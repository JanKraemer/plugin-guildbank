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
				array('name' => 'gb_ibanker',	'sort' => true,		'th_add' => 'align="center"',				'td_add' => '')
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
		'hptt_guildbank_admin_items' => array(
			'name'					=> 'hptt_guildbank_admin_items',
			'table_main_sub'		=> '%item_id%',
			'table_subs'			=> array('%item_id%', '%itt_lang%', '%itt_direct%', '%onlyicon%', '%noicon%'),
			'page_ref'				=> 'manage_banker.php',
			'show_numbers'			=> true,
			'show_select_boxes' 	=> true,
			'selectboxes_checkall'	=> true,
			'table_sort_dir'		=> 'desc',
			'table_sort_col'		=> 1,
			'table_presets' => array(
				array('name' => 'gb_iname_itt',	'sort' => true,		'th_add' => '',								'td_add' => 'style="height:21px;"'),
				array('name' => 'gb_idate',		'sort' => true,		'th_add' => '',								'td_add' => ''),
				array('name' => 'gb_itype',		'sort' => true,		'th_add' => '',								'td_add' => ''),
				array('name' => 'gb_irarity',	'sort' => true,		'th_add' => 'align="center"',				'td_add' => ''),
				array('name' => 'gb_iamount',	'sort' => true,		'th_add' => 'align="center"',				'td_add' => ''),
				array('name' => 'gb_ivalue',	'sort' => true,		'th_add' => 'align="center"',				'td_add' => ''),
				array('name' => 'gb_idkp',		'sort' => true,		'th_add' => 'align="center"',				'td_add' => ''),
				array('name' => 'gb_iedit',		'sort' => false,	'th_add' => 'align="center width="40px"',	'td_add' => ''),
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
			'table_sort_dir'		=> 'desc',
			'table_sort_col'		=> 1,
			'table_presets'			=> array(
				array('name' => 'gb_tdate',		'sort' => true,		'th_add' => 'align="center width="100%"',	'td_add' => ''),
				array('name' => 'gb_tsubject',	'sort' => true,		'th_add' => 'align="center width="100%"',	'td_add' => ''),
				array('name' => 'gb_titem_itt',	'sort' => true,		'th_add' => 'align="center width="100%"',	'td_add' => ''),
				array('name' => 'gb_tbuyer',	'sort' => true,		'th_add' => 'align="center width="50px"',	'td_add' => ''),
				array('name' => 'gb_tbanker',	'sort' => true,		'th_add' => 'align="center width="200px"',	'td_add' => ''),
				array('name' => 'gb_tvalue',	'sort' => true,		'th_add' => 'align="center"',				'td_add' => ''),
				array('name' => 'gb_tdkp',		'sort' => true,		'th_add' => 'align="center"',				'td_add' => ''),
				array('name' => 'gb_tedit',		'sort' => false,	'th_add' => 'align="center width="40px"',	'td_add' => '')
			)
		),
	)
);

?>
