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

if (!class_exists('pdh_r_guildbank_transactions')){
	class pdh_r_guildbank_transactions extends pdh_r_generic{

		public static function __shortcuts() {
			$shortcuts = array('pdc', 'db', 'pdh', 'game', 'user', 'html', 'config', 'jquery', 'time');
			return array_merge(parent::$shortcuts, $shortcuts);
		}

		private $data;
		private $startvalues;
		private $summ;
		private $itemcost;

		public $hooks = array(
			'guildbank_transactions_update'
		);

		public $presets = array(
		);

		public function reset(){
			$this->pdc->del('pdh_guildbank_ta_table.transactions');
			$this->pdc->del('pdh_guildbank_ta_table.startvalues');
			$this->pdc->del('pdh_guildbank_ta_table.summ');
			$this->pdc->del('pdh_guildbank_ta_table.itemcost');
			unset($this->data);
			unset($this->startvalues);
			unset($this->summ);
			unset($this->itemcost);
		}

		public function init(){
			// try to get from cache first
			$this->data			= $this->pdc->get('pdh_guildbank_ta_table.transactions');
			$this->startvalues	= $this->pdc->get('pdh_guildbank_ta_table.startvalues');
			$this->summ			= $this->pdc->get('pdh_guildbank_ta_table.summ');
			$this->itemcost		= $this->pdc->get('pdh_guildbank_ta_table.itemcost');
			if($this->data !== NULL && $this->startvalues !== NULL && $this->summ !== NULL && $this->itemcost !== NULL){
				return true;
			}

			// empty array as default
			$this->data = $this->startvalues = $this->summ = $this->itemcost = array();

			$sql = 'SELECT * FROM `__guildbank_transactions` ORDER BY ta_id ASC;';
			$result = $this->db->query($sql);
			if ($result){
				// add row by row to local copy
				while (($row = $this->db->fetch_record($result))){
					$this->data[(int)$row['ta_id']] = array(
						'id'			=> (int)$row['ta_id'],
						'banker'		=> (int)$row['ta_banker'],
						'char'			=> (int)$row['ta_char'],
						'item'			=> (int)$row['ta_item'],
						'dkp'			=> (int)$row['ta_dkp'],
						'value'			=> (int)$row['ta_value'],
						'subject'		=> $row['ta_subject'],
						'date'			=> (int)$row['ta_date'],
						'startvalue'	=> (int)$row['ta_startvalue'],
					);
					$this->summ[(int)(int)$row['ta_banker']] += (int)$row['ta_value'];
					$this->startvalues[(int)$row['ta_startvalue']] = $row['ta_value'];
					if((int)$row['ta_item'] > 0){
						$this->itemcost[(int)$row['ta_item']] = $row['ta_value'];
					}
				}
				$this->db->free_result($result);
			}

			// add data to cache
			$this->pdc->put('pdh_guildbank_ta_table.transactions',	$this->data,		null);
			$this->pdc->put('pdh_guildbank_ta_table.startvalues',	$this->startvalues,	null);
			$this->pdc->put('pdh_guildbank_ta_table.summ',			$this->summ,		null);
			$this->pdc->put('pdh_guildbank_ta_table.itemcost',		$this->itemcost,	null);
			return true;
		}

		public function get_id_list(){
			if (is_array($this->data)){
				return array_keys($this->data);
			}
			return array();
		}

		public function get_char($id, $raw=false){
			if($raw){
				return (isset($this->data[$id]) && $this->data[$id]['char'] > 0) ? $this->data[$id]['char'] : 0;
			}
			return (isset($this->data[$id]) && $this->data[$id]['char'] > 0) ? $this->pdh->get('member', 'name', array($this->data[$id]['char'])) : '--';
		}

		public function get_banker($id, $raw=false){
			if($raw){
				return (isset($this->data[$id]) && $this->data[$id]['banker'] > 0) ? $this->data[$id]['banker'] : 0;
			}
			return (isset($this->data[$id]) && $this->data[$id]['char'] > 0) ? $this->pdh->get('guildbank_banker', 'name', array($this->data[$id]['banker'])) : '--';
		}

		public function get_item($id, $raw=false){
			if($raw){
				return (isset($this->data[$id]) && $this->data[$id]['item'] > 0) ? $this->data[$id]['item'] : 0;
			}
			return (isset($this->data[$id]) && $this->data[$id]['item'] > 0) ? $this->pdh->get('guildbank_items', 'name', array($this->data[$id]['item'])) : '--';
		}

		public function get_value($id){
			return (isset($this->data[$id]) && $this->data[$id]['value'] > 0) ? $this->data[$id]['value'] : 0;
		}

		public function get_item_price($itemid){
			return (isset($this->itemcost[$bankid]) && $this->itemcost[$bankid] > 0) ? $this->itemcost[$bankid] : 0;
		}

		public function get_money_summ($bankid){
			return (isset($this->summ[$bankid]) && $this->summ[$bankid] > 0) ? $this->summ[$bankid] : 0;
		}

		public function get_money($bankid){
			return (isset($this->startvalues[$bankid]) && $this->startvalues[$bankid] > 0) ? $this->startvalues[$bankid] : 0;
		}

		public function get_dkp($id){
			return (isset($this->data[$id]) && $this->data[$id]['dkp'] > 0) ? $this->data[$id]['dkp'] : 0;
		}

		public function get_startvalue($id){
			return (isset($this->data[$id]) && $this->data[$id]['startvalue'] > 0) ? $this->data[$id]['startvalue'] : 0;
		}

		public function get_date($id, $raw=false){
			if($raw){
				return (isset($this->data[$id]) && $this->data[$id]['date'] > 0) ? $this->data[$id]['date'] : 0;
			}
			return (isset($this->data[$id]) && $this->data[$id]['date'] > 0) ? $this->time->user_date($this->data[$id]['date']) : '--';
		}

		public function get_subject($id){
			return (isset($this->data[$id]) && $this->data[$id]['subject']) ? $this->data[$id]['subject'] : '';
		}
  } //end class
} //end if class not exists
?>
