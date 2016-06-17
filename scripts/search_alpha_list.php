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
if ($_GET["d_h"]) {
$_SESSION["d_h"]=$_GET["d_h"];
$_SESSION["d_h_n"]=$_GET["d_h_n"];
}
$count=0;
if ($cz===true) {
$collation=$collation_2;	
} else {
$collation=$collation_1;		
}
// 1. pagination
if (isset($_GET['pagenum'])) {
if ($_GET['pagenum']>$_SESSION["alpha_p"]) {
$_SESSION["num_alpha"]=$_SESSION["num_alpha"]+(($_GET['pagenum']-$_SESSION["alpha_p"])*30);
} else {
$_SESSION["num_alpha"]=$_SESSION["num_alpha"]-(($_SESSION["alpha_p"] - $_GET['pagenum'])*30);	
}
$_SESSION["alpha_p"] = $_GET['pagenum'];
} 
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop4 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
// SEARCH / IN THE WHOLE DATABASE 
$table="ds_1_headword";
if (!isset($_SESSION["num_keyword_in_dictionary"])) {
//all keywords in dictinary
$sql = sprintf ('SELECT `id` FROM `%s`',
	$table);
$oop->Setnames();
$oop->query($sql);
$_SESSION["num_keyword_in_dictionary"] = $oop->getNumRows();
$oop->freeResult();
}
if (($_SESSION["num_alpha"]=="") OR (($_GET["list_kind"]=="alpha") OR (isset($_GET["d_h"]) OR ($found_now===TRUE)))){
// SQL TO GET NUMBER OF RESULTS - FOR PAGINATION
	$sql = sprintf ('SELECT `id` FROM `%s` WHERE `keyword` COLLATE `%s` < %s  ORDER BY `keyword` COLLATE `%s`, `num_keyword`',
	$table,
	$collation,
	quate_smart($_SESSION["d_h"]),
	$collation);
$oop->Setnames();
$oop->query($sql);
$_SESSION["num_alpha"] = $oop->getNumRows();
$oop->freeResult();	
} else {
}
// PAGINATION
// 3. Calculate number of $lastpage
$rows_per_page = 30;
$lastpage      = ceil($_SESSION["num_keyword_in_dictionary"]/$rows_per_page);
// PAGINATION
// 4. Ensure that $pagenum is within range
$_SESSION["alpha_p"] = (int)$_SESSION["alpha_p"];
if ($_SESSION["alpha_p"] > $lastpage) {
$_SESSION["alpha_p"] = $lastpage;
} 
if ($_SESSION["alpha_p"] < 1) {
$_SESSION["alpha_p"] = 1;
} 
$_SESSION["alpha_p"]=ceil(($_SESSION["num_alpha"]/$rows_per_page)+0.01);
// PAGINATION
// 5. Construct LIMIT clause
$limit1=(($_SESSION["alpha_p"] - 1) * $rows_per_page);
$limit2=$rows_per_page;
$limit = 'LIMIT ' .$limit1 .',' .$limit2;
$sql = sprintf ('SELECT `keyword`, `num_keyword`,`stem`, `gram_1_word_group`, `gram_2_endings`, `gram_3_additional` FROM `%s` ORDER BY  `keyword` COLLATE `%s`, `num_keyword` %s',
	$table,
	$collation,
	$limit);
$oop->Setnames();
$oop->query($sql);
$num = $oop->getNumRows();
// begin flickr pagination
if (($_SESSION["alpha_p"]==$lastpage) AND ($_SESSION["alpha_p"]==1)) {
} else {
if ($_SESSION["alpha_p"]>1) {
 $prevpage = $_SESSION["alpha_p"]-1;
$BUFFER_ALPHA_LIST .= " <a href=\"".$_SERVER['PHP_SELF']."?pagenum=".$prevpage."\"><img src=\"/images/left_arrow_pink.png\" border=\"0\" alt=\"\"></a>";
} else {
$BUFFER_ALPHA_LIST .= '<img src="/images/left_arrow_noactive.png" border="0" alt="">';	
}
$stop=false;
$nextpage = $_SESSION["alpha_p"]+1;
if ($_SESSION["alpha_p"]<$lastpage) {
$BUFFER_ALPHA_LIST .= " <a href=\"".$_SERVER['PHP_SELF']."?pagenum=".$nextpage."\"><img src=\"/images/right_arrow_pink.png\" border=\"0\" alt=\"\"></a>";
} else {
$BUFFER_ALPHA_LIST .= '<img src="/images/right_arrow_noactive.png" border="0" alt="">';
}
}
$BUFFER_ALPHA_LIST .= '<br><br>';
// end of flickr pagination
while($returned = $oop->fetchRow ()) :
$count++;
if ($returned[1]==0) {
$BUFFER_ALPHA_LIST .= "<a href=\"search.php?list_kind=alpha&amp;d_h=".$returned[0]."&amp;d_h_n=".$returned[1]."\">";
// highlight
if (($returned[0]==$_SESSION["d_h"]) AND ($returned[1]==$_SESSION["d_h_n"])) {
$BUFFER_ALPHA_LIST .= "<span class=\"e5\">";
} else {
$BUFFER_ALPHA_LIST .= "<span class=\"e3\">";	
}
$BUFFER_ALPHA_LIST .= $returned[0]."</span></a>";
} else {
$BUFFER_ALPHA_LIST .= "<a href=\"search.php?list_kind=alpha&amp;d_h=".$returned[0]."&amp;d_h_n=".$returned[1]."\">";
// highlight
if (($returned[0]==$_SESSION["d_h"]) AND ($returned[1]==$_SESSION["d_h_n"])) {
$BUFFER_ALPHA_LIST .= "<span class=\"e5\">";
} else {
$BUFFER_ALPHA_LIST .= "<span class=\"e3\">";	
}
$BUFFER_ALPHA_LIST .= "<sup>".$returned[1]."</sup>".$returned[0]."</span>";
$BUFFER_ALPHA_LIST .= " <span class=\"e4\"> ".$returned[3]." </span></a>"; 		
}
$BUFFER_ALPHA_LIST .="<br>";
endwhile; 	
$oop->freeResult();
$BUFFER_ALPHA_LIST .="<br>";
?>
