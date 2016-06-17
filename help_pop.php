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
include './start.php';
$dir  = "./language/";
$dir_path = $dir.$_SESSION["lang"]."/lang_help.php";
include ($dir_path);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$lang_header_dict;?></title>
<link rel="shortcut icon" href="favicon.ico">
<meta name="description" content="<?=$lang_head_description?>">
<meta name="keywords" content="<?=$lang_head_content?>">
<meta name="author" content="<?=$lang_head_author?>">
<meta http-equiv="X-UA-Compatible" content="IE=7">
<link rel="stylesheet" type="text/css" title="hvalur" href="style_popup.css">	  
<script type="text/javascript">	
function setfocus() {
document.form1.search_string.focus();
}
function popitup(url) {
newwindow=window.open(url,'name','height=400,width=800, scrollbars=yes');
if (window.focus) {newwindow.focus()}
return false;
}
</script>
<script type="text/javascript" src="<?=$IMAGE_URL?>scripts/jquery-latest.pack.js"></script>
</head>
<body>
<h2><?=$lang_popup_help2?></h2>
<?php
if ($_GET["num_subtitle"]=='1') {
echo $lang_int_1;
} else if ($_GET["num_subtitle"]=='2') {
	echo "<h4>".$lang_int_2_title."</h4>";
	echo $lang_int_2;
	
} else if ($_GET["num_subtitle"]=='3') {
	echo "<h4>".$lang_int_3_title."</h4>";
	echo $lang_int_3;
} else if ($_GET["num_subtitle"]=='4') {
	echo "<h4>".$lang_int_24_title."</h4>";
	echo $lang_int_4;
} else if ($_GET["num_subtitle"]=='5') {
	echo "<h4>".$lang_int_5_title."</h4>";
	echo $lang_int_5;
} else if ($_GET["num_subtitle"]=='6a') {
	echo "<h4>".$lang_int_6a_title."</h4>";
	echo $lang_int_6a;
} else if ($_GET["num_subtitle"]=='6b') {
	echo "<h4>".$lang_int_6b_title."</h4>";
	echo $lang_int_6b;
} else if ($_GET["num_subtitle"]=='7') {
	echo "<h4>".$lang_int_7_title."</h4>";
	echo $lang_int_7;
} else if ($_GET["num_subtitle"]=='8') {
	echo "<h4>".$lang_int_8_title."</h4>";
	echo $lang_int_8;
} else if ($_GET["num_subtitle"]=='9') {
	echo "<h4>".$lang_int_9_title."</h4>";
	echo $lang_int_9;
} else if ($_GET["num_subtitle"]=='10') {
	echo "<h4>".$lang_int_10_title."</h4>";
	echo $lang_int_10;
} else if ($_GET["num_subtitle"]=='11') {
	echo "<h4>".$lang_int_11_title."</h4>";
	echo $lang_int_11;
} else if ($_GET["num_subtitle"]=='12') {
	echo "<h4>".$lang_int_12_title."</h4>";
	echo $lang_int_12;
} else if ($_GET["num_subtitle"]=='13') {
	echo "<h4>".$lang_int_13_title."</h4>";
	echo $lang_int_13;
} else if ($_GET["num_subtitle"]=='14') {
	echo "<h4>".$lang_int_14_title."</h4>";
	echo $lang_int_14;
} else if ($_GET["num_subtitle"]=='15') {
	echo "<h4>".$lang_int_15_title."</h4>";
	echo $lang_int_15;
} else if ($_GET["num_subtitle"]=='16a') {
	echo "<h4>".$lang_int_16a_title."</h4>";
	echo $lang_int_16a;
} else if ($_GET["num_subtitle"]=='16b') {
	echo "<h4>".$lang_int_16b_title."</h4>";
	echo $lang_int_16b;
} else if ($_GET["num_subtitle"]=='16c') {
	echo "<h4>".$lang_int_16c_title."</h4>";
	echo $lang_int_16c;
} else if ($_GET["num_subtitle"]=='17a') {
	echo "<h4>".$lang_int_17a_title."</h4>";
	echo $lang_int_17a;
} else if ($_GET["num_subtitle"]=='17b') {
	echo "<h4>".$lang_int_17b_title."</h4>";
	echo $lang_int_17b;
} else if ($_GET["num_subtitle"]=='18') {
	echo "<h4>".$lang_int_18_title."</h4>";
	echo $lang_int_18;
} else if ($_GET["num_subtitle"]=='19') {
	echo "<h4>".$lang_int_19_title."</h4>";
	echo $lang_int_19;
} else if ($_GET["num_subtitle"]=='20') {
	echo "<h4>".$lang_int_20_title."</h4>";
	echo $lang_int_20;
} else if ($_GET["num_subtitle"]=='21') {
	echo "<h4>".$lang_int_21_title."</h4>";
	echo $lang_int_21;
} else if ($_GET["num_subtitle"]=='22') {
	echo "<h4>".$lang_int_22_title."</h4>";
	echo $lang_int_22;
} else if ($_GET["num_subtitle"]=='23') {
	echo "<h4>".$lang_int_23_title."</h4>";
	echo $lang_int_23;
} else if ($_GET["num_subtitle"]=='24') {
	echo "<h4>".$lang_int_24_title."</h4>";
	echo $lang_int_24;
} else if ($_GET["num_subtitle"]=='25') {
	echo "<h4>".$lang_int_25_title."</h4>";
	echo $lang_int_25;
} else if ($_GET["num_subtitle"]=='26') {
	echo "<h4>".$lang_int_26_title."</h4>";
	echo $lang_int_26;
} else if ($_GET["num_subtitle"]=='27') {
	echo "<h4>".$lang_int_27_title."</h4>";
	echo $lang_int_27;
} else if ($_GET["num_subtitle"]=='28') {
	echo "<h4>".$lang_int_28_title."</h4>";
	echo $lang_int_28;
} else if ($_GET["num_subtitle"]=='29a') {
	echo "<h4>".$lang_int_29a_title."</h4>";
	echo $lang_int_29a;
} else if ($_GET["num_subtitle"]=='29b') {
	echo "<h4>".$lang_int_29b_title."</h4>";
	echo $lang_int_29b;
} else if ($_GET["num_subtitle"]=='30') {
	echo "<h4>".$lang_int_30_title."</h4>";
	echo $lang_int_30;
} 
?>
</body>
</html>
