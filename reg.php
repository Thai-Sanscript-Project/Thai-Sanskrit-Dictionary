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
header("Location: reg.php");
$correct=FALSE;
Die();
} else {	
//PASSWORD VERIFICATION
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table=  'ds_settings';
// we checked the project password
$sql = sprintf ('SELECT `d_password` FROM `%s`',			
		        $table);
$oop->Setnames();
$oop->query($sql);		
$row = $oop->fetchArray();
$d_password = sha1($_POST["d_password"]);
$oop->freeResult();
$correct=TRUE;
if ($d_password!=$row[0]) {
$_SESSION["ses_message"] = $lang_reg_m1;
header("Location: reg.php");
$correct=FALSE;
Die();
} else {
// project password correct begin registration
if (($_POST["password"])!=($_POST["password2"])){
$_SESSION["ses_message"] = $lang_reg_m2;
header("Location: reg.php");
$correct=FALSE;
Die();
}
//USER AND PASSWORD LENGTH CHECK
$min_lenngth = 6; 
if(strlen($_POST["nick"]) < $min_lenngth || strlen($_POST["password"]) < $min_lenngth) {
$_SESSION["ses_message"] = $lang_reg_m3;
header("Location: reg.php");
$correct=FALSE;
Die();
}
// if the user already exist
$table=  'ds_users';
$sql = sprintf ('SELECT `nick` FROM `%s` WHERE `nick` = %s',			
	$table,
	quate_smart(trim($_POST["nick"])));
$oop->Setnames();
$oop->query($sql);		
$num2 = $oop->getNumRows();
//if a user with the same username is returned we redirect the users to a previously created error page
if ($num2!=0) {
$_SESSION["ses_message"] = $lang_reg_m4;
header("Location: reg.php");
$correct=FALSE;
Die();
}
// if the email address is already associated to another account
$oop->freeResult();
$table=  'ds_users';
$sql = sprintf ('SELECT `email` FROM `%s` WHERE `email` = %s',			
	$table,
	quate_smart(trim($_POST["email"])));
$oop->Setnames();
$oop->query($sql);
$num2 = $oop->getNumRows();
if ($num2!=0) {
$_SESSION["ses_message"] = $lang_reg_m5;
header("Location: reg.php");
$correct=FALSE;
Die();		
}
if ($correct=='TRUE') {
// we encrypt the passwotd with md5 function	
$password=sha1(trim($_POST["password"]));
$nq=2;
$table=  'ds_users';
$sql = sprintf ('INSERT INTO `%s` (`id_user`, `nick`, `password`, `email`, `rights`) VALUES (NULL, %s, %s, %s, %s)',
	$table,
	quate_smart(trim($_POST["nick"])),
	quate_smart($password),
	quate_smart(trim($_POST["email"])),			
	quate_smart($nq));
$oop->Setnames();
$result2 = $oop->query($sql);
$oop->freeResult();
$_SESSION["ses_message"] = $lang_reg_m6;
$ip=$_POST["nick"];
$page_id=522; 
include './work.php'; 
// we send email with a special number for the first login in, 
require("./scripts/PHPMailer_v5.0.0/class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP();                                      // set mailer to use SMTP

$mail->SMTPAuth = true;     // turn on SMTP authentication
 $pos = strpos($mail_host, 'gmail'); // if gmail -> secure connection required
  if ($pos!==FALSE) {
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Port = 465; 	
}
$mail->CharSet = 'UTF-8';
$mail->Host = $mail_host;  // specify main and backup server
$mail->Username = $mail_user;  // SMTP username
$mail->Password = $mail_password; // SMTP password
$mail->From = $mail_user;
$mail->FromName = $mail_admin_name;
$mail->AddAddress(trim($_POST["email"]), trim($_POST["nick"]));
$mail->WordWrap = 50;                                
$mail->IsHTML(true);
$mail->Subject = $lang_reg_m7;
$mail->Body    = $lang_reg_m8." ".$IMAGE_URL." ".$lang_reg_m9." <b>5895623569874589</b> ".$lang_reg_m10."<br> ".$lang_reg_m11." <strong>".trim($_POST["nick"])."</strong>";
$mail->AltBody = $lang_reg_m8." ".$IMAGE_URL." ".$lang_reg_m9." 5895623569874589 ".$lang_reg_m10." <br>  ".$lang_reg_m11." ".trim($_POST["nick"])." ";
if(!$mail->Send())
{
$_SESSION["ses_message"] .= $lang_mail1 . $mail->ErrorInfo;
$_SESSION["ses_message"] .= "<br>".$lang_mail2;
header("Location: reg.php");
Die ();
}
$_SESSION["ses_message"] .= $lang_reg_m12;
header("Location: index.php");
} else {
$_SESSION["ses_message"] = $lang_reg_m13;
header("Location: reg.php");
Die ();
}
$oop->_mySQL; 	
} 
}} else {
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
<h2><?=$lang_reg_head?></h2>
<form action="reg.php?action=confirm" method="post">
<table class="sample">
<tr><td><strong> <?=$lang_reg_required?></strong></td> <td> </td> </tr>
<tr>
<td width="300"><?=$lang_reg_user?></td>
<td width="300" > <input type="text" class="inputbox" name="nick" size="20"> * </td>
</tr>
<tr>
<td><?=$lang_reg_password?></td>
<td><input type="password"  class="inputbox" name="password" size="20"> *</td>
</tr>
<tr>
<td><?=$lang_reg_password2?> </td>
<td><input type="password" class="inputbox" name="password2" size="20"> *</td>
</tr>
<tr>
<td><?=$lang_reg_password_admin?></td>
<td><input type="password" class="inputbox" name="d_password" size="20"> *</td>
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
<td><?=$lang_reg_email?></td>
<td><input type="text" class="inputbox" name="email" size="20"> *</td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit" class="button2" value="<?=$lang_reg_button?>" name="submit"></td> <!-- //this is the Register button. If you want your button to show another text you can change value="Register" to value="Order", value="Send" or what you prefer -->
</tr>
</table>
</form>
<br><br>
<?=$lang_reg_m14?> <?=$lang_reg_notice?> <br>
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