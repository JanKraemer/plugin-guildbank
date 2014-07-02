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

class guildbank extends plugin_generic {
	public $vstatus		= 'Beta';
	public $version		= '1.1.0';
	public $copyright 	= 'Wallenium';

	public function __construct(){
		parent::__construct();

		$this->add_data(array (
			'name'              => 'GuildBank',
			'code'              => 'guildbank',
			'path'              => 'guildbank',
			'template_path'     => 'plugins/guildbank/templates/',
			'icon'              => 'fa-university',
			'version'           => $this->version,
			'author'            => $this->copyright,
			'description'       => $this->user->lang('guildbank_short_desc'),
			'long_description'  => $this->user->lang('guildbank_long_desc'),
			'homepage'          => EQDKP_PROJECT_URL,
			'manuallink'        => false,
			'plus_version'      => '2.0'
		));

		$this->add_dependency(array(
			'plus_version'      => '2.0'
		));

		// -- Register our permissions ------------------------
		// permissions: 'a'=admins, 'u'=user
		// ('a'/'u', Permission-Name, Enable? 'Y'/'N', Language string, array of user-group-ids that should have this permission)
		// Groups: 1 = Guests, 2 = Super-Admin, 3 = Admin, 4 = Member
		$this->add_permission('u', 'view',		'Y', $this->user->lang('view'),				array(2,3,4));
		$this->add_permission('u', 'shop',		'Y', $this->user->lang('gb_shop'),			array(2,3,4));
		$this->add_permission('a', 'manage',	'N', $this->user->lang('manage'),			array(2,3));
		$this->add_permission('a', 'auctions',	'N', $this->user->lang('gb_perm_auctions'),	array(2,3));
		$this->add_permission('a', 'settings',	'N', $this->user->lang('menu_settings'),	array(2,3));
		
		// -- PDH Modules -------------------------------------
		$this->add_pdh_read_module('guildbank_banker');
		$this->add_pdh_read_module('guildbank_items');
		$this->add_pdh_read_module('guildbank_transactions');
		$this->add_pdh_read_module('guildbank_auctions');
		$this->add_pdh_write_module('guildbank_banker');
		$this->add_pdh_write_module('guildbank_items');
		$this->add_pdh_write_module('guildbank_transactions');
		$this->add_pdh_write_module('guildbank_auctions');
		
		// -- Hooks -------------------------------------------
		#$this->add_hook('search', 'guildbank_search_hook', 'search');
		
	    // -- Routing -------------------------------------------
		$this->routing->addRoute('Guildbank', 'guildbank', 'plugins/guildbank/page_objects');
		$this->routing->addRoute('Bankshop', 'bankshop', 'plugins/guildbank/page_objects');
		
		// -- Menu --------------------------------------------
		$this->add_menu('admin', $this->gen_admin_menu());
		$this->add_menu('main', $this->gen_main_menu());
	}

	/**
	* Define Installation
	*/
	public function pre_install(){
		// include SQL and default configuration data for installation
		include($this->root_path.'plugins/guildbank/includes/sql.php');

		// define installation
		for ($i = 1; $i <= count($guildbankSQL['install']); $i++){
			$this->add_sql(SQL_INSTALL, $guildbankSQL['install'][$i]);
		}

		// set the default config
		if (is_array($config_vars)){
			$this->config->set($this->default_config(), '', 'guildbank');
		}
	}

	/**
	* Define the default config
	*/
	private function default_config(){
		return array(
			'merge_bankers'		=> 0,
			'show_money'		=> 1,
			'show_tooltip'		=> 0,
			'adjustment_event'	=> 0,
			'use_autoadjust'	=> 0,
		);
	}


	/**
	* Define uninstallation
	*/
	public function pre_uninstall(){
		// include SQL data for uninstallation
		include($this->root_path.'plugins/guildbank/includes/sql.php');

		for ($i = 1; $i <= count($guildbankSQL['uninstall']); $i++)
			$this->add_sql(SQL_UNINSTALL, $guildbankSQL['uninstall'][$i]);
	}

	/**
	* Generate the Admin Menu
	*/
	private function gen_admin_menu(){
		$admin_menu = array (array(
			'name' => $this->user->lang('guildbank'),
			'icon' => 'fa-university',
			1 => array (
				'link'	=> 'plugins/guildbank/admin/manage_banker.php'.$this->SID,
				'text'	=> $this->user->lang('gb_manage_banker'),
				'check'	=> 'a_guildbank_manage',
				'icon'	=> 'fa-university'
			),
			2 => array (
				'link'	=> 'plugins/guildbank/admin/manage_auctions.php'.$this->SID,
				'text'	=> $this->user->lang('gb_manage_auctions'),
				'check'	=> 'a_guildbank_auctions',
				'icon'	=> 'fa-gavel'
			),
			3 => array (
				'link'	=> 'plugins/guildbank/admin/manage_settings.php'.$this->SID,
				'text'	=> $this->user->lang('settings'),
				'check'	=> 'a_guildbank_settings',
				'icon'	=> 'fa-wrench'
			)
		));
		return $admin_menu;
	}

	/**
	* gen_admin_menu
	* Generate the Admin Menu
	*/
	private function gen_main_menu(){
		$main_menu = array(
			1 => array (
				'link'		=> $this->routing->build('Guildbank', false, false, true, true),
				'text'		=> $this->user->lang('gb_usermenu_guildbank'),
				'check'		=> 'u_guildbank_view',
			),
		);
		return $main_menu;
	}
}
?>