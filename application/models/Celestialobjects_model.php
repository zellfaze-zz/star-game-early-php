<?php
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