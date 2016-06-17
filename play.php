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
include './head_s.php';
if(isset($_SESSION["right_answers"])){
	// nothing happens :)
	// value remains same
}else{
	// we inicialize the variable
	$_SESSION["right_answers"] = "0";
}

if(isset($_SESSION["wrong_answers"])){
	// nothing happens :)
	// value remains same
}else{
	// we inicialize the variable
	$_SESSION["wrong_answers"] = "0";
}
?>
<script type="text/javascript">
   function setfocus() {
   document.form1.answer_string.focus();
   }
</script>
<script type="text/javascript" src="<?=$IMAGE_URL?>audio/audio-player/audio-player.js"></script>  
         <script type="text/javascript">  
             AudioPlayer.setup("<?=$IMAGE_URL?>/audio/audio-player/player.swf", {  
                 width: 290,
		 autostart: "yes",
		 bg: "eeeeee",
		 initialvolume: 100,  
		  transparentpagebg: "yes",
		 leftbg: "eeeeee",
		 lefticon: "666666",
		 rightbg: "FFDDDD",
		 rightbghover: "ff7272",
		 righticon: "666666",
		 righticonhover: "666666",
		 text:"666666",
		 slider: "666666",
		 track: "FFFFFF",
		 border: "666666",
		 loader:" FFDDDD",
		 noinfo:"yes"
            });
           
         </script> 
</head>
<body onload="setfocus ()">
<div id="wrapper">
<?php include 'header.php';
include 'menu.php'; 
echo $MAIN_MENU;
?>
<div id="content">
<div class="left_huge">
<h2><?=$lang_play_header;?></h2> 
<p>
<?php
				
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table_sound = 'ds_sound';
				if ($_GET["reset"]=='yes') {
				$_SESSION["right_answers"]=0;
				$_SESSION["wrong_answers"]=0;
				}
				
				
				if ($_GET["answer"]=='yes') {

$sql2 = sprintf ('SELECT `keyword` FROM `%s` WHERE `sound` = %s',
					$table_sound,
					quate_smart(trim($_POST["num_file"]))); 
$oop2->Setnames();
$oop2->query($sql2);
$keyword = $oop2->fetchArray ();
$oop2->freeResult();	
echo '<table class="sample"> <tr> <td>';
if ($_POST["answer_string"]==$keyword[0]) {
echo '<img src="/images/icon_correct.jpg" border="0" alt="">'.$lang_play_answer1.' </td></tr><tr><td><h3>'.$keyword[0].'</h3>';
echo '</td> </tr> </table>';

$_SESSION["right_answers"]++;
} else {
	
	$_SESSION["wrong_answers"]++;
	
echo $lang_play_answer2.'</td><td> '.$lang_play_answer3.'';
echo '</td></tr>';
echo '<tr><td>';
echo '<h3>'.$keyword[0].'';
	


echo '</h3> </td><td><h3>'.$_POST["answer_string"].'</h3>';
echo '</td></tr><tr><td>';
$file = $IMAGE_URL."audio/uploaded_files/".$_GET["sound_file"];


?>
<p id="audioplayer_1"></p>  
         <script type="text/javascript">  
         AudioPlayer.embed("audioplayer_1", {soundFile: "<?=$file;?>", autostart: "no", width: 80});
         </script> 
       
         <?php
         echo '</td><td></td></tr>';
}
echo '</table>';
echo '<br>';
	echo '<table class="sample"> <tr> <td>';
	echo $lang_play_answer4;
	echo '</td><td>';
	echo $lang_play_answer5;
	echo '</td></tr><tr><td>';
	echo $_SESSION["right_answers"];
	echo '</td><td>';
	echo $_SESSION["wrong_answers"];
	echo '</td></tr></table>';
echo '<br>';
			echo '<h3><a href="./play.php">'.$lang_play_answer6.'</a></h3>';
			echo '<a href="./play.php?reset=yes">'.$lang_new_game.'</a>';
				} else { 

	$found_next=FALSE;
	while ($found_next===FALSE) {
	$num=rand(1, 21275);	
	
	 
	$count = count($_SESSION["result_list"]);
	//echo ' neni prazdny a tu asi chyba'.$count;
	$found_same=FALSE;
	for ($i = 0; $i < $count; $i++) {
		
		// the case when the list is not full
		if ($_SESSION["result_list"][$i]==$num) {
//		echo 'found same true';	
		$found_same=TRUE;
		
	  }
	  
	  	  }
		  
		  if ($found_same===FALSE) {
		$found_next=TRUE;
		$new_result_list=$num;
		
		
		// we add the new one to the beginning of the array
		if ($count!=0) {
	array_unshift($_SESSION["result_list"], $new_result_list);
		} else {
		$_SESSION["result_list"][0]=$new_result_list;	
		}
		  }
		
	}
$sql2 = sprintf ('SELECT `sound` FROM `%s` WHERE `id` = %s',
					$table_sound,
					quate_smart($num)); 
					
		
$oop2->Setnames();
$oop2->query($sql2);
$sound_file = $oop2->fetchArray ();
$oop2->freeResult();	

	$file = $IMAGE_URL."audio/uploaded_files/".$sound_file[0];


?>

<form action="play.php?answer=yes&sound_file=<?=$sound_file[0];?>" method="post" name="form1">

<br>	

 <p id="audioplayer_1"></p>  
         <script type="text/javascript">  
         AudioPlayer.embed("audioplayer_1", {soundFile: "<?=$file;?>"});
         </script> 
	 <br>
	 <br>
<input type="hidden" name="num_file" value="<?=$sound_file[0]?>">
<table  border="0">

<tr> <td> </td><td>
<span class="search_string">
<span onclick="document.form1.answer_string.value += 'ð';document.form1.answer_string.focus()" onmouseover="this.style.cursor='pointer'">ð</span>
<span onclick="document.form1.answer_string.value += 'þ';document.form1.answer_string.focus()" onmouseover="this.style.cursor='pointer'">þ</span>
<span onclick="document.form1.answer_string.value += 'æ';document.form1.answer_string.focus()" onmouseover="this.style.cursor='pointer'">æ</span>
<span onclick="document.form1.answer_string.value += 'ö';document.form1.answer_string.focus()" onmouseover="this.style.cursor='pointer'">ö</span>
|<span onclick="document.form1.answer_string.value += 'é';document.form1.answer_string.focus()" onmouseover="this.style.cursor='pointer'">é</span>
<span onclick="document.form1.answer_string.value += 'í';document.form1.answer_string.focus()" onmouseover="this.style.cursor='pointer'">í</span>
<span onclick="document.form1.answer_string.value += 'ó';document.form1.answer_string.focus()" onmouseover="this.style.cursor='pointer'">ó</span>
<span onclick="document.form1.answer_string.value += 'ú';document.form1.answer_string.focus()" onmouseover="this.style.cursor='pointer'">ú</span>
<span onclick="document.form1.answer_string.value += 'ý';document.form1.answer_string.focus()" onmouseover="this.style.cursor='pointer'">ý</span>
<span onclick="document.form1.answer_string.value += 'á';document.form1.answer_string.focus()" onmouseover="this.style.cursor='pointer'">á</span>
</span> 
</td>
</tr>
<tr> <td> <?=$lang_search_type;?></td> <td><input type="text" name="answer_string" class="inputbox search" value="" size="20" maxlength="70">
</td>
</tr>
<tr>
<td>
</td>
<td> 
<input type="submit" class="button2" name="submit" value="<?=$lang_play_button;?>"> <?=$lang_search_enter;?>
</td>
</tr>




</table>

</form>

<?php

				}
				
?>
				
				
		
		</div>
<div style="clear: both;">&nbsp;</div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div></div><?php 
include ('./html_end.php');
?>
