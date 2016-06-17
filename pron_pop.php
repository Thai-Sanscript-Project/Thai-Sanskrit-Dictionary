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
include 'start.php';
include './head_s.php'; ?>
<script type="text/javascript" src="<?=$IMAGE_URL?>audio/audio-player/audio-player.js"></script>  
<script type="text/javascript">  
AudioPlayer.setup("<?=$IMAGE_URL?>audio/audio-player/player.swf", {  
width: 250,
bg: "eeeeee",
initialvolume: 100,  
transparentpagebg: "yes",
leftbg: "eeeeee",
lefticon: "666666",
rightbg: "e8cae4",
rightbghover: "e9a0c0",
righticon: "666666",
righticonhover: "666666",
text:"666666",
slider: "e8cae4",
track: "FFFFFF",
border: "666666",
autostart: "yes",
loader:" e8cae4"
});  
</script> 
</head>   
<body>
<?php
$oop4 = new mySQL ($host1, $user1, $pass1, $data1, TRUE);
$table_sound='ds_sound';
$sql4 = sprintf ('SELECT `sound`, `keyword` FROM `%s` WHERE `keyword` COLLATE `%s` = %s',
	$table_sound,
	$collation_1,
	quate_smart($_GET["word"])); 
$oop4->Setnames();
$oop4->query($sql4);
$sound = $oop4->fetchArray ();
$oop4->freeResult();
$oop4->_mySQL;
clearstatcache();
$file = $IMAGE_URL."audio/uploaded_files/".$sound[0];

echo '<div style="text-align: center;">';
echo $_GET["word"].' - '.$_GET["fram"].' ';
?>
<span id="audioplayer_1" style="text-align: center;"></span>  
<script type="text/javascript">  
AudioPlayer.embed("audioplayer_1", {soundFile: "<?=$file;?>", titles: "<?=$_GET["word"]?>"});  
</script> 
</div>
</body>
</html>
