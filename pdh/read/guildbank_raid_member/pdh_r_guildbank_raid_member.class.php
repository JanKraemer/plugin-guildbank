<?php
/*	Project:	EQdkp-Plus
 *	Package:	Guildbanker Plugin
 *	Link:		http://eqdkp-plus.eu
 *
 *	Copyright (C) 2006-2016 EQdkp-Plus Developer Team
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

if (!defined('EQDKP_INC')){
    die('Do not access this file directly.');
}

if (!class_exists('pdh_r_guildbank_raid_member')){
    class pdh_r_guildbank_raid_member extends pdh_r_generic{
        private $data;

        public $hooks = array(
        );

        public $presets = array(
        );

        public function reset(){
            $this->pdc->del('pdh_guildbank_raid_member_table');
            unset($this->data);
        }

        public function init(){
            // try to get from cache first
            $this->data = $this->pdc->get('pdh_guildbank_raid_member_table');
            if($this->data !== NULL){
                return true;
            }

            // empty array as default
            $this->data = array();

            // read all guildbank_fields entries from db
            $sql = 'SELECT * FROM `__groups_raid_members` ORDER BY member_id ASC;';
            $result = $this->db->query($sql);
            if ($result){
                // add row by row to local copy
                while (($row = $result->fetchAssoc())){
                    $this->data[(int)$row['member_id']] = array(
                        'member_id'		=> (int)$row['member_id'],
                        'group_id'		=> (int)$row['group_id'],
                    );
                }
                #$this->db->free_result($result);
            }

            // add data to cache
            $this->pdc->put('pdh_guildbank_raid_member_table', $this->data, null);
            return true;
        }

        public function get_id_list(){
            if (is_array($this->data)){
                return array_keys($this->data);
            }
            return array();
        }

        public function get_raidId($id){
            return (isset($this->data[$id]) && $this->data[$id]['group_id']) ? $this->data[$id]['group_id'] : '0';
        }
    } //end class
} //end if class not exists
