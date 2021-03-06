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
<h2><?=$lang_head_title;?></h2>
<?=$lang_info_1_new;?>
<br><br>
<?=$lang_info_1_thanks;?>
<br>
<h4><?=$lang_info_options?></h4>
<ol>
<li><a href="./search.php"> <?=$lang_info_2;?></a> </li>
<li><a href="./download.php#pdf"><?=$lang_info_3;?></a></li>
<li><a href="./download.php#stardict"><?=$lang_info_4;?></a></li>
</ol>         
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
