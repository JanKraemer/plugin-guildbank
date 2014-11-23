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

define('EQDKP_INC', true);
define('IN_ADMIN', true);
define('PLUGIN', 'guildbank');

$eqdkp_root_path = './../../../';
include_once('./../includes/common.php');

class Manage_Auction extends page_generic {
	public function __construct(){
		$this->user->check_auth('a_guildbank_auctions');
		$handler = array(
			'addedit'		=> array('process' => 'display_add'),
			'save'			=> array('process' => 'save',			'csrf'=>true),
		);
		parent::__construct(false, $handler, array('guildbank_auctions', 'name'), null, 'auction_ids[]');
		$this->process();
	}

	public function save() {
		$retu		= array();
		$edit		= $this->in->get('editmode', 0);
		$func		= ($edit > 0) ? 'update' : 'add';
		$itemids	= $this->in->getArray('item', 0);
		$retu		= array();

		// save it to the database
		if($itemids > 0){
			foreach($itemids as $itemid){
				$retu[]		= $this->pdh->put('guildbank_auctions', $func, array(
					//$intID, $intItemID, $intStartdate, $intDuration, $intBidsteps, $intStartvalue, $intAttendance, $strNote='', $boolActive=1
					$this->in->get('transaction', 0), $itemid, $this->time->fromformat($this->in->get('startdate'), 1), $this->in->get('duration', 0),
					$this->in->get('bidsteps', 0), $this->in->get('startvalue', 0), $this->in->get('raidattendance', 0), $this->in->get('multidkppool', 1)
				));
			}
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

	public function delete() {
		$tmp_ids	= $this->in->getArray('selections');
		$retu		= $names = array();
		if(count($tmp_ids) > 0) {
			foreach($tmp_ids as $s_id) {
				$retu[]		= $this->pdh->put('guildbank_auctions', 'delete', array($s_id));
				$names[]	= $this->pdh->get('guildbank_auctions', 'name', ($id));
			}
		}
		
		if(in_array(false, $retu)) {
			$message = array('title' => $this->user->lang('del_no_suc'), 'text' => implode(', ', $names), 'color' => 'red');
		}else{
			$message = array('title' => $this->user->lang('del_suc'), 'text' => implode(', ', $names), 'color' => 'green');
		}

		$this->pdh->process_hook_queue();
		$this->display($message);
	}

	public function display($messages=false) {
		if($messages) {
			$this->pdh->process_hook_queue();
			$this->core->messages($messages);
		}

		infotooltip_js();
		$this->pdh->get('guildbank_auctions', 'counterJS');
		require_once($this->root_path.'plugins/guildbank/includes/systems/guildbank.esys.php');

		$view_auctions		= $this->pdh->get('guildbank_auctions', 'id_list', array(false));
		$hptt_auctions		= $this->get_hptt($systems_guildbank['pages']['hptt_guildbank_admin_auctions'], $view_auctions, $view_auctions, array('%itt_lang%' => false, '%itt_direct%' => 0, '%onlyicon%' => 0, '%noicon%' => 0));
		$page_suffix		= '&amp;start='.$this->in->get('start', 0);
		$sort_suffix		= '&amp;sort='.$this->in->get('sort');
		$auctions_count		= count($view_auctions);
		$auctions_footer	= sprintf($this->user->lang('gb_footer_auction'), $auctions_count, $this->user->data['user_ilimit']);

		$redirect_url		= 'manage_auctions.php'.$this->SID;
		$transactions_url	= 'manage_auctions.php'.$this->SID.'&simple_head=true&addedit=true';

		$this->jquery->dialog('add_auction', $this->user->lang('gb_auction_head_add'), array('url' => $transactions_url, 'width' => 600, 'height' => 440, 'onclose'=> $redirect_url));
		$this->jquery->dialog('edit_auction', $this->user->lang('gb_auction_head_edit'), array('url' => $transactions_url."&auction='+id+'", 'width' => 600, 'height' => 500, 'onclose'=> $redirect_url, 'withid' => 'id'));

		$this->confirm_delete($this->user->lang('gb_confirm_delete_auctions'));
		$this->tpl->assign_vars(array(
			'AUCTION_LIST'				=> $hptt_auctions->get_html_table($this->in->get('sort'), $page_suffix, $this->in->get('start', 0), $this->user->data['user_ilimit'], $auctions_footer),
			'PAGINATION_AUCTION'		=> generate_pagination('manage_auctions.php'.$this->SID.$sort_suffix, $auctions_count, $this->user->data['user_ilimit'], $this->in->get('start', 0)),
		));

		$this->core->set_vars(array(
			'page_title'		=> $this->user->lang('gb_manage_auctions'),
			'template_path'		=> $this->pm->get_data('guildbank', 'template_path'),
			'template_file'		=> 'admin/manage_auctions.html',
			'display'			=> true)
		);
	}
	
	// ---------------------------------------------------------
	// Displays add/edit auction dialog
	// ---------------------------------------------------------
	public function display_add(){
		$auctionID				= $this->in->get('auction', 0);

		$this->tpl->assign_vars(array(
			'S_EDIT'			=> ($auctionID > 0) ? true : false,
			'EDITMODE'			=> ($auctionID > 0) ? '1' : '0',
			'AUCTIONID'			=> $auctionID,
			
			'ITEM'				=> new hmultiselect('item', array('options' => $this->pdh->aget('guildbank_items', 'name', 0, array($this->pdh->get('guildbank_items', 'id_list'))), 'value' => $this->config->get('calendar_raid_autocaddchars'))),
			'STARTDATE'			=> new hdatepicker('startdate', array('timepicker' => true, 'value' => (($auctionID > 0) ? $this->pdh->get('guildbank_auctions', 'startdate', array($auctionID)) : $this->time->time))),
			'DURATION'			=> new hspinner('duration', array('value' => (($auctionID > 0) ? $this->pdh->get('guildbank_auctions', 'duration', array($auctionID)) : 6), 'step'=> 1, 'min' => 0, 'max' => 100, 'onlyinteger' => true)),
			'STARTVALUE'		=> new hspinner('startvalue', array('value' => (($auctionID > 0) ? $this->pdh->get('guildbank_auctions', 'startvalue', array($auctionID)) : 50), 'step'=> 10, 'min' => 0, 'onlyinteger' => true)),
			'BIDSTEPS'			=> new hspinner('bidsteps', array('value' => (($auctionID > 0) ? $this->pdh->get('guildbank_auctions', 'bidsteps', array($auctionID)) : 10), 'step'=> 1, 'min' => 1, 'onlyinteger' => true)),
			'RAIDATTENDANCE'	=> new hspinner('raidattendance', array('value' => (($auctionID > 0) ? $this->pdh->get('guildbank_auctions', 'raidattendance', array($auctionID)) : 0), 'step'=> 1, 'min' => 0, 'onlyinteger' => true)),
			'MULTIDKPPOOL'		=> new hdropdown('multidkppool', array('value' => (($auctionID > 0) ? $this->pdh->get('guildbank_auctions', 'multidkppool', array($auctionID)) : 1), 'options' => $this->pdh->aget('multidkp', 'name', 0, array($this->pdh->get('multidkp', 'id_list'))))),
		));

		$this->core->set_vars(array(
			'page_title'		=> ($itemID > 0) ? $this->user->lang('gb_edit_item_title') : $this->user->lang('gb_add_auction_title'),
			'template_file'		=> 'admin/manage_banker_add_auction.html',
			'template_path'		=> $this->pm->get_data('guildbank', 'template_path'),
			'header_format'		=> ($this->in->get('simple_head')) ? 'simple' : 'full',
			'display'			=> true)
		);
	}
}
registry::register('Manage_Auction');
?>