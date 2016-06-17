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
if ($_GET["action"]=='confirm') {
include './images/securimage/securimage.php';
$securimage = new Securimage();
if ($securimage->check($_POST['captcha_code']) == false) {
$_SESSION["ses_message"] = $lang_lost_password_wrong_answer;
header("Location: lost_pp.php");
$correct=FALSE;
Die();
} else {
function generatePassword($length=9, $strength=0) {
$vowels = 'aeuy';
$consonants = 'bdghjmnpqrstvz';
if ($strength & 1) {
$consonants .= 'BDGHJLMNPQRSTVWXZ';
}
if ($strength & 2) {
$vowels .= "AEUY";
}
if ($strength & 4) {
$consonants .= '23456789';
}
if ($strength & 8) {
$consonants .= '@#$%';
}
$password = '';
$alt = time() % 2;
for ($i = 0; $i < $length; $i++) {
if ($alt == 1) {
$password .= $consonants[(rand() % strlen($consonants))];
$alt = 0;
} else {
$password .= $vowels[(rand() % strlen($vowels))];
$alt = 1;
}
}
return $password;
}
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table=  'ds_users';
$sql = sprintf ('SELECT * FROM `%s` WHERE `nick` = %s AND `email` = %s',			
	$table,
	quate_smart($_POST["pp_nick"]),
	quate_smart($_POST["pp_email"]));
$oop->Setnames();
$oop->query($sql);		
$row = $oop->fetchArray();
$num2 = $oop->getNumRows();
$oop->freeResult();
//if a user with the same username is returned we redirect the users to a previously created error page
if ($num2!=1) {
$_SESSION["ses_message"] = $lang_lost_password_wrong_pass;
header("Location: index.php");
$correct=FALSE;
Die();
} else {
$pp_password=generatePassword(6,4);
$pp_password_en=sha1($pp_password); 
// we encrypt the passwotd with md5 function
$table=  'ds_users';
$sql = sprintf ('UPDATE `%s` SET `password` = %s WHERE `nick` = %s AND `email` = %s',
	$table,
	quate_smart($pp_password_en),
	quate_smart($_POST["pp_nick"]),
	quate_smart($_POST["pp_email"]));
$oop->Setnames();
$result2 = $oop->query($sql);
$oop->freeResult();
$oop->_mySQL; 	
$_SESSION["ses_message"] = $lang_lost_password_correct_mess;
$ip=$_POST["pp_nick"];
$page_id=535; 
include './work.php'; 
// we send email with a special number for the first login in, 
// we check whether it was a correct email
require("./scripts/PHPMailer_v5.0.0/class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP();  // set mailer to use SMTP

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
$mail->AddAddress(trim($_POST["pp_email"]), trim($_POST["pp_nick"]));
$mail->WordWrap = 50;      // set word wrap to 50 characters
$mail->IsHTML(true);       // set email format to HTML
$mail->Subject = $lang_lost_password_email_subject;
$mail->Body    = $lang_lost_password_correct1." ".$_POST["pp_nick"]." <br> ".$lang_lost_password_correct2." <strong>".$pp_password."</strong> <br><br> ".$lang_lost_password_correct3;
$mail->AltBody = $lang_lost_password_correct1." ".$_POST["pp_nick"]." <br> ".$lang_lost_password_correct2." ".$pp_password." ".$lang_lost_password_correct3;
if(!$mail->Send())
{
$_SESSION["ses_message"] .= $lang_mail1 . $mail->ErrorInfo;
$_SESSION["ses_message"] .= "<br> ".$lang_mail2;
header("Location: index.php");
Die ();
}
header("Location: index.php");
}
$oop->_mySQL; 	
}
} else {
?>
<?php
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
<h2><?=$lang_mail3?></h2>
<form action="lost_pp.php?action=confirm" method="post">
<table class="sample">
<tr><td><strong> <?=$lang_reg_required?></strong></td> <td> </td> </tr>
<tr>
<td width="300"><?=$lang_reg_user?></td>
<td width="300" > <input type="text" class="inputbox" name="pp_nick" size="20"> * </td>
</tr>
<tr>
<td><?=$lang_lost_password_email?>  </td>
<td><input type="text" class="inputbox" name="pp_email" size="20"> *</td>
</tr>
<tr>
<td><img id="captcha" src="images/securimage/securimage_show.php" alt="CAPTCHA Image"> </td>
<td> <input type="text" name="captcha_code" size="20" maxlength="6"> *</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>
<a href="#" onclick="document.getElementById('captcha').src = 'images/securimage/securimage_show.php?' + Math.random(); return false"><?=$lang_menu_reload?></a>
</td></tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit" class="button2" value="<?=$lang_mail4?>" name="submit"></td>
</tr>
</table>
</form>
<br>
<?=$lang_lost_password_info?>  
<br>
</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div>
</div>
<?php } ?>
<?php 
include ('./html_end.php');
?>