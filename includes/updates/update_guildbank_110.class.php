<?php
/*
 * Project:     EQdkp Shoutbox
 * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:        http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:       2008
 * Date:        $Date$
 * -----------------------------------------------------------------------
 * @author      $Author$
 * @copyright   2008-2011 Aderyn
 * @link        http://eqdkp-plus.com
 * @package     shoutbox
 * @version     $Rev$
 *
 * $Id$
 */

if (!defined('EQDKP_INC')){
	header('HTTP/1.0 404 Not Found');exit;
}


include_once(registry::get_const('root_path').'maintenance/includes/sql_update_task.class.php');

if (!class_exists('update_guildbank_110')){
	class update_guildbank_110 extends sql_update_task{

		public $author		= 'Wallenium';
		public $version		= '1.1.0';    // new version
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
					'update_guildbank_110' => 'Guild Banker 1.1.0 Update Package',
					// SQL
					1 => 'Add auctions table',
					2 => 'Add table field for sell type to item table',
				),
				'german' => array(
					'update_guildbank_110' => 'Guild Banker 1.1.0 Update Paket',
					// SQL
					1 => 'Füge Auktionstabelle hinzu',
					2 => 'Add table field for sell type to item table',
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
						auction_active tinyint(1) default 0,
						PRIMARY KEY (auction_id)
					) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;",
				2 =>  "INSERT INTO `__auth_options` (`auth_value`, `auth_default`) VALUES ('a_guildbank_auctions', 'N');",
			);
		}

	}
}
?>
