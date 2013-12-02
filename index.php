<!DOCTYPE HTML>
<html>
<head>
    <title>Welcome to DeliveryGuys!</title>
    <link rel = "stylesheet" type = "text/css" href = "./sign_up/sign_up.css">
    <link rel = "stylesheet" type = "text/css" href = "./index.css">
</head>
<body>
    <section id = "signup_login_links">
        Hello, <span id = 'username_upright'>guest!
        <a href = "#sign_up" onclick = "signup_popup()">Sign Up</a>
        <a href = "#login" onclick = "login_popup()">Log In</a></span>
    </section>
    <br>
    <section class = "search_form">
        <!-- <h1>DeliveryGuys!</h1> -->
        <img src = "./icons/web_logo.png">
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
                <li id = "tab1" class = "selected" onclick = "tab_switch(this.id);">Customers</li>
                <li id = "tab2" onclick = "tab_switch(this.id);">Shop Owners</li>
            </ul>
            <section id = "cus_form" style = "display: none;">
                <form method="post" action="./restaurants/restaurant_list.html" onsubmit = 'return cus_validation()'>
                    <p>
                        <input type = "text" name = "signup_uname" placeholder = "Username"><br>
                        <input type = "email" name = "signup_email" placeholder = "Email"><br>
                        <input type = "password" name = "signup_psw" placeholder = "Password"><br>
                        <input type = "password" name = "confirm_psw" placeholder = "Comfirm Password"><br>
                        <p class = "form_buttons">
                            <input type = "reset" value = "Reset">
                            <input type = "submit" value = "Sign up">
                        </p>
                    </p>
                </form>
            </section>
            <section id = "owners_form" style = "display: none;">
                <form method = "post" onsubmit = 'return owner_validate()'>
                    <p id = "owners_left">
                        <input type = "text" name = "signup_uname" placeholder = "Username"><br>
                        <input type = "email" name = "signup_email" placeholder = "Email"><br>
                        <input type = "password" name = "signup_psw" placeholder = "Password"><br>
                        <input type = "password" name = "comfirm_psw" placeholder = "Comfirm Password"><br>
                        <input type = "text" name = "signup_fname" placeholder = "First Name"><br>
                        <input type = "text" name = "signup_lname" placeholder = "Last Name"><br>
                        <input type = "tel" name = "signup_phone" placeholder = "Telephone"><br>
                    </p>
                    <p id = "owners_right">
                        <input type = "text" name = "signup_straddr" placeholder = "Street Address"><br>
                        <input type = "text" name = "signup_city" placeholder = "City"><br>
                        <select id = "states_sel">
                        </select><br>
                        <input type = "text" name = "signup_zcode" placeholder = "Zip-Code"><br>
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
if (isset($_POST['login_uname_email']) == TRUE)
{
    $uname_or_email = $_POST['login_uname_email'];
    $passwd = $_POST['login_psw'];
    $uname_or_email = addslashes($uname_or_email);
    $passwd = SHA1($passwd);
    $passwd = addslashes($passwd);
    
    $sql_tmp = 'SELECT * FROM USER WHERE user_name = \''.$uname_or_email.'\' AND passwd = \''.$passwd.'\';';
    $link = mysql_connect('localhost', 'web_user', 'webwebweb') or die('Cannot connect to DB!');
    mysql_select_db('web_final_db') or die('Cannot select DB!');
    $sql_result = mysql_query($sql_tmp) or die('Query failed!'.mysql_error());
    if (mysql_num_rows($sql_result) != 1)
    {
        $sql_tmp2 = 'SELECT * FROM USER WHERE email = \''.$uname_or_email.'\' AND passwd = \''.$passwd.'\';';
        $sql_result = mysql_query($sql_tmp2) or die('Query failed!'.mysql_error());
        if (mysql_num_rows($sql_result) == 1)
        {
            $tmp_username = '';
            while ($row = mysql_fetch_assoc($sql_result)) {
                 $tmp_username = $row['user_name'];
            }
            // Success!
            echo '<script>';
            echo 'login_success(\''.$tmp_username.'\');';
            echo '</script>';
        }
        else
        {
            //Fail!
            echo '<script>';
            echo 'login_popup();';
            echo 'login_fail();';
            echo '</script>';
        }
    }
    else
    {
        //Success!
        echo '<script>';
        echo 'login_success(\''.$uname_or_email.'\');';
        echo '</script>';
    }
    mysql_close();
}
?>
</body>
</html>