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
include './head.php';
?>
<body onload="setfocus ()">
<div id="wrapper">
<?php include 'header.php';
include 'menu.php'; 
echo $MAIN_MENU;
if (empty($_GET["user"])) {
$user = $_SESSION["id_user"];
} else {
$user = $_GET["user"]; } ?>

<div id="content">
<div class="left_huge">
<h2><?=$lang_infouser_head?></h2>
<div class="menu_sub">
<ul>
<?php if ($user==$_SESSION["id_user"]) { ?>
<li><a href="./edit_user.php"><?=$lang_user_edit_user?></a></li> 
<?php } ?>
<li><a href="./listofusers.php"><?=$lang_user_1?></a></li> 
</ul>
</div>
<table class="sample">
<tr>
<?php 
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table=  'ds_users';
$sql = sprintf ('SELECT * FROM `%s` WHERE `id_user` = %s',
	$table,
	quate_smart($user));
$oop->Setnames();
$oop->query($sql);
while($returned = $oop->fetchRow ()) :
$count++;
echo '<tr><td>'.$lang_reg_user.' </td><td><strong>'.$returned[1].'</strong></td></tr>'; 
echo '<tr><td>'.$lang_reg_email.' </td><td>'.$returned[3].'</td></tr>';
echo '<tr><td>'.$lang_users_admin.' </td><td></td></tr>';
echo '<tr><td>'.$lang_reg_name.'</td><td>'.$returned[5].'</td></tr>'; 
echo '<tr><td>'.$lang_reg_address.' </td><td>'.$returned[6].'</td></tr>'; 
echo '<tr><td>'.$lang_reg_zipcode.' </td><td>'.$returned[7].'</td></tr>'; 
echo '<tr><td>'.$lang_reg_town.'</td><td> '.$returned[8].'</td></tr>'; 
echo '<tr><td>'.$lang_reg_country.'</td><td> '.$returned[9].'</td></tr>'; 
echo '<tr><td>'.$lang_reg_timezone.'</td><td> '.$returned[10].'</td></tr>'; 
echo '<tr><td>'.$lang_reg_phone.' </td><td>'.$returned[11].'</td></tr>'; 
echo '<tr><td>'.$lang_reg_phone_alt.' </td><td>'.$returned[12].'</td></tr>'; 
echo '<tr><td>'.$lang_reg_msn.'</td><td> '.$returned[13].'</td></tr>'; 
echo '<tr><td>'.$lang_reg_icq.' </td><td>'.$returned[14].'</td></tr>'; 
echo '<tr><td>'.$lang_reg_email_alt.' </td><td>'.$returned[15].'</td></tr>'; 
echo '<tr><td>'.$lang_reg_web_pages.' </td><td>'.$returned[16].'</td></tr>'; 
echo '<tr><td>'.$lang_reg_notes.' </td><td>'.$returned[17].'</td></tr>'; 
echo '<tr><td>'.$lang_user_lang.' </td><td>'.$returned[20].'</td></tr>'; 
endwhile;
echo '</table><br>';
echo '<br>';
$oop->freeResult();
$oop->_mySQL;
?> 
</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div></div><?php 
include ('./html_end.php');
?>