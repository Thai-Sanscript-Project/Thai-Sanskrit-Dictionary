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
// view_word is true
$table_keyword='ds_1_headword';
if ($cz===true) {
$collation=$collation_2;
} else {
$collation=$collation_1;			
}
if ($_SESSION["d_h"]=='') {
$_SESSION["d_h"]=$_SESSION["first_keyword"];
$_SESSION["d_h_n"]= $_SESSION["first_num_keyword"];
}
$oop_w_h = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$sql = sprintf ('SELECT `keyword`, `num_keyword` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table_keyword,
	$collation,
	quate_smart($_SESSION["d_h"]),
	quate_smart($_SESSION["d_h_n"])); 
$oop_w_h->Setnames();
$oop_w_h->query($sql);
$num = $oop_w_h->getNumRows();
if ($num!=0) {
// record the view word
$table_queries='ds_queries';
$oop_evidence = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
if (($_SESSION["rights"]==2) OR ($_SESSION["rights"]==1)) {
	$usr='registered';
} else {
	$usr='unregistered';
}
$sql = sprintf ('SELECT `keyword` FROM `%s` WHERE `keyword` = %s AND `ip` = %s LIMIT 0, 1',
	$table_queries,
	quate_smart($_SESSION["d_h"]),
	quate_smart($ip)); 
$oop_evidence->Setnames();
$oop_evidence->query($sql);
$returned_e = $oop_evidence->fetchRow ();
$oop_evidence->FreeResult();
if ($returned_e[0]!=$_SESSION["d_h"]) {
$sql = sprintf ('INSERT INTO `%s` (`id`, `keyword`, `field`, `ip`, `time`) VALUES (NULL, %s, %s, %s, %s)',
	$table_queries,	
	quate_smart($_SESSION["d_h"]),
	quate_smart($usr),
	quate_smart($ip),
	quate_smart(date("Y-m-d H:i:s")));
$oop_evidence->Setnames();
$oop_evidence->query($sql);
$oop_evidence->FreeResult();
}
$oop_evidence->_mySQL;
$returned_1 = $oop_w_h->fetchRow ();
$oop_w_h->freeResult();
$view_word='true';
$view_keyword=$returned_1[0];
$view_num_keyword=$returned_1[1];
$base_url="./search.php?d_h=".$view_keyword."&d_h_n=".$view_num_keyword;
// display the headword
if ($view_word=='true') {
include './scripts/view_word_br_hvalur.php';
$BUFFER_SEARCH2 .= $BUFFER_VIEW_KEYWORD;
$BUFFER_SEARCH2 .= '<br>';
// headwords in examples
include './scripts/view_example_br_x.php';
if ($example_output!='') {
$BUFFER_SEARCH2 .= '<div class="viewentry">';
$BUFFER_SEARCH2 .= "<span class =\"nav\">".$lang_search_keyword_in_example."</span>";
$BUFFER_SEARCH2 .= $example_output;
$BUFFER_SEARCH2 .= '</div>';	
}
// images
include './scripts/view_image_br_x.php';
if ($picture_found!=false) {
$BUFFER_SEARCH2 .= '<div class="viewentry">';
$BUFFER_SEARCH2 .= "<span class =\"nav\">".$lang_search_keyword_in_image."</span>";	    
$BUFFER_SEARCH2 .= $image_output;
$BUFFER_SEARCH2 .= '</div>';
}
// synonyms
include './scripts/view_synonym_br_x.php';
if ($synonym_output!='') {
$BUFFER_SEARCH2 .= '<div class="viewentry">';
$BUFFER_SEARCH2 .= "<span class =\"nav\">".$lang_search_synonyms."</span>";	    
$BUFFER_SEARCH2 .= $synonym_output;
$BUFFER_SEARCH2 .= '</div>';
}
// we find the grammer of viewed word
$table=  'ds_1_headword';
$sql_c = sprintf ('SELECT `gram_1_word_group`, `gram_2_endings`, `gram_3_additional` FROM  `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`= %s ',
	$table,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop_w_h->Setnames();
$oop_w_h->query($sql_c);	
$returned_c = $oop_w_h->fetchRow();
$oop_w_h->FreeResult();
// usage cagegory
if ($_GET["d_h"]) { 
$usage_keyword=$_GET["d_h"];
$usage_num_keyword=$_GET["d_h_n"];
}
else
{
$usage_keyword=$view_keyword;
$usage_num_keyword=$view_num_keyword;
}
include './scripts/view_usage_category_detail_br_x.php';
if ($usage_list_found!=false) {
$BUFFER_SEARCH2 .= '<div class="viewentry">';
$BUFFER_SEARCH2 .= "<span class =\"nav\">".$lang_search_menus1."</span>";	    
$BUFFER_SEARCH2 .= $usage_list_output;
$BUFFER_SEARCH2 .= "</div>";
}
if ($usage_found!=false) {
$BUFFER_SEARCH2 .= '<div class="viewentry">';
$BUFFER_SEARCH2 .= "<span class =\"nav\">".$lang_search_menus1a."</span>";	    
$BUFFER_SEARCH2 .= $usage_output;
$BUFFER_SEARCH2 .= "</div>";
}
// compound words
$table=  'ds_1_headword';
$sql_c = sprintf ('SELECT `words_in_compound2` FROM  `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`= %s ',
	$table,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop_w_h->Setnames();
$oop_w_h->query($sql_c);	
$returned_g = $oop_w_h->fetchRow();
$oop_w_h->FreeResult();
if ($returned_g[0]!='') {
$BUFFER_SEARCH2 .= '<div class="viewentry">';
$BUFFER_SEARCH2 .= "<span class =\"nav\">".$lang_comp_word1."</span>";	
$BUFFER_SEARCH2 .= '<div class="main_entry">';
$BUFFER_SEARCH2 .= $returned_g[0];
$BUFFER_SEARCH2 .= "</div>";
$BUFFER_SEARCH2 .= "</div>";
}
$BUFFER_SEARCH2 .= "</div>";
$BUFFER_SEARCH2 .= '<div class="search_2column">';

$sql4 = sprintf ('SELECT `pronunciation` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`= %s',
	$table_keyword,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword)); 
$oop_w_h->Setnames();
$oop_w_h->query($sql4);
$IPA_pron = $oop_w_h->fetchArray ();
$oop_w_h->freeResult();
$buffer_ipa .= "<span class=\"pronunciation_search\"> [".$IPA_pron[0]."] </span>";  
$buffer_ipa .= '<br><br>';
// sound
$table_sound = 'ds_sound';
$sql4 = sprintf ('SELECT `sound`, `author`, `licence` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`= %s',
	$table_sound,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword)); 
$oop_w_h->Setnames();
$oop_w_h->query($sql4);
$num_s = $oop_w_h->getNumRows();
$sound_found=FALSE;
if ($num_s!=0) {
$sound_found=TRUE;
$rr_count=0;
while ($sound = $oop_w_h->fetchArray ()):
$rr_count++;
clearstatcache();
$file = $IMAGE_URL."audio/uploaded_files/".$sound[0];
$final_file=$file;
$buffer_sound .= "<span id=\"audioplayer_".$rr_count."\"></span>";  
$buffer_sound .="<script type=\"text/javascript\">";
$buffer_sound .= "AudioPlayer.embed(\"audioplayer_".$rr_count."\", {soundFile: \"".$final_file."\", titles: \"".$view_keyword."\"});</script> ";
$buffer_sound .= "<span class=\"foto\">".$lang_img2."</span> <span class=\"nav\">".$sound[1]."</span> ";
$buffer_sound .= "<span class=\"foto\">".$lang_img3."</span> <span class=\"nav\">".$sound[2]."</span>";
if ($_SESSION["login"]!='true') {
$buffer_sound .= "<div id=\"sound\">
			<a href=\"http://www.adobe.com/go/getflashplayer\"> Download Flash Player
				<img src=\"images/get_flash_player.gif\" alt=\"Get Adobe Flash player\">
			</a>
		</div>";
}
if (($_SESSION["rights"])!=3) {
$sound_output_delete .= "<li><a href=\"./multiple.upload.form.php?action=del&amp;name_of_file=".$sound[0]."&amp;a=sound&amp;d_h=".$_GET["d_h"]."&amp;d_h_n=".$_GET["d_h_n"]."\">".$lang_search_mes4.$rr_count."</a> </li>";
}
endwhile;
}
$oop_w_h->freeResult();
$oop_w_h->_mySQL;

if (($num_s!=0) OR ($IPA_pron[0]!='')) {
$buffer_pron .= '<div class="viewentry">';
$buffer_pron .= "<span class =\"nav\">".$lang_search_pron."</span>";	    
$buffer_pron .= '<div class="main_entry">';
if ($IPA_pron[0]!='') {
$buffer_pron .= $buffer_ipa;		
}
if ($num_s!=0) {
$buffer_pron .= $buffer_sound;		
}
$buffer_pron .= '</div>';
$buffer_pron .= '</div>';
$BUFFER_SEARCH2 .= $buffer_pron;
}
// declination
if (($returned_c[0]=='n') OR ($returned_c[0]=='f') OR ($returned_c[0]=='m') OR ($returned_c[0]=='pron') OR ($returned_c[0]=='adj') OR ($returned_c[0]=='v') OR ($returned_c[0]=='adv') OR ($returned_c[0]=='num') OR ($returned_c[0]=='part')) {
$BUFFER_SEARCH2 .= '<div class="viewentry">';
$BUFFER_SEARCH2 .= "<span class =\"nav\">".$lang_search_declinations."</span>";	    
if ($_SESSION["long_dec_show"]=='1') {
$BUFFER_SEARCH2 .= "<a href=\"./search.php?list_kind=alpha&amp;long_dec=true&amp;d_h=".$view_keyword."&amp;d_h_n=".$view_num_keyword."\"><span class =\"nav\">".$lang_search_dec_short."</span></a>";
} else {
$BUFFER_SEARCH2 .= "<a href=\"./search.php?list_kind=alpha&amp;long_dec=true&amp;d_h=".$view_keyword."&amp;d_h_n=".$view_num_keyword."\"><span class =\"nav\">".$lang_search_dec_long."</span></a>";     
}
$BUFFER_SEARCH2 .= '</div>';
$BUFFER_SEARCH2 .= '<div class="viewentry">';
if (($returned_c[0]=='n') OR ($returned_c[0]=='f') OR ($returned_c[0]=='m')) {
include './scripts/view_declination_noun.php'; 
}
else if ($returned_c[0]=='adj') {
include './scripts/view_declination_adj_all.php';
} else if ($returned_c[0]=='v'){
include './scripts/view_declination_verb_all.php';
}
else if (($returned_c[0]=='adv') OR ($returned_c[0]=='adv/ pron')){
include './scripts/view_declination_adv.php';
}
else if (($returned_c[0]=='pron') AND ($returned_c[1]=='pers') AND ($pos3 !== false)) {
include './scripts/view_declination_pron_pers.php';	
}
else if (($returned_c[0]=='pron') OR ($returned_c[0]=='num') OR ($returned_c[0]=='part') OR ($returned_c[0]=='pron/ num')) {
include './scripts/view_declination_pron.php';	
}
$BUFFER_SEARCH2 .= $BUFFER_DEC;
$BUFFER_SEARCH2 .= '</div>';
}
if ($fr_output!='') {
}
$BUFFER_SEARCH2 .= '</div>';
if ($output_phrase!='') {
$BUFFER_SEARCH2 .= '<div id="phraselist">';
$BUFFER_SEARCH2 .= $output_phrase;
$BUFFER_SEARCH2 .= '</div>';
}
}// END => view word
} // no headword found or was not chosen
else 
{
$BUFFER_SEARCH2 .=$lang_search_mes3;
}
?>
