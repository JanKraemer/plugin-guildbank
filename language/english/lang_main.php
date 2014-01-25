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

if (!defined('EQDKP_INC'))
{
    header('HTTP/1.0 404 Not Found');exit;
}

$lang = array(
	'guildbank'						=> "Guild bank",
	'guildbank_short_desc'			=> 'Manage items and transactions of guild bankers',
	'guildbank_long_desc'			=> 'Manage items and transactions of guild bankers',
	'guildbank_not_installed'		=> 'Guild bank is not installed',

	// User Menu
	'gb_usermenu_guildbank'			=> "Guild bank",

	// Admin Menu
	'gb_adminmenu_guildbank'		=> "Guild bank",

	//guildbank
	'gb_banker'						=> "banker",
	'gb_shop'						=> "Itemshop",
	'gb_not_avail'					=> "n.a.",
	'gb_all_bankers'				=> "All banker",
	'gb_total_bankers'				=> "Asset of all bankers",
	'gb_mainchar_out'				=> "Main character",
	'gb_no_bankchar'				=> 'None',
	'gb_update'						=> 'Last activity',
	'gb_tab_transactions'			=> 'Transactions',
	'gb_tab_items'					=> 'Items',

	// Shop
	'gb_shop_window'				=> 'Buy item',
	'gb_shop_icon_title'			=> 'Buy item',
	'gb_shop_buy'					=> 'Buy',
	'gb_item_name'					=> 'Item name',
	'gb_shop'						=> 'Shop',

	// manage_banker
	'manage_bankers'				=> 'Manage guild banker',
	'confirm_delete_bankers'		=> "Should the banker(s) %s be removed?",
	'banker_mainchar'				=> 'Bank-character',
	'money'							=> 'Balance',

	// manage transactions
	'gb_manage_bank_items_title'	=> "Edit items of banker '%s'",
	'gb_manage_bank_items'			=> "Edit items of banker",
	'gb_mode'						=> 'Mode',
	'gb_a_mode'					=> array(
		'0'			=> 'Item',
		'1'			=> 'Transaction',
	),
	'gb_subject'					=> 'Purpose',
	'gb_members'					=> 'Recipient',
	'gb_manage_bank_transa'			=> 'Manage transactions',
	'gb_item_added'					=> 'Add item',
	'gb_item_payout'				=> 'Item payed out',
	'gb_payout_item'				=> 'Pay out item',
	'add_transaction'				=> 'Add transaction',
	'gb_adjustment_text'			=> 'Guildbank - Bought an item',
	'gb_item_sellable'				=> 'Item sellable',

	// add/edit banker
	'gb_add_item_title'				=> 'Add item to bank account',
	'gb_edit_item_title'			=> 'Edit item',
	'gb_item_name'					=> "Item",
	'gb_rarity'						=> 'Item level',
	'gb_type'						=> "Item type",
	'gb_dkp'						=> "DKP",
	'gb_amount'						=> "Amount",
	'rb_additem_button'				=> 'Save item',
	'rb_edititem_button'			=> 'Edit item',
	'gb_payput_button'				=> 'Payout item',
	'gb_ta_head_transaction'		=> 'Manage transaction',
	'gb_ta_head_payout'				=> 'Payout Item',
	'gb_ta_head_item'				=> 'Manage item',

	// settings
	'gb_header_global'				=> "Guild bank settings",
	'gb_saved'						=> "The settings were successfully saved",
	'gb_show_money'					=> "Show the bank assets",
	'gb_show_money_help'			=> "Show the bank assets (if disabled: money not displayed)",
	'gb_merge_banker'				=> "Combine all banker",
	'gb_merge_banker_help'			=> "Combine all banker to a single bank",
	'gb_show_tooltip'				=> "Show info tooltips",
	'gb_show_tooltip_help'			=> "tbd",
	'gb_enable_autoadjustment'		=> 'Add autoadjustment for sold items',
	'gb_enable_autoadjustment_help'	=> 'If you want an auto adjustment for every item sold',
	'gb_default_event'				=> 'Default event for adjustments',
	'gb_default_event_help'			=> 'If you want to use the auto adjustments, you need to set a default event',

	//filter translations
	'gb_filter_banker'				=> "Choose banker",
	'gb_filter_type'				=> "Choose item type",
	'gb_filter_rarity'				=> "Choose item level",

	// filters
	'gb_a_type'						=> array(
		'quest'		=> "Quest",
		'weapon'	=> "Weapon",
		'reagent'	=> "Reagent",
		'builder'	=> "Crafting",
		'armor'		=> "Armor",
		'key'		=> "Key",
		'useable'	=> "Usables",
		'misc'		=> "Others"
	),
	'gb_a_rarity'					=> array(
		'5'			=> "Legendary",
		'4'			=> "Epic",
		'3'			=> "Rare",
		'2'			=> "Normal",
		'1'			=> "Other"
	),

	// credits
	'guildbank_credits'			=> "Guild bank %s",
);
?>
