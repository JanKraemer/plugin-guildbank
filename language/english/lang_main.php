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

if (!defined('EQDKP_INC')){
	header('HTTP/1.0 404 Not Found');exit;
}

$lang = array(
	'guildbank'							=> "Guild bank",
	'guildbank_short_desc'				=> 'Manage items and transactions of guild bankers',
	'guildbank_long_desc'				=> 'Guild bank is a Plugin to manage raiditems.',
	'guildbank_not_installed'			=> 'Guild bank is not installed.',

	// Permissions
	'gb_a_perm_auctions'				=> 'Manage auctions',
	'gb_u_perm_auction'					=> 'Bid on auctions',
	'gb_perm_shop'						=> 'Buy items',

	// Main Menu
	'gb_mainmenu_guildbank'				=> "Guild bank",

	// Admin Menu
	'gb_adminmenu_guildbank'			=> "Guild bank",

	//guildbank
	'gb_banker'							=> "Banker",
	'gb_shop'							=> "Itemshop",
	'gb_not_avail'						=> "n.a.",
	'gb_all_bankers'					=> "All banker",
	'gb_total_bankers'					=> "Asset of all bankers",
	'gb_mainchar_out'					=> "Main character",
	'gb_no_bankchar'					=> 'None',
	'gb_update'							=> 'Last activity',
	'gb_tab_transactions'				=> 'Transactions',
	'gb_tab_items'						=> 'Items',
	'gb_tab_auctions'					=> 'Auction',
	'gb_title_page'						=> 'View guildbank',

	// Shop
	'gb_shop_window'					=> 'Buy item',
	'gb_shop_icon_title'				=> 'Buy item',
	'gb_shop_buy'						=> 'Buy',
	'gb_item_name'						=> 'Item',
	'gb_item_value'						=> 'Purchasing price (DKP)',
	'gb_item_date'						=> 'Purchasing date ',
	'gb_dkppool'						=> 'MultiDKP-Pool',
	'gb_shop'							=> 'Shop',
	'gb_shop_error_nodkp'				=> 'There are not enough DKP to buy this item.',
	'gb_shop_error_noitem'				=> 'There is no item available to purchase.',
	'gb_shop_buy_subject'				=> 'Item received',
	'gb_shop_buy_successmsg'			=> 'The item was flagged for shopping. The transaction will be made ​​after the confirmation by an admin and credited to your account',
	'gb_confirm_shop_ta_head'			=> 'Guild bank item purchases',
	'gb_confirm_shop_ta_button'			=> 'Confirm purchase',
	'gb_decline_shop_ta_button'			=> 'Decline purchase',
	'gb_confirm_msg_success'			=> 'The transaction was successfully completed',
	'gb_confirm_msg_delete'				=> 'The transaction was successfully declined',
	'gb_notify_shopta_header'			=> 'Share purchases item',
	'gb_notify_shopta_confirm_req1'		=> 'A purchase is waiting for release',
	'gb_notify_shopta_confirm_req2'		=> "%s purchases are waiting for release",
	'gb_no_item_id_missing'				=> "The item-ID is missing. Please try again",

	// manage_auction
	'gb_manage_auctions'				=> 'Manage auctions',
	'gb_auction_management'				=> 'Auction management',
	'gb_auction_head_add'				=> 'Add auction',
	'gb_auction_head_edit'				=> 'Edit auction',
	'gb_footer_auction'					=> "... %1\$d auction(s) found / %2\$d per page",
	'gb_add_auction'					=> 'Create auction',
	'gb_delete_auctions'				=> 'Delete selected Items',
	'gb_add_auction_title'				=> 'Add auction',
	'gb_edit_auction_title'				=> 'Edit auction',
	'gb_auction_item'					=> 'Item',
	'gb_auction_item_help'				=> 'One or more items to auction off. For multiple choice multiple auctions are created',
	'gb_auction_startdate'				=> 'Start time',
	'gb_auction_duration'				=> 'auction duration',
	'gb_auction_duration_help'			=> 'The auction duration in hours',
	'gb_auction_startvalue'				=> 'Starting bid value',
	'gb_auction_bidsteps'				=> 'Bid increment',
	'gb_auction_bidsteps_help'			=> 'Bidders can bid on these increments to the object',
	'gb_auction_raidatt'				=> 'Raid participate to bid',
	'gb_auction_raidatt_help'			=> 'Number of Raid participate in which the relevant objects have fallen. At 0 anyone can offer on the item.',
	'gb_confirm_delete_auctions'		=> "You are sure, do delete this auction(s) %s ?",
	'gb_auction_multidkppool'			=> 'Multidkp Pool',
	'gb_auction_multidkppool_help'		=> 'Enter a MultiDKP pool from which the points are to be used for bids.',

	// auction shop
	'gb_auction_icon_title'				=> 'Bid',
	'gb_auction_window'					=> 'Auction',
	'gb_auction_title'					=> 'Auction & bidding',
	'gb_button_bid'						=> 'Bidding',
	'gb_error_noidnotloggedin'			=> 'ATTENTION: To use the auctions you have either logged in, also use as a valid auctionID. Lets try again.',
	'gb_auction_avail_dkp'				=> 'Available credits',
	'gb_auction_timeleft'				=> 'Remaining auctiontime',
	'gb_auction_bid_info'				=> 'Place a bid',
	'gb_bids_footcount'					=> "... %1\$d Bid(s) / %2\$d per page",

	// manage_banker
	'gb_manage_bankers'					=> 'Manage guild bankers',
	'gb_confirm_delete_bankers'			=> "Should the bankers are deleted?",
	'gb_banker_mainchar'				=> 'Bank-character',
	'gb_money'							=> 'Credits',

	// manage transactions
	'gb_manage_bank_items_title'		=> "Edit item of bankers '%s'",
	'gb_manage_bank_items'				=> "Edit bankitems",
	'gb_mode'							=> 'Mode',
	'gb_a_mode'							=> array(
		'0'			=> 'Item',
		'1'			=> 'Transaction',
	),
	'gb_subject'						=> 'Application',
	'gb_members'						=> 'Recipient',
	'gb_manage_bank_transa'				=> 'Manage transactions',
	'gb_title_transaction'				=> 'Transaction management',
	'gb_title_item'						=> 'Item management',
	'gb_item_added'						=> 'Item added',
	'gb_item_payout'					=> 'Item payed out',
	'gb_payout_item'					=> 'Pay out item',
	'add_transaction'					=> 'Add transaction',
	'gb_adjustment_text'				=> 'Guild bank - Item was purchased ',
	'gb_item_sellable'					=> 'Item sellable',
	'gb_itemvalue'						=> 'Item value',

	// add/edit banker
	'gb_manage_banker'					=> 'Manage bankers',
	'gb_add_item_title'					=> 'Add item to bank account',
	'gb_edit_item_title'				=> 'Edit item',
	'gb_item_name'						=> "Item",
	'gb_rarity'							=> 'Item level',
	'gb_type'							=> "Item type",
	'gb_dkp'							=> "DKP",
	'gb_amount'							=> "Amount",
	'gb_additem_button'					=> 'Save item',
	'gb_payout_button'					=> 'Payout item',
	'gb_addtrans_button'				=> 'Save transaction',
	'gb_ta_head_transaction'			=> 'Manage transaction',
	'gb_ta_head_payout'					=> 'Payout item',
	'gb_ta_head_item'					=> 'Manage item',
	'gb_banker_added'					=> 'Banker added',

	// settings
	'gb_header_global'					=> "Guild bank settings",
	'gb_breadcrumb_settings'			=> "Guild bank: settings",
	'gb_saved'							=> "The settings were successfully saved",
	'gb_fs_banker_display'				=> "Guildbank display settings",
	'gb_f_show_money'					=> "Show the bank assets",
	'gb_f_help_show_money'				=> "Show the bank assets (if disabled: money not displayed)",
	'gb_f_merge_bankers'				=> "Combine all banker",
	'gb_f_help_merge_bankers'			=> "Combine all banker to a single bank",
	'gb_f_show_tooltip'					=> "Show info tooltips",
	'gb_f_help_show_tooltip'			=> "Don't know what it does ;)",
	'gb_fs_itemshop'					=> "Item Transactions",
	'gb_f_use_autoadjust'				=> 'Add autoadjustment for sold items',
	'gb_f_help_use_autoadjust'			=> 'Should be entered automatic corrections for each sold item?',
	'gb_f_default_event'				=> 'Default event for adjustments',
	'gb_f_help_default_event'			=> 'If you want to use the auto adjustments, you need to set a default event',

	//filter translations
	'gb_filter_banker'					=> "Choose banker",
	'gb_filter_type'					=> "Choose item type",
	'gb_filter_rarity'					=> "Choose item level",

	// filters
	'gb_a_type'							=> array(
		'quest'		=> "Quest",
		'weapon'	=> "Weapon",
		'reagent'	=> "Reagent",
		'builder'	=> "Crafting",
		'armor'		=> "Armor",
		'key'		=> "Key",
		'useable'	=> "Usables",
		'misc'		=> "Others"
	),
	'gb_a_rarity'						=> array(
		'5'			=> "Legendary",
		'4'			=> "Epic",
		'3'			=> "Rare",
		'2'			=> "Normal",
		'1'			=> "Other"
	),

	// default currency
	'gb_currency'						=> array(
		'platin'	=> 'Platinum',
		'platin_s'	=> 'P',
		'gold'		=> 'Gold',
		'gold_s'	=> 'G',
		'silver'	=> 'Silver',
		'silver_s'	=> 'S',
		'copper'	=> 'Copper',
		'copper_s'	=> 'C',
		'diamond'	=> 'Diamond',
		'diamond_s'	=> 'D',
	),

	// credits
	'gb_credits'						=> "Guild bank %s",
);
?>