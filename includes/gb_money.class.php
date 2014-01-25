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

if(!defined('EQDKP_INC'))
{
	header('HTTP/1.0 Not Found');
	exit;
}

if(!class_exists('gb_money')) {
	class gb_money extends gen_class {
		public static $shortcuts = array('in', 'config', 'user', 'game', 'html');
		
		public function __construct(){
			$f_moneydata	= $this->root_path.'plugins/guildbank/games/'.$this->game->get_game().'/money.config.php';
			$f_include		= (is_file($f_moneydata)) ? $f_moneydata : $this->root_path.'plugins/guildbank/games/default/money.config.php';
			include($f_include);
			$this->data		= $money_data;
		}
		
		public function get_data(){
			return $this->data;
		}

		public function output($input, $variables){
			if($input){
				$outp = floor($input/$variables['factor']);
				//echo 'test: '.$input.'/'.$variables['factor'].'='.$outp.'<br/>';
				return ($variables['size'] == 'unlimited') ? $outp : substr($outp, ((isset($variables['size']) && is_int($variables['size']) && $variables['size'] > 0) ? -$variables['size'] : -2));
			}
			return '0';
		}

		public function input($arrData= false, $name='money_{ID}'){
			$total	= 0;
			foreach($this->data as $mname=>$value){
				if($arrData){
					$total		+= ($arrData[str_replace('{ID}', $mname, $name)]) ? ($arrData[str_replace('{ID}', $mname, $name)]*$value['factor']) : 0;
				}else{
					$total		+= ($this->in->exists(str_replace('{ID}', $mname, $name))) ? ($this->in->get(str_replace('{ID}', $mname, $name), 0)*$value['factor']) : 0;
				}
				
			}

			// add the operator..
			if($this->in->exists(str_replace('{ID}', 'pm', $name))){
				$total = $this->in->get(str_replace('{ID}', 'pm', $name)).$total;
			}

			return $total;
		}

		public function fields($mymoney){
			$monvalue = array();
			foreach($this->data as $monName=>$monValue){
				$monvalue[] = $this->output($mymoney, $monValue).$this->image($monValue);
			}
			return implode(" ", $monvalue);
		}

		public function image($monValue, $large=false, $size=false){
			$imgsize	= ($size) ? ' width="'.$size.'"' : '';
			return '<img src="'.$this->root_path.'plugins/guildbank/games/'.(($large) ? ((isset($monValue['image_large'])) ? $monValue['image_large'] : $monValue['image']) : $monValue['image']).'" alt="'.$monValue['language'].'" title="'.$monValue['language'].'"'.$imgsize.' />';
		}

		public function editfields($mymoney=0, $name='money_{ID}', $plusminus=false){
			$monvalue = ($plusminus) ? $this->html->DropDown(str_replace('{ID}', 'pm', $name), array('+'=>'+', '-'=>'-')) : '';
			foreach($this->data as $monName=>$monValue){
				$monvalue .= $this->image($monValue).' '.$this->html->TextField(str_replace('{ID}', $monName, $name), (($monValue['size'] == 'unlimited') ? 6 : $monValue['size']), $this->output($mymoney, $monValue));
			}
			return $monvalue;
		}
	}
}
?>