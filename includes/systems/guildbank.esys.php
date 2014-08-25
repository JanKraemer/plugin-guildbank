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

if (!defined('EQDKP_INC')){
	header('HTTP/1.0 404 Not Found');exit;
}

$systems_guildbank = array(
	'pages' => array(
		'hptt_guildbank_items' => array(
			'name'					=> 'hptt_guildbank_items',
			'table_main_sub'		=> '%item_id%',
			'table_subs'			=> array('%item_id%', '%itt_lang%', '%itt_direct%', '%onlyicon%', '%noicon%'),
			'page_ref'				=> 'guildbank.php',
			'show_numbers'			=> false,
			'show_select_boxes' 	=> false,
			'selectboxes_checkall'	=> false,
			'table_sort_dir'		=> 'desc',
			'table_sort_col'		=> 1,
			'table_presets'			=> array(
				array('name' => 'gb_iname_itt',	'sort' => true,		'th_add' => 'align="center width="100%"',	'td_add' => ''),
				array('name' => 'gb_iamount',	'sort' => true,		'th_add' => 'align="center width="50px"',	'td_add' => ''),
				array('name' => 'gb_itype',		'sort' => true,		'th_add' => 'align="center width="200px"',	'td_add' => ''),
				array('name' => 'gb_ibanker',	'sort' => true,		'th_add' => 'align="center"',				'td_add' => ''),
				array('name' => 'gb_idkp',		'sort' => true,		'th_add' => 'align="center"',				'td_add' => ''),
				array('name' => 'gb_icost',		'sort' => true,		'th_add' => 'align="center"',				'td_add' => ''),
				array('name' => 'gb_ishop',		'sort' => false,	'th_add' => 'align="center"',				'td_add' => '')
			)
		),
		'hptt_guildbank_transactions' => array(
			'name'					=> 'hptt_guildbank_transactions',
			'table_main_sub'		=> '%trans_id%',
			'table_subs'			=> array('%trans_id%', '%itt_lang%', '%itt_direct%', '%onlyicon%', '%noicon%'),
			'page_ref'				=> 'guildbank.php',
			'show_numbers'			=> false,
			'show_select_boxes' 	=> false,
			'selectboxes_checkall'	=> false,
			'table_sort_dir'		=> 'desc',
			'table_sort_col'		=> 1,
			'table_presets'			=> array(
				array('name' => 'gb_tdate',		'sort' => true,		'th_add' => 'align="center width="100%"',	'td_add' => ''),
				array('name' => 'gb_tsubject',	'sort' => true,		'th_add' => 'align="center width="100%"',	'td_add' => ''),
				array('name' => 'gb_titem_itt',	'sort' => true,		'th_add' => 'align="center width="100%"',	'td_add' => ''),
				array('name' => 'gb_tbuyer',	'sort' => true,		'th_add' => 'align="center width="50px"',	'td_add' => ''),
				array('name' => 'gb_tbanker',	'sort' => true,		'th_add' => 'align="center width="200px"',	'td_add' => ''),
				array('name' => 'gb_tvalue',	'sort' => true,		'th_add' => 'align="center"',				'td_add' => ''),
				array('name' => 'gb_tdkp',		'sort' => true,		'th_add' => 'align="center"',				'td_add' => '')
			)
		),
		'hptt_guildbank_auctions' => array(
			'name'					=> 'hptt_guildbank_auctions',
			'table_main_sub'		=> '%auction_id%',
			'table_subs'			=> array('%auction_id%', '%itt_lang%', '%itt_direct%', '%onlyicon%', '%noicon%'),
			'page_ref'				=> 'guildbank.php',
			'show_numbers'			=> false,
			'show_select_boxes' 	=> false,
			'selectboxes_checkall'	=> false,
			'table_sort_dir'		=> 'desc',
			'table_sort_col'		=> 0,
			'table_presets'			=> array(
				array('name' => 'gb_aalink',		'sort' => false,	'th_add' => 'align="center width="20px"',	'td_add' => ''),
				array('name' => 'gb_astartdate',	'sort' => true,		'th_add' => 'align="center width="100%"',	'td_add' => ''),
				array('name' => 'gb_aname_itt',		'sort' => true,		'th_add' => 'align="center width="100%"',	'td_add' => ''),
				array('name' => 'gb_left_atime',	'sort' => true,		'th_add' => 'align="center width="100%"',	'td_add' => ''),
				array('name' => 'gb_astartvalue',	'sort' => true,		'th_add' => 'align="center width="100%"',	'td_add' => ''),
				array('name' => 'gb_bidhibidder',	'sort' => true,		'th_add' => 'align="center width="50px"',	'td_add' => ''),
				array('name' => 'gb_bidhivalue',	'sort' => true,		'th_add' => 'align="center width="50px"',	'td_add' => ''),
			)
		),
		'hptt_guildbank_bids' => array(
			'name'					=> 'hptt_guildbank_bids',
			'table_main_sub'		=> '%bid_id%',
			'table_subs'			=> array('%bid_id%'),
			'page_ref'				=> 'guildauction.php',
			'show_numbers'			=> false,
			'show_select_boxes' 	=> false,
			'selectboxes_checkall'	=> false,
			'table_sort_dir'		=> 'desc',
			'table_sort_col'		=> 0,
			'table_presets'			=> array(
				array('name' => 'gb_biddate',	'sort' => false,	'th_add' => 'align="center width="20%"',	'td_add' => ''),
				array('name' => 'gb_bidmember',	'sort' => false,	'th_add' => 'align="center width="30%"',	'td_add' => ''),
				array('name' => 'gb_bidvalue',	'sort' => false,	'th_add' => 'align="center width="50%"',	'td_add' => ''),
			)
		),
		'hptt_guildbank_admin_items' => array(
			'name'					=> 'hptt_guildbank_admin_items',
			'table_main_sub'		=> '%item_id%',
			'table_subs'			=> array('%item_id%', '%itt_lang%', '%itt_direct%', '%onlyicon%', '%noicon%'),
			'page_ref'				=> 'manage_banker.php',
			'show_numbers'			=> true,
			'show_select_boxes' 	=> true,
			'selectboxes_checkall'	=> true,
			'selectbox_name'		=> 'selections',
			'selectbox_valueprefix'	=> 'item_',
			'table_sort_dir'		=> 'desc',
			'table_sort_col'		=> 1,
			'table_presets' => array(
				array('name' => 'gb_iedit',		'sort' => false,	'th_add' => 'align="center width="40px"',	'td_add' => ''),
				array('name' => 'gb_iname_itt',	'sort' => true,		'th_add' => '',								'td_add' => 'style="height:21px;"'),
				array('name' => 'gb_idate',		'sort' => true,		'th_add' => '',								'td_add' => ''),
				array('name' => 'gb_itype',		'sort' => true,		'th_add' => '',								'td_add' => ''),
				array('name' => 'gb_irarity',	'sort' => true,		'th_add' => 'align="center"',				'td_add' => ''),
				array('name' => 'gb_iamount',	'sort' => true,		'th_add' => 'align="center"',				'td_add' => ''),
				array('name' => 'gb_ivalue',	'sort' => true,		'th_add' => 'align="center"',				'td_add' => ''),
				array('name' => 'gb_idkp',		'sort' => true,		'th_add' => 'align="center"',				'td_add' => ''),
			),
		),
		'hptt_guildbank_admin_transactions' => array(
			'name'					=> 'hptt_guildbank_admin_transactions',
			'table_main_sub'		=> '%trans_id%',
			'table_subs'			=> array('%trans_id%', '%itt_lang%', '%itt_direct%', '%onlyicon%', '%noicon%'),
			'page_ref'				=> 'manage_banker.php',
			'show_numbers'			=> true,
			'show_select_boxes' 	=> true,
			'selectboxes_checkall'	=> true,
			'selectbox_name'		=> 'selections',
			'selectbox_valueprefix'	=> 'transaction_',
			'table_sort_dir'		=> 'desc',
			'table_sort_col'		=> 0,
			'table_presets'			=> array(
				array('name' => 'gb_tedit',		'sort' => false,	'th_add' => 'align="center width="40px"',	'td_add' => ''),
				array('name' => 'gb_tdate',		'sort' => true,		'th_add' => 'align="center width="100%"',	'td_add' => ''),
				array('name' => 'gb_tsubject',	'sort' => true,		'th_add' => 'align="center width="100%"',	'td_add' => ''),
				array('name' => 'gb_titem_itt',	'sort' => true,		'th_add' => 'align="center width="100%"',	'td_add' => ''),
				array('name' => 'gb_tbuyer',	'sort' => true,		'th_add' => 'align="center width="50px"',	'td_add' => ''),
				array('name' => 'gb_tbanker',	'sort' => true,		'th_add' => 'align="center width="200px"',	'td_add' => ''),
				array('name' => 'gb_tvalue',	'sort' => true,		'th_add' => 'align="center"',				'td_add' => ''),
				array('name' => 'gb_tdkp',		'sort' => true,		'th_add' => 'align="center"',				'td_add' => ''),
			)
		),
		'hptt_guildbank_admin_auctions' => array(
			'name'					=> 'hptt_guildbank_admin_auctions',
			'table_main_sub'		=> '%auction_id%',
			'table_subs'			=> array('%auction_id%', '%itt_lang%', '%itt_direct%', '%onlyicon%', '%noicon%'),
			'page_ref'				=> 'manage_auctions.php',
			'show_numbers'			=> true,
			'show_select_boxes' 	=> true,
			'selectboxes_checkall'	=> true,
			'selectbox_name'		=> 'auction_ids',
			'table_sort_dir'		=> 'desc',
			'table_sort_col'		=> 3,
			'table_presets'			=> array(
				array('name' => 'gb_aedit',			'sort' => false,	'th_add' => 'align="center width="40px"',	'td_add' => ''),
				array('name' => 'gb_aactive',		'sort' => false,	'th_add' => 'align="center"',				'td_add' => ''),
				array('name' => 'gb_aname_itt',		'sort' => true,		'th_add' => 'align="center width="100%"',	'td_add' => ''),
				array('name' => 'gb_astartdate',	'sort' => true,		'th_add' => 'align="center width="100%"',	'td_add' => ''),
				array('name' => 'gb_aduration',		'sort' => true,		'th_add' => 'align="center width="100%"',	'td_add' => ''),
				array('name' => 'gb_astartvalue',	'sort' => true,		'th_add' => 'align="center width="100%"',	'td_add' => ''),
				array('name' => 'gb_abidsteps',		'sort' => true,		'th_add' => 'align="center width="50px"',	'td_add' => ''),
				array('name' => 'gb_left_atime',		'sort' => true,		'th_add' => 'align="center width="50px"',	'td_add' => ''),
				array('name' => 'gb_anote',			'sort' => true,		'th_add' => 'align="center width="200px"',	'td_add' => ''),
			)
		),
	)
);

?>
