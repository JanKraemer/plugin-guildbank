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
  header('HTTP/1.0 404 Not Found');exit;
}

$guildbankSQL = array(
	'uninstall' => array(
		1	=> 'DROP TABLE IF EXISTS `__guildbank_items`',
		2	=> 'DROP TABLE IF EXISTS `__guildbank_banker`',
		3	=> 'DROP TABLE IF EXISTS `__guildbank_transactions`'
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
				ta_banker mediumint(8) default 0,
				ta_char mediumint(8) default 0,
				ta_item mediumint(8) default 0,
				ta_value BIGINT(20) default 0,
				ta_dkp int(20) default 0,
				ta_date int(11) default NULL,
				ta_startvalue mediumint(8) default 0,
				ta_subject varchar(255) default NULL,
				PRIMARY KEY  (ta_id)
			) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;"
	)
);

?>
