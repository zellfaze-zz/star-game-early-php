<?php

class Settlement implements SaveLoad {
  protected $id, $planet_id, $owner_id;
  protected $ci;
  protected $size;
  protected $buildings, $resources;
  
  public function __construct($id = false) {
    $this->ci = get_instance();
    
    if ($id !== false) {
      $this->id = $id;
      $this->loadData();
    } else {
      $this->id = null;
      $this->planet_id = null;
      $this->owner_id = null;
      $this->size = 1;
      $this->buildings = array();
      $this->resources = array();
    }
  }
  
  public function saveData() {
    $this->ci->load->model('settlement_model');
    
    if ($this->planet_id === null) {
      throw new Exception('Settlement must be attached to planet to save');
    }
    
    if ($this->owner_id === null) {
      throw new Exception('Settlement must be owned by player to save');
    }
    
    $data['building_data'] = json_encode($this->buildings);
    $data['resource_data'] = json_encode($this->buildings);
    $data['planet_id']     = $this->planet_id;
    $data['owner_id']      = $this->owner_id;
    
    if ($this->id === null) {
      $this->id = $this->ci->settlement_model->insertSettlement($data);
    } else {
      $this->ci->settlement_model->saveSettlement($this->id, $data);
    }
  }
  
  public function loadData() {
    $this->ci->load->model('settlement_model');
    
    $data = $this->ci->settlement_model->getSettlement($this->id);
    
    $this->buildings = json_decode($data['building_data'], true);
    $this->buildings = json_decode($data['resource_data'], true);
    $this->planet_id = $data['planet_id'];
    $this->owner_id  = $data['owner_id'];
  }
  
  public function setOwner($id) {
    $this->owner_id = $id;
  }
  
  public function getOwner() {
    return $this->owner_id;
  }
  
  public function setPlanet($id) {
    $this->planet_id = $id;
  }
  
  public function getPlanet() {
    return $this->planet_id;
  }
}