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

// mysql connection details
$host1 = "localhost";
$data1 = "dictionary_system";
$user1= "root";
$pass1 = "password";

//first language mysql collation
$collation_1="utf8_general_ci";
//second language mysql collation
$collation_2="utf8_general_ci";

// mail
$mail_host="boom.to.dev@gmail.com";
$mail_user="root";
$mail_password="password";
$mail_admin="boom.to.dev@gmail.com";

// mail admin full name
// for example Tom Richardson
$mail_admin_name="boom.to.dev@gmail.com";

// ftp for cron job with backup file automated by host server
$ftp_user_name="root";
$ftp_user_pass="password";
$ftp_server="";

// name of daily sql dump
$server_file = "";

// absolute path
// permission / chmod 666
// for example /DISK2/WWW/hvalur.org/www/backup/
$folder_path = "";

// image upload directory
// permission / chmod 666
// for example /DISK2/WWW/hvalur.org/www/images/uploaded_files/
$con_uploadsDirectory = "D:\AppServ\www\dictionary-system-bare/images/uploaded_files/";

// sound upload directory
// permission / chmod 666
// for example /DISK2/WWW/hvalur.org/www/audio/uploaded_files/
$sound_uploadsDirectory = "D:\AppServ\www\dictionary-system-bare/audio/uploaded_files/";

// base link
// html address of home page
$IMAGE_URL = "http://localhost/";

// when submiting pictures and audio files, if authors and licence fields left blank
$author="";
$licence="";

// export to LaTex - absolute path on your local computer
// for example /home/author/Dokumenty/web/HVALUR-JOINED/www/images/biolib/full/
$home_path_biolib="/home/???/images/biolib/full/";
?>