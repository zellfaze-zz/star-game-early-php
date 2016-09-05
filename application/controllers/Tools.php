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


class Tools extends CI_Controller {
  public function __construct() {
    parent::__construct();
    
    require_once('application/third_party/load.php');
  }
  
  public function index() {
    echo 'Help:' . PHP_EOL . PHP_EOL;
    echo 'Tools migrate' . PHP_EOL;
    echo '  Migrate the database' . PHP_EOL;
    
    echo 'Tools resetMap' . PHP_EOL;
    echo '  Empty and regenerate the map (this takes a long time!)' . PHP_EOL;
  }
  
  //WARNING: Remove this method after development is done
  public function migrate() {
    $this->load->library('migration');
    
    if ($this->migration->current() === FALSE) {
      show_error($this->migration->error_string());
    } else {
      echo 'Migrated!' . PHP_EOL;
    }
  }
  
  public function resetMap() {
    $this->load->model('map_model');
    
    $this->map_model->emptyMap();
    
    $map = new Map();
    $map->saveData(true);
    
    echo 'Saved Map' . PHP_EOL;
  }
  
  public function deleteUsers() {
    $this->load->model('user_model');
    
    $this->user_model->emptyUsers();
    
    echo 'Deleted all users! Please create root' . PHP_EOL;
  }
}