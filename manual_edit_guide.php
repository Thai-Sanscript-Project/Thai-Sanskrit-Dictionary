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
include './start.php';
?>
<?php include './head_s.php'; 
$dir  = "./language/";
$dir_path = $dir.$_SESSION["lang"]."/lang_help.php";
include ($dir_path);
?>
<script type="text/javascript" src="<?=$IMAGE_URL?>scripts/thickbox-compressed.php"></script>
</head>
<body onload="setfocus ()">
<div id="wrapper">
<?php include 'header.php'; ?>
<?php 
include 'menu.php'; ?>
<?php
echo $MAIN_MENU;
?>
<div id="content">
<div class="left_huge">
<h2><?=$lang_popup_help2?></h2>
<?php
echo "<div class=\"left_huge\">
<h2><a name=\"top\"></a>".$lang_di_title."</h2>
<div class=\"menu_sub\">
<ul>
<li><a href=\"\">".$lang_int_index1." </a>
<ul>
<li><a href=\"#1_guide\">1. ".$lang_int_1_title."</a></li>
<li><a href=\"#2_guide\">2. ".$lang_int_2_title."</a></li>
<li><a href=\"#3_guide\">3. ".$lang_int_3_title."</a></li>
<li><a href=\"#4_guide\">4. ".$lang_int_4_title."</a></li>
<li><a href=\"#5_guide\">5. ".$lang_int_5_title."</a></li>
<li><a href=\"#6_guide\">6. ".$lang_int_6a_title."</a></li>
<li><a href=\"#7_guide\">7. ".$lang_int_6b_title."</a></li>
<li><a href=\"#8_guide\">9. ".$lang_int_30_title."</a></li>
<li><a href=\"#9_guide\">8. ".$lang_int_7_title."</a></li>
<li><a href=\"#10_guide\">10. ".$lang_int_8_title."</a></li>
<li><a href=\"#11_guide\">11. ".$lang_int_9_title."</a></li>
<li><a href=\"#12_guide\">12. ".$lang_int_10_title."</a></li>
<li><a href=\"#13_guide\">13. ".$lang_int_11_title."</a></li>

</ul>
</li>
<li><a href=\"\">".$lang_int_index2." </a>
<ul>
<li><a href=\"#14_guide\">14. ".$lang_int_12_title."</a></li>
<li><a href=\"#15_guide\">15. ".$lang_int_13_title."</a></li>
<li><a href=\"#16_guide\">16. ".$lang_int_14_title."</a></li>
<li><a href=\"#17_guide\">17. ".$lang_int_15_title."</a></li>
<li><a href=\"#18_guide\">18. ".$lang_int_16a_title."</a></li>
<li><a href=\"#19_guide\">19. ".$lang_int_16b_title."</a></li>
<li><a href=\"#20_guide\">20. ".$lang_int_16c_title."</a></li>
<li><a href=\"#21_guide\">21. ".$lang_int_17a_title."</a></li>
<li><a href=\"#22_guide\">22. ".$lang_int_17b_title."</a></li>
<li><a href=\"#23_guide\">23. ".$lang_int_18_title."</a></li>
<li><a href=\"#24_guide\">24. ".$lang_int_19_title."</a></li>
<li><a href=\"#25_guide\">25. ".$lang_int_20_title."</a></li>
<li><a href=\"#26_guide\">26. ".$lang_int_21_title."</a></li>
<li><a href=\"#27_guide\">27. ".$lang_int_22_title."</a></li>
<li><a href=\"#28_guide\">28. ".$lang_int_23_title."</a></li>
<li><a href=\"#29_guide\">29. ".$lang_int_24_title."</a></li>
<li><a href=\"#30_guide\">30. ".$lang_int_25_title."</a></li>
<li><a href=\"#31_guide\">31. ".$lang_int_26_title."</a></li>
<li><a href=\"#32_guide\">32. ".$lang_int_27_title."</a></li>
<li><a href=\"#33_guide\">33. ".$lang_int_28_title."</a></li>
<li><a href=\"#34_guide\">34. ".$lang_int_29a_title."</a></li>
<li><a href=\"#35_guide\">35. ".$lang_int_29b_title."</a></li>

</ul>
</li>
</ul>
</div>";

echo "<a name=\"1_guide\"></a><h4>".$lang_int_1_title."</h4>";
echo $lang_int_1;
echo "<a name=\"2_guide\"></a><h4>".$lang_int_2_title."</h4>";
echo $lang_int_2;
echo "<a name=\"3_guide\"></a><h4>".$lang_int_3_title."</h4>";
echo $lang_int_3;
echo "<a name=\"4_guide\"></a><h4>".$lang_int_4_title."</h4>";
echo $lang_int_4;
echo "<a name=\"5_guide\"></a><h4>".$lang_int_5_title."</h4>";
echo $lang_int_5;
echo "<a name=\"6_guide\"></a><h4>".$lang_int_6a_title."</h4>";
echo $lang_int_6a;
echo "<a name=\"7_guide\"></a><h4>".$lang_int_6b_title."</h4>";
echo $lang_int_6b;
echo "<a name=\"8_guide\"></a><h4>".$lang_int_30_title."</h4>";
echo $lang_int_30;
echo "<a name=\"9_guide\"></a><h4>".$lang_int_7_title."</h4>";
echo $lang_int_7;
echo "<a name=\"10_guide\"></a><h4>".$lang_int_8_title."</h4>";
echo $lang_int_8;
echo "<a name=\"11_guide\"></a><h4>".$lang_int_9_title."</h4>";
echo $lang_int_9;
echo "<a name=\"12_guide\"></a><h4>".$lang_int_10_title."</h4>";
echo $lang_int_10;
echo "<a name=\"13_guide\"></a><h4>".$lang_int_11_title."</h4>";
echo $lang_int_11;
echo "<a name=\"14_guide\"></a><h4>".$lang_int_12_title."</h4>";
echo $lang_int_12;
echo "<a name=\"15_guide\"></a><h4>".$lang_int_13_title."</h4>";
echo $lang_int_13;
echo "<a name=\"16_guide\"></a><h4>".$lang_int_14_title."</h4>";
echo $lang_int_14;
echo "<a name=\"17_guide\"></a><h4>".$lang_int_15_title."</h4>";
echo $lang_int_15;
echo "<a name=\"19_guide\"></a><h4>".$lang_int_16a_title."</h4>";
echo $lang_int_16a;
echo "<a name=\"19_guide\"></a><h4>".$lang_int_16b_title."</h4>";
echo $lang_int_16b;
echo "<a name=\"20_guide\"></a><h4>".$lang_int_16c_title."</h4>";
echo $lang_int_16c;
echo "<a name=\"21_guide\"></a><h4>".$lang_int_17a_title."</h4>";
echo $lang_int_17a;
echo "<a name=\"22_guide\"></a><h4>".$lang_int_17b_title."</h4>";
echo $lang_int_17b;
echo "<a name=\"23_guide\"></a><h4>".$lang_int_18_title."</h4>";
echo $lang_int_18;
echo "<a name=\"24_guide\"></a><h4>".$lang_int_19_title."</h4>";
echo $lang_int_19;
echo "<a name=\"25_guide\"></a><h4>".$lang_int_20_title."</h4>";
echo $lang_int_20;
echo "<a name=\"26_guide\"></a><h4>".$lang_int_21_title."</h4>";
echo $lang_int_21;
echo "<a name=\"27_guide\"></a><h4>".$lang_int_22_title."</h4>";
echo $lang_int_22;
echo "<a name=\"28_guide\"></a><h4>".$lang_int_23_title."</h4>";
echo $lang_int_23;
echo "<a name=\"29_guide\"></a><h4>".$lang_int_24_title."</h4>";
echo $lang_int_24;
echo "<a name=\"30_guide\"></a><h4>".$lang_int_25_title."</h4>";
echo $lang_int_25;
echo "<a name=\"31_guide\"></a><h4>".$lang_int_26_title."</h4>";
echo $lang_int_26;
echo "<a name=\"32_guide\"></a><h4>".$lang_int_27_title."</h4>";
echo $lang_int_27;
echo "<a name=\"33_guide\"></a><h4>".$lang_int_28_title."</h4>";
echo $lang_int_28;
echo "<a name=\"34_guide\"></a><h4>".$lang_int_29a_title."</h4>";
echo $lang_int_29a;
echo "<a name=\"35_guide\"></a><h4>".$lang_int_29b_title."</h4>";
echo $lang_int_29b;
?>
</div></div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div>
</div>
<?php 
include ('./html_end.php');
?>
