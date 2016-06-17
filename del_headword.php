<?php
include 'redirect_public.php';
$keyword_del = $_GET["d_h"];
$num_keyword_del = $_GET["d_h_n"];
$oop2 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$dict_keyword='ds_1_headword'; 
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`=%s',
	$dict_keyword,
	$collation_1,
	quate_smart($keyword_del),
	quate_smart($num_keyword_del));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$table = 'ds_history';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`=%s',
	$table,
	$collation_1,
	quate_smart($keyword_del),
	quate_smart($num_keyword_del));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$table_dict1 = 'ds_2_senses';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`=%s',
	$table_dict1,
	$collation_1,
	quate_smart($keyword_del),
	quate_smart($num_keyword_del));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
//////////// noun
$table2 = 'ds_dec_noun';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($keyword_del),
	quate_smart($num_keyword_del));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();

// adjective
$table2 = 'ds_dec_adj_info';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($keyword_del),
	quate_smart($num_keyword_del));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$table2 = 'ds_dec_adj_1';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($keyword_del),
	quate_smart($num_keyword_del));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$table2 = 'ds_dec_adj_2';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($keyword_del),
	quate_smart($num_keyword_del));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$table2 = 'ds_dec_adj_3';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($keyword_del),
	quate_smart($num_keyword_del));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
//pronoun
$table2 = 'ds_dec_pron';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($keyword_del),
	quate_smart($num_keyword_del));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
//pronoun_pers
$table2 = 'ds_dec_pron_pers';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($keyword_del),
	quate_smart($num_keyword_del));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
//ADVERB
$table2 = 'ds_dec_adv';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($keyword_del),
	quate_smart($num_keyword_del));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
//wordform
$table_declination='ds_wordform';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table_declination,
	$collation_1,
	quate_smart($keyword_del),
	quate_smart($num_keyword_del));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
// verb
$table2 = 'ds_dec_v_info';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($keyword_del),
	quate_smart($num_keyword_del));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$table2 = 'ds_dec_v_1';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($keyword_del),
	quate_smart($num_keyword_del));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$table2 = 'ds_dec_v_2';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($keyword_del),
	quate_smart($num_keyword_del));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$table2 = 'ds_dec_v_3';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($keyword_del),
	quate_smart($num_keyword_del));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
$table2 = 'ds_dec_v_4';
$sql2 = sprintf ('DELETE FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword` = %s',
	$table2,
	$collation_1,
	quate_smart($keyword_del),
	quate_smart($num_keyword_del));
$oop2->Setnames();
$oop2->query($sql2);
$oop2->freeResult();
//images
$table_images = 'ds_images';
$sql = sprintf ('SELECT `name_of_file`, `id` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`= %s',
	$table_images,
	$collation_1,
	quate_smart($keyword_del),
	quate_smart($num_keyword_del)); 
$oop2->Setnames();
$oop2->query($sql);
$num = $oop2->getNumRows();
if ($num!=0) {
$oop4 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
while ($image = $oop2->fetchArray ()):
$sql2 = sprintf ('DELETE FROM `%s` WHERE `id`= %s',
	$table_images,
	quate_smart($image[1]));
$oop4->Setnames();
$oop4->query($sql2);
$oop4->freeResult();
$uploadsDirectory = $con_uploadsDirectory;
$myFile = $uploadsDirectory.$image[0];
unlink($myFile);
$myFile2 = $uploadsDirectory.'th_'.$image[0];
unlink($myFile2);
endwhile;
$oop4->_mySQL;
}
$oop2->freeResult();
//sound
$table_sound = 'ds_sound';
$sql = sprintf ('SELECT `sound`, `id` FROM `%s` WHERE `keyword` COLLATE `%s` = %s AND `num_keyword`= %s',
	$table_sound,
	$collation_1,
	quate_smart($keyword_del),
	quate_smart($num_keyword_del)); 
$oop2->Setnames();
$oop2->query($sql);
$num = $oop2->getNumRows();
if ($num!=0) {
$oop4 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
while ($sound = $oop2->fetchArray ()):
$sql2 = sprintf ('DELETE FROM `%s` WHERE `id`= %s',
	$table_sound,					
	quate_smart($sound[1]));
$oop4->Setnames();
$oop4->query($sql2);
$oop4->freeResult();
$uploadsDirectory = $sound_uploadsDirectory;
$myFile = $uploadsDirectory.$sound[0];
unlink($myFile);
endwhile;
$oop4->_mySQL;
}
$oop2->freeResult();
$oop2->_mySQL;
$page_id=27; 
include './work.php'; 
$_SESSION["ses_message"] .= $lang_edit_delete1.$keyword_del. $lang_edit_delete1;
?>