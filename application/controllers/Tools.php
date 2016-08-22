<?php

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
}