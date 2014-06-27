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

if (!class_exists('pdh_w_guildbank_items'))
{
	class pdh_w_guildbank_items extends pdh_w_generic {

		public function add($intID, $strBanker, $strName, $intRarity, $strType, $intAmount, $intDKP, $intMoney, $intChar, $intSellable=0, $strSubject='gb_item_added'){
			$resQuery = $this->db->prepare("INSERT INTO __guildbank_items :p")->set(array(
				'item_banker'	=> $strBanker,
				'item_date'		=> $this->time->time,
				'item_name'		=> $strName,
				'item_rarity'	=> $intRarity,
				'item_type'		=> $strType,
				'item_amount'	=> $intAmount,
				'item_sellable'	=> $intSellable,
			))->execute();
			$id = $resQuery->insertId;
			//($intID, $intBanker, $intChar, $intItem, $intDKP, $intValue, $strSubject, $intStartvalue)
			$this->pdh->put('guildbank_transactions', 'add', array(0, $strBanker, $intChar, $id, $intDKP, $intMoney, $strSubject, $id));
			$this->pdh->enqueue_hook('guildbank_items_update');
			if ($resQuery) return $id;
			return false;
		}

		public function update($intID, $strBanker, $strName, $intRarity, $strType, $intAmount, $intDKP, $intMoney, $intChar, $intSellable=0, $strSubject=''){
			$resQuery = $this->db->prepare("UPDATE __guildbank_items :p WHERE item_id=?")->set(array(
				'item_banker'	=> $strBanker,
				'item_date'		=> $this->time->time,
				'item_name'		=> $strName,
				'item_rarity'	=> $intRarity,
				'item_type'		=> $strType,
				'item_amount'	=> $intAmount,
				'item_sellable'	=> $intSellable,
			))->execute($intID);
			$this->pdh->put('guildbank_transactions', 'update_itemtransaction',	array($intID, $intMoney, $intDKP));
			$this->pdh->enqueue_hook('guildbank_items_update');
			if ($resQuery) return $intID;
			return false;
		}

		public function amount($intID, $intAmount){
			$resQuery = $this->db->prepare("UPDATE __guildbank_items :p WHERE item_id=?")->set(array(
				'item_amount'	=> $intAmount,
			))->execute($intID);
			$this->pdh->enqueue_hook('guildbank_items_update');
			if ($resQuery) return $intID;
			return false;
		}

		public function delete($intID){
			$this->db->prepare("DELETE FROM __guildbank_items WHERE item_id=?")->execute($intID);
			$this->pdh->enqueue_hook('guildbank_items_update');
			return true;
		}
	
		public function truncate(){
			$this->db->query("TRUNCATE __guildbank_items");
			$this->pdh->enqueue_hook('guildbank_items_update');
			return true;
		}
	} //end class
} //end if class not exists
?>
