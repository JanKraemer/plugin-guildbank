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

if (!defined('EQDKP_INC'))
{
  die('Do not access this file directly.');
}

if (!class_exists('pdh_r_guildbank_items')){
	class pdh_r_guildbank_items extends pdh_r_generic{

		public static function __shortcuts() {
			$shortcuts = array('pdc', 'db', 'pdh', 'game', 'user', 'html', 'config', 'jquery', 'time', 'money' => 'gb_money');
			return array_merge(parent::$shortcuts, $shortcuts);
		}

		private $data;

		public $hooks = array(
			'guildbank_items_update'
		);

		public $presets = array(
			'gb_idate'		=> array('html_date',	array('%item_id%'), array()),
			'gb_iname'		=> array('name',		array('%item_id%', '%itt_lang%', '%itt_direct%', '%onlyicon%', '%noicon%'), array()),
			'gb_iamount'	=> array('amount',		array('%item_id%'), array()),
			'gb_itype'		=> array('type',		array('%item_id%'), array()),
			'gb_iedit'		=> array('edit',		array('%item_id%'), array()),
			'gb_ivalue'		=> array('value',		array('%item_id%'), array()),
			'gb_ivalue_a'	=> array('value_a',		array('%item_id%'), array()),
			'gb_irarity'	=> array('rarity',		array('%item_id%'), array()),
			'gb_ibanker'	=> array('banker_name',	array('%item_id%'), array()),
			'gb_idkp'		=> array('dkp',			array('%item_id%'), array()),
		);

		public function reset(){
			$this->pdc->del('pdh_guildbank_items_table.items');
			$this->pdc->del('pdh_guildbank_items_table.banker_items');
			unset($this->data);
			unset($this->banker_items);
		}

		public function init(){
			// try to get from cache first
			$this->data			= $this->pdc->get('pdh_guildbank_items_table.items');
			$this->banker_items	= $this->pdc->get('pdh_guildbank_items_table.banker_items');
			if($this->data !== NULL && $this->banker_items !== NULL){
				return true;
			}

			// empty array as default
			$this->data = $this->banker_items = array();

			$sql = 'SELECT * FROM `__guildbank_items` ORDER BY item_id ASC;';
			$result = $this->db->query($sql);
			if ($result){
				// add row by row to local copy
				while (($row = $this->db->fetch_record($result))){
					$this->data[(int)$row['item_id']] = array(
						'id'		=> (int)$row['item_id'],
						'banker'	=> (int)$row['item_banker'],
						'name'		=> $row['item_name'],
						'type'		=> $row['item_type'],
						'rarity'	=> (int)$row['item_rarity'],
						'amount'	=> (int)$row['item_amount'],
						'date'		=> (int)$row['item_date']
					);
					$this->banker_items[(int)$row['item_banker']][(int)$row['item_id']]	= $row['item_name'];
				}
				$this->db->free_result($result);
			}

			// add data to cache
			$this->pdc->put('pdh_guildbank_items_table.items', $this->data, null);
			$this->pdc->put('pdh_guildbank_items_table.banker_items', $this->banker_items, null);
			return true;
		}

		public function get_id_list($bankerID = 0, $priority = 0, $type = 0, $rarity = 0){
			$data	= ($bankerID > 0) ? $this->banker_items[$bankerID] : $this->data;
			if (is_array($data)){
				$data	= array_keys($data);
				// filter the output
				if($priority > 0 || $type > 0 || $rarity > 0){
					foreach($data as $itemid) {
						if(($type > 0 && $this->get_type($itemid) != $type) ||	($priority > 0 && $this->get_priority($itemid) != $priority) || ($rarity > 0 && $this->get_rarity($itemid) != $rarity)){
							unset($data[$itemid]);
						}
					}
				}
				return $data;
			}
			return array();
		}

		public function get_date($id){
			return (isset($this->data[$id]) && $this->data[$id]['date'] > 0) ? $this->data[$id]['date'] : 0;
		}

		public function get_html_date($id){
			return $this->time->user_date($this->get_date($id));
		}

		public function get_amount($id){
			return (isset($this->data[$id]) && $this->data[$id]['amount'] > 0) ? $this->data[$id]['amount'] : 0;
		}

		public function get_rarity($id, $raw=false){
			if($raw){
				return (isset($this->data[$id]) && $this->data[$id]['rarity'] > 0) ? $this->data[$id]['rarity'] : 0;
			}
			return (isset($this->data[$id]) && $this->data[$id]['rarity'] > 0) ? $this->user->lang(array('gb_a_rarity', $this->data[$id]['rarity'])) : 0;
		}

		public function get_name($id){
			return (isset($this->data[$id]) && $this->data[$id]['name']) ? $this->data[$id]['name'] : 'none';
		}

		public function get_type($id, $raw=false){
			if($raw){
				return (isset($this->data[$id]) && $this->data[$id]['type']) ? $this->data[$id]['type'] : 'none';
			}
			return (isset($this->data[$id]) && $this->data[$id]['type']) ? $this->user->lang(array('gb_a_type', $this->data[$id]['type'])) : 'none';
		}

		public function get_edit($id){
			return '<a href="javascript:edit_item(\''.$id.'\');"><img src="'.$this->root_path.'images/glyphs/edit.png" alt="'.$this->user->lang('edit').'" title="'.$this->user->lang('edit').'" /></a>';
		}

		public function get_value($id){
			return $this->money->fields($this->pdh->get('guildbank_transactions', 'itemvalue', array($id)));
		}

		public function get_value_a($id){
			return $this->money->fields($this->pdh->get('guildbank_transactions', 'itemvalue', array($id)));
		}

		public function get_dkp($id){
			return $this->pdh->get('guildbank_transactions', 'itemdkp', array($id));
		}

		public function get_banker($id){
			return (isset($this->data[$id]) && $this->data[$id]['banker']) ? $this->data[$id]['banker'] : 0;
		}

		public function get_banker_name($id){
			return $this->pdh->get('guildbank_banker', 'name', array($this->get_banker($id)));
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
						'onclose' => $_SERVER['REQUEST_URI']
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
