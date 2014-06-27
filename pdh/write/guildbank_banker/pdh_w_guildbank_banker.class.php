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

if (!class_exists('pdh_w_guildbank_banker'))
{
	class pdh_w_guildbank_banker extends pdh_w_generic {

		public static function __shortcuts() {
			$shortcuts = array('pdc', 'db', 'pdh', 'game', 'user', 'html', 'config', 'jquery', 'time');
			return array_merge(parent::$shortcuts, $shortcuts);
		}

		public function add($intID, $strName, $intMoney, $intBankChar, $strNote){
			$resQuery = $this->db->query("INSERT INTO __guildbank_banker :params", array(
				'banker_name'			=> $strName,
				'banker_bankchar'		=> $intBankChar,
				'banker_note'			=> $strNote
			));
			$id = $this->db->insert_id();
			//($intID, $intBanker, $intChar, $intItem, $intDKP, $intValue, $strSubject, $intStartvalue)
			$this->pdh->put('guildbank_transactions', 'add', array(0, $id, $intBankChar, 0, 0, $intMoney, '', $id));
			$this->pdh->enqueue_hook('guildbank_banker_update');
			
			if ($resQuery) return $id;
			return false;
		}

		public function update($intID, $strName, $intMoney, $intBankChar, $strNote){
			$resQuery = $this->db->query("UPDATE __guildbank_banker SET :params WHERE banker_id=?", array(
				'banker_name'			=> $strName,
				'banker_bankchar'		=> $intBankChar,
				'banker_note'			=> $strNote
			), $intID);
			$this->pdh->put('guildbank_transactions', 'update_money', array($intID, $intMoney));
			$this->pdh->enqueue_hook('guildbank_banker_update');
			if ($resQuery) return $intID;
			return false;
		}
	
		public function delete($intID){
			$this->db->query("DELETE FROM __guildbank_banker WHERE banker_id=?", false, $intID);
			$this->pdh->put('guildbank_transactions', 'delete_bybankerid', array($intID));
			$this->pdh->enqueue_hook('guildbank_banker_update');
			return true;
		}
	
	public function truncate(){
		$this->db->query("TRUNCATE __guildbank_banker");
		$this->pdh->enqueue_hook('guildbank_banker_update');
		return true;
	}
   
    

  } //end class
} //end if class not exists

if(version_compare(PHP_VERSION, '5.3.0', '<')) registry::add_const('short_pdh_w_guildbank_banker', pdh_w_guildbank_banker::__shortcuts());
?>
