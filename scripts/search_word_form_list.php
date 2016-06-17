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
$not_found_word_form=false;
if ($_SESSION["post_f"]=='keyword') {
$message_list_word_form.= "<span class=\"headings_result\">".$lang_search_word_form." ".$key."</span><br>";
$oop_sub = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop_sub2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$found_form=FALSE;
$table_keyword='ds_1_headword';
$ccc=0;
$table_wordform='ds_wordform';
$sql_sub = sprintf ('SELECT * FROM `%s` WHERE `word_form` COLLATE `%s` = %s',
	$table_wordform,
	$collation_1,
	quate_smart($key));
$oop_sub->Setnames();
$oop_sub->query($sql_sub);
$num99=0;
$num99 = $oop_sub->getNumRows();
if ($num99!=0) {
while($returned_sub = $oop_sub->fetchRow ()) :
$found_form=TRUE; $ccc++;
$first_wordform_keyword=$returned_sub[1];
$first_wordform_num_keyword=$returned_sub[2];
$sql_sub2 = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table_keyword,
	$collation_1,
	quate_smart($returned_sub[1]),
	quate_smart($returned_sub[2]));
$oop_sub2->Setnames();
$oop_sub2->query($sql_sub2);
$returned_sub2 = $oop_sub2->fetchArray ();
$oop_sub2->FreeResult();
if ($returned_sub[2]==0) {
$message_list_word_form.= "<a href=\"search.php?list_kind=alpha&amp;d_h=".$returned_sub[1]."&amp;d_h_n=".$returned_sub[2]."\"><span class=\"e7\">".$returned_sub[1]."</span>";
} else {
$message_list_word_form.= "<a href=\"search.php?list_kind=alpha&amp;d_h=".$returned_sub[1]."&amp;d_h_n=".$returned_sub[2]."\"><span class=\"e7\"><sup>".$returned_sub[2]."</sup>".$returned_sub[1]."</span>";	
}
if ($returned_sub[2]==0) {
$message_list_word_form.= "</a><br>";
} else {
$message_list_word_form.= " <span class=\"e4\">".$returned_sub2[7]."</a><br>";	
}
endwhile;
}
$oop_sub->FreeResult();
// at last we search in dict keyword other word groups then adj, n, f, m, v, pron, adv / 
// for exaple adv in basic form
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s',
	$dict_keyword,
	$collation_1,
	quate_smart($key));
$oop_sub2->Setnames();
$oop_sub2->query($sql);
while($returned_sub = $oop_sub2->fetchRow ()) :
$found_form=TRUE;
if (($returned_sub[7]!='adj') AND ($returned_sub[7]!='n') AND ($returned_sub[7]!='pron') AND ($returned_sub[7]!='f') AND ($returned_sub[7]!='m') AND ($returned_sub[7]!='v') AND ($returned_sub[7]!='adv')) {
if ($returned_sub[2]==0) {
$message_list_word_form.= "<a href=\"search.php?list_kind=alpha&amp;d_h=".$returned_sub[1]."&amp;d_h_n=".$returned_sub[2]."\"><span class=\"e7\">".$returned_sub[1]."</span>";
} else {
$message_list_word_form.= "<a href=\"search.php?list_kind=alpha&amp;d_h=".$returned_sub[1]."&amp;d_h_n=".$returned_sub[2]."\"><span class=\"e7\"><sup>".$returned_sub[2]."</sup>".$returned_sub[1]."</span>";	
}
if ($returned_sub[2]==0) { 
$message_list_word_form.= "</a><br>";
} else {
$message_list_word_form.= " <span class=\"e4\">".$returned_sub[7]."</a><br>";	
}
}
endwhile;
$oop_sub2->FreeResult();
$oop_sub->_mySQL;
$oop_sub2->_mySQL;
if ($ccc==0) {
$not_found_word_form=TRUE;
$message_list_word_form.='<span class="pos"><br>'.$lang_wordform_notfound.'</span>';	
}
$message_list_word_form.= '<br>';
$view_keyword=$_GET["d_h"];
$view_num_keyword=$_GET["d_h_n"];
} else {
$message_list_word_form='';
$ccc==2;
}
?>
