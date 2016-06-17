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
$picture_found=false;
$dict = 'ds_2_senses';
$biolib = 'ds_biolib_full';
$num_found=0;
$oop11 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop22 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop33 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
if ($_GET["picture"]=='change') {
if ($_GET["status"]=='correct') {
$st=10;
} else if ($_GET["status"]=='wrong') {
$st=0;	
} else if ($_GET["status"]=='skip') {
$st=5;		
}
$sql = sprintf ('UPDATE `%s` SET `status` = %s WHERE `id` = %s',
	$biolib,				
	quate_smart($st),
	quate_smart($_GET["id_picture"]));
$oop11->Setnames();
$oop11->query($sql);
$oop11->FreeResult();
} if ($_GET["picture"]=='delete') {
$sql = sprintf ('DELETE FROM `%s` WHERE `id` = %s',
	$biolib,					
	quate_smart($_GET["id_picture"]));
$oop11->Setnames();
$oop11->query($sql);
$oop11->FreeResult();
}
$empty='';
$sql = sprintf ('SELECT `latinnames` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s AND `latinnames` != %s',
	$dict,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword),
	quate_smart($empty));
$oop11->Setnames();
$oop11->query($sql);
$num2 = $oop11->getNumrows(); 
if ($num2 != 0) { // 1
$row_latin = $oop11->fetchRow ();
$sql = sprintf ('SELECT `D`, `A`, `H`, `I`, `F`, `E`, `status`, `id` FROM `%s` WHERE `B` = %s AND `C` != 0 ORDER BY `status` DESC',
	$biolib,				
	quate_smart($row_latin[0]));
$oop22->Setnames();
$oop22->query($sql);
$num3= $oop22->getNumrows(); 
if ($num3 != 0) { // 1
if (($_SESSION["rights"])!=3) {
$picture_found=true;	
$image_output .= "<form action=\"search.php?action=update_status\" method=\"post\" name=\"form_status\">";
$image_output .= "<input type=\"hidden\" name=\"keyword\" value=\"".$view_keyword."\">";
$image_output .= "<input type=\"hidden\" name=\"num_keyword\" value=\"".$view_num_keyword."\">";
$as=0;
if (isset($_SESSION["ids_image"])) {
foreach ($_SESSION["ids_image"] as $k => $value)
{
unset ($_SESSION["ids_image"][$k]);	
}
}
while ($row_image = $oop22->fetchRow ()):
$image_output .= "<a href=\"http://www.biolib.cz/cz/taxonimage/id".$row_image[0]."\" target=\"_blank\"><img src=\"./images/biolib/".$row_image[0].".jpg\" border=\"0\" alt=\"\"></a>";
if ($row_image[6]==10) {
$image_output .= " <img id=\"image_".$as."\" name=\"image_1\" src=\"".$IMAGE_URL."images/dec_2.png\" onClick=\"Swap_image(this.id);\" class=\"small_icons\"> ";	
} else {
$image_output .= " <img id=\"image_".$as."\" name=\"image_1\" src=\"".$IMAGE_URL."images/dec_4.png\" onClick=\"Swap_image(this.id);\" class=\"small_icons\"> ";
}
$image_output .= "<input type=\"hidden\" id=\"image_".$as."_hidden\" name=\"image_".$as."_hidden\" value=\"".$row_image[6]."\">";
$image_output .= "<span class=\"nav\"><a href=\"http://www.biolib.cz/cz/taxon/id".$row_image[5]."/\" target=\"_blank\">".$row_image[4]."</a></span> ";
$_SESSION["ids_image"][$as]=$row_image[7];
$as++;
endwhile;
$image_output .= "<input type=\"submit\" class=\"button2\" name=\"submit_image\" value=\"".$lang_admin_button."\">";
$image_output .= "</form>";
} else {
$cor1=10;
$sql33 = sprintf ('SELECT `D`, `A`, `H`, `I`, `F`, `E`, `status`, `id` FROM `%s` WHERE `B` = %s AND `C` != 0 AND `status`= %s ORDER BY `status` DESC',
	$biolib,				
	quate_smart($row_latin[0]),
	quate_smart($cor1));
$oop33->Setnames();
$oop33->query($sql33);
$num33= $oop33->getNumrows(); 
$rand=rand(1,$num33); 
$as=1;
while ($row_image = $oop33->fetchRow ()):	
if ($as==$rand) {
$image_output_user_biolib .= '<div class="main_entry_little">';
$image_output_user_biolib .= '<br>';
if ($_SESSION["lang"]=='cz') {
$biolib_directory="cz";
} else {
$biolib_directory="en";	
}
$image_output_user_biolib .= "<a href=\"http://www.biolib.cz/".$biolib_directory."/taxonimage/id".$row_image[0]."\" target=\"_blank\"><img src=\"./images/biolib/".$row_image[0].".jpg\" border=\"0\" alt=\"\"></a><br>";
$picture_found=true;
$image_output_user_biolib .= "<span class=\"foto\">".$lang_img2.":</span> <span class=\"nav\">".$row_image[2]."</span> <br>";
$image_output_user_biolib .= "<span class=\"foto\">".$lang_img3."</span> <span class=\"nav\">".$row_image[3]."</span>";
$image_output_user_biolib .= "</div>";	
}
$as++;
endwhile;	
}
}
}	
$oop11->FreeResult();
$oop22->FreeResult();
$oop33->FreeResult();

////////////////////////////////////////////////////////////////////////////////////
//////////////////////////// IMAGES ////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
$num_found=0;
$table_images = 'ds_images';
if (($_SESSION["rights"]==1) OR ($_SESSION["rights"]==2)) {	
	$image_add_button=TRUE;	
}
$image_output .= '<br>';
$sql = sprintf ('SELECT `name_of_file`,`author`,`licence`, `orientation` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table_images,
	$collation_1,
	quate_smart($view_keyword),
	quate_smart($view_num_keyword));
$oop11->Setnames();
$oop11->query($sql);
$num2 = $oop11->getNumrows(); 
if ($num2!=0){
$image_found=TRUE;
$count_i=0;
if (($_SESSION["rights"]==1) OR ($_SESSION["rights"]==2)) {
$image_output .= '<div class="main_entry_little">';
$image_output .= "<br>";
while ($image = $oop11->fetchRow ()):
$count_i++;
$picture_found=true;
if ($image[3]==1) {
$image_output .= "<a href=\"".$IMAGE_URL."images/uploaded_files/".$image[0]."\" title=\"".ucfirst($view_keyword).",	".$lang_img2." ".$image[1]."\" class=\"thickbox\"><img src=\"".$IMAGE_URL."images/uploaded_files/th_".$image[0]."\"  border=\"0\" alt=\"Single Image\"></a> ";
} else {
$image_output .= "<a href=\"".$IMAGE_URL."images/uploaded_files/".$image[0]."\" title=\"".ucfirst($view_keyword).",	".$lang_img2." ".$image[1]."\" class=\"thickbox\"><img src=\"".$IMAGE_URL."images/uploaded_files/th_".$image[0]."\" border=\"0\" alt=\"Single Image\"></a> ";
}
$image_output .= "<br>";
$image_output .= "<span class=\"foto\">".$lang_img2."</span> <span class=\"nav\">".$image[1]."</span> <br>";
if ($image[2]=='Creative Commons Attribution-Share Alike 2.5 Generic')
{
$image[2]='cc-by-sa-2.5';
} else if ($image[2]=='Creative Commons Attribution 3.0')
{
$image[2]='cc-by-3.0';
} else if ($image[2]=='Creative Commons Attribution-Share Alike 3.0 Unported')
{
$image[2]='cc-by-sa-3.0-un';
} else if ($image[2]=='Public domain')
{
$image[2]='Public domain';
} else if ($image[2]=='GNU Free Documentation License')
{
$image[2]='GFDL';
} 
$image_output .= "<span class=\"foto\">".$lang_img3."</span> <span class=\"nav\">".$image[2]."</span>";
if (($_SESSION["rights"])!=3) {
$image_output_delete .= "<li><a href=\"./multiple.upload.form.php?action=del&amp;name_of_file=".$image[0]."&amp;a=image&amp;d_h=".$_GET["d_h"]."&amp;d_h_n=".$_GET["d_h_n"]."\">vymazat obrázek č. ".$count_i."</a> </li>";
}
$image_output .= "<br>";
$image_output .= "<br>";
endwhile;
$image_output .= "</div>";
	
} else {
$rand=rand(1,$num2);
$image_output_user_own .= '<div class="main_entry_little">';
$image_output_user_own .= "<br>";
while ($image = $oop11->fetchRow ()):
$count_i++;
$picture_found=true;
if ($rand==$count_i){
if ($image[3]==1) {
$image_output_user_own .= "<a href=\"".$IMAGE_URL."images/uploaded_files/".$image[0]."\" title=\"".ucfirst($view_keyword).",	".$lang_img2." ".$image[1]."\" class=\"thickbox\"><img src=\"".$IMAGE_URL."images/uploaded_files/th_".$image[0]."\"  border=\"0\" alt=\"Single Image\"></a> ";
} else {
$image_output_user_own  .= "<a href=\"".$IMAGE_URL."images/uploaded_files/".$image[0]."\" title=\"".ucfirst($view_keyword).",	".$lang_img2." ".$image[1]."\" class=\"thickbox\"><img src=\"".$IMAGE_URL."images/uploaded_files/th_".$image[0]."\" border=\"0\" alt=\"Single Image\"></a> ";
}
$image_output_user_own  .= "<br>";
$image_output_user_own  .= "<span class=\"foto\">".$lang_img2."</span> <span class=\"nav\">".$image[1]."</span> <br>";
if ($image[2]=='Creative Commons Attribution-Share Alike 2.5 Generic')
{
$image[2]='cc-by-sa-2.5';
} else if ($image[2]=='Creative Commons Attribution 3.0')
{
$image[2]='cc-by-3.0';
} else if ($image[2]=='Creative Commons Attribution-Share Alike 3.0 Unported')
{
$image[2]='cc-by-sa-3.0-un';
} else if ($image[2]=='Public domain')
{
$image[2]='Public domain';
} else if ($image[2]=='GNU Free Documentation License')
{
$image[2]='GFDL';
} 
$image_output_user_own  .= "<span class=\"foto\">".$lang_img3."</span> <span class=\"nav\">".$image[2]."</span>";
$image_output_user_own  .= "<br>";
$image_output_user_own  .= "<br>";
}
endwhile;
$image_output_user_own  .= "</div>";
}
}
if (($_SESSION["rights"]==1) OR ($_SESSION["rights"]==2)) {	
} else {
if ($picture_found===true) {
$rand=rand(1,2);
//randomly choose from biolib or own gallery
if (($image_output_user_own!='') AND ($image_output_user_biolib!='')) {
if ($rand==1) {
$image_output.=	$image_output_user_own;	
} else {
$image_output.=	$image_output_user_biolib;	
}
// if exists only one source of picture
} else {
if ($image_output_user_own!='') {
$image_output.=	$image_output_user_own;
} else {
$image_output.=	$image_output_user_biolib;	
}
}
}
}
	
	
$oop11->FreeResult();
$oop11->_mySQL;
$oop22->_mySQL;
$oop33->_mySQL;
?>
