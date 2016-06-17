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
$table = 'ds_todo';
include './head.php';
?>
<body onload="setfocus ()">
<div id="wrapper">
<?php include 'header.php'; 
include 'menu.php'; 
echo $MAIN_MENU;?>
<div id="content">
<div class="left_huge">
<h2><?=$lang_todo_head?></h2>
<?php
if ($_GET["action"]=='confirm'){
if (trim($_POST["activity"])!='') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$sql = sprintf ('INSERT INTO `%s` (`id`, `time_of_creation`, `kind_of_activity`, `activity`,`status`, `user`, `time_of_finishing`) VALUES (NULL, %s, %s, %s, %s, %s, %s)',
	$table,					
	quate_smart(date("d-m-Y")),
	quate_smart($_POST["kind_of_activity"]),
	quate_smart(trim($_POST["activity"])),
	quate_smart($_POST["status"]),
	quate_smart(0),
	quate_smart(0));
$oop->Setnames_cz();
$result = $oop->query($sql);
$oop->freeResult();
$oop->_mySQL;
$page_id=12;
include './work.php'; 
$oop->freeResult();
$_SESSION["ses_message"]=$lang_todo2;
} else {
$_SESSION["ses_message"]=$lang_todo3;
}
$location = 'Location: ./todo.php?show_activity='.$_POST["kind_of_activity"];
header($location); 
} else if ($_GET["action"]=='add') {
?>
<div class="menu_sub">
<ul>
<li><input type="submit" class="button3" name="submit_direct" value="<?=$lang_edit_submit?>">
<li><a href="" target="_self" ><?=$lang_todo1?></a>
<ul>
<li><a href="./todo.php?show_activity=0"><?=$lang_todo_option1?></a></li> 
<li><a href="./todo.php?show_activity=1"><?=$lang_todo_option2?></a></li> 
</ul>
</li>
</ul>
</div>
<br>
<?=$lang_todo_write?>
<br>
<form action="todo.php?action=confirm" method="post" name "form1">
<table class="sample">
<tr>
<td><select name="kind_of_activity" >
<option value="0" selected> <?=$lang_todo_option1?></option>
<option value="1"> <?=$lang_todo_option2?></option>
</select> </td>
<td>
<textarea name="activity" class="inputbox" rows="2" cols="60" ></textarea>
</td> </tr>
<tr>
<td>
</td>
<td>
<div align="center"><input class="button2" type="submit" name="sumbit" value="<?=$lang_todo_button?>"></div>
</td> </tr>
</table>
</form>
 <?php
} else if ($_GET["action"]=='signed'){
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$sql = sprintf ('UPDATE `%s` SET `user` = %s, `time_of_taking`=%s WHERE `id` = %s',
	$table,					
	quate_smart($_SESSION["id_user"]),
	quate_smart(date("d-m-Y")),
	quate_smart($_GET["id"]));
$oop->Setnames_cz();
$oop->query($sql);
$page_id=13;
include './work.php'; 
$oop->freeResult();
$oop->_mySQL;
$_SESSION["ses_message"]=$lang_todo4;
$location = 'Location: ./todo.php?show_activity='.$_GET["show_activity"];
header($location); 
} else if ($_GET["action"]=='finished'){	
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$sql = sprintf ('UPDATE `%s` SET `time_of_finishing` = %s WHERE `id` = %s',
	$table,					
	quate_smart(date("d-m-Y")),
	quate_smart($_GET["id"]));
$oop->Setnames_cz();
$oop->query($sql);
$page_id=14;
include './work.php'; 
$oop->freeResult();
$oop->_mySQL;
$_SESSION["ses_message"]=$lang_todo5;
$location = 'Location: ./todo.php?show_activity='.$_GET["show_activity"];
header($location); 
} else {
?>
<div class="menu_sub">
<ul>
<li><a href="todo.php?action=add"><?=$lang_todo_add?></a></li> 
<li><a href="" target="_self" ><?=$lang_todo1?></a>
<ul>
<li><a href="./todo.php?show_activity=0"><?=$lang_todo_option1?></a></li> 
<li><a href="./todo.php?show_activity=1"><?=$lang_todo_option2?></a></li> 
</ul>
</li>
</li>
</ul>
</div>
<?php
echo '<br>';
echo '<strong> '.$lang_todo_unasigned.' </strong><br>';
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$sql = sprintf ('SELECT * FROM `%s` WHERE `kind_of_activity` = %s ORDER BY `id` DESC',
	$table,
	quate_smart($_GET["show_activity"]));
$oop->Setnames_cz();
$result = $oop->query($sql);
?>
<table class="sample">
<tr>
<td><entry class="italic1"><?=$lang_todo_num?></entry></td> 
<td><entry class="italic1"><?=$lang_todo_creation_time?></entry></td>
<td><entry class="italic1"><?=$lang_todo_todoevent?></entry></td>
<td><entry class="italic1"><?=$lang_todo_signed_with?></entry></td>
</tr>
<?php
$count=0;
while ($returned = $oop->fetchRow ()):
$table_user=  'ds_users';
$sql_sub = sprintf ('SELECT `nick` FROM `%s` WHERE `id_user`=%s',
	$table_user,
	quate_smart($returned[5]));
$oop2->Setnames();
$oop2->query($sql_sub);	
$row= $oop2->fetchArray();
$oop2->FreeResult();
if ($returned[5]==0) {
$count++;
?>
<tr>
<td><entry class="italic1"><?=$count?></entry></td>
<td><entry class="pos"><?=$returned[1]?></entry></td>
<td><entry class="italic1"><?=$returned[3]?></entry></td>
<td><entry class="pos"><a href="./todo.php?action=signed&id=<?=$returned[0]?>&show_activity=<?=$_GET["show_activity"]?>"><?=$lang_todo_signed_question?></a></entry></td>	
</tr>
<?php 
} 
endwhile;
?>
</table>
<br>
<?php
$oop->freeResult();
?>
<strong><?=$lang_todo_running?></strong> <br>
<?php
$sql = sprintf ('SELECT * FROM `%s` WHERE `kind_of_activity` = %s AND `user` <> %s ORDER BY `time_of_taking` DESC',
	$table,
	quate_smart($_GET["show_activity"]),
	quate_smart(0));
$oop->Setnames_cz();
$result = $oop->query($sql);
?>
<table class="sample">
<tr>
<td><entry class="italic1"><?=$lang_todo_num?></entry></td> 
<td><entry class="italic1"><?=$lang_todo_creation_time?></entry></td>
<td><entry class="italic1"><?=$lang_todo_todoevent?></entry></td>
<td><entry class="italic1"><?=$lang_todo_signed_with?></entry></td>
<td><entry class="italic1"><?=$lang_todo_time_of_taking?></entry></td>
<td><entry class="italic1"><?=$lang_todo_finished?></entry></td>
</tr>
<?php
$count=0;
while ($returned = $oop->fetchRow ()):
$table_user=  'ds_users';
$sql_sub = sprintf ('SELECT `nick` FROM `%s` WHERE `id_user`=%s',
	$table_user,
	quate_smart($returned[5]));
$oop2->Setnames();
$oop2->query($sql_sub);	
$row= $oop2->fetchArray();
$oop2->FreeResult();
$oop2->_mySQL;
if ($returned[7]==0) { 
$count++;
?>
<tr>
<td><entry class="italic1"><?=$count?></entry></td>
<td><entry class="pos"><?=$returned[1]?></entry></td>
<td><entry class="italic1"><?=$returned[3]?></entry></td>
<td><entry class="pos"><?=$row[0]?></entry></td>
<td><entry class="pos"><?=$returned[6]?></entry></td>
<?php 
if ($returned[5]==$_SESSION["id_user"]) {
?>
<td><entry class="pos"><a href="./todo.php?action=finished&id=<?=$returned[0]?>&show_activity=<?=$_GET["show_activity"]?>"> <?=$lang_todo_finished_question?></a></entry></td>
<?php
} else {
?>
<td><entry class="pos"><?=$lang_todo_no?></entry></td>
<?php
}
?>
</tr>
<?php
}
endwhile;
?>
</table>
<br>
<?php
$oop->freeResult();
?>
<strong><?=$lang_todo_finished_events?> </strong> <br>
<?php
$sql = sprintf ('SELECT * FROM `%s` WHERE `kind_of_activity` = %s AND `time_of_finishing` <> %s ORDER BY `time_of_finishing` ASC',
	$table,
	quate_smart($_GET["show_activity"]),
	quate_smart(0));
$oop->Setnames_cz();
$result = $oop->query($sql);
?>
<table class="sample">
<tr>
<td><entry class="italic1"> <?=$lang_todo_num?> </entry></td> 
<td><entry class="italic1"><?=$lang_todo_todoevent?></entry></td>
<td><entry class="italic1"><?=$lang_todo_signed_with?></entry></td>
<td><entry class="italic1"><?=$lang_todo_time_of_taking?></entry></td>
<td><entry class="italic1"><?=$lang_todo_finished?></entry></td>
</tr>
<?php
$count=0;
while ($returned = $oop->fetchRow ()):
$table_user=  'ds_users';
$sql_sub = sprintf ('SELECT `nick` FROM `%s` WHERE `id_user`=%s',
	$table_user,
	quate_smart($returned[5]));
$oop2->Setnames();
$oop2->query($sql_sub);	
$row= $oop2->fetchArray();
$oop2->FreeResult();
$oop2->_mySQL;
$count++;
?>
<tr>
<td><entry class="italic1"><?=$count?></entry></td>
<td><entry class="italic1"><?=$returned[3]?></entry></td>
<td><entry class="pos"><?=$row[0]?></entry></td>
<td><entry class="pos"><?=$returned[6]?></entry></td>
<td><entry class="pos"><?=$returned[7]?></entry></td>
</tr>
<?php
endwhile;
?>
</table>
<?php
$oop->freeResult();
$oop->_mySQL;
} ?>
</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div></div><?php 
include ('./html_end.php');
?>