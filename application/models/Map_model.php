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


//TODO: Clean data

class Map_model extends CI_Model {
  public function __construct() {
    parent::__construct();
    
    $this->load->database();
  }
  
  public function saveSystem($id, $data) {
    $this->db->update('map', $data, array('id' => $id));
  }
  
  public function insertSystem($data) {
    $this->db->insert('map', $data);
    return $this->db->insert_id();
  }
  
  public function getSystem($id) {
    $this->db->select('id, x, y');
    $this->db->where(array('id' => $id));
    $query = $this->db->get('map');
    
    return $query->row_array();
  }
  
  public function getPlanetList($id) {
    $this->db->select('id, type, position');
    $this->db->where(array('system' => $id));
    $query = $this->db->get('celestialobjects');
    
    $results = array();
    foreach ($query->result_array() as $row) {
      $results[] = $row;
    }
    
    return $results;
  }
  
  public function getSystemList() {
    $this->db->select('id, x, y');
    $query = $this->db->get('map');
    
    $results = array();
    foreach ($query->result_array() as $row) {
      $results[] = $row;
    }
    
    return $results;
  }
  
  public function emptyMap() {
    $this->db->truncate('map');
    $this->db->truncate('celestialobjects');
  }
}