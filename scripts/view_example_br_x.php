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
//// searched string with get_keyword
if ($_GET["d_h"]) { 
$ex_keyword=$_GET["d_h"];
$ex_num_keyword=$_GET["d_h_n"];
}
else // there was only one result => direct view
{
$ex_keyword=$view_keyword;
$ex_num_keyword=$view_num_keyword;
}
// num keyword bigger than zero
if ($ex_num_keyword!=0) {
$ex_search_keyword=','.$ex_keyword.'('.$ex_num_keyword.'),';
} else {
$ex_search_keyword=','.$ex_keyword.',';
}
$dict = 'ds_2_senses';
$dict_keyword = 'ds_1_headword';
$num_found=0;
$oop11_example_br = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$empty='';
$sql = sprintf ('SELECT `keyword`, `num_keyword`, `word`, `translation`, `example`, `example_translation`, `example_keyword`, `translation_detail`  FROM `%s` WHERE `example_keyword` COLLATE `%s` LIKE %s ',
	$dict,
	$collation_1,
	quate_two_wildcard($ex_search_keyword));
$oop11_example_br->Setnames();
$oop11_example_br->query($sql);
$num2 = $oop11_example_br->getNumrows(); 
if ($num2 != 0) { // 1
$nn=0;	$dd=0;
while ($row = $oop11_example_br->FetchRow()) :
if (($ex_keyword==$row[0]) AND ($ex_num_keyword==$row[1])) {
} else {
$str = $row[6];
$array1= explode (',', $str);
$word_same=FALSE;

foreach ($array1 as $value) {
if ($value!='') {
// if there is a ( it means there is num_keyword entered
// for example ganga(2)
if (strpos(trim($value), '(')!=0) {
$new_value= explode ('(',trim($value));	
$new_num_keyword = str_replace("(","",$new_value[1]);
$new_num_keyword = str_replace(",","",$new_num_keyword);
$new_num_keyword = str_replace(")","",$new_num_keyword);
$new_value[0] = str_replace(",","",$new_value[0]);
	
// there we check if anchor word do not repeat
$rr=0;
if (!empty($qq_anchor)) {
foreach ($qq_anchor as $val1) {
if (strpos(trim($val1), '(')!=0) {
$qq_new= explode ('(',trim($val1));	
$qq_num_keyword = str_replace("(","",$qq_new[1]);
$qq_num_keyword = str_replace(",","",$qq_num_keyword);
$qq_num_keyword = str_replace(")","",$qq_num_keyword);
$qq_keyword = trim(str_replace(",","",$qq_new[0]));
} else {
$qq_num_keyword = 0;
$qq_keyword = trim($val1);	
}
if ((($qq_keyword==$new_value[0]) AND ($qq_num_keyword==$new_num_keyword)) AND ($qq_word[$rr]==$row[2]))
{
$word_same=TRUE;	
}
$rr++;
}
}



if ((($ex_keyword==$new_value[0]) AND ($ex_num_keyword==$new_num_keyword)))
{
$word_same=FALSE;	
}

// cannot match otherwise it would use the field from the same keyword
if (($ex_keyword==$row[0]) AND ($ex_num_keyword==$row[1])) {
} else {

if (($ex_keyword==trim($new_value[0])) AND ($ex_num_keyword==trim($new_num_keyword))) {
if ($nn==0) {	$nn++;
$ex_message.= '<div class="main_entry">';
}
if ($row[1]==0) {
$ex_message.= "<span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=".$row[0]."&amp;d_h_n=".$row[1]."\">".$row[0]."</a></span>";
} else {
$ex_message.= "<span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=".$row[0]."&amp;d_h_n=".$row[1]."\"><sup>".$row[1]."</sup>".$row[0]."</a></span>";
}
if ($row[4]==''){
$num_found++;
$ex_message.= "<span class=\"word\"> ".$row[2]."</span>";
if ($row[3]!='') {
$ex_message.= "<span class=\"dtrn\">	    ".$row[3]."</span>"; 
} else {
$ex_message.= "<span class=\"ex_translation\">	    ".$row[7]."</span>";	
}
} else { 	
$ex_message.= "<span class=\"ex\">".$row[4]."</span>"; 
$ex_message.= "<span class=\"ex_translation\"> ".$row[5]."</span>";
}
$ex_message.= "<br>";
}
}
} else {
$value = str_replace(",","",$value);

// there we check if anchor word do not repeat
$rr=0;
if (!empty($qq_anchor)) {
foreach ($qq_anchor as $val1) {
if (strpos(trim($val1), '(')!=0) {
$qq_new= explode ('(',trim($val1));	
$qq_num_keyword = str_replace("(","",$qq_new[1]);
$qq_num_keyword = str_replace(",","",$qq_num_keyword);
$qq_num_keyword = str_replace(")","",$qq_num_keyword);
$qq_keyword = trim(str_replace(",","",$qq_new[0]));
} else {
$qq_num_keyword = 0;
$qq_keyword = trim($val1);	
}
// mýfluga == myfluga
if (($qq_keyword==$row[0]) AND ($qq_word[$rr]==$row[2]))
{
$word_same=TRUE;
} 
$rr++;
}
}
//ulfaldi == ulfaldi
if ($ex_keyword==trim($value))
{
//$word_same=FALSE;	
}

if ($ex_keyword==trim($value)) {
if ($nn==0) {	$nn++;
$ex_message.= '<div class="main_entry">';
}
if ($row[1]==0) {
$ex_message.= "<span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=".$row[0]."&amp;d_h_n=".$row[1]."\">".$row[0]."</a></span>";
} else {
$ex_message.= "<span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=".$row[0]."&amp;d_h_n=".$row[1]."\"><sup>".$row[1]."</sup>".$row[0]."</a></span>";
}
if ($row[4]==''){
$num_found++;
$ex_message.= "<span class=\"word\"> ".$row[2]."</span>";
$ex_message.= "<span class=\"dtrn\">	    ".$row[3]."</span>"; 
} else {	
$ex_message.= "<span class=\"ex\">".$row[4]."</span>"; 
$ex_message.= "<span class=\"ex_translation\"> ".$row[5]."</span>";
}
$ex_message.= "<br>";
}

}
}

}
}
// not the same word as in anchor word
if ($word_same===FALSE) {
$example_output .= $ex_message;
$ex_message='';
$started=TRUE;
} else {

$ex_message='';
}
endwhile;
if ($started===TRUE) {
$example_output .= "</div>";
}
}
$oop11_example_br->FreeResult();
$oop11_example_br->_mySQL;
?>
