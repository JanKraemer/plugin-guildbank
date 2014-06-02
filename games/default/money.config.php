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
		'gold'		=> array(
			'icon'			=> array(
				'type'		=> 'default',
				'name'		=> 'gold'
			),
			'factor'		=> 10000,
			'size'			=> 'unlimited',
			'language'		=> $this->user->lang('lang_gold'),
			'short_lang'	=> $this->user->lang('lang_g'),
		),
		'silver'	=> array(
			'icon'			=> array(
				'type'		=> 'default',
				'name'		=> 'silver'
			),
			'factor'		=> 100,
			'size'			=> 2,
			'language'		=> $this->user->lang('lang_silver'),
			'short_lang'	=> $this->user->lang('lang_s'),
		),
		'copper'	=> array(
			'icon'			=> array(
				'type'		=> 'default',
				'name'		=> 'bronze'
			),
			'factor'		=> 1,
			'size'			=> 2,
			'language'		=> $this->user->lang('lang_copper'),
			'short_lang'	=> $this->user->lang('lang_c'),
		)
  );

 ?>
