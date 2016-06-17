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
  include './scripts/image_resize.php';

// filename: upload.processor.php

// first let's set some variables

// make a note of the current working directory, relative to root.
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

// make a note of the directory that will recieve the uploaded files
if ($_GET["a"]=='image') {
$uploadsDirectory = $con_uploadsDirectory;
} else if ($_GET["a"]=='sound') {
$uploadsDirectory = $sound_uploadsDirectory;
}

// make a note of the location of the upload form in case we need it
$uploadForm = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'multiple.upload.form.php';

// make a note of the location of the success page
$uploadSuccess = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'multiple.upload.success.php';

// name of the fieldname used for the file in the HTML form
$fieldname = 'file';

//echo'<pre>';print_r($_FILES);exit;



// Now let's deal with the uploaded files

// possible PHP upload errors
$errors = array(1 => 'php.ini max file size exceeded', 
                2 => 'html form max file size exceeded', 
                3 => 'file upload was only partial', 
                4 => 'no file was attached');

// check the upload form was actually submitted else print form
isset($_POST['submit'])
	or error('the upload form is neaded', $uploadForm);
	
// check if any files were uploaded and if 
// so store the active $_FILES array keys
$active_keys = array();
foreach($_FILES[$fieldname]['name'] as $key => $filename)
{
	if(!empty($filename))
	{
		$active_keys[] = $key;
	}
}

// check at least one file was uploaded
count($active_keys)
	or error('No files were uploaded', $uploadForm);
		
// check for standard uploading errors
foreach($active_keys as $key)
{
	($_FILES[$fieldname]['error'][$key] == 0)
		or error($_FILES[$fieldname]['tmp_name'][$key].': '.$errors[$_FILES[$fieldname]['error'][$key]], $uploadForm);
}
	
// check that the file we are working on really was an HTTP upload
foreach($active_keys as $key)
{
	@is_uploaded_file($_FILES[$fieldname]['tmp_name'][$key])
		or error($_FILES[$fieldname]['tmp_name'][$key].' not an HTTP upload', $uploadForm);
}
	
// validation... since this is an image upload script we 
// should run a check to make sure the upload is an image
//foreach($active_keys as $key)
//{
//	@getimagesize($_FILES[$fieldname]['tmp_name'][$key])
//		or error($_FILES[$fieldname]['tmp_name'][$key].' not an image', $uploadForm);
//}
	
// make a unique filename for the uploaded file and check it is 
// not taken... if it is keep trying until we find a vacant one
foreach($active_keys as $key)
{
	
	if ($_GET["a"]=='image') {
		
		
			$now=1;
	// convert utf8 headword to ascii so that we can name the file clearly
    setlocale(LC_ALL, 'is_IS.UTF8');
    $tofile = $_GET["d_h"];
    $tofile = preg_replace('~[^\\pL0-9_]+~u', '-', $tofile);
    $tofile = trim($tofile, "-");
    $tofile = iconv("utf-8", "us-ascii//TRANSLIT", $tofile);
    $tofile = strtolower($tofile);
    $tofile = preg_replace('~[^-a-z0-9_]+~', '', $tofile);

	
	$ext = strtolower(substr(strrchr($_FILES[$fieldname]['name'][$key], '.'), 1));
	
	while(file_exists($uploadFilename[$key] = $uploadsDirectory.'ds_image_'.$tofile.'_'.$_GET["d_h_n"].'_'.$now.'.'.$ext)) {
				$now++;
			
	}
	$ff_name[$key]='ds_image_'.$tofile.'_'.$_GET["d_h_n"].'_'.$now.'.'.$ext;
	
	}
	
	
	if ($_GET["a"]=='sound') {
		$now=1;
	// convert utf8 headword to ascii so that we can name the file clearly
    setlocale(LC_ALL, 'is_IS.UTF8');
    $tofile = $_GET["d_h"];
    $tofile = preg_replace('~[^\\pL0-9_]+~u', '-', $tofile);
    $tofile = trim($tofile, "-");
    $tofile = iconv("utf-8", "us-ascii//TRANSLIT", $tofile);
    $tofile = strtolower($tofile);
    $tofile = preg_replace('~[^-a-z0-9_]+~', '', $tofile);

	$ext = substr(strrchr($_FILES[$fieldname]['name'][$key], '.'), 1);
	
	
	while(file_exists($uploadFilename[$key] = $uploadsDirectory.'ds_'.$tofile.'_'.$_GET["d_h_n"].'_'.$now.'.'.$ext)) {
				$now++;
	}
	$ff_name[$key]='ds_'.$tofile.'_'.$_GET["d_h_n"].'_'.$now.'.'.$ext;
	}
}



// now let's move the file to its final and allocate it with the new filename
foreach($active_keys as $key)
{
	@move_uploaded_file($_FILES[$fieldname]['tmp_name'][$key], $uploadFilename[$key])
		or error('receiving directory insuffiecient permission', $uploadForm);

}

// thumbnails only for images
if ($_GET["a"]=='image') {

foreach($active_keys as $key)
{
	
		
	$image = new SimpleImage();
   $image->load($uploadFilename[$key]);
   $i_width=$image->getWidth();
    $i_height=$image->getHeight();
    echo 'width = '.$i_width;
    echo 'height = '.$i_height;
   if ($i_width>=$i_height) {
   $image->resizeToWidth(120);
   $orientation[$key]=1;
   } else {
   $image->resizeToHeight(120);
    $orientation[$key]=2;
   }
   
   $image->save($uploadsDirectory.'th_'.$ff_name[$key]);
}
}

$oop = new mySQL ($host1, $user1, $pass1, $data1, TRUE); 

if ($_GET["a"]=='image') {
$uploadsDirectory = $con_uploadsDirectory;


// insert it to ds_images table
// if left empty the values for author and licence are loaded from connection.php
// helps to submit the files
if ($_POST["author"]=='') {
$_POST["author"]=$author;
$_POST["licence"]=$licence;
}
foreach($active_keys as $key)
{

$table='ds_images';
$sql = sprintf ('INSERT INTO `%s` (`id`, `keyword`, `num_keyword`, `name_of_file`, `author`, `licence`, `orientation`) VALUES (NULL, %s, %s, %s, %s, %s, %s)',
				$table,
				quate_smart($_GET["d_h"]),
				quate_smart($_GET["d_h_n"]),
				quate_smart($ff_name[$key]),
				quate_smart($_POST["author"]),
				quate_smart($_POST["licence"]),
				quate_smart($orientation[$key]));

echo $sql;

/* query the database */
$oop->Setnames();
$oop->query($sql);
$oop->freeResult(); 
}

} else if ($_GET["a"]=='sound') {
	
	foreach($active_keys as $key)
{

$table_sound = 'ds_sound';
$sql = sprintf ('INSERT INTO `%s` (`id`, `keyword`, `num_keyword`, `sound`, `author`, `licence`) VALUES (NULL, %s, %s, %s, %s, %s)',
				$table_sound,
				quate_smart($_GET["d_h"]),
				quate_smart($_GET["d_h_n"]),
				quate_smart($ff_name[$key]),
				quate_smart($_POST["author"]),
				quate_smart($_POST["licence"]));


$oop->Setnames();
$oop->query($sql);
$oop->freeResult(); 
}


}


$oop->_mySQL;

      
// If you got this far, everything has worked and the file has been successfully saved.
// We are now going to redirect the client to the success page.

$location = 'Location: ./search.php?list_kind=alpha&d_h='.$_GET["d_h"].'&d_h_n='.$_GET["d_h_n"].'';
header($location);

// make an error handler which will be used if the upload fails


//function error($error, $location, $seconds = 0)
//{
///	header("Refresh: $seconds; URL=\"$location\"");
//	$_GET["ses_message"] = $error;
//	exit;
//} // end error handler

// make an error handler which will be used if the upload fails
function error($error, $location, $seconds = 5)
{
	header("Refresh: $seconds; URL=\"$location\"");
	echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"'."\n".
	'"http://www.w3.org/TR/html4/strict.dtd">'."\n\n".
	'<html lang="en">'."\n".
	'	<head>'."\n".
	'		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">'."\n\n".
	'		<link rel="stylesheet" type="text/css" href="stylesheet.css">'."\n\n".
	'	<title>Upload error</title>'."\n\n".
	'	</head>'."\n\n".
	'	<body>'."\n\n".
	'	<div id="Upload">'."\n\n".
	'		<h1>Upload failure</h1>'."\n\n".
	'		<p>An error has occured: '."\n\n".
	'		<span class="red">' . $error . '...</span>'."\n\n".
	'	 	The upload form is reloading</p>'."\n\n".
	'	 </div>'."\n\n".
	'</html>';
	exit;
} // end error handler
?>