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
include 'start.php';
include './scripts/redirect_public.php';
$dict = 'ds_2_senses';
$dict_keyword = 'ds_1_headword';
$dict_history = 'ds_history';
//if ($_GET["es"]=='true') {
//$_GET["d_h"]=$_SESSION["d_h"];
//$_GET["d_h_n"]=$_SESSION["d_h_n"];
//}
//php lock
$oop_lock = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$sql = sprintf ('SELECT `LOCK_KEY`, `LOCK_EXPIRY_TIME` FROM `%s` WHERE `keyword` = %s AND `num_keyword` = %s',
	$dict_keyword,					
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]));
$oop_lock->Setnames();							
$oop_lock->query($sql);
$lock= $oop_lock->fetchRow ();
$oop_lock->freeResult();
$time_now=date("Y-m-d H:i:s");
if ($lock[0]!=0) {
if ($_SESSION["id_user"]!=$lock[0]) {
if ($lock[1]>=$time_now) {
$_SESSION["ses_message"].=$lang_lock1.$lock[1];
$location = 'Location: ./search.php?list_kind=alpha&amp;d_h='.$_GET["d_h"].'&amp;d_h_n='.$_GET["d_h_n"].'';
header($location);
Die();
}}}
$sql = sprintf ('UPDATE `%s` SET `LOCK_KEY` = %s, `LOCK_EXPIRY_TIME` = ADDTIME(NOW(),"00:10:00") WHERE `keyword` = %s AND `num_keyword` = %s',
	$dict_keyword,					
	quate_smart($_SESSION["id_user"]),
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]));
$oop_lock->Setnames();							
$oop_lock->query($sql);
$oop_lock->freeResult();
$oop_lock->_mySQL;

if ($_GET["action"]=='confirm') {
//update
$oop_edit = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
if ($_POST["submit_direct"]) {
$sql = sprintf ('UPDATE `%s` SET `keyword` = %s, `gram_2` = %s, `word` = %s, `translation` = %s, `order` = %s, `notes` = %s, `num_keyword` = %s, `example` = %s, `synonym` = %s, `latinnames` = %s, `antonym` = %s, `link` = %s, `specification`=%s, `marker`=%s, `sec_marker`=%s, `usage_specification`=%s, `example_translation`=%s, `example_keyword`=%s, `synonym_link`=%s, `translation_detail`=%s, `usage_category`=%s, `translation_usage`=%s, `phrase`=%s, `phrase_order`=%s WHERE `id` = %s',
	$dict,					
	quate_smart($_POST["keyword"]),
	quate_smart($_POST["gram_2"]),
	quate_smart($_POST["word"]),
	quate_smart($_POST["translation"]),
	quate_smart($_POST["order"]),
	quate_smart($_POST["notes"]),
	quate_smart($_POST["num_keyword"]),
	quate_smart($_POST["example"]),
	quate_smart($_POST["synonym"]),
	quate_smart($_POST["latinnames"]),
	quate_smart($_POST["antonym"]),
	quate_smart($_POST["link"]),
	quate_smart($_POST["specification"]),
	quate_smart($_POST["marker"]),
	quate_smart($_POST["sec_marker"]),
	quate_smart($_POST["usage_specification"]),
	quate_smart($_POST["example_translation"]),
	quate_smart($_POST["example_keyword"]),
	quate_smart($_POST["synonym_link"]),
	quate_smart($_POST["translation_detail"]),
	quate_smart($_POST["usage_category"]),
	quate_smart($_POST["translation_usage"]),
	quate_smart($_POST["phrase"]),
	quate_smart($_POST["phrase_order"]),
	$_POST["id"]); 
$sql2 = sprintf ('UPDATE `%s` SET `frequency` = %s, `keyword` = %s, `gram_1_word_group` = %s, `gram_2_endings` = %s, `gram_3_additional` = %s,  `pronunciation` = %s, `keywords_notes` = %s, `num_keyword` = %s, `stem`=%s, `keyword_variant`=%s, `words_in_compound`=%s, `etymology`=%s WHERE `keyword` COLLATE `%s`=%s AND `num_keyword`=%s',
	$dict_keyword,					
	quate_smart($_POST["frequency"]),
	quate_smart($_POST["keyword"]),
	quate_smart($_POST["gram_1_word_group"]),			
	quate_smart($_POST["gram_2_endings"]),
	quate_smart($_POST["gram_3_additional"]),
	quate_smart($_POST["pronunciation"]),
	quate_smart($_POST["keywords_notes"]),
	quate_smart($_POST["num_keyword"]),
	quate_smart($_POST["stem"]),
	quate_smart($_POST["keyword_variant"]),
	quate_smart($_POST["words_in_compound"]),
	quate_smart($_POST["etymology"]),
	$collation_1,
	quate_smart($_POST["keyword"]),
	quate_smart($_POST["num_keyword"]));
$oop_edit->Setnames();							
$oop_edit->query($sql);
$oop_edit->freeResult();
$oop_edit->Setnames();
$oop_edit->query($sql2);
$oop_edit->freeResult();
$oop_edit->_mySQL;   
$keyword_work=$_POST["keyword"];
$num_keyword_work=$_POST["num_keyword"];
$page_id=505; 
include './work.php'; 
$_SESSION["ses_message"].=$lang_edit_submit2;
$location = 'Location: ./edit.php?id='.$_POST["id"].'&d_h='.$_POST["keyword"].'&d_h_n='.$_POST["num_keyword"].'&save_history=FALSE';
header($location);
} 
if ($_GET["new_word"]=='true') {
$sql = sprintf ('SELECT `order` FROM `%s` WHERE `keyword` COLLATE `%s` like %s AND `num_keyword`=%s ORDER BY `order` ASC',
	$dict,
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]));
$oop_edit->Setnames();
$oop_edit->query($sql);
while ($row3 = $oop_edit->FetchArray()) :
$biggest_order=$row3[0];
endwhile;
$oop_edit->freeResult();
// we increase by one the beggist order / the word will be at the end for sure
$id=trim($_GET["id"]);
$order_new=($biggest_order)+1;
// we insert new word under the keyword with the order etc.
$sql = sprintf ('INSERT INTO `%s` (`id`, `keyword`, `translation`, `order`, `num_keyword`) VALUES (NULL, %s, %s, %s, %s)',
	$dict,					
	quate_smart($_GET["d_h"]),
	quate_smart('new'),
	quate_smart($order_new),
	quate_smart($_GET["d_h_n"]));		
$oop_edit->Setnames();
$result = $oop_edit->query($sql);
$oop_edit->freeResult();
$keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
$page_id=506; 
include './work.php'; 
  // we find id of the word we add = with the biggest order number
$sql = sprintf ('SELECT `id` FROM `%s` WHERE `keyword` COLLATE `%s` like %s AND `num_keyword`=%s ORDER BY `order` ASC',
	$dict,
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]));
$oop_edit->Setnames();
$oop_edit->query($sql);
// we find out new id to direct link
while ($row5 = $oop_edit->FetchArray()) :
$new_id=$row5[0];
endwhile;
$oop_edit->freeResult();
$oop_edit->_mySQL; 
$post_h=trim($_POST["post_h"]);
$_SESSION["ses_message"].=$lang_edit_new;
$location = 'Location: ./edit.php?id='.$new_id.'&d_h='.$_GET["d_h"].'&d_h_n='.$_GET["d_h_n"].'&save_history=FALSE&post_h='.$post_h.'';
header($location);
}
}
else  if ($_GET["action"]=='delete') {
	
// we delete from the word database
if ($_GET["loss"]=='true') {
$oop_edit = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
// we delete from the main keyword database
// we delete from the word database as well
if ($_GET["del"]=='complete' ) {
// we insert a record to work table / delete action
include './del_headword.php'; 
} else {
$keyword_work = $_GET["d_h"];
$num_keyword_work = $_GET["d_h_n"];
$sql = sprintf ('DELETE FROM `%s` WHERE `id`=%s',
	$dict,					
	quate_smart($_GET["id"]));
$oop_edit->Setnames();
$result = $oop_edit->query($sql);
$oop_edit->freeResult();
$_SESSION["ses_message"].=$lang_edit_mes1;
$page_id=28; 
include './work.php'; 
}
// we find the first word in the keyword so that we can redirect back after deletion of one word
$sql= sprintf ('SELECT `id`,`keyword`,`num_keyword` FROM `%s` WHERE `keyword` COLLATE `%s`=%s AND `num_keyword`=%s',
	$dict,
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]));
$oop_edit->Setnames();
$oop_edit->query($sql);
$returned = $oop_edit->fetchRow ();
$num2 = $oop_edit->getNumrows(); 
//if true go the keyword back
if ($_GET["del"]=='complete' ) {
$location = 'Location: ./search.php?list_kind=alpha&m=del_complete&d_h='.$_GET["d_h"].'&d_h_n='.$_GET["d_h_n"].''; 
} else {
if ($num2 !=0) 
{ 
$post_h=trim($_POST["post_h"]);
$location = 'Location: ./edit.php?id='.$returned[0].'&d_h='.$returned[1].'&d_h_n='.$returned[2].'&save_history=FALSE&post_h='.$post_h.'&m=del_m_s';
// else to the search page
} 
else {$location = 'Location: ./search.php?list_kind=alpha&d_h='.$_GET["d_h"].'&d_h_n='.$_GET["d_h_n"].'';
}
}
header($location);
$oop_edit->freeResult();
$oop_edit->_mySQL;
} else {
$id=trim($_GET["id"]);
$post_h=trim($_GET["post_h"]);
$oop_edit = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$sql = sprintf ('SELECT * FROM `%s` WHERE `id` = %s ',
	$dict,		
	quate_smart($_GET["id"]));		
$oop_edit->Setnames();
$oop_edit->query($sql);
// show all 
$r_edit = $oop_edit->fetchRow ();
$oop_edit->freeResult();

$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` = %s AND `num_keyword` = %s',
	$dict_keyword,		
	quate_smart($r_edit[1]),
	quate_smart($r_edit[2]));		
$oop_edit->Setnames();
$oop_edit->query($sql);
$r_edit2 = $oop_edit->fetchRow ();
$oop_edit->freeResult();
?>
<?php
include './head.php';
?>
<body onload="setfocus ()">
<div id="wrapper">
<?php include 'header.php'; 
include 'menu.php';
echo $MAIN_MENU;
?>
<div id="content">
<div class="left_huge">
<?php if ($_GET["del"]=='complete') {
echo '<h2>'.$lang_edit_del1.'</h2>';
} else {
echo '<h2>'.$lang_edit_del2.'</h2>';
} 
if ($_GET["del"]=='complete' ) {
echo "<entry class=\"ses_message\">".$lang_edit_del_message;
echo '<a href="./edit.php?action=delete&loss=true&del=complete&d_h='.$_GET["d_h"].'&d_h_n='.$_GET["d_h_n"].'&id='.$id.'&save_history=FALSE"> '.$lang_edit_del_yes.' </a>';
} else {
echo $lang_edit_del3;
echo '<a href="./edit.php?action=delete&loss=true&d_h='.$_GET["d_h"].'&d_h_n='.$_GET["d_h_n"].'&id='.$id.'&save_history=FALSE"> '.$lang_edit_del_yes.' </a>';
}
echo '<a href="javascript:self.history.back();"> '.$lang_edit_del_no.' </a></entry>';
echo'<br><table class="sample">';
echo '<tr><td bgcolor="f5f352">'.$lang_edit_keyword.'</td><td bgcolor="f5f352"> '.$r_edit[1].'</td></tr>';
echo '<tr><td>'.$lang_edit_num_keyword.'</td><td> '.$r_edit[2].'</td></tr>';
echo '<tr><td>'.$lang_edit_stem.'</td><td>'.$r_edit2[3].'</td></tr>'; 
echo '<tr><td>'.$lang_edit_marker.'</td><td>'.$r_edit[19].'</td></tr>'; 
echo '<tr><td>'.$lang_edit_word.'</td><td> '.$r_edit[4].'</td></tr>';
echo '<tr><td bgcolor="FFCCCC">'.$lang_edit_g1.'</td><td bgcolor="FFCCCC">'.$r_edit2[7].'</td></tr>';
echo '<tr><td>'.$lang_edit_g2.'</td><td>'.$r_edit2[8].'</td></tr>';
echo '<tr><td>'.$lang_edit_g3.'</td><td>'.$r_edit2[9].'</td></tr>';
echo '<tr><td bgcolor="339966">'.$lang_edit_translation .'</td><td bgcolor="339966">'.$r_edit[5].'</td></tr>'; 
echo '<tr><td>'.$lang_edit_order.'</td><td> '.$r_edit[8].'</td></tr>'; 
echo '<tr><td>'.$lang_edit_synonym.'</td><td>'.$r_edit[13].'</td></tr>';
echo '<tr><td>'.$lang_edit_antonym.'</td><td>'.$r_edit[17].'</td></tr>';
echo '<tr><td>'.$lang_edit_example.'</td><td>'.$r_edit[10].'</td></tr>';
echo '<tr><td>'.$lang_edit_example_translation.'</td><td>'.$r_edit[11].'</td></tr>';
echo '<tr><td>'.$lang_edit_specification.'</td><td>'.$r_edit [21].'</td></tr>';
echo '<tr><td>'.$lang_edit_usage_spec.' </td><td>'.$r_edit[22].'</td></tr>';
echo '<tr><td>'.$lang_edit_link.'</td><td>'.$r_edit[18].'</td></tr>';
echo '<tr><td>'.$lang_edit_notes.'</td><td>'.$r_edit[9].'</td></tr>'; 
echo '</table>';
echo '</div>';
$oop_edit->_mySQL;
} } else  {
include './head_s.php'; ?>
<script type="text/javascript">
function setfocus_edit() {
document.form.translation.focus();
}
function toggle()  {
document.getElementById('specification').value = document.getElementById('specification_visible').value ;
}
function toggle_usage_specification()  {
document.getElementById('usage_specification').value = document.getElementById('usage_specification_visible').value ;
}
function toggle_synonym()  {
document.getElementById('synonym').value = document.getElementById('synonym_visible').value ;
}
function toggle_grammar()  {
document.getElementById('gram_1_word_group').value = document.getElementById('gram_1_word_group_visible').value ;
}
function add_sign() {
while(''+this.value.charAt(0)==' ')this.value=this.value.substring(1,this.value.length);
this.focus;
}
function insertAtCursor(myField, myValue1, myValue2) {
if (document.selection) {
myField.focus();
sel = document.selection.createRange();
sel.text = myValue1+sel.text+myValue2;
myField.focus();
}
else if (myField.selectionStart || myField.selectionStart == '0') {
var startPos = myField.selectionStart;
var endPos = myField.selectionEnd;
myField.value = myField.value.substring(0, startPos)
+ myValue1 + myField.value.substring(myField.selectionStart, myField.selectionEnd)
+ myValue2 +myField.value.substring(endPos, myField.value.length);
myField.selectionStart = startPos+3;
myField.selectionEnd = endPos + myValue1.length + startPos;
myField.focus();
} else {
myField.value += myValue1+myValue2;
}
}
</script>
<script type="text/javascript" src="./scripts/bsn.AutoSuggest_2.1.3_comp.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$IMAGE_URL?>/scripts/thickbox-compressed.php"></script>
</head>
<body onload="setfocus_edit()">
<div id="wrapper">
<?php include 'header.php'; 
include 'menu.php';
echo $MAIN_MENU;
$oop_edit = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
if ($_POST["submit_direct"]) {
$sql = sprintf ('SELECT * FROM `%s` WHERE `id` = %s ',
	$dict,				
	quate_smart($_POST["id"]));
} else if ($_GET["id"]=='') {
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`=%s ORDER BY `order` LIMIT 0,1',
	$dict,
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]));
} else {
$sql = sprintf ('SELECT * FROM `%s` WHERE `id` = %s ',
	$dict,				
	quate_smart($_GET["id"]));
}
$oop_edit->Setnames();
$oop_edit->query($sql);
$r_edit = $oop_edit->fetchRow ();
$oop_edit->freeResult();
$sql2 = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`=%s ',
	$dict_keyword,
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]));
$oop_edit->Setnames();
$oop_edit->query($sql2);
$r_edit2 = $oop_edit->fetchRow ();
$oop_edit->freeResult();
if ($_POST["submit_direct"]) {
$id_new=$r_edit[0]; 
} else if ($_GET["id"]=='') 
{
$id_new=$r_edit[0];  } else
{
$id_new=$_GET["id"];
}
?>
<form action="edit.php?action=confirm" method="post" name="form">
<div id="content">
<div class="left_huge">
<h2><?=$lang_edit_h2?></h2>
<div class="menu_sub">
<ul>
<li><input type="submit" class="button3" name="submit_direct" value="<?=$lang_edit_submit?>">
</li>
<li><a href="edit.php?action=confirm&new_word=true&id=<?=$id_new?>&d_h=<?php echo $_GET["d_h"]?>&d_h_n=<?php echo $_GET["d_h_n"];?>&order=<?php echo $r_edit[8];?>&save_history=FALSE" target="_self"><?=$lang_edit_add?></a></li>
<li>
<?php
echo "<a href=\"history.php?action=save&amp;d_h=".$_GET["d_h"]."&amp;d_h_n=".$_GET["d_h_n"]."\" target=\"_self\">".$lang_edit_submit_button."</a>";?>
</li>
<li>
<?php
echo "<a href=\"search.php?list_kind=alpha&amp;d_h=".$_GET["d_h"]."&amp;d_h_n=".$_GET["d_h_n"]."\" target=\"_self\">".$lang_edit_back."</a>";?>
</li>
</ul>
</div>
<input type="hidden" name="id" value="<?=$id_new?>">
<table class="sample" width="100%">
<tr><td width="15%">
<a href="./help_pop.php?num_subtitle=2&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_keyword?>" class="thickbox">
<?=$lang_edit_keyword?>
</a></td><td width="30%"><?=$r_edit2[1];?>
<input type="hidden" id="keyword" name="keyword" value="<?php echo $r_edit2[1];?>">
</td>
<td width="15%">
<a href="./help_pop.php?num_subtitle=3&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_num_keyword?>" class="thickbox">
<?=$lang_edit_num_keyword?> 
</a></td><td width="30%"><?=$r_edit2[2];?>
<input type="hidden" id="num_keyword" name="num_keyword" value="<?php echo $r_edit2[2];?>">
</td>
</tr>
<?php
$slovo = $r_edit2[1]; $keyword_new=$r_edit2[1];
$id_slovo = $r_edit2[2]; $num_keyword_new=$r_edit2[2];
?>
<tr>
<td>
<a href="./help_pop.php?num_subtitle=5&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_stem?>" class="thickbox">
<?=$lang_edit_stem?>
</a> <span onClick="insertAtCursor(document.getElementById('stem'), '' ,'·')">(···)</span></td> <td><input type="text" id="stem" class="inputbox" name="stem" TABINDEX="1" size="20"  value="<?=$r_edit2[3];?>"> </td>
<td>
<a href="./help_pop.php?num_subtitle=4&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_pronunciation?>" class="thickbox">
<?=$lang_edit_pronunciation?>
</a></td>
<td><input type="text" class="inputbox" name="pronunciation" size="20" TABINDEX="2" value="<?=$r_edit2[6];?>"> </td>
</tr>
<tr>
<tr>
<td>
<a href="./help_pop.php?num_subtitle=6b&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_words_in_compound?>" class="thickbox">
<?=$lang_edit_words_in_compound?>
</a></td><td><input type="text" class="inputbox" name="words_in_compound" size="20" TABINDEX="3" value="<?=$r_edit2[14];?>"> </td>
<td>
<a href="./help_pop.php?num_subtitle=30&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_etymology?>" class="thickbox">
<?=$lang_edit_etymology?>
</a></td><td><input type="text" class="inputbox" name="etymology" size="20" TABINDEX="4" value="<?=$r_edit2[16];?>"> </td>
</tr>
<td>
<div>
<form method="get" action="" class="asholder">
<a href="./help_pop.php?num_subtitle=7&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_g1?>" class="thickbox">
<?=$lang_edit_g1?></a>
</td><td> <input type="text"  id="gram_1_word_group_visible" class="inputbox" TABINDEX="5" onChange="toggle_grammar()" size="4"  value="<?=$r_edit2[7];?>"> 
</div>
<input type="hidden" id="gram_1_word_group" name="gram_1_word_group"  value="<?=$r_edit2[7];?>">
</td>
<td>
<a href="./help_pop.php?num_subtitle=6a&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_frequency?>" class="thickbox">
<?=$lang_edit_frequency?>
</a>
</td>       
<td><input type="text" class="inputbox" name="frequency" size="20"  value="<?=$r_edit2[11];?>"> </td>
</tr>
<tr>
<td>
<a href="./help_pop.php?num_subtitle=8&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_g2?>" class="thickbox">
<?=$lang_edit_g2?>
</a></td>      
<td> <input type="text" class="inputbox" name="gram_2_endings" size="20" TABINDEX="6" value="<?=$r_edit2[8];?>"> </td>
<td>
<a href="./help_pop.php?num_subtitle=9&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_g3?>" class="thickbox">
<?=$lang_edit_g3?>
</a></td>     
<td> <input type="text" class="inputbox" name="gram_3_additional" size="20" TABINDEX="7" value="<?=$r_edit2[9];?>"> </td>
</tr>
<tr>
<td>
<a href="./help_pop.php?num_subtitle=11&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_keyword_notes?>" class="thickbox">
<?=$lang_edit_keyword_notes?>
</a></td>
<td><textarea name="keywords_notes" class="inputbox" rows="2" TABINDEX="8" cols="20"><?=$r_edit2[10];?></textarea></td>
<td>
<a href="./help_pop.php?num_subtitle=10&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_variant?>" class="thickbox">
<?=$lang_edit_variant?>
</a></td>
<td><input type="text" class="inputbox" name="keyword_variant" size="4" TABINDEX="9" value="<?=$r_edit2[4];?>"> </td>
</tr>
</table>
<br>
<table class="sample" width="100%">
<tr>
<td width="15%">  
<a href="./help_pop.php?num_subtitle=12&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_marker?>" class="thickbox">
<?=$lang_edit_marker?>
</a> </td>
<td width="30%">  <input type="text" class="inputbox" name="marker" size="4" TABINDEX="10" value="<?=$r_edit[19];?>"></td>
<td width="15%">
<a href="./help_pop.php?num_subtitle=13&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_sec_marker?>" class="thickbox">
<?=$lang_edit_sec_marker?>
<a/></td>
<td width="30%"><input type="text" name="sec_marker" class="inputbox" size="10" TABINDEX="11" value="<?=$r_edit[20];?>"> </td>
</tr>
<tr>
<td>
<a href="./help_pop.php?num_subtitle=14&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_word?>" class="thickbox">
<?=$lang_edit_word?>
</a></td> 
<td><input type="text" class="inputbox" id="word" name="word" size="20" TABINDEX="12" value="<?=$r_edit[4];?>"> </td>
<td>
<a href="./help_pop.php?num_subtitle=15&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_word_grammar?>" class="thickbox">
<?=$lang_edit_word_grammar?>
</a></td> 
<td><input type="text" class="inputbox" name="gram_2" size="10" TABINDEX="13" value="<?=$r_edit[3];?>"> </td>
</tr>
<tr>
<td>
<div>
<a href="./help_pop.php?num_subtitle=17a&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_synonym?>" class="thickbox">
<?=$lang_edit_synonym?>
</a></td>
<td> <input type="text" name="synonym_visible" id="synonym_visible" TABINDEX="14" class="inputbox" onBlur="toggle_synonym()" onChange="toggle_synonym()" size="4"  value="<?=$r_edit[13];?>"> 
</div>
<input type="hidden" id="synonym" name="synonym"  value="<?=$r_edit[13];?>">
</td>
<td>
<a href="./help_pop.php?num_subtitle=17b&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_add_synonym_link?>" class="thickbox">
<?=$lang_add_synonym_link?>
</a></td>    
<td> <input type="text" name="synonym_link" class="inputbox" size="20" TABINDEX="15" value="<?=$r_edit[14];?>"> </td>
</tr>
<tr>
<td></td>
<td></td>
<td>
<a href="./help_pop.php?num_subtitle=27&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_antonym?>" class="thickbox">
<?=$lang_edit_antonym?>
</a></td> 
<td><input type="text" name="antonym" class="inputbox" size="10" TABINDEX="16" value="<?=$r_edit[17];?>"> </td>
</tr>
<tr>
<td>
<a href="./help_pop.php?num_subtitle=29a&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_phrase_order1?>" class="thickbox">
<?=$lang_edit_phrase_order1?>
</a></td>
<td><input type="text" name="phrase" class="inputbox" size="10" TABINDEX="17" value="<?=$r_edit[24];?>"> </td>
<td>
<a href="./help_pop.php?num_subtitle=29b&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_phrase_order2?>" class="thickbox">
<?=$lang_edit_phrase_order2?>
</a></td> 
<td><input type="text" name="phrase_order" class="inputbox" size="10" TABINDEX="18" value="<?=$r_edit[25];?>"> </td>
</tr>
</table>
<br>
<table class="sample" width="100%">
<td width="15%">
<a href="./help_pop.php?num_subtitle=16a&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_translation?>" class="thickbox">
<?=$lang_edit_translation?> 
</a></td>    
<td width="30%"> <input type="text" name="translation" class="inputbox" size="20" TABINDEX="19" value="<?=$r_edit[5];?>"> </td>
<td width="15%">
<a href="./help_pop.php?num_subtitle=16b&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_add_tran_usage?>" class="thickbox">
<?=$lang_add_tran_usage?> 
</a> </td>    
<td width="30%"> <input type="text" name="tranlation_usage" class="inputbox" size="20" TABINDEX="19" value="<?=$r_edit[7];?>"> </td>
</tr>
<tr>
<td>
<a href="./help_pop.php?num_subtitle=16c&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_add_tran_detail?>" class="thickbox">
<?=$lang_add_tran_detail?> 
</a> </td>
<td><textarea name="translation_detail" id="translation_detail" class="inputbox" TABINDEX="21" rows="2" cols="20"><?=$r_edit[6];?></textarea> </td>
<td></td>
<td></td>
</tr>
</table>
<br>
<table class="sample" width="100%">
<td width="15%">
<a href="./help_pop.php?num_subtitle=18&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_example?>" class="thickbox">
<?=$lang_edit_example?>
</a></td>
<td width="30%"><textarea name="example" id="example" class="inputbox" rows="2" TABINDEX="22" cols="20"><?=$r_edit[10];?></textarea> </td>
<td width="15%">
<a href="./help_pop.php?num_subtitle=19&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_example_translation?>" class="thickbox">
<?=$lang_edit_example_translation?>
</a></td> 
<td width="30%"><textarea name="example_translation" class="inputbox" rows="2" TABINDEX="23" cols="20"><?=$r_edit[11];?></textarea></td>
</tr>
<tr>
<td> 
<a href="./help_pop.php?num_subtitle=20&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_keyword_in_examples?>" class="thickbox">
<?=$lang_edit_keyword_in_examples?>
</a></td> 
<td><textarea name="example_keyword" class="inputbox" rows="2" TABINDEX="24" cols="20"><?= $r_edit[12];?></textarea></td>
<td>
<a href="./help_pop.php?num_subtitle=21&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_notes?>" class="thickbox">
<?=$lang_edit_notes?> 
</a></td> 
<td><textarea name="notes" class="inputbox" rows="2" TABINDEX="25" cols="20"><?=$r_edit[9];?></textarea></td>
</tr>
</table>
<br>
<table class="sample" width="100%">
<td width="15%"><a href="./help_pop.php?num_subtitle=22&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_link?>" class="thickbox">
<?=$lang_edit_link?>
</a></td>    
<td width="30%"> <input type="text" class="inputbox" name="link" size="20" TABINDEX="26" value="<?=$r_edit[18];?>"> </td>
<td width="15%">
<a href="./help_pop.php?num_subtitle=23&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_order?>" class="thickbox">
<?=$lang_edit_order?> 
</a></td>  
<td width="30%">  <input type="text" name="order" class="inputbox" size="4" TABINDEX="27" value="<?=$r_edit[8];?>"></td>
</tr>
<?php
$order_new=$r_edit[8];
?>
<tr>
<td>
<div>
<a href="./help_pop.php?num_subtitle=24&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_specification?>" class="thickbox">
<?=$lang_edit_specification?>
</a></td> 
<td><input type="text" class="inputbox" id="specification_visible" size="20" TABINDEX="28" onChange="toggle()" value="<?=$r_edit[21];?>">
</div>
<input type="hidden" id="specification" name="specification" value="<?=$r_edit[21];?>"></td>
<td>
<a href="./help_pop.php?num_subtitle=26&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_latin?>" class="thickbox">
<?=$lang_edit_latin?>
</a></td>
<td><input type="text" class="inputbox" name="latinnames" size="20" TABINDEX="29" value="<?=$r_edit[16];?>"> </td>
</tr>
<tr>
<td>
<div>
<a href="./help_pop.php?num_subtitle=25&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_usage_spec?>" class="thickbox">
<?=$lang_edit_usage_spec?>
</a></td> 
<td><input type="text" class="inputbox" id="usage_specification_visible" size="20" TABINDEX="30" onChange="toggle_usage_specification()" value="<?php echo $r_edit[22];?>">
</div>
<input type="hidden" id="usage_specification" name="usage_specification" value="<?=$r_edit[22];?>">
</td>
<td>
<a href="./help_pop.php?num_subtitle=28&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_add_usage_category?>" class="thickbox">
<?=$lang_add_usage_category?>
</a></td>     
<td> <input type="text" name="usage_category" class="inputbox" size="20" TABINDEX="31" value="<?=$r_edit[23];?>"> </td>
</tr>
</table>
</form>
<br>
<h2><?=$lang_edit_h2_2?></h2>
<?php
$oop_edit->_mySQL;
$view_keyword=$_GET["d_h"];
$view_num_keyword=$_GET["d_h_n"];
$editpage=TRUE;
include './scripts/view_word_br_hvalur.php';
echo $BUFFER_VIEW_KEYWORD;
?>
</div>


<?php } ?>
 
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div>
</div>
</div>
<script type="text/javascript">
var options = {
script:"/scripts/autosuggest_spec_values.php?json=true&limit=12&",
varname:"input",
json:true,
shownoresults:true,
maxresults:12,
callback: function (obj1) { document.getElementById('specification').value = obj1.id; }
};
var as_json1 = new bsn.AutoSuggest('specification_visible', options);
var options2 = {
script:"/scripts/autosuggest_grammar_values.php?json=true&limit=12&",
varname:"input",
json:true,
shownoresults:true,
maxresults:12,
callback: function (obj2) { document.getElementById('gram_1_word_group').value = obj2.id; }
};
var as_json2 = new bsn.AutoSuggest('gram_1_word_group_visible', options2);	
var options3 = {
script:"/scripts/autosuggest_usage_values.php?json=true&limit=12&",
varname:"input",
json:true,
shownoresults:true,
maxresults:12,
callback: function (obj3) { document.getElementById('usage_specification').value = obj3.id; }
};
var as_json3 = new bsn.AutoSuggest('usage_specification_visible', options3);
var options4 = {
script:"/scripts/autosuggest_synonym.php?json=true&limit=12&",
varname:"input",
json:true,
shownoresults:true,
maxresults:12,
callback: function (obj4) { document.getElementById('sýnonym').value = obj4.id; }
};
var as_json4 = new bsn.AutoSuggest('synonym_visible', options4);	
</script>
<?php 
include ('./html_end.php');
?>