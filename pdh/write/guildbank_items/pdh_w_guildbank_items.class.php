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

/*+----------------------------------------------------------------------------
  | pdh_w_guildrequest_fields
  +--------------------------------------------------------------------------*/
if (!class_exists('pdh_w_guildbank_items'))
{
	class pdh_w_guildbank_items extends pdh_w_generic {

		public static function __shortcuts() {
			$shortcuts = array('pdc', 'db', 'pdh', 'game', 'user', 'html', 'config', 'jquery', 'time');
			return array_merge(parent::$shortcuts, $shortcuts);
		}

		public function add($strBanker, $strName, $intRarity, $strType, $intAmount, $intQty){
			$resQuery = $this->db->query("INSERT INTO __guildbank_items :params", array(
				'item_banker'	=> $strBanker,
				'item_name'		=> $strName,
				'item_rarity'	=> $intRarity,
				'item_type'		=> $strType,
				'item_amount'	=> $intAmount,
				'item_qty'		=> $intQty,
			));
			$this->pdh->enqueue_hook('guildbank_items_update');
			if ($resQuery) return $this->db->insert_id();
			return false;
		}

		public function update($intID, $strBanker, $strName, $intRarity, $strType, $intAmount, $intQty){
			$resQuery = $this->db->query("UPDATE __guildbank_items SET :params WHERE item_id=?", array(
				'item_banker'	=> $strBanker,
				'item_name'		=> $strName,
				'item_rarity'	=> $intRarity,
				'item_type'		=> $strType,
				'item_amount'	=> $intAmount,
				'item_qty'		=> $intQty,
			), $intID);
			$this->pdh->enqueue_hook('guildbank_items_update');
			if ($resQuery) return $intID;
			return false;
		}
	
		public function delete($intID){
			$this->db->query("DELETE FROM __guildbank_items WHERE item_id=?", false, $intID);
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

if(version_compare(PHP_VERSION, '5.3.0', '<')) registry::add_const('short_pdh_w_guildbank_items', pdh_w_guildbank_items::__shortcuts());
?>
