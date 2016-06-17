<?php 
$lang_int_1_title= "Přírůčka pro úpravu heslových slov";
$lang_int_1= "Tato přírůčka je určena pro správnou úpravu heslových slov. Přírůčka vysvětluje, jakým způsobem jednotlivé položky
zapisovat a v jakém účelu. Vysvětluje také, jaké položky se zobrazují v tištěné verzi, jaké v online verzi a jaké položky jsou pouze prostředkem
k zobrazení dalších informací. <br><br>
První část editační tabulky obsahuje informace týkající se přímo heslového slova. V případě, že heslové slovo má více významů, zůstávájí tyto
informace stále stejné pro všechny významy a je možné je upravit z jakéhokoliv významu. Pro úplnost a názornou představu lze podotknout, že tyto informace jsou
dokonce uloženy v jiné tabulce.<br><br>
Další části editační tabulky obsahují informace týkající se významu heslového slova. <br><br>

Je důležité si uvědomit, že ve většině případů se heslové slovo skládá z vyplněných položek Heslové slovo, Číslo heslového slova, Gramatika (slovní třídy), Gramatiky (koncovky), Překlad.
<br><br>
Pokud chceme přidat další význam, stiskneme menu/slovo/přidat význam. Objeví se (téměř) prázdná editační tabulka (první část tabulky je již vyplněna, neboť obsahuje všeobecné informace o slově). V položce překlad se
vyskytuje ang. slovo \"new\"."; 

$lang_int_2_title= "Heslové slovo";
$lang_int_2= "Na stránce vytvoření nového heslového slova vpište nové heslové slovo. Heslové slovo není možné změnit na editační stránce. Heslové slovo je možné jedině smazat a vytvořit nové heslové slovo."; 

$lang_int_3_title="Číslo heslového slova";
$lang_int_3="Číslo heslového slova není možné změnit na editační stránce. Pokud chcete změnit číslo heslového slova, zvolte menu/třídění/změnit číslo heslového slova.
Pokud chcete vložit heslové slovo, které je již ve slovníku, musíte vložit jiné číslo heslového slova. Homonyma jsou rozlišena právě čísly heslového slova.
<br>
Všechna heslová slova, která nejsou homonyma musí mít číslo heslového slova 0. Číslo 0 se nezobrazuje. 
<div id=\"help_image\"><img src=\"/images/help/num_headword_hest.png\">
</div>
Všechna heslová slova, která jsou homonyma musí mít číslo heslového slova větší jak nula v řadě za sebou, viz. heslo fela
<div id=\"help_image\"><img src=\"/images/help/num_headword_koma.png\">
</div>
<br>
Způsob řazení slovních druhů: <br> 
Pokud jsou heslová slova homonyma - nejdříve umístíme podstatné jméno (nejdříve mužský rod, pak ženský rod, pak střední rod), potom 
přídavná jména, zájmena, číslovky, slovesa (nejdříve slabé časování, potom silné časování, potom nepravidelné), potom příslovce, předložky, spojky, částice, citoslovce a nakonec předpony.
";

$lang_int_4_title="Výslovnost";
$lang_int_4="Pro zápis výslovnosti můžete použít menu/odkazy/IPA. Můžete použít menu/informace/generování výslovnosti pro automatické vygenerování IPA zápisu a poté výsledek zkopírovat a upravit. Upozornění - Microsoft Explorer neumí správně zobrazit IPA znaky při editaci. Prosím použijte jiný prohlížeč.
<br><br>
<div id=\"help_image\"><img src=\"/images/help/ipa_char_picker.png\">
</div>";

$lang_int_5_title="Dělení slov";
$lang_int_5="Zápis heslového slova se speciálními značkami - \"·\",  \"··\" and \"|\"<br>
\"·\" ukazuje vedlejší dělení složeného slova, možnost mnohonásobného použití <br>
\"··\" ukazuje hlavní dělení složeného slova, používejte pouze jednou<br>
 \"|\" ukazuje, kde se k heslovému slovu připojuje deklinančí koncovka, pouze jednou <br>
Podívejte se následující příklad:<br>
<div id=\"help_image\"><img src=\"/images/help/stem_hestur.png\">
</div>
V heslovém slově \"hest|ur\" deklinační koncovka \"-ur\" se připojuje ke slovu za písmenem \"t\". 
Deklinační koncovky \"hestur\" jsou (-s, -ar) a tedy 2. pád jednotného čísla je \"hests\" a 1. pád množného čísla je \"hestar\". 
<br>
Upozornění: Značky mohou následovat po sobě, např tehdy, když po hlavním dělení slova následuje značka deklinační koncovky. Podívejte se na následující příklad ve slově  \"bílasala\":
<br>
<div id=\"help_image\"><img src=\"/images/help/stem_bilasala.png\">
</div>";

$lang_int_6a_title="Frekvence";
$lang_int_6a="Zde je možné použít číslo pořadí heslového slova podle četnosti nebo předem dohodnuté symboly pro označení heslových slov, které jsou
velmi časté, méně časté apod. Tato položka nemusí být ve slovníku přímo uvedena, ale je podle ní možné realizovat preference ve vyhledávání apod.";

$lang_int_6b_title="Složená slova";
$lang_int_6b="Položka složená slova slouží k zobrazení, z jakých heslových slov se složené slovo skládá. <br>
Způsob zápisu:<br>
Zapisujeme vždy pouze dvě heslová slova podle hlavního dělení. Podívejte se na následující příklad u slova samkomulag. Heslové slovo se dělí na samkomu a lag.
Nejdříve zapíšeme heslové slovo v základním tvaru a do hrananté závorky zapíšeme původní tvar a doplníme čárku (nakonec slova nebo na začátek podle toho, kde se slovo připojuje k
druhé části složeného slova. <br><br>

,samkoma[samkomu-],lag[-lag],<br>
Důležité je zachovat stejný formát - čárka před a po části složeného slova se závorkou. <br>
Při uložení do historie se vygeneruje vždy přehled složených slov. V tomto případě po uložení do historie heslových slov samkoma a lag se doplní složené
slovo samkomulag do obou heslových slov.";

$lang_int_7_title="Gramatika - slovní třídy";
$lang_int_7="V tomto poli se objevuje vyskakovací nápověda pro snadné vybrání slovní třídy.

<div id=\"help_image\"><img src=\"/images/help/A_word_group_popup.png\">
</div>
<br>
Pro kompletní seznam zkratek si otevřete menu/informace/zkratky podle použití.
<br>
<div id=\"help_image\"><img src=\"/images/help/A_word_group_question.png\">
</div>
<br>
";

$lang_int_8_title="Gramatika - koncovky";
$lang_int_8="V tomto poli zapisujeme deklinační koncovky heslových slov. Správné zapsání koncovek je důležité pro generování deklinačních tabulek. 
<br>
Deklinanční koncovky jsou uvedeny jak v online verzi tak v tištěné verzi (narozdíl od deklinačních tabulek, které nejsou v tištěné verzi).
Pro každou slovní třídu jsou určitá pravidla. Nejdříve se zmíníme o pravidlech, která platí pro všechny třídy a později o pravidlech pro každou třídu.
<br>
Všechny informace v tomto poli musí být uzavřeny závorkami \"()\", <br><br>
Upozornění - nesprávné uvedení koncovek (např. chybějící závorky, vynechání mezery nebo čárky mezi koncovky) má za následek, že pokud budete později chtít
vygenerovat deklinační tabulky, může se stát, že se vygenerují chybně. <br><br>

<div id=\"help_image\"><img src=\"/images/help/gram_endings_hestur.png\">
</div>

až na několik vyjímek jak je množné číslo podstatných jmen - pl, viz. následující příklad:

<div id=\"help_image\"><img src=\"/images/help/gram_endings_pl.png\">
</div>

<br>
<strong>Koncovky podstatných jmen</strong><br>
První pravidlo: Uveďte 2. pád jednotného čísla a 1. pád množného čísla. 
<div id=\"help_image\"><img src=\"/images/help/gram_endings_hestur.png\">
</div>
Druhé pravidlo: Pokud se heslové slovo vyskytuje jen v jednotném čísle, uveďtě 2. pád jednotného čísla.
<div id=\"help_image\"><img src=\"/images/help/gram_endings_sg.png\">
</div>
Třetí pravidlo: Pokud se heslové slovo vyskytuje jen v množném čísle, uveďte zkratku \"pl\".
<div id=\"help_image\"><img src=\"/images/help/gram_endings_pl.png\">
</div>
<br>
Čtvrté pravidlo: Pokud je heslové slovo nesklonné, uveďte zkratku \"indecl\"
Příklady koncovek podstatných jmen:<br>
<br>
(-s, -ar) => koncovky rodu mužského<br>
(-ar, -ar) => koncovky rodu ženského<br>
(-s, -) => koncovky rodu středního<br>
(-s) => koncovka rodu středního jednotné číslo<br>
pl => pouze množné číslo podstatných jmen<br>
indecl => podstatné jméno nesklonné<br>

<br>
<br>
V případě, že s heslovém slově při skloňování dochází k změně samohlásky (viz. na příklad množné číslo slova \"lag\") je nutné
tuto změnu naznačit v deklinačních koncovkách. 
<div id=\"help_image\"><img src=\"/images/help/word_endings_lag.png\">
</div>

<br><br>
<strong>Koncovky přídavných jmen</strong><br>
Koncovky přídavných jmen zapište pouze tehdy, je-li nepravidelná forma ženského nebo středního rodu. Podívejte se na následující příklad:
<div id=\"help_image\"><img src=\"/images/help/word_endings_hamingjusamur.png\">
</div>
Tento příklad ukazuje, že v ženském rodě (zkratka \"f\", viz zkratky Gramatika - slovní třídy) dochází ke změně samohlásky.
<br>
Ve všech ostatních případech je ponecháno toto pole prázdné - nezapisujeme deklinační koncovky, neboť jsou pravidelné, viz. slovo \"fallegur\" 
<div id=\"help_image\"><img src=\"/images/help/word_endings_fallegur.png\">
</div>

<br><br>
<strong>Koncovky zájmen</strong><br>
Obvykle nezapisujeme koncovky zájmen.
<div id=\"help_image\"><img src=\"/images/help/word_endings_hana.png\">
</div>
pouze tehdy, jestli musíme specifikovat tvar zájmena, uvádíme informaci v závorkách\"()\". Podívejte se na příklad slova \"hana\":
<div id=\"help_image\"><img src=\"/images/help/word_endings_ed.png\">
</div>
Pořadí zápisu informací: 1. číslo, 2. rod, 3. osoba, 4. pád
<br>
Povštimněte si, že v tomto poli uvádíme pouze informace o skloňování. Všechny ostatní informace o zájmeně, jako na příklad, že zájmeno je 
ukazovací, osobní apod., uvádíme v poli Gramatika - přídavné informace.

<br><br>
<strong>Koncovky sloves</strong><br>
Koncovky sloves uvádíme podle toho, do jaké časovací skupiny sloveso náleží. Slovesa zařazujeme do tří skupin.<br>
A. slabá slovesa, která tvoří přítomný čas v 1. osobě koncovkou -a. 
Například sloveso \"hjálpa\". U této skupiny uvádíme 1. osobu minulého času (-aði)
<div id=\"help_image\"><img src=\"/images/help/word_endings_hjalpa.png\">
</div>
B. slabá slovesa, která tvoří přítomný čas v 1. osobě koncovkou -i. Na příklad sloveso \"frétta\". V tomto případě
uvádíme 1. osobu jednotného čísla minulého času a koncovku (nebo celý tvar) příčestí minulého.
Kdykoliv je to možné, uvádíme pouze koncovku, která se připojí k části heslového slova. Pokud to však není možné,
musíme uvést celý tvar, viz. \"frétt\".
<div id=\"help_image\"><img src=\"/images/help/word_endings_fretta.png\">
</div>
C. silná slovesa. Zde uvádíme 4 tvary: 1. osoba jednotného čísla přítomného času, 1. osoba jednotného čísla minulého času,
1. osoba množného čísla minulého času a příčestí minulé.
<div id=\"help_image\"><img src=\"/images/help/word_endings_fara.png\">
</div>
<br><br>

<br>";

$lang_int_9_title="Gramatika - přídavné informace";
$lang_int_9="V tomto poli uveďte gramatické informace, které se nevztahují k slovním třídám nebo deklinačním koncovkám, jako na příklad<br>
<br> Je možné uvést více informací, pokud je to potřeba. 
Informace o pádě:<br>
gen - 2. pád<br>
acc - 4. pád<br>
nom - 1. pád<br>
dat - 3. pád<br>
<br>
Informace o tvaru určitém:<br>
def - tvar určitý<br>
<br>
Druh číslovky:<br>
ord - řadová číslovka<br>
<br>
Druh zájmena:<br>
pers - osoba/ zájmeno osobní<br>
poss - zájmeno přivlastňovací<br>
dem - zájmeno ukazovací<br>
indef - zájmeno neurčité<br>
<br>
Informace o slovese:<br>
pp - příčestí minulé<br>
refl - mediopasivum<br>
impers - sloveso neosobní<br>
met - sloveso počasí<br>
<br>
Informace o stupňování přídavných jmen a příslovcí:<br>
sup  - superlativ<br>
comp - stupňování, 2. stupeň<br>
<br>";

$lang_int_10_title="Varianta heslového slova";
$lang_int_10="Uveďte variantu heslového slova bez pomocných značek pro dělení slov - tedy v základním tvaru. Pokud se varianta vyskytuje
ve slovníku, automaticky se vytvoří hypertextový odkaz. V případě, že je varianta homonymem, uveďte v následném tvaru podle příkladu:<br>
<br>
koma(2)<br>
<br>
Varianta odpovídá heslovému slovu koma s číslem heslového slova 2. Tento zápis odpovídá v tištěné podobě a náhledu <sup>2</sup>koma<br>
<br>
Pro úplnost si řekněme, že pokud je číslo heslového slova (např. albatros) 0 (nula), pak zapisujeme jednoduše jako
<br>
albatros<br>
<br>
tedy bez čárek a závorek a bez uvedení čísla heslového slova. Podobný zápis homonym se vyskytuje také u synonym, antonym, odkazu na jiné heslové slovo.
<div id=\"help_image\"><img src=\"/images/help/variant_albatros.png\">
</div>";

$lang_int_11_title="Poznámky k heslovému slovu";
$lang_int_11="Poznámky se nezobrazují v tištěné podobě ani online podobě a slouží výhradně lexikografům ke společné práci. Zapisujte zde různé postřehy, překlady heslového
slova do jiných jazyků, odkazy na informace o významu heslového slova apod.
<div id=\"help_image\"><img src=\"/images/help/notes_adalfundur.png\">
</div>";

$lang_int_12_title="Ukazatel";
$lang_int_12="K odlišení více významů použijte arabské číslice (1., 2., 3. atd.) s tečkou.";

$lang_int_13_title="Druhotný ukazatel";
$lang_int_13="Použijte malá písmena v abecedním pořadí (a., b., c. etc) s tečkou k odlišení druhotných významů, např. v případě, kdy slovní spojení má více významů.<br>
<br>
Podívejte se na příklad u slovesa \"finna\".<br>
Reflexivní forma \"finnast\" má dva významy a ty jsou odlišeny druhotným ukazatelem.<br>
<div id=\"help_image\"><img src=\"/images/help/sec_marker_finna.png\">
</div>
Všimněte si, že se znovu nepíše slovní spojení ani gramatická informace slovního spojení v druhém významu \"finnast\"<br>";

$lang_int_14_title="Slovní spojení/ slovo";
$lang_int_14="V tomto poli uveďte slovní spojení nebo tvar heslového slova. Například \"finna til\" v heslovém slově \"finna\", \"gefa e-m e-ð\"
v heslovém slově \"gefa\".
<br><br>
Zapisujte celý tvar slovního spojení. V některých slovnících v tištěné verzi se používá značka tylda ke zkrácení zápisu (a ušetření místa). V online
verzi slovníku je zřejmě čitelnější uvést celou verzi. Zkrácení (pokud se autoři slovníku rozhodnou) je možné realizovat skriptem.
<div id=\"help_image\"><img src=\"/images/help/word_finna.png\">
</div>
<br><br>
Některá slovní spojení mohou obsahovat více slov nebo i celé věty např. \"það liggur hundurinn grafinn\". 
<div id=\"help_image\"><img src=\"/images/help/word_phrase_liggur.png\">
</div>
Slovní spojení uvádějte pouze u jednoho heslového slova a to u toho slova, ke kterému logicky nejvíce náleží. V předchozím případě ke slovu
 \"hundur\". <br>
V online verzi je toto slovní spojení nicméně uvedeno i u zbylých heslových slov ve slovním spojení (\"þar\", \"liggur -> liggja\", \"grafinn -> grafa\"), ale 
to na jiném místě v náhledu slova (Heslová slova ve slovních spojeních) a díky tomu, že se správně vyplní pole Heslová slova ve slovních spojeních. 

<div id=\"help_image\"><img src=\"/images/help/word_phrase_hundur.png\">
</div>
Jestliže se vyskytují varianty zápisu slovního spojení, použijte závorky nebo lomítko \"/\" k vyjádření více variant. 

<div id=\"help_image\"><img src=\"/images/help/word_phrase_options.png\">
</div>

Prohlédněte si zápis slovního spojení \"fara í hundana (í hund og kött/ í hund og hrafn)\", které je možné přečíst jako
\"fara í hundana\", \"fara í hund og kött\", \"fara í hund og hrafn\".";

$lang_int_15_title="Gramatika slovního spojení";
$lang_int_15="Zapište gramatické informace, které se vztahují výlučně ke slovnímu spojení a kterého např. odlišují od jiných významů v heslovém slově. K zápisu
použijte stejné zkratky jako v zápisu Gramatika - přídavné informace a to jmenovitě:<br><br>
Informace o pádě:<br>
gen	2. pád<br>
acc	4. pád<br>
nom	1. pád<br>
dat	3. pád<br>
<br>
Informace o tvaru určitém:<br>
def	tvar určitý<br>
<br>
Druh číslovky:<br>
ord	řadová číslovka<br>
<br>
Druh zájmena:<br>
pers	osoba/ zájmeno osobní<br>
poss	zájmeno přivlastňovací<br>
dem	zájmeno ukazovací<br>
indef	zájmeno neurčité<br>
<br>
Informace o slovese:<br>
pp	příčestí minulé<br>
refl	mediopasivum<br>
impers	sloveso neosobní<br>
met	sloveso počasí<br>
<br>
Informace o stupňování přídavných jmen a příslovcí:<br>
sup 	superlativ<br>
comp	stupňování, 2. stupeň<br>
<br>
";

$lang_int_16a_title="Překlad";
$lang_int_16a="Překládejte jeden význam heslového slova jedním nebo více slovy. Použijte čárku \",\" pro oddělení překladů. Použijte středník \";\" pro oddělení překladu, který obsahuje čárku \",\" viz. následující příklad:

<div id=\"help_image\"><img src=\"/images/help/translation_semicolon.png\">
</div>

Používejte závorek \"()\" po překladu k bližšímu určení překladu. Po ilustrační slovo uveďte \"ap.\" (a podobně) k vyjádření, že slovo v závorce je ilustrační. Na příklad:
<div id=\"help_image\"><img src=\"/images/help/translation_bracket.png\">
</div>

Používejte lomítko \"/\" ke zkrácení zápisu, na příklad překlad \"hlavní postava, ústřední postava\" zkrátíme na \"hlavní/ ústřední postava\". Lomítko \"/\" připojte vždy k první části výrazu a následně vpište mezeru mezi lomítkem a druhým slovem, viz. příklad:

<div id=\"help_image\"><img src=\"/images/help/translation_slash.png\">
</div>
V případě, že nevíte, jak výraz přeložit, uveďte \"???\" (tři otazníky). Později při revizích je snadné dohledat nepřeložené nebo nejisté překlady.";

$lang_int_16b_title="Překlad - oborová nebo stylová charakteristika";
$lang_int_16b="Uveďte v tomto poli oborovou nebo stylovou charakteristiku vztahující se k překladu. Seznam používaných zkratek naleznete menu/informace/zkratky podle použití. ";

$lang_int_16c_title="Překlad - opis";
$lang_int_16c="Pokud nelze význam heslového slova přeložit, je nutné ho opsat více slovy (v tištěné podobě i online je opis odlišen od překladu menším písmem).
Podívejte se na příklad u slova tilberi.";

$lang_int_17a_title="Synonymum";
$lang_int_17a="Uveďte synonymum pro jednotlivý význam heslového slova. Správný zápis synonym je nezbytný pro zobrazení synonym odkazující na heslové slovo.<br>
Forma zápisu: Pokud je slovo homonymem (číslo heslového slova je větší než nula), zapisujeme následovně:
<br>
koma(2)<br>
<br>
zápis odpovídá heslovému slovu koma s číslem heslového slova 2. Tento zápis odpovídá v tištěné podobě a náhledu <sup>2</sup>koma<br>
<br>
Pokud je číslo heslového slova (např. albatros) 0 (nula), pak zapisujeme jednoduše jako
<br>
albatros<br>
<br>

<div id=\"help_image\"><img src=\"/images/help/synonym_two_words.png\">
</div>

<div id=\"help_image\"><img src=\"/images/help/synonym_loka_1.png\">
</div>
V náhledu bude vypadat:<br>
<br>
<div id=\"help_image\"><img src=\"/images/help/synonym_loka_2.png\">
</div>

Pokud chcete zapsat synonymum obsahující větší množství slov (např. slovní spojení), použijte toto pole a zároveň uveďte logicky nejdůležitější slovo do položky Synonymum odkazy. V online verzi toto zajišťuje vytvoření hypertextového odkazu.";

$lang_int_17b_title="Synonymum - odkaz";
$lang_int_17b="Synonymum odkaz úzce souvisí s položkou synonymum. Píšeme pouze tehdy pokud synonymum tvoří více slov (např. \"þad ad byggja\"), přičemž používáme zápis jako u synonym.
To znamená, že pokud je číslo heslového slova větší než nula, píšeme např. ,koma(2), a  pokud je číslo heslového slova nula, píšeme jednoduše heslové slovo.";

$lang_int_18_title="Příklad";
$lang_int_18="Zde zapisujeme celé věty nebo slovní spojení nebo pouhá slova. Pokud chceme zapsat více příkladů, použijeme čárku k oddělení příkladů. Středník použijeme, pokud příklad obsahuje čárku.
K zápisu zájmen neurčitých používáme islandské zkratky (e-u, e-n atd.).
<div id=\"help_image\"><img src=\"/images/help/example_fara3.png\">
</div>
Příklad by měl plnit více rolí - např. naznačit časté slovní spojení, ukázat např. pád, s jakým se sloveso pojí ap.";

$lang_int_19_title="Překlad příkladu";
$lang_int_19="Překládáme příklad s tím, že zachováváme formu z příkladu (překládáme větu větou ap.). Zájmena neurčitá (koho, čemu, čím, kdo ap.), která korespondují s islandskými zájmeny neurčitými (e-u, e-n ap.) vkládáme do kulatých závorek. Například mluvil jsem s (kým)";

$lang_int_20_title="Heslová slova v příkladech";
$lang_int_20="Tato položka je pomocná pro online verzi a není explicitně zobrazena ani v tištěné ani online verzi. Zde zapisujeme heslová slova, která se vyskytují v příkladu. Jakmile zapíšeme tyto heslová slova, příklad se objeví také u těchto slov (v online verzi). 
Příklad je tímto způsobem využit vícenásobně ve slovníku a rozšiřuje zásobu příkladů pro heslová slova.
<br><br>
Podívejte se na následující příklad:
<div id=\"help_image\"><img src=\"/images/help/headword_example_reykjarlykt.png\">
</div>
Všechna heslová slova (\"finna\", \"nokkur\", \"reykjarlykt\") jsou vložena v základním tvaru a jsou obklopena čárkou \",\". Tyto slova nejsou homonyma (mají číslo heslového slova nula a proto jsou uvedena bez čísla heslového slova.<br>
Pokud je heslové slovo homonymem, pak zapisujeme podle příkladu:
<div id=\"help_image\"><img src=\"/images/help/headword_example_aldrei.png\">
</div>
V tomto případě \"koma\" má číslo heslového slova 2. Jedná se o stejný zápis jako u synonym, antonym, odkazu i varianty heslového slova.
Zapisujte i slova, která ve slovníku neexistují. Nezapisujte osobní zájmen jako například \"hana\", \"hann\" atd., jejichž příkladů by bylo obrovské množství, přičemž by příklady ničemu navíc nesloužily.
<br><br>
Heslová slova v příkladech se nezobrazují ani v tištěné ani v online verzi pro veřejnost. Zobrazují se pouze v náhledu heslového slova pro lexikografy s hypertextovými odkazy na heslová slova z příkladu. <br>
Hypertextový odkaz zároveň ukazuje, zda heslové slovo existuje ve slovníku. Odkaz není vytvořen, pokud je zápis proveden špatně nebo slovo neexistuje ve slovníku.";

$lang_int_21_title= "Poznámky k významu heslového slova";
$lang_int_21= "Zde můžete zanechat poznámky týkající se výhradně významu heslového slova. Poznámky se nezobrazují ani v tištěné ani v online verzi.";

$lang_int_22_title="Odkaz na heslové slovo";
$lang_int_22="Odkazem rozumíme, že význam heslového slova odkazuje na jiné heslové slovo ve slovníku. V online verzi je odkaz realizován hypertextovým
odkazem. V tištěné verzi je naznačena šipka. <br><br>
As a link you can enter only a headword that is already in the dictionary, because you want to established a hyperlink to the headword 
<br>You will write down the headword and if the number of link's headword is different from 0 (zero) you will write down also the number of link's headword in the brackets directly after the link. 
<br>
Podívejte se na příklad:
<div id=\"help_image\"><img src=\"/images/help/link_beyki2.png\">
</div>
Náhled slova v online verzi:
<div id=\"help_image\"><img src=\"/images/help/link_beyki.png\">
</div>
Zápis odkazů je obdobný zápisu synonym - tedy heslová slova s číslem heslové slova nula zapisujeme bez čísla a heslová slova s číslem heslového
slova větším jako nula, zapisujeme následovně: ,á(1), ,á(2), k odlišení homonym.

<br><br>
Používejte odkaz tehdy, když  1) význam nebo slovo je stejný jako jiný význam nebo slovo ve slovníku <br>
<div id=\"help_image\"><img src=\"/images/help/link_usage1.png\">
</div>
2) chcete vyjádřit, že informace se nachází na jiném místě ve slovníku.
<div id=\"help_image\"><img src=\"/images/help/link_usage2.png\">
</div>
Důvodem je v tištěné verzi úspora místa a neopakování se informací.";

$lang_int_23_title="Pořadí významu heslového slova";
$lang_int_23="Pořadí je možno měnit manuálně zadáním číslice nebo použitím funkce menu/třídění/změnit pořadí významů.
<br><br>
Pořadí významů ve slově seřaďte podle ukazatelů, druhotných ukazatelů, slovních spojení.
<div id=\"help_image\"><img src=\"/images/help/order_leggja.png\">
</div>";

$lang_int_24_title="Oborová charakteristika";
$lang_int_24="Použijte zkratky pro oborovou charakteristiku k vymezení významu. Pro snadnější zápis vyskočí nabídka, z níž je možné vybrat. Úplný seznam
zkratek pro oborovou charakteristiku naleznete v menu/informace/zkratky podle použití.

<div id=\"help_image\"><img src=\"/images/help/A_popup_field.png\">
</div>

<br>
Seznam zkratek oborových charakteristik:
 <br>
1. arch. => Architektura <br>
2. astro. => Výzkum vesmíru, astronomie<br>
3. biol. => Biologie<br>
4. bot. => Botanika<br>
5. chem. => Chemie<br>
6. cykl. => Cyklistika, jízdní kolo<br>
7. ekon. => Ekonomika, obchodi<br>
8. elek. => Elektrina<br>
9. filos. => Filosofie, logika<br>
10. fyz. => Fyzika<br>
11. geog. => Geografie, zeměpis<br>
12. geol. => Geologiei<br>
13. hist. => Historie<br>
14. hud. => Hudba<br>
15. jaz. => Jazykověda, gramatika, lingvistika<br>
16. let. => Letectví<br>
17. lit. => Literatura, vydavatelství<br>
18. mat. => Matematika<br>
19. med. => Hygiena, anatomie, lékařství, medicína<br>
20. meteo. => Meteorologie<br>
21. náb. => Náboženství, církevi<br>
22. nám. => Námořnictví, rybolov<br>
23. poč. => Počítače, informatika<br>
24. pol. => Politika, politologie<br>
25. pov. => Lidové víra, lidové pověsti<br>
26. práv. => Právo, soudnictví<br>
27. prům. => Průmysl<br>
28. psych. => Psychologie<br>
29. škol. => Školství<br>
30. sport. => Sport<br>
31. stav. => Stavebnictví<br>
32. techn. => Technika, mechanika<br>
33. voj. => Vojenství<br>
34. zem. => Zemědělství<br>
35. zool. => Zoologie<br>";


$lang_int_25_title="Stylová charakteristika";
$lang_int_25="Použijte zkratky pro stylovou charakteristiku významu. Pro snadnější zápis vyskočí nabídka, z níž je možné vybrat. Úplný seznam
zkratek pro oborovou charakteristiku naleznete v menu/informace/zkratky podle použití.
<div id=\"help_image\"><img src=\"/images/help/A_popup_usage.png\">
</div>

<br><br>
Úplný seznam zkratek stolových charatkeristik:
 <br>
1. básn. => básnický, poetický výraz<br>
2. dět. => dětsky <br>
3. form. => Formálně <br>
4. han. => Hanlivě<br>
5. hovor. => Hovorově <br>
6. hrub. => Hrubě <br>
7. neform. => Neformálně <br>
8. přen. => Přeneseně <br>
9. říd. => řídce<br>
10. slang. => Slang <br>
11. zast. => Zastarale <br>
12. zdrob. => Zdrobněle  <br>";

$lang_int_26_title="Latinské názvy";
$lang_int_26="U botanických a zoologických názvů pište latinské názvy. Vždy s velkým písmenem na začátku - na příklad. \"Cetacea\". 
<br><br>
Latinské názvy plní také významnou roli při automatickém výběru z fotografií z Biolibu.";

$lang_int_27_title="Antonyma";
$lang_int_27="Uveďte antonyma pro jednotlivý význam heslového slova. Správný zápis antonym je nezbytný pro správné vytvoření hypertextového odkazu v online verzi.
Forma zápisu (stejná jako u synonym): Pokud je slovo homonymem (číslo heslového slova je větší než nula), zapisujeme následovně:
<br>
koma(2)<br>
<br>
zápis odpovídá heslovému slovu koma s číslem heslového slova 2. Tento zápis odpovídá v tištěné podobě a náhledu <sup>2</sup>koma<br>
<br>
Pokud je číslo heslového slova (např. albatros) 0 (nula), pak zapisujeme jednoduše jako
<br>
albatros<br>
<br>
V tištěné i v online verzi se před antonym objeví automaticky \"x\" k vyjádření toho, že se jedná o antonymum.<br>
<br>
Zapisujte antonyma pouze v případě, že se jedná o rovnocennné antonymum, například  \"studený\" a \"teplý\"";

$lang_int_28_title="Kategorie použití";
$lang_int_28="Tato položka se zobrazuje nepřímo pouze v online verzi. Smyslem je zařazení významu heslového slova do určité kategorie (významové skupiny) a 
následně zobrazení dalších částí této kategorie, rovněž tak zobrazení částí kategorie u názvu kategorie. Podívejte se na následující příklad.
Název kategorie je \"barva\". Části kategorie jsou \"modrá\", \"žlutá\" apod. <br>
U heslového slova \"barva\" se následně zobrazí seznam jeho částí s hypertextovým odkazem na jednotlivá heslová slova a u částí (jednotlivých barev v tomto případě)
se zobrazí další části s hypertextovým odkazem. <br><br>

Upozornění: Zkontrolujte vždy seznam kategorií použití v menu/administrace/kategorie použití. Pokud kategorie neexistuje, vytvořte ji.
";

$lang_int_29a_title="Fráze";
$lang_int_29a="Do této položky zapisujte slovní spojení v obecném tvaru s předložkou podle příkladu \"leggja + til\" nebo \"koma + fyrir\" za použitím značky \"+\". Fráze sdružuje více slovních spojení nebo slov v heslovém slově do určitých skupin a usnadňuje orientaci uživatele v textu. <br>
Tato položka je určena především pro slovesa, která obsahují několik desítek významů a slovních spojení (např. \"leggja\", \"koma\" atd.)
<br> <br>
Podívejte se na následující příklad:
V heslovém slově læra máme slovní spojení læra af e-m. Do položky fráze zapíšeme læra + af. Dále zapíšeme lærast u slova lærast.<br> <br>
V online verzi se automaticky vytváří boční menu pro snadnou orientaci v heslovém slovu. (Pouze pokud je alespoň jedna položka fráze plná).
";

$lang_int_29b_title="Pořadí fráze";
$lang_int_29b="Do položky pořadí fráze zapisujeme číslo v takovém pořadí, v jakém chceme, aby se položka fráze zobrazovala ve slovníku.<br>
Pořadí by mělo respektovat abecední řazení podle předložek, dále slovní spojení, které nelze zařadit a nakonec přísloví nebo rčení.";

$lang_int_30_title="Etymologie";
$lang_int_30="Do této položky zapisujte etymologii heslového slova.";

$lang_int_index1="Heslové slovo";
$lang_int_index2="Význam";
?>
