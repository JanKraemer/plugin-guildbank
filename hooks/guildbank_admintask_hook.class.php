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
if (!class_exists('guildbank_admintask_hook')) {
	class guildbank_admintask_hook extends gen_class{

		/**
		* hook_init
		* blablabla
		*
		* @return array
		*/
		public function admin_tasks(){
			return array(
				'gb_confirmTA'	=> array(
					'name'			=> 'gb_confirm_shop_ta_head',
					'icon'			=> 'fa fa-check',
					'notify_func'	=> array($this, 'admintask_shopTA_ntfy'),
					'content_func'	=> array($this, 'admintask_shopTA_content'),
					'action_func'	=> array($this, 'admintask_shopTA_handle'),
					'actions'		=> array(
						'confirm'	=> array('icon' => 'fa fa-check', 'title' => 'gb_confirm_shop_ta_button', 'permissions' => array('a_guildbank_manage')),
						'delete'	=> array('icon' => 'fa-times', 'title' => 'gb_decline_shop_ta_button', 'permissions' => array('a_guildbank_manage')),
					),
				),
			);
		}
		
		public function admintask_shopTA_content(){
			$arrContent		= array();
		
			//Confirm item transactions
			$confirm		= $this->pdh->get('guildbank_shop_ta', 'id_list');
			if (count($confirm) > 0){
				$nothing	= false;
				foreach ($confirm as $transaction){
					$arrContent[]	= array(
							'id'			=> $transaction,
							'gb_item_name'	=> $this->pdh->get('guildbank_shop_ta',	'item',		array($transaction)),
							'gb_amount'		=> $this->pdh->get('guildbank_shop_ta',	'amount',	array($transaction)),
							'gb_item_date'	=> $this->pdh->get('guildbank_shop_ta',	'date',		array($transaction)),
							'gb_item_value'	=> $this->pdh->get('guildbank_shop_ta',	'value',	array($transaction)),
							'buyer'			=> $this->pdh->get('guildbank_shop_ta',	'buyer',	array($transaction)),
					);
				}
			}
			return $arrContent;
		}
	
		public function admintask_shopTA_ntfy(){
			$confirm		= $this->pdh->get('guildbank_shop_ta', 'id_list');
			if (count($confirm) > 0){
				return array(array(
					'type'		=> 'gb_notify_shopta',
					//'count'		=> count($confirm),
					'count'		=> 1,
					'msg'		=> (count($confirm) > 1) ? sprintf($this->user->lang('gb_notify_shopta_confirm_req2'), count($confirm)) : $this->user->lang('gb_notify_shopta_confirm_req1'),
					'icon'		=> 'fa-shopping-cart',
					'prio'		=> 1,
				));
			}
			return array();
		}
	
		public function admintask_shopTA_handle($strAction, $arrIDs, $strTaskID){
			if ($strAction == 'confirm'){
				if (count($arrIDs)){
					foreach($arrIDs as $ta_id){
						$this->pdh->put('guildbank_transactions', 'confirm_itemta', array((int)$ta_id));
					}
					$this->pdh->process_hook_queue();
					$this->core->message($this->user->lang('gb_confirm_msg_success'), $this->user->lang('success'), 'green');
				}
			}

			if($strAction == 'delete'){
				if (count($arrIDs)){
					foreach($arrIDs as $ta_id){
						$this->pdh->put('guildbank_transactions', 'delete_itemta', array((int)$ta_id));
					}
					$this->pdh->process_hook_queue();
					$this->core->message($this->user->lang('gb_confirm_msg_delete'), $this->user->lang('success'),'green');
			
				}
			}
		}
	}
}
?>