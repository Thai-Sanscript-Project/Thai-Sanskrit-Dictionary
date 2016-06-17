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
$table = 'ds_dec_adj_info';
$sql = sprintf ('UPDATE `%s` SET `stig_1` = %s, `stig_2` = %s, `stig_3` = %s  WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$table,					
	quate_smart(trim($_POST["stig_1"])),
	quate_smart(trim($_POST["stig_2"])),
	quate_smart(trim($_POST["stig_3"])),
	$collation_1,
	quate_smart($_POST["keyword"]),
	quate_smart($_POST["num_keyword"])); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$oop->_mySQL;   
$view_keyword=$_POST["keyword"];
$view_num_keyword=$_POST["num_keyword"];
$action_scripts='adj_info_update';
include './scripts/d_scripts_adj.php';
$location = 'Location: ./d_edit_adj.php?d_h='.$_POST["keyword"].'&d_h_n='.$_POST["num_keyword"];
header($location);
}
} else if ($_GET["action"]=='nextword') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$page_id = 100; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
$table = 'ds_dec_adj_info';
if ($_GET["correct"]=='1') {
$status= '2';} else if ($_GET["correct"]=='2') {
$status = '3';
} else { $status= '1';}
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
$action_scripts='adj_info_update';
include './scripts/d_scripts_adj.php';
$table_declination='ds_wordform';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table_declination,
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]));
$oop->Setnames();
$oop->query($sql2);
$oop->freeResult();
$action_scripts='adj_generate_single_script';
include './scripts/d_scripts_adj.php';
if ($_GET["d_h_n"]==0) {
$_SESSION["ses_message"].=$lang_dec_adj9.' '.$_GET["d_h"].''.$lang_dec_adj10;
} else {
$_SESSION["ses_message"].=$lang_dec_adj9.' <sup>'.$_GET["d_h_n"].'</sup>'.$_GET["d_h"].' '.$lang_dec_adj10;	
}
$page_id = 105; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
include './work.php';
$location = 'Location: ./search.php?list_kind=alpha&d_h='.$_GET["d_h"].'&d_h_n='.$_GET["d_h_n"].'&correct=1';
header($location);
Die();
} else if ($_GET["action"]=='adj1') {
if ($_GET["adj1_action"]=='adj1_confirm') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
if ($_POST["adj1_submit_direct"]) {
$table = 'ds_dec_adj_1';
$sql = sprintf ('UPDATE `%s` SET `s_sg_m_1` = %s, `s_sg_m_4` = %s, `s_sg_m_3` = %s, `s_sg_m_2` = %s, `s_sg_f_1` = %s, `s_sg_f_4` = %s, `s_sg_f_3` = %s, `s_sg_f_2` = %s, `s_sg_n_1` = %s, `s_sg_n_4` = %s, `s_sg_n_3` = %s, `s_sg_n_2` = %s, `s_pl_m_1` = %s, `s_pl_m_4` = %s, `s_pl_m_3` = %s, `s_pl_m_2` = %s, `s_pl_f_1` = %s, `s_pl_f_4` = %s, `s_pl_f_3` = %s, `s_pl_f_2` = %s, `s_pl_n_1` = %s, `s_pl_n_4` = %s, `s_pl_n_3` = %s, `s_pl_n_2` = %s, `v_sg_m_1` = %s, `v_sg_m_4` = %s, `v_sg_m_3` = %s, `v_sg_m_2` = %s, `v_sg_f_1` = %s, `v_sg_f_4` = %s, `v_sg_f_3` = %s, `v_sg_f_2` = %s, `v_sg_n_1` = %s, `v_sg_n_4` = %s, `v_sg_n_3` = %s, `v_sg_n_2` = %s, `v_pl_m_1` = %s, `v_pl_m_4` = %s, `v_pl_m_3` = %s, `v_pl_m_2` = %s, `v_pl_f_1` = %s, `v_pl_f_4` = %s, `v_pl_f_3` = %s, `v_pl_f_2` = %s, `v_pl_n_1` = %s, `v_pl_n_4` = %s, `v_pl_n_3` = %s, `v_pl_n_2` = %s WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$table,					
	quate_smart(trim($_POST["s_sg_m_1"])),
	quate_smart(trim($_POST["s_sg_m_4"])),
	quate_smart(trim($_POST["s_sg_m_3"])),
	quate_smart(trim($_POST["s_sg_m_2"])),
	quate_smart(trim($_POST["s_sg_f_1"])),
	quate_smart(trim($_POST["s_sg_f_4"])),
	quate_smart(trim($_POST["s_sg_f_3"])),
	quate_smart(trim($_POST["s_sg_f_2"])),
	quate_smart(trim($_POST["s_sg_n_1"])),
	quate_smart(trim($_POST["s_sg_n_4"])),
	quate_smart(trim($_POST["s_sg_n_3"])),
	quate_smart(trim($_POST["s_sg_n_2"])),
	quate_smart(trim($_POST["s_pl_m_1"])),
	quate_smart(trim($_POST["s_pl_m_4"])),
	quate_smart(trim($_POST["s_pl_m_3"])),
	quate_smart(trim($_POST["s_pl_m_2"])),
	quate_smart(trim($_POST["s_pl_f_1"])),
	quate_smart(trim($_POST["s_pl_f_4"])),
	quate_smart(trim($_POST["s_pl_f_3"])),
	quate_smart(trim($_POST["s_pl_f_2"])),
	quate_smart(trim($_POST["s_pl_n_1"])),
	quate_smart(trim($_POST["s_pl_n_4"])),
	quate_smart(trim($_POST["s_pl_n_3"])),
	quate_smart(trim($_POST["s_pl_n_2"])),				
	quate_smart(trim($_POST["v_sg_m_1"])),
	quate_smart(trim($_POST["v_sg_m_4"])),
	quate_smart(trim($_POST["v_sg_m_3"])),
	quate_smart(trim($_POST["v_sg_m_2"])),
	quate_smart(trim($_POST["v_sg_f_1"])),
	quate_smart(trim($_POST["v_sg_f_4"])),
	quate_smart(trim($_POST["v_sg_f_3"])),
	quate_smart(trim($_POST["v_sg_f_2"])),
	quate_smart(trim($_POST["v_sg_n_1"])),
	quate_smart(trim($_POST["v_sg_n_4"])),
	quate_smart(trim($_POST["v_sg_n_3"])),
	quate_smart(trim($_POST["v_sg_n_2"])),
	quate_smart(trim($_POST["v_pl_m_1"])),
	quate_smart(trim($_POST["v_pl_m_4"])),
	quate_smart(trim($_POST["v_pl_m_3"])),
	quate_smart(trim($_POST["v_pl_m_2"])),
	quate_smart(trim($_POST["v_pl_f_1"])),
	quate_smart(trim($_POST["v_pl_f_4"])),
	quate_smart(trim($_POST["v_pl_f_3"])),
	quate_smart(trim($_POST["v_pl_f_2"])),
	quate_smart(trim($_POST["v_pl_n_1"])),
	quate_smart(trim($_POST["v_pl_n_4"])),
	quate_smart(trim($_POST["v_pl_n_3"])),
	quate_smart(trim($_POST["v_pl_n_2"])),
	$collation_1,
	quate_smart($_POST["keyword"]),
	quate_smart($_POST["num_keyword"])); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$oop->_mySQL;
$page_id = 109; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
include './work.php';
$_SESSION["ses_message"].=$lang_dec_adj3;
$location = 'Location: ./d_edit_adj.php?action=adj1&d_h='.$_POST["keyword"].'&d_h_n='.$_POST["num_keyword"];
header($location);
} 
}
else  
{
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop9 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table = 'ds_dec_adj_1';
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
document.getElementById("s_sg_m_1").value='';
document.getElementById("s_sg_f_1").value='';
document.getElementById("s_sg_n_1").value='';
document.getElementById("s_pl_m_1").value='';
document.getElementById("s_pl_f_1").value='';
document.getElementById("s_pl_n_1").value='';

document.getElementById("s_sg_m_4").value='';
document.getElementById("s_sg_f_4").value='';
document.getElementById("s_sg_n_4").value='';
document.getElementById("s_pl_m_4").value='';
document.getElementById("s_pl_f_4").value='';
document.getElementById("s_pl_n_4").value='';

document.getElementById("s_sg_m_3").value='';
document.getElementById("s_sg_f_3").value='';
document.getElementById("s_sg_n_3").value='';
document.getElementById("s_pl_m_3").value='';
document.getElementById("s_pl_f_3").value='';
document.getElementById("s_pl_n_3").value='';

document.getElementById("s_sg_m_2").value='';
document.getElementById("s_sg_f_2").value='';
document.getElementById("s_sg_n_2").value='';
document.getElementById("s_pl_m_2").value='';
document.getElementById("s_pl_f_2").value='';
document.getElementById("s_pl_n_2").value='';

document.getElementById("v_sg_m_1").value='';
document.getElementById("v_sg_f_1").value='';
document.getElementById("v_sg_n_1").value='';
document.getElementById("v_pl_m_1").value='';
document.getElementById("v_pl_f_1").value='';
document.getElementById("v_pl_n_1").value='';

document.getElementById("v_sg_m_4").value='';
document.getElementById("v_sg_f_4").value='';
document.getElementById("v_sg_n_4").value='';
document.getElementById("v_pl_m_4").value='';
document.getElementById("v_pl_f_4").value='';
document.getElementById("v_pl_n_4").value='';

document.getElementById("v_sg_m_3").value='';
document.getElementById("v_sg_f_3").value='';
document.getElementById("v_sg_n_3").value='';
document.getElementById("v_pl_m_3").value='';
document.getElementById("v_pl_f_3").value='';
document.getElementById("v_pl_n_3").value='';

document.getElementById("v_sg_m_2").value='';
document.getElementById("v_sg_f_2").value='';
document.getElementById("v_sg_n_2").value='';
document.getElementById("v_pl_m_2").value='';
document.getElementById("v_pl_f_2").value='';
document.getElementById("v_pl_n_2").value='';
}
</script>
<script type="text/javascript">
function setFocus2()
{
document.getElementById("s_sg_m_1").focus();
}
</script>
</head>
<body onload="setFocus2()">
<div id="wrapper">
<?php include './header.php';
include './menu.php';
echo $MAIN_MENU;
?>
<form action="/d_edit_adj.php?action=adj1&adj1_action=adj1_confirm&d_h=<?=$_GET["d_h"]?>&d_h_n=<?=$_GET["d_h_n"]?>" method="post" name="form">
<div id="content">
<div class="left_huge">
<h2><?=$lang_dec_adj1?>
<?php if ($_GET["d_h_n"]!=0) {
echo "<sup>".$_GET["d_h_n"]."</sup>";
} 
echo $_GET["d_h"];	 
?></h2>
<?php
$BUFFER_MENU='';
$BUFFER_MENU .= "<div class=\"menu_sub\">";
$BUFFER_MENU .= "<ul>"; 
$BUFFER_MENU .= "<li><input type=\"submit\" class=\"button3\" name=\"adj1_submit_direct\" value=\"".$lang_edit_submit."\"></li>";
$BUFFER_MENU .= "<li><a href=\"./d_edit_adj.php?d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\">".$lang_back1."</a></li>";
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
<tr><th colspan="8"><?=$lang_dec_adj2?></th></tr>
<tr><th colspan="8"><?=$lang_declination_positive_strong_dec?></th></tr>
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
<input type="text" class="inputbox_small" id="s_sg_m_1" onBlur="lasttext=this;" name="s_sg_m_1" size="18" maxlength="80" value="<?=$returned[4];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_sg_f_1" onBlur="lasttext=this;" name="s_sg_f_1" size="18" maxlength="80" value="<?=$returned[8];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_sg_n_1" onBlur="lasttext=this;" name="s_sg_n_1" size="18" maxlength="80" value="<?=$returned[12];?>"></td>
<td><?=$lang_declination_1_case?></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_m_1" onBlur="lasttext=this;" name="s_pl_m_1" size="18" maxlength="80" value="<?=$returned[16];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_f_1" onBlur="lasttext=this;" name="s_pl_f_1" size="18" maxlength="80" value="<?=$returned[20];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_n_1" onBlur="lasttext=this;" name="s_pl_n_1" size="18" maxlength="80" value="<?=$returned[24];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_4_case?></td>
<td>
<input type="text" class="inputbox_small" id="s_sg_m_4" onBlur="lasttext=this;" name="s_sg_m_4" size="18" maxlength="80" value="<?=$returned[5];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_sg_f_4" onBlur="lasttext=this;" name="s_sg_f_4" size="18" maxlength="80" value="<?=$returned[9];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_sg_n_4" onBlur="lasttext=this;" name="s_sg_n_4" size="18" maxlength="80" value="<?=$returned[13];?>"></td>
<td><?=$lang_declination_4_case?></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_m_4" onBlur="lasttext=this;" name="s_pl_m_4" size="18" maxlength="80" value="<?=$returned[17];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_f_4" onBlur="lasttext=this;" name="s_pl_f_4" size="18" maxlength="80" value="<?=$returned[21];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_n_4" onBlur="lasttext=this;" name="s_pl_n_4" size="18" maxlength="80" value="<?=$returned[25];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_3_case?> </td>
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
<tr><th colspan="8"><?=$lang_declination_positive_weak_dec?></th></tr>
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
<td><?=$lang_declination_4_case?> </td>
<td>
<input type="text" class="inputbox_small" id="v_sg_m_4" onBlur="lasttext=this;" name="v_sg_m_4" size="18" maxlength="80" value="<?=$returned[29];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_sg_f_4" onBlur="lasttext=this;" name="v_sg_f_4" size="18" maxlength="80" value="<?=$returned[33];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_sg_n_4" onBlur="lasttext=this;" name="v_sg_n_4" size="18" maxlength="80" value="<?=$returned[37];?>"></td>
<td><?=$lang_declination_4_case?></td>
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
<td><?=$lang_declination_2_case?> </td>
<td>
<input type="text" class="inputbox_small" id="v_sg_m_2" onBlur="lasttext=this;" name="v_sg_m_2" size="18" maxlength="80" value="<?=$returned[31];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_sg_f_2" onBlur="lasttext=this;" name="v_sg_f_2" size="18" maxlength="80" value="<?=$returned[35];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_sg_n_2" onBlur="lasttext=this;" name="v_sg_n_2" size="18" maxlength="80" value="<?=$returned[39];?>"></td>
<td><?=$lang_declination_2_case?> </td>
<td>
<input type="text" class="inputbox_small" id="v_pl_m_2" onBlur="lasttext=this;" name="v_pl_m_2" size="18" maxlength="80" value="<?=$returned[43];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_pl_f_2" onBlur="lasttext=this;" name="v_pl_f_2" size="18" maxlength="80" value="<?=$returned[47];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_pl_n_2" onBlur="lasttext=this;" name="v_pl_n_2" size="18" maxlength="80" value="<?=$returned[51];?>"></td>
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
} 
else if ($_GET["action"]=='adj2') {
if ($_GET["adj2_action"]=='adj2_confirm') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
if ($_POST["adj2_submit_direct"]) {
$table = 'ds_dec_adj_2';
$sql = sprintf ('UPDATE `%s` SET `s_sg_m_1` = %s, `s_sg_m_4` = %s, `s_sg_m_3` = %s, `s_sg_m_2` = %s, `s_sg_f_1` = %s, `s_sg_f_4` = %s, `s_sg_f_3` = %s, `s_sg_f_2` = %s, `s_sg_n_1` = %s, `s_sg_n_4` = %s, `s_sg_n_3` = %s, `s_sg_n_2` = %s, `s_pl_m_1` = %s, `s_pl_m_4` = %s, `s_pl_m_3` = %s, `s_pl_m_2` = %s, `s_pl_f_1` = %s, `s_pl_f_4` = %s, `s_pl_f_3` = %s, `s_pl_f_2` = %s, `s_pl_n_1` = %s, `s_pl_n_4` = %s, `s_pl_n_3` = %s, `s_pl_n_2` = %s WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$table,					
	quate_smart(trim($_POST["s_sg_m_1"])),
	quate_smart(trim($_POST["s_sg_m_4"])),
	quate_smart(trim($_POST["s_sg_m_3"])),
	quate_smart(trim($_POST["s_sg_m_2"])),
	quate_smart(trim($_POST["s_sg_f_1"])),
	quate_smart(trim($_POST["s_sg_f_4"])),
	quate_smart(trim($_POST["s_sg_f_3"])),
	quate_smart(trim($_POST["s_sg_f_2"])),
	quate_smart(trim($_POST["s_sg_n_1"])),
	quate_smart(trim($_POST["s_sg_n_4"])),
	quate_smart(trim($_POST["s_sg_n_3"])),
	quate_smart(trim($_POST["s_sg_n_2"])),
	quate_smart(trim($_POST["s_pl_m_1"])),
	quate_smart(trim($_POST["s_pl_m_4"])),
	quate_smart(trim($_POST["s_pl_m_3"])),
	quate_smart(trim($_POST["s_pl_m_2"])),
	quate_smart(trim($_POST["s_pl_f_1"])),
	quate_smart(trim($_POST["s_pl_f_4"])),
	quate_smart(trim($_POST["s_pl_f_3"])),
	quate_smart(trim($_POST["s_pl_f_2"])),
	quate_smart(trim($_POST["s_pl_n_1"])),
	quate_smart(trim($_POST["s_pl_n_4"])),
	quate_smart(trim($_POST["s_pl_n_3"])),
	quate_smart(trim($_POST["s_pl_n_2"])),
	$collation_1,
	quate_smart($_POST["keyword"]),
	quate_smart($_POST["num_keyword"])); 
echo $sql;
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$oop->_mySQL;
$page_id = 108; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
include './work.php';
$_SESSION["ses_message"].=$lang_dec_adj4;
$location = 'Location: ./d_edit_adj.php?action=adj2&d_h='.$_POST["keyword"].'&d_h_n='.$_POST["num_keyword"];
header($location);
} 
} 
else  
{
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop9 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table = 'ds_dec_adj_2';
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
document.getElementById("s_sg_m_1").value='';
document.getElementById("s_sg_f_1").value='';
document.getElementById("s_sg_n_1").value='';
document.getElementById("s_pl_m_1").value='';
document.getElementById("s_pl_f_1").value='';
document.getElementById("s_pl_n_1").value='';
document.getElementById("s_sg_m_4").value='';
document.getElementById("s_sg_f_4").value='';
document.getElementById("s_sg_n_4").value='';
document.getElementById("s_pl_m_4").value='';
document.getElementById("s_pl_f_4").value='';
document.getElementById("s_pl_n_4").value='';
document.getElementById("s_sg_m_3").value='';
document.getElementById("s_sg_f_3").value='';
document.getElementById("s_sg_n_3").value='';
document.getElementById("s_pl_m_3").value='';
document.getElementById("s_pl_f_3").value='';
document.getElementById("s_pl_n_3").value='';
document.getElementById("s_sg_m_2").value='';
document.getElementById("s_sg_f_2").value='';
document.getElementById("s_sg_n_2").value='';
document.getElementById("s_pl_m_2").value='';
document.getElementById("s_pl_f_2").value='';
document.getElementById("s_pl_n_2").value='';
}
function setFocus2()
{
document.getElementById("s_sg_m_1").focus();
}
</script>
</head>
<body onload="setFocus2()">
<div id="wrapper">
<?php include './header.php'; 
include './menu.php'; 
echo $MAIN_MENU;
?>
<form action="/d_edit_adj.php?action=adj2&adj2_action=adj2_confirm&d_h=<?=$_GET["d_h"]?>&d_h_n=<?=$_GET["d_h_n"]?>" method="post" name="form">
<div id="content">
<div class="left_huge">
<h2><?=$lang_dec_adj6?>
<?php if ($_GET["d_h_n"]!=0) {
echo "<sup>".$_GET["d_h_n"]."</sup>";
} 
echo $_GET["d_h"];	 
?></h2>
<?php
$BUFFER_MENU='';
$BUFFER_MENU .= "<div class=\"menu_sub\">";
$BUFFER_MENU .= "<ul>"; 
$BUFFER_MENU .= "<li><input type=\"submit\" class=\"button3\" name=\"adj2_submit_direct\" value=\"".$lang_edit_submit."\"></li>";
$BUFFER_MENU .= "<li><a href=\"./d_edit_adj.php?d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\">".$lang_back1."</a></li>";
$BUFFER_MENU .= "<li><a href= \"http://bin.arnastofnun.is/leit.php?q=".$_GET["d_h"]." \" onclick= \"return popitup('http://bin.arnastofnun.is/leit.php?q=".$_GET["d_h"]."') \">".$lang_declination_bin."</a></li>";
$BUFFER_MENU .= "</ul>";	
$BUFFER_MENU .= "</div>";	
echo $BUFFER_MENU; ?> 
<?php

?>
<input type="hidden" id="keyword" name="keyword" value="<?=$_GET["d_h"]?>">
<?php

?>
<input type="hidden" id="num_keyword" name="num_keyword" value="<?=$_GET["d_h_n"];?>">
<table class="sample">
<tr><th colspan="8"><?=$lang_dec_adj2?></th></tr>
<tr><th colspan="8"><?=$lang_declination_comparative_weak_dec?></th></tr>
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
<td><?=$lang_declination_3_case?> </td>
<td>
<input type="text" class="inputbox_small" id="s_sg_m_3" onBlur="lasttext=this;" name="s_sg_m_3" size="18" maxlength="80" value="<?=$returned[6];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_sg_f_3" onBlur="lasttext=this;" name="s_sg_f_3" size="18" maxlength="80" value="<?=$returned[10];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_sg_n_3" onBlur="lasttext=this;" name="s_sg_n_3" size="18" maxlength="80" value="<?=$returned[14];?>"></td>
<td><?=$lang_declination_3_case?> </td>
<td>
<input type="text" class="inputbox_small" id="s_pl_m_3" onBlur="lasttext=this;" name="s_pl_m_3" size="18" maxlength="80" value="<?=$returned[18];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_f_3" onBlur="lasttext=this;" name="s_pl_f_3" size="18" maxlength="80" value="<?=$returned[22];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_n_3" onBlur="lasttext=this;" name="s_pl_n_3" size="18" maxlength="80" value="<?=$returned[26];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_2_case?> </td>
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
} else if ($_GET["action"]=='adj3') {
if ($_GET["adj3_action"]=='adj3_confirm') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
if ($_POST["adj3_submit_direct"]) {
$table = 'ds_dec_adj_3';
$sql = sprintf ('UPDATE `%s` SET `s_sg_m_1` = %s, `s_sg_m_4` = %s, `s_sg_m_3` = %s, `s_sg_m_2` = %s, `s_sg_f_1` = %s, `s_sg_f_4` = %s, `s_sg_f_3` = %s, `s_sg_f_2` = %s, `s_sg_n_1` = %s, `s_sg_n_4` = %s, `s_sg_n_3` = %s, `s_sg_n_2` = %s, `s_pl_m_1` = %s, `s_pl_m_4` = %s, `s_pl_m_3` = %s, `s_pl_m_2` = %s, `s_pl_f_1` = %s, `s_pl_f_4` = %s, `s_pl_f_3` = %s, `s_pl_f_2` = %s, `s_pl_n_1` = %s, `s_pl_n_4` = %s, `s_pl_n_3` = %s, `s_pl_n_2` = %s, `v_sg_m_1` = %s, `v_sg_m_4` = %s, `v_sg_m_3` = %s, `v_sg_m_2` = %s, `v_sg_f_1` = %s, `v_sg_f_4` = %s, `v_sg_f_3` = %s, `v_sg_f_2` = %s, `v_sg_n_1` = %s, `v_sg_n_4` = %s, `v_sg_n_3` = %s, `v_sg_n_2` = %s, `v_pl_m_1` = %s, `v_pl_m_4` = %s, `v_pl_m_3` = %s, `v_pl_m_2` = %s, `v_pl_f_1` = %s, `v_pl_f_4` = %s, `v_pl_f_3` = %s, `v_pl_f_2` = %s, `v_pl_n_1` = %s, `v_pl_n_4` = %s, `v_pl_n_3` = %s, `v_pl_n_2` = %s WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$table,					
	quate_smart(trim($_POST["s_sg_m_1"])),
	quate_smart(trim($_POST["s_sg_m_4"])),
	quate_smart(trim($_POST["s_sg_m_3"])),
	quate_smart(trim($_POST["s_sg_m_2"])),
	quate_smart(trim($_POST["s_sg_f_1"])),
	quate_smart(trim($_POST["s_sg_f_4"])),
	quate_smart(trim($_POST["s_sg_f_3"])),
	quate_smart(trim($_POST["s_sg_f_2"])),
	quate_smart(trim($_POST["s_sg_n_1"])),
	quate_smart(trim($_POST["s_sg_n_4"])),
	quate_smart(trim($_POST["s_sg_n_3"])),
	quate_smart(trim($_POST["s_sg_n_2"])),
	quate_smart(trim($_POST["s_pl_m_1"])),
	quate_smart(trim($_POST["s_pl_m_4"])),
	quate_smart(trim($_POST["s_pl_m_3"])),
	quate_smart(trim($_POST["s_pl_m_2"])),
	quate_smart(trim($_POST["s_pl_f_1"])),
	quate_smart(trim($_POST["s_pl_f_4"])),
	quate_smart(trim($_POST["s_pl_f_3"])),
	quate_smart(trim($_POST["s_pl_f_2"])),
	quate_smart(trim($_POST["s_pl_n_1"])),
	quate_smart(trim($_POST["s_pl_n_4"])),
	quate_smart(trim($_POST["s_pl_n_3"])),
	quate_smart(trim($_POST["s_pl_n_2"])),				
	quate_smart(trim($_POST["v_sg_m_1"])),
	quate_smart(trim($_POST["v_sg_m_4"])),
	quate_smart(trim($_POST["v_sg_m_3"])),
	quate_smart(trim($_POST["v_sg_m_2"])),
	quate_smart(trim($_POST["v_sg_f_1"])),
	quate_smart(trim($_POST["v_sg_f_4"])),
	quate_smart(trim($_POST["v_sg_f_3"])),
	quate_smart(trim($_POST["v_sg_f_2"])),
	quate_smart(trim($_POST["v_sg_n_1"])),
	quate_smart(trim($_POST["v_sg_n_4"])),
	quate_smart(trim($_POST["v_sg_n_3"])),
	quate_smart(trim($_POST["v_sg_n_2"])),
	quate_smart(trim($_POST["v_pl_m_1"])),
	quate_smart(trim($_POST["v_pl_m_4"])),
	quate_smart(trim($_POST["v_pl_m_3"])),
	quate_smart(trim($_POST["v_pl_m_2"])),
	quate_smart(trim($_POST["v_pl_f_1"])),
	quate_smart(trim($_POST["v_pl_f_4"])),
	quate_smart(trim($_POST["v_pl_f_3"])),
	quate_smart(trim($_POST["v_pl_f_2"])),
	quate_smart(trim($_POST["v_pl_n_1"])),
	quate_smart(trim($_POST["v_pl_n_4"])),
	quate_smart(trim($_POST["v_pl_n_3"])),
	quate_smart(trim($_POST["v_pl_n_2"])),
	$collation_1,
	quate_smart($_POST["keyword"]),
	quate_smart($_POST["num_keyword"])); 
$oop->Setnames();							
$result = $oop->query($sql);
$oop->freeResult();
$oop->_mySQL;
$page_id = 107; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
include './work.php';
$_SESSION["ses_message"].=$lang_dec_adj5;
$location = 'Location: ./d_edit_adj.php?action=adj3&d_h='.$_POST["keyword"].'&d_h_n='.$_POST["num_keyword"];
header($location);
} 
}
else  
{
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop9 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table = 'ds_dec_adj_3';
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
document.getElementById("s_sg_m_1").value='';
document.getElementById("s_sg_f_1").value='';
document.getElementById("s_sg_n_1").value='';
document.getElementById("s_pl_m_1").value='';
document.getElementById("s_pl_f_1").value='';
document.getElementById("s_pl_n_1").value='';
document.getElementById("s_sg_m_4").value='';
document.getElementById("s_sg_f_4").value='';
document.getElementById("s_sg_n_4").value='';
document.getElementById("s_pl_m_4").value='';
document.getElementById("s_pl_f_4").value='';
document.getElementById("s_pl_n_4").value='';
document.getElementById("s_sg_m_3").value='';
document.getElementById("s_sg_f_3").value='';
document.getElementById("s_sg_n_3").value='';
document.getElementById("s_pl_m_3").value='';
document.getElementById("s_pl_f_3").value='';
document.getElementById("s_pl_n_3").value='';
document.getElementById("s_sg_m_2").value='';
document.getElementById("s_sg_f_2").value='';
document.getElementById("s_sg_n_2").value='';
document.getElementById("s_pl_m_2").value='';
document.getElementById("s_pl_f_2").value='';
document.getElementById("s_pl_n_2").value='';
document.getElementById("v_sg_m_1").value='';
document.getElementById("v_sg_f_1").value='';
document.getElementById("v_sg_n_1").value='';
document.getElementById("v_pl_m_1").value='';
document.getElementById("v_pl_f_1").value='';
document.getElementById("v_pl_n_1").value='';
document.getElementById("v_sg_m_4").value='';
document.getElementById("v_sg_f_4").value='';
document.getElementById("v_sg_n_4").value='';
document.getElementById("v_pl_m_4").value='';
document.getElementById("v_pl_f_4").value='';
document.getElementById("v_pl_n_4").value='';
document.getElementById("v_sg_m_3").value='';
document.getElementById("v_sg_f_3").value='';
document.getElementById("v_sg_n_3").value='';
document.getElementById("v_pl_m_3").value='';
document.getElementById("v_pl_f_3").value='';
document.getElementById("v_pl_n_3").value='';
document.getElementById("v_sg_m_2").value='';
document.getElementById("v_sg_f_2").value='';
document.getElementById("v_sg_n_2").value='';
document.getElementById("v_pl_m_2").value='';
document.getElementById("v_pl_f_2").value='';
document.getElementById("v_pl_n_2").value='';
}
function setFocus2()
{
document.getElementById("s_sg_m_1").focus();
}
</script>
</head>
<body onload="setFocus2()">
<div id="wrapper">
<?php include './header.php'; 
include './menu.php';
echo $MAIN_MENU;
?>
<form action="/d_edit_adj.php?action=adj3&adj3_action=adj3_confirm&d_h=<?=$_GET["d_h"]?>&d_h_n=<?=$_GET["d_h_n"]?>" method="post" name="form">
<div id="content">
<div class="left_huge">
<h2><?=$lang_dec_adj7?>
<?php if ($_GET["d_h_n"]!=0) {
echo "<sup>".$_GET["d_h_n"]."</sup>";
} 
echo $_GET["d_h"];
?></h2>
<?php
$BUFFER_MENU='';
$BUFFER_MENU .= "<div class=\"menu_sub\">";
$BUFFER_MENU .= "<ul>"; 
$BUFFER_MENU .= "<li><input type=\"submit\" class=\"button3\" name=\"adj3_submit_direct\" value=\"".$lang_edit_submit."\"></li>";
$BUFFER_MENU .= "<li><a href=\"./d_edit_adj.php?d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\">".$lang_back1."</a></li>";
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
<input type="hidden" id="num_keyword" name="num_keyword" value="<?php echo $returned[2];?>"></td>
<table class="sample">
<tr><th colspan="8"><?=$lang_dec_adj2?></th></tr>
<tr><th colspan="8"><?=$lang_declination_superlative_strong_dec?></th></tr>
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
<input type="text" class="inputbox_small" id="s_sg_m_1" onBlur="lasttext=this;" name="s_sg_m_1" size="18" maxlength="80" value="<?=$returned[4];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_sg_f_1" onBlur="lasttext=this;" name="s_sg_f_1" size="18" maxlength="80" value="<?=$returned[8];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_sg_n_1" onBlur="lasttext=this;" name="s_sg_n_1" size="18" maxlength="80" value="<?=$returned[12];?>"></td>
<td><?=$lang_declination_1_case?></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_m_1" onBlur="lasttext=this;" name="s_pl_m_1" size="18" maxlength="80" value="<?=$returned[16];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_f_1" onBlur="lasttext=this;" name="s_pl_f_1" size="18" maxlength="80" value="<?=$returned[20];?>"></td>
<td>
<input type="text" class="inputbox_small" id="s_pl_n_1" onBlur="lasttext=this;" name="s_pl_n_1" size="18" maxlength="80" value="<?=$returned[24];?>"></td>
</tr>
<tr>
<td><?=$lang_declination_4_case?></td>
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
<tr><th colspan="8"><?=$lang_declination_superlative_weak_dec?></th></tr>
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
<td><?=$lang_declination_4_case?> </td>
<td>
<input type="text" class="inputbox_small" id="v_sg_m_4" onBlur="lasttext=this;" name="v_sg_m_4" size="18" maxlength="80" value="<?=$returned[29];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_sg_f_4" onBlur="lasttext=this;" name="v_sg_f_4" size="18" maxlength="80" value="<?=$returned[33];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_sg_n_4" onBlur="lasttext=this;" name="v_sg_n_4" size="18" maxlength="80" value="<?=$returned[37];?>"></td>
<td><?=$lang_declination_4_case?></td>
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
<td><?=$lang_declination_2_case?> </td>
<td>
<input type="text" class="inputbox_small" id="v_sg_m_2" onBlur="lasttext=this;" name="v_sg_m_2" size="18" maxlength="80" value="<?=$returned[31];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_sg_f_2" onBlur="lasttext=this;" name="v_sg_f_2" size="18" maxlength="80" value="<?=$returned[35];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_sg_n_2" onBlur="lasttext=this;" name="v_sg_n_2" size="18" maxlength="80" value="<?=$returned[39];?>"></td>
<td><?=$lang_declination_2_case?> </td>
<td>
<input type="text" class="inputbox_small" id="v_pl_m_2" onBlur="lasttext=this;" name="v_pl_m_2" size="18" maxlength="80" value="<?=$returned[43];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_pl_f_2" onBlur="lasttext=this;" name="v_pl_f_2" size="18" maxlength="80" value="<?=$returned[47];?>"></td>
<td>
<input type="text" class="inputbox_small" id="v_pl_n_2" onBlur="lasttext=this;" name="v_pl_n_2" size="18" maxlength="80" value="<?=$returned[51];?>"></td>
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
} else if ($_GET["action"]=='add') {
$view_keyword=$_GET["d_h"];
$view_num_keyword=$_GET["d_h_n"];
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop3 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop4 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table2 = 'ds_dec_adj_info';
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
$sql2 = sprintf ('INSERT INTO `%s` (`id`, `keyword`, `num_keyword`, `status_keyword`) VALUES (NULL, %s, %s, %s)',
	$table2,					
	quate_smart($view_keyword),
	quate_smart($view_num_keyword),
	quate_smart($status_keyword));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$action_scripts="gen_adj1";
include './scripts/d_scripts_adj.php';
$action_scripts="";
$action_scripts="gen_adj2";
include './scripts/d_scripts_adj.php';
$action_scripts="";
$action_scripts="gen_adj3";
include './scripts/d_scripts_adj.php';
$action_scripts="";
$oop->freeResult();
$oop->_mySQL;
$_SESSION["ses_message"].=$lang_dec_adj9.''.$view_keyword.'('.$view_num_keyword.') '.$lang_dec_adj10;
$location = 'Location: ./search.php?d_h='.$view_keyword.'&d_h_n='.$view_num_keyword.'';
header($location);
} else {
$_SESSION["ses_message"].=$lang_dec_adj9.''.$view_keyword.'('.$view_num_keyword.') '.$lang_dec_adj11;
$location = 'Location: ./search.php?d_h='.$view_keyword.'&d_h_n='.$view_num_keyword.'';
header($location);	
}
} else if ($_GET["action"]=='delete'){
if ($_GET["del"]=='TRUE') {
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$view_keyword=$_GET["d_h"];
$view_num_keyword=$_GET["d_h_n"];
$table2 = 'ds_dec_adj_info';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$table2 = 'ds_dec_adj_1';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$table2 = 'ds_dec_adj_2';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$table2 = 'ds_dec_adj_3';
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
$page_id = 106; $keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
include './work.php';
$_SESSION["ses_message"]=$lang_dec_adj12.''.$view_keyword.'('.$view_num_keyword.') '.$lang_dec_adj13;
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
?>
<div id="content">
<div class="left_huge">
<h2><?=$lang_dec_adj12?> 
<?php if ($_GET["d_h_n"]!=0) {
echo "<sup>".$_GET["d_h_n"]."</sup>";
} 
echo $_GET["d_h"];	 
?></h2>
<?php
echo $lang_dec_adj15."<br>";
echo " <a href=\"./d_edit_adj.php?action=delete&del=TRUE&d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\"> ".$lang_edit_del_yes." </a>";
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
$oop9 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table='ds_dec_adj_info';
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
$table=  'ds_dec_adj_info';
$status=2;
$sql = sprintf ('SELECT `status_keyword` FROM `%s` WHERE `status_keyword` = %s',
	$table,				
	quate_smart($status));
$oop_sub->Setnames();
$oop_sub->query($sql);
$num_corrected = $oop_sub->getNumRows();
$oop_sub->FreeResult();
$sql = sprintf ('SELECT `prep` FROM `%s`',
	$table);
$oop_sub->Setnames();
$oop_sub->query($sql);
$num_keywords = $oop_sub->getNumRows();
$oop_sub->FreeResult();
?>
<form action="/d_edit_adj.php?action=confirm&d_h=<?=$_GET["d_h"]?>&d_h_n=<?=$_GET["d_h_n"]?>" method="post" name="form">
<div id="content">
<div class="left_huge">
<h2><?=$lang_dec_adj12?> 
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
$BUFFER_MENU .= "<li><a href=\"./d_edit_adj.php?action=nextword&correct=1&d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\">".$lang_declination_saving."</a></li>";
$BUFFER_MENU .= "<li><a href=\"./search.php?list_kind=alpha&amp;d_h=".$_GET["d_h"]."&amp;d_h_n=".$_GET["d_h_n"]."\">".$lang_back2."</a></li>";
$BUFFER_MENU .= "<li><a href= \"http://bin.arnastofnun.is/leit.php?q=".$_GET["d_h"]." \" onclick= \"return popitup('http://bin.arnastofnun.is/leit.php?q=".$_GET["d_h"]."') \">".$lang_declination_bin."</a></li>";
$BUFFER_MENU .= "</ul>";	
$BUFFER_MENU .= "</div>";	
echo $BUFFER_MENU;
?>
<table class="sample" width="100%" border="0">
<tr><th colspan="8"><?=$lang_dec_adj14?></th></tr>
<tr><th colspan="8"> <?=$lang_declination_adj_info?></th></tr>
<?php
$keyword = $returned[1]; $keyword_new=$returned[1];
?>
<?php
$num_keyword = $returned[2]; $num_keyword_new=$returned[2];
?>
<tr>
<td width="15%"><input type="hidden" id="keyword" name="keyword" value="<?php echo $returned[1];?>"><input type="hidden" id="num_keyword" name="num_keyword" value="<?php echo $returned[2];?>"><?=$lang_declination_stig1?></td>
<td>
<select name="stig_1" >
<option value="0" <?php if ($returned[4]==0) { echo 'selected';}?>><?=$lang_declination_notexist?></option>
<option value="1" <?php if ($returned[4]==1) { echo 'selected';}?>> <?=$lang_declination_unclear?></option>
<option value="2" <?php if ($returned[4]==2) { echo 'selected';}?>>  <?=$lang_declination_exist?></option>
</select> 
<?php
if ($returned[4]!=0) {
echo " <a href=\"./d_edit_adj.php?action=adj1&d_h=".$keyword."&d_h_n=".$num_keyword."\">".$lang_dec_adj16."<a>";	
}
?>
</td>
</tr>
<tr>
<td width="15%"><?=$lang_declination_stig2?></td>
<td>
<select name="stig_2" >
<option value="0" <?php if ($returned[6]==0) { echo 'selected';}?>> <?=$lang_declination_notexist?></option>
<option value="1" <?php if ($returned[6]==1) { echo 'selected';}?>> <?=$lang_declination_unclear?></option>
<option value="2" <?php if ($returned[6]==2) { echo 'selected';}?>>  <?=$lang_declination_exist?></option>
</select> 
<?php
if ($returned[6]!=0) {
echo " <a href=\"./d_edit_adj.php?action=adj2&d_h=".$keyword."&d_h_n=".$num_keyword."\">".$lang_dec_adj16."<a>";	
}
?>
</td>
</tr>
<tr>
<td width="15%"><?=$lang_declination_stig3?></td>
<td>
<select name="stig_3" >
<option value="0" <?php if ($returned[8]==0) { echo 'selected';}?>> <?=$lang_declination_notexist?></option>
<option value="1" <?php if ($returned[8]==1) { echo 'selected';}?>> <?=$lang_declination_unclear?></option>
<option value="2" <?php if ($returned[8]==2) { echo 'selected';}?>> <?=$lang_declination_exist?></option>
</select> 
<?php
if ($returned[8]!=0) {
echo " <a href=\"./d_edit_adj.php?action=adj3&d_h=".$keyword."&d_h_n=".$num_keyword."\">".$lang_dec_adj16."<a>";	
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
include './scripts/view_declination_adj_all.php';
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
