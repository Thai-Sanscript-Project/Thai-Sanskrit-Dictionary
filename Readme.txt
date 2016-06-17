===================================================================================
Dictionary system. Web-based application for development of bilingual dictionaries
Version: 1.0
Copyright (c) Ales Chejn, hvalur.org 2011
All rights reserved

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

For support contact us at www.hvalur.org
===================================================================================

Dictionary system can be downloaded in three versions:
1. dictionary-system-bare_1.0.zip (11.5MB)
2. dictionary-system-icelandic_1.0.zip (16.9MB)
3. dictionary-system-hvalur_1.0.zip (38.8MB)

In addition you can download audio and image files:
1. images-biolib.zip (306.9MB)
2. audio-uploaded_files.zip (1.1GB)
3. images-uploaded_files.zip (61.6MB)

**************************************************************************************
1. Dictionary system - bare (11.5MB)
Application is intended to create bilingual dictionary. 
In comparison to Dictionary System - Icelandic and Dictionary System - Hvalur 
zip file does not contain any headword list, pronunciation rules etc.

+ Download images-biolib and place it in the images/biolib directory. Later if you add Latin name
to the headword beautiful photographs of animals and plants will appear with your headword.
(306.9MB)

***************************************************************************************
2. Dictionary system - Icelandic (16.9MB)
Application with Icelandic extention is intended to create Icelandic-any language 
dictionary. Application already contains list of Icelandic headwords (22000), IPA transcription, 
endings, senses, phrases, examples, synonyms, antonyms, Latin names, rules for generation of IPA, 
rules for generation of declention and conjugation of Icelandic words, wordform database etc.

+ Download images-biolib and place it in the images/biolib directory. Later if you add Latin name
to the headword beautiful photographs of animals and plants will appear with your headword.
(306.9MB)
+ Download audio-uploaded_files and place it in the audio/uploaded_files directory. 
Pronunciation by native speaker in mp3 format will appear with each headword in the list (22000 sounds).
(1.1GB)
+ Download images-uploaded_files and place it in the images/uploaded_files. Pictures will appear with
some specific Icelandic headwords (culinary terms, Icelandic towns etc.)
(61.6MB)

*******************************************************************************************
3. Dictionary system - Hvalur (38.8MB)
Application contains up to date Icelandic-Czech students' Dictionary that can be found 
at www.hvalur.org. 

+ Download images-biolib and place it in the images/biolib directory. Later if you add Latin name
to the headword beautiful photos of animals and plants will appear with your headword.
(306.9MB)
+ Download audio-uploaded_files and place it in the audio/uploaded_files directory. 
Pronunciation by native speaker in mp3 format will appear with each headword in the list (22000 sounds).
(1.1GB)
+ Download images-uploaded_files and place it in the images/uploaded_files. Pictures will appear with
some specific Icelandic headwords (culinary terms, Icelandic towns etc.)
(61.6MB)
****************************************************************************************************

----------------------------------------------------------------------------------
To install Dictionary system follow these steps:

1. copy all files to remote server
2. run /install/install.php from remote server
3. fill out values for mysql connection and run the test, set database name
4. fill out values for ftp connection
5. fill out values for email connection
6. connection.php file will be created
7. MySql tables will be created (it can take 5-10 minutes)
8. create admin account
9. set Project password (that password allows other lexicographers to register)
10. delete completely /install/ directory (for security reasons)

The Dictionary system is now ready to use.
------------------------------------------------------------------------------------

Import already created Dictionary
-----------------------------------------------------------------------------------
You can import Dictionary from .csv file using /menu/administration/import

Later
-----------------------------------------------------------------------------------
11. Change values in language files - namely 
/language/cz/language.php 
/language/en/language.php
according to your Dictionary name. 
12. Cron settings - set backupcron.php to backup the database (weakly for example)
