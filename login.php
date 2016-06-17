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
ini_set('arg_separator.output', '&amp;');
include 'start.php';
include './head.php';
?>
<body onload="setfocus()">
    <div id="wrapper">
        <?php
        include 'header.php';
        include 'menu.php';
        echo $MAIN_MENU;
        ?>
        <div id="content">
            <div class="left_huge">
                <h2><?= $lang_login1 ?></h2>
<?= $lang_login2 ?>
                <br><br>
                <form action="validate.php" method="post" name="form2">
                    <table  class="sample">
                        <tr>
                            <td><?= $lang_index_user ?> </td>
                            <td><input type="text" class="inputbox" name="nn" size="14" maxlength="40"></td>
                        </tr>
                        <tr>
                            <td><?= $lang_index_password ?> </td>
                            <td><input type="password" class="inputbox" name="pp" size="14" maxlength="40"></td>
                        </tr>
<?php if ($_GET["first_login"] == 'TRUE') { ?>
                            <tr>
                                <td><?= $lang_login3 ?></td>
                                <td><input type="password" class="inputbox" name="first_login_password" size="14" maxlength="40"></td>
                            </tr>
<?php } ?>
                        <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" class="button2" name="submit" value="<?= $lang_login4 ?>">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><a href="./lost_pp.php"><?= $lang_index_forgotten ?></a> <a href="./reg.php"><?= $lang_index_reg ?></a></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div style="clear:both;"> </div>
        </div>
        <div id="footer">
    <?= $lang_footer; ?>
        </div></div><?php
    include ('./html_end.php');
    ?>