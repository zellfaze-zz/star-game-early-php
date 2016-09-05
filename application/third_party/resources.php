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


class Resources {
  public static function getList() {
    return array(
      //Required
      'food',         //Used to feed population, common
      'population',   //Literally people, common
      'science',      //Used to purchase technologies and create inventions, common
      'oxygen',       //Used for breating also required for fuel to work, common
      'electricity',  //Used to power all the things, common
      
      //General Building Materials
      'metals',       //Used as general building materials, common
      'polymers',     //Used as general building materials, uncommon
      'rare_earth',   //Used to build electronics, rare
      
      //Fuel Sources
      'fuel',         //Used to power slower than light speed ships and terestrial vehicles, common
      'antimatter',   //Used to power anti-matter drives and weapons, rare
      'deuterium',    //Used to power slower than light speed ships, uncommon
      'he3',          //Fissionable energy source, used for ships and power reactors, common
      'uranium',      //Fissionable energy source, used for ships and power reactors, uncommon
      'hydrogen',     //Used as fuel, common
      
      //FTL Materials
      'gluon_arrays', //Very expensive to produce, used for gravitational astronomy and some FTL designs, rare
      'dilithium',    //Very rare, used to power some FTL designs, very rare
      
      //Other
      'monopoles',    //Used to produce levitating terestrial buildings and units, rare
      'lithium',      //Used for electrical storage, common
      'collapsium',   //Extremely durable metal used for armor, rare
    );
  }
}

trait ResourceContainer {
  protected $resourceContainer = array();
  protected $resourceContainerTransforms = array();
  protected $resourceContainerLastUpdated = null;
  
  public function addResource($resource, $amount) {
    $this->resourceContainer[$resource] += $amount;
  }
  
  public function removeResource($resource, $amount) {
    $this->resourceContainer[$resource] -= $amount;
  }
  
  public function getResource($resource) {
    return $this->resourceContainer[$resource];
  }
  
  public function addResourceTransform($transformObject) {
    $this->resourceContainerTransforms[] = $transformObject;
  }
  
  public function updateResourceContainer() {
    if ($this->resourceContainerLastUpdated === null) {
      throw new Exception('Container last updated must be initialised!');
    }
    
    foreach ($this->resourceContainerTransforms as $transform) {
      $resources = $transform->getAcceptedResourceList();
      
      $bucket = array();
      foreach ($resources as $resource) {
        $bucket[$resource] = $this->ResourceContainer[$resource];
      }
      unset($resouce)
      
      $newBucket = $transform->transformResources($bucket, $this->resourceContainerLastUpdated, $now);
      
      foreach ($newBucket as $resource => $value) {
        $this->addResource($resouce, $value);
      }
    }
  }
}

trait ResourceTransform {
  abstract public function transformResources($resources, $start, $end, $max = null);
    //Returns array with changes to resources listed
    //Accepts array of current resources
    
  abstract public function getAcceptedResourceList();
    //Returns an array listing resources accepted
}