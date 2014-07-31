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

if (!class_exists('pdh_r_guildbank_banker')){
	class pdh_r_guildbank_banker extends pdh_r_generic{
		private $data;

		public $hooks = array(
			'guildbank_banker_update'
		);

		public $presets = array(
		);

		public function reset(){
			$this->pdc->del('pdh_guildbank_banker_table');
			unset($this->data);
		}

		public function init(){
			// try to get from cache first
			$this->data = $this->pdc->get('pdh_guildbank_banker_table');
			if($this->data !== NULL){
				return true;
			}

			// empty array as default
			$this->data = array();

			// read all guildbank_fields entries from db
			$sql = 'SELECT * FROM `__guildbank_banker` ORDER BY banker_id ASC;';
			$result = $this->db->query($sql);
			if ($result){
				// add row by row to local copy
				while (($row = $result->fetchAssoc())){
					$this->data[(int)$row['banker_id']] = array(
						'id'			=> (int)$row['banker_id'],
						'name'			=> $row['banker_name'],
						'bankchar'		=> (int)$row['banker_bankchar'],
						'note'			=> $row['banker_note'],
					);
				}
				#$this->db->free_result($result);
			}

			// add data to cache
			$this->pdc->put('pdh_guildbank_banker_table', $this->data, null);
			return true;
		}

		public function get_id_list(){
			if (is_array($this->data)){
				return array_keys($this->data);
			}
			return array();
		}

		public function get_name($id){
			return (isset($this->data[$id]) && $this->data[$id]['name']) ? $this->data[$id]['name'] : 'None';
		}

		public function get_note($id){
			return (isset($this->data[$id]) && $this->data[$id]['note']) ? $this->data[$id]['note'] : '';
		}

		public function get_refresh_date($id){
			return $this->time->user_date(0);;
		}

		public function get_bankchar($id, $raw=false){
			if($raw){
				return (isset($this->data[$id]) && $this->data[$id]['bankchar'] > 0) ? $this->data[$id]['bankchar'] : 0;
			}
			return (isset($this->data[$id]) && $this->data[$id]['bankchar'] > 0) ? $this->pdh->get('member', 'name', array($this->data[$id]['bankchar'])) : $this->user->lang('gb_no_bankchar');
		}
	} //end class
} //end if class not exists
?>
