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
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
if ($_POST["submit"]) {
if ($_POST["writing"]!='') {
$table = 'ds_phonems';
$sql = sprintf ('INSERT INTO `%s` (`id`, `writing`, `pronunciation`, `place`, `example_writing`, `example_pronunciation`, `additional_info`, `info2`, `explanation`, `options`) VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s)',
	$table,					
	quate_smart($_POST["writing"]),
	quate_smart($_POST["pronunciation"]),
	quate_smart($_POST["place"]),
	quate_smart($_POST["example_writing"]),
	quate_smart($_POST["example_pronunciation"]),
	quate_smart($_POST["additional_info"]),
	quate_smart($_POST["info2"]),
	quate_smart($_POST["explanation"]),
	quate_smart($_POST["options"]));	                     
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$oop->_mySQL;   
$page_id=520; 
$_SESSION["ses_message"] .= $lang_phonetics_mes1;
include './work.php'; 
}
$location = 'Location: ./phonetics.php';
header($location);
} 
if ($_POST["submit_edit"]) {
$table = 'ds_phonems';
$sql = sprintf ('UPDATE `%s` SET `writing` = %s, `pronunciation` = %s, `place` = %s, `example_writing` = %s, `example_pronunciation` = %s, `additional_info` = %s, `info2` = %s, `explanation` = %s, `options`= %s WHERE `id` = %s',
	$table,					
	quate_smart($_POST["writing"]),
	quate_smart($_POST["pronunciation"]),
	quate_smart($_POST["place"]),
	quate_smart($_POST["example_writing"]),
	quate_smart($_POST["example_pronunciation"]),
	quate_smart($_POST["additional_info"]),
	quate_smart($_POST["info2"]),
	quate_smart($_POST["explanation"]),
	quate_smart($_POST["options"]),
	quate_smart($_POST["id"]));	                     
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$oop->_mySQL;   
$page_id=521; 
include './work.php'; 
$_SESSION["ses_message"] .= $lang_phonetics_mes2;
$location = 'Location: ./phonetics.php';
header($location);
}
} else {
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
<h2><?=$lang_phonetics_mes3?></h2>
<?php
if ($_GET["subaction"]=='edit') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table=  'ds_phonems';
$sql = sprintf ('SELECT * FROM `%s` WHERE `id`= %s',
	$table,
	quate_smart($_GET["id"]));
$oop->Setnames();
$oop->query($sql);
$returned = $oop->fetchRow();
$oop->FreeResult();
?>
<div id="viewentry">
<form action="phonetics.php?action=confirm" method="post" name="form1">
<table  class="sample">
<input type="hidden" name="id" value="<?=$returned[0]?>">  
<tr>
<td><?=$lang_phonetic4?> </td>
<td><input type="text" class="inputbox" name="writing" size="14" maxlength="40" value="<?=$returned[1]?>"></td>
</tr>
<tr>
<td><?=$lang_phonetic5?> </td>
<td><input type="text" class="inputbox" name="pronunciation" size="14" maxlength="40" value="<?=$returned[2]?>"></td>
</tr>
<tr>
<td><?=$lang_phonetic6?> </td>
<td>
<select name="place" >
<option value="1" <?php if (($returned[3])==1) { echo 'selected';}?>><?=$lang_phonetic7?></option>
<option value="6" <?php if (($returned[3])==6) { echo 'selected';}?>><?=$lang_phonetic23?></option>
<option value="2" <?php if (($returned[3])==2) { echo 'selected';}?>><?=$lang_phonetic8?></option>
<option value="3" <?php if (($returned[3])==3) { echo 'selected';}?>><?=$lang_phonetic9?></option>
<option value="4" <?php if (($returned[3])==4) { echo 'selected';}?>><?=$lang_phonetic20?></option>
<option value="5" <?php if (($returned[3])==5) { echo 'selected';}?>><?=$lang_phonetic21?></option>
</select> 
</td>
</tr>
<tr>
<td><?=$lang_phonetic10?> </td>
<td><input type="text" class="inputbox" name="example_writing" size="14" maxlength="40" value="<?=$returned[4]?>"></td>
</tr>
<tr>
<td><?=$lang_phonetic11?></td>
<td><input type="text" class="inputbox" name="example_pronunciation" size="14" maxlength="40" value="<?=$returned[5]?>"></td>
</tr>
<tr>
<td><?=$lang_phonetic12?></td>
<td><input type="text" class="inputbox" id="additional_info" name="additional_info" size="14" maxlength="40" value="<?=$returned[6]?>"></td>
</tr>
<tr>
<td><?=$lang_phonetic3?></td>
<td><input type="text" class="inputbox" name="info2" size="14" maxlength="40" value="<?=$returned[7]?>"></td>
</tr>
<tr>
<td><?=$lang_phonetic24?></td>
<td><textarea name="explanation" id="explanation" class="inputbox" rows="2" cols="20"><?=$returned[8]?></textarea></td>
</tr>
<tr>
<td><?=$lang_phonetic25?></td>
<td><input type="text" class="inputbox" name="options" size="14" maxlength="40" value="<?=$returned[9]?>"></td>
</tr>
<tr>
<td>
</td>
<td>
<input type="submit" class="button2" name="submit_edit" value="<?=$lang_phonetic14?>">
</td>
</tr>
</table>
</form>
</div>
<?php
} else {
?>
<h4><?=$lang_phonetic26?></h4>
<div id="viewentry">
<form action="phonetics.php?action=confirm" method="post" name="form1">
<table  class="sample">
<tr>
<td><?=$lang_phonetic4?> </td>
<td><input type="text" class="inputbox" id="writing" name="writing" size="14" maxlength="40"></td>
</tr>
<tr>
<td><?=$lang_phonetic5?></td>
<td><input type="text" class="inputbox" name="pronunciation" size="14" maxlength="40"></td>
</tr>
<tr>
<td><?=$lang_phonetic6?> </td>
<td>
<select name="place" >
<option value="1" selected><?=$lang_phonetic7?></option>
<option value="6"><?=$lang_phonetic23?></option>
<option value="2"><?=$lang_phonetic8?></option>
<option value="3"><?=$lang_phonetic9?></option>
<option value="4"><?=$lang_phonetic20?></option>
<option value="5"><?=$lang_phonetic21?></option>
</select> 
</td>
</tr>
<tr>
<td><?=$lang_phonetic10?></td>
<td><input type="text" class="inputbox" name="example_writing" size="14" maxlength="40"></td>
</tr>
<tr>
<tr>
<td><?=$lang_phonetic11?></td>
<td><input type="text" class="inputbox" name="example_pronunciation" size="14" maxlength="40"></td>
</tr>
<tr>
<tr>
<td><?=$lang_phonetic12?></td>
<td><input type="text" class="inputbox" id="additional_info" name="additional_info" size="14" maxlength="40"></td>
</tr>
<tr>
<td><?=$lang_phonetic13?></td>
<td><input type="text" class="inputbox" name="info2" size="14" maxlength="40"></td>
</tr>
<tr>
<td><?=$lang_phonetic25?></td>
<td><textarea name="explanation" id="explanation" class="inputbox" rows="2" cols="20"></textarea></td>
</tr>
<tr>
<tr>
<td><?=$lang_phonetic26?></td>
<td><input type="text" class="inputbox" name="options" size="14" maxlength="40" value=""></td>
</tr>
<td>
</td>
<td>
<input type="submit" class="button2" name="submit" value="<?=$lang_phonetic14?>">
</td>
</tr>
</table>
</form>
<br><br>
<a href="./pron_gen.php"><?=$lang_phonetic27?></a>
<br>
<h4><?=$lang_phonetic28?></h4>
<?php
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table=  'ds_phonems';
$sql = sprintf ('SELECT * FROM `%s` ORDER BY `writing` DESC',
	$table);
$oop->Setnames();
$oop->query($sql);
echo '<table class="sample">';
echo '<tr>';
echo '<td>'.$lang_phonetic3.'</td>';
echo '<td>'.$lang_phonetic4.'</td>';  
echo '<td>'.$lang_phonetic5.'</td>';
echo '<td>'.$lang_phonetic6.'</td>';
echo '<td>'.$lang_phonetic10.'</td>';
echo '<td>'.$lang_phonetic11.'</td>';
echo '<td>'.$lang_phonetic12.'</td>';
echo '<td>'.$lang_phonetic13.'</td>';
echo '<td>'.$lang_phonetic24.'</td>';
echo '</tr>';
while($returned = $oop->fetchRow()) :
echo '<tr>';
echo '<td>'.$returned[0].'</td>';
echo '<td><a href="./phonetics.php?subaction=edit&id='.$returned[0].'">'.$returned[1].'</a></td>';
echo '<td>'.$returned[2].'</td>';
echo '<td>'.$returned[3].'</td>';
echo '<td>'.$returned[4].'</td>';
echo '<td>'.$returned[5].'</td>';
echo '<td>'.$returned[6].'</td>';
echo '<td>'.$returned[7].'</td>';
echo '<td>'.$returned[8].'</td>';
echo '<td>'.$returned[9].'</td>';
echo '</tr>';
endwhile;
echo '</table>';
$oop->FreeResult();
?>
</div>
<?php
}
}
?>
</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div></div><?php 
include ('./html_end.php');
?>