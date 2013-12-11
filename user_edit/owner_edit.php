<?php
session_start();
$_SESSION['page'] = 'owner_edit';
if(isset($_SESSION['uname']) != true)
{
    die('You have to login first!');
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>DeliveryGuys|Edit Personal Info</title>
    <link rel="stylesheet" type="text/css" href="./user_edit.css">
    <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
</head>
<body>
    <div class = "whole_page">
        <header>
            <a href = "../index.php">
                <img src = "../icons/web_logo.png" alt = "website logo." height = "70px">
            </a>
            <aside id = "signup_login_aside">
                <section id = "signup_login_links">
                    Hello, 
<?php
include '../user_db/login_display.php';
?>
                </section>
                <form method="post" action = '../restaurants/restaurant_list.php' id = "search_form_id">
                    <input type = "text" name = "search_cont" placeholder = "Search...">
                </form>
            </aside>
        </header>
        <div class = "content_wrapper">
            <form name = 'update_owner_info' action = './owner_edit.php' method = 'post' onsubmit = 'return myPInfoUpdate();' id = 'left_form'>
                <span class = 'myTitle'>Your infomation:</span>
                <span id = 'click_to_edit'> Click <a href = './owner_edit.php#!' onclick = 'myEnableInputs();'>HERE</a> to edit.</span>
                <div id = 'personal_info_warning'><br></div>
                <label for = 'uname'>username:</label>
                <input type = 'text' name = 'uname' disabled value = '' id = 'uname_id' onblur = 'myValidateUname(this.id, "personal_info_warning");'><br>
                <label for = 'email'>email:</label>
                <input type = 'email' name = 'email' disabled id = 'email_id' onblur = 'myValidateEmail(this.id, "personal_info_warning");'><br>
                <label for = 'fname'>first name:</label>
                <input type = 'text' name = 'fname' disabled id = 'fname_id' onblur = 'myTagsValidate(this.id, "personal_info_warning");'><br>
                <label for = 'lname'>last name:</label>
                <input type = 'text' name = 'lname' disabled id = 'lname_id' onblur = 'myTagsValidate(this.id, "personal_info_warning");'><br>
                <label for = 'tel'>telephone:</label>
                <input type = 'text' name = 'tel' disabled id = 'tel_id' onblur = 'myTelValidate(this.id, "personal_info_warning");'><br>
                <label for = 'straddr'>street address:</label>
                <input type = 'text' name = 'straddr' disabled id = 'straddr_id' onblur = 'myTagsValidate(this.id, "personal_info_warning");'><br>
                <label for = 'city'>city:</label>
                <input type = 'text' name = 'city' disabled id = 'city_id' onblur = 'myTagsValidate(this.id, "personal_info_warning");'><br>
                <label for = 'state'>state:</label>
                <select id = 'states_sel' name = 'state' disabled></select><br>
                <label for = 'zcode'>zip code:</label>
                <input type = 'text' name = 'zcode' disabled id = 'zcode_id' onblur = 'myZCodeValidate(this.id, "personal_info_warning");'><br>
                <div id = 'button_wrapper1'>
                <button type = 'button' onclick = 'location.reload();' disabled>Cancel</button>
                <button id = 'myResetButton' type = 'button' onclick = 'myResetPersonalInfo();'disabled>Reset</button>
                <input type = 'submit' value = 'Submit' disabled></div>
            </form>
            <form name = 'reset_password' action = './owner_edit.php' method = 'post' onsubmit = 'return myPasswordValidate();' id = 'right_form'>
                <span class = 'myTitle'>Reset your password:</span><br>
                <div id = 'password_warning'><br></div>
                <label for = 'old_passwd'>old password:</label>
                <input type = 'password' name = 'old_passwd'><br>
                <label for = 'new_passwd'>new password:</label>
                <input type = 'password' name = 'new_passwd'><br>
                <label for = 'conf_passwd'>confirm:</label>
                <input type = 'password' name = 'conf_passwd'><br>
                <div id = 'button_wrapper2'>
                <button type = 'button' onclick = 'myPasswdReset()'>Reset</button>
                <input type = 'submit' value = 'Submit'></div>
            </form>
            <div style="clear: left;"></div>
        </div>
        <section id = 'rest_info'>
            <article id = 'no_rest_notice'></>There is no restaurant yet, to open a restaurant, click <a href = '#!' onclick = 'open_restaurant();'>HERE</a></article>
            <article id = 'edit_restaurant' style = 'display: none;'>
                <div id = 'rest_title'><span class = 'myTitle'>Edit Your Restaurant:</span></div>
                <article id = 'rest_left_wrapper'>
                    <div id = 'rest_warning'><br></div>
                    <form name = 'rest_edit' method='post' action='./owner_edit.php' id = 'rest_info_form' onsubmit = 'return my_rest_edit_validate();'>
                    <label for = 'rest_name'>name:</label>
                    <input type = 'text' id = 'rest_name_id' name = 'rest_name' onblur = 'myTagsValidate(this.id, "rest_warning");'><br>
                    <label for = 'rest_straddr'>street address:</label>
                    <input type = 'text' id = 'rest_straddr_id' name = 'rest_straddr' onblur = 'myTagsValidate(this.id, "rest_warning");'><br>
                    <label for = 'rest_city'>city:</label>
                    <input type = 'text' id = 'rest_city_id' name = 'rest_city' onblur ='myTagsValidate(this.id, "rest_warning");'><br>
                    <label for = 'rest_state'>state:</label>
                    <select id = 'rest_states_id' name = 'rest_state'></select><br>
                    <label for = 'rest_zcode'>zip code:</label>
                    <input type = 'text' id = 'rest_zcode_id' name = 'rest_zcode' onblur = 'myZCodeValidate(this.id, "rest_warning");'><br>
                    <label for = 'rest_tel'>telephone:</label>
                    <input type = 'text' id = 'rest_tel_id' name = 'rest_tel' onblur = 'myTelValidate(this.id, "rest_warning");'><br>
                    <label for = 'rest_description'>description:</label>
                    <textarea id = 'rest_description_id' name = 'rest_description' onblur = 'myTagsValidate(this.id, "rest_warning");' row = "4"></textarea>
                    <input type = 'submit' value = 'submit' style = 'position: absolute; left: -9999px'>
                    </form>
                </article>
                <article id = 'rest_right_wrapper'>
                    <div id = 'rest_img_warning'><br></div>
                    <article id = 'img_wrapper'>
<?php
include './check_rest_icon.php';
?>
                    </article>
                    <form method="post" action='owner_edit.php' enctype="multipart/form-data" id = 'img_upload_form'>
                        <label for = 'rest_icon_url'>image URL:</label>
                        <input type = 'text' name = 'rest_icon_url' id = 'rest_icon_url_id'><br>
                        <label for = 'rest_icon_file'>or upload:</label>
                        <input type = 'file' name = 'rest_icon_file' id = 'rest_icon_file_id' value="choose"><br>
                        <input type = 'submit' name = 'submit' value = 'submit'>
                    </form>
                </article>
                <div style="clear: left;"></div>
            </article>
            <article id = 'add_menu' style = 'display: none;'>
                <div id = 'add_menu_title'><span class = 'myTitle'>Add menu:</span></div>
                <article id = 'menu_wrapper'>
                    <div id = 'menu_warning'><br></div>
<?php
include './menu_download.php';
?>
                    
<form action="./owner_edit.php" method="post" enctype="multipart/form-data" id = "menu_upload_form" onsubmit="return my_check_file();">
<label for="menu_upload">upload menu:</label>
<input type="file" name="menu_upload" id="menu_upload_id">
<input type="submit" name="submit" value="Submit">
</form>
                        <a href = '#!' onclick='my_add_category();'>Add category</a>
                        <a href = '#!' onclick='my_remove_category();'>Remove category</a>
                        <form method = 'post' action = 'owner_edit.php' id = 'menu_all_form'>
                        <div class = 'menu_category' id = 'menu_category_id0'>
                        <div class = 'cate_inputs'>
                        <label for = 'cate_name'>category name:</label>
                        <input type = 'text' name = 'cate_name[]' id = 'cate_name_id0'><br>
                        <label for = 'cate_descript'>description:</label>
                        <input type = 'text' name = 'cate_description[]' id = 'cate_description_id0'>
                        </div>
                        
                        <div class = 'edit_menu_buttons'>
                            <input type = 'button' value = 'add dish' onclick = 'my_add_dish(this.id);' id = 'add_dish_button_id0'>
                            <input type = 'button' value = 'remove dish' onclick = 'my_remove_dish(this.id);' id = 'remove_dish_button_id0'>
                        </div>
<table id = 'dish_table_id0'>
    <tbody>
        <tr>
            <td><input type = 'checkbox' name = 'chk[]'></td>
            <td>
                <label for = 'dish_name'>dish name:</label>
                <input type = 'text' name='cate0_dish_name[]' class='dish_name'>
            </td>
            <td>
                <label for = 'dish_price'>price:</label>
                <input type = 'text' name='cate0_dish_price[]' class='price'>
            </td>
        </tr>
    </tbody>
</table>
                        </div>
                            <input type='submit' value = 'submit' id = 'menu_submit' style = 'position: absolute; left: -9999px'>
                        </form>
                    
                </article>
            </article>
        </section>
    </div>
    <div id = 'personal_info' style = 'display: none;'>
<?php
include './user_edit_db.php';
?>
    </div>
    <script src = './user_edit.js'></script>
<?php
include './owner_update.php';
?>
    <div id = 'my_rest_info' style = 'display: none;'>
<?php
include './edit_restaurant_db.php';
?>
    </div>
    <script scr = 'http://code.jquery.com/jquery-latest.min.js'></script>
<?php
include './menu_upload.php';
?>
<?php
include './img_upload.php';
?>
</body>
</html>