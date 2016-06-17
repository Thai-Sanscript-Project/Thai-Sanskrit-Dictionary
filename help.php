<?php
ini_set('arg_separator.output','&amp;');
include 'start.php';
include './scripts/redirect_public.php';
// language file


$dir_path = $dir.$_SESSION["lang"]."/lang_help.php";
include ($dir_path);

$table = 'ds_help';

if ($_SESSION["edithelp_show"]=='') {
	$_SESSION["edithelp_show"]='2';
}

if ($_GET["edithelp_show"]=='true') {
	if ($_SESSION["edithelp_show"]=='1') {$_SESSION["edithelp_show"]='2';}
else {$_SESSION["edithelp_show"]='1';} }

?>
<?php
include './head.php';
?>
<body onload="setfocus ()">


<div id="wrapper">

<?php include 'header.php'; ?>
<?php include 'menu.php'; 
echo $MAIN_MENU;?>
			
<div id="content">
<div class="left_huge">
          <h2>Nápověda - manuál</h2>
       
         
	 <p> <?php
	 if ($_GET["action"]=='confirm'){
		
	
	$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);

        $keyword_work = $_POST["keyword"];
	$num_keyword_work = $_POST["num_keyword"];
	
if ($_POST["id"]!='new') {
	

	// we update table, already know the id


	$sql = sprintf ('UPDATE `%s` SET `num_name` = %s, `name` = %s, `num_title` = %s, `title` = %s, `num_subtitle` = %s, `subtitle` = %s, `text` = %s, `update` = %s, `user` = %s WHERE `id` = %s',
				$table,					
					
					quate_smart($_POST["num_name"]),
					quate_smart($_POST["name"]),
					quate_smart($_POST["num_title"]),
					quate_smart($_POST["title"]),
					quate_smart($_POST["num_subtitle"]),
					quate_smart($_POST["subtitle"]),
					quate_smart($_POST["text"]),
					quate_smart($_POST["update"]),
					quate_smart($_POST["user"]),
					$_POST["id"]); 
	
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();

$oop->_mySQL;
	$_SESSION["ses_message"]='The help was edited.';
	

	$ip=$_POST["id"];
	  $page_id=515; 
  include './work.php'; 
	


} else  {
	if ($_POST["title"]!='') {
	//add new book

$sql = sprintf ('INSERT INTO `%s` (`id`, `num_name`, `name`, `num_title`, `title`, `num_subtitle`, `subtitle`, `text`, `update`, `user`) VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s)',
					$table,					
					quate_smart($_POST["num_name"]),
					quate_smart($_POST["name"]),
					quate_smart($_POST["num_title"]),
					quate_smart($_POST["title"]),
					quate_smart($_POST["num_subtitle"]),
					quate_smart($_POST["subtitle"]),
					quate_smart($_POST["text"]),
					quate_smart($_POST["update"]),
					quate_smart($_POST["user"]));	

/* query the database */
// add to dict1
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();

$oop->_mySQL;

$_SESSION["ses_message"]='Nová stránka nápověda byla uložena do databáze.';


	$ip=$_POST["id"];
	  $page_id=516; 
  include './work.php'; 
  
	}
	
	}


	$location = 'Location: ./help.php?num_name='.$_POST["num_name"].'&num_title='.$_POST["num_title"].'&num_subtitle='.$_POST["num_subtitle"];
header($location); 

	// delete action

	} else  if ($_GET["action"]=='delete_confirm'){
		
		
		
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$sql = sprintf ('DELETE FROM `%s` WHERE `id` = %s',
					$table,					
					quate_smart($_GET["id"]));
$oop->Setnames();
$oop->query($sql);
$oop->freeResult();

$_SESSION["ses_message"]='Stránka nápovědy byla smazána.';


	$ip=$_GET["id"];
	  $page_id=517; 
  include './work.php'; 
  
$location = 'Location: ./help.php';
header($location);		
		
		//preparation for delete confirm
	} else if ($_GET["action"]=='delete'){
		
		
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);


$sql = sprintf ('SELECT `id`, `subtitle`, `text` FROM `%s` WHERE `id`=%s',
	$table,
	quate_smart($_GET["id"]));		

$oop->Setnames(); 
$oop->query($sql);
$row = $oop->fetchArray();
		
	echo '<entry class="ses_message"> Chcete opravdu vymazat tuto stránku nápovědy '.$row[1].'? </entry><br>';
	echo '<a href="./help.php">Ne</a> ';
	echo '<a href="./help.php?action=delete_confirm&id='.$row[0].'"> ANO </a> ';
	
	echo '<br><br>';
	echo $row[2];
	
$oop->FreeResult();

$oop->_mySQL;	
	
	} else if ($_GET["action"]=='add'){
			

?>
 <div class="menu_sub">
<ul>
<li><input type="submit" class="button3" name="submit_direct" value="<?=$lang_edit_submit?>">
<li><a href="./help.php?page=toc">Zrušit</a> </li> 
</ul>

				</div>
<form action="help.php?action=confirm" method="post" name="form">


<table class="sample">

<tr>
<input type="hidden" name="id" value="new">
<td>Number of topic</td> <td><input type="text" class="inputbox" name="num_name" size="20" maxlength="80"  value=""> </td>

<td>Topic name</td> <td><input type="text" class="inputbox" name="name" size="20" maxlength="80"  value=""> </td>
</tr>

<tr>
<td>Number of title</td> <td><input type="text" class="inputbox" name="num_title" size="20" maxlength="80" value=""> </td>
<td>Title's name</td> <td><input type="text" class="inputbox" name="title" size="20" maxlength="80"  value=""> </td>
</tr>

<tr>
<td>Number of subtitle</td> <td><input type="text" class="inputbox" name="num_subtitle" size="20" maxlength="80" value=""> </td>
<td>Subtitle's name</td> <td><input type="text" class="inputbox" name="subtitle" size="20" maxlength="80" value=""> </td>

</tr>

<input type="hidden" name="update" value="<?=date("d. m. Y H:i:s");?>">
<input type="hidden" name="user" value="<?=$_SESSION["id_user"]?>">
</table>


<table width="100%" border="0">
<tr>
<td>Notes  </td>       
<td><textarea class="inputbox" name="text" size="20" rows="15" cols="100"></textarea> </td>

</tr>
</table>
</form>


  
</div>

<?php
	// edit bibliography
	} else if ($_GET["action"]=='edit'){
				


// in ds_1_headword we choose everything
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$sql = sprintf ('SELECT * FROM `%s` WHERE `id` = %s',
			$table,				
			quate_smart($_GET["id"]));

$oop->Setnames();
$oop->query($sql);
$returned = $oop->fetchRow ();
$oop->freeResult();
$oop->_mySQL;
?>

<div class="menu_sub">
<ul>
<li><input type="submit" class="button3" name="submit_direct" value="<?=$lang_edit_submit?>">
<li><a href="./help.php?page=toc">Zrušit</a> </li> 
</ul>

				</div>

 
<form action="help.php?action=confirm" method="post" name="form">


<table class="sample">

<tr>
<input type="hidden" name="id" value="<?=$returned[0]?>">
<td>Number of topic</td> <td><input type="text" class="inputbox" name="num_name" size="20" maxlength="80"  value="<?=$returned[1]?>"> </td>

<td>Topic name</td> <td><input type="text" class="inputbox" name="name" size="30" maxlength="80"  value="<?=$returned[2]?>"> </td>
</tr>

<tr>
<td>Number of title</td> <td><input type="text" class="inputbox" name="num_title" size="20" maxlength="80" value="<?=$returned[3]?>"> </td>
<td>Title's name</td> <td><input type="text" class="inputbox" name="title" size="30" maxlength="80"  value="<?=$returned[4]?>"> </td>
</tr>

<tr>
<td>Number of subtitle</td> <td><input type="text" class="inputbox" name="num_subtitle" size="20" maxlength="80" value="<?=$returned[5]?>"> </td>
<td>Subtitle's name</td> <td><input type="text" class="inputbox" name="subtitle" size="30" maxlength="80" value="<?=$returned[6]?>"> </td>
</tr>
      

<input type="hidden" name="update" value="<?=date("d. m. Y H:i:s");?>">
<input type="hidden" name="user" value="<?=$_SESSION["id_user"]?>">

</table>
<table width="100%" border="0">
<tr>
<td>Text </td>       
<td><textarea class="inputbox" name="text" size="30" rows="30" cols="100"><?=$returned[7]?></textarea> </td>

</tr>
</table>
</form>


  
</div>
<!-- End #main -->

<!-- End #content -->

<?php
		
		
	// print manual
} else  if ($_GET["action"]=='print'){
	
	
	
$count=0; $record[$count]='pepa';
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 




$_xml .="\documentclass[a4paper,12pt,oneside,titlepage]{book}\n";
$_xml .="\usepackage[czech, icelandic, english]{babel}\n";
$_xml .="\n";
$_xml .="\usepackage[utf8x, utf8]{inputenc}\n";
$_xml .="\usepackage[T1]{fontenc}\n";


$_xml .="\usepackage[pdftex]{graphicx}\n";

$_xml .="\n";
$_xml .="\\title{\\textbf{The Guide for Correct Record}\n";
$_xml .="       \\thanks{This file was created in \LaTeX\ in Ubuntu 9.04.}}\n";
$_xml .="\author{Hvalur.org}\n";
 $_xml .="\n";
$_xml .="\date{3. 11. 2009}\n";
$_xml .="\n";
$_xml .="\begin{document}\n";	
$_xml .="\maketitle";
$_xml .="\n";
$_xml .="\\tableofcontents";
$_xml .="\n";
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop3 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);


$table="ds_help";
$one='A';
$sql2 = sprintf ('SELECT * FROM `%s` WHERE `num_name` = %s ORDER BY `num_name`, `num_title`, `num_subtitle` ',
					$table,
					quate_smart($one));


$oop2->Setnames(); 
$oop2->query($sql2);

$num2 = $oop2->getNumrows(); 

// only one row in the table, one meaning
$pocet=1;	
while ($row = $oop2->FetchArray()) :

 
  $pocet++;


  //	 if ($row[2]!=$last_topic) {
 // topic name
//$_wordentryxml .="\\chapter {".$row[2]."}\n"; 
// $last_topic=$row[2];}
 
 if ($row[4]!=$last_title) { 
 // title name
 $_wordentryxml .="\\chapter {The Guide for Correct Record}\n"; 
 $last_title=$row[4];}
 
  if ($row[6]!=$last_subtitle) {
 // subtitle name
$_wordentryxml .="\\section{".$row[6]."}\n";  
$last_subtitle=$row[6];} 

 // html info
 $row[7] = str_replace  ('&', '',  $row[7]);
 $row[7] = str_replace  ('$', '',  $row[7]);
 $row[7] = str_replace  ('<br>', ' \par',  $row[7]);
 
 $row[7] = str_replace  ('<div id="help_title_summary">', '',  $row[7]); 
   $row[7] = str_replace  ('<help class="title_summary">', '',  $row[7]);
 
   $row[7] = str_replace  ('</help>', ' ',  $row[7]);
   $row[7] = str_replace  ('</div>', ' ',  $row[7]);
   


$row[7] = str_replace  ('<div id="help_image">', '',  $row[7]);



$pos = strpos($row[7], '<img src=');
while ($pos!==FALSE) :

	 
  $new_text = explode ('<img src="', $row[7]);
  
  $image_name = explode ('">', $new_text[1]);
 
  $row[7] = str_replace  ('<img src="'.$image_name[0].'">
', '\begin{center}
\includegraphics[scale=0.7]{/home/latex/tex'.$image_name[0].'}
\end{center}',  $row[7]);
  
$pos = strpos($row[7], '<img src=');

//Die();
  endwhile;
  
  // we get rid of local hyperlinks
  $pos = strpos($row[7], '<a name="');
while ($pos!==FALSE) :

	 
  $new_text = explode ('<a name="', $row[7]);
  
  $hyperlink = explode ('">', $new_text[1]);
 
  $row[7] = str_replace  ('<a name="'.$hyperlink[0].'">', '',  $row[7]);
  
$pos = strpos($row[7], '<a name="');

//Die();
  endwhile;
  
  // we get rid of hyperlinks
  $pos = strpos($row[7], '<a href="');
while ($pos!==FALSE) :

	 
  $new_text = explode ('<a href="', $row[7]);
  
  $hyperlink = explode ('">', $new_text[1]);
 
  $row[7] = str_replace  ('<a href="'.$hyperlink[0].'">', '',  $row[7]);
  
$pos = strpos($row[7], '<a href="');

//Die();
  endwhile;

  // the rest of hyperlinks
 $row[7] = str_replace  ('</a>', '',  $row[7]);
 
  $row[7] = str_replace  ('<strong>', '',  $row[7]);
   $row[7] = str_replace  ('</strong>', '',  $row[7]);

 
  $_wordentryxml .="".trim($row[7])."\n"; 

//\begin{center}
//\includegraphics{myimage.png}
//\end{center}
   
 $pocet++; // increase of pocet

   endwhile;


  $_wordentryxml .="\r\n";

 // end of else condition
$_xml .= $_wordentryxml;

//**********************8
// 2 = keyword
		
	
$oop2->freeResult();
 $rew++;
   // end of whole while loop 




$_xml .="\end{document}\n";
$_xml .="\endinput";



$oop6 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 

  
/* SQL statement to query the database */

$table= 'ds_users';
$sql = sprintf ('SELECT * FROM `%s` WHERE `id_user`=%s',
			$table,
			quate_smart($_SESSION["id_user"]));			
			

/* query the database */
$oop6->Setnames();
$oop6->query($sql);
$row = $oop6->fetchRow ();
$oop6->freeResult();

$file = fopen('./tmp/napoveda.tex','w');
	if (!fwrite($file, $_xml)) {
		print('Chyba při ukládání souboru napoveda.tex');
	}
	fclose($file);
	
require("./scripts/PHPMailer_v5.0.0/class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP();                                      // set mailer to use SMTP
$mail->Host = $mail_host;  // specify main and backup server
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = $mail_user;  // SMTP username
$mail->Password = $mail_password; // SMTP password

$mail->From = $row[3];
$mail->FromName = "DS - ".$row[1];
$mail->AddAddress($mail_admin, $mail_admin_name);
//$mail->AddAddress("ellen@example.com");                  // name is optional
//$mail->AddReplyTo("info@example.com", "Information");

$mail->WordWrap = 50;                                 // set word wrap to 50 characters
$mail->AddAttachment("./tmp/napoveda.tex");         // add attachments
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
$mail->IsHTML(true);                                  // set email format to HTML

$mail->Subject = "Uživatel ".$row[1]." tiskne soubor Nápovědy do Latexu";
$mail->Body    = "Soubor Nápovědy připravený pro tisk v LaTexu.";
$mail->AltBody = "Soubor Nápovědy připravený pro tisk v LaTexu.";

if(!$mail->Send())
{
 
   $_SESSION["ses_message"] ="Zprávu se nepovedlo odeslat. <p> Mailer Error: " . $mail->ErrorInfo;
    
}


$_SESSION["ses_message"] = "Na poštovní adresu administrátora byl vyslán e-mail s latexovým souborem obsahující Nápovědu.";
 
 	$oop->freeResult();
	$oop->_mySQL;
	

	
	  $page_id=518; 
  include './work.php'; 

	header('Location: ./help.php?page=toc'); 
	
} else {
	?>
	<div class="menu_sub">
<ul>
<li><a href="" target="_self" >navigace</a>
<ul>
<li><a href="./help.php?num_name=1">manuál k aplikaci</a> </li> 
<li><a href="./help.php?num_name=A">manuál k editaci slov</a></li> 
<li><a href="./manual_dictionary_system.php">manuál k aplikaci</a></li> 
<li><a href="./manual_edit_guide.php">manuál k úpravě heslových slov</a></li> 

</ul>
</li>
<li><a href="" target="_self" >pdf</a>
<ul>
<li><a href="./download/dictionary_system_manual.pdf">manuál (pdf soubor)</a></li> 
<li><a href="./download/the_guide_for_correct_record.pdf">manuál k editaci slov (pdf)</a></li>
</ul>
</li>
<li><a href="" target="_self" >editovat</a>
<ul>
<li><a href="./help.php?action=add">přidat novou stránku</a></li> 
</ul>
</li>
<li><a href="" target="_self" >tisknout</a>
<ul>
<li><a href="./help.php?action=print">tisknout manuál</a></li> 
<li><a href="./help.php?page=all">tisknout vše</a></li> 
</ul>
</li>
</ul>

				</div>
<?php
	// this section open to public
	///////////////////////////////
	
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop_sub = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop_nav = new mySQL ($host1, $user1, $pass1, $data1, TRUE);


  if ($_GET["page"]=='toc') {
$sql = sprintf ('SELECT * FROM `%s` ORDER BY `num_name`, `num_title`, `num_subtitle`',
	$table);	

  } else if ($_GET["page"]=='all') {
$sql = sprintf ('SELECT * FROM `%s` ORDER BY `num_name`, `num_title`, `num_subtitle`',
	$table);	

 } else if (($_GET["num_name"]!='') AND ($_GET["num_title"]!='') AND ($_GET["num_subtitle"]!='')) {
$sql = sprintf ('SELECT * FROM `%s` WHERE `num_name` = %s AND `num_title` = %s AND `num_subtitle` = %s ORDER BY `num_name`, `num_title`, `num_subtitle`',
	$table,           
	quate_smart($_GET["num_name"]),
	quate_smart($_GET["num_title"]),
	quate_smart($_GET["num_subtitle"]));
 } else if (($_GET["num_name"]!='') AND ($_GET["num_title"]!='')) {
$sql = sprintf ('SELECT * FROM `%s` WHERE `num_name` = %s AND `num_title` = %s ORDER BY `num_name`, `num_title`, `num_subtitle`',
	$table,
	quate_smart($_GET["num_name"]),
	quate_smart($_GET["num_title"]));
$_GET["page"]='toc';
 } else if ($_GET["num_name"]!='') {
$sql = sprintf ('SELECT * FROM `%s` WHERE `num_name` = %s ORDER BY `num_name`, `num_title`, `num_subtitle`',
	$table,
	quate_smart($_GET["num_name"]));	
$_GET["page"]='toc';
 }  
 
// echo $sql;
 
 
$oop->Setnames(); 
$oop->query($sql);


 while ($row = $oop->fetchArray()) :
 $as++;
 
 // edit image
 if ($_GET["page"]!='toc') {
 
	 if ($row[2]!=$last_topic) {
 // topic name
 echo '<div id="help_title">
<a href="./help.php?num_name='.$row[1].'"><help class="table_of_contants"><strong>'.$row[2].'</strong></help></a>

</div><br> '; 
 $last_topic=$row[2];}
 
 if ($row[4]!=$last_title) { 
 // title name
 echo '<div id="help_title">
<a href="./help.php?num_name='.$row[1].'&num_title='.$row[3].'"><help class="title">'.$row[3].'. '.$row[4].'</help></a>
</div>'; 
 $last_title=$row[4];}
 
  if ($row[6]!=$last_subtitle) {
 // subtitle name
 echo '<div id="help_title_sub">
<a href="./help.php?num_name='.$row[1].'&num_title='.$row[3].'&num_subtitle='.$row[5].'"><help class="title_sub">'.$row[3].'.'.$row[5].'. '.$row[6].'</help></a>
</div>'; 
$last_subtitle=$row[6];} 

 // html info
 echo '<div id="help_title_summary">';
 // nav arrows forward
$sql_nav = sprintf ('SELECT `subtitle`,`num_name`,`num_title`,`num_subtitle` FROM `%s` WHERE `order`> %s AND `num_name` = %s ORDER BY `order` ASC LIMIT 0,1',             
			$table,
			quate_smart($row[10]),
			quate_smart($row[1]));

$oop_nav->query($sql_nav);
$row_nav_bigger = $oop_nav->fetchRow ();
$oop_nav->freeResult();

 // nav arrows back
$sql_nav = sprintf ('SELECT `subtitle`,`num_name`,`num_title`,`num_subtitle` FROM `%s` WHERE `order`< %s AND `num_name` = %s ORDER BY `order` DESC LIMIT 0,1',             
			$table,
			quate_smart($row[10]),
			quate_smart($row[1]));

$oop_nav->query($sql_nav);
$row_nav_smaller = $oop_nav->fetchRow ();
$oop_nav->freeResult();
echo "<a href=\"help.php?num_name=".$row_nav_smaller[1]."&num_title=".$row_nav_smaller[2]."&num_subtitle=".$row_nav_smaller[3]."\"><img src=\"./images/pag_first.png\" border=\"0\" alt=\"\">".$row_nav_smaller[2].".".$row_nav_smaller[3].". ".$row_nav_smaller[0]."</a>";
 echo '<img src="images/icons/myicons/blank_table.png"  border="0" alt="">';
echo "<a href=\"help.php?num_name=".$row_nav_bigger[1]."&num_title=".$row_nav_bigger[2]."&num_subtitle=".$row_nav_bigger[3]."\">".$row_nav_bigger[2].".".$row_nav_bigger[3].". ".$row_nav_bigger[0]."<img src=\"./images/pag_last.png\" border=\"0\" alt=\"\"></a>";
  
  echo "<br>";
echo '<help class="title_summary">';
 echo $row[7];
 echo '</help>';
 echo "<br>";
 echo "<a href=\"help.php?num_name=".$row_nav_smaller[1]."&num_title=".$row_nav_smaller[2]."&num_subtitle=".$row_nav_smaller[3]."\"><img src=\"./images/pag_first.png\" border=\"0\" alt=\"\">".$row_nav_smaller[2].".".$row_nav_smaller[3].". ".$row_nav_smaller[0]."</a>";
 echo '<img src="images/icons/myicons/blank_table.png"  border="0" alt="">';
echo "<a href=\"help.php?num_name=".$row_nav_bigger[1]."&num_title=".$row_nav_bigger[2]."&num_subtitle=".$row_nav_bigger[3]."\">".$row_nav_bigger[2].".".$row_nav_bigger[3].". ".$row_nav_bigger[0]."<img src=\"./images/pag_last.png\" border=\"0\" alt=\"\"></a>";
  

echo '</div><br>';
 
if ($_GET["page"]!='all') {
 echo '<div id="help_footer">';

 // update plus user
 
 //--- we fill select field with the list of the users

$table= 'ds_users';
$sql_sub = sprintf ('SELECT `nick` FROM `%s` WHERE `id_user`=%s',             
			$table,
			quate_smart($row[9]));

$oop_sub->query($sql_sub);
$row_sub = $oop_sub->fetchRow ();
$oop_sub->freeResult();

 echo $row[8].' - '.$row_sub[0];
 echo '<a href="./help.php?action=edit&id='.$row[0].'"><img src="/images/icons/myicons/dec_2.png" border="0" alt=""></a>';
 echo '<a href="./help.php?action=delete&id='.$row[0].'"><img src="/images/icons/myicons/b_drop.png" border="0" alt=""></a>';
 echo '</div>';
}

 } else {

	 if ($row[2]!=$last_topic) { 
 // topic name
 echo '<div id="help_title">
<a href="./help.php?num_name='.$row[1].'"><help class="table_of_contants"><strong>'.$row[2].'</strong></help></a>

</div><br> '; 
	 $last_topic=$row[2];}

	  if ($row[4]!=$last_title) { 
 // title name
 echo '<div id="help_title">
<a href="./help.php?num_name='.$row[1].'&num_title='.$row[3].'"><help class="title">'.$row[3].'. '.$row[4].'</help></a>
</div>'; 
$last_title=$row[4];} 

 if ($row[6]!=$last_subtitle) {
 // subtitle name
 echo '<div id="help_title_sub">
<a href="./help.php?num_name='.$row[1].'&num_title='.$row[3].'&num_subtitle='.$row[5].'"><help class="title_sub">'.$row[3].'.'.$row[5].'. '.$row[6].'</help></a>
</div>'; 
	$last_subtitle=$row[6];} 
	
 }
 
 endwhile;
$oop->FreeResult();

$oop->_mySQL;


	?>
	


</div>
<?php } ?>
 </p>
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