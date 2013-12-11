<?php
session_start();
$_SESSION['page'] = 'cus_edit';
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
                <form method="post" action = "../restaurants/restaurant_list.php" id ="search_form_id">
                    <input type = "text" name = "search_cont" placeholder = "Search...">
                </form>
            </aside>
        </header>
        <div class = "content_wrapper">
            <form name = 'update_cus_info' action = './cus_edit.php' method = 'post' onsubmit = 'return myPInfoUpdate();' id = 'left_form_cus'>
                <span class = 'myTitle'>Your infomation:</span>
                <span id = 'click_to_edit'> Click <a href = './cus_edit.php#!' onclick = 'myEnableInputs();'>HERE</a> to edit.</span>
                <div id = 'personal_info_warning'><br></div>
                <label for = 'uname'>username:</label>
                <input type = 'text' name = 'uname' disabled value = '' id = 'uname_id' onblur = 'myValidateUname(this.id, "personal_info_warning");'><br>
                <label for = 'email'>email:</label>
                <input type = 'email' name = 'email' disabled id = 'email_id' onblur = 'myValidateEmail(this.id, "personal_info_warning");'><br>
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
            <form name = 'reset_password' action = './cus_edit.php' method = 'post' onsubmit = 'return myPasswordValidate();' id = 'right_form'>
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
    </div>
    <div id = 'personal_info' style = 'display: none;'>
<?php
include './user_edit_db.php';
?>
    </div>
    <script src = './user_edit.js'></script>
<?php
include './cus_update.php';
?>
</body>
</html>