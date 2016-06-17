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
include './head.php';
// language file
$dir  = "./language/";
$dir_path = $dir.$_SESSION["lang"]."/language_tips.php";
include ($dir_path);
?>
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
<h2><a name="top"></a><?=$lang_tips1?></h2>
<span class="guide_title">1. <?=$lang_tips2?></span><br><br><br><br>
<h4>1.1 <?=$lang_tips3?> </h4>
<?=$lang_tips4?>
<h4>1.2 <?=$lang_tips5?></h4>
<?=$lang_tips6?>  
<h4>1.3 <?=$lang_tips7?></h4>
<?=$lang_tips8?>
<h4>1.4 <?=$lang_tips9?></h4>
<?=$lang_tips10?> 
<br>
<br>
<?=$lang_tips11?>
<br>
<br>
<?=$lang_tips12?>
<h4>1.5 <?=$lang_tips13?></h4>
<?=$lang_tips14?>
<h4>1.6 <?=$lang_tips15?></h4>
<?=$lang_tips16?>
<h4>1.7 <?=$lang_tips17?></h4>
<?=$lang_tips18?>
<h4>1.8 <?=$lang_tips19?></h4>
<?=$lang_tips20?>
<h4>1.9 <?=$lang_tips21?></h4>
<?=$lang_tips22?>
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
