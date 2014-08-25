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


/*+----------------------------------------------------------------------------
  | guildrequest_search_hook
  +--------------------------------------------------------------------------*/
if (!class_exists('guildbank_search_hook')){
	class guildbank_search_hook extends gen_class{

		/**
		* hook_search
		* Do the hook 'search'
		*
		* @return array
		*/
		public function search(){
			// build search array
			$search = array(
				'guildbank'	=> array(
					'category'		=> $this->user->lang('guildbank'),
					'module'		=> 'guildbank_items',
					'method'		=> 'search',
					'permissions'	=> array('u_guildbank_view'),
				),
			);
			return $search;
		}
	}
}
?>