<?php
/*	Project:	EQdkp-Plus
 *	Package:	Guildbanker Plugin
 *	Link:		http://eqdkp-plus.eu
 *
 *	Copyright (C) 2006-2015 EQdkp-Plus Developer Team
 *
 *	This program is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU Affero General Public License as published
 *	by the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU Affero General Public License for more details.
 *
 *	You should have received a copy of the GNU Affero General Public License
 *	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if (!defined('EQDKP_INC')){
	die('Do not access this file directly.');
}

if (!class_exists('pdh_w_guildbank_transactions')){
	class pdh_w_guildbank_transactions extends pdh_w_generic {

		public function add($intID, $intBanker, $intChar, $intItem, $intDKP, $intValue, $strSubject, $intStartvalue, $intType=0){
			$resQuery = $this->db->prepare("INSERT INTO __guildbank_transactions :p")->set(array(
				'ta_banker'		=> $intBanker,
				'ta_type'		=> $intType,
				'ta_char'		=> $intChar,
				'ta_item'		=> $intItem,
				'ta_dkp'		=> $intDKP,
				'ta_value'		=> $intValue,
				'ta_subject'	=> $strSubject,
				'ta_date'		=> $this->time->time,
				'ta_startvalue'	=> $intStartvalue,
			))->execute();
			$this->pdh->enqueue_hook('guildbank_items_update');
			if ($resQuery) return $resQuery->insertId;;
			return false;
		}

		public function buy_item($intItem, $intChar, $intDKP, $intAmount=1){
			#$intBanker	= $this->pdh->get('guildbank_items', 'banker', array($intItem));
			$resQuery = $this->db->prepare("INSERT INTO __guildbank_shop_ta :p")->set(array(
				'st_itemid'		=> $intItem,
				'st_date'		=> $this->time->time,
				'st_value'		=> $intDKP,
				'st_amount'		=> $intAmount,
				'st_buyer'		=> $intChar,
			))->execute();
			$this->pdh->enqueue_hook('guildbank_items_update');
		}
		
		public function confirm_itemta($intShopID){
			if($intShopID > 0){
				// read the data
				$trans_data		= $this->pdh->get('guildbank_shop_ta', 'data', array($intShopID));
				$intBanker		= $this->pdh->get('guildbank_items', 'banker', array($trans_data['itemid']));
				$item_amount	= $this->pdh->get('guildbank_items', 'amount', array($trans_data['itemid']));

				// add a transaction
				$this->add(0, $intBanker, $trans_data['buyer'], $trans_data['itemid'], $trans_data['value'], 0, $this->user->lang('gb_shop_buy_subject'));
				
				// reduce the amount
				$this->pdh->put('guildbank_items', 'amount', array($trans_data['itemid'], $item_amount-$trans_data['amount']));
				
				// add auto correction
				if($this->config->get('use_autoadjust',	'guildbank') > 0 && $this->config->get('adjustment_event',	'guildbank') > 0){
					//add_adjustment($adjustment_value, $adjustment_reason, $member_ids, $event_id, $raid_id=NULL, $time=false, $group_key = null)
					$this->pdh->put('adjustment', 'add_adjustment', array($trans_data['value'], $this->user->lang('gb_adjustment_text'), $trans_data['buyer'], $this->config->get('adjustment_event',	'guildbank')));
				}
				
				// now, delete the transaction on hold
				$this->delete_itemta($intShopID);
			}
			return false;
		}

		public function delete_itemta($intShopID){
			if($intShopID > 0){
				$this->db->prepare("DELETE FROM __guildbank_shop_ta WHERE st_id=?")->execute($intShopID);
				$this->pdh->enqueue_hook('guildbank_items_update');
			}
		}

		public function update($intID, $intBanker, $intChar, $intItem, $intDKP, $intValue, $strSubject, $intStartvalue, $intType=0){
			$resQuery = $this->db->prepare("UPDATE __guildbank_transactions :p WHERE ta_id=?")->set(array(
				'ta_banker'		=> $intBanker,
				'ta_type'		=> $intType,
				'ta_char'		=> $intChar,
				'ta_item'		=> $intItem,
				'ta_dkp'		=> $intDKP,
				'ta_value'		=> $intValue,
				'ta_subject'	=> $strSubject,
				'ta_date'		=> $this->time->time,
				'ta_startvalue'	=> $intStartvalue,
			))->execute($intID);
			$this->pdh->enqueue_hook('guildbank_items_update');
			if ($resQuery) return $intID;
			return false;
		}

		public function update_money($intBanker, $intValue){
			$resQuery = $this->db->prepare("UPDATE __guildbank_transactions :p WHERE ta_startvalue=?")->set(array(
				'ta_value'		=> $intValue,
				'ta_date'		=> $this->time->time,
			))->execute($intBanker);
			$this->pdh->enqueue_hook('guildbank_items_update');
			if ($resQuery) return $intBanker;
			return false;
		}

		public function update_itemtransaction($intBanker, $intValue, $intDKP){
			$resQuery = $this->db->prepare("UPDATE __guildbank_transactions :p WHERE ta_item=?")->set(array(
				'ta_dkp'		=> $intDKP,
				'ta_value'		=> $intValue,
				'ta_date'		=> $this->time->time,
			))->execute($intBanker);
			$this->pdh->enqueue_hook('guildbank_items_update');
			if ($resQuery) return $intBanker;
			return false;
		}

		public function delete($intID){
			$this->db->prepare("DELETE FROM __guildbank_transactions WHERE ta_id=?")->execute($intID);
			$this->pdh->enqueue_hook('guildbank_items_update');
			return true;
		}

		public function delete_bybankerid($intID){
			$this->db->prepare("DELETE FROM __guildbank_transactions WHERE ta_banker=?")->execute($intID);
			$this->pdh->enqueue_hook('guildbank_items_update');
			return true;
		}

		public function truncate(){
			$this->db->query("TRUNCATE __guildbank_transactions");
			$this->pdh->enqueue_hook('guildbank_items_update');
			return true;
		}
	} //end class
} //end if class not exists
?>
