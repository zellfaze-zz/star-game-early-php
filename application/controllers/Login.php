<?php

class Login extends CI_Controller {
  public function __construct() {
    parent::__construct();
    
    require_once('application/third_party/load.php');
    $this->load->model('user_model');
  }
  
  public function index() {
    if (!$this->user_model->rootExists()) {
      redirect('login/registerroot');
    }
    
    $data = array();
    if ($this->session->flashdata('error')) {
      $data['error'] = $this->session->flashdata('error');
    }
    
    $this->load->view('login', $data);
  }
  
  public function registerroot() {
    if ($this->user_model->rootExists()) {
      redirect('login/');
    }
    
    $this->load->view('registerroot');
  }
  
  public function createroot() {
    if ($this->user_model->rootExists()) {
      redirect('login/');
    }
    
    $this->user_model->createUser('root', $this->input->post('password'));
    $this->user_model->makeAdmin(1);
    
    redirect('login/');
  }
  
  public function logout() {
    session_destroy();
    redirect('login/');
  }
  
  public function check() {
    if ($this->input->post('register') !== null) {
      if ($this->input->post('username') === null) {
        $this->session->set_flashdata('error', 'You have to specify a username');
        redirect('login/');
      }
      
      if ($this->input->post('password') === null) {
        $this->session->set_flashdata('error', 'You have to specify a password');
        redirect('login/');
      }
      
      if ($this->user_model->userExists($this->input->post('username'))) {
        $this->session->set_flashdata('error', 'That username is already taken');
        redirect('login/');
      }
      
      $userID = $this->user_model->createUser($this->input->post('username'), $this->input->post('password'));
      $_SESSION['id'] = $userID;
      redirect('welcome/');
    } else {
      $userID = $this->user_model->checkLogin($this->input->post('username'), $this->input->post('password'));
      
      if ($userID !== false) {
        $_SESSION['id'] = $userID;
        redirect('welcome/');
      } else {
        $this->session->set_flashdata('error', 'Username or Password is wrong!');
        redirect('login/');
      }
    }
  }
}