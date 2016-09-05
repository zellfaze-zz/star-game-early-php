<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_timer_tables extends CI_Migration {

  public function up() {
    //Create settlements table
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 5,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'size' => array(
        'type' => 'DATETIME',
      ),
      'owner_id' => array (
        'type' => 'DATETIME',
      ),
      'callback' => array(
        'type' => 'TEXT'
      ),
      'data' => array(
        'type' => 'TEXT',
      ),
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('timers');
    
  }

  public function down() {
    $this->dbforge->drop_table('timers');
  }
}