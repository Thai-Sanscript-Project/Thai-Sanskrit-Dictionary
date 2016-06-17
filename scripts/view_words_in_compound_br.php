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
$dict_keyword = 'ds_1_headword';
$num_found=0;
$oop_ex = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$compound_found=FALSE;
$empty='';
$sql = sprintf ('SELECT `keyword`, `num_keyword`, `words_in_compound`  FROM `%s` WHERE `words_in_compound` NOT LIKE %s ',
	$dict_keyword,				
	quate_smart($empty));
$oop_ex->Setnames();
$oop_ex->query($sql);
$num2 = $oop_ex->getNumrows();
if ($num2 != 0) { // 1
$nn=0;	$dd=0; $id=0;
while ($row = $oop_ex->FetchRow()) :
$str = $row[2];
$array1= explode (',', $str);
$word_same=FALSE;
foreach ($array1 as $value) {
if (strpos(trim($value), '[')!=0) {
$new_value= explode ('[',trim($value));	
$word_compound_help = str_replace("[","",$new_value[1]);
$word_compound_help  = str_replace(",","",$word_compound_help );
$word_compound_help  = str_replace("]","",$word_compound_help );
$value = str_replace(",","",$new_value[0]);	
}
if (strpos(trim($value), '(')!=0) {
$new_value= explode ('(',trim($value));	
$new_num_keyword = str_replace("(","",$new_value[1]);
$new_num_keyword = str_replace(",","",$new_num_keyword);
$new_num_keyword = str_replace(")","",$new_num_keyword);
$new_value[0] = str_replace(",","",$new_value[0]);
if (($view_keyword==trim($new_value[0])) AND ($view_num_keyword==trim($new_num_keyword))) {
$compound_found=true;
if ($word_compound_help!='') {
$word_compound[$id][1]=$word_compound_help;
} else {
$word_compound[$id][1]=$value;
}
if ($row[1]==0) {
$word_compound[$id][2]= "<span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=".$row[0]."&amp;d_h_n=".$row[1]."\">".$row[0]."</a></span>";	
} else {
$word_compound[$id][2]= "<span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=".$row[0]."&amp;d_h_n=".$row[1]."\"><sup>".$row[1]."</sup>".$row[0]."</a></span>";
}
}
} else {
if ($view_keyword!=$row[0]) {
$value = str_replace(",","",$value);
if ($view_keyword==trim($value)) {
$compound_found=true;
if ($word_compound_help!='') {
$word_compound[$id][1]=$word_compound_help;
} else {
$word_compound[$id][1]=$value;
}
if ($nn==0) {	$nn++;
}
if ($row[1]==0) {
$word_compound[$id][2]= "<span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=".$row[0]."&amp;d_h_n=".$row[1]."\">".$row[0]."</a></span>";
} else {
$word_compound[$id][2]= "<span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=".$row[0]."&amp;d_h_n=".$row[1]."\"><sup>".$row[1]."</sup>".$row[0]."</a></span>";
}
$num_found++;
}
}
}
$id++;
}
// not the same word as in anchor word
if ($word_same===FALSE) {
echo $com_message;
$com_message='';
} else {
$com_message='';
}	
endwhile;
if ($compound_found===true) {
// Obtain a list of columns
foreach ($word_compound as $key => $row) {
$volume[$key]  = $row['1'];
$edition[$key] = $row['2'];
}
// Sort the data with volume descending, edition ascending
// Add $data as the last parameter, to sort by the common key
$compound_result='';
array_multisort($volume, SORT_DESC, $edition, SORT_ASC, $word_compound);
foreach ($word_compound as $value1) {
$aa++;
if ($value1[1]==$previous_v) {
$compound_result.= ''.$value1[2] .', ';	
} else {
if ($aa==1){
$br='';	
} else {
$br='<br>';	
}
$compound_result.= $br.$value1[1].' - '.$value1[2] .', ';
$previous_v=$value1[1];
}
}
}
}
$oop_ex->FreeResult();
$sql = sprintf ('UPDATE `%s` SET `words_in_compound2` = %s WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s ',
	$dict_keyword,
	quate_smart($compound_result),
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop_ex->Setnames();
$oop_ex->query($sql);
$oop_ex->FreeResult();
$oop_ex->_mySQL;
?>
