<?php

function redirectLogin($id = null) {
  if (!isset($_SESSION['id'])) {
    redirect('login');  
  }
  
  if ($id !== null) {
    if ((int)$_SESSION['id'] !== $id) {
      show_error('You do not have permission to view this page.', 403, '403 Forbidden');
      //redirect('login');
    }
  }
}