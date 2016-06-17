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
include './start.php';
include './head.php';
$table = 'ds_bibliography';
if ($_SESSION["editsources_show"]=='') {
$_SESSION["editsources_show"]='2';
}
if ($_GET["editsources_show"]=='true') {
if ($_SESSION["editsources_show"]=='1') {$_SESSION["editsources_show"]='2';}
else {$_SESSION["editsources_show"]='1';} }
?>
<body onload="setfocus ()">
<div id="wrapper">
<?php include 'header.php'; 
include 'menu.php'; 
echo $MAIN_MENU;?>
<div id="content">
<div class="left_huge">
<h2><?=$lang_sources_head?></h2>
<?php
if ($_GET["action"]=='confirm'){
if (($_SESSION["rights"]==1) OR ($_SESSION["rights"]==2)){
	$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
	$page_id = 18;
        $keyword_work = $_POST["keyword"];
	$num_keyword_work = $_POST["num_keyword"];
	include './work.php';
if ($_POST["id"]!='new') {
$sql = sprintf ('UPDATE `%s` SET `type` = %s, `category` = %s, `title` = %s, `author1_name` = %s, `author2_name` = %s, `author3_name` = %s, `author4_name` = %s, `author1_surname` = %s, `author2_surname` = %s, `author3_surname` = %s, `author4_surname` = %s, `book` = %s, `pages` = %s, `notes` = %s, `abstract` = %s, `publisher` = %s, `address` = %s, `series` = %s, `volume` = %s, `number`=%s, `year`=%s, `bibtexkey`=%s, `bibtex`=%s, `link`=%s, `visit_time`=%s WHERE `id` = %s',
	$table,					
	quate_smart($_POST["type"]),
	quate_smart($_POST["category"]),
	quate_smart($_POST["title"]),
	quate_smart($_POST["author1_name"]),
	quate_smart($_POST["author2_name"]),
	quate_smart($_POST["author3_name"]),
	quate_smart($_POST["author4_name"]),
	quate_smart($_POST["author1_surname"]),
	quate_smart($_POST["author2_surname"]),
	quate_smart($_POST["author3_surname"]),
	quate_smart($_POST["author4_surname"]),
	quate_smart($_POST["book"]),
	quate_smart($_POST["pages"]),
	quate_smart($_POST["notes"]),
	quate_smart($_POST["abstract"]),
	quate_smart($_POST["publisher"]),
	quate_smart($_POST["address"]),
	quate_smart($_POST["series"]),
	quate_smart($_POST["volume"]),
	quate_smart($_POST["number"]),
	quate_smart($_POST["year"]),
	quate_smart($_POST["bibtexkey"]),
	quate_smart($_POST["bibtex"]),
	quate_smart($_POST["link"]),
	quate_smart($_POST["visit_time"]),
	$_POST["id"]); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
$oop->_mySQL;
$ip=$_POST["id"];
$page_id=507; 
include './work.php'; 
$_SESSION["ses_message"]=$lang_sources3;
} else  {
if ($_POST["title"]!='') {
$sql = sprintf ('INSERT INTO `%s` (`id`, `type`, `category`, `title`, `author1_name`, `author2_name`, `author3_name`, `author4_name`, `author1_surname`, `author2_surname`, `author3_surname`, `author4_surname`, `book`, `pages`, `notes`, `abstract`, `publisher`, `address`, `series`, `volume`, `number`, `year`, `bibtexkey`, `bibtex`, `link`, `visit_time`) VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)',
	$table,					
	quate_smart($_POST["type"]),
	quate_smart($_POST["category"]),
	quate_smart($_POST["title"]),
	quate_smart($_POST["author1_name"]),
	quate_smart($_POST["author2_name"]),
	quate_smart($_POST["author3_name"]),
	quate_smart($_POST["author4_name"]),
	quate_smart($_POST["author1_surname"]),
	quate_smart($_POST["author2_surname"]),
	quate_smart($_POST["author3_surname"]),
	quate_smart($_POST["author4_surname"]),
	quate_smart($_POST["book"]),
	quate_smart($_POST["pages"]),
	quate_smart($_POST["notes"]),
	quate_smart($_POST["abstract"]),
	quate_smart($_POST["publisher"]),
	quate_smart($_POST["address"]),
	quate_smart($_POST["series"]),
	quate_smart($_POST["volume"]),
	quate_smart($_POST["number"]),
	quate_smart($_POST["year"]),
	quate_smart($_POST["bibtexkey"]),
	quate_smart($_POST["bibtex"]),
	quate_smart($_POST["link"]),
	quate_smart($_POST["visit_time"]));	
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
$oop->_mySQL;
$_SESSION["ses_message"].=$lang_sources4;
$ip=$_POST["title"];
$page_id=508; 
include './work.php'; 
} else {
$_SESSION["ses_message"].=$lang_sources4b;
}
}
$location = 'Location: ./sources.php';
header($location); 
}
// delete action
} else  if ($_GET["action"]=='delete_confirm'){
if (($_SESSION["rights"]==1) OR ($_SESSION["rights"]==2)){
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$sql = sprintf ('DELETE FROM `%s` WHERE `id` = %s',
	$table,					
	quate_smart($_GET["id"]));
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
$oop->_mySQL;
$_SESSION["ses_message"]=$lang_sources4a;
$ip=$_GET["id"];
$page_id=509; 
include './work.php'; 
$location = 'Location: ./sources.php';
header($location);		
}	
//preparation for delete confirm
} else if ($_GET["action"]=='delete'){
if (($_SESSION["rights"]==1) OR ($_SESSION["rights"]==2)){		
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$sql = sprintf ('SELECT * FROM `%s` WHERE `id`=%s',
	$table,
	quate_smart($_GET["id"]));		
$oop->Setnames(); 
$oop->query($sql);
$row = $oop->fetchArray();
echo '<entry class="ses_message"> '.$lang_sources5.' '.$row[3].'? </entry><br>';
echo '<a href="./sources.php">'.$lang_sources6.'</a> ';
echo '<a href="./sources.php?action=delete_confirm&id='.$row[0].'">'.$lang_sources7.'</a> ';
$oop->FreeResult();
$oop->_mySQL;	
}
} else if ($_GET["action"]=='add'){
if (($_SESSION["rights"]==1) OR ($_SESSION["rights"]==2)){
?>
<form action="sources.php?action=confirm" method="post" name="form">
<?php if (($_SESSION["rights"]==1) OR ($_SESSION["rights"]==2)){?>
<div class="menu_sub">
<ul>
<li><input type="submit" class="button3" name="submit" value="<?=$lang_edit_submit?>">
</li>
<li><a href="./sources.php"><?=$lang_sources_back?></a></li> 
</ul>
</div>	
<?php } ?>
<table class="sample" width="100%" border="0">
<tr>
<td> <?=$lang_sources9?></td><td>  
<select name="type" >
<option value="book"><?=$lang_sources10?></option>
<option value="web"> <?=$lang_sources11?></option>
<option value="program" selected> <?=$lang_sources12?></option>
</select> 
</td>
<td> <?=$lang_sources13?></td><td> 
<select name="category" >
<option value="dictionaries"> <?=$lang_sources14?></option>
<option value="other_material"> <?=$lang_sources15?></option>
<option value="online_dictionaries"> <?=$lang_sources16?></option>
<option value="other_online_material"> <?=$lang_sources17?> </option>
<option value="programming" selected><?=$lang_sources18?> </option>
</select> 
</td>
</tr>
<tr>
<td><?=$lang_sources19?><input type="hidden" name="id" value="new"></td><td><input type="text" class="inputbox" id="title" name="title" size="20" maxlength="80" value=""></td>
<td> </td>
</tr>
<tr>
<td><?=$lang_sources20?></td><td><input type="text" class="inputbox" name="author1_name" size="20" maxlength="80"  value=""> </td>
<td><?=$lang_sources21?></td><td><input type="text" class="inputbox" name="author1_surname" size="20" maxlength="80"  value=""> </td>
</tr>
<tr>
<td><?=$lang_sources22?></td><td><input type="text" class="inputbox" name="author2_name" size="20" maxlength="80" value=""> </td>
<td><?=$lang_sources23?></td><td><input type="text" class="inputbox" name="author2_surname" size="20" maxlength="80"  value=""> </td>
</tr>
<tr>
<td><?=$lang_sources24?></td><td><input type="text" class="inputbox" name="author3_name" size="20" maxlength="80" value=""> </td>
<td><?=$lang_sources25?></td><td><input type="text" class="inputbox" name="author3_surname" size="20" maxlength="80" value=""> </td>
</tr>
<tr>
<td><?=$lang_sources26?></td><td><input type="text" class="inputbox" name="author4_name" size="20" maxlength="80"  value=""> </td>
<td><?=$lang_sources27?></td><td><input type="text" class="inputbox" name="author4_surname" size="20" maxlength="80"  value=""> </td>
</tr>
<tr>
<td><?=$lang_sources28?></td><td><input type="text" class="inputbox" name="book" size="20" maxlength="80" value=""> </td>
<td><?=$lang_sources29?></td><td> <textarea class="inputbox" name="abstract" rows="2" cols="20"></textarea> </td>
</tr>
<tr>
<td><?=$lang_sources30?></td>       
<td><textarea class="inputbox" name="notes" size="20" rows="2" cols="20"></textarea> </td>
</tr>
<tr>
<td><?=$lang_sources31?></td><td><input type="text"  name="pages" class="inputbox" size="4" maxlength="80" value=""> 
<td><?=$lang_sources32?></td><td><input type="text" class="inputbox" name="publisher" size="20" maxlength="80" value=""> </td>
</tr>
<tr>
<td><?=$lang_sources33?></td><td><input type="text" class="inputbox" name="address" size="20" maxlength="80" value=""> </td>
<td><?=$lang_sources34?></td> <td><input type="text" class="inputbox" name="series" size="4" maxlength="80" value=""> </td>
</tr>
<tr>
<td> <?=$lang_sources35?> </td><td> <input type="text" class="inputbox" name="volume" size="4" maxlength="80" value=""></td>
<td><?=$lang_sources36?> </td> <td><input type="text" class="inputbox" name="number" id="number" size="20" maxlength="80" value=""> </td>
</tr>
<tr>
<td><?=$lang_sources37?></td><td><input type="text" name="year" class="inputbox" size="20" maxlength="80" value=""> </td>
<td><?=$lang_sources38?></td> <td><input type="text" class="inputbox" name="bibtexkey" size="20" maxlength="80" value=""> </td>
</tr>
<tr>
<td><?=$lang_sources39?></td><td><textarea name="bibtex" id="bibtex" class="inputbox" rows="2" cols="20">
</textarea> </td>
<td><?=$lang_sources40?></td><td><textarea name="link" class="inputbox" rows="2" cols="20">
</textarea></td>
</tr>
<tr>
<td>
</td><td>
</td>
<td><?=$lang_sources41?></td><td> <input type="text" class="inputbox" name="visit_time" size="20" maxlength="80" value=""> </td>
<td>
</td></tr>
</table>
</form>
</div>
<?php
}
// edit bibliography
} else if ($_GET["action"]=='edit'){
if (($_SESSION["rights"]==1) OR ($_SESSION["rights"]==2)){
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
<form action="sources.php?action=confirm" method="post" name="form">
<?php if (($_SESSION["rights"]==1) OR ($_SESSION["rights"]==2)){?>
<div class="menu_sub">
<ul>
<li><input type="submit" class="button3" name="submit" value="Uložit">
</li>
<li><a href="./sources.php"><?=$lang_sources_back?></a></li> 
</ul>
</div>	
<?php } ?>
<table class="sample" width="100%" border="0">
<tr><td> <?=$lang_sources9?> </td><td>  
<select name="type" >
<option value="book" <?php if ($returned[1]=='book') {echo 'selected'; }?>> <?=$lang_sources10?> </option>
<option value="web" <?php if ($returned[1]=='web') {echo 'selected'; }?>> <?=$lang_sources11?></option>
<option value="program" <?php if ($returned[1]=='program') {echo 'selected'; }?>> <?=$lang_sources12?></option>
</select> 
</td>
<td> <?=$lang_sources13?></td><td> 
<select name="category" >
<option value="dictionaries"<?php if ($returned[2]=='dictionaries') {echo 'selected'; }?>> <?=$lang_sources14?></option>
<option value="other_material"<?php if ($returned[2]=='other_material') {echo 'selected'; }?>> <?=$lang_sources15?></option>
<option value="online_dictionaries" <?php if ($returned[2]=='online_dictionaries') {echo 'selected'; }?>> <?=$lang_sources16?></option>
<option value="other_online_material"<?php if ($returned[2]=='other_online_material') {echo 'selected'; }?>> <?=$lang_sources17?> </option>
<option value="programming"<?php if ($returned[2]=='programming') {echo 'selected'; }?>><?=$lang_sources18?> </option>
</select> 
</td>
</tr>
<tr>
<input type="hidden" name="id" value="<?=$returned[0]?>">
<td><?=$lang_sources19?></td><td><input type="text" class="inputbox" id="title" name="title" size="30" maxlength="80" value="<?=$returned[3]?>"></td>
<td> </td>
</tr>
<tr>
<td><?=$lang_sources20?></td><td><input type="text" class="inputbox" name="author1_name" size="20" maxlength="80"  value="<?=$returned[4]?>"> </td>
<td><?=$lang_sources21?></td><td><input type="text" class="inputbox" name="author1_surname" size="20" maxlength="80"  value="<?=$returned[8]?>"> </td>
</tr>
<tr>
<td><?=$lang_sources22?></td><td><input type="text" class="inputbox" name="author2_name" size="20" maxlength="80" value="<?=$returned[5]?>"> </td>
<td><?=$lang_sources23?></td><td><input type="text" class="inputbox" name="author2_surname" size="20" maxlength="80"  value="<?=$returned[9]?>"> </td>
</tr>
<tr>
<td><?=$lang_sources24?></td><td><input type="text" class="inputbox" name="author3_name" size="20" maxlength="80" value="<?=$returned[6]?>"> </td>
<td><?=$lang_sources25?></td><td><input type="text" class="inputbox" name="author3_surname" size="20" maxlength="80" value="<?=$returned[10]?>"> </td>
</tr>
<tr>
<td><?=$lang_sources26?></td><td><input type="text" class="inputbox" name="author4_name" size="20" maxlength="80"  value="<?=$returned[7]?>"> </td>
<td><?=$lang_sources27?></td><td><input type="text" class="inputbox" name="author4_surname" size="20" maxlength="80"  value="<?=$returned[11]?>"> </td>
</tr>
<td><?=$lang_sources28?></td><td><input type="text" class="inputbox" name="book" size="20" maxlength="80" value="<?=$returned[12]?>"> </td>
</tr>
<tr>
<td><?=$lang_sources29?></td><td><textarea class="inputbox" name="abstract" rows="2" cols="20"> <?=$returned[13]?></textarea> </td>
<td><?=$lang_sources30?> </td>       
<td><textarea class="inputbox" name="notes" size="20" rows="2" cols="20"> </textarea> <?=$returned[14]?></td>
</tr>
<tr>
<td><?=$lang_sources31?></td><td><input type="text"  name="pages" class="inputbox" size="4" maxlength="80" value="<?=$returned[15]?>"> 
<td><?=$lang_sources32?></td><td><input type="text" class="inputbox" name="publisher" size="20" maxlength="80" value="<?=$returned[16]?>"> </td>
</tr>
<tr>
<td><?=$lang_sources33?></td><td><input type="text" class="inputbox" name="address" size="20" maxlength="80" value="<?=$returned[17]?>"> </td>
<td><?=$lang_sources34?></td> <td><input type="text" class="inputbox" name="series" size="4" maxlength="80" value="<?=$returned[18]?>"> </td>
</tr>
<tr>
<td> <?=$lang_sources35?></td><td><input type="text" class="inputbox" name="volume" size="4" maxlength="80" value="<?=$returned[19]?>"></td>
<td><?=$lang_sources36?></td><td><input type="text" class="inputbox" name="number" id="number" size="20" maxlength="80" value="<?=$returned[20]?>"> </td>
</tr>
<tr>
<td><?=$lang_sources37?></td><td><input type="text" name="year" class="inputbox" size="20" maxlength="80" value="<?=$returned[21]?>"> </td>
<td><?=$lang_sources38?></td> <td><input type="text" class="inputbox" name="bibtexkey" size="20" maxlength="80" value="<?=$returned[22]?>"> </td>
</tr>
<tr>
<td><?=$lang_sources39?></td><td><textarea name="bibtex" id="bibtex" class="inputbox" rows="2" cols="20"><?=$returned[23]?>
</textarea> </td>
<td><?=$lang_sources40?></td><td><textarea name="link" class="inputbox" rows="2" cols="20"><?=$returned[24]?>
</textarea></td>
</tr>
<tr>
<td>
</td><td>
</td>
<td><?=$lang_sources41?></td><td><input type="text" class="inputbox" name="visit_time" size="20" maxlength="80" value="<?=$returned[25]?>"> </td>
<td>
</td></tr>
</table>
</form>
</div>
<?php
}		
// list of bibliography
} else {
if (($_SESSION["rights"]==1) OR ($_SESSION["rights"]==2)){?>
<div class="menu_sub">
<ul>
<li><a href="./sources.php?action=add"><?=$lang_sources1?></a></li> 
<li><a href="./sources.php?editsources_show=true"><?=$lang_sources2?></a></li> 
</ul>
</div>	
<?php } ?>
<p>
<?php 
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$sql = sprintf ('SELECT * FROM `%s` ORDER BY `category`, `id`',
	$table);		
$oop->Setnames(); 
$oop->query($sql);
$as=0; $a1=0; $a2=0; $a3=0; $a4=0; $a5=0;
while ($row = $oop->fetchArray()) :
$as++;
if (($row[2]=='dictionaries') AND ($a1==0)) {
$a1++;
?>
<strong><?=$lang_sources_1?><br><br></strong>
<?php
} else if (($row[2]=='other_material') AND ($a2==0)) {
$a2++;?>
<br>
<strong><?=$lang_sources_2?><br><br></strong>
<?php
} else if (($row[2]=='online_dictionaries') AND ($a3==0)) {
$a3++;
?>
<br>
<strong><?=$lang_sources_3?><br><br></strong>
<?php
} else if (($row[2]=='other_online_material') AND ($a4==0)) {
$a4++;
?>
<br>
<strong><?=$lang_sources_4?><br><br></strong>
<?php
} else if (($row[2]=='programming') AND ($a5==0)) {
$a5++;
?>
<br>
<strong><?=$lang_sources_5?><br><br></strong>
<?php
} 
if ($_SESSION["editsources_show"]=='1') {
echo '<a href="./sources.php?action=edit&id='.$row[0].'"><img src="/images/dec_2.png" border="0" alt=""></a>';
echo '<a href="./sources.php?action=delete&id='.$row[0].'"><img src="/images/b_drop.png" border="0" alt=""></a>';
}
echo ' '.$as.'. '; 
if ($row[8]!='') {
echo $row[8].', '.$row[4].'. ';
}
if ($row[9]!='') {
echo $row[9].', '.$row[5].'. ';
}
if ($row[10]!='') {
echo $row[10].', '.$row[6].'. ';
}
if ($row[11]!='') {
echo $row[11].', '.$row[7].'. ';
}
// title
if ($row[24]!='') { 
echo '<entry class="italic2"><a href="'.$row[24].'" target="_blank">'.$row[3].'.</a></entry>';
} else {
echo '<entry class="italic2">'.$row[3].'.</entry>';	 
}
// address
if ($row[17]!='') {
echo ' '.$row[17].'.';
}
if ($row[16]!='') { 
// publisher
echo ' '.$row[16].',';
}
if ($row[21]!='') { 
// year
echo ' '.$row[21].'.';
}
echo '<br>';
endwhile;
$oop->FreeResult();
$oop->_mySQL;	
?>
</p>
</div>
<?php } ?>
<div style="clear: both;">&nbsp;</div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div></div><?php 
include ('./html_end.php');
?>
