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
$table= 'ds_users';
$sql = sprintf ('SELECT * FROM `%s`',
		$table);
$oop472->query($sql);
$num2 = $oop472->getNumrows(); 
$oop472->freeResult();
$rights=1;
$pass_admin=sha1($this->get(admin_password));
$first='5895623569874589';
if ($num2!=0) {
$sql = sprintf ('UPDATE  `%s` SET `id_user` = %s, `nick` = %s, `password` = %s, `email` = %s,  `rights` = %s, `first_login_password` = %s',
	$table,
	quate_smart($rights),
	quate_smart($this->get(n_admin)),
	quate_smart($pass_admin),
	quate_smart($this->get(email)),
	quate_smart($rights),
	quate_smart($first));
$oop472->query($sql);
$error = $oop472->getMysqlError();
} else {
// we search if ip is not between banned ip addressess
$sql = sprintf ('INSERT INTO `%s` (`id_user`, `nick`, `password`, `email`, `rights`, `first_login_password`) VALUES (NULL, %s, %s, %s, %s, %s)',
	$table,
	quate_smart($this->get(n_admin)),
	quate_smart($pass_admin),
	quate_smart($this->get(email)),
	quate_smart($rights),
	quate_smart($first));
$oop472->query($sql);
$error = $oop472->getMysqlError();
}
$oop472->freeResult();
$oop472->_mySQL; 
?>
