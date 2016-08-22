<?php
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