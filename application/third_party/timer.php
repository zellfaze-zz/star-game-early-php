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


class Timer implements SaveLoad {
  protected $id;
  protected $start, $endTime;
  protected $callback;
  protected $data;
  protected $ci;
  
  public function __construct(int $id = false) {
    $this->ci = get_instance();
    
    if ($id !== false) {
      $this->id = $id;
      $this->loadData();
    } else {
      $this->id = null;
      $this->startTime = null;
      $this->endTime = null;
      $this->callback = null;
      $this->data = null;
    }
  }
  
  public function setTimer(int $length, DateTime $begin = null) {
    $now = new DateTime('now');
    
    if ($begin === null) {
      $begin = $now;
    }
    
    $interval = new DateInterval('PT' . $length . 'S');
    $end = clone $begin;
    $end->add($interval);
    
    $this->start = $begin;
    $this->endTime = $end;
  }
  
  public function setBegin(DateTime $time = null) {
    if ($time === null) {
      $time = new DateTime('now');
    }
    
    $this->start = $time;
  }
  
  public function setEnd(DateTime $time = null) {
    if ($time === null) {
      $time = new DateTime('now');
    }
    
    $this->$endTime = $time;
  }
  
  public function timeLeft() {
    $now = new DateTime('now');
    
    //Get the endTime
    $end = $this->endTime;
    
    //Compare that to now
    $timeLeft = date_diff($now, $end);
    
    //Return seconds left
    return (int)$timeLeft->format('%r%s');
  }
  
  public function cancelTimer() {
    //Set everything to null except ID
    $this->startTime = null;
    $this->endTime = null;
    $this->callback = null;
    $this->data = null;
    
    //If ID is not null drop the row
    if ($this->id !== null) {
      $this->ci->load->model('timer_model');
      $this->ci->timer_model->deleteTimer($this->id);
    }
    
    //Set ID to null
    $this->id = null;
    
    //This object should now behave like a new timer object
  }
  
  public function callback(callable $callback) {
    //Set class to class
    //Set method to method
    $this->callback = $callback;
  }
  
  public function performCallback(bool $remove = true) {
    //Call class's method, passing it data
    //Return the methods return data
    $return = call_user_func_array($this->callback, $this->data);
    
    if ($remove === true) {
      $this->cancelTimer();
    }
    
    return $return;
  }
  
  public function setData(array $data) {
    //Set the data that will be used for the callback
    $this->data = $data;
  }
  public function getData() {
    //Return the callback data
    return $this->data;
  }
  
  public function saveData() {
    //Save this timer to database, insert new row if needed
    $this->ci->load->model('timer_model');
    
    $data = array(
      'startTime' => $this->startTime->format("Y-m-d H:i:s");
      'endTime' => $this->endTime->format("Y-m-d H:i:s");
      'callback' => json_encode($this->callback);
      'data' => json_encode($this->data);
    );
    
    if ($this->id === null) {
      //Insert new row
      $this->id = $this->ci->timer_model->insertTimer($data);
    } else {
      //Update old row
      $this->ci->timer_model->updateTimer($this->id, $data);
    }
  }
  public function loadData() {
    //Load or refresh this timer with the information in the database
    $this->ci->load->model('timer_model');
    
    if ($this->id === null) {
      throw new Exception('Can not load timer without ID set');
    }
    
    $data = $this->ci->timer_model->getTimer($id);
    $this->startTime = new DateTime($data['startTime']);
    $this->endTime = new DateTime($data['endTime']);
    $this->callback = json_decode($data['callback'], true);
    $this->data = json_decode($data['data'], true);
  }
  
  public static function getExpiredTimers() {
    //Get a list of all expired timers from the database
    $this->ci->load->model('timer_model');
    $expired = $this->ci->timer_model->getExpiredTimers();
    
    //Create return the list of Timer ID numbers
    return $expired;
  }
  
  public static function performExpiredTimers() {
    //Get most recently expired timers
    $this->ci->load->model('timer_model');
    $expired = $this->ci->timer_model->getNewestExpiredTimer();
    
    //If there are none, return
    if ($expired === null) {
      return;
    }
    
    //Create a timer object for that timer
    $timer = new Timer($expired);
    
    //Perform timer's callback
    $timer->performCallback();
    
    //self::performExpiredTimers();
    self::performExpiredTimers();
  }
}