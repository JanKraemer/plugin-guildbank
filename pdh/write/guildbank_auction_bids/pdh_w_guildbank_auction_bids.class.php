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

if (!class_exists('pdh_w_guildbank_auction_bids')){
	class pdh_w_guildbank_auction_bids extends pdh_w_generic {

		public function add($intAuctionID, $intDate, $intUMemberID, $intBidvalue){
			$resQuery = $this->db->prepare("INSERT INTO __guildbank_auction_bids :p")->set(array(
				'bid_auctionid'		=> $intAuctionID,
				'bid_date'			=> $intDate,
				'bid_memberid'		=> $intMemberID,
				'bid_bidvalue'		=> $intBidvalue,
			))->execute();

			$id = $resQuery->insertId;
			$this->pdh->enqueue_hook('guildbank_auction_bid_update');

			if ($resQuery) return $id;
			return false;
		}

		public function delete($intID){
			$this->db->prepare("DELETE FROM __guildbank_auction_bids WHERE bid_id=?")->execute($intID);
			$this->pdh->enqueue_hook('guildbank_auction_bid_update');
			return true;
		}
		
		public function delete_byauction($intID){
			$this->db->prepare("DELETE FROM __guildbank_auction_bids WHERE bid_auctionid=?")->execute($intID);
			$this->pdh->enqueue_hook('guildbank_auction_bid_update');
			return true;
		}

		public function truncate(){
			$this->db->query("TRUNCATE __guildbank_auction_bids");
			$this->pdh->enqueue_hook('guildbank_auction_bid_update');
			return true;
		}
	} //end class
} //end if class not exists
?>
