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
$dict_dec = 'ds_dec_noun';
$oop11_noun = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s  AND `num_keyword`=%s' ,
	$dict_dec,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop11_noun->Setnames();
$oop11_noun->query($sql);
$num11 = $oop11_noun->getNumrows();
if ($num11==0) {
} else {
$row = $oop11_noun->FetchRow();
if ($_SESSION["long_dec_show"]==2) {
include './scripts/short_dec_script.php';
Short_Dec($row, $stem_for_pronunciation,$view_keyword);
}
$BUFFER_DEC .= "<table class=\"sample\">";
$BUFFER_DEC .= "<tr><th colspan=\"3\" align=\"center\"><span class=\"dec_info\">".$lang_declination_singular."</span></th>";
$BUFFER_DEC .= "<th colspan=\"3\" align=\"center\"><span class=\"dec_info\">".$lang_declination_plural."</span></th></tr>";
$BUFFER_DEC .= "<tr>";
$BUFFER_DEC .= "<td width=\"10%\"></td>";
$BUFFER_DEC .= "<td align=\"center\" width=\"20%\"><span class=\"dec_info\">".$lang_declination_without_article."</span></td>";
$BUFFER_DEC .= "<td align=\"center\" width=\"20%\"><span class=\"dec_info\">".$lang_declination_with_article."</span></td>";
$BUFFER_DEC .= "<td width=\"10%\"></td>";
$BUFFER_DEC .= "<td align=\"center\" width=\"20%\"><span class=\"dec_info\">".$lang_declination_without_article."</span></td>";
$BUFFER_DEC .= "<td align=\"center\" width=\"20%\"><span class=\"dec_info\">".$lang_declination_with_article."</span></td>";
$BUFFER_DEC .= "</tr>";
$BUFFER_DEC .= "<tr>";
$BUFFER_DEC .= "<td><span class=\"dec_info\">".$lang_declination_1_case."</span></td>";
$BUFFER_DEC .= "<td>";
$BUFFER_DEC .= $row[5];
$BUFFER_DEC .= "</td>";
$BUFFER_DEC .= "<td>";
$BUFFER_DEC .= $row[9];
$BUFFER_DEC .= "</td><td>";
$BUFFER_DEC .= "<span class=\"dec_info\">".$lang_declination_1_case."</span></td>";
$BUFFER_DEC .="<td>";
$BUFFER_DEC .= $row[13];
$BUFFER_DEC .="</td><td>";
$BUFFER_DEC .= $row[17];
$BUFFER_DEC .= "</td></tr><tr>";
$BUFFER_DEC .="<td><span class=\"dec_info\">".$lang_declination_4_case."</span></td>";
$BUFFER_DEC .= "<td>";
$BUFFER_DEC .= $row[6];
$BUFFER_DEC .= "</td>";
$BUFFER_DEC .= "<td>";
$BUFFER_DEC .= $row[10];
$BUFFER_DEC .= "</td>";
$BUFFER_DEC .= "<td><span class=\"dec_info\">".$lang_declination_4_case."</span></td>";
$BUFFER_DEC .= "<td>";
$BUFFER_DEC .= $row[14];
$BUFFER_DEC .="</td>";
$BUFFER_DEC .="<td>";
$BUFFER_DEC .= $row[18];
$BUFFER_DEC .="</td>";
$BUFFER_DEC .="</tr>";
$BUFFER_DEC .="<tr>";
$BUFFER_DEC .="<td><span class=\"dec_info\">".$lang_declination_3_case."</span></td>";
$BUFFER_DEC .="<td>"; 
$BUFFER_DEC .= $row[7];
$BUFFER_DEC .="</td>";
$BUFFER_DEC .="<td>"; 
$BUFFER_DEC .= $row[11];
$BUFFER_DEC .="</td>";
$BUFFER_DEC .="<td><span class=\"dec_info\">".$lang_declination_3_case."</span></td>";
$BUFFER_DEC .="<td>"; 
$BUFFER_DEC .= $row[15];
$BUFFER_DEC .="</td>";
$BUFFER_DEC .="<td>"; 
$BUFFER_DEC .= $row[19];
$BUFFER_DEC .="</td>";
$BUFFER_DEC .="</tr>";
$BUFFER_DEC .="<tr>";
$BUFFER_DEC .="<td><span class=\"dec_info\">".$lang_declination_2_case."</span></td>";
$BUFFER_DEC .="<td>"; 
$BUFFER_DEC .= $row[8];
$BUFFER_DEC .="</td>";
$BUFFER_DEC .="<td>";
$BUFFER_DEC .= $row[12];
$BUFFER_DEC .="</td>";
$BUFFER_DEC .="<td><span class=\"dec_info\">".$lang_declination_2_case."</span></td>";
$BUFFER_DEC .="<td>";
$BUFFER_DEC .= $row[16];
$BUFFER_DEC .="</td>";
$BUFFER_DEC .="<td>";
$BUFFER_DEC .= $row[20];
$BUFFER_DEC .="</td>";
$BUFFER_DEC .="</tr>";
$BUFFER_DEC .="</table>";
}
$oop11_noun->freeResult();
$oop11_noun->_mySQL;?>
