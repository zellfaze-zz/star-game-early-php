<?php

function redirectLogin($id = null) {
  if (!isset($_SESSION['id'])) {
    redirect('login');  
  }
  
  if ($id !== null) {
    if ((int)$_SESSION['id'] !== $id) {
      redirect('login');
    }
  }
}