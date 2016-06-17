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
$dict_sound = 'ds_sound';
include './head_s.php'; ?>
<script type="text/javascript">
function setfocus2() {
document.form.keyword.focus();
}
function toggle()
{
document.getElementById('specification').value = document.getElementById('specification_visible').value ;
}
function toggle_usage_specification()
{
document.getElementById('usage_specification').value = document.getElementById('usage_specification_visible').value ;
}
function toggle_grammar()
{
document.getElementById('gram_1_word_group').value = document.getElementById('gram_1_word_group_visible').value ;
}
function toggle_synonym()
{
document.getElementById('synonym').value = document.getElementById('synonym_visible').value ;
}
function add_sign() {
while(''+this.value.charAt(0)==' ')this.value=this.value.substring(1,this.value.length); this.focus;
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
function checkForInt(evt) {
var charCode = ( evt.which ) ? evt.which : event.keyCode;
return (charCode <= 57 );
}
</script>
<script type="text/javascript" src="./scripts/bsn.AutoSuggest_2.1.3_comp.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$IMAGE_URL?>/scripts/thickbox-compressed.php"></script>
</head>
<body onload="setfocus2()">
<div id="wrapper">
<?php include './header.php';
include './menu.php'; 
echo $MAIN_MENU;
?>
<form action="add.php?action=confirm" method="post" name="form">
<div id="content">
<div class="left_huge">
<h2><?=$lang_add1?></h2>
<div class="menu_sub">
<ul>
<li><input type="submit" class="button3" name="submit_direct" value="<?=$lang_edit_submit?>">
</li>
<li><a href="./search.php?list_kind=alpha" target="_self"><?=$lang_add2?></a>
</li>
</ul>
</div>
<?php
if ($_GET["action"]=='confirm'){
// we check if the num_keyword is numeric
$keyword_numeric=false;
if (is_numeric(trim($_POST["num_keyword"]))) {
$keyword_numeric=true;
} else {
$_SESSION["ses_message"]=$lang_add_numeric;
$location = 'Location: ./add.php';
header($location);
}
//we check that there is written keyword , otherwise not insert
if (($_POST["keyword"]!='') AND ($keyword_numeric===true)) {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 	
// we check if the added word and num_keyword is not already in databaase
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$dict_keyword,
	$collation_1,
	quate_smart($_POST["keyword"]),
	quate_smart($_POST["num_keyword"])); 
$oop->Setnames();
$oop->query($sql);
$num = $oop->getNumRows();
$oop->freeResult();
if ($num==0) {
// we insert a record to work table / add action
$page_id = 7;
$keyword_work = $_POST["keyword"];
$num_keyword_work = $_POST["num_keyword"];
include './work.php'; 
$sql = sprintf ('INSERT INTO `%s` (`id`, `keyword`, `gram_2`, `word`, `translation`, `order`, `notes`, `num_keyword`, `example`, `synonym`, `latinnames`, `antonym`, `link`, `specification`, `usage_specification`, `marker`, `sec_marker`, `example_translation`, `example_keyword`, `synonym_link`, `translation_detail`, `usage_category`, `translation_usage`, `phrase`, `phrase_order`) VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)',
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
	quate_smart($_POST["usage_specification"]),
	quate_smart($_POST["marker"]),
	quate_smart($_POST["sec_marker"]),
	quate_smart($_POST["example_translation"]),
	quate_smart($_POST["example_keyword"]),
	quate_smart(trim($_POST["synonym_link"])),
	quate_smart(trim($_POST["translation_detail"])),
	quate_smart(trim($_POST["usage_category"])),
	quate_smart($_POST["translation_usage"]),
	quate_smart(trim($_POST["phrase"])),
	quate_smart(trim($_POST["phrase_order"])));	
$sql2 = sprintf ('INSERT INTO `%s` (`id`, `keyword`, `num_keyword`, `stem`, `gram_1_word_group`, `gram_2_endings`, `gram_3_additional`, `pronunciation`, `keywords_notes`, `frequency`, `words_in_compound`, `keyword_variant`, `etymology`) VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)',
	$dict_keyword,					
	quate_smart($_POST["keyword"]),
	quate_smart($_POST["num_keyword"]),
	quate_smart($_POST["stem"]),			
	quate_smart($_POST["gram_1_word_group"]),
	quate_smart($_POST["gram_2_endings"]),
	quate_smart($_POST["gram_3_additional"]),
	quate_smart($_POST["pronunciation"]),
	quate_smart($_POST["keywords_notes"]),
	quate_smart($_POST["frequency"]),
	quate_smart($_POST["words_in_compound"]),
	quate_smart($_POST["keyword_variant"]),
	quate_smart($_POST["etymology"]));	
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$oop2->_mySQL;
$oop->_mySQL;
$_SESSION["ses_message"].=$lang_add_success1.' '.$_POST["keyword"];
$location = 'Location: ./search.php?list_kind=alpha&d_h='.$_POST["keyword"].'&d_h_n='.$_POST["num_keyword"].'';
header($location); 
} else {
$_SESSION["ses_message"].=$lang_add_warning1;
$location = 'Location: ./add.php?action=';
header($location); 
}
} else {
$_SESSION["ses_message"].=$lang_add_warning2;
	$location = 'Location: ./add.php?action=';
	header($location); 	
}} else {
?>
<table class="sample" width="100%">
<?php
if (isset($_GET["new_keyword"])) 
{
$new_k=$_GET["new_keyword"];
}
else {
$new_k='';
}
?>
<tr><td width="15%">
<a href="./help_pop.php?num_subtitle=2&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_keyword?>" class="thickbox">
<?=$lang_edit_keyword?></a></td> 
<td width="30%"><input type="text" class="inputbox" name="keyword" TABINDEX="1" size="20"  value="<?=$new_k?>"></td>
<td width="15%">
<a href="./help_pop.php?num_subtitle=3&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_num_keyword?>" class="thickbox">
<?=$lang_edit_num_keyword?></a></td>   
<td width="30%"><input type="text" onkeypress="return checkForInt(event)" class="inputbox" id="num_keyword" name="num_keyword" TABINDEX="2" size="20"  value="0"></td>
</tr>
<tr>
<td>
<a href="./help_pop.php?num_subtitle=5&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_stem?>" class="thickbox">
<?=$lang_edit_stem?>
</a> <span onClick="insertAtCursor(document.getElementById('stem'), '' ,'·')">(···)</span></td> <td><input type="text" id="stem" class="inputbox" name="stem" TABINDEX="3" size="20"  value=""> </td>
<td>
<a href="./help_pop.php?num_subtitle=4&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_pronunciation?>" class="thickbox">
<?=$lang_edit_pronunciation?>
</a></td> <td><input type="text" class="inputbox" name="pronunciation" TABINDEX="4" size="20"  value=""> </td>
</tr>
<tr>
<tr>
<td>
<a href="./help_pop.php?num_subtitle=6b&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_g1?>" class="thickbox">
<?=$lang_edit_words_in_compound?>
</a></td>      <td> <input type="text" class="inputbox" name="words_in_compound" TABINDEX="5" size="20"  value=""> </td>
<td>
<a href="./help_pop.php?num_subtitle=30&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_etymology?>" class="thickbox">
<?=$lang_edit_etymology?>
</a></td><td><input type="text" class="inputbox" name="etymology" size="20" TABINDEX="6" value=""> </td>
</tr>
<tr>
<td>
<div>
<form method="get" action="" class="asholder">
<a href="./help_pop.php?num_subtitle=7&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_g1?>" class="thickbox">
<?=$lang_edit_g1?>
</a></td><td> <input type="text"  id="gram_1_word_group_visible" class="inputbox" TABINDEX="7" onChange="toggle_grammar()" size="4"  value=""> 
</div>
<input type="hidden" id="gram_1_word_group" name="gram_1_word_group" value="">
</td>
<td>
<a href="./help_pop.php?num_subtitle=6a&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_frequency?>" class="thickbox">
<?=$lang_edit_frequency?>  </a> </td>       
<td><input type="text" class="inputbox" name="frequency" size="20" TABINDEX="8" value=""> </td>
</tr>
<tr>
<td>
<a href="./help_pop.php?num_subtitle=8&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_g2?>" class="thickbox">
<?=$lang_edit_g2?>
</a></td>
<td> <input type="text" class="inputbox" name="gram_2_endings" size="20" TABINDEX="9" value=""> </td>
<td>
<a href="./help_pop.php?num_subtitle=9&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_g3?>" class="thickbox">
<?=$lang_edit_g3?></a></td>      <td> <input type="text" class="inputbox" name="gram_3_additional" TABINDEX="10" size="20"  value=""> </td>
</tr>
<tr>
<td>
<a href="./help_pop.php?num_subtitle=11&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_keyword_notes?>" class="thickbox">
<?=$lang_edit_keyword_notes?> 
</a></td> <td><textarea name="keywords_notes" class="inputbox" rows="2" TABINDEX="11" cols="20"></textarea></td>
<td>
<a href="./help_pop.php?num_subtitle=10&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_variant?>" class="thickbox">
<?=$lang_edit_variant?>
</a></td> <td><input type="text" class="inputbox" name="keyword_variant" TABINDEX="12" size="4"  value=""> </td>
</tr>
</table>
<br>
<table class="sample" width="100%">
<tr>
<td width="15%"> 
<a href="./help_pop.php?num_subtitle=12&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_marker?>" class="thickbox">
<?=$lang_edit_marker?></a> </td>       <td width="30%">  <input type="text" class="inputbox" TABINDEX="13" name="marker" size="4"  value=""></td>
<td width="15%">
<a href="./help_pop.php?num_subtitle=13&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_sec_marker?>" class="thickbox">
<?=$lang_edit_sec_marker?></a></td> <td width="30%"><input type="text" name="sec_marker" TABINDEX="14" class="inputbox" size="10"  value=""> </td>
</tr>
<tr>
<td>
<a href="./help_pop.php?num_subtitle=14&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_word?>" class="thickbox">
<?=$lang_edit_word?></a></td> <td><input type="text" class="inputbox" id="word" name="word" TABINDEX="15" size="20"  value=""> </td>
<td>
<a href="./help_pop.php?num_subtitle=15&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_word_grammar?>" class="thickbox">
<?=$lang_edit_word_grammar?>
</a></td> <td><input type="text" class="inputbox" name="gram_2" size="10" TABINDEX="16" value=""> </td>
</tr>
<tr>
<td>
<div>
<a href="./help_pop.php?num_subtitle=17a&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_synonym?>" class="thickbox">
<?=$lang_edit_synonym?></a></td>
<td> <input type="text" name="synonym_visible" id="synonym_visible" class="inputbox" TABINDEX="17" onBlur="toggle_synonym()" onChange="toggle_synonym()" size="4"  value=""> 
</div>
<input type="hidden" id="synonym" name="synonym" value="">
</td>
<td>
<a href="./help_pop.php?num_subtitle=17b&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_add_synonym_link?>" class="thickbox">
<?=$lang_add_synonym_link?></a></td> <td> <input type="text" name="synonym_link" class="inputbox" TABINDEX="18" size="20"  value=""> </td>
</tr>
<tr>
<td></td>
<td></td>
<td>
<a href="./help_pop.php?num_subtitle=27&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_antonym?>" class="thickbox">
<?=$lang_edit_antonym?></a></td> <td><input type="text" name="antonym" class="inputbox" size="10" TABINDEX="19" value=""> </td>
</tr>
<tr>
<td>
<a href="./help_pop.php?num_subtitle=29a&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_phrase_order1?>" class="thickbox">
<?=$lang_edit_phrase_order1?></a></td> <td><input type="text" name="phrase" class="inputbox" size="10"  TABINDEX="20" value=""> </td>
<td>
<a href="./help_pop.php?num_subtitle=29b&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_phrase_order2?>" class="thickbox">
<?=$lang_edit_phrase_order2?></a></td> <td><input type="text" name="phrase_order" class="inputbox" size="10" TABINDEX="21" value=""> </td>
</tr>
</table>
<br>
<table class="sample" width="100%" border="0">
<tr>
<td width="15%">
<a href="./help_pop.php?num_subtitle=16a&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_translation?>" class="thickbox">
<?=$lang_edit_translation?></a></td><td width="30%"> <input type="text" name="translation" class="inputbox" TABINDEX="22" size="20"  value=""> </td>
<td width="15%">
<a href="./help_pop.php?num_subtitle=16b&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_add_tran_usage?>" class="thickbox">
<?=$lang_add_tran_usage?></a></td><td width="30%"><input type="text" name="translation_usage" class="inputbox" TABINDEX="23" size="20"  value=""> </td>
</tr>
<tr>
<td>
<a href="./help_pop.php?num_subtitle=16c&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_add_tran_detail?>" class="thickbox">
<?=$lang_add_tran_detail?>  </a></td><td><textarea name="translation_detail" id="translation_detail" class="inputbox" TABINDEX="24" rows="2" cols="20"></textarea> </td>
<td></td>
<td></td>
</tr>
</table>
<br>
<table class="sample" width="100%">
<tr>
<td width="15%">
<a href="./help_pop.php?num_subtitle=18&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_example?>" class="thickbox">
<?=$lang_edit_example?></a> </td><td width="30%"><textarea name="example" id="example" class="inputbox" rows="2" TABINDEX="25" cols="20"></textarea> </td>
<td width="15%">
<a href="./help_pop.php?num_subtitle=19&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_example_translation?>" class="thickbox">
<?=$lang_edit_example_translation?></a></td><td width="30%"><textarea name="example_translation" class="inputbox" TABINDEX="26" rows="2" cols="20"></textarea></td>
</tr>
<tr>
<td>
<a href="./help_pop.php?num_subtitle=20&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_keyword_in_examples?>" class="thickbox">
<?=$lang_edit_keyword_in_examples?></a></td> <td><textarea name="example_keyword" class="inputbox" rows="2" TABINDEX="27" cols="20"></textarea></td>
<td>
<a href="./help_pop.php?num_subtitle=21&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_notes?>" class="thickbox">
<?=$lang_edit_notes?> </a></td> <td><textarea name="notes" class="inputbox" rows="2" TABINDEX="28" cols="20"></textarea></td>
</tr>
</table>
<br>
<table class="sample" width="100%">
<tr>
<td width="15%"><a href="./help_pop.php?num_subtitle=22&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_link?>" class="thickbox">
<?=$lang_edit_link?></a></td><td width="30%"> <input type="text" class="inputbox" name="link" TABINDEX="29" size="20"  value=""> </td>
<td width="15%">
<a href="./help_pop.php?num_subtitle=23&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_order?>" class="thickbox">
<?=$lang_edit_order?></a></td><td width="30%">  <input type="text" name="order" class="inputbox" TABINDEX="30" size="4"  value=""></td>
</tr>
<tr>
<td>
<div>
<a href="./help_pop.php?num_subtitle=24&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_specification?>" class="thickbox">
<?=$lang_edit_specification?></a></td> 
<td><input type="text" class="inputbox" id="specification_visible" size="20" TABINDEX="31" onChange="toggle()" value="">
</div>
<input type="hidden" id="specification" name="specification" value="">
</td>
<td>
<a href="./help_pop.php?num_subtitle=26&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_latin?>" class="thickbox">
<?=$lang_edit_latin?></a></td> <td><input type="text" class="inputbox" name="latinnames" TABINDEX="32" size="20"  value=""> </td>
</tr>
<tr>
<td>
<div>
<a href="./help_pop.php?num_subtitle=25&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_edit_usage_spec?>" class="thickbox">
<?=$lang_edit_usage_spec?></a></td> <td><input type="text" class="inputbox" TABINDEX="33" id="usage_specification_visible" size="20"  onChange="toggle_usage_specification()" value="">
</div>
<input type="hidden" id="usage_specification" name="usage_specification" value="">
</td>
<td>
<a href="./help_pop.php?num_subtitle=28&keepThis=true&TB_iframe=true&height=500&width=900" title="<?=$lang_popup_help?><?=$lang_add_usage_category?>" class="thickbox">
<?=$lang_add_usage_category?> </a> </td>      <td> <input type="text" name="usage_category" TABINDEX="34" class="inputbox" size="20"  value=""> </td>
</tr>
</table>
</form>
</div>
<?php } ?>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
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
</script>
<?php 
include ('./html_end.php');
?>