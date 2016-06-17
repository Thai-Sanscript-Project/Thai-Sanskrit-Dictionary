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
$dict_dec = 'ds_dec_adv';
$oop11 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s  AND `num_keyword`=%s' ,
	$dict_dec,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop11->Setnames();
$oop11->query($sql);
$num11 = $oop11->getNumrows();
if ($num11==0) {
} else {
$row = $oop11->FetchArray();
$oop11->freeResult();
if ($row[3]==10) {
} else {
if ($_SESSION["long_dec_show"]==2) {
include './scripts/short_dec_script.php';
Short_Dec($row, $stem_for_pronunciation,$view_keyword);
}
$BUFFER_DEC .= "<table class=\"sample\">
<tr>
<th width=\"33%\"><span class=\"dec_info\">".$lang_dec_adv6."</span></th>
<th width=\"33%\"><span class=\"dec_info\">".$lang_dec_adv7."</span></th>
<th width=\"34%\"><span class=\"dec_info\">".$lang_dec_adv8."</span></th>
</tr>
<tr>";
for ($i = 4; $i < 7; $i++) {
if ($row[$i]!=$view_keyword) {
$dict_keyword='ds_1_headword';
$gram='adv';
$sql = sprintf ('SELECT `num_keyword` FROM `%s` WHERE `keyword` COLLATE `%s` = %s  AND `gram_1_word_group` LIKE %s' ,
	$dict_keyword,
	$collation_1,
	quate_smart($row[$i]),
	quate_two_wildcard($gram));
$oop11->Setnames();
$oop11->query($sql);
$num11 = $oop11->getNumrows();
if ($num11!=0) {
$row_h = $oop11->FetchArray();
if ($_SESSION["rights"]==3) {
$BUFFER_DEC .= '<td><a href="./search.php?list_kind=alpha&d_h='.$row[$i].'&d_h_n='.$row_h[0].'&detail_from_result=TRUE">'.$row[$i].'</a></td>';
} else {
$BUFFER_DEC .= '<td><a href="./search.php?list_kind=alpha&d_h='.$row[$i].'&d_h_n='.$row_h[0].'&detail_from_result=TRUE">'.$row[$i].'</a></td>';
}
} else {
$BUFFER_DEC .='<td>'.$row[$i].'</td>';	
}
} else {
$BUFFER_DEC .= '<td>'.$row[$i].'</td>';	
}
}
$BUFFER_DEC .= "</tr></table>";
}
}
$oop11->freeResult();
$oop11->_mySQL;?>
