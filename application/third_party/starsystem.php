<?php
log_message('debug', 'Loaded StarSystem class');

class StarSystem implements SaveLoad {
  protected $id, $x, $y;
  protected $bodies = array();
  protected $ci;
  
  public function __construct($id = null) {
    $this->ci =& get_instance();
    
    //If they don't give us an ID we generate a new System, else we load it
    if ($id == null) {
      $this->id = null;
      $this->x = null;
      $this->y = null;
      $this->generateNewSystem();
    } else {
      $this->id = $id;
      $this->loadData();
    }
  }
  
  public function generateNewSystem() {
    //Determine the size of the system
    //System Types:
    //  1: Single Dwarf
    //  2: Binary Dwarf
    //  3: Single Main Sequence
    //  4: Binary Main Sequence
    //  5: Giant
    $systemType = rand(1,6) -1;
    
    //Build our Stars
    switch($systemType) {
      case 0:
      case 1:
        $systemSize = rand(475500, 3329000);
        $starSize = floor($systemSize * 0.95);
        $planetSize = floor($systemSize * 0.05);
        $this->bodies[] = new Star($starSize);
        break;
      case 2:
        $systemSize = rand(951000, 3329000);
        $starSize = floor($systemSize * 0.95);
        $planetSize = floor($systemSize * 0.05);
        $minStarPercentage = floor((475500/$starSize) * 100);
        $secondStarPercentage = rand($minStarPercentage, 100-$minStarPercentage);
        $star1 = floor($starSize * ((100-$secondStarPercentage)/100));
        $star2 = floor($starSize * (($secondStarPercentage)/100));
        $this->bodies[] = new Star($star1);
        $this->bodies[] = new Star($star2);
        break;
      case 3:
        $systemSize = rand(3329000,53264000);
        $starSize = floor($systemSize * 0.95);
        $planetSize = floor($systemSize * 0.05);
        $this->bodies[] = new Star($starSize);
        break;
      case 4:
        $systemSize = rand(6658000,106528000);
        $starSize = floor($systemSize * 0.99);
        $planetSize = floor($systemSize * 0.01);
        $minStarPercentage = floor((475500/$starSize) * 100);
        if ($minStarPercentage == 0) {
          $minStarPercentage++;
        }
        $secondStarPercentage = rand($minStarPercentage, 100-$minStarPercentage);
        $star1 = floor($starSize * ((100-$secondStarPercentage)/100));
        $star2 = floor($starSize * (($secondStarPercentage)/100));
        $this->bodies[] = new Star($star1);
        $this->bodies[] = new Star($star2);
        break;
      case 5:
        $systemSize = rand(79896000,133160000);
        $starSize = floor($systemSize * 0.99);
        $planetSize = floor($systemSize * 0.01);
        $this->bodies[] = new Star($starSize);
        break;
    }
    
    //Find all of the Gas Giants
    $maxGasGiants = rand(1,5);
    $currentGiants = 0;
    $jupiters = array();
    while ($planetSize > 5000) {
      $max = 30000;
      if ($max > $planetSize) {
        $max = $planetSize;
      }
      
      $planet1 = rand(4000, $max);
      $jupiters[] = new GasGiant($planet1);
      $planetSize -= $planet1;
      
      $currentGiants++;
      if ($currentGiants == $maxGasGiants) {
        break;
      }
    }
    
    //Find all of the Ice Giants
    $maxIceGiants = rand(1,5);
    $currentGiants = 0;
    $neptunes = array();
    while ($planetSize > 3000) {
      $max = 20000;
      if ($max > $planetSize) {
        $max = $planetSize;
      }
      
      $planet1 = rand(4000, $max);
      $neptunes[] = new IceGiant($planet1);
      $planetSize -= $planet1;
      
      $currentGiants++;
      if ($currentGiants == $maxIceGiants) {
        break;
      }
    }
    
    //Find all of the Rocky Planets
    $maxRocky = rand(1,10);
    $currentRocky = 0;
    $mercurys = array();
    while ($planetSize > 0) {
      $max = 500;
      if ($max > $planetSize) {
        $max = $planetSize;
      }
      
      $planet1 = rand(1, $max);
      $mercurys[] = new RockyPlanet($planet1);
      $planetSize -= $planet1;
      
      $currentRocky++;
      if ($currentRocky == $maxRocky) {
        break;
      }
    }
    
    //Should we move a Jupiter in close?
    if (rand(1,5) == 1) {
      //Yes
      $planet = array_pop($jupiters);
      $this->bodies[] = $planet;
      
      if (rand(1,3) > 1) {
        //Lets destroy some stuff!
        if (count($mercurys) > 0) {
          $planetDeath = rand(0, count($mercurys)-1);
          $size = $mercurys[$planetDeath]->outputSize();
          $belt = new Belt($size);
          $mercurys[$planetDeath] = $belt;
        }
      }
    }
    
    //Destroy a planet?
    if (rand(1,2) == 1) {
      //If we have enough
      if (count($mercurys) > 0) {
        //How many?
        $death = rand(1, count($mercurys));
        $currentDeath = 0;
        while ($currentDeath < $death) {
          $whichPlanet = rand(0, count($mercurys)-1);
          $mercurys[$whichPlanet] = new Belt($mercurys[$whichPlanet]->outputSize());
          $currentDeath++;
        }
      }
    }
    
    //Combine the rest of the system
    foreach ($mercurys as $planet) {
      $this->bodies[] = $planet;
    }
    
    foreach ($jupiters as $planet) {
      $this->bodies[] = $planet;
    }
    
    foreach ($neptunes as $planet) {
      $this->bodies[] = $planet;
    }
    
    //Set planet positions
    foreach ($this->bodies as $position => $planet) {
      $planet->setPosition($position);
    }
  }
  
  public function outputSystem() {
    $bodies = array();
    $counter = 0;
    foreach ($this->bodies as $body) {
      $bodies[$counter]['id'] = $body->getID();
      $bodies[$counter]['type'] = $body->outputType();
      $bodies[$counter]['size'] = $body->outputSize();
      $counter++;
    }
    
    return $bodies;
  }
  
  public function systemHabitable() {
    foreach ($this->bodies as $body) {
      if (is_a($body, 'Planet')) {
        if ($body->isHabitable()) {
          return true;
        }
      }
    }
    return false;
  }
  
  public function loadData() {
    $this->ci->load->model('map_model');
    
    //Get Core System Data
    $systemData = $this->ci->map_model->getSystem($this->id);
    $this->x = $systemData['x'];
    $this->y = $systemData['y'];
    
    //Get Planet Data
    $planetData = $this->ci->map_model->getPlanetList($this->id);
    foreach ($planetData as $planet) {
      $planetObj = new $planet['type']($planet['id'], true);
      $this->bodies[$planet['position']] = $planetObj;
    }
  }
  
  //TODO: Check for existance of x and y
  public function saveData() {
    $this->ci->load->model('map_model');
    if(($this->x === null) || ($this->y === null)) {
      throw new Exception('System coords must be set to save');
    }
    
    $data = array('x' => $this->x, 'y' => $this->y);
    
    //Save Core System Data
    if ($this->id === null) {
      $this->id = $this->ci->map_model->insertSystem($data);
    } else {
      $this->ci->map_model->saveSystem($this->id, $data);
    }
    
    //Save Planet Data
    foreach ($this->bodies as $planet) {
      $planet->setSystem($this->id);
      $planet->saveData();
    }
  }
  
  public function setCoord($x, $y) {
    $this->x = $x;
    $this->y = $y;
  }
  
  public function getCoord() {
    return array('x' => $this->x, 'y' => $this->y);
  }
  
  public function &getBody($position) {
    return $this->bodies[$position];
  }
}