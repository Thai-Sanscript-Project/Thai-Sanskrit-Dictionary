<div class="menu_edit">
<ul>
<li><a href="./index.php" target="_self" >domů</a>
</li>
<li><a href="" target="_self" >úpravy</a>
<ul>
<li><a href="./add.php" target="_self">přidat nové slovo</a></li>
<li><a href="./phonetics.php" target="_self">úprava fonetiky</a></li>
<li><a href="./usage_category.php" target="_self">úprava kategorií</a></li>
<li><a href="./sources.php" target="_self">úprava pramenů</a></li>
</ul>
</li>
<li><a href="" target="_self" >profil</a>
<ul>
<li><a href="./user.php" target="_self">vlastní profil</a></li>
<li><a href="./listofusers.php" target="_self">uživatelé</a></li>
<li><a href="./stats.php" target="_self">statistiky</a></li>
<li><a href="./todo.php" target="_self">úkoly</a></li>
</ul>
</li>
<li><a href="" target="_self" >administrace</a>
<ul>
<li><a href="./fileprint.php" target="_self">tisk</a></li>
<li><a href="./admin_settings.php" target="_self">nastavení</a></li>
</ul>
</li>
<li><a href="./help.php?page=toc" target="_self" >nápověda</a>
</li>
<li><a href="./logout.php" target="_self" >odhlásit</a>
</li>
</ul>
</div>

 <?php 
if ($_SESSION["ses_message"]!='') {
	echo '<br><p>';
	echo '<span class="ses_message"> '.$_SESSION["ses_message"].'</span><br>';
	echo '</p>';
	$_SESSION["ses_message"]='';
}
?>
