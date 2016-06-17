<?php
	if ($_SESSION["adv_field"]=='specification') {
	$table='ds_specifikace';
	$sql = sprintf ('SELECT * FROM `%s` ORDER BY `zkratka_spec`',
		$table); 	
	}
	
	if ($_SESSION["adv_field"]=='usage_specification') {
	$table='ds_spec_usage';	
	$sql = sprintf ('SELECT * FROM `%s` ORDER BY `abb_usage`',
		$table); 
	}
	
	if ($_SESSION["adv_field"]=='usage_category') {
	$table='ds_usage_category';
	$sql = sprintf ('SELECT * FROM `%s` ORDER BY `is_category`',
		$table); 	
	}
	
	if ($_SESSION["adv_field"]=='gram_1_word_group') {
	$table='ds_abb_grammar';
	$sql = sprintf ('SELECT * FROM `%s` ORDER BY `abb_grammar`',
		$table); 	
	}
	
	if ($_SESSION["adv_field"]=='gram_2_endings') {
	$table='ds_abb_grammar_endings';
	$sql = sprintf ('SELECT * FROM `%s` ORDER BY `grammar_endings`',
		$table); 	
	}
	
	if ($_SESSION["adv_field"]=='gram_3_additional') {
	$table='ds_abb_grammar_additional';
	$sql = sprintf ('SELECT * FROM `%s` ORDER BY `abb_grammar`',
		$table); 	
	}
	
if (($_SESSION["adv_field"]=='specification') OR ($_SESSION["adv_field"]=='usage_specification') OR ($_SESSION["adv_field"]=='usage_category') OR ($_SESSION["adv_field"]=='gram_1_word_group') OR ($_SESSION["adv_field"]=='gram_2_endings') OR ($_SESSION["adv_field"]=='gram_3_additional')) {
	
$oop9 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$oop9->Setnames();
$oop9->query($sql);
$tip_output .= 'Tip: <br>';
while($returned = $oop9->fetchRow ()) :
$tip_output .= "<a href=\"search.php?action=find&amp;post_keyword=".$returned[1]."&amp;pagenum=1&amp;list_adv_field=".$_SESSION["adv_field"]."\"><span class=\"dtrn2\">".$returned[1]."</span> <span class=\"specification\">".$returned[2]."</span></a><br>";
endwhile;
$oop9->freeResult();
$oop9->_mySQL;
echo $tip_output;
}
?>
