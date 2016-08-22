<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_database extends CI_Migration {

  public function up() {
    //Create map table
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 5,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'x' => array(
        'type' => 'INT',
      ),
      'y' => array(
        'type' => 'INT',
      ),
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('map');
    
    //Create planet table
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 5,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'type' => array (
        'type' => 'VARCHAR',
        'constraint' => 32,
      ),
      'system' => array(
        'type' => 'INT',
      ),
      'position' => array(
        'type' => 'INT',
      ),
      'data' => array(
        'type' => 'TEXT',
        'null' => true,
      ),
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('celestialobjects');
  }

  public function down() {
    $this->dbforge->drop_table('map');
    $this->dbforge->drop_table('celestialobjects');
  }
}