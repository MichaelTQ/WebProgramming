<?php
session_start();
$_SESSION['page'] = 'restaurant_page';

if(isset($_GET['id']) == true and $_GET['id'] != '')
{
    //check id;
    $rest_id = $_GET['id'];
    $sql_get_rest = 'select * from shop_info where id = \''.$_GET['id'].'\' and approve_status = "y";';
    $link = $link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
    $sql_result = mysqli_query($link, $sql_get_rest) or die ('Query failed! '.mysql_error());
    if(mysqli_num_rows($sql_result) >= 1)
    {
        $_SESSION['rest_id'] = $rest_id;
    }
    else
    {
        die('wrong url');
    }
}
else
{
    die('wrong url');
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>DeliveryGuys|Mr Wraps</title>
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
                
                <form method="post" id = "search_form_id" action = "./restaurant_list.php">
                    <input type = "text" name = "search_cont" placeholder = "Search...">
                </form>
            </aside>
        </header>
        <div class = "content_wrapper">
            <div class = "left_all">
                <section class = "restaurant_info">
<?php
include 'display_rest.php';
?>
                </section>
                <section id = "tabs_wrapper">
                    <ul id = "tabs">
                        <li><a href = "#!" name = "tab1">menu</a></li>
                        <li><a href = "#!" name = "tab2">pictures</a></li>
                        <li><a href = "#!" name = "tab3">reviews</a></li>
                    </ul>
                    
                    <section id = "content">
                        <div id = "tab1">
                            <article class = "rest_menu">
<?php
include 'display_rest_menu.php';
?>
                            </article>
                        </div>
                        <div id = "tab2" style = "display: none;">
<?php
include 'display_imgs.php';
?>
                        </div>
                        <div id = "tab3" style = "display: none;">
<?php
include 'show_reviews.php';
?>
                        </div>
                    </section>
                </section>
            </div>        
            
            <div class = "right_all">
                <aside id = "right_side">
                    <div id="map-canvas"></div>
                    <section id = "order_details">
                        Your order:<br><br>
                        <span style = "color: grey;" id = "order_content_table">
                            Click <a href = "#!" onclick = "click_addlinks()">Here</a> to start.
                        <br><br></span>
                            <table class="table_css_class" id = "order_table_id" style = "display: none;">
                                <thead>
                                <tr>
                                <th>Dish Name</th>
                                <th>Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                <td><strong>Totol Price:</strong></td>
                                <td><strong>$</strong></td>
                                </tr>
                                </tbody>
                            </table>
                        <form method = "post" class = "order_buttons" style = "display: none;">
                            <p class = "form_buttons">
                                <input type = "reset" onclick = "cancel_order()" value = "Cancel">
                                <input type = "submit" value = "Submit">
                            </p>
                        </form>
                    </section>
                </aside>
            </div>
        </div>
        <div id = "signup_login">
        </div>
    </div>
    
    <div id = "fade" style = "display: none;" onclick = "signup_hide()"></div>
    <div id = "pic_preview" style = "display: none;">
        <img alt = "preview" id = "preview_picture" src = "">
    </div>
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
        <div style = "display: none;" id = "my_menu_num">1</div>
    <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src = "./rest_pages.js"></script>
    <script src = "../index.js"></script>
<?php
include '../user_db/login_signup.php'
?>
<?php
include './owner_img_upload.php';
?>
</body>
</html>