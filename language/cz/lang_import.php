<?php 
// Text specific to each Dictionary. Update text with your data.
$lang_import_headings="Import";
$lang_import1="Nahrání souboru na server (krok 1/3)";
$lang_import2="Funkce importu Vám pomůže importovat Váš slovník do aplikace DS. Nejdříve vyexportujte Váš slovník do formátu csv. Tento
formát je podporován většinou databázových programů (Excel, MySQL etc.). Formát csv by měl být v následujícím tvaru - \"fallegur\",\"adj\",\"hezký\",\"fagur\" (dvojité uvozovky kolem textu a sloupce odděleny čárkou). 
Každý řádek v souboru reprezentuje jeden řádek v tabulce. Poté, co nahrajete soubor na server, budete moci přiřadit každé hodnotě, co označuje (první sloupce -> heslové slovo, druhý sloupec -> překlad ap.)
a to podle prvního řádku";
$lang_import3="Prosím nahrajte csv soubor, který chcete importovat. Soubor bude uložen do adresáře ";
$lang_import4=" na serveru. Do toho adresáře ";
$lang_import5="je možné zapisovat.";
$lang_import6="není možné zapisovat. Prosím změňte oprávnění k adresáři na chmod 777.";
$lang_import7="Dočasný soubor bude uložen do ";
$lang_import8="Do tohoto adresáře";
$lang_import9="Tabulka ds_1_headword již existuje ";
$lang_import10="heslových slov a tabulka ds_2_senses";

$lang_import11="heslových slov. Chcete tabulku vyčistit (truncate)? Pokud zaškrtnete, tabulky ds_1_headword a ds_2_senses budou vyčistěny a Vy začnete od samého začátku tím, že importujete nový slovník. Pokud nezaškrtnete, aplikace při importu zkontroluje, zda-li nejsou heslová slova duplicitní a vloží pouze neduplicitní heslová slova do tabulek.";
$lang_import12="Vyčistit (truncate) tabulky";
$lang_import13="Aplikace zkontrolovala tabulky ds_1_headword a ds_2_senses a zjistila, že jsou prázdné. Můžete bezpečně pokračovat v importu nových dat.";
$lang_import14="Prosím povštimněte si, že používáte porovnání";
$lang_import15="Můžete změnit porovnání v souboru connection.php. Soubor je umístěn v kořenovém adresáři aplikace. Poté, co přiřadíte nové porovnání proměnné $collation_1, nahrajte soubor connection.php přes FTP na server a pokračujte v importu.";
$lang_import16="Správné nastavení porovnání je důležité pro porovnávání heslových slov během importu do tabulky, která již obsahuje nějaká data. Porovnání je také používáno v celé aplikaci. Pokud si nejste jisti, jaké porovnání zvolit pro Vaši kombinaci jazyků, vyberte <strong>utf8_unicode_ci</strong>, které by mělo fungovat ve většině případů.";
$lang_import17="Přiřadit hodnotám pole (krok 2/3)";
$lang_import18="Tabulky byly vyčištěny.";
$lang_import19="Počet položek:";
$lang_import20="Prosím přiřaďte všechny (nebo pouze některé) hodnoty správnénum poli v tabulce. Každá hodnota reprezentuje sloupec v tabulce. Není možné přiřadit více hodnot stejnému poli. Je nutné přiřadit jednu hodnotu poli <strong>Heslové slovo</strong>, neboť
toto pole slouží k identifikaci heslového slova v aplikaci. Pokud nechcete přiřadit hodnotě pole (nechcete hodnotu importovat), zvolte <strong>nezahrnovat</strong>(původní). Tato hodnota nebude importována.";

$lang_import21="Importování (krok 3/3)";
$lang_import22="Poznámka: Musíte přiřadit jednu hodnotu poli <strong>heslové slovo</strong>";
$lang_import23="Prosím přiřaďte znovu hodnoty. Jedno nebo více polí bylo stejné.";
$lang_import24="Import - pracuji...";
$lang_import25="heslových slov importovaných.";
$lang_import26="Gratulujeme. Úspěšně jste importoval ";
$lang_import27="heslových slov do tabulky ds_1_headword a";
$lang_import28="významů do ds_2_senses. Nyní můžete začít s úpravou heslových slov ve slovníku. Přejeme Vám hodně úspěchů.";
$lang_import29="nezahrnovat";
$lang_import30="dělení složených slov";

$lang_import31="dělení složených slov 2";
$lang_import32="odkaz na synonymum";
$lang_import33="charakteristika překladu";
$lang_import34="pořadí významu v heslu";
$lang_import35="kategorie";
$lang_import36="fráze";
$lang_import37="pořadí ve frázi";
$lang_import38="potvrdit";
?>
