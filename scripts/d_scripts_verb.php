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
if ($action_scripts=="verb_info_update") {
$table_info = 'ds_dec_v_info';
$table_1 = 'ds_dec_v_1';
$table_2 = 'ds_dec_v_2';
$table_3 = 'ds_dec_v_3';
$table_4 = 'ds_dec_v_4';
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop11 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s  AND `num_keyword`=%s' ,
	$table_info,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop11->Setnames();
$oop11->query($sql);
$row_prep = $oop11->FetchArray();
$oop11->freeResult();
 // check if germynd exist
if ($row_prep[4]!=0) {
$num1==5;
$sql = sprintf ('SELECT `status` FROM `%s` WHERE `keyword` COLLATE `%s` = %s  AND `num_keyword`=%s' ,
	$table_1,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop->Setnames();							
$oop->query($sql);
$result= $oop->FetchArray();
$num1 = $oop->getNumRows();
$status_germynd=$result[0];
if ($status_germynd==2) {$first=TRUE;}
$oop->freeResult();} else {$first=TRUE;}
// check if midmynd exist
if ($row_prep[6]!=0) {
$sql = sprintf ('SELECT `status` FROM `%s` WHERE `keyword` COLLATE `%s` = %s  AND `num_keyword`=%s' ,
	$table_2,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop->Setnames();							
$oop->query($sql);
$result= $oop->FetchArray();
$num1 = $oop->getNumRows();
$status_midmynd=$result[0];
if ($status_midmynd==2) {$second=TRUE;}
$oop->freeResult();} else {$second=TRUE;}
// check if bodhattur exist
if ($row_prep[8]!=0) {
$sql = sprintf ('SELECT `status` FROM `%s` WHERE `keyword` COLLATE `%s` = %s  AND `num_keyword`=%s' ,
	$table_3,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop->Setnames();							
$oop->query($sql);
$result= $oop->FetchArray();
$num1 = $oop->getNumRows();
$status_bodhattur=$result[0];
if ($status_bodhattur==2) {$third=TRUE;}
$oop->freeResult();} else {$third=TRUE;}
// check if midmynd exist
if ($row_prep[10]!=0) {
$sql = sprintf ('SELECT `status` FROM `%s` WHERE `keyword` COLLATE `%s` = %s  AND `num_keyword`=%s' ,
	$table_4,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop->Setnames();							
$oop->query($sql);
$result= $oop->FetchArray();
$num1 = $oop->getNumRows();
$status_lysingarhattur=$result[0];
if ($status_lysingarhattur==2) {$fourth=TRUE;}
$oop->freeResult();} else {$fourth=TRUE;}
$sql = sprintf ('UPDATE `%s` SET `status_germynd` = %s, `status_midmynd` = %s, `status_bodhattur` = %s, `status_lysingarhattur` = %s WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$table_info,					
	quate_smart($status_germynd),
	quate_smart($status_midmynd),
	quate_smart($status_bodhattur),
	quate_smart($status_lysingarhattur),
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword)); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
if (($first===TRUE) AND ($second===TRUE) AND ($third===TRUE) AND ($fourth===TRUE)) 
{
$status_keyword='2';
$sql = sprintf ('UPDATE `%s` SET `status_keyword` = %s WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$table_info,					
	quate_smart($status_keyword),
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword)); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();}
$oop11->freeResult();
$oop11->_mySQL;}
if ($action_scripts=="verb_generate_single_script") {
$table_declination='ds_wordform';
$table_info = 'ds_dec_v_info';
$table_1 = 'ds_dec_v_1';
$table_2 = 'ds_dec_v_2';
$table_3 = 'ds_dec_v_3';
$table_4 = 'ds_dec_v_4';
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table_info,
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]));
$oop->Setnames();
$result = $oop->query($sql);
$num89 = $oop->getNumRows();
$returned = $oop->fetchRow ();
// germynd exist
if ($returned[4]==2) {
$sql2 = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table_1,
	$collation_1,
	quate_smart($returned[1]),
	quate_smart($returned[2]));
$oop2->Setnames();
$oop2->query($sql2);
$returned2 = $oop2->fetchArray ();
$nn=0;
foreach ($returned2 as &$value) {
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
$oop4->freeResult();}}} else {
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
$oop4->freeResult();}
$oop3->freeResult();}}}
$oop2->freeResult();
$num_all++;}
// MIDMYND exist
if ($returned[6]==2) {
$sql2 = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table_2,
	$collation_1,
	quate_smart($returned[1]),
	quate_smart($returned[2]));
$oop2->Setnames();
$oop2->query($sql2);
$returned2 = $oop2->fetchArray ();
$nn=0;
foreach ($returned2 as &$value) {
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
$oop4->freeResult();}}} else {
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
$oop4->freeResult();}
$oop3->freeResult();}}}
$oop2->freeResult();
$num_all++;} // END MIDMYND
// SAGNBOT exist
if ($returned[8]==2) {
$sql2 = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table_3,
	$collation_1,
	quate_smart($returned[1]),
	quate_smart($returned[2]));
$oop2->Setnames();
$oop2->query($sql2);
$returned2 = $oop2->fetchArray ();
$nn=0;
foreach ($returned2 as &$value) {
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
$oop4->freeResult();}}} else {
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
$oop4->freeResult();}
$oop3->freeResult();}}}
$oop2->freeResult();
$num_all++;}
// LYSINGARHATTUR /ATIDAR exist
if ($returned[10]==2) {
$sql2 = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table_4,
	$collation_1,
	quate_smart($returned[1]),
	quate_smart($returned[2]));
$oop2->Setnames();
$oop2->query($sql2);
$returned2 = $oop2->fetchArray ();
$nn=0;
foreach ($returned2 as &$value) {
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
$oop4->freeResult();}}} else {
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
$oop4->freeResult();}
$oop3->freeResult();}}}
$oop2->freeResult();
$num_all++;}
$oop->freeResult();}
if ($action_scripts=="gen_verb1") {
$dict_keyword='ds_1_headword';
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$dict_keyword,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop->Setnames();
$oop->query($sql);
$returned = $oop->fetchArray ();
$oop->freeResult();
$number33=55;
$table2 = 'ds_dec_v_1';
$sql = sprintf ('SELECT `keyword` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop3->Setnames();
$oop3->query($sql);
$number33 = $oop3->getNumrows(); 
$oop3->freeResult();
$found_pattern=FALSE;
$ary[] = "UTF-8";
$ary[] = "ASCII";
mb_detect_order($ary);
mb_internal_encoding("UTF-8");
if ($number33==0) {
$num=mb_strlen($view_keyword);
$char[$num-1] = mb_substr($view_keyword,$num-1,1);
$char[$num-2] = mb_substr($view_keyword,$num-2,1);
$char[$num-3] = mb_substr($view_keyword,$num-3,1);
$char[$num-4] = mb_substr($view_keyword,$num-4,1);
$char[$num-5] = mb_substr($view_keyword,$num-5,1);
$char[$num-6] = mb_substr($view_keyword,$num-6,1);
$last_6=$char[$num-6].$char[$num-5].$char[$num-4].$char[$num-3].$char[$num-2].$char[$num-1];
$last_5=$char[$num-5].$char[$num-4].$char[$num-3].$char[$num-2].$char[$num-1];
$last_4=$char[$num-4].$char[$num-3].$char[$num-2].$char[$num-1];
$last_3=$char[$num-3].$char[$num-2].$char[$num-1];
$last_2=$char[$num-2].$char[$num-1];
$last_1=$char[$num-1];
if ((($returned[8]=='(-aði)') OR ($returned[8]=='(-aðist)')) AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
if ($returned[8]=='(-aðist)') {
$newstring = mb_substr($view_keyword, 0, -3);	} else {
$newstring = mb_substr($view_keyword, 0, -1);}
$f_n_sg_1=$newstring.'a';
$f_n_sg_2=$newstring.'ar';
$f_n_sg_3=$newstring.'ar';
if (($char[$num-5]=='a') AND ($char[$num-5].$char[$num-4]!='au') AND ($num>4)) {
$helpstring = mb_substr($view_keyword, 0, -5);	
$f_n_pl_1=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'um';}
else if ($char[$num-3]=='a') {
$helpstring = mb_substr($view_keyword, 0, -3);	
$f_n_pl_1=$helpstring.'ö'.$char[$num-2].'um';} else if (($char[$num-4]=='a') AND ($char[$num-4].$char[$num-3]!='au')) {
$helpstring = mb_substr($view_keyword, 0, -4);	
$f_n_pl_1=$helpstring.'ö'.$char[$num-3].$char[$num-2].'um';} else {
$f_n_pl_1=$newstring.'um';	}
$f_n_pl_2=$newstring.'ið';
$f_n_pl_3=$newstring.'a';
$f_p_sg_1=$newstring.'aði';
$f_p_sg_2=$newstring.'aðir';
$f_p_sg_3=$newstring.'aði';
if (($char[$num-5]=='a') AND ($char[$num-5].$char[$num-4]!='au') AND ($num>4)){
$helpstring = mb_substr($view_keyword, 0, -5);	
$f_p_pl_1=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðum';
$f_p_pl_2=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðuð';
$f_p_pl_3=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðu';}
else 
if ($char[$num-3]=='a') {
$helpstring = mb_substr($view_keyword, 0, -3);	
$f_p_pl_1=$helpstring.'ö'.$char[$num-2].'uðum';
$f_p_pl_2=$helpstring.'ö'.$char[$num-2].'uðuð';
$f_p_pl_3=$helpstring.'ö'.$char[$num-2].'uðu';} else if (($char[$num-4]=='a') AND ($char[$num-4].$char[$num-3]!='au')){
$helpstring = mb_substr($view_keyword, 0, -4);	
$f_p_pl_1=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðum';
$f_p_pl_2=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðuð';
$f_p_pl_3=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðu';} else {
$f_p_pl_1=$newstring.'uðum';	
$f_p_pl_2=$newstring.'uðuð';
$f_p_pl_3=$newstring.'uðu';}
$v_n_sg_1=$newstring.'i';
$v_n_sg_2=$newstring.'ir';
$v_n_sg_3=$newstring.'i';
if (($char[$num-5]=='a') AND ($char[$num-5].$char[$num-4]!='au') AND ($num>4)) {
$helpstring = mb_substr($view_keyword, 0, -5);	
$v_n_pl_1=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'um';}
else 
if ($char[$num-3]=='a') {
$helpstring = mb_substr($view_keyword, 0, -3);	
$v_n_pl_1=$helpstring.'ö'.$char[$num-2].'um';} else if (($char[$num-4]=='a') AND ($char[$num-4].$char[$num-3]!='au')) {
$helpstring = mb_substr($view_keyword, 0, -4);	
$v_n_pl_1=$helpstring.'ö'.$char[$num-3].$char[$num-2].'um';} else  {
$v_n_pl_1=$newstring.'um';	}
$v_n_pl_2=$newstring.'ið';
$v_n_pl_3=$newstring.'i';
$v_p_sg_1=$newstring.'aði';
$v_p_sg_2=$newstring.'aðir';
$v_p_sg_3=$newstring.'aði';
if (($char[$num-5]=='a') AND ($char[$num-5].$char[$num-4]!='au') AND ($num>4)){
$helpstring = mb_substr($view_keyword, 0, -5);	
$v_p_pl_1=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðum';
$v_p_pl_2=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðuð';
$v_p_pl_3=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðu';}
else 
if ($char[$num-3]=='a') {
$helpstring = mb_substr($view_keyword, 0, -3);	
$v_p_pl_1=$helpstring.'ö'.$char[$num-2].'uðum';
$v_p_pl_2=$helpstring.'ö'.$char[$num-2].'uðuð';
$v_p_pl_3=$helpstring.'ö'.$char[$num-2].'uðu';} else  if (($char[$num-4]=='a') AND ($char[$num-4].$char[$num-3]!='au')){
$helpstring = mb_substr($view_keyword, 0, -4);	
$v_p_pl_1=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðum';
$v_p_pl_2=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðuð';
$v_p_pl_3=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðu';} else {
$v_p_pl_1=$newstring.'uðum';	
$v_p_pl_2=$newstring.'uðuð';
$v_p_pl_3=$newstring.'uðu';}} 
// afferma
if (($returned[8]=='(-di, -t)') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
if ($char[$num-3].$char[$num-2]=='gj') {
$newstring = mb_substr($view_keyword, 0, -2);
$f_n_sg_1=$newstring.'i';
$f_n_sg_2=$newstring.'ir';
$f_n_sg_3=$newstring.'ir';
$f_n_pl_1=$newstring.'jum';	
$f_n_pl_2=$newstring.'ið';
$f_n_pl_3=$newstring.'ja';
$f_p_sg_1=$newstring.'di';
$f_p_sg_2=$newstring.'dir';
$f_p_sg_3=$newstring.'di';
$f_p_pl_1=$newstring.'dum';	
$f_p_pl_2=$newstring.'duð';
$f_p_pl_3=$newstring.'du';
$v_n_sg_1=$newstring.'i';
$v_n_sg_2=$newstring.'ir';
$v_n_sg_3=$newstring.'i';
$v_n_pl_1=$newstring.'jum';	
$v_n_pl_2=$newstring.'ið';
$v_n_pl_3=$newstring.'i';
$v_p_sg_1=$newstring.'di';
$v_p_sg_2=$newstring.'dir';
$v_p_sg_3=$newstring.'di';
$v_p_pl_1=$newstring.'dum';	
$v_p_pl_2=$newstring.'duð';
$v_p_pl_3=$newstring.'du';} else {
$newstring = mb_substr($view_keyword, 0, -1);
$f_n_sg_1=$newstring.'i';
$f_n_sg_2=$newstring.'ir';
$f_n_sg_3=$newstring.'ir';
$f_n_pl_1=$newstring.'um';	
$f_n_pl_2=$newstring.'ið';
$f_n_pl_3=$newstring.'a';
$f_p_sg_1=$newstring.'di';
$f_p_sg_2=$newstring.'dir';
$f_p_sg_3=$newstring.'di';
$f_p_pl_1=$newstring.'dum';	
$f_p_pl_2=$newstring.'duð';
$f_p_pl_3=$newstring.'du';
$v_n_sg_1=$newstring.'i';
$v_n_sg_2=$newstring.'ir';
$v_n_sg_3=$newstring.'i';
$v_n_pl_1=$newstring.'um';	
$v_n_pl_2=$newstring.'ið';
$v_n_pl_3=$newstring.'i';
$v_p_sg_1=$newstring.'di';
$v_p_sg_2=$newstring.'dir';
$v_p_sg_3=$newstring.'di';
$v_p_pl_1=$newstring.'dum';	
$v_p_pl_2=$newstring.'duð';
$v_p_pl_3=$newstring.'du';}} 
// auglýsa
if (($returned[8]=='(-ti, -t)') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
if ($char[$num-3].$char[$num-2]=='tj') {
$newstring = mb_substr($view_keyword, 0, -2);
$f_n_sg_1=$newstring.'';
$f_n_sg_2=$newstring.'ur';
$f_n_sg_3=$newstring.'ur';
$f_n_pl_1=$newstring.'jum';	
$f_n_pl_2=$newstring.'jið';
$f_n_pl_3=$newstring.'ja';
$f_p_sg_1=$newstring.'ti';
$f_p_sg_2=$newstring.'tir';
$f_p_sg_3=$newstring.'ti';
$f_p_pl_1=$newstring.'tum';	
$f_p_pl_2=$newstring.'tuð';
$f_p_pl_3=$newstring.'tu';
$v_n_sg_1=$newstring.'ji';
$v_n_sg_2=$newstring.'jir';
$v_n_sg_3=$newstring.'ji';
$v_n_pl_1=$newstring.'jum';	
$v_n_pl_2=$newstring.'jið';
$v_n_pl_3=$newstring.'ji';
$v_p_sg_1=$newstring.'ti';
$v_p_sg_2=$newstring.'tir';
$v_p_sg_3=$newstring.'ti';
$v_p_pl_1=$newstring.'tum';	
$v_p_pl_2=$newstring.'tuð';
$v_p_pl_3=$newstring.'tu';} else 
// kíkja
if ($char[$num-3].$char[$num-2]=='kj') {
$newstring = mb_substr($view_keyword, 0, -2);
$f_n_sg_1=$newstring.'i';
$f_n_sg_2=$newstring.'ir';
$f_n_sg_3=$newstring.'ir';
$f_n_pl_1=$newstring.'jum';	
$f_n_pl_2=$newstring.'ið';
$f_n_pl_3=$newstring.'ja';
$f_p_sg_1=$newstring.'ti';
$f_p_sg_2=$newstring.'tir';
$f_p_sg_3=$newstring.'ti';
$f_p_pl_1=$newstring.'tum';	
$f_p_pl_2=$newstring.'tuð';
$f_p_pl_3=$newstring.'tu';
$v_n_sg_1=$newstring.'i';
$v_n_sg_2=$newstring.'ir';
$v_n_sg_3=$newstring.'i';
$v_n_pl_1=$newstring.'jum';	
$v_n_pl_2=$newstring.'ið';
$v_n_pl_3=$newstring.'i';
$v_p_sg_1=$newstring.'ti';
$v_p_sg_2=$newstring.'tir';
$v_p_sg_3=$newstring.'ti';
$v_p_pl_1=$newstring.'tum';	
$v_p_pl_2=$newstring.'tuð';
$v_p_pl_3=$newstring.'tu';} else 
// fylla
if (($char[$num-3].$char[$num-2]=='ll') OR ($char[$num-3].$char[$num-2]=='nn')OR ($char[$num-2]=='p') OR ($char[$num-2]=='t') OR ($char[$num-2]=='s') OR ($char[$num-2]=='k')) {
$newstring = mb_substr($view_keyword, 0, -1);
$f_n_sg_1=$newstring.'i';
$f_n_sg_2=$newstring.'ir';
$f_n_sg_3=$newstring.'ir';
$f_n_pl_1=$newstring.'um';	
$f_n_pl_2=$newstring.'ið';
$f_n_pl_3=$newstring.'a';
$f_p_sg_1=$newstring.'ti';
$f_p_sg_2=$newstring.'tir';
$f_p_sg_3=$newstring.'ti';
$f_p_pl_1=$newstring.'tum';	
$f_p_pl_2=$newstring.'tuð';
$f_p_pl_3=$newstring.'tu';
$v_n_sg_1=$newstring.'i';
$v_n_sg_2=$newstring.'ir';
$v_n_sg_3=$newstring.'i';
$v_n_pl_1=$newstring.'um';	
$v_n_pl_2=$newstring.'ið';
$v_n_pl_3=$newstring.'i';
$v_p_sg_1=$newstring.'ti';
$v_p_sg_2=$newstring.'tir';
$v_p_sg_3=$newstring.'ti';
$v_p_pl_1=$newstring.'tum';	
$v_p_pl_2=$newstring.'tuð';
$v_p_pl_3=$newstring.'tu';} 
// 'benda
else if ($char[$num-2]=='d') {
$newstring = mb_substr($view_keyword, 0, -2);
$f_n_sg_1=$newstring.'di';
$f_n_sg_2=$newstring.'dir';
$f_n_sg_3=$newstring.'dir';
$f_n_pl_1=$newstring.'dum';	
$f_n_pl_2=$newstring.'dið';
$f_n_pl_3=$newstring.'da';
$f_p_sg_1=$newstring.'ti';
$f_p_sg_2=$newstring.'tir';
$f_p_sg_3=$newstring.'ti';
$f_p_pl_1=$newstring.'tum';	
$f_p_pl_2=$newstring.'tuð';
$f_p_pl_3=$newstring.'tu';
$v_n_sg_1=$newstring.'di';
$v_n_sg_2=$newstring.'dir';
$v_n_sg_3=$newstring.'di';
$v_n_pl_1=$newstring.'dum';	
$v_n_pl_2=$newstring.'dið';
$v_n_pl_3=$newstring.'di';
$v_p_sg_1=$newstring.'ti';
$v_p_sg_2=$newstring.'tir';
$v_p_sg_3=$newstring.'ti';
$v_p_pl_1=$newstring.'tum';	
$v_p_pl_2=$newstring.'tuð';
$v_p_pl_3=$newstring.'tu';} else {
$newstring = mb_substr($view_keyword, 0, -1);
$f_n_sg_1=$newstring.'i';
$f_n_sg_2=$newstring.'ir';
$f_n_sg_3=$newstring.'ir';
$f_n_pl_1=$newstring.'um';	
$f_n_pl_2=$newstring.'ið';
$f_n_pl_3=$newstring.'a';
$f_p_sg_1=$newstring.'di';
$f_p_sg_2=$newstring.'dir';
$f_p_sg_3=$newstring.'di';
$f_p_pl_1=$newstring.'dum';	
$f_p_pl_2=$newstring.'duð';
$f_p_pl_3=$newstring.'du';
$v_n_sg_1=$newstring.'i';
$v_n_sg_2=$newstring.'ir';
$v_n_sg_3=$newstring.'i';
$v_n_pl_1=$newstring.'um';	
$v_n_pl_2=$newstring.'ið';
$v_n_pl_3=$newstring.'i';
$v_p_sg_1=$newstring.'di';
$v_p_sg_2=$newstring.'dir';
$v_p_sg_3=$newstring.'di';
$v_p_pl_1=$newstring.'dum';	
$v_p_pl_2=$newstring.'duð';
$v_p_pl_3=$newstring.'du';}} 
// hlýða
if (($returned[8]=='(-ddi, -tt)') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -1);
$f_n_sg_1=$newstring.'i';
$f_n_sg_2=$newstring.'ir';
$f_n_sg_3=$newstring.'ir';
$f_n_pl_1=$newstring.'um';	
$f_n_pl_2=$newstring.'ið';
$f_n_pl_3=$newstring.'a';$newstring = mb_substr($view_keyword, 0, -2);
$f_p_sg_1=$newstring.'ddi';
$f_p_sg_2=$newstring.'ddir';
$f_p_sg_3=$newstring.'ddi';
$f_p_pl_1=$newstring.'ddum';	
$f_p_pl_2=$newstring.'dduð';
$f_p_pl_3=$newstring.'ddu';$newstring = mb_substr($view_keyword, 0, -1);
$v_n_sg_1=$newstring.'i';
$v_n_sg_2=$newstring.'ir';
$v_n_sg_3=$newstring.'i';$v_n_pl_1=$newstring.'um';	
$v_n_pl_2=$newstring.'ið';
$v_n_pl_3=$newstring.'i';$newstring = mb_substr($view_keyword, 0, -2);
$v_p_sg_1=$newstring.'ddi';
$v_p_sg_2=$newstring.'ddir';
$v_p_sg_3=$newstring.'ddi';
$v_p_pl_1=$newstring.'ddum';	
$v_p_pl_2=$newstring.'dduð';
$v_p_pl_3=$newstring.'ddu';
} 
// alhæfa
if (($returned[8]=='(-ði, -t)') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
// bergja
if ($char[$num-2]=='j') {
$newstring = mb_substr($view_keyword, 0, -2);
$f_n_sg_1=$newstring.'i';
$f_n_sg_2=$newstring.'ir';
$f_n_sg_3=$newstring.'ir';$f_n_pl_1=$newstring.'jum';	
$f_n_pl_2=$newstring.'ið';
$f_n_pl_3=$newstring.'ja';
$f_p_sg_1=$newstring.'ði';
$f_p_sg_2=$newstring.'ðir';
$f_p_sg_3=$newstring.'ði';
$f_p_pl_1=$newstring.'ðum';	
$f_p_pl_2=$newstring.'ðuð';
$f_p_pl_3=$newstring.'ðu';$v_n_sg_1=$newstring.'i';
$v_n_sg_2=$newstring.'ir';
$v_n_sg_3=$newstring.'i';$v_n_pl_1=$newstring.'jum';	
$v_n_pl_2=$newstring.'ið';
$v_n_pl_3=$newstring.'i';$v_p_sg_1=$newstring.'ði';
$v_p_sg_2=$newstring.'ðir';
$v_p_sg_3=$newstring.'ði';
$v_p_pl_1=$newstring.'ðum';	
$v_p_pl_2=$newstring.'ðuð';
$v_p_pl_3=$newstring.'ðu';
} else {
$newstring = mb_substr($view_keyword, 0, -1);
$f_n_sg_1=$newstring.'i';
$f_n_sg_2=$newstring.'ir';
$f_n_sg_3=$newstring.'ir';$f_n_pl_1=$newstring.'um';	
$f_n_pl_2=$newstring.'ið';
$f_n_pl_3=$newstring.'a';
$f_p_sg_1=$newstring.'ði';
$f_p_sg_2=$newstring.'ðir';
$f_p_sg_3=$newstring.'ði';
$f_p_pl_1=$newstring.'ðum';	
$f_p_pl_2=$newstring.'ðuð';
$f_p_pl_3=$newstring.'ðu';$v_n_sg_1=$newstring.'i';
$v_n_sg_2=$newstring.'ir';
$v_n_sg_3=$newstring.'i';$v_n_pl_1=$newstring.'um';	
$v_n_pl_2=$newstring.'ið';
$v_n_pl_3=$newstring.'i';$v_p_sg_1=$newstring.'ði';
$v_p_sg_2=$newstring.'ðir';
$v_p_sg_3=$newstring.'ði';
$v_p_pl_1=$newstring.'ðum';	
$v_p_pl_2=$newstring.'ðuð';
$v_p_pl_3=$newstring.'ðu';
}} 
// vofa
if (($returned[8]=='(-ði, -að)') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
// bergja
if ($char[$num-2]=='j') {
$newstring = mb_substr($view_keyword, 0, -2);
$f_n_sg_1=$newstring.'i';
$f_n_sg_2=$newstring.'ir';
$f_n_sg_3=$newstring.'ir';$f_n_pl_1=$newstring.'jum';	
$f_n_pl_2=$newstring.'ið';
$f_n_pl_3=$newstring.'ja';
$f_p_sg_1=$newstring.'ði';
$f_p_sg_2=$newstring.'ðir';
$f_p_sg_3=$newstring.'ði';
$f_p_pl_1=$newstring.'ðum';	
$f_p_pl_2=$newstring.'ðuð';
$f_p_pl_3=$newstring.'ðu';$v_n_sg_1=$newstring.'i';
$v_n_sg_2=$newstring.'ir';
$v_n_sg_3=$newstring.'i';$v_n_pl_1=$newstring.'jum';	
$v_n_pl_2=$newstring.'ið';
$v_n_pl_3=$newstring.'i';$v_p_sg_1=$newstring.'ði';
$v_p_sg_2=$newstring.'ðir';
$v_p_sg_3=$newstring.'ði';
$v_p_pl_1=$newstring.'ðum';	
$v_p_pl_2=$newstring.'ðuð';
$v_p_pl_3=$newstring.'ðu';
} else {
$newstring = mb_substr($view_keyword, 0, -1);
$f_n_sg_1=$newstring.'i';
$f_n_sg_2=$newstring.'ir';
$f_n_sg_3=$newstring.'ir';$f_n_pl_1=$newstring.'um';	
$f_n_pl_2=$newstring.'ið';
$f_n_pl_3=$newstring.'a';
$f_p_sg_1=$newstring.'ði';
$f_p_sg_2=$newstring.'ðir';
$f_p_sg_3=$newstring.'ði';
$f_p_pl_1=$newstring.'ðum';	
$f_p_pl_2=$newstring.'ðuð';
$f_p_pl_3=$newstring.'ðu';$v_n_sg_1=$newstring.'i';
$v_n_sg_2=$newstring.'ir';
$v_n_sg_3=$newstring.'i';$v_n_pl_1=$newstring.'um';	
$v_n_pl_2=$newstring.'ið';
$v_n_pl_3=$newstring.'i';$v_p_sg_1=$newstring.'ði';
$v_p_sg_2=$newstring.'ðir';
$v_p_sg_3=$newstring.'ði';
$v_p_pl_1=$newstring.'ðum';	
$v_p_pl_2=$newstring.'ðuð';
$v_p_pl_3=$newstring.'ðu';
}}
// bera
if (($returned[8]=='(-ber, -bar, -bárum, -borið)') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -4);
$f_n_sg_1=$newstring.'ber';
$f_n_sg_2=$newstring.'berð';
$f_n_sg_3=$newstring.'ber';$f_n_pl_1=$newstring.'berum';	
$f_n_pl_2=$newstring.'berið';
$f_n_pl_3=$newstring.'bera';
$f_p_sg_1=$newstring.'bar';
$f_p_sg_2=$newstring.'barst';
$f_p_sg_3=$newstring.'bar';
$f_p_pl_1=$newstring.'bárum';	
$f_p_pl_2=$newstring.'báruð';
$f_p_pl_3=$newstring.'báru';
$v_n_sg_1=$newstring.'beri';
$v_n_sg_2=$newstring.'berir';
$v_n_sg_3=$newstring.'beri';$v_n_pl_1=$newstring.'berum';	
$v_n_pl_2=$newstring.'berið';
$v_n_pl_3=$newstring.'beri';
$v_p_sg_1=$newstring.'bæri';
$v_p_sg_2=$newstring.'bærir';
$v_p_sg_3=$newstring.'bæri';
$v_p_pl_1=$newstring.'bærum';	
$v_p_pl_2=$newstring.'bæruð';
$v_p_pl_3=$newstring.'bæru';
} 
if (($_GET["generate"]=='no') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;$f_n_sg_1='';
$f_n_sg_2='';
$f_n_sg_3='';$f_n_pl_1='';	
$f_n_pl_2='';
$f_n_pl_3='';
$f_p_sg_1='';
$f_p_sg_2='';
$f_p_sg_3='';
$f_p_pl_1='';	
$f_p_pl_2='';
$f_p_pl_3='';$v_n_sg_1='';
$v_n_sg_2='';
$v_n_sg_3='';$v_n_pl_1='';	
$v_n_pl_2='';
$v_n_pl_3='';$v_p_sg_1='';
$v_p_sg_2='';
$v_p_sg_3='';
$v_p_pl_1='';	
$v_p_pl_2='';
$v_p_pl_3='';}
if ($found_pattern===FALSE) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -2);
$f_n_sg_1=$newstring.'';
$f_n_sg_2=$newstring.'';
$f_n_sg_3=$newstring.'';$f_n_pl_1=$newstring.'';	
$f_n_pl_2=$newstring.'';
$f_n_pl_3=$newstring.'';
$f_p_sg_1=$newstring.'';
$f_p_sg_2=$newstring.'';
$f_p_sg_3=$newstring.'';
$f_p_pl_1=$newstring.'';	
$f_p_pl_2=$newstring.'';
$f_p_pl_3=$newstring.'';$v_n_sg_1=$newstring.'i';
$v_n_sg_2=$newstring.'ir';
$v_n_sg_3=$newstring.'i';$v_n_pl_1=$newstring.'';	
$v_n_pl_2=$newstring.'ið';
$v_n_pl_3=$newstring.'i';$v_p_sg_1=$newstring.'';
$v_p_sg_2=$newstring.'';
$v_p_sg_3=$newstring.'';
$v_p_pl_1=$newstring.'';	
$v_p_pl_2=$newstring.'';
$v_p_pl_3=$newstring.'';
} 
$table2 = 'ds_dec_v_1';$sql2 = sprintf ('INSERT INTO `%s` (`id`, `keyword`, `num_keyword`, `f_n_sg_1`, `f_n_sg_2`, `f_n_sg_3`, `f_n_pl_1`, `f_n_pl_2`, `f_n_pl_3`, `f_p_sg_1`, `f_p_sg_2`, `f_p_sg_3`, `f_p_pl_1`, `f_p_pl_2`, `f_p_pl_3`, `v_n_sg_1`, `v_n_sg_2`, `v_n_sg_3`, `v_n_pl_1`, `v_n_pl_2`, `v_n_pl_3`, `v_p_sg_1`, `v_p_sg_2`, `v_p_sg_3`, `v_p_pl_1`, `v_p_pl_2`, `v_p_pl_3`) VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)',
	$table2,					
	quate_smart($view_keyword),
	quate_smart($view_num_keyword),
	quate_smart($f_n_sg_1),
	quate_smart($f_n_sg_2),
	quate_smart($f_n_sg_3),
	quate_smart($f_n_pl_1),
	quate_smart($f_n_pl_2),
	quate_smart($f_n_pl_3),
	quate_smart($f_p_sg_1),
	quate_smart($f_p_sg_2),
	quate_smart($f_p_sg_3),
	quate_smart($f_p_pl_1),
	quate_smart($f_p_pl_2),
	quate_smart($f_p_pl_3),
	quate_smart($v_n_sg_1),
	quate_smart($v_n_sg_2),
	quate_smart($v_n_sg_3),
	quate_smart($v_n_pl_1),
	quate_smart($v_n_pl_2),
	quate_smart($v_n_pl_3),
	quate_smart($v_p_sg_1),
	quate_smart($v_p_sg_2),
	quate_smart($v_p_sg_3),
	quate_smart($v_p_pl_1),
	quate_smart($v_p_pl_2),
	quate_smart($v_p_pl_3));
$oop2->Setnames();
$oop2->query($sql2);$oop2->freeResult();
}
}
if ($action_scripts=="gen_verb2") {
$dict_keyword='ds_1_headword';
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$dict_keyword,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop->Setnames();
$oop->query($sql);
$returned = $oop->fetchArray ();
$oop->freeResult();$number33=55;
$table2 = 'ds_dec_v_2';
$sql = sprintf ('SELECT `keyword` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop3->Setnames();
$oop3->query($sql);
$number33 = $oop3->getNumrows(); 
$oop3->freeResult();
$found_pattern=FALSE;
$ary[] = "UTF-8";
$ary[] = "ASCII";
mb_detect_order($ary);
mb_internal_encoding("UTF-8");
if ($number33==0) {
$num=mb_strlen($view_keyword);$char[$num-1] = mb_substr($view_keyword,$num-1,1);
$char[$num-2] = mb_substr($view_keyword,$num-2,1);
$char[$num-3] = mb_substr($view_keyword,$num-3,1);
$char[$num-4] = mb_substr($view_keyword,$num-4,1);
$char[$num-5] = mb_substr($view_keyword,$num-5,1);
$char[$num-6] = mb_substr($view_keyword,$num-6,1);$last_6=$char[$num-6].$char[$num-5].$char[$num-4].$char[$num-3].$char[$num-2].$char[$num-1];
$last_5=$char[$num-5].$char[$num-4].$char[$num-3].$char[$num-2].$char[$num-1];
$last_4=$char[$num-4].$char[$num-3].$char[$num-2].$char[$num-1];
$last_3=$char[$num-3].$char[$num-2].$char[$num-1];
$last_2=$char[$num-2].$char[$num-1];
$last_1=$char[$num-1];
if ((($returned[8]=='(-aði)') OR ($returned[8]=='(-aðist)')) AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
if ($returned[8]=='(-aðist)') {
$newstring = mb_substr($view_keyword, 0, -3);	
} else {
$newstring = mb_substr($view_keyword, 0, -1);
}
$f_n_sg_1=$newstring.'ast';
$f_n_sg_2=$newstring.'ast';
$f_n_sg_3=$newstring.'ast';
if (($char[$num-5]=='a') AND ($char[$num-5].$char[$num-4]!='au') AND ($num>4)) {
$helpstring = mb_substr($view_keyword, 0, -5);	
$f_n_pl_1=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'umst';}
else if ($char[$num-3]=='a') {
$helpstring = mb_substr($view_keyword, 0, -3);	
$f_n_pl_1=$helpstring.'ö'.$char[$num-2].'umst';
} else if (($char[$num-4]=='a') AND ($char[$num-4].$char[$num-3]!='au')) {
$helpstring = mb_substr($view_keyword, 0, -4);	
$f_n_pl_1=$helpstring.'ö'.$char[$num-3].$char[$num-2].'umst';
} else {
$f_n_pl_1=$newstring.'umst';	}
$f_n_pl_2=$newstring.'ist';
$f_n_pl_3=$newstring.'ast';
$f_p_sg_1=$newstring.'aðist';
$f_p_sg_2=$newstring.'aðist';
$f_p_sg_3=$newstring.'aðist';
if (($char[$num-5]=='a') AND ($char[$num-5].$char[$num-4]!='au') AND ($num>4)){
$helpstring = mb_substr($view_keyword, 0, -5);	
$f_p_pl_1=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðumst';
$f_p_pl_2=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðust';
$f_p_pl_3=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðust';}
else 
 if ($char[$num-3]=='a') {
$helpstring = mb_substr($view_keyword, 0, -3);	
$f_p_pl_1=$helpstring.'ö'.$char[$num-2].'uðumst';
$f_p_pl_2=$helpstring.'ö'.$char[$num-2].'uðust';
$f_p_pl_3=$helpstring.'ö'.$char[$num-2].'uðust';} else if (($char[$num-4]=='a') AND ($char[$num-4].$char[$num-3]!='au')){
$helpstring = mb_substr($view_keyword, 0, -4);	
$f_p_pl_1=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðumst';
$f_p_pl_2=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðust';
$f_p_pl_3=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðust';} else {
$f_p_pl_1=$newstring.'uðumst';	
$f_p_pl_2=$newstring.'uðust';
$f_p_pl_3=$newstring.'uðust';}

$v_n_sg_1=$newstring.'ist';
$v_n_sg_2=$newstring.'ist';
$v_n_sg_3=$newstring.'ist';

if (($char[$num-5]=='a') AND ($char[$num-5].$char[$num-4]!='au') AND ($num>4)) {
$helpstring = mb_substr($view_keyword, 0, -5);	
$v_n_pl_1=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'umsts';}
else 
 if ($char[$num-3]=='a') {
$helpstring = mb_substr($view_keyword, 0, -3);	
$v_n_pl_1=$helpstring.'ö'.$char[$num-2].'umst';
} else if (($char[$num-4]=='a') AND ($char[$num-4].$char[$num-3]!='au')) {
$helpstring = mb_substr($view_keyword, 0, -4);	
$v_n_pl_1=$helpstring.'ö'.$char[$num-3].$char[$num-2].'ustm';
} else  {
$v_n_pl_1=$newstring.'umst';	}
$v_n_pl_2=$newstring.'ist';
$v_n_pl_3=$newstring.'ist';
$v_p_sg_1=$newstring.'aðist';
$v_p_sg_2=$newstring.'aðist';
$v_p_sg_3=$newstring.'aðist';
if (($char[$num-5]=='a') AND ($char[$num-5].$char[$num-4]!='au') AND ($num>4)){
$helpstring = mb_substr($view_keyword, 0, -5);	
$v_p_pl_1=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðumst';
$v_p_pl_2=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðust';
$v_p_pl_3=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðust';}
else 
if ($char[$num-3]=='a') {
$helpstring = mb_substr($view_keyword, 0, -3);	
$v_p_pl_1=$helpstring.'ö'.$char[$num-2].'uðumst';
$v_p_pl_2=$helpstring.'ö'.$char[$num-2].'uðust';
$v_p_pl_3=$helpstring.'ö'.$char[$num-2].'uðust';} else  if (($char[$num-4]=='a') AND ($char[$num-4].$char[$num-3]!='au')){
$helpstring = mb_substr($view_keyword, 0, -4);	
$v_p_pl_1=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðumst';
$v_p_pl_2=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðust';
$v_p_pl_3=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðust';} else {
$v_p_pl_1=$newstring.'uðumst';	
$v_p_pl_2=$newstring.'uðust';
$v_p_pl_3=$newstring.'uðust';}} 
// afferma
if (($returned[8]=='(-di, -t)') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
if ($char[$num-3].$char[$num-2]=='gj') {$newstring = mb_substr($view_keyword, 0, -2);
$f_n_sg_1=$newstring.'ist';
$f_n_sg_2=$newstring.'ist';
$f_n_sg_3=$newstring.'ist';$f_n_pl_1=$newstring.'jumst';	
$f_n_pl_2=$newstring.'ist';
$f_n_pl_3=$newstring.'jast';
$f_p_sg_1=$newstring.'dist';
$f_p_sg_2=$newstring.'dist';
$f_p_sg_3=$newstring.'dist';
$f_p_pl_1=$newstring.'dumst';	
$f_p_pl_2=$newstring.'dust';
$f_p_pl_3=$newstring.'dust';$v_n_sg_1=$newstring.'ist';
$v_n_sg_2=$newstring.'ist';
$v_n_sg_3=$newstring.'ist';$v_n_pl_1=$newstring.'jumst';	
$v_n_pl_2=$newstring.'ist';
$v_n_pl_3=$newstring.'ist';$v_p_sg_1=$newstring.'dist';
$v_p_sg_2=$newstring.'dist';
$v_p_sg_3=$newstring.'dist';
$v_p_pl_1=$newstring.'dumst';	
$v_p_pl_2=$newstring.'dust';
$v_p_pl_3=$newstring.'dust';} else {
// týna
$newstring = mb_substr($view_keyword, 0, -1);
$f_n_sg_1=$newstring.'ist';
$f_n_sg_2=$newstring.'ist';
$f_n_sg_3=$newstring.'ist';$f_n_pl_1=$newstring.'umst';	$f_n_pl_2=$newstring.'ist';
$f_n_pl_3=$newstring.'ast';$f_p_sg_1=$newstring.'dist';
$f_p_sg_2=$newstring.'dist';
$f_p_sg_3=$newstring.'dist';
$f_p_pl_1=$newstring.'dumst';	
$f_p_pl_2=$newstring.'dust';
$f_p_pl_3=$newstring.'dust';$v_n_sg_1=$newstring.'ist';
$v_n_sg_2=$newstring.'ist';
$v_n_sg_3=$newstring.'ist';$v_n_pl_1=$newstring.'umst';	$v_n_pl_2=$newstring.'ist';
$v_n_pl_3=$newstring.'ist';
$v_p_sg_1=$newstring.'dist';
$v_p_sg_2=$newstring.'dist';
$v_p_sg_3=$newstring.'dist';
$v_p_pl_1=$newstring.'dumst';	
$v_p_pl_2=$newstring.'dust';
$v_p_pl_3=$newstring.'dust';}} 
// auglýsa
if (($returned[8]=='(-ti, -t)') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
if ($char[$num-3].$char[$num-2]=='tj') {
$newstring = mb_substr($view_keyword, 0, -2);
$f_n_sg_1=$newstring.'st';
$f_n_sg_2=$newstring.'ust';
$f_n_sg_3=$newstring.'ust';$f_n_pl_1=$newstring.'jumst';	
$f_n_pl_2=$newstring.'jist';
$f_n_pl_3=$newstring.'jast';
$f_p_sg_1=$newstring.'tist';
$f_p_sg_2=$newstring.'tist';
$f_p_sg_3=$newstring.'tist';
$f_p_pl_1=$newstring.'tumst';	
$f_p_pl_2=$newstring.'tust';
$f_p_pl_3=$newstring.'tust';$v_n_sg_1=$newstring.'jist';
$v_n_sg_2=$newstring.'jist';
$v_n_sg_3=$newstring.'jist';$v_n_pl_1=$newstring.'jumst';	
$v_n_pl_2=$newstring.'jist';
$v_n_pl_3=$newstring.'jist';$v_p_sg_1=$newstring.'tist';
$v_p_sg_2=$newstring.'tist';
$v_p_sg_3=$newstring.'tist';
$v_p_pl_1=$newstring.'tumst';	
$v_p_pl_2=$newstring.'tust';
$v_p_pl_3=$newstring.'tust';} else 
// kíkja
if ($char[$num-3].$char[$num-2]=='kj') {
$newstring = mb_substr($view_keyword, 0, -2);
$f_n_sg_1=$newstring.'ist';
$f_n_sg_2=$newstring.'ist';
$f_n_sg_3=$newstring.'ist';$f_n_pl_1=$newstring.'jumst';	
$f_n_pl_2=$newstring.'ist';
$f_n_pl_3=$newstring.'jast';
$f_p_sg_1=$newstring.'tist';
$f_p_sg_2=$newstring.'tist';
$f_p_sg_3=$newstring.'tist';
$f_p_pl_1=$newstring.'tumst';	
$f_p_pl_2=$newstring.'tust';
$f_p_pl_3=$newstring.'tust';$v_n_sg_1=$newstring.'ist';
$v_n_sg_2=$newstring.'ist';
$v_n_sg_3=$newstring.'ist';$v_n_pl_1=$newstring.'jumst';	
$v_n_pl_2=$newstring.'ist';
$v_n_pl_3=$newstring.'ist';$v_p_sg_1=$newstring.'tist';
$v_p_sg_2=$newstring.'tist';
$v_p_sg_3=$newstring.'tist';
$v_p_pl_1=$newstring.'tumst';	
$v_p_pl_2=$newstring.'tust';
$v_p_pl_3=$newstring.'tust';} else 
// fylla
if (($char[$num-3].$char[$num-2]=='ll') OR ($char[$num-3].$char[$num-2]=='nn') OR ($char[$num-2]=='p') OR ($char[$num-2]=='t') OR ($char[$num-2]=='s') OR ($char[$num-2]=='k')) {
$newstring = mb_substr($view_keyword, 0, -1);
$f_n_sg_1=$newstring.'ist';
$f_n_sg_2=$newstring.'ist';
$f_n_sg_3=$newstring.'ist';$f_n_pl_1=$newstring.'umst';	
$f_n_pl_2=$newstring.'ist';
$f_n_pl_3=$newstring.'ast';
$f_p_sg_1=$newstring.'tist';
$f_p_sg_2=$newstring.'tist';
$f_p_sg_3=$newstring.'tist';
$f_p_pl_1=$newstring.'tumst';	
$f_p_pl_2=$newstring.'tust';
$f_p_pl_3=$newstring.'tust';$v_n_sg_1=$newstring.'ist';
$v_n_sg_2=$newstring.'ist';
$v_n_sg_3=$newstring.'ist';$v_n_pl_1=$newstring.'umst';	
$v_n_pl_2=$newstring.'ist';
$v_n_pl_3=$newstring.'ist';$v_p_sg_1=$newstring.'tist';
$v_p_sg_2=$newstring.'tist';
$v_p_sg_3=$newstring.'tist';
$v_p_pl_1=$newstring.'tumst';	
$v_p_pl_2=$newstring.'tust';
$v_p_pl_3=$newstring.'tust';} 
// 'benda
else if ($char[$num-2]=='d') {
$newstring = mb_substr($view_keyword, 0, -2);
$f_n_sg_1=$newstring.'dist';
$f_n_sg_2=$newstring.'dist';
$f_n_sg_3=$newstring.'dist';$f_n_pl_1=$newstring.'dumst';	
$f_n_pl_2=$newstring.'dist';
$f_n_pl_3=$newstring.'dast';
$f_p_sg_1=$newstring.'tist';
$f_p_sg_2=$newstring.'tist';
$f_p_sg_3=$newstring.'tist';
$f_p_pl_1=$newstring.'tumst';	
$f_p_pl_2=$newstring.'tust';
$f_p_pl_3=$newstring.'tust';$v_n_sg_1=$newstring.'dist';
$v_n_sg_2=$newstring.'dist';
$v_n_sg_3=$newstring.'dist';$v_n_pl_1=$newstring.'dumst';	
$v_n_pl_2=$newstring.'dist';
$v_n_pl_3=$newstring.'dist';$v_p_sg_1=$newstring.'tist';
$v_p_sg_2=$newstring.'tist';
$v_p_sg_3=$newstring.'tist';
$v_p_pl_1=$newstring.'tumst';	
$v_p_pl_2=$newstring.'tust';
$v_p_pl_3=$newstring.'tust';} else {
$newstring = mb_substr($view_keyword, 0, -1);
$f_n_sg_1=$newstring.'ist';
$f_n_sg_2=$newstring.'ist';
$f_n_sg_3=$newstring.'ist';$f_n_pl_1=$newstring.'umst';	$f_n_pl_2=$newstring.'ist';
$f_n_pl_3=$newstring.'ast';$f_p_sg_1=$newstring.'dist';
$f_p_sg_2=$newstring.'dist';
$f_p_sg_3=$newstring.'dist';
$f_p_pl_1=$newstring.'dumst';	
$f_p_pl_2=$newstring.'dust';
$f_p_pl_3=$newstring.'dust';$v_n_sg_1=$newstring.'ist';
$v_n_sg_2=$newstring.'ist';
$v_n_sg_3=$newstring.'ist';$v_n_pl_1=$newstring.'umst';	$v_n_pl_2=$newstring.'ist';
$v_n_pl_3=$newstring.'ist';$v_p_sg_1=$newstring.'dist';
$v_p_sg_2=$newstring.'dist';
$v_p_sg_3=$newstring.'dist';
$v_p_pl_1=$newstring.'dumst';	
$v_p_pl_2=$newstring.'dust';
$v_p_pl_3=$newstring.'dust';}} 
// hlýða
if (($returned[8]=='(-ddi, -tt)') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -1);
$f_n_sg_1=$newstring.'ist';
$f_n_sg_2=$newstring.'ist';
$f_n_sg_3=$newstring.'ist';$f_n_pl_1=$newstring.'umst';	
$f_n_pl_2=$newstring.'ist';
$f_n_pl_3=$newstring.'ast';$newstring = mb_substr($view_keyword, 0, -2);
$f_p_sg_1=$newstring.'ddist';
$f_p_sg_2=$newstring.'ddist';
$f_p_sg_3=$newstring.'ddist';
$f_p_pl_1=$newstring.'ddumst';	
$f_p_pl_2=$newstring.'ddust';
$f_p_pl_3=$newstring.'ddust';$newstring = mb_substr($view_keyword, 0, -1);
$v_n_sg_1=$newstring.'ist';
$v_n_sg_2=$newstring.'ist';
$v_n_sg_3=$newstring.'ist';$v_n_pl_1=$newstring.'umst';	
$v_n_pl_2=$newstring.'ist';
$v_n_pl_3=$newstring.'ist';$newstring = mb_substr($view_keyword, 0, -2);
$v_p_sg_1=$newstring.'ddist';
$v_p_sg_2=$newstring.'ddist';
$v_p_sg_3=$newstring.'ddist';
$v_p_pl_1=$newstring.'ddumst';	
$v_p_pl_2=$newstring.'ddust';
$v_p_pl_3=$newstring.'ddust';
} 
// alhæfa
if (($returned[8]=='(-ði, -t)') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
// bergja
if ($char[$num-2]=='j') {
$newstring = mb_substr($view_keyword, 0, -2);
$f_n_sg_1=$newstring.'ist';
$f_n_sg_2=$newstring.'ist';
$f_n_sg_3=$newstring.'ist';$f_n_pl_1=$newstring.'jumst';	
$f_n_pl_2=$newstring.'ist';
$f_n_pl_3=$newstring.'jast';
$f_p_sg_1=$newstring.'ðist';
$f_p_sg_2=$newstring.'ðist';
$f_p_sg_3=$newstring.'ðist';
$f_p_pl_1=$newstring.'ðumst';	
$f_p_pl_2=$newstring.'ðust';
$f_p_pl_3=$newstring.'ðust';$v_n_sg_1=$newstring.'ist';
$v_n_sg_2=$newstring.'ist';
$v_n_sg_3=$newstring.'ist';$v_n_pl_1=$newstring.'jumst';	
$v_n_pl_2=$newstring.'ist';
$v_n_pl_3=$newstring.'ist';$v_p_sg_1=$newstring.'ðist';
$v_p_sg_2=$newstring.'ðist';
$v_p_sg_3=$newstring.'ðist';
$v_p_pl_1=$newstring.'ðumst';	
$v_p_pl_2=$newstring.'ðust';
$v_p_pl_3=$newstring.'ðust';
} else {
$newstring = mb_substr($view_keyword, 0, -1);
$f_n_sg_1=$newstring.'ist';
$f_n_sg_2=$newstring.'ist';
$f_n_sg_3=$newstring.'ist';$f_n_pl_1=$newstring.'umst';	
$f_n_pl_2=$newstring.'ist';
$f_n_pl_3=$newstring.'ast';
$f_p_sg_1=$newstring.'ðist';
$f_p_sg_2=$newstring.'ðist';
$f_p_sg_3=$newstring.'ðist';
$f_p_pl_1=$newstring.'ðumst';	
$f_p_pl_2=$newstring.'ðust';
$f_p_pl_3=$newstring.'ðust';$v_n_sg_1=$newstring.'ist';
$v_n_sg_2=$newstring.'ist';
$v_n_sg_3=$newstring.'ist';$v_n_pl_1=$newstring.'umst';	
$v_n_pl_2=$newstring.'ist';
$v_n_pl_3=$newstring.'ist';$v_p_sg_1=$newstring.'ðist';
$v_p_sg_2=$newstring.'ðist';
$v_p_sg_3=$newstring.'ðist';
$v_p_pl_1=$newstring.'ðumst';	
$v_p_pl_2=$newstring.'ðust';
$v_p_pl_3=$newstring.'ðust';
}} 
if (($returned[8]=='(-ber, -bar, -bárum, -borið)') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -4);
$f_n_sg_1=$newstring.'berst';
$f_n_sg_2=$newstring.'berst';
$f_n_sg_3=$newstring.'berst';$f_n_pl_1=$newstring.'berumst';	
$f_n_pl_2=$newstring.'berist';
$f_n_pl_3=$newstring.'berast';$f_p_sg_1=$newstring.'barst';
$f_p_sg_2=$newstring.'barst';
$f_p_sg_3=$newstring.'barst';
$f_p_pl_1=$newstring.'bárumst';	
$f_p_pl_2=$newstring.'bárust';
$f_p_pl_3=$newstring.'bárust';
$v_n_sg_1=$newstring.'berist';
$v_n_sg_2=$newstring.'berist';
$v_n_sg_3=$newstring.'berist';$v_n_pl_1=$newstring.'berumst';	
$v_n_pl_2=$newstring.'berist';
$v_n_pl_3=$newstring.'berist';$v_p_sg_1=$newstring.'bærist';
$v_p_sg_2=$newstring.'bærist';
$v_p_sg_3=$newstring.'bærist';
$v_p_pl_1=$newstring.'bærumst';	
$v_p_pl_2=$newstring.'bærust';
$v_p_pl_3=$newstring.'bærust';
} 
if (($_GET["generate"]=='no') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;$f_n_sg_1='';
$f_n_sg_2='';
$f_n_sg_3='';$f_n_pl_1='';	
$f_n_pl_2='';
$f_n_pl_3='';
$f_p_sg_1='';
$f_p_sg_2='';
$f_p_sg_3='';
$f_p_pl_1='';	
$f_p_pl_2='';
$f_p_pl_3='';$v_n_sg_1='';
$v_n_sg_2='';
$v_n_sg_3='';$v_n_pl_1='';	
$v_n_pl_2='';
$v_n_pl_3='';$v_p_sg_1='';
$v_p_sg_2='';
$v_p_sg_3='';
$v_p_pl_1='';	
$v_p_pl_2='';
$v_p_pl_3='';
}
if ($found_pattern===FALSE) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -2);
$f_n_sg_1=$newstring.'';
$f_n_sg_2=$newstring.'';
$f_n_sg_3=$newstring.'';$f_n_pl_1=$newstring.'';	
$f_n_pl_2=$newstring.'';
$f_n_pl_3=$newstring.'';
$f_p_sg_1=$newstring.'';
$f_p_sg_2=$newstring.'';
$f_p_sg_3=$newstring.'';
$f_p_pl_1=$newstring.'';	
$f_p_pl_2=$newstring.'';
$f_p_pl_3=$newstring.'';$v_n_sg_1=$newstring.'ist';
$v_n_sg_2=$newstring.'ist';
$v_n_sg_3=$newstring.'ist';$v_n_pl_1=$newstring.'';	
$v_n_pl_2=$newstring.'ist';
$v_n_pl_3=$newstring.'ist';$v_p_sg_1=$newstring.'';
$v_p_sg_2=$newstring.'';
$v_p_sg_3=$newstring.'';
$v_p_pl_1=$newstring.'';	
$v_p_pl_2=$newstring.'';
$v_p_pl_3=$newstring.'';
}
$table2 = 'ds_dec_v_2';$sql2 = sprintf ('INSERT INTO `%s` (`id`, `keyword`, `num_keyword`, `f_n_sg_1`, `f_n_sg_2`, `f_n_sg_3`, `f_n_pl_1`, `f_n_pl_2`, `f_n_pl_3`, `f_p_sg_1`, `f_p_sg_2`, `f_p_sg_3`, `f_p_pl_1`, `f_p_pl_2`, `f_p_pl_3`, `v_n_sg_1`, `v_n_sg_2`, `v_n_sg_3`, `v_n_pl_1`, `v_n_pl_2`, `v_n_pl_3`, `v_p_sg_1`, `v_p_sg_2`, `v_p_sg_3`, `v_p_pl_1`, `v_p_pl_2`, `v_p_pl_3`) VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)',
	$table2,					
	quate_smart($view_keyword),
	quate_smart($view_num_keyword),
	quate_smart($f_n_sg_1),
	quate_smart($f_n_sg_2),
	quate_smart($f_n_sg_3),
	quate_smart($f_n_pl_1),
	quate_smart($f_n_pl_2),
	quate_smart($f_n_pl_3),
	quate_smart($f_p_sg_1),
	quate_smart($f_p_sg_2),
	quate_smart($f_p_sg_3),
	quate_smart($f_p_pl_1),
	quate_smart($f_p_pl_2),
	quate_smart($f_p_pl_3),
	quate_smart($v_n_sg_1),
	quate_smart($v_n_sg_2),
	quate_smart($v_n_sg_3),
	quate_smart($v_n_pl_1),
	quate_smart($v_n_pl_2),
	quate_smart($v_n_pl_3),
	quate_smart($v_p_sg_1),
	quate_smart($v_p_sg_2),
	quate_smart($v_p_sg_3),
	quate_smart($v_p_pl_1),
	quate_smart($v_p_pl_2),
	quate_smart($v_p_pl_3));$oop2->Setnames();
$oop2->query($sql2);$oop2->freeResult();
}
}
if ($action_scripts=="gen_verb3") {
$dict_keyword='ds_1_headword';
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$dict_keyword,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop->Setnames();
$oop->query($sql);
$returned = $oop->fetchArray ();
$oop->freeResult();$number33=55;
$table2 = 'ds_dec_v_3';
$sql = sprintf ('SELECT `keyword` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop3->Setnames();
$oop3->query($sql);
$number33 = $oop3->getNumrows(); 
$oop3->freeResult();
$found_pattern=FALSE;
$ary[] = "UTF-8";
$ary[] = "ASCII";
mb_detect_order($ary);
mb_internal_encoding("UTF-8");
if ($number33==0) {$num=mb_strlen($view_keyword);$char[$num-1] = mb_substr($view_keyword,$num-1,1);
$char[$num-2] = mb_substr($view_keyword,$num-2,1);
$char[$num-3] = mb_substr($view_keyword,$num-3,1);
$char[$num-4] = mb_substr($view_keyword,$num-4,1);
$char[$num-5] = mb_substr($view_keyword,$num-5,1);
$char[$num-6] = mb_substr($view_keyword,$num-6,1);$last_6=$char[$num-6].$char[$num-5].$char[$num-4].$char[$num-3].$char[$num-2].$char[$num-1];
$last_5=$char[$num-5].$char[$num-4].$char[$num-3].$char[$num-2].$char[$num-1];
$last_4=$char[$num-4].$char[$num-3].$char[$num-2].$char[$num-1];
$last_3=$char[$num-3].$char[$num-2].$char[$num-1];
$last_2=$char[$num-2].$char[$num-1];
$last_1=$char[$num-1];
// kalla
if ((($returned[8]=='(-aði)') OR ($returned[8]=='(-aðist)')) AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
if ($returned[8]=='(-aðist)') {
$newstring = mb_substr($view_keyword, 0, -3);	
} else {
$newstring = mb_substr($view_keyword, 0, -1);
}
$b_1=$newstring.'a';
$b_sg_1=$newstring.'aðu';
$b_pl_1=$newstring.'ið';
$b_sg_2='';
$b_pl_2='';
$ln=$newstring.'andi';
$s_1=$newstring.'að';
$s_2=$newstring.'ast';} 
// afferma
if (($returned[8]=='(-di, -t)') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
if ($char[$num-3].$char[$num-2]=='gj') {$newstring = mb_substr($view_keyword, 0, -2);$b_1=$newstring.'';
$b_sg_1=$newstring.'tu';
$b_pl_1=$newstring.'jið';
$b_sg_2='';
$b_pl_2='';
$ln=$newstring.'jandi';
$s_1=$newstring.'t';
$s_2='';
} else {
// týna
$newstring = mb_substr($view_keyword, 0, -1);
$b_1=$newstring.'';
$b_sg_1=$newstring.'du';
$b_pl_1=$newstring.'ið';
$b_sg_2='';
$b_pl_2='';
$ln=$newstring.'andi';
$s_1=$newstring.'t';
$s_2='';}} 
// auglýsa
if (($returned[8]=='(-ti, -t)') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
if ($char[$num-3].$char[$num-2]=='tj') {
$newstring = mb_substr($view_keyword, 0, -2);$b_1=$newstring.'';
$b_sg_1=$newstring.'tu';
$b_pl_1=$newstring.'jið';
$b_sg_2='';
$b_pl_2='';
$ln=$newstring.'jandi';
$s_1=$newstring.'t';
$s_2='';
} else 
// kíkja
if ($char[$num-3].$char[$num-2]=='kj') {
$newstring = mb_substr($view_keyword, 0, -2);
$b_1=$newstring.'';
$b_sg_1=$newstring.'tu';
$b_pl_1=$newstring.'ið';
$b_sg_2='';
$b_pl_2='';
$ln=$newstring.'jandi';
$s_1=$newstring.'t';
$s_2='';
} else 
// fylla
if (($char[$num-3].$char[$num-2]=='ll') OR ($char[$num-2]=='p') OR ($char[$num-2]=='t') OR ($char[$num-2]=='s') OR ($char[$num-2]=='k')) {
$newstring = mb_substr($view_keyword, 0, -1);$b_1=$newstring.'';
$b_sg_1=$newstring.'tu';
$b_pl_1=$newstring.'ið';
$b_sg_2='';
$b_pl_2='';
$ln=$newstring.'andi';
$s_1=$newstring.'t';
$s_2='';
} 
// 'benda
else if ($char[$num-2]=='d') {
$newstring = mb_substr($view_keyword, 0, -2);$b_1=$newstring.'d';
$b_sg_1=$newstring.'tu';
$b_pl_1=$newstring.'dið';
$b_sg_2='';
$b_pl_2='';
$ln=$newstring.'dandi';
$s_1=$newstring.'t';
$s_2='';
} else {
$newstring = mb_substr($view_keyword, 0, -1);
$b_1=$newstring.'';
$b_sg_1=$newstring.'tu';
$b_pl_1=$newstring.'ið';
$b_sg_2='';
$b_pl_2='';
$ln=$newstring.'andi';
$s_1=$newstring.'t';
$s_2='';}} 
// hlýða
if (($returned[8]=='(-ddi, -tt)') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -2);
$b_1=$newstring.'ð';
$b_sg_1=$newstring.'ddu';
$b_pl_1=$newstring.'ðið';
$b_sg_2='';
$b_pl_2='';
$ln=$newstring.'ðandi';
$s_1=$newstring.'tt';
$s_2='';
} 
// alhæfa
if (($returned[8]=='(-ði, -t)') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
// bergja
if ($char[$num-2]=='j') {
$newstring = mb_substr($view_keyword, 0, -2);
$b_1=$newstring.'';
$b_sg_1=$newstring.'ðu';
$b_pl_1=$newstring.'ið';
$b_sg_2='';
$b_pl_2='';
$ln=$newstring.'jandi';
$s_1=$newstring.'t';
$s_2='';
} 
}
if (($returned[8]=='(-ber, -bar, -bárum, -borið)') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -4);
$b_1=$newstring.'ber';
$b_sg_1=$newstring.'berðu';
$b_pl_1=$newstring.'berið';
$b_sg_2='berstu';
$b_pl_2='berist';
$ln=$newstring.'berndi';
$s_1=$newstring.'borið';
$s_2='borist';
} 
if (($_GET["generate"]=='no') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -2);
$b_1=$newstring.'';
$b_sg_1=$newstring.'';
$b_pl_1=$newstring.'';
$b_sg_2='';
$b_pl_2='';
$ln=$newstring.'';
$s_1=$newstring.'';
$s_2='';
}
if ($found_pattern===FALSE) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -2);
$b_1=$newstring.'';
$b_sg_1=$newstring.'';
$b_pl_1=$newstring.'';
$b_sg_2='';
$b_pl_2='';
$ln=$newstring.'ndi';
$s_1=$newstring.'t';
$s_2='';
}  
$table2 = 'ds_dec_v_3';
$sql2 = sprintf ('INSERT INTO `%s` (`id`, `keyword`, `num_keyword`, `b_1`, `b_sg_1`, `b_pl_1`, `b_sg_2`, `b_pl_2`, `ln`, `s_1`, `s_2`) VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)',
	$table2,					
	quate_smart($view_keyword),
	quate_smart($view_num_keyword),
	quate_smart($b_1),
	quate_smart($b_sg_1),
	quate_smart($b_pl_1),
	quate_smart($b_sg_2),
	quate_smart($b_pl_2),
	quate_smart($ln),
	quate_smart($s_1),
	quate_smart($s_2));$oop2->Setnames();
$oop2->query($sql2);$oop2->freeResult();
}
}
if ($action_scripts=="gen_verb4") {
$dict_keyword='ds_1_headword';
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$dict_keyword,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop->Setnames();
$oop->query($sql);
$returned = $oop->fetchArray ();
$oop->freeResult();$number33=55;
$table2 = 'ds_dec_v_4';
$sql = sprintf ('SELECT `keyword` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop3->Setnames();
$oop3->query($sql);
$number33 = $oop3->getNumrows(); 
$oop3->freeResult();
$found_pattern=FALSE;
$ary[] = "UTF-8";
$ary[] = "ASCII";
mb_detect_order($ary);
mb_internal_encoding("UTF-8");
if ($number33==0) {$num=mb_strlen($view_keyword);$char[$num-1] = mb_substr($view_keyword,$num-1,1);
$char[$num-2] = mb_substr($view_keyword,$num-2,1);
$char[$num-3] = mb_substr($view_keyword,$num-3,1);
$char[$num-4] = mb_substr($view_keyword,$num-4,1);
$char[$num-5] = mb_substr($view_keyword,$num-5,1);
$char[$num-6] = mb_substr($view_keyword,$num-6,1);$last_6=$char[$num-6].$char[$num-5].$char[$num-4].$char[$num-3].$char[$num-2].$char[$num-1];
$last_5=$char[$num-5].$char[$num-4].$char[$num-3].$char[$num-2].$char[$num-1];
$last_4=$char[$num-4].$char[$num-3].$char[$num-2].$char[$num-1];
$last_3=$char[$num-3].$char[$num-2].$char[$num-1];
$last_2=$char[$num-2].$char[$num-1];
$last_1=$char[$num-1];
if (($last_4=='laus') OR ($last_3=='fær') OR ($last_3=='kær') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
$newstring = $view_keyword;
//aðgerðarlaus
// strong singular		
$s_sg_m_1=$newstring;
$s_sg_m_4=$newstring.'an';
$s_sg_m_3=$newstring.'um';
$s_sg_m_2=$newstring.'s';
$s_sg_f_1=$newstring;
$s_sg_f_4=$newstring.'a';
$s_sg_f_3=$newstring.'ri';
$s_sg_f_2=$newstring.'rar';
$s_sg_n_1=$newstring.'t';
$s_sg_n_4=$newstring.'t';
$s_sg_n_3=$newstring.'u';
$s_sg_n_2=$newstring.'s';
// strong pluraL
$s_pl_m_1=$newstring.'ir';
$s_pl_m_4=$newstring.'a';
$s_pl_m_3=$newstring.'um';
$s_pl_m_2=$newstring.'ra';
$s_pl_f_1=$newstring.'ar';
$s_pl_f_4=$newstring.'ar';
$s_pl_f_3=$newstring.'um';
$s_pl_f_2=$newstring.'ra';
$s_pl_n_1=$newstring;
$s_pl_n_4=$newstring;
$s_pl_n_3=$newstring.'um';
$s_pl_n_2=$newstring.'ra';
// eak singular
$v_sg_m_1=$newstring.'i';
$v_sg_m_4=$newstring.'a';
$v_sg_m_3=$newstring.'a';
$v_sg_m_2=$newstring.'a';
$v_sg_f_1=$newstring.'a';
$v_sg_f_4=$newstring.'u';
$v_sg_f_3=$newstring.'u';
$v_sg_f_2=$newstring.'u';
$v_sg_n_1=$newstring.'a';
$v_sg_n_4=$newstring.'a';
$v_sg_n_3=$newstring.'a';
$v_sg_n_2=$newstring.'a';
// weak plural
$v_pl_m_1=$newstring.'u';
$v_pl_m_4=$newstring.'u';
$v_pl_m_3=$newstring.'u';
$v_pl_m_2=$newstring.'u';
$v_pl_f_1=$newstring.'u';
$v_pl_f_4=$newstring.'u';
$v_pl_f_3=$newstring.'u';
$v_pl_f_2=$newstring.'u';
$v_pl_n_1=$newstring.'u';
$v_pl_n_4=$newstring.'u';
$v_pl_n_3=$newstring.'u';
$v_pl_n_2=$newstring.'u';	
} 
//langur
if (($last_5=='angur') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -5);
//aðgerðarlaus
// strong singular		
$s_sg_m_1=$newstring.'angur';
$s_sg_m_4=$newstring.'angan';
$s_sg_m_3=$newstring.'öngum';
$s_sg_m_2=$newstring.'angs';
$s_sg_f_1=$newstring.'öng';
$s_sg_f_4=$newstring.'anga';
$s_sg_f_3=$newstring.'angri';
$s_sg_f_2=$newstring.'angrar';
$s_sg_n_1=$newstring.'angt';
$s_sg_n_4=$newstring.'angt';
$s_sg_n_3=$newstring.'öngu';
$s_sg_n_2=$newstring.'angs';
// strong pluraL
$s_pl_m_1=$newstring.'angir';
$s_pl_m_4=$newstring.'anga';
$s_pl_m_3=$newstring.'öngum';
$s_pl_m_2=$newstring.'angra';
$s_pl_f_1=$newstring.'angar';
$s_pl_f_4=$newstring.'angar';
$s_pl_f_3=$newstring.'öngum';
$s_pl_f_2=$newstring.'angra';
$s_pl_n_1=$newstring.'öng';
$s_pl_n_4=$newstring.'öng';
$s_pl_n_3=$newstring.'öngum';
$s_pl_n_2=$newstring.'angra';
// eak singular
$v_sg_m_1=$newstring.'angi';
$v_sg_m_4=$newstring.'anga';
$v_sg_m_3=$newstring.'anga';
$v_sg_m_2=$newstring.'anga';
$v_sg_f_1=$newstring.'anga';
$v_sg_f_4=$newstring.'öngu';
$v_sg_f_3=$newstring.'öngu';
$v_sg_f_2=$newstring.'öngu';
$v_sg_n_1=$newstring.'anga';
$v_sg_n_4=$newstring.'anga';
$v_sg_n_3=$newstring.'anga';
$v_sg_n_2=$newstring.'anga';
// weak plural
$v_pl_m_1=$newstring.'öngu';
$v_pl_m_4=$newstring.'öngu';
$v_pl_m_3=$newstring.'öngu';
$v_pl_m_2=$newstring.'öngu';
$v_pl_f_1=$newstring.'öngu';
$v_pl_f_4=$newstring.'öngu';
$v_pl_f_3=$newstring.'öngu';
$v_pl_f_2=$newstring.'öngu';
$v_pl_n_1=$newstring.'öngu';
$v_pl_n_4=$newstring.'öngu';
$v_pl_n_3=$newstring.'öngu';
$v_pl_n_2=$newstring.'öngu';	
}
//langur
if (($last_5=='arður') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -5);
// strong singular		
$s_sg_m_1=$newstring.'arður';
$s_sg_m_4=$newstring.'arðan';
$s_sg_m_3=$newstring.'örðum';
$s_sg_m_2=$newstring.'arðs';
$s_sg_f_1=$newstring.'örð';
$s_sg_f_4=$newstring.'arða';
$s_sg_f_3=$newstring.'arðri';
$s_sg_f_2=$newstring.'arðrar';
$s_sg_n_1=$newstring.'art';
$s_sg_n_4=$newstring.'art';
$s_sg_n_3=$newstring.'örðu';
$s_sg_n_2=$newstring.'arðs';
// strong pluraL
$s_pl_m_1=$newstring.'arðir';
$s_pl_m_4=$newstring.'arða';
$s_pl_m_3=$newstring.'örðum';
$s_pl_m_2=$newstring.'arðra';
$s_pl_f_1=$newstring.'arðar';
$s_pl_f_4=$newstring.'arðar';
$s_pl_f_3=$newstring.'örðum';
$s_pl_f_2=$newstring.'arðra';
$s_pl_n_1=$newstring.'örð';
$s_pl_n_4=$newstring.'örð';
$s_pl_n_3=$newstring.'örðum';
$s_pl_n_2=$newstring.'arðra';
// eak singular
$v_sg_m_1=$newstring.'arði';
$v_sg_m_4=$newstring.'arða';
$v_sg_m_3=$newstring.'arða';
$v_sg_m_2=$newstring.'arða';
$v_sg_f_1=$newstring.'arða';
$v_sg_f_4=$newstring.'örðu';
$v_sg_f_3=$newstring.'örðu';
$v_sg_f_2=$newstring.'örðu';
$v_sg_n_1=$newstring.'arða';
$v_sg_n_4=$newstring.'arða';
$v_sg_n_3=$newstring.'arða';
$v_sg_n_2=$newstring.'arða';
// weak plural
$v_pl_m_1=$newstring.'örðu';
$v_pl_m_4=$newstring.'örðu';
$v_pl_m_3=$newstring.'örðu';
$v_pl_m_2=$newstring.'örðu';
$v_pl_f_1=$newstring.'örðu';
$v_pl_f_4=$newstring.'örðu';
$v_pl_f_3=$newstring.'örðu';
$v_pl_f_2=$newstring.'örðu';
$v_pl_n_1=$newstring.'örðu';
$v_pl_n_4=$newstring.'örðu';
$v_pl_n_3=$newstring.'örðu';
$v_pl_n_2=$newstring.'örðu';	
}
if (($returned[8]=='indecl') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = $view_keyword;
//indecl
// strong singular		
$s_sg_m_1=$newstring;
$s_sg_m_4=$newstring;
$s_sg_m_3=$newstring;
$s_sg_m_2=$newstring;
$s_sg_f_1=$newstring;
$s_sg_f_4=$newstring;
$s_sg_f_3=$newstring;
$s_sg_f_2=$newstring;
$s_sg_n_1=$newstring;
$s_sg_n_4=$newstring;
$s_sg_n_3=$newstring;
$s_sg_n_2=$newstring;
// strong pluraL
$s_pl_m_1=$newstring;
$s_pl_m_4=$newstring;
$s_pl_m_3=$newstring;
$s_pl_m_2=$newstring;
$s_pl_f_1=$newstring;
$s_pl_f_4=$newstring;
$s_pl_f_3=$newstring;
$s_pl_f_2=$newstring;
$s_pl_n_1=$newstring;
$s_pl_n_4=$newstring;
$s_pl_n_3=$newstring;
$s_pl_n_2=$newstring;
// eak singular
$v_sg_m_1=$newstring;
$v_sg_m_4=$newstring;
$v_sg_m_3=$newstring;
$v_sg_m_2=$newstring;
$v_sg_f_1=$newstring;
$v_sg_f_4=$newstring;
$v_sg_f_3=$newstring;
$v_sg_f_2=$newstring;
$v_sg_n_1=$newstring;
$v_sg_n_4=$newstring;
$v_sg_n_3=$newstring;
$v_sg_n_2=$newstring;
// weak plural
$v_pl_m_1=$newstring;
$v_pl_m_4=$newstring;
$v_pl_m_3=$newstring;
$v_pl_m_2=$newstring;
$v_pl_f_1=$newstring;
$v_pl_f_4=$newstring;
$v_pl_f_3=$newstring;
$v_pl_f_2=$newstring;
$v_pl_n_1=$newstring;
$v_pl_n_4=$newstring;
$v_pl_n_3=$newstring;
$v_pl_n_2=$newstring;	
}
if (($_GET["generate"]=='no') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = $view_keyword;
//indecl
// strong singular		
$s_sg_m_1='';
$s_sg_m_4='';
$s_sg_m_3='';
$s_sg_m_2='';
$s_sg_f_1='';
$s_sg_f_4='';
$s_sg_f_3='';
$s_sg_f_2='';
$s_sg_n_1='';
$s_sg_n_4='';
$s_sg_n_3='';
$s_sg_n_2='';
// strong pluraL
$s_pl_m_1='';
$s_pl_m_4='';
$s_pl_m_3='';
$s_pl_m_2='';
$s_pl_f_1='';
$s_pl_f_4='';
$s_pl_f_3='';
$s_pl_f_2='';
$s_pl_n_1='';
$s_pl_n_4='';
$s_pl_n_3='';
$s_pl_n_2='';
// eak singular
$v_sg_m_1='';
$v_sg_m_4='';
$v_sg_m_3='';
$v_sg_m_2='';
$v_sg_f_1='';
$v_sg_f_4='';
$v_sg_f_3='';
$v_sg_f_2='';
$v_sg_n_1='';
$v_sg_n_4='';
$v_sg_n_3='';
$v_sg_n_2='';
// weak plural
$v_pl_m_1='';
$v_pl_m_4='';
$v_pl_m_3='';
$v_pl_m_2='';
$v_pl_f_1='';
$v_pl_f_4='';
$v_pl_f_3='';
$v_pl_f_2='';
$v_pl_n_1='';
$v_pl_n_4='';
$v_pl_n_3='';
$v_pl_n_2='';	
}
if (($last_3=='inn') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -3);
// kominn
// strong singular		
$s_sg_m_1=$newstring.'inn';
$s_sg_m_4=$newstring.'inn';
$s_sg_m_3=$newstring.'num';
$s_sg_m_2=$newstring.'ins';
$s_sg_f_1=$newstring.'in';
$s_sg_f_4=$newstring.'na';
$s_sg_f_3=$newstring.'inni';
$s_sg_f_2=$newstring.'innar';
$s_sg_n_1=$newstring.'ið';
$s_sg_n_4=$newstring.'ið';
$s_sg_n_3=$newstring.'nu';
$s_sg_n_2=$newstring.'ins';
// strong pluraL
$s_pl_m_1=$newstring.'nir';
$s_pl_m_4=$newstring.'na';
$s_pl_m_3=$newstring.'num';
$s_pl_m_2=$newstring.'inna';
$s_pl_f_1=$newstring.'nar';
$s_pl_f_4=$newstring.'nar';
$s_pl_f_3=$newstring.'num';
$s_pl_f_2=$newstring.'inna';
$s_pl_n_1=$newstring.'in';
$s_pl_n_4=$newstring.'in';
$s_pl_n_3=$newstring.'num';
$s_pl_n_2=$newstring.'inna';
// eak singular
$v_sg_m_1=$newstring.'ni';
$v_sg_m_4=$newstring.'na';
$v_sg_m_3=$newstring.'na';
$v_sg_m_2=$newstring.'na';
$v_sg_f_1=$newstring.'na';
$v_sg_f_4=$newstring.'nu';
$v_sg_f_3=$newstring.'nu';
$v_sg_f_2=$newstring.'nu';
$v_sg_n_1=$newstring.'na';
$v_sg_n_4=$newstring.'na';
$v_sg_n_3=$newstring.'na';
$v_sg_n_2=$newstring.'na';
// weak plural
$v_pl_m_1=$newstring.'nu';
$v_pl_m_4=$newstring.'nu';
$v_pl_m_3=$newstring.'nu';
$v_pl_m_2=$newstring.'nu';
$v_pl_f_1=$newstring.'nu';
$v_pl_f_4=$newstring.'nu';
$v_pl_f_3=$newstring.'nu';
$v_pl_f_2=$newstring.'nu';
$v_pl_n_1=$newstring.'nu';
$v_pl_n_4=$newstring.'nu';
$v_pl_n_3=$newstring.'nu';
$v_pl_n_2=$newstring.'nu';
}
if (($returned[8]=='(-ber, -bar, -bárum, -borið)') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -4);
$newstring=$newstring.'bor';
// kominn
// strong singular		
$s_sg_m_1=$newstring.'inn';
$s_sg_m_4=$newstring.'inn';
$s_sg_m_3=$newstring.'num';
$s_sg_m_2=$newstring.'ins';
$s_sg_f_1=$newstring.'in';
$s_sg_f_4=$newstring.'na';
$s_sg_f_3=$newstring.'inni';
$s_sg_f_2=$newstring.'innar';
$s_sg_n_1=$newstring.'ið';
$s_sg_n_4=$newstring.'ið';
$s_sg_n_3=$newstring.'nu';
$s_sg_n_2=$newstring.'ins';
// strong pluraL
$s_pl_m_1=$newstring.'nir';
$s_pl_m_4=$newstring.'na';
$s_pl_m_3=$newstring.'num';
$s_pl_m_2=$newstring.'inna';
$s_pl_f_1=$newstring.'nar';
$s_pl_f_4=$newstring.'nar';
$s_pl_f_3=$newstring.'num';
$s_pl_f_2=$newstring.'inna';
$s_pl_n_1=$newstring.'in';
$s_pl_n_4=$newstring.'in';
$s_pl_n_3=$newstring.'num';
$s_pl_n_2=$newstring.'inna';
// eak singular
$v_sg_m_1=$newstring.'ni';
$v_sg_m_4=$newstring.'na';
$v_sg_m_3=$newstring.'na';
$v_sg_m_2=$newstring.'na';
$v_sg_f_1=$newstring.'na';
$v_sg_f_4=$newstring.'nu';
$v_sg_f_3=$newstring.'nu';
$v_sg_f_2=$newstring.'nu';
$v_sg_n_1=$newstring.'na';
$v_sg_n_4=$newstring.'na';
$v_sg_n_3=$newstring.'na';
$v_sg_n_2=$newstring.'na';
// weak plural
$v_pl_m_1=$newstring.'nu';
$v_pl_m_4=$newstring.'nu';
$v_pl_m_3=$newstring.'nu';
$v_pl_m_2=$newstring.'nu';
$v_pl_f_1=$newstring.'nu';
$v_pl_f_4=$newstring.'nu';
$v_pl_f_3=$newstring.'nu';
$v_pl_f_2=$newstring.'nu';
$v_pl_n_1=$newstring.'nu';
$v_pl_n_4=$newstring.'nu';
$v_pl_n_3=$newstring.'nu';
$v_pl_n_2=$newstring.'nu';
}
// (-ddi, -tt)
if (($returned[8]=='(-ddi, -tt)') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -2);
// strong singular		
$s_sg_m_1=$newstring.'ddur';
$s_sg_m_4=$newstring.'ddan';
$s_sg_m_3=$newstring.'ddum';
$s_sg_m_2=$newstring.'dds';
$s_sg_f_1=$newstring.'dd';
$s_sg_f_4=$newstring.'dda';
$s_sg_f_3=$newstring.'ddri';
$s_sg_f_2=$newstring.'ddrar';
$s_sg_n_1=$newstring.'tt';
$s_sg_n_4=$newstring.'tt';
$s_sg_n_3=$newstring.'ddu';
$s_sg_n_2=$newstring.'dds';
// strong pluraL
$s_pl_m_1=$newstring.'ddir';
$s_pl_m_4=$newstring.'dda';
$s_pl_m_3=$newstring.'ddum';
$s_pl_m_2=$newstring.'ddra';
$s_pl_f_1=$newstring.'ddar';
$s_pl_f_4=$newstring.'ddar';
$s_pl_f_3=$newstring.'ddum';
$s_pl_f_2=$newstring.'ddra';
$s_pl_n_1=$newstring.'dd';
$s_pl_n_4=$newstring.'dd';
$s_pl_n_3=$newstring.'ddum';
$s_pl_n_2=$newstring.'ddra';
// eak singular
$v_sg_m_1=$newstring.'ddi';
$v_sg_m_4=$newstring.'dda';
$v_sg_m_3=$newstring.'dda';
$v_sg_m_2=$newstring.'dda';
$v_sg_f_1=$newstring.'dda';
$v_sg_f_4=$newstring.'ddu';
$v_sg_f_3=$newstring.'ddu';
$v_sg_f_2=$newstring.'ddu';
$v_sg_n_1=$newstring.'dda';
$v_sg_n_4=$newstring.'dda';
$v_sg_n_3=$newstring.'dda';
$v_sg_n_2=$newstring.'dda';
// weak plural
$v_pl_m_1=$newstring.'ddu';
$v_pl_m_4=$newstring.'ddu';
$v_pl_m_3=$newstring.'ddu';
$v_pl_m_2=$newstring.'ddu';
$v_pl_f_1=$newstring.'ddu';
$v_pl_f_4=$newstring.'ddu';
$v_pl_f_3=$newstring.'ddu';
$v_pl_f_2=$newstring.'ddu';
$v_pl_n_1=$newstring.'ddu';
$v_pl_n_4=$newstring.'ddu';
$v_pl_n_3=$newstring.'ddu';
$v_pl_n_2=$newstring.'ddu';
}
// (-ddi, -tt)
if (($returned[8]=='(-di, -t)') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -1);
// strong singular		
$s_sg_m_1=$newstring.'dur';
$s_sg_m_4=$newstring.'dan';
$s_sg_m_3=$newstring.'dum';
$s_sg_m_2=$newstring.'ds';
$s_sg_f_1=$newstring.'d';
$s_sg_f_4=$newstring.'da';
$s_sg_f_3=$newstring.'dri';
$s_sg_f_2=$newstring.'drar';
$s_sg_n_1=$newstring.'t';
$s_sg_n_4=$newstring.'t';
$s_sg_n_3=$newstring.'du';
$s_sg_n_2=$newstring.'ds';
// strong pluraL
$s_pl_m_1=$newstring.'dir';
$s_pl_m_4=$newstring.'da';
$s_pl_m_3=$newstring.'dum';
$s_pl_m_2=$newstring.'dra';
$s_pl_f_1=$newstring.'dar';
$s_pl_f_4=$newstring.'dar';
$s_pl_f_3=$newstring.'dum';
$s_pl_f_2=$newstring.'dra';
$s_pl_n_1=$newstring.'d';
$s_pl_n_4=$newstring.'d';
$s_pl_n_3=$newstring.'dum';
$s_pl_n_2=$newstring.'dra';
// eak singular
$v_sg_m_1=$newstring.'di';
$v_sg_m_4=$newstring.'da';
$v_sg_m_3=$newstring.'da';
$v_sg_m_2=$newstring.'da';
$v_sg_f_1=$newstring.'da';
$v_sg_f_4=$newstring.'du';
$v_sg_f_3=$newstring.'du';
$v_sg_f_2=$newstring.'du';
$v_sg_n_1=$newstring.'da';
$v_sg_n_4=$newstring.'da';
$v_sg_n_3=$newstring.'da';
$v_sg_n_2=$newstring.'da';
// weak plural
$v_pl_m_1=$newstring.'du';
$v_pl_m_4=$newstring.'du';
$v_pl_m_3=$newstring.'du';
$v_pl_m_2=$newstring.'du';
$v_pl_f_1=$newstring.'du';
$v_pl_f_4=$newstring.'du';
$v_pl_f_3=$newstring.'du';
$v_pl_f_2=$newstring.'du';
$v_pl_n_1=$newstring.'du';
$v_pl_n_4=$newstring.'du';
$v_pl_n_3=$newstring.'du';
$v_pl_n_2=$newstring.'du';
}
// (-ddi, -tt)
if (($returned[8]=='(-ti, -t)') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -1);
// strong singular		
$s_sg_m_1=$newstring.'tur';
$s_sg_m_4=$newstring.'tan';
$s_sg_m_3=$newstring.'tum';
$s_sg_m_2=$newstring.'ts';
$s_sg_f_1=$newstring.'t';
$s_sg_f_4=$newstring.'ta';
$s_sg_f_3=$newstring.'tri';
$s_sg_f_2=$newstring.'trar';
$s_sg_n_1=$newstring.'t';
$s_sg_n_4=$newstring.'t';
$s_sg_n_3=$newstring.'tu';
$s_sg_n_2=$newstring.'ts';
// strong pluraL
$s_pl_m_1=$newstring.'tir';
$s_pl_m_4=$newstring.'ta';
$s_pl_m_3=$newstring.'tum';
$s_pl_m_2=$newstring.'tra';
$s_pl_f_1=$newstring.'tar';
$s_pl_f_4=$newstring.'tar';
$s_pl_f_3=$newstring.'tum';
$s_pl_f_2=$newstring.'tra';
$s_pl_n_1=$newstring.'t';
$s_pl_n_4=$newstring.'t';
$s_pl_n_3=$newstring.'tum';
$s_pl_n_2=$newstring.'tra';
// eak singular
$v_sg_m_1=$newstring.'ti';
$v_sg_m_4=$newstring.'ta';
$v_sg_m_3=$newstring.'ta';
$v_sg_m_2=$newstring.'ta';
$v_sg_f_1=$newstring.'ta';
$v_sg_f_4=$newstring.'tu';
$v_sg_f_3=$newstring.'tu';
$v_sg_f_2=$newstring.'tu';
$v_sg_n_1=$newstring.'ta';
$v_sg_n_4=$newstring.'ta';
$v_sg_n_3=$newstring.'ta';
$v_sg_n_2=$newstring.'ta';
// weak plural
$v_pl_m_1=$newstring.'tu';
$v_pl_m_4=$newstring.'tu';
$v_pl_m_3=$newstring.'tu';
$v_pl_m_2=$newstring.'tu';
$v_pl_f_1=$newstring.'tu';
$v_pl_f_4=$newstring.'tu';
$v_pl_f_3=$newstring.'tu';
$v_pl_f_2=$newstring.'tu';
$v_pl_n_1=$newstring.'tu';
$v_pl_n_4=$newstring.'tu';
$v_pl_n_3=$newstring.'tu';
$v_pl_n_2=$newstring.'tu';
}
// lítill
if (($last_6=='lítill') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -6);
// strong singular		
$s_sg_m_1=$newstring.'lítill';
$s_sg_m_4=$newstring.'lítinn';
$s_sg_m_3=$newstring.'litlum';
$s_sg_m_2=$newstring.'lítils';
$s_sg_f_1=$newstring.'lítil';
$s_sg_f_4=$newstring.'litla';
$s_sg_f_3=$newstring.'lítilli';
$s_sg_f_2=$newstring.'lítillar';
$s_sg_n_1=$newstring.'lítið';
$s_sg_n_4=$newstring.'lítið';
$s_sg_n_3=$newstring.'litlu';
$s_sg_n_2=$newstring.'lítils';
// strong pluraL
$s_pl_m_1=$newstring.'litlir';
$s_pl_m_4=$newstring.'litla';
$s_pl_m_3=$newstring.'litlum';
$s_pl_m_2=$newstring.'lítilla';
$s_pl_f_1=$newstring.'litlar';
$s_pl_f_4=$newstring.'litlar';
$s_pl_f_3=$newstring.'litlum';
$s_pl_f_2=$newstring.'lítilla';
$s_pl_n_1=$newstring.'lítil';
$s_pl_n_4=$newstring.'lítil';
$s_pl_n_3=$newstring.'litlum';
$s_pl_n_2=$newstring.'lítilla';
// eak singular
$v_sg_m_1=$newstring.'litli';
$v_sg_m_4=$newstring.'litla';
$v_sg_m_3=$newstring.'litla';
$v_sg_m_2=$newstring.'litla';
$v_sg_f_1=$newstring.'litla';
$v_sg_f_4=$newstring.'litlu';
$v_sg_f_3=$newstring.'litlu';
$v_sg_f_2=$newstring.'litlu';
$v_sg_n_1=$newstring.'litla';
$v_sg_n_4=$newstring.'litla';
$v_sg_n_3=$newstring.'litla';
$v_sg_n_2=$newstring.'litla';
// weak plural
$v_pl_m_1=$newstring.'litlu';
$v_pl_m_4=$newstring.'litlu';
$v_pl_m_3=$newstring.'litlu';
$v_pl_m_2=$newstring.'litlu';
$v_pl_f_1=$newstring.'litlu';
$v_pl_f_4=$newstring.'litlu';
$v_pl_f_3=$newstring.'litlu';
$v_pl_f_2=$newstring.'litlu';
$v_pl_n_1=$newstring.'litlu';
$v_pl_n_4=$newstring.'litlu';
$v_pl_n_3=$newstring.'litlu';
$v_pl_n_2=$newstring.'litlu';}
// mikill
if (($last_6=='mikill') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -6);
// strong singular		
$s_sg_m_1=$newstring.'mikill';
$s_sg_m_4=$newstring.'mikinn';
$s_sg_m_3=$newstring.'miklum';
$s_sg_m_2=$newstring.'mikils';
$s_sg_f_1=$newstring.'mikil';
$s_sg_f_4=$newstring.'mikla';
$s_sg_f_3=$newstring.'mikilli';
$s_sg_f_2=$newstring.'mikillar';
$s_sg_n_1=$newstring.'mikið';
$s_sg_n_4=$newstring.'mikið';
$s_sg_n_3=$newstring.'miklu';
$s_sg_n_2=$newstring.'mikils';
// strong pluraL
$s_pl_m_1=$newstring.'miklir';
$s_pl_m_4=$newstring.'mikla';
$s_pl_m_3=$newstring.'miklum';
$s_pl_m_2=$newstring.'mikilla';
$s_pl_f_1=$newstring.'miklar';
$s_pl_f_4=$newstring.'miklar';
$s_pl_f_3=$newstring.'miklum';
$s_pl_f_2=$newstring.'mikilla';
$s_pl_n_1=$newstring.'mikil';
$s_pl_n_4=$newstring.'mikil';
$s_pl_n_3=$newstring.'miklum';
$s_pl_n_2=$newstring.'mikilla';
// eak singular
$v_sg_m_1=$newstring.'mikli';
$v_sg_m_4=$newstring.'mikla';
$v_sg_m_3=$newstring.'mikla';
$v_sg_m_2=$newstring.'mikla';
$v_sg_f_1=$newstring.'mikla';
$v_sg_f_4=$newstring.'miklu';
$v_sg_f_3=$newstring.'miklu';
$v_sg_f_2=$newstring.'miklu';
$v_sg_n_1=$newstring.'mikla';
$v_sg_n_4=$newstring.'mikla';
$v_sg_n_3=$newstring.'mikla';
$v_sg_n_2=$newstring.'mikla';
// weak plural
$v_pl_m_1=$newstring.'miklu';
$v_pl_m_4=$newstring.'miklu';
$v_pl_m_3=$newstring.'miklu';
$v_pl_m_2=$newstring.'miklu';
$v_pl_f_1=$newstring.'miklu';
$v_pl_f_4=$newstring.'miklu';
$v_pl_f_3=$newstring.'miklu';
$v_pl_f_2=$newstring.'miklu';
$v_pl_n_1=$newstring.'miklu';
$v_pl_n_4=$newstring.'miklu';
$v_pl_n_3=$newstring.'miklu';
$v_pl_n_2=$newstring.'miklu';}
// -samur
if (($last_5=='samur') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -5);
// strong singular		
$s_sg_m_1=$newstring.'samur';
$s_sg_m_4=$newstring.'saman';
$s_sg_m_3=$newstring.'sömum';
$s_sg_m_2=$newstring.'sams';
$s_sg_f_1=$newstring.'söm';
$s_sg_f_4=$newstring.'sama';
$s_sg_f_3=$newstring.'samri';
$s_sg_f_2=$newstring.'samrar';
$s_sg_n_1=$newstring.'samt';
$s_sg_n_4=$newstring.'samt';
$s_sg_n_3=$newstring.'sömu';
$s_sg_n_2=$newstring.'sams';
// strong pluraL
$s_pl_m_1=$newstring.'samir';
$s_pl_m_4=$newstring.'sama';
$s_pl_m_3=$newstring.'sömum';
$s_pl_m_2=$newstring.'samra';
$s_pl_f_1=$newstring.'samar';
$s_pl_f_4=$newstring.'samar';
$s_pl_f_3=$newstring.'sömum';
$s_pl_f_2=$newstring.'samra';
$s_pl_n_1=$newstring.'söm';
$s_pl_n_4=$newstring.'söm';
$s_pl_n_3=$newstring.'sömum';
$s_pl_n_2=$newstring.'samra';
// eak singular
$v_sg_m_1=$newstring.'sami';
$v_sg_m_4=$newstring.'sama';
$v_sg_m_3=$newstring.'sama';
$v_sg_m_2=$newstring.'sama';
$v_sg_f_1=$newstring.'sama';
$v_sg_f_4=$newstring.'sömu';
$v_sg_f_3=$newstring.'sömu';
$v_sg_f_2=$newstring.'sömu';
$v_sg_n_1=$newstring.'sama';
$v_sg_n_4=$newstring.'sama';
$v_sg_n_3=$newstring.'sama';
$v_sg_n_2=$newstring.'sama';
// weak plural
$v_pl_m_1=$newstring.'sömu';
$v_pl_m_4=$newstring.'sömu';
$v_pl_m_3=$newstring.'sömu';
$v_pl_m_2=$newstring.'sömu';
$v_pl_f_1=$newstring.'sömu';
$v_pl_f_4=$newstring.'sömu';
$v_pl_f_3=$newstring.'sömu';
$v_pl_f_2=$newstring.'sömu';
$v_pl_n_1=$newstring.'sömu';
$v_pl_n_4=$newstring.'sömu';
$v_pl_n_3=$newstring.'sömu';
$v_pl_n_2=$newstring.'sömu';}
// -aður
if ((($returned[8]=='(-aði)') OR ($returned[8]=='(-aðist)')) AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
if ($returned[8]=='(-aðist)') {
$newstring = mb_substr($view_keyword, 0, -3);	
} else {
$newstring = mb_substr($view_keyword, 0, -1);
}
// strong singular		
$s_sg_m_1=$newstring.'aður';
$s_sg_m_4=$newstring.'aðan';
if (($char[$num-5]=='a') AND ($char[$num-5].$char[$num-4]!='au') AND ($num>4)) {
$helpstring = mb_substr($view_keyword, 0, -5);	
$s_sg_m_3=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðum';
} else if ($char[$num-3]=='a') {
$helpstring = mb_substr($view_keyword, 0, -3);	
$s_sg_m_3=$helpstring.'ö'.$char[$num-2].'uðum';
} else if (($char[$num-4]=='a') AND ($char[$num-4].$char[$num-3]!='au')) {
$helpstring = mb_substr($view_keyword, 0, -4);	
$s_sg_m_3=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðum';
} else {
$s_sg_m_3=$newstring.'uðum';	}
$s_sg_m_2=$newstring.'aðs';
if (($char[$num-5]=='a') AND ($char[$num-5].$char[$num-4]!='au') AND ($num>4)) {
$helpstring = mb_substr($view_keyword, 0, -5);	
$s_sg_f_1=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uð';
} else if ($char[$num-3]=='a') {
$helpstring = mb_substr($view_keyword, 0, -3);	
$s_sg_f_1=$helpstring.'ö'.$char[$num-2].'uð';
} else if (($char[$num-4]=='a') AND ($char[$num-4].$char[$num-3]!='au')) {
$helpstring = mb_substr($view_keyword, 0, -4);	
$s_sg_f_1=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uð';
} else {
$s_sg_f_1=$newstring.'uð';	}
$s_sg_f_4=$newstring.'aða';
$s_sg_f_3=$newstring.'aðri';
$s_sg_f_2=$newstring.'aðrar';
$s_sg_n_1=$newstring.'að';
$s_sg_n_4=$newstring.'að';
if (($char[$num-5]=='a') AND ($char[$num-5].$char[$num-4]!='au') AND ($num>4)) {
$helpstring = mb_substr($view_keyword, 0, -5);	
$s_sg_n_3=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðu';
} else if ($char[$num-3]=='a') {
$helpstring = mb_substr($view_keyword, 0, -3);	
$s_sg_n_3=$helpstring.'ö'.$char[$num-2].'uðu';
} else if (($char[$num-4]=='a') AND ($char[$num-4].$char[$num-3]!='au')) {
$helpstring = mb_substr($view_keyword, 0, -4);	
$s_sg_n_3=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðu';
} else {
$s_sg_n_3=$newstring.'uðu';	}
$s_sg_n_2=$newstring.'aðs';
// strong pluraL
$s_pl_m_1=$newstring.'aðir';
$s_pl_m_4=$newstring.'aða';
if (($char[$num-5]=='a') AND ($char[$num-5].$char[$num-4]!='au') AND ($num>4)) {
$helpstring = mb_substr($view_keyword, 0, -5);	
$s_pl_m_3=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðum';
} else if ($char[$num-3]=='a') {
$helpstring = mb_substr($view_keyword, 0, -3);	
$s_pl_m_3=$helpstring.'ö'.$char[$num-2].'uðum';
} else if (($char[$num-4]=='a') AND ($char[$num-4].$char[$num-3]!='au')) {
$helpstring = mb_substr($view_keyword, 0, -4);	
$s_pl_m_3=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðum';
} else {
$s_pl_m_3=$newstring.'uðum';	}
$s_pl_m_2=$newstring.'aðra';
$s_pl_f_1=$newstring.'aðar';
$s_pl_f_4=$newstring.'aðar';
if (($char[$num-5]=='a') AND ($char[$num-5].$char[$num-4]!='au') AND ($num>4)) {
$helpstring = mb_substr($view_keyword, 0, -5);	
$s_pl_f_3=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðum';
} else if ($char[$num-3]=='a') {
$helpstring = mb_substr($view_keyword, 0, -3);	
$s_pl_f_3=$helpstring.'ö'.$char[$num-2].'uðum';
} else if (($char[$num-4]=='a') AND ($char[$num-4].$char[$num-3]!='au')) {
$helpstring = mb_substr($view_keyword, 0, -4);	
$s_pl_f_3=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðum';
} else {
$s_pl_f_3=$newstring.'uðum';	}
$s_pl_f_2=$newstring.'aðra';
if (($char[$num-5]=='a') AND ($char[$num-5].$char[$num-4]!='au') AND ($num>4)) {
$helpstring = mb_substr($view_keyword, 0, -5);	
$s_pl_n_1=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uð';
$s_pl_n_4=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uð';
$s_pl_n_3=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðum';
} else if ($char[$num-3]=='a') {
$helpstring = mb_substr($view_keyword, 0, -3);	
$s_pl_n_1=$helpstring.'ö'.$char[$num-2].'uð';
$s_pl_n_4=$helpstring.'ö'.$char[$num-2].'uð';
$s_pl_n_3=$helpstring.'ö'.$char[$num-2].'uðum';
} else if (($char[$num-4]=='a') AND ($char[$num-4].$char[$num-3]!='au')) {
$helpstring = mb_substr($view_keyword, 0, -4);	
$s_pl_n_1=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uð';
$s_pl_n_4=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uð';
$s_pl_n_3=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðum';
} else {
$s_pl_n_1=$newstring.'uð';
$s_pl_n_4=$newstring.'uð';
$s_pl_n_3=$newstring.'uðum';	}
$s_pl_n_2=$newstring.'aðra';
// eak singular
$v_sg_m_1=$newstring.'aði';
$v_sg_m_4=$newstring.'aða';
$v_sg_m_3=$newstring.'aða';
$v_sg_m_2=$newstring.'aða';
$v_sg_f_1=$newstring.'aða';
if (($char[$num-5]=='a') AND ($char[$num-5].$char[$num-4]!='au') AND ($num>4)) {
$helpstring = mb_substr($view_keyword, 0, -5);	
$v_sg_f_4=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðu';
$v_sg_f_3=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðu';
$v_sg_f_2=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðu';
} else if ($char[$num-3]=='a') {
$helpstring = mb_substr($view_keyword, 0, -3);	
$v_sg_f_4=$helpstring.'ö'.$char[$num-2].'uðu';
$v_sg_f_3=$helpstring.'ö'.$char[$num-2].'uðu';
$v_sg_f_2=$helpstring.'ö'.$char[$num-2].'uðu';
} else if (($char[$num-4]=='a') AND ($char[$num-4].$char[$num-3]!='au')) {
$helpstring = mb_substr($view_keyword, 0, -4);	
$v_sg_f_4=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðu';
$v_sg_f_3=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðu';
$v_sg_f_2=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðu';} else {
$v_sg_f_4=$newstring.'uðu';
$v_sg_f_3=$newstring.'uðu';
$v_sg_f_2=$newstring.'uðu';	}
$v_sg_n_1=$newstring.'aða';
$v_sg_n_4=$newstring.'aða';
$v_sg_n_3=$newstring.'aða';
$v_sg_n_2=$newstring.'aða';
// weak plural
if (($char[$num-5]=='a') AND ($char[$num-5].$char[$num-4]!='au') AND ($num>4)) {
$helpstring = mb_substr($view_keyword, 0, -5);	
$v_pl_m_1=$helpstring.'ö'.$char[$num-4].$char[$num-3].$char[$num-2].'uðu';
} else if ($char[$num-3]=='a') {
$helpstring = mb_substr($view_keyword, 0, -3);	
$v_pl_m_1=$helpstring.'ö'.$char[$num-2].'uðu';
} else if (($char[$num-4]=='a') AND ($char[$num-4].$char[$num-3]!='au')) {
$helpstring = mb_substr($view_keyword, 0, -4);	
$v_pl_m_1=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðu';
} else {
$v_pl_m_1=$newstring.'uðu';	}$v_pl_m_1=$v_pl_m_1;
$v_pl_m_4=$v_pl_m_1;
$v_pl_m_3=$v_pl_m_1;
$v_pl_m_2=$v_pl_m_1;
$v_pl_f_1=$v_pl_m_1;
$v_pl_f_4=$v_pl_m_1;
$v_pl_f_3=$v_pl_m_1;
$v_pl_f_2=$v_pl_m_1;
$v_pl_n_1=$v_pl_m_1;
$v_pl_n_4=$v_pl_m_1;
$v_pl_n_3=$v_pl_m_1;
$v_pl_n_2=$v_pl_m_1;}
if ($found_pattern===FALSE) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -2);
//glæsilegur
// strong singular		
$s_sg_m_1=$newstring.'ur';
$s_sg_m_4=$newstring.'an';
$s_sg_m_3=$newstring.'um';
$s_sg_m_2=$newstring.'s';
$s_sg_f_1=$newstring;
$s_sg_f_4=$newstring.'a';
$s_sg_f_3=$newstring.'ri';
$s_sg_f_2=$newstring.'rar';
if ($char3=='t') { 
$s_sg_n_1=$newstring;
$s_sg_n_4=$newstring;}else if (($last_3=='ður') OR ($last_3=='dur')) {
$help_string = mb_substr($view_keyword, 0, -3);
$s_sg_n_1=$help_string.'t';
$s_sg_n_4=$help_string.'t'; } else if ($char3.$char4=='dd') {
$help_string = mb_substr($view_keyword, 0, -4);
$s_sg_n_1=$help_string.'tt';
$s_sg_n_4=$help_string.'tt'; 
} else
{
$s_sg_n_1=$newstring.'t';
$s_sg_n_4=$newstring.'t'; }$s_sg_n_3=$newstring.'u';
$s_sg_n_2=$newstring.'s';
// strong pluraL
$s_pl_m_1=$newstring.'ir';
$s_pl_m_4=$newstring.'a';
$s_pl_m_3=$newstring.'um';
$s_pl_m_2=$newstring.'ra';
$s_pl_f_1=$newstring.'ar';
$s_pl_f_4=$newstring.'ar';
$s_pl_f_3=$newstring.'um';
$s_pl_f_2=$newstring.'ra';
$s_pl_n_1=$newstring;
$s_pl_n_4=$newstring;
$s_pl_n_3=$newstring.'um';
$s_pl_n_2=$newstring.'ra';
// eak singular
$v_sg_m_1=$newstring.'i';
$v_sg_m_4=$newstring.'a';
$v_sg_m_3=$newstring.'a';
$v_sg_m_2=$newstring.'a';
$v_sg_f_1=$newstring.'a';
$v_sg_f_4=$newstring.'u';
$v_sg_f_3=$newstring.'u';
$v_sg_f_2=$newstring.'u';
$v_sg_n_1=$newstring.'a';
$v_sg_n_4=$newstring.'a';
$v_sg_n_3=$newstring.'a';
$v_sg_n_2=$newstring.'a';
// weak plural
$v_pl_m_1=$newstring.'u';
$v_pl_m_4=$newstring.'u';
$v_pl_m_3=$newstring.'u';
$v_pl_m_2=$newstring.'u';
$v_pl_f_1=$newstring.'u';
$v_pl_f_4=$newstring.'u';
$v_pl_f_3=$newstring.'u';
$v_pl_f_2=$newstring.'u';
$v_pl_n_1=$newstring.'u';
$v_pl_n_4=$newstring.'u';
$v_pl_n_3=$newstring.'u';
$v_pl_n_2=$newstring.'u';} 
$table2 = 'ds_dec_v_4';$sql2 = sprintf ('INSERT INTO `%s` (`id`, `keyword`, `num_keyword`, `s_sg_m_1`, `s_sg_m_4`, `s_sg_m_3`, `s_sg_m_2`, `s_sg_f_1`, `s_sg_f_4`, `s_sg_f_3`, `s_sg_f_2`, `s_sg_n_1`, `s_sg_n_4`, `s_sg_n_3`, `s_sg_n_2`, `s_pl_m_1`, `s_pl_m_4`, `s_pl_m_3`, `s_pl_m_2`, `s_pl_f_1`, `s_pl_f_4`, `s_pl_f_3`, `s_pl_f_2`, `s_pl_n_1`, `s_pl_n_4`, `s_pl_n_3`, `s_pl_n_2`, `v_sg_m_1`, `v_sg_m_4`, `v_sg_m_3`, `v_sg_m_2`, `v_sg_f_1`, `v_sg_f_4`, `v_sg_f_3`, `v_sg_f_2`, `v_sg_n_1`, `v_sg_n_4`, `v_sg_n_3`, `v_sg_n_2`, `v_pl_m_1`, `v_pl_m_4`, `v_pl_m_3`, `v_pl_m_2`, `v_pl_f_1`, `v_pl_f_4`, `v_pl_f_3`, `v_pl_f_2`, `v_pl_n_1`, `v_pl_n_4`, `v_pl_n_3`, `v_pl_n_2`) VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)',
	$table2,					
	quate_smart($view_keyword),
	quate_smart($view_num_keyword),
	quate_smart($s_sg_m_1),
	quate_smart($s_sg_m_4),
	quate_smart($s_sg_m_3),
	quate_smart($s_sg_m_2),
	quate_smart($s_sg_f_1),
	quate_smart($s_sg_f_4),
	quate_smart($s_sg_f_3),
	quate_smart($s_sg_f_2),
	quate_smart($s_sg_n_1),
	quate_smart($s_sg_n_4),
	quate_smart($s_sg_n_3),
	quate_smart($s_sg_n_2),
	quate_smart($s_pl_m_1),
	quate_smart($s_pl_m_4),
	quate_smart($s_pl_m_3),
	quate_smart($s_pl_m_2),
	quate_smart($s_pl_f_1),
	quate_smart($s_pl_f_4),
	quate_smart($s_pl_f_3),
	quate_smart($s_pl_f_2),
	quate_smart($s_pl_n_1),
	quate_smart($s_pl_n_4),
	quate_smart($s_pl_n_3),
	quate_smart($s_pl_n_2),
	quate_smart($v_sg_m_1),
	quate_smart($v_sg_m_4),
	quate_smart($v_sg_m_3),
	quate_smart($v_sg_m_2),
	quate_smart($v_sg_f_1),
	quate_smart($v_sg_f_4),
	quate_smart($v_sg_f_3),
	quate_smart($v_sg_f_2),
	quate_smart($v_sg_n_1),
	quate_smart($v_sg_n_4),
	quate_smart($v_sg_n_3),
	quate_smart($v_sg_n_2),
	quate_smart($v_pl_m_1),
	quate_smart($v_pl_m_4),
	quate_smart($v_pl_m_3),
	quate_smart($v_pl_m_2),
	quate_smart($v_pl_f_1),
	quate_smart($v_pl_f_4),
	quate_smart($v_pl_f_3),
	quate_smart($v_pl_f_2),
	quate_smart($v_pl_n_1),
	quate_smart($v_pl_n_4),
	quate_smart($v_pl_n_3),
	quate_smart($v_pl_n_2));$oop2->Setnames();
$oop2->query($sql2);$oop2->freeResult();
}
}
?>
