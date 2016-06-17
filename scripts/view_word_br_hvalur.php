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

$dict = 'ds_2_senses';
$dict_keyword = 'ds_1_headword';
$table_sound = 'ds_sound';
$table = 'ds_1_headword';
$phrase_list_array[0]='';
$_from_another_keyword=false;
//buffer to display the headword
$BUFFER_VIEW_KEYWORD='';
// dont show in history
if ($history!==TRUE) {
if (($editpage===TRUE)) {
} else {
$BUFFER_VIEW_KEYWORD .= '<div class="main_search_page3">';	
}
}
$qq1=0;$qq5=0;$p=0;$p4=0;$synonym_direct[1]='';
$antonym_direct[1]='';
$synonym_2_direct[1]='';
$oop11 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop22_spec = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop22 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
// phrase list that appears with the large headwords like fara, setja etc.
$empty='';
$sql5 = sprintf ('SELECT `phrase` FROM `%s` WHERE `keyword` COLLATE `%s` = %s  AND `num_keyword`=%s AND `phrase` != %s ORDER BY `order` ASC' ,
	$dict,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword),
	quate_smart($empty));
// only first time
if ($qq5==0) {
//phrase list
$qq5++;
$oop22->Setnames();
$oop22->query($sql5);
$num5 = $oop22->getNumrows(); 
if ($num5!=0) {
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .= '<div class="search_0column">';
$BUFFER_VIEW_KEYWORD .= '<div id="phraselist">';
$dd=0;$pp=1;
while ($row5 = $oop22->FetchRow()) :
if ($row5[0]!='') {
$_found=FALSE;
foreach ($phrase_list_array as $key1 => $value) {
if ($row5[0]==$value) {
$_found=TRUE;
}
}
if ($_found===FALSE) {
$pp++;	
$phrase_list_array[$pp]=$row5[0];
if ($row5[0]=='fr') {
$show_phrase=$lang_viewword1;	
} else {
$show_phrase=$phrase_list_array[$pp];
}
if ($history!==TRUE) {

$BUFFER_VIEW_KEYWORD .= '<a href="#'.$pp.'">'.$show_phrase.'</a><br>';

}
}
}
endwhile;

$BUFFER_VIEW_KEYWORD .= '</div>';
$BUFFER_VIEW_KEYWORD .= '</div>';

}
}
$oop22->FreeResult();
}
// dont show in history
if ($history!==TRUE) {

$BUFFER_VIEW_KEYWORD .= '<div class="search_1column">';

}
//// get the headword to display
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s  AND `num_keyword`=%s ORDER BY `order` ASC' ,
	$dict,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$sql2 = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`=%s ',
	$dict_keyword,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop11->Setnames();
$oop11->query($sql);
$num2 = $oop11->getNumrows(); 
$oop22_spec->Setnames();
$oop22_spec->query($sql2);
$cc=0;
$returned2 = $oop22_spec->FetchArray();
$oop22_spec->FreeResult();
$oop22_spec->_mySQL;
$pocet=1;	
while ($row3 = $oop11->FetchRow()) :
$cc++;
// first time it will create an article and a headword
if ($pocet == 1 ) { //5
if (($editpage===TRUE)) {
// edit page
} else {
if ($history!==TRUE) {
// search page
$BUFFER_VIEW_KEYWORD .= '<div class="viewentry">';	
} else {
// history page
$BUFFER_VIEW_KEYWORD .= '<div class="viewentry">';
}
}
if (($num2==1) AND ($editpage===TRUE)){
if ($history!==TRUE) {
if ($_SESSION["rights"]!=3) {
$BUFFER_VIEW_KEYWORD .="<a href=\"./edit.php?action=delete&amp;del=complete&amp;d_h=".$returned2[1]."&amp;d_h_n=".$returned2[2]."&amp;id=".$row3[0]."\"><img src=\"".$IMAGE_URL."images/delete.png\" border=\"0\" alt=\"Delete word (caution !! - you cannot take the change back!!)\"></a>";
}
}
}
if ($_SESSION["rights"]!=3) {
if ($history!==TRUE) {
$search_menu = "<a href=\"./edit.php?d_h=".$returned2[1]."&amp;d_h_n=".$returned2[2]."&amp;es=true\">";
}
$BUFFER_VIEW_KEYWORD .=$search_menu;
}
$BUFFER_VIEW_KEYWORD .= "<span class=\"e1\"> ";
if ($returned2[2]!=0) { $BUFFER_VIEW_KEYWORD .= '<sup>'.$returned2[2].'</sup>';}
$stem_for_pronunciation=$returned2[3];
// stem
if ($returned2[3]=='') {
$BUFFER_VIEW_KEYWORD .= $returned2[1];
} else {
$BUFFER_VIEW_KEYWORD .= $returned2[3];	 
}
$BUFFER_VIEW_KEYWORD .= " </span>"; 
if ($_SESSION["rights"]!=3) {
$BUFFER_VIEW_KEYWORD .= "</a>";
}
// in this script we enlarge the visit counter by one and display it
// visit counter is to show information how often the lexicographers visited the keyword
if (($editpage!==TRUE) AND ($printer!==TRUE)) {
if ($_SESSION["rights"]!=3) {
$sql111 = sprintf ('SELECT `num_visits_private` FROM `%s`WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s ',
	$dict_keyword,
	$collation_1,
	quate_smart($returned2[1]),
	quate_smart($returned2[2])); 
$oop22->Setnames();
$oop22->query($sql111);
$returned111 = $oop22->fetchRow ();
if ($returned111[0]=='') {
$returned111[0]=0;
}
$n111=$returned111[0]+1;
$oop22->FreeResult();
$sql111 = sprintf ('UPDATE `%s` SET `num_visits_private` = %s WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$dict_keyword,
	quate_smart($n111),
	$collation_1,	
	quate_smart($returned2[1]),
	quate_smart($returned2[2])); 
$oop22->Setnames();
$oop22->query($sql111);
$oop22->FreeResult();

} else {
$n112=1;
// we count the visits of unregistered users
$sql111 = sprintf ('UPDATE `%s` SET `num_visits_public` = `num_visits_public` + %s WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$dict_keyword,
	quate_smart($n112),
	$collation_1,	
	quate_smart($returned2[1]),
	quate_smart($returned2[2])); 
$oop22->Setnames();
$oop22->query($sql111);
$oop22->FreeResult();

}
}

// keyword variant
if ($returned2[4]!='') {
$array2= explode (',', $returned2[4]);
$count1= count ($array2);
foreach ($array2 as $value) {
if ($value!="") {
// check if num keyword is zero or more
if (strpos(trim($value), '(')!=0) {
$new_value= explode ('(',trim($value));
$variant_keyword=trim($new_value[0]);
$variant_num_keyword = str_replace("(","",$new_value[1]);
$variant_num_keyword = str_replace(",","",$variant_num_keyword);
$variant_num_keyword = str_replace(")","",$variant_num_keyword);
$variant_num_keyword=trim($variant_num_keyword);
$BUFFER_VIEW_KEYWORD .= "<span class=\"stem\">";
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .= "<a href=\"./search.php?list_kind=alpha&amp;d_h=".$variant_keyword."&amp;d_h_n=".$variant_num_keyword."\">";
}
$BUFFER_VIEW_KEYWORD .= "<sup>".$variant_num_keyword."</sup> ".$variant_keyword." ";
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .= "</a>";
}
$BUFFER_VIEW_KEYWORD .= "</span>";
} else {
$variant_keyword = str_replace(",","",$value);
$variant_keyword=trim($value);	 
$variant_num_keyword=0;
$BUFFER_VIEW_KEYWORD .= "<span class=\"stem\">";
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .= "<a href=\"./search.php?list_kind=alpha&amp;d_h=".$variant_keyword."&amp;d_h_n=".$variant_num_keyword."\">";
}
$BUFFER_VIEW_KEYWORD .= " ".$variant_keyword." ";
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .= "</a>";
}
$BUFFER_VIEW_KEYWORD .= "</span>";
}
}
}
}
// pronunciation 
if ($returned2[6]!='') { 
// only show in history, otherwise display pronunciation with sound
if ($history===TRUE) {
$BUFFER_VIEW_KEYWORD .= "<span class=\"pronunciation_history\"> [".$returned2[6]."] </span>";
}
}
//etymology
if ($returned2[16]!='') { 
$BUFFER_VIEW_KEYWORD .= "<span class=\"pronunciation_history\"> ".$returned2[16]." </span>";
}
$BUFFER_VIEW_KEYWORD .= '<span class="pos">';
$BUFFER_VIEW_KEYWORD .= $returned2[7];  
$fr_gr=$returned2[7]; 
if ($returned2[8]!='') { 
$BUFFER_VIEW_KEYWORD .= ' '.$returned2[8];   } 
if ($returned2[9]!='') {  $BUFFER_VIEW_KEYWORD .= ' '.$returned2[9];   }
$BUFFER_VIEW_KEYWORD .= '</span>';
// dont show in history
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .= '<br>';
}
if ($history!==TRUE) {
if ($editpage===TRUE) {
$BUFFER_VIEW_KEYWORD .= '<div class="main_entry_edit">';	
} else {
$BUFFER_VIEW_KEYWORD .= '<div class="main_entry">';	
}
}
}//5
// phrase list on right side
$only_once=TRUE;
foreach ($phrase_list_array as $key1 => $value) {
if ($key1!=0) {
if (($row3[24]==$value) AND ($only_once===TRUE)) {
if ($value=='fr') {
$value=$lang_viewword1;
}
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .= '<div class="phrase_show">';
$BUFFER_VIEW_KEYWORD .= '<span class="pos">';
$BUFFER_VIEW_KEYWORD .= '<a name="'.$key1.'"></a><a href="#UP">'.$value.'</a>';
$key_to_remove=$key1;
$BUFFER_VIEW_KEYWORD .= '</span></div>';	 
$only_once=FALSE;
}
}	
}
}
unset($phrase_list_array[$key_to_remove]);
// show 
if (($_SESSION["word_order_show"]==1) AND ($num2!=1) AND ($editpage!==TRUE) AND ($_SESSION["rights"]!=3)) { 
if ($history!==TRUE) {
if ($cc!=1) {
$BUFFER_VIEW_KEYWORD .= "<a href=\"./search.php?action=change_order&amp;reorder=FALSE&amp;direction=up&amp;d_h=".$returned2[1]."&amp;d_h_n=".$returned2[2]."&amp;num_order=".$row3[8]."\"><img src=\"".$IMAGE_URL."images/up.png\" border=\"0\" alt=\"\"></a>";
}
if ($cc!=$num2) {
$BUFFER_VIEW_KEYWORD .= "<a href=\"./search.php?action=change_order&amp;reorder=FALSE&amp;direction=down&amp;d_h=".$returned2[1]."&amp;d_h_n=".$returned2[2]."&amp;num_order=".$row3[8]."\"><img src=\"".$IMAGE_URL."images/down.png\" border=\"0\" alt=\"\"></a>";
}
}
}
// the rest will make while loop, it fills the definition tags
if ((($editpage===TRUE) AND ($num2!=1) AND ($_SESSION["rights"]!=3))) { 
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .= "<a href=\"./edit.php?action=delete&amp;d_h=".$returned2[1]."&amp;d_h_n=".$returned2[2]."&amp;id=".$row3[0]."\"><img src=\"".$IMAGE_URL."images/b_drop.png\" border=\"0\" alt=\"\"></a>";
}
}
if ($printer!==TRUE){
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .= '<span class="num">';
if ($_SESSION["rights"]!=3) {
$BUFFER_VIEW_KEYWORD .= $cc.')'; 
}
$BUFFER_VIEW_KEYWORD .= '</span>'; 
}
} 
if ($_SESSION["rights"]!=3) {
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .= "<a href=\"./edit.php?id=".$row3[0]."&amp;d_h=".$returned2[1]."&amp;d_h_n=".$returned2[2]."&amp;es=true\">";
}
} 
// markers
if ($row3[19]!='') {
$BUFFER_VIEW_KEYWORD .= '<span class="markers"> '.$row3[19].' </span>';
} 
// word
if ($row3[4]!='') {
$BUFFER_VIEW_KEYWORD .= '<span class="word"> '.$row3[4].' </span>';
// if the word is linked to another keyword (for example koma í klípu
// we fill the word with all information and leave the linked
if ($row3[18]!='') {
$qq_anchor[$qq1]=$row3[18];
$qq_word[$qq1]=$row3[4];
if (strpos(trim($row3[18]), '(')!=0) {
$new_value= explode ('(',trim($row3[18]));
$new_keyword=trim($new_value[0]);
$new_num_keyword = str_replace("(","",$new_value[1]);
$new_num_keyword = str_replace(")","",$new_num_keyword);
$new_num_keyword=trim($new_num_keyword);
} else {
$new_keyword=trim($row3[18]);	 
$new_num_keyword=0;
$qq_anchor1[$qq1]=$new_keyword;
$qq_anchor2[$qq1]=$new_num_keyword;
}
$qq1++;
// we find the first word in the keyword so that we can redirect to other keyword
$sql= sprintf ('SELECT `synonym`, `synonym_link`, `gram_2`, `translation`, `translation_detail`, `example`, `example_translation`, `specification`, `usage_specification` FROM `%s` WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s AND `word` = %s',
	$dict,
	$collation_1,
	quate_smart($new_keyword),
	quate_smart($new_num_keyword),
	quate_smart($row3[4]));				
$oop22->Setnames();
$oop22->query($sql);
$num3 = $oop22->getNumrows();
if ($num3!=0) {
$returned_link = $oop22->fetchRow ();
$oop22->FreeResult();
// synonym
$BUFFER_VIEW_KEYWORD .= ' ';
if ($returned_link[0]!='') {
// synonym link if synonym is composed from more than one word
$BUFFER_VIEW_KEYWORD .= '<span class="syn">';
if (strpos(trim($returned_link[0]), '(')!=0) {
$new_value= explode ('(',trim($returned_link[0]));	
$new_num_keyword = str_replace("(","",$new_value[1]);
$new_num_keyword = str_replace(")","",$new_num_keyword);
// we find the first word in the keyword so that we can redirect to other keyword
$sql= sprintf ('SELECT `id`, `keyword`, `num_keyword` FROM `%s` WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$dict,
	$collation_1,
	quate_smart($new_value[0]),
	quate_smart($new_num_keyword));				
$oop22->Setnames();
$oop22->query($sql);
$num3 = $oop22->getNumrows();
$returned = $oop22->fetchRow ();
} else {
// we make link to synonym keyword
// we find the first word in the keyword so that we can redirect to other keyword
$sql= sprintf ('SELECT `id`, `keyword`, `num_keyword` FROM `%s` WHERE `keyword` COLLATE `%s`=%s',
	$dict,
	$collation_1,
	quate_smart($returned_link[0]));				
$oop22->Setnames();
$oop22->query($sql);
$num3 = $oop22->getNumrows();
$returned7 = $oop22->fetchRow ();
}
$oop22->FreeResult();
if ($num3>=1) {
// if this is the edit mode, we go to edit page
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .=	"<a href =\"./search.php?list_kind=alpha&amp;d_h=".$returned7[1]."&amp;d_h_n=".$returned7[2]."\">"; 
}
$BUFFER_VIEW_KEYWORD .= "(";
if (strpos(trim($returned_link[0]), '(')!=0) 
{ 
$BUFFER_VIEW_KEYWORD .= '<sup>'.$new_num_keyword.'</sup>';
$BUFFER_VIEW_KEYWORD .= $new_value[0];
} else { 
$BUFFER_VIEW_KEYWORD .= $returned_link[0];
}
$BUFFER_VIEW_KEYWORD .= ")";
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .= "</a>"; 
}
} else {
// no link to synonym was found
// we try to make hyperlink from synonym link
if ($returned_link[1]!='') {
// synonym link if synonym is composed from more than one word
if (strpos(trim($returned_link[1]), '(')!=0) {
$new_value= explode ('(',trim($returned_link[1]));	
$new_num_keyword = str_replace("(","",$new_value[1]);
$new_num_keyword = str_replace(")","",$new_num_keyword);
// we find the first word in the keyword so that we can redirect to other keyword
$sql= sprintf ('SELECT `id`, `keyword`, `num_keyword` FROM `%s` WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$dict,
	$collation_1,
	quate_smart($new_value[0]),
	quate_smart($new_num_keyword));				
$oop22->Setnames();
$oop22->query($sql);
$num3 = $oop22->getNumrows();
$returned = $oop22->fetchRow ();
} else {
// we make link to synonym keyword
// we find the first word in the keyword so that we can redirect to other keyword
$sql= sprintf ('SELECT `id`, `keyword`, `num_keyword` FROM `%s` WHERE `keyword` COLLATE `%s`=%s',
	$dict,
	$collation_1,
	quate_smart($returned_link[1]));				
$oop22->Setnames();
$oop22->query($sql);
$num3 = $oop22->getNumrows();
$returned7 = $oop22->fetchRow ();
}
$oop22->FreeResult();
if ($num3>=1) {
// if this is the edit mode, we go to edit page
if ($history!==TRUE) {	
$BUFFER_VIEW_KEYWORD .=	"<a href =\"./search.php?list_kind=alpha&amp;d_h=".$returned7[1]."&amp;d_h_n=".$returned7[2]."\">";
}
$BUFFER_VIEW_KEYWORD .= "(";
if (strpos(trim($returned_link[1]), '(')!=0) {
 $BUFFER_VIEW_KEYWORD .= '<sup>'.$new_num_keyword.'</sup>' ;
$BUFFER_VIEW_KEYWORD .= $new_value[0];
} else { 
$BUFFER_VIEW_KEYWORD .= $returned_link[0];} 
$BUFFER_VIEW_KEYWORD .= ")";
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .= "</a>";
}
} else {
// no link to synonym was found
$BUFFER_VIEW_KEYWORD .= "(".$returned_link[0].")"; 
}
} else {
$BUFFER_VIEW_KEYWORD .= "(".$returned_link[0].")"; 
}
}
$BUFFER_VIEW_KEYWORD .= '</span> ';
}
$_from_another_keyword=TRUE;
// specification
if (trim($returned_link[7])!='') {
$BUFFER_VIEW_KEYWORD .= '<span class="specification"> '.$returned_link[7].' </span>';
}
// usage specification
if ($returned_link[8]!='') {
$BUFFER_VIEW_KEYWORD .= '<span class="specification2"> '.$returned_link[8].' </span>';
}
// word gram
if ($returned_link[2]!='') {
$BUFFER_VIEW_KEYWORD .= '<span class="pos"> '.$returned_link[2].' </span>';
}
// translation
if ($returned_link[3]!='') {
$BUFFER_VIEW_KEYWORD .= '<span class="dtrn2"> '.$returned_link[3].' </span>';
}
// translation detail
if ($returned_link[4]!='') {
$BUFFER_VIEW_KEYWORD .= '<span class="ex_translation"> '.$returned_link[4].' </span>';
}
// format of example
if ($returned_link[5]!='') {
if ($history!==TRUE) {

$BUFFER_VIEW_KEYWORD .= '<div class="viewkeyword_examples">';
}
}
// example
if ($returned_link[5]!='') {
$BUFFER_VIEW_KEYWORD .= '<span class="ex"> '.$returned_link[5].' </span>';
}
// example translation
if ($returned_link[6]!='') {
$BUFFER_VIEW_KEYWORD .= '<span class="ex_translation"> '.$returned_link[6].' </span>';
}
// end of format of example
if ($returned_link[5]!='') {
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .= '</div>';
}
}
}
}
}
// secondary marker
if ($row3[20]!='') {
$BUFFER_VIEW_KEYWORD .= '<span class="markers"> '.$row3[20].' </span>';
}
if ($history!==TRUE) {
if ($_SESSION["rights"]!=3) {
$BUFFER_VIEW_KEYWORD .= '</a>'; 
}
}
// synonym
if (!empty($row3[13])) { 
$p4++;
$synonym_direct[$p4]=$row3[13];
// synonym link if synonym is composed from more than one word
$BUFFER_VIEW_KEYWORD .= '<span class="syn">';
if (strpos(trim($row3[13]), '(')!=0) {
$new_value= explode ('(',trim($row3[13]));	
$new_num_keyword = str_replace("(","",$new_value[1]);
$new_num_keyword = str_replace(")","",$new_num_keyword);
// we find the first word in the keyword so that we can redirect to other keyword
$sql= sprintf ('SELECT `id`, `keyword`, `num_keyword` FROM `%s` WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$dict,
	$collation_1,
	quate_smart($new_value[0]),
	quate_smart($new_num_keyword));				
$oop22->Setnames();
$oop22->query($sql);
$num3 = $oop22->getNumrows();
$returned7 = $oop22->fetchRow ();
} else {
// we make link to synonym keyword
// we find the first word in the keyword so that we can redirect to other keyword
$sql= sprintf ('SELECT `id`, `keyword`, `num_keyword` FROM `%s` WHERE `keyword` COLLATE `%s`=%s',
	$dict,
	$collation_1,
	quate_smart($row3[13]));				
$oop22->Setnames();
$oop22->query($sql);
$num3 = $oop22->getNumrows();
$returned7 = $oop22->fetchRow ();
}
$oop22->FreeResult();
if ($num3>=1) {
// if this is the edit mode, we go to edit page
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .=	"<a href =\"./search.php?list_kind=alpha&amp;d_h=".$returned7[1]."&amp;d_h_n=".$returned7[2]."\">";
}
$BUFFER_VIEW_KEYWORD .=	"(";
if (strpos(trim($row3[13]), '(')!=0) { 
$BUFFER_VIEW_KEYWORD .=	 '<sup>'.$new_num_keyword.'</sup>' ;
$BUFFER_VIEW_KEYWORD .=	 $new_value[0];
} else { 
$BUFFER_VIEW_KEYWORD .=	 $row3[13];} 
$BUFFER_VIEW_KEYWORD .=	")"; 
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .=	"</a>";
}
} else {
// no link to synonym was found
// we try to make hyperlink from synonym link
if ($row3[14]!='') {
// synonym link if synonym is composed from more than one word
if (strpos(trim($row3[14]), '(')!=0) {
$new_value= explode ('(',trim($row3[14]));	
$new_num_keyword = str_replace("(","",$new_value[1]);
$new_num_keyword = str_replace(")","",$new_num_keyword);
// we find the first word in the keyword so that we can redirect to other keyword
$sql= sprintf ('SELECT `id`, `keyword`, `num_keyword` FROM `%s` WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$dict,
	$collation_1,
	quate_smart($new_value[0]),
	quate_smart($new_num_keyword));				
$oop22->Setnames();
$oop22->query($sql);
$num3 = $oop22->getNumrows();
$returned7 = $oop22->fetchRow ();
} else {
// we make link to synonym keyword
// we find the first word in the keyword so that we can redirect to other keyword
$sql= sprintf ('SELECT `id`, `keyword`, `num_keyword` FROM `%s` WHERE `keyword` COLLATE `%s`=%s',
	$dict,
	$collation_1,
	quate_smart($row3[14]));				
$oop22->Setnames();
$oop22->query($sql);
$num3 = $oop22->getNumrows();
$returned7 = $oop22->fetchRow ();
}
$oop22->FreeResult();
if ($num3>=1) {
// if this is the edit mode, we go to edit page
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .=	"<a href =\"./search.php?list_kind=alpha&amp;d_h=".$returned7[1]."&amp;d_h_n=".$returned7[2]."\">";
}
$BUFFER_VIEW_KEYWORD .= "(";
$BUFFER_VIEW_KEYWORD .= $row3[13];
$BUFFER_VIEW_KEYWORD .=")"; 
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .="</a>"; 
}
} else {
// no link to synonym was found
$BUFFER_VIEW_KEYWORD .="(".$row3[13].")"; 
}
} else {
$BUFFER_VIEW_KEYWORD .="(".$row3[13].")"; 
}
}
$BUFFER_VIEW_KEYWORD .= '</span> ';
}	 
if ($history!==TRUE) {
if ($_SESSION["rights"]!=3) {
$BUFFER_VIEW_KEYWORD .= "<a href=\"./edit.php?id=".$row3[0]."&amp;d_h=".$returned2[1]."&amp;d_h_n=".$returned2[2]."&amp;es=true\">";
} 
}
if ($row3[3]!='') { 
$BUFFER_VIEW_KEYWORD .="<span class=\"pos\"> ". $row3[3]." </span>";
}
if ($row3[21]!='') {  
$BUFFER_VIEW_KEYWORD .= "<span class=\"specification\"> ". $row3[21]." </span>";
} 
if ($row3[22]!='') { 
$BUFFER_VIEW_KEYWORD .= "<span class=\"specification2\"> ". $row3[22]." </span>";
}
if ($row3[5]!='') { 
$BUFFER_VIEW_KEYWORD .= "<span class=\"dtrn2\"> ". $row3[5]." </span>";
} 
if ($row3[6]!='') { 
$BUFFER_VIEW_KEYWORD .= "<span class=\"ex_translation\"> ". $row3[6]." </span>";
} 
if ($history!==TRUE) {
if ($_SESSION["rights"]!=3) {
$BUFFER_VIEW_KEYWORD .= "</a>";
} 
}
if ($row3[10]!='') { 
if ($history!==TRUE) {

$BUFFER_VIEW_KEYWORD .= '<div class="viewkeyword_examples">';

}
if ($row3[10]!='') { 
$BUFFER_VIEW_KEYWORD .= "<span class=\"ex\">	    ". $row3[10]." </span>";
} 
if ($row3[10]!='') { 
$BUFFER_VIEW_KEYWORD .= "<span class=\"ex_translation\">	    ". $row3[11]." </span>";
}
} 
// we make hyperlinks from keyword in translation
if ($_SESSION["rights"]!=3) {
if ($history!==TRUE) {
if ($row3[12]!="") {
$str = $row3[12];
$ww=0;
$array1= explode (',', $str);
$count1= count ($array1);
$BUFFER_VIEW_KEYWORD .= '<span class="ex_keyword">(';
foreach ($array1 as $value) {
if ($value!="") {
$ww++;
// if there is a ( it means there is num_keyword entered
// for example ganga (2)
if (strpos(trim($value), '(')!=0) {
$new_value= explode ('(',trim($value));	
$new_num_keyword = str_replace("(","",$new_value[1]);
$new_num_keyword = str_replace(",","",$new_num_keyword);
$new_num_keyword = str_replace(")","",$new_num_keyword);
$new_keyword = str_replace(",","",$new_value[0]);
$new_keyword=trim($new_keyword);
// we check whether the keyword exists, if so we create hyperlink if not we do not create hyperlink
$sql= sprintf ('SELECT `id` FROM `%s` WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$dict_keyword,
	$collation_1,
	quate_smart($new_keyword),
	quate_smart($new_num_keyword));				
$oop22->Setnames();
$oop22->query($sql);
$num_check = $oop22->getNumrows();
$oop22->FreeResult();
if ($num_check!=0) {
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .= "<a href=\"./search.php?d_h=".$new_keyword."&amp;d_h_n=".$new_num_keyword."\"><sup>".$new_num_keyword."</sup>".$new_keyword."</a>";
}
} else {
$BUFFER_VIEW_KEYWORD .= "<sup>".$new_num_keyword."</sup>".$new_keyword;
}
} else {
$new_keyword = str_replace(",","",$value);	
$new_keyword=trim($new_keyword);
$new_num_keyword=0;
// we check whether the keyword exists, if so we create hyperlink if not we do not create hyperlink
$sql= sprintf ('SELECT `id` FROM `%s` WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$dict_keyword,
	$collation_1,
	quate_smart($new_keyword),
	quate_smart($new_num_keyword));				
$oop22->Setnames();
$oop22->query($sql);
$num_check = $oop22->getNumrows();
$oop22->FreeResult();
if ($num_check!=0) {
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .= "<a href=\"./search.php?list_kind=alpha&amp;d_h=".$new_keyword."&amp;d_h_n=0\" class=\"pale\">".$new_keyword."</a>";
}
} else {
$BUFFER_VIEW_KEYWORD .= $new_keyword;
}
}
// we dont add komma when there is last word
if ($ww!=$count1-2) {
$BUFFER_VIEW_KEYWORD .= ',';
}		
}
}
$BUFFER_VIEW_KEYWORD .= ')</span>';
} } }
if ($row3[10]!='') {
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .= "</div>";
}
}
//antonym
if (!empty($row3[17])) {
$p++;
$antonym_direct[$p]=$row3[17];
$BUFFER_VIEW_KEYWORD .= '<span class="syn"> ';
if (strpos(trim($row3[17]), '(')!=0) {
$new_value= explode ('(',trim($row3[17]));	
$new_num_keyword = str_replace("(","",$new_value[1]);
$new_num_keyword = str_replace(")","",$new_num_keyword);
// we find the first word in the keyword so that we can redirect to other keyword
$sql= sprintf ('SELECT `id`, `keyword`, `num_keyword` FROM `%s` WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$dict,
	$collation_1,
	quate_smart($new_value[0]),
	quate_smart($new_num_keyword));				
$oop22->Setnames();
$oop22->query($sql);
$num3 = $oop22->getNumrows();
$returned = $oop22->fetchRow ();
} else {
// we make link to synonym keyword
// we find the first word in the keyword so that we can redirect to other keyword
$sql= sprintf ('SELECT `id`, `keyword`, `num_keyword` FROM `%s` WHERE `keyword` COLLATE `%s`=%s',
	$dict,
	$collation_1,
	quate_smart($row3[17]));				
$oop22->Setnames();
$oop22->query($sql);
$num3 = $oop22->getNumrows();
$returned = $oop22->fetchRow ();
}
$oop22->FreeResult();
if ($num3>=1) {
// if this is the edit mode, we go to edit page
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .=	"<a href =\"./search.php?list_kind=alpha&amp;d_h=".$returned[1]."&amp;d_h_n=".$returned[2]."\">"; 
}
$BUFFER_VIEW_KEYWORD .= "<span class=\"specification2\"> x </span>(";
if (strpos(trim($row3[17]), '(')!=0) { 
$BUFFER_VIEW_KEYWORD .= '<sup>'.$new_num_keyword.'</sup>' ;
$BUFFER_VIEW_KEYWORD .= $new_value[0];
} else {
$BUFFER_VIEW_KEYWORD .= $row3[17];} 
$BUFFER_VIEW_KEYWORD .= ")";
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .= "</a>";
}
} else {
// no link to synonym was found
$BUFFER_VIEW_KEYWORD .= "<span class=\"specification2\"> x </span>(". $row3[17].")";
}
$BUFFER_VIEW_KEYWORD .= '</span> ';
}
if ($row3[16]!='') { 
$BUFFER_VIEW_KEYWORD .="<span class=\"latin\">(". $row3[16].")</span>"; 
}
// link to another keyowrd
$_show_link=false;
if ((($fr_gr=='zkr') AND ($_SESSION["rights"]==3)) OR (($row3[5]=='') AND ($_SESSION["rights"]==3) AND ($_from_another_keyword===FALSE)) OR ((($word_grammar=='pp') OR ($word_grammar=='presp')) AND ($_SESSION["rights"]==3)) OR ($_SESSION["rights"]!=3)){
$_show_link=TRUE;
}
if ($_show_link===TRUE) {	
if (!empty($row3[18])) { 
if (strpos(trim($row3[18]), '(')!=0) {
$new_value= explode ('(',trim($row3[18]));	
$new_num_keyword = str_replace("(","",$new_value[1]);
$new_num_keyword = str_replace(")","",$new_num_keyword);
// we find the first word in the keyword so that we can redirect to other keyword
$sql= sprintf ('SELECT `id`, `keyword`, `num_keyword` FROM `%s` WHERE `keyword` COLLATE `%s`=%s AND `num_keyword` = %s',
	$dict,
	$collation_1,
	quate_smart($new_value[0]),
	quate_smart($new_num_keyword));				
$oop22->Setnames();
$oop22->query($sql);
$num3 = $oop22->getNumrows();
$returned = $oop22->fetchRow ();
} else {
// we make link to synonym keyword
// we find the first word in the keyword so that we can redirect to other keyword
$sql= sprintf ('SELECT `id`, `keyword`, `num_keyword` FROM `%s` WHERE `keyword` COLLATE `%s`=%s',
	$dict,
	$collation_1,
	quate_smart($row3[18]));				
$oop22->Setnames();
$oop22->query($sql);
$num3 = $oop22->getNumrows();
$returned = $oop22->fetchRow ();
}
$oop22->FreeResult();
if ($num3>=1) {
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .=	"<a href =\"./search.php?list_kind=alpha&amp;d_h=".$returned[1]."&amp;d_h_n=".$returned[2]."\">"; 
}
$BUFFER_VIEW_KEYWORD .= "<span class=\"link\">→";
 if (strpos(trim($row3[18]), '(')!=0) { 
$BUFFER_VIEW_KEYWORD .= '<sup>'.$new_num_keyword.'</sup>' ;
$BUFFER_VIEW_KEYWORD .= $new_value[0];
} else { 
$BUFFER_VIEW_KEYWORD .= $row3[18];} 
$BUFFER_VIEW_KEYWORD .= "</span>";
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .= "</a>";
}
} else {
$BUFFER_VIEW_KEYWORD .= "<span class=\"link\">→ ". $row3[18]." </span> ";
}
}
}
if ($history!==TRUE) {
$BUFFER_VIEW_KEYWORD .='<br>';
}
$pocet++; // increase of pocet
endwhile;
// dont show in history
if ($history!==TRUE) {

$BUFFER_VIEW_KEYWORD .='</div>';
$BUFFER_VIEW_KEYWORD .= '</div>'; 

}
$oop11->_mySQL;
$oop22->_mySQL;
?>
