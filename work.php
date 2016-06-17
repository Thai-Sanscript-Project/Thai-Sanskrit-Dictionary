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
$page = array('0' => 'Útok hackera',				
'1' => 'Mazání',
'2' => 'Hlavní',
'3' => 'Seznam uživatelů',
'4' => 'Uživatel',
'5' => 'Slovník',
'6' => 'Vyhledat',
'7' => 'Přidání heslového slova',
'8' => 'Nastavení',
					
'10' => 'Statistiky',
'11' => 'Potvrzení úprav',							
'12' => 'Přidání úkolu',
'13' => 'Zapsání se do úkolu',
'14' => 'Zakončení úkolu',
'15' => 'Přidání významu',

'17' => 'Změna čísla heslového slova',
							
'21' => 'Publikování s LaTexem - email',
'25' => 'Přihlášení',
'26' => 'Odhlášení',
'27' => 'Vymazání heslového slova',
'28' => 'Vymazání významu heslového slova',
							
'100' => 'Deklinace',
'101' => 'Přidání skloňování podstatného jména do databáze slovních tvarů',
'110' => 'Vytvoření deklinačních tabulek zájmen',
'111' => 'Vymazání deklinačních tabulek zájmen',
'112' => 'Úprava deklinačních tabulek zájmen',
'110' => 'Přidání deklinačních tabulek zájmen do databáze slovních tvarů',
'105' => 'Uložení skloňování přídavného jména do databáze slovních tvarů',
'106' => 'Vymazání deklinačních tabulek přídavného jména',
'107' => 'Úprava 3. stupně přídavného jména',
'108' => 'Úprava 2. stupně přídavného jména',
'109' => 'Úprava 1. stupně přídavného jména',
'115' => 'Úprava stupňování příslovce',
'116' => 'Přidání deklinačních tabulek příslovce do databáze slovních tvarů',
'117' => 'Vytvoření deklinačních tabulek',
'118' => 'Smazání deklinačních tabulek příslovce',
'120' => 'Úprava skloňování podstatného jména',
'121' => 'Přidání deklinačních tvarů do databáze slovních tvarů',
'122' => 'Vytvoření deklinačních tabulek podstatného jména',
'123' => 'Smazání deklinačních tabulek podstatného jména',
'130' => 'Přidání slovesných deklinačních tvarů do databáze slovních tvarů',
'131' => 'Úprava činného rodu slovesa',
'132' => 'Úprava mediopasiva slovesa',
'133' => 'Úprava trpného rodu slovesa',
'134' => 'Úprava příčestí minulého slovesa',
'135' => 'Vytvoření deklinačních tabulek slovesa',
'136' => 'Přidání časovacích tvarů slovesa do databáze slovních tvarů',
'137' => 'Vymazání deklinačních tabulek slovesa',

'501' => 'Změna projektového hesla',

'505' => 'Úprava heslového slova',
'506' => 'Přidání nového významu',
'507' => 'Úprava pramene',
'508' => 'Přidání nového pramene',
'509' => 'Vymazání pramene',
							
'16' => 'Přidání zprávy pro registrované uživatele',
'161' => 'Úprava zprávy pro registrované uživatele',
'162' => 'Vymazání zprávy pro registrované uživatele',
							
'514' => 'Úprava informací o uživateli',
'519' => 'Uložení do historie',
'520' => 'Vložení fonému',
'521' => 'Úprava fonému',
							
'523' => 'Úprava nastavení',

'513' => 'Přidání zprávy pro neregistrované uživatele',
'525' => 'Úprava zprávy pro neregistrované uživatele',
'526' => 'Vymazání zprávy pro neregistrované uživatele',
														
'528' => 'Přidání kategorie použití',
'527' => 'Úprava kategorie použití',
'529' => 'Vymazání kategorie použití',
							
'535' => 'Vyslání e-mailu s heslem',
'538' => 'Vyslání e-mailu všem uživatelům',
);
if ($load_stats===TRUE) {
} else {
$oop10 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$work=  'ds_work';
if ($keyword_work!='') {
$sql10 = sprintf ('INSERT INTO `%s` (`num`, `id_user`, `time`, `activity`, `keyword`, `num_keyword`) VALUES (NULL, %s, %s, %s, %s, %s)',
       $work,
	quate_smart($_SESSION["id_user"]),
	quate_smart(date("Y-m-d H:i:s")),
	quate_smart($page_id),			
	quate_smart($keyword_work),
	quate_smart($num_keyword_work)); 
$oop10->Setnames();
$oop10->query($sql10);
$oop10->freeResult();
} else  {
if (!$ip) {
$ip='';
}
$sql10 = sprintf ('INSERT INTO `%s` (`num`, `id_user`, `time`, `activity`, `activity_detail`) VALUES (NULL, %s, %s, %s, %s)',
       $work,
	quate_smart($_SESSION["id_user"]),
	quate_smart(date("Y-m-d H:i:s")),
	quate_smart($page_id),			
	quate_smart($ip)); 
$oop10->Setnames();
$oop10->query($sql10);
$oop10->freeResult();
}
$oop10->_mySQL;
}
?>
