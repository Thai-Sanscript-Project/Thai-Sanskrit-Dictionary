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
include './start.php';
include './scripts/redirect_public.php';
include './head_s.php';
$dir  = "./language/";
$dir_path = $dir.$_SESSION["lang"]."/lang_import.php";
include ($dir_path);
?>
<script type="text/javascript" src="./import/SolmetraUploader.js"></script>
<script type="text/javascript">
SolmetraUploader.setErrorHandler('test');
function test (id, str) { alert('ERROR: ' + str); }
SolmetraUploader.setEventHandler('testEvent');
function testEvent (id, str, data) { /*alert('EVENT: ' + str);*/ }
</script>
</head>
<?php
$fieldseparator = ",";
$lineseparator = "\n";
$realpath= realpath(dirname('./connection.php'));
$importpath=$realpath.'/import/uploads';
?>
<body onload="setfocus ()">
<div id="wrapper">
<?php include 'header.php';
include 'menu.php'; 
echo $MAIN_MENU;
$dict_keyword="ds_1_headword";
$dict="ds_2_senses";
$searched_areas_keyword = array(
'notinclude' => $lang_import29,
'keyword' => $lang_search_klicove_slovo,
'num_keyword' => $lang_search_cat26,
'keyword_variant' => $lang_search_cat2,
'gram_1_word_group' => $lang_search_cat5,
'gram_2_endings' => $lang_search_cat6,
'gram_3_additional' => $lang_search_cat7,
'pronunciation' => $lang_search_pron,
'stem' => $lang_search_cat1,
'keyword_notes' => $lang_search_cat8,
'frequency' => $lang_search_cat9,
'words_in_compound' => $lang_import30,
'words_in_compound2' => $lang_import31,
);
$searched_areas_sense = array(	
'gram_2' => $lang_search_cat10,
'synonym' => $lang_search_cat11,
'synonym_link' => $lang_import32,
'word' => $lang_search_cat13,
'translation' => $lang_search_cat14,
'translation_detail' => $lang_search_cat15,
'translation_usage' => $lang_import33,
'order' => $lang_import34,
'antonym' => $lang_search_cat16,
'sec_marker' => $lang_search_cat17,
'link' => $lang_search_cat18,
'example' => $lang_search_cat19,
'example_translation' => $lang_search_cat20,
'example_keyword' => $lang_search_cat12,
'notes' => $lang_search_cat21,
'specification' => $lang_search_cat22,
'usage_specification' => $lang_search_cat25,
'usage_category' => $lang_search_cat27,
'latinnames' => $lang_search_cat23,
'marker' => $lang_search_cat24,
'category' => $lang_import35,
'phrase' => $lang_import36,
'phrase_order' => $lang_import37,
);
?>
<div id="content">
<div class="left_huge">
<h2><?=$lang_import_headings?></h2>
<?php
if ($_GET["action"]=="specify") {
?>
<h3><?=$lang_import1?></h3>
<?=$lang_import2?>
<br>
<?=$lang_import3?> <strong><?=$importpath?></strong> <?=$lang_import4?> 
<?php
if (is_writable($importpath)===TRUE) {
echo '<strong>'.$lang_import5.'</strong>.';
} else {
echo $lang_import6;	
}
$tmppath=$realpath.'/import/tmp/';
?>
<?=$lang_import7?> <?=$tmppath?>. <?=$lang_import8?> 
<?php
if (is_writable($tmppath)===TRUE) {
echo '<strong>'.$lang_import5.'</strong>.';
} else {
echo $lang_import6;	
}
?>
<br>
<br>
<?php
// === Include main Uploader class
include './import/SolmetraUploader.php';
// === Instantiate the class
$solmetraUploader = new SolmetraUploader(
'./import/',           // a base path to Flash Uploader's directory (relative to the page)
'upload.php',       // path to a file that handles file uploads (relative to uploader.swf) [optional]
'./import/config.php'  // path to a server-side config file (relative to the page) [optional]
);
?>
<form action="import_csv.php?action=prepare" method="post">
<?php
//$solmetraUploader->setDemo(10);
echo $solmetraUploader->getInstance('firstFile',      // name of the field 
        500,              // width
        40,               // height
        true              // yes - it's required
        // the rest of the parameters are taken from config file
       );
?>
<br />
<?php
$solmetraUploader->gatherUploadedFiles();
if (isset($_FILES) && sizeof($_FILES)) {
$csvfile=$_FILES["firstFile"]["name"];
}
?>
<input type="hidden" name="csvfile" value="<?=$csvfile?>">
<?php
$oop_check = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 	
$sql = sprintf ('SELECT `id` FROM `%s`',
	$dict_keyword);
$oop_check->Setnames();							
$oop_check->query($sql);
$num1 = $oop_check->getNumrows(); 
$oop_check->freeResult();
$sql = sprintf ('SELECT `id` FROM `%s`',
	$dict);
$oop_check->Setnames();							
$oop_check->query($sql);
$num2 = $oop_check->getNumrows(); 
$oop_check->freeResult();$oop_check->_mySQL;
//truncate or not
if (($num1!=0) or ($num2!=0)) {
echo $lang_import9." ".$num1." ".$lang_import10." ".$num2."  ".$lang_import11;
echo '<br><br><input type="checkbox" name="truncate" value="2"> '.$lang_import12;
} else {
echo $lang_import13;
echo '<input type="hidden" name="truncate" value="1">';
}
?>
<br>
<input type="submit" value="<?=$lang_import38?>" />
</form>
<br>
<br>
<?=$lang_import14?> <strong><?=$collation_1?></strong>. <?=$lang_import15?>
<br>
<?=$lang_import16?>
<br>
<?php
} else if ($_GET["action"]=="prepare") {
?>
<h3><?=$lang_import17?></h3>
<?php
if ($_GET["goback"]!='true') {
include './import/SolmetraUploader.php';
$solmetraUploader = new SolmetraUploader(
'./import/',           // a base path to Flash Uploader's directory (relative to the page)
'upload.php',       // path to a file that handles file uploads (relative to uploader.swf) [optional]
'./import/config.php'  // path to a server-side config file (relative to the page) [optional]
);
$solmetraUploader->gatherUploadedFiles();
if (isset($_FILES) && sizeof($_FILES)) {
$csvfile=$_FILES["firstFile"]["name"];
}
$pathtofile=$realpath."/import/uploads/".$csvfile;
echo $pathtotile;
echo '<br>';
if ($_POST["truncate"]=='2' ) {
$oop_check = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 	
$sql = sprintf ('TRUNCATE TABLE `%s`',
	$dict_keyword);
$oop_check->Setnames();							
$oop_check->query($sql);
$num1 = $oop_check->getNumrows(); 
$oop_check->freeResult();
$sql = sprintf ('TRUNCATE TABLE `%s`',
	$dict);
$oop_check->Setnames();							
$oop_check->query($sql);
$num2 = $oop_check->getNumrows(); 
$oop_check->freeResult();$oop_check->_mySQL;
echo $lang_import18." <br><br>";
} else {
echo "";
}
/********************************/
} else {
$pathtofile=$realpath."/import/uploads/".$_GET["file"];	
$csvfile=$_GET["file"];
}
$content = file($pathtofile);
$csvcontent = $content[0];
$lines=0;
foreach(split($lineseparator,$csvcontent) as $line) {
$lines++;
if ($lines == 1) {
$line = trim($line," \t");
$line = str_replace("\r","",$line);
/************************************
This line escapes the special character. remove it if entries are already escaped in the csv file
************************************/
$line = str_replace("'","\'",$line);
$line = str_replace("\"","",$line);
/*************************************/
$linearray = explode($fieldseparator,$line);
// number of columns
$n_count=count($linearray);
echo $lang_import19.' '.count($linearray).'<br><br>';
}
}
?>
<?=$lang_import20?>
<form action="./import_csv.php?action=import&n_count=<?=$n_count?>&file=<?=$csvfile?>&import_limit=0" method="post" name="form1">
<table  class="sample">
<?php
foreach ($linearray as $key => $v) {
?>
<tr> 
<td>
<?php
echo $v;
?>
</td><td>
<select name="<?=$key?>">
<?php 
$ee=0;
foreach ($searched_areas_keyword as $key1 => $value) {
$ee++;	
echo '<option value="'.$key1.'">'.$value.'</option>';
}
foreach ($searched_areas_sense as $key1 => $value) {
$ee++;
echo '<option value="'.$key1.'">'.$value.'</option>';
}
?>
</select> 
</td></tr>
<?php
}
?>
<tr>
<td> </td><td>
<input type="submit" class="button2" name="submit" value="Import">
</td>
</tr>
</table>
</form> 
<?php
} else if ($_GET["action"]=="import") {
?>
<h3><?=$lang_import21?></h3>
<?php
if ($_GET["import_limit"]==0) {
$found=FALSE;
for ($k = 0; $k < $_GET["n_count"]; $k++) {
if ($_POST[$k]=='keyword') {
$found=TRUE;	
}}
if ($found===TRUE) {
} else {
//goback
$_SESSION["ses_message"] .= $lang_import22;	
$location = 'Location: ./import_csv.php?action=prepare&file='.$_GET["file"].'&goback=true';
header($location);
Die();	
}
$cc=0;
$bb=0;
for ($k = 0; $k < $_GET["n_count"]; $k++) {
if ($_POST[$k]=='notinclude') {
$bb++;	
}
}
for ($i = 0; $i < $_GET["n_count"]; $i++) {
for ($k = 0; $k <= $_GET["n_count"]; $k++) {
if (($_POST[$k]==$_POST[$i]) AND ($_POST[$k]!='notinclude')) {
$cc++;	
}
}
}
if (($cc+$bb)==$_GET["n_count"]) {
if ($_GET["import_limit"]==0) {
for ($i = 0; $i <= $_GET["n_count"]; $i++) {
$_SESSION["fields"][$i]=$_POST[$i];
}
}
//ok
} else {
//goback
$_SESSION["ses_message"] .= $lang_import23;	
$location = 'Location: ./import_csv.php?action=prepare&file='.$_GET["file"].'&goback=true';
header($location);
Die();
}
}
$csvfile =$_GET["file"];
$pathtofile=$realpath."/import/uploads/".$csvfile;
/********************************/
$content = file($pathtofile);
$all_count=$_GET["import_limit"]+100;
if ($_SESSION["all_lines"]=='') {
$all_lines = count(file($pathtofile));
$_SESSION["all_lines"]=$all_lines;
}
if ($all_count<$_SESSION["all_lines"]) {
for ($i = $_GET["import_limit"]; $i < $all_count; $i++) {
$csvcontent.=$content[$i];
}
$oop_import = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop_check = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$lines = 0;
$queries = "";
$linearray = array();
$line_count=0;
foreach(split($lineseparator,$csvcontent) as $line) {
$line_count++;
echo '<br>';
$lines++;
$line = trim($line," \t");
$line = str_replace("\r","",$line);
/************************************
This line escapes the special character. remove it if entries are already escaped in the csv file
************************************/
$line = str_replace("'","\'",$line);
$line = str_replace("\"","",$line);
/*************************************/
$linearray = explode($fieldseparator,$line);
$count =count ($linearray);
// decide if we specify according to keyword or keyword plus num_keyword
$found1=FALSE;
$found2=FALSE;
for ($i = 0; $i <= $count; $i++) {
if ($_SESSION["fields"][$i]=='keyword') {
$found1=TRUE;
$pos1=$i;
}
if ($_SESSION["fields"][$i]=='num_keyword') {
$found2=TRUE;
$pos2=$i;
}
}
$first_part="";
for ($i = 0; $i <= $count; $i++) {
if ($i==0) {
$first_part.='`id`';	
}
if ($_SESSION["fields"][$i]!='notinclude') {
if (array_key_exists($_SESSION["fields"][$i], $searched_areas_keyword)) {
if ($_SESSION["fields"][$i]) {
$first_part.=', `'.$_SESSION["fields"][$i].'`';	
}
}
}
}
$second_part="";
for ($i = 0; $i < $count; $i++) {
if ($i==0) {
$second_part.='NULL';	
}
if ($_SESSION["fields"][$i]!='notinclude') {
if (array_key_exists($_SESSION["fields"][$i], $searched_areas_keyword)) {
if ($_SESSION["fields"][$i]) {
$second_part.= ', '.quate_smart($linearray[$i]);
}
}
}
}
$third_part="";
for ($i = 0; $i <= $count; $i++) {
if ($i==0) {
$third_part.='`id`';	
if ($found1===TRUE) {
$third_part.=', `keyword`';		
}
if ($found2===TRUE) {
$third_part.=', `num_keyword`';		
}
}
if ($_SESSION["fields"][$i]!='notinclude') {
if (array_key_exists($_SESSION["fields"][$i], $searched_areas_sense)) {
if ($_SESSION["fields"][$i]) {
$third_part.=', `'.$_SESSION["fields"][$i].'`';	
}
}
}
}
$fourth_part="";
for ($i = 0; $i < $count; $i++) {
if ($i==0) {
$fourth_part.='NULL';	
if ($found1===TRUE) {
$fourth_part.=', '.quate_smart($linearray[$pos1]);		
}
if ($found2===TRUE) {
$fourth_part.=', '.quate_smart($linearray[$pos2]);		
}
}
if ($_SESSION["fields"][$i]!='notinclude') {
if (array_key_exists($_SESSION["fields"][$i], $searched_areas_sense)) {
if ($_SESSION["fields"][$i]) {
$fourth_part.= ', '.quate_smart($linearray[$i]);
}
}
}
}
$fifth_part='';
if ($found2===TRUE) {
$fifth_part.='AND `num_keyword` = '.quate_smart($linearray[$pos2]);	
} else {
}
$sql = sprintf ('SELECT `id` FROM `%s` WHERE `keyword` COLLATE %s = %s %s',
	$dict_keyword,					
	quate_smart($collation_1),
	quate_smart($linearray[$pos1]),
	$fifth_part);
$oop_check->Setnames();							
$oop_check->query($sql);
$num2 = $oop_check->getNumrows(); 
$oop_check->freeResult();
// only if there is no such keyword
if ($num2==0) {
	$_SESSION["i_headword"]++;
$sql = sprintf ('INSERT INTO `%s` (%s) VALUES (%s)',
	$dict_keyword,
	$first_part,
	$second_part);
	$oop_import->Setnames();
	$oop_import->query($sql);
	$oop_import->freeResult();	
} else {
}
$_SESSION["i_senses"]++;
$sql = sprintf ('INSERT INTO `%s` (%s) VALUES (%s)',
	$dict,
	$third_part,
	$fourth_part);
	$oop_import->Setnames();
	$oop_import->query($sql);
	$oop_import->freeResult();
} 
$oop_import->_mySQL; 
$oop_check->_mySQL; 
$_GET["import_limit"]=$_GET["import_limit"]+100;
$_SESSION["ses_message"] .= $lang_import24." (".$_GET["import_limit"]." ".$lang_import25;
$location = './import_csv.php?action=import&file='.$csvfile.'&import_limit='.$_GET["import_limit"];
header("Refresh: \"5\"; URL=\"".$location."\"");
Die();
} else {
$location = 'Location: ./import_csv.php?action=success';
header($location);
$oop_import->_mySQL; 
$oop_check->_mySQL; 
}
}  else if ($_GET["action"]=="success") {
?>
<?=$lang_import26?> <strong><?=$_SESSION["i_headword"]?></strong> <?=$lang_import27?> <strong><?=$_SESSION["i_senses"]?></strong> <?=$lang_import28?>
<?php
}
?>
</div>
<div style="clear: both;">&nbsp;</div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div></div><?php 
include ('./html_end.php');
?>
