<?php
/*
 * Project:     EQdkp GuildBank
 * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:        http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:       2005
 * Date:        $Date$
 * -----------------------------------------------------------------------
 * @author      $Author$
 * @copyright   2005-2014 Wallenium
 * @link        http://eqdkp-plus.com
 * @package     guildbank
 * @version     $Rev$
 *
 * $Id$
 */

if (!defined('EQDKP_INC')){
  die('Do not access this file directly.');
}

if (!class_exists('pdh_r_guildbank_auctions')){
	class pdh_r_guildbank_auctions extends pdh_r_generic{
		private $data;

		public $hooks = array(
			'guildbank_auction_update'
		);

		public $presets = array(
			'gb_aname'		=> array('name',		array('%auction_id%', '%itt_lang%', '%itt_direct%', '%onlyicon%', '%noicon%'), array()),
			'gb_aname_itt'	=> array('name_itt',	array('%auction_id%', '%itt_lang%', '%itt_direct%', '%onlyicon%', '%noicon%'), array()),
			'gb_astartdate'	=> array('startdate',	array('%auction_id%'), array()),
			'gb_astartvalue'=> array('startvalue',	array('%auction_id%'), array()),
			'gb_aduration'	=> array('duration',	array('%auction_id%'), array()),
			'gb_abidsteps'	=> array('bidsteps',	array('%auction_id%'), array()),
			'gb_anote'		=> array('note',		array('%auction_id%'), array()),
			'gb_aactive'	=> array('active',		array('%auction_id%'), array()),
			'gb_aedit'		=> array('edit',		array('%auction_id%'), array()),
		);

		public function reset(){
			$this->pdc->del('pdh_guildbank_auction_table');
			unset($this->data);
		}

		public function init(){
			// try to get from cache first
			$this->data = $this->pdc->get('pdh_guildbank_auction_table');
			if($this->data !== NULL){
				return true;
			}

			// empty array as default
			$this->data = array();

			// read all guildbank_fields entries from db
			$sql = 'SELECT * FROM `__guildbank_auctions` ORDER BY auction_id ASC;';
			$result = $this->db->query($sql);
			if ($result){
				// add row by row to local copy
				while (($row = $result->fetchAssoc())){
					$this->data[(int)$row['auction_id']] = array(
						'id'				=> (int)$row['auction_id'],
						'item'				=> (int)$row['auction_item'],
						'startvalue'		=> (int)$row['auction_startvalue'],
						'startdate'			=> (int)$row['auction_startdate'],
						'duration'			=> (int)$row['auction_duration'],
						'bidsteps'			=> (int)$row['auction_bidsteps'],
						'note'				=> $row['auction_note'],
						'active'			=> (int)$row['auction_active'],
						'raidattendance'	=> (int)$row['auction_raidattendance'],
					);
				}
			}

			// add data to cache
			$this->pdc->put('pdh_guildbank_auction_table', $this->data, null);
			return true;
		}

		public function get_id_list($active_only=false){
			if (is_array($this->data)){
				// filter active only
				if($active_only){
					foreach($this->data as $id=>$value){
						if($value['active'] == 0){
							unset($this->data[$id]);
						}
					}
				}
				return array_keys($this->data);
			}
			return array();
		}

		public function get_note($id){
			return (isset($this->data[$id]) && $this->data[$id]['note']) ? $this->data[$id]['note'] : '';
		}

		public function get_startdate($id){
			return (isset($this->data[$id]) && $this->data[$id]['startdate']) ? $this->time->user_date($this->data[$id]['startdate'], true, false, true) : '';
		}

		public function get_duration($id){
			return (isset($this->data[$id]) && $this->data[$id]['duration']) ? $this->data[$id]['duration'] : 0;
		}

		public function get_bidsteps($id){
			return (isset($this->data[$id]) && $this->data[$id]['bidsteps']) ? $this->data[$id]['bidsteps'] : 0;
		}

		public function get_startvalue($id){
			return (isset($this->data[$id]) && $this->data[$id]['startvalue']) ? $this->data[$id]['startvalue'] : 0;
		}

		public function get_raidattendance($id){
			return (isset($this->data[$id]) && $this->data[$id]['raidattendance']) ? $this->data[$id]['raidattendance'] : 0;
		}

		public function get_active($id){
			return (isset($this->data[$id]) && $this->data[$id]['active']) ? $this->data[$id]['active'] : 0;
		}

		public function get_edit($id){
			return '<a href="javascript:edit_auction(\''.$id.'\');"><i class="fa fa-pencil fa-lg" title="'.$this->user->lang('edit').'"></i></a>';
		}

		public function get_name($id){
			return (isset($this->data[$id]) && $this->data[$id]['item']) ? $this->pdh->get('guildbank_items', 'name', array($this->data[$id]['item'])) : 0;
		}

		public function get_itt_itemname($id, $lang=false, $direct=0, $onlyicon=0, $noicon=false, $in_span=false) {
			if(!isset($this->data[$id])) return false;
			if($this->config->get('infotooltip_use')) {
				$lang = (!$lang) ? $this->user->lang('XML_LANG') : $lang;
				$ext = '';
				if($direct) {
					$options = array(
						'url' => $this->root_path."infotooltip/infotooltip_feed.php?name=".urlencode(base64_encode($this->get_name($id)))."&lang=".$lang."&update=1&direct=1",
						'height' => '340',
						'width' => '400',
						'onclose' => $this->env->request
					);
					$this->jquery->Dialog("infotooltip_update", "Item-Update", $options);
					$ext = '<span style="cursor:pointer;" onclick="infotooltip_update()">Refresh</span>';
				}
				return infotooltip($this->get_name($id), 0, $lang, $direct, $onlyicon, $noicon, '', false, false, $in_span, false).$ext;
			}
			return $this->get_name($id);
		}

		public function get_name_itt($item_id, $lang=false, $direct=0, $onlyicon=0, $noicon=false, $in_span=false) {
			return $this->get_itt_itemname($item_id, $lang, $direct, $onlyicon, $noicon, $in_span);
		}
	} //end class
} //end if class not exists
?>
