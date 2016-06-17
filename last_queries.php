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
include './scripts/redirect_public.php';
// 1. pagination
if (isset($_GET['pagenum'])) {
$_SESSION["queries_p"] = $_GET['pagenum'];
}
?>
<body onload="setfocus ()">
<div id="wrapper">
<?php include 'header.php';
include 'menu.php'; 
echo $MAIN_MENU;
?>
<div id="content">
<div class="left_huge">
<h2><?=$lang_last_queries1;?></h2>
<div class="search_1column">
<h3><?=$lang_last_queries2;?></h3>
<?php
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop_ip = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$table=  'ds_queries';

$sql = sprintf ('SELECT * FROM %s ORDER BY `time` DESC, `id` DESC',
	$table); 
$oop->Setnames();
$oop->query($sql);
$num = $oop->getNumRows();
$oop->freeResult();
// PAGINATION
// 3. Calculate number of $lastpage
$rows_per_page = 50;
$lastpage      = ceil($num/$rows_per_page);
// PAGINATION
// 4. Ensure that $pagenum is within range
$_SESSION["queries_p"] = (int)$_SESSION["queries_p"];
if ($_SESSION["queries_p"] > $lastpage) {
   $_SESSION["queries_p"] = $lastpage;
}
if ($_SESSION["queries_p"] < 1) {
   $_SESSION["queries_p"] = 1;
}
// PAGINATION
// 5. Construct LIMIT clause
$limit = 'LIMIT ' .($_SESSION["queries_p"] - 1) * $rows_per_page .',' .$rows_per_page;
// SQL WITH LIMIT FOR PAGINATION

$sql = sprintf ('SELECT * FROM `%s` ORDER BY `time` DESC, `id` DESC %s',
	$table,
	$limit); 

$oop->Setnames();
$oop->query($sql);
// begin flickr pagination
if (($_SESSION["queries_p"]==$lastpage) AND ($_SESSION["queries_p"]==1)) {
} else {
echo '<br>';

if ($_SESSION["queries_p"]>1) {

 $prevpage = $_SESSION["queries_p"]-1;
echo " <a href=\"".$_SERVER['PHP_SELF']."?pagenum=".$prevpage."\"><img src=\"/images/left_arrow_pink.png\" border=\"0\" alt=\"\"></a>";
echo '';
} else {
echo '<img src="/images/left_arrow_noactive.png" border="0" alt=""></li>';	
}
$stop=false;
$nextpage = $_SESSION["queries_p"]+1;
if ($_SESSION["queries_p"]<$lastpage) {
echo " <a href=\"".$_SERVER['PHP_SELF']."?pagenum=".$nextpage."\"><img src=\"/images/right_arrow_pink.png\" border=\"0\" alt=\"\"></a>";
} else {
echo '<img src="/images/right_arrow_noactive.png" border="0" alt="">';
}
echo '<br>';
echo '<br> ';
}
// end of flickr pagination
echo'<table class="sample">';
while ($returned = $oop->fetchRow ()):
$count++;
 $user_ip = $returned[3];

$table='country_info';
$sql1 = sprintf ('SELECT `country_code2` FROM `%s` WHERE `ip_from` <= INET_ATON (%s) AND `ip_to` >= INET_ATON (%s)',
	$table,
	quate_smart($user_ip),
	quate_smart($user_ip)); 
$oop_ip->Setnames();
$oop_ip->query($sql1);
$return_flag = $oop_ip->fetchRow ();
$oop_ip->freeResult(); 

echo '<tr><td>'.$returned[4].'</td>';
echo '<td><strong> <a href="./search.php?action=find&d_h='.$returned[1].'" target="_blank">'.$returned[1].'</a></strong></td>';
echo '<td>';
if ($returned[2]=='unregistered') {
echo '<span class="ex">';
} else if ($returned[2]=='registered') {
echo '<span class="phonetics_result">';
} else {
echo '<span class="italic2">';
}
echo ''.$returned[2].'</span></td>';
echo '<td>'.$returned[3].'</td>';
echo '<td>';
if ($return_flag[0]!='') {
echo '<img src="'. $IMAGE_URL . 'images/flags/'.$return_flag[0].'.gif" alt="" width="15" height="13"/> ';
}
echo '</td></tr>';

endwhile;
echo '</table>';
$oop->freeResult();
$oop->_mySQL;
$oop_ip->_mySQL;

?>
</div>

<div class="search_2column">
<h3><?=$lang_last_queries3;?></h3>
<?php
function deleteFirstChar( $string ) {
return substr( $string, 1 );
}
$oop5 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table=  'ds_queries';

$title="day";
$usr='registered';
$sql = sprintf ('SELECT * FROM `%s` WHERE `field`= %s',
	$table,
	quate_smart($usr));
$oop5->Setnames(); 
$oop5->query($sql);
$num = $oop5->getNumRows();
$year=date('Y');
$month=date('m');
$day=date('d');
//$month=11;
$days = date("t");
$_SESSION["newgraph1"]='';
for ($k = 1; $k <= $days; $k++) {
$_SESSION["newgraph1"][$k]=0;
}
if ($num!=0) {
while ($returned = $oop5->fetchRow ()):
$date = explode(" ", $returned[4]);
$full_date = explode("-", $date[0]);
if ($year==$full_date[0]) {
if ($month==$full_date[1]) {
	
$r = $full_date[2][0]; 
$ee3++;
if ($r==0) {
$full_date[2]=deleteFirstChar($full_date[2]);
}
$_SESSION["newgraph1"][$full_date[2]]++;
if ($full_date[2]==$day) {
$oo3++;	
}
}
}
endwhile;	
}
$oop5->freeResult();


	$_SESSION["stats_title"]="day";

$usr='unregistered';
$sql = sprintf ('SELECT * FROM `%s` WHERE `field`= %s',
	$table,
	quate_smart($usr));

$oop5->Setnames(); 
$oop5->query($sql);
$num = $oop5->getNumRows();
$year=date('Y');
$month=date('m');
//$month=11;
$days = date("t");
$_SESSION["newgraph2"]='';
for ($k = 1; $k <= $days; $k++) {
$_SESSION["newgraph2"][$k]=0;
}
if ($num!=0) {
while ($returned = $oop5->fetchRow ()):
$date = explode(" ", $returned[4]);
$full_date = explode("-", $date[0]);
if ($year==$full_date[0]) {
if ($month==$full_date[1]) {
	
$r = $full_date[2][0]; 
$ee2++;
if ($r==0) {
$full_date[2]=deleteFirstChar($full_date[2]);
}
$_SESSION["newgraph2"][$full_date[2]]++;
if ($full_date[2]==$day) {
$oo2++;	
}
}
}
endwhile;


	
}
$oop5->freeResult();


	
	$_SESSION["stats_title"]="day";

$usr1='unregistered';
$usr2='registered';
$sql = sprintf ('SELECT * FROM `%s` WHERE `field` NOT LIKE %s AND `field` NOT LIKE %s ',
	$table,
	quate_smart($usr1),
	quate_smart($usr2));

$oop5->Setnames(); 
$oop5->query($sql);
$num = $oop5->getNumRows();
$year=date('Y');
$month=date('m');
//$month=11;
$days = date("t");
$_SESSION["newgraph3"]='';
for ($k = 1; $k <= $days; $k++) {
$_SESSION["newgraph3"][$k]=0;
}
if ($num!=0) {
while ($returned = $oop5->fetchRow ()):
$date = explode(" ", $returned[4]);
$full_date = explode("-", $date[0]);
if ($year==$full_date[0]) {
if ($month==$full_date[1]) {
	
$r = $full_date[2][0]; 
$ee++;
if ($r==0) {
$full_date[2]=deleteFirstChar($full_date[2]);
}
$_SESSION["newgraph3"][$full_date[2]]++;
if ($full_date[2]==$day) {
$oo++;	
}
}
}
endwhile;
}
	$oop5->freeResult();
	$oop5->_mySQL;
?>
<img src="./statsgraph.php" />
<?php
?>
<div class="view_keyword">
<table class="sample">
<tr><td><?=$lang_last_queries8;?> </td><td><?=$lang_last_queries9;?> </td><td> <?=$lang_last_queries10;?></td><tr>
<tr><td><?=$lang_last_queries4;?> </td><td><?=$oo?> </td><td> <?=$ee?></td><tr>
<tr><td><?=$lang_last_queries5;?>  </td><td><?=$oo2?> </td><td> <?=$ee2?></td><tr>
<tr><td><?=$lang_last_queries7;?>  </td><td><?=$oo3?> </td><td> <?=$ee3?></td><tr>
<tr><td><?=$lang_last_queries11;?>  </td><td><?=$oo3+$oo2?> </td><td> <?=$ee3+$ee2?></td><tr>
</table>
</div>
</div>
</div>
<div style="clear: both;">&nbsp;</div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div></div><?php 
include ('./html_end.php');
?>
