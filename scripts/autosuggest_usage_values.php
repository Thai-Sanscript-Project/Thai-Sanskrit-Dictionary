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
include '../connection.php';
include '../scripts/mysqlclass.php';
include '../scripts/query_function.php';
$table='ds_spec_usage';
$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 
$sql = sprintf ('SELECT * FROM `%s`',
	$table);
$oop->Setnames();
$oop->query($sql);
$cc=0;
while ($returned = $oop->fetchArray ()) :
$cc++;
$aUsers[$cc]=$returned[1];
$aInfo[$cc]=$returned[2];
endwhile;
$oop->freeResult();
$oop->_mySQL; 
$input = strtolower( $_GET['input'] );
$len = strlen($input);
$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 0;
$aResults = array();
$count = 0;
if ($len)
{
for ($i=0;$i<count($aUsers);$i++)
{
if (strtolower(substr(utf8_decode($aUsers[$i]),0,$len)) == $input)
{
$count++;
$aResults[] = array( "id"=>($i+1) ,"value"=>htmlspecialchars($aUsers[$i]), "info"=>htmlspecialchars($aInfo[$i]) );
}
if ($limit && $count==$limit)
break;
}
}
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header ("Pragma: no-cache"); // HTTP/1.0
header("Content-Type: text/xml");
if (isset($_REQUEST['json']))
{
header("Content-Type: application/json");
echo "{\"results\": [";
$arr = array();
for ($i=0;$i<count($aResults);$i++)
{
$arr[] = "{\"id\": \"".$aResults[$i]['value']."\", \"value\": \"".$aResults[$i]['value']."\", \"info\": \"".$aResults[$i]['info']."\"}";
}
echo implode(", ", $arr);
echo "]}";
}
else
{
header("Content-Type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?><results>";
for ($i=0;$i<count($aResults);$i++)
{
echo "<rs id=\"".$aResults[$i]['id']."\" info=\"".$aResults[$i]['info']."\">".$aResults[$i]['value']."</rs>";
}
echo "</results>";
}?>