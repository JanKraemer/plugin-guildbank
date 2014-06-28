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
			'icon'			=> array(
				'type'		=> 'svg',
				'name'		=> 'fw/images/diamond.svg'
			),
			'factor'		=> 1000000,
			'size'			=> 'unlimited',
			'language'		=> $user->lang['currency_diamond'],
			'short_lang'	=> $user->lang['currency_diamond_s'],
		),
		'gold'		=> array(
			'icon'			=> array(
				'type'		=> 'default',
				'name'		=> 'gold'
			),
			'factor'		=> 10000,
			'size'			=> 2,
			'language'		=> $user->lang['currency_gold'],
			'short_lang'	=> $user->lang['currency_gold_s'],
		),
		'silver'	=> array(
			'icon'			=> array(
				'type'		=> 'default',
				'name'		=> 'silver'
			),
			'factor'		=> 100,
			'size'			=> 2,
			'language'		=> $user->lang['currency_silver'],
			'short_lang'	=> $user->lang['currency_silver_s'],
		),
		'copper'	=> array(
			'icon'			=> array(
				'type'		=> 'default',
				'name'		=> 'bronze'
			),
			'factor'		=> 1,
			'size'			=> 2,
			'language'		=> $user->lang['currency_copper'],
			'short_lang'	=> $user->lang['currency_copper_s'],
		)
	);

 ?>
