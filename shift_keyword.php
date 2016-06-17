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
$dict = 'ds_2_senses';
$dict_keyword = 'ds_1_headword';
//php lock
$oop_lock = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$sql = sprintf ('SELECT `LOCK_KEY`, `LOCK_EXPIRY_TIME` FROM `%s` WHERE `keyword` = %s AND `num_keyword` = %s',
	$dict_keyword,					
	quate_smart($_SESSION["d_h"]),
	quate_smart($_SESSION["d_h_n"]));
$oop_lock->Setnames();							
$oop_lock->query($sql);
$lock= $oop_lock->fetchRow ();
$oop_lock->freeResult();
$time_now=date("Y-m-d H:i:s");
if ($lock[0]!=0) {
if ($_SESSION["id_user"]!=$lock[0]) {
if ($lock[1]>=$time_now) {
$_SESSION["ses_message"].=$lang_lock1.$lock[1];
$location = 'Location: ./search.php?list_kind=alpha&amp;d_h='.$_SESSION["d_h"].'&amp;d_h_n='.$_SESSION["d_h_n"].'';
header($location);
Die();
}}}
$sql = sprintf ('UPDATE `%s` SET `LOCK_KEY` = %s, `LOCK_EXPIRY_TIME` = ADDTIME(NOW(),"00:10:00") WHERE `keyword` = %s AND `num_keyword` = %s',
	$dict_keyword,					
	quate_smart($_SESSION["id_user"]),
	quate_smart($_SESSION["d_h"]),
	quate_smart($_SESSION["d_h_n"]));
$oop_lock->Setnames();							
$oop_lock->query($sql);
$oop_lock->freeResult();
$oop_lock->_mySQL;
//end php lock
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
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
<h2><?=$lang_shift_keyword?></h2>
<?php 
if ($_GET["action"]=='detail') {
?> 
<?=$lang_edit_list_of_homonyms?>
<br>
<?=$lang_shift1?><br><br>
<?php
$table_keyword='ds_1_headword';
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s',
	$table_keyword,
	$collation_1,
	quate_smart($_GET["d_h"]));
$oop->Setnames();
$oop->query($sql);
$num = $oop->getNumRows();
$nn=0;
while($returned = $oop->fetchRow ()) :
$new_num_keyword=$returned[2]+1;
$new_num_smaller_keyword=$returned[2]-1;
if ($returned[2]==0) {
echo "<a href=\"./shift_keyword.php?action=change&direction=up&d_h=".$returned[1]."&d_h_n=".$returned[2]."&new_num_keyword=".$new_num_keyword."\"> ".$lang_shift2." ".$returned[1]." ".$lang_shift3." ".$returned[1]."  (".$returned[7].") ".$lang_shift4."  <sup>".$new_num_keyword."</sup>".$returned[1]."</sup></a><br>";
echo "<br>";
echo "<a href=\"./shift_keyword.php?action=change&direction=down&d_h=".$returned[1]."&d_h_n=".$returned[2]."&new_num_keyword=".$new_num_smaller_keyword."\"> ".$lang_shift2." ".$returned[1]." ".$lang_shift3." ".$returned[1]."  (".$returned[7].") ".$lang_shift4."  <sup>".$new_num_smaller_keyword."</sup>".$returned[1]."</sup></a><br>";
} else {
echo "<a href=\"./shift_keyword.php?action=change&direction=up&d_h=".$returned[1]."&d_h_n=".$returned[2]."&new_num_keyword=".$new_num_keyword."\"> ".$lang_shift2." ".$returned[1]." ".$lang_shift3." <sup>".$returned[2]."</sup>".$returned[1]."  (".$returned[7].") ".$lang_shift4."  <sup>".$new_num_keyword."</sup>".$returned[1]."</sup></a><br>";
echo "<br>";
echo "<a href=\"./shift_keyword.php?action=change&direction=down&d_h=".$returned[1]."&d_h_n=".$returned[2]."&new_num_keyword=".$new_num_smaller_keyword."\"> ".$lang_shift2." ".$returned[1]." ".$lang_shift3." <sup>".$returned[2]."</sup>".$returned[1]."  (".$returned[7].") ".$lang_shift4."  <sup>".$new_num_smaller_keyword."</sup>".$returned[1]."</sup></a><br>";
}
endwhile;
$oop->freeResult();
}
if ($_GET["action"]=='change') {
$update=FALSE;
$table_keyword='ds_1_headword';
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`=%s',
	$table_keyword,
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["new_num_keyword"]));
$oop->Setnames();
$oop->query($sql);
$num = $oop->getNumRows();
$oop->freeResult();
// to get grammatical info
$table_keyword='ds_1_headword';
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`=%s',
	$table_keyword,
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]));
$oop->Setnames();
$oop->query($sql);
$returned=$oop->FetchRow();
$oop->freeResult();
if ($num!=0) {
if ($_GET["direction"]=='up') {
$plus_two=$_GET["new_num_keyword"]+1;
} else {
$plus_two=$_GET["new_num_keyword"]-1;	 
}
// to find out whether the keyword with new num, keyword exists already
$table_keyword='ds_1_headword';
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`=%s',
	$table_keyword,
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($plus_two));
$oop->Setnames();
$oop->query($sql);
$num2 = $oop->getNumRows();
$oop->freeResult();
if ($num2!=0) {
echo $lang_shift5.''.$_GET["new_num_keyword"].' '.$lang_shift6.' '.$plus_two.' '.$lang_shift7.'';
} else {
$update=TRUE;
$_GET["new_num_keyword"]=$plus_two;
}
} else {
$update=TRUE;
}
// no result -> no keyword with the future num_keyword, we can change it
if ($update===TRUE) {
// ds_1_headword
$table='ds_1_headword';
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
$keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
$page_id=524; 
include './work.php'; 
// ds_2_senses
$table='ds_2_senses';
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
// ds_2_senses_status
$table='ds_2_senses_status';
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
/// EXAMPLE in ds_2_senses
$table='ds_2_senses';
$sql = sprintf ('SELECT `example_keyword`, `id` FROM `%s`',
	$table);
$oop->Setnames();
$oop->query($sql);
while ($row=$oop->FetchRow()):
$view=FALSE;
// IF BOTH NUM KEYWORDS ARE NOT ZERO {
if (($_GET["d_h_n"]!=0) AND ($_GET["new_num_keyword"]!=0)) {
// ,koma (2),
$to_compare=','.$_GET["d_h"].'('.$_GET["d_h_n"].'),';
$pos = strpos($row[0], $to_compare);
if ($pos!==FALSE) {
$view=TRUE;
// ,koma (1),
$new_string = ','.$_GET["d_h"].'('.$_GET["new_num_keyword"].'),';
$bodytag = str_replace($to_compare, $new_string, $row[0]);
$sql2 = sprintf ('UPDATE `%s` SET `example_keyword` = %s WHERE `id` = %s',
	$table,					
	quate_smart($bodytag),
	quate_smart($row[1])); 
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
}
}
// IF new num keyword becomes zero {
if (($_GET["d_h_n"]!=0) AND ($_GET["new_num_keyword"]==0)) { 
// ,koma (1),
$to_compare=','.$_GET["d_h"].'('.$_GET["d_h_n"].'),';
$pos = strpos($row[0], $to_compare);
if ($pos!==FALSE) {
$view=TRUE;
// ,koma,
$new_string = ','.$_GET["d_h"].',';
$bodytag = str_replace($to_compare, $new_string, $row[0]);
$sql2 = sprintf ('UPDATE `%s` SET `example_keyword` = %s WHERE `id` = %s',
	$table,					
	quate_smart($bodytag),
	quate_smart($row[1])); 
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
}
}
// IF old num keyword becomes not zero {
if (($_GET["d_h_n"]==0) AND ($_GET["new_num_keyword"]!=0)) { 
// ,koma,
$to_compare=','.$_GET["d_h"].',';
$pos = strpos($row[0], $to_compare);
if ($pos!==FALSE) {
// koma (1),
$new_string = ','.$_GET["d_h"].'('.$_GET["new_num_keyword"].'),';
$bodytag = str_replace($to_compare, $new_string, $row[0]);
$view=TRUE;
// ,koma (1),
$sql2 = sprintf ('UPDATE `%s` SET `example_keyword` = %s WHERE `id` = %s',
	$table,					
	quate_smart($bodytag),
	quate_smart($row[1])); 
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
}
}
endwhile;
$oop->freeResult();
/// END OF EXAMPLE CHANGE 
// SYNONYM in ds_2_senses
$table='ds_2_senses';
$sql = sprintf ('SELECT `synonym`, `id` FROM `%s`',
	$table);
$oop->Setnames();
$oop->query($sql);
while ($row=$oop->FetchRow()):
$continue = FALSE; $view=FALSE;
$num_3=str_word_count($row[0], 0, '1234567890ðöáéáíýóæú()');
// if word cout is 2 and if it contains (
// for example koma (2)
if ($num_3==2) {
$pos_3 = strpos($row[0], '(');
if ($pos_3!==FALSE){
$continue=TRUE;	
}
}
// if word count is 1
// for example leita
if ($num_3==1) {
$continue=TRUE;
}
// if word count is bigger than 2 it means there can be no change in synonym
// for example koma heim
if ($continue===TRUE) {
// IF BOTH NUM KEYWORDS ARE NOT ZERO {
if (($_GET["d_h_n"]!=0) AND ($_GET["new_num_keyword"]!=0)) {
// koma (2),
$to_compare=$_GET["d_h"].'('.$_GET["d_h_n"].')';
$pos = strpos($row[0], $to_compare);
if ($pos!==FALSE) {
$view=TRUE;
// koma (1),
$new_string = $_GET["d_h"].'('.$_GET["new_num_keyword"].')';
$bodytag = str_replace($to_compare, $new_string, $row[0]);
$sql2 = sprintf ('UPDATE `%s` SET `synonym` = %s WHERE `id` = %s',
	$table,					
	quate_smart($bodytag),
	quate_smart($row[1])); 
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
}
}
// IF new num keyword becomes zero {
if (($_GET["d_h_n"]!=0) AND ($_GET["new_num_keyword"]==0)) { 
// koma (1),
$to_compare=$_GET["d_h"].'('.$_GET["d_h_n"].')';
$pos = strpos($row[0], $to_compare);
if ($pos!==FALSE) {
$view=TRUE;
// koma,
$new_string = $_GET["d_h"];
$bodytag = str_replace($to_compare, $new_string, $row[0]);
$sql2 = sprintf ('UPDATE `%s` SET `synonym` = %s WHERE `id` = %s',
	$table,					
	quate_smart($bodytag),
	quate_smart($row[1])); 
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
}
}
// IF old num keyword becomes not zero {
if (($_GET["d_h_n"]==0) AND ($_GET["new_num_keyword"]!=0)) { 
// koma,
$to_compare=$_GET["d_h"];
$pos = strpos($row[0], $to_compare);
$pos2 = strpos($row[0], '(');
if (($pos!==FALSE) AND ($pos2===FALSE) AND ($_GET["d_h"]==$row[0])) {
$view=TRUE;
// koma (1),
$new_string = $_GET["d_h"].'('.$_GET["new_num_keyword"].')';
$bodytag = str_replace($to_compare, $new_string, $row[0]);
$sql2 = sprintf ('UPDATE `%s` SET `synonym` = %s WHERE `id` = %s',
	$table,					
	quate_smart($bodytag),
	quate_smart($row[1])); 
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
}
}
}
endwhile;
$oop->freeResult();
// END OF SYNOYM
// link CHANGE 
$table='ds_2_senses';
$sql = sprintf ('SELECT `link`, `id` FROM `%s`',
	$table);
$oop->Setnames();
$oop->query($sql);
while ($row=$oop->FetchRow()):
$continue = FALSE; $view=FALSE;
$num_3=str_word_count($row[0], 0, '1234567890ðöáéáíýóæú()');
// if word cout is 2 and if it contains (
// for example koma (2)
if ($num_3==2) {
$pos_3 = strpos($row[0], '(');
if ($pos_3!==FALSE){
$continue=TRUE;	
}
}
// if word count is 1
// for example leita
if ($num_3==1) {
$continue=TRUE;
}
// if word count is bigger than 2 it means there can be no change in synonym
// for example koma heim
if ($continue===TRUE) {
// IF BOTH NUM KEYWORDS ARE NOT ZERO {
if (($_GET["d_h_n"]!=0) AND ($_GET["new_num_keyword"]!=0)) {
// koma (2),
$to_compare=$_GET["d_h"].'('.$_GET["d_h_n"].')';
$pos = strpos($row[0], $to_compare);
if ($pos!==FALSE) {
$view=TRUE;
// koma (1),
$new_string = $_GET["d_h"].'('.$_GET["new_num_keyword"].')';
$bodytag = str_replace($to_compare, $new_string, $row[0]);
$sql2 = sprintf ('UPDATE `%s` SET `link` = %s WHERE `id` = %s',
	$table,					
	quate_smart($bodytag),
	quate_smart($row[1])); 
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
}
}
// IF new num keyword becomes zero {
if (($_GET["d_h_n"]!=0) AND ($_GET["new_num_keyword"]==0)) { 
// koma (1),
$to_compare=$_GET["d_h"].'('.$_GET["d_h_n"].')';
$pos = strpos($row[0], $to_compare);
if ($pos!==FALSE) {
$view=TRUE;
// koma,
$new_string = $_GET["d_h"];
$bodytag = str_replace($to_compare, $new_string, $row[0]);
$sql2 = sprintf ('UPDATE `%s` SET `link` = %s WHERE `id` = %s',
	$table,					
	quate_smart($bodytag),
	quate_smart($row[1])); 
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
}
}
// IF old num keyword becomes not zero {
if (($_GET["d_h_n"]==0) AND ($_GET["new_num_keyword"]!=0)) { 
// koma,
$to_compare=$_GET["d_h"];
$pos = strpos($row[0], $to_compare);
$pos2 = strpos($row[0], '(');
if (($pos!==FALSE) AND ($pos2===FALSE) AND ($_GET["d_h"]==$row[0])) {
$view=TRUE;
// koma (1),
$new_string = $_GET["d_h"].'('.$_GET["new_num_keyword"].')';
$bodytag = str_replace($to_compare, $new_string, $row[0]);
$sql2 = sprintf ('UPDATE `%s` SET `link` = %s WHERE `id` = %s',
	$table,					
	quate_smart($bodytag),
	quate_smart($row[1])); 
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
}
}
}
endwhile;
$oop->freeResult();
// END OF LINK
// ANTONYM CHANGE 
$table='ds_2_senses';
$sql = sprintf ('SELECT `antonym`, `id` FROM `%s`',
	$table);
$oop->Setnames();
$oop->query($sql);
while ($row=$oop->FetchRow()):
$continue = FALSE; $view=FALSE;
$num_3=str_word_count($row[0], 0, '1234567890ðöáéáíýóæú()');
// if word cout is 2 and if it contains (
// for example koma (2)
if ($num_3==2) {
$pos_3 = strpos($row[0], '(');
if ($pos_3!==FALSE){
$continue=TRUE;	
}
}
// if word count is 1
// for example leita
if ($num_3==1) {
$continue=TRUE;
}
// if word count is bigger than 2 it means there can be no change in synonym
// for example koma heim
if ($continue===TRUE) {
// IF BOTH NUM KEYWORDS ARE NOT ZERO {
if (($_GET["d_h_n"]!=0) AND ($_GET["new_num_keyword"]!=0)) {
// koma (2),
$to_compare=$_GET["d_h"].'('.$_GET["d_h_n"].')';
$pos = strpos($row[0], $to_compare);
if ($pos!==FALSE) {
$view=TRUE;
// koma (1),
$new_string = $_GET["d_h"].'('.$_GET["new_num_keyword"].')';
$bodytag = str_replace($to_compare, $new_string, $row[0]);
$sql2 = sprintf ('UPDATE `%s` SET `antonym` = %s WHERE `id` = %s',
	$table,					
	quate_smart($bodytag),
	quate_smart($row[1])); 
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
}
}
// IF new num keyword becomes zero {
if (($_GET["d_h_n"]!=0) AND ($_GET["new_num_keyword"]==0)) { 
// koma (1),
$to_compare=$_GET["d_h"].'('.$_GET["d_h_n"].')';
$pos = strpos($row[0], $to_compare);
if ($pos!==FALSE) {
$view=TRUE;
// koma,
$new_string = $_GET["d_h"];
$bodytag = str_replace($to_compare, $new_string, $row[0]);
$sql2 = sprintf ('UPDATE `%s` SET `antonym` = %s WHERE `id` = %s',
	$table,					
	quate_smart($bodytag),
	quate_smart($row[1])); 
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
}
}
// IF old num keyword becomes not zero {
if (($_GET["d_h_n"]==0) AND ($_GET["new_num_keyword"]!=0)) { 
// koma,
$to_compare=$_GET["d_h"];
$pos = strpos($row[0], $to_compare);
$pos2 = strpos($row[0], '(');
if (($pos!==FALSE) AND ($pos2===FALSE) AND ($_GET["d_h"]==$row[0])) {
$view=TRUE;
// koma (1),
$new_string = $_GET["d_h"].'('.$_GET["new_num_keyword"].')';
$bodytag = str_replace($to_compare, $new_string, $row[0]);
$sql2 = sprintf ('UPDATE `%s` SET `antonym` = %s WHERE `id` = %s',
	$table,					
	quate_smart($bodytag),
	quate_smart($row[1])); 
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
}
}
}
endwhile;
$oop->freeResult();
// END OF ANTONYM
// ds_dec_noun
$table='ds_dec_noun';
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
// ds_wordform
$table='ds_wordform';
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
// ds_dec_pron
$table='ds_dec_pron';
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
// ds_dec_pron_pers
$table='ds_dec_pron_pers';
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
// ds_dec_adv
$table='ds_dec_adv';
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
// ds_dec_adj_1
$table='ds_dec_adj_1';
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
// ds_dec_adj_2
$table='ds_dec_adj_2';
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
// ds_dec_adj_3
$table='ds_dec_adj_3';
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
// ds_dec_adj_info
$table='ds_dec_adj_info';
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
// ds_dec_v_1
$table='ds_dec_v_1';
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
// ds_dec_v_2
$table='ds_dec_v_2';
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
// ds_dec_v_3
$table='ds_dec_v_3';
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
// ds_dec_v_4
$table='ds_dec_v_4';
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
// ds_dec_v_info
$table='ds_dec_v_info';
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
// ds_work
$table='ds_work';
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
// ds_history
$table='ds_history';
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
// ds_images
$table_images='ds_images';
$sql4 = sprintf ('SELECT `keyword`, `num_keyword`, `name_of_file`, `id` FROM `%s` WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table_images,
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql4);
$num2 = $oop->getNumrows(); 
if ($num2!=0) {
$oop5 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
setlocale(LC_ALL, 'is_IS.UTF8');
$uploadsDirectory = $con_uploadsDirectory;
while ($image = $oop->fetchArray ()):
$now=1;
$tofile = $image[0];
$tofile = preg_replace('~[^\\pL0-9_]+~u', '-', $tofile);
$tofile = trim($tofile, "-");
$tofile = iconv("utf-8", "us-ascii//TRANSLIT", $tofile);
$tofile = strtolower($tofile);
$tofile = preg_replace('~[^-a-z0-9_]+~', '', $tofile);
$ext= strtolower(substr(strrchr($image[2], '.'), 1));
while(file_exists($uploadsDirectory.'ds_image_'.$tofile.'_'.$_GET["new_num_keyword"].'_'.$now.'.'.$ext)) {
$now++;
}
$file='ds_image_'.$tofile.'_'.$_GET["new_num_keyword"].'_'.$now.'.'.$ext;
rename ('images/uploaded_files/'.$image[2], 'images/uploaded_files/'.$file);
rename ('images/uploaded_files/th_'.$image[2], 'images/uploaded_files/th_'.$file);		
$sql = sprintf ('UPDATE `%s` SET `name_of_file` = %s WHERE `id`= %s',
	$table_images,					
	quate_smart($file),
	quate_smart($image[3])); 
$oop5->Setnames();
$oop5->query($sql);
$oop5->freeResult();
endwhile;
$oop->freeResult();	
$oop5->_mySQL;	
}
$oop->freeResult();
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table_images,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
// ds_sound
$table_sound='ds_sound';
$sql4 = sprintf ('SELECT `keyword`, `num_keyword`, `sound`, `id` FROM `%s` WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table_sound,
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql4);
$num2 = $oop->getNumrows(); 
if ($num2!=0) {
$oop5 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
setlocale(LC_ALL, 'is_IS.UTF8');
$uploadsDirectory = $sound_uploadsDirectory;
while ($sound = $oop->fetchArray ()):
$now=1;
$tofile = $sound[0];
$tofile = preg_replace('~[^\\pL0-9_]+~u', '-', $tofile);
$tofile = trim($tofile, "-");
$tofile = iconv("utf-8", "us-ascii//TRANSLIT", $tofile);
$tofile = strtolower($tofile);
$tofile = preg_replace('~[^-a-z0-9_]+~', '', $tofile);
$ext= strtolower(substr(strrchr($sound[2], '.'), 1));
while(file_exists($uploadsDirectory.'ds_'.$tofile.'_'.$_GET["new_num_keyword"].'_'.$now.'.'.$ext)) {
$now++;
}
$file='ds_'.$tofile.'_'.$_GET["new_num_keyword"].'_'.$now.'.'.$ext;
rename ('audio/uploaded_files/'.$sound[2], 'audio/uploaded_files/'.$file);
$sql = sprintf ('UPDATE `%s` SET `sound` = %s WHERE `id`= %s',
	$table_sound,					
	quate_smart($file),
	quate_smart($sound[3])); 
$oop5->Setnames();
$oop5->query($sql);
$oop5->freeResult();
endwhile;
$oop->freeResult();	
$oop5->_mySQL;	
}
$sql = sprintf ('UPDATE `%s` SET `num_keyword` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table_sound,					
	quate_smart($_GET["new_num_keyword"]),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
$page_id=17;
$keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["new_num_keyword"];
include 'work.php';
}
$_SESSION["ses_message"]=" ".$lang_edit_changed_confirm." ".$_GET["d_h"]." (".$_GET["new_num_keyword"].") ".$returned[7]." ".$lang_edit_changed_from." (".$_GET["d_h_n"].")";
$location = 'Location: ./search.php?list_kind=alpha&d_h='.$_GET["d_h"].'&d_h_n='.$_GET["new_num_keyword"].'';
header($location);
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