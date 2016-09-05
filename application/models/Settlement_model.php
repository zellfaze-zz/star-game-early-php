<?php/*
Copyright (c) 2016 "Derric Atzrott"

This file is part of Star-Game.

Star-Game is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as
published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/


//TODO: Finish class

class Settlement_model extends CI_Model {
  public function __construct() {
    parent::__construct();
    
    $this->load->database();
  }
 
  public function getSettlement($id) {
    $this->db->select('id, size, owner_id, planet_id, resource_data, building_data');
    $this->db->where(array('id' => $id));
    $query = $this->db->get('settlements');
  
    return $query->row_array();
  }
 
  public function saveSettlement($id, $data) {
    $this->db->update('settlements', $data, array('id' => $id));
  }
 
  public function insertSettlement($data) {
    $this->db->insert('settlements', $data);
    return $this->db->insert_id();
  }
 
  public function getSettlementsOnPlanet($planet_id) {
    $this->db->select('id');
    $this->db->where(array('planet_id' => $planet_id));
    $query = $this->db->get('settlements');
    
    if ($query->num_rows() === 0) {
      return null;
    }
    
    $settlements = array();
    foreach ($query->result() as $row) {
      $settlements[] = $row->id;
    }
    
    return $settlements;
  }
  
  public function dropSettlement($id) {
    $this->db->delete('settlements', array('id' => $id));
  }
 
}