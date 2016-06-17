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
$usage_found=false;
$usage_list_found=false;
$table = 'ds_usage_category';
$table_dict1 = 'ds_2_senses';
$table_dict1_keyword = 'ds_1_headword';
$help_c=1;
$help_arr[0]='';
$num_found=0;
$usage_list_output="";
$oop00 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop11 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop66 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
// 1 we search for list of words belonging to the group 
$sql0 = sprintf ('SELECT `usage_category` FROM `%s` WHERE `keyword` COLLATE `%s` = %s  AND `num_keyword` = %s' ,
	$table_dict1,
	$collation_1,
	quate_smart($usage_keyword),
	quate_smart($usage_num_keyword),
	quate_smart($empty));
$oop11->Setnames();
$oop11->query($sql0);
$num0 = $oop11->getNumrows(); 
if ($num0 != 0) { // 1
while ($row0 = $oop11->FetchRow()):
if ($row0[0]!='') {
$sql0 = sprintf ('SELECT `keyword`, `num_keyword` FROM `%s` WHERE `usage_category` COLLATE `%s` LIKE %s' ,
	$table_dict1,
	$collation_1,
	quate_smart($row0[0]));
$oop00->Setnames();
$oop00->query($sql0);
$num1 = $oop00->getNumrows(); 
if ($num1 != 0) { // 1
$usage_list_found=true;
$usage_list_output .= "<div class=\"main_entry\">";
$sql1 = sprintf ('SELECT `is_category`, `cz_category` FROM `%s` WHERE `is_category` COLLATE `%s` like %s' ,
	$table,
	$collation_1,
	quate_smart($row0[0]));
$oop66->Setnames();
$oop66->query($sql1);
$num1 = $oop66->getNumrows(); 
if ($num1!=0) {
$row_trans = $oop66->FetchRow();
$oop66->FreeResult();
if ($_SESSION["lang"]=='is') {
$trans=$row_trans[0];   
} else {
// translation of usage category
$trans=$row_trans[1];
}
}
$usage_list_output .= "<a href=\"./search.php?list_kind=alpha&amp;d_h=".mb_strtolower($row0[0], 'UTF-8')."&amp;d_h_n=0\">".$trans."</a><br>";
while ($row1 = $oop00->FetchRow()):
$usage_list_output .= "<a href=\"./search.php?list_kind=alpha&amp;d_h=".$row1[0]."&amp;d_h_n=".$row1[1]."\">".$row1[0]."</a>, ";
endwhile;
$usage_list_output .="</div>";
}
$oop00->FreeResult();
}
endwhile;
}
$oop11->FreeResult();
$oop11->_mySQL;
// 2 we search for general group - vegetable, seasons, colors etc.
$empty='';
$sql1 = sprintf ('SELECT `is_category`, `cz_category` FROM `%s` WHERE `is_category` COLLATE `%s` like %s' ,
	$table,
	$collation_1,
	quate_smart($usage_keyword));
$oop66->Setnames();
$oop66->query($sql1);
$num1 = $oop66->getNumrows(); 
if ($num1!=0) {
$row_trans = $oop66->FetchRow();
if ($_SESSION["lang"]=='is') {
$trans=$row_trans[0];   
} else {
// translation of usage category
$trans=$row_trans[1];
}
$usage_output .= "<div class=\"main_entry\">";
$usage_output .= '<br>';
$sql5 = sprintf ('SELECT `keyword`,`num_keyword`,`translation`,`translation_detail` FROM `%s` WHERE `usage_category` COLLATE `%s` like %s ',
	$table_dict1,
	$collation_1,
	quate_smart($row_trans[0]));
$oop00->Setnames();
$oop00->query($sql5);
$usage_output.= "<table class=\"sample\">";
while ($row5 = $oop00->FetchRow()) :
$usage_found=true;
$usage_output.="<tr>";
if ($row5[1]!=0) {
$usage_output .= "<td><span class=\"syn\">";
$usage_output .= "<a href=\"./search.php?d_h=".$row5[0]."&amp;d_h_n=".$row5[1]."\">";
$usage_output .= "<sup>".$row5[1]."</sup>".$row5[0]."</a></span></td>";
$usage_output .= "<td><span class=\"dtrn2\">  ".$row5[2]. "</span> <span class=\"ex_translation\">".$row5[3];
$usage_output .= "</span></td>";
} else {
$usage_output .= "<td><span class=\"syn\">";	
$usage_output .= "<a href=\"./search.php?d_h=".$row5[0]."&amp;d_h_n=".$row5[1]."\">";
$usage_output .= $row5[0]."</a></span></td>";
$usage_output .= "<td><span class=\"dtrn2\">  ".$row5[2]. "</span> <span class=\"ex_translation\">".$row5[3];
$usage_output .= "</span></td>";
}
$usage_output.="</tr>";
endwhile;
$usage_output .="</table>";
$usage_output .="</div>";
}
$oop00->FreeResult();
$oop00->_mySQL;
$oop66->FreeResult();
$oop66->_mySQL;
?>
