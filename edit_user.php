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
include './scripts/redirect_public.php';
if ($_GET["action"]=='confirm') {
//PASSWORD VERIFICATION
if (($_POST["password"])!=($_POST["password2"])) 
{
$_SESSION["ses_message"]=$lang_edit_user1;
$location = 'Location: ./edit_user.php';
header($location);
Die();
}
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
if (empty ($_POST["password"])) {
$table=  'ds_users';
$sql = sprintf ('SELECT `password` FROM `%s` WHERE `id_user`=%s',
	$table,
	quate_smart($_SESSION["id_user"]));
$oop->Setnames();
$oop->query($sql);
$row= $oop->fetchArray();
$oop->freeResult();
$password=$row[0];
} 
else 
{ 
$password=sha1(trim($_POST["password"]));
}
$table=  'ds_users';
$sql = sprintf('UPDATE `%s` SET `nick` = %s, `password` = %s, `email`= %s, `name` = %s, `street` = %s, `psc`= %s, `town`= %s, `country`= %s, `timezone`= %s, `phone`= %s, `alter_phone`= %s, `msn`= %s, `icq`= %s, `alter_email`= %s, `web`= %s, `notes`= %s, `pref_lang` = %s WHERE `id_user` = %s',			
	$table,
	quate_smart($_POST["nick"]),
	quate_smart($password),
	quate_smart($_POST["email"]),
	quate_smart($_POST["name"]),
	quate_smart($_POST["street"]),
	quate_smart($_POST["psc"]),
	quate_smart($_POST["town"]),
	quate_smart($_POST["country"]),
	quate_smart($_POST["timezone"]),
	quate_smart($_POST["phone"]),
	quate_smart($_POST["alter_phone"]),
	quate_smart($_POST["msn"]),
	quate_smart($_POST["icq"]),
	quate_smart($_POST["alter_email"]),
	quate_smart($_POST["web"]),
	quate_smart($_POST["notes"]),
	quate_smart($_POST["pref_lang"]),
	quate_smart($_SESSION["id_user"]));
$oop->Setnames();
$result = $oop->query($sql);
$oop->freeResult();
$oop->_mySQL;
$ip=$_POST["nick"];
$page_id=514; 
include './work.php'; 
$h= $_SESSION["id_user"];
echo $lang_edit_user2;
$_SESSION["ses_message"].=$lang_edit_user2;
$location = 'Location: ./listofusers.php';
header($location); 
} else {
include './head.php';
?>
<body onload="setfocus ()">
<div id="wrapper">
<?php include 'header.php';
include 'menu.php';
echo $MAIN_MENU;?>
<form action="./edit_user.php?action=confirm" method="post">
<div id="content">
<div class="left_huge">
<h2><?=$lang_edituser_head?></h2>
<div class="menu_sub">
<ul>
<li><input type="submit" class="button3" name="sumbit" value="<?=$lang_edit_submit?>"></li>
<li><a href="./listofusers.php"><?=$lang_user_1?></a></li> 
</ul>
</div>
<?php
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table=  'ds_users';
$sql = sprintf ('SELECT * FROM `%s` WHERE `id_user` = %s',
	$table,
	quate_smart($_SESSION['id_user']));
$oop->Setnames();
$oop->query($sql);
$returned = $oop->fetchRow ();
?>
<table class="sample">
<tr><td><strong> <?=$lang_reg_required?></strong></td> <td><?=$lang_edituser45?> </td> </tr>
<tr>
<td><?=$lang_reg_user?> </td>  <td><?php echo $returned[1];?> 
<input type="hidden" name="nick" value="<?=$returned[1]?>">
</td> </tr>
<tr><td><?=$lang_reg_password?></td> <td><input type="password" class="inputbox" name="password" size="40" maxlength="80" value=""> *</td>
</tr>
<tr> <td>
<?=$lang_reg_password2?> </td> <td><input type="password" class="inputbox" name="password2" size="40" maxlength="80" value=""> *</td>
</tr>
<tr><td>
<?=$lang_reg_email?></td> <td> <input type="text" class="inputbox" name="email" size="40" maxlength="80" value="
<?=$returned[3];?>
"> </td> </tr>
<tr><td><strong><?=$lang_reg_optional?></strong></td> </tr>
<tr><td>
<?=$lang_reg_name?></td> <td><input type="text" class="inputbox" name="name" size="40" maxlength="80" value="
<?=$returned[5];?>
"> </td> </tr>
<tr> <td>
<?=$lang_reg_address?></td> <td><input type="text" class="inputbox" name="street" size="40" maxlength="80" value="
<?=$returned[6];?>
"> </td> </tr>
<tr> <td>
<?=$lang_reg_zipcode?></td> <td><input type="text" class="inputbox" name="psc" size="40" maxlength="80" value="
<?=$returned[7];?>
"> </td> </tr>
<tr> <td>
<?=$lang_reg_town?> </td> <td><input type="text" class="inputbox" name="town" size="40" maxlength="80" value="
<?=$returned[8];?>
"> </td> </tr>
<tr> <td>
<?=$lang_reg_country?></td> <td><input type="text" class="inputbox" name="country" size="40" maxlength="80" value="
<?=$returned[9];?>
"> </td> </tr>
<tr> <td>
<?=$lang_reg_timezone?> </td> <td><input type="text" class="inputbox" name="timezone" size="40" maxlength="80" value="
<?=$returned[10];?>
"> </td> </tr>
<tr> <td>
<?=$lang_reg_phone?></td> <td> <input type="text" class="inputbox" name="phone" size="40" maxlength="80" value="
<?=$returned[11];?>
"> </td> </tr>
<tr> <td>
<?=$lang_reg_phone_alt?></td> <td> <input type="text" class="inputbox" name="alter_email" size="40" maxlength="80" value="
<?=$returned[12];?>
"></td> </tr>
<tr> <td>
<?=$lang_reg_msn?></td> <td><input type="text" class="inputbox" name="msn" size="40" maxlength="80" value="
<?=$returned[13];?>
"> </td> </tr>
<tr> <td>
<?=$lang_reg_icq?></td> <td><input type="text" class="inputbox" name="icq" size="40" maxlength="80" value="
<?=$returned[14];?>
"> </td> </tr>
<tr> <td>
<?=$lang_reg_email_alt?></td> <td> <input type="text" class="inputbox" name="alter_email" size="40" maxlength="80" value="
<?=$returned[15];?>
"> </td> </tr>
<tr> <td>
<?=$lang_reg_web_pages?></td> <td><input type="text" class="inputbox" name="web" size="40" maxlength="80" value="
<?=$returned[16];?>
"> </td> </tr>
<tr> <td>
<?=$lang_reg_notes?></td> <td><textarea name="notes" class="inputbox" rows="4" cols="80">
<?=$returned[17];?>
<?php 
$oop->freeResult(); $oop->_mySQL;
?>
</textarea> </td> </tr>
<tr> <td>
<?=$lang_user_lang?></td> <td>
<select name="pref_lang" >
<option value="cz" <?php if (($returned[20])=='cz') { echo 'selected';}?>>cz</option>
<option value="en" <?php if (($returned[20])=='en') { echo 'selected';}?>>en</option>
</select> 
</td> </tr>
</table>
</form>
<br>
<?=$lang_edituser_info?> 
</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div></div><?php 
include ('./html_end.php');
?>
<?php } ?>