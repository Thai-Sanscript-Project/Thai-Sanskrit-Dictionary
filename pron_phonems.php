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
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=300,height=100,left = 412,top = 334');");
}
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
<h2><a name="top"></a><?=$lang_pron_info6?></h2>
<?php
$oop_r = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop_r4 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table = 'phonems_list';
$sql = sprintf ('SELECT * FROM `%s`',
	$table); 
$oop_r->Setnames();
$oop_r->query($sql);
$rr_count=0;
echo '<p>';
echo $lang_pron_info7.'<a href="http://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/IPA_chart_2005_png.svg/2000px-IPA_chart_2005_png.svg.png" target="_blank">'.$lang_pron_info8.'</a><br>';
$wow = array(	
	'0' => '[a]',
	'1' => '[ɛ]',
	'2' => '[ɪ]',
	'3' => '[i]',
	'4' => '[ɔ]',
	'5' => '[ou]',							
	'6' => '[ʏ]',
	'7' => '[u]',
	'8' => '[œ]',
	'11' => '[ei]'
	);
foreach ($wow as $id => $value) {
echo '<a href="#'.$value.'">'.$value.'</a> ';
}
$cons = array(	
	'0' => '[b̥]',
	'1' => '[pʰ]',
	'2' => '[d̥]',
	'3' => '[tʰ]',
	'4' => '[ð]',							
	'5' => '[θ]',							
	'6' => '[f]',
	'7' => '[v]',
	'8' => '[ɡ̊]',
	'9' => '[ɟ̊]',
	'10' => '[j]',
	'11' => '[ɣ]',
	'12' => '[h]',
	'13' => '[ç]',
	'14' => '[l]',
	'15' => '[l̥]',
	'16' => '[kʰ]',
	'17' => '[m]',
	'18' => '[m̥]',
	'19' => '[cʰ]',
	'20' => '[n]',
	'21' => '[n̥]',
	'22' => '[s]',
	'23' => '[r]',
	'24' => '[r̥]',
	'25' => '[x]',
	'26' => '[ŋ]',
	'27' => '[ŋ̊]',
	'28' => '[ɲ]',
	'29' => '[ɲ̊]',
	);
foreach ($cons as $id => $value) {
echo '<a href="#'.$value.'">'.$value.'</a> ';
}
echo '</p>';
echo '<br>';
echo '<table class="sample">';
echo '<tr>';
echo $lang_pron_info9;
echo '</tr>';

while($r = $oop_r->fetchRow ()) :
echo '<tr>';
if (trim($r[1])!=$old) {
echo '<td><strong><a name="'.$r[1].'"></a><a href="#top">'.$r[1].'</a></strong></td>';
}
else {
echo '<td></td>';
}
$old=$r[1];
echo '<td>'.$r[2].'</td>';
echo '<td><a href="./pron_pop.php?word='.$r[3].'&amp;fram='.$r[4].'&keepThis=true&TB_iframe=true&height=50&width=400" title="'.$lang_pron_info4.' '.$r[3].'" class="thickbox">'.$r[3].'</a></td> ';
echo '<td>';
echo $r[4];	
echo '</td>';
$old=$r[1];
echo '<td>'.$r[5].'</td></tr>';
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
