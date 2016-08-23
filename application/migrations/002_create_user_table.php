<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_user_table extends CI_Migration {

  public function up() {
    //Create map table
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 5,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'username' => array(
        'type' => 'VARCHAR',
        'constraint' => 64,
      ),
      'password' => array(
        'type' => 'VARCHAR',
        'constraint' => 256,
      ),
      'is_admin' => array(
        'type' => 'BOOL',
      ),
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('users');
    
  }

  public function down() {
    $this->dbforge->drop_table('users');
  }
}