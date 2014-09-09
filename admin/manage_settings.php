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

// EQdkp required files/vars
define('EQDKP_INC', true);
define('IN_ADMIN', true);
define('PLUGIN', 'guildbank');

$eqdkp_root_path = './../../../';
include_once('./../includes/common.php');

class guildbankSettings extends page_generic {
	/**
	* Constructor
	*/
	public function __construct(){
		// plugin installed?
		if (!$this->pm->check('guildbank', PLUGIN_INSTALLED))
			message_die($this->user->lang('guildbank_not_installed'));

		$handler = array(
			'sb_save' => array('process' => 'save', 'csrf' => true, 'check' => 'a_guildbank_settings'),
		);
		parent::__construct('a_guildbank_settings', $handler);

		$this->process();
	}

	private $arrData = false;

	public function save(){
		$objForm				= register('form', array('gb_settings'));
		$objForm->langPrefix	= 'gb_';
		$objForm->validate		= true;
		$objForm->add_fieldsets($this->fields());
		$arrValues				= $objForm->return_values();

		if($objForm->error){
			$this->arrData		= $arrValues;
		}else{
			// update configuration
			$this->config->set($arrValues, '', 'guildbank');
			// Success message
			$messages[]			= $this->user->lang('gb_saved');
			$this->display($messages);
		}
	}

	private function fields(){
		$arrFields = array(
			'banker_display' => array(
				'show_tooltip' => array(
					'type'		=> 'radio',
				),
				'show_money' => array(
					'type'		=> 'radio',
				),
				'merge_bankers' => array(
					'type'		=> 'radio',
				),
			),
			'itemshop' => array(
				'use_autoadjust' => array(
					'type'		=> 'radio',
				),
				'default_event' => array(
					'type'		=> 'dropdown',
					'options'	=> $this->pdh->aget('event', 'name', 0, array($this->pdh->get('event', 'id_list'))),
					'value'		=> $this->config->get('default_event',	'guildbank'),
				),
			)
		);
		return $arrFields;
	}

	public function display($messages=array()){
		// -- Messages ------------------------------------------------------------
		if ($messages){
			foreach($messages as $name)
				$this->core->message($name, $this->user->lang('guildbank'), 'green');
		}

		// get the saved data
		$arrValues		= $this->config->get_config('guildbank');
		if ($this->arrData !== false) $arrValues = $this->arrData;

		// -- Template ------------------------------------------------------------
		// initialize form class
		$objForm				= register('form', array('gb_settings'));
		$objForm->reset_fields();
		$objForm->lang_prefix	= 'gb_';
		$objForm->validate		= true;
		$objForm->use_fieldsets	= true;
		$objForm->add_fieldsets($this->fields());
		
		// Output the form, pass values in
		$objForm->output($arrValues);

		$this->core->set_vars(array(
			'page_title'	=> $this->user->lang('guildbank').' '.$this->user->lang('settings'),
			'template_path'	=> $this->pm->get_data('guildbank', 'template_path'),
			'template_file'	=> 'admin/manage_settings.html',
			'display'		=> true
	  ));
	}

}
registry::register('guildbankSettings');
?>
