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
  
  public function delete() {
    Settlement::deleteSettlement($this->id);
  }
  
  public static function deleteSettlement($id) {
    $ci = get_instance;
    $ci->load->model('settlement_model');
    
    $ci->settlement_model->dropSettlement($id);
  }
}