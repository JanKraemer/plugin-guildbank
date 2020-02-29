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

if (!class_exists('pdh_r_guildbank_raids')){
    class pdh_r_guildbank_raids extends pdh_r_generic{
        private $data;
        private $banker;

        public $hooks = array(
        );

        public $presets = array(
        );

        public function reset(){
            $this->pdc->del('pdh_guildbank_raids_table.raid');
            $this->pdc->del('pdh_guildbank_raids_table.banker');
            unset($this->data);
            unset($this->banker);
        }

        public function init(){
            // try to get from cache first
            $this->data = $this->pdc->get('pdh_guildbank_raids_table.raid');
            $this->banker = $this->pdc->get('pdh_guildbank_raids_table.banker');
            if($this->data !== NULL && $this->banker !== NULL){
                return true;
            }

            // empty array as default
            $this->data = $this->banker = array();

            // read all guildbank_fields entries from db
            $sql = 'SELECT * FROM `__groups_raid` ORDER BY groups_raid_id ASC;';
            $result = $this->db->query($sql);
            if ($result){
                // add row by row to local copy
                while (($row = $result->fetchAssoc())){
                    $this->data[(int)$row['groups_raid_id']] = array(
                        'raid_id'		=> (int)$row['groups_raid_id'],
                        'raid_name'			=> $row['groups_raid_name'],
                    );
                    foreach ($this->pdh->get('guildbank_banker', 'id_list', array((int)$row['groups_raid_id'])) as $banker_id) {
                        $this->banker[$banker_id] = (int)$row['groups_raid_id'];
                    }
                }
                #$this->db->free_result($result);
            }

            // add data to cache
            $this->pdc->put('pdh_guildbank_raids_table.raid', $this->data, null);
            $this->pdc->put('pdh_guildbank_raids_table.banker', $this->banker, null);
            return true;
        }

        public function get_id_list($banker_id){
            $data = ((int)$banker_id> 0) ? $this->banker[$banker_id] : $this->data;
            if (is_array($data)){
                return array_keys($data);
            }
            return array();
        }

        public function get_name($id){
            return (isset($this->data[$id]) && $this->data[$id]['raid_name']) ? $this->data[$id]['raid_name'] : 'None';
        }
    } //end class
} //end if class not exists
