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
if ($_SESSION["long_dec_show"]==2) {
include './scripts/short_dec_script.php';
}
$oop12 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop11 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$table_adj_info = 'ds_dec_adj_info';
// adj info table
$sql12 = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`=%s',
	$table_adj_info,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop12->Setnames();
$oop12->query($sql12);	
$num12 = $oop12->getNumrows();
if ($num12==0) {
} else {
$returned_info = $oop12->fetchArray();
if ($returned_info[4]!='0'){
$dict_dec = 'ds_dec_adj_1';
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s  AND `num_keyword`=%s' ,
	$dict_dec,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop11->Setnames();
$oop11->query($sql);
$row = $oop11->FetchArray();
if ($_SESSION["long_dec_show"]==2) {
Short_Dec($row, $stem_for_pronunciation,$view_keyword);
}
$BUFFER_DEC .="
<table class=\"sample\">
<tr><th colspan=\"8\"><span class=\"dec_info\">".$lang_declination_positive_strong_dec."</span></th></tr>
<tr><th colspan=\"4\"><span class=\"dec_info\">".$lang_declination_singular."</span></th>
<th colspan=\"4\"><span class=\"dec_info\">".$lang_declination_plural."</span></th></tr>
<tr>
<td width=\"5%\"></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_m."</span></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_f."</span></td>

<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_n."</span></td>
<td width=\"5%\"></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_m."</span></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_f."</span></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_n."</span></td>
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
<tr><th colspan=\"8\"><span class=\"dec_info\">".$lang_declination_positive_weak_dec."</span></th></tr>
<tr><th colspan=\"4\"><span class=\"dec_info\">".$lang_declination_singular."</span></th>
<th colspan=\"4\"><span class=\"dec_info\">".$lang_declination_plural."</span></th></tr>
<tr>
<td width=\"5%\"></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_m."</span></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_f."</span></td>

<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_n."</span></td>
<td width=\"5%\"></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_m."</span></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_f."</span></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_n."</span></td>
</tr>
<tr>
<td><span class=\"dec_info\">".$lang_declination_1_case."</span></td>
<td>".$row[28]."</td>
<td>".$row[32]."</td>
<td>".$row[36]."</td>
<td><span class=\"dec_info\">".$lang_declination_1_case."</span></td>
<td>".$row[40]."</td>
<td>".$row[44]."</td>
<td>".$row[48]."</td>
</tr>
<tr>
<td><span class=\"dec_info\">".$lang_declination_4_case."</span></td>
<td>".$row[29]."</td>
<td>".$row[33]."</td>
<td>".$row[37]."</td>
<td><span class=\"dec_info\">".$lang_declination_4_case."</span></td>
<td>".$row[41]."</td>
<td>".$row[45]."</td>
<td>".$row[49]."</td>
</tr>
<tr>
<td><span class=\"dec_info\">".$lang_declination_3_case."</span></td>
<td>".$row[30]."</td>
<td>".$row[34]."</td>
<td>".$row[38]."</td>
<td><span class=\"dec_info\">".$lang_declination_3_case."</span></td>
<td>".$row[42]."</td>
<td>".$row[46]."</td>
<td>".$row[50]."</td>
</tr>
<tr>
<td><span class=\"dec_info\">".$lang_declination_2_case."</span></td>
<td>".$row[31]."</td>
<td>".$row[35]."</td>
<td>".$row[39]."</td>
<td><span class=\"dec_info\">".$lang_declination_2_case."</span></td>
<td>".$row[43]."</td>
<td>".$row[47]."</td>
<td>".$row[51]."</td>
</tr>
</table><br>";
} else {
$BUFFER_DEC .= '<table class="sample"><tr><td><span class=\"dec_info\">'.$lang_declination_positive_notexist.'</span></td></tr></table><br>';
}
$oop11->freeResult();
if ($returned_info[6]!='0'){
$dict_dec = 'ds_dec_adj_2';
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s  AND `num_keyword`=%s' ,
	$dict_dec,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop11->Setnames();
$oop11->query($sql);
$row = $oop11->FetchArray();
if ($_SESSION["long_dec_show"]==2) {
Short_Dec($row, $stem_for_pronunciation,$view_keyword);
}
$BUFFER_DEC .="
<table class=\"sample\">
<tr><th colspan=\"8\"><span class=\"dec_info\">".$lang_declination_comparative_weak_dec."</span></th></tr>
<tr><th colspan=\"4\"><span class=\"dec_info\">".$lang_declination_singular."</span></th>
<th colspan=\"4\"><span class=\"dec_info\">".$lang_declination_plural."</span></th></tr>
<tr>
<td width=\"5%\"></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_m."</span></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_f."</span></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_n."</span></td>
<td width=\"5%\"></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_m."</span></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_f."</span></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_n."</span></td>
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
</table><br>";
} else {
$BUFFER_DEC .= '<br><table class="sample"><tr><td><span class=\"dec_info\">'.$lang_declination_comparative_notexist.'</span></td></tr></table><br>';
}
$oop11->freeResult();
if ($returned_info[8]!='0'){
$dict_dec = 'ds_dec_adj_3';
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s  AND `num_keyword`=%s' ,
	$dict_dec,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop11->Setnames();
$oop11->query($sql);
$row = $oop11->FetchArray();
if ($_SESSION["long_dec_show"]==2) {
Short_Dec($row, $stem_for_pronunciation,$view_keyword);
}
$BUFFER_DEC .="
<table class=\"sample\">
<tr><th colspan=\"8\"><span class=\"dec_info\">".$lang_declination_superlative_strong_dec."</span></th></tr>
<tr><th colspan=\"4\"><span class=\"dec_info\">".$lang_declination_singular."</span></th>
<th colspan=\"4\"><span class=\"dec_info\">".$lang_declination_plural."</span></th></tr>
<tr>
<td width=\"5%\"></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_m."</span></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_f."</span></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_n."</span></td>
<td width=\"5%\"></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_m."</span></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_f."</span></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_n."</span></td>
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
<tr><th colspan=\"8\"><span class=\"dec_info\">".$lang_declination_superlative_weak_dec."</span></th></tr>
<tr><th colspan=\"4\"><span class=\"dec_info\">".$lang_declination_singular."</span></th>
<th colspan=\"4\"><span class=\"dec_info\">".$lang_declination_plural."</span></th></tr>
<tr>
<td width=\"5%\"></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_m."</span></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_f."</span></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_n."</span></td>
<td width=\"5%\"></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_m."</span></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_f."</span></td>
<td width=\"15%\"><span class=\"dec_info\">".$lang_declination_n."</span></td>
</tr>
<tr>
<td><span class=\"dec_info\">".$lang_declination_1_case."</span></td>
<td>".$row[28]."</td>
<td>".$row[32]."</td>
<td>".$row[36]."</td>
<td><span class=\"dec_info\">".$lang_declination_1_case."</span></td>
<td>".$row[40]."</td>
<td>".$row[44]."</td>
<td>".$row[48]."</td>
</tr>
<tr>
<td><span class=\"dec_info\">".$lang_declination_4_case."</span></td>
<td>".$row[29]."</td>
<td>".$row[33]."</td>
<td>".$row[37]."</td>
<td><span class=\"dec_info\">".$lang_declination_4_case."</span></td>
<td>".$row[41]."</td>
<td>".$row[45]."</td>
<td>".$row[49]."</td>
</tr>
<tr>
<td><span class=\"dec_info\">".$lang_declination_3_case."</span></td>
<td>".$row[30]."</td>
<td>".$row[34]."</td>
<td>".$row[38]."</td>
<td><span class=\"dec_info\">".$lang_declination_3_case."</span></td>
<td>".$row[42]."</td>
<td>".$row[46]."</td>
<td>".$row[50]."</td>
</tr>
<tr>
<td><span class=\"dec_info\">".$lang_declination_2_case."</span></td>
<td>".$row[31]."</td>
<td>".$row[35]."</td>
<td>".$row[39]."</td>
<td><span class=\"dec_info\">".$lang_declination_2_case."</span></td>
<td>".$row[43]."</td>
<td>".$row[47]."</td>
<td>".$row[51]."</td>
</tr>
</table>";
} else {
$BUFFER_DEC .= '<table class="sample"><tr><td><span class=\"dec_info\">'.$lang_declination_superlative_notexist.'</span></td></tr></table><br>';
}
$oop11->freeResult();
$oop11->_mySQL;
}
$oop12->FreeResult();
$oop12->_mySQL;
?>
