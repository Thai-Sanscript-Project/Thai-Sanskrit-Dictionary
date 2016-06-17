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
if((isset($_POST["post_m"])) AND ($_POST["post_m"]!="")){
$_SESSION["post_m"]=$_POST["post_m"];
}else{
if($_GET["post_m"]!=''){
$_SESSION["post_m"] = $_GET["post_m"];
} else {
if(isset($_SESSION["post_m"])){
}else{
$_SESSION["post_m"] = "2";
}}}
if((isset($_POST["adv_field"])) AND ($_POST["adv_field"]!="")){
$_SESSION["post_f"]=$_POST["adv_field"];
}else{
if($_GET["post_f"]!=''){
$_SESSION["post_f"] = $_GET["post_f"];
} else {
if(isset($_SESSION["post_f"])){
}else{
$_SESSION["post_f"] = "keyword";
}}}
?>
<div id="header">
<div id="logo">
<div id="lang_selector"><select id="example-04">
<option value="cz">čeština</option>
<option value="en">English</option>
<?php
if ($_SESSION["login"]!='true') {?>
<option value="is">íslenska</option>
<option value="pl">polska</option>
<option value="sl">slovenčina</option>
<option value="fr">français</option>
<?php } ?>
</select> </div>
<h1><a href="./index.php"><?=$lang_header_dict;?></a><a name="UP"></a></h1>
<h2><?=$lang_search_vyhledej?>
<span onclick="setchar('ð')" class="s_char">ð</span>
<span onclick="setchar('þ')" class="s_char">þ</span>
<span onclick="setchar('æ')" class="s_char">æ</span>
<span onclick="setchar('ö')" class="s_char">ö</span>
|<span onclick="setchar('é')" class="s_char">é</span>
<span onclick="setchar('í')" class="s_char">í</span>
<span onclick="setchar('ó')" class="s_char">ó</span>
<span onclick="setchar('ú')" class="s_char">ú</span>
<span onclick="setchar('ý')" class="s_char">ý</span>
<span onclick="setchar('á')" class="s_char">á</span>
|<span onclick="setchar('ě')" class="s_char">ě</span>
<span onclick="setchar('č')" class="s_char">č</span>
<span onclick="setchar('ů')" class="s_char">ů</span>
<span onclick="setchar('ř')" class="s_char">ř</span>
<span onclick="setchar('š')" class="s_char">š</span>
<span onclick="setchar('ž')" class="s_char">ž</span>
</h2>
<form action="search.php?action=find&amp;list_kind=users" method="post" name="form1">
<table  border="0">
<tr> 
<td>
<input type="text" name="search_string" value="" size="30" maxlength="30">
</td><td>
<select name="post_m">
<option value="1" <?php if (($_SESSION["post_m"])==1) { echo 'selected';}?>> <?=$lang_search_option1?></option>
<option value="2" <?php if (($_SESSION["post_m"])==2) { echo 'selected';}?>> <?=$lang_search_option2?></option>
<option value="3" <?php if (($_SESSION["post_m"])==3) { echo 'selected';}?>> <?=$lang_search_option3?></option>
<option value="4" <?php if (($_SESSION["post_m"])==4) { echo 'selected';}?>> <?=$lang_search_option4?> </option>
</select> 
<td><h2>
<?=$lang_search_oblast?></h2>
</td>
<td>
<?php
// visitors / general public / not all fields in advanced search	 
$searched_areas = array(	
'keyword' => $lang_search_klicove_slovo,
'translation' => $lang_search_cat14,
'keyword_variant' => $lang_search_cat2,
'translation_detail' => $lang_search_cat15,
'gram_1_word_group' => $lang_search_cat5,
'gram_2_endings' => $lang_search_cat6,
'gram_3_additional' => $lang_search_cat7,
'gram_2' => $lang_search_cat10,
'word' => $lang_search_cat13,
'synonym' => $lang_search_cat11,
'antonym' => $lang_search_cat16,
'link' => $lang_search_cat18,
'example' => $lang_search_cat19,
'example_translation' => $lang_search_cat20,
'example_keyword' => $lang_search_cat12,
'specification' => $lang_search_cat22,
'usage_specification' => $lang_search_cat25,
'usage_category' => $lang_search_cat27,
'latinnames' => $lang_search_cat23,
);
$cz_areas = array(	
'translation' => $lang_search_cat14,
'translation_detail' => $lang_search_cat15,
'example_translation' => $lang_search_cat20,
);
$searched_areas_dict = array(	
'gram_2' => $lang_search_cat10,
'synonym' => $lang_search_cat11,
'word' => $lang_search_cat13,
'translation' => $lang_search_cat14,
'translation_detail' => $lang_search_cat15,
'antonym' => $lang_search_cat16,
'sec_marker' => $lang_search_cat17,
'link' => $lang_search_cat18,
'example' => $lang_search_cat19,
'example_translation' => $lang_search_cat20,
'example_keyword' => $lang_search_cat12,
'notes' => $lang_search_cat21,
'specification' => $lang_search_cat22,
'usage_specification' => $lang_search_cat25,
'usage_category' => $lang_search_cat27,
'latinnames' => $lang_search_cat23,
'marker' => $lang_search_cat24,
'num_keyword' => $lang_search_cat26,
);
$pageok = $page[$searched_areas];
?>
<select ID="source" name="adv_field">
<?php 
$n=0;
foreach ($searched_areas as $key1 => $value) {
if ($_SESSION["post_f"]==$key1) {
if (($key1=='translation') OR ($key1=='keyword')) {
$ad = 'style="font-weight: bold"';
} else {
$ad='';	
}
echo '<option value="'.$key1.'" '.$ad.' selected>'.$value.'</option>';	
} else {
if (($key1=='translation') OR ($key1=='keyword')) {
$ad = 'style="font-weight: bold"';
} else {
$ad='';	
}
echo '<option value="'.$key1.'" '.$ad.'>'.$value.'</option>';
}
$n++;
}
?>
</select>
</td> 
<td> 
<input type="submit" class="button2" name="submit" value="<?=$lang_search_button?>">
</td>
</tr>
</table>
</form>  
</div>
</div>
