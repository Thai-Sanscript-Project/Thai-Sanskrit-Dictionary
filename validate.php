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
session_start(); 
ob_start();   
include './scripts/mysqlclass.php';
include './scripts/query_function.php';
$dir  = "./language/";
$dir_path = $dir.$_SESSION["lang"]."/language.php";
include ($dir_path);
$password=stripslashes($_POST["pp"]);
$password = sha1($password);
$nick=stripslashes($_POST["nn"]);
include './connection.php'; 
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$table= 'ds_users';
$sql = sprintf ('SELECT * FROM `%s` WHERE `nick`=%s AND `password`=%s',
	$table,
	quate_smart($nick),			
	quate_smart($password));
$oop->Setnames();
$oop->query($sql);
$num2 = $oop->getNumRows();
$row = $oop->fetchRow ();
$oop->freeResult();
if ($num2!=0) {
$ip=getRealIpAddr();
// we search if ip is not between banned ip addressess
$table= 'ban_ip';
$sql2 = sprintf ('SELECT `id` FROM `%s` WHERE `ip`= %s',
	$table,
	quate_smart($ip));
$oop->query($sql2);
$num3 = $oop->getNumRows();
$oop->freeResult();
$table= 'ban_ip2';
$sql2 = sprintf ('SELECT `id` FROM `%s` WHERE `ip`= %s',
	$table,
	quate_smart($ip));
$oop->query($sql2);
$num4 = $oop->getNumRows();
$oop->freeResult();
if (($num3==0) AND ($num4==0)) {
$first_login=FALSE;
if (isset($_POST["first_login_password"])) {
if (trim($_POST["first_login_password"])=='5895623569874589') {
// user first login, correct number that was sent to him by email
// set number to user database, next time only check if there is the number
$oop6 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 		
$table= 'ds_users';
$sql6 = sprintf ('UPDATE `%s` SET `first_login_password`= %s  WHERE `id_user`= %s',
	$table,
	quate_smart(trim($_POST["first_login_password"])),			
	quate_smart($row[0]));
$oop6->Setnames();
$oop6->query($sql6);
$oop6->freeResult();
$oop6->_mySQL;
$_SESSION["ses_message"] .= $lang_validate1;
$first_login_password=trim($_POST["first_login_password"]);
$first_login=TRUE;
}		
}
if ($first_login!==TRUE) {
$first_login_password=$row[18];
}
if (trim($first_login_password)!='5895623569874589') {
$_SESSION["ses_message"] .= $lang_validate2;	
 header('Location: ./login.php?first_login=TRUE');
} else {
/* access granted */
// creation of history of tabs of user
$id_user = $row[0];
// security condition
if (($id_user!='0') 	AND ($id_user!=0) AND (isset($id_user))) {
$oop->freeResult();
// for the time beign = just one project / just one db_prefix
header("Cache-control: private");
for ($i = 0; $i <= 7; $i++) {
for ($ee = 1; $ee <= 2; $ee++) {
$_SESSION["result_list"][$i][$ee] = '';
}  }
$_SESSION["id_user"] = $id_user;
$_SESSION["check"]='5895623569874589';
$_SESSION["rights"]=$row[4];
$_SESSION["login"]= 'true';
if ($row[20]!="") {
$_SESSION["lang"] = $row[20];
}
$oop->_mySQL;
$page_id=25; 
include './work.php'; 
// we redirect either to the previous headword or new searchpage
$_SESSION["ses_message"] .= $lang_validate3;
if(isset($_COOKIE["d_h_cookie"])) {
header('Location: ./search.php?list_kind=alpha&d_h='.$_COOKIE["d_h_cookie"].'&d_h_n='.$_COOKIE["d_h_n_cookie"].'');
} else {
header('Location: ./search.php?list_kind=alpha');        
}
} else 
{ 
Die();
}
}
} else {  
// we check whether someone can get to this place without password	
$table='ds_spam_notice';
// we save to database the attempts
$sql = sprintf ('INSERT INTO `%s` (`id`, `ip`, `date`, `nick`, `password`) VALUES (NULL, %s, %s, %s, %s)',
	$table,					
	quate_smart($ip),
	quate_smart(date("Y-m-d H:i:s")),
	quate_smart($nick),
	quate_smart($password));	
$oop->query($sql);
$oop->freeResult();
$oop->_mySQL;
Die();
}
} else {
  /* access denied ? redirect back to login */
$_SESSION["ses_message"] .= $lang_validate4;
header("Location: login.php");
}
?>  
