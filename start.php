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
include './connection.php';
include './scripts/mysqlclass.php';
include './scripts/query_function.php';
// we find the ip address
$ip=getRealIpAddr();
// check if session ip_welcome is set if not search in ban ip database
if(!isset($_SESSION["ip_welcome"])) {
$num4=1;
$oop_start = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
// we search if ip is not between banned ip addressess
$table= 'ban_ip';
$sql2 = sprintf ('SELECT * FROM `%s` WHERE `ip`= %s',
	$table,
	quate_smart($ip));
$oop_start->query($sql2);
$num4 = $oop_start->getNumRows();
$oop_start->freeResult();
if ($num4==0) {
$oo_welcome=TRUE;
$_SESSION["ip_welcome"]=$ip;
} else {  
// we check whether some spammers got here	
$table='ds_spam_notice';
// we save to database the attempts
$sql = sprintf ('INSERT INTO `%s` (`id`, `ip`, `date`) VALUES (NULL, %s, %s)',
	$table,					
	quate_smart($ip),
	quate_smart(date("Y-m-d H:i:s")));	
$oop_start->query($sql);
$oop_start->freeResult();
$oo_welcome=FALSE;
Die();
}
} else if ($_SESSION["ip_welcome"]!=$ip) {
$oo_welcome=FALSE;
Die();
}
// language change
if ($_GET["lang"]) {
$_SESSION["lang"]=$_GET["lang"];
setcookie("language",$_GET["lang"], time()+604800);
}
// we use coookie language to store the language settings from previous visit
if (!isset($_SESSION["lang"])) {
if(isset($_COOKIE["language"]))    {
$_SESSION["lang"]= $_COOKIE["language"];
}
else
{
$_SESSION["lang"]='cz';
setcookie("language", "cz", time()+604800);
}
}
if (!isset($_SESSION["rights"])) {
$_SESSION["rights"]=3;	}
// language directory
$dir  = "./language/";
$dir_path = $dir.$_SESSION["lang"]."/language.php";
include ($dir_path);
if ($_SESSION["login"]=='true') {
$dir_path = $dir.$_SESSION["lang"]."/lang_program.php";
include ($dir_path);	
}
?>
