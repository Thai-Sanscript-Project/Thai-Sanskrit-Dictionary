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
// language file
$dir  = "./language/";
$dir_path = $dir.$_SESSION["lang"]."/language_dictionary_instructions.php";
include ($dir_path);
?>
<?php include './head_s.php'; ?>
<script type="text/javascript">	
function setfocus() {
document.form1.search_string.focus();
}
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=300,height=100,left = 412,top = 334');");
}
</script>
<script type="text/javascript" src="<?=$IMAGE_URL?>audio/audio-player/audio-player.js"></script>  
<script type="text/javascript">  
AudioPlayer.setup("<?=$IMAGE_URL?>audio/audio-player/player.swf", {  
width: 290,
bg: "eeeeee",
initialvolume: 100,  
transparentpagebg: "yes",
leftbg: "eeeeee",
lefticon: "666666",
rightbg: "e8cae4",
rightbghover: "e9a0c0",
righticon: "666666",
righticonhover: "666666",
text:"666666",
slider: "e8cae4",
track: "FFFFFF",
border: "666666", 
loader:" e8cae4"
});  
</script> 
<script type="text/javascript" src="<?=$IMAGE_URL?>scripts/thickbox-compressed.php"></script>
</head>
<body onload="setfocus ()">
<div id="wrapper">
<?php include 'header.php'; ?>
<?php 
include 'menu.php'; ?>
<?php
echo $MAIN_MENU;
?>
<div id="content">
<?php 
$ins.="<div class=\"left_huge\">
<h2><a name=\"top\"></a>".$lang_di_title."</h2>
<div class=\"menu_sub\">
<ul>
<li><a href=\"\">".$lang_di_tableofcontants."</a>
<ul>
<li><a href=\"#1_guide\">1. ".$lang_di_title1."</a></li>
<li><a href=\"#2_guide\">2. ".$lang_di_title2."</a></li>
<li><a href=\"#3_guide\">3. ".$lang_di_title3."</a></li>
<li><a href=\"#4_guide\">4. ".$lang_di_title4."</a></li>
<li><a href=\"#5_guide\">5. ".$lang_di_title5."</a></li>
<li><a href=\"#6_guide\">6. ".$lang_di_title6."</a></li>
<li><a href=\"#7_guide\">7. ".$lang_di_title7."</a></li>
<li><a href=\"#8_guide\">8. ".$lang_di_title8."</a></li>
<li><a href=\"#9_guide\">9. ".$lang_di_title9."</a></li>
<li><a href=\"#10_guide\">10. ".$lang_di_title10."</a></li>
<li><a href=\"#11_guide\">11. ".$lang_di_title11."</a></li>
<li><a href=\"#12_guide\">12. ".$lang_di_title12."</a></li>
<li><a href=\"#13_guide\">13. ".$lang_di_title13."</a></li>
<li><a href=\"#14_guide\">14. ".$lang_di_title14."</a></li>
</ul>
</li>
</ul>
</div>";

$ins.="<span class=\"guide_title\"><a name=\"1_guide\"></a><a href=\"#top\">1. ".$lang_di_title1."</a></span><br>";

$ins.="<h4>1.1 ".$lang_di_title1_sub1." </h4>
".$lang_di_title1_sub2."
<br>
<strong>a, á, b, d, ð, e, é, f, g, h, i, í, j, k, l, m, n, o, ó, p, r, s, t, u, ú, v, x, y, ý, þ, æ, ö</strong>";

$ins.="<h4>1.2 ".$lang_di_title1_sub3."</h4>
".$lang_di_title1_sub4."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">ráð··hús</span>
</div></div>
".$lang_di_title1_sub5."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">við·bótar··líf·eyris·sparnað|ur</span>
</div></div>
".$lang_di_title1_sub6."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">heils|a</span> <span class=\"pos\">f (-u) </span>
</div></div>
".$lang_di_title1_sub7."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">við··|bragð</span> <span class=\"pos\">n (-bragðs, -brögð)</span>
</div></div>

<h4>1.3 ".$lang_di_title1_sub8."</h4>
".$lang_di_title1_sub9." 
<div class=\"guide\">
<div class=\"main_entry_guide\">	
<span class=\"e1\">albatros|i <a href=\"./search.php?action=find&d_h=albatros&d_h_n=0\">albatros</a></span> <span class=\"pos\">m (-a, -ar)</span>
</div></div>

<h4>1.4 ".$lang_di_title1_sub10." </h4>
".$lang_di_title1_sub11."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\"><sup>1</sup>vor</span> <span class=\"pos\">n (-s, -)</span> <br>
<span class=\"e1\"><sup>2</sup>vor</span> <span class=\"pos\">pron poss</span>
</div></div>
".$lang_di_title1_sub12."

<br><br>
<span class=\"guide_title\"><a name=\"2_guide\"></a><a href=\"#top\">2. ".$lang_di_title2."</a></span>
".$lang_di_title2_sub1."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">af</span> <span class=\"pos\">prep/ adv</span>
</div></div>
".$lang_di_title2_sub2."

<h4>2.1 ".$lang_di_title2_sub3."</h4>
".$lang_di_title2_sub4."
<div class=\"guide\">
<div class=\"main_entry_guide\">	
<span class=\"e1\">hestur</span> <span class=\"pos\"> m</span><br>
<span class=\"e1\">kona </span> <span class=\"pos\">f</span><br>
<span class=\"e1\">hús </span> <span class=\"pos\">n</span>
</div></div>

<h4>2.2 ".$lang_di_title2_sub5."</h4>
".$lang_di_title2_sub6."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">fallegur</span> <span class=\"pos\"> adj</span><br>
<span class=\"e1\">fremri</span> <span class=\"pos\"> adj comp</span><br>
<span class=\"e1\">einasti</span> <span class=\"pos\"> adj sup</span>
</div></div>
".$lang_di_title2_sub7."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">líkur</span> <span class=\"pos\"> adj dat</span>
</div></div>

<h4>2.3 ".$lang_di_title2_sub8."</h4>
".$lang_di_title2_sub9."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\"><sup>2</sup>hver</span> <span class=\"pos\"> pron</span><br>
<span class=\"e1\">þessi</span> <span class=\"pos\"> pron dem</span><br>
<span class=\"e1\">minn</span> <span class=\"pos\"> pron poss</span><br>
<span class=\"e1\">ég</span> <span class=\"pos\"> pron pers </span><br>
<span class=\"e1\">nokkur</span> <span class=\"pos\"> pron indef</span>
</div></div>
".$lang_di_title2_sub10."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">mig</span> <span class=\"pos\"> pron pers acc sg</span>
</div></div>

<h4>2.4 ".$lang_di_title2_sub11."</h4>
".$lang_di_title2_sub12."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">tuttugu</span> <span class=\"pos\"> num</span><br>
<span class=\"e1\">tveir</span> <span class=\"pos\"> num m</span><br>
<span class=\"e1\">tvær</span> <span class=\"pos\"> num f</span><br>
<span class=\"e1\">tvö</span> <span class=\"pos\"> num n</span><br>
<span class=\"e1\">fyrsti</span> <span class=\"pos\"> num ord</span>
</div></div>

<h4>2.5 ".$lang_di_title2_sub13."</h4>
".$lang_di_title2_sub14."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">fara</span> <span class=\"pos\"> v</span><br>
<span class=\"e1\">nálgast</span> <span class=\"pos\"> v refl</span><br>
<span class=\"e1\">svima</span> <span class=\"pos\"> v impers</span>
</div></div>
".$lang_di_title2_sub15."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">klór|a</span> <span class=\"pos\"> v acc/dat</span>
</div></div>
".$lang_di_title2_sub16."
<div class=\"guide\">
<div class=\"main_entry_guide\">	
<span class=\"e1\">gefa</span> <span class=\"pos\"> v dat + acc</span>
</div></div>
 
<h4>2.6 ".$lang_di_title2_sub17."</h4>
".$lang_di_title2_sub18."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">nýlega</span> <span class=\"pos\"> adv</span><br>
<span class=\"e1\">ofar</span> <span class=\"pos\"> adv comp </span><br>
<span class=\"e1\">síðast</span> <span class=\"pos\"> adv sup</span>
</div></div>

<h4>2.7 ".$lang_di_title2_sub19."</h4>
".$lang_di_title2_sub20."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">af</span> <span class=\"pos\"> prep/ adv dat</span><br>
<span class=\"e1\">fyrir</span> <span class=\"pos\"> prep/ adv acc/ dat</span><br>
<span class=\"e1\">milli</span> <span class=\"pos\"> prep gen</span>
</div></div>

<h4>2.8 ".$lang_di_title2_sub21."</h4>
".$lang_di_title2_sub22."

<h4>2.9 ".$lang_di_title2_sub23."</h4>
".$lang_di_title2_sub24."

<h4>2.10 ".$lang_di_title2_sub25."</h4>
".$lang_di_title2_sub26."

<br><br>
<span class=\"guide_title\"><a name=\"3_guide\"></a><a href=\"#top\">3. ".$lang_di_title3."</a></span>
".$lang_di_title3_sub1."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class =\"nav\">".$lang_di_title3_sub2."</span><a href=\"./search.php?list_kind=alpha&amp;long_dec=true&amp;d_h=hvalur&amp;d_h_n=0\"><span class =\"nav\">  ".$lang_di_title3_sub3."</span></a>
<table class=\"sample\">
<tr><th colspan=\"3\" align=\"center\"><span class=\"dec_info\">".$lang_di_gram1."</span></th>
<th colspan=\"3\" align=\"center\"><span class=\"dec_info\">".$lang_di_gram2."</span></th></tr>
<tr>
<td width=\"10%\"></td>
<td align=\"center\" width=\"20%\"><span class=\"dec_info\">".$lang_di_gram3."</span></td>
<td align=\"center\" width=\"20%\"><span class=\"dec_info\">".$lang_di_gram4."</span></td>
<td width=\"10%\"></td>
<td align=\"center\" width=\"20%\"><span class=\"dec_info\">".$lang_di_gram3."</span></td>
<td align=\"center\" width=\"20%\"><span class=\"dec_info\">".$lang_di_gram4."</span></td>
</tr>
<tr>
<td><span class=\"dec_info\">1.p</span></td>
<td>hvalur</td>
<td>hvalurinn</td>
<td><span class=\"dec_info\">1.p</span></td>
<td>hvalir</td>
<td>hvalirnir</td>
</tr>
<tr>
<td><span class=\"dec_info\">4.p</span></td>
<td>hval</td>
<td>hvalinn</td>
<td><span class=\"dec_info\">4.p</span></td>
<td>hvali</td>
<td>hvalina</td>
</tr>
<tr>
<td><span class=\"dec_info\">3.p</span></td>
<td>hval</td>
<td>hvalnum</td>
<td><span class=\"dec_info\">3.p</span></td>
<td>hvölum</td>
<td>hvölunum</td>
</tr>
<tr>
<td><span class=\"dec_info\">2.p</span></td>
<td>hvals</td>
<td>hvalsins</td>
<td><span class=\"dec_info\">2.p</span></td>
<td>hvala</td>
<td>hvalanna</td>
</tr>
</table>
</div>
</div>
<br><br><br><br>
".$lang_di_title3_sub4."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class =\"nav\"".$lang_di_title3_sub2."</span><a href=\"./search.php?list_kind=alpha&amp;long_dec=true&amp;d_h=bókahilla&amp;d_h_n=0\"><span class =\"nav\">  ".$lang_di_title3_sub3."</span></a>
<table class=\"sample\">
<tr><th colspan=\"3\" align=\"center\"><span class=\"dec_info\">".$lang_di_gram1."</span></th>
<th colspan=\"3\" align=\"center\"><span class=\"dec_info\">".$lang_di_gram2."</span></th></tr>
<tr>
<td width=\"10%\"></td>
<td align=\"center\" width=\"20%\"><span class=\"dec_info\">".$lang_di_gram3."</span></td>
<td align=\"center\" width=\"20%\"><span class=\"dec_info\">".$lang_di_gram4."</span></td>
<td width=\"10%\"></td>
<td align=\"center\" width=\"20%\"><span class=\"dec_info\">".$lang_di_gram3."</span></td>
<td align=\"center\" width=\"20%\"><span class=\"dec_info\">".$lang_di_gram4."</span></td>
</tr>
<tr>
<td><span class=\"dec_info\">1.p</span></td>
<td>~hilla</td>
<td>~hillan</td>
<td><span class=\"dec_info\">1.p</span></td>
<td>~hillur</td>
<td>~hillurnar</td>
</tr>
<tr>
<td><span class=\"dec_info\">4.p</span></td>
<td>~hillu</td>
<td>~hilluna</td>
<td><span class=\"dec_info\">4.p</span></td>
<td>~hillur</td>
<td>~hillurnar</td>
</tr>
<tr>
<td><span class=\"dec_info\">3.p</span></td>
<td>~hillu</td>
<td>~hillunni</td>
<td><span class=\"dec_info\">3.p</span></td>
<td>~hillum</td>
<td>~hillunum</td>
</tr>
<tr>
<td><span class=\"dec_info\">2.p</span></td>
<td>~hillu</td>
<td>~hillunnar</td>
<td><span class=\"dec_info\">2.p</span></td>
<td>~hillna</td>
<td>~hillnanna</td>
</tr>
</table>
</div>
</div>
<br><br>
".$lang_di_title3_sub5."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">mynd</span> <span class=\"pos\"> f (-ar, -ir)</span><br>
<span class=\"e1\">á··|lag</span> <span class=\"pos\"> n (-lags, -lög) </span><br>
<span class=\"e1\">maður</span> <span class=\"pos\"> m (manns, menn)</span>
</div></div>
".$lang_di_title3_sub6."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">beð|ur</span> <span class=\"pos\"> m (-s/-jar, -ir)</span>
</div></div>

<h4>3.1 ".$lang_di_title3_sub7."</h4>
".$lang_di_title3_sub8."
<div class=\"guide\">
<div class=\"main_entry_guide\">	
<span class=\"e1\">hval|ur</span> <span class=\"pos\"> m (-s, -ir)</span>
</div></div>
".$lang_di_title3_sub9."
 ".$lang_di_title3_sub10."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">heisl|a</span> <span class=\"pos\"> (-u)</span>
</div></div>
".$lang_di_title3_sub11."
".$lang_di_title3_sub12."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">afar··kostir</span> <span class=\"pos\"> m pl</span>
</div></div>
".$lang_di_title3_sub13."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">fræði</span> <span class=\"pos\"> f indecl</span>
</div></div>

<h4>3.2 ".$lang_di_title3_sub14."</h4>
".$lang_di_title3_sub15."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">reglu··|samur</span> <span class=\"pos\"> adj (f -söm)</span><br>
<span class=\"e1\">hýr </span> <span class=\"pos\">adj (f hýr)</span><br>
<span class=\"e1\">tví··mála</span> <span class=\"pos\"> adj indecl</span><br>
</div></div>

<h4>3.3.".$lang_di_title3_sub16."</h4>
".$lang_di_title3_sub17."
3.3.1 ".$lang_di_title3_sub18."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">ætl|a</span> <span class=\"pos\"> v (-aði)</span>
</div></div>

3.3.2 ".$lang_di_title3_sub19."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">kenn|a</span> <span class=\"pos\"> v (-di, -t) </span>
</div></div>
".$lang_di_title3_sub20."

3.3.3 ".$lang_di_title3_sub21."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">grípa</span> <span class=\"pos\"> v (gríp, greip, gripum, gripið) acc</span>
</div></div>

<h4>3.4. ".$lang_di_title3_sub22."</h4>
".$lang_di_title3_sub23."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">batn/a</span> <span class=\"pos\"> v (-aði)</span>
<div class=\"main_e_g_a\">
...<br>
<span class=\"markers\">2.</span><span class=\"word\"> e-m batnar </span><span class=\"pos\">impers </span><span class=\"dtrn2\">(kdo) se uzdravuje, (komu) je lépe </span> 
<div class=\"viewkeyword_examples\">	<span class=\"ex\">
Mér batnaði fljótt.</span> <span class=\"ex_translation\">Rychle jsem se uzdravil. </span>
</div></div>
</div></div>
".$lang_di_title3_sub24." 
".$lang_di_title3_sub25."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">bót</span> <span class=\"pos\"> f (bótar, bætur)</span>
<div class=\"main_e_g_a\">
...<br>
<span class=\"word\">bætur</span> <span class=\"syn\">(tryggingafé)</span> <span class=\"pos\">pl</span> <span class=\"dtrn2\">dávky, příspěvky </span>
</div>
</div></div>
".$lang_di_title3_sub26."

<br><br>
<span class=\"guide_title\"><a name=\"4_guide\"></a><a href=\"#top\">4. ".$lang_di_title4."</a></span>

<h4>4.1 ".$lang_di_title4_sub1."</h4>
".$lang_di_title4_sub2."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">landa··fræði</span> <span class=\"pos\"> f indecl</span>
<div class=\"main_e_g_a\">
<span class=\"dtrn2\">zeměpis, geografie</span>
</div>
</div></div>
".$lang_di_title4_sub3."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">að··stoð</span> <span class=\"pos\"> f (-ar)</span> 
<div class=\"main_e_g_a\">
<span class=\"dtrn2\">(malá) pomoc 
</span>
</div>
</div></div>
".$lang_di_title4_sub4."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">fíkj|a</span> <span class=\"pos\"> f (-u, -ur)</span>
<div class=\"main_e_g_a\">
<span class=\"specification\">bot.</span> <span class=\"dtrn2\">fík (plod) 
</span>
</div>
</div></div>
".$lang_di_title4_sub5."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">að·gengi··legur</span> <span class=\"pos\"> adj</span>
<div class=\"main_e_g_a\">
<span class=\"dtrn2\">přístupný (vchod ap.) 
</span>
</div>
</div></div>
".$lang_di_title4_sub6."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">andlits··fall</span> <span class=\"pos\"> n (-s)</span>
<div class=\"main_e_g_a\">
<span class=\"dtrn2\">rysy/podoba tváře </span>
</div>
</div></div>
".$lang_di_title4_sub7."

<h4>4.2 ".$lang_di_title4_sub8."</h4>
".$lang_di_title4_sub9." 
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">til··ber|i</span> <span class=\"pos\"> m (-a, -ar)</span> 
<div class=\"main_e_g_a\">
<span class=\"specification2\">pov.</span> <span class=\"ex_translation\">stvoření, které dojí krávy a ovce jiných hospodářů
</span>
</div>
<span class=\"e1\">klein|a</span> <span class=\"pos\"> f (-u, -ur)</span> 
<div class=\"main_e_g_a\">
<span class=\"specification2\">
kulin. </span><span class=\"ex_translation\">druh islandské koblihy 
</span>
</div>
</div></div>

<h4>4.3 ".$lang_di_title4_sub10."</h4>
".$lang_di_title4_sub11."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">lær|a</span> <span class=\"pos\">v (-ði, -t) acc</span>
<div class=\"main_e_g_a\">
...<br>
<span class=\"word\">læra utanbókar</span> <span class=\"dtrn2\">učit se zpaměti, memorovat</span>
</div>
</div></div>
".$lang_di_title4_sub12." 
<br><br>
4.3.1 	".$lang_di_title4_sub13." <br>
".$lang_di_title4_sub14."
<div class=\"guide\">
<div class=\"main_entry_guide\">	
<span class=\"e1\">bót</span> <span class=\"pos\"> f (bótar, bætur)</span>
<div class=\"main_e_g_a\">
...<br>
<span class=\"word\">bætur</span> <span class=\"syn\">(tryggingafé)</span> <span class=\"pos\"> pl</span> <span class=\"dtrn2\">dávky, příspěvky</span> 
</div>
</div></div>
".$lang_di_title4_sub15."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">finna</span> <span class=\"pos\"> v (finn, fann, fundum, fundið) acc</span>
<div class=\"main_e_g_a\">
...<br>
<span class=\"word\">finnast</span> <span class=\"pos\"> refl</span> <span class=\"dtrn2\">potkat se, setkat se, shledat se</span> 
</div></div></div>
".$lang_di_title4_sub16."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">drekka</span> <span class=\"pos\">
<div class=\"main_e_g_a\">
...<br>
<span class=\"word\">drukkinn</span> <span class=\"pos\"> pp </span> → <span class=\"link\">drukkinn</span>
</div>
</div></div>
".$lang_di_title4_sub17."
<br><br>
4.3.2	 ".$lang_di_title4_sub18."<br>
".$lang_di_title4_sub19." 
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">leit/a</span> <span class=\"pos\"> v (-aði) gen</span>
<div class=\"main_e_g_a\">...<br>
<span class=\"word\">leita að e-u</span> <span class=\"pos\">dat</span> <span class=\"dtrn2\">hledat (co)</span>
<div class=\"viewkeyword_examples\">	<span class=\"ex\">leita að lyklunum</span> <span class=\"ex_translation\">hledat klíče</span>  
</div>
</div></div></div>
<br><br>
4.3.3	 ".$lang_di_title4_sub20." <br>
".$lang_di_title4_sub21."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<div class=\"main_e_g_a\">
<span class=\"word\">leita e-s dyrum og dyngjum</span> <span class=\"dtrn2\">hledat (co/ koho) úplně všude/ po všech čertech</span>
</div>
</div></div>
<br><br>
4.3.4	 ".$lang_di_title4_sub22." <br>
<div class=\"guide\">
<div class=\"main_entry_guide\">	
<span class=\"e1\">eik</span> <span class=\"pos\"> f (-ar/-ur, -ur)</span>
<div class=\"main_e_g_a\">...<br>
<span class=\"word\">Eplið fellur sjaldan langt frá eikinni.</span> <span class=\"specification2\">přís.</span> <span class=\"dtrn2\">Jablko nepadá daleko od stromu.</span>
</div>
</div></div>
<div class=\"guide\">
<div class=\"main_entry_guide\">
<div class=\"main_e_g_a\">
<span class=\"word\">halda á e-u</span> <span class=\"dtrn2\">držet (co), nést (co)</span>
</div></div></div>
".$lang_di_title4_sub23."
".$lang_di_title4_sub24."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">blín|a</span> <span class=\"pos\"> v (-di, -t)</span>
<div class=\"main_e_g_a\">...<br>
<span class=\"word\">blína á e-ð/e-n</span> <span class=\"dtrn2\">koukat se na (co/koho)</span> 
</div></div></div>
".$lang_di_title4_sub25."
".$lang_di_title4_sub26."
<div class=\"guide\">
<div class=\"main_entry_guide\">	
<span class=\"e1\"><sup>1</sup>ár</span> <span class=\"pos\"> f (-ar, -ar) </span>
<div class=\"main_e_g_a\">...<br>
<span class=\"word\">taka (of) djúpt í árinni</span> <span class=\"specification2\">přen.</span> <span class=\"dtrn2\">přehnat (co v tvrzení)</span>
</div>
</div></div>
".$lang_di_title4_sub27."

<br><br>
<span class=\"guide_title\"><a name=\"5_guide\"></a><a href=\"#top\">5. ".$lang_di_title5."</a></span>

<h4>5.1. ".$lang_di_title5_sub1."</h4>
".$lang_di_title5_sub2." 
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">land</span> <span class=\"pos\"> n (lands, lönd) </span>
<div class=\"main_e_g_a\">
<span class=\"markers\">1.</span> <span class=\"syn\">(þurrlendi)</span> <span class=\"dtrn2\">souš, pevnina, země</span> <br>
<span class=\"markers\">2.</span> <span class=\"syn\">(árbakki)</span> <span class=\"dtrn2\">břeh </span><br>
<span class=\"markers\">3.</span> <span class=\"syn\">(ríki)</span> <span class=\"dtrn2\">země, stát </span><br>
<span class=\"markers\">4.</span> <span class=\"syn\">(landareign)</span> <span class=\"dtrn2\">pozemek</span> <br>
</div>
</div></div>

<h4>5.2. ".$lang_di_title5_sub3."</h4>
".$lang_di_title5_sub4."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">drag</span> <span class=\"pos\"> n (drags, drög) </span>
<div class=\"main_e_g_a\">
<span class=\"dtrn2\">mokřina, podmoklý terén</span> <br>
<span class=\"word\">drög</span><span class=\"markers\"> a.</span> <span class=\"syn\">(uppsprettur)</span> <span class=\"pos\"> pl</span> <span class=\"dtrn2\">prameny (řeky ap.)</span><br> 
<span class=\"word\">drög</span> <span class=\"markers\">b.</span> <span class=\"syn\">(undirbúningur)</span> <span class=\"pos\"> pl </span><span class=\"dtrn2\">náčtr, návrh</span>   <br>
</div>
</div></div>

<br><br>
<span class=\"guide_title\"><a name=\"6_guide\"></a><a href=\"#top\">6. ".$lang_di_title6." </a></span>
".$lang_di_title6_sub1."

<h4>6.1 ".$lang_di_title6_sub2."</h4>
".$lang_di_title6_sub3."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">tím|i</span> <span class=\"pos\"> m (-a, -ar) </span>
<div class=\"main_e_g_a\">
<span class=\"markers\">1.</span> <span class=\"syn\">(tíð)</span> <span class=\"dtrn2\">čas</span> <br>
<span class=\"word\">í þann tíma</span> <span class=\"syn\">(<sup>2</sup>þá)</span> <span class=\"dtrn2\">pak</span> <br>
<span class=\"markers\">2.</span> <span class=\"syn\">(klukkustund)</span> <span class=\"dtrn2\">hodina (šedesát minut)</span> <br>
</div>
</div></div>

<h4> 6.2. ".$lang_di_title6_sub4."</h4>
".$lang_di_title6_sub5."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">finna</span> <span class=\"pos\"> v (finn, fann, fundum, fundið) acc </span>
<div class=\"main_e_g_a\">
<span class=\"markers\">1.</span> <span class=\"syn\">(uppgötva)</span> <span class=\"dtrn2\">najít, nalézt</span> <br>
...<br>
<span class=\"markers\">3.</span> <span class=\"syn\">(skynja)</span> <span class=\"dtrn2\">cítit, vnímat</span> <br>
...<br>
♦<br>
<span class=\"word\">finna að</span> <span class=\"syn\">(gagnrýna)</span> <span class=\"dtrn2\">kritizovat, nacházet chyby </span><br>
...<br>
</div>
</div></div>

<h4> 6.3 ".$lang_di_title6_sub6.":</h4>
".$lang_di_title6_sub7." 
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\"><sup>2</sup>koma</span> <span class=\"pos\"> v (kem, kom, komum, komið) dat</span>
<div class=\"main_e_g_a\">
...<br>
<span class=\"pos\">koma + úr</span><br>
<span class=\"word\">e-ð er komið úr móð</span> <span class=\"dtrn2\">(co) vychází z módy</span><br>
<span class=\"pos\">koma + út</span><br>
<span class=\"word\">koma út</span> <span class=\"dtrn2\">vyjít, objevit se </span><br>
<span class=\"word\">koma upp úr kafinu</span><span class=\"dtrn2\"> objasnit se, vyjasnit se</span><br>
...<br>
</div>
</div></div>
".$lang_di_title6_sub8."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<div class=\"main_e_g_a\">
... <br>	
<span class=\"pos\">komast</span><br>
<span class=\"word\">komast</span> <span class=\"pos\"> refl</span> <span class=\"dtrn2\">přijet, dostat se</span> <br>
...<br>
</div>
</div></div>
".$lang_di_title6_sub9." 
<div class=\"guide\">
<div class=\"main_entry_guide\">
<div class=\"main_e_g_a\">
...<br>
<span class=\"pos\">kominn</span> <br>
<span class=\"word\">kominn af góðu fólki</span> <span class=\"dtrn2\">být z dobré rodiny</span><br>
...<br>
</div></div></div>
".$lang_di_title6_sub10."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<div class=\"main_e_g_a\">
... <br>
<div class=\"phrase_show\">
<span class=\"pos\">
".$lang_di_title5_sub3."</span>
</div>
<span class=\"word\">koma e-u heim og saman</span> <span class=\"syn\">(samrýma)</span> <span class=\"dtrn2\">uvést v soulad</span> <br>
...<br></div>
</div></div>
".$lang_di_title6_sub13."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<div class=\"main_e_g_a\">
...<br>
<div class=\"phrase_show\">
<span class=\"pos\">
".$lang_di_title6_sub11."</span>
</div>
<span class=\"word\">Ekki (eigi) fellur eik við fyrsta högg.</span> <span class=\"specification2\">přís.</span> <span class=\"dtrn2\">Jedna vlaštovka jaro nedělá.</span> 
</div></div></div>

<br><br>
<span class=\"guide_title\"> <a name=\"7_guide\"></a><a href=\"#top\">7. ".$lang_di_title7."</a></span>

<h4> 7.1 ".$lang_di_title7_sub1."</h4>
".$lang_di_title7_sub2." 
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">staða</span> <span class=\"pos\"> f (stöðu, stöður) </span>
<div class=\"main_e_g_a\">
<span class=\"markers\">1.</span> <span class=\"syn\">(ástand)</span> <span class=\"dtrn2\">situace</span> <br>
<span class=\"markers\">2.</span> <span class=\"syn\">(starf)</span> <span class=\"dtrn2\">pozice (ve firmě ap.), profese</span><br>
</div>
</div></div>
".$lang_di_title7_sub3."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">bygging</span> <span class=\"pos\"> f (-ar, -ar) </span>
<div class=\"main_e_g_a\">
<span class=\"markers\">1.</span><span class=\"syn\">(það að byggja)(* byggja)</span> <span class=\"dtrn2\">(vý)stavba, stavení</span> <br>
<span class=\"markers\">2.</span> <span class=\"syn\">(hús)</span> <span class=\"dtrn2\">budova </span><br>
</div>
</div></div>
".$lang_di_title7_sub4."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<div class=\"main_e_g_a\">
<span class=\"markers\">1.</span><span class=\"syn\"><a href=\"./search.php?action=find&d_h=byggja&d_h_n=0\">(það að byggja)</a></span> <span class=\"dtrn2\">(vý)stavba, stavení</span>
</div></div></div>
".$lang_di_title7_sub5."

<h4> 7.2 ".$lang_di_title7_sub6."</h4>
".$lang_di_title7_sub7."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">kaldur</span> <span class=\"pos\"> adj (f köld) </span>
<div class=\"main_e_g_a\">
<span class=\"markers\">1.</span> <span class=\"dtrn2\">studený, chladný</span> <span class=\"syn\">x (<a href=\"./search.php?action=find&d_h=heitur&d_h_n=0\">heitur</a>)</span>
</div>
</div></div>

<br><br>
<span class=\"guide_title\"><a name=\"8_guide\"></a><a href=\"#top\">8. ".$lang_di_title8."</a></span>
".$lang_di_title8_sub1."

<h4>8.1 ".$lang_di_title8_sub2."</h4>
".$lang_di_title8_sub3."
".$lang_di_title8_sub4."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">
berg </span> <span class=\"pos\">n (-s, -)</span>
<div class=\"main_e_g_a\">
<span class=\"markers\">
1.</span> <span class=\"specification\"> geol. </span> <span class=\"dtrn2\">hornina, kámen</span> <br>
<span class=\"markers\">2. </span> <span class=\"syn\">(klöpp)</span> <span class=\"dtrn2\"> skalní stěna </span> <br>
</div>
</div></div>
".$lang_di_title8_sub5."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">mús</span> <span class=\"pos\"> f (músar, mýs)</span>
<div class=\"main_e_g_a\">
<span class=\"markers\">1.</span> <span class=\"specification\"> zool.</span> <span class=\"dtrn2\"> myš </span><span class=\"latin\"> (Mus)</span> <br>
<span class=\"markers\">2.</span> <span class=\"specification\"> poč.</span> <span class=\"dtrn2\"> myš </span> <br>
</div>
</div></div>

<h4>8.2 ".$lang_di_title8_sub6."</h4>
".$lang_di_title8_sub7."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">dís</span> <span class=\"pos\"> f (-ar, -ir) </span>
<div class=\"main_e_g_a\">
...<br>
<span class=\"markers\">2.</span> <span class=\"specification2\">básn.</span> <span class=\"dtrn2\">sestra</span> <br>
</div>
</div></div>
    
<br><br>
<span class=\"guide_title\"><a name=\"9_guide\"></a><a href=\"#top\">9. ".$lang_di_title9."</a></span>
".$lang_di_title9_sub1."
".$lang_di_title9_sub2."
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">
leit|a </span> <span class=\"pos\">v (-aði) gen</span>
<div class=\"main_e_g_a\">
...<br>
<span class=\"pos\">leita + að</span><br>
<span class=\"word\">leita að e-u/ e-m</span> <span class=\"dtrn2\">hledat (co/ koho)</span><br>
<div class=\"viewkeyword_examples\">	<span class=\"ex\">
leita að lyklunum</span> <span class=\"ex_translation\"> hledat klíče  </span>
</div>
</div>
</div></div>
".$lang_di_title9_sub3."

<h4>9.3 ".$lang_di_title9_sub4."</h4>
".$lang_di_title9_sub5."
<br><br>
9.3.1	 ".$lang_di_title9_sub6." <br>
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">
hett/a </span> <span class=\"pos\">f (-u, -ur)</span>
<div class=\"main_e_g_a\">
<span class=\"markers\">1. </span> <span class=\"dtrn2\">
kapuce</span>
<div class=\"viewkeyword_examples\">	<span class=\"ex\">
hettuúlpa</span> <span class=\"ex_translation\"> bunda s kapucí  </span>
</div>
</div>
</div></div>
<br><br>
9.3.2	 ".$lang_di_title9_sub7." <br>
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">
tím|i  </span> <span class=\"pos\">m (-a, -ar)</span>
<div class=\"main_e_g_a\">
...<br>
<span class=\"markers\">2. </span> <span class=\"syn\"> (klukkustund) </span><span class=\"dtrn2\">
hodina (šedesát minut)</span>
<div class=\"viewkeyword_examples\">	<span class=\"ex\">
tveggja tíma gangur</span> <span class=\"ex_translation\"> dvouhodinový pochod  </span>
</div>
</div>
</div></div>
<br><br>
9.3.3	 ".$lang_di_title9_sub8." <br>
<div class=\"guide\">
<div class=\"main_entry_guide\">
<span class=\"e1\">
mæt|a   </span> <span class=\"pos\">v (-ti, -t) dat</span>
<div class=\"main_e_g_a\">
...<br>
<span class=\"word\">mætast </span> <span class=\"syn\"> (ná saman) </span>
<span class=\"pos\"> refl </span><span class=\"dtrn2\">
setkat se</span>
<div class=\"viewkeyword_examples\">	<span class=\"ex\">
Þau mættust á miðri leið.</span> <span class=\"ex_translation\">  Potkali se na půli cesty. </span>
</div>
</div>
</div></div> 

<br><br>
<span class=\"guide_title\"><a name=\"10_guide\"></a><a href=\"#top\">10. ".$lang_di_title10."</a></span>
".$lang_di_title10_sub1."
<div class=\"guide\">
<span class =\"nav\">".$lang_di_gram6."</span>
<br>
<div class=\"main_entry_guide\"><br>
<a href=\"http://ds.hvalur.org/images/multiple_uploader/uploaded_files/1287587172-43_posta.jpg\" title=\"Pósthús,	Autor: hvalur.org\" class=\"thickbox\">
<img src=\"http://ds.hvalur.org/images/multiple_uploader/uploaded_files/th_1287587172-43_posta.jpg\"  border=\"0\" alt=\"Single Image\">
</a> <br>
<span class=\"foto\">".$lang_di_title10_sub2.":</span> 
<span class=\"nav\">hvalur.org</span> <br>
<span class=\"foto\">".$lang_di_title10_sub3.":</span> <span class=\"nav\">CC Unported Licence</span>
</div></div>
<span class=\"guide_title\"><a name=\"11_guide\"></a><a href=\"#top\">11. ".$lang_di_title11." </a></span>
".$lang_di_title11_sub1."
<br>
".$lang_di_title11_sub2."
<br><p id=\"audioplayer_\"></p>  
<script type=\"text/javascript\">  
AudioPlayer.embed(\"audioplayer_\", {soundFile: \"http://www.hljod.hvalur.org/audio/ds_19310.mp3\"});  
</script>

<br><br>
<span class=\"guide_title\"><a name=\"12_guide\"></a><a href=\"#top\">12. ".$lang_di_title12." </a></span>
".$lang_di_title12_sub1."
<br>
<br>
<div class=\"guide\">	  	  	  
<span class=\"e1\">
hest|ur</span> 
<span class=\"pos\">m (-s, -ar)</span> <br>
<span class=\"num\"></span> <span class=\"markers\">1.</span>    <span class=\"specification\">zool. </span>  <span class=\"dtrn2\">kůň </span> 
<span class=\"latin\">(Equus)</span> <br><span class=\"num\"></span> <span class=\"word\"> setja sig á háan hest </span><span class=\"syn\">(gera sig merkilegan)</span>     <span class=\"dtrn2\">vytahovat se </span> 
<br><span class=\"num\"></span> <span class=\"markers\">2.</span>    <span class=\"specification\">sport. </span>  <span class=\"dtrn2\">kůň </span> 
<span class=\"ex_translation\">(sportovní náčiní v gymnastice) </span><br></div><br><br><div class=\"guide\"><br><span class =\"nav\">Klíčová slova v příkladech</span><br><span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=beisla&amp;d_h_n=0\">beisla</a></span><span class=\"ex\">beisla hestinn</span><span class=\"ex_translation\"> zapřáhout koně</span><br><span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=dráttur&amp;d_h_n=0\">dráttur</a></span><span class=\"ex\">hafa hesta til dráttar</span><span class=\"ex_translation\"> vlastnit koně na tažení</span><br><span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=falur&amp;d_h_n=0\">falur</a></span><span class=\"ex\">Hesturinn er falur.</span><span class=\"ex_translation\"> Kůň je na prodej.</span><br><span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=hneggja&amp;d_h_n=0\">hneggja</a></span><span class=\"ex\">Hesturinn hneggjar.</span><span class=\"ex_translation\"> Kůň řehtá.</span><br><span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=hófur&amp;d_h_n=0\">hófur</a></span><span class=\"ex\">hófurinn á hestinum</span><span class=\"ex_translation\"> kopyto koně</span><br><span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=hvíla&amp;d_h_n=2\"><sup>2</sup>hvíla</a></span><span class=\"ex\">hvíla hestinn</span><span class=\"ex_translation\"> nechat odpočinout koně</span><br><span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=vitja&amp;d_h_n=0\">vitja</a></span><span class=\"ex\">vitja um hestana</span><span class=\"ex_translation\"> zkontrolovat koně</span><br><span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=leyfa&amp;d_h_n=0\">leyfa</a></span><span class=\"ex\">leyfa henni að halda á hestinum</span><span class=\"ex_translation\"> dovolit jí vést koně</span><br><span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=múll&amp;d_h_n=0\">múll</a></span><span class=\"ex\">leggja múl á hestinn</span><span class=\"ex_translation\"> nasadit koni ohlávku</span><br><span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=ríða&amp;d_h_n=0\">ríða</a></span><span class=\"ex\">ríða gráum hesti</span><span class=\"ex_translation\"> jet na šedém koni</span><br><span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=tamning&amp;d_h_n=0\">tamning</a></span><span class=\"ex\">tamning hesta</span><span class=\"ex_translation\"> krocení koně</span><br><span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=hefta&amp;d_h_n=0\">hefta</a></span><span class=\"ex\">hefta hest</span><span class=\"ex_translation\"> přivázat koně</span><br><span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=klyfja&amp;d_h_n=0\">klyfja</a></span><span class=\"ex\">klyfjaður hestur</span><span class=\"ex_translation\"> kůň s nákladem</span><br><span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=klyf&amp;d_h_n=0\">klyf</a></span><span class=\"ex\">binda klyfjarnar á hestinn</span><span class=\"ex_translation\"> uvázat náklad na koně</span><br><span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=níðingur&amp;d_h_n=0\">níðingur</a></span><span class=\"ex\">hestaníðingur</span><span class=\"ex_translation\"> člověk, který je surový ke koním</span><br><span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=sport&amp;d_h_n=0\">sport</a></span><span class=\"ex\">eiga hesta upp á sport</span><span class=\"ex_translation\"> mít koně pro zábavu</span><br><span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=þvæla&amp;d_h_n=2\"><sup>2</sup>þvæla</a></span><span class=\"ex\">þvæla hestinn</span><span class=\"ex_translation\"> uštvat koně</span><br><span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=reiður&amp;d_h_n=0\">reiður</a></span><span class=\"ex\">Hestinum er reitt.</span><span class=\"ex_translation\"> Na tom koni se dá jet.</span><br></div>  
<span class=\"guide_title\"><a name=\"13_guide\"></a><a href=\"#top\">13. ".$lang_di_title13." </a></span>
".$lang_di_title13_sub1."
<br>
<br>
<div class=\"guide\">	  	  	  	  
<span class=\"e1\">
fagur 	 </span> 
<span class=\"pos\">adj (f fögur)</span> <br>
<span class=\"num\"></span>     <span class=\"dtrn2\">krásný, úchvatný </span> 
<br><br></div><div class=\"guide\"><span class =\"nav\">".$lang_di_gram5."</span><br><br><span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=fallegur&amp;d_h_n=0\">fallegur</a> </span> <span class=\"specification2\"></span><span class=\"specification\"></span> <span class=\"word\"></span><span class=\"dtrn2\"> hezký, pěkný</span><br><span class=\"syn\"><a href=\"./search.php?list_kind=alpha&amp;d_h=prúður&amp;d_h_n=0\">prúður</a> </span> <span class=\"specification2\"></span><span class=\"specification\"></span> <span class=\"word\"></span><span class=\"dtrn2\"> přepěkný, krásný</span><br></div>
<span class=\"guide_title\"><a name=\"14_guide\"></a><a href=\"#top\">14. ".$lang_di_title14." </a></span>
".$lang_di_title14_sub1."
</div>";
echo $ins;
?>
<div style="clear:both;"> </div>
</div>
<div id="footer">
<?=$lang_footer;?>
</div>
</div>
<?php 
include ('./html_end.php');
?>
