<?php
/*	Project:	EQdkp-Plus
 *	Package:	Guildbanker Plugin
 *	Link:		http://eqdkp-plus.eu
 *
 *	Copyright (C) 2006-2016 EQdkp-Plus Developer Team
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
	header('HTTP/1.0 404 Not Found'); exit;
}

/*+----------------------------------------------------------------------------
  | mc_featured_media_portal
  +--------------------------------------------------------------------------*/
class gb_auctions_portal extends portal_generic{

	/**
	* Portal path
	*/
	protected static $path = 'gb_auctions';
	/**
	* Portal data
	*/
/**
	* Portal data
	*/
	protected static $data = array(
		'name'			=> 'Guildbank number of open auctions',
		'version'		=> '0.1.0',
		'author'			=> 'Wallenium',
		'contact'		=> 'https://eqdkp-plus.eu',
		'description'	=> 'Displays the number of available and open auctions',
		'lang_prefix'	=> 'gb_',
		'multiple'		=> true,
	);
	
	protected static $apiLevel = 20;
	protected static $multiple = true;
	
	public function get_settings($state){
		$settings = array(
			'show_list_future_auctions'	=> array(
				'type'		=> 'radio',
				'default'	=> '0',
			),
			'show_count_future_auctions'	=> array(
				'type'		=> 'radio',
				'default'	=> '1',
			),
			'show_timeleft'	=> array(
				'type'		=> 'radio',
				'default'	=> '0',
			),
		);
		return $settings;
	}

	/**
	* output
	* Get the portal output
	*
	* @returns string
	*/
	public function output(){
		$output			= "";
		$arrAuctions	= $this->pdh->geth('guildbank_auctions', 'id_list', array(true));

		$output = '<table class="table fullwidth nextraid_table">';
		// the number of auctions
		if($this->config('show_count_future_auctions')){
			$output .= '<tr class="gbportalAuctionCount"><td colsüan="4">'.count($arrAuctions).'</td></tr>';
		}

		// show the single auctions
		if($this->config('show_list_future_auctions')){
			if((is_array($arrAuctions) && count($arrAuctions) > 0)){
				foreach($arrAuctions as $intAuctionID=>$strAuctionsData){
					if($this->config('show_timeleft')){
						$this->pdh->get('guildbank_auctions', 'counterJS');
					}
					$strItemName	= $this->pdh->geth('guildbank_auctions', 'html_name', array($strAuctionsData['item']));
					$strMaxValue	= $this->pdh->geth('guildbank_auction_bids', 'highest_value', array($intAuctionID));
					$strMaxBidder	= $this->pdh->geth('guildbank_auction_bids', 'highest_bidder', array($intAuctionID));
					$strEndDate		= $this->pdh->geth('guildbank_auctions', 'enddate', array($intAuctionID));
					$strTimeLeft	= $this->pdh->geth('guildbank_auctions', 'atime_left_html', array($intAuctionID));
					$output .= '<tr>
										<td width="70%">'.$strItemName.'</td>
										<td width="15%">'.(($this->config('show_timeleft')) ? $strTimeLeft : $strEndDate).'</td>
										<td width="15%">'.$strMaxBidder.'</td>
										<td width="15%">'.$strMaxValue.'</td>
									</tr>';
				}
			}else{
				$output .= '<tr><td colsüan="4">No entries</td></tr>';
			}
		}
		
		$output .= '</table>';
		return $output;
	}
}

?>