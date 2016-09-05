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