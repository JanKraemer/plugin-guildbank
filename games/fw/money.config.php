<?php
/*
 * Project:     EQdkp GuildBanker
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

	// The array with the images
	$money_data = array(
		'diamond'		=> array(
			'image'			=> 'default/images/gold.png',
			'factor'		=> 1000000,
			'size'			=> 'unlimited',
			'language'		=> $user->lang['lang_diamond'],
			'short_lang'	=> $user->lang['lang_d'],
		),
		'gold'		=> array(
			'image'			=> 'default/images/gold.png',
			'factor'		=> 10000,
			'size'			=> 2,
			'language'		=> $user->lang['lang_gold'],
			'short_lang'	=> $user->lang['lang_g'],
		),
		'silver'	=> array(
			'image'			=> 'default/images/silver.png',
			'factor'		=> 100,
			'size'			=> 2,
			'language'		=> $user->lang['lang_silver'],
			'short_lang'	=> $user->lang['lang_s'],
		),
		'copper'	=> array(
			'image'			=> 'default/images/copper.png',
			'factor'		=> 1,
			'size'			=> 2,
			'language'		=> $user->lang['lang_copper'],
			'short_lang'	=> $user->lang['lang_c'],
		)
	);

 ?>
