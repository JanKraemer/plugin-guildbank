<?php
/*	Project:	EQdkp-Plus
 *	Package:	Guildbanker Plugin
 *	Link:		http://eqdkp-plus.eu
 *
 *	Copyright (C) 2006-2015 EQdkp-Plus Developer Team
 *
 *	This program is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU Affero General Public License as published
 *	by the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU Affero General Public License for more details.
 *
 *	You should have received a copy of the GNU Affero General Public License
 *	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

class guildbank_pageobject extends pageobject {

	public static function __shortcuts(){
		$shortcuts = array('money' => 'gb_money');
		return array_merge(parent::$shortcuts, $shortcuts);
	}

	private $data = array();

	public function __construct(){
		if (!$this->pm->check('guildbank', PLUGIN_INSTALLED))
			message_die($this->user->lang('guildbank_not_installed'));

		// load the includes
		require_once($this->root_path.'plugins/guildbank/includes/gb_money.class.php');

		$handler = array(
			#'save' => array('process' => 'save', 'csrf' => true, 'check' => 'u_guildbank_view'),
		);
		parent::__construct('u_guildbank_view', $handler);
		$this->process();
	}
	
	public function display(){
		$bankerID		= $this->in->get('banker', 0);
		require_once($this->root_path.'plugins/guildbank/includes/systems/guildbank.esys.php');

 		//init infotooltip
 		infotooltip_js();

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
					'VALUE'		=> $this->money->output($this->pdh->get('guildbank_transactions', 'money_summ', array($banker_id)), $monValue)
				));
			}
		}

		// the money row
		foreach($this->money->get_data() as $monName=>$monValue){
			$this->tpl->assign_block_vars('money_row', array(
				'NAME'			=> $monName,
				'IMAGE'			=> $this->money->image($monValue, true, '22'),
				'VALUE'			=> $this->money->output($this->pdh->get('guildbank_transactions', 'money_summ_all'), $monValue),
				'LANGUAGE'		=> $monValue['language'],
			));
		}

		$dd_type		= array_merge(array(0 => '--'), $this->user->lang('gb_a_type'));
		$dd_rarity		= array_merge(array(0 => '--'), $this->user->lang('gb_a_rarity'));
		$dd_banker		= array_merge(array(0 => '--'), $this->pdh->aget('guildbank_banker', 'name', 0, array($this->pdh->get('guildbank_banker', 'id_list'))));

		$guildbank_ids	= $guildbank_out = array();
		// -- display entries ITEMS ------------------------------------------------
		$items_list		= $this->pdh->get('guildbank_items', 'id_list', array($bankerID));
		$hptt_items		= $this->get_hptt($systems_guildbank['pages']['hptt_guildbank_items'], $items_list, $items_list, array('%itt_lang%' => false, '%itt_direct%' => 0, '%onlyicon%' => 0, '%noicon%' => 0));
		$page_suffix	= '&amp;start='.$this->in->get('start', 0);
		$sort_suffix	= '&amp;sort='.$this->in->get('sort');
		$item_count		= count($items_list);
		$footer_item	= sprintf($this->user->lang('listitems_footcount'), $item_count, $this->user->data['user_ilimit']);

		// -- display entries TRANSACTIONS -----------------------------------------
		$ta_list		= $this->pdh->get('guildbank_transactions', 'id_list', array($bankerID));
		$hptt_transa	= $this->get_hptt($systems_guildbank['pages']['hptt_guildbank_transactions'], $ta_list, $ta_list, array('%itt_lang%' => false, '%itt_direct%' => 0, '%onlyicon%' => 0, '%noicon%' => 0));
		//$page_suffix	= '&amp;start='.$this->in->get('start', 0);
		//$sort_suffix	= '&amp;sort='.$this->in->get('sort');
		$ta_count		= count($ta_list);
		$footer_transa	= sprintf($this->user->lang('listitems_footcount'), $ta_count, $this->user->data['user_ilimit']);

		 // -- display entries AUCTIONS -----------------------------------------
		if($this->user->check_auth('u_guildbank_auction', false)){
			$this->pdh->get('guildbank_auctions', 'counterJS');		// init the auction clock
			$auction_list		= $this->pdh->get('guildbank_auctions', 'id_list', array());
			$hptt_auction		= $this->get_hptt($systems_guildbank['pages']['hptt_guildbank_auctions'], $auction_list, $auction_list, array('%itt_lang%' => false, '%itt_direct%' => 0, '%onlyicon%' => 0, '%noicon%' => 0));
			$page_suffix_a		= '&amp;astart='.$this->in->get('astart', 0);
			$sort_suffix_a		= '&amp;asort='.$this->in->get('asort');
			$auction_count		= count($auction_list);
			$footer_auction		= sprintf($this->user->lang('listitems_footcount'), $auction_list, $this->user->data['user_ilimit']);
			
			$this->tpl->assign_vars(array(
				'AUCTION_TABLE'		=> $hptt_auction->get_html_table($this->in->get('sort'), $page_suffix_a, $this->in->get('astart', 0), $this->user->data['user_ilimit'], $footer_auction),
				'PAGINATION_AUCTION'=> generate_pagination('guildbank.php'.$this->SID.$sort_suffix_a, $auction_count, $this->user->data['user_ilimit'], $this->in->get('astart', 0)),
			));
		}

		$this->jquery->dialog('open_shop', $this->user->lang('gb_shop_window'), array('url' => $this->routing->build('bankshop')."&simple_head=true&item='+id+'", 'width' => 600, 'height' => 400, 'onclose'=> $this->routing->build('bankshop'), 'withid' => 'id'));

		$this->jquery->Tab_header('guildbank_tab', true);
		$this->tpl->assign_vars(array(
			'SHOW_BANKERS'		=> ($this->config->get('show_bankers',		'guildbank') == 1) ? true : false,
			'SHOW_MONEY'		=> ($this->config->get('show_money',		'guildbank') == 1) ? true : false,
			'SHOW_TOOLTIP'		=> ($this->config->get('show_tooltip',		'guildbank') == 1 ) ? true : false,
			'SHOW_AUCTIONS'		=> $this->user->check_auth('u_guildbank_auction', false),
			'ROUTING_BANKER'	=> $this->routing->build('guildbank'),

			// Table & pagination for items
			'ITEMS_TABLE'		=> $hptt_items->get_html_table($this->in->get('sort'), $page_suffix, $this->in->get('start', 0), $this->user->data['user_ilimit'], $footer_item),
			'PAGINATION_ITEM'	=> generate_pagination('guildbank.php'.$this->SID.$sort_suffix, $item_count, $this->user->data['user_ilimit'], $this->in->get('start', 0)),

			// Table & pagination for transactions
			'TRANSA_TABLE'		=> $hptt_transa->get_html_table($this->in->get('sort'), $page_suffix, $this->in->get('start', 0), $this->user->data['user_ilimit'], $footer_transa),
			'PAGINATION_TRANSA'	=> generate_pagination('guildbank.php'.$this->SID.$sort_suffix, $ta_count, $this->user->data['user_ilimit'], $this->in->get('start', 0)),

			'DD_BANKER'		=> new hdropdown('banker', array('options' => $dd_banker, 'value' => $this->in->get('banker'), 'js' => 'onchange="javascript:form.submit();"')),
			'DD_RARITY'		=> new hdropdown('rarity', array('options' => $dd_rarity, 'value' => $this->in->get('rarity'), 'js' => 'onchange="javascript:form.submit();"')),
			'DD_TYPE'		=> new hdropdown('type', array('options' => $dd_type, 'value' => $this->in->get('type'), 'js' => 'onchange="javascript:form.submit();"')),

			'CREDITS'		=> sprintf($this->user->lang('gb_credits'), $this->pm->get_data('guildbank', 'version')),
		));

		$this->core->set_vars(array(
			'page_title'		=> $this->user->lang('gb_title_page'),
			'template_path'		=> $this->pm->get_data('guildbank', 'template_path'),
			'template_file'		=> 'bank.html',
			'display'			=> true,
			)
		);
	}
}
?>