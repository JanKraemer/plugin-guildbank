<?php
/*	Project:	EQdkp-Plus
 *	Package:	Guildbanker Plugin
 *	Link:		http://eqdkp-plus.eu
 *
 *	Copyright (C) 2006-2015 EQdkp-Plus Developer Team
 *
 *	This program is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU Affero General Public License as published
 *	by the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU Affero General Public License for more details.
 *
 *	You should have received a copy of the GNU Affero General Public License
 *	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if(!defined('EQDKP_INC'))
{
	header('HTTP/1.0 Not Found');
	exit;
}

if(!class_exists('gb_money')) {
	class gb_money extends gen_class {

		public function __construct(){
			$f_moneydata		= $this->root_path.'plugins/guildbank/games/'.$this->game->get_game().'/money.config.php';
			$f_include			= (is_file($f_moneydata)) ? $f_moneydata : $this->root_path.'plugins/guildbank/games/default/money.config.php';
			include($f_include);
			$this->data			= $money_data;
			$this->load_css();
		}
		
		private function load_css(){
			$this->tpl->add_css("
				.coin{
					font-size:10px;
				}
				.coin-large{
					font-size:14px;
				}
				.coin-platin{
					color:#EDEDEF;
				}
				.coin-platin .coin-inner{
					color:#D0D4D5;
				}
				.coin-gold{
					color:#DAA520;
				}
				.coin-gold .coin-inner{
					color:#FFD700;
				}
				.coin-silver{
					color:#a7a7a7;
				}
				.coin-silver .coin-inner{
					color:#dadada;
				}
				.coin-bronze{
					color:#cd7f32;
				}
				.coin-bronze .coin-inner{
					color:#e8c4a0;
				}"
			);
		}
		
		public function loadMoneyClass(){
			// this is just a pseudo class for the PDH to load the CSS in this construct... The PDH modules & the caching require this step
			return true;
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
			switch($monValue['icon']['type']){
				case 'svg':
					$output	= "noch einbauen";
				break;
				default:
					$large_tag	= ($large) ? ' coin-large' : '';
					$output	= '<span class="fa-stack fa-fw coin coin-'.$monValue['icon']['name'].$large_tag.'" title="'.$monValue['language'].'"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-star fa-stack-1x fa-inverse coin-inner"></i></span>';
				break;
			}
			return $output;
		}

		public function editfields($mymoney=0, $name='money_{ID}', $plusminus=false){
			$monvalue = ($plusminus) ? new hdropdown(str_replace('{ID}', 'pm', $name), array('options' => array('+'=>'+', '-'=>'-'))) : '';
			foreach($this->data as $monName=>$monValue){
				$monvalue .= $this->image($monValue).' '.new htext(str_replace('{ID}', $monName, $name), array('value' => $this->output($mymoney, $monValue), 'size' => (($monValue['size'] == 'unlimited') ? 9 : $monValue['size'])));
			}
			return $monvalue;
		}
	}
}
?>