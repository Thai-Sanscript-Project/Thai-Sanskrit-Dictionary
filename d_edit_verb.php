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
$table = 'ds_dec_v_info';
$sql = sprintf ('UPDATE `%s` SET `germynd` = %s, `midmynd` = %s, `bodhattur` = %s, `lysingarhattur` = %s WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$table,								
	quate_smart($_POST["germynd"]),
	quate_smart($_POST["midmynd"]),
	quate_smart($_POST["bodhattur"]),
	quate_smart($_POST["lysingarhattur"]),
	$collation_1,
	quate_smart($_POST["keyword"]),
	quate_smart($_POST["num_keyword"])); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$oop->_mySQL;   
$view_keyword=$_POST["keyword"];
$view_num_keyword=$_POST["num_keyword"];
$action_scripts='verb_info_update';
include './scripts/d_scripts_verb.php';
$location = 'Location: ./d_edit_verb.php?action=info&d_h='.$_POST["keyword"].'&d_h_n='.$_POST["num_keyword"];
header($location);
} 
} else if ($_GET["action"]=='nextword') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop3 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop4 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table = 'ds_dec_v_info';
$oop->freeResult();
$status='2';
$sql = sprintf ('SELECT * FROM `%s` WHERE `status_keyword`<> %s AND `keyword` COLLATE `%s` > %s',
	$table,				
	quate_smart($status),
	$collation_1,
	quate_smart($_GET["d_h"]));
$oop->Setnames();
$oop->query($sql);
$returned = $oop->FetchArray();
$view_keyword=$returned[1];
$view_num_keyword=$returned[2];
$action_scripts='verb_info_update';
include './scripts/d_scripts_verb.php';
$action_scripts='';
$table_declination='ds_wordform';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table_declination,
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]));
$oop->Setnames();
$oop->query($sql2);
$oop->freeResult();
$oop->_mySQL;
$action_scripts='verb_generate_single_script';
include './scripts/d_scripts_verb.php';
$action_scripts='';
$page_id = 130; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
include './work.php';
if ($_GET["d_h_n"]==0) {
$_SESSION["ses_message"]=$lang_dec_noun2.''.$_GET["d_h"].''.$lang_dec_noun3;
} else {
$_SESSION["ses_message"]=$lang_dec_noun2.'<sup>'.$_GET["d_h_n"].'</sup>'.$_GET["d_h"].''.$lang_dec_noun3;	
}
$location = 'Location: ./search.php?list_kind=alpha&d_h='.$_GET["d_h"].'&d_h_n='.$_GET["d_h_n"].'&correct=1';
header($location);
} else if ($_GET["action"]=='verb1') {
if ($_GET["verb1_action"]=='verb1_confirm') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
if ($_POST["verb1_submit_direct"]) {
$table = 'ds_dec_v_1';
$sql = sprintf ('UPDATE `%s` SET `f_n_sg_1` = %s, `f_n_sg_2` = %s, `f_n_sg_3` = %s, `f_n_pl_1` = %s, `f_n_pl_2` = %s, `f_n_pl_3` = %s, `f_p_sg_1` = %s, `f_p_sg_2` = %s, `f_p_sg_3` = %s, `f_p_pl_1` = %s, `f_p_pl_2` = %s, `f_p_pl_3` = %s, `v_n_sg_1` = %s, `v_n_sg_2` = %s, `v_n_sg_3` = %s, `v_n_pl_1` = %s, `v_n_pl_2` = %s, `v_n_pl_3` = %s, `v_p_sg_1` = %s, `v_p_sg_2` = %s, `v_p_sg_3` = %s, `v_p_pl_1` = %s, `v_p_pl_2` = %s, `v_p_pl_3` = %s WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$table,					
	quate_smart($_POST["f_n_sg_1"]),
	quate_smart($_POST["f_n_sg_2"]),
	quate_smart($_POST["f_n_sg_3"]),
	quate_smart($_POST["f_n_pl_1"]),
	quate_smart($_POST["f_n_pl_2"]),
	quate_smart($_POST["f_n_pl_3"]),
	quate_smart($_POST["f_p_sg_1"]),
	quate_smart($_POST["f_p_sg_2"]),
	quate_smart($_POST["f_p_sg_3"]),
	quate_smart($_POST["f_p_pl_1"]),
	quate_smart($_POST["f_p_pl_2"]),
	quate_smart($_POST["f_p_pl_3"]),
	quate_smart($_POST["v_n_sg_1"]),
	quate_smart($_POST["v_n_sg_2"]),
	quate_smart($_POST["v_n_sg_3"]),
	quate_smart($_POST["v_n_pl_1"]),
	quate_smart($_POST["v_n_pl_2"]),
	quate_smart($_POST["v_n_pl_3"]),
	quate_smart($_POST["v_p_sg_1"]),
	quate_smart($_POST["v_p_sg_2"]),
	quate_smart($_POST["v_p_sg_3"]),
	quate_smart($_POST["v_p_pl_1"]),
	quate_smart($_POST["v_p_pl_2"]),
	quate_smart($_POST["v_p_pl_3"]),
	$collation_1,
	quate_smart($_POST["keyword"]),
	quate_smart($_POST["num_keyword"])); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$oop->_mySQL;
$page_id = 131; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
include './work.php';
if ($_GET["d_h_n"]==0) {
$_SESSION["ses_message"]=$lang_dec_verb1.''.$_GET["d_h"];
} else {
$_SESSION["ses_message"]=$lang_dec_verb1.'<sup>'.$_GET["d_h_n"].'</sup>'.$_GET["d_h"];	
}
$location = 'Location: ./d_edit_verb.php?action=verb1&d_h='.$_POST["keyword"].'&d_h_n='.$_POST["num_keyword"];
header($location);
} 
} else if ($_GET["verb1_action"]=='verb1_nextword') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$table = 'ds_dec_v_1';
if ($_GET["correct"]=='1') {
$status= '2';} else if ($_GET["correct"]=='2') {
$status = '3';
} else { $status= '1';}
$working= '1';
$sql = sprintf ('UPDATE `%s` SET `status` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($status),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$status='1';
$sql = sprintf ('SELECT * FROM `%s` WHERE `status`=%s AND `keyword` COLLATE `%s` > %s',
	$table,				
	quate_smart($status),
	$collation_1,
	quate_smart($_GET["d_h"]));
$oop->Setnames();
$oop->query($sql);
$returned = $oop->FetchArray();
$location = 'Location: ./d_edit_verb.php?d_h='.$_GET["d_h"].'&d_h_n='.$_GET["d_h_n"];
header($location);
} else 
if ($_GET["verb1_action"]=='verb1_info') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$table = 'ds_dec_v_1';
if ($_GET["correct"]=='1') {
$status= '2';} else if ($_GET["correct"]=='2') {
$status = '3';
} else { $status= '1';}
$working= '1';
$sql = sprintf ('UPDATE `%s` SET `status` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($status),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$view_keyword=$_GET["d_h"];
$view_num_keyword=$_GET["d_h_n"];
include './scripts/d_scripts_verb.php?action=verb_info_update';
$location = 'Location: ./d_edit_verb.php?d_h='.$_GET["d_h"].'&d_h_n='.$_GET["d_h_n"];
header($location);
} 
else  
{
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table='ds_dec_v_1';
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
function Delete_all() {
document.getElementById("f_n_sg_1").value='';
document.getElementById("f_n_pl_1").value='';
document.getElementById("f_p_sg_1").value='';
document.getElementById("f_p_pl_1").value='';
document.getElementById("f_n_sg_2").value='';
document.getElementById("f_n_pl_2").value='';
document.getElementById("f_p_sg_2").value='';
document.getElementById("f_p_pl_2").value='';
document.getElementById("f_n_sg_3").value='';
document.getElementById("f_n_pl_3").value='';
document.getElementById("f_p_sg_3").value='';
document.getElementById("f_p_pl_3").value='';
document.getElementById("v_n_sg_1").value='';
document.getElementById("v_n_pl_1").value='';
document.getElementById("v_p_sg_1").value='';
document.getElementById("v_p_pl_1").value='';
document.getElementById("v_n_sg_2").value='';
document.getElementById("v_n_pl_2").value='';
document.getElementById("v_p_sg_2").value='';
document.getElementById("v_p_pl_2").value='';
document.getElementById("v_n_sg_3").value='';
document.getElementById("v_n_pl_3").value='';
document.getElementById("v_p_sg_3").value='';
document.getElementById("v_p_pl_3").value='';
}
function setFocus2()
{
document.getElementById("f_n_sg_1").focus();
}
</script>
</head>
<body onload="setFocus2()">
<div id="wrapper">
<?php include './header.php'; 
include './menu.php'; 
echo $MAIN_MENU;
?>
<form action="/d_edit_verb.php?action=verb1&verb1_action=verb1_confirm&d_h=<?=$_GET["d_h"]?>&d_h_n=<?=$_GET["d_h_n"]?>" method="post" name="form">
<div id="content">
<div class="left_huge">
<h2><?=$lang_dec_verb2?> 
<?php if ($_GET["d_h_n"]!=0) {
echo "<sup>".$_GET["d_h_n"]."</sup>";
} 
echo $_GET["d_h"];	 
?></h2>
<?php
$BUFFER_MENU='';
$BUFFER_MENU .= "<div class=\"menu_sub\">";
$BUFFER_MENU .= "<ul>"; 
$BUFFER_MENU .= "<li><input type=\"submit\" class=\"button3\" name=\"verb1_submit_direct\" value=\"".$lang_edit_submit."\"></li>";
$BUFFER_MENU .= "<li><a href=\"./d_edit_verb.php?action=verb1&verb1_action=verb1_nextword&correct=1&d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\">".$lang_dec_verb6."</a></li>";
$BUFFER_MENU .= "<li><a href=\"#\" onClick=\"Delete_all()\"\">".$lang_declination_del_all."</a></li>";
$BUFFER_MENU .= "<li><a href= \"http://bin.arnastofnun.is/leit.php?q=".$_GET["d_h"]." \" onclick= \"return popitup('http://bin.arnastofnun.is/leit.php?q=".$_GET["d_h"]."') \">".$lang_declination_bin."</a></li>";
$BUFFER_MENU .= "</ul>";	
$BUFFER_MENU .= "</div>";	
echo $BUFFER_MENU;
?>
<?php
$keyword = $returned[1]; $keyword_new=$returned[1];
?>
<input type="hidden" id="keyword" name="keyword" value="<?php echo $returned[1];?>">
<?php
$num_keyword = $returned[2]; $num_keyword_new=$returned[2];
?>
<input type="hidden" id="num_keyword" name="num_keyword" value="<?php echo $returned[2];?>">
<table class="sample">
<tr><th colspan="8"><?=$lang_dec_verb7?></th></tr>
<tr><th colspan="8"><?=$lang_declination_framsoguhattur?></th></tr>
<tr>
<td width="5%"></td>
<td width="15%"><?=$lang_declination_singular?></td>
<td width="15%"><?=$lang_declination_plural?></td>
<td width="5%"></td>
<td width="15%"><?=$lang_declination_singular?></td>
<td width="15%"><?=$lang_declination_plural?></td>
</tr>
<tr>
<td><?=$lang_declination_1_p?></td>
<td>
<input type="text" class="inputbox_small" id="f_n_sg_1" onBlur="lasttext=this;" name="f_n_sg_1" size="18" maxlength="80" value="<?=$returned[4];?>"></td>
<td>
<input type="text" class="inputbox_small" id="f_n_pl_1" onBlur="lasttext=this;" name="f_n_pl_1" size="18" maxlength="80" value="<?=$returned[7];?>"></td>
<td><?=$lang_declination_1_p?> </td>
<td>
<input type="text" class="inputbox_small" id="f_p_sg_1" onBlur="lasttext=this;" name="f_p_sg_1" size="18" maxlength="80" value="<?=$returned[10];?>"></td>
<td>
<input type="text" class="inputbox_small" id="f_p_pl_1" onBlur="lasttext=this;" name="f_p_pl_1" size="18" maxlength="80" value="<?=$returned[13];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_2_p?></td>
<td>
<input type="text" class="inputbox_small" id="f_n_sg_2" onBlur="lasttext=this;" name="f_n_sg_2" size="18" maxlength="80" value="<?=$returned[5];?>"></td>
<td>
<input type="text" class="inputbox_small" id="f_n_pl_2" onBlur="lasttext=this;" name="f_n_pl_2" size="18" maxlength="80" value="<?=$returned[8];?>"></td>
<td><?=$lang_declination_2_p?> </td>
<td>
<input type="text" class="inputbox_small" id="f_p_sg_2" onBlur="lasttext=this;" name="f_p_sg_2" size="18" maxlength="80" value="<?=$returned[11];?>"></td>
<td>
<input type="text" class="inputbox_small" id="f_p_pl_2" onBlur="lasttext=this;" name="f_p_pl_2" size="18" maxlength="80" value="<?=$returned[14];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_3_p?></td>
<td>
<input type="text" class="inputbox_small" id="f_n_sg_3" onBlur="lasttext=this;" name="f_n_sg_3" size="18" maxlength="80" value="<?=$returned[6];?>"></td>
<td>
<input type="text" class="inputbox_small" id="f_n_pl_3" onBlur="lasttext=this;" name="f_n_pl_3" size="18" maxlength="80" value="<?=$returned[9];?>"></td>
<td><?=$lang_declination_3_p?> </td>
<td>
<input type="text" class="inputbox_small" id="f_p_sg_3" onBlur="lasttext=this;" name="f_p_sg_3" size="18" maxlength="80" value="<?=$returned[12];?>"></td>
<td>
<input type="text" class="inputbox_small" id="f_p_pl_3" onBlur="lasttext=this;" name="f_p_pl_3" size="18" maxlength="80" value="<?=$returned[15];?>"></td>
</tr>
<tr><th colspan="8"><?=$lang_declination_vidtengingarhattur?></th></tr>
<tr>
<td width="5%"></td>
<td width="15%"><?=$lang_declination_singular?></td>
<td width="15%"><?=$lang_declination_plural?></td>
<td width="5%"></td>
<td width="15%"><?=$lang_declination_singular?></td>
<td width="15%"><?=$lang_declination_plural?></td>
</tr>
<tr>
<td><?=$lang_declination_1_p?></td>
<td>
<input type="text" class="inputbox_small" id="v_n_sg_1" onBlur="lasttext=this;" name="v_n_sg_1" size="18" maxlength="80" value="<?=$returned[16];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_n_pl_1" onBlur="lasttext=this;" name="v_n_pl_1" size="18" maxlength="80" value="<?=$returned[19];?>"></td>
<td><?=$lang_declination_1_p?> </td>
<td>
<input type="text" class="inputbox_small" id="v_p_sg_1" onBlur="lasttext=this;" name="v_p_sg_1" size="18" maxlength="80" value="<?=$returned[22];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_p_pl_1" onBlur="lasttext=this;" name="v_p_pl_1" size="18" maxlength="80" value="<?=$returned[25];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_2_p?></td>
<td>
<input type="text" class="inputbox_small" id="v_n_sg_2" onBlur="lasttext=this;" name="v_n_sg_2" size="18" maxlength="80" value="<?=$returned[17];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_n_pl_2" onBlur="lasttext=this;" name="v_n_pl_2" size="18" maxlength="80" value="<?=$returned[20];?>"></td>
<td><?=$lang_declination_2_p?> </td>
<td>
<input type="text" class="inputbox_small" id="v_p_sg_2" onBlur="lasttext=this;" name="v_p_sg_2" size="18" maxlength="80" value="<?=$returned[23];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_p_pl_2" onBlur="lasttext=this;" name="v_p_pl_2" size="18" maxlength="80" value="<?=$returned[26];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_3_p?></td>
<td>
<input type="text" class="inputbox_small" id="v_n_sg_3" onBlur="lasttext=this;" name="v_n_sg_3" size="18" maxlength="80" value="<?=$returned[18];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_n_pl_3" onBlur="lasttext=this;" name="v_n_pl_3" size="18" maxlength="80" value="<?=$returned[21];?>"></td>
<td><?=$lang_declination_3_p?> </td>
<td>
<input type="text" class="inputbox_small" id="v_p_sg_3" onBlur="lasttext=this;" name="v_p_sg_3" size="18" maxlength="80" value="<?=$returned[24];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_p_pl_3" onBlur="lasttext=this;" name="v_p_pl_3" size="18" maxlength="80" value="<?=$returned[27];?>"></td>
</tr>
</table>
</form>
<?php
$oop->freeResult();
$oop->_mySQL;
?>
</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div>
<?php 
}
// verb2
} else if ($_GET["action"]=="verb2") {
if ($_GET["verb2_action"]=='verb2_confirm') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
if ($_POST["verb2_submit_direct"]) {
$table = 'ds_dec_v_2';
$sql = sprintf ('UPDATE `%s` SET `f_n_sg_1` = %s, `f_n_sg_2` = %s, `f_n_sg_3` = %s, `f_n_pl_1` = %s, `f_n_pl_2` = %s, `f_n_pl_3` = %s, `f_p_sg_1` = %s, `f_p_sg_2` = %s, `f_p_sg_3` = %s, `f_p_pl_1` = %s, `f_p_pl_2` = %s, `f_p_pl_3` = %s, `v_n_sg_1` = %s, `v_n_sg_2` = %s, `v_n_sg_3` = %s, `v_n_pl_1` = %s, `v_n_pl_2` = %s, `v_n_pl_3` = %s, `v_p_sg_1` = %s, `v_p_sg_2` = %s, `v_p_sg_3` = %s, `v_p_pl_1` = %s, `v_p_pl_2` = %s, `v_p_pl_3` = %s WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$table,					
	quate_smart($_POST["f_n_sg_1"]),
	quate_smart($_POST["f_n_sg_2"]),
	quate_smart($_POST["f_n_sg_3"]),
	quate_smart($_POST["f_n_pl_1"]),
	quate_smart($_POST["f_n_pl_2"]),
	quate_smart($_POST["f_n_pl_3"]),
	quate_smart($_POST["f_p_sg_1"]),
	quate_smart($_POST["f_p_sg_2"]),
	quate_smart($_POST["f_p_sg_3"]),
	quate_smart($_POST["f_p_pl_1"]),
	quate_smart($_POST["f_p_pl_2"]),
	quate_smart($_POST["f_p_pl_3"]),
	quate_smart($_POST["v_n_sg_1"]),
	quate_smart($_POST["v_n_sg_2"]),
	quate_smart($_POST["v_n_sg_3"]),
	quate_smart($_POST["v_n_pl_1"]),
	quate_smart($_POST["v_n_pl_2"]),
	quate_smart($_POST["v_n_pl_3"]),
	quate_smart($_POST["v_p_sg_1"]),
	quate_smart($_POST["v_p_sg_2"]),
	quate_smart($_POST["v_p_sg_3"]),
	quate_smart($_POST["v_p_pl_1"]),
	quate_smart($_POST["v_p_pl_2"]),
	quate_smart($_POST["v_p_pl_3"]),
	$collation_1,	
	quate_smart($_POST["keyword"]),
	quate_smart($_POST["num_keyword"])); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$oop->_mySQL;   
$page_id = 132; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
include './work.php';
if ($_GET["d_h_n"]==0) {
$_SESSION["ses_message"]=$lang_dec_verb8.''.$_GET["d_h"];
} else {
$_SESSION["ses_message"]=$lang_dec_verb8.'<sup>'.$_GET["d_h_n"].'</sup>'.$_GET["d_h"];	
}
$location = 'Location: ./d_edit_verb.php?action=verb2&d_h='.$_POST["keyword"].'&d_h_n='.$_POST["num_keyword"];
header($location);
} 
} else if ($_GET["verb2_action"]=='verb2_info') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$table = 'ds_dec_v_2';
if ($_GET["correct"]=='1') {
$status= '2';} else if ($_GET["correct"]=='2') {
$status = '3';
} else { $status= '1';}
$working= '1';
$sql = sprintf ('UPDATE `%s` SET `status` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($status),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$view_keyword=$_GET["d_h"];
$view_num_keyword=$_GET["d_h_n"];
include './scripts/verb_info_update.php';
$_SESSION["ses_message"]=$lang_dec_verb8.''.$_GET["d_h"].'('.$_GET["d_h_n"].'';
$location = 'Location: ./d_edit_verb.php?action=verb2&d_h='.$_GET["d_h"].'&d_h_n='.$_GET["d_h_n"];
header($location);
} else if ($_GET["verb2_action"]=='verb2_nextword') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$table = 'ds_dec_v_2';
if ($_GET["correct"]=='1') {
$status= '2';} else if ($_GET["correct"]=='1') {
$status = '1';
} else { $status= '3';}
$working= '1';
$sql = sprintf ('UPDATE `%s` SET `status` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($status),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$status='2';
$status0='0';
$sql = sprintf ('SELECT * FROM `%s` WHERE `status`<>%s AND `status` <> %s AND `keyword` COLLATE `%s` > %s',
	$table,				
	quate_smart($status),
	quate_smart($status0),
	$collation_1,
	quate_smart($_GET["d_h"]));
$oop->Setnames();
$oop->query($sql);
$returned = $oop->FetchArray();
$location = 'Location: ./d_edit_verb.php?d_h='.$_GET["d_h"].'&d_h_n='.$_GET["d_h_n"];
header($location);
} 
else  
{
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table='ds_dec_v_2';
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
function Delete_all() {
document.getElementById("f_n_sg_1").value='';
document.getElementById("f_n_pl_1").value='';
document.getElementById("f_p_sg_1").value='';
document.getElementById("f_p_pl_1").value='';
document.getElementById("f_n_sg_2").value='';
document.getElementById("f_n_pl_2").value='';
document.getElementById("f_p_sg_2").value='';
document.getElementById("f_p_pl_2").value='';
document.getElementById("f_n_sg_3").value='';
document.getElementById("f_n_pl_3").value='';
document.getElementById("f_p_sg_3").value='';
document.getElementById("f_p_pl_3").value='';
document.getElementById("v_n_sg_1").value='';
document.getElementById("v_n_pl_1").value='';
document.getElementById("v_p_sg_1").value='';
document.getElementById("v_p_pl_1").value='';
document.getElementById("v_n_sg_2").value='';
document.getElementById("v_n_pl_2").value='';
document.getElementById("v_p_sg_2").value='';
document.getElementById("v_p_pl_2").value='';
document.getElementById("v_n_sg_3").value='';
document.getElementById("v_n_pl_3").value='';
document.getElementById("v_p_sg_3").value='';
document.getElementById("v_p_pl_3").value='';
}
function setFocus2()
{
document.getElementById("f_n_sg_1").focus();
}
</script>
</head>
<body onload="setFocus()">
<div id="wrapper">
<?php include './header.php'; 
include './menu.php'; 
echo $MAIN_MENU;
?>
<form action="/d_edit_verb.php?action=verb2&verb2_action=verb2_confirm&d_h=<?=$_GET["d_h"]?>&d_h_n=<?=$_GET["d_h_n"]?>" method="post" name="form">
<div id="content">
<div class="left">
</div>
<div class="left_huge">
<h2><?=$lang_dec_verb3?> 
<?php if ($_GET["d_h_n"]!=0) {
echo "<sup>".$_GET["d_h_n"]."</sup>";
} 
echo $_GET["d_h"];	 
?></h2>
<?php
$BUFFER_MENU='';
$BUFFER_MENU .= "<div class=\"menu_sub\">";
$BUFFER_MENU .= "<ul>"; 
$BUFFER_MENU .= "<li><input type=\"submit\" class=\"button3\" name=\"verb2_submit_direct\" value=\"".$lang_edit_submit."\"></li>";
$BUFFER_MENU .= "<li><a href=\"./d_edit_verb.php?action=verb2&verb2_action=verb2_nextword&correct=1&d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\">".$lang_dec_verb6."</a></li>";
$BUFFER_MENU .= "<li><a href=\"#\" onClick=\"Delete_all()\"\">".$lang_declination_del_all."</a></li>";
$BUFFER_MENU .= "<li><a href= \"http://bin.arnastofnun.is/leit.php?q=".$_GET["d_h"]." \" onclick= \"return popitup('http://bin.arnastofnun.is/leit.php?q=".$_GET["d_h"]."') \">".$lang_declination_bin."</a></li>";
$BUFFER_MENU .= "</ul>";	
$BUFFER_MENU .= "</div>";	
echo $BUFFER_MENU; ?>
<?php
$keyword = $returned[1]; $keyword_new=$returned[1];
?>
<input type="hidden" id="keyword" name="keyword" value="<?php echo $returned[1];?>">
<?php
$num_keyword = $returned[2]; $num_keyword_new=$returned[2];
?>
<input type="hidden" id="num_keyword" name="num_keyword" value="<?php echo $returned[2];?>">
<table class="sample">
<tr><th colspan="8"><?=$lang_dec_verb7?></th></tr>
<tr><th colspan="8"><?=$lang_declination_framsoguhattur?></th></tr>
<tr>
<td width="5%"></td>
<td width="15%"><?=$lang_declination_singular?></td>
<td width="15%"><?=$lang_declination_plural?></td>
<td width="5%"></td>
<td width="15%"><?=$lang_declination_singular?></td>
<td width="15%"><?=$lang_declination_plural?></td>
</tr>
<tr>
<td><?=$lang_declination_1_p?></td>
<td>
<input type="text" class="inputbox_small" id="f_n_sg_1" onBlur="lasttext=this;" name="f_n_sg_1" size="18" maxlength="80" value="<?=$returned[4];?>"></td>
<td>
<input type="text" class="inputbox_small" id="f_n_pl_1" onBlur="lasttext=this;" name="f_n_pl_1" size="18" maxlength="80" value="<?=$returned[7];?>"></td>
<td><?=$lang_declination_1_p?> </td>
<td>
<input type="text" class="inputbox_small" id="f_p_sg_1" onBlur="lasttext=this;" name="f_p_sg_1" size="18" maxlength="80" value="<?=$returned[10];?>"></td>
<td>
<input type="text" class="inputbox_small" id="f_p_pl_1" onBlur="lasttext=this;" name="f_p_pl_1" size="18" maxlength="80" value="<?=$returned[13];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_2_p?></td>
<td>
<input type="text" class="inputbox_small" id="f_n_sg_2" onBlur="lasttext=this;" name="f_n_sg_2" size="18" maxlength="80" value="<?=$returned[5];?>"></td>
<td>
<input type="text" class="inputbox_small" id="f_n_pl_2" onBlur="lasttext=this;" name="f_n_pl_2" size="18" maxlength="80" value="<?=$returned[8];?>"></td>
<td><?=$lang_declination_2_p?> </td>
<td>
<input type="text" class="inputbox_small" id="f_p_sg_2" onBlur="lasttext=this;" name="f_p_sg_2" size="18" maxlength="80" value="<?=$returned[11];?>"></td>
<td>
<input type="text" class="inputbox_small" id="f_p_pl_2" onBlur="lasttext=this;" name="f_p_pl_2" size="18" maxlength="80" value="<?=$returned[14];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_3_p?></td>
<td>
<input type="text" class="inputbox_small" id="f_n_sg_3" onBlur="lasttext=this;" name="f_n_sg_3" size="18" maxlength="80" value="<?=$returned[6];?>"></td>
<td>
<input type="text" class="inputbox_small" id="f_n_pl_3" onBlur="lasttext=this;" name="f_n_pl_3" size="18" maxlength="80" value="<?=$returned[9];?>"></td>
<td><?=$lang_declination_3_p?> </td>
<td>
<input type="text" class="inputbox_small" id="f_p_sg_3" onBlur="lasttext=this;" name="f_p_sg_3" size="18" maxlength="80" value="<?=$returned[12];?>"></td>
<td>
<input type="text" class="inputbox_small" id="f_p_pl_3" onBlur="lasttext=this;" name="f_p_pl_3" size="18" maxlength="80" value="<?=$returned[15];?>"></td>
</tr>
<tr><th colspan="8"><?=$lang_declination_vidtengingarhattur?></th></tr>
<tr>
<td width="5%"></td>
<td width="15%"><?=$lang_declination_singular?></td>
<td width="15%"><?=$lang_declination_plural?></td>
<td width="5%"></td>
<td width="15%"><?=$lang_declination_singular?></td>
<td width="15%"><?=$lang_declination_plural?></td>
</tr>
<tr>
<td><?=$lang_declination_1_p?></td>
<td>
<input type="text" class="inputbox_small" id="v_n_sg_1" onBlur="lasttext=this;" name="v_n_sg_1" size="18" maxlength="80" value="<?=$returned[16];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_n_pl_1" onBlur="lasttext=this;" name="v_n_pl_1" size="18" maxlength="80" value="<?=$returned[19];?>"></td>
<td><?=$lang_declination_1_p?> </td>
<td>
<input type="text" class="inputbox_small" id="v_p_sg_1" onBlur="lasttext=this;" name="v_p_sg_1" size="18" maxlength="80" value="<?=$returned[22];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_p_pl_1" onBlur="lasttext=this;" name="v_p_pl_1" size="18" maxlength="80" value="<?=$returned[25];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_2_p?></td>
<td>
<input type="text" class="inputbox_small" id="v_n_sg_2" onBlur="lasttext=this;" name="v_n_sg_2" size="18" maxlength="80" value="<?=$returned[17];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_n_pl_2" onBlur="lasttext=this;" name="v_n_pl_2" size="18" maxlength="80" value="<?=$returned[20];?>"></td>
<td><?=$lang_declination_2_p?> </td>
<td>
<input type="text" class="inputbox_small" id="v_p_sg_2" onBlur="lasttext=this;" name="v_p_sg_2" size="18" maxlength="80" value="<?=$returned[23];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_p_pl_2" onBlur="lasttext=this;" name="v_p_pl_2" size="18" maxlength="80" value="<?=$returned[26];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_3_p?></td>
<td>
<input type="text" class="inputbox_small" id="v_n_sg_3" onBlur="lasttext=this;" name="v_n_sg_3" size="18" maxlength="80" value="<?=$returned[18];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_n_pl_3" onBlur="lasttext=this;" name="v_n_pl_3" size="18" maxlength="80" value="<?=$returned[21];?>"></td>
<td><?=$lang_declination_3_p?> </td>
<td>
<input type="text" class="inputbox_small" id="v_p_sg_3" onBlur="lasttext=this;" name="v_p_sg_3" size="18" maxlength="80" value="<?=$returned[24];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_p_pl_3" onBlur="lasttext=this;" name="v_p_pl_3" size="18" maxlength="80" value="<?=$returned[27];?>"></td>
</tr>
</table>
</form>
<?php
$oop->freeResult();
$oop->_mySQL;
?>
</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div>
<?php 
}
} else if ($_GET["action"]=="verb3" ) {
if ($_GET["verb3_action"]=='verb3_confirm') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
if ($_POST["verb3_submit_direct"]) {
$table = 'ds_dec_v_3';
$sql = sprintf ('UPDATE `%s` SET `b_1` = %s, `b_sg_1` = %s, `b_pl_1` = %s, `b_sg_2` = %s, `b_pl_2` = %s, `ln` = %s, `s_1` = %s, `s_2` = %s WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$table,					
	quate_smart($_POST["b_1"]),
	quate_smart($_POST["b_sg_1"]),
	quate_smart($_POST["b_pl_1"]),
	quate_smart($_POST["b_sg_2"]),
	quate_smart($_POST["b_pl_2"]),
	quate_smart($_POST["ln"]),
	quate_smart($_POST["s_1"]),
	quate_smart($_POST["s_2"]),
	$collation_1,
	quate_smart($_POST["keyword"]),
	quate_smart($_POST["num_keyword"])); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$oop->_mySQL;   
$page_id = 133; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
include './work.php';
if ($_GET["d_h_n"]==0) {
$_SESSION["ses_message"]=$lang_dec_verb9.''.$_GET["d_h"];
} else {
$_SESSION["ses_message"]=$lang_dec_verb9.'<sup>'.$_GET["d_h_n"].'</sup>'.$_GET["d_h"];	
}
$location = 'Location: ./d_edit_verb.php?action=verb3&d_h='.$_POST["keyword"].'&d_h_n='.$_POST["num_keyword"];
header($location);
} 
}  else 
if ($_GET["action"]=='verb3_info') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$table = 'ds_dec_v_3';
if ($_GET["correct"]=='1') {
$status= '2';} else if ($_GET["correct"]=='2') {
$status = '3';
} else { $status= '1';}
$working= '1';
$sql = sprintf ('UPDATE `%s` SET `status` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($status),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$oop->_mySQL;
$view_keyword=$_GET["d_h"];
$view_num_keyword=$_GET["d_h_n"];
include './scripts/verb_info_update.php';
$location = 'Location: ./d_edit_verb.php?d_h='.$_GET["d_h"].'&d_h_n='.$_GET["d_h_n"];
header($location);
} else if ($_GET["verb3_action"]=='verb3_nextword') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$table = 'ds_dec_v_3';
if ($_GET["correct"]=='1') {
$status= '2';} else if ($_GET["correct"]=='0') {
$status = '1';
} else { $status= '3';}
$working= '1';
$sql = sprintf ('UPDATE `%s` SET `status` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($status),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$status='2';
$status0='0';
$sql = sprintf ('SELECT * FROM `%s` WHERE `status`<>%s AND `status`<>%s AND `keyword` COLLATE `%s` > %s',
	$table,				
	quate_smart($status),
	quate_smart($status0),
	$collation_1,
	quate_smart($_GET["d_h"]));
$oop->Setnames();
$oop->query($sql);
$returned = $oop->FetchArray();
$oop->_mySQL;   
$location = 'Location: ./d_edit_verb.php?d_h='.$_GET["d_h"].'&d_h_n='.$_GET["d_h_n"];
header($location);
}   
else  
{ 
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table='ds_dec_v_3';
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
document.getElementById("b_1").focus();
}
</script>
</head>
<body onload="setFocus()">
<div id="wrapper">
<?php include './header.php';
include './menu.php';
echo $MAIN_MENU;
?>
<form action="/d_edit_verb.php?action=verb3&verb3_action=verb3_confirm&d_h=<?=$_GET["d_h"]?>&d_h_n=<?=$_GET["d_h_n"]?>" method="post" name="form">
<div id="content">
<div class="left_huge"> 
<h2><?=$lang_dec_verb4?> 
<?php if ($_GET["d_h_n"]!=0) {
echo "<sup>".$_GET["d_h_n"]."</sup>";
} 
echo $_GET["d_h"];	 
?></h2>
<?php
$BUFFER_MENU='';
$BUFFER_MENU .= "<div class=\"menu_sub\">";
$BUFFER_MENU .= "<ul>"; 
$BUFFER_MENU .= "<li><input type=\"submit\" class=\"button3\" name=\"verb3_submit_direct\" value=\"".$lang_edit_submit."\"></li>";
$BUFFER_MENU .= "<li><a href=\"./d_edit_verb.php?action=verb3&verb3_action=verb3_nextword&correct=1&d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\">".$lang_dec_verb6."</a></li>";
$BUFFER_MENU .= "<li><a href= \"http://bin.arnastofnun.is/leit.php?q=".$_GET["d_h"]." \" onclick= \"return popitup('http://bin.arnastofnun.is/leit.php?q=".$_GET["d_h"]."') \">".$lang_declination_bin."</a></li>";
$BUFFER_MENU .= "</ul>";	
$BUFFER_MENU .= "</div>";	
echo $BUFFER_MENU;
?>
<?php
$keyword = $returned[1]; $keyword_new=$returned[1];
?>
<input type="hidden" id="keyword" name="keyword" value="<?php echo $returned[1];?>">
<?php
$num_keyword = $returned[2]; $num_keyword_new=$returned[2];
?>
<input type="hidden" id="num_keyword" name="num_keyword" value="<?php echo $returned[2];?>">
<table class="sample">
<tr><th colspan="8"><?=$lang_dec_verb7?></th></tr>
<tr><th colspan="8"><?=$lang_declination_bodhattur?></th></tr>
<tr>
<td width="15%"><?=$lang_declination_b_1?></td>
<td width="15%"><?=$lang_declination_b_sg_1?></td>
<td width="15%"><?=$lang_declination_b_pl_1?></td>
<td width="15%"><?=$lang_declination_b_sg_2?></td>
<td width="15%"><?=$lang_declination_b_pl_2?></td>
</tr>
<tr>
<td>
<input type="text" class="inputbox_small" id="b_1" onBlur="lasttext=this;" name="b_1" size="18" maxlength="80" value="<?=$returned[4];?>"></td>
<td>
<input type="text" class="inputbox_small" id="b_sg_1" onBlur="lasttext=this;" name="b_sg_1" size="18" maxlength="80" value="<?=$returned[5];?>"></td>
<td>
<input type="text" class="inputbox_small" id="b_pl_1" onBlur="lasttext=this;" name="b_pl_1" size="18" maxlength="80" value="<?=$returned[6];?>"></td>
<td>
<input type="text" class="inputbox_small" id="b_sg_2" onBlur="lasttext=this;" name="b_sg_2" size="18" maxlength="80" value="<?=$returned[7];?>"></td>
<td>
<input type="text" class="inputbox_small" id="b_pl_2" onBlur="lasttext=this;" name="b_pl_2" size="18" maxlength="80" value="<?=$returned[8];?>"></td>
</tr>
<tr>
<td width="15%"><?=$lang_declination_ln?> </td>
<td width="15%"><?=$lang_declination_s_1?></td>
<td width="15%"><?=$lang_declination_s_2?></td>
</tr>
<tr>
<td>
<input type="text" class="inputbox_small" id="ln" onBlur="lasttext=this;" name="ln" size="18" maxlength="80" value="<?=$returned[9];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_1" onBlur="lasttext=this;" name="s_1" size="18" maxlength="80" value="<?=$returned[10];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_2" onBlur="lasttext=this;" name="s_2" size="18" maxlength="80" value="<?=$returned[11];?>"></td>
</tr>
</table>
</form>

</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div>
<?php
$oop->freeResult();
$oop->_mySQL;
?>
<?php
}
} else if ($_GET["action"]=="verb4") {
if ($_GET["verb4_action"]=='verb4_confirm') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
if ($_POST["verb4_submit_direct"]) {
$table = 'ds_dec_v_4';
$sql = sprintf ('UPDATE `%s` SET `s_sg_m_1` = %s, `s_sg_m_4` = %s, `s_sg_m_3` = %s, `s_sg_m_2` = %s, `s_sg_f_1` = %s, `s_sg_f_4` = %s, `s_sg_f_3` = %s, `s_sg_f_2` = %s, `s_sg_n_1` = %s, `s_sg_n_4` = %s, `s_sg_n_3` = %s, `s_sg_n_2` = %s, `s_pl_m_1` = %s, `s_pl_m_4` = %s, `s_pl_m_3` = %s, `s_pl_m_2` = %s, `s_pl_f_1` = %s, `s_pl_f_4` = %s, `s_pl_f_3` = %s, `s_pl_f_2` = %s, `s_pl_n_1` = %s, `s_pl_n_4` = %s, `s_pl_n_3` = %s, `s_pl_n_2` = %s, `v_sg_m_1` = %s, `v_sg_m_4` = %s, `v_sg_m_3` = %s, `v_sg_m_2` = %s, `v_sg_f_1` = %s, `v_sg_f_4` = %s, `v_sg_f_3` = %s, `v_sg_f_2` = %s, `v_sg_n_1` = %s, `v_sg_n_4` = %s, `v_sg_n_3` = %s, `v_sg_n_2` = %s, `v_pl_m_1` = %s, `v_pl_m_4` = %s, `v_pl_m_3` = %s, `v_pl_m_2` = %s, `v_pl_f_1` = %s, `v_pl_f_4` = %s, `v_pl_f_3` = %s, `v_pl_f_2` = %s, `v_pl_n_1` = %s, `v_pl_n_4` = %s, `v_pl_n_3` = %s, `v_pl_n_2` = %s WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$table,					
	quate_smart($_POST["s_sg_m_1"]),
	quate_smart($_POST["s_sg_m_4"]),
	quate_smart($_POST["s_sg_m_3"]),
	quate_smart($_POST["s_sg_m_2"]),
	quate_smart($_POST["s_sg_f_1"]),
	quate_smart($_POST["s_sg_f_4"]),
	quate_smart($_POST["s_sg_f_3"]),
	quate_smart($_POST["s_sg_f_2"]),
	quate_smart($_POST["s_sg_n_1"]),
	quate_smart($_POST["s_sg_n_4"]),
	quate_smart($_POST["s_sg_n_3"]),
	quate_smart($_POST["s_sg_n_2"]),
	quate_smart($_POST["s_pl_m_1"]),
	quate_smart($_POST["s_pl_m_4"]),
	quate_smart($_POST["s_pl_m_3"]),
	quate_smart($_POST["s_pl_m_2"]),
	quate_smart($_POST["s_pl_f_1"]),
	quate_smart($_POST["s_pl_f_4"]),
	quate_smart($_POST["s_pl_f_3"]),
	quate_smart($_POST["s_pl_f_2"]),
	quate_smart($_POST["s_pl_n_1"]),
	quate_smart($_POST["s_pl_n_4"]),
	quate_smart($_POST["s_pl_n_3"]),
	quate_smart($_POST["s_pl_n_2"]),		
	quate_smart($_POST["v_sg_m_1"]),
	quate_smart($_POST["v_sg_m_4"]),
	quate_smart($_POST["v_sg_m_3"]),
	quate_smart($_POST["v_sg_m_2"]),
	quate_smart($_POST["v_sg_f_1"]),
	quate_smart($_POST["v_sg_f_4"]),
	quate_smart($_POST["v_sg_f_3"]),
	quate_smart($_POST["v_sg_f_2"]),
	quate_smart($_POST["v_sg_n_1"]),
	quate_smart($_POST["v_sg_n_4"]),
	quate_smart($_POST["v_sg_n_3"]),
	quate_smart($_POST["v_sg_n_2"]),
	quate_smart($_POST["v_pl_m_1"]),
	quate_smart($_POST["v_pl_m_4"]),
	quate_smart($_POST["v_pl_m_3"]),
	quate_smart($_POST["v_pl_m_2"]),
	quate_smart($_POST["v_pl_f_1"]),
	quate_smart($_POST["v_pl_f_4"]),
	quate_smart($_POST["v_pl_f_3"]),
	quate_smart($_POST["v_pl_f_2"]),
	quate_smart($_POST["v_pl_n_1"]),
	quate_smart($_POST["v_pl_n_4"]),
	quate_smart($_POST["v_pl_n_3"]),
	quate_smart($_POST["v_pl_n_2"]),
	$collation_1,
	quate_smart($_POST["keyword"]),
	quate_smart($_POST["num_keyword"])); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$oop->_mySQL;   
$page_id = 134; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
include './work.php';
if ($_GET["d_h_n"]==0) {
$_SESSION["ses_message"]=$lang_dec_verb10.''.$_GET["d_h"];
} else {
$_SESSION["ses_message"]=$lang_dec_verb10.'<sup>'.$_GET["d_h_n"].'</sup>'.$_GET["d_h"];	
}
$location = 'Location: ./d_edit_verb.php?action=verb4&d_h='.$_POST["keyword"].'&d_h_n='.$_POST["num_keyword"];
header($location);
}  
} else if ($_GET["verb4_action"]=='verb4_info') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$table = 'ds_dec_v_4';
if ($_GET["correct"]=='1') {
$status= '2';} else if ($_GET["correct"]=='2') {
$status = '3';
} else { $status= '1';}
$sql = sprintf ('UPDATE `%s` SET `status` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($status),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$oop->_mySQL;
$view_keyword=$_GET["d_h"];
$view_num_keyword=$_GET["d_h_n"];
include './scripts/verb_info_update.php';
$location = 'Location: ./d_edit_verb.php?d_h='.$_GET["d_h"].'&d_h_n='.$_GET["d_h_n"];
header($location);
} else if ($_GET["verb4_action"]=='verb4_nextword') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$table = 'ds_dec_v_4';
if ($_GET["correct"]=='1') {
$status= '2';} else if ($_GET["correct"]=='2') {
$status = '3';
} else { $status= '1';}
$working= '1';
$sql = sprintf ('UPDATE `%s` SET `status` = %s WHERE `keyword` COLLATE `%s`= %s AND `num_keyword` = %s',
	$table,					
	quate_smart($status),
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$status='2';
$status0='0';
$sql = sprintf ('SELECT * FROM `%s` WHERE `status` <> %s AND `status`<> %s AND `keyword` COLLATE `%s` > %s',
	$table,				
	quate_smart($status),
	quate_smart($status0),
	$collation_1,
	quate_smart($_GET["d_h"]));
$oop->Setnames();
$oop->query($sql);
$returned = $oop->FetchArray();
$oop->_mySQL;
$location = 'Location: ./d_edit_verb.php?d_h='.$_GET["d_h"].'&d_h_n='.$_GET["d_h_n"];
header($location);
}  
else  
{
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table='ds_dec_v_4';
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
document.getElementById("s_sg_m_1").focus();
}
function Delete_all() {
document.getElementById("s_sg_m_1").value='';
document.getElementById("s_sg_m_4").value='';
document.getElementById("s_sg_m_3").value='';
document.getElementById("s_sg_m_2").value='';
document.getElementById("s_sg_f_1").value='';
document.getElementById("s_sg_f_4").value='';
document.getElementById("s_sg_f_3").value='';
document.getElementById("s_sg_f_2").value='';
document.getElementById("s_sg_n_1").value='';
document.getElementById("s_sg_n_4").value='';
document.getElementById("s_sg_n_3").value='';
document.getElementById("s_sg_n_2").value='';
document.getElementById("s_pl_m_1").value='';
document.getElementById("s_pl_m_4").value='';
document.getElementById("s_pl_m_3").value='';
document.getElementById("s_pl_m_2").value='';
document.getElementById("s_pl_f_1").value='';
document.getElementById("s_pl_f_4").value='';
document.getElementById("s_pl_f_3").value='';
document.getElementById("s_pl_f_2").value='';
document.getElementById("s_pl_n_1").value='';
document.getElementById("s_pl_n_4").value='';
document.getElementById("s_pl_n_3").value='';
document.getElementById("s_pl_n_2").value='';
document.getElementById("v_sg_m_1").value='';
document.getElementById("v_sg_m_4").value='';
document.getElementById("v_sg_m_3").value='';
document.getElementById("v_sg_m_2").value='';
document.getElementById("v_sg_f_1").value='';
document.getElementById("v_sg_f_4").value='';
document.getElementById("v_sg_f_3").value='';
document.getElementById("v_sg_f_2").value='';
document.getElementById("v_sg_n_1").value='';
document.getElementById("v_sg_n_4").value='';
document.getElementById("v_sg_n_3").value='';
document.getElementById("v_sg_n_2").value='';
document.getElementById("v_pl_m_1").value='';
document.getElementById("v_pl_m_4").value='';
document.getElementById("v_pl_m_3").value='';
document.getElementById("v_pl_m_2").value='';
document.getElementById("v_pl_f_1").value='';
document.getElementById("v_pl_f_4").value='';
document.getElementById("v_pl_f_3").value='';
document.getElementById("v_pl_f_2").value='';
document.getElementById("v_pl_n_1").value='';
document.getElementById("v_pl_n_4").value='';
document.getElementById("v_pl_n_3").value='';
document.getElementById("v_pl_n_2").value='';
}
</script>
</head>
<body onload="setFocus()">
<div id="wrapper">
<?php include './header.php'; 
include './menu.php'; 
echo $MAIN_MENU;
?>
<form action="/d_edit_verb.php?action=verb4&verb4_action=verb4_confirm&d_h=<?=$_GET["d_h"]?>&d_h_n=<?=$_GET["d_h_n"]?>" method="post" name="form">
<div id="content">
<div class="left_huge"> 
<h2><?=$lang_dec_verb5?> 
<?php if ($_GET["d_h_n"]!=0) {
echo "<sup>".$_GET["d_h_n"]."</sup>";
} 
echo $_GET["d_h"];	 
?></h2>
<?php
$BUFFER_MENU='';
$BUFFER_MENU .= "<div class=\"menu_sub\">";
$BUFFER_MENU .= "<ul>"; 
$BUFFER_MENU .= "<li><input type=\"submit\" class=\"button3\" name=\"verb4_submit_direct\" value=\"".$lang_edit_submit."\"></li>";
$BUFFER_MENU .= "<li><a href=\"./d_edit_verb.php?action=verb4&verb4_action=verb4_nextword&correct=1&d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\">".$lang_dec_verb6."</a></li>";
$BUFFER_MENU .= "<li><a href=\"#\" onClick=\"Delete_all()\"\">".$lang_declination_del_all."</a></li>";
$BUFFER_MENU .= "<li><a href= \"http://bin.arnastofnun.is/leit.php?q=".$_GET["d_h"]." \" onclick= \"return popitup('http://bin.arnastofnun.is/leit.php?q=".$_GET["d_h"]."') \">".$lang_declination_bin."</a></li>";
$BUFFER_MENU .= "</ul>";	
$BUFFER_MENU .= "</div>";	
echo $BUFFER_MENU;
?>
<?php
$keyword = $returned[1]; $keyword_new=$returned[1];
?>
<input type="hidden" id="keyword" name="keyword" value="<?php echo $returned[1];?>">
<?php
$num_keyword = $returned[2]; $num_keyword_new=$returned[2];
?>
<input type="hidden" id="num_keyword" name="num_keyword" value="<?php echo $returned[2];?>">
<table class="sample">
<tr><th colspan="8"><?=$lang_dec_verb7?></th></tr>
<tr><th colspan="8"><?=$lang_declination_lysingarhattur_strong_dec?></th></tr>
<tr><th colspan="4"><?=$lang_declination_singular?></th><th colspan="4"><?=$lang_declination_plural?></th></tr>
<tr>
<td width="5%"></td>
<td width="15%"><?=$lang_declination_m?></td>
<td width="15%"><?=$lang_declination_f?></td>
<td width="15%"><?=$lang_declination_n?></td>
<td width="5%"></td>
<td width="15%"><?=$lang_declination_n?></td>
<td width="15%"><?=$lang_declination_f?></td>
<td width="15%"><?=$lang_declination_n?></td>
</tr>
<tr>
<td><?=$lang_declination_1_case?> </td>
<td>
<input type="text" class="inputbox_small" id="s_sg_m_1" onBlur="lasttext=this;" name="s_sg_m_1" size="18" maxlength="80" value="<?=$returned[4];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_sg_f_1" onBlur="lasttext=this;" name="s_sg_f_1" size="18" maxlength="80" value="<?=$returned[8];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_sg_n_1" onBlur="lasttext=this;" name="s_sg_n_1" size="18" maxlength="80" value="<?=$returned[12];?>"></td>
<td><?=$lang_declination_1_case?> </td>
<td>
<input type="text" class="inputbox_small" id="s_pl_m_1" onBlur="lasttext=this;" name="s_pl_m_1" size="18" maxlength="80" value="<?=$returned[16];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_f_1" onBlur="lasttext=this;" name="s_pl_f_1" size="18" maxlength="80" value="<?=$returned[20];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_n_1" onBlur="lasttext=this;" name="s_pl_n_1" size="18" maxlength="80" value="<?=$returned[24];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_4_case?> </td>
<td>
<input type="text" class="inputbox_small" id="s_sg_m_4" onBlur="lasttext=this;" name="s_sg_m_4" size="18" maxlength="80" value="<?=$returned[5];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_sg_f_4" onBlur="lasttext=this;" name="s_sg_f_4" size="18" maxlength="80" value="<?=$returned[9];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_sg_n_4" onBlur="lasttext=this;" name="s_sg_n_4" size="18" maxlength="80" value="<?=$returned[13];?>"></td>
<td><?=$lang_declination_4_case?> </td>
<td>
<input type="text" class="inputbox_small" id="s_pl_m_4" onBlur="lasttext=this;" name="s_pl_m_4" size="18" maxlength="80" value="<?=$returned[17];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_f_4" onBlur="lasttext=this;" name="s_pl_f_4" size="18" maxlength="80" value="<?=$returned[21];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_n_4" onBlur="lasttext=this;" name="s_pl_n_4" size="18" maxlength="80" value="<?=$returned[25];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_3_case?></td>
<td>
<input type="text" class="inputbox_small" id="s_sg_m_3" onBlur="lasttext=this;" name="s_sg_m_3" size="18" maxlength="80" value="<?=$returned[6];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_sg_f_3" onBlur="lasttext=this;" name="s_sg_f_3" size="18" maxlength="80" value="<?=$returned[10];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_sg_n_3" onBlur="lasttext=this;" name="s_sg_n_3" size="18" maxlength="80" value="<?=$returned[14];?>"></td>
<td><?=$lang_declination_3_case?></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_m_3" onBlur="lasttext=this;" name="s_pl_m_3" size="18" maxlength="80" value="<?=$returned[18];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_f_3" onBlur="lasttext=this;" name="s_pl_f_3" size="18" maxlength="80" value="<?=$returned[22];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_n_3" onBlur="lasttext=this;" name="s_pl_n_3" size="18" maxlength="80" value="<?=$returned[26];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_2_case?></td>
<td>
<input type="text" class="inputbox_small" id="s_sg_m_2" onBlur="lasttext=this;" name="s_sg_m_2" size="18" maxlength="80" value="<?=$returned[7];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_sg_f_2" onBlur="lasttext=this;" name="s_sg_f_2" size="18" maxlength="80" value="<?=$returned[11];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_sg_n_2" onBlur="lasttext=this;" name="s_sg_n_2" size="18" maxlength="80" value="<?=$returned[15];?>"></td>
<td><?=$lang_declination_2_case?></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_m_2" onBlur="lasttext=this;" name="s_pl_m_2" size="18" maxlength="80" value="<?=$returned[19];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_f_2" onBlur="lasttext=this;" name="s_pl_f_2" size="18" maxlength="80" value="<?=$returned[23];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_n_2" onBlur="lasttext=this;" name="s_pl_n_2" size="18" maxlength="80" value="<?=$returned[27];?>"></td>
</tr>
<tr><th colspan="8"><?=$lang_declination_lysingarhattur_strong_dec?></th></tr>
<tr><th colspan="4"><?=$lang_declination_singular?></th><th colspan="4"><?=$lang_declination_plural?></th></tr>
<tr>
<td width="5%"></td>
<td width="15%"><?=$lang_declination_m?></td>
<td width="15%"><?=$lang_declination_f?></td>
<td width="15%"><?=$lang_declination_n?></td>
<td width="5%"></td>
<td width="15%"><?=$lang_declination_n?></td>
<td width="15%"><?=$lang_declination_f?></td>
<td width="15%"><?=$lang_declination_n?></td>
</tr>
<tr>
<td><?=$lang_declination_1_case?></td>
<td>
<input type="text" class="inputbox_small" id="v_sg_m_1" onBlur="lasttext=this;" name="v_sg_m_1" size="18" maxlength="80" value="<?=$returned[28];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_sg_f_1" onBlur="lasttext=this;" name="v_sg_f_1" size="18" maxlength="80" value="<?=$returned[32];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_sg_n_1" onBlur="lasttext=this;" name="v_sg_n_1" size="18" maxlength="80" value="<?=$returned[36];?>"></td>
<td><?=$lang_declination_1_case?></td>
<td>
<input type="text" class="inputbox_small" id="v_pl_m_1" onBlur="lasttext=this;" name="v_pl_m_1" size="18" maxlength="80" value="<?=$returned[40];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_pl_f_1" onBlur="lasttext=this;" name="v_pl_f_1" size="18" maxlength="80" value="<?=$returned[44];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_pl_n_1" onBlur="lasttext=this;" name="v_pl_n_1" size="18" maxlength="80" value="<?=$returned[48];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_4_case?></td>
<td>
<input type="text" class="inputbox_small" id="v_sg_m_4" onBlur="lasttext=this;" name="v_sg_m_4" size="18" maxlength="80" value="<?=$returned[29];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_sg_f_4" onBlur="lasttext=this;" name="v_sg_f_4" size="18" maxlength="80" value="<?=$returned[33];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_sg_n_4" onBlur="lasttext=this;" name="v_sg_n_4" size="18" maxlength="80" value="<?=$returned[37];?>"></td>
<td><?=$lang_declination_4_case?> </td>
<td>
<input type="text" class="inputbox_small" id="v_pl_m_4" onBlur="lasttext=this;" name="v_pl_m_4" size="18" maxlength="80" value="<?=$returned[41];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_pl_f_4" onBlur="lasttext=this;" name="v_pl_f_4" size="18" maxlength="80" value="<?=$returned[45];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_pl_n_4" onBlur="lasttext=this;" name="v_pl_n_4" size="18" maxlength="80" value="<?=$returned[49];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_3_case?></td>
<td>
<input type="text" class="inputbox_small" id="v_sg_m_3" onBlur="lasttext=this;" name="v_sg_m_3" size="18" maxlength="80" value="<?=$returned[30];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_sg_f_3" onBlur="lasttext=this;" name="v_sg_f_3" size="18" maxlength="80" value="<?=$returned[34];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_sg_n_3" onBlur="lasttext=this;" name="v_sg_n_3" size="18" maxlength="80" value="<?=$returned[38];?>"></td>
<td><?=$lang_declination_3_case?></td>
<td>
<input type="text" class="inputbox_small" id="v_pl_m_3" onBlur="lasttext=this;" name="v_pl_m_3" size="18" maxlength="80" value="<?=$returned[42];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_pl_f_3" onBlur="lasttext=this;" name="v_pl_f_3" size="18" maxlength="80" value="<?=$returned[46];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_pl_n_3" onBlur="lasttext=this;" name="v_pl_n_3" size="18" maxlength="80" value="<?=$returned[50];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_2_case?></td>
<td>
<input type="text" class="inputbox_small" id="v_sg_m_2" onBlur="lasttext=this;" name="v_sg_m_2" size="18" maxlength="80" value="<?=$returned[31];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_sg_f_2" onBlur="lasttext=this;" name="v_sg_f_2" size="18" maxlength="80" value="<?=$returned[35];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_sg_n_2" onBlur="lasttext=this;" name="v_sg_n_2" size="18" maxlength="80" value="<?=$returned[39];?>"></td>
<td><?=$lang_declination_2_case?></td>
<td>
<input type="text" class="inputbox_small" id="v_pl_m_2" onBlur="lasttext=this;" name="v_pl_m_2" size="18" maxlength="80" value="<?=$returned[43];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_pl_f_2" onBlur="lasttext=this;" name="v_pl_f_2" size="18" maxlength="80" value="<?=$returned[47];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_pl_n_2" onBlur="lasttext=this;" name="v_pl_n_2" size="18" maxlength="80" value="<?=$returned[51];?>"></td>
</tr>
</table>
</form>

</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div>
<?php
$oop->freeResult();
$oop->_mySQL;
?>
<?php 
}
} else if ($_GET["action"]=='add'){
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop3 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$view_keyword=$_GET["d_h"];
$view_num_keyword=$_GET["d_h_n"];
$table2 = 'ds_dec_v_info';
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`=%s',
	$table2,
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]));
$oop->Setnames();
$oop->query($sql);
$num = $oop->getNumRows();
$oop->freeResult();
if ($num==0) {
$num_added++;
$status_keyword=3;
$status_exists=2;
$sql2 = sprintf ('INSERT INTO `%s` (`id`, `keyword`, `num_keyword`, `status_keyword`, `germynd`, `midmynd`, `bodhattur`, `lysingarhattur`) VALUES (NULL, %s, %s, %s, %s, %s, %s, %s)',
	$table2,					
	quate_smart($view_keyword),
	quate_smart($view_num_keyword),
	quate_smart($status_keyword),
	quate_smart($status_exists),
	quate_smart($status_exists),
	quate_smart($status_exists),
	quate_smart($status_exists));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$action_scripts="gen_verb1";
include './scripts/d_scripts_verb.php';
$action_scripts="";
$action_scripts="gen_verb2";
include './scripts/d_scripts_verb.php';
$action_scripts="";
$action_scripts="gen_verb3";
include './scripts/d_scripts_verb.php';
$action_scripts="";
$action_scripts="gen_verb4";
include './scripts/d_scripts_verb.php';
$action_scripts="";
$oop->freeResult();
$oop->_mySQL;
$view_keyword=$_GET["d_h"];
$view_num_keyword=$_GET["d_h_n"];
$page_id = 135; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
include './work.php';
if ($view_num_keyword!=0) {
$_SESSION["ses_message"]=$lang_dec_noun2.'<sup>'.$view_num_keyword.'</sup> '.$view_keyword.''.$lang_dec_adj10;
} else {
$_SESSION["ses_message"]=$lang_dec_noun2.''.$view_keyword.' '.$lang_dec_adj10;	
}
$location = 'Location: ./search.php?d_h='.$view_keyword.'&d_h_n='.$view_num_keyword.'';
header($location);
} else {
if ($view_num_keyword!=0) {	
$_SESSION["ses_message"]=$lang_dec_noun2.'<sup>'.$view_num_keyword.'</sup>'.$view_keyword.''.$lang_dec_adj11;
} else {
$_SESSION["ses_message"]=$lang_dec_noun2.' '.$view_keyword.''.$lang_dec_adj11;
}
$location = 'Location: ./search.php?d_h='.$view_keyword.'&d_h_n='.$view_num_keyword.'';
header($location);	
}
} else if ($_GET["action"]=='delete'){
$view_keyword=$_GET["d_h"];
$view_num_keyword=$_GET["d_h_n"];	
if ($_GET["del"]=='TRUE') {
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$table2 = 'ds_dec_v_info';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$table2 = 'ds_dec_v_1';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$table2 = 'ds_dec_v_2';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$table2 = 'ds_dec_v_3';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$table2 = 'ds_dec_v_4';
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
$page_id = 136; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
include './work.php';
if ($view_num_keyword!=0) {	
$_SESSION["ses_message"]=$lang_dec_verb11.'<sup>'.$view_num_keyword.'</sup>'.$view_keyword.''.$lang_dec_verb12;
} else {
$_SESSION["ses_message"]=$lang_dec_verb11.' '.$view_keyword.''.$lang_dec_verb12;
}
$location = 'Location: ./search.php?d_h='.$view_keyword.'&d_h_n='.$view_num_keyword.'';
header($location);
} else {
?>
</head>
<body onload="setfocus ()">
<div id="wrapper">
<?php include './header.php';
include './menu.php'; 
echo $MAIN_MENU;
?><div id="content">
<div class="left_huge">
<h2><?=$lang_dec_verb11?>
<?php if ($_GET["d_h_n"]!=0) {
echo "<sup>".$_GET["d_h_n"]."</sup>";
} 
echo $_GET["d_h"];	 
?></h2>
<?php
echo $lang_dec_verb14."<br>";
echo " <a href=\"./d_edit_verb.php?action=delete&del=TRUE&d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\"> ".$lang_edit_del_yes." </a>";
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
} else {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table='ds_dec_v_info';
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
</head>
<body onload="setfocus ()">
<div id="wrapper">
<?php include './header.php';
include './menu.php'; 
echo $MAIN_MENU;
$oop_sub = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table=  'ds_dec_v_info';
?>
<form action="/d_edit_verb.php?action=confirm&d_h=<?=$_GET["d_h"]?>&d_h_n=<?=$_GET["d_h_n"]?>" method="post" name="form">
<div id="content">
<div class="left_huge">
<h2><?=$lang_dec_verb11?> 
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
$BUFFER_MENU .= "<li><a href=\"./d_edit_verb.php?action=nextword&correct=1&d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\">".$lang_declination_saving."</a></li>";
$BUFFER_MENU .= "<li><a href=\"./search.php?list_kind=alpha&amp;d_h=".$_GET["d_h"]."&amp;d_h_n=".$_GET["d_h_n"]."\">".$lang_back2."</a></li>";
$BUFFER_MENU .= "<li><a href= \"http://bin.arnastofnun.is/leit.php?q=".$_GET["d_h"]." \" onclick= \"return popitup('http://bin.arnastofnun.is/leit.php?q=".$_GET["d_h"]."') \">".$lang_declination_bin."</a></li>";
$BUFFER_MENU .= "</ul>";	
$BUFFER_MENU .= "</div>";	
echo $BUFFER_MENU;
?>
<table class="sample">
<tr><th colspan="8"><?=$lang_dec_verb13?></th></tr>
<?php
$keyword = $returned[1]; $keyword_new=$returned[1];
?>
<input type="hidden" id="keyword" name="keyword" value="<?php echo $returned[1];?>">
<?php
$num_keyword = $returned[2]; $num_keyword_new=$returned[2];
?>
<input type="hidden" id="num_keyword" name="num_keyword" value="<?php echo $returned[2];?>">
<tr>
<td width="15%"><?=$lang_declination_germynd?></td>
<td>
<select name="germynd" >
<option value="0" <?php if ($returned[4]==0) { echo 'selected';}?>> <?=$lang_declination_notexist?></option>
<option value="1" <?php if ($returned[4]==1) { echo 'selected';}?>><?=$lang_declination_unclear?></option>
<option value="2" <?php if ($returned[4]==2) { echo 'selected';}?>> <?=$lang_declination_exist?></option>
</select> 
<?php
if ($returned[4]!=0) {
echo " <a href=\"./d_edit_verb.php?action=verb1&d_h=".$keyword."&d_h_n=".$num_keyword."\">Upravit<a>";	
}
?>
</td>
</tr>
<tr>
<td width="15%"><?=$lang_declination_midmynd?></td>
<td>
<select name="midmynd" >
<option value="0" <?php if ($returned[6]==0) { echo 'selected';}?>> <?=$lang_declination_notexist?></option>
<option value="1" <?php if ($returned[6]==1) { echo 'selected';}?>> <?=$lang_declination_unclear?></option>
<option value="2" <?php if ($returned[6]==2) { echo 'selected';}?>> <?=$lang_declination_exist?></option>
</select> 
<?php
if ($returned[6]!=0) {
echo " <a href=\"./d_edit_verb.php?action=verb2&d_h=".$keyword."&d_h_n=".$num_keyword."\">Upravit<a>";	
 }
?>
</td>
</tr>
<tr>
<td width="15%"><?=$lang_declination_bodhattur?></td>
<td>
<select name="bodhattur" >
<option value="0" <?php if ($returned[8]==0) { echo 'selected';}?>> <?=$lang_declination_notexist?></option>
<option value="1" <?php if ($returned[8]==1) { echo 'selected';}?>> <?=$lang_declination_unclear?></option>
<option value="2" <?php if ($returned[8]==2) { echo 'selected';}?>> <?=$lang_declination_exist?></option>
</select> 
<?php
if ($returned[8]!=0) {
echo " <a href=\"./d_edit_verb.php?action=verb3&d_h=".$keyword."&d_h_n=".$num_keyword."\">Upravit<a>";	
 }
?>
</td>
</tr>
<tr>
<td width="15%"><?=$lang_declination_lysingarhattur?></td>
<td>
<select name="lysingarhattur" >
<option value="0" <?php if ($returned[10]==0) { echo 'selected';}?>> <?=$lang_declination_notexist?></option>
<option value="1" <?php if ($returned[10]==1) { echo 'selected';}?>> <?=$lang_declination_unclear?></option>
<option value="2" <?php if ($returned[10]==2) { echo 'selected';}?>> <?=$lang_declination_exist?></option>
</select> 
<?php
if ($returned[10]!=0) {
echo " <a href=\"./d_edit_verb.php?action=verb4&d_h=".$keyword."&d_h_n=".$num_keyword."\">Upravit<a>";	
}
?>
</td>
</tr>
</table>
</form>
<br>
<?php
$view_keyword=$returned[1];
$view_num_keyword=$returned[2];
include './scripts/view_declination_verb_all.php';
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