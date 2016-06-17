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
if ($_GET["logout"]=='true') {
$lang_old=$_SESSION["lang"];
$page_id = 26;
include './work.php'; 
setcookie("d_h_cookie", $_SESSION["d_h"], time()+604800);
setcookie("d_h_n_cookie", $_SESSION["d_h_n"], time()+604800);
unset($_SESSION["id_user"]);
unset($_SESSION["ip_welcome"]);
session_destroy();
session_start();
$_SESSION["lang"]=$lang_old;
$dir  = "./language/";
$dir_path = $dir.$_SESSION["lang"]."/lang_program.php";
include ($dir_path);
$_SESSION["ses_message"] .= $lang_logout3;
$location = 'Location: ./index.php';
echo $_SESSION["ses_message"];
header($location);
} else {
?>
<body onload="setfocus ()">
<div id="wrapper">
<?php include 'header.php';
include 'menu.php';
echo $MAIN_MENU;
?>
<div id="content">
<div class="left_huge">
<h2><?=$lang_logout1?></h2>
<p><?=$lang_logout2?></p>
<p> <a href="./logout.php?logout=true"><?=$lang_edit_del_yes?></a>  /  <a href="./search.php?list_kind=alpha"><?=$lang_edit_del_no?></a> </p>
</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div>
</div>
<?php 
include ('./html_end.php');
}
?>