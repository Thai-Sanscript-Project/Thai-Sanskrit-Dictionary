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
$dict = 'ds_2_senses';
$num_found=0;
$oop11_syn = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
// from synonym fields
if ($view_num_keyword!=0) {
$string=$view_keyword.'('.$view_num_keyword.')';
$sql = sprintf ('SELECT `keyword`, `num_keyword`, `translation`, `specification`, `usage_specification`, `word`, `synonym`, `marker`, `translation_detail`  FROM `%s` WHERE `synonym` COLLATE `%s` = %s ',
	$dict,
	$collation_1,
	quate_smart($string));
} else {
$sql = sprintf ('SELECT `keyword`, `num_keyword`, `translation`, `specification`, `usage_specification`, `word`, `synonym`, `marker`, `translation_detail`  FROM `%s` WHERE `synonym` COLLATE `%s` = %s ',
	$dict,
	$collation_1,
	quate_smart($view_keyword));
}
$oop11_syn->Setnames();
$oop11_syn->query($sql);
$num2 = $oop11_syn->getNumrows(); 
if ($num2 != 0) { // 1
$nn=0;	
$synonym_output .= "<div class=\"main_entry\">";
while ($row = $oop11_syn->FetchRow()) :
if ($row[1]!=0) {
$synonym_output .= "<span class=\"syn\">";
$synonym_output .= "<a href=\"./search.php?list_kind=alpha&amp;d_h=".$row[0]."&amp;d_h_n=".$row[1]."\">";
$synonym_output .= "<sup>".$row[1]."</sup>".$row[0]."</a> </span> <span class=\"specification2\">".$row[4]."</span><span class=\"specification\">".$row[3]."</span> <span class=\"word\">".$row[5]."</span><span class=\"dtrn2\"> ".$row[2]."</span>";
if ($row[8]!="") {
$synonym_output.="<span class=\"ex_translation\"> ".$row[8]."</span>";
}
} else {
$synonym_output .= "<span class=\"syn\">";
$synonym_output .= "<a href=\"./search.php?list_kind=alpha&amp;d_h=".$row[0]."&amp;d_h_n=".$row[1]."\">";
$synonym_output .= $row[0];
$synonym_output .= "</a> </span> <span class=\"specification2\">".$row[4]."</span><span class=\"specification\">".$row[3]."</span> <span class=\"word\">".$row[5]."</span><span class=\"dtrn2\"> ".$row[2]."</span>";
if ($row[8]!="") {
$synonym_output.="<span class=\"ex_translation\"> ".$row[8]."</span>";
}
}	
$synonym_output .= "<br>";	
endwhile;
$synonym_output .= "</div>";
}
$oop11_syn->FreeResult();
// antonyms
if ($view_num_keyword!=0) {
$string=$view_keyword.'('.$view_num_keyword.')';
$sql = sprintf ('SELECT `keyword`, `num_keyword`, `translation`, `specification`, `usage_specification`, `word`, `antonym`, `marker`, `translation_detail`   FROM `%s` WHERE `antonym` COLLATE `%s` = %s ',
	$dict,
	$collation_1,
	quate_smart($string));
} else {
$sql = sprintf ('SELECT `keyword`, `num_keyword`, `translation`, `specification`, `usage_specification`, `word`, `antonym`, `marker`, `translation_detail`   FROM `%s` WHERE `antonym` COLLATE `%s` = %s ',
	$dict,
	$collation_1,
	quate_smart($view_keyword));
}
$oop11_syn->Setnames();
$oop11_syn->query($sql);
$num2 = $oop11_syn->getNumrows(); 
if ($num2 != 0) { // 1
$nn=0;	
$synonym_output .= "<div class=\"main_entry\">";
while ($row = $oop11_syn->FetchRow()) :
if ($row[1]!=0) {
$synonym_output .= "<span class=\"syn\">";
$synonym_output .= "<a href=\"./search.php?list_kind=alpha&amp;d_h=".$row[0]."&amp;d_h_n=".$row[1]."\">";
$synonym_output .= "x <sup>".$row[1]."</sup>".$row[0]."</a> </span> <span class=\"specification2\">".$row[4]."</span><span class=\"specification\">".$row[3]."</span> <span class=\"word\">".$row[5]."</span><span class=\"dtrn2\"> ".$row[2]."</span>";
if ($row[8]!="") {
$synonym_output.="<span class=\"ex_translation\"> ".$row[8]."</span>";
}
} else {
$synonym_output .= "<span class=\"syn\">";
$synonym_output .= "<a href=\"./search.php?list_kind=alpha&amp;d_h=".$row[0]."&amp;d_h_n=".$row[1]."\">";
$synonym_output .= 'x '.$row[0];
$synonym_output .= "</a> </span> <span class=\"specification2\">".$row[4]."</span><span class=\"specification\">".$row[3]."</span> <span class=\"word\">".$row[5]."</span><span class=\"dtrn2\"> ".$row[2]."</span>";
if ($row[8]!="") {
$synonym_output.="<span class=\"ex_translation\"> ".$row[8]."</span>";
}
}
$synonym_output .= "<br>";
endwhile;
$synonym_output .= "</div>";
}
$oop11_syn->FreeResult();
$oop11_syn->_mySQL;
?>
