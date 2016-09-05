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

class Celestialobjects_model extends CI_Model {
  public function __construct() {
    parent::__construct();
    
    $this->load->database();
  }
  
  public function saveObject($id, $data) {
    $this->db->update('celestialobjects', $data, array('id' => $id));
  }
  
  public function insertObject($data) {
    $this->db->insert('celestialobjects', $data);
    return $this->db->insert_id();
  }
  
  public function getObject($id) {
    $this->db->select('id, type, system, position, data');
    $this->db->where(array('id' => $id));
    $query = $this->db->get('celestialobjects');
    
    return $query->row_array();
  }
}