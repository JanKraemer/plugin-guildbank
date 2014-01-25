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

class Manage_BankDetails extends page_generic {
	public static function __shortcuts() {
		$shortcuts = array('user', 'tpl', 'in', 'pdh', 'jquery', 'core', 'config', 'html', 'pm', 'time', 'money' => 'gb_money');
		return array_merge(parent::$shortcuts, $shortcuts);
	}

	public function __construct(){
		$this->user->check_auth('a_guildbank_manage');
		$handler = array(
			'save'				=> array('process' => 'save',			'csrf'=>true),
			'perform_payout'	=> array('process' => 'perform_payout',	'csrf'=>true),
			'addedit'			=> array('process' => 'display_add'),
			'payout'			=> array('process' => 'display_payout'),
			
		);
		parent::__construct(false, $handler, array('guildbank_items', 'name'), null, 'content_ids[]');
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
		$this->pdh->process_hook_queue();

		// close the dialog
		$this->tpl->add_js('jQuery.FrameDialog.closeDialog();');
	}

	public function perform_payout(){
		$buyer		= $this->in->get('char', 0);
		$item		= $this->in->get('item', 0);
		$amount		= $this->in->get('amount', 0);
		$dkp		= -$this->in->get('dkp', 0);
		$money		= $this->money->input();
		
		if($buyer > 0 && $item > 0){
			// calculate the new amount
			$amount_new	= $this->pdh->get('guildbank_items', 'amount', array($item)) - $amount;

			// add the transaction
			$retu		= $this->pdh->put('guildbank_transactions', 'add', array(
				//$intID, $intBanker, $intChar, $intItem, $intDKP, $intValue, $strSubject, $intStartvalue
				$this->in->get('transaction', 0), $this->in->get('banker', 0), $buyer, $item, $dkp, $money, 'gb_item_payout', 0
			));
		
			// reduce amount of items
			$this->pdh->put('guildbank_items', 'amount', array($item, $amount_new));

			// add a auto correction here...
			if($this->config->get('use_autoadjust',	'guildbank') > 0 && $this->config->get('adjustment_event',	'guildbank') > 0){
				//add_adjustment($adjustment_value, $adjustment_reason, $member_ids, $event_id, $raid_id=NULL, $time=false, $group_key = null)
				$this->pdh->put('adjustment', 'add_adjustment', array($dkp, $this->user->lang('gb_adjustment_text'), $buyer, $this->config->get('adjustment_event',	'guildbank')));
			}
			$this->pdh->process_hook_queue();

			// close the dialog
			$this->tpl->add_js('jQuery.FrameDialog.closeDialog();');
		}
	}

	public function delete() {
		/*$banker_ids = $this->in->getArray('banker_ids', 'int');
		if($banker_ids) {
			foreach($banker_ids as $id) {
				$names[] = $this->pdh->get('guildbank_banker', 'name', ($id));
				$retu[] = $this->pdh->put('guildbank_banker', 'delete', array($id));
			}
			if(in_array(false, $retu)) {
				$message = array('title' => $this->user->lang('del_no_suc'), 'text' => implode(', ', $names), 'color' => 'red');
			} else {
				$message = array('title' => $this->user->lang('del_suc'), 'text' => implode(', ', $names), 'color' => 'green');
			}
		} else {
			$message = array('title' => '', 'text' => $this->user->lang('no_calendars_selected'), 'color' => 'grey');
		}
		$this->display($message);*/
	}

	public function display($messages=false, $banker = false){
		$bankerID 		= ($banker > 0) ? $banker : $this->in->get('g', 0);
		$banker_name	= $this->pdh->get('guildbank_banker', 'name', array($bankerID));
		
		//init infotooltip
		infotooltip_js();
		require_once($this->root_path.'plugins/guildbank/includes/systems/guildbank.esys.php');

		// -- display entries ITEMS ------------------------------------------------
		$view_items		= $this->pdh->get('guildbank_items', 'id_list', array($bankerID));
		$hptt_items		= $this->get_hptt($systems_guildbank['pages']['hptt_guildbank_admin_items'], $view_items, $view_items, array('%itt_lang%' => false, '%itt_direct%' => 0, '%onlyicon%' => 0, '%noicon%' => 0));
		$page_suffix	= '&amp;start='.$this->in->get('start', 0);
		$sort_suffix	= '&amp;sort='.$this->in->get('sort');
		$item_count		= count($view_items);
		$item_footer	= sprintf($this->user->lang('listitems_footcount'), $item_count, $this->user->data['user_ilimit']);

		// -- display entries TRANSACTIONS -----------------------------------------
		$ta_list		= $this->pdh->get('guildbank_transactions', 'id_list', array($bankerID));
		$hptt_transa	= $this->get_hptt($systems_guildbank['pages']['hptt_guildbank_admin_transactions'], $ta_list, $ta_list, array('%itt_lang%' => false, '%itt_direct%' => 0, '%onlyicon%' => 0, '%noicon%' => 0));
		$ta_count		= count($ta_list);
		$footer_transa	= sprintf($this->user->lang('listitems_footcount'), $ta_count, $this->user->data['user_ilimit']);

		// start ouptut
		$this->jquery->Tab_header('guildbank_tab');
		
		// build the url for the dialogs
		$redirect_url		= 'manage_bank_details.php'.$this->SID.'&g='.$bankerID.'&details=true';
		$transactions_url	= 'manage_bank_details.php'.$this->SID.'&simple_head=true&addedit=true&g='.$bankerID;
		$payout_url			= 'manage_bank_details.php'.$this->SID.'&simple_head=true&g='.$bankerID;
		
		$this->jquery->dialog('add_transaction', $this->user->lang('gb_manage_bank_transa'), array('url' => $transactions_url.'&mode=1', 'width' => 600, 'height' => 400, 'onclose'=> $redirect_url));
		$this->jquery->dialog('edit_transaction', $this->user->lang('gb_manage_bank_transa'), array('url' => $transactions_url."&mode=1&t='+id+'", 'width' => 600, 'height' => 400, 'onclose'=> $redirect_url, 'withid' => 'id'));
		$this->jquery->dialog('add_item', $this->user->lang('gb_ta_head_item'), array('url' => $transactions_url.'&mode=0', 'width' => 600, 'height' => 400, 'onclose'=> $redirect_url));
		$this->jquery->dialog('edit_item', $this->user->lang('gb_ta_head_item'), array('url' => $transactions_url."&mode=0&i='+id+'", 'width' => 600, 'height' => 400, 'onclose'=> $redirect_url, 'withid' => 'id'));
		$this->jquery->dialog('payout_item', $this->user->lang('gb_ta_head_payout'), array('url' => $payout_url."&payout=true", 'width' => 600, 'height' => 400, 'onclose'=> $redirect_url));
		
		$this->confirm_delete($this->user->lang('confirm_delete_items'));
		$this->tpl->assign_vars(array(
			'BANKID'				=> $bankerID,
			'SID'					=> $this->SID,

			'BANKNAME'				=> $this->pdh->get('guildbank_banker', 'name', array($bankerID)),

			'ITEM_LIST'				=> $hptt_items->get_html_table($this->in->get('sort'), $page_suffix, $this->in->get('start', 0), $this->user->data['user_ilimit'], $item_footer),
			'PAGINATION_ITEMS'		=> generate_pagination('manage_bank_details.php'.$this->SID.'&g='.$bankerID.$sort_suffix, $item_count, $this->user->data['user_ilimit'], $this->in->get('start', 0)),
			'ITEMS_COLUMN_COUNT'	=> $hptt_items->get_column_count(),
			
			'TRANSA_LIST'			=> $hptt_transa->get_html_table($this->in->get('sort'), $page_suffix, $this->in->get('start', 0), $this->user->data['user_ilimit'], $footer_transa),
			'TRANSA_PAGINATION'		=> generate_pagination('manage_bank_details.php'.$this->SID.'&g='.$bankerID.$sort_suffix, $ta_count, $this->user->data['user_ilimit'], $this->in->get('start', 0)),
			'TRANSA_COLUMN_COUNT'	=> $hptt_transa->get_column_count(),
		));

		$this->core->set_vars(array(
			'page_title'		=> sprintf($this->user->lang('gb_manage_bank_items_title'), $banker_name),
			'template_file'		=> 'admin/manage_banker_items.html',
			'template_path'		=> $this->pm->get_data('guildbank', 'template_path'),
			'display'			=> true)
		);
	}

	// ---------------------------------------------------------
	// Displays add/edit item dialog
	// ---------------------------------------------------------
	public function display_add(){
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
			'MONEY'			=> $this->money->editfields($money, 'money_{ID}', true),
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

	public function display_payout(){
		$bankerID		= $this->pdh->get('guildbank_items', 'banker', array($itemID));
		$money			= $this->pdh->get('guildbank_transactions', 'money', array($edit_bankid));

		$this->tpl->assign_vars(array(
			'MONEY'			=> $this->money->editfields($money),
			'AMOUNT'		=> ($itemID > 0) ? $this->pdh->get('guildbank_items', 'amount', array($itemID)) : 0,
			'DKP'			=> ($itemID > 0) ? $this->pdh->get('guildbank_transactions', 'dkp', array($edit_bankid)) : 0,
			'BANKERID'		=> ($bankerID > 0) ? $bankerID : $this->pdh->get('guildbank_items', 'banker', array($itemID)),
			'DD_ITEMS'		=> $this->html->DropDown('item', $this->pdh->aget('guildbank_items', 'name', 0, array($this->pdh->get('guildbank_items', 'id_list'))), 0),
			'DD_CHARS'		=> $this->html->DropDown('char', $this->pdh->aget('member', 'name', 0, array($this->pdh->get('member', 'id_list'))), $edit_charID),
		));

		$this->core->set_vars(array(
			'page_title'		=> ($itemID > 0) ? $this->user->lang('gb_edit_item_title') : $this->user->lang('gb_add_item_title'),
			'template_file'		=> 'admin/manage_banker_payout_items.html',
			'template_path'		=> $this->pm->get_data('guildbank', 'template_path'),
			'header_format'		=> ($this->in->get('simple_head')) ? 'simple' : 'full',
			'display'			=> true)
		);
	}
}
if(version_compare(PHP_VERSION, '5.3.0', '<')) registry::add_const('short_Manage_BankDetails', Manage_BankDetails::__shortcuts());
registry::register('Manage_BankDetails');
?>