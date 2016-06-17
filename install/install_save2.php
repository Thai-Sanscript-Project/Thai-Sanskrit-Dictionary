<?php
//===================================================================================
// Dictionary system. Web-based application for development of bilingual dictionaries
// Version: 1.0
// Copyright (c) Ales Chejn, hvalur.org 2011
// All rights reserved
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
//
// For support contact us at www.hvalur.org
//===================================================================================
//include '../connection.php';
include '../connection.php';
include '../scripts/mysqlclass.php';
include '../scripts/query_function.php';
$oop472 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$table= 'ds_settings';
$pass_admin=sha1($this->get(d_password));
// we add the project  password
// we search if ip is not between banned ip addressess
$sql = sprintf ('INSERT INTO `%s` (`d_password`) VALUES (%s)',
	$table,
	quate_smart($pass_admin));
$oop472->query($sql);
$oop472->freeResult();
$oop472->_mySQL; 
?>
