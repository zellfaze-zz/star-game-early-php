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