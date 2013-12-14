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
define('PLUGIN', 'guildbank');

$eqdkp_root_path = './../../';
include_once('./includes/common.php');

class gb_guildbank extends page_generic {

	public static function __shortcuts(){
		$shortcuts = array('pm', 'user', 'core', 'in', 'pdh', 'time', 'tpl', 'html', 'money' => 'gb_money');
		return array_merge(parent::$shortcuts, $shortcuts);
	}

	private $data = array();

	public function __construct(){
		if (!$this->pm->check('guildbank', PLUGIN_INSTALLED))
			message_die($this->user->lang('guildbank_not_installed'));

		$handler = array(
			#'save' => array('process' => 'save', 'csrf' => true, 'check' => 'u_guildbank_view'),
		);
		parent::__construct('u_guildbank_view', $handler);
		$this->process();
	}
	
	 public function display(){

		 $bankerID = $this->in->get('banker', 0);

		 // the money row
		 foreach($this->money->get_data() as $monName=>$monValue){
			 $this->tpl->assign_block_vars('money_row', array(
				 'NAME'			=> $monName,
				 'IMAGE'		=> $this->money->image($monValue),
				 'VALUE'		=> $this->money->output($gb_summ_all, $monValue),
				 'LANGUAGE'		=> $monValue['language'],
			 ));
		 }

		 foreach($this->pdh->get('guildbank_banker', 'id_list') as $banker_id){
			 $bankchar	= $this->pdh->get('guildbank_banker', 'bankchar', array($banker_id));
			 $this->tpl->assign_block_vars('banker_row', array(
				 'NAME'			=> $this->pdh->get('guildbank_banker', 'name', array($banker_id)),
				 //'TOOLTIP'		=> $khrml->HTMLTooltip($myTooltip, 'gb_charinfo', '' , $char['gb_char_name']),
				 'BANKCHAR'		=> ($bankchar != "") ? "(".addslashes($bankchar).")" : '',
				 'UPDATE'		=> $this->pdh->get('guildbank_banker', 'refresh_date', array($banker_id)),
			 ));

			 // The Money per char..
			 foreach($this->money->get_data() as $monName=>$monValue){
				 $this->tpl->assign_block_vars('banker_row.cmoney_row', array(
					 'VALUE'	=> $this->money->output($this->pdh->get('guildbank_transactions', 'money_summ', array($banker_id)), $monValue)
				 ));
			 }
		 }

		 $dd_type		= array_merge(array(0 => '--'), $this->user->lang('gb_a_type'));
		 $dd_rarity		= array_merge(array(0 => '--'), $this->user->lang('gb_a_rarity'));
		 $dd_banker 	= array_merge(array(0 => '--'), $this->pdh->aget('guildbank_banker', 'name', 0, array($this->pdh->get('guildbank_banker', 'id_list'))));

		 $guildbank_ids = $guildbank_out = array();
		 // -- display entries -----------------------------------------------------
		 require_once($this->root_path.'plugins/guildbank/includes/systems/guildbank.esys.php');
		 
		 $view_list		= $this->pdh->get('guildbank_items', 'id_list', array($bankerID));
		 $hptt			= $this->get_hptt($systems_guildbank['pages']['hptt_guildbank_admin_items'], $view_list, $view_list, array('%itt_lang%' => false, '%itt_direct%' => 0, '%onlyicon%' => 0, '%noicon%' => 0));
		 $page_suffix	= '&amp;start='.$this->in->get('start', 0);
		 $sort_suffix	= '&amp;sort='.$this->in->get('sort');
		 $item_count	= count($view_list);
		 $footer_text	= sprintf($this->user->lang('listitems_footcount'), $item_count, $this->user->data['user_ilimit']);
		
		 $this->tpl->assign_vars(array(
			 'SHOW_NO_BANKERS'	=> ($this->config->get('gb_no_bankers', 'guildbank') == 1) ? true : false,
			 'SHOW_NO_MONEY'	=> ($this->config->get('gb_show_money', 'guildbank') == 1) ? true : false,
			 'SHOW_INFO_TOOLTIP'=> ($this->config->get('gb_show_tooltip', 'guildbank') == 1 ) ? true : false,
			 'SHOW_LINKS'		=> false,

			 // Zable & pagination
			 'BANKER_TABLE'		=> $hptt->get_html_table($this->in->get('sort'), $page_suffix, $this->in->get('start', 0), $this->user->data['user_ilimit'], $footer_text),
			 'START'			=> $start,
			 'PAGINATION'		=> generate_pagination('guildbank.php'.$this->SID.$sort_suffix, $item_count, $this->user->data['user_ilimit'], $this->in->get('start', 0)),

			 'DD_BANKER'		=> $this->html->DropDown('banker', $dd_banker, $this->in->get('banker'), '', 'onchange="javascript:form.submit();"', 'input'),
	         'DD_RARITY'		=>  $this->html->DropDown('rarity', $dd_rarity, $this->in->get('rarity'), '', 'onchange="javascript:form.submit();"', 'input'),
	         'DD_TYPE'			=>  $this->html->DropDown('type', $dd_type, $this->in->get('type'), '', 'onchange="javascript:form.submit();"', 'input'),
			 
			 'CREDITS'			=> sprintf($this->user->lang('guildbank_credits'), $this->pm->get_data('guildbank', 'version')),
		));
		
 		$this->core->set_vars(array(
 			'page_title'        => sprintf($this->user->lang('admin_title_prefix'), $this->config->get('guildtag'), $this->config->get('dkp_name')).': '.$user->lang['guildbank_title'],
 			'template_path'     => $this->pm->get_data('guildbank', 'template_path'),
 			'template_file'     => 'bank.html',
 			'display'           => true,
 			)
 		);
	 }
}
if(version_compare(PHP_VERSION, '5.3.0', '<')) registry::add_const('short_gb_guildbank', gb_guildbank::__shortcuts());
register('gb_guildbank');
?>