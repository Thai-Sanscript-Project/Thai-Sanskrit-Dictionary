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
include './scripts/redirect_admin.php';
include './scripts/image_resize.php';
include './head.php';
?>
<body onload="setfocus ()">
<div id="wrapper">
<?php include 'header.php'; 
include 'menu.php'; 
echo $MAIN_MENU;
?>
<div id="content">
<div class="left_huge">
<h2><?=$lang_publish22?></h2>
<p>
<?php 
if ($_GET["action"]=='latex') {
$ary[] = "UTF-8";
$ary[] = "ASCII";
mb_detect_order($ary);
mb_internal_encoding("UTF-8");
$a=true;
$char = array(	
							'0' => 'a',
							'1' => 'á',
							'2' => 'b',
							'3' => 'd',
							
							'4' => 'e',
							'5' => 'é',
							'6' => 'f',
							'7' => 'g',
							'8' => 'h',
							'9' => 'i',
							'10' => 'í',							
							'11' => 'j',
							'12' => 'k',
							'13' => 'l',
							'14' => 'm',
							'15' => 'n',
							'16' => 'o',
							'17' => 'ó',
							'18' => 'p',
							'19' => 'r',
							'20' => 's',
							'21' => 't',
							'22' => 'u',
							'23' => 'ú',
							'24' => 'v',
							'25' => 'y',
							'26' => 'ý',
							'27' => 'þ',
							'28' => 'æ',
							'29' => 'ö',
					);
$symbols_spec = array(	
							'arch.' => '\dsarchitectural',
							'mat.' => '\dsmathematical',
							'bot.' => '\dsbiological',
							'chem.' => '\dschemical',
							'techn.' => '\dstechnical',
							'zem.' => '\dsagricultural',
							'mil.' => '\dsmilitary',
							'let.' => '\dsaeronautical',
							'práv.' => '\dsjuridical',
							'ekon.' => '\dscommercial',
							'lit.' => '\dsliterary',
							'med.' => '\dsmedical',
							'biol.' => '\dsmedical',
							'fyz.' => '\Radioactivity',
							'astron.' => '\Sun',
							'zool.' => '{\large {\Bat}}',
							'fil.' => '{\small {\manstar}}',
							'prum.' => '{\scriptsize {\Industry}}',
							'sport.' => '\Football',
							'geol.' => 'geol.',
							'geog.' => 'geog.',
							'náb.' => '\Yinyang',
							'jaz.' => '\Writinghand',
							'elek.' => '\Lightning',
							'nám.' => '{\tiny {\anchor}}',
							'hud.' => '\SO',
							'poč.' => '{\scriptsize {\MVAt}}',
							'cykl.' => '\Bicycle',
							'pol.' => '\Gentsroom',
							'škol.' => ' škol.',
							'meteo.' => 'meteo.',
							);
	
$count=0; $record[$count]='pepa';
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
// !!unquate later this point, take a lot of time
$_xml='';
if ($_GET["option"]=='test'){
if ($_GET["limit"]>=400) {
$_xml = "";
$_xml .="\n";
$_xml .="\end{document}\n";
if ($_GET["option"]=='test') {
$file = fopen('./tmp/dictionary_test.tex','a');		
} else {
$file = fopen('./tmp/dictionary.tex','a');
}
if (!fwrite($file, $_xml)) {
print('Error writing to sluvka.tex');
}
fclose($file);
header('Location: ./fileprint.php');
Die();
}
}
$sql333 = sprintf ('SELECT * FROM `ds_1_headword` ORDER BY `keyword` COLLATE `%s`, `num_keyword` ASC LIMIT %s, 100',
	$collation_1,
	$_GET["limit"]);
$rew=0;
$oop->Setnames(); 
$oop->query($sql333);
$num89 = $oop->getNumrows();
if ($num89 != 0 ) {
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop11 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop33 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop_ipa = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
if ($_GET["limit"]==0) {
if ($_GET["option"]=='test') {
$file = fopen('./tmp/dictionary_test.tex','w');		
} else {
$file = fopen('./tmp/dictionary.tex','w');
}
fclose($file);
$_xml .="\documentclass[twocolumn]{book}\n";
// here you can change the margins in pdf
$_xml .="\usepackage[top=2cm, bottom=2cm, left=2cm, right=2cm]{geometry}\n";
// here you can change the margins in pdf
$_xml .="\usepackage{fancyhdr}\n";
 // here is necessary to use your babel language
$_xml .="\usepackage[icelandic, czech, english]{babel}\n";
$_xml .="\n";
$_xml .="\usepackage[utf8x, utf8]{inputenc}\n";
$_xml .="\usepackage[T1]{fontenc}\n";
$_xml .="\usepackage{enumitem}\n";
$_xml .="\usepackage{hanging}\n";
$_xml .="\\newcommand{\entry}[2]{\hangpara{2em}{1}\\textsf{\\textbf{#1}}\ #2\markboth{#1}{#1}\par}\\nopagebreak[4]\n";
//$_xml .="\\pagestyle{fancy}\n";
$_xml .="\\newcommand*{\dictchar}[1]{\centerline{\LARGE\\textbf{#1}}\par}\n";
$_xml .="\pagestyle{fancy}
\\fancypagestyle{basicstyle}{%
 \\fancyhf{}
  \\renewcommand{\headrulewidth}{0.4pt}
  \\renewcommand{\\footrulewidth}{0pt}
  \\fancyhead[LE,RO]{\\textsf{\\textbf{\\chaptitle}}}
  \\fancyhead[LO,RE]{\\textsf{\\textbf{\\thepage}}}}\n";
$_xml .="\\fancypagestyle{dictstyle}{%\n
  \\fancyhf{}
  \\fancyhead[LE,RO]{\\textsf{\\textbf{\\rightmark\ -- \leftmark}}}
  \\fancyhead[LO,RE]{\\textsf{\\textbf{\\thepage}}}}\n";
$_xml .="\usepackage{tipa}\n";
$_xml .="\usepackage{fix2col}\n";
$_xml .="\usepackage{marvosym}\n";
$_xml .="\usepackage{dingbat}\n";
$_xml .="\usepackage{manfnt}\n";
$_xml .="\usepackage{latexsym}\n";
$_xml .="\usepackage{graphicx}\n";
$_xml .="\usepackage{color}\n
\usepackage{titlesec}
\\titleformat{\chapter}[block]
  {\\normalfont\huge\bfseries}{\\thechapter.}{1em}{\Huge}
\\titlespacing*{\chapter}{20pt}{20pt}{20pt}
\definecolor{darkgreen}{rgb}{0.80,0.40,0.11}\n";
$_xml .="\graphicspath{{".$home_path_biolib."}{/home/chejnik/Dokumenty/web/HVALUR-JOINED/www/images/uploaded_files/}}\n";
$_xml .="\n";
$_xml .="\\title{\\textbf{Islandsko-český studijní slovník}\n";
$_xml .="       \\thanks{Tato kniha byla vytvořena v \LaTeX{}u pod Ubuntu 10.04. Poděkování patří všem autorům, kteří publikují pod svobodnými licencemi.}}\n";
$_xml .="\author{Aleš Chejn, Jón Gíslason}\n";
 $_xml .="\n";
$_xml .="\date{říjen 2011}\n";
$_xml .="\n";
$_xml .="\begin{document}\n";
$_xml .=" \makeatletter\@openrightfalse
\maketitle
\@openrighttrue\makeatother
\\renewcommand {\contentsname} {Obsah}
\\renewcommand {\chaptername} {Kapitola}
 \makeatletter\@openrightfalse
\\tableofcontents
\@openrighttrue\makeatother
\\newpage";
$_xml .="\pagestyle{basicstyle}\n
\\newcommand*{\sectitle}{}\n
\\renewcommand*{\sectionmark}[1]{%
    \\renewcommand*{\sectitle}{#1}}
\\newcommand*{\chaptitle}{}
\\renewcommand*{\chaptermark}[1]{%
    \\renewcommand*{\chaptitle}{#1}}
    \makeatletter\@openrightfalse\n";
$_xml .="\chapter{Průvodce po slovníku}
\@openrighttrue\makeatother
\n";	
// show the general information about dictionary from /language/cz(current language)/dictionary_instructions.tex
$instructions = file_get_contents("./language/cz/dictionary_instructions.tex");
$_xml .=$instructions;
// load the list of abbreviations
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
foreach ($arr_all as $id => $value) {
$sql2 = sprintf ('SELECT * FROM `%s`',
	$value);
$oop2->Setnames(); 
$oop2->query($sql2);
while($r = $oop2->fetchRow ()) :
$sw++;
for ($i = 1; $i < 8; $i++) {
if ($i==7) {
$new_arr[$sw][$i]=$id;		
} else {
$new_arr[$sw][$i]=$r[$i];
}
}
endwhile;
}
$songs = subval_sort($new_arr,'1'); 
$_xml .="\clearpage
\makeatletter\@openrightfalse
\chapter{Zkratky}
\@openrighttrue\makeatother \n";
$_xml .="\begin{description}\itemsep2pt\n";
foreach ($songs as $id => $v) {
	$_xml .="\item[\\small{". $v[1]."}] ";

	$_xml .="\\small{". $v[3]."}\n";

}
$_xml .="\end{description}\n";
$_xml .="\clearpage
\makeatletter\@openrightfalse
\\chapter{Islandsko-český studijní slovník}
\@openrighttrue\makeatother
\clearpage\n";
$_xml .="\pagestyle{dictstyle}\n";
$oop2->freeResult();

}
// there begins the all while loop / the main one
 while ($row = $oop->fetchArray()) :
 $num_walked++;
  // check whether there is homonym procedure
  // first load first word to help string
  // fill temp string 
  // check if the next word is the same
  // if so string replace the word with superscript string with word
  // if not copy temp string to xml final string
  // note -> control string replace according to whether we use stem word or keyword
  // we replace keyword string with superscript with keyword string
 // letter end
$table_dict="ds_2_senses";
$sql2 = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table_dict,
	$collation_1,
	quate_smart($row[1]),
	quate_smart ($row[2]));
$oop2->Setnames(); 
$oop2->query($sql2);
$num2 = $oop2->getNumrows(); 
$_wordxml=''; // empty the temp wordxml string container (full of last word)
$_wordentryxml=''; // empty the temp wordxml string container (full of last word)
// only one row in the table, one meaning
$pocet=1;	
while ($row2 = $oop2->FetchArray()) :
$char_f = mb_substr(trim($row[1]),0,1);
$char_f = strtolower($char_f);
if ($_GET["old_char"]==$char_f) {
} else {
$char_f_upper=strtoupper($char_f);
$_wordentryxml .="\\dictchar{".$char_f_upper."}";
$_GET["old_char"]=$char_f;
$found=TRUE;	
}
// first time it will create an article and a headword
if ($pocet == 1 ) { //5
$_wordentryxml .="\\entry{";
if ($row[3]=='') { 
// if stem is empty we fill it with headword value
$row[3]=$row[1];
}
if ($row[2]!=0) {
$_wordentryxml .="{\\textsuperscript{".$row[2]."}}{".$row[3]."}}"; }
else {
$_wordentryxml .="{".$row[3]."}}"; } // keyword with superscript if neccessary
$_wordentryxml .="{";
if ($row[4]!='') {
}
if ($row[6]!='') {
$ipa_pronunciation=$row[6];
$num_ipa=mb_strlen($ipa_pronunciation);
$new_ipa_pronunciation='';
$table_ipa='phonems_latex';
for ($ii = 0; $ii < $num_ipa; $ii++) {
$new_ipa_char='';
$ipa_char[$ii]= mb_substr($ipa_pronunciation,$ii,1);
$ipa_char[$ii+1]= mb_substr($ipa_pronunciation,$ii+1,1);
$sql_ipa = sprintf ('SELECT `latex_phonem` FROM `%s` WHERE `phonem` = %s',
	$table_ipa,
	quate_smart($ipa_char[$ii].$ipa_char[$ii+1]));
$oop_ipa->Setnames();
$oop_ipa->query($sql_ipa);
$num2 = $oop_ipa->getNumrows(); 
if ($num2!=0) {
$returned_ipa = $oop_ipa->fetchRow ();
$new_ipa_char=$returned_ipa[0];
if ($ii==$num_ipa-1) {
$new_ipa_pronunciation.='{'.$new_ipa_char.'}';
} else {
$new_ipa_pronunciation.='{'.$new_ipa_char.'}';		
}
$oop_ipa->FreeResult();
$ii++;
} else {
$oop_ipa->FreeResult();
$sql_ipa = sprintf ('SELECT `latex_phonem` FROM `%s` WHERE `phonem` = %s',
	$table_ipa,
	quate_smart($ipa_char[$ii]));
$oop_ipa->Setnames();
$oop_ipa->query($sql_ipa);
$returned_ipa = $oop_ipa->fetchRow ();
$new_ipa_char=$returned_ipa[0];
if ($ii==$num_ipa-1) {
$new_ipa_pronunciation.='{'.$new_ipa_char.'}';
} else {
$new_ipa_pronunciation.='{'.$new_ipa_char.'}';		
}
$oop_ipa->FreeResult();	
}
}
$_wordentryxml .="{\\textipa{[". $new_ipa_pronunciation . "]}}";
} // pronunciation
//etymology
if ($row[16]!='') {
$_wordentryxml .="{\\small{ ". $row[16] . "}}";} // etymology
if ($row[7]!='') {
$_wordentryxml .="{\color{darkgreen}{\\small{ ". $row[7] . "}}}";} // grammer word form
if ($row[8]!='') {
$_wordentryxml .="{\\small{ ". $row[8] . "}}";} // grammer endings
if ($row[9]!='') {
$_wordentryxml .="{\\small{ ". $row[9] . "}}";} // grammer additional
}//5
// the rest will make while loop, it fills the definition tags
if ($pocet>1) {$_wordentryxml .="";}
if ($row2[24]!='') {
$_wordentryxml .="{\\textbf{ ". $row2[24] . "}}";} //  phrase
if ($row2[19]!='') {
$_wordentryxml .="{ ". $row2[19] . "}";} // markers
if ($row2[13]!='') {
if (strpos(trim($row2[13]), '(')!=0) {
$new_value= explode ('(',trim($row2[13]));	
$new_num = str_replace("(","",$new_value[1]);
$new_num = str_replace(")","",$new_num);
$_wordentryxml .="{\\textit{ (\\textsuperscript{".$new_num."}". $new_value[0] .")}}"; // synonym 
} else {
$_wordentryxml .="{\\textit{ (". $row2[13] . ")}}"; // synonym 
}
}
if ($row2[4]!='') {
$_wordentryxml .="{\\textsl{\\textbf{ ". $row2[4] . "}}}";} // word
if ($row2[3]!='') {
$_wordentryxml .="{\\footnotesize{ ". $row2[3] . "}}";} // word grammer 
if ($row2[20]!='') {
$_wordentryxml .="{ ". $row2[20] . "}";} // sec markers
if ($row2[21]!='') {
$_wordentryxml .="\\foreignlanguage{czech}{{\\footnotesize{ ". $row2[21] . "}}}";} // specification
if ($row2[22]!='') {
$_wordentryxml .="{\\footnotesize{ ". $row2[22] . "}}";} // usage s
if ($row2[7]!='') {
$_wordentryxml .="\\foreignlanguage{czech}{{\\footnotesize{ ". $row2[7] . "}}}";} //  translation usage
if ($row2[5]!='') {
$_wordentryxml .="\\foreignlanguage{czech}{{ ". $row2[5] . "}}";} // direct translation
if ($row2[6]!='') {
$_wordentryxml .="{\\footnotesize {\\foreignlanguage{czech}{ ". $row2[6] . "}}}";} // translation detail 
if ($row2[10]!='') {
// $new_11 = str_replace("~", "$\sim$", $row3[11]);
$_wordentryxml .=" $\\triangleright$ "; // to devide the translation from example  
$_wordentryxml .="{\\textit{\\textbf{ ". $row2[10] . "}}}";} // example
if ($row2[11]!='') {
$_wordentryxml .="{\\textit{\\foreignlanguage{czech}{ ". $row2[11] . "}}}";} // example translation
if ($row2[17]!='') {
if (strpos(trim($row2[17]), '(')!=0) {
$new_value= explode ('(',trim($row2[17]));	
$new_num = str_replace("(","",$new_value[0]);
$new_num = str_replace(")","",$new_num);
$_wordentryxml .="{\\textit{ (\\textsuperscript{".$new_num."}". $new_value[1] . ")}}"; // antonym
} else {
$_wordentryxml .="{\\textit{ (". $row2[17] . ")}}"; // antonym
}
}
if ($row2[16]!='') {
$_wordentryxml .="{\\textit{ ". $row2[16] . "}}";} // latinnames
if ($row2[18]!='') {
if (strpos(trim($row2[18]), '(')!=0) {
$new_value= explode ('(',trim($row2[18]));	
$new_num = str_replace("(","",$new_value[0]);
$new_num = str_replace(")","",$new_num);
$_wordentryxml .=" $\\rightarrow$        \\textsuperscript{".$new_num."}". $new_value[1] . ""; // link to another keyentry
} else {
$_wordentryxml .=" $\\rightarrow$       ". $row2[18] . ""; // link to another keyentry
}
}
if ($num2!=$pocet) {
$_wordentryxml .=","; // comma to separate senses, only if last sense no comma
}
$pocet++; // increase of pocet
endwhile;
// image
// uploaded IMAGES
$num_found=0;
$table_images = 'ds_images';
$sql = sprintf ('SELECT `name_of_file`,`author`,`licence`, `orientation` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table_images,
	$collation_1,
	quate_smart($row[1]),
	quate_smart($row[2]));
$oop11->Setnames();
$oop11->query($sql);
$num2 = $oop11->getNumrows(); 
if ($num2!=0){
$image_found=TRUE;
$count_i=0;
while ($image = $oop11->fetchRow ()):
if ($count_i==0) {
$count_i++;
if ($image[3]==1) {
$_wordentryxml .= "\par\begin{center}\setlength\\fboxsep{0pt}\setlength\\fboxrule{0.5pt}\\fbox{\includegraphics[width=6cm]{".$image[0]."}}\end{center}";
} else {
$_wordentryxml .= "\par\begin{center}\setlength\\fboxsep{0pt}\setlength\\fboxrule{0.5pt}\\fbox{\includegraphics[height=6cm]{".$image[0]."}}\end{center}";
}
$_wordentryxml .= "\par\begin{center}\\footnotesize {Autor: ".$image[1]." ";
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
$_wordentryxml .=  "Licence: ".$image[2]."}\end{center}";
}
endwhile;
}
$oop11->FreeResult();
if ($image_found!==TRUE) {
$dict = 'ds_2_senses';
$biolib = 'ds_biolib_full';
$num_found=0;
$empty='';
$sql = sprintf ('SELECT `latinnames` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s AND `latinnames` != %s',
	$dict,
	$collation_1,
	quate_smart($row[1]),
	quate_smart($row[2]),
	quate_smart($empty));
$oop11->Setnames();
$oop11->query($sql);
$num2 = $oop11->getNumrows(); 
if ($num2 != 0) { // 1
$row_latin = $oop11->fetchRow ();
$cor1=10;
$sql33 = sprintf ('SELECT `D`, `A`, `H`, `I`, `F`, `E`, `status`, `id` FROM `%s` WHERE `B` = %s AND `C` != 0 AND `status`= %s ORDER BY `status` DESC',
	$biolib,				
	quate_smart($row_latin[0]),
	quate_smart($cor1));
$oop33->Setnames();
$oop33->query($sql33);
$num33= $oop33->getNumrows(); 
$add=FALSE;
while ($row_image = $oop33->fetchRow ()):
if ($add===FALSE) {
$filename = "/DISK2/WWW/hvalur.org/hvalur/images/biolib/full/".$row_image[0].".jpg";
if (file_exists($filename)) {
$add=TRUE;
$image = new SimpleImage();
$image->load($IMAGE_URL."images/biolib/full/".$row_image[0].".jpg");
$i_width=$image->getWidth();
$i_height=$image->getHeight();
if ($i_width>=$i_height) {
$_wordentryxml .= "\par\begin{center}\setlength\\fboxsep{0pt}\setlength\\fboxrule{0.5pt}\\fbox{\includegraphics[width=6cm]{".$row_image[0].".jpg}}\end{center}";
} else {
$_wordentryxml .= "\par\begin{center}\setlength\\fboxsep{0pt}\setlength\\fboxrule{0.5pt}\\fbox{\includegraphics[width=3cm]{".$row_image[0].".jpg}}\end{center}";
}
$_wordentryxml .= "\par\begin{center}\\footnotesize {Autor: ".$row_image[2]." ";
if ($row_image[3]=='Creative Commons Attribution-Share Alike 2.5 Generic')
{
$row_image[3]='cc-by-sa-2.5';
} else if ($row_image[3]=='Creative Commons Attribution 3.0')
{
$row_image[3]='cc-by-3.0';
} else if ($row_image[3]=='Creative Commons Attribution-Share Alike 3.0 Unported')
{
$row_image[3]='cc-by-sa-3.0-un';
} else if ($row_image[3]=='Public domain')
{
$row_image[3]='Public domain';
} else if ($row_image[3]=='GNU Free Documentation License')
{
$row_image[3]='GFDL';
} 
$_wordentryxml .=  "Licence: ".$row_image[3]."}\end{center}";
} else {
$add=FALSE;
}
}
endwhile;	
}
}
$oop11->FreeResult();
$oop33->FreeResult();
$image_found=FALSE;
$_wordentryxml .="}\n";
$_xml .= $_wordentryxml;
$oop2->freeResult();
$rew++;
endwhile;
// end of whole while loop 
$oop11->_mySQL;
$oop33->_mySQL;
$oop_ipa->_mySQL;
$oop->freeResult();
$oop->_mySQL;
$oop2->_mySQL;
if ($_GET["option"]=='test') {
$file = fopen('./tmp/dictionary_test.tex','a');		
	} else {
$file = fopen('./tmp/dictionary.tex','a');
	}
if (!fwrite($file, $_xml)) {
print('Error writing to sluvka.tex');
}
fclose($file);
$l=$_GET["limit"]+100;
$_SESSION["ses_message"] =  $lang_publish23." - ".$_GET["limit"]." - ".$l;
if ($_GET["option"]=='test') {
$location = $IMAGE_URL.'fileprint.php?action=latex&limit='.$l.'&old_char='.$_GET["old_char"].'&option=test'; 
} else {
$location = $IMAGE_URL.'fileprint.php?action=latex&limit='.$l.'&old_char='.$_GET["old_char"]; 	
}
header("Refresh: 2; url=\"".$location."");
} else {
if ($_GET["option"]!='test') {
$_xml = "";
$_xml .="\n";
$_xml .="\end{document}\n";
}
if ($_GET["option"]=='test') {
$file = fopen('./tmp/dictionary_test.tex','a');		
} else {
$file = fopen('./tmp/dictionary.tex','a');
}
if (!fwrite($file, $_xml)) {
print('Error writing to sluvka.tex');
}
fclose($file);
	
// send file to mail address	
/*	
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
$mail->AddAttachment("./tmp/sluvka.tex");         // add attachments
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
$mail->IsHTML(true);                                  // set email format to HTML

$mail->Subject = "User ".$row[1]." is sending file for Latex";
$mail->Body    = "Hi administrator, please can you print this file for me in Latex?";
$mail->AltBody = "Hi administrator, please can you print this file for me in Latex?";

if(!$mail->Send())
{
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   $_SESSION["ses_message"] ="Message could not be sent. <p> Mailer Error: " . $mail->ErrorInfo;
    
}
*/
$oop->freeResult();
$oop->_mySQL;
$_SESSION["ses_message"] = $lang_publish20;
header('Location: ./fileprint.php'); 
}
} else if ($_GET["action"]=='dsl') { 
$ary[] = "UTF-8";
$ary[] = "ASCII";
mb_detect_order($ary);
mb_internal_encoding("UTF-8");
$table_sound = 'ds_sound';
$a=true;
$count=0; $record[$count]='pepa';
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$_xml='';
if ($_GET["option"]=='test'){
if ($_GET["limit"]>200) {
if ($_GET["option"]=='test') {
$file = fopen('./tmp/dictionary_test.dsl','a');		
} else {
$file = fopen('./tmp/dictionary.dsl','a');
}
if (!fwrite($file, $_xml)) {
print('Error writing to is-cz-dictionary.dict');
}
fclose($file);
header('Location: ./fileprint.php');
}
}
$sql333 = sprintf ('SELECT * FROM `ds_1_headword` ORDER BY `keyword` COLLATE `%s`, `num_keyword` ASC LIMIT %s, 100',
	$collation_1,
	$_GET["limit"]);
$rew=0;
$oop->Setnames(); 
$oop->query($sql333);
$num89 = $oop->getNumrows();
if ($num89 != 0 ) {
if ($_GET["limit"]==0) {
if ($_GET["option"]=='test') {
$file = fopen('./tmp/dictionary_test.dsl','w');		
} else {
$file = fopen('./tmp/dictionary.dsl','w');
}
fclose($file);
}
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop11 = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$oop33 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop_ipa = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$num_walked=0;
// there begins the all while loop / the main one
 while ($row = $oop->fetchArray()) :
 $num_walked++;
$table_dict="ds_2_senses";
$sql2 = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table_dict,
	$collation_1,
	quate_smart($row[1]),
	quate_smart ($row[2]));
$oop2->Setnames(); 
$oop2->query($sql2);
$num2 = $oop2->getNumrows(); 
$_wordxml=''; // empty the temp wordxml string container (full of last word)
$_wordentryxml=''; // empty the temp wordxml string container (full of last word)
if ($num_walked==1) {
$_wordentryxml .='#NAME "'.$lang_header_dict.'"
#INDEX_LANGUAGE	"Icelandic"
#CONTENTS_LANGUAGE "Czech"';
$_wordentryxml .="\n\n";
}
// only one row in the table, one meaning
$pocet=0;	
while ($row2 = $oop2->FetchArray()) :
// first time it will create an article and a headword
if ($pocet == 0 ) { //5
$row[3] = str_replace("··","{··}",$row[3]);
$row[3] = str_replace("·","{·}",$row[3]);
$row[3] = str_replace("|","{|}",$row[3]);
if ($row[3]=="") { // if stem value is empty we fill it with headword value
$row[3]=$row[1];	
}
if ($row[2]!=0) {
$_wordentryxml .="{[sup]".$row[2]."[/sup]}".$row[3].""; 
} else {
$_wordentryxml .="".$row[3].""; } // keyword with superscript if neccessary
$_wordentryxml .="\n";
if ($row[4]!='') {
}
// this space is important for dsl format
$_wordentryxml .=" ";
if ($row[6]!='') {
$_wordentryxml .="\[". $row[6] . "\] ";
} // pronunciation
if ($row[16]!='') {
$_wordentryxml .="". $row[16] . "";} // etymology
if ($row[7]!='') {
$_wordentryxml .="[p]". $row[7] . "[/p] ";} // grammer word form
if ($row[8]!='') {
$_wordentryxml .="[p][i] ". $row[8] . "[/i][/p] ";} // grammer endings
if ($row[9]!='') {
$_wordentryxml .="[p][i] ". $row[9] . "[/i][/p] ";} // grammer additional
$sql = sprintf ('SELECT `sound` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table_sound,
	$collation_1,
	quate_smart($row[1]),
	quate_smart($row[2]));
$oop11->Setnames();
$oop11->query($sql);
$sound = $oop11->fetchRow ();
$oop11->FreeResult();
$_wordentryxml .="[s]".$sound[0]."[/s]";
}//5
// the rest will make while loop, it fills the definition tags
if ($pocet>0) {$_wordentryxml .="";}
$_wordentryxml .="\n [m1]";
if ($row2[24]!='') {
$_wordentryxml .="[c darkred][u] ". $row2[24] . "[/u][/c] ";} //  phrase
if ($row2[19]!='') {
$_wordentryxml .="[b]". $row2[19] . "[/b] ";} // markers
if ($row2[13]!='') {
if (strpos(trim($row2[13]), '(')!=0) {
$new_value= explode ('(',trim($row2[13]));	
$new_num = str_replace("(","",$new_value[1]);
$new_num = str_replace(")","",$new_num);
$_wordentryxml .="([sup]".$new_num."[/sup]<<". $new_value[0] .">>) "; // synonym 
} else {
$_wordentryxml .="(<<". $row2[13] . ">>) "; // synonym 
}
}
if ($row2[4]!='') {
// $new_11 = str_replace("~", "$\sim$", $row3[6]); 
$_wordentryxml .="[c darkred][b]". $row2[4] . "[/b][/c] ";} // word
if ($row2[3]!='') {
$_wordentryxml .="[p]". $row2[3] . "[/p] ";} // word grammer 
if ($row2[20]!='') {
$_wordentryxml .="[b]". $row2[20] . "[/b] ";} // sec markers
if ($row2[21]!='') {
$_wordentryxml .="[c darkgreen]". $row2[21] . "[/c] ";} // specification
if ($row2[22]!='') {
$_wordentryxml .="[c darkgreen]". $row2[22] . "[/c] ";} // usage s
if ($row2[7]!='') {
$_wordentryxml .="[c darkgreen][i]". $row2[7] . "[/i][/c] ";} // translation usage
if ($row2[5]!='') {
$_wordentryxml .="[trn]". $row2[5] . "[/trn] ";} // direct translation
if ($row2[6]!='') {
$_wordentryxml .="[i]". $row2[6] . "[/i] ";} // translation detail 
if ($row2[10]!='') {
$_wordentryxml .="[/m] ";
$_wordentryxml .="
   ";
$_wordentryxml .=" [m3][ex][c darkred]". $row2[10] . "[/c][/ex]"; // example
$_wordentryxml .="[ex] ". $row2[11] . "[/ex][/m] ";
$_wordentryxml .="
   ";
$_wordentryxml .=" [m1]";} // example translation
   
   
 
  
if ($row2[17]!='') {
if (strpos(trim($row2[17]), '(')!=0) {
$new_value= explode ('(',trim($row2[17]));	
$new_num = str_replace("(","",$new_value[0]);
$new_num = str_replace(")","",$new_num);
$_wordentryxml .="(x [sup]".$new_num."[/sup]<<". $new_value[1] . ">>) "; // antonym
} else {
$_wordentryxml .="(x <<". $row2[17] . ">>) "; // antonym
}
}
if ($row2[16]!='') {
$_wordentryxml .="([i]". $row2[16] . "[/i]) ";} // latinnames
if ($row2[18]!='') {
if (strpos(trim($row2[18]), '(')!=0) {
$new_value= explode ('(',trim($row2[18]));	
$new_num = str_replace("(","",$new_value[0]);
$new_num = str_replace(")","",$new_num);
$_wordentryxml .="-> [sup]".$new_num."[/sup]<<". $new_value[1] . ">> "; // link to another keyentry
} else {
$_wordentryxml .="->  <<". $row2[18] . ">> "; // link to another keyentry
}
}
if ($num2!=$pocet) {
$_wordentryxml .="[/m] "; // comma to separate senses, only if last sense no comma
}
$pocet++; // increase of pocet
endwhile;
// image
// uploaded IMAGES
$num_found=0;
$table_images = 'ds_images';
$sql = sprintf ('SELECT `name_of_file`,`author`,`licence`, `orientation` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table_images,
	$collation_1,
	quate_smart($row[1]),
	quate_smart($row[2]));
$oop11->Setnames();
$oop11->query($sql);
$num2 = $oop11->getNumrows(); 
if ($num2!=0){
$image_found=TRUE;
$count_i=0;
while ($image = $oop11->fetchRow ()):
if ($count_i==0) {
$count_i++;
if ($image[3]==1) {
$_wordentryxml .= "[s]th_".$image[0]."[/s]";
} else {
$_wordentryxml .= "[s]th_".$image[0]."[/s]";
}
$_wordentryxml .= "Autor: ".$image[1]."";
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
$_wordentryxml .=  "Licence: ".$image[2]."";
}
endwhile;
}
$oop11->FreeResult();
if ($image_found!==TRUE) {
$dict = 'ds_2_senses';
$biolib = 'ds_biolib_full';
$num_found=0;
$empty='';
$sql = sprintf ('SELECT `latinnames` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s AND `latinnames` != %s',
	$dict,
	$collation_1,
	quate_smart($row[1]),
	quate_smart($row[2]),
	quate_smart($empty));
$oop11->Setnames();
$oop11->query($sql);
$num2 = $oop11->getNumrows(); 
if ($num2 != 0) { // 1
$row_latin = $oop11->fetchRow ();
$cor1=10;
$sql33 = sprintf ('SELECT `D`, `A`, `H`, `I`, `F`, `E`, `status`, `id` FROM `%s` WHERE `B` = %s AND `C` != 0 AND `status`= %s ORDER BY `status` DESC',
	$biolib,				
	quate_smart($row_latin[0]),
	quate_smart($cor1));
$oop33->Setnames();
$oop33->query($sql33);
$num33= $oop33->getNumrows(); 
if ($num33!=0) {
$add=FALSE;
while ($row_image = $oop33->fetchRow ()):
if ($add===FALSE) {
// only thumbs 
$filename = "/DISK2/WWW/hvalur.org/hvalur/images/biolib/".$row_image[0].".jpg";
if (file_exists($filename)) {
    $add=TRUE;
$image = new SimpleImage();
// only thumbs 
$image->load($IMAGE_URL."images/biolib/".$row_image[0].".jpg");
$i_width=$image->getWidth();
$i_height=$image->getHeight();
if ($i_width>=$i_height) {
$_wordentryxml .= "[s]".$row_image[0].".jpg[/s]";
} else {
$_wordentryxml .= "[s]".$row_image[0].".jpg[/s]";
}
} else {
    $add=FALSE;
}
}
endwhile;
}
}
}
$oop11->FreeResult();
$oop33->FreeResult();
$image_found=FALSE;
// end of else condition
$_wordentryxml .="\n"; // comma to separate senses, only if last sense no comma
$_xml .= $_wordentryxml;
$oop2->freeResult();
 $rew++;
endwhile;
// end of whole while loop 
$oop11->_mySQL;
$oop33->_mySQL;
$oop_ipa->_mySQL;
$oop->freeResult();
$oop->_mySQL;
$oop2->_mySQL;
if ($_GET["option"]=='test') {
$file = fopen('./tmp/dictionary_test.dsl','a');		
} else {
$file = fopen('./tmp/dictionary.dsl','a');
}
if (!fwrite($file, $_xml)) {
print('Error writing to dictionary.dsl');
}
fclose($file);
$l=$_GET["limit"]+100;
$_SESSION["ses_message"] =  "Prošlá slova - ".$_GET["limit"]." - ".$l;
if ($_GET["option"]=='test') {
$location = $IMAGE_URL.'fileprint.php?action=dsl&limit='.$l.'&old_char='.$_GET["old_char"].'&option=test'; 
} else {
$location = $IMAGE_URL.'fileprint.php?action=dsl&limit='.$l.'&old_char='.$_GET["old_char"]; 	
}
header("Refresh: 2; url=\"".$location."");
} else {
if ($_GET["option"]=='test') {
$file = fopen('./tmp/dictionary_test.dsl','a');		
} else {
$file = fopen('./tmp/dictionary.dsl','a');
}
if (!fwrite($file, $_xml)) {
print('Error writing to dictionary.dsl');
}
fclose($file);

// send file in email	
/*	
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
$mail->AddAttachment("./tmp/sluvka.tex");         // add attachments
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
$mail->IsHTML(true);                                  // set email format to HTML

$mail->Subject = "User ".$row[1]." is sending file for Latex";
$mail->Body    = "Hi administrator, please can you print this file for me in Latex?";
$mail->AltBody = "Hi administrator, please can you print this file for me in Latex?";

if(!$mail->Send())
{
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   $_SESSION["ses_message"] ="Message could not be sent. <p> Mailer Error: " . $mail->ErrorInfo;
    
}
*/
$oop->freeResult();
$oop->_mySQL;
$_SESSION["ses_message"] = $lang_publish21;
header('Location: ./fileprint.php'); 
}
} else if ($_GET["action"]=='latex_intro'){
?>
<div id="left_huge">
</p>     
<h4><?=$lang_publish1?></h4><br>
<?=$lang_publish2?>
<br>
</p>
</div>
<?php
}  else if ($_GET["action"]=='sound_intro'){
 ?>
 <div id="main_search_page3">
</p>     
<strong> <?=$lang_publish3?></strong><br>
<?=$lang_publish4?>
 </p>
 </div>
<?php
 } else  if ($_GET["action"]=='truncate_biolib') {
 $oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
 $table_biolib="ds_biolib";
$sql = sprintf ('TRUNCATE TABLE `%s`',
	$table_biolib);
$oop->Setnames(); 
$oop->query($sql);
$_SESSION["ses_message"] = "Biolib table has been truncated.";
$oop->freeResult();
$oop->_mySQL;
header('Location: ./fileprint.php'); 
} else  if ($_GET["action"]=='create_biolib') {
 $oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop3 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
 $table_biolib="ds_biolib";
 $dict = 'ds_2_senses';
$dict_keyword = 'ds_1_headword';
$sql = sprintf ('SELECT `keyword`, `num_keyword`, `keyword_variant`  FROM `%s`',
	$dict_keyword);
$oop->Setnames(); 
$oop->query($sql);
$num_1 = $oop->getNumRows();
if ($num_1!=0) {
while ($row = $oop->FetchArray()) :
$empty='';
$zool='zool.';
$bot='bot.';
$sql = sprintf ('SELECT `latinnames`, `word`, `translation`  FROM `%s` WHERE (`latinnames` != %s AND (`specification` = %s OR `specification` = %s)) AND `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$dict,
	quate_smart($empty),
	quate_smart($zool),
	quate_smart($bot),
	$collation_1,
	quate_smart($row[0]),
	quate_smart($row[1]));
$oop2->Setnames(); 
$oop2->query($sql);
$num_2 = $oop2->getNumRows();
if ($num_2!=0) {
$row2 = $oop2->FetchArray();
// if there is no word
if ($row2[1]=='') {
$sql = sprintf ('INSERT INTO `%s` (`id`, `latin_name`, `icelandic_name`, `czech_name`)VALUES (NULL, %s, %s, %s)',
	$table_biolib,
	quate_smart($row2[0]),
	quate_smart($row[0]),
	quate_smart($row2[2]));
} else {
$sql = sprintf ('INSERT INTO `%s` (`id`, `latin_name`, `icelandic_name`, `czech_name`)VALUES (NULL, %s, %s, %s)',
	$table_biolib,
	quate_smart($row2[0]),
	quate_smart($row2[1]),
	quate_smart($row2[2]));	
}
$oop3->Setnames(); 
$oop3->query($sql);
$oop3->freeResult();
// if there is a keyword variant we add new row
if ($row[2]!='') {
// if there is no word
if ($row2[1]=='') {	
$sql = sprintf ('INSERT INTO `%s` (`id`, `latin_name`, `icelandic_name`, `czech_name`)VALUES (NULL, %s, %s, %s)',	
	$table_biolib,
	quate_smart($row2[0]),
	quate_smart($row[2]),
	quate_smart($row2[2]));
}
$oop3->Setnames(); 
$oop3->query($sql);
$oop3->freeResult();
}
}
$oop2->freeResult();
endwhile;
}
$_SESSION["ses_message"] = "Biolib table has been created.";
$oop->freeResult();
$oop->_mySQL;
$oop2->_mySQL;
$oop3->_mySQL;
header('Location: ./fileprint.php'); 
} else  if ($_GET["action"]=='download_image') { 
$biolib = 'ds_biolib_full';
$oop22 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$sql = sprintf ('SELECT `D` FROM `%s` WHERE `D` != 0 OR `D` IS NOT NULL',
	$biolib);
$oop22->Setnames();
$oop22->query($sql);
$num3= $oop22->getNumrows(); 
if ($num3 != 0) { // 1
$as=0;
while ($row_image = $oop22->fetchRow ()):
clearstatcache();
$filename = '/DISK2/WWW/hvalur.org/ds/images/biolib/'.$row_image[0].'.jpg';
if (!file_exists($filename)) {
$as++;
$image_url = "http://www.biolib.cz/IMG/THN/_".$row_image[0].".jpg";
$ch = curl_init();
$timeout = 0;
curl_setopt ($ch, CURLOPT_URL, $image_url);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
// Getting binary data
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
$image = curl_exec($ch);
curl_close($ch);
//The above example will just show the image to the screen, you can use 
$fp = fopen('/DISK2/WWW/hvalur.org/ds/images/biolib/'.$row_image[0].'.jpg', 'w'); 
//and replace the above with:
$ch = curl_init($image_url);
//$fp = fopen($this->tempFiles[0]['temp'], 'w');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_exec($ch);
curl_close($ch);
fclose($fp);
}
endwhile;
}	
$oop22->FreeResult();
$oop22->_mySQL;
$_SESSION["ses_message"] = "Number of new images downloaded = ".$as;
header('Location: ./fileprint.php'); 
} else {
if ($_SESSION["rights"]==1) {
?>
<h4><?=$lang_publish5?></h4><br>
<?=$lang_publish6?>
<br>
<?php 
echo "<a href =\"./fileprint.php?action=latex_intro\">".$lang_print_help2."</a>";
echo '<br>';
echo '<br>';
echo $lang_publish7;
echo '<br>';
echo "<a href=\"./fileprint.php?action=latex&first_time=true&limit=0&option=test\">$lang_publish8</a>";
echo '<br>';
echo '<br>';
echo $lang_publish9;
 echo "<a href=\"./fileprint.php?action=latex&first_time=true&limit=0\">$lang_publish10</a>";
echo '<br>';
echo '<br>';
echo $lang_publish11;
echo '<br>';
?>
<h4><?=$lang_publish12?></h4><br>
<?php
echo $lang_publish13;
echo '<br>';
?>
 <br>
 <?=$lang_publish14?><br>
 <a href ="./fileprint.php?action=dsl&first_time=true&limit=0&option=test"><?=$lang_publish15?></a> 
<br><br>
<?=$lang_publish16?>
<br>
<a href ="./fileprint.php?action=dsl&first_time=true&limit=0"><?=$lang_publish17?></a> 
<br>
<br>
<?=$lang_publish18?>
<br>
<br>
<?=$lang_publish19?>
<br>
<?php
 }
}
?>
</p>
<br>
</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div>
</div>
<?php 
include ('./html_end.php');
?>