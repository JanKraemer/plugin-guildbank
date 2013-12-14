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

		public static function __shortcuts() {
			$shortcuts = array('pdc', 'db', 'pdh', 'game', 'user', 'html', 'config', 'jquery', 'time');
			return array_merge(parent::$shortcuts, $shortcuts);
		}

		public function add($intID, $intBanker, $intChar, $intItem, $intDKP, $intValue, $strSubject, $intStartvalue){
			$resQuery = $this->db->query("INSERT INTO __guildbank_transactions :params", array(
				'ta_banker'		=> $intBanker,
				'ta_char'		=> $intChar,
				'ta_item'		=> $intItem,
				'ta_dkp'		=> $intDKP,
				'ta_value'		=> $intValue,
				'ta_subject'	=> $strSubject,
				'ta_date'		=> $this->time->time,
				'ta_startvalue'	=> $intStartvalue,
			));
			$this->pdh->enqueue_hook('guildbank_transactions_update');
			if ($resQuery) return $this->db->insert_id();
			return false;
		}

		public function update($intID, $intBanker, $intChar, $intItem, $intDKP, $intValue, $strSubject, $intStartvalue){
			$resQuery = $this->db->query("UPDATE __guildbank_transactions SET :params WHERE ta_id=?", array(
				'ta_banker'		=> $intBanker,
				'ta_char'		=> $intChar,
				'ta_item'		=> $intItem,
				'ta_dkp'		=> $intDKP,
				'ta_value'		=> $intValue,
				'ta_subject'	=> $strSubject,
				'ta_date'		=> $this->time->time,
				'ta_startvalue'	=> $intStartvalue,
			), $intID);
			$this->pdh->enqueue_hook('guildbank_transactions_update');
			if ($resQuery) return $intID;
			return false;
		}

		public function update_money($intBanker, $intValue){
			$resQuery = $this->db->query("UPDATE __guildbank_transactions SET :params WHERE ta_startvalue=?", array(
				'ta_value'		=> $intValue,
				'ta_date'		=> $this->time->time,
			), $intBanker);
			$this->pdh->enqueue_hook('guildbank_transactions_update');
			if ($resQuery) return $intBanker;
			return false;
		}

		public function update_itemtransaction($intBanker, $intValue, $intDKP){
			$resQuery = $this->db->query("UPDATE __guildbank_transactions SET :params WHERE ta_item=?", array(
				'ta_dkp'		=> $intDKP,
				'ta_value'		=> $intValue,
				'ta_date'		=> $this->time->time,
			), $intBanker);
			$this->pdh->enqueue_hook('guildbank_transactions_update');
			if ($resQuery) return $intBanker;
			return false;
		}

		public function delete($intID){
			$this->db->query("DELETE FROM __guildbank_transactions WHERE ta_id=?", false, $intID);
			$this->pdh->enqueue_hook('guildbank_transactions_update');
			return true;
		}

		public function delete_bybankerid($intID){
			$this->db->query("DELETE FROM __guildbank_transactions WHERE ta_banker=?", false, $intID);
			$this->pdh->enqueue_hook('guildbank_transactions_update');
			return true;
		}

		public function truncate(){
			$this->db->query("TRUNCATE __guildbank_transactions");
			$this->pdh->enqueue_hook('guildbank_transactions_update');
			return true;
		}
	} //end class
} //end if class not exists

if(version_compare(PHP_VERSION, '5.3.0', '<')) registry::add_const('short_pdh_w_guildbank_transactions', pdh_w_guildbank_transactions::__shortcuts());
?>
