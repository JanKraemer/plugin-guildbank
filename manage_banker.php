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

define('EQDKP_INC', true);
define('IN_ADMIN', true);
define('PLUGIN', 'guildbank');

$eqdkp_root_path = './../../../';
include_once('./../includes/common.php');

class Manage_Banker extends page_generic {
	public static function __shortcuts() {
		$shortcuts = array('user', 'tpl', 'in', 'pdh', 'jquery', 'core', 'config', 'html', 'pm', 'time', 'money' => 'rb_money');
		return array_merge(parent::$shortcuts, $shortcuts);
	}

	public function __construct(){
		$this->user->check_auth('a_guildbank_manage');
		$handler = array(
			'save'	=> array('process' => 'save', 'csrf'=>true),
			'g'		=> array('process' => 'edit'),
		);
		parent::__construct(false, $handler, array('bankers', 'name'), null, 'banker_ids[]');
		$this->process();
	}

	public function save() {
		$noranks = false;
		$retu = array();
		$bankers = $this->get_post();
		if($bankers) {
			$id_list = $this->pdh->get('guildbank_banker', 'id_list');
			foreach($bankers as $banker) {
				$func				= (in_array($banker['id'], $id_list)) ? 'update' : 'add';
				$money				= $this->money->input($banker, 'money_{ID}');
				$retu[]				= $this->pdh->put('guildbank_banker', $func, array($banker['id'], $banker['name'], $money, $banker['bankchar'], $banker['note']));
				$names[]			= $banker['name'];
			}
			if(in_array(false, $retu)) {
				$message = array('title' => $this->user->lang('save_nosuc'), 'text' => implode(', ', $names), 'color' => 'red');
			} elseif(in_array(true, $retu)) {
				$message = array('title' => $this->user->lang('save_suc'), 'text' => implode(', ', $names), 'color' => 'green');
			}
		}else{
			$message = array('title' => '', 'text' => $this->user->lang('no_calendars_selected'), 'color' => 'grey');
		}
		$this->display($message);
	}

	public function delete() {
		$noranks = false;
		$banker_ids = $this->in->getArray('banker_ids', 'int');
		if($banker_ids) {
			foreach($banker_ids as $id) {
				$names[] = $this->pdh->get('guildbank_banker', 'name', ($id));
				$retu[] = $this->pdh->put('guildbank_banker', 'delete', array($id));
			}
			if(in_array(false, $retu)) {
				$message = array('title' => $this->user->lang('del_no_suc'), 'text' => implode(', ', $names), 'color' => 'red');
			} else {
				$message = array('title' => $this->user->lang('del_suc'), 'text' => implode(', ', $names), 'color' => 'green');
			}
		} else {
			$message = array('title' => '', 'text' => $this->user->lang('no_calendars_selected'), 'color' => 'grey');
		}
		$this->display($message);
	}

	public function display($messages=false) {
		if($messages) {
			$this->pdh->process_hook_queue();
			$this->core->messages($messages);
		}

		// bankchar
		$bankchars	=  array_merge(array(0 => '---'),$this->pdh->aget('member', 'name', 0, array($this->pdh->get('member', 'id_list'))));
		$new_id		= 0;
		$order		= $this->in->get('order','0.0');
		$arrBanker	= $this->pdh->aget('guildbank_banker', 'name', 0, array($this->pdh->get('guildbank_banker', 'id_list')));
		if($order == '0.0') {
			arsort($arrBanker);
		} else {
			asort($arrBanker);
		}
		$key		= 0;
		$new_id		= 1;
		ksort($arrBanker);
		foreach($arrBanker as $id => $name) {
			$this->tpl->assign_block_vars('bankers', array(
				'KEY'			=> $key,
				'ID'			=> $id,
				'NAME'			=> $name,
				'DR_BANKCHAR'	=> $this->html->DropDown('bankers['.$key.'][bankchar]', $bankchars, $this->pdh->get('guildbank_banker', 'bankchar', array($id, true)), '', '', 'input', 'bankchar'.$key),
				'MONEY'			=> $this->money->editfields($this->pdh->get('guildbank_transactions', 'money', array($id)), 'bankers['.$key.'][money_{ID}]'),
				'NOTE'			=> $this->pdh->get('guildbank_banker', 'note', array($id)),
			));
			$key++;
			$new_id	= ($new_id == $id) ? $id+1 : $new_id;
		}
		$this->confirm_delete($this->user->lang('confirm_delete_bankers'));

		$this->tpl->assign_vars(array(
			'SID'			=> $this->SID,
			'ID'			=> $new_id,
			'KEY'			=> $key,
			'DR_BANKCHAR'	=> $this->html->DropDown('bankers['.$key.'][bankchar]', $bankchars, '', '', '', 'input', 'bankchar'.$key),
			'MONEY'			=> $this->money->editfields(0, 'bankers['.$key.'][money_{ID}]'),
		));

		$this->core->set_vars(array(
			'page_title'		=> $this->user->lang('manage_bankers'),
			'template_path'		=> $this->pm->get_data('guildbank', 'template_path'),
			'template_file'		=> 'admin/manage_banker.html',
			'display'			=> true)
		);
	}

	// ---------------------------------------------------------
	// Displays a single Group
	// ---------------------------------------------------------
	public function edit($messages=false, $banker = false){
		if($messages) {
			$this->pdh->process_hook_queue();
			$this->core->messages($messages);
		}
		
		$bankerID  = ($banker > 0) ? $banker : $this->in->get('g', 0);
		
		//init infotooltip
		infotooltip_js();
		require_once($this->root_path.'plugins/guildbank/includes/systems/guildbank.esys.php');

		// load and init hptt
		$view_list		= $this->pdh->get('guildbank_items', 'id_list', array($bankerID));
		$hptt			= $this->get_hptt($systems_guildbank['pages']['hptt_guildbank_admin_items'], $view_list, $view_list, array('%itt_lang%' => false, '%itt_direct%' => 0, '%onlyicon%' => 0, '%noicon%' => 0));
		$page_suffix	= '&amp;start='.$this->in->get('start', 0);
		$sort_suffix	= '&amp;sort='.$this->in->get('sort');
		$item_count		= count($view_list);
		$footer_text	= sprintf($this->user->lang('listitems_footcount'), $item_count, $this->user->data['user_ilimit']);

		// start ouptut
		$this->confirm_delete($this->user->lang('confirm_delete_items'));
		$this->tpl->assign_vars(array(
			'BANKID'			=> $bankerID,
			'SID'				=> $this->SID,
			'ITEM_LIST'			=> $hptt->get_html_table($this->in->get('sort'), $page_suffix, $this->in->get('start', 0), $this->user->data['user_ilimit'], $footer_text),
			'PAGINATION'		=> generate_pagination('manage_banker.php'.$this->SID.'&g='.$bankerID.$sort_suffix, $item_count, $this->user->data['user_ilimit'], $this->in->get('start', 0)),
			'HPTT_COLUMN_COUNT'	=> $hptt->get_column_count())
		);

		$this->core->set_vars(array(
			'page_title'		=> 'Hioer kommz noch nen Titel hon',
			'template_file'		=> 'admin/manage_banker_items.html',
			'template_path'		=> $this->pm->get_data('guildbank', 'template_path'),
			'display'			=> true)
		);
	}

	private function get_post() {
		$bankers 	= array();
		$banker_id	= 0;
		$selected = $this->in->getArray('banker_ids', 'int');
		if($this->in->exists('bankers', 'string')) {
			foreach($this->in->getArray('bankers', 'string') as $key => $banker) {
				if(isset($banker['id']) && $banker['id'] && !empty($banker['name'])) {
					$bankers[$banker_id] = array(
						'selected'	=> (in_array($banker['id'], $selected)) ? $banker['id'] : false,
						'id'		=> $this->in->get('bankers:'.$key.':id', 0),
						'name'		=> $this->in->get('bankers:'.$key.':name', ''),
						'bankchar'	=> $this->in->get('bankers:'.$key.':bankchar', 0),
						'note'		=> $this->in->get('bankers:'.$key.':note', '')
					);
					foreach($this->money->get_data() as $monName=>$monValue){
						$bankers[$banker_id]['money_'.$monName] = $this->in->get('bankers:'.$key.':money_'.$monName, '');
					}
				}
				$banker_id++;
			}
			return $bankers;
		}
		return false;
	}
}
if(version_compare(PHP_VERSION, '5.3.0', '<')) registry::add_const('short_Manage_Banker', Manage_Banker::__shortcuts());
registry::register('Manage_Banker');
?>