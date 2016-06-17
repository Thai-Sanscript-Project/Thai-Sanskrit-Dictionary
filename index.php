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
include './head_s.php';
?>
<script type="text/javascript" src="<?=$IMAGE_URL?>scripts/swfobject.js"></script>
<script type="text/javascript">
var flashvars = {};
var params = {};
var attributes = {};
swfobject.embedSWF("<?=$IMAGE_URL?>audio/audio-player/player.swf", "sound", "0", "0", "9.0.0", "", flashvars, params, attributes);
</script>
</head>
<body onload="setfocus ()">
<div id="wrapper">
<?php include 'header.php'; ?>
<?php include 'menu.php'; 
$BUFFER_SEARCH_PAGE.="<div id=\"content\">";
//$BUFFER_SEARCH_PAGE.=" <div class=\"left\">";
//if (($_SESSION["rights"]==1) OR ($_SESSION["rights"]==2))  {
//if ($_SESSION["list_kind"]=='alpha') {
//include './scripts/search_alpha_list.php';
//}}
echo $MAIN_MENU ;
echo $BUFFER_SEARCH_PAGE;
echo $BUFFER_ALPHA_LIST;
//echo " </div>";
echo "<div class=\"left_huge\">";
?>
<h2><?=$lang_menu_search2;?></h2>
<?php if (($_SESSION["rights"]==1) OR ($_SESSION["rights"]==2))  {
?><p>
<?=$lang_index1?>
<br>
<div class="search_1column">
<?php
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
//spam notice for administrator
if ($_SESSION["rights"]==1) {?>
<h4><?=$lang_spamnotice?></h4>
<?php
$table=  'ds_spam_notice';
$sql = sprintf ('SELECT * FROM `%s` ORDER BY `date` DESC LIMIT 0,3',
	$table);
$oop->Setnames();
$oop->query($sql);	
while ($returned = $oop->fetchRow ()):
$count++;
echo '<span class="info_message"> '.$returned[1].'</span>';
echo '<br>';
echo '<span class="italic2"> '.$returned[2].'</span><br><br>';
endwhile;
$oop->freeResult();
}?>
<h4><?=$lang_message_info?></h4>
<?php
$table=  'ds_message';
$sql = sprintf ('SELECT * FROM `%s` ORDER BY `date` DESC',
	$table);
$oop->Setnames();
$oop->query($sql);	
while ($returned = $oop->fetchRow ()):
$count++;
echo '<span class="info_message"> '.$returned[3].'</span>';
echo '<strong><span class="pos">'.$returned[2].'</span></strong><br>';
echo '<span class="italic2"> '.$returned[4].'</span><br><br>';
endwhile;
$oop->freeResult();
?> 
</div>
<div class="search_2column">
<h4><?=$lang_index2?></h4>
<?php
$table=  'ds_dev_info';
$sql = sprintf ('SELECT * FROM `%s` ORDER BY `date` DESC',
	$table);
$oop->Setnames();
$oop->query($sql);	
while ($returned = $oop->fetchRow ()):
echo '<span class="info_message"> '.$returned[2].'</span>';
echo '<strong><span class="pos">'.$returned[1].'</span></strong><br>';
echo '<span class="italic2"> '.$returned[3].'</span><br><br>';
endwhile;
$oop->freeResult();
$oop->_mySQL; 
?>
</div>
</p> <?php
} else { 
echo $lang_info_1_new;
echo "<br><br>";
echo $lang_info_1_thanks;?>
<h4><?=$lang_index3?></h4>
<?php
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$table=  'ds_dev_info';
$sql = sprintf ('SELECT * FROM `%s` ORDER BY `date` DESC LIMIT 0,5',
	$table);
$oop->Setnames();
$oop->query($sql);	
while ($returned = $oop->fetchRow ()):
echo '<span class="info_message"> '.$returned[2].'</span>';
echo '<strong><span class="pos">'.$returned[1].'</span></strong><br>';
echo '<span class="italic2"> '.$returned[3].'</span><br><br>';
endwhile;
$oop->freeResult();
$oop->_mySQL; 
?>
<?php } ?>
<div id="sound">
<br>
<a href="http://www.adobe.com/go/getflashplayer"> <?=$lang_information_flash?> <br>
<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player">
</a>
</div>
</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div>
</div>
<?php 
include ('./html_end.php');
?>