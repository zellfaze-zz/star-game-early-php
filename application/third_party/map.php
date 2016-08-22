<?php

class Map {
  protected $mapArray = array();
  protected $idArray = array();
  protected $ci;
  
  public function __construct($xMax = 100, $yMax = 100) {
    $this->ci =& get_instance();
    
    if ($xMax === true) {
      //Load Star Systems
      $this->loadData();
    } else {
      //Generate Star Systems
      $x = 0;
      while ($x < $xMax) {
        $this->mapArray[$x] = array();
        $y = 0;
        
        while ($y < $yMax) {
          $this->mapArray[$x][$y] = new StarSystem();
          $this->mapArray[$x][$y]->setCoord($x, $y);
          $y++;
        }
        
        $x++;
      }
    }
  }
  
  public function &getSystem($x, $y) {
    //Ensure X array is set
    if (!isset($this->mapArray[$x])) {
      $this->mapArray[$x] = array();
    }
    
    //Lazy load the system if needed
    if (!isset($this->mapArray[$x][$y])) {
      if (!isset($this->idArray[$x][$y])) {
        throw new Exception('System does not exist!');
      }
      $id = $this->idArray[$x][$y];
      $this->mapArray[$x][$y] = new StarSystem($id);
    }
      
    return $this->mapArray[$x][$y];
  }
  
  public function loadData() {
    $this->ci->load->model('map_model');
    
    //Get list of systems
    $list = $this->ci->map_model->getSystemList();
    
    //Create objects and save to appropriate locations
    foreach ($list as $element) {
      $x = (int)$element['x'];
      $y = (int)$element['y'];
      $id = (int)$element['id'];
      
      //Ensure the X array is there
      if (!isset($this->idArray[$x])) {
        $this->idArray[$x] = array();
      }
      
      //Add the Y coordinate
      $this->idArray[$x][$y] = $id;
    }    
  }
  
  public function saveData($verbose = false) {
    //Loop through all star systems and call their save method
    
    foreach ($this->mapArray as $mapRow) {
      foreach($mapRow as $system) {
        if ($verbose == true) {
          echo 'Saving system: ' . $system->getCoord()['x'] . ', ' . $system->getCoord()['y'] . PHP_EOL;
        }
        $system->saveData();
      }
    }
  }
}