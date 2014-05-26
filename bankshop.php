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

class gb_guildbank_shop extends page_generic {

	public static function __shortcuts(){
		$shortcuts = array('pm', 'user', 'core', 'in', 'pdh', 'time', 'tpl', 'html', 'money' => 'gb_money');
		return array_merge(parent::$shortcuts, $shortcuts);
	}

	private $data = array();

	public function __construct(){
		if (!$this->pm->check('guildbank', PLUGIN_INSTALLED))
			message_die($this->user->lang('guildbank_not_installed'));

		$handler = array(
			'save'		=> array('process' => 'save', 'csrf' => true, 'check' => 'u_guildbank_shop'),
			'auction'	=> array('process' => 'display_auction'),
		);
		parent::__construct('u_guildbank_shop', $handler);
		$this->process();
	}

	public function save(){
		// check if the meber has enough DKP
		
		// perform the process
		
		// close the dialog
		$this->tpl->add_js('jQuery.FrameDialog.closeDialog();');
	}

	// shop display
	public function display(){
		 $itemID	= $this->in->get('i', 0);
		 $amount	= $this->pdh->get('guildbank_items', 'amount', array($itemID));
		 $dkp		= $this->pdh->get('guildbank_items', 'dkp', array($itemID));
		 $this->pdh->get('member', 'connection_id', array($user_id));

		 $this->tpl->assign_vars(array(
			 'NOSELECTION'		=> ($itemID > 0) ? true : false,
			 'DD_ITEMS'			=> $this->html->DropDown('item', $this->pdh->aget('guildbank_items', 'name', 0, array($this->pdh->get('guildbank_items', 'id_list', array(0,0,0,0,1)))), $itemID, '', '', 'input', 'items_id'),
			 'ITEM'				=> $this->pdh->get('guildbank_items', 'name', array($itemID)),
			 'ITEM_ID'			=> $itemID,
			 'DD_MYCHARS'		=> $this->html->DropDown('char', $this->pdh->aget('member', 'name', 0, array($this->pdh->get('member', 'connection_id', array($this->user->data['user_id']))))),
			 'DD_AMOUNT'		=> $this->html->DropDown('item', (($amount > 0) ? range(0, $amount) : 1), 0),
			 'DKP'				=> $dkp,
		 ));
		
		 $this->core->set_vars(array(
 			'page_title'        => sprintf($this->user->lang('admin_title_prefix'), $this->config->get('guildtag'), $this->config->get('dkp_name')).': '.$user->lang['guildbank_title'],
 			'template_path'     => $this->pm->get_data('guildbank', 'template_path'),
 			'template_file'     => 'bankshop.html',
 			'display'           => true,
			'header_format'		=> ($this->in->get('simple_head')) ? 'simple' : 'full',
		));
	}

 	// auction display
 	public function display_auction(){
		
	}
}
if(version_compare(PHP_VERSION, '5.3.0', '<')) registry::add_const('short_gb_guildbank_shop', gb_guildbank_shop::__shortcuts());
register('gb_guildbank_shop');
?>