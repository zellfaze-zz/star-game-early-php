<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_settlement_table extends CI_Migration {

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
        'type' => 'INT',
        'unsigned' => TRUE
      ),
      'owner_id' => array (
        'type' => 'INT',
      ),
      'planet_id' => array (
        'type' => 'INT',
        'unsigned' => TRUE
      ),
      'resource_data' => array(
        'type' => 'TEXT'
      ),
      'building_data' => array(
        'type' => 'TEXT',
      ),
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('settlements');
    
  }

  public function down() {
    $this->dbforge->drop_table('settlements');
  }
}