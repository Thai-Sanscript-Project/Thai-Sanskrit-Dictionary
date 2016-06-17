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
if ($action_scripts=='adj_info_update' ) {
$table_info = 'ds_dec_adj_info';
$table_1 = 'ds_dec_adj_1';
$table_2 = 'ds_dec_adj_2';
$table_3 = 'ds_dec_adj_3';
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
// check if stig 1 exist
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
$status_stig_1=$result[0];
if ($status_stig_1==2) {$first=TRUE;}
$oop->freeResult();
} else {$first=TRUE;}
// check if stig 2 exist
if ($row_prep[6]!=0) {
$sql = sprintf ('SELECT `status` FROM `%s` WHERE `keyword` COLLATE `%s` = %s  AND `num_keyword`=%s' ,
	$table_2,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop->Setnames();							
$oop->query($sql);
$result= $oop->FetchArray();
$num1 = $oop->getNumRows();
$status_stig_2=$result[0];
if ($status_stig_2==2) {$second=TRUE;}
$oop->freeResult();
} else {$second=TRUE;}
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
$status_stig_3=$result[0];
if ($status_stig_3==2) {$third=TRUE;}
$oop->freeResult();
} else {$third=TRUE;}
$sql = sprintf ('UPDATE `%s` SET `status_stig_1` = %s, `status_stig_2` = %s, `status_stig_3` = %s WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$table_info,					
	quate_smart($status_stig_1),
	quate_smart($status_stig_2),
	quate_smart($status_stig_3),
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword)); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
if (($first===TRUE) AND ($second===TRUE) AND ($third===TRUE)) 
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
$oop->freeResult();
}
$oop11->freeResult();
$oop11->_mySQL;
}
if ($action_scripts=='adj_generate_single_script' ) {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop3 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop4 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table_declination='ds_wordform';
$table_info = 'ds_dec_adj_info';
$table_1 = 'ds_dec_adj_1';
$table_2 = 'ds_dec_adj_2';
$table_3 = 'ds_dec_adj_3';
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
}
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
}$oop2->freeResult();
$num_all++;
} // END MIDMYND
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
}$oop2->freeResult();
$num_all++;
}
$oop->freeResult();
$oop->_mySQL;
}
if ($action_scripts=='gen_adj1' ) {
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
// we add a frumsting beyging
$number33=77;	    
$table3='ds_dec_adj_1';
$sql3 = sprintf ('SELECT `keyword` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table3,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop3->Setnames();
$oop3->query($sql3);
$number33 = $oop3->getNumrows(); 
$oop3->freeResult();
$found_pattern=FALSE;
$ary[] = "UTF-8";
$ary[] = "ASCII";
mb_detect_order($ary);
mb_internal_encoding("UTF-8");
if ($number33==0) {
if (($_GET["generate"]=='no') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
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
}   else {
$save=TRUE;
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
// soldill
if (($last_4=='dill') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -4);
// strong singular		
$s_sg_m_1=$newstring.'dill';
$s_sg_m_4=$newstring.'dinn';
$s_sg_m_3=$newstring.'tlum';
$s_sg_m_2=$newstring.'dils';
$s_sg_f_1=$newstring.'dil';
$s_sg_f_4=$newstring.'tla';
$s_sg_f_3=$newstring.'dilli';
$s_sg_f_2=$newstring.'dillar';
$s_sg_n_1=$newstring.'dið';
$s_sg_n_4=$newstring.'dið';
$s_sg_n_3=$newstring.'tlu';
$s_sg_n_2=$newstring.'dils';
// strong pluraL
$s_pl_m_1=$newstring.'tlir';
$s_pl_m_4=$newstring.'tla';
$s_pl_m_3=$newstring.'tlum';
$s_pl_m_2=$newstring.'dilla';
$s_pl_f_1=$newstring.'tlar';
$s_pl_f_4=$newstring.'tlar';
$s_pl_f_3=$newstring.'tlum';
$s_pl_f_2=$newstring.'dilla';
$s_pl_n_1=$newstring.'dil';
$s_pl_n_4=$newstring.'dil';
$s_pl_n_3=$newstring.'tlum';
$s_pl_n_2=$newstring.'dilla';
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
$v_pl_n_2=$newstring.'litlu';
}
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
$v_pl_n_2=$newstring.'miklu';
}
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
$v_pl_n_2=$newstring.'sömu';
}
// -aður
if (($last_4=='aður') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$return_view_keyword = $view_keyword;
$view_keyword = mb_substr($view_keyword, 0, -3);
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
$newstring = mb_substr($view_keyword, 0, -1);
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
$s_sg_m_3=$newstring.'uðum';	
}
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
$s_sg_f_1=$newstring.'uð';	
}
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
$s_sg_n_3=$newstring.'uðu';	
}
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
$s_pl_m_3=$newstring.'uðum';	
}
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
$s_pl_f_3=$newstring.'uðum';	
}
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
$s_pl_n_3=$newstring.'uðum';	
}
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
$v_sg_f_2=$helpstring.'ö'.$char[$num-3].$char[$num-2].'uðu';
} else {
$v_sg_f_4=$newstring.'uðu';
$v_sg_f_3=$newstring.'uðu';
$v_sg_f_2=$newstring.'uðu';	
}
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
$v_pl_m_1=$newstring.'uðu';	
}
$v_pl_m_1=$v_pl_m_1;
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
$v_pl_n_2=$v_pl_m_1;
 $view_keyword = $return_view_keyword ;
}
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
$s_sg_n_4=$newstring;
}else if (($last_3=='ður') OR ($last_3=='dur')) {
$help_string = mb_substr($view_keyword, 0, -3);
$s_sg_n_1=$help_string.'t';
$s_sg_n_4=$help_string.'t'; 
} else if ($char3.$char4=='dd') {
$help_string = mb_substr($view_keyword, 0, -4);
$s_sg_n_1=$help_string.'tt';
$s_sg_n_4=$help_string.'tt'; 
} else
{
$s_sg_n_1=$newstring.'t';
$s_sg_n_4=$newstring.'t'; }
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
}	
$table2='ds_dec_adj_1';
$sql2 = sprintf ('INSERT INTO `%s` (`id`, `keyword`, `num_keyword`, `s_sg_m_1`, `s_sg_m_4`, `s_sg_m_3`, `s_sg_m_2`, `s_sg_f_1`, `s_sg_f_4`, `s_sg_f_3`, `s_sg_f_2`, `s_sg_n_1`, `s_sg_n_4`, `s_sg_n_3`, `s_sg_n_2`, `s_pl_m_1`, `s_pl_m_4`, `s_pl_m_3`, `s_pl_m_2`, `s_pl_f_1`, `s_pl_f_4`, `s_pl_f_3`, `s_pl_f_2`, `s_pl_n_1`, `s_pl_n_4`, `s_pl_n_3`, `s_pl_n_2`, `v_sg_m_1`, `v_sg_m_4`, `v_sg_m_3`, `v_sg_m_2`, `v_sg_f_1`, `v_sg_f_4`, `v_sg_f_3`, `v_sg_f_2`, `v_sg_n_1`, `v_sg_n_4`, `v_sg_n_3`, `v_sg_n_2`, `v_pl_m_1`, `v_pl_m_4`, `v_pl_m_3`, `v_pl_m_2`, `v_pl_f_1`, `v_pl_f_4`, `v_pl_f_3`, `v_pl_f_2`, `v_pl_n_1`, `v_pl_n_4`, `v_pl_n_3`, `v_pl_n_2`) VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)',
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
$oop2->query($sql2);
$oop2->freeResult();
}
}
if ($action_scripts=='gen_adj2' ) {
// we add a midstig beyging
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
$ary[] = "UTF-8";
$ary[] = "ASCII";
mb_detect_order($ary);
mb_internal_encoding("UTF-8");
$save=FALSE; $found_pattern=FALSE;
$num_all++;
$table3='ds_dec_adj_2';
$sql3 = sprintf ('SELECT `keyword` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table3,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop3->Setnames();
$oop3->query($sql3);
$number33 = $oop3->getNumrows(); 
$oop3->freeResult();
if ($number33==0) {
if (($_GET["generate"]=='no') AND ($found_pattern===FALSE)) {
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
} else {
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
if (($last_4=='laus') OR ($last_3=='fær') OR ($last_3=='kær')  AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
$newstring = $view_keyword;
//aðgerðarlaus
// strong singular		
$s_sg_m_1=$newstring.'ari';
$s_sg_m_4=$newstring.'ari';
$s_sg_m_3=$newstring.'ari';
$s_sg_m_2=$newstring.'ari';
$s_sg_f_1=$newstring.'ari';
$s_sg_f_4=$newstring.'ari';
$s_sg_f_3=$newstring.'ari';
$s_sg_f_2=$newstring.'ari';
$s_sg_n_1=$newstring.'ara';
$s_sg_n_4=$newstring.'ara';
$s_sg_n_3=$newstring.'ara';
$s_sg_n_2=$newstring.'ara';
// strong pluraL
$s_pl_m_1=$newstring.'ari';
$s_pl_m_4=$newstring.'ari';
$s_pl_m_3=$newstring.'ari';
$s_pl_m_2=$newstring.'ari';
$s_pl_f_1=$newstring.'ari';
$s_pl_f_4=$newstring.'ari';
$s_pl_f_3=$newstring.'ari';
$s_pl_f_2=$newstring.'ari';
$s_pl_n_1=$newstring.'ari';
$s_pl_n_4=$newstring.'ari';
$s_pl_n_3=$newstring.'ari';
$s_pl_n_2=$newstring.'ari';
} 
if (($last_3=='kur') OR ($last_3=='dur') OR ($last_3=='ður') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -2);
//aðgerðarlaus
// strong singular		
$s_sg_m_1=$newstring.'ari';
$s_sg_m_4=$newstring.'ari';
$s_sg_m_3=$newstring.'ari';
$s_sg_m_2=$newstring.'ari';
$s_sg_f_1=$newstring.'ari';
$s_sg_f_4=$newstring.'ari';
$s_sg_f_3=$newstring.'ari';
$s_sg_f_2=$newstring.'ari';
$s_sg_n_1=$newstring.'ara';
$s_sg_n_4=$newstring.'ara';
$s_sg_n_3=$newstring.'ara';
$s_sg_n_2=$newstring.'ara';
// strong pluraL
$s_pl_m_1=$newstring.'ari';
$s_pl_m_4=$newstring.'ari';
$s_pl_m_3=$newstring.'ari';
$s_pl_m_2=$newstring.'ari';
$s_pl_f_1=$newstring.'ari';
$s_pl_f_4=$newstring.'ari';
$s_pl_f_3=$newstring.'ari';
$s_pl_f_2=$newstring.'ari';
$s_pl_n_1=$newstring.'ari';
$s_pl_n_4=$newstring.'ari';
$s_pl_n_3=$newstring.'ari';
$s_pl_n_2=$newstring.'ari';
} 
//langur
if (($last_5=='angur') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -5);
// strong singular		
$s_sg_m_1=$newstring.'engri';
$s_sg_m_4=$newstring.'engri';
$s_sg_m_3=$newstring.'engri';
$s_sg_m_2=$newstring.'engri';
$s_sg_f_1=$newstring.'engri';
$s_sg_f_4=$newstring.'engri';
$s_sg_f_3=$newstring.'engri';
$s_sg_f_2=$newstring.'engri';
$s_sg_n_1=$newstring.'engra';
$s_sg_n_4=$newstring.'engra';
$s_sg_n_3=$newstring.'engra';
$s_sg_n_2=$newstring.'engra';
// strong pluraL
$s_pl_m_1=$newstring.'engri';
$s_pl_m_4=$newstring.'engri';
$s_pl_m_3=$newstring.'engri';
$s_pl_m_2=$newstring.'engri';
$s_pl_f_1=$newstring.'engri';
$s_pl_f_4=$newstring.'engri';
$s_pl_f_3=$newstring.'engri';
$s_pl_f_2=$newstring.'engri';
$s_pl_n_1=$newstring.'engri';
$s_pl_n_4=$newstring.'engri';
$s_pl_n_3=$newstring.'engri';
$s_pl_n_2=$newstring.'engri';
}
//fullur
if (($last_6=='fullur') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -6);
// strong singular		
$s_sg_m_1=$newstring.'fyllri';
$s_sg_m_4=$newstring.'fyllri';
$s_sg_m_3=$newstring.'fyllri';
$s_sg_m_2=$newstring.'fyllri';
$s_sg_f_1=$newstring.'fyllri';
$s_sg_f_4=$newstring.'fyllri';
$s_sg_f_3=$newstring.'fyllri';
$s_sg_f_2=$newstring.'fyllri';
$s_sg_n_1=$newstring.'fyllra';
$s_sg_n_4=$newstring.'fyllra';
$s_sg_n_3=$newstring.'fyllra';
$s_sg_n_2=$newstring.'fyllra';
// strong pluraL
$s_pl_m_1=$newstring.'fyllri';
$s_pl_m_4=$newstring.'fyllri';
$s_pl_m_3=$newstring.'fyllri';
$s_pl_m_2=$newstring.'fyllri';
$s_pl_f_1=$newstring.'fyllri';
$s_pl_f_4=$newstring.'fyllri';
$s_pl_f_3=$newstring.'fyllri';
$s_pl_f_2=$newstring.'fyllri';
$s_pl_n_1=$newstring.'fyllri';
$s_pl_n_4=$newstring.'fyllri';
$s_pl_n_3=$newstring.'fyllri';
$s_pl_n_2=$newstring.'fyllri';
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
}
if (($last_3=='inn') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -3);
// kominn
// strong singular		
$s_sg_m_1=$newstring.'nari';
$s_sg_m_4=$newstring.'nari';
$s_sg_m_3=$newstring.'nari';
$s_sg_m_2=$newstring.'nari';
$s_sg_f_1=$newstring.'nari';
$s_sg_f_4=$newstring.'nari';
$s_sg_f_3=$newstring.'nari';
$s_sg_f_2=$newstring.'nari';
$s_sg_n_1=$newstring.'nara';
$s_sg_n_4=$newstring.'nara';
$s_sg_n_3=$newstring.'nara';
$s_sg_n_2=$newstring.'nara';
// strong pluraL
$s_pl_m_1=$newstring.'nari';
$s_pl_m_4=$newstring.'nari';
$s_pl_m_3=$newstring.'nari';
$s_pl_m_2=$newstring.'nari';
$s_pl_f_1=$newstring.'nari';
$s_pl_f_4=$newstring.'nari';
$s_pl_f_3=$newstring.'nari';
$s_pl_f_2=$newstring.'nari';
$s_pl_n_1=$newstring.'nari';
$s_pl_n_4=$newstring.'nari';
$s_pl_n_3=$newstring.'nari';
$s_pl_n_2=$newstring.'nari';
}
// lítill
if (($last_6=='lítill') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -6);
// strong singular		
$s_sg_m_1=$newstring.'minni';
$s_sg_m_4=$newstring.'minni';
$s_sg_m_3=$newstring.'minni';
$s_sg_m_2=$newstring.'minni';
$s_sg_f_1=$newstring.'minni';
$s_sg_f_4=$newstring.'minni';
$s_sg_f_3=$newstring.'minni';
$s_sg_f_2=$newstring.'minni';
$s_sg_n_1=$newstring.'minna';
$s_sg_n_4=$newstring.'minna';
$s_sg_n_3=$newstring.'minna';
$s_sg_n_2=$newstring.'minna';
// strong pluraL
$s_pl_m_1=$newstring.'minni';
$s_pl_m_4=$newstring.'minni';
$s_pl_m_3=$newstring.'minni';
$s_pl_m_2=$newstring.'minni';
$s_pl_f_1=$newstring.'minni';
$s_pl_f_4=$newstring.'minni';
$s_pl_f_3=$newstring.'minni';
$s_pl_f_2=$newstring.'minni';
$s_pl_n_1=$newstring.'minni';
$s_pl_n_4=$newstring.'minni';
$s_pl_n_3=$newstring.'minni';
$s_pl_n_2=$newstring.'minni';
}
// mikill
if (($last_6=='mikill') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -6);
// strong singular		
$s_sg_m_1=$newstring.'meiri';
$s_sg_m_4=$newstring.'meiri';
$s_sg_m_3=$newstring.'meiri';
$s_sg_m_2=$newstring.'meiri';
$s_sg_f_1=$newstring.'meiri';
$s_sg_f_4=$newstring.'meiri';
$s_sg_f_3=$newstring.'meiri';
$s_sg_f_2=$newstring.'meiri';
$s_sg_n_1=$newstring.'meira';
$s_sg_n_4=$newstring.'meira';
$s_sg_n_3=$newstring.'meira';
$s_sg_n_2=$newstring.'meira';
// strong pluraL
$s_pl_m_1=$newstring.'meiri';
$s_pl_m_4=$newstring.'meiri';
$s_pl_m_3=$newstring.'meiri';
$s_pl_m_2=$newstring.'meiri';
$s_pl_f_1=$newstring.'meiri';
$s_pl_f_4=$newstring.'meiri';
$s_pl_f_3=$newstring.'meiri';
$s_pl_f_2=$newstring.'meiri';
$s_pl_n_1=$newstring.'meiri';
$s_pl_n_4=$newstring.'meiri';
$s_pl_n_3=$newstring.'meiri';
$s_pl_n_2=$newstring.'meiri';
}
// -samur
if (($last_5=='samur') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -5);
// strong singular		
$s_sg_m_1=$newstring.'samari';
$s_sg_m_4=$newstring.'samari';
$s_sg_m_3=$newstring.'samari';
$s_sg_m_2=$newstring.'samari';
$s_sg_f_1=$newstring.'samari';
$s_sg_f_4=$newstring.'samari';
$s_sg_f_3=$newstring.'samari';
$s_sg_f_2=$newstring.'samari';
$s_sg_n_1=$newstring.'samara';
$s_sg_n_4=$newstring.'samara';
$s_sg_n_3=$newstring.'samara';
$s_sg_n_2=$newstring.'samara';
// strong pluraL
$s_pl_m_1=$newstring.'samari';
$s_pl_m_4=$newstring.'samari';
$s_pl_m_3=$newstring.'samari';
$s_pl_m_2=$newstring.'samari';
$s_pl_f_1=$newstring.'samari';
$s_pl_f_4=$newstring.'samari';
$s_pl_f_3=$newstring.'samari';
$s_pl_f_2=$newstring.'samari';
$s_pl_n_1=$newstring.'samari';
$s_pl_n_4=$newstring.'samari';
$s_pl_n_3=$newstring.'samari';
$s_pl_n_2=$newstring.'samari';
}
// -aður
if (($last_4=='aður') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -4);
// strong singular		
$s_sg_m_1=$newstring.'aðri';
$s_sg_m_4=$newstring.'aðri';
$s_sg_m_3=$newstring.'aðri';
$s_sg_m_2=$newstring.'aðri';
$s_sg_f_1=$newstring.'aðri';
$s_sg_f_4=$newstring.'aðri';
$s_sg_f_3=$newstring.'aðri';
$s_sg_f_2=$newstring.'aðri';
$s_sg_n_1=$newstring.'aðra';
$s_sg_n_4=$newstring.'aðra';
$s_sg_n_3=$newstring.'aðra';
$s_sg_n_2=$newstring.'aðra';
// strong pluraL
$s_pl_m_1=$newstring.'aðri';
$s_pl_m_4=$newstring.'aðri';
$s_pl_m_3=$newstring.'aðri';
$s_pl_m_2=$newstring.'aðri';
$s_pl_f_1=$newstring.'aðri';
$s_pl_f_4=$newstring.'aðri';
$s_pl_f_3=$newstring.'aðri';
$s_pl_f_2=$newstring.'aðri';
$s_pl_n_1=$newstring.'aðri';
$s_pl_n_4=$newstring.'aðri';
$s_pl_n_3=$newstring.'aðri';
$s_pl_n_2=$newstring.'aðri';
}

if ($found_pattern===FALSE) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -5);
//glæsilegur
// strong singular		
$s_sg_m_1=$newstring.'legri';
$s_sg_m_4=$newstring.'legri';
$s_sg_m_3=$newstring.'legri';
$s_sg_m_2=$newstring.'legri';
$s_sg_f_1=$newstring.'legri';
$s_sg_f_4=$newstring.'legri';
$s_sg_f_3=$newstring.'legri';
$s_sg_f_2=$newstring.'legri';
if ($char3=='t') { 
$s_sg_n_1=$newstring;
$s_sg_n_4=$newstring;
}else if (($last_3=='ður') OR ($last_3=='dur')) {
$help_string = mb_substr($view_keyword, 0, -3);
$s_sg_n_1=$help_string.'legra';
$s_sg_n_4=$help_string.'legra'; 
} else if ($char3.$char4=='dd') {
$help_string = mb_substr($view_keyword, 0, -4);
$s_sg_n_1=$help_string.'legra';
$s_sg_n_4=$help_string.'legra'; 
} else
{
$s_sg_n_1=$newstring.'legra';
$s_sg_n_4=$newstring.'legra'; }
$s_sg_n_3=$newstring.'legra';
$s_sg_n_2=$newstring.'legra';
// strong pluraL
$s_pl_m_1=$newstring.'legri';
$s_pl_m_4=$newstring.'legri';
$s_pl_m_3=$newstring.'legri';
$s_pl_m_2=$newstring.'legri';
$s_pl_f_1=$newstring.'legri';
$s_pl_f_4=$newstring.'legri';
$s_pl_f_3=$newstring.'legri';
$s_pl_f_2=$newstring.'legri';
$s_pl_n_1=$newstring.'legri';
$s_pl_n_4=$newstring.'legri';
$s_pl_n_3=$newstring.'legri';
$s_pl_n_2=$newstring.'legri';
} 
}
$table2 = 'ds_dec_adj_2';
$num_walked++;
// check if the keyword does not already exists in database
$sql = sprintf ('SELECT `keyword` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`=%s',
	$table2,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop3->Setnames();
$oop3->query($sql);
$number = $oop3->getNumrows(); 
$oop3->freeResult();
if ($number==0) { // no result we can add a keyword
$num_added++;
$sql2 = sprintf ('INSERT INTO `%s` (`id`, `keyword`, `num_keyword`, `s_sg_m_1`, `s_sg_m_4`, `s_sg_m_3`, `s_sg_m_2`, `s_sg_f_1`, `s_sg_f_4`, `s_sg_f_3`, `s_sg_f_2`, `s_sg_n_1`, `s_sg_n_4`, `s_sg_n_3`, `s_sg_n_2`, `s_pl_m_1`, `s_pl_m_4`, `s_pl_m_3`, `s_pl_m_2`, `s_pl_f_1`, `s_pl_f_4`, `s_pl_f_3`, `s_pl_f_2`, `s_pl_n_1`, `s_pl_n_4`, `s_pl_n_3`, `s_pl_n_2`) VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)',
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
	quate_smart($s_pl_n_2));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
}
}
}
if ($action_scripts=='gen_adj3' ) {
// we add efsta stig beyging if exists
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
$ary[] = "UTF-8";
$ary[] = "ASCII";
mb_detect_order($ary);
mb_internal_encoding("UTF-8");
$save=FALSE; $found_pattern=FALSE;
$num_all++;
$table3='ds_dec_adj_3';
$sql3 = sprintf ('SELECT `keyword` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table3,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop3->Setnames();
$oop3->query($sql3);
$number33 = $oop3->getNumrows(); 
$oop3->freeResult();
if ($number33==0) {
if (($_GET["generate"]=='no') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
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
} else {
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
if (($last_4=='laus') OR ($last_3=='fær') OR ($last_3=='kær') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
$newstring = $view_keyword;
//aðgerðarlaus
// strong singular		
$s_sg_m_1=$newstring.'astur';
$s_sg_m_4=$newstring.'astan';
$s_sg_m_3=$newstring.'ustum';
$s_sg_m_2=$newstring.'asts';
$s_sg_f_1=$newstring.'ust';
$s_sg_f_4=$newstring.'asta';
$s_sg_f_3=$newstring.'astri';
$s_sg_f_2=$newstring.'astrar';
$s_sg_n_1=$newstring.'ast';
$s_sg_n_4=$newstring.'ast';
$s_sg_n_3=$newstring.'ustu';
$s_sg_n_2=$newstring.'asts';
// strong pluraL
$s_pl_m_1=$newstring.'astir';
$s_pl_m_4=$newstring.'asta';
$s_pl_m_3=$newstring.'ustum';
$s_pl_m_2=$newstring.'astra';
$s_pl_f_1=$newstring.'astar';
$s_pl_f_4=$newstring.'astar';
$s_pl_f_3=$newstring.'ustum';
$s_pl_f_2=$newstring.'astra';
$s_pl_n_1=$newstring.'ust';
$s_pl_n_4=$newstring.'ust';
$s_pl_n_3=$newstring.'ustum';
$s_pl_n_2=$newstring.'astra';
// eak singular
$v_sg_m_1=$newstring.'asti';
$v_sg_m_4=$newstring.'asta';
$v_sg_m_3=$newstring.'asta';
$v_sg_m_2=$newstring.'asta';
$v_sg_f_1=$newstring.'asta';
$v_sg_f_4=$newstring.'ustu';
$v_sg_f_3=$newstring.'ustu';
$v_sg_f_2=$newstring.'ustu';
$v_sg_n_1=$newstring.'asta';
$v_sg_n_4=$newstring.'asta';
$v_sg_n_3=$newstring.'asta';
$v_sg_n_2=$newstring.'asta';
// weak plural
$v_pl_m_1=$newstring.'ustu';
$v_pl_m_4=$newstring.'ustu';
$v_pl_m_3=$newstring.'ustu';
$v_pl_m_2=$newstring.'ustu';
$v_pl_f_1=$newstring.'ustu';
$v_pl_f_4=$newstring.'ustu';
$v_pl_f_3=$newstring.'ustu';
$v_pl_f_2=$newstring.'ustu';
$v_pl_n_1=$newstring.'ustu';
$v_pl_n_4=$newstring.'ustu';
$v_pl_n_3=$newstring.'ustu';
$v_pl_n_2=$newstring.'ustu';	
} 
if (($last_3=='ænn') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -1);
//bannvænn
// strong singular		
$s_sg_m_1=$newstring.'astur';
$s_sg_m_4=$newstring.'astan';
$s_sg_m_3=$newstring.'ustum';
$s_sg_m_2=$newstring.'asts';
$s_sg_f_1=$newstring.'ust';
$s_sg_f_4=$newstring.'asta';
$s_sg_f_3=$newstring.'astri';
$s_sg_f_2=$newstring.'astrar';
$s_sg_n_1=$newstring.'ast';
$s_sg_n_4=$newstring.'ast';
$s_sg_n_3=$newstring.'ustu';
$s_sg_n_2=$newstring.'asts';
// strong pluraL
$s_pl_m_1=$newstring.'astir';
$s_pl_m_4=$newstring.'asta';
$s_pl_m_3=$newstring.'ustum';
$s_pl_m_2=$newstring.'astra';
$s_pl_f_1=$newstring.'astar';
$s_pl_f_4=$newstring.'astar';
$s_pl_f_3=$newstring.'ustum';
$s_pl_f_2=$newstring.'astra';
$s_pl_n_1=$newstring.'ust';
$s_pl_n_4=$newstring.'ust';
$s_pl_n_3=$newstring.'ustum';
$s_pl_n_2=$newstring.'astra';
// eak singular
$v_sg_m_1=$newstring.'asti';
$v_sg_m_4=$newstring.'asta';
$v_sg_m_3=$newstring.'asta';
$v_sg_m_2=$newstring.'asta';
$v_sg_f_1=$newstring.'asta';
$v_sg_f_4=$newstring.'ustu';
$v_sg_f_3=$newstring.'ustu';
$v_sg_f_2=$newstring.'ustu';
$v_sg_n_1=$newstring.'asta';
$v_sg_n_4=$newstring.'asta';
$v_sg_n_3=$newstring.'asta';
$v_sg_n_2=$newstring.'asta';
// weak plural
$v_pl_m_1=$newstring.'ustu';
$v_pl_m_4=$newstring.'ustu';
$v_pl_m_3=$newstring.'ustu';
$v_pl_m_2=$newstring.'ustu';
$v_pl_f_1=$newstring.'ustu';
$v_pl_f_4=$newstring.'ustu';
$v_pl_f_3=$newstring.'ustu';
$v_pl_f_2=$newstring.'ustu';
$v_pl_n_1=$newstring.'ustu';
$v_pl_n_4=$newstring.'ustu';
$v_pl_n_3=$newstring.'ustu';
$v_pl_n_2=$newstring.'ustu';	
} 
//langur
if (($last_5=='angur') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -5);
// strong singular		
$s_sg_m_1=$newstring.'engstur';
$s_sg_m_4=$newstring.'engstan';
$s_sg_m_3=$newstring.'engstum';
$s_sg_m_2=$newstring.'engsts';
$s_sg_f_1=$newstring.'engst';
$s_sg_f_4=$newstring.'engsta';
$s_sg_f_3=$newstring.'engstri';
$s_sg_f_2=$newstring.'engstrar';
$s_sg_n_1=$newstring.'engst';
$s_sg_n_4=$newstring.'engst';
$s_sg_n_3=$newstring.'engstu';
$s_sg_n_2=$newstring.'engsts';
// strong pluraL
$s_pl_m_1=$newstring.'engstir';
$s_pl_m_4=$newstring.'engsta';
$s_pl_m_3=$newstring.'engstum';
$s_pl_m_2=$newstring.'engstra';
$s_pl_f_1=$newstring.'engstar';
$s_pl_f_4=$newstring.'engstar';
$s_pl_f_3=$newstring.'engstum';
$s_pl_f_2=$newstring.'engstra';
$s_pl_n_1=$newstring.'engst';
$s_pl_n_4=$newstring.'engst';
$s_pl_n_3=$newstring.'engstum';
$s_pl_n_2=$newstring.'engstra';
// eak singular
$v_sg_m_1=$newstring.'engsti';
$v_sg_m_4=$newstring.'engsta';
$v_sg_m_3=$newstring.'engsta';
$v_sg_m_2=$newstring.'engsta';
$v_sg_f_1=$newstring.'engsta';
$v_sg_f_4=$newstring.'engstu';
$v_sg_f_3=$newstring.'engstu';
$v_sg_f_2=$newstring.'engstu';
$v_sg_n_1=$newstring.'engsta';
$v_sg_n_4=$newstring.'engsta';
$v_sg_n_3=$newstring.'engsta';
$v_sg_n_2=$newstring.'engsta';
// weak plural
$v_pl_m_1=$newstring.'engstu';
$v_pl_m_4=$newstring.'engstu';
$v_pl_m_3=$newstring.'engstu';
$v_pl_m_2=$newstring.'engstu';
$v_pl_f_1=$newstring.'engstu';
$v_pl_f_4=$newstring.'engstu';
$v_pl_f_3=$newstring.'engstu';
$v_pl_f_2=$newstring.'engstu';
$v_pl_n_1=$newstring.'engstu';
$v_pl_n_4=$newstring.'engstu';
$v_pl_n_3=$newstring.'engstu';
$v_pl_n_2=$newstring.'engstu';	
}
//langur
if (($last_5=='arður') AND ($found_pattern===FALSE)){
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -5);
// strong singular		
$s_sg_m_1=$newstring.'arðastur';
$s_sg_m_4=$newstring.'arðastan';
$s_sg_m_3=$newstring.'örðustum';
$s_sg_m_2=$newstring.'arðasts';
$s_sg_f_1=$newstring.'örðust';
$s_sg_f_4=$newstring.'arðasta';
$s_sg_f_3=$newstring.'arðastri';
$s_sg_f_2=$newstring.'arðastrar';
$s_sg_n_1=$newstring.'arðast';
$s_sg_n_4=$newstring.'arðast';
$s_sg_n_3=$newstring.'örðustu';
$s_sg_n_2=$newstring.'arðasts';
// strong pluraL
$s_pl_m_1=$newstring.'arðastir';
$s_pl_m_4=$newstring.'arðasta';
$s_pl_m_3=$newstring.'örðustum';
$s_pl_m_2=$newstring.'arðastra';
$s_pl_f_1=$newstring.'arðastar';
$s_pl_f_4=$newstring.'arðastar';
$s_pl_f_3=$newstring.'örðustum';
$s_pl_f_2=$newstring.'arðastra';
$s_pl_n_1=$newstring.'örðust';
$s_pl_n_4=$newstring.'örðust';
$s_pl_n_3=$newstring.'örðustum';
$s_pl_n_2=$newstring.'arðastra';
// eak singular
$v_sg_m_1=$newstring.'arðasti';
$v_sg_m_4=$newstring.'arðasta';
$v_sg_m_3=$newstring.'arðasta';
$v_sg_m_2=$newstring.'arðasta';
$v_sg_f_1=$newstring.'arðasta';
$v_sg_f_4=$newstring.'örðustu';
$v_sg_f_3=$newstring.'örðustu';
$v_sg_f_2=$newstring.'örðustu';
$v_sg_n_1=$newstring.'arðasta';
$v_sg_n_4=$newstring.'arðasta';
$v_sg_n_3=$newstring.'arðasta';
$v_sg_n_2=$newstring.'arðasta';
// weak plural
$v_pl_m_1=$newstring.'örðustu';
$v_pl_m_4=$newstring.'örðustu';
$v_pl_m_3=$newstring.'örðustu';
$v_pl_m_2=$newstring.'örðustu';
$v_pl_f_1=$newstring.'örðustu';
$v_pl_f_4=$newstring.'örðustu';
$v_pl_f_3=$newstring.'örðustu';
$v_pl_f_2=$newstring.'örðustu';
$v_pl_n_1=$newstring.'örðustu';
$v_pl_n_4=$newstring.'örðustu';
$v_pl_n_3=$newstring.'örðustu';
$v_pl_n_2=$newstring.'örðustu';	
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
if (($last_3=='inn') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -3);
// kominn
// strong singular		
$s_sg_m_1=$newstring.'nastur';
$s_sg_m_4=$newstring.'nastan';
$s_sg_m_3=$newstring.'nustum';
$s_sg_m_2=$newstring.'nasts';
$s_sg_f_1=$newstring.'nust';
$s_sg_f_4=$newstring.'nasta';
$s_sg_f_3=$newstring.'nastri';
$s_sg_f_2=$newstring.'nastrar';
$s_sg_n_1=$newstring.'nast';
$s_sg_n_4=$newstring.'nast';
$s_sg_n_3=$newstring.'nustu';
$s_sg_n_2=$newstring.'nasts';
// strong pluraL
$s_pl_m_1=$newstring.'nastir';
$s_pl_m_4=$newstring.'nasta';
$s_pl_m_3=$newstring.'nustum';
$s_pl_m_2=$newstring.'nastra';
$s_pl_f_1=$newstring.'nastar';
$s_pl_f_4=$newstring.'nastar';
$s_pl_f_3=$newstring.'nustum';
$s_pl_f_2=$newstring.'nastra';
$s_pl_n_1=$newstring.'nust';
$s_pl_n_4=$newstring.'nust';
$s_pl_n_3=$newstring.'nustum';
$s_pl_n_2=$newstring.'nastra';
// eak singular
$v_sg_m_1=$newstring.'nasti';
$v_sg_m_4=$newstring.'nasta';
$v_sg_m_3=$newstring.'nasta';
$v_sg_m_2=$newstring.'nasta';
$v_sg_f_1=$newstring.'nasta';
$v_sg_f_4=$newstring.'nustu';
$v_sg_f_3=$newstring.'nustu';
$v_sg_f_2=$newstring.'nustu';
$v_sg_n_1=$newstring.'nasta';
$v_sg_n_4=$newstring.'nasta';
$v_sg_n_3=$newstring.'nasta';
$v_sg_n_2=$newstring.'nasta';
// weak plural
$v_pl_m_1=$newstring.'nustu';
$v_pl_m_4=$newstring.'nustu';
$v_pl_m_3=$newstring.'nustu';
$v_pl_m_2=$newstring.'nustu';
$v_pl_f_1=$newstring.'nustu';
$v_pl_f_4=$newstring.'nustu';
$v_pl_f_3=$newstring.'nustu';
$v_pl_f_2=$newstring.'nustu';
$v_pl_n_1=$newstring.'nustu';
$v_pl_n_4=$newstring.'nustu';
$v_pl_n_3=$newstring.'nustu';
$v_pl_n_2=$newstring.'nustu';
}
// lítill
if (($last_6=='lítill') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -6);
// strong singular		
$s_sg_m_1=$newstring.'minnstur';
$s_sg_m_4=$newstring.'minnstan';
$s_sg_m_3=$newstring.'minnstum';
$s_sg_m_2=$newstring.'minnsts';
$s_sg_f_1=$newstring.'minnst';
$s_sg_f_4=$newstring.'minnsta';
$s_sg_f_3=$newstring.'minnstri';
$s_sg_f_2=$newstring.'minnstrar';
$s_sg_n_1=$newstring.'minnst';
$s_sg_n_4=$newstring.'minnst';
$s_sg_n_3=$newstring.'minnstu';
$s_sg_n_2=$newstring.'minnsts';
// strong pluraL
$s_pl_m_1=$newstring.'minnstir';
$s_pl_m_4=$newstring.'minnsta';
$s_pl_m_3=$newstring.'minnstum';
$s_pl_m_2=$newstring.'minnstra';
$s_pl_f_1=$newstring.'minnstar';
$s_pl_f_4=$newstring.'minnstar';
$s_pl_f_3=$newstring.'minnstum';
$s_pl_f_2=$newstring.'minnstra';
$s_pl_n_1=$newstring.'minnst';
$s_pl_n_4=$newstring.'minnst';
$s_pl_n_3=$newstring.'minnstum';
$s_pl_n_2=$newstring.'minnstra';
// eak singular
$v_sg_m_1=$newstring.'minnsti';
$v_sg_m_4=$newstring.'minnsta';
$v_sg_m_3=$newstring.'minnsta';
$v_sg_m_2=$newstring.'minnsta';
$v_sg_f_1=$newstring.'minnsta';
$v_sg_f_4=$newstring.'minnstu';
$v_sg_f_3=$newstring.'minnstu';
$v_sg_f_2=$newstring.'minnstu';
$v_sg_n_1=$newstring.'minnsta';
$v_sg_n_4=$newstring.'minnsta';
$v_sg_n_3=$newstring.'minnsta';
$v_sg_n_2=$newstring.'minnsta';
// weak plural
$v_pl_m_1=$newstring.'minnstu';
$v_pl_m_4=$newstring.'minnstu';
$v_pl_m_3=$newstring.'minnstu';
$v_pl_m_2=$newstring.'minnstu';
$v_pl_f_1=$newstring.'minnstu';
$v_pl_f_4=$newstring.'minnstu';
$v_pl_f_3=$newstring.'minnstu';
$v_pl_f_2=$newstring.'minnstu';
$v_pl_n_1=$newstring.'minnstu';
$v_pl_n_4=$newstring.'minnstu';
$v_pl_n_3=$newstring.'minnstu';
$v_pl_n_2=$newstring.'minnstu';
}
// mikill
if (($last_6=='mikill') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -6);
// strong singular		
$s_sg_m_1=$newstring.'mestur';
$s_sg_m_4=$newstring.'mestan';
$s_sg_m_3=$newstring.'mestum';
$s_sg_m_2=$newstring.'mests';
$s_sg_f_1=$newstring.'mest';
$s_sg_f_4=$newstring.'mesta';
$s_sg_f_3=$newstring.'mestri';
$s_sg_f_2=$newstring.'mestrar';
$s_sg_n_1=$newstring.'mest';
$s_sg_n_4=$newstring.'mest';
$s_sg_n_3=$newstring.'mestu';
$s_sg_n_2=$newstring.'mests';
// strong pluraL
$s_pl_m_1=$newstring.'mestir';
$s_pl_m_4=$newstring.'mesta';
$s_pl_m_3=$newstring.'mestum';
$s_pl_m_2=$newstring.'mestra';
$s_pl_f_1=$newstring.'mestar';
$s_pl_f_4=$newstring.'mestar';
$s_pl_f_3=$newstring.'mestum';
$s_pl_f_2=$newstring.'mestra';
$s_pl_n_1=$newstring.'mest';
$s_pl_n_4=$newstring.'mest';
$s_pl_n_3=$newstring.'mestum';
$s_pl_n_2=$newstring.'mestra';
// eak singular
$v_sg_m_1=$newstring.'mesti';
$v_sg_m_4=$newstring.'mesta';
$v_sg_m_3=$newstring.'mesta';
$v_sg_m_2=$newstring.'mesta';
$v_sg_f_1=$newstring.'mesta';
$v_sg_f_4=$newstring.'mestu';
$v_sg_f_3=$newstring.'mestu';
$v_sg_f_2=$newstring.'mestu';
$v_sg_n_1=$newstring.'mesta';
$v_sg_n_4=$newstring.'mesta';
$v_sg_n_3=$newstring.'mesta';
$v_sg_n_2=$newstring.'mesta';
// weak plural
$v_pl_m_1=$newstring.'mestu';
$v_pl_m_4=$newstring.'mestu';
$v_pl_m_3=$newstring.'mestu';
$v_pl_m_2=$newstring.'mestu';
$v_pl_f_1=$newstring.'mestu';
$v_pl_f_4=$newstring.'mestu';
$v_pl_f_3=$newstring.'mestu';
$v_pl_f_2=$newstring.'mestu';
$v_pl_n_1=$newstring.'mestu';
$v_pl_n_4=$newstring.'mestu';
$v_pl_n_3=$newstring.'mestu';
$v_pl_n_2=$newstring.'mestu';
}
if (($last_3=='úll') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -1);
// strong singular		
$s_sg_m_1=$newstring.'astur';
$s_sg_m_4=$newstring.'astan';
$s_sg_m_3=$newstring.'ustum';
$s_sg_m_2=$newstring.'asts';
$s_sg_f_1=$newstring.'ust';
$s_sg_f_4=$newstring.'asta';
$s_sg_f_3=$newstring.'astri';
$s_sg_f_2=$newstring.'astrar';
$s_sg_n_1=$newstring.'ast';
$s_sg_n_4=$newstring.'ast';
$s_sg_n_3=$newstring.'ustu';
$s_sg_n_2=$newstring.'asts';
// strong pluraL
$s_pl_m_1=$newstring.'astir';
$s_pl_m_4=$newstring.'asta';
$s_pl_m_3=$newstring.'ustum';
$s_pl_m_2=$newstring.'astra';
$s_pl_f_1=$newstring.'astar';
$s_pl_f_4=$newstring.'astar';
$s_pl_f_3=$newstring.'ustum';
$s_pl_f_2=$newstring.'astra';
$s_pl_n_1=$newstring.'ust';
$s_pl_n_4=$newstring.'ust';
$s_pl_n_3=$newstring.'ustum';
$s_pl_n_2=$newstring.'astra';
// eak singular
$v_sg_m_1=$newstring.'asti';
$v_sg_m_4=$newstring.'asta';
$v_sg_m_3=$newstring.'asta';
$v_sg_m_2=$newstring.'asta';
$v_sg_f_1=$newstring.'asta';
$v_sg_f_4=$newstring.'ustu';
$v_sg_f_3=$newstring.'ustu';
$v_sg_f_2=$newstring.'ustu';
$v_sg_n_1=$newstring.'asta';
$v_sg_n_4=$newstring.'asta';
$v_sg_n_3=$newstring.'asta';
$v_sg_n_2=$newstring.'asta';
// weak plural
$v_pl_m_1=$newstring.'ustu';
$v_pl_m_4=$newstring.'ustu';
$v_pl_m_3=$newstring.'ustu';
$v_pl_m_2=$newstring.'ustu';
$v_pl_f_1=$newstring.'ustu';
$v_pl_f_4=$newstring.'ustu';
$v_pl_f_3=$newstring.'ustu';
$v_pl_f_2=$newstring.'ustu';
$v_pl_n_1=$newstring.'ustu';
$v_pl_n_4=$newstring.'ustu';
$v_pl_n_3=$newstring.'ustu';
$v_pl_n_2=$newstring.'ustu';
}
if (($last_6=='fullur') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -6);
// fullur
// strong singular		
$s_sg_m_1=$newstring.'fyllstur';
$s_sg_m_4=$newstring.'fyllstan';
$s_sg_m_3=$newstring.'fyllstum';
$s_sg_m_2=$newstring.'fyllsts';
$s_sg_f_1=$newstring.'fyllst';
$s_sg_f_4=$newstring.'fyllsta';
$s_sg_f_3=$newstring.'fyllstri';
$s_sg_f_2=$newstring.'fyllstrar';
$s_sg_n_1=$newstring.'fyllst';
$s_sg_n_4=$newstring.'fyllst';
$s_sg_n_3=$newstring.'fyllstu';
$s_sg_n_2=$newstring.'fyllsts';
// strong pluraL
$s_pl_m_1=$newstring.'fyllstir';
$s_pl_m_4=$newstring.'fyllsta';
$s_pl_m_3=$newstring.'fyllstum';
$s_pl_m_2=$newstring.'fyllstra';
$s_pl_f_1=$newstring.'fyllstar';
$s_pl_f_4=$newstring.'fyllstar';
$s_pl_f_3=$newstring.'fyllstum';
$s_pl_f_2=$newstring.'fyllstra';
$s_pl_n_1=$newstring.'fyllst';
$s_pl_n_4=$newstring.'fyllst';
$s_pl_n_3=$newstring.'fyllstum';
$s_pl_n_2=$newstring.'fyllstra';
// eak singular
$v_sg_m_1=$newstring.'fyllsti';
$v_sg_m_4=$newstring.'fyllsta';
$v_sg_m_3=$newstring.'fyllsta';
$v_sg_m_2=$newstring.'fyllsta';
$v_sg_f_1=$newstring.'fyllsta';
$v_sg_f_4=$newstring.'fyllstu';
$v_sg_f_3=$newstring.'fyllstu';
$v_sg_f_2=$newstring.'fyllstu';
$v_sg_n_1=$newstring.'fyllsta';
$v_sg_n_4=$newstring.'fyllsta';
$v_sg_n_3=$newstring.'fyllsta';
$v_sg_n_2=$newstring.'fyllsta';
// weak plural
$v_pl_m_1=$newstring.'fyllstu';
$v_pl_m_4=$newstring.'fyllstu';
$v_pl_m_3=$newstring.'fyllstu';
$v_pl_m_2=$newstring.'fyllstu';
$v_pl_f_1=$newstring.'fyllstu';
$v_pl_f_4=$newstring.'fyllstu';
$v_pl_f_3=$newstring.'fyllstu';
$v_pl_f_2=$newstring.'fyllstu';
$v_pl_n_1=$newstring.'fyllstu';
$v_pl_n_4=$newstring.'fyllstu';
$v_pl_n_3=$newstring.'fyllstu';
$v_pl_n_2=$newstring.'fyllstu';
}
// -samur
if (($last_5=='samur') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -5);
// strong singular		
$s_sg_m_1=$newstring.'samastur';
$s_sg_m_4=$newstring.'samastan';
$s_sg_m_3=$newstring.'sömustum';
$s_sg_m_2=$newstring.'samasts';
$s_sg_f_1=$newstring.'sömust';
$s_sg_f_4=$newstring.'samasta';
$s_sg_f_3=$newstring.'samastri';
$s_sg_f_2=$newstring.'samastrar';
$s_sg_n_1=$newstring.'samast';
$s_sg_n_4=$newstring.'samast';
$s_sg_n_3=$newstring.'sömustu';
$s_sg_n_2=$newstring.'samasts';
// strong pluraL
$s_pl_m_1=$newstring.'samastir';
$s_pl_m_4=$newstring.'samasta';
$s_pl_m_3=$newstring.'sömustum';
$s_pl_m_2=$newstring.'samastra';
$s_pl_f_1=$newstring.'samastar';
$s_pl_f_4=$newstring.'samastar';
$s_pl_f_3=$newstring.'sömustum';
$s_pl_f_2=$newstring.'samastra';
$s_pl_n_1=$newstring.'sömust';
$s_pl_n_4=$newstring.'sömust';
$s_pl_n_3=$newstring.'sömustum';
$s_pl_n_2=$newstring.'samastra';
// eak singular
$v_sg_m_1=$newstring.'samasti';
$v_sg_m_4=$newstring.'samasta';
$v_sg_m_3=$newstring.'samasta';
$v_sg_m_2=$newstring.'samasta';
$v_sg_f_1=$newstring.'samasta';
$v_sg_f_4=$newstring.'sömustu';
$v_sg_f_3=$newstring.'sömustu';
$v_sg_f_2=$newstring.'sömustu';
$v_sg_n_1=$newstring.'samasta';
$v_sg_n_4=$newstring.'samasta';
$v_sg_n_3=$newstring.'samasta';
$v_sg_n_2=$newstring.'samasta';
// weak plural
$v_pl_m_1=$newstring.'sömustu';
$v_pl_m_4=$newstring.'sömustu';
$v_pl_m_3=$newstring.'sömustu';
$v_pl_m_2=$newstring.'sömustu';
$v_pl_f_1=$newstring.'sömustu';
$v_pl_f_4=$newstring.'sömustu';
$v_pl_f_3=$newstring.'sömustu';
$v_pl_f_2=$newstring.'sömustu';
$v_pl_n_1=$newstring.'sömustu';
$v_pl_n_4=$newstring.'sömustu';
$v_pl_n_3=$newstring.'sömustu';
$v_pl_n_2=$newstring.'sömustu';
}
// -aður
if ($found_pattern===FALSE) {
$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($view_keyword, 0, -2);
// strong singular		
$s_sg_m_1=$newstring.'astur';
$s_sg_m_4=$newstring.'astan';
$s_sg_m_3=$newstring.'ustum';
$s_sg_m_2=$newstring.'asts';
$s_sg_f_1=$newstring.'ust';
$s_sg_f_4=$newstring.'asta';
$s_sg_f_3=$newstring.'astri';
$s_sg_f_2=$newstring.'astrar';
if ($char3=='t') { 
$s_sg_n_1=$newstring;
$s_sg_n_4=$newstring;
}else if (($last_3=='ður') OR ($last_3=='dur')) {
$help_string = mb_substr($view_keyword, 0, -3);
$s_sg_n_1=$help_string.'ast';
$s_sg_n_4=$help_string.'ast'; 
} else if ($char3.$char4=='dd') {
$help_string = mb_substr($view_keyword, 0, -4);
$s_sg_n_1=$help_string.'tt';
$s_sg_n_4=$help_string.'tt'; 
} else
{
$s_sg_n_1=$newstring.'ast';
$s_sg_n_4=$newstring.'ast'; }
$s_sg_n_3=$newstring.'ustu';
$s_sg_n_2=$newstring.'asts';
// strong pluraL
$s_pl_m_1=$newstring.'astir';
$s_pl_m_4=$newstring.'asta';
$s_pl_m_3=$newstring.'ustum';
$s_pl_m_2=$newstring.'astra';
$s_pl_f_1=$newstring.'astar';
$s_pl_f_4=$newstring.'astar';
$s_pl_f_3=$newstring.'ustum';
$s_pl_f_2=$newstring.'astra';
$s_pl_n_1=$newstring.'ust';
$s_pl_n_4=$newstring.'ust';
$s_pl_n_3=$newstring.'ustum';
$s_pl_n_2=$newstring.'astra';
// eak singular
$v_sg_m_1=$newstring.'asti';
$v_sg_m_4=$newstring.'asta';
$v_sg_m_3=$newstring.'asta';
$v_sg_m_2=$newstring.'asta';
$v_sg_f_1=$newstring.'asta';
$v_sg_f_4=$newstring.'ustu';
$v_sg_f_3=$newstring.'ustu';
$v_sg_f_2=$newstring.'ustu';
$v_sg_n_1=$newstring.'asta';
$v_sg_n_4=$newstring.'asta';
$v_sg_n_3=$newstring.'asta';
$v_sg_n_2=$newstring.'asta';
// weak plural
$v_pl_m_1=$newstring.'ustu';
$v_pl_m_4=$newstring.'ustu';
$v_pl_m_3=$newstring.'ustu';
$v_pl_m_2=$newstring.'ustu';
$v_pl_f_1=$newstring.'ustu';
$v_pl_f_4=$newstring.'ustu';
$v_pl_f_3=$newstring.'ustu';
$v_pl_f_2=$newstring.'ustu';
$v_pl_n_1=$newstring.'ustu';
$v_pl_n_4=$newstring.'ustu';
$v_pl_n_3=$newstring.'ustu';
$v_pl_n_2=$newstring.'ustu';
} 
}   
$table2 = 'ds_dec_adj_3';
$num_walked++;
// check if the keyword does not already exists in database
$sql = sprintf ('SELECT `keyword` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`=%s',
	$table2,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop3->Setnames();
$oop3->query($sql);
$number = $oop3->getNumrows(); 
$oop3->freeResult();
if ($number==0) { // no result we can add a keyword
$num_added++;
$sql2 = sprintf ('INSERT INTO `%s` (`id`, `keyword`, `num_keyword`, `s_sg_m_1`, `s_sg_m_4`, `s_sg_m_3`, `s_sg_m_2`, `s_sg_f_1`, `s_sg_f_4`, `s_sg_f_3`, `s_sg_f_2`, `s_sg_n_1`, `s_sg_n_4`, `s_sg_n_3`, `s_sg_n_2`, `s_pl_m_1`, `s_pl_m_4`, `s_pl_m_3`, `s_pl_m_2`, `s_pl_f_1`, `s_pl_f_4`, `s_pl_f_3`, `s_pl_f_2`, `s_pl_n_1`, `s_pl_n_4`, `s_pl_n_3`, `s_pl_n_2`, `v_sg_m_1`, `v_sg_m_4`, `v_sg_m_3`, `v_sg_m_2`, `v_sg_f_1`, `v_sg_f_4`, `v_sg_f_3`, `v_sg_f_2`, `v_sg_n_1`, `v_sg_n_4`, `v_sg_n_3`, `v_sg_n_2`, `v_pl_m_1`, `v_pl_m_4`, `v_pl_m_3`, `v_pl_m_2`, `v_pl_f_1`, `v_pl_f_4`, `v_pl_f_3`, `v_pl_f_2`, `v_pl_n_1`, `v_pl_n_4`, `v_pl_n_3`, `v_pl_n_2`) VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)',
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
	quate_smart($v_pl_n_2));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
}
}
}
?>
