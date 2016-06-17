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
require '../install/pis.php'; 

class MyInstaller extends PIS {
function page_welcome(){	
$this->title("(1/13)  Welcome / Vítejte");
$this->message('<strong>Welcome to the installation of Dictionary system 1.0.</strong>');
$this->message('The Dictionary System provides  '.
'a flexible framework for development of bilingual '.
'dictionary with support for online team work. ');
 $this->message('For more information about the '.
'Dictionary System and installation process, check out '.
 '<a href="http://www.ds.hvalur.org">web pages</a>.');
 $this->message('The next couple of pages will guide you '.
'through the installation process. Please select a language of installation and press button Další / Next');
$this->message('<br><strong>Vítejte v instalaci Dictionary System 1.0 </strong>');
 $this->message('Aplikace Dictionary System poskytuje prostředí pro tvorbu dvojjazyčných slovníku s podporou týmové spolupráce.');
 $this->message('Na <a href="http://www.ds.hvalur.org">webových stránkách aplikace</a>. se můžete dozvědět více o samotné aplikaci a instalačním procesu.');
 $this->message('Následující stránky Vás provedou instalací aplikace. Prosím zvolte jazyk instalace a pokračujte tlačítkem Další / Next.');
 $this->input('select','lang',array(
 'required' => true,
 'label' => 'Jazyk instalace / Language of installation',
'options' => array('English'=>'en','Česky'=>'cz')
 ));
  }
function page_license(){
  if ($this->get(lang)=='cz'){
 $_SESSION["lang_install"]='cz';  
 } else {
 $_SESSION["lang_install"]='en';  	  
}
$dir  = "../language/";
$dir_path = $dir.$_SESSION["lang_install"]."/lang_install.php";
include ($dir_path);
$this->title("(2/13) ".$lang_install_licence1." ");   
if ($this->get(lang)=='cz'){
$this->input('agreement','agreement',array('required'=>true,'file'=>'gpl_cz.txt')); 
} else {
 $this->input('agreement','agreement',array('required'=>true,'file'=>'gpl.txt'));	  
} 
}

function page_chmod () {

 $dir  = "../language/";
$dir_path = $dir.$_SESSION["lang_install"]."/lang_install.php";
include ($dir_path);

$this->title("(3/13)  ".$lang_install_writable3."");
$this->message($lang_install_writable4);
$this->message( '<br>');
$realpath= realpath(dirname('../connection.php'));
$importpath=$realpath.'/tmp';
$this->message( $importpath);
if (is_writable($importpath)===TRUE) {
$this->message( '<strong> '.$lang_install_writable1.'</strong>.');
} else {
$this->message( $lang_install_writable2);	
}
$this->message( '<br>');
$importpath=$realpath.'/backup';
$this->message( $importpath);
if (is_writable($importpath)===TRUE) {
$this->message( '<strong>'.$lang_install_writable1.'</strong>.');
} else {
$this->message( $lang_install_writable2);	
}
$this->message( '<br>');
$importpath=$realpath.'/audio/uploaded_files';
$this->message( $importpath);
if (is_writable($importpath)===TRUE) {
$this->message( '<strong>'.$lang_install_writable1.'</strong>.');
} else {
$this->message( $lang_install_writable2);	
}
$this->message( '<br>');
$importpath=$realpath.'/images/uploaded_files';
$this->message( $importpath);
if (is_writable($importpath)===TRUE) {
$this->message( '<strong>'.$lang_install_writable1.'</strong>.');
} else {
$this->message( $lang_install_writable2);	
}
$this->message( '<br>');
$importpath=$realpath.'/connection.php';
$this->message( $importpath);
if (is_writable($importpath)===TRUE) {
$this->message( '<strong>'.$lang_install_writable1.'</strong>.');
} else {
$this->message( $lang_install_writable2);	
}
$this->message( '<br>');
$importpath=$realpath.'/import/tmp';
$this->message( $importpath);
if (is_writable($importpath)===TRUE) {
$this->message( '<strong>'.$lang_install_writable1.'</strong>.');
} else {
$this->message( $lang_install_writable2);	
}
$this->message( '<br>');
$importpath=$realpath.'/import/uploads';
$this->message( $importpath);
if (is_writable($importpath)===TRUE) {
$this->message( '<strong>'.$lang_install_writable1.'</strong>.');
} else {
$this->message( $lang_install_writable2);	
}
}
 function page_config(){
 $dir  = "../language/";
$dir_path = $dir.$_SESSION["lang_install"]."/lang_install.php";
include ($dir_path);
 $this->title("(3/13)  ".$lang_install_mysql1."");
$this->message($lang_install_mysql2);
$this->input('text','db_host',array(
 'required' => true,
 'label' => $lang_install_mysql3,
 'size' => 25,
 ));
 $this->input('text','db_user',array(
'required' => true,
'label' => $lang_install_mysql5,
'size' => 25,
));
$this->input('password','db_pass',array(
'required' => false,
'label' => $lang_install_mysql6,
'size' => 25,
));
$this->input('text','db_name',array(
'required' => true,
'label' => $lang_install_mysql7,
'size' => 25,
));
}
function page_check_connection(){
$dir  = "../language/";
$dir_path = $dir.$_SESSION["lang_install"]."/lang_install.php";
include ($dir_path);
$this->title("(4/13) ".$lang_install_mysql8);
$this->message($lang_install_mysql15);
// we try to establish the link to database and check the connection status
$link = mysql_connect(($this->get(db_host)),($this->get(db_user)),($this->get(db_pass)));
$db = mysql_select_db(($this->get(db_name)));
if (!$link) {
$this->message('<strong> ***** '.$lang_install_mysql9.' ***** </strong>');
} else {
$this->message('<strong> ***** '.$lang_install_mysql10.' ***** </strong>');
}
if (!$db) {
$this->message('<strong> ***** '.$lang_install_mysql11.' ***** </strong>');
} else {
$this->message('<strong> ***** '.$lang_install_mysql12.' ***** </strong>');
}
if ((!$db) OR (!$link)) {
$this->message (''.$lang_install_mysql13.' ');
} else {
$this->message (''.$lang_install_mysql14.'');
}
}
function page_config2(){
$dir  = "../language/";
$dir_path = $dir.$_SESSION["lang_install"]."/lang_install.php";
include ($dir_path);
$this->title("(5/13) ".$lang_install_mail1);
$this->message($lang_install_mail2);
$this->input('text','mail_host',array(
'required' => false,
'label' => $lang_install_mail3,
'size' => 25,
'help' => $lang_install_mail9,
));
$this->input('text','mail_user',array(
'required' => false,
'label' => $lang_install_mail4,
'size' => 25,
));
$this->input('password','mail_password',array(
'required' => false,
'label' => $lang_install_mail5,
'size' => 25,
));
$this->message('<br><br> '.$lang_install_mail8);
$this->input('text','mail_admin',array(
'required' => true,
'label' => $lang_install_mail6,
'size' => 25,
));
$this->input('text','mail_admin_name',array(
'required' => true,
'label' => $lang_install_mail7,
'size' => 25,
 'help' => $lang_install_mail11
));
 $this->message ($lang_install_mail10);
}
function page_config3(){
$dir  = "../language/";
$dir_path = $dir.$_SESSION["lang_install"]."/lang_install.php";
include ($dir_path);
$this->title("(6/13) ".$lang_install_ftp1);
$this->message($lang_install_ftp2);
$this->input('text','ftp_user_name',array(
'required' => false,
'label' => $lang_install_ftp3,
'size' => 25,
));
$this->input('password','ftp_user_pass',array(
'required' => false,
'label' => $lang_install_ftp4,
'size' => 25,
));
$this->input('text','ftp_server',array(
'required' => false,
'label' => $lang_install_ftp5,
'size' => 25,
'help' => $lang_install_ftp6
));
$this->input('text','backup_path',array(
'required' => false,
'label' => $lang_install_ftp7,
'size' => 25,
'help' => $lang_install_ftp8
));
$this->input('text','server_file',array(
'required' => false,
'label' => $lang_install_ftp9,
'size' => 25,
'help' => $lang_install_ftp10
));
$this->message ($lang_install_ftp11);
}
function page_installation(){
$dir  = "../language/";
$dir_path = $dir.$_SESSION["lang_install"]."/lang_install.php";
include ($dir_path);
$this->title("(7/13) ".$lang_install_write1);  
$this->message($lang_install_write2."<br>");
$link = mysql_connect(($this->get(db_host)),($this->get(db_user)),($this->get(db_pass)));
$db = mysql_select_db(($this->get(db_name))); 

include 'install_fwrite.php';
$this->message ($lang_install_write3); 
$this->message ('<br><br>'.$lang_install_write4); 
}
function page_installation2(){
$dir  = "../language/";
$dir_path = $dir.$_SESSION["lang_install"]."/lang_install.php";
include ($dir_path);
$this->title("(8/13) ".$lang_install_create1);
$this->message ($lang_install_mysql17);
$add= "<a href= \"bigdump.php\" onclick= \"return popitup('bigdump.php') \"> ".$lang_install_mysql16."</a>";
$this->message("<br>".$add."<br>");
}
function  page_installation3(){
$dir  = "../language/";
$dir_path = $dir.$_SESSION["lang_install"]."/lang_install.php";
include ($dir_path);
$this->title("(9/13) ".$lang_install_admin1);
$this->message($lang_install_admin2);
$this->input('text','n_admin',array(
'required' => true,
'label' => $lang_install_admin3,
'size' => 25,
));
$this->input('password','admin_password',array(
'required' => true,
'label' => $lang_install_admin4,
'size' => 25,
));
$this->input('password','admin_password2',array(
'required' => true,
'label' => $lang_install_admin5,
'size' => 25,
'help' => $lang_install_admin7
));
 $this->input('text','email',array(
'required' => true,
'label' => $lang_install_admin6,
'size' => 25,
));
}
function page_finishinfo1(){	
$dir  = "../language/";
$dir_path = $dir.$_SESSION["lang_install"]."/lang_install.php";
include ($dir_path);
$this->title("(10/13) ".$lang_install_admin8);
if (($this->get(admin_password))!= ($this->get(admin_password2))) {
$this->message(' <strong> ***** '.$lang_install_admin9.' ***** </strong>');
} 
if ((strlen($this->get(admin_password)))<=5){
$this->message(' <strong>***** '.$lang_install_admin10.' ***** </strong>');
}
include 'install_save1.php';
$this->message($lang_install_admin11);
 $this->message($lang_install_admin12);
}
function page_settings(){
$dir  = "../language/";
$dir_path = $dir.$_SESSION["lang_install"]."/lang_install.php";
include ($dir_path);
 $this->title("(11/13) ".$lang_install_admin13);
$this->message($lang_install_admin14);
 $this->input('password','d_password',array(
'required' => true,
'label' => $lang_install_admin15,
'size' => 25,
));
 $this->input('password','d_password2',array(
'required' => true,
'label' => $lang_install_admin16,
'size' => 25,
 ));
}
function page_finishinfo2(){	
$dir  = "../language/";
$dir_path = $dir.$_SESSION["lang_install"]."/lang_install.php";
include ($dir_path);
$this->title("(12/13) ".$lang_install_admin18);
if (($this->get(d_password))!= ($this->get(d_password2))) {
 $this->message('<strong> ***** '.$lang_install_admin9.' ***** </strong>');
} 
if ((strlen($this->get(d_password)))<=5){
$this->message('<strong> ***** '.$lang_install_admin10.' ***** </strong>');
}
include 'install_save2.php';
$this->message('<strong>'.$lang_install_admin11.' </strong>');
$this->message($lang_install_admin22);
}
function page_finish(){
 $dir  = "../language/";
$dir_path = $dir.$_SESSION["lang_install"]."/lang_install.php";
include ($dir_path);
$this->title("(13/13) ".$lang_install_admin23);
$this->message($lang_install_admin24);
$this->message('<a href="../index.php">'.$lang_install_admin25.'</a>');
}
}
$installer = new MyInstaller('Instalace / Installation - Dictionary System');
?><?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $installer->title; ?></title>
<style type="text/css">
/* default style */
body {font-family: "Trebuchet MS", Verdana, Arial, sans-serif; font-size: 12px;}
label {width: 300px; float: left; text-align: right; margin-right: 5px; font-family: verdana; }
label.required {font-weight: bold; font-style: normal;}
h1 {width: 800px; text-align: left; font-family: "Trebuchet MS", Verdana, Arial, sans-serif; font-size: 16px; margin: 10% 0px 0px 0px; background-color: #fff; padding: 3px; color: #B7271F;}
h2 {border-bottom: 1px solid black; margin: 0px 10px 0px 10px; }
input, textarea, select { border: 1px solid black; float: left; }
hr {border:1px solid black;}
.message { margin-bottom: 10px;}
#page {background-color: #fff; width: 700px; text-align:left; padding: 3px; padding-top: 10px; }
#main {padding: 10px; }
#navigation {border-top: 1px solid black; margin: 5px 10px 0px 10px; padding: 5px;}
#navigation input {float: right; margin-left: 10px;}
#footer {padding: 3px; width: 700px; text-align: center; font-size: 0.7em; color: #AAAAAA; border-top: 1px dotted #B7271F; margin-top: 40px;}
.error,
.field .error { color: red; font-weight: bold; font-size: 0.8em; }
.field .error { display: inline; margin-left: 10px; }
.field { margin-top: 10px;}
.help {padding:2px; float: left; font-weight: bold; margin-left: 10px; }
</style>
<script type="text/javascript">	
function popitup(url) {
newwindow=window.open(url,'name','height=450,width=850, scrollbars=yes');
if (window.focus) {newwindow.focus()}
return false;
}
</script>
</head>
<body>
<div align="center">
<?php  $installer->run(); ?>
</div>
</body>
</html>