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
$file= fopen("../connection.php", "w");
// $file= fopen("../connection.php", "w");
$realpath= realpath(dirname('../connection.php'));

function get_server() {
	$protocol = 'http';
	if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443') {
		$protocol = 'https';
	}
	$host = $_SERVER['HTTP_HOST'];
	$baseUrl = $protocol . '://' . $host;
	if (substr($baseUrl, -1)=='/') {
		$baseUrl = substr($baseUrl, 0, strlen($baseUrl)-1);
	}
	return $baseUrl;
}
$base_link= get_server();
$_con = '<?php
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

// mysql connection details
$host1 = "'.$this->get(db_host).'";
$data1 = "'.$this->get(db_name).'";
$user1= "'.$this->get(db_user).'";
$pass1 = "'.$this->get(db_pass).'";

//first language mysql collation
$collation_1="utf8_general_ci";
//second language mysql collation
$collation_2="utf8_general_ci";

// mail
$mail_host="'.$this->get(mail_host).'";
$mail_user="'.$this->get(mail_user).'";
$mail_password="'.$this->get(mail_password).'";
$mail_admin="'.$this->get(mail_admin).'";

// mail admin full name
// for example Tom Richardson
$mail_admin_name="'.$this->get(mail_admin_name).'";

// ftp for cron job with backup file automated by host server
$ftp_user_name="'.$this->get(ftp_user_name).'";
$ftp_user_pass="'.$this->get(ftp_user_pass).'";
$ftp_server="'.$this->get(ftp_server).'";

// name of daily sql dump
$server_file = "'.$this->get(server_file).'";

// absolute path
// permission / chmod 666
// for example /DISK2/WWW/hvalur.org/www/backup/
$folder_path = "'.$this->get(backup_path).'";

// image upload directory
// permission / chmod 666
// for example /DISK2/WWW/hvalur.org/www/images/uploaded_files/
$con_uploadsDirectory = "'.$realpath.'/images/uploaded_files/";

// sound upload directory
// permission / chmod 666
// for example /DISK2/WWW/hvalur.org/www/audio/uploaded_files/
$sound_uploadsDirectory = "'.$realpath.'/audio/uploaded_files/";

// base link
// html address of home page
$IMAGE_URL = "'.$base_link.'/";

// when submiting pictures and audio files, if authors and licence fields left blank
$author="";
$licence="";

// export to LaTex - absolute path on your local computer
// for example /home/author/Dokumenty/web/HVALUR-JOINED/www/images/biolib/full/
$home_path_biolib="/home/???/images/biolib/full/";
?>';
fwrite($file, $_con);
fclose($file);
?>
