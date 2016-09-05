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


class Explore extends CI_Controller {
  public function __construct() {
    parent::__construct();
    
    require_once('application/third_party/load.php');
    redirectLogin(1);
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