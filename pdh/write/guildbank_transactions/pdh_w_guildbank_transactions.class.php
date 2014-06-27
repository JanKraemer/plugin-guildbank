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

if (!class_exists('pdh_w_guildbank_transactions'))
{
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
