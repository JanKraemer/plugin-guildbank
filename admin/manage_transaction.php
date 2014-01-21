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

define('EQDKP_INC', true);
define('IN_ADMIN', true);
define('PLUGIN', 'guildbank');

$eqdkp_root_path = './../../../';
include_once('./../includes/common.php');

class Manage_Transaction extends page_generic {
	public static function __shortcuts() {
		$shortcuts = array('user', 'tpl', 'in', 'pdh', 'jquery', 'core', 'config', 'html', 'pm', 'time', 'money' => 'gb_money');
		return array_merge(parent::$shortcuts, $shortcuts);
	}

	public function __construct(){
		$this->user->check_auth('a_guildbank_manage');
		$handler = array(
			'save'		=> array('process' => 'save',			'csrf'=>true),
		);
		parent::__construct(false, $handler, array('bankers', 'name'), null, 'banker_ids[]');
		$this->process();
	}

	public function save() {
		$retu		= array();
		$edit		= $this->in->get('editmode', 0);
		$mode		= $this->in->get('mode', 0);
		$money		= $this->money->input();
		$char		= $this->in->get('char', 0);
		$func		= ($edit > 0 && ($mode == 0 && $this->in->get('item', 0) > 0) || ($mode == 1 && $this->in->get('mode', 0) > 0)) ? 'update' : 'add';

		// transactions
		if($mode == 1){
			$retu		= $this->pdh->put('guildbank_transactions', $func, array(
				//$intID, $intBanker, $intChar, $intItem, $intDKP, $intValue, $strSubject, $intStartvalue
				$this->in->get('transaction', 0), $this->in->get('banker', 0), $char, 0, 0, 0, $this->in->get('subject', ''), 0
			));

		// items
		}else{
			$retu		= $this->pdh->put('guildbank_items', $func, array(
			//$intID, $strBanker, $strName, $intRarity, $strType, $intAmount, $intDKP, $intMoney, $intChar, $strSubject='gb_item_added'
			$this->in->get('item', 0), $this->in->get('banker', 0), $this->in->get('name', ''), $this->in->get('rarity', 0), $this->in->get('type', ''), $this->in->get('amount', 0), $this->in->get('dkp', 0), $money, $char));
		}
		
		if($retu) {
			$message = array('title' => $this->user->lang('save_nosuc'), 'text' => implode(', ', $names), 'color' => 'red');
		} elseif(in_array(true, $retu)) {
			$message = array('title' => $this->user->lang('save_suc'), 'text' => implode(', ', $names), 'color' => 'green');
		}
		$this->display($message);
	}

	public function delete() {
		
	}

	// ---------------------------------------------------------
	// Displays add/edit item dialog
	// ---------------------------------------------------------
	public function display(){
		$bankerID		= $this->in->get('g', 0);
		$itemID			= $this->in->get('i', 0);
		$transactionID	= $this->in->get('t', 0);
		$mode_select	= $this->in->get('mode', 0);
		$edit_charID	= $this->pdh->get('guildbank_transactions', 'char', array(0));
		$edit_mode		= false;
		$edit_charID	= 0;
		$money			= 0;
		
		if($itemID > 0){
			$mode_select	= 0;
			$edit_mode		= true;
			$edit_bankid	= ($itemID > 0) ? $this->pdh->get('guildbank_items', 'banker', array($itemID)) : 0;
			$money			= $this->pdh->get('guildbank_transactions', 'money', array($edit_bankid));
			$edit_charID	= $this->pdh->get('guildbank_transactions', 'char', array($this->pdh->get('guildbank_transactions', 'transaction_id', array($itemID))));
		}elseif($transactionID > 0){
			$mode_select	= 1;
			$edit_mode		= true;
			$money			= $this->pdh->get('guildbank_transactions', 'value', array($transactionID, true));
			$edit_charID	= $this->pdh->get('guildbank_transactions', 'char', array($transactionID, true));
		}

		$rarity			= $this->pdh->get('guildbank_items', 'rarity', array($itemID));
		$type			= $this->pdh->get('guildbank_items', 'type', array($itemID));
		$this->tpl->assign_vars(array(
			'S_EDIT'		=> $edit_mode,
			'EDITMODE'		=> ($edit_mode) ? '1' : '0',
			'MODE'			=> $mode_select,
			'ITEMID'		=> $itemID,
			'TAID'			=> $transactionID,
			'MONEY'			=> $this->money->editfields($money),
			'DD_RARITY'		=> $this->html->DropDown('rarity', $this->user->lang('gb_a_rarity'), (($itemID > 0) ? $rarity : '')),
			'DD_TYPE'		=> $this->html->DropDown('type', $this->user->lang('gb_a_type'), $type),
			'V_SUBJECT'		=> ($itemID > 0) ? $this->pdh->get('guildbank_transactions', 'subject', array($transactionID)) : '',
			'V_NAME'		=> ($itemID > 0) ? $this->pdh->get('guildbank_items', 'name', array($itemID)) : '',
			'AMOUNT'		=> ($itemID > 0) ? $this->pdh->get('guildbank_items', 'amount', array($itemID)) : 0,
			'DKP'			=> ($itemID > 0) ? $this->pdh->get('guildbank_transactions', 'dkp', array($edit_bankid)) : 0,
			'BANKERID'		=> ($bankerID > 0) ? $bankerID : $this->pdh->get('guildbank_items', 'banker', array($itemID)),
			'MS_MEMBERS'	=> $this->html->DropDown('char', $this->pdh->aget('member', 'name', 0, array($this->pdh->get('member', 'id_list'))), $edit_charID),
			'DD_MODE'		=> $this->html->DropDown('mode', $this->user->lang('gb_a_mode'), $mode_select, '', '', 'input', 'selectmode', array(), $edit_mode),
		));

		$this->core->set_vars(array(
			'page_title'		=> ($itemID > 0) ? $this->user->lang('gb_edit_item_title') : $this->user->lang('gb_add_item_title'),
			'template_file'		=> 'admin/manage_banker_add_items.html',
			'template_path'		=> $this->pm->get_data('guildbank', 'template_path'),
			'header_format'		=> ($this->in->get('simple_head')) ? 'simple' : 'full',
			'display'			=> true)
		);
	}
}
if(version_compare(PHP_VERSION, '5.3.0', '<')) registry::add_const('short_Manage_Transaction', Manage_Transaction::__shortcuts());
registry::register('Manage_Transaction');
?>