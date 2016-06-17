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
include './scripts/redirect_public.php';
include './head.php';
?>
<body onload="setfocus()">
<div id="wrapper">
<?php include 'header.php'; 
include 'menu.php'; 
echo $MAIN_MENU;
?>
<div id="content">
<div class="left_huge">
<h2><?=$lang_stats_head?></h2>
<h4><?=$lang_stats_1?></h4> <br>
<?php 
echo "<table class=\"sample\">";
echo "<tr>";
echo "<td>";
echo $lang_stats_num_fields;
echo "</td><td>";
echo $lang_stats_num_keywords;
echo "</td><td>";
echo $lang_stats_empty;
echo "</td><td>";
echo $lang_stats_unsure;
echo "</td></tr>";
echo "<tr><td>";
$dict = 'ds_2_senses';
$dict_keyword = 'ds_1_headword';
$dict_status = 'ds_2_senses_status';	
// number of fields
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$sql = sprintf ('SELECT `id` FROM `%s`',
	$dict);
$oop->Setnames(); 
$oop->query($sql);
$num2 = $oop->getNumrows();
echo $num2;

$oop->freeResult();
echo "</td><td>";
// number of keywords
$sql = sprintf ('SELECT `id` FROM `%s`',
	$dict_keyword);
$oop->Setnames();
$oop->query($sql);
$num2 = $oop->getNumrows();
$number_keywords=$num2;
echo $num2;

$oop->freeResult();
$re=$num2;
echo "</td><td>";
$count=0;
// number of empty translation fields
$sql = sprintf ('SELECT `id` FROM `%s` WHERE `translation`=%s AND `link`=%s GROUP BY `keyword` COLLATE `utf8_icelandic_ci`, `num_keyword`',
	$dict,
	quate_smart($h),
	quate_smart($h));
$oop->Setnames();
$oop->query($sql);
$num2 = $oop->getNumrows();
echo $num2;

$re=$num2;
$oop->freeResult();
$count=0;
echo "</td><td>";
// uncertain words
$h='???';
$sql = sprintf ('SELECT `id` FROM `%s` WHERE `translation`=%s GROUP BY `keyword` COLLATE `utf8_icelandic_ci`, `num_keyword`',
	$dict,
	quate_smart($h));
$oop->Setnames();
$oop->query($sql);
$num3 = $oop->getNumrows();
echo $num3;

echo "</td></tr></table>";
$oop->freeResult();
$count=0;
// number of visits > 0
$h=0;
$sql = sprintf ('SELECT `id` FROM `%s` WHERE `num_visits_private` > %s',
	$dict_keyword,
	quate_smart($h));
$oop->Setnames();
$oop->query($sql);
$num3 = $oop->getNumrows();
$procent= round(($num3/$number_keywords)*100);
echo "<br>";
echo "<table class=\"sample\">";
echo "<tr><td>";
echo $lang_stats_2;
echo "</td><td>";
echo $lang_stats_3;
echo "</td></tr><tr><td>";
echo $num3;
echo "</td><td>";
echo $procent." %";
echo "</td></tr></table>";
?>
<img src="./graph.php?per=<?=$procent; ?>" alt="76.82% graph">
<?php
$oop->freeResult();
echo "<br>";
echo "<br>";
echo "<table class=\"sample\">";
echo "<tr><td>";
echo $lang_stats_4;
echo "</td><td>";
echo $lang_stats_5;
echo "</td><td>";
echo $lang_stats_6;
echo "</td><td>";
echo $lang_stats_7;
echo "</td><td>";
echo $lang_stats_8;
echo "</td></tr><tr><td>";
$h='';
$sql = sprintf ('SELECT `id` FROM `%s` WHERE `example` != %s',
	$dict,
	quate_smart($h));
$oop->Setnames();
$oop->query($sql);
$num3 = $oop->getNumrows();
echo $num3;
$oop->freeResult();
$h='';
$sql = sprintf ('SELECT `id` FROM `%s` WHERE `example_translation` != %s',
	$dict,
	quate_smart($h));
$oop->Setnames();
$oop->query($sql);
$num3 = $oop->getNumrows();
echo "</td><td>";
echo $num3;
$oop->freeResult();
$h='';
$sql = sprintf ('SELECT `id` FROM `%s` WHERE `example_keyword` != %s',
	$dict,
	quate_smart($h));
$oop->Setnames();
$oop->query($sql);
$num3 = $oop->getNumrows();
echo "</td><td>";
echo $num3;
$oop->freeResult();
$h='';
$sql = sprintf ('SELECT `id` FROM `%s` WHERE `synonym` != %s',
	$dict,
	quate_smart($h));
$oop->Setnames();
$oop->query($sql);
$num3 = $oop->getNumrows();
echo "</td><td>";
echo $num3;
$oop->freeResult();
$h='';
$sql = sprintf ('SELECT `id` FROM `%s` WHERE `antonym` != %s',
	$dict,
	quate_smart($h));
$oop->Setnames();
$oop->query($sql);
$num3 = $oop->getNumrows();
echo "</td><td>";
echo $num3;
echo "</td></tr></table>";
$oop->freeResult();
?>
<h4><?=$lang_stats_9?></h4> <br>
<form action="stats.php" method="post" name="form1">
<table class="sample">
<tr>
<td>
<?=$lang_stats_10?>
</td>
<td>
<?=$lang_stats_11?>
</td>
<td>
</td>
</tr>
<tr>
<td>
<?php
$oop_sub = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$nnn=3;
$table= 'ds_users';
$sql_sub = sprintf ('SELECT * FROM `%s` WHERE `rights`< %s',             
	$table,
	quate_smart($nnn));
$oop_sub->query($sql_sub);	
$num=1;
echo '<select name="user" >';
while($returned_sub = $oop_sub->fetchRow ()) :
echo '<option value="'.$returned_sub[0].'"';
echo '>';
echo $returned_sub[1].'</option>';
$num++;
endwhile; 
echo '<option value="all" selected>'.$lang_stats_all.'</option>';
echo '</select> ';
$oop_sub->FreeResult();
?>
</td><td>
<select name="numrows" >
<option value="50"> 50</option>
<option value="100"> 100 </option>
<option value="150"> 150 </option>
<option value="200"> 200 </option>
<option value="300" selected> 300 </option>
<option value="400"> 400 </option>
<option value="all"> <?=$lang_stats_all?></option>
</select> 
</td>
<td> 
<input type="submit" class="button2" name="submit" value="<?=$lang_stats_button1?>"> </td>
</tr>
</table>
</form> 
<h4><?=$lang_stats_12?></h4> <br>
<?=$lang_stats_13?>
<br><br>
<form action="stats.php" method="post" name="form1">
<table class="sample">
<tr>
<td>
<?=$lang_stats_10?>
</td>
<td>
<?=$lang_stats_14?>
</td>
<td>
<?=$lang_stats_15?>
</td>
<td>
</td>
</tr>
<tr>
<td>
<?php
$oop_sub = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$nnn=3;
$table= 'ds_users';
$sql_sub = sprintf ('SELECT * FROM `%s` WHERE `rights`< %s',             
	$table,
	quate_smart($nnn));
$oop_sub->query($sql_sub);	
$num=1;
if ($_POST["user"]) {
$_SESSION["user_stats"]=$_POST["user"];	
}
if ($_SESSION["user_stats"]) {
$user=$_SESSION["user_stats"];	
} else {
$user=$_SESSION["id_user"];
}
echo '<select name="user" >';
while($returned_sub = $oop_sub->fetchRow ()) :
echo '<option value="'.$returned_sub[0].'"';
if ($returned_sub[0]==$user) {
echo ' selected';	
}
echo '>';
echo $returned_sub[1].'</option>';
$num++;
endwhile; 
echo '<option value="all">'.$lang_stats_all.'</option>';
echo '</select> ';
$oop_sub->FreeResult();
?>
</td>
<td>
<?php 
if ($_POST["year"]) {
$_SESSION["year"]=$_POST["year"];	
}
if ($_SESSION["year"]) {
$year=$_SESSION["year"];	
} else {
$year=date('Y');
}
?>
<select name="year" >
<?php
for ($i = 2008; $i <= date('Y'); $i++) {
echo "<option value=\"".$i."\"";
if ($year==$i) {echo 'selected';}
echo "> ".$i."</option>";	
}
?>
</select> 
</td>
<td>
<?php 
if ($_POST["month"]) {
$_SESSION["month"]=$_POST["month"];	
}
if ($_SESSION["month"]) {
$month=$_SESSION["month"];	
} else {
$month=date('m');
}
?>
<?php if ($month=='01') {echo 'selected';}?>
<select name="month" >
<option value="01" <?php if ($month=='01') {echo 'selected';}?>> <?=$lang_stats_m_1?></option>
<option value="02" <?php if ($month=='02') {echo 'selected';}?>> <?=$lang_stats_m_2?> </option>
<option value="03" <?php if ($month=='03') {echo 'selected';}?>> <?=$lang_stats_m_3?></option>
<option value="04" <?php if ($month=='04') {echo 'selected';}?>> <?=$lang_stats_m_4?> </option>
<option value="05" <?php if ($month=='05') {echo 'selected';}?>> <?=$lang_stats_m_5?></option>
<option value="06" <?php if ($month=='06') {echo 'selected';}?>> <?=$lang_stats_m_6?></option>
<option value="07" <?php if ($month=='07') {echo 'selected';}?>> <?=$lang_stats_m_7?></option>
<option value="08" <?php if ($month=='08') {echo 'selected';}?>> <?=$lang_stats_m_8?></option>
<option value="09" <?php if ($month=='09') {echo 'selected';}?>> <?=$lang_stats_m_9?></option>
<option value="10" <?php if ($month=='10') {echo 'selected';}?>> <?=$lang_stats_m_10?></option>
<option value="11" <?php if ($month=='11') {echo 'selected';}?>> <?=$lang_stats_m_11?></option>
<option value="12" <?php if ($month=='12') {echo 'selected';}?>> <?=$lang_stats_m_12?> </option>
</select> 
</td>
<td> <input type="submit" class="button2" name="submit_graph" value="<?=$lang_stats_button2?>"> </td>
</tr>
</table>
</form> 
<?php
if ($_POST["submit"]) {
$count=0;
$table=  'ds_work';
if ($_POST["user"]=='all') {
if ($_POST["numrows"]=='all') {
$sql = sprintf ('SELECT * FROM `%s` ORDER BY `num` DESC',
	$table);
} else {
$sql = sprintf ('SELECT * FROM `%s` ORDER BY `num` DESC LIMIT 0, %s',
	$table,
	$_POST["numrows"]);	
}
} else {
if ($_POST["numrows"]=='all') {
$sql = sprintf ('SELECT * FROM `%s` WHERE `id_user`=%s ORDER BY `num` DESC',
	$table,
	quate_smart($_POST["user"]));	
} else 
{
$sql = sprintf ('SELECT * FROM `%s` WHERE `id_user`=%s ORDER BY `num` DESC LIMIT 0, %s',
	$table,
	quate_smart($_POST["user"]),
	$_POST["numrows"]);	
}
}
$oop->Setnames(); 
$oop->query($sql);
$oop_sub = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table= 'ds_users';
$sql_sub = sprintf ('SELECT `nick` FROM `%s` WHERE `id_user`=%s',
	$table,
	quate_smart($_POST["user"]));
$oop_sub->Setnames();
$oop_sub->query($sql_sub);	
$returned_sub = $oop_sub->fetchRow ();
$user=$returned_sub[0];
$oop_sub->FreeResult();
echo "<br>";
echo '<table class="sample">';
if ($_POST["user"]!='all') {
echo '<tr> <td>'.$lang_stats_16.'</td> <td>'.$lang_stats_17.'</td> <td>'.$lang_stats_18.'</td> <td>'.$lang_stats_19.'</td> <td>'.$lang_stats_20.'</td>        </tr>';
} else {
echo '<tr> <td>'.$lang_stats_16.'</td><td>'.$lang_stats_10.'</td> <td>'.$lang_stats_17.'</td> <td>'.$lang_stats_18.'</td> <td>'.$lang_stats_19.'</td> <td>'.$lang_stats_20.'</td>        </tr>';
}
while($returned = $oop->fetchRow ()) :
$count++;
echo '<tr><td>';
echo '<entry class="nav">';
echo '<br> '.$count.'.  </entry></td>';
if ($_POST["user"]=='all') {
$oop_sub = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$nnn=4;
$table= 'ds_users';
$sql_sub = sprintf ('SELECT `nick` FROM `%s` WHERE `id_user`=%s AND `rights` < %s',
	$table,
	quate_smart($returned[1]),
	quate_smart($nnn));
$oop_sub->Setnames();
$oop_sub->query($sql_sub);	
$returned_sub = $oop_sub->fetchRow ();
$user=$returned_sub[0];
$oop_sub->FreeResult();
echo '<td>';
echo '<a href="user.php?user='.$returned[1].'">'.$user.'</a>  ';
echo '</td>';
}
echo '<td>'; echo '<entry class="nav">';
echo ''.$returned[2].'</entry>';
echo '</td>';
echo '<td>';
$load_stats=TRUE;
include './work.php';
foreach ($page as $k => $v) {
if ($k==$returned[3]) {
$value=$v;
}
}
echo '<entry class="specification">'.$value.'</entry>';
echo '</td>';
echo '<td>'; echo '<entry class="nav">';
if (($returned[3]==25) OR ($returned[3]==26)) {
echo '</entry>';
} else {
echo ''.$returned[7].'</entry>';	
}
echo '</td>';
echo '<td>';
if ($returned[5]!=0) {
echo '   <a href="search.php?list_kind=alpha&d_h='.$returned[4].'&d_h_n='.$returned[5].'"><sup>'.$returned[5].'</sup>'.$returned[4].'</a> ';
} else {
echo '   <a href="search.php?list_kind=alpha&d_h='.$returned[4].'&d_h_n='.$returned[5].'">'.$returned[4].'</a> ';
}
echo '</td></tr>';
endwhile;
echo '</table>';
$oop->freeResult();
$oop->_mySQL;
}
if ($_POST["submit_graph"]) {
	function deleteFirstChar( $string ) {
return substr( $string, 1 );
}
	$oop5 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table = 'ds_work';
$h='519';
$stats_title="day";
if ($_POST["user"]!='all') {
$sql = sprintf ('SELECT * FROM `%s` WHERE `activity`=%s AND `id_user`=%s',
	$table,
	quate_smart($h),
	quate_smart($_POST["user"]));
} else {
$sql = sprintf ('SELECT * FROM `%s` WHERE `activity`=%s',
	$table,
	quate_smart($h));
}
$oop5->Setnames(); 
$oop5->query($sql);
$num = $oop5->getNumRows();
function days_in_month($month, $year)
{
// calculate number of days in a month
return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
} 
$days = days_in_month($_POST["month"], $_POST["year"]);
$_SESSION["newgraph"]='';
for ($k = 1; $k <= $days; $k++) {
$_SESSION["newgraph"][$k]=0;
}
if ($num!=0) {
while ($returned = $oop5->fetchRow ()):
$date = explode(" ", $returned[2]);
$full_date = explode("-", $date[0]);
if ($_POST["year"]==$full_date[0]) {
if ($_POST["month"]==$full_date[1]) {
$r = $full_date[2][0]; 
if ($r==0) {
$full_date[2]=deleteFirstChar($full_date[2]);
}
$_SESSION["newgraph"][$full_date[2]]++;
}
}
endwhile;

?>
<img src="statsgraph.php" border="0" alt="">
<?php
} else {
echo "<br>";	
echo $lang_stats_21;	
}
$oop5->freeResult();
$oop5->_mySQL;
}
?>           
</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div></div><?php 
include ('./html_end.php');
?>