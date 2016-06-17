<?php header("Content-type: text/css");
$snow = '#fff';
$white1='#fafafa';
$white2='#f5f5f5';
$green_light1='#e4e8ca';
$red1 = '#CB392C';
$red2 = '#B7271F';
$red3='#d50202';
$red4='#990000';
$orange1='#e13a16';
$pink_light='#e8cae4';
$pink_dark='#D31141';
$pink_ultra='#ff0084';
$blue_light='#368AD2';
$blue_light2='#6688FF';
$blue2='#0F4987';
$blue3='#0063e3';
$blue4='#1B5CCD';
$blue5='#6EADE7';
$blue_dark='#105289';
$blue_dark2='#115098';
$grey_blue='#5a6681';
$violet2='#5c41b1';
$violet_dark='#211b4b';
$violet_ultra='#6600FF';
$violet_dark2='#7f0049';
$grey= '#666666';
$grey1='#999999';
$grey2='#CCCCCC';
$grey_light='#B4BAC0';
$grey_dark1='#4b4b4b';
$grey_dark2='#444444';
$grey_dark3='#696969';
$grey3='#a9a9a9';
$black = '#333333';
$black1='#000000';
$black2='#222222';
?>
* {
padding: 0;
margin: 0;
} 
body {
background: <?=$snow?> url(images/bg.jpg) repeat-x top;
font-family: "Trebuchet MS", Verdana, Arial, sans-serif;
font-size: 12px;
color: <?=$black?>;
}
a {
color: <?=$red1?>;
text-decoration: none;
}
a:hover {
text-decoration: underline;
}
p {
color: <?=$black?>;
} 
ol {
margin-left: 25px;
padding: 0px;
}
li {
padding-left: 10px;
}
#wrapper {
width:950px;
margin: 0 auto;
}
#header {
height: 100px;
padding-left:10px;
}
#header h1 {
font-size: 30px;
font-weight: 100;
letter-spacing: -2px;
padding: 15px 0 0 0px;
}
#header h1 a {
text-decoration: none;
color: <?=$red2?>;
}
#header h1 a:hover {
text-decoration: none;
color: <?=$black1?>;
}
#header h2 {
color: <?=$grey?>;
font-weight: 100;
font-size: 10px;
padding: 0 0 0 1px;
}
#content {
margin: 20px 0;
line-height: 17px;
}
#edit_left {
float: left;
width: 200px;
}
.left {
float: left;
padding-left:5px;
width: 100px;
text-align: justify;
border-right:1px dotted;
border-color:<?=$red2?>;
}
.left_huge h3 {
color: <?=$red2?>;
font-size: 16px;
font-weight: 100;
padding : 10px 0 15px 0;
}
.left_huge h4 {
color: <?=$red2?>;
font-size: 16px;
font-weight: 100;
padding : 15px 0 5px 0;
}
.left_huge {
float: left; 
padding:20px 0 0 20px;
width: 810px;
min-height:500px;
}
.left_huge h2 {
color: <?=$red2?>;
font-size: 24px;
font-weight: 100;
padding : 10px 0 15px 0;
}
#footer {
font-size: 11px;
float:left;
width:950px;
margin: 0 auto;
color: <?=$black?>; 
text-align: center;
padding: 5px 0 10px 0;
margin-top: 50px;
/*border-top: 3px solid <?=$pink_light?>;*/
border-top: 1px solid <?=$red2?>;
}
#footer a { 
color: <?=$grey1?>;
}
#footer a:hover {
color: <?=$black?>; 
text-decoration: underline; 
}
/* Page Structure
----------------------------------------------- */
@media all {
.main_search_page3 {
width:800px;
font-size:100%;
float: left;
}
.viewentry {
width: 300px;
float:left;
font-size:97%;
padding: 1px;
}
.main_entry {
width: 300px;
float:left;
margin:0px 0px 0px 25px;
font-size:97%;
padding: 3px;
}
.main_entry_little {
width: 450px;
float:left;
margin:0px 0px 0px 50px;
font-size:97%;
line-height:80%;
padding: 3px;
}
.phrase_show {
width: 350px;
float:left;
margin: 5px 0px 2px -10px;
}
#phraselist{
width: 50px;
float:left;
font-size:80%;
}
.search_0column {
width: 50px;
float:left;
padding-right: 5px;
border-right:1px dotted;
border-color:<?=$red2?>;
}
.search_1column {
width: 300px;
float:left;
padding: 0px 5px 0px 5px;
}
.search_2column {
width: 300px;
float:left;
padding: 0px 5px 0px 70px;
}
.viewkeyword_examples {
width: 300px;
float:left;
margin:0px 0px 0px 20px;
font-size:100%;
padding: 3px;
}
.viewkeyword_examples_edit {
width: 180px;
float:left;
margin:0px 0px 0px 10px;
padding: 3px;
font-size:120%;
text-align:justify;
}
#help_title {
width: 600px;
float:left;
margin-bottom:1px;
margin:0px 0px 0px 30px;
padding: 2px;
color: <?=$red2?>;
font-size: 24px;
font-weight: 100;
padding : 10px 0 15px 0;
}
#help_title_sub {
width: 600px;
float:left;
margin-bottom:1px;
margin:0px 0px 0px 40px;
padding: 2px;
color: <?=$red2?>;
font-size: 16px;
font-weight: 100;
padding : 10px 0 5px 0;
}
#help_title_summary {
width: 600px;
float:left;
margin-bottom:1px;
margin:0px 0px 5px 60px;
padding: 20px;
}
#help_footer {
width: 400px;
float:left;
margin-bottom:1px;
margin:0px 0px 5px 60px;
font-size:60%;
padding: 2px;
}
#help_image {
margin:5px 0px 5px 5px;
padding: 2px;
}
#logo {
width:700px;;
float:left;
}
#lang_selector {
float:right;
padding: 15px 0 0 0px;
}
}
@media handheld {
#content {
width:100%;
}
#logo {
width:680px;;
float:left;
}
#word_form_list {
font-size:100%;
float:left;
}
#wiewentry {
font-size:100%;
float:left;
}
}
input.button3 {
font-weight:normal;
height:20px;
border:none;
border:0px;
margin:0px;
font-size:10px;
}
a:link	{ color: <?=$blue_dark?>;  text-decoration: none; }
a:visited	{ color: <?=$blue_dark?>;  text-decoration: none; }
a:hover	{ color: <?=$pink_dark?>;  text-decoration: underline; }
a:active	{ color: <?=$blue_light?>;  text-decoration: none; }
p {  font-size:100%;
text-align:left;
}
/*-------------------------------------------------------------
Headword outlook
-------------------------------------------------------------- */
.e1 {
margin:0;
font-size:180%;
font-weight:bold;
color:<?=$black?>; 
}
.e3 {
font-size:100%;
color:<?=$black?>; 
}
.e4 {
font-size:70%;
color:<?=$grey_blue?>; 
}
.e5 {
font-size:100%;
color:<?=$red2?>; 
}
.e6 {
font-size:80%;
}
.e7 {
font-size:120%;
color:<?=$black?>; 
}
.e8 {
font-size:120%;
color:<?=$red2?>; 
}
.e9 {
font-size:100%;
}
.pos {
margin:0;
padding-left:5px;
font-size:80%;
font-style:italic;
color:<?=$grey_blue?>; 
}
.headings_result {
font-size:80%;
color:<?=$grey_blue?>; 
}
.nav {
margin:0;
font-size:70%;
font-style:normal;
color:<?=$grey_blue?>; 
}
.foto {
margin:0;
font-size:70%;
font-style:normal;
}
.italic2 {
margin:0;
font-size:100%;
font-style:italic;
color:<?=$black?>; 
}
.dtrn {
font-size:100%;
font-style:normal;
color:<?=$black?>; 
}
.dtrn2 {
margin:0;
padding-left:1px;
font-size:120%;
font-style:normal;
color:<?=$black1?>; 
}
.latin{
margin:0;
font-size:90%;
font-style:normal;
color:<?=$black?>; 
}
.dec_info{
font-size:70%;
font-style:normal;
color:<?=$black?>; 
}
.pronunciation_history{
font-size:80%;
font-style:normal;
}
.pronunciation_search{
font-size:120%;
font-style:normal;
}
.markers {
margin:0;
font-size:100%;
font-weight:bold;
color:<?=$black?>; 
}
.word {
font-size:120%;
font-weight:bold;
color:<?=$red2?>; 
}
.num {
font-size:50%;
color:<?=$violet_dark?>;
padding-right:5px;
}
.specification{
margin:0;
font-size:80%;
font-weight:bold;
}
.abb_guide{
font-size:100%;
font-weight:bold;
color: <?=$red2?>;
}
.abb_guide_zkr{
font-size:100%;
font-weight:bold;
color: <?=$red1?>;
}
.specification2{
margin:0;
font-size:80%;
font-weight:bold;
} 
.syn{
margin:0;
font-size:80%;
font-style:normal;
color:<?=$black?>; 
}
.ex {
margin:0;
font-style:italic;
color:<?=$red2?>; 
margin:0px 0px 0px 10px;
}
.ex_translation {
margin:0;
font-style:italic;
color:<?=$black?>; 
}
 .ex_keyword {
margin:0;
font-size:90%;
font-style:normal;
color:<?=$grey?>; 
}
.phonetics_result {
font-style:normal;
color:<?=$violet_ultra?>;
}
.phonetics_result_search_page {
font-size:120%;
font-style:normal;
color:<?=$violet_ultra?>;
}
.info_message {
font-size:100%;
font-weight:bold;
}
.phonetics_result_search_page_exp {
color:<?=$blue_light2?>;
 }
.ses_message {
padding-right:50px;
font-size:100%;
color:<?=$red3?>; 
}
 .unique_color {
color:<?=$violet_dark2?>; 
}
 .guide_title {
color: <?=$red2?>;
font-size: 20px;
font-weight: 100;
padding : 20px 0 15px 0;
float: left; 
width: 820px;
text-align: justify;
}
 .guide {
padding : 20px 0 15px 40px;
}
.main_entry_guide {
}
.s_char {
cursor:pointer;
letter-spacing:4px;
}
/*-------------------------------------------------------------
Help outlook
-------------------------------------------------------------- */
.help {  font-size:100%;
text-align:left;
}
.help.table_of_contants {
margin:10px;
font-size:140%;
font-weight:bold;
color:<?=$violet_dark?>;
}
.help.title {
margin:10px;
font-size:130%;
font-style:normal;
color:<?=$black1?>;
}
.help.title_sub {
margin:20px;
font-size:120%;
font-style:normal;
color:<?=$black1?>;
}
.title_summary {
margin:20px;
font-size:90%;
font-style:normal;
color:<?=$black1?>;
padding:50px;
}
.help.subtitle {
margin:30px;
font-size:100%;
font-style:italic;
color:<?=$black1?>;
}
.help.help_footer {
margin:60px;
font-size:60%;
text-align:center;
font-weight:bold;
color:<?=$black1?>;
}
  /* validation error
---------------------------------------- */
error {
font-size:90%;
font-weight:bold;
color:#d31141; 
}
/*-------------------------------------------------------------
Table outlook
-------------------------------------------------------------- */
table.sample {
border-width: thin thin thin thin;
border-spacing: 0px;
border-style: solid solid solid solid;
border-color: <?=$pink_light?> <?=$pink_light?> <?=$pink_light?> <?=$pink_light?>;
border-collapse: separate;
background-color: white;
}
table.sample th {
border-width: 1px 1px 1px 1px;
padding: 3px 3px 3px 3px;
border-style: dotted dotted dotted dotted;
border-color: <?=$pink_light?> <?=$pink_light?> <?=$pink_light?> <?=$pink_light?>;
background-color: white;
}
table.sample td {
border-width: 1px 1px 1px 1px;
padding: 2px 2px 2px 3px;
border-style: dotted dotted dotted dotted;
border-color: <?=$pink_light?> <?=$pink_light?> <?=$pink_light?> <?=$pink_light?>;
background-color: white;
font-size:90%;
}
tr.d0 td {
background-color: <?=$green_light1?>; color: black;
border-color: <?=$pink_light?> <?=$green_light1?> <?=$pink_light?> <?=$green_light1?>;
}
img.preview {
width:90px;
height:120px;
} 
img.preview a {
text-decoration: none; }
img.preview a:visited {
text-decoration: none;	
}
img.preview a:hover {
text-decoration: none;	
}
img.preview a:active {
text-decoration: none;	
}
img.preview_2 {
width:120px;
height:90px;
} 
img.preview_2 a {
text-decoration: none; }
img.preview_2 a:visited {
text-decoration: none;	
}
img.preview_2 a:hover {
text-decoration: none;	
}
img.preview_2 a:active {
text-decoration: none;	
}
input {
font-weight: normal;
vertical-align: middle;
font-size: 1em;
font-family: Verdana, Helvetica, Arial, sans-serif;
}
select {
font-size:10px;
vertical-align: middle;
}
option {
padding-right: 1em;
}
textarea {
font-family: "Lucida Grande", Verdana, Helvetica, Arial, sans-serif;
width: 60%;
padding: 2px;
font-size: 1em;
line-height: 1.4em;
}
/* Input field styles
---------------------------------------- */
.inputbox {
background-color: <?=$snow?>;
border: 1px solid #ff0000;
color: <?=$black?>;
padding: 1px;
cursor: text;
}
.inputbox:hover {
border: 1px solid #eaeaea;
}
.inputbox:focus {
border: 1px solid #eaeaea;
color: <?=$grey_dark1?>;
}
input.inputbox	{ width : 200px; }
textarea.inputbox {
width: 85%;
}
.autowidth {
width: auto !important;
}
input.disabled {
font-weight: normal;
color: <?=$grey?>;
}
.full { width: 95%; }
.inputbox_small {
background-color: <?=$snow?>;
border: 1px solid #ff0000;
color: <?=$black?>;
padding: 1px;
cursor: text;
}
.inputbox_small:hover {
border: 1px solid #eaeaea;
}
.inputbox_small:focus {
border: 1px solid #eaeaea;
color: <?=$grey_dark1?>;
}
input.inputbox_small	{ width : 100px; }
/*-------------------------------------------------------------
Colours and backgrounds for common.css
-------------------------------------------------------------- */
html, body {
color: <?=$black1?>;
background-color: <?=$snow?>;
}
h3 {
color: <?=$blue_dark2?>;
}
.inputbox {
background-color: <?=$snow?>; 
border-color: <?=$grey_light?>;
color: <?=$black?>;
}
.inputbox:hover {
border-color: <?=$orange1?>;
}
.inputbox:focus {
border-color: <?=$violet2?>;
color: <?=$blue2?>;
}
.inputbox_small {
background-color: <?=$snow?>; 
border-color: <?=$grey_light?>;
color: <?=$black?>;
}
.inputbox_small:hover {
border-color: <?=$orange1?>;
}
.inputbox_small:focus {
border-color: <?=$violet2?>;
color: <?=$blue2?>;
}
/*-------------------------------------------------------------
Pagination flickr
-------------------------------------------------------------- */
body
{
position: relative;
}
ul{border:0; margin:0; padding:0;}
#pagination-flickr li{
border:0; margin:0; padding:0;
font-size:8px;
list-style:none;
}
#pagination-flickr a{
border:solid 1px <?=$pink_light?>;
margin-right:2px;
}
#pagination-flickr .previous-off,
#pagination-flickr .next-off {
color:<?=$grey?>;
display:block;
float:left;
font-weight:bold;
padding:3px 4px;
}
#pagination-flickr .next a,
#pagination-flickr .previous a {
font-weight:bold;
border:solid 1px <?=$snow?>;
} 
#pagination-flickr .active{
color:<?=$pink_ultra?>;
font-weight:bold;
display:block;
float:left;
padding:4px 6px;
}
#pagination-flickr a:link,
#pagination-flickr a:visited {
color:<?=$blue3?>;
display:block;
float:left;
padding:3px 6px;
text-decoration:none;
}
#pagination-flickr a:hover{
border:solid 1px <?=$grey?>;
}
small,sub,sup
{
font-size:60%;
}
sub
{
vertical-align:sub;
}
sup
{
vertical-align:super;
}
/*-------------------------------------------------------------
Thickbox outlook
-------------------------------------------------------------- */
*{padding: 0; margin: 0;}
#TB_window {
font: 12px Arial, Helvetica, sans-serif;
color: <?=$black?>;
}
#TB_secondLine {
font: 10px Arial, Helvetica, sans-serif;
color:<?=$grey?>;
}
#TB_window a:link {color: <?=$grey?>;}
#TB_window a:visited {color: <?=$grey?>;}
#TB_window a:hover {color: <?=$black1?>;}
#TB_window a:active {color: <?=$grey?>;}
#TB_window a:focus{color: <?=$grey?>;}
#TB_overlay {
position: fixed;
z-index:100;
top: 0px;
left: 0px;
height:100%;
width:100%;
}
.TB_overlayMacFFBGHack {background: url(macFFBgHack.png) repeat;}
.TB_overlayBG {
background-color:<?=$black1?>;
filter: alpha(opacity=50);
opacity: .50;
}
* html #TB_overlay { /* ie6 hack */
position: absolute;
height: expression(document.body.scrollHeight > document.body.offsetHeight ? document.body.scrollHeight : document.body.offsetHeight + 'px');
}
#TB_window {
position: fixed;
background: <?=$snow?>;
z-index: 102;
color:<?=$black1?>;
display:none;
border: 4px solid #525252;
text-align:left;
top:50%;
left:50%;
}
* html #TB_window { /* ie6 hack */
position: absolute;
margin-top: expression(0 - parseInt(this.offsetHeight / 2) + (TBWindowMargin = document.documentElement && document.documentElement.scrollTop || document.body.scrollTop) + 'px');
}
#TB_window img#TB_Image {
display:block;
margin: 15px 0 0 15px;
border-right: 1px solid <?=$grey2?>;
border-bottom: 1px solid <?=$grey2?>;
border-top: 1px solid <?=$grey?>;
border-left: 1px solid <?=$grey?>;
}
#TB_caption{
height:25px;
padding:7px 30px 10px 25px;
float:left;
font-size:100%;
font-weight:bold;
color:<?=$black?>; 
}
#TB_closeWindow{
height:25px;
padding:11px 25px 10px 0;
float:right;
}
#TB_closeAjaxWindow{
padding:7px 10px 5px 0;
margin-bottom:1px;
text-align:right;
float:right;
}
#TB_ajaxWindowTitle{
float:left;
padding:7px 0 5px 10px;
margin-bottom:1px;
}
#TB_title{
background-color:#e8e8e8;
height:27px;
}
#TB_ajaxContent{
clear:both;
padding:2px 15px 15px 15px;
overflow:auto;
text-align:left;
line-height:1.4em;
}
#TB_ajaxContent.TB_modal{
padding:15px;
}
#TB_ajaxContent p{
padding:5px 0px 5px 0px;
}
#TB_load{
position: fixed;
display:none;
height:13px;
width:208px;
z-index:103;
top: 50%;
left: 50%;
margin: -6px 0 0 -104px; /* -height/2 0 0 -width/2 */
}
* html #TB_load { /* ie6 hack */
position: absolute;
margin-top: expression(0 - parseInt(this.offsetHeight / 2) + (TBWindowMargin = document.documentElement && document.documentElement.scrollTop || document.body.scrollTop) + 'px');
}
#TB_HideSelect{
z-index:99;
position:fixed;
top: 0;
left: 0;
background-color:<?=$snow?>;
border:none;
filter:alpha(opacity=0);
opacity: 0;
height:100%;
width:100%;
}
* html #TB_HideSelect { /* ie6 hack */
position: absolute;
height: expression(document.body.scrollHeight > document.body.offsetHeight ? document.body.scrollHeight : document.body.offsetHeight + 'px');
}
#TB_iframeContent{
clear:both;
border:none;
margin-bottom:-1px;
margin-top:1px;
_margin-bottom:1px;
}
/*-------------------------------------------------------------
Main menu outlook
-------------------------------------------------------------- */
.menu_edit{
border:none;
border:0px;
margin:0px;
padding-left:20px;
font-size:12px;
font-weight:bold;
}
.menu_edit ul{
background: #fff url(images/bg_menu.jpg) repeat-x top;
height:30px;
list-style:none;
margin:0;
padding:0;
}
.menu_edit li{
float:left;
padding:0px;
}
.menu_edit li a, .menu_edit li input.button3{
background:#fff url("images/seperator.gif") bottom right no-repeat;
background: url(images/bg_menu.jpg) repeat-x top;
color:<?=$snow?>;
display:block;
font-weight:bold;
line-height:30px;
margin:0px;
padding:0px 15px;
text-align:center;
text-decoration:none;
}
.menu_edit li a:hover, .menu_edit ul li:hover a, .menu_edit li input.button3:hover{
background: #990000;
color:<?=$snow?>;
text-decoration:none;
cursor:pointer;
}
.menu_edit li ul{
background:<?=$snow?>;
display:none;
height:auto;
padding:0px;
margin:0px;
border: 1px solid #990000;
position:absolute;
width:240px;
z-index:200;
}
.menu_edit li:hover ul{
display:block;
}
.menu_edit li li {
display:block;
float:none;
margin:0px;
padding:0px;
width:240px;
}
.menu_edit li:hover li a{
background:none;
}
.menu_edit li ul a{
display:block;
height:30px;
font-size:12px;
font-style:normal;
margin:0px;
padding:0px 10px 0px 15px;
text-align:left;
color:<?=$black?>;
}
.menu_edit li ul a:hover, .menu_edit li ul li:hover a{
background: #990000;
border: 0px;
color:<?=$snow?>;
text-decoration:none;
}
.menu_edit li:hover ul li a{
font-weight:normal;
color:<?=$black?>;
}
.menu_edit li:hover ul li a:hover{
font-weight:normal;
color:<?=$snow?>;
}
.menu_edit li:hover ul.inactive{
display:block;
}
.menu_edit li li.inactive {
display:block;
float:none;
margin:0px;
padding:0px;
width:240px;
}
.menu_edit li:hover li.inactive a{
background:none;
}
.menu_edit li ul a:hover, .menu_edit li ul li.inactive:hover a{
background: <?=$snow?>;
border: 0px;
color:<?=$black?>;
text-decoration:none;
}
.menu_edit li:hover ul li.inactive a{
font-weight:normal;
color:black;
cursor:auto;
}
.menu_edit li:hover ul li.inactive a:hover{
font-weight:normal;
cursor:auto;
color:<?=$black?>;
}		
.menu_edit p{
clear:both;
}
div.autosuggest
{
position: absolute;
background-image: url(/images/autosuggest/as_pointer.gif);
background-position: top;
background-repeat: no-repeat;
padding: 10px 0 0 0;
}
div.autosuggest div.as_header,
div.autosuggest div.as_footer
{
position: relative;
height: 6px;
padding: 0 6px;
background-image: url(/images/autosuggest/ul_corner_tr.gif);
background-position: top right;
background-repeat: no-repeat;
overflow: hidden;
}
div.autosuggest div.as_footer
{
background-image: url(/images/autosuggest/ul_corner_br.gif);
}
div.autosuggest div.as_header div.as_corner,
div.autosuggest div.as_footer div.as_corner
{
position: absolute;
top: 0;
left: 0;
height: 6px;
width: 6px;
background-image: url(/images/autosuggest/ul_corner_tl.gif);
background-position: top left;
background-repeat: no-repeat;
}
div.autosuggest div.as_footer div.as_corner
{
background-image: url(/images/autosuggest/ul_corner_bl.gif);
}
div.autosuggest div.as_header div.as_bar,
div.autosuggest div.as_footer div.as_bar
{
height: 6px;
overflow: hidden;
background-color: <?=$black?>;
}
div.autosuggest ul
{
list-style: none;
margin: 0 0 -4px 0;
padding: 0;
overflow: hidden;
background-color: <?=$black?>;
}
div.autosuggest ul li
{
color: <?=$grey2?>;
padding: 0;
margin: 0 4px 4px;
text-align: left;
}
div.autosuggest ul li a
{
color: <?=$grey2?>;
display: block;
text-decoration: none;
background-color: transparent;
position: relative;
padding: 0;
width: 100%;
}
div.autosuggest ul li a:hover
{
background-color: <?=$grey_dark2?>;
}
div.autosuggest ul li.as_highlight a:hover
{
background-color: <?=$blue4?>;
}
div.autosuggest ul li a span
{
display: block;
padding: 3px 6px;
font-weight: bold;
}
div.autosuggest ul li a span small
{
font-weight: normal;
color: <?=$grey1?>;
}
div.autosuggest ul li.as_highlight a span small
{
color: <?=$grey2?>;
}
div.autosuggest ul li.as_highlight a
{
color: <?=$snow?>;
background-color: <?=$blue4?>;
background-image: url(/images/autosuggest/hl_corner_br.gif);
background-position: bottom right;
background-repeat: no-repeat;
}
div.autosuggest ul li.as_highlight a span
{
background-image: url(/images/autosuggest/hl_corner_bl.gif);
background-position: bottom left;
background-repeat: no-repeat;
}
div.autosuggest ul li a .tl,
div.autosuggest ul li a .tr
{
background-color: transparent;
background-repeat: no-repeat;
width: 6px;
height: 6px;
position: absolute;
top: 0;
padding: 0;
margin: 0;
}
div.autosuggest ul li a .tr
{
right: 0;
}
div.autosuggest ul li.as_highlight a .tl
{
left: 0;
background-image: url(/images/autosuggest/hl_corner_tl.gif);
background-position: bottom left;
}
div.autosuggest ul li.as_highlight a .tr
{
right: 0;
background-image: url(/images/autosuggest/hl_corner_tr.gif);
background-position: bottom right;
}
div.autosuggest ul li.as_warning
{
font-weight: bold;
text-align: center;
}
div.autosuggest ul em
{
font-style: normal;
color: <?=$blue5?>;
}
.menu_sub{
margin:0px;
border: 1px dotted #990000;
font-size:10px;
font-weight:bold;
background: <?=$snow?>;

}
.menu_sub ul{
height:20px;
list-style:none;
margin:0;
padding:0;
}
.menu_sub li{
float:left;
padding:0px;
}
.menu_sub li a, .menu_sub li input.button3{
background:#fff url("images/seperator.gif") bottom right no-repeat;
color:<?=$red4?>;
display:block;
font-weight:bold;
line-height:20px;
margin:0px;
padding:0px 15px;
text-align:center;
text-decoration:none;
}
.menu_sub li a:hover, .menu_sub ul li:hover a, .menu_sub li input.button3:hover{
background: <?=$red4?>;
color:<?=$snow?>;
text-decoration:none;
cursor:pointer;
}
.menu_sub li ul{
background:<?=$snow?>;
display:none;
height:auto;
padding:0px;
margin:0px;
border: 1px solid <?=$red4?>;
position:absolute;
width:240px;
z-index:200;
}
.menu_sub li:hover ul{
display:block;
}
.menu_sub li li {
display:block;
float:none;
margin:0px;
padding:0px;
width:240px;
}
.menu_sub li:hover li a{
background:none;
}
.menu_sub li ul a{
display:block;
height:20px;
font-size:10px;
font-style:normal;
margin:0px;
padding:0px 10px 0px 15px;
text-align:left;
color:<?=$black?>;
}
.menu_sub li ul a:hover, .menu_sub li ul li:hover a{
background: <?=$red4?>;
border: 0px;
color:<?=$snow?>;
text-decoration:none;
}
.menu_sub li:hover ul li a{
font-weight:normal;
color:<?=$black?>;
}
.menu_sub li:hover ul li a:hover{
font-weight:normal;
color:<?=$snow?>;
}
.jgd-dropdown a,.jgd-dropdown a:visited{color:<?=$grey_dark3?>;text-decoration:none;outline:none;}
.jgd-dropdown a:hover{color:<?=$grey_dark3?>;}
.jgd-dropdown dd{position:relative;}
.jgd-dropdown dd ul{background-color:<?=$snow?>;border:1px solid <?=$grey3?>;color:<?=$grey_dark3?>;display:none;z-index:1000;left:0;padding:0;position:absolute;top:2px;width:150px;list-style:none;}
.jgd-dropdown dd ul li a{padding:5px;display:block;}
.jgd-dropdown dd ul li a:hover{text-decoration:underline;color:<?=$black2?>;}
.jgd-dropdown dd ul li.hide_selected{display:none;}
.jgd-dropdown dd ul li.item-even a{background-color:<?=$white1?>;}
.jgd-dropdown dd ul li.item-odd a{background-color:<?=$white2?>;}
.jgd-dropdown dd,.jgd-dropdown dt,.jgd-dropdown ul{margin:0;padding:0;}
.jgd-dropdown dt{background: url(scripts/DropDown/dropdown/gfx/arrow.png) no-repeat right center;width:150px;}
.jgd-dropdown dt a{display:block;padding-right:20px;width:150px;padding:7px;}
.jgd-dropdown dt a span{cursor:pointer;display:block;}
.jgd-dropdown dt a:hover{color:<?=$grey_dark3?>;}
.jgd-dropdown span.value{display:none;}

.jgd-dropdown.jgd-countries .flag a{padding:1px 4px 1px 32px;background-image:url(scripts/DropDown/dropdown/gfx/my_countries.png);background-repeat:no-repeat;background-position:-20px 0;font-size:0.9em;line-height:18px;}

.jgd-dropdown.jgd-countries .flag.en a{background-position:0 -25px;}
.jgd-dropdown.jgd-countries .flag.is a{background-position:0 -45px;}
.jgd-dropdown.jgd-countries .flag.pl a{background-position:0 -65px;}
.jgd-dropdown.jgd-countries .flag.sl a{background-position:0 -85px;}
.jgd-dropdown.jgd-countries .flag.fr a{background-position:0 -105px;}
.jgd-dropdown.jgd-countries .flag.cz a{background-position:0 -5px;}
.jgd-dropdown.jgd-countries dd ul{width:150px;}
.jgd-dropdown.jgd-countries dt{width:150px;}
.jgd-dropdown.jgd-countries dt a{padding:1px 4px 1px 32px;font-weight:bold;}

.clip               { position: absolute; top: 0; left: 0; }
.pos-1              { clip: rect(5px, 30px, 25px, 0px); }
.pos-2              { clip: rect(25px, 30px, 45px, 0px); top:-20px }
.pos-3             { clip: rect(45px, 30px, 65px, 0px);top:-40px }
.pos-4             { clip: rect(65px, 30px, 85px, 0px); top:-60px}
.pos-5             { clip: rect(85px, 30px, 105px, 0px); top:-80px }
.pos-6              { clip: rect(105px, 30px, 125px, 0px); top:-100px }

.clipwrapper        { position: relative; float:left; height: 30px; width: 30px; }
