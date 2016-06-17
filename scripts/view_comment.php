	 
<div id="viewentry">

	<?php
// comment
$oop_c = new mySQL ($host1, $user1, $pass1, $data1, TRUE);

$table=  'ds_dict1_comment';
$sql_c = sprintf ('SELECT * FROM `%s` WHERE `keyword` COLLATE `%s` like %s AND `num_keyword`=%s ',
			$table,
			$collation_1,
			quate_smart($view_keyword),
			quate_smart($view_num_keyword));
			
$oop_c->Setnames();
$oop_c->query($sql_c);	
$num3 = $oop_c->getNumrows();
$returned_c = $oop_c->fetchRow ();


$oop_c->FreeResult();
$oop_c->_mySQL;
?>

 <form action="add_comment.php?action=confirm" method="post" name="form">
<?=$lang_search_comment?><input type="text" class="inputbox" name="comment" size="5" maxlength="30" value="
<?php
echo $returned_c[3];
?>
"> 
<br>
<input type="hidden" id="keyword" name="keyword" value="<?php echo $view_keyword;?>">
<input type="hidden" id="num_keyword" name="num_keyword" value="<?php echo $view_num_keyword;?>">
<input type="hidden" name="post_keyword" value="<?php echo $_GET["post_keyword"];?>">
<input type="hidden" name="pagenum" value="<?php echo $_GET["pagenum"];?>">
<input type="submit" class="button2" name="submit_direct" value="<?=$lang_search_button_comment?>">

</form>

<entry class ="pos"> 
<br>(1.e.d - 2.spec.o)
<br>o.opravit - d.dopnit - dv.doplnit význam
<br>p.překlad - s.synonymum - a.antonymum - e.example - gr.gramatika - spec.specifikace

</entry>
</div>
