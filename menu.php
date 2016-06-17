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
$B_M_R='';
$B_M_R .= "<div class=\"menu_edit\">";
$B_M_R .= "<ul>"; 
$B_M_R .= "<li><a href=\"./search.php?recreate=recreate_list\">".$lang_mainmenu1."</a>";
$B_M_R .= "<ul>"; 
$B_M_R .= "<li><a href=\"./search.php?recreate=recreate_list\">".$lang_mainmenu2."</a>";
$B_M_R .= "<li><a href=\"./search.php?list_kind=alpha\">".$lang_mainmenu3."</a>";
$B_M_R .= "</ul>";
$B_M_R .= "</li>";
if (($_SESSION["rights"]==1) OR ($_SESSION["rights"]==2))  {
if (($search_page===TRUE) OR ($edit_page===TRUE)) {
$add_class="";
$B_M='';
$B_M .= "<li><a href=\"\" target=\"_self\" >".$lang_mainmenu4."</a>";
$B_M .= "<ul>";
$B_M .= "<li><a href=\"./add.php\" target=\"_self\">".$lang_mainmenu5."</a></li>";
$B_M .= "<li><a href=\"edit.php?action=confirm&new_word=true&d_h=".$_GET["d_h"]."&amp;d_h_n=".$_GET["d_h_n"]."&amp;save_history=FALSE\">".$lang_mainmenu6."</a></li>"; 
$B_M .= "<li> <a href=\"edit.php?d_h=".$_GET["d_h"]."&amp;d_h_n=".$_GET["d_h_n"]."&amp;post_h=".$key."&amp;pagenum=".$pagenum."&amp;post_m=".$_GET["post_m"]."&amp;post_f=".$_GET["post_f"]."&amp;es=true\" target=\"_self\">".$lang_mainmenu7."</a></li>";
$B_M .= "<li> <a href=\"edit.php?d_h=".$_GET["d_h"]."&amp;d_h_n=".$_GET["d_h_n"]."&amp;post_h=".$key."&amp;pagenum=".$pagenum."&amp;post_m=".$_GET["post_m"]."&amp;post_f=".$_GET["post_f"]."&m=del_meaning&amp;es=true\" target=\"_self\">".$lang_mainmenu8."</a></li>";
$B_M .= "</ul>";
$B_M .= "</li>";
$B_M .= "<li><a href=\"./index.php\">".$lang_mainmenu9."</a>";
$B_M .= "<ul>";
$B_M .= "<li><a href=\"./search.php?action=change_order&amp;reorder=TRUE&amp;d_h=".$_GET["d_h"]."&amp;d_h_n=".$_GET["d_h_n"]."\">".$lang_mainmenu10."</a></li>";
$B_M .= "<li><a href=\"./search.php?word_order_show=true&amp;d_h=".$_GET["d_h"]."&amp;d_h_n=".$_GET["d_h_n"]."\">".$lang_mainmenu11."</a></li>";
$B_M .= "<li><a href=\"./shift_keyword.php?action=detail&d_h=".$_GET["d_h"]."&amp;d_h_n=".$_GET["d_h_n"]."\">".$lang_mainmenu12."</a></li>"; 
$B_M .= "</ul>";
$B_M .= "</li>";
$B_M .= "<li><a href=\"\" target=\"_self\" >".$lang_mainmenu13."</a>";
$B_M .= "<ul>";
$found=true;
$oop_w_h = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$table=  'ds_1_headword';
$sql_c = sprintf ('SELECT `gram_1_word_group`, `gram_2_endings`, `gram_3_additional` FROM  `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`= %s ',
	$table,
	$collation_1,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]));
$oop_w_h->Setnames();
$oop_w_h->query($sql_c);	
$returned_c = $oop_w_h->fetchRow();
$oop_w_h->FreeResult();
$oop_w_h->_mySQL;
//dec nouns
if (($returned_c[0]=='n') OR ($returned_c[0]=='f') OR ($returned_c[0]=='m')) {
$dec_kind="noun";
// dec adjectives
} else if ($returned_c[0]=='adj') {
$dec_kind="adj";	
// declination verbs
} else if ($returned_c[0]=='v') {
$dec_kind="verb";
// dec adverbs
} else if ($returned_c[0]=='adv'){
$dec_kind="adv";
// dec pronouns
} else if (($returned_c[0]=='pron') AND ($returned_c[1]=='pers') AND ($pos3 !== false)) {
$dec_kind="pron_pers";
// dec pronouns num	
} else if (($returned_c[0]=='pron') OR ($returned_c[0]=='num') OR ($returned_c[0]=='pron/ num') OR ($returned_c[0]=='part')) {
$dec_kind="pron";
} else {
$found=false;
}
// word group unknown
 if ($found===false) { 
$B_M .= "<li><a href=\"".$base_url."&m=dec_add\">".$lang_mainmenu14."</a></li>";
$B_M .= "<li><a href=\"".$base_url."&m=dec_add\">".$lang_mainmenu15."</a></li>";
$B_M .= "<li><a href=\"".$base_url."&m=dec_edit\">".$lang_mainmenu16."</a></li>";
$B_M .= "<li><a href=\"".$base_url."&m=dec_del\">".$lang_mainmenu17."</a></li>";
} else {
$B_M .= "<li><a href=\"./d_edit_".$dec_kind.".php?action=add&d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\">".$lang_mainmenu14."</a></li>";
$B_M .= "<li><a href=\"./d_edit_".$dec_kind.".php?action=add&generate=no&d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\">".$lang_mainmenu15."</a></li>"; 
$B_M .= "<li><a href=\"./d_edit_".$dec_kind.".php?d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\">".$lang_mainmenu16."</a></li>"; 
$B_M .= "<li><a href=\"./d_edit_".$dec_kind.".php?action=delete&del=FALSE&d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\">".$lang_mainmenu17."</a></li>"; 
}
$B_M .= "</ul>";
$B_M .= "</li>";
$B_M .= "<li><a href=\"\" target=\"_self\" >".$lang_mainmenu18."</a>";
$B_M .= "<ul>";
$B_M .= "<li><a href=\"./multiple.upload.form.php?a=image&d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\">".$lang_mainmenu19."</a></li>"; 
if ($image_found===TRUE) {
$B_M .= $image_output_delete;
}
$B_M .= "<li><a href=\"./multiple.upload.form.php?a=sound&d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\">".$lang_mainmenu20."</a></li>"; 
if ($sound_found===TRUE) {
$B_M .= $sound_output_delete; 
}
$B_M .= "</ul>";
$B_M .= "</li>";
$B_M .= "<li><a href=\"\" target=\"_self\" >".$lang_mainmenu21."</a>";
$B_M .= "<ul>";
$B_M .= "<li><a href=\"history.php?action=save&d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\" target=\"_self\">".$lang_mainmenu22."</a></li>";
$B_M .= "<li><a href=\"history.php?action=print&d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."\" target=\"_self\">".$lang_mainmenu23."</a></li>";
$B_M .= "</ul>";
$B_M .= "</li>";
} else {
$add_class="class=\"inactive\"";
$B_M='';
$B_M .= "<li><a href=\"\" target=\"_self\" >".$lang_mainmenu4."</a>";
$B_M .= "<ul>";
$B_M .= "<li><a href=\"./add.php\" target=\"_self\">".$lang_mainmenu5."</a></li>";
$B_M .= "<li ".$add_class."><a href=\"\" target=\"_self\" >".$lang_mainmenu6."</a></li>"; 
$B_M .= "<li ".$add_class."> <a href=\"\" target=\"_self\" >".$lang_mainmenu7."</a></li>";
$B_M .= "<li ".$add_class."><a href=\"\" target=\"_self\" >".$lang_mainmenu8."</a></li>";
$B_M .= "</ul>";
$B_M .= "</li>";
$B_M .= "<li><a href=\"./index.php\">".$lang_mainmenu9."</a>";
$B_M .= "<ul>";
$B_M .= "<li ".$add_class."><a href=\"\" target=\"_self\" >".$lang_mainmenu10."</a></li>";
$B_M .= "<li ".$add_class."><a href=\"\" target=\"_self\" >".$lang_mainmenu11."</a></li>";
$B_M .= "<li ".$add_class."><a href=\"\" target=\"_self\" >".$lang_mainmenu12."</a></li>"; 
$B_M .= "</ul>";
$B_M .= "</li>";
$B_M .= "<li><a href=\"\" target=\"_self\" >".$lang_mainmenu13."</a>";
$B_M .= "<ul>";
$found=true;
$B_M .= "<li ".$add_class."><a href=\"\" target=\"_self\" >".$lang_mainmenu14."</a></li>";
$B_M .= "<li ".$add_class."><a href=\"\" target=\"_self\" >".$lang_mainmenu15."</a></li>";
$B_M .= "<li ".$add_class."><a href=\"\" target=\"_self\" >".$lang_mainmenu16."</a></li>";
$B_M .= "<li ".$add_class."><a href=\"\" target=\"_self\" >".$lang_mainmenu17."</a></li>";
$B_M .= "</ul>";
$B_M .= "</li>";
$B_M .= "<li><a href=\"\" target=\"_self\" >".$lang_mainmenu18."</a>";
$B_M .= "<ul>";
$B_M .= "<li ".$add_class."><a href=\"\" target=\"_self\" >".$lang_mainmenu19."</a></li>"; 
if ($image_found===TRUE) {
$B_M .= $image_output_delete;
}
$B_M .= "<li ".$add_class."><a href=\"\" target=\"_self\" >".$lang_mainmenu20."</a></li>"; 
if ($sound_found===TRUE) {
$B_M .= $sound_output_delete; 
}
$B_M .= "</ul>";
$B_M .= "</li>";
$B_M .= "<li><a href=\"\" target=\"_self\" >".$lang_mainmenu21."</a>";
$B_M .= "<ul>";
if ($history_page===TRUE) {
$B_M .= "<li><a href=\"history.php?action=save&amp;d_h=".$_GET["d_h"]."&amp;d_h_n=".$_GET["d_h_n"]."\" target=\"_self\">".$lang_mainmenu22."</a></li>";
$B_M .= "<li><a href=\"history.php?action=print&amp;d_h=".$_GET["d_h"]."&amp;d_h_n=".$_GET["d_h_n"]."\" target=\"_self\">".$lang_mainmenu23."</a></li>";
} else {
$B_M .= "<li ".$add_class."><a href=\"\" target=\"_self\" >".$lang_mainmenu22."</a></li>";
$B_M .= "<li ".$add_class."><a href=\"\" target=\"_self\" >".$lang_mainmenu23."</a></li>";	
}
$B_M .= "</ul>";
$B_M .= "</li>"; 
}
$B_M .= "<li><a href=\"\" target=\"_self\" >".$lang_mainmenu24."</a>";
$B_M .= "<ul>";
$B_M .= "<li><a href= \"http://snara.is/vefbaekur/g.aspx?action=search&sw=".$_GET["d_h"]."&lid=40&dbid=2&version=\" onclick= \"return popitup('http://snara.is/vefbaekur/g.aspx?action=search&sw=".$_GET["d_h"]."&lid=40&dbid=2&version=') \"> Íslensk orðabók.</a></li> ";
$B_M .= "<li><a href= \"http://snara.is/vefbaekur/g.aspx?action=search&sw=".$_GET["d_h"]."&lid=40&dbid=38&version=\" onclick= \"return popitup('http://snara.is/vefbaekur/g.aspx?action=search&sw=".$_GET["d_h"]."&lid=40&dbid=38&version=') \"> Íslensk-ensk orðabók</a></li> ";
$B_M .= "<li><a href= \"http://snara.is/vefbaekur/g.aspx?action=search&sw=".$_GET["d_h"]."&lid=40&dbid=41&version=\" onclick= \"return popitup('http://snara.is/vefbaekur/g.aspx?action=search&sw=".$_GET["d_h"]."&lid=40&dbid=41&version=') \"> 30 tungumála orðabók </a></li> ";
$B_M .= "<li><a href= \"http://bin.arnastofnun.is/leit.php?q=".$_GET["d_h"]." \" onclick= \"return popitup('http://bin.arnastofnun.is/leit.php?q=".$_GET["d_h"]."') \">BIN</a></li> ";
$B_M .= "<li><a href=\"http://www.lexis.hi.is/osamb/osamb.pl?finna=Leita&flyk=".$_GET["d_h"]."&fofl=&flyk2=&fofl2=&ftexti=\" onclick= \"return popitup('http://www.lexis.hi.is/osamb/osamb.pl?finna=Leita&flyk=".$_GET["d_h"]."&fofl=&flyk2=&fofl2=&ftexti=') \"> Skrá um orðasambönd</a></li> ";
$B_M .= "<li><a href=\"http://www2.lexis.hi.is/cgi-bin/ritmal/leitord.cgi?adg=leit&l=".$_GET["d_h"]."\" onclick= \"return popitup('http://www2.lexis.hi.is/cgi-bin/ritmal/leitord.cgi?adg=leit&l=".$_GET["d_h"]."') \"> Ritmálssafn</a></li> ";
$B_M .= "<li><a href= \"http://people.w3.org/rishida/scripts/pickers/ipa/\" onclick= \"return popitup('http://people.w3.org/rishida/scripts/pickers/ipa/') \"> IPA</a></li>";
$B_M .= "</ul>";
$B_M .= "</li>";
$B_M .= "<li><a href=\"\" target=\"_self\" >".$lang_mainmenu25."</a>";
$B_M .= "<ul>";
$B_M .= "<li><a href=\"./import_csv.php?action=specify\" target=\"_self\">".$lang_mainmenu61."</a></li>";
$B_M .= "<li><a href=\"./phonetics.php\" target=\"_self\">".$lang_mainmenu26."</a></li>";
$B_M .= "<li><a href=\"./usage_category.php\" target=\"_self\">".$lang_mainmenu27."</a></li>";
$B_M .= "<li><a href=\"./sources.php\" target=\"_self\">".$lang_mainmenu28."</a></li>";
$B_M .= "<li><a href=\"./dev_info.php\" target=\"_self\">".$lang_mainmenu29."</a></li>";
$B_M .= "<li><a href=\"./message.php\" target=\"_self\">".$lang_mainmenu30."</a></li>";
$B_M .= "<li><a href=\"./todo.php\" target=\"_self\">".$lang_mainmenu31."</a></li>";
if ($_SESSION["rights"]==1) {
$B_M .= "<li><a href=\"./fileprint.php\" target=\"_self\">".$lang_mainmenu32."</a></li>";
} else {
$B_M .= "<li class=\"inactive\"><a href=\"./fileprint.php\" target=\"_self\">".$lang_mainmenu32."</a></li>";	
}
if ($_SESSION["rights"]==1) {
$B_M .= "<li><a href=\"./admin_settings.php\" target=\"_self\">".$lang_mainmenu33."</a></li>";
} else {
$B_M .= "<li class=\"inactive\"><a href=\"./admin_settings.php\" target=\"_self\">".$lang_mainmenu33."</a></li>";	
}
$B_M .= "</ul>";
$B_M .= "</li>";
$B_M .= "<li><a href=\"\" target=\"_self\" >".$lang_mainmenu34."</a>";
$B_M .= "<ul>";
$B_M .= "<li><a href=\"./user.php\" target=\"_self\">".$lang_mainmenu35."</a></li>";
$B_M .= "<li><a href=\"./listofusers.php\" target=\"_self\">".$lang_mainmenu36."</a></li>";
$B_M .= "<li><a href=\"./stats.php\" target=\"_self\">".$lang_mainmenu37."</a></li>";
$B_M .= "<li><a href=\"./last_queries.php\" target=\"_self\">".$lang_mainmenu62."</a></li>";
$B_M .= "<li><a href=\"./logout.php\" target=\"_self\" >".$lang_mainmenu38."</a>";
$B_M .= "</ul>";
$B_M .= "</li>";
$B_M .= "
<li><a href=\"\" target=\"_self\" >".$lang_mainmenu39."</a>
<ul>
<li><a href=\"./info.php\" target=\"_self\">".$lang_mainmenu40."</a></li>
<li><a href=\"./pron_info.php\" target=\"_self\">".$lang_mainmenu41."</a></li>
<li><a href=\"./pron_wow.php\" target=\"_self\">".$lang_mainmenu42."</a></li>
<li><a href=\"./pron_cons.php\" target=\"_self\">".$lang_mainmenu43."</a></li>
<li><a href=\"./pron_phonems.php\" target=\"_self\">".$lang_mainmenu44."</a></li>
<li><a href=\"./pron_gen.php\" target=\"_self\">".$lang_mainmenu45."</a></li>
<li><a href=\"./abb.php\" target=\"_self\">".$lang_mainmenu46."</a></li>
<li><a href=\"./abb.php?order=no\" target=\"_self\">".$lang_mainmenu47."</a></li>
<li><a href=\"./download.php\" target=\"_self\" >".$lang_mainmenu48."</a>
<li><a href=\"./authors.php\" target=\"_self\">".$lang_mainmenu49."</a></li>
<li><a href=\"./license.php\" target=\"_self\">".$lang_mainmenu50."</a></li>
</ul>
</li>";
$B_M .= "<li><a href=\"\" target=\"_self\" >".$lang_mainmenu51."</a>";
$B_M .= "<ul>";
$B_M .= "<li><a href=\"./dictionary_instructions.php\" target=\"_self\">".$lang_mainmenu52."</a></li>";
$B_M .= "<li><a href=\"./tips.php\" target=\"_self\">".$lang_mainmenu53."</a></li>";
$B_M .= "<li><a href=\"./download/manual-".$_SESSION["lang"]."-Dictionary-System-DWS.pdf\">".$lang_mainmenu54."</a></li>";
$B_M .= "<li><a href=\"./manual_edit_guide.php\" target=\"_self\" >".$lang_mainmenu55."</a>";
$B_M .= "</ul>";
$B_M .= "</li>";
$B_M .= "</ul>";
$B_M .= "</div>";
$MAIN_MENU = $B_M_R.$B_M;
} else {
$BUFFER_MAIN_MENU .= "	
<li><a href=\"\" target=\"_self\" >".$lang_mainmenu39."</a>
<ul>
<li><a href=\"./info.php\" target=\"_self\">".$lang_mainmenu40."</a></li>
<li><a href=\"./dictionary_instructions.php\" target=\"_self\">".$lang_mainmenu52."</a></li>
<li><a href=\"./tips.php\" target=\"_self\">".$lang_mainmenu53."</a></li>
</ul>
</li>
<li><a href=\"\" target=\"_self\" >".$lang_mainmenu56."</a>
<ul>
<li><a href=\"./pron_info.php\" target=\"_self\">".$lang_mainmenu41."</a></li>
<li><a href=\"./pron_wow.php\" target=\"_self\">".$lang_mainmenu42."</a></li>
<li><a href=\"./pron_cons.php\" target=\"_self\">".$lang_mainmenu43."</a></li>
<li><a href=\"./pron_phonems.php\" target=\"_self\">".$lang_mainmenu44."</a></li>
<li><a href=\"./pron_gen.php\" target=\"_self\">".$lang_mainmenu45."</a></li>
<li><a href=\"./play.php\" target=\"_self\">".$lang_mainmenu57."</a></li>
</ul>
</li>
<li><a href=\"\" target=\"_self\" >".$lang_mainmenu58."</a>
<ul>
<li><a href=\"./abb.php\" target=\"_self\">".$lang_mainmenu46."</a></li>
<li><a href=\"./abb.php?order=no\" target=\"_self\">".$lang_mainmenu47."</a></li>
<li><a href=\"./sources.php\" target=\"_self\">".$lang_mainmenu28."</a></li>
</ul>
</li>
<li><a href=\"./download.php\" target=\"_self\" >".$lang_mainmenu48."</a>
</li>
<li><a href=\"\" target=\"_self\" >".$lang_mainmenu59."</a>
<ul>
<li><a href=\"./authors.php\" target=\"_self\">".$lang_mainmenu49."</a></li>
<li><a href=\"./license.php\" target=\"_self\">".$lang_mainmenu50."</a></li>
</ul>
</li>
<li><a href=\"./login.php\" target=\"_self\" >".$lang_mainmenu60."</a>
</li>
</ul></div>";
$MAIN_MENU = $B_M_R.$BUFFER_MAIN_MENU; 
} 
if ($_SESSION["ses_message"]!='') {
$MAIN_MENU .=  '<br><p>';
$MAIN_MENU .=  '<span class="ses_message"> '.$_SESSION["ses_message"].'</span><br>';
$MAIN_MENU .= '</p>';
$_SESSION["ses_message"]='';
}
?>
