<?php
/*
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


class Timer_model extends CI_Model {
  public function __construct() {
    parent::__construct();
    
    $this->load->database();
  }
  
  public function deleteTimer($id) {
    $this->db->delete('timers', array('id' => $id));
  }
  
  public function insertTimer($data) {
    $this->db->insert('timers', $data);
    $id = $this->db->insert_id();
    
    return (int)$id;
  }
  
  public function updateTimer($id, $data) {
    $this->db->update('timers', $data, array('id' => $id));
  }
  
  public function getTimer($id) {
    $this->db->select('id, startTime, endTime, callback, data');
    $this->db->where(array('id' => $id));
    $query = $this->db->get('timers');
    
    return $query->row_array();
  }
  
  public function getExpiredTimers() {
    $now = new DateTime('now');
    $this->db->select('id');
    $this->db->where(array('endTime <' => $now->format("Y-m-d H:i:s")));
    $query = $this->db->get('timers');
    
    $expired = array();
    foreach ($query-result() as $row) {
      $expired[] = $row->id;
    }
    
    return $expired;
  }
  
  public function getNewestExpiredTimer() {
    $now = new DateTime('now');
    $this->db->select('id');
    $this->db->where(array('endTime <' => $now->format("Y-m-d H:i:s")));
    $this->db->order_by('endTime', 'ASC');
    $this->db->limit(1);
    $query = $this->db->get('timers');
    
    if ($query->num_rows() == 0) {
      return null;
    }
    
    $row = $query->result();
    return $row->id;
  }
  
}