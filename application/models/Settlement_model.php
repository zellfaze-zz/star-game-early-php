<?php
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
 
}