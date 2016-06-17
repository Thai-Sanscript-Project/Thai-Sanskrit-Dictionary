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
function str_replace_once($needle , $replace , $haystack){
$pos = strpos($haystack, $needle);
if ($pos === false) {
return $haystack;
}
return substr_replace($haystack, $replace, $pos, strlen($needle));
}
?>
<?php include './head_s.php'; ?>
<script type="text/javascript" src="<?=$IMAGE_URL?>audio/audio-player/audio-player.js"></script>  
<script type="text/javascript">  
AudioPlayer.setup("<?=$IMAGE_URL?>audio/audio-player/player.swf", {  
width: 290,
bg: "eeeeee",
initialvolume: 100,  
transparentpagebg: "yes",
leftbg: "eeeeee",
lefticon: "666666",
rightbg: "e8cae4",
rightbghover: "e9a0c0",
righticon: "666666",
righticonhover: "666666",
text:"666666",
slider: "e8cae4",
track: "FFFFFF",
border: "666666", 
loader:" e8cae4"
});  
</script> 
</head>
<body onload="setfocus()">
<div id="wrapper">
<?php include 'header.php'; 
include 'menu.php'; 
echo $MAIN_MENU;
?>
<div id="content">
<div class="left_huge">
<h2><?=$lang_pron_info10?></h2>
<p><?=$lang_pron_info11?></p>
<p><form action="pron_gen.php?action=search" method="post" name="form2">
<table  class="sample">
<tr><td>
<span class="search_string">
<span onclick="document.form2.search_pattern.value += 'ð';document.form2.search_pattern.focus()" onmouseover="this.style.cursor='pointer'">ð</span>
<span onclick="document.form2.search_pattern.value += 'þ';document.form2.search_pattern.focus()" onmouseover="this.style.cursor='pointer'">þ</span>
<span onclick="document.form2.search_pattern.value += 'æ';document.form2.search_pattern.focus()" onmouseover="this.style.cursor='pointer'">æ</span>
<span onclick="document.form2.search_pattern.value += 'ö';document.form2.search_pattern.focus()" onmouseover="this.style.cursor='pointer'">ö</span>
<span onclick="document.form2.search_pattern.value += 'é';document.form2.search_pattern.focus()" onmouseover="this.style.cursor='pointer'">é</span>
<span onclick="document.form2.search_pattern.value += 'í';document.form2.search_pattern.focus()" onmouseover="this.style.cursor='pointer'">í</span>
<span onclick="document.form2.search_pattern.value += 'ó';document.form2.search_pattern.focus()" onmouseover="this.style.cursor='pointer'">ó</span>
<span onclick="document.form2.search_pattern.value += 'ú';document.form2.search_pattern.focus()" onmouseover="this.style.cursor='pointer'">ú</span>
<span onclick="document.form2.search_pattern.value += 'ý';document.form2.search_pattern.focus()" onmouseover="this.style.cursor='pointer'">ý</span>
<span onclick="document.form2.search_pattern.value += 'á';document.form2.search_pattern.focus()" onmouseover="this.style.cursor='pointer'">á</span>
</span> 
<input type="text" id="search_pattern" name="search_pattern" size="40" maxlength="40"></td>
<td> <input type="submit" class="button2" name="submit_pron" value="<?=$lang_edit_submit?>"></td>
</tr></table></form>
<?php
echo  '<div class="view_entry">';
if ((($_POST["submit_pron"]) OR ($_GET["action"]=='search')) AND ($_POST["search_pattern"]!='')) {
include './scripts/pronunciation_generate.php';
} else if ($_GET["action"]=='show_cluster') {
$table='ds_phonems';
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$sql = sprintf ('SELECT * FROM `%s` WHERE `writing` COLLATE `%s`= %s',
	$table,
	$collation_1,
	quate_smart($_GET["cluster"]));
$oop->Setnames();
$oop->query($sql);
$num89 = $oop->getNumrows();
if ($num89!=0) {
$first_position=1;
$result_exp.='<a href="./pron_gen.php?action=search&search_word_cl='.$_GET["searched_word_cl"].'">'.$lang_pron_info12.'</a>';
$result_exp.='<table  class="sample">';
$result_exp.= '<tr><td>';
$result_exp.= $lang_pron_info13;
$result_exp.= '</td></tr>';
while ($row = $oop->fetchRow ()):
if ($row[3]==2) {
$position=$lang_phonetic8;
} else if ($row[3]==3) {
$position=$lang_phonetic9;
} else if ($row[3]==4) {
$position=$lang_phonetic20;
} else if ($row[3]==5) {
$position=$lang_phonetic21;
} else if ($row[3]==1) {
$position=$lang_phonetic7;
} else if ($row[3]==6) {
$position=$lang_phonetic23;
}
$result_exp.= '<tr>'; 	
$result_exp.='<td'.$add.'>';
$result_exp.= ''.$row[1].'';
$result_exp.= '</td><td'.$add.'>';
$result_exp.= '<entry class="phonetics_result">['.$row[2].']</entry>';	
$result_exp.= '</td><td'.$add.'>';
$result_exp.= $position;
$result_exp.= '</td><td'.$add.'>';
$result_exp.= $row[4];
$result_exp.= '</td><td'.$add.'>';
$result_exp.= $row[5];
$result_exp.= '</td>';
$result_exp.= '</td><td'.$add.'>';
$result_exp.= $row[8];
$result_exp.= '</td>';
$result_exp.='</tr>';
endwhile;
$result_exp.='</table>';
}
$oop->freeResult();
$oop->_mySQL;
}
echo $result_exp;
echo '</div>';
?>
</div>
<?php
if (($_POST["submit_pron"]) AND ($_POST["search_pattern"]!='')) {
?>
<div class="right_pron">
<?php
if ($result_comp!='') {
echo $result_comp;} else {
echo $lang_pron_info14;	
}
?>
</div>
<?php 
}
?>
<div style="clear: both;">&nbsp;</div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div></div><?php 
include ('./html_end.php');
?>
