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
if ($_GET["m"]=='dec_add') {
$_SESSION["ses_message"]=$lang_dec_mes1;	
}
if ($_GET["m"]=='dec_edit') {
$_SESSION["ses_message"]=$lang_dec_mes2;	
}
if ($_GET["m"]=='dec_del') {
$_SESSION["ses_message"]=$lang_dec_mes3;	
}
if ($_GET["m"]=='del_meaning') {
$_SESSION["ses_message"]=$lang_dec_mes4;	
}
if ($_GET["m"]=='del_complete') {
$_SESSION["ses_message"]=$lang_dec_mes5;
}
if ($_GET["m"]=='del_m_s') {
$_SESSION["ses_message"]=$lang_dec_mes6;
}
if (isset($_POST["search_string"])) {
if ($_POST["search_string"]=='') {
$special_empty=TRUE; // show start page with random headwords - search string was empty
}  
$key= $_POST["search_string"];	
$_SESSION["post_h"]= $_POST["search_string"];
$_SESSION["post_p"]=1;
$_SESSION["post_m"]=$_POST["post_m"];
$_SESSION["post_f"]=$_POST["adv_field"];
} else 	{
$key= $_SESSION["post_h"];		
}
if (isset($_GET["d_h"])) {
$_SESSION["d_h"]=$_GET["d_h"];
$_SESSION["d_h_n"]= $_GET["d_h_n"];
}
if (($_SESSION["d_h"]=='') AND (!isset($_POST["search_string"]))) {
$special_empty=TRUE; // show start page with random headwords - session probably expired	
}
if((isset($_POST["mode_lang"])) AND ($_POST["mode_lang"]!="")){
$_SESSION["mode_lang"]=$_POST["mode_lang"];
}else{
if($_GET["list_mode_lang"]!=''){
$_SESSION["mode_lang"] = $_GET["list_mode_lang"];
} else {
if(isset($_SESSION["mode_lang"])){
}else{
$_SESSION["mode_lang"] = "is-cz";
}}}
if ($_SESSION["list_kind"]=='') {
$_SESSION["list_kind"]="users";	
}
if ($_GET["list_kind"]=="users") {
$_SESSION["list_kind"]="users";		
} else if ($_GET["list_kind"]=="alpha") {
$_SESSION["list_kind"]="alpha";	
}
if ($_SESSION["mode"]=='') {
$_SESSION["mode"]='1';
}
$dict = 'ds_2_senses';
$dict_keyword = 'ds_1_headword';
if ($_SESSION["word_form_show"]=='') {
$_SESSION["word_form_show"]='1';
}
if ($_SESSION["word_order_show"]=='') {
$_SESSION["word_order_show"]='2';
}
if ($_SESSION["long_dec_show"]=='') {
$_SESSION["long_dec_show"]='2';
}
if ($_GET["long_dec"]=='true') {
if ($_SESSION["long_dec_show"]=='1') {
$_SESSION["long_dec_show"]='2';
$_SESSION["ses_message"]=$lang_dec_mes7;	
}
else {$_SESSION["long_dec_show"]='1';
$_SESSION["ses_message"]=$lang_dec_mes8;
} }
if ($_GET["word_form_show"]=='true') {
if ($_SESSION["word_form_show"]=='1') {$_SESSION["word_form_show"]='2';}
else {$_SESSION["word_form_show"]='1';} }
if ($_GET["word_order_show"]=='true') {
if ($_SESSION["word_order_show"]=='1') {$_SESSION["word_order_show"]='2';}
else {$_SESSION["word_order_show"]='1';} }
if ($_GET["recreate"]=='recreate_list') {
if (isset($_SESSION["post_h"]) AND ($_SESSION["post_h"]!='')) {
	$_SESSION["list_kind"]='user';
$location = 'Location: ./search.php?action=find&post_h='.$_SESSION["post_h"].'&pagenum='.$_SESSION["post_p"].'&post_m='.$_SESSION["post_m"].'&post_f='.$_SESSION["post_f"];
} else {
$location = 'Location: ./search.php?list_kind=alpha';		
}
header($location);	
}
if ($_GET["action"]=='change_order') {
//php lock
$dict_keyword = 'ds_1_headword';
$oop_lock = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$sql = sprintf ('SELECT `LOCK_KEY`, `LOCK_EXPIRY_TIME` FROM `%s` WHERE `keyword` = %s AND `num_keyword` = %s',
	$dict_keyword,					
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]));
$oop_lock->Setnames();							
$oop_lock->query($sql);
$lock= $oop_lock->fetchRow ();
$oop_lock->freeResult();
$time_now=date("Y-m-d H:i:s");
if ($lock[0]!=0) {
if ($_SESSION["id_user"]!=$lock[0]) {
if ($lock[1]>=$time_now) {
$_SESSION["ses_message"].=$lang_lock1.$lock[1];
$location = 'Location: ./search.php?list_kind=alpha&amp;d_h='.$_GET["d_h"].'&amp;d_h_n='.$_GET["d_h_n"].'';
header($location);
Die();
}}}
$sql = sprintf ('UPDATE `%s` SET `LOCK_KEY` = %s, `LOCK_EXPIRY_TIME` = ADDTIME(NOW(),"00:10:00") WHERE `keyword` = %s AND `num_keyword` = %s',
	$dict_keyword,					
	quate_smart($_SESSION["id_user"]),
	quate_smart($_GET["d_h"]),
	quate_smart($_GET["d_h_n"]));
$oop_lock->Setnames();							
$oop_lock->query($sql);
$oop_lock->freeResult();
$oop_lock->_mySQL;
//end php lock
$view_keyword=$_GET["d_h"];
$view_num_keyword=$_GET["d_h_n"];
$view_num_order=$_GET["num_order"];
$view_direction=$_GET["direction"];
$reorder=$_GET["reorder"];
$_SESSION["ses_message"].=$lang_dec_mes9;
include './scripts/change_order_script.php';
} else if ($_POST["submit_image"]) {
$biolib = 'ds_biolib_full';
$oop_start = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$ad=0;
foreach ($_SESSION["ids_image"] as $k => $value) {
$hh='image_'.$k.'_hidden';
$picture=$_POST[$hh];
$sql = sprintf ('UPDATE `%s` SET `status` = %s WHERE `id` = %s',
	$biolib,				
	quate_smart($picture),
	quate_smart($value));
$ad++;
$oop_start->Setnames();
$oop_start->query($sql);
$oop_start->FreeResult();
$oop_start->_mySQL;   
}
$location = 'Location: ./search.php?list_kind=alpha&d_h='.$_POST["keyword"].'&d_h_n='.$_POST["num_keyword"];
header($location);
}
include './head_s.php';
?>
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
<?php if ($_SESSION["login"]=='true') {?>
function Swap_image(id)
{
var items=document.getElementById(id).getAttribute("src").split("/");
if(items[items.length-1]=="dec_4.png")
{
document.getElementById(id).setAttribute("src","<?=$IMAGE_URL?>images/dec_2.png");
document.getElementById(id+"_hidden").value=10;
}
else
{
document.getElementById(id).setAttribute("src","<?=$IMAGE_URL?>images/dec_4.png")
document.getElementById(id+"_hidden").value=0;
}
}
<?php } ?>
</script>
<script type="text/javascript" src="<?=$IMAGE_URL?>scripts/thickbox-compressed.php"></script>
<?php if ($_SESSION["login"]!='true') {?>
<script type="text/javascript" src="<?=$IMAGE_URL?>scripts/swfobject.js"></script>
<script type="text/javascript">
var flashvars = {};
var params = {};
var attributes = {};
swfobject.embedSWF("<?=$IMAGE_URL?>audio/audio-player/player.swf", "sound", "0", "0", "9.0.0", "", flashvars, params, attributes);
</script>
<?php } ?>
</head>
<body onload="setfocus ()">
<div id="wrapper">
<?php include 'header.php';
$BUFFER_SEARCH_PAGE.="<div id=\"content\">";

if ($special_empty!==TRUE){
if ($_SESSION["list_kind"]=='alpha') {
include './scripts/search_alpha_list.php';
include "./search_part2.php"; 
$BUFFER_SEARCH_PAGE.=" <div class=\"left\">";
$BUFFER_SEARCH_PAGE .= $BUFFER_ALPHA_LIST;

$BUFFER_SEARCH='';

$BUFFER_SEARCH_PAGE .= " </div>";
$BUFFER_SEARCH_PAGE .=  "<div class=\"left_huge\">";
if ($special_empty!==TRUE){
$BUFFER_SEARCH_PAGE .= $BUFFER_SEARCH2;
} 
} else {
$BUFFER_SEARCH_PAGE.=" <div class=\"left_huge\">";
$BUFFER_SEARCH_PAGE .= '<div class="search_1column">';
include "./scripts/search_word_form_list.php"; 
include "./search_part1.php"; 
$BUFFER_SEARCH_PAGE .= $BUFFER_SEARCH;
$BUFFER_SEARCH_PAGE .= '</div>';
$BUFFER_SEARCH_PAGE .= '<div class="search_2column">';

$BUFFER_SEARCH_PAGE .= $message_list_word_form;
$BUFFER_SEARCH_PAGE .= '</div>';
}


} else {
include './scripts/start_tips.php';
}
$search_page=TRUE;
include 'menu.php';
echo $MAIN_MENU;
if ($special_empty!==TRUE){
echo $BUFFER_SEARCH_PAGE;
} else {
echo "<div id=\"content\">";
echo $buffer_tips2;
echo " <div class=\"left_huge\">";
echo $buffer_tips;
}
// if was found exactly one headword in search, to show list
if (($found_now===TRUE) AND ($special_empty!==TRUE)) {
include './scripts/search_alpha_list.php';
$found_now=false;	  
}
if ($special_empty!==TRUE) {
// show alpha list if session is on and 
if ($_SESSION["list_kind"]=='alpha') {
//echo $BUFFER_ALPHA_LIST;
} else {
if ($not_found_word_form!==TRUE) {
// show results of word form match
//echo $message_list_word_form;
}
}
// show results of users search
//echo $BUFFER_SEARCH;
$BUFFER_SEARCH='';
}

$BUFFER_SEARCH_PAGE .= " </div>";
?> 
</div>
</div>
<div style="clear:both;"> 
</div>
<div id="footer">
<?=$lang_footer;?>
</div></div><?php 
include ('./html_end.php');
?>