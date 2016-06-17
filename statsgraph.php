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
ob_start();session_start();
include("./scripts/phpgraphlib.php"); 
$graph=new PHPGraphLib(700,450);
if ($_SESSION["newgraph"]!='') {
$graph->addData($_SESSION["newgraph"]);
} else {
$graph->addData($_SESSION["newgraph1"], $_SESSION["newgraph2"], $_SESSION["newgraph3"]);	
}
//if ($_SESSION["stats_title"]=='month') {
//$graph->setTitle($lang_stats_status5);
//} else {
//$graph->setTitle($lang_stats_status4);	
//}
$graph->setGradient("red", "maroon");
$graph->createGraph();
$_SESSION["newgraph"]='';
$_SESSION["newgraph1"]='';
$_SESSION["newgraph2"]='';
$_SESSION["newgraph3"]='';
?>
