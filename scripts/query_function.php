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
function quate_smart($string) {
    $h = get_magic_quotes_gpc();
    if ($h == 1) {
        $str = stripslashes(trim($string));
    }
    $nn = mysql_real_escape_string($str);
    $str2 = '\'' . $nn . '\'';
    return ($str2);
}

function quate_wildcard($string) {
    $h = get_magic_quotes_gpc();
    if ($h == 1) {
        $str = stripslashes(trim($string));
    }
    $nn = mysql_real_escape_string($str);
    $str2 = '\'' . $nn . '%\'';
    return ($str2);
}

function quate_two_wildcard($string) {
    $h = get_magic_quotes_gpc();
    if ($h == 1) {
        $str = stripslashes(trim($string));
    }
    $nn = mysql_real_escape_string($str);
    $str2 = '\'%' . $nn . '%\'';
    return ($str2);
}

function quate_end_wildcard($string) {
    $h = get_magic_quotes_gpc();
    if ($h == 1) {
        $str = stripslashes(trim($string));
    }
    $nn = mysql_real_escape_string($str);
    $str2 = '\'%' . $nn . '\'';
    return ($str2);
}

function getRealIpAddr() {
    $ip = $_SERVER['REMOTE_ADDR'];
    return $ip;
}

?>