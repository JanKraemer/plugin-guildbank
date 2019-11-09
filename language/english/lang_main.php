<?php
/*	Project:	EQdkp-Plus
 *	Package:	EQdkp-Plus Language File
 *	Link:		http://eqdkp-plus.eu
 *
 *	Copyright (C) 2006-2016 EQdkp-Plus Developer Team
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


if (!defined('EQDKP_INC')) {
	die('You cannot access this file directly.');
}

//Language: English
//Created by EQdkp Plus Translation Tool on  2014-12-17 23:17
//File: plugins/guildbank/language/english/lang_main.php
//Source-Language: german

$lang = array(
	"guildbank" => 'Guild bank',
	"guildbank_short_desc" => 'Manage items and transactions of guild bankers',
	"guildbank_long_desc" => 'Guild bank is a Plugin to manage raiditems.',
	"guildbank_not_installed" => 'Guild bank is not installed.',
	"gb_a_perm_auctions" => 'Manage auctions',
	"gb_u_perm_auction" => 'Bid on auctions',
	"gb_perm_shop" => 'Buy items',
	"gb_mainmenu_guildbank" => 'Guild bank',
	"gb_adminmenu_guildbank" => 'Guild bank',
	"gb_banker" => 'Banker',
	"gb_shop" => 'Shop',
	"gb_not_avail" => 'n.a.',
	"gb_all_bankers" => 'All banker',
	"gb_total_bankers" => 'Asset of all bankers',
	"gb_bankchar_name" => 'Bank character',
	"gb_no_bankchar" => 'None',
	"gb_update" => 'Last activity',
	"gb_tab_transactions" => 'Transactions',
	"gb_tab_items" => 'Items',
	"gb_tab_auctions" => 'Auction',
	"gb_title_page" => 'View guildbank',
	"gb_shop_window" => 'Buy item',
	"gb_shop_icon_title" => 'Buy item',
	"gb_shop_buy" => 'Buy',
	"gb_item_name" => 'Item',
	"gb_item_value" => 'Purchasing price (DKP)',
	'gb_item_value_money' => 'Purchasing price (Money)',
	'gb_itemcost' => 'Cost',
	"gb_item_date" => 'Purchasing date ',
	"gb_dkppool" => 'MultiDKP-Pool',
	"gb_default_note" => 'No note available',
	"gb_shop_error_nodkp" => 'There are not enough DKP to buy this item.',
	"gb_shop_error_noitem" => 'There is no item available to purchase.',
	"gb_shop_error_noselection" => 'You have not selected any amount of items to buy.',
	"gb_shop_buy_subject" => 'Item received',
	"gb_auction_won_subject" => 'Item won in auction',
	"gb_shop_buy_successmsg" => 'The item was flagged for shopping. The transaction will be made ​​after the confirmation by an admin and credited to your account',
	"gb_confirm_shop_ta_head" => 'Guild bank item purchases',
	"gb_confirm_shop_ta_button" => 'Confirm purchase',
	"gb_decline_shop_ta_button" => 'Decline purchase',
	"gb_confirm_msg_success" => 'The transaction was successfully completed',
	"gb_confirm_msg_delete" => 'The transaction was successfully declined',
	"gb_notify_shopta_header" => 'Share purchases item',
	"gb_notify_shopta_confirm_req1" => 'A purchase is waiting for release',
	"gb_notify_shopta_confirm_req2" => '%s purchases are waiting for release',
	'gb_confirm_auction_ta_head'	=> 'Gildenbank auctions',
	'gb_confirm_auction_ta_button'	=> 'Approve auctions',
	'gb_decline_auction_ta_button'	=> 'Decline auctions',
	'gb_notify_auctionta_header'	=> 'Manage successfull auctions',
	'gb_notify_auctionta_confirm1'	=> 'One auction item transfer waiting for approval',
	'gb_notify_auctionta_confirm2'	=> "%s auction items transfer waiting for approval",
	"gb_no_item_id_missing" => 'The item-ID is missing. Please try again',
	"gb_manage_auctions" => 'Manage auctions',
	"gb_auction_management" => 'Auction management',
	"gb_auction_head_add" => 'Add auction',
	"gb_auction_head_edit" => 'Edit auction',
	"gb_footer_auction" => '... %1$d auction(s) found / %2$d per page',
	"gb_footer_transaction" => '... %1$d transaction(s) found / %2$d per page',
	"gb_footer_item" => '... %1$d item(s) found / %2$d per page',
	"gb_add_auction" => 'Create auction',
	"gb_delete_auctions" => 'Delete selected Items',
	"gb_add_auction_title" => 'Add auction',
	"gb_edit_auction_title" => 'Edit auction',
	"gb_auction_item" => 'Item',
	"gb_auction_item_help" => 'One or more items to auction off. For multiple choice multiple auctions are created',
	"gb_auction_startdate" => 'Start time',
	'gb_auction_winner'	=> 'Winner',
	'gb_auction_price'	=> 'Highest bid',
	"gb_auction_duration" => 'auction duration',
	"gb_auction_amountbids" => 'amount of bids',
	"gb_auction_duration_help" => 'The auction duration in hours',
	"gb_auction_startvalue" => 'Starting bid value',
	"gb_auction_bidsteps" => 'Bid increment',
	"gb_auction_bidsteps_help" => 'Bidders can bid on these increments to the object',
	"gb_auction_raidatt" => 'Raid participate to bid',
	"gb_auction_raidatt_help" => 'Number of Raid participate in which the relevant objects have fallen. At 0 anyone can offer on the item.',
	"gb_confirm_delete_auctions" => 'You are sure, do delete this auction(s) %s ?',
	"gb_auction_multidkppool" => 'Multidkp Pool',
	"gb_auction_multidkppool_help" => 'Enter a MultiDKP pool from which the points are to be used for bids.',
	"gb_auction_icon_title" => 'Bid',
	"gb_auction_window" => 'Auction',
	"gb_auction_title" => 'Auction & bidding',
	"gb_button_bid" => 'Bidding',
	"gb_error_noidnotloggedin" => 'ATTENTION: To use the auctions you have either logged in, also use as a valid auctionID. Lets try again.',
	"gb_auction_avail_dkp" => 'Available credits',
	"gb_auction_timeleft" => 'Remaining auctiontime',
	"gb_auction_bid_info" => 'Place a bid',
	"gb_bids_footcount" => '... %1$d Bid(s) / %2$d per page',
	'gb_bids_loading' => 'Loading...',
	"gb_bids_auctionended" => 'Ended',
	"gb_bids_nobids" => 'No bids',
	"gb_manage_bankers" => 'Manage guild bankers',
	"gb_confirm_delete_bankers" => 'Should the bankers are deleted?',
	"gb_banker_mainchar" => 'Bank-character',
	"gb_money" => 'Credits',
	"gb_manage_bank_items_title" => 'Edit item of bankers \'%s\'',
	"gb_manage_bank_items" => 'Edit bankitems',
	"gb_mode" => 'Mode',
	"gb_a_mode" => array(
	0 => 'Item',
	1 => 'Transaction',
	),
	"gb_subject" => 'Application',
	"gb_members" => 'Recipient',
	"gb_manage_bank_transa" => 'Manage transactions',
	"gb_title_transaction" => 'Transaction management',
	"gb_title_item" => 'Item management',
	"gb_item_added" => 'Item added',
	"gb_item_payout" => 'Item payed out',
	"gb_payout_item" => 'Pay out item',
	"add_transaction" => 'Add transaction',
	"gb_adjustment_text" => 'Guild bank - Item was purchased ',
	"gb_item_sellable" => 'Item sellable',
	"gb_itemvalue" => 'Item value',
	"gb_manage_banker" => 'Manage bankers',
	"gb_add_item_title" => 'Add item to bank account',
	"gb_edit_item_title" => 'Edit item',
	"gb_rarity" => 'Item level',
	"gb_type" => 'Item type',
	"gb_dkp" => 'DKP',
	"gb_amount" => 'Amount',
	"gb_additem_button" => 'Save item',
	"gb_payout_button" => 'Payout item',
	"gb_addtrans_button" => 'Save transaction',
	"gb_ta_head_transaction" => 'Manage transaction',
	"gb_ta_head_payout" => 'Payout item',
	"gb_ta_head_item" => 'Manage item',
	"gb_banker_added" => 'Banker added',
	'gb_money_updated'	=> 'Updated bank deposits',
	"gb_header_global" => 'Guild bank settings',
	"gb_breadcrumb_settings" => 'Guild bank: settings',
	"gb_saved" => 'The settings were successfully saved',
	"gb_fs_banker_display" => 'Guildbank display settings',
	"gb_f_show_money" => 'Show the bank assets',
	"gb_f_help_show_money" => 'Show the bank assets (if disabled: money not displayed)',
	"gb_f_merge_bankers" => 'Combine all banker',
	"gb_f_help_merge_bankers" => 'Combine all banker to a single bank',
	"gb_fs_itemshop" => 'Item Transactions',
	"gb_f_use_autoadjust" => 'Add autoadjustment for sold items',
	"gb_f_help_use_autoadjust" => 'Should be entered automatic corrections for each sold item?',
	"gb_f_default_event" => 'Default event for adjustments',
	"gb_f_help_default_event" => 'If you want to use the auto adjustments, you need to set a default event',
	"gb_filter_banker" => 'Choose banker',
	'gb_f_allow_manualentry'		=> 'Allow manual bid typing',
	'gb_f_help_allow_manualentry'	=> 'If activated, the bidder is allowed to enter own numbers in the bid field, otherwise the selection field could be used only.',
	"gb_filter_type" => 'Choose item type',
	"gb_filter_rarity" => 'Choose item level',
	"gb_a_type" => array(
	"quest" => 'Quest',
	"weapon" => 'Weapon',
	"reagent" => 'Reagent',
	"builder" => 'Crafting',
	"armor" => 'Armor',
	"key" => 'Key',
	"useable" => 'Usables',
	"misc" => 'Others',
	),
	"gb_a_rarity" => array(
	1 => 'Other',
	2 => 'Normal',
	3 => 'Rare',
	4 => 'Epic',
	5 => 'Legendary',

	),
	"gb_currency" => array(
	"platin" => 'Platinum',
	"platin_s" => 'P',
	"gold" => 'Gold',
	"gold_s" => 'G',
	"silver" => 'Silver',
	"silver_s" => 'S',
	"copper" => 'Copper',
	"copper_s" => 'C',
	"diamond" => 'Diamond',
	"diamond_s" => 'D',
	),
	"gb_credits" => 'Guild bank %s',
	'gb_fs_auctions' => 'Auctions',
	// portal module
	'gb_auctions'					=> "Auctions",
	'gb_auctions_auctioncount' => "Anzahl Auktionen",
	'gb_f_show_list_future_auctions' => "Show list of open auctions",
	'gb_f_hide_count_future_auctions' => "Hide amount of open auctions",
	'gb_f_show_timeleft' => "Show countdown instead of fixed end date",
	'gb_auctions_maxbid' => 'Max Bid value',
		'gb_bids_error_virtual'			=> 'You do not have enough DKP, as you have already bid for other auctions.',
		'gb_bids_error_dkp'				=> 'You do not have enough DKP.',
		'gb_bids_error_step'			=> 'Your bid must be higher than the highest bid plus the bid increament.',
		'gb_bids_error_time'			=> 'The auction has already ended.',
		'gb_new_bid_info'				=> 'A new bid was submitted for this auction.<br /><br /><a href="%s">Click here to reload this page.</a>',
		
);
