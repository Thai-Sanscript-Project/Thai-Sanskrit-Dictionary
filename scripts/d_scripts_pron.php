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
if ($action_scripts=='gen_pron' ) {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop3 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop4 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table_declination='ds_wordform';
$table = 'ds_dec_pron';
$sql2 = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table,
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]));
$oop2->Setnames();
$oop2->query($sql2);
$returned = $oop2->fetchArray ();
foreach ($returned as &$value) {
$pos = strpos($value, ',');
if (($value!='') AND !(is_numeric($value))) {
// more expressions
if ($pos!==FALSE) {
$more_words = explode (',', $value);
foreach ($more_words as &$value) {
$num_walked++;
$sql3 = sprintf ('SELECT * FROM `%s` WHERE `word_form` COLLATE `%s` = %s AND `keyword` = %s AND `num_keyword` = %s',
	$table_declination,
	$collation_1,
	quate_smart(trim($value)),
	quate_smart($returned[1]),
	quate_smart($returned[2]));
$oop3->Setnames();
$oop3->query($sql3);	
$num1 = $oop3->getNumRows();
if ($num1==0) {
$num_added++;
$sql4= sprintf ('INSERT INTO `%s` (`id`, `keyword`, `num_keyword`, `word_form`) VALUES (NULL, %s, %s, %s)',
	$table_declination,
	quate_smart($returned[1]),
	quate_smart($returned[2]),
	quate_smart(trim($value)));
$oop4->Setnames();
$oop4->query($sql4);
$oop4->freeResult();
}
}
} else {
$num_walked++;
$sql3 = sprintf ('SELECT * FROM `%s` WHERE `word_form` COLLATE `%s` = %s AND `keyword` = %s AND `num_keyword` = %s',
	$table_declination,
	$collation_1,
	quate_smart(trim($value)),
	quate_smart($returned[1]),
	quate_smart($returned[2]));
$oop3->Setnames();
$oop3->query($sql3);	
$num1 = $oop3->getNumRows();
if ($num1==0) {
$num_added++;
$sql4= sprintf ('INSERT INTO `%s` (`id`, `keyword`, `num_keyword`, `word_form`) VALUES (NULL, %s, %s, %s)',
	$table_declination,
	quate_smart($returned[1]),
	quate_smart($returned[2]),
	quate_smart(trim($value)));
$oop4->Setnames();
$oop4->query($sql4);
$oop4->freeResult();
}
$oop3->freeResult();	
}
}
}
$oop2->freeResult();
$num_all++;
$oop->freeResult();
$oop->_mySQL;
}
?>
