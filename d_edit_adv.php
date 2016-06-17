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
$table = 'ds_dec_adv';
$sql = sprintf ('UPDATE `%s` SET `adv_pos` = %s, `adv_comp` = %s, `adv_super` = %s WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$table,					
	quate_smart(trim($_POST["adv_pos"])),
	quate_smart(trim($_POST["adv_comp"])),
	quate_smart(trim($_POST["adv_super"])),
	$collation_1,
	quate_smart($_POST["keyword"]),
	quate_smart($_POST["num_keyword"])); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$oop->_mySQL;
$page_id = 115; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
include './work.php';
$_SESSION["ses_message"].=$lang_dec_adv1;
$location = 'Location: ./d_edit_adv.php?d_h='.$_POST["keyword"].'&d_h_n='.$_POST["num_keyword"];
header($location);
} 
} else if ($_GET["action"]=='nextword') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop3 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop4 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table = 'ds_dec_adv';
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
	quate_smart(trim($value)));
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
$sql3 = sprintf ('SELECT `id` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s AND `word_form` COLLATE `%s` = %s',
	$table_declination,
	$collation_1,
	quate_smart($returned[1]),
	quate_smart($returned[2]),
	$collation_1,
	quate_smart(trim($value)));
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
$oop->freeResult();
$oop->_mySQL;
$oop3->_mySQL;
$oop4->_mySQL;
$page_id = 116; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
include './work.php';
if ($_GET["d_h_n"]==0) {
$_SESSION["ses_message"].=$lang_dec_adj9.''.$_GET["d_h"].''.$lang_dec_adj10;
} else {
$_SESSION["ses_message"].=$lang_dec_adj9.'<sup>'.$_GET["d_h_n"].'</sup>'.$_GET["d_h"].''.$lang_dec_adj10;	
}
$location = 'Location: ./search.php?d_h='.$_GET["d_h"].'&d_h_n='.$_GET["d_h_n"];
header($location);
} else if ($_GET["action"]=='add') {
$view_keyword = $_GET["d_h"];
$view_num_keyword = $_GET["d_h_n"];
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop3 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$adv_pos='';
$adv_comp='';
$adv_super='';
$table2 = 'ds_dec_adv';
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
if ($number==0) {
$sql2 = sprintf ('INSERT INTO `%s` (`id`, `keyword`, `num_keyword`, `adv_pos`, `adv_comp`, `adv_super`) VALUES (NULL, %s, %s, %s, %s, %s)',
	$table2,					
	quate_smart($view_keyword),
	quate_smart($view_num_keyword),
	quate_smart($adv_pos),
	quate_smart($adv_comp),
	quate_smart($adv_super));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$page_id = 117; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
include './work.php';
if ($view_num_keyword==0) {
$_SESSION["ses_message"].=$lang_dec_adj9.''.$view_keyword.''.$lang_dec_adj10;
} else {
$_SESSION["ses_message"].=$lang_dec_adj9.'<sup>'.$view_num_keyword.'</sup>'.$view_keyword.''.$lang_dec_adj10;	
}
$location = 'Location: ./search.php?d_h='.$view_keyword.'&d_h_n='.$view_num_keyword.'';
header($location);
} else {
if ($view_num_keyword==0) {
$_SESSION["ses_message"].=$lang_dec_adj9.''.$view_keyword.''.$lang_dec_adj11;
} else {
$_SESSION["ses_message"].=$lang_dec_adj9.'<sup>'.$view_num_keyword.'</sup>'.$view_keyword.''.$lang_dec_adj11;	
}
$location = 'Location: ./search.php?d_h='.$view_keyword.'&d_h_n='.$view_num_keyword.'';
header($location);	
}
} else if ($_GET["action"]=='delete'){
if ($_GET["del"]=='TRUE') {
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$view_keyword=$_GET["d_h"];
$view_num_keyword=$_GET["d_h_n"];
$table2 = 'ds_dec_adv';
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
$page_id = 118; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
include './work.php';
if ($view_num_keyword==0) {
$_SESSION["ses_message"].=$lang_dec_adv2.''.$view_keyword.''.$lang_dec_adv3;
} else {
$_SESSION["ses_message"].=$lang_dec_adv2.'<sup>'.$view_num_keyword.'</sup>'.$view_keyword.''.$lang_dec_adv2;	
}
$location = 'Location: ./search.php&d_h='.$view_keyword.'&d_h_n='.$view_num_keyword.'';
header($location);
} else {
?>
</head>
<body onload="setfocus ()">
<div id="wrapper">
<?php include './header.php'; 
include './menu.php'; 
echo $MAIN_MENU;
?>
<div id="content">
<div class="left_huge">
<h2><?=$lang_dec_adv2?> 
<?php if ($_GET["d_h_n"]!=0) {
echo "<sup>".$_GET["d_h_n"]."</sup>";
} 
echo $_GET["d_h"];	 
?></h2>
<?php
echo $lang_dec_adv5."<br>";
echo " <a href=\"./d_edit_adv.php?action=delete&del=TRUE&d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\"> ".$lang_edit_del_yes." </a>";
echo "<a href=\"./search.php?d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\"> ".$lang_edit_del_no." </a> <br>";
?>
</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div>
<?	
}} else  
{
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table='ds_dec_adv';
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
<body onload="setfocus2()">
<div id="wrapper">
<?php include './header.php';
include './menu.php'; 
echo $MAIN_MENU;
?>
<div id="content">
<div class="left_huge">
<h2><?=$lang_dec_adv2?>
<?php if ($_GET["d_h_n"]!=0) {
echo "<sup>".$_GET["d_h_n"]."</sup>";
} 
echo $_GET["d_h"];	 
?></h2>
<form action="./d_edit_adv.php?action=confirm&d_h=<?=$_GET["d_h"]?>&d_h_n=<?=$_GET["d_h_n"]?>" method="post" name="form">
<?php
$BUFFER_MENU='';
$BUFFER_MENU .= "<div class=\"menu_sub\">";
$BUFFER_MENU .= "<ul>"; 
$BUFFER_MENU .= "<li><input type=\"submit\" class=\"button3\" name=\"submit_direct\" value=\"".$lang_edit_submit."\"></li>";
$BUFFER_MENU .= "<li><a href=\"./d_edit_adv.php?action=nextword&correct=1&d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\">".$lang_declination_saving."</a></li>";
$BUFFER_MENU .= "<li><a href=\"./search.php?d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\">".$lang_back2."</a></li>";
$BUFFER_MENU .= "<li><a href= \"http://bin.arnastofnun.is/leit.php?q=".$_GET["d_h"]." \" onclick= \"return popitup('http://bin.arnastofnun.is/leit.php?q=".$_GET["d_h"]."') \">".$lang_declination_bin."</a></li>";
$BUFFER_MENU .= "</ul>";	
$BUFFER_MENU .= "</div>";	
echo $BUFFER_MENU;
$keyword = $returned[1]; $keyword_new=$returned[1]; $view_keyword=$returned[1];
?>
<input type="hidden" id="keyword" name="keyword" value="<?php echo $returned[1];?>">
<?php
$num_keyword = $returned[2]; $num_keyword_new=$returned[2]; $view_num_keyword=$returned[2];
?>
<input type="hidden" id="num_keyword" name="num_keyword" value="<?php echo $returned[2];?>">
<table class="sample">
<td align="center" width="20%"><?=$lang_dec_adv6?></td>
<td align="center" width="20%"><?=$lang_dec_adv7?></td>
<td align="center" width="20%"><?=$lang_dec_adv8?></td>
</tr>
<tr>
<td><input type="text" class="inputbox" id="sg_ag_1" onBlur="lasttext=this;" name="adv_pos" size="20" maxlength="80" value="<?=$returned[4];?>"></td>
<td>
<input type="text" class="inputbox" id="sg_ag_1" onBlur="lasttext=this;" name="adv_comp" size="20" maxlength="80" value="<?=$returned[5];?>"></td>
<td>
<input type="text" class="inputbox" id="pl_ag_1" onBlur="lasttext=this;" name="adv_super" size="20" maxlength="80" value="<?=$returned[6];?>">
</td>
</tr>
</table>
</form>
<br>
<?php
include './scripts/view_declination_adv.php';
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
