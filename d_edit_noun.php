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
ini_set('arg_separator.output','&amp;');
include './start.php';
include './head_s.php'; 
//php lock
$dict_keyword = 'ds_1_headword';
$oop_lock = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$sql = sprintf ('SELECT `LOCK_KEY`, `LOCK_EXPIRY_TIME` FROM `%s` WHERE `keyword` = %s AND `num_keyword` = %s',
	$dict_keyword,					
	quate_smart($_SESSION["d_h"]),
	quate_smart($_SESSION["d_h_n"]));
$oop_lock->Setnames();							
$oop_lock->query($sql);
$lock= $oop_lock->fetchRow ();
$oop_lock->freeResult();
$time_now=date("Y-m-d H:i:s");
if ($lock[0]!=0) {
if ($_SESSION["id_user"]!=$lock[0]) {
if ($lock[1]>=$time_now) {
$_SESSION["ses_message"].=$lang_lock1.$lock[1];
$location = 'Location: ./search.php?list_kind=alpha&amp;d_h='.$_SESSION["d_h"].'&amp;d_h_n='.$_SESSION["d_h_n"].'';
header($location);
Die();
}}}
$sql = sprintf ('UPDATE `%s` SET `LOCK_KEY` = %s, `LOCK_EXPIRY_TIME` = ADDTIME(NOW(),"00:10:00") WHERE `keyword` = %s AND `num_keyword` = %s',
	$dict_keyword,					
	quate_smart($_SESSION["id_user"]),
	quate_smart($_SESSION["d_h"]),
	quate_smart($_SESSION["d_h_n"]));
$oop_lock->Setnames();							
$oop_lock->query($sql);
$oop_lock->freeResult();
$oop_lock->_mySQL;
//end php lock
if ($_GET["action"]=='confirm') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
if ($_POST["submit_direct"]) {
$table = 'ds_dec_noun';
$sql = sprintf ('UPDATE `%s` SET `sg_ag_1` = %s, `sg_ag_4` = %s, `sg_ag_3` = %s, `sg_ag_2` = %s, `sg_g_1` = %s, `sg_g_4` = %s, `sg_g_3` = %s, `sg_g_2` = %s, `pl_ag_1` = %s, `pl_ag_4` = %s, `pl_ag_3` = %s, `pl_ag_2` = %s, `pl_g_1` = %s, `pl_g_4` = %s, `pl_g_3` = %s, `pl_g_2` = %s WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$table,					
	quate_smart($_POST["sg_ag_1"]),
	quate_smart($_POST["sg_ag_4"]),
	quate_smart($_POST["sg_ag_3"]),
	quate_smart($_POST["sg_ag_2"]),
	quate_smart($_POST["sg_g_1"]),
	quate_smart($_POST["sg_g_4"]),
	quate_smart($_POST["sg_g_3"]),
	quate_smart($_POST["sg_g_2"]),
	quate_smart($_POST["pl_ag_1"]),
	quate_smart($_POST["pl_ag_4"]),
	quate_smart($_POST["pl_ag_3"]),
	quate_smart($_POST["pl_ag_2"]),
	quate_smart($_POST["pl_g_1"]),
	quate_smart($_POST["pl_g_4"]),
	quate_smart($_POST["pl_g_3"]),
	quate_smart($_POST["pl_g_2"]),
	$collation_1,
	quate_smart($_POST["keyword"]),
	quate_smart($_POST["num_keyword"])); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$oop->_mySQL;
$page_id = 120; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
include './work.php';
$_SESSION["ses_message"].=$lang_dec_noun1;
$location = 'Location: ./d_edit_noun.php?d_h='.$_POST["keyword"].'&d_h_n='.$_POST["num_keyword"];
header($location);
} 
} else if ($_GET["action"]=='nextword') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop3 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop4 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$page_id = 101; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
$table = 'ds_dec_noun';
$table_declination='ds_wordform';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table_declination,
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]));
$oop->Setnames();
$oop->query($sql2);
$oop->freeResult();
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table,
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]));
$oop->Setnames();
$oop->query($sql);
$num89 = $oop->getNumRows();
$returned = $oop->fetchArray();
foreach ($returned as &$value) {
$pos = strpos($value, ',');	
if (($value!='') AND !(is_numeric($value))) {
if ($pos!==FALSE) {
$more_words = explode (',', $value);
foreach ($more_words as &$value) {
$sql3 = sprintf ('SELECT `id` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s AND `word_form` COLLATE `%s` = %s',
	$table_declination,
	$collation_1,
	quate_smart($returned[1]),
	quate_smart($returned[2]),
	$collation_1,
	quate_smart($value));
$oop3->Setnames();
$oop3->query($sql3);	
$num1 = $oop3->getNumRows();
if ($num1==0) {
$num_added++;
$sql4= sprintf ('INSERT INTO `%s` (`id`, `keyword`, `num_keyword`, `word_form`) VALUES (NULL, %s, %s, %s)',
	$table_declination,
	quate_smart($returned[1]),
	quate_smart($returned[2]),
	quate_smart($value));
$oop4->Setnames();
$oop4->query($sql4);
$oop4->freeResult();
}
}
} else {
$sql3 = sprintf ('SELECT `id` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s AND `word_form` COLLATE `%s` = %s',
	$table_declination,
	$collation_1,
	quate_smart($returned[1]),
	quate_smart($returned[2]),
	$collation_1,
	quate_smart($value));
$oop3->Setnames();
$oop3->query($sql3);	
$num1 = $oop3->getNumRows();
if ($num1==0) {
$num_added++;
$sql4= sprintf ('INSERT INTO `%s` (`id`, `keyword`, `num_keyword`, `word_form`) VALUES (NULL, %s, %s, %s)',
	$table_declination,
	quate_smart($returned[1]),
	quate_smart($returned[2]),
	quate_smart($value));
$oop4->Setnames();
$oop4->query($sql4);
$oop4->freeResult();
}
$oop3->freeResult();	
}
}
}
$oop->freeResult();
$oop->_mySQL;
$oop3->_mySQL;
$oop4->_mySQL;
$page_id = 121; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
include './work.php';
if ($_GET["d_h_n"]==0) {
$_SESSION["ses_message"]=$lang_dec_noun2.''.$_GET["d_h"].''.$lang_dec_noun3;
} else {
$_SESSION["ses_message"]=$lang_dec_noun2.'<sup>'.$_GET["d_h_n"].'</sup>'.$_GET["d_h"].''.$lang_dec_noun3;	
}
$location = 'Location: ./search.php?list_kind=alpha';
header($location);
} else if ($_GET["action"]=='add') {
$view_keyword = $_GET["d_h"];
$view_num_keyword = $_GET["d_h_n"];
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop3 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$dict_keyword='ds_1_headword';
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$dict_keyword,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop->Setnames();
$oop->query($sql);
$returned = $oop->fetchRow ();
$save=FALSE; $found_pattern=FALSE;
$ary[] = "UTF-8";
$ary[] = "ASCII";
mb_detect_order($ary);
mb_internal_encoding("UTF-8");
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
// N (-s, -)
if (($returned[7]=='n') AND ($returned[8]=='(-s, -)'))
{ $save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -1);
if ($last_1 == 'i') {
$sg_ag_1=$returned[1];
$sg_ag_4=$returned[1];
$sg_ag_3=$returned[1];
$sg_ag_2=$returned[1].'s';
$sg_g_1=$newstring.'ið';
$sg_g_4=$newstring.'ið';
$sg_g_3=$returned[1].'nu';
$sg_g_2=$returned[1].'sins';
$pl_ag_1=$returned[1];
$pl_ag_4=$returned[1];
$pl_ag_3=$newstring.'um';
$pl_ag_2=$newstring.'a';
$pl_g_1=$newstring.'in';
$pl_g_4=$newstring.'in';
$pl_g_3=$newstring.'unum';
$pl_g_2=$newstring.'anna';	
}
else 
{
$sg_ag_1=$returned[1];
$sg_ag_4=$returned[1];
$sg_ag_3=$returned[1].'i';
$sg_ag_2=$returned[1].'s';
$sg_g_1=$returned[1].'ið';
$sg_g_4=$returned[1].'ið';
$sg_g_3=$returned[1].'inu';
$sg_g_2=$returned[1].'sins';
$pl_ag_1=$returned[1];
$pl_ag_4=$returned[1];
$pl_ag_3=$returned[1].'um';
$pl_ag_2=$returned[1].'a';
$pl_g_1=$returned[1].'in';
$pl_g_4=$returned[1].'in';
$pl_g_3=$returned[1].'unum';
$pl_g_2=$returned[1].'anna';
}
} // end of n (-s, -)
// N (-s)
if (($returned[7]=='n') AND ($returned[8]=='(-s)'))
{$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -1);
if ($last_1 == 'i') {
$sg_ag_1=$returned[1];
$sg_ag_4=$returned[1];
$sg_ag_3=$returned[1];
$sg_ag_2=$returned[1].'s';
$sg_g_1=$newstring.'ið';
$sg_g_4=$newstring.'ið';
$sg_g_3=$returned[1].'nu';
$sg_g_2=$returned[1].'sins';
$pl_ag_1='';
$pl_ag_4='';
$pl_ag_3='';
$pl_ag_2='';
$pl_g_1='';
$pl_g_4='';
$pl_g_3='';
$pl_g_2='';	
}
else 
{
$sg_ag_1=$returned[1];
$sg_ag_4=$returned[1];
$sg_ag_3=$returned[1].'i';
$sg_ag_2=$returned[1].'s';
$sg_g_1=$returned[1].'ið';
$sg_g_4=$returned[1].'ið';
$sg_g_3=$returned[1].'inu';
$sg_g_2=$returned[1].'sins';
$pl_ag_1='';
$pl_ag_4='';
$pl_ag_3='';
$pl_ag_2='';
$pl_g_1='';
$pl_g_4='';
$pl_g_3='';
$pl_g_2='';
}
} // end of n (-s)
// N (-A, -U) 
if (($returned[7]=='n') AND ($returned[8]=='(-a, -u)'))
{ $save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -1);
$sg_ag_1=$returned[1];
$sg_ag_4=$returned[1];
$sg_ag_3=$returned[1];
$sg_ag_2=$returned[1];
$sg_g_1=$newstring.'að';
$sg_g_4=$newstring.'að';
$sg_g_3=$returned[1].'nu';
$sg_g_2=$returned[1].'ns';
$pl_ag_1=$newstring.'u';
$pl_ag_4=$newstring.'u';
$pl_ag_3=$newstring.'um';
$pl_ag_2=$newstring.'na';
$pl_g_1=$newstring.'un';
$pl_g_4=$newstring.'un';
$pl_g_3=$newstring.'unum';
$pl_g_2=$newstring.'nanna';	
} // end of n (-a, -u)
if (($returned[7]=='n') AND ($returned[8]=='(-lags, -lög)'))
{ $save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -3);
$sg_ag_1=$newstring.'lag';
$sg_ag_4=$newstring.'lag';
$sg_ag_3=$newstring.'lagi';
$sg_ag_2=$newstring.'lags';
$sg_g_1=$newstring.'lagið';
$sg_g_4=$newstring.'lagið';
$sg_g_3=$newstring.'laginu';
$sg_g_2=$newstring.'lagsins';
$pl_ag_1=$newstring.'lög';
$pl_ag_4=$newstring.'lög';
$pl_ag_3=$newstring.'lögum';
$pl_ag_2=$newstring.'laga';
$pl_g_1=$newstring.'lögin';
$pl_g_4=$newstring.'lögin';
$pl_g_3=$newstring.'lögunum';
$pl_g_2=$newstring.'laganna';	
}
// N pl
if (($returned[7]=='n') AND ($returned[8]=='pl'))
{ $save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -1);
if ($last_1 != 'i') {
$sg_ag_1='';
$sg_ag_4='';
$sg_ag_3='';
$sg_ag_2='';
$sg_g_1='';;
$sg_g_4='';
$sg_g_3='';
$sg_g_2='';
$pl_ag_1=$returned[1];
$pl_ag_4=$returned[1];
$pl_ag_3=$returned[1].'um';
$pl_ag_2=$returned[1].'a';
$pl_g_1=$returned[1].'in';
$pl_g_4=$returned[1].'in';
$pl_g_3=$returned[1].'unum';
$pl_g_2=$returned[1].'anna';
} else {
$sg_ag_1='';
$sg_ag_4='';
$sg_ag_3='';
$sg_ag_2='';
$sg_g_1='';;
$sg_g_4='';
$sg_g_3='';
$sg_g_2='';
$pl_ag_1=$returned[1];
$pl_ag_4=$returned[1];
$pl_ag_3=$newstring.'um';
$pl_ag_2=$newstring.'a';
$pl_g_1=$newstring.'in';
$pl_g_4=$newstring.'in';
$pl_g_3=$newstring.'unum';
$pl_g_2=$newstring.'anna';
} // end of n pl
}
// m (-s, -ar)
if (($returned[7]=='m') AND ($returned[8]=='(-s, -ar)'))
{ $save=TRUE; $found_pattern=TRUE;
if ($last_5 == 'dagur') {
$newstring = mb_substr($returned[1], 0, -5);
// dagur
$sg_ag_1=$newstring.'dagur';
$sg_ag_4=$newstring.'dag';
$sg_ag_3=$newstring.'degi';
$sg_ag_2=$newstring.'dags';
$sg_g_1=$newstring.'dagurinn';
$sg_g_4=$newstring.'daginn';
$sg_g_3=$newstring.'deginum';
$sg_g_2=$newstring.'dagsins';
$pl_ag_1=$newstring.'dagar';
$pl_ag_4=$newstring.'daga';
$pl_ag_3=$newstring.'dögum';
$pl_ag_2=$newstring.'daga';
$pl_g_1=$newstring.'dagarnir';
$pl_g_4=$newstring.'dagana';
$pl_g_3=$newstring.'dögunum';
$pl_g_2=$newstring.'daganna';
} else if ($last_2 == 'ur') {
$newstring = mb_substr($returned[1], 0, -2);	
//hestur	
$sg_ag_1=$newstring.'ur';
$sg_ag_4=$newstring;
$sg_ag_3=$newstring.'i';
$sg_ag_2=$newstring.'s';
$sg_g_1=$newstring.'urinn';
$sg_g_4=$newstring.'inn';
$sg_g_3=$newstring.'inum';
$sg_g_2=$newstring.'sins';
$pl_ag_1=$newstring.'ar';
$pl_ag_4=$newstring.'a';
$pl_ag_3=$newstring.'um';
$pl_ag_2=$newstring.'a';
$pl_g_1=$newstring.'arnir';
$pl_g_4=$newstring.'ana';
$pl_g_3=$newstring.'unum';
$pl_g_2=$newstring.'anna';	
} else if ($last_2 == 'nn') {
$newstring = mb_substr($returned[1], 0, -2);	
$sg_ag_1=$newstring.'nn';
$sg_ag_4=$newstring.'n';
$sg_ag_3=$newstring.'ni';
$sg_ag_2=$newstring.'ns';
$sg_g_1=$newstring.'nninn';
$sg_g_4=$newstring.'ninn';
$sg_g_3=$newstring.'ninum';
$sg_g_2=$newstring.'nsins';
$pl_ag_1=$newstring.'nar';
$pl_ag_4=$newstring.'na';
$pl_ag_3=$newstring.'num';
$pl_ag_2=$newstring.'na';
$pl_g_1=$newstring.'narnir';
$pl_g_4=$newstring.'nana';
$pl_g_3=$newstring.'nunum';
$pl_g_2=$newstring.'nanna';	
} else {
// vagn
$sg_ag_1=$returned[1];
$sg_ag_4=$returned[1];
$sg_ag_3=$returned[1].'i';
$sg_ag_2=$returned[1].'s';
$sg_g_1=$returned[1].'inn';
$sg_g_4=$returned[1].'inn';
$sg_g_3=$returned[1].'inum';
$sg_g_2=$returned[1].'sins';
$pl_ag_1=$returned[1].'ar';
$pl_ag_4=$returned[1].'a';
$pl_ag_3=$returned[1].'um';
$pl_ag_2=$returned[1].'a';
$pl_g_1=$returned[1].'arnir';
$pl_g_4=$returned[1].'ana';
$pl_g_3=$returned[1].'unum';
$pl_g_2=$returned[1].'anna';
}
} // end of m (-s, -ar)
// m (-anda, -endur)
if (($returned[7]=='m') AND ($returned[8]=='(-anda, -endur)'))
{ $save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -4);
$sg_ag_1=$newstring.'andi';
$sg_ag_4=$newstring.'anda';
$sg_ag_3=$newstring.'anda';
$sg_ag_2=$newstring.'anda';
$sg_g_1=$newstring.'andinn';
$sg_g_4=$newstring.'andann';
$sg_g_3=$newstring.'andanum';
$sg_g_2=$newstring.'andans';
$pl_ag_1=$newstring.'endur';
$pl_ag_4=$newstring.'endur';
$pl_ag_3=$newstring.'endum';
$pl_ag_2=$newstring.'enda';
$pl_g_1=$newstring.'endurnir';
$pl_g_4=$newstring.'endurna';
$pl_g_3=$newstring.'endunum';
$pl_g_2=$newstring.'endanna';	
} // end of m (-anda, -endur)
// m (-ar)
if (($returned[7]=='m') AND ($returned[8]=='(-ar)'))
{ $save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -2);
$sg_ag_1=$newstring.'ur';
$sg_ag_4=$newstring;
$sg_ag_3=$newstring;
$sg_ag_2=$newstring.'ar';
$sg_g_1=$newstring.'urinn';
$sg_g_4=$newstring.'inn';
$sg_g_3=$newstring.'num';
$sg_g_2=$newstring.'arins';
$pl_ag_1='';
$pl_ag_4='';
$pl_ag_3='';
$pl_ag_2='';
$pl_g_1='';
$pl_g_4='';
$pl_g_3='';
$pl_g_2='';	
} // end of m (-ar)
// m (-a)
if (($returned[7]=='m') AND ($returned[8]=='(-a)'))
{ $save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -1);
$sg_ag_1=$newstring.'i';
$sg_ag_4=$newstring.'a';
$sg_ag_3=$newstring.'a';
$sg_ag_2=$newstring.'a';
$sg_g_1=$newstring.'inn';
$sg_g_4=$newstring.'ann';
$sg_g_3=$newstring.'anum';
$sg_g_2=$newstring.'ans';
$pl_ag_1='';
$pl_ag_4='';
$pl_ag_3='';
$pl_ag_2='';
$pl_g_1='';
$pl_g_4='';
$pl_g_3='';
$pl_g_2='';	
} // end of m (-a)
// m (-s)
if (($returned[7]=='m') AND ($returned[8]=='(-s)'))
{ $save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -2);
$sg_ag_1=$newstring.'ur';
$sg_ag_4=$newstring;
$sg_ag_3=$newstring.'i';
$sg_ag_2=$newstring.'s';
$sg_g_1=$newstring.'urinn';
$sg_g_4=$newstring.'inn';
$sg_g_3=$newstring.'inum';
$sg_g_2=$newstring.'sins';
$pl_ag_1='';
$pl_ag_4='';
$pl_ag_3='';
$pl_ag_2='';
$pl_g_1='';
$pl_g_4='';
$pl_g_3='';
$pl_g_2='';	
} // end of m (-s)
// m (-is)
if (($returned[7]=='m') AND ($returned[8]=='(-is)'))
{ $save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -2);
$sg_ag_1=$newstring.'ir';
$sg_ag_4=$newstring.'i';
$sg_ag_3=$newstring.'i';
$sg_ag_2=$newstring.'is';
$sg_g_1=$newstring.'irinn';
$sg_g_4=$newstring.'inn';
$sg_g_3=$newstring.'inum';
$sg_g_2=$newstring.'isins';
$pl_ag_1='';
$pl_ag_4='';
$pl_ag_3='';
$pl_ag_2='';
$pl_g_1='';
$pl_g_4='';
$pl_g_3='';
$pl_g_2='';	
} // end of m (-is)
// m (-manns, -menn)
if (($returned[7]=='m') AND ($returned[8]=='(-manns, -menn)'))
{ $save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -6);
$sg_ag_1=$newstring.'maður';
$sg_ag_4=$newstring.'mann';
$sg_ag_3=$newstring.'manni';
$sg_ag_2=$newstring.'manns';
$sg_g_1=$newstring.'maðurinn';
$sg_g_4=$newstring.'manninn';
$sg_g_3=$newstring.'manninum';
$sg_g_2=$newstring.'mannsins';
$pl_ag_1=$newstring.'menn';
$pl_ag_4=$newstring.'menn';
$pl_ag_3=$newstring.'mönnum';
$pl_ag_2=$newstring.'manna';
$pl_g_1=$newstring.'mennirnir';
$pl_g_4=$newstring.'mennina';
$pl_g_3=$newstring.'mönnunum';
$pl_g_2=$newstring.'mannanna';	
} // end of m (-manns, -menn)
// m (-a, -ar)
if (($returned[7]=='m') AND ($returned[8]=='(-a, -ar)'))
{ $save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -1);
$sg_ag_1=$newstring.'i';
$sg_ag_4=$newstring.'a';
$sg_ag_3=$newstring.'a';
$sg_ag_2=$newstring.'a';
$sg_g_1=$newstring.'inn';
$sg_g_4=$newstring.'ann';
$sg_g_3=$newstring.'anum';
$sg_g_2=$newstring.'ans';
$pl_ag_1=$newstring.'ar';
$pl_ag_4=$newstring.'a';
// pl an greinis dativ
if ($char[$num-3]=='a') {
$helpstring = mb_substr($returned[1], 0, -3);	
$pl_ag_3=$helpstring.'ö'.$char[$num-2].'um';
} else  if (($char[$num-4]=='a') AND ($char[$num-4].$char[$num-3]!='au')){
$helpstring = mb_substr($returned[1], 0, -4);	
$pl_ag_3=$helpstring.'ö'.$char[$num-3].$char[$num-2].'um';
} else {
$pl_ag_3=$newstring.'um';
}
$pl_ag_2=$newstring.'a';
$pl_g_1=$newstring.'arnir';
$pl_g_4=$newstring.'ana';
// pl med greinum dativ
if ($char[$num-3]=='a') {
$helpstring = mb_substr($returned[1], 0, -3);	
$pl_g_3=$helpstring.'ö'.$char[$num-2].'unum';
} else  if (($char[$num-4]=='a') AND ($char[$num-4].$char[$num-3]!='au')){
$helpstring = mb_substr($returned[1], 0, -4);	
$pl_g_3=$helpstring.'ö'.$char[$num-3].$char[$num-2].'unum';
} else {
$pl_g_3=$newstring.'unum';
}
$pl_g_2=$newstring.'anna';	
} // end of m (-a, -ar)
// m (-ja, -jar)
if (($returned[7]=='m') AND ($returned[8]=='(-ja, -jar)'))
{ $save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -1);
$sg_ag_1=$newstring.'i';
$sg_ag_4=$newstring.'ja';
$sg_ag_3=$newstring.'ja';
$sg_ag_2=$newstring.'ja';
$sg_g_1=$newstring.'inn';
$sg_g_4=$newstring.'jann';
$sg_g_3=$newstring.'janum';
$sg_g_2=$newstring.'jans';
$pl_ag_1=$newstring.'jar';
$pl_ag_4=$newstring.'ja';
$pl_ag_3=$newstring.'jum';
$pl_ag_2=$newstring.'ja';
$pl_g_1=$newstring.'jarnir';
$pl_g_4=$newstring.'jana';
$pl_g_3=$newstring.'junum';
$pl_g_2=$newstring.'janna';	

} // end of m (-a, -ar)
if (($returned[7]=='m') AND ($returned[8]=='(-a/-ja, -ar/-jar)'))
{$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -1);
$sg_ag_1=$newstring.'i';
$sg_ag_4=$newstring.'a, '.$newstring.'ja';
$sg_ag_3=$newstring.'a, '.$newstring.'ja';
$sg_ag_2=$newstring.'a, '.$newstring.'ja';
$sg_g_1=$newstring.'inn';
$sg_g_4=$newstring.'ann, '.$newstring.'jann';
$sg_g_3=$newstring.'anum, '.$newstring.'janum';
$sg_g_2=$newstring.'ans, '.$newstring.'jans';
$pl_ag_1=$newstring.'ar, '.$newstring.'jar';
$pl_ag_4=$newstring.'a, '.$newstring.'ja';
$pl_ag_3=$newstring.'um, '.$newstring.'jum';
$pl_ag_2=$newstring.'a, '.$newstring.'ja';
$pl_g_1=$newstring.'arnir, '.$newstring.'jarnir';
$pl_g_4=$newstring.'ana, '.$newstring.'jana';
$pl_g_3=$newstring.'unum, '.$newstring.'junum';
$pl_g_2=$newstring.'anna, '.$newstring.'janna';	
} // end of m (-a, -ar)
// höfundur
if (($returned[7]=='m') AND ($returned[8]=='(-ar, -ar)'))
{ $save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -2);
$sg_ag_1=$newstring.'ur';
$sg_ag_4=$newstring.'';
$sg_ag_3=$newstring.'i';
$sg_ag_2=$newstring.'ar';
$sg_g_1=$newstring.'urinn';
$sg_g_4=$newstring.'inn';
$sg_g_3=$newstring.'inum';
$sg_g_2=$newstring.'arins';
$pl_ag_1=$newstring.'ar';
$pl_ag_4=$newstring.'a';
$pl_ag_3=$newstring.'um';
$pl_ag_2=$newstring.'a';
$pl_g_1=$newstring.'arnir';
$pl_g_4=$newstring.'ana';
$pl_g_3=$newstring.'unum';
$pl_g_2=$newstring.'anna';	
} // end of m (-a, -ar)
// m (-ar, -ir)
if (($returned[7]=='m') AND ($returned[8]=='(-ar, -ir)'))
{$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -2);
$sg_ag_1=$newstring.'ur';
$sg_ag_4=$newstring;
$sg_ag_3=$newstring.'i';
$sg_ag_2=$newstring.'ar';
$sg_g_1=$newstring.'urinn';
$sg_g_4=$newstring.'inn';
$sg_g_3=$newstring.'inum';
$sg_g_2=$newstring.'arins';
$pl_ag_1=$newstring.'ir';
$pl_ag_4=$newstring.'i';
$pl_ag_3=$newstring.'um';
$pl_ag_2=$newstring.'a';
$pl_g_1=$newstring.'irnir';
$pl_g_4=$newstring.'ina';
$pl_g_3=$newstring.'unum';
$pl_g_2=$newstring.'anna';	
} // end of m (-ar, -ir)
//m (-urs, -rar) 
if (($returned[7]=='m') AND ($returned[8]=='(-urs, -rar)'))
{ $save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -2);
$sg_ag_1=$newstring.'ur';
$sg_ag_4=$newstring.'ur';
$sg_ag_3=$newstring.'ri';
$sg_ag_2=$newstring.'urs';
$sg_g_1=$newstring.'urinn';
$sg_g_4=$newstring.'urinn';
$sg_g_3=$newstring.'rinum';
$sg_g_2=$newstring.'ursins';
$pl_ag_1=$newstring.'rar';
$pl_ag_4=$newstring.'ra';
$pl_ag_3=$newstring.'rum';
$pl_ag_2=$newstring.'ra';
$pl_g_1=$newstring.'rarnir';
$pl_g_4=$newstring.'rana';
$pl_g_3=$newstring.'runum';
$pl_g_2=$newstring.'ranna';	
} // end of m (-urs, -rar)
if (($returned[7]=='m') AND ($returned[8]=='(-ils, -lar)'))
{ $save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -3);
$sg_ag_1=$newstring.'ill';
$sg_ag_4=$newstring.'il';
$sg_ag_3=$newstring.'li';
$sg_ag_2=$newstring.'ils';
$sg_g_1=$newstring.'illinn';
$sg_g_4=$newstring.'ilinn';
$sg_g_3=$newstring.'linum';
$sg_g_2=$newstring.'ilsins';
$pl_ag_1=$newstring.'lar';
$pl_ag_4=$newstring.'la';
$pl_ag_3=$newstring.'lum';
$pl_ag_2=$newstring.'la';
$pl_g_1=$newstring.'larnir';
$pl_g_4=$newstring.'lana';
$pl_g_3=$newstring.'lunum';
$pl_g_2=$newstring.'lanna';	
} // end of m (-urs, -rar)
// m (-is, -ar)
if (($returned[7]=='m') AND ($returned[8]=='(-is, -ar)'))
{$save=TRUE; $found_pattern=TRUE;
//læknir
$newstring = mb_substr($returned[1], 0, -2);
$sg_ag_1=$newstring.'ir';
$sg_ag_4=$newstring.'i';
$sg_ag_3=$newstring.'i';
$sg_ag_2=$newstring.'is';
$sg_g_1=$newstring.'irinn';
$sg_g_4=$newstring.'inn';
$sg_g_3=$newstring.'inum';
$sg_g_2=$newstring.'isins';
$pl_ag_1=$newstring.'ar';
$pl_ag_4=$newstring.'a';
$pl_ag_3=$newstring.'um';
$pl_ag_2=$newstring.'a';
$pl_g_1=$newstring.'arnir';
$pl_g_4=$newstring.'ana';
$pl_g_3=$newstring.'unum';
$pl_g_2=$newstring.'anna';	
} // end of n (-is, -ar)
// m (-s, -ir)
if (($returned[7]=='m') AND ($returned[8]=='(-s, -ir)'))
{$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -2);
$sg_ag_1=$newstring.'ur';
$sg_ag_4=$newstring;
$sg_ag_3=$newstring.'i';
$sg_ag_2=$newstring.'s';
$sg_g_1=$newstring.'urinn';
$sg_g_4=$newstring.'inn';
$sg_g_3=$newstring.'inum';
$sg_g_2=$newstring.'sins';
$pl_ag_1=$newstring.'ir';
$pl_ag_4=$newstring.'i';
$pl_ag_3=$newstring.'um';
$pl_ag_2=$newstring.'a';
$pl_g_1=$newstring.'irnir';
$pl_g_4=$newstring.'ina';
$pl_g_3=$newstring.'unum';
$pl_g_2=$newstring.'anna';	
} // end of m (-s, -ir)
if (($returned[7]=='m') AND ($returned[8]=='pl'))
{$save=TRUE; $found_pattern=TRUE;
$newstring2 = mb_substr($returned[1], 0, -1);
$newstring = mb_substr($returned[1], 0, -2);
$sg_ag_1='';
$sg_ag_4='';
$sg_ag_3='';
$sg_ag_2='';
$sg_g_1='';
$sg_g_4='';
$sg_g_3='';
$sg_g_2='';
$pl_ag_1=$returned[1];
$pl_ag_4=$newstring2;
$pl_ag_3=$newstring.'um';
$pl_ag_2=$newstring.'a';
$pl_g_1=$returned[1].'nir';
$pl_g_4=$newstring2.'na';
$pl_g_3=$newstring.'unum';
$pl_g_2=$newstring.'anna';	
} // end of m pl
///////////// f (-u, -ur) //////////////////////////
 if (($returned[7]=='f') AND ($returned[8]=='(-u, -ur)'))
{$save=TRUE; $found_pattern=TRUE;
 $newstring = mb_substr($returned[1], 0, -1);
$sg_ag_1=$newstring.'a';
$sg_ag_4=$newstring.'u';
$sg_ag_3=$newstring.'u';
$sg_ag_2=$newstring.'u';
$sg_g_1=$newstring.'an';
$sg_g_4=$newstring.'una';
$sg_g_3=$newstring.'unni';
$sg_g_2=$newstring.'unnar';
$pl_ag_1=$newstring.'ur';
$pl_ag_4=$newstring.'ur';
$pl_ag_3=$newstring.'um';
if (($last_2='da') OR ($last_2='ða') OR ($last_2='fa') OR ($last_3='fla') OR ($last_2='ga') OR ($last_2='ka') OR ($last_3='gja') OR ($last_3='kja') OR ($last_3='gga') OR ($last_3='lla') OR ($last_2='ma') OR ($last_3='nga') OR ($last_3='rla') OR ($last_2='sa') OR ($last_3='sla') OR ($last_3='sta') OR ($last_2='ta')) {
$pl_ag_2=$newstring.'na';
}
else {
$pl_ag_2=$newstring.'a';	
}
$pl_g_1=$newstring.'urnar';
$pl_g_4=$newstring.'urnar';
$pl_g_3=$newstring.'unum';
$pl_g_2=$newstring.'anna';	
} // end of f (-u, -ur)
   ///////////// f (-unar, -anir) //////////////////////////
 if (($returned[7]=='f') AND ($returned[8]=='(-unar, -anir)'))
{$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -2);
$sg_ag_1=$newstring.'un';
$sg_ag_4=$newstring.'un';
$sg_ag_3=$newstring.'un';
$sg_ag_2=$newstring.'unar';
$sg_g_1=$newstring.'unin';
$sg_g_4=$newstring.'unin';
$sg_g_3=$newstring.'uninni';
$sg_g_2=$newstring.'unarinnar';
$pl_ag_1=$newstring.'anir';
$pl_ag_4=$newstring.'anir';
$pl_ag_3=$newstring.'unum';
$pl_ag_2=$newstring.'ana';
$pl_g_1=$newstring.'anirnar';
$pl_g_4=$newstring.'anirnar';
$pl_g_3=$newstring.'ununum';
$pl_g_2=$newstring.'ananna';	
} // end of f (-unar)
if (($returned[7]=='f') AND ($returned[8]=='(-unar)'))
{$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -2);
$sg_ag_1=$newstring.'un';
$sg_ag_4=$newstring.'un';
$sg_ag_3=$newstring.'un';
$sg_ag_2=$newstring.'unar';
$sg_g_1=$newstring.'unin';
$sg_g_4=$newstring.'unin';
$sg_g_3=$newstring.'uninni';
$sg_g_2=$newstring.'unarinnar';
$pl_ag_1='';
$pl_ag_4='';
$pl_ag_3='';
$pl_ag_2='';
$pl_g_1='';
$pl_g_4='';
$pl_g_3='';
$pl_g_2='';	
} // end of f (-unar)
///////////// f (-sögu, -sögur) //////////////////////////
if (($returned[7]=='f') AND ($returned[8]=='(-sögu, -sögur)'))
{$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -4);
$sg_ag_1=$newstring.'saga';
$sg_ag_4=$newstring.'sögu';
$sg_ag_3=$newstring.'sögu';
$sg_ag_2=$newstring.'sögu';
$sg_g_1=$newstring.'sagan';
$sg_g_4=$newstring.'söguna';
$sg_g_3=$newstring.'sögunni';
$sg_g_2=$newstring.'sögunnar';
$pl_ag_1=$newstring.'sögur';
$pl_ag_4=$newstring.'sögur';
$pl_ag_3=$newstring.'sögum';
$pl_ag_2=$newstring.'sagna';
$pl_g_1=$newstring.'sögurnar';
$pl_g_4=$newstring.'sögurnar';
$pl_g_3=$newstring.'sögunum';
$pl_g_2=$newstring.'sagnanna';	
} // end of f (-sögu, -sögur)
///////////// f (-ar, -ir) //////////////////////////
if (($returned[7]=='f') AND ($returned[8]=='(-ar, -ir)'))
{$save=TRUE; $found_pattern=TRUE;
$sg_ag_1=$returned[1];
$sg_ag_4=$returned[1];
$sg_ag_3=$returned[1];
$sg_ag_2=$returned[1].'ar';
$sg_g_1=$returned[1].'in';
$sg_g_4=$returned[1].'ina';
$sg_g_3=$returned[1].'inni';
$sg_g_2=$returned[1].'arinnar';
$pl_ag_1=$returned[1].'ir';
$pl_ag_4=$returned[1].'ir';
$pl_ag_3=$returned[1].'um';
$pl_ag_2=$returned[1].'a';
$pl_g_1=$returned[1].'irnar';
$pl_g_4=$returned[1].'irnar';
$pl_g_3=$returned[1].'unum';
$pl_g_2=$returned[1].'anna';	
} // end of f (-ar, -ir)
if (($returned[7]=='f') AND ($returned[8]=='(-jar, -jar)'))
{$save=TRUE; $found_pattern=TRUE;
$newstring = $returned[1];
$sg_ag_1=$newstring.'';
$sg_ag_4=$newstring.'';
$sg_ag_3=$newstring.'';
$sg_ag_2=$newstring.'jar';
$sg_g_1=$newstring.'in';
$sg_g_4=$newstring.'ina';
$sg_g_3=$newstring.'inni';
$sg_g_2=$newstring.'jarinnar';
$pl_ag_1=$newstring.'jar';
$pl_ag_4=$newstring.'jar';
$pl_ag_3=$newstring.'jum';
$pl_ag_2=$newstring.'ja';
$pl_g_1=$newstring.'jarnar';
$pl_g_4=$newstring.'jarnar';
$pl_g_3=$newstring.'junum';
$pl_g_2=$newstring.'janna';	
} // end of f (-jar, -jar)
///////////// f indecl //////////////////////////
if (($returned[7]=='f') AND ($returned[8]=='indecl'))
{$save=TRUE; $found_pattern=TRUE;
$sg_ag_1=$returned[1];
$sg_ag_4=$returned[1];
$sg_ag_3=$returned[1];
$sg_ag_2=$returned[1];
$sg_g_1=$returned[1].'n';
$sg_g_4=$returned[1].'na';
$sg_g_3=$returned[1].'nni';
$sg_g_2=$returned[1].'nnar';
$pl_ag_1='';
$pl_ag_4='';
$pl_ag_3='';
$pl_ag_2='';
$pl_g_1='';
$pl_g_4='';
$pl_g_3='';
$pl_g_2='';	
} // end of f indecl
///////////// f (-ar) //////////////////////////
if (($returned[7]=='f') AND ($returned[8]=='(-ar)'))
{$save=TRUE; $found_pattern=TRUE;
if ($last_2=='ng') { // kenning ap.
$sg_ag_1=$returned[1];
$sg_ag_4=$returned[1].'u';
$sg_ag_3=$returned[1].'u';
$sg_ag_2=$returned[1].'ar';
$sg_g_1=$returned[1].'in';
$sg_g_4=$returned[1].'una';
$sg_g_3=$returned[1].'unni';
$sg_g_2=$returned[1].'arinnar';
$pl_ag_1= '';
$pl_ag_4='';
$pl_ag_3='';
$pl_ag_2='';
$pl_g_1='';
$pl_g_4='';
$pl_g_3='';
$pl_g_2='';	
} else {
$sg_ag_1=$returned[1];
$sg_ag_4=$returned[1];
$sg_ag_3=$returned[1];
$sg_ag_2=$returned[1].'ar';
$sg_g_1=$returned[1].'in';
$sg_g_4=$returned[1].'ina';
$sg_g_3=$returned[1].'inni';
$sg_g_2=$returned[1].'arinnar';
$pl_ag_1= '';
$pl_ag_4='';
$pl_ag_3='';
$pl_ag_2='';
$pl_g_1='';
$pl_g_4='';
$pl_g_3='';
$pl_g_2='';
}
} // end of f (-ar)
///////////// f (-ar) //////////////////////////
if (($returned[7]=='f') AND ($returned[8]=='(-u)'))
{$save=TRUE; $found_pattern=TRUE;
$newstring = mb_substr($returned[1], 0, -1);
$sg_ag_1=$newstring.'a';
$sg_ag_4=$newstring.'u';
$sg_ag_3=$newstring.'u';
$sg_ag_2=$newstring.'u';
$sg_g_1=$newstring.'an';
$sg_g_4=$newstring.'una';
$sg_g_3=$newstring.'unni';
$sg_g_2=$newstring.'unnar';
$pl_ag_1= '';
$pl_ag_4='';
$pl_ag_3='';
$pl_ag_2='';
$pl_g_1='';
$pl_g_4='';
$pl_g_3='';
$pl_g_2='';	
} // end of f (-u)
///////////// f (-r, -r) //////////////////////////
if (($returned[7]=='f') AND ($returned[8]=='(-r, -r)'))
{$save=TRUE; $found_pattern=TRUE;
$sg_ag_1=$returned[1];
$sg_ag_4=$returned[1];
$sg_ag_3=$returned[1];
$sg_ag_2=$returned[1].'r';
$sg_g_1=$returned[1].'in';
$sg_g_4=$returned[1].'na';
$sg_g_3=$returned[1].'nni';
$sg_g_2=$returned[1].'rinnar';
$pl_ag_1=$returned[1].'r';
$pl_ag_4=$returned[1].'r';
$pl_ag_3=$returned[1].'m';
$pl_ag_2=$returned[1].'a';
$pl_g_1=$returned[1].'rnar';
$pl_g_4=$returned[1].'rnar';
$pl_g_3=$returned[1].'num';
$pl_g_2=$returned[1].'nna';	
} // end of f (-r, -r)
///////////// f (-ar, -ar) //////////////////////////
if (($returned[7]=='f') AND ($returned[8]=='(-ar, -ar)'))
{$save=TRUE; $found_pattern=TRUE;
if ($last_2=='ng') { // kenning ap.
$sg_ag_1=$returned[1].'';
$sg_ag_4=$returned[1].'u';
$sg_ag_3=$returned[1].'u';
$sg_ag_2=$returned[1].'ar';
$sg_g_1=$returned[1].'in';
$sg_g_4=$returned[1].'una';
$sg_g_3=$returned[1].'unni';
$sg_g_2=$returned[1].'arinnar';
$pl_ag_1=$returned[1].'ar';
$pl_ag_4=$returned[1].'ar';
$pl_ag_3=$returned[1].'um';
$pl_ag_2=$returned[1].'a';
$pl_g_1=$returned[1].'arnar';
$pl_g_4=$returned[1].'arnar';
$pl_g_3=$returned[1].'unum';
$pl_g_2=$returned[1].'anna';	
} 
else 
{ 		 /// vél ap.
$sg_ag_1=$returned[1].'';
$sg_ag_4=$returned[1].'';
$sg_ag_3=$returned[1].'';
$sg_ag_2=$returned[1].'ar';
$sg_g_1=$returned[1].'in';
$sg_g_4=$returned[1].'ina';
$sg_g_3=$returned[1].'inni';
$sg_g_2=$returned[1].'arinnar';
$pl_ag_1=$returned[1].'ar';
$pl_ag_4=$returned[1].'ar';
$pl_ag_3=$returned[1].'um';
$pl_ag_2=$returned[1].'a';
$pl_g_1=$returned[1].'arnar';
$pl_g_4=$returned[1].'arnar';
$pl_g_3=$returned[1].'unum';
$pl_g_2=$returned[1].'anna';
}
} // end of f (-ar, -ar)
if (($returned[7]=='f') AND ($returned[8]=='pl'))
{$save=TRUE; $found_pattern=TRUE;
if ($last_2=='ar') { // kenning ap.
$zero='';
$sg_ag_1=$zero;
$sg_ag_4=$zero;
$sg_ag_3=$zero;
$sg_ag_2=$zero;
$sg_g_1=$zero;
$sg_g_4=$zero;
$sg_g_3=$zero;
$sg_g_2=$zero;
$pl_ag_1=$returned[1].'ar';
$pl_ag_4=$returned[1].'ar';
$pl_ag_3=$returned[1].'um';
$pl_ag_2=$returned[1].'a';
$pl_g_1=$returned[1].'arnar';
$pl_g_4=$returned[1].'arnar';
$pl_g_3=$returned[1].'unum';
$pl_g_2=$returned[1].'anna';	
} 
else 
{ 		 /// vél ap.
$sg_ag_1=$zero;
$sg_ag_4=$zero;
$sg_ag_3=$zero;
$sg_ag_2=$zero;
$sg_g_1=$zero;
$sg_g_4=$zero;
$sg_g_3=$zero;
$sg_g_2=$zero;
$pl_ag_1=$returned[1].'ir';
$pl_ag_4=$returned[1].'ir';
$pl_ag_3=$returned[1].'um';
$pl_ag_2=$returned[1].'a';
$pl_g_1=$returned[1].'irnar';
$pl_g_4=$returned[1].'irnar';
$pl_g_3=$returned[1].'unum';
$pl_g_2=$returned[1].'anna';
}
} // end of f (-ar, -ar)
if (($_GET["generate"]=='no') AND ($found_pattern===FALSE)) {
$save=TRUE; $found_pattern=TRUE;
$sg_ag_1='';
$sg_ag_4='';
$sg_ag_3='';
$sg_ag_2='';
$sg_g_1='';
$sg_g_4='';
$sg_g_3='';
$sg_g_2='';
$pl_ag_1='';
$pl_ag_4='';
$pl_ag_3='';
$pl_ag_2='';
$pl_g_1='';
$pl_g_4='';
$pl_g_3='';
$pl_g_2='';
	
}

// if not found pattern we fill at least with the keyword
if ($found_pattern===FALSE) {
$save=TRUE;
$sg_ag_1=$returned[1];
$sg_ag_4=$returned[1];
$sg_ag_3=$returned[1];
$sg_ag_2=$returned[1];
$sg_g_1=$returned[1];
$sg_g_4=$returned[1];
$sg_g_3=$returned[1];
$sg_g_2=$returned[1];
$pl_ag_1=$returned[1];
$pl_ag_4=$returned[1];
$pl_ag_3=$returned[1];
$pl_ag_2=$returned[1];
$pl_g_1=$returned[1];
$pl_g_4=$returned[1];
$pl_g_3=$returned[1];
$pl_g_2=$returned[1];
} // end of filling 
$table2 = 'ds_dec_noun';
// check if the keyword does not already exists in database
$sql = sprintf ('SELECT `keyword` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`=%s',
	$table2,
	$collation_1,
	quate_smart($returned[1]),
	quate_smart($returned[2]));
$oop3->Setnames();
$oop3->query($sql);
$number = $oop3->getNumrows(); 
$oop3->freeResult();
if ($number==0) {
$sql2 = sprintf ('INSERT INTO `%s` (`id`, `keyword`, `num_keyword`, `sg_ag_1`, `sg_ag_4`, `sg_ag_3`, `sg_ag_2`, `sg_g_1`, `sg_g_4`, `sg_g_3`, `sg_g_2`, `pl_ag_1`, `pl_ag_4`, `pl_ag_3`, `pl_ag_2`, `pl_g_1`, `pl_g_4`, `pl_g_3`, `pl_g_2`) VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)',
	$table2,					
	quate_smart($returned[1]),
	quate_smart($returned[2]),
	quate_smart($sg_ag_1),
	quate_smart($sg_ag_4),
	quate_smart($sg_ag_3),
	quate_smart($sg_ag_2),
	quate_smart($sg_g_1),
	quate_smart($sg_g_4),
	quate_smart($sg_g_3),
	quate_smart($sg_g_2),
	quate_smart($pl_ag_1),
	quate_smart($pl_ag_4),
	quate_smart($pl_ag_3),
	quate_smart($pl_ag_2),
	quate_smart($pl_g_1),
	quate_smart($pl_g_4),
	quate_smart($pl_g_3),
	quate_smart($pl_g_2));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$oop->freeResult();
$oop->_mySQL;
$page_id = 122; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
include './work.php';
if ($view_num_keyword!=0) {
$_SESSION["ses_message"]=$lang_dec_noun2.'<sup>'.$view_num_keyword.'</sup> '.$view_keyword.''.$lang_dec_adj10;
} else {
$_SESSION["ses_message"]=$lang_dec_noun2.''.$view_keyword.' '.$lang_dec_adj10;	
}
$location = 'Location: ./d_edit_noun.php?d_h='.$view_keyword.'&d_h_n='.$view_num_keyword.'';
header($location);
} else {
if ($view_num_keyword!=0) {	
$_SESSION["ses_message"]=$lang_dec_noun2.'<sup>'.$view_num_keyword.'</sup>'.$view_keyword.''.$lang_dec_adj11;
} else {
$_SESSION["ses_message"]=$lang_dec_noun2.' '.$view_keyword.''.$lang_dec_adj11;
}
$location = 'Location: ./search.php?list_kind=alpha';
header($location);	
}
} else if ($_GET["action"]=='delete'){
if ($_GET["del"]=='TRUE') {
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$view_keyword=$_GET["d_h"];
$view_num_keyword=$_GET["d_h_n"];
$table2 = 'ds_dec_noun';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$table_declination='ds_wordform';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table_declination,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$page_id = 123; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
include './work.php';
if ($view_num_keyword!=0) {
$_SESSION["ses_message"]=$lang_dec_noun4.'<sup>'.$view_num_keyword.'</sup>'.$view_keyword.''.$lang_dec_noun5;
} else {
$_SESSION["ses_message"]=$lang_dec_noun4.$view_keyword.$lang_dec_noun5;
}
$location = 'Location: ./search.php?list_kind=alpha';
header($location);
} else {
?>
</head>
<body onload="setfocus ()">
<div id="wrapper">
<?php include './header.php'; 
$menuleft=TRUE;
include 'menu.php'; 
echo $MAIN_MENU;
?>
<div id="content">
<div class="left_huge">
<h2><?=$lang_dec_noun6?> 
<?php if ($_GET["d_h_n"]!=0) {
echo "<sup>".$_GET["d_h_n"]."</sup>";
} 
echo $_GET["d_h"];	 
?></h2>
<?php
echo $lang_dec_noun7."<br>";
echo " <a href=\"./d_edit_noun.php?action=delete&del=TRUE&d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\"> ".$lang_edit_del_yes." </a>";
echo "<a href=\"./search.php?d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\"> ".$lang_edit_del_no." </a> <br>";
?>
</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div>
<?	
}
}	
else  
{
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop9 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table='ds_dec_noun';
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`=%s',
	$table,
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]));
$oop->Setnames();
$oop->query($sql);
$returned = $oop->fetchRow ();
$oop->freeResult();
$oop->_mySQL;
?>
<script type="text/javascript">
function setFocus2()
{
document.getElementById("sg_ag_1").focus();
}
</script>
</head>
<body onload="setfocus ()">
<div id="wrapper">
<?php include './header.php'; 
include './menu.php'; 
echo $MAIN_MENU;
?>
<form action="./d_edit_noun.php?action=confirm&d_h=<?=$_GET["d_h"]?>&d_h_n=<?=$_GET["d_h_n"]?>" method="post" name="form">
<div id="content">
<div class="left_huge">
<h2><?=$lang_dec_noun6?> 
<?php if ($_GET["d_h_n"]!=0) {
echo "<sup>".$_GET["d_h_n"]."</sup>";
} 
echo $_GET["d_h"];	 
?></h2>
<?php
$BUFFER_MENU='';
$BUFFER_MENU .= "<div class=\"menu_sub\">";
$BUFFER_MENU .= "<ul>"; 
$BUFFER_MENU .= "<li><input type=\"submit\" class=\"button3\" name=\"submit_direct\" value=\"".$lang_edit_submit."\"></li>";
$BUFFER_MENU .= "<li><a href=\"./d_edit_noun.php?action=nextword&correct=1&d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\">".$lang_declination_saving."</a></li>";
$BUFFER_MENU .= "<li><a href=\"./search.php?d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\">".$lang_back2."</a></li>";
$BUFFER_MENU .= "<li><a href= \"http://bin.arnastofnun.is/leit.php?q=".$_GET["d_h"]." \" onclick= \"return popitup('http://bin.arnastofnun.is/leit.php?q=".$_GET["d_h"]."') \">".$lang_declination_bin."</a></li>";
$BUFFER_MENU .= "</ul>";	
$BUFFER_MENU .= "</div>";	
echo $BUFFER_MENU;
$keyword = $returned[1]; $keyword_new=$returned[1];
?>
<input type="hidden" id="keyword" name="keyword" value="<?php echo $returned[1];?>">
<?php
$num_keyword = $returned[2]; $num_keyword_new=$returned[2];
?>
<input type="hidden" id="num_keyword" name="num_keyword" value="<?php echo $returned[2];?>">
<table class="sample">
<tr><th colspan="8"><?=$lang_dec_noun8?></th></tr>
<tr><th colspan="3" align="center"><?=$lang_declination_singular?></th><th colspan="3" align="center"><?=$lang_declination_plural?></th></tr>
<td width="10%"></td>
<td align="center" width="20%"><?=$lang_declination_without_article?></td>
<td align="center" width="20%"><?=$lang_declination_with_article?></td>
<td width="10%"></td>
<td align="center" width="20%"><?=$lang_declination_without_article?></td>
<td align="center" width="20%"><?=$lang_declination_with_article?></td>
</tr>
<tr>
<td><?=$lang_declination_1_case?></td>
<td>
<input type="text" class="inputbox_small" id="sg_ag_1" onBlur="lasttext=this;" name="sg_ag_1" size="20" maxlength="80" value="<?=$returned[5];?>"></td>
<td>
<input type="text" class="inputbox_small" id="sg_g_1" onBlur="lasttext=this;" name="sg_g_1" size="20" maxlength="80" value="<?=$returned[9];?>"></td>
<td><?=$lang_declination_1_case?></td>
<td>
<input type="text" class="inputbox_small" id="pl_ag_1" onBlur="lasttext=this;" name="pl_ag_1" size="20" maxlength="80" value="<?=$returned[13];?>">
</td>
<td>
<input type="text" class="inputbox_small" id="pl_g_1" onBlur="lasttext=this;" name="pl_g_1" size="20" maxlength="80" value="<?=$returned[17];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_4_case?></td>
<td>
<input type="text" class="inputbox_small" id="sg_ag_4" onBlur="lasttext=this;" name="sg_ag_4" size="20" maxlength="80" value="<?=$returned[6];?>"></td>
<td>
<input type="text" class="inputbox_small" id="sg_g_4" onBlur="lasttext=this;" name="sg_g_4" size="20" maxlength="80" value="<?=$returned[10];?>"></td>
<td><?=$lang_declination_4_case?></td>
<td>
<input type="text" class="inputbox_small" id="pl_ag_4" onBlur="lasttext=this;" name="pl_ag_4" size="20" maxlength="80" value="<?=$returned[14];?>"></td>
<td>
<input type="text" class="inputbox_small" id="pl_g_4" onBlur="lasttext=this;" name="pl_g_4" size="20" maxlength="80" value="<?=$returned[18];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_3_case?></td>
<td>
<input type="text" class="inputbox_small" id="sg_ag_3" onBlur="lasttext=this;" name="sg_ag_3" size="20" maxlength="80" value="<?=$returned[7];?>"></td>
<td>
<input type="text" class="inputbox_small" id="sg_g_3" onBlur="lasttext=this;" name="sg_g_3" size="20" maxlength="80" value="<?=$returned[11];?>"></td>
<td><?=$lang_declination_3_case?></td>
<td>
<input type="text" class="inputbox_small" id="pl_ag_3" onBlur="lasttext=this;" name="pl_ag_3" size="20" maxlength="80" value="<?=$returned[15];?>"></td>
<td>
<input type="text" class="inputbox_small" id="pl_g_3" onBlur="lasttext=this;" name="pl_g_3" size="20" maxlength="80" value="<?=$returned[19];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_2_case?></td>
<td>
<input type="text" class="inputbox_small" id="sg_ag_2" onBlur="lasttext=this;" name="sg_ag_2" size="20" maxlength="80" value="<?=$returned[8];?>"></td>
<td>
<input type="text" class="inputbox_small" id="sg_g_2" onBlur="lasttext=this;" name="sg_g_2" size="20" maxlength="80" value="<?=$returned[12];?>"></td>
<td><?=$lang_declination_2_case?></td>
<td>
<input type="text" class="inputbox_small" id="pl_ag_2" onBlur="lasttext=this;" name="pl_ag_2" size="20" maxlength="80" value="<?=$returned[16];?>"></td>
<td>
<input type="text" class="inputbox_small" id="pl_g_2" onBlur="lasttext=this;" name="pl_g_2" size="20" maxlength="80" value="<?=$returned[20];?>"></td>
</tr>
</table>
</form>
<br>
<?php
$view_keyword=$returned[1];
$view_num_keyword=$returned[2];
include './scripts/view_declination_noun.php';
echo $BUFFER_DEC;
$oop->freeResult();
$oop->_mySQL;
?>
</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div>
<?php }?>
</div>
<?php 
include ('./html_end.php');
?>
