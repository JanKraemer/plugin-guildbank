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

if (!defined('EQDKP_INC')){
  die('Do not access this file directly.');
}

if (!class_exists('pdh_w_guildbank_auctions')){
	class pdh_w_guildbank_auctions extends pdh_w_generic {

		public function add($intID, $intItemID, $intStartdate, $intDuration, $intBidsteps, $intStartvalue, $intAttendance, $intMultiDKP, $strNote='', $boolActive=1){
			$resQuery = $this->db->prepare("INSERT INTO __guildbank_auctions :p")->set(array(
				'auction_item'			=> $intItemID,
				'auction_startdate'		=> $intStartdate,
				'auction_duration'		=> $intDuration,
				'auction_bidsteps'		=> $intBidsteps,
				'auction_note'			=> $strNote,
				'auction_startvalue'	=> $intStartvalue,
				'auction_raidattendance'=> $intAttendance,
				'auction_multidkppool'	=> $intMultiDKP,
				'auction_active'		=> $boolActive,
			))->execute();

			$id = $resQuery->insertId;
			$this->pdh->enqueue_hook('guildbank_auction_update');

			if ($resQuery) return $id;
			return false;
		}

		public function update($intID, $intItemID, $intStartdate, $intDuration, $intBidsteps, $intStartvalue, $intAttendance, $intMultiDKP, $strNote='', $boolActive=1){
			$resQuery = $this->db->prepare("UPDATE __guildbank_auctions :p WHERE auction_id=?")->set(array(
				'auction_item'			=> $intItemID,
				'auction_startdate'		=> $intStartdate,
				'auction_duration'		=> $intDuration,
				'auction_bidsteps'		=> $intBidsteps,
				'auction_note'			=> $strNote,
				'auction_startvalue'	=> $intStartvalue,
				'auction_raidattendance'=> $intAttendance,
				'auction_multidkppool'	=> $intMultiDKP,
				'auction_active'		=> $boolActive,
			))->execute($intID);
			$this->pdh->enqueue_hook('guildbank_auction_update');
			if ($resQuery) return $intID;
			return false;
		}

		public function delete($intID){
			$this->db->prepare("DELETE FROM __guildbank_auctions WHERE auction_id=?")->execute($intID);
			$this->pdh->put('guildbank_auction_bids', 'delete_byauction', array($intID));
			$this->pdh->enqueue_hook('guildbank_auction_update');
			return true;
		}

		public function truncate(){
			$this->db->query("TRUNCATE __guildbank_auctions");
			$this->pdh->enqueue_hook('guildbank_auction_update');
			return true;
		}
	} //end class
} //end if class not exists
?>
