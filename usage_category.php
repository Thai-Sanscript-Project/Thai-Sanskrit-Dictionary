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
$table = 'ds_usage_category';
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
<?php
if ($_GET["action"]=='confirm'){
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
if ($_POST["id"]!='new') {
$sql = sprintf ('UPDATE `%s` SET `is_category` = %s, `cz_category` = %s, `super_category` = %s WHERE `id` = %s',
	$table,					
	quate_smart(trim($_POST["is_category"])),
	quate_smart(trim($_POST["cz_category"])),
	quate_smart(trim($_POST["super_category"])),
	$_POST["id"]); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
$oop->_mySQL;
$_SESSION["ses_message"]=$lang_add_usage_category11;
$ip=$_POST["id"];
$page_id=527; 
include './work.php'; 
} else  {
$sql = sprintf ('INSERT INTO `%s` (`id`, `is_category`, `cz_category`, `super_category`) VALUES (NULL, %s, %s, %s)',
	$table,					
	quate_smart(trim($_POST["is_category"])),
	quate_smart(trim($_POST["cz_category"])),
	quate_smart(trim($_POST["super_category"])));	
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
$oop->_mySQL;
$_SESSION["ses_message"]=$lang_add_usage_category12;
$page_id=528; 
include './work.php'; 
}
$location = 'Location: ./usage_category.php';
header($location); 
} else  if ($_GET["action"]=='delete_confirm'){
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$sql = sprintf ('DELETE FROM `%s` WHERE `id` = %s',
	$table,					
	quate_smart($_GET["id"]));
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
$_SESSION["ses_message"]=$lang_add_usage_category13;
$ip=$_GET["id"];
$page_id=529; 
include './work.php'; 
$location = 'Location: ./usage_category.php';
header($location);		
} else if ($_GET["action"]=='delete'){
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$sql = sprintf ('SELECT * FROM `%s` WHERE `id`=%s',
	$table,
	quate_smart($_GET["id"]));		
$oop->Setnames(); 
$oop->query($sql);
$row = $oop->fetchArray();
echo '<entry class="ses_message"> '.$lang_add_usage_category2.' '.$row[1].'? </entry><br>';
echo '<a href="./usage_category.php">'.$lang_add_usage_category3.'</a> ';
echo '<a href="./usage_category.php?action=delete_confirm&id='.$row[0].'">'.$lang_add_usage_category4.'</a> ';
$oop->FreeResult();
$oop->_mySQL;	
} else if ($_GET["action"]=='add'){
?>
<h2><?=$lang_usage1?></h2>
<form action="usage_category.php?action=confirm" method="post" name="form">
<table class="sample">
<tr>
<input type="hidden" name="id" value="new">
<td><?=$lang_add_usage_category5?></td>       <td>  <input type="text" class="inputbox" id="is_category" name="is_category" size="20" maxlength="80" value=""></td>
</tr>
<tr>
<td><?=$lang_add_usage_category6?></td> <td><input type="text" class="inputbox" name="cz_category" size="20" maxlength="80"  value=""> </td>
</tr>
<tr>
<td><?=$lang_add_usage_category7?></td> <td><input type="text" class="inputbox" name="super_category" size="20" maxlength="80"  value=""> </td>
</tr>
<tr>
<td></td>
<td> <input type="submit" class="button2" name="sumbit" value="<?=$lang_edit_submit?>"></td>
</tr>
</table>
</form>
<?php
} else if ($_GET["action"]=='edit'){
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$sql = sprintf ('SELECT * FROM `%s` WHERE `id` = %s',
			$table,				
			quate_smart($_GET["id"]));

$oop->Setnames();
$oop->query($sql);
$returned = $oop->fetchRow ();
$oop->freeResult();
$oop->_mySQL;
?>
<h2><?=$lang_usage2?></h2>
<form action="usage_category.php?action=confirm" method="post" name="form">
<table class="sample">
<tr>
<input type="hidden" name="id" value="<?=$returned[0]?>">
<td><?=$lang_add_usage_category5?></td>       <td>  <input type="text" class="inputbox" id="is_category" name="is_category" size="20" maxlength="80" value="<?=$returned[1]?>"></td>
</tr>
<tr>
<td><?=$lang_add_usage_category6?></td> <td><input type="text" class="inputbox" name="cz_category" size="20" maxlength="80"  value="<?=$returned[2]?>"> </td>
</tr>
<tr>
<td><?=$lang_add_usage_category7?></td> <td><input type="text" class="inputbox" name="super_category" size="20" maxlength="80"  value="<?=$returned[3]?>"> </td>
</tr>
<tr>
<td></td>
<td> <input type="submit" class="button2" name="sumbit" value="<?=$lang_edit_submit?>"></td>
</tr>
</table>
</form>
</div>
</div>
<?php
} else if ($_GET["action"]=='detail'){
include './scripts/view_usage_category_detail_br_x.php';
} else {
?>
<h2><?=$lang_add_usage_category?></h2>
<div class="menu_sub">
<ul>
<li><a href="./usage_category.php?action=add" target="_self"><?=$lang_add_usage_category8?></a></li>
</ul>
</div>
<br><br>
<?php 
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$sql = sprintf ('SELECT * FROM `%s` ORDER BY `super_category`',
	$table);		
$oop->Setnames(); 
$oop->query($sql);
while ($row = $oop->fetchArray()) :
$as++;
echo '<a href="./usage_category.php?action=edit&id='.$row[0].'"><img src="/images/dec_2.png" border="0" alt=""></a>';
echo '<a href="./usage_category.php?action=delete&id='.$row[0].'"><img src="/images/b_drop.png" border="0" alt=""></a>';
echo $as.'.';
echo ' '.$row[3].'  -  '.$row[1].'  -  ('.$row[2].')';
echo '<br>';
endwhile;
$oop->FreeResult();
$oop->_mySQL;
?>
</div>
<?php } ?>
</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div></div><?php 
include ('./html_end.php');
?>