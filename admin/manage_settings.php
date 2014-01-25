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
 
// EQdkp required files/vars
define('EQDKP_INC', true);
define('IN_ADMIN', true);
define('PLUGIN', 'guildbank');

$eqdkp_root_path = './../../../';
include_once('./../includes/common.php');

class guildbankSettings extends page_generic {

	public static function __shortcuts(){
		$shortcuts = array('user', 'config', 'pdc', 'pfh', 'pdh', 'pm', 'html');
		return array_merge(parent::$shortcuts, $shortcuts);
	}

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

	public function save(){

		// take over new values
		$savearray = array(
			'merge_bankers'		=> $this->in->get('merge_bankers',	0),
			'show_money'		=> $this->in->get('show_money',		0),
			'show_tooltip'		=> $this->in->get('show_tooltip',	0),
			'adjustment_event'	=> $this->in->get('adjustment_event',	0),
			'use_autoadjust'	=> $this->in->get('use_autoadjust',	0),
		);

		// update configuration
		$this->config->set($savearray, '', 'guildbank');
		// Success message
		$messages[] = $this->user->lang('gb_saved');

		$this->display($messages);
	}

	public function display($messages=array()){
		// -- Messages ------------------------------------------------------------
		if ($messages){
			foreach($messages as $name)
				$this->core->message($name, $this->user->lang('guildbank'), 'green');
		}

		// stored config settings
		$show_tooltip	= $this->config->get('show_tooltip',	'guildbank');
		$show_money		= $this->config->get('show_money',		'guildbank');
		$merge_banker	= $this->config->get('merge_bankers',	'guildbank');
		$use_autoadjust	= $this->config->get('use_autoadjust',	'guildbank');

		$this->tpl->assign_vars(array(
			'R_SHOW_TOOLTIP'	=> $this->html->RadioBox('show_tooltip',	false, (($show_tooltip) ? $show_tooltip : 0), 'input'),
			'R_SHOW_MONEY'		=> $this->html->RadioBox('show_money',		false, (($show_money) ? $show_money : 0), 'input'),
			'R_MERGE_BANKER'	=> $this->html->RadioBox('merge_bankers',	false, (($merge_banker) ? $merge_banker : 0), 'input'),
			'R_AUTOADJUST'		=> $this->html->RadioBox('use_autoadjust',	false, (($use_autoadjust) ? $use_autoadjust : 0), 'input'),

			'DD_EVENT'			=> $this->html->DropDown('adjustment_event', $this->pdh->aget('event', 'name', 0, array($this->pdh->get('event', 'id_list'))), $this->config->get('adjustment_event',	'guildbank')),
		));

		$this->core->set_vars(array(
			'page_title'	=> $this->user->lang('guildbank').' '.$this->user->lang('settings'),
			'template_path'	=> $this->pm->get_data('guildbank', 'template_path'),
			'template_file'	=> 'admin/manage_settings.html',
			'display'		=> true
	  ));
	}

}

if(version_compare(PHP_VERSION, '5.3.0', '<')) registry::add_const('short_guildbankSettings', guildbankSettings::__shortcuts());
registry::register('guildbankSettings');
?>
