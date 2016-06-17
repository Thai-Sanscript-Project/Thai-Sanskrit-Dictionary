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
?>
<div id="content">
<div class="left_huge">
<h2><?=$lang_users_head?></h2>
<?php 
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$nn=1;
$table=  'ds_users';
$sql = sprintf ('SELECT * FROM `%s` WHERE `rights`= %s',
	$table,
	quate_smart($nn));
$oop->Setnames();
$oop->query($sql);
?>
<?=$lang_listofusers_admin?><br>
<table class="sample">
<tr>
<?php // this id info important only for admin 
if ($_SESSION["id_user"]==1) { ?>
 <td><?=$lang_users_id?> </td>
<?php }?>
<td><?=$lang_users_name?> </td>
<td><?=$lang_users_email?></td>
</tr>
<?php
while($returned = $oop->fetchRow()) :
$count++;
echo "<tr>";
if ($_SESSION["id_user"]==1) {
echo "<td>".$returned[0]."</td>"; }
echo "<td><a href=\"user.php?user=".$returned[0]."\">".$returned[1]."</a></td>"; 
echo "<td>".$returned[3]."</td>";
echo "</tr>";
endwhile;
echo '</table>';
$oop->freeResult();
$nn=2;
$sql = sprintf ('SELECT * FROM `%s` WHERE `rights`= %s',
	$table,
	quate_smart($nn));
$oop->Setnames();
$oop->query($sql);
?>
<br><?=$lang_listofusers_users?><br>
<table class="sample">
<tr> 
<?php // this id info important only for admin 
if (($_SESSION["rights"])==1) { ?>
<td><?=$lang_users_id?> </td>
<?php }?>
<td><?=$lang_users_name?> </td>
<td><?=$lang_users_email?></td>
</tr>
<?php
while($returned = $oop->fetchRow()) :
$count++;
echo "<tr>";
if (($_SESSION["rights"])==1) {
echo "<td>".$returned[0]."</td>"; }
echo "<td><a href=\"user.php?user=".$returned[0]."\">".$returned[1]."</a></td>"; 
echo "<td>".$returned[3]."</td>";
echo "</tr>";
endwhile;
echo '</table>';
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