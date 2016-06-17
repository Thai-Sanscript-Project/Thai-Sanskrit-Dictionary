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
<?php include 'header.php';
include 'menu.php';
echo $MAIN_MENU;
?>
<div id="content">
<div class="left_huge">
<h2><?=$lang_author_1;?></h2>
<p><?=$lang_author_2;?></p>
<h3><?=$lang_author_3;?></h3>
<p><?=$lang_author_4;?></p>
<h3><?=$lang_author_6;?></h3>
<p>
<table class="sample">
<tr>
<td><div class="clipwrapper"><img src="<?=$IMAGE_URL?>scripts/DropDown/dropdown/gfx/my_countries.png" border="0" class="clip pos-1" alt=""></div></td><td><?=$lang_translation_author1?></td></tr>

<tr><td><div class="clipwrapper"><img src="<?=$IMAGE_URL?>scripts/DropDown/dropdown/gfx/my_countries.png" border="0" class="clip pos-2" alt=""></div></td><td><?=$lang_translation_author2?></td></tr>
<tr><td><div class="clipwrapper"><img src="<?=$IMAGE_URL?>scripts/DropDown/dropdown/gfx/my_countries.png" border="0" class="clip pos-3" alt=""></div></td><td> <?=$lang_translation_author3?></td></tr>
<tr><td><div class="clipwrapper"><img src="<?=$IMAGE_URL?>scripts/DropDown/dropdown/gfx/my_countries.png" border="0" class="clip pos-4" alt=""></div></td><td> <?=$lang_translation_author4?></td></tr>
<tr><td><div class="clipwrapper"><img src="<?=$IMAGE_URL?>scripts/DropDown/dropdown/gfx/my_countries.png" border="0" class="clip pos-5" alt=""></div></td><td><?=$lang_translation_author5?></td></tr>
<tr><td><div class="clipwrapper"><img src="<?=$IMAGE_URL?>scripts/DropDown/dropdown/gfx/my_countries.png" border="0" class="clip pos-6" alt=""></div></td><td><?=$lang_translation_author6?></td></tr>
</table>
  
</p>
<br>
<h3><?=$lang_author_5;?></h3>
<p><img border="0" alt="" src="/images/mm.png" title=""></p>
</div>
<div style="clear: both;">&nbsp;</div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div></div><?php 
include ('./html_end.php');
?>
