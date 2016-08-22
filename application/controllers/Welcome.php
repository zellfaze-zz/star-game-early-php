<?php

class Welcome extends CI_Controller {
  public function __construct() {
    parent::__construct();
    
    require_once('application/third_party/load.php');
  }
  
  public function index() {
    echo 'Index page';
  }
}