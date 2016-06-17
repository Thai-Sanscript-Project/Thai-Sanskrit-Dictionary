<?php 
$lang_int_1_title= "Guide for correct editing of headwords";
$lang_int_1= "This guide is intended for correct editing of headwords. This guide explains how to enter each item and for which purpose. The guide explains also which items are displayed in the printed, online and offline version and which items purpose
is only to display additional information. <br><br>
In the first part of the edit table, there is only information concerning the headword. If the headword has several meanings, information is the same
for all meanings and it is possible to edit it from any meaning. The information is stored in different MySQL table.<br><br>
The rest of the edit tables contains the information concerning the meaning. <br><br>
It is important to realize that in most cases, the headword consists of items Headword, Number of headwords, Grammar (word groups), Grammar (endings) and Translation.
<br><br>
If you want to add a new meaning, navigate to menu/word/add a new meaning. There is an (almost) empty edit table (the first part of the table is already filled in, because it contains information concerning the headword. In Translation, there is
word \"new\"."; 

$lang_int_2_title= "Headword";
$lang_int_2= "In Add the page, enter the new headword. It is not possible to change the headword in Edit page. You can only delete the headword and create the new one."; 

$lang_int_3_title="Headword number";
$lang_int_3="It is not possible to change the headword number in Edit page. If you want to change the headword number, navigate to menu/sort/change the headword number.
If you want to add the headword that already exists in the dictionary, you have to enter a headword number which differs from the existing one. Homonyms differ by the headword numbers.
<br>
All headwords that are not homonyms have to have their headword number set on 0 (zero). Number 0 is not displayed. 
<div id=\"help_image\"><img src=\"/images/help/num_headword_hest.png\">
</div>
All headwords that are homonyms, have to have their headword number set to higher than 0 (zero) and those numbers have to follow one another (for example 1, 2, 3 etc.). See the headword fela
<div id=\"help_image\"><img src=\"/images/help/num_headword_koma.png\">
</div>
<br>
The way how to order the word groups <br> 
If the headwords are homonyms, firstly, place nouns (at first, masculinum, then femininum and at last, neutrum), then  
adjectives, pronouns, numbers, verbs (at first, weak conjugation, then strong conjugation and at last, irregular verbs), adverbs, prepositions, conjunctions, particles, interjections and prefixes.
";

$lang_int_4_title="Pronunciation";
$lang_int_4="You can use the hyperlink menu/links/IPA to pick the IPA characters. You can use the function menu/information/generation of pronunciation to generate automatically the IPA transcription and to copy the result into this field. Notice - Microsoft Explorer does not show properly the IPA characters in Edit page. Please, use another browser.
<br><br>
<div id=\"help_image\"><img src=\"/images/help/ipa_char_picker.png\">
</div>";

$lang_int_5_title="Division of compounds";
$lang_int_5="For the headword, special marks are used - \"·\",  \"··\" and \"|\"<br>
\"·\" indicates division of the compound, it is possible to use the mark more than once<br>
\"··\"indicates main division of the compound, use it only once<br>
 \"|\" indicates the place where the declension ending joins the headword, use it only once <br>
Please, see the following example:<br>
<div id=\"help_image\"><img src=\"/images/help/stem_hestur.png\">
</div>
In the headword \"hest|ur\", declension ending \"-ur\" joins the headword after the letter \"t\". 
Declension endings for \"hestur\" are (-s, -ar); it means that the genitive singular is \"hests\" and the nominative plural is \"hestar\". 
<br>
Notice: Marks can follow one another, for example, there is a mark for declension endings after main headword division. See the following example with the headword  \"bílasala\":
<br>
<div id=\"help_image\"><img src=\"/images/help/stem_bilasala.png\">
</div>";

$lang_int_6a_title="Frequency";
$lang_int_6a="Through it, you can enter a frequency number for the headword or some set symbols used for frequency (rare, often etc.) This item can be visible in the dictionary, but now, it is set as invisible. ";

$lang_int_6b_title="Compounds";
$lang_int_6b="This item enables to display words of which the compound consists. <br>
The way of editing:<br>
Enter always only two headwords according to main division. See the following example with the headword  \"samkomulag\". Main headword division divides the headword to \"samkomu\" and \"lag\".
At first, enter the headword in the basic form and then, in square brackets, enter the form in which the headword appears in the compound and add hyphen (at the beginning of the word or at the end, according to where the word joins the second part of the compound.) <br><br>

,samkoma[samkomu-],lag[-lag],<br>
It is important to enter the same format - comma before and after the part of the compound. <br>
The list of compounds is generated always after saving the headword to history. In the case of the headword \"samkomulag\", this headword appears with headwords \"samkoma\" and \"lag\" after saving to history these two headwords.";

$lang_int_7_title="Grammar - part of speech";
$lang_int_7="In this item, there is a help pop-up window which helps to choose easily the part of speech. 

<div id=\"help_image\"><img src=\"/images/help/A_word_group_popup.png\">
</div>
<br>
For a complete list of abbreviations, open menu/information/abbreviation listed according to usage.
<br>
<div id=\"help_image\"><img src=\"/images/help/A_word_group_question.png\">
</div>
<br>
";

$lang_int_8_title="Grammar - endings";
$lang_int_8="Through this item, we edit the declension endings of headwords. The correct form of editing is important for generating of new declension and conjugation tables. 
<br>
Declension endings are used both in the online version and in the printed version (in contrary to declension tables which are displayed only in the printed version).
For each part of speech, there exist some rules. Firstly, we mention the rules which are common for all parts of speech, then, we mention the rules which are set for each part of speech. 
<br>
All information in this item has to be put in brackets  \"()\", <br><br>

<div id=\"help_image\"><img src=\"/images/help/gram_endings_hestur.png\">
</div>

apart from few exceptions like plural form of nouns - pl, see the following example:

<div id=\"help_image\"><img src=\"/images/help/gram_endings_pl.png\">
</div>

<br>
<strong>Noun endings</strong><br>
First rule: Enter the genitive singular and the nominative plural.
<div id=\"help_image\"><img src=\"/images/help/gram_endings_hestur.png\">
</div>
Second rule: If the headword exists only in singular, enter only the genitive singular. 

<div id=\"help_image\"><img src=\"/images/help/gram_endings_sg.png\">
</div>
Third rule: If the headword exists only in plural, enter the abbreviation \"pl\".
<div id=\"help_image\"><img src=\"/images/help/gram_endings_pl.png\">
</div>
<br>
Fourth rule: If the headword is indeclinable, enter the abbreviation  \"indecl\"
Example of noun endings:<br>
<br>
(-s, -ar) => endings of masculine noun<br>
(-ar, -ar) => endings of feminine noun<br>
(-s, -) => endings of neuter noun<br>
(-s) => ending of neuter noun, only singular<br>
pl => only plural form of noun<br>
indecl => noun is indeclinable<br>

<br>
<br>
If there is a vowel change in the headword (see the example with plural form of the headword \"lag\"), it is necessary to indicate the change.
<div id=\"help_image\"><img src=\"/images/help/word_endings_lag.png\">
</div>

<br><br>
<strong>Adjective endings</strong><br>
Endings for adjectives are entered only if there exists the irregular form in the feminine or neuter. See the following example:
<div id=\"help_image\"><img src=\"/images/help/word_endings_hamingjusamur.png\">
</div>
This example shows that in the feminine form (abbreviation \"f\", see abbreviations in Grammar - part of speech), there is a vowel change.
<br>
In other cases, this item is left empty - we do not enter the endings because the adjective declension is regular, see the headword  \"fallegur\" 
<div id=\"help_image\"><img src=\"/images/help/word_endings_fallegur.png\">
</div>

<br><br>
<strong>Pronoun endings</strong><br>
We do not usually enter the endings for pronouns,
<div id=\"help_image\"><img src=\"/images/help/word_endings_hana.png\">
</div>
only if we have to specify the form of the pronoun, we add the information in brackets \"()\". See the example of the headword \"hana\":
<div id=\"help_image\"><img src=\"/images/help/word_endings_ed.png\">
</div>
The order of information: 1. number, 2. gender, 3. person, 4. case
<br>
Notice: In this item, we enter only information concerning declension. All other information indicating, for example, that the pronoun is demonstrative, personal etc., are entered through Grammar - additional information.

<br><br>
<strong>Verb endings</strong><br>
We enter endings for verbs according to the conjugation group to which the verb belongs. Icelandic verbs are divided into three groups. <br>
A. weak verbs which form the 1st person of the present tense by adding the ending -a. 
For example, the verb \"hjálpa\". We enter only the ending of the 1st person of the past tense (-aði)
<div id=\"help_image\"><img src=\"/images/help/word_endings_hjalpa.png\">
</div>
B. weak verbs which form the 1st person of the present tense with -i. For example, the verb \"frétta\". In this case, we enter the 1st person of the past tense and the past participle (the ending or the whole form). 
Whenever it is possible, we enter only the ending which joins the part of the headword. If it is not possible (because of the vowel change), we have to enter the whole form, see the headword \"frétt\".
<div id=\"help_image\"><img src=\"/images/help/word_endings_fretta.png\">
</div>
C. strong verbs. We enter four forms: 1st person singular of the present tense, 1st person singular of the past tense, 1st person plural of the past tense and the past participle.
<div id=\"help_image\"><img src=\"/images/help/word_endings_fara.png\">
</div>
<br><br>

<br>";

$lang_int_9_title="Grammar - additional information";
$lang_int_9="Through this item, enter grammatical information which are not related to the part of speech or to declension endings.<br>
<br> It is possible to enter more information, if necessary. 
Information on the case:<br>
gen - genitive<br>
acc - accusative<br>
nom - nominative<br>
dat - dative<br>
<br>
Information on the definitive form:<br>
def - definitive form<br>
<br>
Information on the type of numeral:<br>
ord - ordinal number<br>
<br>
Information on the type of pronoun:<br>
pers - personal pronoun<br>
poss - possessive pronoun<br>
dem - demonstrative pronoun<br>
indef - indefinite pronoun<br>
<br>
Information on the verb:<br>
pp - past participle<br>
refl - reflexive<br>
impers - impersonal verb<br>
met – so-called weather verb<br>
<br>
Information on the degrees of comparison of adjectives and adverbs:<br>
sup - superlative<br>
comp - comparative<br>
<br>";

$lang_int_10_title="Headword variant";
$lang_int_10="Enter the headword variant without the additional indicators - in basic form. If the variant already exists in the dictionary, the hyperlink is created automatically. If the variant is homonym, enter it according to the following example: <br>
<br>
koma(2)<br>
<br>
This variant corresponds to the headword \"koma\" with the headword number \"2\". This information corresponds to \"<sup>2</sup>koma\" in the headword preview or in the printed version<br>
<br>
Notice also that if the number of headword is  \"0\" (zero), we enter simply 
<br>
albatros<br>
<br>without commas and brackets and without the headword number. The same form of entry is used with homonyms, synonyms, antonyms and links to other headwords. 
<div id=\"help_image\"><img src=\"/images/help/variant_albatros.png\">
</div>";

$lang_int_11_title="Headword notes";
$lang_int_11="The notes are not displayed, neither in the printed, nor in the online version and they serve only to lexicographers. You can enter here any information which can help to edit the headword.
<div id=\"help_image\"><img src=\"/images/help/notes_adalfundur.png\">
</div>";

$lang_int_12_title="Indicator";
$lang_int_12="Use Arabic numerals to distinguish among different meanings (1., 2., 3. etc.) with dot. ";

$lang_int_13_title="Secondary indicator";
$lang_int_13="Use small letters in alphabetical order (a., b., c. etc) with dot to distinguish secondary meanings of the phrase. For example, if the phrase has several meanings. <br>
<br>
Please, see the example in the headword \"finna\".<br>
Reflexive form  \"finnast\" has two meanings and that is why there is used the secondary indicator.<br>
<div id=\"help_image\"><img src=\"/images/help/sec_marker_finna.png\">
</div>
Notice that you do not enter again neither the phrase nor grammar information for the second meaning of  \"finnast\"<br>";

$lang_int_14_title="Word phrase / word";
$lang_int_14="Through this item, enter the word phrase or form of the headword (for example, the plural form).  For example, \"finna til\" in the headword \"finna\", \"gefa e-m e-ð\"
in headword \"gefa\".
<br><br>
Enter the whole form of the phrase. In some dictionaries, there is used the tilde symbol in printed versions to shorten the text and to save the space. In the online version, it seems to be better to add the whole phrase without shortening. This shortening can be realized via script, if necessary.  
<div id=\"help_image\"><img src=\"/images/help/word_finna.png\">
</div>
<br><br>
Some word phrases may contain several words or even sentences, for example  \"það liggur hundurinn grafinn\". 
<div id=\"help_image\"><img src=\"/images/help/word_phrase_liggur.png\">
</div>
Enter the word phrase only once in the headword to which the word phrase logically belongs. In the last example, that would be the case of the headword  \"hundur\". <br>
Nevertheless, in the online version, this word phrase appears also in headwords which are in the word phrase. (\"þar\", \"liggur -> liggja\", \"grafinn -> grafa\"), but in the other part of the headword preview, namely in Headwords in examples. This is realized by correctly entering  information in the item Headwords in examples.

<div id=\"help_image\"><img src=\"/images/help/word_phrase_hundur.png\">
</div> If there exist variants of the word phrase, use brackets or the symbol \"/\" to indicate some of them. 

<div id=\"help_image\"><img src=\"/images/help/word_phrase_options.png\">
</div>

See the word phrase \"fara í hundana (í hund og kött/ í hund og hrafn)\" that be read as
\"fara í hundana\", \"fara í hund og kött\", \"fara í hund og hrafn\".";

$lang_int_15_title="Grammar of word phrase";
$lang_int_15="Enter grammatical information which is related to the word phrase. Use the same abbreviation as in Grammar - part of speech and additional information
Namely:<br><br>

Information on the case:<br>
gen - genitive<br>
acc - accusative<br>
nom - nominative<br>
dat - dative<br>
<br>
Information on the definitive form:<br>
def - definitive form<br>
<br>
Information on the type of numeral:<br>
ord - ordinal number<br>
<br>
Information on the type of pronoun:<br>
pers - personal pronoun<br>
poss - possessive pronoun<br>
dem - demonstrative pronoun<br>
indef - indefinite pronoun<br>
<br>
Information on verb:<br>
pp - past participle<br>
refl - reflexive<br>
impers - impersonal verb<br>
met - so-called weather verb<br>
<br>
Information on the degrees of comparison of adjectives and adverbs:<br>
sup  - superlative<br>
comp - comparative<br>
<br>
";

$lang_int_16a_title="Translation";
$lang_int_16a="Translate each meaning of the headword by one or more words. Use  \",\" to divide several translations. Use \";\" to divide translations which contain  \",\" for example, in:

<div id=\"help_image\"><img src=\"/images/help/translation_semicolon.png\">
</div>

After translating, use brackets \"()\" to specify the translation. After the illustrative word, add the abbreviation \"ap.\" (a podobně) to indicate that the word in brackets is illustrative. For example:
<div id=\"help_image\"><img src=\"/images/help/translation_bracket.png\">
</div>

Use \"/\" to shorten the variants of translation, for example, the translation \"hlavní postava, ústřední postava\" can be shortened to \"hlavní/ ústřední postava\". Add the symbol \"/\" directly to the first part and then, add leave space between the slash symbol and the second part, for example:

<div id=\"help_image\"><img src=\"/images/help/translation_slash.png\">
</div>
If you are not sure how to translate the meaning, enter  \"???\" (three interrogation marks). Later, it will be easier to find the non-translated meanings or unsure translations. ";

$lang_int_16b_title="Translation - field and usage categories";
$lang_int_16b="Through this item, enter field or usage categories related to the translation. You can find the list of abbreviations in menu/information/abbreviations listed according to usage. ";

$lang_int_16c_title="Translation - detail";
$lang_int_16c="If it is not possible to translate the meaning directly, use this item to explain the meaning periphrastically. Such a translation is displayed with smaller letters in the printed and online version. 
Please, see the example in the headword \"tilberi\".";

$lang_int_17a_title="Synonyms";
$lang_int_17a="Enter the synonym for the headword meaning. Correct way of entering the synonyms is necessary for displaying the hyperlinks and synonyms which are related to the headword.  <br>
Form of entry: If the word is homonym (headword number is higher than zero), enter as follows: 
<br>
koma(2)<br>
<br>That would appear in the printed version or in the preview as sup>2</sup>koma<br>
<br>
If the headword number is 0 (zero), enter simply (without zero)
<br>
albatros<br>
<br>

<div id=\"help_image\"><img src=\"/images/help/synonym_two_words.png\">
</div>

<div id=\"help_image\"><img src=\"/images/help/synonym_loka_1.png\">
</div>
It will be as follows:<br>
<br>
<div id=\"help_image\"><img src=\"/images/help/synonym_loka_2.png\">
</div>

If you want to use the synonym which consists of more than one word or phrase, enter the word which is logically the most important in the item Synonym - link. That will create the hyperlink to such a headword.";

$lang_int_17b_title="Synonym - link";
$lang_int_17b="Synonym - link is closely related to the item Synonym. If the field Synonym consists of more than one word (for example\"það að byggja\") and, therefore, the hyperlink to the headword in the dictionary cannot be created, use this item to enter the logically most important word to create the hyperlink. (for example \"byggja\").
Use the same form of record as in the field Synonym. <br>
If the word is homonym (headword number is higher than zero), enter as follows: 
<br>
koma(2)<br>
<br>That would appear in the printed version or in the preview as sup>2</sup>koma<br>
<br>
If the headword number is 0 (zero), enter only the headword (without zero)
<br>
albatros<br>
<br>
";

$lang_int_18_title="Example";
$lang_int_18="Here, you can enter example sentences, phrases or word(s). If you want to enter several examples, separate them by comma. If the example contains comma, use semicolon. 
For entering indefinite pronouns, use Icelandic abbreviations (e-u, e-n etc.).
<div id=\"help_image\"><img src=\"/images/help/example_fara3.png\">
</div>
";

$lang_int_19_title="Translation of example";
$lang_int_19="Translate the example and use the same form (translate the sentence with the sentence etc.). Put in brackets the indefinite pronouns (koho, čemu, čím, kdo etc.) which correspond to Icelandic indefinite pronouns (e-u, e-n etc.). For example, \"mluvil jsem s (kým)\"";

$lang_int_20_title="Headwords in example";
$lang_int_20="This item is not explicitly displayed, neither in the printed nor in the online version, but it helps to indicate examples in which the headword is contained. Here, enter the headwords in basic form which appears in the example. As soon as you enter the headwords, the example appears also for those headwords (in the online version). 

Therefore, the example is used more efficiently in the dictionary.
<br><br>
See the following example:
<div id=\"help_image\"><img src=\"/images/help/headword_example_reykjarlykt.png\">
</div>
All headwords (\"finna\", \"nokkur\", \"reykjarlykt\") are entered in the basic form and they are divided by comma \",\". These words are not homonyms (their headword number is zero and, therefore, they are entered without any headword number.<br>If the headword is homonym, enter it as it is shown in the example:
<div id=\"help_image\"><img src=\"/images/help/headword_example_aldrei.png\">
</div>
In this case, the headword \"koma\" has headword number 2. 
Enter also the headwords which are not yet included in the dictionary. Do not enter personal pronouns (for example \"hana\", \"hann\" etc.) or some other frequent headwords - such examples would not have any purpose. 
<br><br>
Headwords in example appear only in the headword preview and only for lexicographers, with hyperlinks to headwords. If the hyperlink is not active, the headword does not exist in the dictionary or the form of record is not correct (for example, missing comma etc.)<br>";

$lang_int_21_title= "Notes";
$lang_int_21= "Here, you can enter notes which are related to each meaning. Notes are not displayed in any version. ";

$lang_int_22_title="Link to other headword";
$lang_int_22="Use this item to point to other headword in the dictionary. In the online version, this link is a hyperlink. In the printed version, the symbol arrow is used. <br><br>

<br>Enter the headword and if the number of link's headword is not 0 (zero), enter also the number of link's headword in the brackets directly after the link. 
<br>
See the following example:
<div id=\"help_image\"><img src=\"/images/help/link_beyki2.png\">
</div>
Headword preview in the online version:
<div id=\"help_image\"><img src=\"/images/help/link_beyki.png\">
</div>
If the word is homonym (headword number is higher than zero), enter as follows: 
<br>
koma(2)<br>
<br>That would appear in the printed version or in the preview as sup>2</sup>koma<br>
<br>
If the headword number is 0 (zero), enter only the headword without zero)
<br>
albatros<br>
<br>
Use the link if 1) the meaning has exactly the same meaning as another one in the dictionary. <br>
<div id=\"help_image\"><img src=\"/images/help/link_usage1.png\">
</div>
2)  you want to indicate that some information can be find somewhere else in the dictionary
<div id=\"help_image\"><img src=\"/images/help/link_usage2.png\">
</div>
In the printed version, the aim is to save space and not to repeat the same information. ";

$lang_int_23_title="The number of meanings in the headword";
$lang_int_23="It is possible to change the order by entering the number, but we recommend you to use the function in menu/sorting/change the order of meanings.
<br><br>
Order the meanings according to indicators, secondary indicators and word phrases.
<div id=\"help_image\"><img src=\"/images/help/order_leggja.png\">
</div>";

$lang_int_24_title="Field categories";
$lang_int_24="Use the abbreviations of field categories to specify the meaning. There is a small pop-up window which helps you to choose the abbreviation. You can complete the list of field abbreviation in menu/information/abbreviations listed according to usage

<div id=\"help_image\"><img src=\"/images/help/A_popup_field.png\">
</div>

<br>
The list of abbreviations of field categories:
 <br>﻿astro. astronomy <br>
biol.biology <br>
bot.botany <br>
chem.chemistry <br>
cykl.cycling <br>
ekon.economy <br>
elek.electricity <br>
filos.philosophy, logic <br>
fyz.physics <br>
geog.geography <br>
geol.geology <br>
hist.history <br>
hud.music <br>
jaz.linguistics <br>
kulin.cuisine <br>
let.aviation <br>
lit.literature, publishing <br>
mat.mathematics <br>
med. medicine <br>
meteo.meteorology <br>
náb.religion <br>
nám.marine <br>
poč.informatics, computer <br>
spol.politics <br>
pov.folklore <br>
práv.law, justice <br>
psych.psychology <br>
škol.educational system <br>
sport.sport <br>
stav.civil engineering, architecture <br>
techn.technology <br>
voj.warfare <br>
zem.agriculture <br>
zool.zoology <br>
 <br>
";


$lang_int_25_title="Language categories";
$lang_int_25="Use the abbreviations of language categories. There is a small pop-up window which helps you to choose the abbreviation. You can complete the list of field categories in menu/information/abbreviations listed according to usage.
<div id=\"help_image\"><img src=\"/images/help/A_popup_usage.png\">
</div>

<br><br>
The list of abbreviations of language categories:
 <br>﻿básn.poetic expression <br>﻿
dět.childlike <br>﻿
form.formal <br>﻿
han.pejoratively <br>﻿
hovor.colloquial <br>﻿
hrub.grossly <br>﻿
neform.informal <br>﻿
neo.neologism <br>﻿
přen.figuratively <br>﻿
přís.proverb <br>﻿
říd.rarely <br>﻿
slang.slang <br>﻿
zast.archaic <br>﻿
zdrob.diminutive <br>﻿
";

$lang_int_26_title="Latin names";
$lang_int_26="Enter Latin names in botanical and zoological entries. Use the capital letter at the beginning - for example: \"Cetacea\". 
<br><br>
According to Latin names, the pictures from Biolib are automatically assigned to the headword.";

$lang_int_27_title="Antonyms";
$lang_int_27="Enter antonym for the headword meaning. Correct way of entering the antonyms is necessary for displaying the hyperlinks and for antonyms which are related to the headword.  <br>
Form of record: If the word is homonym (headword number is higher than zero), enter as follows: 
<br>
koma(2)<br>
<br>That would appear in the printed version or in the preview as sup>2</sup>koma<br>
<br>
If the headword number is 0 (zero), enter only the headword (without zero)
<br>
albatros<br>
<br>
In the printed and online version, there appears automatically a small \"x\" to express that the word is antonym<br>
<br>
Enter antonyms only when the antonyms are equal in relation, for example  \"cold\" and \"hot\"";

$lang_int_28_title="Usage category";
$lang_int_28="This item is displayed only indirectly in the online version. The purpose of this item is to set the word semantically into some category (semantic group). Then, it is possible to display the words which are part of this group and the word which belongs to the word. See the following example:
The name of the category is \"colour\". The parts of the category are \"blue\", \"yellow\" etc.<br>
In the headword \"colour\", there is a list with the parts with hyperlinks to the headwords and through the parts of this category (headwords \"blue\", \"yellow\" etc.), there appear other parts with hyperlinks. <br><br>

Notice: At first, it is necessary to create the categories in menu/administration/usage category. 
";

$lang_int_29a_title="Phrase";
$lang_int_29a="Through this item, enter the word phrase in a general form with  \"+\" and with a preposition as in the example: \"leggja + til\" or \"koma + fyrir\" using \"+\". The phrase field combines more word phrases in the headword and helps to easily navigate in the large entries with a great amount of meanings.  <br>
This item is designed especially for those verbs which contain dozens of meanings and word phrases like  \"leggja\", \"koma\" etc.
<br> <br>
See the following example:
In the headword  \"læra\", there is a word phrase \"læra af e-m\". In the phrase field, we enter  \"læra + af\". Then, we enter \"lærast\" with word phrase \"lærast\".<br> <br>
In the online version, there is automatically created a sidelist for easy orientation in the entry. (This menu appears only if at least one phrase field is not empty).
";

$lang_int_29b_title="The order of phrases";
$lang_int_29b="Through this item, we enter order in which we want the phrase to appear in the dictionary. <br>
The order should respect the alphabetical order according to prepositions, then, reflexive, after that, word phrases which cannot be grouped (no prepositions etc.) and at last, the proverbs. ";

$lang_int_30_title="Etymology";
$lang_int_30="In this field, you can enter etymology of the headword. ";

$lang_int_index1="Headword";
$lang_int_index2="Meaning";
?>
