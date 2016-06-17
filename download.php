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
<h2><?=$lang_menu_download2;?></h2>
<?php 
if ($_GET["file"]) {
?>
<?=$lang_download_info?>
<form action="./download.php" method="post" name="form1">
<input type="hidden" id="file" name="file"  value="<?=$_GET["file"]?>">
<table>
<tr>
<td>
<img id="captcha" src="images/securimage/securimage_show.php" alt="CAPTCHA Image">
</td>
<td>
<a href="#" onclick="document.getElementById('captcha').src = 'images/securimage/securimage_show.php?' + Math.random(); return false"><?=$lang_menu_reload?></a>
</td>
</tr>
<tr>
<td>
<input type="text" name="captcha_code" size="20" maxlength="6">
</td>
<td>
</td>
</tr>
<tr>
<td>
<input type="submit" class="button2" name="submit" value="<?=$lang_menu_download2;?>">
</td>
<td>
</td>
</tr>
</table>
</form>
<?
} else if ($_POST["submit"]) {
include './images/securimage/securimage.php';
$securimage = new Securimage();
if ($securimage->check($_POST['captcha_code']) == false) {
$_SESSION["ses_message"]= 'Opsal jste špatně bezpečnostní kód. Prosím zkuste znovu.';
$location = 'Location: ./download.php';
header($location);
} else {
$location = 'Location: '.$IMAGE_URL.'download/'.$_POST["file"];
header($location);
}
} else {?>
<h4></h4>	
<!-- Please uncomment this when you are finished with creation of pdf files for download. Name properly files.
<?=$lang_down2?>
<?=$lang_down3?>
<?=$lang_down4?>
-->
<?=$lang_down_old1?>
<?=$lang_down_old2?>
<?=$lang_down_old3?>
<?=$lang_down_old4?>
<?=$lang_down_old5?>

<?php } ?>
</div>
<div style="clear: both;">&nbsp;</div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div></div><?php 
include ('./html_end.php');
?>
