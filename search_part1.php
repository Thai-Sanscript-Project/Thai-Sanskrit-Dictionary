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
if (isset($_POST["mode_lang"])) {
if ($_POST["mode_lang"]=='is-cz') {
$_SESSION["post_f"]='keyword';
} else {
$_SESSION["post_f"]='translation';	
}}
$first_keyword='';
$first_num_keyword='';
// 1. pagination
if (isset($_GET['pagenum'])) {
$_SESSION["post_p"] = $_GET['pagenum'];
} 
// variable for empty search
$special_empty=FALSE;
$table_queries='ds_queries';
if ($key!="") {
$oop_evidence = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$sql = sprintf ('SELECT `keyword` FROM `%s` WHERE `field` = %s AND `ip` = %s LIMIT 0, 1',
	$table_queries,
	quate_smart($_SESSION["post_f"]),
	quate_smart($ip)); 
$oop_evidence->Setnames();
$oop_evidence->query($sql);
$returned_e = $oop_evidence->fetchRow ();
$oop_evidence->FreeResult();
if ($returned_e[0]!=$key) {
$sql = sprintf ('INSERT INTO `%s` (`id`, `keyword`, `field`, `ip`, `time`) VALUES (NULL, %s, %s, %s, %s)',
	$table_queries,	
	quate_smart($key),
	quate_smart($_SESSION["post_f"]),
	quate_smart($ip),
	quate_smart(date("Y-m-d H:i:s")));
$oop_evidence->Setnames();
$oop_evidence->query($sql);
$oop_evidence->FreeResult();
}
$oop_evidence->_mySQL;
}
// we fill the session result list so that we can access the results later via hyperlink
// add value only if it from post keyword / from the real search
// CHANGED THE PAGENUM IN ONE OF THE RESULT LIST FIELDS
if ($pagenum_changed===TRUE) {
$count = count($_SESSION["result_list"]);
for ($i = 0; $i < $count; $i++) {
if ($_SESSION["post_h"]=='') {
$pp_string='!0!';	
} else {
$pp_string=$_SESSION["post_h"];	
}
if (($_SESSION["result_list"][$i][0]==$pp_string) AND ($_SESSION["result_list"][$i][2]==$_SESSION["post_m"])) {
$_SESSION["result_list"][$i][1]=$_SESSION["post_p"];
}}}
if (isset($_POST["search_string"])) {
$found_same=FALSE;  
$count = count($_SESSION["result_list"]);
if ($_POST["search_string"]=='') {
$pp_post_h='!0!';	
} else {
$pp_post_h=$_POST["search_string"];	
}	
for ($i = 0; $i < $count; $i++) {
if (($_SESSION["result_list"][$i][0]==$pp_post_h) AND ($_SESSION["result_list"][$i][1]==1) AND ($_SESSION["result_list"][$i][2]==$_POST["mode_search"])) {
$found_same=TRUE;
}}
if ($found_same===FALSE) {
$new_result_list=array("0" => $pp_post_h, "1" => 1, "2" =>$_SESSION["post_m"], "3" =>$_SESSION["post_advanced_search"], "4" =>$_SESSION["post_f"]);
if ($count!=0) {
array_unshift($_SESSION["result_list"], $new_result_list);
} else {
$_SESSION["result_list"][0]=$new_result_list;	
}
}
$count = count($_SESSION["result_list"]);
}
//////////////////////////////////********************************************************/////////////////
/////////////////////////////////////************ SEARCH ****** BEGINS ******************/////////////////
/////////////////////////////////********************************************************/////////////////
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop4 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$only_one_result=FALSE;
if ($_GET["action"] == "find") {
$n=0;	
// we find in which table we will search
foreach ($searched_areas_dict as $key1 => $value) {
if ($_SESSION["post_f"]==$key1) {
$n++;	
}}
if ($n==1) {
$table=$dict;
} else {
$table=$dict_keyword;   
};
// register this session to know in which table we search
$_SESSION["adv_table"] = $table;
$cz=false;
foreach ($cz_areas as $key1 => $value) {
if ($_SESSION["post_f"]==$key1) {
$cz=true;	
} else {
}}
if ($cz===false) {
$collation=$collation_1;	
} else {
$collation=$collation_2;		
}
// inicializace variable to begin search
$search_begins=false;	
$show_tips=false;
if ($search_begins===false) {
// ************************************************** //
// ADVANCED SEARCH / IN THE WHOLE DATABASE
// ************************************************** //
if (($_SESSION["post_m"])==2) {
$sql = sprintf ('SELECT * FROM %s WHERE %s COLLATE `%s` like %s GROUP BY  `keyword` COLLATE `%s`, `num_keyword`',
	$table,
	trim($_SESSION["post_f"]),
	$collation,
	quate_wildcard($key),
	$collation); 
}
if (($_SESSION["post_m"])==3) {
$sql = sprintf ('SELECT * FROM %s WHERE %s COLLATE `%s` like %s',
	$table,
	trim($_SESSION["post_f"]),
	$collation,
	quate_two_wildcard($key)); 
}
if (($_SESSION["post_m"])==4) {
$sql = sprintf ('SELECT * FROM %s WHERE %s COLLATE `%s` like %s',
	$table,
	trim($_SESSION["post_f"]),
	$collation,
	quate_end_wildcard($key)); 
}
if (($_SESSION["post_m"])==5) {
$sql = sprintf ('SELECT * FROM %s WHERE %s COLLATE `%s` != %s',
	$table,
	trim($_SESSION["post_f"]),
	$collation,
	quate_smart($key)); 
}
if (($_SESSION["post_m"])==1) {
$sql = sprintf ('SELECT * FROM %s WHERE %s COLLATE `%s` = %s',
	$table,
	trim($_SESSION["post_f"]),
	$collation,
	quate_smart($key)); 
}
if ($cz===false) {
$oop->Setnames();
} else {
$oop->Setnames_cz();
}
$oop->query($sql);
$num = $oop->getNumRows();
if ($num==1) {
$only_one_result=TRUE;
}
$oop->freeResult();
// PAGINATION
// 3. Calculate number of $lastpage
$rows_per_page = 20;
$lastpage      = ceil($num/$rows_per_page);
// PAGINATION
// 4. Ensure that $pagenum is within range
$_SESSION["post_p"] = (int)$_SESSION["post_p"];
if ($_SESSION["post_p"] > $lastpage) {
   $_SESSION["post_p"] = $lastpage;
}
if ($_SESSION["post_p"] < 1) {
   $_SESSION["post_p"] = 1;
}
// PAGINATION
// 5. Construct LIMIT clause
$limit = 'LIMIT ' .($_SESSION["post_p"] - 1) * $rows_per_page .',' .$rows_per_page;
// SQL WITH LIMIT FOR PAGINATION
if (($_SESSION["post_m"])==2) {
$sql = sprintf ('SELECT * FROM `%s` WHERE `%s` COLLATE `%s` like %s GROUP BY  `keyword` COLLATE `%s`, `num_keyword` %s',
	$table,
	trim($_SESSION["post_f"]),
	$collation,
	quate_wildcard($key),
	$collation,
	$limit); 
}
if (($_SESSION["post_m"])==3) {
$sql = sprintf ('SELECT * FROM `%s` WHERE `%s` COLLATE `%s` like %s GROUP BY  `keyword` COLLATE `%s`, `num_keyword` %s',
	$table,
	trim($_SESSION["post_f"]),
	$collation,					
	quate_two_wildcard($key),
	$collation,
	$limit); 
}
if (($_SESSION["post_m"])==4) {
$sql = sprintf ('SELECT * FROM `%s` WHERE `%s` COLLATE `%s` like %s GROUP BY  `keyword` COLLATE `%s`, `num_keyword` %s',
	$table,
	trim($_SESSION["post_f"]),
	$collation,					
	quate_end_wildcard($key),
	$collation,
	$limit); 
}
if (($_SESSION["post_m"])==5) {
$sql = sprintf ('SELECT * FROM `%s` WHERE `%s` COLLATE `%s` != %s GROUP BY  `keyword` COLLATE `%s`, `num_keyword` %s',
	$table,
	trim($_SESSION["post_f"]),
	$collation,					
	quate_smart($key),
	$collation,
	$limit); 
}	
if (($_SESSION["post_m"])==1) {
$sql = sprintf ('SELECT * FROM `%s` WHERE `%s` COLLATE `%s` = %s %s',
	$table,
	trim($_SESSION["post_f"]),
	$collation,
	quate_smart($key),
	$limit); 
}
if ($cz===false) {
$oop->Setnames();
} else {
$oop->Setnames_cz();
}
$oop->query($sql);
$num = $oop->getNumRows();
// no results found in the database
if ($num==0) {
$list_of_word_form=FALSE;
// no word forms found in database
if ($ccc==0) {
// special function for metausers - if search string contains 1 it means
// that it is direct search of headword (no matter what search criteria were
$radgata= strpos ($key, '1');
if ($radgata===FALSE) {
} else {
$key =str_replace ('1', '' ,  $key);
$location = './search.php?list_kind=alpha&post_h='.$key.'&post_m=3&amp;post_f=translation';	
header("Location: ".$location."");
}
// special functions for direct searching in translations
$radgata= strpos ($key, '0');
if ($radgata===FALSE) {
} else {
$key =str_replace ('0', '' ,  $key);
$location = './search.php?list_kind=alpha&post_h='.$key.'&post_m=2&amp;post_f=keyword';	
header("Location: ".$location."");
}
$BUFFER_SEARCH .= $search_slovo." ".$key."  ".$lang_search_notfound."  ";
// levenstein for headwords - we try with this method to find the most approximate headword
if ($_SESSION["post_f"]=='keyword') {
// input misspelled word
$input = $key;
// array of words to check against
$oop_leven = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$sql = sprintf ('SELECT `keyword` FROM `%s`',
	$dict_keyword); 
$oop_leven->Setnames();
$oop_leven->query($sql);
// no shortest distance found, yet
$shortest = -1;
while($ret_lev = $oop_leven->fetchRow ()) :
// loop through words to find the closest calculate the distance between the input word and the current word
$lev = levenshtein($input, $ret_lev[0]);
// check for an exact match
if ($lev == 0) {
// closest word is this one (exact match)
$closest = $ret_lev[0];
$shortest = 0;
 // break out of the loop; we've found an exact match
break;
}
// if this distance is less than the next found shortest distance, OR if a next shortest word has not yet been found
if ($lev <= $shortest || $shortest < 0) {
// set the closest match, and shortest distance
$closest  = $ret_lev[0];
$shortest = $lev;
}
endwhile;
$oop_leven->freeResult();
$sql = sprintf ('SELECT `keyword` FROM `%s` WHERE `keyword` COLLATE `%s` = %s',
	$dict_keyword,
	$collation,
	quate_smart($closest)); 
$oop_leven->Setnames();
$oop_leven->query($sql);
$num_leven = $oop_leven->getNumRows();
if ($num_leven==1) {
$leven_num=0; 
} else {
$leven_num=1; 
}	
if ($shortest == 0) {
$BUFFER_SEARCH .=  $lang_search_mes1.$closest;
} else {
$BUFFER_SEARCH .= '<br>';
$BUFFER_SEARCH .= '<br>';
$BUFFER_SEARCH .= $search_help." <a href=\"./search.php?list_kind=alpha&d_h=".$closest."&d_h_n=".$leven_num."\">$closest</a>?\n";
}
$oop_leven->freeResult();
$oop_leven->_mySQL;
}
} // end of no word form found in database 
else if ($ccc==1) { // we have only one result from word forms we can display it vith notice
$oop->FreeResult();		
$list_of_word_form=FALSE;
$sql_4 = sprintf ('SELECT `id`,`keyword`,`num_keyword` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table_keyword,
	$collation,
	quate_smart($first_wordform_keyword),
	quate_smart($first_wordform_num_keyword));
$oop->Setnames();
$oop->query($sql_4);
$num = $oop->getNumRows();
$ccc_found=true;
$ccc=2;
$returned_1 = $oop->fetchRow ();
$oop->freeResult();
$_SESSION["d_h"]=$returned_1[1];
$_SESSION["d_h_n"]=$returned_1[2];
$_SESSION["ses_message"].="".$lang_search_word_form." ".$key."";
$location = 'Location: ./search.php?list_kind=alpha';		
header($location);
Die();
// more than one word form found in database
} else {
$list_of_word_form=TRUE;
$BUFFER_SEARCH .= '<span class="pos">';
$BUFFER_SEARCH .= $lang_search_list_of_keywords.'<br>';
$BUFFER_SEARCH .= $lang_search_mes2;
$BUFFER_SEARCH .= '</span>';
$_SESSION["d_h"]=$first_wordform_keyword;
$_SESSION["d_h_n"]=$first_wordform_num_keyword;
}
}
//end of basic search /////////////
if ($list_of_word_form!==TRUE) {
if ($_SESSION["post_f"]!='keyword') {
$ddd=2;	
}
//found exactly one result => directly to edit or viewandsearch page 
if (((($num==1) AND (($ccc<=1) OR ($ddd==2))) OR ($ccc_found===TRUE))) {
$returned_1 = $oop->fetchRow ();
if (($_SESSION["adv_table"]==$dict) AND ($only_one_result===TRUE)) {
$view_keyword=$returned_1[1];
$view_num_keyword=$returned_1[2];
} else {
// we will view this word later
$view_word='true';
$view_keyword=$returned_1[1];
$view_num_keyword=$returned_1[2];
$_SESSION["d_h"]=$view_keyword;
$_SESSION["d_h_n"]=$view_num_keyword;
}
$oop->freeResult();
$location = 'Location: ./search.php?list_kind=alpha&d_h='.$view_keyword.'&d_h_n='.$view_num_keyword.'';		
header($location);
Die();

if (isset($_POST["submit"])) {
$found_now=TRUE;
$_SESSION["list_kind"]='alpha';
// show the headword in alpha list - because there is no result list
}
$oop->freeResult();
} else if ($num<>0) {
///////////////////////////////////////////////////////////////////////
////////////// more results were found = make pagination pages ////////
////////////////////////////////////////////////////////////////////////
$BUFFER_SEARCH .= '<span class="headings_result">'.$lang_search_list_of_keywords.'</span><br>';
$count_t=0;
if ($table==$dict) {
// begin flickr pagination
if (($_SESSION["post_p"]==$lastpage) AND ($_SESSION["post_p"]==1)) {
} else {
$BUFFER_SEARCH .= '<br>';

if ($_SESSION["post_p"]>1) {

 $prevpage = $_SESSION["post_p"]-1;
$BUFFER_SEARCH .= " <a href=\"".$_SERVER['PHP_SELF']."?action=find&amp;pagenum=".$prevpage."\"><img src=\"/images/left_arrow_pink.png\" border=\"0\" alt=\"\"></a>";
$BUFFER_SEARCH .= '';
} else {
$BUFFER_SEARCH .= '<img src="/images/left_arrow_noactive.png" border="0" alt=""></li>';	
}
$stop=false;
$nextpage = $_SESSION["post_p"]+1;
if ($_SESSION["post_p"]<$lastpage) {
$BUFFER_SEARCH .= " <a href=\"".$_SERVER['PHP_SELF']."?action=find&amp;pagenum=".$nextpage."\"><img src=\"/images/right_arrow_pink.png\" border=\"0\" alt=\"\"></a>";
} else {
$BUFFER_SEARCH .= '<img src="/images/right_arrow_noactive.png" border="0" alt="">';
}
$BUFFER_SEARCH .= '<br>';
$BUFFER_SEARCH .= '<br> ';
}
// end of flickr pagination
while($row = $oop->fetchRow ()) :
$count_t++;
$sql3 = sprintf ('SELECT `gram_1_word_group`, `gram_2_endings`, `gram_3_additional`, `keyword` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$dict_keyword,
	$collation,
	quate_smart($row[1]),
	quate_smart($row[2])); 
$oop4->Setnames();
$oop4->query($sql3);
$new_row = $oop4->fetchRow ();
$oop4->freeResult();
// to get the unique search field and color it, not exatch match in both with begins with or contains
if (($_SESSION["post_m"])==2) {
$sql4 = sprintf ('SELECT `%s`, `translation`, `translation_detail` FROM `%s` WHERE `%s` COLLATE `%s` like %s AND `keyword` COLLATE `%s` = %s AND `num_keyword` = %s ',
	trim($_SESSION["post_f"]),
	$table,
	trim($_SESSION["post_f"]),
	$collation,
	quate_wildcard($key),
	$collation,
	quate_smart($row[1]),
	quate_smart($row[2])); 
}
if (($_SESSION["post_m"])==3) {
$sql4 = sprintf ('SELECT `%s`, `translation`, `translation_detail` FROM `%s` WHERE `%s` COLLATE `%s` like %s AND `keyword` COLLATE `%s` = %s AND `num_keyword` = %s ',
	trim($_SESSION["post_f"]),
	$table,
	trim($_SESSION["post_f"]),
	$collation,
	quate_two_wildcard($key),
	$collation,
	quate_smart($row[1]),
	quate_smart($row[2]));
}
if (($_SESSION["post_m"])==4) {
$sql4 = sprintf ('SELECT `%s`, `translation`, `translation_detail` FROM `%s` WHERE `%s` COLLATE `%s` like %s AND `keyword` COLLATE `%s` = %s AND `num_keyword` = %s ',
	trim($_SESSION["post_f"]),
	$table,
	trim($_SESSION["post_f"]),
	$collation,
	quate_end_wildcard($key),
	$collation,
	quate_smart($row[1]),
	quate_smart($row[2]));
}
if (($_SESSION["post_m"])==5) {
$sql4 = sprintf ('SELECT `%s`, `translation`, `translation_detail` FROM `%s` WHERE `%s` COLLATE `%s` != %s AND `keyword` COLLATE `%s` = %s AND `num_keyword` = %s ',
	trim($_SESSION["post_f"]),
	$table,
	trim($_SESSION["post_f"]),
	$collation,
	quate_smart($key),
	$collation,
	quate_smart($row[1]),
	quate_smart($row[2]));
}
if (($_SESSION["post_m"])==1) {
$sql4 = sprintf ('SELECT `%s`, `translation`, `translation_detail` FROM `%s` WHERE `%s` COLLATE `%s` = %s AND `keyword` COLLATE `%s` = %s AND `num_keyword` = %s ',
	trim($_SESSION["post_f"]),
	$table,
	trim($_SESSION["post_f"]),
	$collation,
	quate_smart($key),
	$collation,
	quate_smart($row[1]),
	quate_smart($row[2]));
}
$oop4->Setnames();
$oop4->query($sql4);
$unique_row = $oop4->fetchRow ();
$oop4->freeResult();
$new_key="<span class=\"unique_color\">".$key."</span>";
$unique_row[0]=str_replace($key, $new_key, $unique_row[0]);
 // basic result list with pagination pages
if (($_SESSION["post_f"]=='specification') OR ($_SESSION["post_f"]=='usage_specification') OR ($_SESSION["post_f"]=='usage_category')) {
} else {
$unique_row[1]='';
$unique_row[2]='';	
}
if ($first_keyword=='') {
$_SESSION["first_keyword"]=$row[1];	
$_SESSION["first_num_keyword"]=$row[2];
}
if ($row[1]==0) {
$BUFFER_SEARCH .= "<a href=\"search.php?list_kind=alpha&amp;d_h=".$row[1]."&amp;d_h_n=".$row[2]."\">";
if (($row[1]==$_SESSION["d_h"]) AND ($row[2]==$_SESSION["d_h_n"])) {
$BUFFER_SEARCH .="<span class=\"e8\">";
} else {
$BUFFER_SEARCH .= "<span class=\"e7\">";	
}
$BUFFER_SEARCH .= $new_row[3]."</span>";
$BUFFER_SEARCH .= " <span class=\"e9\">".$unique_row[0]." ".$unique_row[1]." <span class=\"ex_translation\">".$unique_row[2]."</span></span></a> "; 
} else {
$BUFFER_SEARCH .= "<a href=\"search.php?list_kind=alpha&amp;d_h=".$row[1]."&amp;d_h_n=".$row[2]."\">";
if (($row[1]==$_SESSION["d_h"]) AND ($row[2]==$_SESSION["d_h_n"])) {
$BUFFER_SEARCH .="<span class=\"e8\">";
} else {
$BUFFER_SEARCH .= "<span class=\"e7\">";	
}
$BUFFER_SEARCH .= "<sup>".$row[2]."</sup>".$new_row[3]."</span>";
$BUFFER_SEARCH .= "  <span class=\"e9\">".$unique_row[0]." ".$unique_row[1]." <span class=\"ex_translation\">".$unique_row[2]."</span></span></a> "; 		
}
$BUFFER_SEARCH .= "<br>";
endwhile; 	
$oop->freeResult();
// results from dict1_keyword	
} else {
// begin flickr pagination
if (($_SESSION["post_p"]==$lastpage) AND ($_SESSION["post_p"]==1)) {
} else {
$BUFFER_SEARCH .= '';
if ($_SESSION["post_p"]>1) {
$BUFFER_SEARCH .= '';
 $prevpage = $_SESSION["post_p"]-1;
$BUFFER_SEARCH .= " <a href=\"".$_SERVER['PHP_SELF']."?action=find&amp;pagenum=".$prevpage."\"><img src=\"/images/left_arrow_pink.png\" border=\"0\" alt=\"\"></a>";
$BUFFER_SEARCH .= '';
} else {
$BUFFER_SEARCH .= '<img src="/images/left_arrow_noactive.png" border="0" alt="">';	
}
$stop=false;
$nextpage = $_SESSION["post_p"]+1;
if ($_SESSION["post_p"]<$lastpage) {
$BUFFER_SEARCH .= '';
$BUFFER_SEARCH .= " <a href=\"".$_SERVER['PHP_SELF']."?action=find&amp;pagenum=".$nextpage."\"><img src=\"/images/right_arrow_pink.png\" border=\"0\" alt=\"\"></a>";
$BUFFER_SEARCH .= '';
} else {
$BUFFER_SEARCH .= '<img src="/images/right_arrow_noactive.png" border="0" alt=""></a>';
$BUFFER_SEARCH .= '';	
}
$BUFFER_SEARCH .= '';
$BUFFER_SEARCH .= '<br>';
} // end of flickr pagination	
$BUFFER_SEARCH .= '<br>';
while($returned = $oop->fetchRow ()) :
$count_t++;
if ($num_keyword == '') {$returned[9]= '';}
// if advanced search in dict keyword / we show unique field
//// to get the unique search field and color it, not exatch match in both with begins with or contains
if (($_SESSION["post_m"])==2) {
$sql4 = sprintf ('SELECT `%s` FROM `%s` WHERE `%s` COLLATE `%s` like %s AND `keyword` COLLATE `%s` = %s AND `num_keyword` = %s ',
	trim($_SESSION["post_f"]),
	$table,
	trim($_SESSION["post_f"]),
	$collation,
	quate_wildcard($key),
	$collation,
	quate_smart($returned[1]),
	quate_smart($returned[2])); 
}
if (($_SESSION["post_m"])==3) {
$sql4 = sprintf ('SELECT `%s` FROM `%s` WHERE `%s` COLLATE `%s` like %s AND `keyword` COLLATE `%s` = %s AND `num_keyword` = %s ',
	trim($_SESSION["post_f"]),
	$table,
	trim($_SESSION["post_f"]),
	$collation,
	quate_two_wildcard($key),
	$collation,
	quate_smart($returned[1]),
	quate_smart($returned[2]));
}
if (($_SESSION["post_m"])==4) {
	$sql4 = sprintf ('SELECT `%s` FROM `%s` WHERE `%s` COLLATE `%s` like %s AND `keyword` COLLATE `%s` = %s AND `num_keyword` = %s ',
	trim($_SESSION["post_f"]),
	$table,
	trim($_SESSION["post_f"]),
	$collation,
	quate_end_wildcard($key),
	$collation,
	quate_smart($returned[1]),
	quate_smart($returned[2]));
}
if (($_SESSION["post_m"])==5) {
	$sql4 = sprintf ('SELECT `%s` FROM `%s` WHERE `%s` COLLATE `%s` != %s AND `keyword` COLLATE `%s` = %s AND `num_keyword` = %s ',
	trim($_SESSION["post_f"]),
	$table,
	trim($_SESSION["post_f"]),
	$collation,
	quate_smart($key),
	$collation,
	quate_smart($returned[1]),
	quate_smart($returned[2]));
}
if (($_SESSION["post_m"])==1) {
$sql4 = sprintf ('SELECT `%s` FROM `%s` WHERE `%s` COLLATE `%s` = %s AND `keyword` COLLATE `%s` = %s AND `num_keyword` = %s ',
	trim($_SESSION["post_f"]),
	$table,
	trim($_SESSION["post_f"]),
	$collation,
	quate_smart($key),
	$collation,
	quate_smart($returned[1]),
	quate_smart($returned[2]));
}
$oop4->Setnames();
$oop4->query($sql4);
$unique_row = $oop4->fetchRow ();
$oop4->freeResult();
$new_key="<span class=\"unique_color\">".$key."</span>";
$unique_row[0]=str_replace($key, $new_key, $unique_row[0]);
if ($_SESSION["first_keyword"]=='') {
$_SESSION["first_keyword"]=$returned[1];	
$_SESSION["first_num_keyword"]=$returned[2];
}
if ($returned[2]==0) {
$BUFFER_SEARCH .= "<a href=\"search.php?list_kind=alpha&amp;d_h=".$returned[1]."&amp;d_h_n=".$returned[2]."\">";
if (($returned[1]==$_SESSION["d_h"]) AND ($returned[2]==$_SESSION["d_h_n"])) {
$BUFFER_SEARCH .= "<span class=\"e8\">";
} else {
$BUFFER_SEARCH .= "<span class=\"e7\">";	
}
$BUFFER_SEARCH .= $returned[1]."</span>";
} else {
$BUFFER_SEARCH .= "<a href=\"search.php?list_kind=alpha&amp;d_h=".$returned[1]."&amp;d_h_n=".$returned[2]."\">";
if (($returned[1]==$_SESSION["d_h"]) AND ($returned[2]==$_SESSION["d_h_n"])) {
$BUFFER_SEARCH .="<span class=\"e8\">";
} else {
$BUFFER_SEARCH .= "<span class=\"e7\">";	
}
$BUFFER_SEARCH .= "<sup>".$returned[2]."</sup>".$returned[1]."</span>";
}
if ($returned[2]!=0) {
$BUFFER_SEARCH .= " <span class=\"e4\">".$returned[7]."</span></a>";	
} else {
$BUFFER_SEARCH .= "</a>";		
}
if ($_SESSION["post_f"]=='keyword') {
} else  {
$BUFFER_SEARCH .= "-> <span class=\"e9\"> ".$unique_row[0]." </span>";		
}
$BUFFER_SEARCH .= "<br>";
endwhile; 	
$oop->freeResult();
} // end of results from dict1_keyword 
} // end of more than one result
} // end of list of word form not true
} // end of search begins
}
$oop->_mySQL;
$oop4->_mySQL;
?>
