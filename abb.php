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
include 'start.php';
include 'head.php';
?>
<body onload="setfocus ()">
<div id="wrapper">
<?php include 'header.php'; 
include 'menu.php';
echo $MAIN_MENU;
?>
<div id="content">
<div class="left_huge">
<h2><a name="top"></a><?=$lang_abb;?></h2>
<?=$lang_abb_info;?><br>
<?php
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
function subval_sort($a,$subkey) {
foreach($a as $k=>$v) {
$b[$k] = strtolower($v[$subkey]);
}
asort($b);
foreach($b as $key=>$val) {
$c[] = $a[$key];
}
return $c;
}
$arr_all= array(	
'0' => 'ds_abb_grammar',
'1' => 'ds_abb_grammar_additional',
'2' => 'ds_spec_field',
'3' => 'ds_spec_usage'
);
$sw=0;
if ($_GET["order"]=='no') {
	
	$arr_desc= array(						
'0' => $lang_abb1,
'1' => $lang_abb2,
'2' => $lang_abb3,
'3' => $lang_abb4
);
echo '<br>';
foreach ($arr_desc as $id => $value) {
echo '<a href="#'.$id.'">'.$value.'</a><br>';
}

echo '<table class="sample">';
while($r = $oop2->fetchRow ()) :
echo '<tr>';
echo '<td>';
echo $r[1];
echo '</td>';
echo '<td>';
if ($id==0) {
$field='gram_1_word_group';
} else if ($id==1) {
$field='gram_3_additional';
} else if ($id==2) {
$field='specification';
} else if ($id==3) {
$field='usage_specification';
} 
echo '<a href="./search.php?list_kind=alpha&amp;post_h='.$r[1].'&amp;pagenum=1&amp;post_f='.$field.'">';
if ($_SESSION["lang"]=='cz') {
echo $r[3];
} else if ($_SESSION["lang"]=='en') {
echo $r[4];
} else if ($_SESSION["lang"]=='is') { 
echo $r[5];
} else if ($_SESSION["lang"]=='pl') {
echo $r[6];
} else if ($_SESSION["lang"]=='sl') {
echo $r[7];
} else if ($_SESSION["lang"]=='fr') {
echo $r[8];
}
echo '</a></td></tr>';
endwhile;
echo '</table>';
$oop2->freeResult();
$arr= array(		
'0' => 'ds_abb_grammar',
'1' => 'ds_abb_grammar_additional',
'2' => 'ds_spec_field',
'3' => 'ds_spec_usage'
	);

foreach ($arr as $id => $value) {
$sql2 = sprintf ('SELECT * FROM `%s`',
	$value);
$oop2->Setnames(); 
$oop2->query($sql2);
echo '<br><a name="'.$id.'"></a><a href="#top">'.$arr_desc[$id].'</a>';
echo '<table class="sample">';
while($r = $oop2->fetchRow ()) :
echo '<tr><td>';
echo $r[1];
echo '</td><td>';
if ($id==0) {
$field='gram_1_word_group';
} else if ($id==1) {
$field='gram_3_additional';
} else if ($id==2) {
$field='specification';
} else if ($id==3) {
$field='usage_specification';
}
if ($_SESSION["lang"]=='cz') {
echo $r[3];
} else if ($_SESSION["lang"]=='en') {
echo $r[4];
} else if ($_SESSION["lang"]=='is') {
echo $r[5];
} else if ($_SESSION["lang"]=='pl') {
echo $r[6];
} else if ($_SESSION["lang"]=='sl') {
echo $r[7];
} else if ($_SESSION["lang"]=='fr') {
echo $r[8];
} 
echo '</td>';
echo '</tr>';
endwhile;
echo '</table>';
}
$oop2->freeResult();
} else {
foreach ($arr_all as $id => $value) {
$sql2 = sprintf ('SELECT * FROM `%s`',
	$value);
$oop2->Setnames(); 
$oop2->query($sql2);
while($r = $oop2->fetchRow ()) :
$sw++;
for ($i = 1; $i < 10; $i++) {
if ($i==9) {
$new_arr[$sw][$i]=$id;		
} else {
$new_arr[$sw][$i]=$r[$i];
}
}
endwhile;
}
$songs = subval_sort($new_arr,'1'); 
echo '<br>';
echo '<table class="sample">';
foreach ($songs as $id => $v) {
echo '<tr>';
echo '<td>';
echo $v[1];
echo '</td>';
echo '<td>';
if ($v[9]==0) {
$field='gram_1_word_group';
} else if ($v[9]==1) {
$field='gram_3_additional';
} else if ($v[9]==2) {
$field='specification';
} else if ($v[9]==3) {
$field='usage_specification';
}
if ($_SESSION["lang"]=='cz') {
echo $v[3];
} else if ($_SESSION["lang"]=='en') {
echo $v[4];
} else if ($_SESSION["lang"]=='is') {
echo $v[5];
} else if ($_SESSION["lang"]=='pl') {
echo $v[6];
} else if ($_SESSION["lang"]=='sl') {
echo $v[7];
} else if ($_SESSION["lang"]=='fr') {
echo $v[8];
} 
echo '</td>';
echo '</tr>';
}
echo '</table>';
$oop2->freeResult();
}	
$oop2->_mySQL;	
?>
</div>
<div style="clear: both;">&nbsp;</div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div></div><?php 
include ('./html_end.php');
?>
