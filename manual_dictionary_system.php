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
$dir  = "./language/";
$dir_path = $dir.$_SESSION["lang"]."/language_manual.php";
include ($dir_path);
include './head_s.php'; ?>
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
<script type="text/javascript" src="<?=$IMAGE_URL?>scripts/thickbox-compressed.php"></script>
</head>
<body onload="setfocus()">
<div id="wrapper">
<?php include 'header.php'; 
include 'menu.php'; 
echo $MAIN_MENU;
?>
<div id="content">
<div class="left_huge">
<h2><a name="top"></a>Přírůčka uživatele pro aplikaci Dictionary System (DS)</h2>
<div class="menu_sub">
<ul>
<li><a href="">Obsah </a>
<ul>
<li><a href="#1_guide">1. Všeobecné informace</a></li>
<li><a href="#2_guide">2. Instalace</a></li>
<li><a href="#3_guide">3. Orientace v aplikaci</a></li>
<li><a href="#4_guide">4. Seznam</a></li>
<li><a href="#5_guide">5. Slovo</a></li>
<li><a href="#6_guide">6. Třídění</a></li>
<li><a href="#7_guide">7. Deklinace</a></li>
<li><a href="#8_guide">8. Multimédia</a></li>
<li><a href="#9_guide">9. Historie</a></li>
<li><a href="#10_guide">10. Odkazy</a></li>
<li><a href="#11_guide">11. Administrace</a></li>
<li><a href="#12_guide">12. Profil</a></li>
<li><a href="#13_guide">13. Informace o slovníku</a></li>
<li><a href="#14_guide">14. Nápověda</a></li>
</ul>
</li>
</ul>
</div>
<?php 
// manual
echo $lang_manual_1_title;
echo $lang_manual_1_1;
echo $lang_manual_1_2;
echo $lang_manual_1_3;

echo $lang_manual_2_title;
echo $lang_manual_2_1;
echo $lang_manual_2_2;
echo $lang_manual_2_3;
echo $lang_manual_2_4;
echo $lang_manual_2_5;
echo $lang_manual_2_6;
echo $lang_manual_2_7;
echo $lang_manual_2_8;

?>
</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div></div><?php 
include ('./html_end.php');
?>
