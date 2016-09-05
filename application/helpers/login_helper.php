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