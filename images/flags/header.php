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
if((isset($_POST["post_m"])) AND ($_POST["post_m"]!="")){
$_SESSION["post_m"]=$_POST["post_m"];
}else{
if($_GET["post_m"]!=''){
$_SESSION["post_m"] = $_GET["post_m"];
} else {
if(isset($_SESSION["post_m"])){
}else{
$_SESSION["post_m"] = "2";
}}}
if((isset($_POST["adv_field"])) AND ($_POST["adv_field"]!="")){
$_SESSION["post_f"]=$_POST["adv_field"];
}else{
if($_GET["post_f"]!=''){
$_SESSION["post_f"] = $_GET["post_f"];
} else {
if(isset($_SESSION["post_f"])){
}else{
$_SESSION["post_f"] = "keyword";
}}}
?>
<div id="header">
<div id="logo">
<h1><a href="./index.php"><?=$lang_header_dict;?></a><a name="UP"></a>
<form name=AddressForm action="" method=post>
<td align=right><IMG alt="" src="" id=imgFlag style="VISIBILITY: visible"></td>
<select id="Country" name="Country" size="1" value="" onChange='ShowFlag()'>
				<!--[OPTIONS]-->
				<Option value="00">*** Other ***</option>
				<Option value="AF">Afghanistan</option>
				<Option value="AL">Albania</option>
				<Option value="DZ">Algeria</option>
				<Option value="AS">American Samoa</option>
				<Option value="AD">Andorra</option>
				<Option value="AO">Angola</option>
				<Option value="AI">Anguilla</option>
				<Option value="AQ">Antarctica</option>
				<Option value="AG">Antigua and Barbuda</option>
				<Option value="AR">Argentina</option>
				<Option value="AM">Armenia</option>
				<Option value="AW">Aruba</option>
				<Option value="AU">Australia</option>
				<Option value="AT">Austria</option>
				<Option value="AZ">Azerbaijan</option>
				<Option value="BH">Bahrain</option>
				<Option value="BD">Bangladesh</option>
				<Option value="BB">Barbados</option>
				<Option value="BY">Belarus</option>
				<Option value="BE">Belgium</option>
				<Option value="BZ">Belize</option>
				<Option value="BJ">Benin</option>
				<Option value="BM">Bermuda</option>
				<Option value="BT">Bhutan</option>
				<Option value="BO">Bolivia</option>
				<Option value="BA">Bosnia and Herzegovina</option>
				<Option value="BW">Botswana</option>
				<Option value="BV">Bouvet Island</option>
				<Option value="BR">Brazil</option>
				<Option value="IO">British Indian Ocean Territory</option>
				<Option value="VG">British Virgin Islands</option>
				<Option value="BN">Brunei Darussalam</option>
				<Option value="BG">Bulgaria</option>
				<Option value="BF">Burkina Faso</option>
				<Option value="MM">Burma</option>
				<Option value="BI">Burundi</option>
				<Option value="KH">Cambodia</option>
				<Option value="CM">Cameroon</option>
				<Option value="CA">Canada</option>
				<Option value="CV">Cape Verde</option>
				<Option value="KY">Cayman Islands</option>
				<Option value="CF">Central African Republic</option>
				<Option value="TD">Chad</option>
				<Option value="CL">Chile</option>
				<Option value="CN">China</option>
				<Option value="CX">Christmas Island</option>
				<Option value="CC">Cocos (Keeling) Islands</option>
				<Option value="CO">Colombia</option>
				<Option value="KM">Comoros</option>
				<Option value="CD">Congo, Democratic Republic of the</option>
				<Option value="CG">Congo, Republic of the</option>
				<Option value="CK">Cook Islands</option>
				<Option value="CR">Costa Rica</option>
				<Option value="CI">Cote d'Ivoire</option>
				<Option value="HR">Croatia</option>
				<Option value="CU">Cuba</option>
				<Option value="CY">Cyprus</option>
				<Option value="CZ"><img src="/images/cze.png" border="0" alt=""> Czech Republic</option>
				<Option value="DK">Denmark</option>
				<Option value="DJ">Djibouti</option>
				<Option value="DM">Dominica</option>
				<Option value="DO">Dominican Republic</option>
				<Option value="TP">East Timor</option>
				<Option value="EC">Ecuador</option>
				<Option value="EG">Egypt</option>
				<Option value="SV">El Salvador</option>
				<Option value="GQ">Equatorial Guinea</option>
				<Option value="ER">Eritrea</option>
				<Option value="EE">Estonia</option>
				<Option value="ET">Ethiopia</option>
				<Option value="FK">Falkland Islands (Islas Malvinas)</option>
				<Option value="FO">Faroe Islands</option>
				<Option value="FJ">Fiji</option>
				<Option value="FI">Finland</option>
				<Option value="FR">France</option>
				<Option value="FX">France, Metropolitan</option>
				<Option value="GF">French Guiana</option>
				<Option value="PF">French Polynesia</option>
				<Option value="TF">French Southern and Antarctic Lands</option>
				<Option value="GA">Gabon</option>
				<Option value="GE">Georgia</option>
				<Option value="DE">Germany</option>
				<Option value="GH">Ghana</option>
				<Option value="GI">Gibraltar</option>
				<Option value="GR">Greece</option>
				<Option value="GL">Greenland</option>
				<Option value="GD">Grenada</option>
				<Option value="GP">Guadeloupe</option>
				<Option value="GU">Guam</option>
				<Option value="GT">Guatemala</option>
				<Option value="GG">Guernsey</option>
				<Option value="GN">Guinea</option>
				<Option value="GW">Guinea-Bissau</option>
				<Option value="GY">Guyana</option>
				<Option value="HT">Haiti</option>
				<Option value="HM">Heard Island and McDonald Islands</option>
				<Option value="VA">Holy See (Vatican City)</option>
				<Option value="HN">Honduras</option>
				<Option value="HK">Hong Kong (SAR)</option>
				<Option value="HU">Hungary</option>
				<Option value="IS">Iceland</option>
				<Option value="IN">India</option>
				<Option value="ID">Indonesia</option>
				<Option value="IR">Iran</option>
				<Option value="IQ">Iraq</option>
				<Option value="IE">Ireland</option>
				<Option value="IL">Israel</option>
				<Option value="IT">Italy</option>
				<Option value="JM">Jamaica</option>
				<Option value="JP">Japan</option>
				<Option value="JE">Jersey</option>
				<Option value="JO">Jordan</option>
				<Option value="KZ">Kazakhstan</option>
				<Option value="KE">Kenya</option>
				<Option value="KI">Kiribati</option>
				<Option value="KP">Korea, North</option>
				<Option value="KR">Korea, South</option>
				<Option value="KW">Kuwait</option>
				<Option value="KG">Kyrgyzstan</option>
				<Option value="LA">Laos</option>
				<Option value="LV">Latvia</option>
				<Option value="LB">Lebanon</option>
				<Option value="LS">Lesotho</option>
				<Option value="LR">Liberia</option>
				<Option value="LY">Libya</option>
				<Option value="LI">Liechtenstein</option>
				<Option value="LT">Lithuania</option>
				<Option value="LU">Luxembourg</option>
				<Option value="MO">Macao</option>
				<Option value="MK">Macedonia, The Former Yugoslav Republic of</option>
				<Option value="MG">Madagascar</option>
				<Option value="MW">Malawi</option>
				<Option value="MY">Malaysia</option>
				<Option value="MV">Maldives</option>
				<Option value="ML">Mali</option>
				<Option value="MT">Malta</option>
				<Option value="IM">Man, Isle of</option>
				<Option value="MH">Marshall Islands</option>
				<Option value="MQ">Martinique</option>
				<Option value="MR">Mauritania</option>
				<Option value="MU">Mauritius</option>
				<Option value="YT">Mayotte</option>
				<Option value="MX">Mexico</option>
				<Option value="FM">Micronesia, Federated States of</option>
				<Option value="MD">Moldova</option>
				<Option value="MC">Monaco</option>
				<Option value="MN">Mongolia</option>
				<Option value="MS">Montserrat</option>
				<Option value="MA">Morocco</option>
				<Option value="MZ">Mozambique</option>
				<Option value="NA">Namibia</option>
				<Option value="NR">Nauru</option>
				<Option value="NP">Nepal</option>
				<Option value="NL">Netherlands</option>
				<Option value="AN">Netherlands Antilles</option>
				<Option value="NC">New Caledonia</option>
				<Option value="NZ">New Zealand</option>
				<Option value="NI">Nicaragua</option>
				<Option value="NE">Niger</option>
				<Option value="NG">Nigeria</option>
				<Option value="NU">Niue</option>
				<Option value="NF">Norfolk Island</option>
				<Option value="MP">Northern Mariana Islands</option>
				<Option value="NO">Norway</option>
				<Option value="OM">Oman</option>
				<Option value="PK">Pakistan</option>
				<Option value="PW">Palau</option>
				<Option value="PS">Palestinian Territory, Occupied</option>
				<Option value="PA">Panama</option>
				<Option value="PG">Papua New Guinea</option>
				<Option value="PY">Paraguay</option>
				<Option value="PE">Peru</option>
				<Option value="PH">Philippines</option>
				<Option value="PN">Pitcairn Islands</option>
				<Option value="PL">Poland</option>
				<Option value="PT">Portugal</option>
				<Option value="PR">Puerto Rico</option>
				<Option value="QA">Qatar</option>
				<Option value="RE">Réunion</option>
				<Option value="RO">Romania</option>
				<Option value="RU">Russia</option>
				<Option value="RW">Rwanda</option>
				<Option value="SH">Saint Helena</option>
				<Option value="KN">Saint Kitts and Nevis</option>
				<Option value="LC">Saint Lucia</option>
				<Option value="PM">Saint Pierre and Miquelon</option>
				<Option value="VC">Saint Vincent and the Grenadines</option>
				<Option value="WS">Samoa</option>
				<Option value="SM">San Marino</option>
				<Option value="ST">São Tomé and Príncipe</option>
				<Option value="SA">Saudi Arabia</option>
				<Option value="SN">Senegal</option>
				<Option value="SC">Seychelles</option>
				<Option value="SL">Sierra Leone</option>
				<Option value="SG">Singapore</option>
				<Option value="SK">Slovakia</option>
				<Option value="SI">Slovenia</option>
				<Option value="SB">Solomon Islands</option>
				<Option value="SO">Somalia</option>
				<Option value="ZA" SELECTED>South Africa</option>
				<Option value="GS">South Georgia and the South Sandwich Islands</option>
				<Option value="ES">Spain</option>
				<Option value="LK">Sri Lanka</option>
				<Option value="SD">Sudan</option>
				<Option value="SR">Suriname</option>
				<Option value="SJ">Svalbard</option>
				<Option value="SZ">Swaziland</option>
				<Option value="SE">Sweden</option>
				<Option value="CH">Switzerland</option>
				<Option value="SY">Syria</option>
				<Option value="TW">Taiwan</option>
				<Option value="TJ">Tajikistan</option>
				<Option value="TZ">Tanzania</option>
				<Option value="TH">Thailand</option>
				<Option value="BS">The Bahamas</option>
				<Option value="GM">The Gambia</option>
				<Option value="TG">Togo</option>
				<Option value="TK">Tokelau</option>
				<Option value="TO">Tonga</option>
				<Option value="TT">Trinidad and Tobago</option>
				<Option value="TN">Tunisia</option>
				<Option value="TR">Turkey</option>
				<Option value="TM">Turkmenistan</option>
				<Option value="TC">Turks and Caicos Islands</option>
				<Option value="TV">Tuvalu</option>
				<Option value="UG">Uganda</option>
				<Option value="UA">Ukraine</option>
				<Option value="AE">United Arab Emirates</option>
				<Option value="UK">United Kingdom</option>
				<Option value="US">United States</option>
				<Option value="UM">United States Minor Outlying Islands</option>
				<Option value="UY">Uruguay</option>
				<Option value="UZ">Uzbekistan</option>
				<Option value="VU">Vanuatu</option>
				<Option value="VE">Venezuela</option>
				<Option value="VN">Vietnam</option>
				<Option value="VI">Virgin Islands</option>
				<Option value="WF">Wallis and Futuna</option>
				<Option value="EH">Western Sahara</option>
				<Option value="YE">Yemen</option>
				<Option value="YU">Yugoslavia</option>
				<Option value="ZM">Zambia</option>
				<Option value="ZW">Zimbabwe</option>
			</Select>
</form>
<a href="<?=$_SERVER['PHP_SELF']?>?lang=cz"> <img src="/images/cze.png" border="0" alt=""> </a>
<a href="<?=$_SERVER['PHP_SELF']?>?lang=en"><img src="/images/eng.png" border="0" alt=""></a></h1>
<h2><?=$lang_search_vyhledej?>
<span class="search_string">
<span onclick="document.form1.search_string.value += 'ð';document.form1.search_string.focus()" onmouseover="this.style.cursor='pointer'">ð</span>
<span onclick="document.form1.search_string.value += 'þ';document.form1.search_string.focus()" onmouseover="this.style.cursor='pointer'">þ</span>
<span onclick="document.form1.search_string.value += 'æ';document.form1.search_string.focus()" onmouseover="this.style.cursor='pointer'">æ</span>
<span onclick="document.form1.search_string.value += 'ö';document.form1.search_string.focus()" onmouseover="this.style.cursor='pointer'">ö</span>
|<span onclick="document.form1.search_string.value += 'é';document.form1.search_string.focus()" onmouseover="this.style.cursor='pointer'">é</span>
<span onclick="document.form1.search_string.value += 'í';document.form1.search_string.focus()" onmouseover="this.style.cursor='pointer'">í</span>
<span onclick="document.form1.search_string.value += 'ó';document.form1.search_string.focus()" onmouseover="this.style.cursor='pointer'">ó</span>
<span onclick="document.form1.search_string.value += 'ú';document.form1.search_string.focus()" onmouseover="this.style.cursor='pointer'">ú</span>
<span onclick="document.form1.search_string.value += 'ý';document.form1.search_string.focus()" onmouseover="this.style.cursor='pointer'">ý</span>
<span onclick="document.form1.search_string.value += 'á';document.form1.search_string.focus()" onmouseover="this.style.cursor='pointer'">á</span>
|<span onclick="document.form1.search_string.value += 'ě';document.form1.search_string.focus()" onmouseover="this.style.cursor='pointer'">ě</span>
<span onclick="document.form1.search_string.value += 'š';document.form1.search_string.focus()" onmouseover="this.style.cursor='pointer'">š</span>
<span onclick="document.form1.search_string.value += 'č';document.form1.search_string.focus()" onmouseover="this.style.cursor='pointer'">č</span>
<span onclick="document.form1.search_string.value += 'ř';document.form1.search_string.focus()" onmouseover="this.style.cursor='pointer'">ř</span>
<span onclick="document.form1.search_string.value += 'ž';document.form1.search_string.focus()" onmouseover="this.style.cursor='pointer'">ž</span>
</span> 						 
</h2>
<form action="search.php?action=find&list_kind=users" method="post" name="form1">
<table  border="0">
<tr> 
<td>
<input type="text" name="search_string" value="" size="30" maxlength="30">
</td><td>
<select name="post_m">
<option value="1" <?php if (($_SESSION["post_m"])==1) { echo 'selected';}?>> <?=$lang_search_option1?></option>
<option value="2" <?php if (($_SESSION["post_m"])==2) { echo 'selected';}?>> <?=$lang_search_option2?></option>
<option value="3" <?php if (($_SESSION["post_m"])==3) { echo 'selected';}?>> <?=$lang_search_option3?></option>
<option value="4" <?php if (($_SESSION["post_m"])==4) { echo 'selected';}?>> <?=$lang_search_option4?> </option>
</select> 
<td><h2>
<?=$lang_search_oblast?></h2>
</td>
<td>
<?php
// visitors / general public / not all fields in advanced search	 
$searched_areas = array(	
'keyword' => $lang_search_klicove_slovo,
'translation' => $lang_search_cat14,
'keyword_variant' => $lang_search_cat2,
'translation_detail' => $lang_search_cat15,
'gram_1_word_group' => $lang_search_cat5,
'gram_2_endings' => $lang_search_cat6,
'gram_3_additional' => $lang_search_cat7,
'gram_2' => $lang_search_cat10,
'word' => $lang_search_cat13,
'synonym' => $lang_search_cat11,
'antonym' => $lang_search_cat16,
'link' => $lang_search_cat18,
'example' => $lang_search_cat19,
'example_translation' => $lang_search_cat20,
'example_keyword' => $lang_search_cat12,
'specification' => $lang_search_cat22,
'usage_specification' => $lang_search_cat25,
'usage_category' => $lang_search_cat27,
'latinnames' => $lang_search_cat23,
);
$cz_areas = array(	
'translation' => $lang_search_cat14,
'translation_detail' => $lang_search_cat15,
'example_translation' => $lang_search_cat20,
);
$searched_areas_dict = array(	
'gram_2' => $lang_search_cat10,
'synonym' => $lang_search_cat11,
'word' => $lang_search_cat13,
'translation' => $lang_search_cat14,
'translation_detail' => $lang_search_cat15,
'antonym' => $lang_search_cat16,
'sec_marker' => $lang_search_cat17,
'link' => $lang_search_cat18,
'example' => $lang_search_cat19,
'example_translation' => $lang_search_cat20,
'example_keyword' => $lang_search_cat12,
'notes' => $lang_search_cat21,
'specification' => $lang_search_cat22,
'usage_specification' => $lang_search_cat25,
'usage_category' => $lang_search_cat27,
'latinnames' => $lang_search_cat23,
'marker' => $lang_search_cat24,
'num_keyword' => $lang_search_cat26,
);
$pageok = $page[$searched_areas];
?>
<select ID="source" name="adv_field">
<?php 
$n=0;
foreach ($searched_areas as $key1 => $value) {
if ($_SESSION["post_f"]==$key1) {
if (($key1=='translation') OR ($key1=='keyword')) {
$ad = 'style="font-weight: bold"';
} else {
$ad='';	
}
echo '<option value="'.$key1.'" '.$ad.' selected>'.$value.'</option>';	
} else {
if (($key1=='translation') OR ($key1=='keyword')) {
$ad = 'style="font-weight: bold"';
} else {
$ad='';	
}
echo '<option value="'.$key1.'" '.$ad.'>'.$value.'</option>';
}
$n++;
}
?>
</select>
</td> 
<td> 
<input type="submit" class="button2" name="submit" value="<?=$lang_search_button?>">
</td>
</tr>
</table>
</form>  
</div>
</div>
