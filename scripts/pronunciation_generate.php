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
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop4 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$long_atkvaedi=FALSE;
$rr_count=0;
$samsett_ord2=array();
// DIRECT UPDATING OF THE WORD (MEANING)
if ($_POST["submit_pron"]) {
$search_pattern=$_POST["search_pattern"]; 
$stem_for_pronunciation=$_POST["search_pattern"]; 
} else if ($ipa=='yes') {
$search_pattern=$view_keyword;	
$stem_for_pronunciation=$view_keyword;
} else if ($_GET["action"]=='search') {
$search_pattern=$_GET["search_word_cl"]; 
$stem_for_pronunciation=$_GET["search_word_cl"]; 
} else  {
$search_pattern=$view_keyword;	
$stem_for_pronunciation=$view_keyword;
}
// we have to load the stem record from keyword database to handle correcty the keyword
$table_keyword='ds_1_headword';
$sql4 = sprintf ('SELECT `stem` FROM `%s` WHERE `keyword` COLLATE `%s` = %s',
	$table_keyword,
	$collation_1,
	quate_smart($search_pattern));
$oop4->Setnames();
$oop4->query($sql4);
$num = $oop4->getNumRows();
if ($num!=0) {
$unique_row = $oop4->fetchRow ();
$stem_for_pronunciation=$unique_row[0];
} else {
}
$oop4->freeResult();
$table = 'ds_phonems';
$vowels = array(	
'0' => 'a',
'1' => 'á',
'2' => 'e',
'3' => 'é',
'4' => 'i',
'5' => 'í',							
'6' => 'o',
'7' => 'ó',
'8' => 'u',
'9' => 'ú',
'10' => 'y',
'11' => 'ý',
'12' => 'æ',
'13' => 'ö',
);
$all_vowels = array(	
'0' => 'a',
'1' => 'á',
'2' => 'e',
'3' => 'é',
'4' => 'i',
'5' => 'í',							
'6' => 'o',
'7' => 'ó',
'8' => 'u',
'9' => 'ú',
'10' => 'y',
'11' => 'ý',
'12' => 'æ',
'13' => 'ö',
'14' => 'au',
'15' => 'ei',
'16' => 'ey',
);
$vowels_change_before_ng = array(	
'0' => 'a',
'1' => 'e',
'2' => 'i',
'3' => 'u',
'4' => 'y',
'5' => 'ö',
);
$f_brott_vowels = array(	
'0' => 'á',
'1' => 'ó',
'2' => 'ú',
);
$g_after_vowels = array(	
'0' => 'a',
'1' => 'u',
);
$fram_vowels = array(	
'0' => 'e',
'1' => 'i',
'2' => 'í',							
'3' => 'y',
'4' => 'ý',
'5' => 'æ',
'6' => 'ei',
'7' => 'ey',
);
$double_vowels = array(	
'0' => 'au',
'1' => 'ei',
'2' => 'ey',
);
$nn_vowels = array(	
'0' => 'au',
'1' => 'ei',
'2' => 'ey',
'3' => 'í',
'4' => 'ú',
'5' => 'æ',
'6' => 'á',
'7' => 'ó',
);
$ahersla_1_consonants = array(	
'0' => 'p',
'1' => 't',
'2' => 'k',
'3' => 's',
);
$ahersla_2_consonants = array(	
'0' => 'v',
'1' => 'j',
'2' => 'r',
);
$raddad_consonants_b_d_g_h = array(	
'6' => 'ç',
'7' => 'cʰ',
'8' => 'tʰ',
'9' => 's',
'10' => 'l̥',
'11' => 'kʰ',
);
// preparation of stem information into phonetic word division
$stem_for_pronunciation = str_replace  ('··', '·',  $stem_for_pronunciation);
$stem_for_pronunciation = str_replace  ('|', '',  $stem_for_pronunciation);
$stem_for_pronunciation = str_replace  ('·', '*',  $stem_for_pronunciation);
$headword_for_sound = str_replace  ('*', '',  $stem_for_pronunciation);
$pieces = explode("*", $stem_for_pronunciation);
$ary[] = "UTF-8";
$ary[] = "ASCII";
mb_detect_order($ary);
mb_internal_encoding("UTF-8");
$nw=0;
$num_samsett_ord=0;
$samsett_ord='';
foreach ($pieces as $word_item => $word_item_value) {
$search_pattern=mb_strtolower($word_item_value);
$num_samsett_ord++;
$samsett_ord[$num_samsett_ord]=$word_item_value;
$search_pattern_division='';
$consonant_last=FALSE;
$cc= 0;
$nw++;
$num=mb_strlen($search_pattern);
$skip_next_vowel=FALSE;
$skip_next_vowel_num=0;
// we declear first vowel, it changes when first vowel appears
// on the second or other position
// it doesnot effect first position
$first_vowel=FALSE;
$items='';
//  CHANGING THE WORDS INTO CONSONANTS AND WOWELS
for ($i = 0; $i < $num; $i++) {
$char[$i] = mb_substr($search_pattern,$i,1);
$char[$i+1] = mb_substr($search_pattern,$i+1,1);
$vowel_true=FALSE;    
foreach ($vowels as $k => $v) {
if ($char[$i]==$v) {
$vowel_true=TRUE;	
}
}
if ($vowel_true===TRUE) {
if ($skip_next_vowel===TRUE) {
$skip_next_vowel_num++;	
}
//check the doble vowel
if ($char[$i].$char[$i+1]=='au') {
$cc++;
$items[$nw][$cc]=$char[$i].$char[$i+1];
$skip_next_vowel=TRUE;
$search_pattern_division.='v';
$search_pattern_division2.='v';
$consonant_last=FALSE;
$skip_next_vowel_num=1;
} else if ($char[$i].$char[$i+1]=='ei') {
$cc++;
$items[$nw][$cc]=$char[$i].$char[$i+1];
$skip_next_vowel=TRUE;
$search_pattern_division.='v';
$search_pattern_division2.='v';
$consonant_last=FALSE;
$skip_next_vowel_num=1;
} else if ($char[$i].$char[$i+1]=='ey') {
$cc++;
$items[$nw][$cc]=$char[$i].$char[$i+1];
$skip_next_vowel=TRUE;
$search_pattern_division.='v';
$search_pattern_division2.='v';
$consonant_last=FALSE;
$skip_next_vowel_num=1;
} else { 
if ($skip_next_vowel!==TRUE) {
$search_pattern_division.='v';
$search_pattern_division2.='v';
$consonant_last=FALSE;
$cc++;
$items[$nw][$cc]=$char[$i];
$skip_next_vowel=FALSE;
}
}
if ($skip_next_vowel_num==2) {
$skip_next_vowel=FALSE;
$skip_next_vowel_num==0;
}
} else {
// we complete the consonant clusters
if ($consonant_last===TRUE) {
$sql2 = sprintf ('SELECT * FROM `%s` WHERE `writing` COLLATE `%s`= %s',
	$table,
	$collation_1,
	quate_smart($items[$nw][$cc].$char[$i]));
$oop2->Setnames();
$oop2->query($sql2);
$num_2 = $oop2->getNumrows();
$oop2->freeResult();
if ($num_2!=0) {
// there exists a consonant group in database
$items[$nw][$cc]=$items[$nw][$cc].$char[$i];
} else {
// there is no such a c. group, it means there begins new word, compound word
$cc++;
$items[$nw][$cc]=$char[$i];
$search_pattern_division2.='K';
$search_pattern_division.='K';
}
} else {
$cc++;	
$items[$nw][$cc]=$char[$i];
$search_pattern_division2.='K';
$search_pattern_division.='K';
}
$consonant_last=TRUE;
}
} 
$number=0; $aa=0;
//  WORDS IN ARRAYS OF LETTERS
$result_exp.='<table  class="sample">';
$result_exp.= '<tr><td>';
$result_exp.= $lang_pron_gen1;
$result_exp.= '</td><td>';
$result_exp.= $lang_pron_gen2;
$result_exp.= '</td><td>';
$result_exp.= $lang_pron_gen3;
$result_exp.= '</td><td>';
$result_exp.= $lang_pron_gen4;
$result_exp.= '</td><td>';
$result_exp.= $lang_pron_gen5;
$result_exp.= '</td>';
$result_exp.= '<td>';
$result_exp.= $lang_pron_gen2;
$result_exp.= '</td></tr>';
$_info_long=FALSE;
foreach ($items as $v_items) {
$bb++; $first_vowel=FALSE; $ch=0;
foreach ($v_items as $k => $v) {
$aa++;	
$num89 = 0;
$sql = sprintf ('SELECT * FROM `%s` WHERE `writing` COLLATE `%s`= %s',
	$table,
	$collation_1,
	quate_smart($v));
$oop->Setnames();
$oop->query($sql);
$num89 = $oop->getNumrows();
if ($num89!=0) {
$first_position=1;
while ($row = $oop->fetchRow ()):
// long vowel
// Kv fá
// KvK far
// vKv aka
// when p,t,k,s and follows v,j,r - nepja
//
// starting position
if ($k==1) {
$found=FALSE;
if ($row[3]==1) {
$position=$lang_phonetic7;
} else  if ($row[3]==3) {
$position=$lang_phonetic9;
} else if ($row[3]==2) {
$position=$lang_phonetic8;
} else if ($row[3]==4) {
$position=$lang_phonetic20;
} else if ($row[3]==5) {
$position=$lang_phonetic21;
} else if ($row[3]==6) {
$position=$lang_phonetic23;
}
// first item must match also start position in row[3], all positions and begin and middle position
if (($v==$row[1]) AND (($row[3]==1) OR ($row[3]==3) OR ($row[3]==6))) {
$result1_show.=$row[1].' - <span class="phonetics_result">['.$row[2].']</span>';
if ($row[8]=='vj') {
$result3_show.='<span class="phonetics_result_search_page_exp">'.$lang_pron_wowel7.'</span><br>';
} else if ($row[8]!='') {
$result3_show.='<span class="phonetics_result_search_page_exp">'.$row[8].'</span><br>';
}
// LONG VOWEL
$long_vowel2=FALSE;
$vowel_found=FALSE;
foreach ($vowels as $ka1 => $va1) {
if ($v==$va1)  {
$vowel_found=TRUE;
}
}
foreach ($double_vowels as $ka1 => $va1) {
if ($v==$va1)  {
$vowel_found=TRUE;
}
}
if (($vowel_found===TRUE) AND ($first_vowel!==TRUE)) { 
$first_vowel=TRUE;
$item_only_one=FALSE;
// if the last letter is next, probably only one consonant remain
$last_letter_next=FALSE;
$last_letter=FALSE;
$num_items=count($items[$bb]);
// only one item (vowel)
if ($num_items==1) {
$long_vowel2=TRUE;
if ($_info_long===FALSE) {
$result2_show.='<span class="phonetics_result_search_page_exp">'.$lang_pron_wowel1.'</span><br>';
$_info_long=TRUE;
}
// more items
} else {
$num_con=mb_strlen($items[$bb][$aa+1]);
//next cluster cant be vowel
// we are sure that the next item is only one letter
// consonant
if ($num_con==1) {
// we check if the letter after this single consonant is vowel
$vowel_after_consonant_found=FALSE;
foreach ($all_vowels as $ka1 => $va1) {
if ($items[$bb][$aa+2]==$va1)  {
$vowel_after_consonant_found=TRUE;
}
}
if ($vowel_after_consonant_found===TRUE) {
// only one consonant followed by vowel
$item_only_one=TRUE;	
}
// next item is cluster og double vowel (contains more than one letter)
} else {
// else we search if the two letters in item are not consonants
for ($i = 0; $i < 2; $i++) {
$maybe_consonant[1] = mb_substr($items[$bb][$aa+1],$i-1,1);
$maybe_consonant[2] = mb_substr($items[$bb][$aa+1],$i,1);
}	
}
if ($aa+1==$num_items)   {
// next letter or cluster is last
$last_letter_next=TRUE;
}
// this is last letter or cluster
if ($aa==$num_items)   {               
$last_letter=TRUE;
}
// the two next letters, we have to know if they are consonants and if not belong to special group
if ($item_only_one!==TRUE) {
// whether the consonant after first vowel belongs to p,t,k,s
$ahersla_1_consonants_found=FALSE;
foreach ($ahersla_1_consonants as $ka1 => $va1) {
if ($maybe_consonant[1]==$va1)  {
$ahersla_1_consonants_found=TRUE;
}
}
// whether the consonant after the second consonant belongs to v,j,r
$ahersla_2_consonants_found=FALSE;
foreach ($ahersla_2_consonants as $ka2 => $va2) {
if ($maybe_consonant[2]==$va2)  {
$ahersla_2_consonants_found=TRUE;
}
}
}
// we compare values
// if next letter is not last, we have to search in two possible consonants
// first we check whether both are consonant
// then whether they do no belong together to special group before that is vowel long as well
if ($last_letter!==TRUE) {
if ($last_letter_next!==TRUE) {
if ($item_only_one!==TRUE) {
if (($ahersla_1_consonants_found===TRUE) AND ($ahersla_2_consonants_found===TRUE)) {
$long_vowel2=TRUE;
if ($_info_long===FALSE) {
$result2_show.='<span class="phonetics_result_search_page_exp">'.$lang_pron_wowel2.'</span><br>';
$_info_long=TRUE;
}
}
} else {
if (($items[$bb][$aa+1]=='g') AND ($items[$bb][$aa+2]=='i')) {
if ($_info_long===FALSE) {
$result2_show.='<span class="phonetics_result_search_page_exp">'.$lang_pron_wowel3.'</span><br>';
$_info_long=TRUE;
}
} else {
$long_vowel2=TRUE;	
if ($_info_long===FALSE) {
$result2_show.='<span class="phonetics_result_search_page_exp">'.$lang_pron_wowel4.'</span><br>';
$_info_long=TRUE;
}
}
}
} else {
// the next letter or cluster is last
// if single consonant last = long if cluster short
// it is either single consonant or cluster
if ($num_con==1) {
$long_vowel2=TRUE;	
if ($_info_long===FALSE) {
$result2_show.='<span class="phonetics_result_search_page_exp">'.$lang_pron_wowel5.'</span><br>';
$_info_long=TRUE;
}
}
}
} else {
$long_vowel2=TRUE;
if ($_info_long===FALSE) {
$result2_show.='<span class="phonetics_result_search_page_exp">'.$lang_pron_wowel6.'</span><br>';
$_info_long=TRUE;
}
}
}
}
// LONG VOWEL
// NG_NK
// if vowel preceds ng or nk or nnk or nnl it changes
if ($row[6]=='vowel') {
$found=TRUE;
// vowel before ng etc.
if (($items[$bb][$aa+1]=='ng') OR ($items[$bb][$aa+1]=='nk') OR ($items[$bb][$aa+1]=='nnk') OR ($items[$bb][$aa+1]=='nnl') OR ($items[$bb][$aa+1]=='ngj') OR ($items[$bb][$aa+1]=='nkj') OR ($items[$bb][$aa+1]=='ngl') OR ($items[$bb][$aa+1]=='ngn') OR ($items[$bb][$aa+1]=='ngs') OR ($items[$bb][$aa+1]=='ngt') OR ($items[$bb][$aa+1]=='nkt') OR ($items[$bb][$aa+1]=='nks') OR ($items[$bb][$aa+1]=='nkts')) {
$found=TRUE;
$vowel_ng=FALSE;
foreach ($vowels_change_before_ng as $ka1 => $va1) {
if ($items[$bb][$aa]==$va1)  {
$vowel_ng=TRUE;
}
}
if ($vowel_ng===TRUE) {
if ($row[7]=='3') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
} else {
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 	
}
// vowel before gi
} else if (($items[$bb][$aa+1]=='g') AND ($items[$bb][$aa+2]=='i')) {
// o, a, u
if (($items[$bb][$aa]=='a') OR ($items[$bb][$aa]=='o') OR ($items[$bb][$aa]=='u')) {
if ($row[7]=='gi') {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
// i, y, e, ö, 
} else if ($row[3]=='3') {
$result_full.=$row[2]; $result_det_pron=$row[2];	 
}
} else {
if ($row[7]=='1') {
if ($long_vowel2===TRUE) {	
$result_full.=$row[2].'ː'; $result_det_pron=$row[2].'ː';
} else {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
}	
}
}
// end of NG_NK
if ($row[6]=='ch-n') {
$found=TRUE;
$num_array1=count($items[$bb]);    
$last_letter=FALSE;	
if ($aa==$num_array1)  {               
$last_letter=TRUE;
}
// last cluster
if ($last_letter===TRUE) {
// last position
if ($row[3]=='5') {
// first of last position = has to have 3 in options
if ($row[7]=='3') {	
$result_full.=$row[2]; $result_det_pron=$row[2];
$ch_base=$row[2];
} else {
$ch_choices[$ch]=$row[2]; $result_det_pron=$row[2];
$ch++;		
}
}
// all except last position
} else if ($row[3]!='5'){
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
$ch_base=$row[2];
} else {
$ch_choices[$ch]=$row[2]; $result_det_pron=$row[2];
$ch++;	
}
} 
}
// rule_g
if ($row[6]=='rule_g') {
$found=TRUE;
// find whether the vowel is framgomaelt or uppgomaelt
$framgomael_vowel=FALSE;
foreach ($fram_vowels as $k1 => $v1) {
if ($items[$bb][$aa+1]==$v1)  {
$framgomael_vowel=TRUE;
}
}
if ($framgomael_vowel===TRUE)  {
if ($row[7]=='fram') {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
// uppgomaelt
} else {
if ($row[7]=='upp') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
}
// end of rule_g
// rule_g2
// 1 g in word saga, appears after long vowel
// 2 g in word lágar, app. after á, o, ú before a, u or in back position
// 3 g in word hagi, always before i
// 4 g long in word hagi, and two ways of pronunciation
if ($row[6]=='rule_g2') {
$found=TRUE;
$f_brott_vowel=FALSE;
foreach ($f_brott_vowels as $k1 => $v1) {
if ($items[$bb][$aa-1]==$v1)  {
$f_brott_vowel=TRUE;
}
}
$g_after_vowel=FALSE;
foreach ($g_after_vowels as $k1 => $v2) {
if ($items[$bb][$aa+1]==$v2)  {
$g_after_vowel=TRUE;
}
// if it the last letter
$num_array=count($items);    
if ($aa==$num_array)  {               
$g_after_vowel=TRUE;
}
}
// if gi 
if ($items[$bb][$aa+1]=='i')  {
if ($row[7]=='4') {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
// if á,o,ú before g and a,u after, or last position
} else if (($f_brott_vowel===TRUE) AND ($g_after_vowel===TRUE))  {
if ($row[7]=='2') {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
// the rest , in word saga etc
} else {
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
}
// end of rule_g2
if ($row[6]=='CH') {
$found=TRUE;
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
$ch_base=$row[2];
} else if ($row[6]=='CH'){
$ch_choices[$ch]=$row[2]; $result_det_pron=$row[2];
$ch++;	
}
}
// A - ok is normal pronunciation the other not normal or dialect
if ($row[6]=='A') {
$found=TRUE;
if ($row[7]=='ok') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
// hv 1 is normal pronunciation the other not normal or dialect
if ($row[6]=='stadbundinn') {
$found=TRUE;
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
// THV - 1 normal þv
// 2 in common short words like þvi pronounced þi
// for example page 113
if ($row[6]=='thv') {
$found=TRUE;
if ($row[7]=='1') {
if ($long_vowel===TRUE)  {		
$result_full.=$row[2].'ː'; $result_det_pron=$row[2].'ː';
} else {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
} 
}
// end of FT
// rule_f
if ($row[6]=='rule_f') {
$found=TRUE;
$num_array1=count($items[$bb]);    
$last_letter=FALSE;	
if ($aa==$num_array1)  {               
$last_letter=TRUE;
}
// last cluster
if ($last_letter===TRUE) {
if ($row[3]=='5') {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
} else {
$brott_vowel=FALSE;
foreach ($f_brott_vowels as $k1 => $v2) {
if ($items[$bb][$aa-1]==$v2)  {
$brott_vowel=TRUE;
}
}
if ($brott_vowel===TRUE)  {
if ($row[7]=='brott') {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
} else {
if ($row[7]=='ok') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
}
}
if ($row[6]=='rule_zeta') {
$found=TRUE;
$num_array1=count($items[$bb]);
$num_ord=count($pieces);
$last_letter=FALSE;	
if ($aa==$num_array1)  {               
$last_letter=TRUE;
}
// last cluster
if ($last_letter===TRUE) {
if ($num_ord>1) {
// samsett ord
if ($num_ord==$bb) {
// last letter of samsett ord
if ($row[3]=='5') {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
} else {
// normal pronunciation
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
}	
}
} else {
// last letter of single word
if ($row[3]=='5') {
$result_full.=$row[2]; $result_det_pron=$row[2]; 
}
}
} else {
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
}
}
// end of rule_zeta
// the rest with no condition
if ($found!==TRUE) {
if ($long_vowel===TRUE)  {	
$result_full.=$row[2].'ː';$result_det_pron=$row[2].'ː';
} else {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
}
}
// the middle and end of the word	
} else {
// LONG VOWEL
$long_vowel2=FALSE;
$vowel_found=FALSE;
foreach ($vowels as $ka1 => $va1) {
if ($v==$va1)  {
$vowel_found=TRUE;
}
}
foreach ($double_vowels as $ka1 => $va1) {
if ($v==$va1)  {
$vowel_found=TRUE;
}
}
if (($vowel_found===TRUE) AND ($first_vowel!==TRUE)) { 
$first_vowel=TRUE;
$item_only_one=FALSE;
// if the last letter is next, probably only one consonant remain
$last_letter_next=FALSE;
$last_letter=FALSE;
$num_items=count($items[$bb]);
// only one item (vowel)
if ($num_items==1) {
$long_vowel2=TRUE;
if ($_info_long===FALSE) {
$result2_show.='<span class="phonetics_result_search_page_exp">'.$lang_pron_wowel1.'</span><br>';
$_info_long=TRUE;
}
// more items
} else {
$num_con=mb_strlen($items[$bb][$aa+1]);
//next cluster cant be vowel
// we are sure that the next item is only one letter
// consonant
if ($num_con==1) {
// we check if the letter after this single consonant is vowel
$vowel_after_consonant_found=FALSE;
foreach ($all_vowels as $ka1 => $va1) {
if ($items[$bb][$aa+2]==$va1)  {
$vowel_after_consonant_found=TRUE;
}
}
if ($vowel_after_consonant_found===TRUE) {
// only one consonant followed by vowel
$item_only_one=TRUE;	
}
// next item is cluster og double vowel (contains more than one letter)
} else {
// else we search if the two letters in item are not consonants
for ($i = 0; $i < 2; $i++) {
$maybe_consonant[1] = mb_substr($items[$bb][$aa+1],$i-1,1);
$maybe_consonant[2] = mb_substr($items[$bb][$aa+1],$i,1);
}	
}
if ($aa+1==$num_items)   {
// next letter or cluster is last
$last_letter_next=TRUE;
}
// this is last letter or cluster
if ($aa==$num_items)   {               
$last_letter=TRUE;
}
// the two next letters, we have to know if they are consonants and if not belong to special group
if ($item_only_one!==TRUE) {
// whether the consonant after first vowel belongs to p,t,k,s
$ahersla_1_consonants_found=FALSE;
foreach ($ahersla_1_consonants as $ka1 => $va1) {
if ($maybe_consonant[1]==$va1)  {
$ahersla_1_consonants_found=TRUE;
}
}
// whether the consonant after the second consonant belongs to v,j,r
$ahersla_2_consonants_found=FALSE;
foreach ($ahersla_2_consonants as $ka2 => $va2) {
if ($maybe_consonant[2]==$va2)  {
$ahersla_2_consonants_found=TRUE;
}	}
}
// we compare values
// if next letter is not last, we have to search in two possible consonants
// first we check whether both are consonant
// then whether they do no belong together to special group before that is vowel long as well
if ($last_letter!==TRUE) {
if ($last_letter_next!==TRUE) {
if ($item_only_one!==TRUE) {
if (($ahersla_1_consonants_found===TRUE) AND ($ahersla_2_consonants_found===TRUE)) {
$long_vowel2=TRUE;
if ($_info_long===FALSE) {
$result2_show.='<span class="phonetics_result_search_page_exp">'.$lang_pron_wowel2.'</span><br>';
 $_info_long=TRUE;
}
}
} else {
if (($items[$bb][$aa+1]=='g') AND ($items[$bb][$aa+2]=='i')) {
if ($_info_long===FALSE) {
$result2_show.='<span class="phonetics_result_search_page_exp">'.$lang_pron_wowel3.'</span><br>';
$_info_long=TRUE;
}
} else {
$long_vowel2=TRUE;	
if ($_info_long===FALSE) {
$result2_show.='<span class="phonetics_result_search_page_exp">'.$lang_pron_wowel4.'</span><br>';
$_info_long=TRUE;
}
}
}
} else {
// the next letter or cluster is last
// if single consonant last = long if cluster short
// it is either single consonant or cluster
if ($num_con==1) {
$long_vowel2=TRUE;	
if ($_info_long===FALSE) {
$result2_show.='<span class="phonetics_result_search_page_exp">'.$lang_pron_wowel5.'</span><br>';
$_info_long=TRUE;
}
}
}
} else {
$long_vowel2=TRUE;
if ($_info_long===FALSE) {
$result2_show.='<span class="phonetics_result_search_page_exp">'.$lang_pron_wowel6.'</span><br>';
$_info_long=TRUE;
}
}
}
}
// LONG VOWEL
// if more result than one
if ($num89>=1) {
$found=FALSE;	
if (($v==$row[1]) AND (($row[3]==2) OR ($row[3]==3) OR ($row[3]==4) OR ($row[3]==5) OR ($row[3]==6))) {
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
$result1_show.=$row[1].' - <span class="phonetics_result">['.$row[2].']</span>';
if ($row[8]=='vj') {
$result3_show.='<span class="phonetics_result_search_page_exp">'.$lang_pron_wowel7.'</span><br>';
} else if ($row[8]!='') {
$result3_show.='<span class="phonetics_result_search_page_exp">'.$row[8].'</span><br>';
}
// dialects, hardmaeli, raddadur framburdur
if (($row[7]=='hard') OR ($row[7]=='raddadur_f')) {
} else {
$found=FALSE;
// phonetics rules
// rule_g
if ($row[6]=='rule_g') {
$found=TRUE;
// find whether the vowel is framgomaelt or uppgomaelt
$framgomael_vowel=FALSE;
foreach ($fram_vowels as $k1 => $v1) {
if ($items[$bb][$aa+1]==$v1)  {
$framgomael_vowel=TRUE;
}
}
if ($framgomael_vowel===TRUE)  {
if (($row[9]=='ch') AND ($row[7]=='fram'))  {
if (($row[7]=='fram') AND ($ch_forbase!==TRUE)) {
$result_full.=$row[2]; $result_det_pron=$row[2];
$ch_base=$row[2]; $ch_forbase=TRUE;
} else if ($row[9]=='ch'){
$ch_choices[$ch]=$row[2]; $result_det_pron=$row[2];
$ch++;	
}
} else {
if ($row[7]=='fram') {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
}
// uppgomaelt
} else {
if (($row[9]=='ch') AND ($row[7]=='upp')) {
if (($row[7]=='upp') AND ($ch_forbase!==TRUE)) {
$result_full.=$row[2]; $result_det_pron=$row[2];
$ch_base=$row[2]; $ch_forbase=TRUE;
} else if ($row[9]=='ch') {
$ch_choices[$ch]=$row[2]; $result_det_pron=$row[2];
$ch++;	
}
} else {
if ($row[7]=='upp') {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
}
}
}
// end of rule_g
// rule_g2
// 1 g in word saga, appears after long vowel
// 2 g in word lágar, app. after á, o, ú before a, u or in back position
// 3 g in word hagi, always before i
// 4 g long in word hagi, and two ways of pronunciation
if ($row[6]=='rule_g2') {
$found=TRUE;
$num_array1=count($items[$bb]);    
$last_letter=FALSE;	
if ($aa==$num_array1)  {               
$last_letter=TRUE;
}
 if ($last_letter===TRUE) {
 if ($row[3]=='5') {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
 } else {
$f_brott_vowel=FALSE;
foreach ($f_brott_vowels as $k1 => $v1) {
if ($items[$bb][$aa-1]==$v1)  {
$f_brott_vowel=TRUE;
}
}
$g_after_vowel=FALSE;
foreach ($g_after_vowels as $k1 => $v2) {
if ($items[$bb][$aa+1]==$v2)  {
$g_after_vowel=TRUE;
}
// if it the last letter
$num_array=count($items);    
if ($aa==$num_array)  {               
$g_after_vowel=TRUE;
}
}


// if gi 
if ($items[$bb][$aa+1]=='i')  {
if ($row[7]=='4') {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
// if á,o,ú before g and a,u after, or last position
} else if (($f_brott_vowel===TRUE) AND ($g_after_vowel===TRUE))  {
if ($row[7]=='2') {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
// the rest , in word saga etc
} else {
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
}
}
// end of rule_g2
// rule_f
if ($row[6]=='rule_f') {
$found=TRUE;
$num_array1=count($items[$bb]);    
$last_letter=FALSE;	
if ($aa==$num_array1)  {               
$last_letter=TRUE;
}
// last cluster
if ($last_letter===TRUE) {
if ($row[3]=='5') {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
} else {
$brott_vowel=FALSE;
foreach ($f_brott_vowels as $k1 => $v2) {
if ($items[$bb][$aa-1]==$v2)  {
$brott_vowel=TRUE;
}
}
if ($brott_vowel===TRUE)  {

if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
$ch_base=$row[2];
} else if ($row[7]=='2') {
$result_full.=$row[2]; $result_det_pron=$row[2];
$ch_choices[$ch]=$row[2]; $result_det_pron=$row[2];
$ch++;	
}
} else {
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
}
}
if ($row[6]=='rule_zeta') {
$found=TRUE;
$num_array1=count($items[$bb]);
$num_ord=count($pieces);
$last_letter=FALSE;	
if ($aa==$num_array1)  {               
$last_letter=TRUE;
}
// last cluster
if ($last_letter===TRUE) {
if ($num_ord>1) {
// samsett ord
if ($num_ord==$bb) {
// last letter of samsett ord
if ($row[3]=='5') {
 $result_full.=$row[2]; $result_det_pron=$row[2];
}
} else {
// normal pronunciation
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
}	
}
} else {
// last letter of single word
if ($row[3]=='5') {
$result_full.=$row[2]; $result_det_pron=$row[2]; 
}
}
} else {
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
}
}
// end of rule_zeta
// 117 rule 1 normal
// 2 nn is pronounced dn after í, ú and double vowels
// 3 dn at the last position
if ($row[6]=='117') {
$found=TRUE;
// find whether the vowel belongs to nn_vowels
$nn_vowel_found=FALSE;
foreach ($nn_vowels as $k1 => $v2) {
if ($items[$bb][$aa-1]==$v2)  {
$nn_vowel_found=TRUE;
}
}
// if it the last letter
$num_array=count($items[$bb]);    
$last_letter=FALSE;
if ($aa==$num_array)  {               
$last_letter=TRUE;
}

if ($nn_vowel_found===TRUE)  {
if ($last_letter===TRUE) {
// last letter after nn_vowel
if ($row[7]=='3') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
} else {
// after nn_vowel, not the last letter
if ($row[7]=='2') {
$result_full.=$row[2]; $result_det_pron=$row[2];
$result2_show.='<span class="phonetics_result_search_page_exp">'.$lang_pron_wowel8.'</span><br>';
} 
}
} else {
if ($last_letter===TRUE) {
if ($row[7]=='4') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
} else {
//long pronounciation of nn
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
$result2_show.='<span class="phonetics_result_search_page_exp">'.$lang_pron_wowel9.'</span><br>';
} 
}
}
}
// end of rule_117
// NG_NK
// if vowel preceds ng or nk or nnk or nnl it changes
if ($row[6]=='vowel') {
	
$found=TRUE;
// vowel before ng etc.
if (($items[$bb][$aa+1]=='ng') OR ($items[$bb][$aa+1]=='nk') OR ($items[$bb][$aa+1]=='nnk') OR ($items[$bb][$aa+1]=='nnl') OR ($items[$bb][$aa+1]=='ngj') OR ($items[$bb][$aa+1]=='nkj') OR ($items[$bb][$aa+1]=='ngl') OR ($items[$bb][$aa+1]=='ngn') OR ($items[$bb][$aa+1]=='ngs') OR ($items[$bb][$aa+1]=='ngt') OR ($items[$bb][$aa+1]=='nkt') OR ($items[$bb][$aa+1]=='nks') OR ($items[$bb][$aa+1]=='nkts')) {
$found=TRUE;
$vowel_ng=FALSE;
foreach ($vowels_change_before_ng as $ka1 => $va1) {
if ($items[$bb][$aa]==$va1)  {
$vowel_ng=TRUE;
}
}
if ($vowel_ng===TRUE) {
if ($row[7]=='3') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
} else {
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 	
}

// vowel before gi and before gj in the middle of the word = segjum
} else if ((($items[$bb][$aa+1]=='g') AND ($items[$bb][$aa+2]=='i')) OR ($items[$bb][$aa+1]=='gj')) {
// o, a, u
if (($items[$bb][$aa]=='a') OR ($items[$bb][$aa]=='o') OR ($items[$bb][$aa]=='u')) {
if ($row[7]=='gi') {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
// i, y, e, ö, 
} else if ($row[3]=='3') {
$result_full.=$row[2]; $result_det_pron=$row[2];	 
}
} else {
if ($row[7]=='1') {
if ($long_vowel2===TRUE) {	
$result_full.=$row[2].'ː'; $result_det_pron=$row[2].'ː';
} else {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
}	
}
}
// end of NG_NK
// A - ok is normal pronunciation the other not normal or dialect
if ($row[6]=='A') {
$found=TRUE;
if ($row[7]=='ok') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
// D - ok is normal pronunciation the other is called bd framburdur
// 168 page
if ($row[6]=='D') {
$found=TRUE;
if ($row[7]=='ok') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
// end of D
// E - ok is normal pronunciation the other is pronounced differently
// in tokuord - 108 page
if ($row[6]=='E') {
$found=TRUE;
if ($row[7]=='ok') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
// end of E
// 130 - 1 ok 2 pronounced y, spyrja etc.
if ($row[6]=='130') {
$found=TRUE;
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
// end of E
// CH both choices are ok
// for example page 109 fld
if ($row[6]=='CH') {
$found=TRUE;
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
$ch_base=$row[2];
} else if ($row[6]=='CH'){
$ch_choices[$ch]=$row[2]; $result_det_pron=$row[2];
$ch++;	
}
}
// end of CH
// FT rule ft, 1 normal pronunciation
// 2 only in words aftur, aftan, eftir, toft, thofta
// for example page 109 fld
if ($row[6]=='FT') {
$found=TRUE;
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
// end of FT
// TS rule 1 normal pronunciation
// 2 samlogun, for example med greini, often used etc. 
// for example page 85 fld
if ($row[6]=='TS') {
$found=TRUE;
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
// end of FT
// KS rule 1 normal pronunciation
// 2 samlogun
// for example page 80 fld
if ($row[6]=='KS') {
$found=TRUE;
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
$result2_show.='<span class="phonetics_result_search_page_exp"><span class="phonetics_result">['.$row[2].']</span>'.$lang_pron_wowel10.'</span><br>';
} 
}
// end of ks
// LDS rule 1 normal pronunciation
// 2 often in samsett ord
// for example page 88
if ($row[6]=='LDS') {
$found=TRUE;
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
$result2_show.='<span class="phonetics_result_search_page_exp"><span class="phonetics_result">['.$row[2].']</span>'.$lang_pron_wowel11.'</span><br>';
} 
}
// end of LDS
// LKS rule 1 normal pronunciation
// 2 only in word folks
// 3 rarely
// for example page 90
if ($row[6]=='LKS') {
$found=TRUE;
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
// end of LKS
// LLS rule 1 normal pronunciation ls
// 2 in genitivive nouns and adjectives , t.d. falls
// for example page 121
if ($row[6]=='LLS') {
$found=TRUE;
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
// end of LLS
// LTS rule 1 normal pronunciation lds
// 2 only in most frequent words
// for example page 88
if ($row[6]=='LTS') {
$found=TRUE;
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
// end of LTS
// rule_m 1 normal pronunciation m
// 2 only in words, fram, um and en
// for example page 88
if ($row[6]=='rule_m') {
$found=TRUE;
if (($search_pattern=='fram') OR ($search_pattern=='um') OR ($search_pattern=='en')) {
if ($row[7]=='2') {
 $result_full.=$row[2]; $result_det_pron=$row[2];
} 	
} else {
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
}
// end of rule_m
// LGN rule 1 normal pronunciation
// 2 often, commen - preferable 
// for example page 88
if ($row[6]=='ch-n') {
$found=TRUE;
$num_array1=count($items[$bb]);    
$last_letter=FALSE;	
if ($aa==$num_array1)  {               
$last_letter=TRUE;
}
// last cluster
if ($last_letter===TRUE) {
// last position
if ($row[3]=='5') {
// first of last position = has to have 3 in options
if ($row[7]=='3') {	
$result_full.=$row[2]; $result_det_pron=$row[2];
$ch_base=$row[2];
} else {
$ch_choices[$ch]=$row[2]; $result_det_pron=$row[2];
$ch++;		
}
}
 // all except last position
} else if ($row[3]!='5'){
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
$ch_base=$row[2];
} else {
$ch_choices[$ch]=$row[2]; $result_det_pron=$row[2];
$ch++;	
}
} 
}
// end of LGN
// 1 normal pronunciation
// 2 ll tokuord
// 4 at the last position
if ($row[6]=='varianta_3_tokuord') {
$found=TRUE;
// if it the last letter
$num_array1=count($items[$bb]);    
$last_letter=FALSE;	
if ($aa==$num_array1)  {               
$last_letter=TRUE;
}
 if ($tokuord===TRUE) {
// diminitutive or tokuord
if ($row[7]=='2') {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
} else {
if ($last_letter===TRUE) {
// last letter 
if ($row[3]=='5') {
 $result_full.=$row[2]; $result_det_pron=$row[2];
} 
} else {
// middle
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
 }
 }
 }
 // end of LL
 // single l
 if ($row[6]=='oraddad_l') {
 $found=TRUE;
// if it the last letter
$num_array1=count($items[$bb]);    
$last_letter=FALSE;	
if ($aa==$num_array1)  {               
$last_letter=TRUE;
}
 if ($last_letter===TRUE) {
 // last letter 
 if ($row[7]=='2') {
 $result_full.=$row[2]; $result_det_pron=$row[2];
 } 
} else {
 // not the last letter
 if ($row[7]=='1') {
 $result_full.=$row[2]; $result_det_pron=$row[2];
} 
 }
 }

 
   // unvoiced ð
 if ($row[6]=='rule_unvoiced') {
 $found=TRUE;
// if it the last letter
$num_array1=count($items[$bb]);    
$last_letter=FALSE;	
if ($aa==$num_array1)  {               
$last_letter=TRUE;
}
 if ($last_letter===TRUE) {
 // last letter 
 if ($row[3]=='5') {
 $result_full.=$row[2]; $result_det_pron=$row[2];
 } 
} else {
 // not the last letter
 if ($row[3]=='4') {
 $result_full.=$row[2]; $result_det_pron=$row[2];
} 
 }
 }
 
  // r in back of the word
 if ($row[6]=='rule_r') {
 $found=TRUE;
// if it the last letter
$num_array1=count($items[$bb]);    
$last_letter=FALSE;	
if ($aa==$num_array1)  {               
$last_letter=TRUE;
}
 if ($last_letter===TRUE) {
 // last letter 
 if ($row[7]=='2') {
 $result_full.=$row[2]; $result_det_pron=$row[2];
 } 
} else {
 // not the last letter
 if ($row[7]=='1') {
 $result_full.=$row[2]; $result_det_pron=$row[2];
} 
 }
 }
 
 // LGD rule 1 normal pronunciation
// 2 l er gomlitad
// for example page 89
if ($row[6]=='LGD') {
$found=TRUE;
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
// end of LGD
// NKT 1 normal pronunciation 
// 2 usual in words punktur and sankti
// for example page 88
if ($row[6]=='NKT') {
$found=TRUE;
if (($search_pattern=='punktur') OR ($search_pattern=='sankti')) {
if ($row[7]=='2') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 	
} else {
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
 }
 // end of NKT
// RGN 1 normal pronunciation 
// 2 only in word morgunn and its form
// 3 also in word morgunn
 // see 98 page
if ($row[6]=='RGN') {
$found=TRUE;
// if it the last letter
$num_array1=count($items[$bb]);    
$last_letter=FALSE;	
if ($aa==$num_array1)  {               
$last_letter=TRUE;
}
 if ($last_letter===TRUE) {
if ($row[7]=='5') {
 $result_full.=$row[2]; $result_det_pron=$row[2];
} 
} else {
// if form of word morgunn,
if ($search_pattern=='morgunn') {
if ($row[7]=='2') {
 $result_full.=$row[2]; $result_det_pron=$row[2];
} 	
} else {
if ($row[7]=='1') {
 $result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
}
 }
// end of RGN
// 123 1 normal pronunciation 
// 2 rs is kept if long rr i stofni
// see 123 page
if ($row[6]=='123') {
$found=TRUE;
// if form of word morgunn,
if ($search_pattern=='----') {
if ($row[7]=='2') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 	
} else {
if ($row[7]=='1') {
 $result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
 }
// end of 123
/////////// r fellur brott á undan s
 // 124 1 r fellur brott
// 2 r is there
// see 124 page
 if ($row[6]=='124') {
$found=TRUE;
// if form of word morgunn,
if ($search_pattern=='--') {           
if ($row[7]=='2') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 	
} else {
if ($row[7]=='2') {
$result_full.=$row[2]; $result_det_pron=$row[2];
} 
}
 }
 // end of 124
 // RL 1 normal pronunciation 
// 2 in frequent words like varla, barn
// 3 called rn rl framburd - pronounced varla
// see 76 page
if ($row[6]=='RL') {
 $found=TRUE;
// if it the last letter
$num_array1=count($items[$bb]);    
$last_letter=FALSE;	
if ($aa==$num_array1)  {               
$last_letter=TRUE;
}
 if ($last_letter===TRUE) {
if ($row[3]=='5')  {
if ($row[7]=='4') {
$result_full.=$row[2]; $result_det_pron=$row[2];
$ch_base=$row[2];
} else {
$ch_choices[$ch]=$row[2]; $result_det_pron=$row[2];
$ch++;	
}
} 
}  else if ($row[3]!='5'){
// if form of word morgunn,
if ($search_pattern=='varla') {
} else {
if ($row[7]=='1') {
$result_full.=$row[2]; $result_det_pron=$row[2];
$ch_base=$row[2];
} else {
$ch_choices[$ch]=$row[2]; $result_det_pron=$row[2];
$ch++;	
}
}
}
}
// end of RL
// ? strange pronunciation, found it but not use it
if ($row[6]=='?') {
$found=TRUE; 
}
// the rest with no condition
if ($found!==TRUE) {
if ($long_vowel2===TRUE) {	
$result_full.=$row[2].'ː'; $result_det_pron=$row[2].'ː';
} else {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
}
}	
}
// if only one result we can directly add it
} else {
if ($long_vowel2===TRUE) {	
$result_full.=$row[2].'ː'; $result_det_pron=$row[2].'ː';
} else {
$result_full.=$row[2]; $result_det_pron=$row[2];
}
if ($row[3]==1) {
$position=$lang_phonetic7;
} else  if ($row[3]==3) {
$position=$lang_phonetic9;
} else if ($row[3]==2) {
$position=$lang_phonetic8;
} else if ($row[3]==4) {
$position=$lang_phonetic20;
} else if ($row[3]==5) {
$position=$lang_phonetic21;
} else if ($row[3]==6) {
$position=$lang_phonetic23;
}
$result1_show.=$row[1].' - <span class="phonetics_result">['.$result_det_pron.']</span>';
}
}
if ((($k==1) AND ($row[3]==2)) OR (($k>1) AND ($row[3]==1))) {
} else {
if ($row[1]==$last_lett) {
$add=' class="d1"';
} else {
$add='';
}
$last_lett=$row[1];
if ($result_det_pron!='') {
$result_exp.= '<tr class="d0">'; 
} else {
$result_exp.= '<tr>'; 	
}
$result_exp.='<td'.$add.'>';
$result_exp.= '<a href="./pron_gen.php?action=show_cluster&amp;cluster='.$row[1].'&amp;searched_word_cl='.$stem_for_pronunciation.'">'.$row[1].'</a>';	$row[1]='';
$result_exp.= '</td><td'.$add.'>';
if ($row[2]!='') {
$result_exp.= '<span class="phonetics_result">['.$row[2].']</span>';	$row[2]='';
}
$result_exp.= '</td><td'.$add.'>';
$result_exp.= $position;
$position='';
$result_exp.= '</td><td'.$add.'>';
$result_exp.= $result3_show;
$result3_show='';
$result_exp.= '</td><td'.$add.'>';
$result_exp.= $result2_show;
$result2_show='';
$result_exp.= '</td>';
$result_exp.= '<td'.$add.'>';
if ($result_det_pron!='') {
$result_exp.= '<span class="phonetics_result">['.$result_det_pron.']</span>'; 
$result_det_pron='';}
$result_exp.= '</td>';
$result_exp.='</tr>';
}
endwhile;
$oop->freeResult();
$number++;
}
}
}
$result_exp.='</table>';
$result_arr[$num_samsett_ord]=$result_exp;
$result_exp='';
//   SAMSETT ORD 
if ($num_samsett_ord>=2) {
$c=$num_samsett_ord;
$_h_result_full=$result_full;
for ($s = 1; $s < $num_samsett_ord; $s++) {
$_h_result_full = str_replace  ($samsett_ord2[$s], '',  $_h_result_full);
}
$samsett_ord2[$num_samsett_ord]=$_h_result_full;
} else {
$samsett_ord2[$num_samsett_ord]=$result_full;
}
}
// we go through all IPA words in samsett ord
foreach ($samsett_ord2 as $id => $value) {
// change of hé 
$result_first=mb_substr($value,0,1);
$result_sec=mb_substr($value,1,1);
$result_third=mb_substr($value,2,1);
if ($result_first.$result_sec.$result_third=='hjɛ') {
$value =str_replace_once ('hjɛ', 'çɛ' ,  $value);
$result_full =str_replace_once ($samsett_ord2[$id], $value ,  $result_full);
$samsett_ord2[$id]=$value;
}
$result_later.= '<br>';
$result_later.= 'Složené slovo ('.$id.') - '.$samsett_ord[$id].' <span class="phonetics_result">['.$value.']</span>';
if ($num_samsett_ord>1) {
$table_sound='ds_sound';
$sql4 = sprintf ('SELECT `sound` FROM `%s` WHERE `keyword` COLLATE `%s` = %s',
	$table_sound,
	$collation_1,
	quate_smart($samsett_ord[$id])); 
$oop4->Setnames();
$oop4->query($sql4);
$num4 = $oop->getNumRows();
if ($num4!=0) {
$sound = $oop4->fetchArray ();
clearstatcache();
$filename = $sound_uploadsDirectory.$sound[0];
$rr_count++;
$file = "./audio/uploaded_files/".$sound[0];
$final_file=$file;
$result_later.= '<br><span id="audioplayer_'.$rr_count.'"></span><script type="text/javascript">AudioPlayer.embed("audioplayer_'.$rr_count.'", {soundFile: "'.$final_file.'", titles:"'.$samsett_ord[$id].'"});</script> ';
}
$oop4->freeResult();}
$result_later.= $result_arr[$id];
// first word
if ($id==1) { 
$ff1=strpos($value, 'ː');
if ($ff1===false) {
} else {
$value_help =str_replace_once ('ː', '+' ,  $value);
// test if there  the latter is long
$ff2=strpos($value_help, 'ː');
if ($ff2===false) {
// only one long 
$value_help =str_replace_once ('+', 'ː' ,  $value_help);
$result_full =str_replace ($samsett_ord2[$id], $value_help ,  $result_full);
$samsett_ord2[$id]=$value_help;
} else {
// the consonants in the first word is long
$long_atkvaedi=TRUE;
$value_help =str_replace ('+', '' ,  $value_help);
$result_full =str_replace ($samsett_ord2[$id], $value_help ,  $result_full);
$samsett_ord2[$id]=$value_help;
}
}
} else if ($id>1) {
// test for long mark in samsett ord (not first one)
$ff=strpos($value, 'ː');
if ($ff===false) {
} else {
$value =str_replace ('ː', '' ,  $value);
$result_full =str_replace ($samsett_ord2[$id], $value ,  $result_full);
$samsett_ord2[$id]=$value;
}
}
}
echo '<br>';echo '<br>';
// the word is compound
if ($num_samsett_ord>=2) {
for ($i = 1; $i < $num_samsett_ord; $i++) {
$num=mb_strlen($samsett_ord[$i]);
$char_1_last = mb_substr($samsett_ord[$i],$num-1,1);
$char_1_last2 = mb_substr($samsett_ord[$i],$num-2,1);
$vowel_char_1_last_true=FALSE;	
foreach ($vowels as $k => $v) {
if ($char_1_last==$v) {
$vowel_char_1_last_true=TRUE;	
}
}
$num=mb_strlen($samsett_ord[$i+1]);
$char_2_first= mb_substr($samsett_ord[$i+1],0,1);
$char_2_second = mb_substr($samsett_ord[$i+1],1,1);
// BLS 141 41-42
/////////////// f /////////////////////////////
$IPAchar_2_first= mb_substr($samsett_ord2[$i+1],0,1);
$IPAchar_2_first2= mb_substr($samsett_ord2[$i+1],0,2);
$vowel_char_2_first_true=FALSE;	
foreach ($vowels as $k => $v) {
if ($char_2_first==$v) {
$vowel_char_2_first_true=TRUE;	
}
}
$vowel_char_2_second_true=FALSE;	
foreach ($vowels as $k => $v) {
if ($char_2_second==$v) {
$vowel_char_2_second_true=TRUE;	
}
}		
$result_comp.= $lang_pron_wowel12;
$result_comp.= '<br>';
///// SHORTEN THE FIRST LID I SAMSETTU ORDI
// dont shorten only if 1. sidari lidur hefst a serhljodi eda h+serhljodi
if (($vowel_char_2_first_true===TRUE) OR ( ($char_2_first=='h') AND ($vowel_char_2_second_true===TRUE) ) ) {
$result_comp.= $lang_pron_wowel13;
}
// dont shorten only if 2. fyrsti lidurinn endar a p, t,k s
else if (($char_1_last=='p') OR ($char_1_last=='t') OR ($char_1_last=='k') OR ($char_1_last=='s')) { 
$result_comp.= $lang_pron_wowel14;
} // dont shorten only if 3 fyrsti endar a serhljodi
else if ($vowel_char_1_last_true===TRUE) { 
$result_comp.= $lang_pron_wowel15;
} else if ($long_atkvaedi===TRUE) {
$result_comp.= $lang_pron_wowel16;
} else if ($samsett_ord2[$i]=='aːðal') {
} else if ($samsett_ord2[$i]=='anː') {
} else { // shorten all long 
$result_comp.= $lang_pron_wowel17;
$new_samsett_ord =str_replace  ('ː', '',  $samsett_ord2[$i]);
$result_full =str_replace  ($samsett_ord2[$i], $new_samsett_ord ,  $result_full);
$samsett_ord2[$i]=$new_samsett_ord;
}
$result_comp.='<br><br>';
$result_comp.='<br>';
$num_IPAchar1=mb_strlen($samsett_ord2[$i]);
$IPAchar_1_last= mb_substr($samsett_ord2[$i],$num_IPAchar1-2,2);
// BLS 139 11
/// D fellur brott a eftir d eda t
if (($IPAchar_1_last=='d̥') AND (($char_2_first=='d') OR ($char_2_first=='t') OR ($char_2_first=='s'))) {
$new_samsett_ord =str_replace_once ('d̥', '' ,  $samsett_ord2[$i]);
$result_full =str_replace  ($samsett_ord2[$i], $new_samsett_ord ,  $result_full);
$result_comp.='<span class="phonetics_result">'.$lang_pron_wowel19;	
}
// andheiti
if (($IPAchar_1_last=='d̥') AND ($IPAchar_2_first=='h')) {
$new_samsett_ord =str_replace  ('d̥', 'tʰ' ,  $samsett_ord2[$i]);
$new_samsett_ord2 =str_replace  ('h', '' ,  $samsett_ord2[$i+1]);
$result_full =str_replace  ($samsett_ord2[$i], $new_samsett_ord ,  $result_full);
$result_full =str_replace  ($samsett_ord2[$i+1], $new_samsett_ord2 ,  $result_full);
$result_comp.='<span class="phonetics_result">'.$lang_pron_wowel20;
}
if (($IPAchar_1_last=='b̥') AND ($char_2_first=='h')) {
$new_samsett_ord =str_replace  ('b̥', 'pʰ' ,  $samsett_ord2[$i]);
$new_samsett_ord2 =str_replace  ('h', '' ,  $samsett_ord2[$i+1]);
$result_full =str_replace  ($samsett_ord2[$i], $new_samsett_ord ,  $result_full);
$result_full =str_replace  ($samsett_ord2[$i+1], $new_samsett_ord2 ,  $result_full);
$result_comp.='<span class="phonetics_result">'.$lang_pron_wowel21;
}
if (($IPAchar_1_last=='ɡ̊') AND ($char_2_first=='h')) {
$new_samsett_ord =str_replace  ('ɡ̊', 'kʰ' ,  $samsett_ord2[$i]);
$new_samsett_ord2 =str_replace  ('h', '' ,  $samsett_ord2[$i+1]);
$result_full =str_replace  ($samsett_ord2[$i], $new_samsett_ord ,  $result_full);
$result_full =str_replace  ($samsett_ord2[$i+1], $new_samsett_ord2 ,  $result_full);
$result_comp.='<span class="phonetics_result">'.$lang_pron_wowel22;
}
// aðhyllast
if (($char_1_last=='ð') AND ($char_2_first.$char_2_second=='hl')) {
} else
// aðhyllast
if (($char_1_last=='ð') AND ($char_2_first=='h')) {
$new_samsett_ord =str_replace  ('ð', 'θ' ,  $samsett_ord2[$i]);
$new_samsett_ord2 =str_replace  ('h', '' ,  $samsett_ord2[$i+1]);
$result_full =str_replace  ($samsett_ord2[$i], $new_samsett_ord ,  $result_full);
$result_full =str_replace  ($samsett_ord2[$i+1], $new_samsett_ord2 ,  $result_full);
$result_comp.='<span class="phonetics_result">'.$lang_pron_wowel23;
}
// afhenda
if (($char_1_last=='f') AND ($IPAchar_2_first=='h')) {
$new_samsett_ord =str_replace  ('v', 'f' ,  $samsett_ord2[$i]);
$result_full =str_replace  ($samsett_ord2[$i], $new_samsett_ord ,  $result_full);
$new_samsett_ord =str_replace  ('h', '' ,  $samsett_ord2[$i+1]);
$result_full =str_replace  ($samsett_ord2[$i+1], $new_samsett_ord ,  $result_full);
$result_comp.='<span class="phonetics_result">'.$lang_pron_wowel24;
}
// aðalhlutverk
if (($IPAchar_1_last=='l̥') AND ($char_2_first.$char_2_second=='hl')) {
$new_samsett_ord =str_replace_once ('l̥', '' ,  $samsett_ord2[$i]);
$result_full =str_replace  ($samsett_ord2[$i], $new_samsett_ord ,  $result_full);
$result_comp.='<span class="phonetics_result">'.$lang_pron_wowel25;
// alhaefa
} else if (($IPAchar_1_last=='l̥')  AND ($char_2_first=='h')) {
$new_samsett_ord =str_replace  ('l', 'l̥' ,  $samsett_ord2[$i]);
$result_full =str_replace  ($samsett_ord2[$i], $new_samsett_ord ,  $result_full);
$result_comp.='<span class="phonetics_result">'.$lang_pron_wowel26;
$result_comp.='';
}
//l a undan l samlogun
if (($IPAchar_1_last=='l̥') AND ($char_2_first=='l')) {
$new_samsett_ord1 =str_replace_once ('l̥', '' ,  $samsett_ord2[$i]);
$result_full =str_replace ($samsett_ord2[$i], $new_samsett_ord1, $result_full);	
$result_comp.=$lang_pron_wowel27;
}
// árfarvegur
if (($char_1_last=='r') AND ($char_2_first=='f')) {
$new_samsett_ord =str_replace  ('r', 'r̥' ,  $samsett_ord2[$i]);
$result_full =str_replace  ($samsett_ord2[$i], $new_samsett_ord ,  $result_full);
$result_comp.='<span class="phonetics_result">'.$lang_pron_wowel28;
}
$raddad=FALSE;	
foreach ($raddad_consonants_b_d_g_h as $k => $v) {
if ($IPAchar_2_first==$v) {
$raddad=TRUE;	
}
if ($IPAchar_2_first2==$v) {
$raddad=TRUE;	
}
}
if (($char_1_last=='f') AND ($raddad===TRUE)) {
$new_samsett_ord =str_replace  ('v', 'f' ,  $samsett_ord2[$i]);
$result_full =str_replace  ($samsett_ord2[$i], $new_samsett_ord ,  $result_full);
$result_comp.=$lang_pron_wowel29;
}
// BLS 142 (46)
////////////// f og sidari lidur hefjist a f eda v /// samlogun
if (($char_1_last=='f') AND (($char_2_first=='f') OR ($char_2_first=='v'))) {
$new_samsett_ord1 =str_replace_once ('v', '' ,  $samsett_ord2[$i]);
if ($char_2_first=='f') {
$new_samsett_ord2 = str_replace_once ('f', 'f' ,  $samsett_ord2[$i+1]);
} else {
$new_samsett_ord2 =str_replace_once ('v', 'vː' ,  $samsett_ord2[$i+1]);	
}
$result_full =str_replace_once ($samsett_ord2[$i], $new_samsett_ord1 ,  $result_full);
$result_full =str_replace_once ($samsett_ord2[$i+1], $new_samsett_ord2 ,  $result_full);
$result_full =str_replace_once ($samsett_ord2[$i+1], $new_samsett_ord2 ,  $result_full);
$result_comp.=$lang_pron_wowel30;
}
// BLS 144 (53)
// g missir roddun a undan p,t,k,s t.d. dagkaup
$num=mb_strlen($samsett_ord2[1]);
$IPAchar_1_last= mb_substr($samsett_ord2[$i],$num-1,1);
$IPAchar_1_last2= mb_substr($samsett_ord2[$i],$num-2,2);
if (($IPAchar_1_last=='ɣ') AND (($char_2_first=='p') OR ($char_2_first=='t') OR ($char_2_first=='k') OR ($char_2_first=='s'))) {
$new_samsett_ord1 =str_replace_once ('ɣ', 'x' ,  $samsett_ord2[$i]);
$result_full =str_replace ($samsett_ord2[$i], $new_samsett_ord1, $result_full);
$result_comp.=$lang_pron_wowel31;
}
// BLS 144 56
// g brottfalla a eftir a,o,u
// but because in that case the last sound of first word is vowel = we have to add long mark again
if (($IPAchar_1_last=='ɣ') AND (($char_1_last2=='á') OR ($char_1_last2=='ó') OR ($char_1_last2=='ú'))) {
$new_samsett_ord1 =str_replace_once ('ɣ', 'ː' ,  $samsett_ord2[$i]);
$result_full =str_replace ($samsett_ord2[$i], $new_samsett_ord1, $result_full);	
$result_comp.=$lang_pron_wowel32;
}	
// BLS 144 61
// K adbladid a undan l t.d. liklegur
if (($char_1_last=='k') AND ($char_2_first=='l')) {
$new_samsett_ord1 =str_replace_once ('g', 'hg' ,  $samsett_ord2[$i]);
$result_full =str_replace ($samsett_ord2[$i], $new_samsett_ord1, $result_full);	
$result_comp.=$lang_pron_wowel33;
}
// BLS 145 63
// k hverfur a undan g o k
// bakgrunnur
if (($char_1_last=='k') AND (($IPAchar_2_first2=='ɡ̊') OR ($IPAchar_2_first.$IPAchar_2_first2=='kʰ'))) {
$new_samsett_ord1 =str_replace_once ('ɡ̊', '' ,  $samsett_ord2[$i+1]);
$result_full =str_replace ($samsett_ord2[$i+1], $new_samsett_ord1, $result_full);	
$result_comp.=$lang_pron_wowel34;
}
if (($char_1_last=='b') AND ($IPAchar_2_first2=='b̥')) {
$new_samsett_ord1 =str_replace_once ('b̥', '' ,  $samsett_ord2[$i+1]);
$result_full =str_replace ($samsett_ord2[$i+1], $new_samsett_ord1, $result_full);	
$result_comp.=$lang_pron_wowel35;
}
// BLS 145 71
// m,n
if ((($char_1_last=='m') OR ($char_1_last=='n')) AND (($char_2_first=='f') OR ($char_2_first=='v'))) {
$new_samsett_ord1 =$samsett_ord2[$i].'<sup>v</sup>';
$result_full =str_replace ($samsett_ord2[$i], $new_samsett_ord1, $result_full);	
$result_comp.=$lang_pron_wowel36;
}

//BLS 147 81
//p
if (($IPAchar_1_last2=='b̥') AND ($IPAchar_2_first2=='b̥')) {
$new_samsett_ord1 =str_replace_once ('b̥', '' ,  $samsett_ord2[$i]);
$result_full =str_replace ($samsett_ord2[$i], $new_samsett_ord1, $result_full);	
$result_comp.='p';
}
//BLS 147 91
//r a undan p,t,k,s
if (($char_1_last=='r') AND (($char_2_first=='p') OR ($char_2_first=='t') OR ($char_2_first=='k') OR ($char_2_first=='s'))) {
$new_samsett_ord1 =str_replace_once ('r', 'r̥' ,  $samsett_ord2[$i]);
$result_full =str_replace ($samsett_ord2[$i], $new_samsett_ord1, $result_full);	
$result_comp.=$lang_pron_wowel38;
}
//BLS 148 92
//r a undan þ, hj, hl, hn
if (($char_1_last=='r') AND (($char_2_first=='þ') OR ($char_2_first.$char_2_second=='hj') OR ($char_2_first.$char_2_second=='hl') OR ($char_2_first.$char_2_second=='hn'))) {
$new_samsett_ord1 =str_replace_once ('r', 'r̥' ,  $samsett_ord2[$i]);
$result_full =str_replace ($samsett_ord2[$i], $new_samsett_ord1, $result_full);	
$result_comp.=$lang_pron_wowel39;
}
//BLS 148 91
//r a undan hr samlogun
if (($char_1_last=='r') AND ($char_2_first.$char_2_second=='hr')) {
$new_samsett_ord1 =str_replace_once ('r', '' ,  $samsett_ord2[$i]);
$result_full =str_replace ($samsett_ord2[$i], $new_samsett_ord1, $result_full);	
$result_comp.=$lang_pron_wowel40;
}
//r a undan r samlogun
if (($char_1_last=='r') AND ($char_2_first=='r')) {
$new_samsett_ord1 =str_replace_once ('r', '' ,  $samsett_ord2[$i]);
$result_full =str_replace ($samsett_ord2[$i], $new_samsett_ord1, $result_full);	
$result_comp.=$lang_pron_wowel41;
}
//BLS 148 101
//s a undan s 
if (($char_1_last=='s') AND ($char_2_first=='s')) {
$new_samsett_ord1 =str_replace_once ('s', '' ,  $samsett_ord2[$i+1]);
$result_full =str_replace ($samsett_ord2[$i+1], $new_samsett_ord1, $result_full);	
$result_comp.=$lang_pron_wowel42;
}
//innskot hljod sn
if (($char_1_last=='s') AND ($char_2_first=='n')) {
$new_samsett_ord1 =str_replace_once ('n', 'd̥n' ,  $samsett_ord2[$i+1]);
$result_full =str_replace ($samsett_ord2[$i+1], $new_samsett_ord1, $result_full);	
$result_comp.=$lang_pron_wowel42;
}

//BLS 149 111
//bara stundum vitleysa 
if (($char_1_last=='t') AND (($char_2_first=='l') OR ($char_2_first=='t'))) {
$new_samsett_ord1 =str_replace_once ('d̥', 'hd̥' ,  $samsett_ord2[$i]);
}
}
}
$pos=strpos($result_full, 'iːj');
// if [iːj] so we change it to [ijː]
if ($pos!==FALSE) {
$result_full =str_replace ('iːj', 'ijː', $result_full);	
$result_comp.=$lang_pron_wowel46;	
}

if (($_POST["submit_pron"]) OR ($_GET["action"]=='search')) {
echo '<h3>'.$lang_pron_wowel44.'</h3>';
echo $headword_for_sound.' - <span class="phonetics_result_search_page">['.$result_full.']</span> ';
if ($ch>0) {
for ($ii = 0; $ii < $ch; $ii++) {
$result_full1 =str_replace_once ($ch_base, $ch_choices[$ii] ,  $result_full);
echo '<span class="phonetics_result_search_page">['.$result_full1.']</span> ';
}
}
echo '<br>';
$table_sound='ds_sound';
$sql4 = sprintf ('SELECT `sound` FROM `%s` WHERE `keyword` COLLATE `%s` = %s',
	$table_sound,
	$collation_1,
	quate_smart($headword_for_sound)); 
$oop4->Setnames();
$oop4->query($sql4);
$num4 = $oop->getNumRows();
if ($num4!=0) {
$sound = $oop4->fetchArray ();
$oop4->freeResult();
$oop4->_mySQL;
clearstatcache();
$filename = $sound_uploadsDirectory.$sound[0];
$rr_count++;
$file = $IMAGE_URL."/audio/uploaded_files/".$sound[0];
$final_file=$file;
?>
<span id="audioplayer_<?=$rr_count?>"></span>  
<script type="text/javascript">  
AudioPlayer.embed("audioplayer_<?=$rr_count?>", {soundFile: "<?=$final_file;?>", titles:"<?=$headword_for_sound?>"});  
</script> 
<?php
}
echo $result_later;
} else {
}
?>
