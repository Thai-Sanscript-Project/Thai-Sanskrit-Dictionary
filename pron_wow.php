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
include './head_s.php'; ?>
<script type="text/javascript">	
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=300,height=100,left = 412,top = 334');");}
</script>
<script type="text/javascript" src="<?=$IMAGE_URL?>/scripts/thickbox-compressed.php"></script>
</head>
<body onload="setfocus ()">
<div id="wrapper">
<?php include 'header.php'; 
include 'menu.php'; 
echo $MAIN_MENU;
?>
<div id="content">
<div class="left">
</div>
<div class="left_huge">
<h2><a name="top"></a><?=$lang_pron_info2?></h2>
<?php
$oop_r = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop_r4 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table = 'pron_wow';
$sql = sprintf ('SELECT * FROM `%s`',
	$table); 
$oop_r->Setnames();
$oop_r->query($sql);
$rr_count=0;
echo '<p>';
echo '<strong>'.$lang_pron_info15.'</strong><br>';
$vowels = array(	
	'0' => 'a',
	'1' => 'á',
	'2' => 'e',
	'3' => 'é',
	'4' => 'i',
	'5' => 'í',							
	'6' => 'o',
	'7' => 'ó',
	'8' => 'u',
	'9' => 'ú',
	'10' => 'y',
	'11' => 'ý',
	'12' => 'æ',
	'13' => 'ö',
	);

$double_vowels = array(	
	'0' => 'au',
	'1' => 'ei',
	'2' => 'ey',
	);

foreach ($vowels as $id => $value) {
echo '<a href="#'.$value.'">'.$value.'</a> ';
}
foreach ($double_vowels as $id => $value) {
echo '<a href="#'.$value.'">'.$value.'</a> ';
}
?>
</p><br>
<table class="sample">
<tr>
<?=$lang_pron_info3?>
</tr>
<?php
while($r = $oop_r->fetchRow ()) :
echo '<tr>';
if (trim($r[1])!=$old) {
echo '<td><strong><a name="'.$r[1].'"></a><a href="#top">'.$r[1].'</a></strong></td>';
}
else {
echo '<td></td>';
}
$old=$r[1];

echo '<td>'.$r[2].'</td>'.'<td>'.$r[3].'</td>'.'<td>'.$r[4].'</td>';
echo '<td><a href="./pron_pop.php?word='.$r[6].'&amp;fram='.$r[7].'&keepThis=true&TB_iframe=true&height=50&width=400" title="'.$lang_pron_info4.' '.$r[6].'" class="thickbox">'.$r[6].'</a></td> ';
echo '<td>';
echo $r[7];	
echo '</td>';
$old=$r[1];
echo '<td>'.$r[8].'</td></tr>';
endwhile;
echo '</table>';
$oop_r->freeResult();
?>
</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div></div><?php 
include ('./html_end.php');
?>
