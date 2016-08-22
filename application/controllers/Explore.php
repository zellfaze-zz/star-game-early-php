<?php

class Explore extends CI_Controller {
  public function __construct() {
    parent::__construct();
    
    require_once('application/third_party/load.php');
  }
  
  public function index() {
    
  }
  public function explore($x = 1, $y = 1) {
    $map = new Map(true);
    $data['system'] = $map->getSystem($x,$y)->outputSystem();
    $data['x'] = $x;
    $data['y'] = $y;
    
    $this->load->view('explore', $data);
  }
  
  public function examine($planetID) {
    $planet = CelestialObject::loadObject($planetID);
    
    $data = array();
    $data['type'] = $planet->outputType();
    $data['id'] = $planet->getID();
    $data['size'] = $planet->outputSize();
    $data['x'] = $planet->getSystem()->getCoord()['x'];
    $data['y'] = $planet->getSystem()->getCoord()['y'];
    
    $objectData = $planet->getData();
    if (isset($objectData['size'])) {
      unset($objectData['size']);
    }
    
    $data['data'] = $objectData;
    
    $this->load->view('examine', $data);
  }
}