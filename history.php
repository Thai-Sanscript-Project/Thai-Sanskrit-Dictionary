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
$dict_history = 'ds_history';
$dict_keyword = 'ds_1_headword';
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
<h2><?=$lang_history1?></h2>
<div class="menu_sub">
<ul>
<li>
<li><a href="./edit.php?d_h=<?=$_GET["d_h"]?>&d_h_n=<?=$_GET["d_h_n"]?>"><?=$lang_history_goback?></a></li>
<li><a href="./search.php?list_kind=alpha&d_h=<?=$_GET["d_h"]?>&d_h_n=<?=$_GET["d_h_n"]?>"><?=$lang_history_goback_search?></a></li>
</li>
</ul>
</div>  
<?php
if ($_GET["action"] == 'print') {
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$sql = sprintf ('SELECT * FROM `%s` WHERE `keyword`=%s AND `num_keyword`=%s ORDER BY `time` DESC',
	$dict_history,
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"])); 
$oop->Setnames();
$oop->query($sql);
$num = $oop->getNumRows();
if ($num==0) {
echo $lang_history2;
}
while($row = $oop->fetchRow ()) :
$table=  'ds_users';
$sql = sprintf ('SELECT * FROM `%s` WHERE `id_user` = %s',
	$table,
	quate_smart($row[2]));
$oop2->Setnames();
$oop2->query($sql);
$row4 = $oop2->fetchRow ();
$oop2->freeResult();
echo "<br>"; 
echo $row[1].' '.$row4[1].'<br>';
echo ' '.$row[5].'<br>';
endwhile; 
$oop->freeResult();
$oop2->_mySQL;
$oop->_mySQL; 
echo "</div>";

}
if ($_GET["action"] == 'save') {
$keyword_work=$_GET["d_h"];
$num_keyword_work=$_GET["d_h_n"];
$view_keyword=$_GET["d_h"];
$view_num_keyword=$_GET["d_h_n"];
$page_id=519; 
include './work.php';
$history=TRUE;
include './scripts/view_word_br_hvalur.php';
$history=FALSE;
$_SESSION["save_history"]=FALSE;
$dict = 'ds_2_senses';
$dict_history = 'ds_history';
$dict_keyword = 'ds_1_headword';
$oop1save = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop2save = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$sql = sprintf ('SELECT `text` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`= %s ORDER BY `time` DESC',
	$dict_history,
	$collation_1,
	quate_smart($_SESSION["d_h"]),
	quate_smart($_SESSION["d_h_n"])); 
$oop1save->Setnames();
$oop1save->query($sql);
$count=0; $tt=0;
$num3 = $oop1save->getNumrows(); 
if ($num3==0) {
$_SESSION["ses_message"]=$lang_history_1;
$_SESSION["ses_message"].="<a href=\"history.php?action=print&d_h=". $_GET["d_h"]. "&d_h_n=".$_GET["d_h_n"]."&save_history=FALSEpost_h=".$_GET["post_h"]."\"> ".$lang_history_2.$_GET["d_h"]." </a>";
$tt++;
$sql_word = sprintf ('INSERT INTO `%s` (`id`, `time`, `user`, `keyword`, `num_keyword`, `text`) VALUES (NULL, %s, %s, %s, %s, %s)',
       $dict_history,
	quate_smart(date("Y-m-d H:i:s")),
	quate_smart($_SESSION["id_user"]),
	quate_smart($_SESSION["d_h"]),
	quate_smart($_SESSION["d_h_n"]),
	quate_smart($BUFFER_VIEW_KEYWORD)); 
$oop2save->Setnames();
$oop2save->query($sql_word);
$oop2save->freeResult();
} else {
while($row = $oop1save->fetchRow ()) :
if (($row[0]!= $BUFFER_VIEW_KEYWORD) AND ($count==0)) { 
$_SESSION["ses_message"]=$lang_history_1.' ';
$_SESSION["ses_message"].="<a href=\"history.php?action=print&d_h=". $_GET["d_h"]. "&d_h_n=".$_GET["d_h_n"]."&save_history=FALSE\">".$lang_history_2.$_GET["d_h"]." </a>";
$tt++;
$sql_word = sprintf ('INSERT INTO `%s` (`id`, `time`, `user`, `keyword`, `num_keyword`, `text`) VALUES (NULL, %s, %s, %s, %s, %s)',
       $dict_history,
       quate_smart(date("Y-m-d H:i:s")),
	quate_smart($_SESSION["id_user"]),
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]),
	quate_smart($BUFFER_VIEW_KEYWORD)); 
$oop2save->Setnames();
$oop2save->query($sql_word);
$oop2save->freeResult();
}
$count++;
endwhile;
}
$oop1save->freeResult();
$oop2save->_mySQL;
$_SESSION["d_h"]=$_GET["d_h"];
$_SESSION["d_h_n"]=$_GET["d_h_n"];
$view_keyword=$_SESSION["d_h"];
$view_num_keyword=$_SESSION["d_h_n"];
// call special script that fills the words in compound field
include './scripts/view_words_in_compound_br.php';
$dict_keyword = 'ds_1_headword';
$lock_key=0;
$lock_expiry_time="0000-00-00 00:00:00";
//php set new lock
$sql = sprintf ('UPDATE `%s` SET `LOCK_KEY` = %s, `LOCK_EXPIRY_TIME` = %s WHERE `keyword` = %s AND `num_keyword` = %s',
	$dict_keyword,					
	quate_smart($lock_key),
	quate_smart($lock_expiry_time),
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]));
$oop1save->Setnames();							
$oop1save->query($sql);
$oop1save->freeResult();
$oop1save->_mySQL; 

$location = "Location: ./search.php?list_kind=alpha&d_h=".$_GET["d_h"]."&d_h_n=".$_GET["d_h_n"]."";
header($location);
}
?>

</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div>
<?php 
include ('./html_end.php');
?>