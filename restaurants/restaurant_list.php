<?php
session_start();
$_SESSION['page'] = 'results';
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>DeliveryGuys|Search result</title>
    <link rel = "stylesheet" type = "text/css" href = "./rest_pages.css">
    <link rel = "stylesheet" type = "text/css" href = "../sign_up/sign_up.css">
    <link rel = "stylesheet" type = "text/css" href = "../index.css">
    <link ref = "stylesheet" type = "text/css" href = "http://www.google.com/fonts#QuickUsePlace:quickUse/Family:Roboto+Condensed:300">
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false">
    </script>
    <script type = "text/javascript">

    </script>
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
                <form method="post">
                    <input type = "text" name = "search_cont" placeholder = "Search...">
                </form>
            </aside>
        </header>
        <div class = "content_wrapper">
            <div class = "left_all">
                <section class = "restaurant_info" style = "text-align: center;">
                    <h3>Results for: <em>
<?php
if(isset($_POST['search_cont']))
{
    echo $_POST['search_cont'];
}
?></em>
                    </h3>
                </section>
                <section class = "restaurant_list">
                    <section id = "rest_list">
                        <ul>
                        <li>
                            <a href = "./restaurant_1.html">
                            <article class = "chopped_img">
                                <img src="./rest_pics/rest_icons/1.JPG" width="100px">
                            </article>
                          <h3 class = "rest_title_list">Mr Wraps</h3>
                          <p class = "rest_address_list">741 Garden St, Hoboken NJ 07030</p>
                          <p class = "rest_tel">(201) 386-3200</p>
                            </a>
                        </li>
                           
                        <li>
                            <a href = "./restaurant_2.html">
                          <article class = "chopped_img">
                            <img src="./rest_pics/rest_icons/2.jpg" width="100px">
                        </article>
                          <h3 class = "rest_title_list">H&amp;S Giovanni's</h3>
                          <p class = "rest_address_list">603 Washington St, Hoboken NJ 07030</p>
                          <p class = "rest_tel">(201) 762-2568</p>
                            </a>
                        </li>
                        
                        <li>
                            <a href = "./restaurant_3.html">
                          <article class = "chopped_img">
                            <img src="./rest_pics/rest_icons/3.JPG" width="100px">
                        </article>
                          <h3 class = "rest_title_list">10th &amp; Willow</h3>
                          <p class = "rest_address_list">935 Willow Ave, Hoboken NJ 07030</p>
                          <p class = "rest_tel">(201) 653-2358</p>
                            </a>
                        </li>
                        
                        <li>
                            <a href = "./restaurant_4.html">
                          <article class = "chopped_img">
                            <img src="./rest_pics/rest_icons/4.jpg" width="100px">
                        </article>
                          <h3 class = "rest_title_list">Stacks Pancake House</h3>
                          <p class = "rest_address_list">506 Washington St, Hoboken NJ 07030</p>
                          <p class = "rest_tel">(201) 762-2567</p>
                            </a>
                        </li>
                        <li>
                            <a href = "./restaurant_5.html">
                          <article class = "chopped_img">
                            <img src="./rest_pics/rest_icons/5.jpg" width="100px">
                        </article>
                          <h3 class = "rest_title_list">Backyard Bistro</h3>
                          <p class = "rest_address_list">732 Jefferson St, Hoboken NJ 07030</p>
                          <p class = "rest_tel">(201) 222-2660</p>
                            </a>
                        </li>
                        </ul>
                        </section>
                </section>
            </div>        
            
            <div class = "right_all">
                <aside id = "right_side">
                    <div id="map-canvas"></div>
                </aside>
            </div>
        </div>
        <div id = "signup_login">
        </div>
    </div>
    
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
    <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src = "./rest_pages.js"></script>
    <script src = "../index.js"></script>
<?php
include '../user_db/login_signup.php';
?>
</body>
</html>