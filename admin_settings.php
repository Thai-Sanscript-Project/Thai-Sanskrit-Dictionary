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
ini_set('arg_separator.output','&amp;');
include 'start.php';
include './scripts/redirect_admin.php';
include './head.php';
?>
<body onload="setfocus ()">
<div id="wrapper">
<?php include 'header.php';
include 'menu.php'; 
echo $MAIN_MENU;
?>
<div id="content">
<div class="left_huge">
<h2><?=$lang_admin1?></h2>
<?php 
if ($_GET["action"]=='change_password') {
?>
<h4><?=$lang_admin2?></h4>
<form action="admin_settings.php?action=change_password_confirm" method="post" name="form1">
<table  border="0">
<tr> <td> <?=$lang_admin_type?></td> <td><input type="password"  name="password1" class="inputbox search" value="" size="40" maxlength="70">
</td>
</tr>
<tr> <td> <?=$lang_admin_retype?></td> <td><input type="password"  name="password2" class="inputbox search" value="" size="40" maxlength="70">
</td>
</tr>
<tr>
<td>
</td>
<td> 
<input type="submit" class="button2" name="submit" value="<?=$lang_admin_button?>">
</td>
</tr>
</table>
</form>  
<?php
} else if ($_GET["action"]=='change_password_confirm') {
// passwords dont match
if ($_POST["password1"]!=$_POST["password1"]) {
$_SESSION["ses_message"] = $lang_admin_password_not_match;
header("Location: admin_settings.php");
Die();
} else {
$min_lenngth = 6;
// password too short
if(strlen($_POST["password1"]) <= $min_lenngth) {
$_SESSION["ses_message"] = $lang_admin_password_too_short;
header("Location: admin_settings.php");
Die();
} else {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 	
$d_password = sha1(trim($_POST["password1"]));		 
$table=  'ds_settings';
$sql = sprintf ('UPDATE `%s` SET `d_password` = %s',			
	$table,
	quate_smart($d_password));
$oop->Setnames();
$oop->query($sql);		
$oop->freeResult();		
$oop->_mySQL; 
$page_id=501; 
include './work.php'; }
$_SESSION["ses_message"] = $lang_admin_password_changed;
header("Location: admin_settings.php");		 
}
}  else if ($_GET["action"]=='prepare_email') {
?>
<h4><?=$lang_admin3?></h4>
<form action="admin_settings.php?action=send_email" method="post" name="form1">
<table  border="0">
<tr> <td> <?=$lang_admin_m1?></td> <td><input type="text" name="mail_subject" class="inputbox search" value="" size="40" maxlength="70">
</td>
</tr>
<tr> <td> <?=$lang_admin_m2?></td> <td><textarea name="mail_body" id="mail_body" class="inputbox" rows="6" cols="80"></textarea>
</td>
</tr>
<tr>
<td>
</td>
<td> 
<input type="submit" class="button2" name="submit" value="<?=$lang_admin_button?>">
</td>
</tr>
</table>
</form>  
<?php
} else  if ($_GET["action"]=='send_email') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 	
$table=  'ds_users';
$admin_email=1;
$sql = sprintf ('SELECT `rights`,`email` FROM `%s',			
	$table,
	quate_smart($admin_email));
$oop->Setnames();
$oop->query($sql);	
require("./scripts/PHPMailer_v5.0.0/class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP();                                      // set mailer to use SMTP
$mail->SMTPAuth = true;     // turn on SMTP authentication
$pos = strpos($mail_host, 'gmail'); // if gmail -> secure connection required
if ($pos!==FALSE) {
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Port = 465; 	
}
$mail->Host = $mail_host;  // specify main and backup server
$mail->Username = $mail_user;  // SMTP username
$mail->Password = $mail_password; // SMTP password
$mail->CharSet = 'UTF-8';
$mail->From = $mail_user;
$mail->FromName = $mail_admin_name;
$rr=0;
while ($returned_email=$oop->fetchRow()):
if ($rr==0) {
$mail->AddAddress(trim($returned_email[1]));
} else {
$mail->AddReplyTo(trim($returned_email[1]));
}
$rr++;
endwhile;
$mail->WordWrap = 50;                             
$mail->IsHTML(true);
$mail->Subject = $_POST["mail_subject"];
$mail->Body    = $_POST["mail_body"];
$mail->AltBody = $_POST["mail_body"];
if(!$mail->Send()) {
echo $lang_admin_mail_error1;
echo $lang_admin_mail_error1. $mail->ErrorInfo;
$_SESSION["ses_message"] .=$lang_admin_mail_error3 . $mail->ErrorInfo;
}
$page_id=538; 
include './work.php'; 
$_SESSION["ses_message"] .= $lang_admin_email_sent;
$oop->freeResult();
$oop->_mySQL;
header('Location: ./admin_settings.php'); 
} else {
if ($_SESSION["rights"]==1) { ?>
<h4><?=$lang_admin3?></h4><br>
<a href="./admin_settings.php?action=prepare_email"><?=$lang_admin_email?></a> <br><br>
<h4><?=$lang_admin2?></h4><br>
<a href="./admin_settings.php?action=change_password"><?=$lang_admin_change_password?></a><br><?=$lang_admin_change_password_info?><br>
<h4><?=$lang_admin4?></h4><br>
<a href ="./dev_info.php"><?=$lang_admin_dev_info?></a> <br>
<a href="./message.php?action=add"><?=$lang_admin_admin_message?></a> <br>
<a href="./todo.php?action=add"><?=$lang_admin_todo_event?></a> <br>
<?php 
}  } ?>
</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div></div><?php 
include ('./html_end.php');
?>