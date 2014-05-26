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

		public function add($intID, $strName, $intMoney, $intBankChar, $strNote){
			$resQuery = $this->db->prepare("INSERT INTO __guildbank_banker :p")->set(array(
				'banker_name'			=> $strName,
				'banker_bankchar'		=> $intBankChar,
				'banker_note'			=> $strNote
			))->execute();
			
			$id = $resQuery->insertId;
			//($intID, $intBanker, $intChar, $intItem, $intDKP, $intValue, $strSubject, $intStartvalue)
			$this->pdh->put('guildbank_transactions', 'add', array(0, $id, $intBankChar, 0, 0, $intMoney, '', $id));
			$this->pdh->enqueue_hook('guildbank_banker_update');
			
			if ($resQuery) return $id;
			return false;
		}

		public function update($intID, $strName, $intMoney, $intBankChar, $strNote){
			$resQuery = $this->db->prepare("UPDATE __guildbank_banker SET :p WHERE banker_id=?")->set(array(
				'banker_name'			=> $strName,
				'banker_bankchar'		=> $intBankChar,
				'banker_note'			=> $strNote
			))->execute($intID);
			$this->pdh->put('guildbank_transactions', 'update_money', array($intBankChar, $intMoney));
			$this->pdh->enqueue_hook('guildbank_banker_update');
			if ($resQuery) return $intID;
			return false;
		}
	
		public function delete($intID){
			$this->db->prepare("DELETE FROM __guildbank_banker WHERE banker_id=?")->execute($intID);
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
?>
