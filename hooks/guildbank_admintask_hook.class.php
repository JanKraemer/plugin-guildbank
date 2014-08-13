<?php
/*
 * Project:     EQdkp guildrequest
 * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:        http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:       2008
 * Date:        $Date$
 * -----------------------------------------------------------------------
 * @author      $Author$
 * @copyright   2008-2011 Aderyn
 * @link        http://eqdkp-plus.com
 * @package     guildrequest
 * @version     $Rev$
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
					'name'			=> 'gb_confirm_shop_ta',
					'icon'			=> 'fa fa-check',
					'notify_func'	=> array($this, 'admintask_shopTA_ntfy'),
					'content_func'	=> array($this, 'admintask_shopTA_content'),
					'action_func'	=> array($this, 'admintask_shopTA_handle'),
					'actions'		=> array(
						'confirm'		=> array('icon' => 'fa fa-check', 'title' => 'uc_confirm_char', 'permissions' => array('a_guildbank_manage')),
						'delete'		=> array('icon' => 'fa-trash-o', 'title' => 'delete_member', 'permissions' => array('a_guildbank_manage')),
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
				foreach ($confirm as $member){
					$userId			= $this->pdh->get('member', 'user', array($member));
					/*$arrContent[]	= array(
							'id'		=> $member,
							'name'		=> $this->pdh->get('member', 'name_decorated', array($member)),
							'level'		=> $this->pdh->get('member', 'level', array($member)),
							'user'		=> ($userId) ? $this->pdh->get('user', 'name', array($userId)) : '',
					);*/
				}
			}
			return $arrContent;
		}
	
		public function admintask_shopTA_ntfy(){
			$deletion		= $this->pdh->get('guildbank_shop_ta', 'confirm_required');
			if (count($deletion) > 0){
				/*return array(array(
					'type'		=> 'yellow',
					'count'		=> count($deletion),
					'msg'		=> sprintf($this->user->lang('notification_char_confirm_required'), count($deletion)),
					'category'	=> $this->user->lang('manage_members'),
				));*/
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