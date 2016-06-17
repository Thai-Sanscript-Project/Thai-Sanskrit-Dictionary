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
if ($reorder=='FALSE') {
$oop11 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$dict='ds_2_senses';
$sql = sprintf ('SELECT `id`,`order` FROM `%s` WHERE `keyword` COLLATE `%s` = %s  AND `num_keyword`=%s AND `order` = %s' ,
	$dict,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword),
	quate_smart($view_num_order));
$oop11->Setnames();
$oop11->query($sql);
$returned = $oop11->fetchRow ();
$oop11->freeResult();
if ($view_direction=='down') {
$sql = sprintf ('SELECT `id`,`order` FROM `%s` WHERE `keyword` COLLATE `%s` = %s  AND `num_keyword`=%s AND `order` > %s LIMIT 0,1' ,
	$dict,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword),
	quate_smart($view_num_order));
$oop11->Setnames();
$oop11->query($sql);
$returned_down = $oop11->fetchRow ();
$oop11->freeResult();	
}
if ($view_direction=='up') {
$sql = sprintf ('SELECT `id`,`order` FROM `%s` WHERE `keyword` COLLATE `%s` = %s  AND `num_keyword`=%s AND `order` < %s ORDER BY `order` ASC' ,
	$dict,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword),
	quate_smart($view_num_order));
$oop11->Setnames();
$oop11->query($sql);
while ($returned_up = $oop11->fetchRow ()):
$up[0]=$returned_up[0];
$up[1]=$returned_up[1];
endwhile;
$oop11->freeResult();		
}
if ($view_direction=='down') {
$sql2 = sprintf ('UPDATE `%s` SET `order` = %s WHERE `id` = %s',
	$dict,					
	quate_smart($returned_down[1]),
	quate_smart($returned[0]));
$oop11->Setnames();
$oop11->query($sql2);
$oop11->freeResult();
$sql2 = sprintf ('UPDATE `%s` SET `order` = %s WHERE `id` = %s',
	$dict,					
	quate_smart($returned[1]),
	quate_smart($returned_down[0]));
$oop11->Setnames();
$oop11->query($sql2);
$oop11->freeResult();	
}
if ($view_direction=='up') {
$sql2 = sprintf ('UPDATE `%s` SET `order` = %s WHERE `id` = %s',
	$dict,					
	quate_smart($up[1]),	
	quate_smart($returned[0]));
$oop11->Setnames();
$oop11->query($sql2);
$oop11->freeResult();
$sql2 = sprintf ('UPDATE `%s` SET `order` = %s WHERE `id` = %s',
	$dict,					
	quate_smart($returned[1]),
	quate_smart($up[0]));
$oop11->Setnames();
$oop11->query($sql2);
$oop11->freeResult();	
}
$oop11->_mySQL; 
if ($view_num_keyword!=0) {
$_SESSION["ses_message"]=$lang_dec_mes10.'<sup>'.$view_num_keyword.'</sup>'.$view_keyword.''.$lang_dec_mes11;	
} else {
$_SESSION["ses_message"]=$lang_dec_mes10.''.$view_keyword.''.$lang_dec_mes11;
}
}
if ($reorder=="TRUE") {
$dict='ds_2_senses';
$oop11 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop12 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$sql = sprintf ('SELECT `id` FROM `%s` WHERE `keyword` COLLATE `%s` = %s  AND `num_keyword`=%s ORDER BY `order` ASC' ,
	$dict,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop11->Setnames();
$oop11->query($sql);
$cc=0;
while ($returned = $oop11->fetchRow ()):
$cc++;
$sql2 = sprintf ('UPDATE `%s` SET `order` = %s WHERE `id` = %s',
	$dict,					
	quate_smart($cc),
	quate_smart($returned[0]));
$oop12->Setnames();
$oop12->query($sql2);
$oop12->freeResult();
endwhile;
$oop11->freeResult();
$oop11->_mySQL; 
$oop12->_mySQL; 
if ($view_num_keyword!=0) {
$_SESSION["ses_message"].=$lang_dec_mes12.'<sup>'.$view_num_keyword.'</sup>'.$view_keyword.''.$lang_dec_mes13;	
} else {
$_SESSION["ses_message"].=$lang_dec_mes12.''.$view_keyword.''.$lang_dec_mes13;
}}
$location = 'Location: ./search.php?list_kind=alpha&d_h='.$view_keyword.'&d_h_n='.$view_num_keyword.'';
header($location);
?>
