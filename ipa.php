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
include 'start.php';

///////// confirm ///////////////////
if ($_GET["action"]=='confirm') {
	function str_replace_once($needle , $replace , $haystack){
    // Looks for the first occurence of $needle in $haystack
    // and replaces it with $replace.
    $pos = strpos($haystack, $needle);
    if ($pos === false) {
        // Nothing found
    return $haystack;
    }
    return substr_replace($haystack, $replace, $pos, strlen($needle));
}

 // BEGINS NORMAL EDIT VIEW ( NO UPDATING, ADDING OR DELETING was confirmed)

$oop_ipa = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop9 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);

// we fill the edit fields with the values from word tables and then from the keywords table
// sometimes we do not know id number so we take first of order in the keyword

$limit=$_GET['limit'];
$table='ds_1_headword';

if ($_GET["kind"]=='single') {
$table_ipa='ds_IPA_single';	
} else if ($_GET["kind"]=='compound') { 
$table_ipa='ds_IPA_compound';	
}

$zkr='zkr';
$str='·';
if ($_GET["kind"]=='single') {
$sql = sprintf ('SELECT `keyword`, `num_keyword`, `stem` FROM `%s` WHERE `stem` NOT LIKE %s AND`gram_1_word_group` NOT LIKE %s LIMIT %s, 50',
			$table,
			quate_two_wildcard($str),
			quate_smart($zkr),
			$limit);
}  else if ($_GET["kind"]=='compound') { 
$sql = sprintf ('SELECT `keyword`, `num_keyword`, `stem` FROM `%s` WHERE `stem` LIKE %s AND`gram_1_word_group` NOT LIKE %s LIMIT %s, 50',
			$table,
			quate_two_wildcard($str),
			quate_smart($zkr),
			$limit);
}
	
$oop_ipa->Setnames();
$oop_ipa->query($sql);
echo $oop_ipa->getMysqlError();
$num_1 = $oop_ipa->getNumRows();
$limit=$_GET['limit']+50;
if ($num_1!=0) {



while ($returned = $oop_ipa->fetchRow ()):

$view_keyword=$returned[0];
$view_num_keyword=$returned[1];
$result_full='';
$ipa='yes';
$bb=0; $aa=0;

include './scripts/pronunciation_generate.php';

$stem=$returned[2];
$stem =str_replace ('··', '·' ,  $stem);
$stem =str_replace ('|', '' ,  $stem);

$sql = sprintf ('INSERT INTO `%s`(`id`, `keyword`, `num_keyword`, `pronunciation`)VALUES (NULL, %s, %s, %s)',
			$table_ipa,
			quate_smart($stem),
			quate_smart($view_num_keyword),
			quate_smart($result_full));
	
$oop9->Setnames();
$oop9->query($sql);
$oop9->freeResult();

endwhile;


$oop_ipa->freeResult();

} else {
$location = 'Location: ipa.php';	
header($location);
}


if ($limit<200000){
$location = './ipa.php?action=confirm&limit='.$limit.'&kind='.$_GET["kind"].'';
} else {
$location = './ipa.php';	
}

$oop_ipa->_mySQL;
$oop9->_mySQL;
header("Refresh: 1; url=\"".$location."");
	
	
}

if ($_GET["action"]=='compound_DISABLE') {


 // BEGINS NORMAL EDIT VIEW ( NO UPDATING, ADDING OR DELETING was confirmed)

$oop_ipa = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop9 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);

// we fill the edit fields with the values from word tables and then from the keywords table
// sometimes we do not know id number so we take first of order in the keyword

$limit=$_GET['limit'];
$table='ds_1_headword';
$zkr='zkr';

$sql = sprintf ('SELECT `id`, `keyword`, `num_keyword`, `stem` FROM `%s` WHERE `gram_1_word_group` NOT LIKE %s LIMIT %s, 50',
			$table,
			quate_smart($zkr),
			$limit);
	
$oop_ipa->Setnames();
$oop_ipa->query($sql);
echo $oop_ipa->getMysqlError();
$num_1 = $oop_ipa->getNumRows();
$limit=$_GET['limit']+50;
if ($num_1!=0) {


while ($returned = $oop_ipa->fetchRow ()):
$compound_stem='';
$stem=$returned[3];
$stem =str_replace ('|', '' ,  $stem);
if (strpos(trim($stem), '··')!=0) {
	$stem =str_replace ('··', '*' ,  $stem);
	$stem =str_replace ('·', '' ,  $stem);
	
	$new_value= explode ('*',trim($stem));	
	$n = count($new_value);
	echo $n.' jsem tady';
	
	
		$id=0;
	foreach ($new_value as $value) {
		$id++;
		
		if ($id==1) {
			$compound_stem.=','.$new_value[$id-1].'['.$new_value[$id-1].'-]'.'';
		} else 	if (($id!=1) AND ($id!=$n)) {
		$compound_stem.=','.$new_value[$id-1].'[-'.$new_value[$id-1].'-]'.',';	
		} else 	if ($id==$n) {
		$compound_stem.=','.$new_value[$id-1].'[-'.$new_value[$id-1].']'.',';	
		}
		
		
		
		
	}
		
	
			
		
		
}


if ($compound_stem!='') {

$sql = sprintf ('UPDATE `%s` SET `words_in_compound` = %s WHERE `id` = %s',
			$table,
			quate_smart($compound_stem),
			$returned[0]);
	
$oop9->Setnames();
$oop9->query($sql);
//echo $sql;
echo $oop9->getMysqlError();
$oop9->freeResult();
}
endwhile;


$oop_ipa->freeResult();

} else {
$location = 'Location: ipa.php';	
header($location);
}


if ($limit<220000){
$location = './ipa.php?action=compound&limit='.$limit;
} else {
$location = './ipa.php';	
}

$oop_ipa->_mySQL;
$oop9->_mySQL;
header("Refresh: 1; url=\"".$location."");
	
	
}


if ($_GET["action"]=='count') {
	
		
		$oop_ipa = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop4 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);

$table='ds_1_headword';
	  $table_ipa_hjal='ds_IPA_hjal';

$sql = sprintf ('SELECT `keyword` FROM `%s`',
			$table);
	
$oop_ipa->Setnames();
$oop_ipa->query($sql);
$dd=0;$pp=0;
while ($returned = $oop_ipa->fetchRow ()):
$pp++;
		
	
         $sql4 = sprintf ('SELECT `ipa` FROM `%s` WHERE `keyword` COLLATE `%s` = %s',
					$table_ipa_hjal,
					$collation_1,
					quate_smart($returned[0])); 
	
$oop4->Setnames();
$oop4->query($sql4);
$num_2 = $oop_ipa->getNumRows();

if ($num_2!=0) {
$dd++;	
}
$oop4->freeResult();

endwhile;

$oop_ipa->freeResult();
$oop_ipa->_mySQL;
$oop4->_mySQL;
echo 'Pocet nalezenych'.$dd.' z '.$pp;
//Pocet nalezenych9257 z 22116 
}

?>
</head>
<body>
<!-- Begin #content - Centers all content and provides edges for floated columns -->
<div id="content">

<div id="menu">


<?php include 'menu.php'; ?>


 <!-- Begin #main - Contains main-column blog content -->
<div id="left"> 
</div>
<div id="left_huge"> 
	 
Ipa confirm <a href="./ipa.php?action=confirm&limit=0&kind=single">generate SINGLE WORDS</a><br>
Ipa confirm <a href="./ipa.php?action=confirm&limit=0&kind=compound">generate COMPOUNDS</a><br>

Ipa count from hjal <a href="./ipa.php?action=count">Count</a>   <br>

Compound create<a href="./ipa.php?action=compound&limit=0">generate</a> <br>
     
  </div>
<!-- End #main -->
</div>

<br>



<div style="clear:both;"> </div>
</div>


<div id="footer">
<?=$lang_footer;?>
</div>


</div>

<?php 
include ('./html_end.php');
?>
