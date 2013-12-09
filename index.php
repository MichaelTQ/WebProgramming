<?php
session_start();
$_SESSION['page'] = 'index';
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Welcome to DeliveryGuys!</title>
    <link rel = "stylesheet" type = "text/css" href = "./sign_up/sign_up.css">
    <link rel = "stylesheet" type = "text/css" href = "./index.css">
</head>
<body>
    <section id = "signup_login_links">
        Hello, 
<?php
include './user_db/login_display.php';
?>
    </section>
    <br>
    <section class = "search_form">
        <!-- <h1>DeliveryGuys!</h1> -->
        <a href = './index.php'>
            <img src = "./icons/web_logo.png" alt = 'logo'>
        </a>
        <form method="post" action = "./restaurants/restaurant_list.php" id = "index_search_form" onsubmit = "return myValidation();">
            <input type = "text" name = "search_cont" placeholder = "Search...">
        </form>
    </section>
        <div id = "fade" style = "display: none;" onclick = "signup_hide()"></div>
        <div id = "login" style = "display: none;">
            <form method = "post" name = 'login_form' onsubmit = 'return login_validate();'>
                <h2>Login</h2>
                <p id = 'login_warning'>User name or Password cannot be empty!</p>
                <input type = "text" name = "login_uname_email" placeholder = "Username or Email"><br>
                <input type = "password" name = "login_psw" placeholder = "Password"><br>
                <p class = "form_buttons">
                    <input type = "reset" onclick = "signup_hide()" value = "Cancel">
                    <input type = "submit" value = "Login">
                </p>
            </form>
        </div>
        <div id = 'login_success' style = 'display: none;'>
            <p>Login Success!
            </p>
            <span id = 'my_timer'>3...</span>
        </div>
        <div id = "signup_all" style = "display: none;">
            <!-- <h1 id = "signup_h1">Sign Up</h1> -->
            <ul class = "tabrow">
                <li id = "signup_tab1" class = "selected" onclick = "tab_switch(this.id);">Customers</li>
                <li id = "signup_tab2" onclick = "tab_switch(this.id);">Shop Owners</li>
            </ul>
            <section id = "cus_form" class = "selected" style = "display: inline;">
                <form method="post" name = 'cus_signup_form' onsubmit = 'return signup_cus_validate();'>
                    <p>
                        <div id = 'cus_signup_warning'>Blank</div>
                        <input type = "text" name = "cus_signup_uname" placeholder = "Username" onblur = 'myValidateUname(this.id);' id = 'cus_uname_id'><br>
                        <input type = "email" name = "cus_signup_email" placeholder = "Email" onblur = 'myValidateEmail(this.id);' id = 'cus_email_id'><br>
                        <input type = "password" name = "cus_signup_psw" placeholder = "Password"><br>
                        <input type = "password" name = "cus_confirm_psw" placeholder = "Comfirm Password"><br>
                        <p class = "form_buttons">
                            <input type = "reset" value = "Reset">
                            <input type = "submit" value = "Sign up">
                        </p>
                    </p>
                </form>
            </section>
            <section id = "owners_form" style = "display: none;">
                <form method = "post" name = 'owner_signup_form' onsubmit = 'return signup_owner_validate();'>
                    <div id = 'owner_signup_warning'>Blank</div>
                    <p id = "owners_left">
                        <input type = "text" name = "owner_signup_uname" placeholder = "Username" onblur = 'myValidateUname(this.id);' id = 'owner_uname_id'><br>
                        <input type = "email" name = "owner_signup_email" placeholder = "Email" onblur = 'myValidateEmail(this.id);' id = 'owner_email_id'><br>
                        <input type = "password" name = "owner_signup_psw" placeholder = "Password"><br>
                        <input type = "password" name = "owner_comfirm_psw" placeholder = "Comfirm Password"><br>
                        <input type = "text" name = "owner_signup_fname" placeholder = "First Name" onblur = 'myTagsValidate(this.id);' id = 'owner_fname_id'><br>
                        <input type = "text" name = "owner_signup_lname" placeholder = "Last Name" onblur = 'myTagsValidate(this.id);' id = 'owner_lname_id'><br>
                        <input type = "tel" name = "owner_signup_phone" placeholder = "Telephone(10 Digits)" onblur = 'myTelValidate(this.id)' id = 'owner_tel_id'><br>
                    </p>
                    <p id = "owners_right">
                        <input type = "text" name = "owner_signup_straddr" placeholder = "Street Address" onblur = 'myTagsValidate(this.id);' id = 'owner_staddr_id'><br>
                        <input type = "text" name = "owner_signup_city" placeholder = "City" onblur = 'myTagsValidate(this.id);' id = 'owner_city_id'><br>
                        <select id = "states_sel" name = 'owner_signup_state'>
                        </select><br>
                        <input type = "text" name = "owner_signup_zcode" placeholder = "Zip-Code" onblur = 'myZCodeValidate(this.id);' id = 'owner_zcode_id'><br>
                        <p class = "form_buttons">
                            <input type = "reset" value = "Reset">
                            <input type = "submit" value = "Sign up">
                        </p>
                    </p>
                </form>
            </section>
        </div>
    <script src = "./sign_up/sign_up.js"></script>
    <script src = "./index.js"></script>
<?php
include './user_db/login_signup.php';
?>
</body>
</html>