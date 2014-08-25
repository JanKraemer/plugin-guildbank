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

$guildbankSQL = array(
	'uninstall' => array(
		1	=> 'DROP TABLE IF EXISTS `__guildbank_items`',
		2	=> 'DROP TABLE IF EXISTS `__guildbank_banker`',
		3	=> 'DROP TABLE IF EXISTS `__guildbank_transactions`',
		4	=> 'DROP TABLE IF EXISTS `__guildbank_auctions`',
		5	=> 'DROP TABLE IF EXISTS `__guildbank_auction_bids`'
	),

	'install'   => array(
		1 => "CREATE TABLE IF NOT EXISTS __guildbank_items (
				item_id mediumint(8) unsigned NOT NULL auto_increment,
				item_banker mediumint(8) default 0,
				item_date int(11) default 0,
				item_name varchar(255) default NULL,
				item_rarity mediumint(8) default 0,
				item_type varchar(255) default NULL,
				item_amount mediumint(8) default 0,
				item_sellable tinyint(1) default 0,
				PRIMARY KEY  (item_id)
			) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;",
		2 => "CREATE TABLE IF NOT EXISTS __guildbank_banker (
				banker_id mediumint(8) unsigned NOT NULL auto_increment,
				banker_name varchar(255) default NULL,
				banker_bankchar int(20) default 0,
				banker_note varchar(255) default NULL,
				PRIMARY KEY (banker_id)
				) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;",
		3 => "CREATE TABLE IF NOT EXISTS __guildbank_transactions (
				ta_id mediumint(8) unsigned NOT NULL auto_increment,
				ta_type tinyint(1) default 0,
				ta_banker mediumint(8) default 0,
				ta_char mediumint(8) default 0,
				ta_item mediumint(8) default 0,
				ta_value BIGINT(20) default 0,
				ta_dkp int(20) default 0,
				ta_date int(11) default NULL,
				ta_startvalue mediumint(8) default 0,
				ta_subject varchar(255) default NULL,
				PRIMARY KEY  (ta_id)
			) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;",
		4 => "CREATE TABLE IF NOT EXISTS __guildbank_auctions (
				auction_id mediumint(8) unsigned NOT NULL auto_increment,
				auction_item int(11) default NULL,
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
		5 => "CREATE TABLE IF NOT EXISTS __guildbank_auction_bids (
				bid_id mediumint(8) unsigned NOT NULL auto_increment,
				bid_auctionid int(11) default NULL,
				bid_date int(11) default NULL,
				bid_memberid int(11) default NULL,
				bid_bidvalue int(11) default NULL,
				PRIMARY KEY (bid_id)
			) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;",
		6 => "CREATE TABLE IF NOT EXISTS __guildbank_shop_ta (
				st_id mediumint(8) unsigned NOT NULL auto_increment,
				st_itemid mediumint(8) default 0,
				st_date int(11) default 0,
				st_value BIGINT(20) default 0,
				st_amount mediumint(8) default 0,
				st_buyer mediumint(8) default 0,
				PRIMARY KEY (st_id)
			) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;",
	)
);

?>
