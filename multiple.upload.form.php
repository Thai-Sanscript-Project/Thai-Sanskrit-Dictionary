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
$oop4 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop5 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$c=1;
if ($_GET["action"]=='del') {
if ($_GET["loss"]=='true') {
if ($_GET["a"]=='image') {
$table='ds_images';
$uploadsDirectory = $con_uploadsDirectory;
$sql4 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`= %s AND `name_of_file`= %s',
					$table,
					$collation_1,
					quate_smart($_GET["d_h"]),
					quate_smart($_GET["d_h_n"]), 					
					quate_smart($_GET["name_of_file"]));
$_SESSION["ses_message"]=$lang_upload8;
}
else if ($_GET["a"]=='sound') {
$table='ds_sound';
$uploadsDirectory = $sound_uploadsDirectory;
$sql4 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`= %s AND `sound`= %s',
					$table,
					$collation_1,
					quate_smart($_GET["d_h"]),
					quate_smart($_GET["d_h_n"]), 					
					quate_smart($_GET["name_of_file"]));
$_SESSION["ses_message"]=$lang_upload9;
}
$oop4->Setnames();
$oop4->query($sql4);
$oop4->freeResult();
// only if its unique file, otherwise it can belong to other headwords
if ($_GET["con"]!="only_from_table") {
$myFile = $uploadsDirectory.$_GET["name_of_file"];
unlink($myFile);
}
if ($_GET["a"]=='image') {
$myFile2 = $uploadsDirectory.'th_'.$_GET["name_of_file"];
unlink($myFile2);
} else if ($_GET["a"]=='sound') {
}

$location = 'Location: ./search.php?list_kind=alpha&d_h='.$_GET["d_h"].'&d_h_n='.$_GET["d_h_n"].'';
header($location);
	} else {
?>
<?php
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
             </script>
<script type="text/javascript" src="<?=$IMAGE_URL?>/scripts/thickbox-compressed.php"></script>
</head>
<body onload="setfocus ()">
<div id="wrapper">
<?php include 'header.php'; ?>
<?php 
include 'menu.php'; 
echo $MAIN_MENU;
?>
<div id="content">
<div class="left_huge">
<h2><?=$lang_menu_search2;?></h2>
<?php 
if ($_GET["a"]=='image') {   ?>
<p>
<?=$lang_upload1?> <?php echo $_GET["name_of_file"]; ?>?<br>
<br>
<?php
echo "<a href=\"./multiple.upload.form.php?action=del&amp;loss=true&amp;a=".$_GET["a"]."&amp;d_h=".$_GET["d_h"]."&amp;d_h_n=".$_GET["d_h_n"]."&amp;name_of_file=".$_GET["name_of_file"]."\"> ".$lang_submit_yes." </a>";
echo "<a href=\"./search.php?list_kind=alpha&amp;d_h=".$_GET["d_h"]."&amp;d_h_n=".$_GET["d_h_n"]."\"> ".$lang_submit_no." </a>";
echo '<br> <br>';
echo '<div class="main_entry_little">';
echo "<a href=\"".$IMAGE_URL."images/uploaded_files/".$_GET["name_of_file"]."\" class=\"thickbox\"><img src=\"".$IMAGE_URL."images/uploaded_files/th_".$_GET["name_of_file"]."\"  border=\"0\" alt=\"Single Image\"></a> ";
echo '</div>';
      }  if ($_GET["a"]=='sound') {?>
<p>
 <?=$lang_upload2?> <?php echo $_GET["name_of_file"]; ?>?<br>
<br>
<?php
// check if not the same file for homonyme headwors
if ($_SESSION["d_h_n"]!=0) {
$table='ds_sound';
$sql4 = sprintf ('SELECT `sound` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND NOT `num_keyword`= %s',
			$table,
			$collation_1,
			quate_smart($_GET["d_h"]),
			quate_smart($_GET["d_h_n"])); 
$oop4->Setnames();
$oop4->query($sql4);
$found_identic_file=FALSE;
while ($sound = $oop4->fetchArray ()):
if ($sound[0]==$_GET["name_of_file"]) {
$found_identic_file=TRUE;	
}
endwhile;
$oop4->freeResult();
}
if ($found_identic_file===TRUE) {
$con="only_from_table";
} else {
$con="";
}
echo "<a href=\"./multiple.upload.form.php?action=del&amp;loss=true&amp;a=".$_GET["a"]."&amp;d_h=".$_GET["d_h"]."&amp;d_h_n=".$_GET["d_h_n"]."&amp;name_of_file=".$_GET["name_of_file"]."&amp;con=".$con."\"> ".$lang_upload3." </a>";
echo "<a href=\"./search.php?list_kind=alpha&amp;d_h=".$_GET["d_h"]."&amp;d_h_n=".$_GET["d_h_n"]."\"> ".$lang_upload4." </a>";
echo '<br> <br>';      
$rr_count=1; 	      
clearstatcache();
$file = $IMAGE_URL."audio/uploaded_files/".$_GET["name_of_file"];
$final_file=$file;
echo "<span id=\"audioplayer_".$rr_count."\"></span>";  
echo "<script type=\"text/javascript\">";
echo "AudioPlayer.embed(\"audioplayer_".$rr_count."\", {soundFile: \"".$final_file."\",titles: \"".$_GET["d_h"]."\"});</script> ";
}}} else {
?>
<?php
include './head.php';
?>
<body onload="setfocus ()">
<div id="wrapper">
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<?php
echo $MAIN_MENU;
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
// make a note of the location of the upload handler
$uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'multiple.upload.processor.php?a='.$_GET["a"].'&d_h='.$_GET["d_h"].'&d_h_n='.$_GET["d_h_n"].'';
// set a max file size for the html upload form
if ($_GET["a"]=='image') {
$max_file_size = 3000000; // size in bytes
} else if ($_GET["a"]=='sound') {
$max_file_size = 3000000; // size in bytes
}
// now echo the html page
?>
<form id="Upload" action="<?php echo $uploadHandler ?>" enctype="multipart/form-data" method="post">
<div id="content">
<div class="left_huge">
<h2><?=$lang_upload5?></h2>
<div class="menu_sub">
<ul>
<li><input type="submit" id="submit"  class="button3" name="submit" value="<?=$lang_record?>">
</li>
<?php 
$return_address= "<a href=\"./search.php?list_kind=alpha&amp;d_h=".$_GET["d_h"]."&amp;d_h_n=".$_GET["d_h_n"]."\" target=\"_self\">";
?>
<li><?=$return_address?><?=$lang_upload6?></a></li> 
</ul>
</div>
<br>

<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size ?>">
<input type="hidden" name="keyword" value="<?=$_GET["d_h"]?>">
<input type="hidden" name="num_keyword" value="<?=$_GET["d_h_n"]?>">

<table class="sample">
<tr>
<td>
<label for="file1"><?=$lang_upload7?></label></td>
<td>
<input id="file1" type="file" name="file[]"></td>
</tr>
<tr>
<td>
<?=$lang_img2?></td><td><input type="text" class="inputbox" name="author" size="20" maxlength="80" value=""></td></tr>
<tr>
<td><?=$lang_img3?></td><td><input type="text" class="inputbox" name="licence" size="20" maxlength="80" value=""><br></td>
</tr>
</table>
</form>
<?php } $oop4->_mySQL;	?>
</p>
<br>
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