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
$table = 'ds_dev_info';
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
if (($_POST["title"]!='') AND ($_POST["text"])!='') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$sql = sprintf ('INSERT INTO `%s` (`id`, `date`, `title`, `text`) VALUES (NULL, %s, %s, %s)',
	$table,					
	quate_smart(date("Y-m-d H:i:s")),
	quate_smart($_POST["title"]),
	quate_smart($_POST["text"]));								
$oop->Setnames_cz();
$result = $oop->query($sql);
$oop->freeResult();
$oop->_mySQL;
$page_id=513; 
include './work.php'; 
$_SESSION["ses_message"]=$lang_devinfo1;
} else {
$_SESSION["ses_message"]=$lang_devinfo17;		
}
$location = 'Location: ./dev_info.php';
header($location); 
} else  if ($_GET["action"]=='delete_confirm'){
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$sql = sprintf ('DELETE FROM `%s` WHERE `id` = %s',
	$table,					
	quate_smart($_GET["id"]));
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
$oop->_mySQL;
$_SESSION["ses_message"]=$lang_devinfo2;
$ip=$_GET["id"];
$page_id=525; 
include './work.php'; 
$location = 'Location: ./dev_info.php';
header($location);		
} else if ($_GET["action"]=='delete'){
?>
<h2><?=$lang_devinfo3?></h2>
<?php
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$sql = sprintf ('SELECT * FROM `%s` WHERE `id`=%s',
	$table,
	quate_smart($_GET["id"]));		
$oop->Setnames(); 
$oop->query($sql);
$row = $oop->fetchArray();
echo '<entry class="ses_message"> '.$lang_devinfo4.' </entry><br>';
echo '<a href="./dev_info.php?action=delete_confirm&id='.$row[0].'">'.$lang_edit_del_yes.'</a>   ';
echo '<a href="./dev_info.php">'.$lang_sources6.'</a> ';
echo '<br>';
echo '<br>';
echo '<strong><span class="dtrn">'.$row[1].'</span></strong>';
echo '<span class="italic2"> '.$row[2].'</span><br>';
echo '<span class="italic2"> '.$row[3].'</span><br>';
$oop->FreeResult();
$oop->_mySQL;	
} else if ($_GET["action"]=='update'){
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$sql = sprintf ('UPDATE `%s` SET `title` = %s, `text` = %s WHERE `id` = %s',
	$table,					
	quate_smart($_POST["title"]),
	quate_smart($_POST["text"]),
	$_POST["id"]); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
$oop->_mySQL;
$ip=$_POST["id"];
$page_id=526; 
include './work.php'; 
$_SESSION["ses_message"]=$lang_devinfo5;
$location = 'Location: ./dev_info.php';
header($location); 
} else if ($_GET["action"]=='edit'){
?>

<?php	
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$sql = sprintf ('SELECT `id`, `title`, `text` FROM `%s` WHERE `id` = %s',
	$table,
	$_GET["id"]);		
$oop->Setnames(); 
$oop->query($sql);
$row = $oop->fetchArray();
$oop->freeResult();
$oop->_mySQL;		
?>
<h2><?=$lang_devinfo6?></h2><br>
 
<form action="dev_info.php?action=update" method="post" name "form1">
<input type="hidden" name="id" value="<?=$row[0]?>">
<table class="sample">
<tr> <td>
<?=$lang_forum_topic?></td>
<td>
<input type="text" class="inputbox" name="title" size="20" maxlength="80" value="<?=$row[1]?>"> </td>
</tr>
<tr>
<td><?=$lang_adminnews_message?></td>
<td>
<textarea name="text" class="inputbox" rows="8" cols="100" ><?=$row[2]?></textarea>
</td> </tr>
<tr>
<td></td>
<td>
<div align="center"><input class="button2" type="submit" name="sumbit" value="Editovat zprávu"></div>
</td> </tr>
</table>
</form> <?php
} else {
?>
<h2><?=$lang_devinfo7?></h2><br>
<form action="dev_info.php?action=confirm" method="post" name "form1">
<table class="sample">
<tr> <td>
<?=$lang_forum_topic?></td>
<td>
<input type="text" class="inputbox" name="title" size="20" maxlength="80" value=""> </td>
</tr>
<tr>
<td><?=$lang_adminnews_message?></td>
<td>
<textarea name="text" class="inputbox" rows="8" cols="100" ></textarea>
</td> </tr>
<tr>
<td></td>
<td>
<div align="center"><input class="button2" type="submit" name="sumbit" value="<?=$lang_adminnews_button?>"></div>
</td> </tr>
</table>
</form>
<h4><?=$lang_devinfo8?></h4><br>
<?php
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$table=  'ds_dev_info';
$sql = sprintf ('SELECT * FROM `%s` ORDER BY `date` DESC LIMIT 0,5',
	$table);
$oop->Setnames();
$oop->query($sql);	
while ($returned = $oop->fetchRow ()):
echo '<a href="./dev_info.php?action=edit&id='.$returned[0].'"><img src="/images/dec_2.png" border="0" alt=""></a>';
echo '<a href="./dev_info.php?action=delete&id='.$returned[0].'"><img src="/images/b_drop.png" border="0" alt=""></a>';
echo '<strong><span class="dtrn">'.$returned[1].'</span></strong>';
echo '<span class="italic2"> '.$returned[2].'</span><br>';
echo '<span class="italic2"> '.$returned[3].'</span><br>';
endwhile;
$oop->freeResult();
$oop->_mySQL; 
}
?>
</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div>
</div>
<?php 
include ('./html_end.php');
?>