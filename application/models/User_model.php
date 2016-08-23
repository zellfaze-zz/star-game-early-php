<?php

class User_model extends CI_Model {
  public function __construct() {
    parent::__construct();
    
    $this->load->database();
    $this->load->helper('security');
  }
  
  public function createUser($username, $password) {
    //Create user
    $hash = do_hash($username . $password, 'sha256');
    
    $data = array(
      'username' => $username,
      'password' => $hash,
      'is_admin' => false
    );
    
    $this->db->insert('users', $data);
    $userID = $this->db->insert_id();
    
    return (int)$userID;
  }
  
  public function checkLogin($username, $password) {
    $this->db->select('id, password');
    $this->db->where('username', $username);
    $query = $this->db->get('users');
    
    $row = $query->row();
    
    if ($row->password == do_hash($username . $password, 'sha256')) {
      return (int)$row->id;
    } else {
      return false;
    }
  }
  
  public function rootExists() {
    $this->db->where('id', 1);
    $num = $this->db->count_all_results('users');
    
    if ($num === 1) {
      return true;
    } else {
      return false;
    }
  }
  
  public function emptyUsers() {
    $this->db->truncate('users');
  }
  
  public function userExists($username) {
    $this->db->where('username', $username);
    $num = $this->db->count_all_results('users');
    
    if ($num === 1) {
      return true;
    } else {
      return false;
    }
  }
  
  public function makeAdmin($id) {
    $data = array(
      'is_admin' => true
    );
    $this->db->where('id', $id);
    $this->db->update('users', $data);
  }
}