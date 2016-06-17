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
require_once(dirname(__FILE__).'/connection.php');
$data='';
$new_file='dictionary_'.date('Y-m-d').'.sql.gz';
//Open the file and write to it
$fp = fopen($folder_path.$new_file, 'w');
fputs($fp,$data);
fclose($fp);
//chmod('/DISK2/WWW/hvalur.org/ds/backup/'.$new_file,0777);
// set up basic connection
$conn_id = ftp_connect($ftp_server);
// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
// try to download $server_file and save to $local_file
if (ftp_get($conn_id, $folder_path.$new_file, $server_file, FTP_BINARY)) {
} else {
}
ftp_close($conn_id);
?>
