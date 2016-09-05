<?php

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