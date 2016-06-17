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
function Short_Dec(&$row,$stem_for_pronunciation, $view_keyword) {
$shortened='';
$number_char=strlen($view_keyword);
if ($number_char>5) {
$pos1 = strrpos($stem_for_pronunciation, "·");
$pos2 = strrpos($stem_for_pronunciation, "··");	 
if ($pos1>=$pos2) {
$stem_for_pronunciation[$pos1] = '*';	 
} else {
$stem_for_pronunciation[$pos2] = '*';		 
}	
$pos_char = strpos($stem_for_pronunciation, '*');
if ($pos_char!==FALSE) {
$new_text = explode ('*', $stem_for_pronunciation);  
$new_text[0] = str_replace("·", "", $new_text[0]);
$new_text[0] = str_replace("/", "", $new_text[0]);
$shortened=$new_text[0];
if ($shortened!='') {
$cc=0;
foreach ($row as $k => $value) {
$cc++;
if ($cc>5) {
$s=1;
$pos_komma = strpos($value, ',');
if ($pos_komma!==FALSE) {
$text_komma = explode (' ', $value);  
$row[$k]='';
foreach ($text_komma as $k1 => $value1) {
$row[$k] .= str_replace_once($shortened, "~", $value1);
}
} else {
$row[$k] = str_replace_once($shortened, "~", $value);	  
}
}}}  }}
return $row;
}
function str_replace_once($needle , $replace , $haystack){ 
$pos = strpos($haystack, $needle); 
if ($pos === false) { 
return $haystack; 
} 
return substr_replace($haystack, $replace, $pos, strlen($needle)); 
}?>
