<?php

$lang_manual_header="Přírůčka pro uživatele aplikace Dictionary System";
$lang_manual_1_title="<span class=\"guide_title\"><a name=\"1_guide\"></a><a href=\"#top\">1. Všeobecné informace</a></span><br>";

$lang_manual_1_1= "
<h4>1.1 Úvodní informace</h4>


<a name=\"1.1.1.\"><strong>1.1.1. Aplikace Dictionary System</strong></a><br>

Aplikace Dictionary System nabízí uzavřené pracovní prostředí pro tvorbu jednosměrných dvojjazyčných slovníků a otevřené webové stránky, které umožňují
vyhledávat ve slovníku široké veřejnosti. Je to webová aplikace běžící v jakémkoliv webovém prohlížeči. 
Aplikace podporuje tvorbu slovníku po celé šíři - přidávání slov, úprava slov, kontrola, publikování. Finálním
výstupem aplikace je hotový slovník ve formátu LaTex, dále ve formátu pro program StarDict a otevřená online verze. 
Aplikace podporuje týmovou spolupráci lexikografů systémem
monitorování činnosti, koordinování cílů, ukládáním verzí heslových slov aj.<br>
<br>
Aplikace obsahuje rozšíření pro islandštinu. Toto islandské rozšíření obsahuje seznam heslových slov (22 000), zápis výslovnosti v IPA, namluvenou výslovnost rodilým mluvčím
Jónem Gíslasonem), pravidla islandské výslovnosti, dělení složených slov. U podstatných a přídavných jmen a u zájmen se nachází skloňování heslového slova. U sloves se nachází časování slova.
U přísloví se nachází stupňování. Navíc toto rozšíření obsahuje skripty pro generování skloňování a časování nových heslových slov. U každého heslového slova je uvedena slovní třída. 
Kromě toho jsou uvedeny morfologické údaje o koncovkách podstatných jmen a sloves, stejně tak jako syntaktické údaje u sloves.
V rozšíření se dále vyskytuje kolem 10 000 synonym a antonym, kolem 8300 příkladů užití heslových slov. 



<br>
<a name=\"1.1.2.\"><strong>1.1.2. Překlady aplikace</strong></a><br>
Aplikace existuje v české a anglické verzi. Překlady aplikace do dalších jazyků jsou plně podporovány. 
<br>
<a name=\"1.1.3.\"><strong>1.1.3. Úrovně aplikace</strong></a><br>
Aplikace má tři úrovně - správce, lexikograf, neregistrovaný uživatel a jednotlivé skupiny mají každá svá práva.";


$lang_manual_1_2= "<h4>1.2 Požadavky</h4>

<a name=\"1.2.1.\"><strong>1.2.1. Požadavky na instalaci a běh aplikace</strong></a><br>

Aplikace Dictionary System je webová aplikace. Ke spuštění potřebuje webový prohlížeč. 
Další požadavky na systém: <br>
<br>
1. přístup k MySQL serveru - 1 MySQL databáze<br>
2. volné místo na webovém serveru - 20 MB (v případě aplikace s islandským rozšířením cca 1.5 GB)<br>
<br>
Nepovinné: <br>
1. Mailový server <br>
2. přístup ke Cron pro automatické zálohování databáze  <br>
3. přístup k phpMyAdmin - ruční zálohování databáze a navíc přístup k údajům, které nejsou dostupné z aplikace <br>
<br>
K převodu výstupního souboru z formátu pro LaTex do PDF je zapotřebí nainstalovat LaTexovém prostředí a soubor převést. LaTex je
volně dostupný ke stažení na Internetu. <br>
<a name=\"1.2.2.\"><strong>1.2.2. Požadavky pro práci s aplikací</strong></a><br>
Pro práci s aplikací je potřeba jakýkoliv webový prohlížeč.";


$lang_manual_1_3= "<h4> 1.3 Licence</h4>
Aplikace Dictionary System je publikována pod Obecnou veřejnou licencí GNU v.3 (GNU General Public Licence v.3).";


$lang_manual_2_title= "<span class=\"guide_title\"><a name=\"2_guide\"></a><a href=\"#top\">2. Slovní druhy</a></span>";
$lang_manual_2_1= "<h4> 2.1 Headword</h4>
According to Wikipedia \"A headword, head word, lemma, or sometimes catchword is the word under which a set of related dictionary or encyclopaedia entries appears. 
The headword is used to locate the entry, and dictates its alphabetical position. Depending on the size and nature of the dictionary or encyclopedia, the entry may include alternative meanings of the word, its etymology and pronunciation, 
compound words or phrases that contain the headword, and encyclopedic information about the concepts represented by the word\"<br>





Headword in terms of the application Dictionary System is headword with the unique number that identifies it.

<div id=\"help_image\">
<img src=\"/help/images/help_num_keyword.png\">
</div>

The example shows two headword with different number that represents two homographs or homonyms. <br>



In case there are no homonyms, the headword is always with 0 number and appears in the dictionary as follows:
<div id=\"help_image\"><img src=\"/help/images/help_keyword_hestur.png\">
</div>
As you can notice there is no 0 (zero) in front of the headword as in the preceding example. Number of the headword 
appears only when is different from 0 (zero). Please study carefully the guide how to enter number of headword in <a href=\"./index_A_16_synonym.php\">synonyms (A.16.)</a>, <a href=\"./index_A_27_antonym.php\">antonyms (A.27.)</a>,
<a href=\"./index_A_20_headwords_in_example.php\">headword in examples (A.20.)</a> and <a href=\"./index_A_22_links.php\">links (A.22.)</a> fields of the Edit page.";


$lang_manual_2_2= "<h4> 2.2 Headword preview</h4>

Headword appears in the Search page in similar way as it would appear in the printed dictionary. Under the headword and its senses appear 4 functions that enhance the information about headword, namely 1) headwords in example 2) synonyms and antonyms 3) declension or conjugation tables 4) pronunciation.
<br>
Let us have a look at example of headword \"finna\" in preview on Search page. All headword information can be found in next three pictures. We will discuss each headword functions more closely in this chapter.
<div id=\"help_image\">
<img src=\"/help/images/search_page_finna1.png\">
</div>

<div id=\"help_image\">
<img src=\"/help/images/search_page_finna2.png\">
</div>

<div id=\"help_image\">
<img src=\"/help/images/search_page_finna3.png\">
</div>";


$lang_manual_2_3= "<h4> 2.3 Headword and stem</h4>
Headword appears in preview and in printed dictionary with special symbols \"/\", \"·\" that devide the headword into morphological units. We will call this form of headword record \"Stem\".  On the other hand the headword record (the headword without special symbols) is used for searching in the database. 

<div id=\"help_image\"><img src=\"/help/images/help_stem.png\">
</div>

<div id=\"help_image\"><img src=\"/help/images/stem_bokaforlag.png\">
</div>
Please study carefully
<a href=\"./help.php?num_name=A&num_title=1&num_subtitle=5\">The Guide How to Enter a  Correct Information - Stem (A.1.5.)</a>"; 


$lang_manual_2_4= "<h4> 2.4 Headword and senses</h4>

<a name=\"exact\"><strong>2.2.1. Headword</strong></a><br>
Headword is identified with its headword and number of headword as we said in part 2.1.
Headword can consist from one or more senses and must have at least one sense.<br>

Headword stores information about pronunciation, stem, alternative spelling, morphology. In other words, the information that are related to headword in general (not only to specific sense).




<a name=\"exact\"><strong>2.2.2. Senses</strong></a><br>
Senses of headword store information about translations, link to other headwords,
usage specification and field specification, antonyms, synonyms, examples and their translations, latin names, markers etc. 

<div id=\"help_image\"><img src=\"/help/images/search_page_finna_detail.png\">
</div>
This is an example of the headword \"finna\". The headword has 13 senses. The small numbers before each sense are shown only for help.";



$lang_manual_2_5= "<h4> 2.5 Headword in examples</h4>

Headwords in example is a function that search the headword in other headwords' example fields and displays the result. It is required a special form of record in field \"headwords in example\", that you can study in The Guide How to Enter a Correct Information - Headwords in example. 
The function enables to show more examples of usage of the headword. In front of each example stands a headword that includes the example. You can click on that headword to preview it.
In the example bellow we show the headword in example of headword \"finna\":
<div id=\"help_image\"><img src=\"/help/images/search_page_finna_headwords_example.png\">
</div>
User can switch this function on and off by clicking on small arrow.";

$lang_manual_2_6= "<h4> 2.6 Headword and synonyms/ antonyms</h4>

Function Synonyms and antonyms searches in other headword's synonym and antonym fields and displays the result.<br>
The result can display in two ways:<br>
1) it shows new headword that has in synonym field the headword plus a direct translation of the sense in a new headword<br>
2) it shows new headword that has in synonym field the headword plus a word information with direct translation of the sense in a new headword<br>
Let us study example bellow of the headword \"finna\":

<div id=\"help_image\"><img src=\"/help/images/search_page_finna_synonyms.png\">
</div>
First result shows headword \"hafa\" which one of its senses is specified with word phrase (in word field) \"hafa uppi á\" and the word phrase has for synonym headword \"finna\" (2) and the directl translation is displayed.<br>
Third result shows headword \"rata\" which one of its senses has for synonym headword \"finna\" (1) and the direct translation is displayed.<br>
<br>
Using this function we can find more relations between headwords. The function can be switch on and off by clicking on small arrow.";


$lang_manual_2_7= "<h4> 2.7 Declension</h4>

Function Declension and conjugation tables shows the declension of nouns, adjectives, pronouns and numerals and conjugation of verbs. The tables are created by user itself using scripts to generate the tables, but the correction/ checking is necessary. The tables will not appear in the printed dictionary, because it would take too many space. 
<div id=\"help_image\"><img src=\"/help/images/help_declention_hestur.png\">
</div>
The function can be switch on and off by clicking on small arrow.";


$lang_manual_2_8= "<h4> 2.8 Pronunciation</h4>

Function Pronunciation generates a pronunciation of the headword. It requires correct form of record of the field Stem, becase it uses a root devision of the stem. It uses IPA symbols. 

<div id=\"help_image\"><img src=\"/help/images/search_page_pronunciation.png\">
</div>
The function can be switch on and off by clicking on a small arrow.";

$lang_manual_3_title= "<span class=\"guide_title\"><a name=\"2_guide\"></a><a href=\"#top\">2. Slovní druhy</a></span>";

$lang_manual_3_1= "<h4> 3.1 Search</h4>

You visit the Search page by clicking on Search button:
<div id=\"help_image\"><img src=\"/help/images/help_search_button.png\">
</div>
Search functions is the basic and most used function. You will use it to find the headword. When you find the headword, you can edit headword information , delete the meaning(s), delete the headword etc.
Search function works on the same princip and in other internet searching. You enter the string to the search field and press Enter or button Submit. 

<div id=\"help_image\"><img src=\"/help/images/help_search_field.png\">
</div>

When there is only one result of the search, appears directly headword in search preview. When there are more results, appears list of headwords with hyperlinks to see each
headword. Headword in the list appears with grammatical information (word class, endings), so that it is clear what headword it is. Please study example bellow:
<div id=\"help_image\"><img src=\"/help/images/help_search_list.png\">
</div>

From the example above, we got 87 headwords found while searching string \"fe\". Only first 15 results appears. 
To see next 15 results you use navigation arrows.";


$lang_manual_3_2= "<h4> 3.2 Search options</h4>

You can search the dictionary using various search options, namely 1) exact match, 2) begins with, 3) contains, 4) ends with. Let us talk about each specifications and what kind of advantages it can bring to you while searching dictionary<br>



<a name=\"exact\"><strong>3.2.1. Exact match</strong></a><br>
While using exact match search, you already have to know exact headword spelling. It is the quickest way of finding way with the advantage that
you view the headword directly. Let us type headword \"hestur\" and see the example below.

<div id=\"help_image\"><img src=\"/help/images/help_search_exact.png\">
</div>




<a name=\"begins\"><strong>3.2.2. Begins with</strong></a><br>
Option \"begins with\" is default search option. It means it appears in the search box when you open the Search page.
This option is probably the most usefull option for finding the headwords that you are unsure of exact spelling and also for list of headwords 
that you will use to correct dictionary entries. The most usefull advantage of headword lists is that you can return to your list
after editing headword or visiting another page. <br>
Let us type string \"a\" and see the example below:

<div id=\"help_image\"><img src=\"/help/images/help_search_begins_with.png\">
</div>
Option Begins with find all strings that begins with searched string. In the example above it was string \"a\"
To see each headword, you click on headword hyperlink.

<div id=\"help_image\"><img src=\"/help/images/help_search_hyperlink.png\">
</div>

To return to result list, you click on hyperlink Back to the result list. The values in the bracket shows the search string and all search optins.

<div id=\"help_image\"><img src=\"/help/images/help_search_return.png\">
</div>




<a name=\"contains\"><strong>3.2.3. Contains</strong></a><br>
While searching with option contains, it will find all word that contains the string. Let us study example bellow. 
<div id=\"help_image\"><img src=\"/help/images/help_search_contains.png\">
</div>
The string that we were searching was string \"hestur\". As you can see from the result list, search function find all the headwords that
contains the string \"hestur\". This option can be usefull to find compound headwords, prefix.




<a name=\"ends\"><strong>3.2.4. Ends with</strong></a><br>
Option Ends with finds all the headword that ends with the searched string. As an example we will find all words that ends with string \"mál\".
<div id=\"help_image\"><img src=\"/help/images/help_search_ends_with.png\">
</div>
This option can be usefull to find compound headwords and suffix.";


$lang_manual_3_3= "<h4> 3.3 Advanced search</h4>

In advanced search we are searching not for headwords but other information. We can search in many fields like pronunciation, translation etc. We can say
that we can search in all fields except headword field. In advanced search you can use also all 4 search options to get the best result. 
<div id=\"help_image\"><img src=\"/help/images/help_search_adv_button.png\">
</div>
You start advanced search by pressing the Advanced search check box. 
<div id=\"help_image\"><img src=\"/help/images/help_search_adv_open.png\">
</div>
After checking this check box appears a new options list that contains other dictionary fields than headword.
<br>
Advanced search can be used in many ways. Let us show few examples that will illustrate the possibilities
of advanced search. 




<a name=\"exact\"><strong>3.2.1. Search in translation</strong></a><br>
Field translation is default search field when you first open Advanced search. You will probably use it most often, to find the headword you cannot remind,
and also to find out wheather the search string is already used in the dictionary. Let us study example bellow:

<div id=\"help_image\"><img src=\"/help/images/help_search_translation.png\">
</div>
We have search string \"pěkný\" (nice in Czech) and got this result list. As you can see from the example above, when there are more results, another headword list appears.
Notice that this time contains headword list also the field and the string (in color) to show the appearance of the string in the search field.




<a name=\"begins\"><strong>3.2.2. Advanced search tip</strong></a><br>
You can use advanced search and search in Grammar 1 Word group to find for example all occurances of word group Adjectives and 
then correct or edit these headwords. See the example bellow:

<div id=\"help_image\"><img src=\"/help/images/help_search_advanced_tip.png\">
</div>
The list of headwords contains all headwords that has v (shortcut for verb) in the Grammar 1 Word group field. Now you can observe
headwords and then return to the result list.
<br>
Another example to illustrate usage of Advanced field:
<div id=\"help_image\"><img src=\"/help/images/help_search_advanced_tip2.png\">
</div>
We have search for the string \"(-s)\" in field Grammar - endings. The result list contains all headwords that has
this endings. ";


$lang_manual_3_4= "<h4> 3.4 Result list</h4>

<a name=\"exact\"><strong>3.3.1. Result list in general</strong></a><br>
After searching for various headwords you would appreciate a function, 
that enables you to return to your preceding searched results. This functions calles
Result list and it is a list of strings that have been previously searched. The Result list
is placed on the right side of the Search page. 

<div id=\"help_image\"><img src=\"/help/images/help_result_list_place.png\">
</div>
And when we look more closely, Result list looks like this example:
<div id=\"help_image\"><img src=\"/help/images/help_result_list_detail.png\">
</div>
By clicking on the hyperlink, you returned to your previous search result. But it is not all. Result list remembers
on which page you are currently in. Let us say for example, that you have search for two string \"la\". String \"la\" returned 184 results,
that means in pagination 13 pages. You edit headwords of your will in the first page and continue to the second page. When you click later on hyperlink
in the result list, you will return to the second page of Result list for string \"la\".
<br>
Consider carefully the advantage of the Result list and its possibilities that can support your work.




<a name=\"exact\"><strong>3.3.2. Functions in Result list</strong></a><br>
There are two functions in the Result list. 1) Delete 2) Sort <br>
1) By pressing Delete, all previous searched strings will be deleted from the Result list. Function can be usefull when you no longer work with the strings that
you have search. 
<div id=\"help_image\"><img src=\"/help/images/help_result_list_del.png\">
</div>
2) By pressing Sort, searched string will be order alphabetically. 
<div id=\"help_image\"><img src=\"/help/images/help_result_list_sort.png\">
</div>";

$lang_manual_4_title= "<span class=\"guide_title\"><a name=\"2_guide\"></a><a href=\"#top\">2. Slovní druhy</a></span>";
$lang_manual_4_1= "<h4> 4.1 Edit in general</h4>
<a name=\"exact\"><strong>4.1.1. Editing in short words</strong></a><br>
Edit a headword means to change information in headword entry. The information that we entered in one of the many fields in the Edit page,
has to be sumbitted by Sumbit button or pressing Enter. When the new information is sumbitted, it appears in the preview of the headword just under the headword fields' table
You should finish all your work on headword by pressing button <a href=\"./help.php?num_name=1&num_title=4&num_subtitle=3\">Save to history(Toc 4.3.)</a>. Let us explain it in following chapters.



<a name=\"exact\"><strong>4.1.2. How can I visit Edit page? Where can I find Edit page?</strong></a><br>
There is no direct link to enter Edit page. You can access it by clicking on headword from <a href=\"./help.php?num_name=1&num_title=3\">Search page (Toc 3.)</a>. 
You need first to find the headword. 
<div id=\"help_image\"><img src=\"/help/images/help_search_hyperlink2.png\">
</div>



<a name=\"exact\"><strong>4.1.3. Edit page appearance</strong></a><br>
Here is an example how Edit page looks:
<div id=\"help_image\"><img src=\"/help/images/help_edit_general.png\">
</div>
Edit page is consisted from many fields. Not all fields has to be filled. You can read more about <a href=\"./index_help.php\">which fields need to be filled in this guide.</a>
Each field requires different information and also there are many rules that applies to all users how to enter information in each specific field.
It means that there are predefined set of rules that help to unify information in the dictionary.
<br>
Read carefully <a href=\"./index_help.php\">The Icelandic-czech students' dictionary Rules (Toc 12.)</a>
<br>





<a name=\"exact\"><strong>4.1.4. How can I navigate between meanings? How can I get from first meaning to second?</strong></a><br>
You navigate between meanings by pressing hyperlink on the meaning you would like to edit.
The headword and meanings with hyperlinks are placed in the preview of the headword just under the edit fields.

<div id=\"help_image\"><img src=\"/help/images/help_navigate_meaning.png\">


</div>
Notice that similar navigation is used on Search page in headword view.




<a name=\"exact\"><strong>4.1.5. Edit page buttons</strong></a><br>
Here is a list of buttons that appear in Edit page and short summory of their function, usually with link to more detailed explanation of their function.
<br>
Buttons: 1) History, 2) Add new meaning, 3) Create topic, 4) Save to history, 5) Submit button, 6) Link to dictionaries, 7) Delete meaning, 8) Delete headword
<br>
Now we can have a look at each of them:<br>

1) History - this function opens History of the headword. There are stored all changes that have been made. See History (Toc 6.2)
<div id=\"help_image\"><img src=\"/help/images/help_edit_button_history.png\">
</div>
2) Add new meaning - this function adds new meaning to currant headword. See Adding new meaning (Toc 6.2)
<div id=\"help_image\"><img src=\"/help/images/help_edit_button_add.png\">
</div>
3) Create Topic - this function prepares to add a new topic in Forum. See Adding topic in Forum chapter (Toc 6.2)
<div id=\"help_image\"><img src=\"/help/images/help_edit_button_begin_topic.png\">
</div>
4) Save to history - this function save changes to History and continues to Search page to view the headword. You should finish all your work on headword by pressing this button.
<div id=\"help_image\"><img src=\"/help/images/help_edit_button_save_to_history.png\">
</div>
5) Submit button - you can use this button or press Enter to submit changes. After pressing button, you will remain in Edit page and continue editing headword.
Changes will be seen both in edit fields and in preview under the edit fields.
<div id=\"help_image\"><img src=\"/help/images/help_edit_button_submit.png\">
</div>
6) Link to dictionaries - these buttons opens a pop-up window with various dictionaries, for example snara.is, BÍN etc.
<div id=\"help_image\"><img src=\"/help/images/help_edit_button_snara.png\">
</div>

7) Delete meaning - this small button deletes a meaning that is on the same line. The delete action is with no warnings and you cannot return the changes. 
See Delete meaning (Toc 14.5)
<div id=\"help_image\"><img src=\"/help/images/help_edit_button_delete_one.png\">
</div>

8) Delete headword - this function deletes the whole headword with its declination information, status information. After clicking on this button,
you will be asked to confirm the deletion. Changes cannot be turned back. See details in Delete headword (Toc 14.9)
<div id=\"help_image\"><img src=\"/help/images/help_edit_button_delete_all.png\">
</div>";

$lang_manual_4_2= "<h4> 4.2 Editing</h4>

<a name=\"exact\"><strong>4.1.1. Editing</strong></a><br>
You edit the headword on Edit page by typing new information into field. In some fields you have to enter all 
information, in other field you enter for example first letter and a list of possible options appears. 
See example bellow:
<div id=\"help_image\"><img src=\"/help/images/help_edit_field_normal.png\">
</div>
You can see that in Translation field you have to write down all information yourself.
<br>
<div id=\"help_image\"><img src=\"/help/images/help_edit_field_list.png\">
</div>
In this case, it appeared a pop-up list with eventual possible options. You choose the option by click on the word there.
<div id=\"help_image\"><img src=\"/help/images/help_edit_field_list_chosen.png\">
</div>
We have chosen Mat. and it will appear in the field. This functions helps to unify entering the information. 
<a href=\"./help_edit_list_popup.php\">Learn here which fields are with list pop-up</a>";


$lang_manual_4_3= "<h4> 4.3 Save to history</h4>

When you finished working on editing headword, you should now press button Save to history
<div id=\"help_image\"><img src=\"/help/images/help_edit_button_save_to_history.png\">
</div>
It means that all changes what have been made will be recorder into History and you will be able
to observe them. <br>
When you press button Save to history, you will be redirected to Search page to headword you have been edited.
 
<a href=\"./help_edit_list_popup.php\">Learn about History (Toc)</a>";


$lang_manual_4_4= "<h4> 4.4 Adding new meaning</h4>

You use Add new meaning button on Edit page.
<div id=\"help_image\"><img src=\"/help/images/help_add_new_meaning_button.png\">
</div>
When you press this button, the new meaning will be added and you can start directly to edit 
this meaning. New meaning is always added to the end of the headword. If you want to change the order of 
the meaning, for example to place it on the first place in the headword entry, use this <a href=\"./index_help.php\">instruction to learn how 
to order meanings in headword</a>
<br>

<div id=\"help_image\"><img src=\"/help/images/help_add_meaning_added.png\">
</div>
New meaning always includes string \"new\". This helps to find which meaning needs to edited.";

$lang_manual_4_5= "<h4> 4.5 Deleting meaning</h4>

<a name=\"exact\"><strong>4.5.1. Deleting one meaning from headword with many meanings</strong></a><br>
You use Edit page to delete meanings. You find delete buttons in the preview of the headword on Edit page under the edit fields.
Now you would like to delete one of the many meanings of headword \"finna\" for example
<div id=\"help_image\"><img src=\"/help/images/help_headword_edit_finna.png\">
</div>
You use this small red cross button to delete the chosen meaning
<div id=\"help_image\"><img src=\"/help/images/help_edit_button_delete_one.png\">
</div>
When you press button, you delete the meaning. The action cannot be taken back and is with no warning.



<a name=\"exact\"><strong>4.5.2. Deleting one meaning from headword with one meaning</strong></a><br>
Let us study example bellow, where is headword \"koffín\" with only one meaning

<div id=\"help_image\"><img src=\"/help/images/help_edit_delete_last_meaning.png\">
</div>
You can see that the delete button is different from previous one 
When there is only on meaning, the button is changed and this button deletes the whole headword.

<div id=\"help_image\"><img src=\"/help/images/help_edit_delete_headword_koffin.png\">
</div>
See next chapter about deleteting the headword. (Toc 4.6.)";

$lang_manual_4_6= "<h4> 4.6 Deleting headword</h4>

<a name=\"exact\"><strong>4.6.1. Preparation before deleting of headword</strong></a><br>
Before deleting a headword is recommended few steps that make the dictionary and database in general
consistant. First af all think twice before deleting. The change cannot be taken back and it would be a 
big loss in dictionary if you by bad luck delete important work. Consider also what other users in the dictionary would 
think and if they would agree. You can use forum to find the general consensus. <br>
When you are sure, that you want to delete the headword, begin with deleting declination tables. Follow this 
<a href=\"./index_help.php\">guide to delete declination tables</a> first.




<a name=\"exact\"><strong>4.6.2. Deleting headword</strong></a><br>
When there is only one meaning in the headword, appears Delete headword button in the preview of the headword on Edit page.
<div id=\"help_image\"><img src=\"/help/images/help_delete_all_koddaver.png\">
</div>
When you press this button you will be redirected on special page. See example of the page bellow 

<div id=\"help_image\"><img src=\"/help/images/help_delete_confirm_page.png\">
</div>
When you press \"Yes\", you confirm the deletion of headword. After confirming the change cannot be taken back.
When you press \"No\", you return to the Edit page.";

$lang_manual_5_title= "<span class=\"guide_title\"><a name=\"2_guide\"></a><a href=\"#top\">2. Slovní druhy</a></span>";
$lang_manual_5_1= "<h4> 5.1 Adding new headword</h4>

You use this button to add a new headword
<div id=\"help_image\"><img src=\"/help/images/help_add_headword_button.png\">
</div>
To add a headword, it's enough to fill in the headword field. Number of headword is set to default 0 value. Remember that all
headwords that have no homonyms in the dictionary should have 0 as number of headword. 

<br>
When you want to submit and add the headword press Submit button or press Enter.

<div id=\"help_image\"><img src=\"/help/images/help_add_submit.png\">
</div>";


$lang_manual_5_2= "<h4> 5.2 Tips for adding headword</h4>

<a name=\"exact\"><strong>5.2.1. I write headword, press Enter and nothing happends</strong></a><br>
There few functions that check whether you have written correct headword. If the headword or number of headword are
not correct, new headword won't be added. These functions protect other headword before damage.
First of all try to find out whether the headword doesn't already exist in  dictionary. 
When you enter homonyms, be sure that you don't enter the same number of headword.
Be sure, that you enter a number (not letter \"O\") in the number of headword.





<a name=\"exact\"><strong>5.2.2. Tips</strong></a><br>
You can fill only headword ( and leave 0 at field number of headword) and submit the headword.
Then appears a Search page with view of the headword. Then you can click on the headword and you can begin
to edit the headword.




<a name=\"exact\"><strong>5.2.3. When appears a possibility to add declinations?</strong></a><br>
Hyperlink to create by script declination's tables appear in the Search page in view of the headword.
It appears as soon as you enter the grammatical information in the field G(word group), after submiting the changes you
visit the Search page and you can see hyperlink to Create declinations.
<br>
<a href=\"help.php?num_name=1&num_title=7&num_subtitle=2\">Please read this guide to create a declination tables</a>

<div id=\"help_image\"><img src=\"/help/images/help_create_declination_hyperlink.png\">
</div>";


$lang_manual_6_title= "<span class=\"guide_title\"><a name=\"2_guide\"></a><a href=\"#top\">2. Slovní druhy</a></span>";
$lang_manual_6_1= "<h4> 6.1 Changing order of meanings</h4>

<a name=\"exact\"><strong>6.1.1. Where can I find this function?</strong></a><br>
You find this function on Search page on the right side. The button Change word order appears only when
some headword is chosen.
<div id=\"help_image\"><img src=\"/help/images/help_change_order_button.png\">
</div>
When you press this button, small up and down arrows appears beside the meanings. You can change the order of meanings
by click on the arrows. It is quite simple - but can be troublesome :). If you have problems, look at Reorder order of meanings bellow.<br>

<div id=\"help_image\"><img src=\"/help/images/help_order_arrows.png\">
</div>





<a name=\"exact\"><strong>6.1.2. I don't see any up and down arrows </strong></a><br>
When you don't see any arrow, it can mean that the headword has only one meaning. In this case it has no sense to show the arrows.
Remember that by pressing the Change word order you active and also deactive the function (the arrows).




<a name=\"reorder\"><strong>6.1.3. Reorder order of meanings</strong></a><br>
Sometimes the meanings cannot be moved. The function Reoder order of meaning unify the numbers in order field and makes homogenous row of numerals.
Use this function only once on headword with which you have troubles. This button appears when Change word order is activated.
<div id=\"help_image\"><img src=\"/help/images/help_reorder_button.png\">
</div>




<a name=\"exact\"><strong>6.1.4. Deactivate change order of meanings</strong></a><br>
To deactive this function, simply click again on Change word order button. The arrows will hide.";


$lang_manual_6_1= "<h4> 6.2 Changing number of headwords</h4>

<a name=\"exact\"><strong>6.2.1. Where can I change the number of headword?</strong></a><br>
You find this function on Search page on the right side. The button Change number of headword appears only when
some headword is chosen.
<div id=\"help_image\"><img src=\"/help/images/help_change_num_headword_button.png\">
</div>
When you press this button, you will be redirected to special page where you can choose new headword number.

<div id=\"help_image\"><img src=\"/help/images/help_change_num_headword_page.png\">
</div>





<a name=\"exact\"><strong>6.1.2. What does the numbers in bracket means?</strong></a><br>
Let us study preceding example of headword \"finna\". There are two hyperlinks. Number in brackets is 
the old number of headword, in this example 0. The numbers 1 and -1 are new number of headword.
You have to choose new number and click on hyperlink. 



<a name=\"reorder\"><strong>6.1.3. Homonyms </strong></a><br>
If there are homonyms in the dictionary, the change number of headword page will look like this:
<div id=\"help_image\"><img src=\"/help/images/help_change_num_headword_homonyms.png\">
</div>
You understand now what the numbers and hyperlinks mean. <br>
Let us study the third hyperlink of example with headword \"breyta\".<br>
In the third hyperlink we have breyta(1) tries to change to breyta(2) but that headword already exists. The fact is,
that in this case, the number will jump over existing number. So in that case will appear headword breyta (3) - headword with number of headword 3.




<a name=\"exact\"><strong>6.1.4 Dictionary and database consistency</strong></a><br>
When you change the number of headword, it will be automatically changed declination tables, headwords in example, synonyms, antonyms and links.
Let us study example bellow:
<div id=\"help_image\"><img src=\"/help/images/help_change_num_headword_info.png\">
</div>
The second meaning of headword \"hitta\" has synonym hæfa with number of headword 2. When we change hæfa(2) to hæfa(1) the synonym for the
second meaning of headword \"hitta\" will be also changed, etc.
<br>
Thus it is very important to learn exact way of entering headword and number of headword information into these fields.
<a href=\"./help.php?num_name=A&num_title=1&num_subtitle=2\">Please read carefully the guide to enter headword and number of headword information</a>";

$lang_manual_7_title= "<span class=\"guide_title\"><a name=\"2_guide\"></a><a href=\"#top\">2. Slovní druhy</a></span>";
$lang_manual_7_1= "<h4> 7.1 Declension</h4>

<a name=\"exact\"><strong>7.1.1. Functions of declension and conjugation in dictionary</strong></a><br>
There are two main functions that Declension and conjugation have in the dictionary.
First of all it help user to find the headword by typing on of the headword form. Secondly it shows
declension tables that can help user to learn and use the headword.




<a name=\"exact\"><strong>7.1.2. Where can I find declension tables?</strong></a><br>
You find the declension tables in Search page under the view of the headword, if some of headwords is chosen.




<a name=\"exact\"><strong>7.1.3. Can I hide declension tables when I don't use them?</strong></a><br>
Yes, you can hide declension tables by clicking on a small arrow (down). Study example bellow:

<div id=\"help_image\"><img src=\"/help/images/help_declination_hide.png\">
</div>

You can show declension tables again by clicking on a small arrow (up). See bellow:

<div id=\"help_image\"><img src=\"/help/images/help_declination_show.png\">
</div>




<a name=\"reorder\"><strong>7.1.4. How can I edit declension tables?</strong></a><br>
You start editing declension tables by clicking on a small hyperlink just above declension table:

<div id=\"help_image\"><img src=\"/help/images/help_declination_link_correct.png\">
</div>

Remember that there are two different ways of editing declension tables: <br>
1. Editing declension tables of nouns and pronouns and numeral<br>
2. Editing declension tables of adjectives and conjugation tables of verbs<br>
Read carefully how to edit declension tables. ";

$lang_manual_7_2= "<h4> 7.2 Create declension</h4>

<a name=\"exact\"><strong>7.2.1. When appears a possibility to add declension tables?</strong></a><br>
Hyperlink to create by script declension tables appear in the Search page in view of the headword.
It appears as soon as you enter the grammatical information in the field G(word group), after submiting the changes you
visit the Search page and you can see hyperlink to Create declinations.
<br>
<div id=\"help_image\"><img src=\"/help/images/help_create_declination_hyperlink.png\">
</div>





<a name=\"exact\"><strong>7.2.2. What information is necessary to create correct declension tables?</strong></a><br>
Each word group that can involve declension tables (nouns, adjectives, pronouns, numerals and verbs) has its own specification what 
information is necessary to create correct decl. table(s). Read carefully section that are related to <a href=\"./help.php?num_name=1&num_title=7&num_subtitle=3\">Nouns </a>, <a href=\"./help.php?num_name=1&num_title=7&num_subtitle=4\">Adjectives</a>, <a href=\"./help.php?num_name=1&num_title=7&num_subtitle=5\">Pronouns and numerals </a> and 
<a href=\"./help.php?num_name=1&num_title=7&num_subtitle=6\">Verbs </a> to learn about each specific group. 
<br>
Now we explain the matter on the word group Nouns. <br>

<strong> For nouns</strong> you need to enter grammatical information about word group and declension endings. Let us study example bellow: 
<br>
<div id=\"help_image\"><img src=\"/help/images/help_declination_explain.png\">
</div>
We created as an example headword \"hús\" and entered word group \"n\" and declension endings \"(-s, -)\". When we click now
on hyperlink Create declension, the correct declension tables will be created. 
<div id=\"help_image\"><img src=\"/help/images/help_declination_hus.png\">
</div>
Notice that Status of declension table says Unchecked. It means that decl. table was generated but not corrected or viewed by 
users. You have to click on hyperlink and check and submit the Correct status.




<a name=\"exact\"><strong>7.2.3. Can I delete declension tables?</strong></a><br>
Yes, you can delete decl. table(s) by clicking on hyperlink Delete declension. See the example bellow:

<br>
<div id=\"help_image\"><img src=\"/help/images/help_declination_link_delete.png\">
</div>
After click on hyperlink a new page appears with confirmation hyperlink. Just click on hyperlink to confirm the deletion of declension tables.";


$lang_manual_7_3= "<h4> 7.3 Nouns</h4>

<a name=\"7.3.1.\"><strong>7.3.1. Declension noun table</strong></a><br>
Declension table for nouns is only one table (compare to Adjectives, Verbs that have many tables). 
The process of creating noun declension tables is simply this - 1. creating by script generating 2. editing, checking, correcting 3. submit the changes 4. save changes -
new word forms are saved to word form database. <a href=\"./help.php?num_name=1&num_title=7&num_subtitle=7\">Learn about Word form database</a> later in Chapter 7.



<a name=\"7.3.2.\"><strong>7.3.2. Necessary information</strong></a><br>
You need to enter word group and endings. Please read <a href=\"./help.php?num_name=A&num_title=1&num_subtitle=7\">the guide how to enter Word class</a> and <a href=\"./help.php?num_name=A&num_title=1&num_subtitle=8\">the guide how to enter Grammatical endings</a> 
Then press Create declension patters. There appears newly created declension tables. <br>
It is necessary to press hyperlink Status - Unchecked and chech whether the declension table is correct. The reason for checking the status is that you
need to submit new word forms to Word form database.



<a name=\"7.3.3.\"><strong>7.3.3. Declination noun edit page </strong></a><br>
You have clicked on hyperlink Status (Unchecked). You visit the Declination noun edit page. The fields corresponds to word forms and you check, correct and then submit changes by pressing Enter or submit button.
<div id=\"help_image\"><img src=\"/help/images/help_declination_edit_noun.png\">
</div>
<br>
Let us now explain the buttons and their functions:
<div id=\"help_image\"><img src=\"/help/images/help_declination_bin_button.png\">
</div>
When you click on BIN button, it appears a pop-up window with BIN (Beygingarlýsing íslensks nútímamals) with the noun that are editing. You can directly check whether 
the declension table is correct.
<div id=\"help_image\"><img src=\"/help/images/help_declination_save_wordform_button.png\">
</div>
When you are sure, that declension table is correct, than press button Saving to Word form database. All unique word forms will be stored in <a href=\"./help.php?num_name=1&num_title=7&num_subtitle=7\">Word form database </a>."; 

$lang_manual_7_4= "<h4> 7.4 Adjectives</h4>

<a name=\"7.4.1.\"><strong>7.4.1. Declension adjectives tables</strong></a><br>
There are three declension tables for adjectives. 1. Positive, 2. Comparative, 3. Superlative. There is a special 
page called Adjective info page that decides which tables should adjective contain and which not. It means that adjective
can contain only positive declension table for example. Let explain it in details in following section Adjective info page. 
<br> Notice that there is no Noun info page.



<a name=\"7.4.2.\"><strong>7.4.2. Adjective info page</strong></a><br>
This is an example how Adjective info page looks like. Let us have a look at it:
<div id=\"help_image\"><img src=\"/help/images/help_declination_adj_info.png\">
</div>
There is an option to each of the adjective declension table. Options are 1. Not exist, 2. Unclear 3. Exists and there is 
hyperlink to edit the declension table. 
<br>
In this example with adjective \"fallegur\" we can see that all declension tables exist, because \"fallegur\" has positive, comparative and superlative forms.





<a name=\"7.4.3.\"><strong>7.4.3. General status of adjective declension</strong></a><br>
When all adjective decl. tables has its own status Corrected (Green ball), by pressing Submit button on Adjective info page, you changed General status 
of adjective declension to Corrected, saying that all declension tables and their existense are correct. 

<div id=\"help_image\"><img src=\"/help/images/help_declination_adj_gen_status.png\">
</div>




<a name=\"7.4.4.\"><strong>7.4.4. Editing positive, comparative, superlative declension tables</strong></a><br>
Editing of declension tables is similar to Noun declension edit page with the difference,
that when you edit changes, submit changes, you are redirected to Adjective info page (you don't directly save word forms to Word form database).
Let us study example bellow:
<div id=\"help_image\"><img src=\"/help/images/help_declination_adj_edit_save.png\">
</div>
We have edited positive of adjective \"fallegur\" and now we continue by pressing button Saving - adjective info page. 





<a name=\"7.4.5.\"><strong>7.4.5. Where can I start editing adjective declension tables?</strong></a><br>
You edit the decl tables by pressing Status hyperlink 1) in view of the headword on Search page
<div id=\"help_image\"><img src=\"/help/images/help_declination_adj_begin3.png\">
</div>
2) Edit hyperlink in Adjective info page
<div id=\"help_image\"><img src=\"/help/images/help_declination_adj_begin1.png\">
</div>
2) Status hyperlink in Adjective info page, under the declension table
<div id=\"help_image\"><img src=\"/help/images/help_declination_adj_begin2.png\">
</div>




<a name=\"7.4.5.\"><strong>7.4.6. Save adjective declension tables to Word form database</strong></a><br>
When I finished editing adjectives decl. tables, you have to press button Saving to Word form database.


<div id=\"help_image\"><img src=\"/help/images/help_declination_save_wordform_button.png\">
</div>

All unique word form will be saved to Word form database. ";

$lang_manual_7_5= "<h4> 7.5 Pronouns and numerals</h4>

<a name=\"7.5.1.\"><strong>7.5.1. Declension pronouns and numerals table</strong></a><br>
Declension table for pronouns and numerals is only one table (compare to Adjectives, Verbs that have many tables). 
The process of creating pronoun declension tables is the same as creating a noun decl. table and is simply this - 1. creating by script generating 2. editing, checking, correcting 3. submit the changes 4. save changes -
new word forms are saved to word form database. <a href=\"./help.php?num_name=1&num_title=7&num_subtitle=7\">Learn about Word form database (Toc 7.7.)</a>



<a name=\"7.5.2.\"><strong>7.5.2. Necessary information</strong></a><br>
There is only one condition - the word group field has to contain either \"pron\" or \"num\", it means the grammatical abbreviation for pronouns and numerals.





<a name=\"7.5.3.\"><strong>7.5.3. Declension pronoun edit page </strong></a><br>
Decl. pronoun edit page is competely the same as <a href=\"./help.php?num_name=1&num_title=7&num_subtitle=3\">Decl. noun edit page. (Toc 7.3.3.)</a>. Study the details there. 



<a name=\"7.5.4.\"><strong>7.5.4. Do I need to create declension table for all pronouns and numerals? </strong></a><br>
No. Create declension table only for pronouns and numerals that can be declined.";



$lang_manual_7_6= "<h4> 7.6 Verbs</h4>

<a name=\"7.6.1.\"><strong>7.6.1. Declension verbs tables</strong></a><br>
There are four declension tables for verbs. 1. Active voice, 2. Middle voice, 3. Imperative and past participle, 4. Past participle declension.
There is a special page called Verb info page that decides which tables should verb contain and which not. 
It means that verb can contain only some tables, not all af them. The princip is similar to Adjective info page.



<a name=\"7.6.2.\"><strong>7.6.2. Verb info page</strong></a><br>
This is an example how Verb info page looks like. Let us have a look at it:
<div id=\"help_image\"><img src=\"/help/images/help_declination_verb_info.png\">
</div>
There is an option to each of the verb declension table. Options are 1. Not exist, 2. Unclear 3. Exists and there is 
hyperlink to edit the declension table. 
<br>
In this example with verb \"breyta\" we can see that all declension tables exist, but not all of them have been checked.





<a name=\"7.6.3.\"><strong>7.6.3. General status of verb declension</strong></a><br>
When all adjective decl. tables has its own status Corrected (Green ball), by pressing Submit button on Adjective info page, you changed General status 
of adjective declension to Corrected, saying that all declension tables and their existense are correct. 

<div id=\"help_image\"><img src=\"/help/images/help_declination_verb_gen_status.png\">
</div>




<a name=\"7.6.4.\"><strong>7.6.4. Editing verb declension tables</strong></a><br>
Editing of declension tables is similar to Noun declension edit page with the difference,
that when you edit changes, submit changes, you are redirected to Verb info page (you don't directly save word forms to Word form database).
For example look at <a href=\"./help_7_declination_adjectives.php#7.4.4\">Editing adjective declension tables (Toc 7.4.4.)</a>. It is the same princip.




<a name=\"7.6.5.\"><strong>7.6.5. Where can I start editing verb declension tables?</strong></a><br>
You find the hyperlink exatly in same places as <a href=\"./help_7_declination_adjectives.php#7.4.5\">adjectives (Toc 7.4.5.)</a>




<a name=\"7.4.5.\"><strong>7.4.6. Save verb declension tables to Word form database</strong></a><br>
When you finished editing verb decl. tables, you have to press button Saving to Word form database.


<div id=\"help_image\"><img src=\"/help/images/help_declination_save_wordform_button.png\">
</div>

All unique word form will be saved to Word form database. ";

$lang_manual_7_7= "<h4> 7.7 Word form database</h4>

<a name=\"7.7.1.\"><strong>7.7.1. Unique word form explanation</strong></a><br>
In Word form database are stored unique word forms. Let us study example bellow of headword \"hús\":
<div id=\"help_image\"><img src=\"/help/images/help_declination_wordform_hus.png\">
</div>
Unique word forms of the headword \"hús\" are hús, húsið, húsin, húsi, húsinu, húsum, húsunum, húss, hússins, húsa, húsanna. It means that we choose only each
word form once to the Word form database. 



<a name=\"7.7.2.\"><strong>7.7.2. Usage</strong></a><br>
The Word form database serves user to find the headword in its word form that is different from the headword form.<br>
For example when you type word \"húsum\" in Search page you get as a result headword \"hús\".



<a name=\"7.7.3.\"><strong>7.7.3. Search engine's rules</strong></a><br>
Generally it implies these rules: <br>
Search engine first searches in headword database and if engine doesn't find any result, it searches in Word form database for word form of headword.
If it finds more unique word forms, it shows list of headwords with this unique word form. If it finds only one unique word form, it shows directly headword in
view of the headword in Search page. Let us explain details in next paragraph.



<a name=\"7.7.4.\"><strong>7.7.4. Various behaviour of showing result in search</strong></a><br>
Let us consider an example search. We are searching word \"húsa\". <br>
When you type word \"húsa\" with option \"begins with\" you get list of keywords show in picture bellow:
<div id=\"help_image\"><img src=\"/help/images/help_search_show_diff1.png\">
</div>
Consider that word \"húsa\" is also a unique word form of headword \"hús\". The search option \"begins with\" decides in this example what to show.
If we change this option to \"exact match\", we get direct view of headword \"hús\" because there is no headword \"húsa\" in the database. <br>
<div id=\"help_image\"><img src=\"/help/images/help_search_show_diff2.png\">
</div>



<a name=\"7.7.5.\"><strong>7.7.5. Headword form in Search page</strong></a><br>
Headword form list appears in Search page. It shows all headwords that contains in their declension or conjugation that word folm.
See example bellow with one result and more results
<div id=\"help_image\"><img src=\"/help/images/help_headword_form_1.png\">
</div>

<div id=\"help_image\"><img src=\"/help/images/help_headword_form_2.png\">
</div>
By clicking on hyperlink on the headword, you visit the Search page with view of the headword.";


$lang_manual_8_title= "<span class=\"guide_title\"><a name=\"2_guide\"></a><a href=\"#top\">2. Slovní druhy</a></span>";
$lang_manual_8_1= "<h4> 8.1 History </h4>


<a name=\"8.1.1.\"><strong>8.1.1. Corrections in the process of building a dictionary</strong></a><br>
In the process of building a dictionary it is necessary to correct and check all headwords many times. There is needed a system that inform
all users about Status of the headword, in other words what is correct and what is not. And how can many users say to each other that the
headword is complete, ready for example to be used in the printed version of the dictionary. We will use in this application two functions that
help in correcting headword. Let us discuss the matter in the following sections.



<a name=\"8.1.2.\"><strong>8.1.2. History of the headword</strong></a><br>
History of the headword is the first function. If you have read chapter 5., you are acquainted with the term History of the headword and
you already know that you save headword to History every time you finished working on the headword.
<br>
In history of headword you can find changes that have beed made in the headword. You can visit History by pressing History button on Search page or Edit page.
<div id=\"help_image\"><img src=\"/help/images/help_search_history.png\">
</div>
There is an example of History of the headword \"breyta\". 
<div id=\"help_image\"><img src=\"/help/images/help_history_show.png\">
</div>
The basic function of History is to see changes in headword.";

$lang_manual_9_title= "<span class=\"guide_title\"><a name=\"2_guide\"></a><a href=\"#top\">2. Slovní druhy</a></span>";
$lang_manual_9_1= "9. Communication
<h4> 9.1. Administrator messages</h4>

<h4> 9.3. Comments in Edit page</h4>

<a name=\"9.3.1.\"><strong>9.3.1. Comments on Edit page</strong></a><br>
Another important option for communications betweeet lexicographers are Comments on Edit page. Comments stored suggestions about improvement on headword,
small notes about uncertainity in translation etc. The more comments lexicographers leave, the better. There are two Comment fields on Edit page.
Let us have a look at both of them:
<div id=\"help_image\"><img src=\"/help/images/help_comments_headword_note.png\">
</div>
This is the general headword comment. There should be left notes about headword in general - frequecy, pronunciation, keyword variants, grammar etc.
<div id=\"help_image\"><img src=\"/help/images/help_comments_meaning_note.png\">
</div>
This is the comment regarding the meaning of the headword. Each meaning in the headword can be commented.



<a name=\"9.3.2.\"><strong>9.3.2.Can I see comments when I print the dictionary?</strong></a><br>
No. The comments won't be printed and can't be seen by visitors. They help lexicographers to leave notes about meanings and headwords.";



$lang_manual_9_2= "<h4> 9.4. General public messages</h4>

Administrator can leave messages and news for general public to inform them about the progress in building a dictionary.
These messages appear in form of a short news with date on the Login page. Everybody even the unregistered user can
see them. It can be usefull to inform the general public about the progress considering that to build a dictionary can take many years.

<div id=\"help_image\"><img src=\"/help/images/help_public_messages.png\">
</div>

Administrator finds a hyperlink to add a new general public message on Print page.

<div id=\"help_image\"><img src=\"/help/images/help_add_public_message.png\">
</div>
After clicking on hyperlink appears a page where can administrator write a message and press Submit button.
Notice: Only administrator can add general public messages. Lexicographers and visitors cannot add the message.";



$lang_manual_9_3= "<h4> 9.5. Tips and hints</h4>

As we already mentioned, the communication is essential to build the dictionary. There are many other ways on internet for
communication between users, like icq, msn, emails, skype or meeting and discussion the headwords, if for example two lexicographers live in the same
town or land.
That is why there is a strong recommendation to as many user information fields  as possible so that other can contact you. Learn how to <a href=\"./help_11_user_edit.php\">edit User information (Toc 11.2.)</a>

<div id=\"help_image\"><img src=\"/help/images/help_user_fields.png\">
</div>";


$lang_manual_10_title= "<span class=\"guide_title\"><a name=\"2_guide\"></a><a href=\"#top\">2. Slovní druhy</a></span>";

$lang_manual_10_1= "<h4> 10.1. 10. Tasks General information</h4>

<a name=\"10.1.1.\"><strong>10.1.1. Explanation of tasks' function</strong></a><br>
The word Task means according to Dictionary.com a definite piece of work assigned to, falling to, or expected of a person; duty.<br>
The function Task is meant to be a workaround place for placing tasks and infoming thus other lexicographers and administrator on which
task you as a lexicographer are now working on. You can write create your own task and signed for it, finish it and signed for another.
<div id=\"help_image\"><img src=\"/help/images/help_task_icon.png\">
</div>





<a name=\"10.1.2.\"><strong>10.1.2. Tasks' tables</strong></a><br>
On Task page there are three tables. 1. Unasigned tasks - tasks there wait to be signed. You sign for the task by clicking on
hyperlink Signed?. Notice that the task will now appear in Running tasks with your username and date of signing.

<div id=\"help_image\"><img src=\"/help/images/help_task_1.png\">
</div>

2. Running tasks - tasks there were signed by you or other lexicographer. When you finish your task, you can click on hyperlink next
to your task to confirm finishing the task. Notice that the task now appears in Finished tasks table.

<div id=\"help_image\"><img src=\"/help/images/help_task_2.png\">
</div>

3. Finished tasks - tasks that have been already finished. There are stored all finished tasks.
<div id=\"help_image\"><img src=\"/help/images/help_task_3.png\">
</div>";


$lang_manual_11_title= "<span class=\"guide_title\"><a name=\"2_guide\"></a><a href=\"#top\">2. Slovní druhy</a></span>";
$lang_manual_11_1= "11. Users


<h4> 11.1. Administrator</h4>

<a name=\"11.1.1.\"><strong>11.1.1. Administrator</strong></a><br>
Administrator of the project is a person who is responsible for a progress of building the dictionary.
It is usually one person, but can be more than one. 






<a name=\"11.1.2.\"><strong>11.1.2. Administrator rights and responsibilities</strong></a><br>
There is a list of administrator's rights and responsibilities
Administrator has direct access to web pages<br>
A. can change the web pages if needed<br>
A. has direct access to databases<br>
A. is responsible for backup of databases<br>
(only) A. knows the Project password.<br>
A. can invite new lexicographers to join the Project<br>
A. opens project to public <br>
A. is responsible for printing and publishing the dictionary <br>
A. can write General public messages<br>
A. can write Administrator messages<br>
A. has all rights and responsibilites of Lexicographer. It means that Administrator can be lexicographer as well. A. can take part in building the dictionary. See the next section <a href=\"./help_11_users_lexicographers.php\">Lexicographer (Toc 11.2.)</a><br>";



$lang_manual_11_2= "<h4> 11.2. Lexicographers</h4>

<a name=\"11.2.1.\"><strong>11.2.1. Lexicographer</strong></a><br>
Lexicographer writes the dictinary. He is invited into the Project by administrator. All information that he entered in registration process can
edit on User page. You can access User page by clicking on Users button in general Menu.
<div id=\"help_image\"><img src=\"/help/images/help_users_icon.png\">
</div>






<a name=\"11.2.2.\"><strong>11.2.2. List of Users</strong></a><br>
In User page there is a list of all Users. Administrator can see both Lexicographers and Visitors, lexicographer can see only Administrator and Lexicographer. Visitors
do not have access to list of Users.
See an example of list of Users:
<div id=\"help_image\"><img src=\"/help/images/help_users_list.png\">
</div>
By clicking on a username in the list of Users, you can see details of the User information:
<div id=\"help_image\"><img src=\"/help/images/help_users_detail.png\">
</div>
You can edit your own users information, not others by clicking on a hyperlink bellow the information table. There are general recommendation to enter as many contact information as possible. See <a href=\"./help_9_communication_tips.php\">Communication tips and hints (Toc 9.5.)</a>about this topic
<div id=\"help_image\"><img src=\"/help/images/help_users_edit_info.png\">
</div>




<a name=\"11.2.3.\"><strong>11.2.3. General summary (and not full) what functions can Lexicographer use in this application </strong></a><br>
You can find all the functions in detail while reading the whole Manual. <br>
Let us try to list all the functions for Lexicographer:<br>
on Search page ... search, search using options, advanced search in all dictionary fields, searching word forms, navigate in result list using pagination arrows, view headword on Search page, hide and show
headwords in examples, synonyms and declination views on Search page, using word form list on Search page, using Result list on Search page to return to previous searches, delete Result list, sort Result list,
activate and deactivate Users list, add headwords to Users list on Search page, print the Users list a)in browser b)in Latex, delete Users list, sort Users list, create or continue with topic related to headword in Forum,
see the History of headword on Search and Edit page, change the number of headword, activate and deactivate functions to change the order of meanings, change order of meanings on Search page with
up and down buttons, reorder order of meanings, active Status fields, change status of various Status fields, submit changes and take responsibility of correcting the headword,
directly entering Edit page clicking on meaning in view of the headword on Search page, jumping to Synonym, Antonym view using hyperlinks in view of headword, view of keywords in example and synonyms, antonyms,

<br>
on Edit page ... editing information by pressing Submit button or Enter, choosing from pop-up list in field and usage specification and in grammar word group, adding 
a new meaning, deleting a meaning, deleting headword
<br>
other pages ... adding headword, adding declension, correcting declension, choosing which tables to include in adjective declension and verb declension, submitting
status of declension, saving headword declension to word form database, deleting declension, adding topic to Forum, answering a topic, editing user information, seeing other users information,
reading Administrator messages, creating a task, signing for task, finishing a task, printing a letter in Latex, login, logout, registration,
reading Manual pages, downloading a Manual pages, using Stats page to observe own or other users activity in graph or in details, reading Source page,"; 


$lang_manual_11_2= "<h4> 11.3. Visitors</h4>

<a name=\"11.3.1.\"><strong>11.3.1. Visitors and general public</strong></a><br>
The dictionary in accordance with its licence is free to all general public. The general public can access
the dictionary when the Administrator opens the application for general public. All visitors that would like to use
the application and dictionary have to register. The registration for visitors is preventive order against misusage of
dictionary. The fact is, that the application has advanced searching functions that require huge computing database capacity.
The registration is of course free. 
<div id=\"help_image\"><img src=\"/help/images/help_registration_icon.png\">
</div>
";

$lang_manual_12_title= "<span class=\"guide_title\"><a name=\"2_guide\"></a><a href=\"#top\">2. Slovní druhy</a></span>";
$lang_manual_12_1= "12. Statistics
<h4> 12.1. General information</h4>

On Statistics page you can find general information about your dictionary. You visit Statistics by clicking on button Statistics in menu.
<div id=\"help_image\"><img src=\"/help/images/help_stats_icon.png\">
</div>

You can follow the progress in development of the dictionary. Administrator can add other informative numbers about the dictionary.
<div id=\"help_image\"><img src=\"/help/images/help_stats_info.png\">
</div>";



$lang_manual_12_2= "<h4> 12.2. Users' activity</h4>
You can observe your own or other user's activity. It can be usefull for administrator to track down some new user's activity and to check whether new lexicographer
understand well for example editing the headwords etc. All activity is tracked down. Namely - login, logout, editing, adding new headword, changing number of headword,
adding task, signing for task and finishing the task, deleting the headword. Here is an example of activity table:
<div id=\"help_image\"><img src=\"/help/images/help_stats_activity.png\">
</div>";



$lang_manual_12_3= "<h4> 12.3. Graph</h4>

You can also view your own or other user's graph that shows how many headwords you have edited in one month. The graph has 
motivating function and is not significant. You can observe also the graph for all the team.
<div id=\"help_image\"><img src=\"/help/images/help_stats_graph.png\">
</div>";


$lang_manual_13_title= "<span class=\"guide_title\"><a name=\"2_guide\"></a><a href=\"#top\">2. Slovní druhy</a></span>";
$lang_manual_13_1= "13. Login / Logout / Registration


<h4> 13.1. Login</h4>

<a name=\"13.1.1.\"><strong>13.1.1. Login in general</strong></a><br>
Each time you want to begin working with application you have to login to the system. You use username and password to login.
There is a general recommendation not to save your username and password in browsers while not using your personal computer or laptop.

<div id=\"help_image\"><img src=\"/help/images/help_login_form.png\">
</div>




<a name=\"13.2.1.\"><strong>13.2.1. First login</strong></a><br>
When you first log in the system, you will be asked to login again with a special code number that has been sent to your email.
<br>
Without that number, you cannot login. After you enter this number, you finish the registration process and then you will login only by using your
username and password.
<div id=\"help_image\"><img src=\"/help/images/help_login_first.png\">
</div>";


$lang_manual_13_2= "<h4> 13.2. Logout</h4>

<a name=\"13.2.1.\"><strong>13.2.1. Logout in general</strong></a><br>
You find the logout button on Users page. When you log out, all your searched results and your users list of headword will be lost. 
It is general recommended to logout while using computer that other can access too, for example in netcoffee.
<div id=\"help_image\"><img src=\"/help/images/help_logout_button.png\">
</div>




<a name=\"13.2.2.\"><strong>13.2.2. Logout because of inactivity</strong></a><br>
If you are more than one hour inactive, you will be automatically logged out. To continue work, you have to log in again.";



$lang_manual_13_3= "<h4> 13.3. Registration</h4>

<a name=\"13.3.1.\"><strong>13.3.1. Registration of lexicographers</strong></a><br>
New lexicographer can register by click on Registration button:
<div id=\"help_image\"><img src=\"/help/images/help_registration_icon.png\">
</div>
And first of all he has to contact the administrator of the project to obtain password (usually by email). When he obtained the
project password, he can continue with registration process. 
<div id=\"help_image\"><img src=\"/help/images/help_registration_form.png\">
</div>
New lexicographer has to choose username, password (minimal 3 letter), retype password, enter project password and enter a valid 
email address. After submitting a registration form, an email will be sent to user with instruction how to finish the registration process.
In email is attached Manual and there is also special security code that user needs for the first login. <a href=\"./help_13_login.php#13.1.2\">See first login (Toc 13.1.2.)</a>
";


$lang_manual_13_4= "<h4> 13.4. Passwords</h4>

<a name=\"13.4.1.\"><strong>13.4.1. Project password</strong></a><br>
Project password should be kept in secret and administrator of the Project should changed it regularly.



<a name=\"13.4.2.\"><strong>13.4.2. Users passwords</strong></a><br>
Password that users or visitors use, can noone see, not even administrator. They are stored in the database encrypted.";


$lang_manual_14_title= "<span class=\"guide_title\"><a name=\"2_guide\"></a><a href=\"#top\">2. Slovní druhy</a></span>";
$lang_manual_14_1= "14. Printing and publishing
<h4> 14.1. Printing</h4>

<a name=\"14.1.1.\"><strong>14.1.1. Printing in general</strong></a><br>
We understand printing creating a pdf file that is standard file for printing. You can use two ways of
printing. First is a printing in browser - it is a low quality printing with a basic css format, but it can be
used by lexicographers themselves. Second way of printing is to generate Latex files and then use Latex to
create Pdf file. The lexicographers will automatically send emailes with latex files to administrator and he
will send back Pdf files. 




<a name=\"14.1.2.\"><strong>14.1.2. Printing of users' list in browser</strong></a><br>
The users can add their favourite headwords to users' list. They can print them to new browser window and 
directly print them in a printer.




<a name=\"14.1.3.\"><strong>14.1.3. Printing of users' list in Latex</strong></a><br>
The users can also print their user's list with Latex. The users simply click on a button Printing users' list with
Latex and a file will be generated by scripts and sent directly to administrator that will create from Latex file a 
Pdf file and will send him back to user.



<a name=\"14.1.2.\"><strong>14.1.4. Printing of letters in Latex</strong></a><br>
Lexicographers will need sometimes to print a special letter and check the mistakes in a printed version. They
can send a Latex file to administrator in a similar way like a users' list by choosing a letter and pressing submit button.
The administrator will send back to them a Pdf file with a chosen letter.



<a name=\"14.1.2.\"><strong>14.1.5. Printing the dictionary in Latex</strong></a><br>
Printing a dictionary to Pdf file with Latex is a final stage of creating a dictionary. The administrator will print dictionary
in Latex when it is agreed by administrator and users that the work on dictionary is finished. Generating a latex file for printing
can be time demanding. Consider twice this final step. Consider to print each letter first and if everything is fine, print the whole
dictionary. It is possible to print various versions of dictionary by not including all information. The administrator can hardcode the 
latex scripts to generate a dictionary.";


$lang_manual_14_2= "<h4> 14.2. Publishing</h4>

In general there are three methods to publish you dictionary - Pdf file that can be uploaded by general public, special formats
for various free offline software dictionaries (for example Stardict) and online web page dictionary. Each method has its advantages.
Pdf file can print user itself and create a book and use it while being without computer. Offline software dictionaries can be used
offline and online dictionary has all functions that has Dictionary system application. Online dictionary has much more possibilities than a 
printed book. ";

$lang_manual_14_3= "<h4> 14.3. Output formats</h4>

Generally you can generate every format as long as you know the required structure. The administrator can create new scripts
for new formats by modifying the existant ones. By default you can generate format that used these software programs:
<br>
<br>
Stardict - dictionary software for Windows, Linux, MacOs
<br>
MobiPocket Reader for PocketPC
<br>
Sdict - dictionary software for Windows and Symbian ";


$lang_manual_14_4= "<h4> 14.4. Online dictionary </h4>

Online dictionary has the same functions as the Search page in the Dictionary system.
When the administrator opens the project to general public, visitors begin to register and start to 
use the Search page while searching for headwords. 

";




?>
