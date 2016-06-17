<?php 
// Text specific to each Dictionary. Update text with your data.
$lang_import_headings="Import";
$lang_import1="Upload the file to server (step 1/3)";
$lang_import2="Import function helps you to import your dictionary into DS. Export your dictionary into csv format. This
format is supported by all database structures (Excel, MySQL etc.). The csv format should be like this - \"fallegur\",\"adj\",\"hezký\",\"fagur\". 
Each line in the file presents one line of table. After upload of the file on server, you will be able to define what each value represents 
according to the first line. ";
$lang_import3="Please upload the csv file you would like to import. The file will be saved into ";
$lang_import4=" in your server. This directory ";
$lang_import5="is writable";
$lang_import6="is not writable. Please change permissions of this directory to 777.";
$lang_import7="The temporary file will be saved to";
$lang_import8="This directory";
$lang_import9="The table ds_1_headword already include ";
$lang_import10="headwords and table ds_2_senses";

$lang_import11="headwords. Do you want to truncate the tables? If checked, the ds_1_headword and ds_2_senses will be truncated and you will start from scratch with uploading new dictionary. If not, application will check wheather the headword is not duplicate and insert only non-duplicate headwords.";
$lang_import12="Truncate the tables";
$lang_import13="The application has checked that the tables ds_1_headword and ds_2_senses are empty. You can safely proceed uploading new data.";
$lang_import14="Please notice that you are using this collation";
$lang_import15="You can change the collation in connection.php. The file is placed in the home directory. After you have set proper collation to $collation_1 variable, upload the connection.php via FTP to your server and continue with upload.";
$lang_import16="The correct collation is essential for sorting headwords while importing new list to tables that already contain some entries. This collacion variable is used in all sorting of headwords in application. If you are unsure which collation you should set, use <strong>utf8_unicode_ci</strong> that would work in most cases.";
$lang_import17="Assign the values to fields (step 2/3)";
$lang_import18="The tables has been truncated.";
$lang_import19="Počet položek:";
$lang_import20="Please assign to each (or some) of the values the correct field in the tables. You cannot assign more than value to the same field. You have to assign one value to the field <strong>Headword</strong>, because 
this field is identification in the tables. If you do not want to assign the value to the fields, choose <strong>not include</strong>(default). Such value will not be imported to dictionary.";

$lang_import21="Import process (step 3/3)";
$lang_import22="Notice: You have to assign one value to the <strong>headword</strong> field.";
$lang_import23="Please choose again the fields. One or more fields were the same.";
$lang_import24="Import - processing...";
$lang_import25="headwords done.";
$lang_import26="Congratulations. You have succesfully imported";
$lang_import27="headword(s) into ds_1_headword table and";
$lang_import28="sense(s) into ds_2_senses. You can start now editing your dictionary. We wish you good luck.";
$lang_import29="not include";
$lang_import30="compound devision";

$lang_import31="compound devision 2";
$lang_import32="synonym link";
$lang_import33="translation usage";
$lang_import34="order";
$lang_import35="category";
$lang_import36="phrase";
$lang_import37="phrase order";
$lang_import38="submit form";
?>
