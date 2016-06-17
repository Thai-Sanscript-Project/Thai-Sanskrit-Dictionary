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
$dict_dec = 'ds_dec_pron_pers';
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
if ($_SESSION["long_dec_show"]==2) {
include './scripts/short_dec_script.php';
Short_Dec($row, $stem_for_pronunciation,$view_keyword);
}
$BUFFER_DEC .= "<table class=\"sample\">
<tr>
<td width=\"10%\"></td>
<th width=\"45%\"><span class=\"dec_info\">".$lang_declination_singular."</span></th>
<th width=\"45%\"><span class=\"dec_info\">".$lang_declination_plural."</span></th>
</tr>
<tr>
<td><span class=\"dec_info\">".$lang_declination_1_case."</span></td>
<td>".$row[5]."</td>
<td>".$row[9]."</td>
</tr>
<tr>
<td><span class=\"dec_info\">".$lang_declination_4_case."</span></td>
<td>".$row[6]."</td>
<td>".$row[10]."</td>
</tr>
<tr>
<td><span class=\"dec_info\">".$lang_declination_3_case."</span></td>
<td>".$row[7]."</td>
<td>".$row[11]."</td>
</tr>
<tr>
<td><span class=\"dec_info\">".$lang_declination_2_case."</td>
<td>".$row[8]."</td>
<td>".$row[12]."</td>
</tr>
</table>";
}
$oop11->freeResult();
$oop11->_mySQL;?>
