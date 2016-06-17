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
$oop11 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$dict_dec = 'ds_dec_pron';
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s  AND `num_keyword`=%s' ,
	$dict_dec,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop11->Setnames();
$oop11->query($sql);
$num12 = $oop11->getNumrows();
if ($num12!=0) {
$row = $oop11->FetchArray();
if ($_SESSION["long_dec_show"]==2) {
include './scripts/short_dec_script.php';
Short_Dec($row, $stem_for_pronunciation,$view_keyword);
}
$BUFFER_DEC .= "<table class=\"sample\">
<tr><th colspan=\"4\"><span class=\"dec_info\">".$lang_declination_singular."</span></th>
<th colspan=\"4\"><span class=\"dec_info\">".$lang_declination_plural."</span></th></tr>
<tr>
<td width=\"5%\"></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_m."</span></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_f."</span></td>
<td width=\"15%\"><span class=\"dec_info\"><span class=\"dec_info\">".$lang_declination_n."</span></td>
<td width=\"5%\"></td>
<td width=\"15%\"><span class=\"dec_info\"><span class=\"dec_info\">".$lang_declination_m."</span></td>
<td width=\"15%\"><span class=\"dec_info\"><span class=\"dec_info\">".$lang_declination_f."</span></td>
<td width=\"15%\"><span class=\"dec_info\"><span class=\"dec_info\">".$lang_declination_n."</span></td>
</tr>
<tr>
<td><span class=\"dec_info\">".$lang_declination_1_case."</span></td>
<td>".$row[4]."</td>
<td>".$row[8]."</td>
<td>".$row[12]."</td>
<td><span class=\"dec_info\">".$lang_declination_1_case."</span></td>
<td>".$row[16]."</td>
<td>".$row[20]."</td>
<td>".$row[24]."</td>
</tr>
<tr>
<td><span class=\"dec_info\">".$lang_declination_4_case."</span></td>
<td>".$row[5]."</td>
<td>".$row[9]."</td>
<td>".$row[13]."</td>
<td><span class=\"dec_info\">".$lang_declination_4_case."</span></td>
<td>".$row[17]."</td>
<td>".$row[21]."</td>
<td>".$row[25]."</td>
</tr>
<tr>
<td><span class=\"dec_info\">".$lang_declination_3_case."</span></td>
<td>".$row[6]."</td>
<td>".$row[10]."</td>
<td>".$row[14]."</td>
<td><span class=\"dec_info\">".$lang_declination_3_case."</span></td>
<td>".$row[18]."</td>
<td>".$row[22]."</td>
<td>".$row[26]."</td>
</tr>
<tr>
<td><span class=\"dec_info\">".$lang_declination_2_case."</span></td>
<td>".$row[7]."</td>
<td>".$row[11]."</td>
<td>".$row[15]."</td>
<td><span class=\"dec_info\">".$lang_declination_2_case."</span></td>
<td>".$row[19]."</td>
<td>".$row[23]."</td>
<td>".$row[27]."</td>
</tr>
</table>
<br>";
} else {
}
$oop11->freeResult();
$oop11->_mySQL;?>
