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

if (!class_exists('update_guildbank_103')){
	class update_guildbank_103 extends sql_update_task{

		public $author		= 'Wallenium';
		public $version		= '1.0.3';    // new version
		public $name		= 'Guild Bank 1.0.3 Update';
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
					'update_guildbank_103' => 'Guild Banker 1.0.3 Update Package',
					// SQL
					1 => 'Add table field for type to transaction table',
				),
				'german' => array(
					'update_guildbank_103' => 'Guild Banker 1.0.3 Update Paket',
					// SQL
					1 => 'Add table field for type to transaction table',
				),
			);

			// init SQL querys
			$this->sqls = array(
				1 => 'ALTER TABLE __guildbank_transactions ADD COLUMN `ta_type` tinyint(1) default 0 AFTER `ta_id`;',
			);
		}

	}
}
?>
