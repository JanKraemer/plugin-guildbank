<?php
 /*
 * Project:		EQdkp-Plus Guildbank Plugin
 * License:		Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:		2014
 * Date:		$Date$
 * -----------------------------------------------------------------------
 * @author		$Author$
 * @copyright	2006-2014 EQdkp-Plus Developer Team
 * @link		http://eqdkp-plus.com
 * @package		eqdkp-plus
 * @version		$Rev$
 * 
 * $Id$
 */

if (!defined('EQDKP_INC')){
	header('HTTP/1.0 404 Not Found');exit;
}

include_once(registry::get_const('root_path').'maintenance/includes/sql_update_task.class.php');

if (!class_exists('update_guildbank_200')){
	class update_guildbank_200 extends sql_update_task{

		public $author		= 'Wallenium';
		public $version		= '2.0.0';    // new version
		public $name		= 'Guild Bank 1.1.0 Update';
		public $type		= 'plugin_update';
		public $plugin_path	= 'guildbank'; // important!

		/**
		* Constructor
		*/
		public function __construct(){
			parent::__construct();

			// init language
			$this->langs = array(
				'english' => array(
					'update_guildbank_200' => 'Guild Banker 2.0.0 Update Package',
					// SQL
					1 => 'Add auctions table',
					2 => 'Add auction bid table',
					3 => 'Add item shop table',
					4 => 'Add auth option for guildbank admin auction management',
					5 => 'Add auth option for guildbank auctions',
				),
				'german' => array(
					'update_guildbank_200' => 'Guild Banker 2.0.0 Update Paket',
					// SQL
					1 => 'Füge Auktionstabelle hinzu',
					2 => 'Füge Auktions-Bitertabelle hinzu',
					3 => 'Fügt Verkaufstabelle hinzu',
					4 => 'Fügt eine auth-Option für die Auktionsverwaltung im Adminbereich hinzu',
					5 => 'Fügt eine auth-Option für die Auktionen hinzu',
				),
			);

			// init SQL querys
			$this->sqls = array(
				1 => "CREATE TABLE IF NOT EXISTS __guildbank_auctions (
						auction_id mediumint(8) unsigned NOT NULL auto_increment,
						auction_item varchar(255) default NULL,
						auction_startdate int(11) default NULL,
						auction_duration int(11) default NULL,
						auction_bidsteps int(11) default NULL,
						auction_note varchar(255) default NULL,
						auction_startvalue int(11) default NULL,
						auction_raidattendance int(11) default NULL,
						auction_multidkppool int(11) default NULL,
						auction_active tinyint(1) default 0,
						PRIMARY KEY (auction_id)
					) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;",
				2 => "CREATE TABLE IF NOT EXISTS __guildbank_auction_bids (
						bid_id mediumint(8) unsigned NOT NULL auto_increment,
						bid_auctionid int(11) default NULL,
						bid_date int(11) default NULL,
						bid_memberid int(11) default NULL,
						bid_bidvalue int(11) default NULL,
						PRIMARY KEY (bid_id)
					) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;",
				3 => "CREATE TABLE IF NOT EXISTS __guildbank_shop_ta (
						st_id mediumint(8) unsigned NOT NULL auto_increment,
						st_itemid mediumint(8) default 0,
						st_date int(11) default 0,
						st_value BIGINT(20) default 0,
						st_amount mediumint(8) default 0,
						st_buyer mediumint(8) default 0,
						PRIMARY KEY (st_id)
					) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;",
				4 => "INSERT INTO `__auth_options` (`auth_value`, `auth_default`) VALUES ('a_guildbank_auctions', 'N');",
				5 => "INSERT INTO `__auth_options` (`auth_value`, `auth_default`) VALUES ('u_guildbank_auction', 'Y');",
			);
		}

	}
}
?>
