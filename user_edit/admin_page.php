<?php
session_start();
$_SESSION['page'] = 'admin_page';
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
                <form method="post" action="../restaurants/restaurant_list.php">
                    <input type = "text" name = "search_cont" placeholder = "Search...">
                </form>
            </aside>
        </header>
        <div class = "content_wrapper_admin">
            <div id = 'admin_warning'><br></div>
            <h3>Customers</h3>
                <table id = 'cus_table' align = 'center' style = 'margin: 0px auto; border-collapse:collapse; border: 1px solid #aaa' border = 1>
                    <tr>
                        <th>id</th>
                        <th>user name</th>
                        <th>email</th>
                        <th>password</th>
                        <th>phone</th>
                        <th>street address</th>
                        <th>city</th>
                        <th>state</th>
                        <th>zip code</th>
                    </tr>
<?php
$sql_get_cus = 'SELECT * FROM user, normal_user where user.id = normal_user.id;';
$link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
$sql_result = mysqli_query($link, $sql_get_cus) or die ('Query failed! '.mysql_error());

while($row = mysqli_fetch_array($sql_result))
{
    echo "<tr>";
    echo '<td>'.$row['id'].'</td>';
    echo '<td>'.$row['user_name'].'</td>';
    echo '<td>'.$row['email'].'</td>';
    echo '<td id = "change_cus_psw_'.$row['id'].'"><a href="#!" class = "cus_change_psw">Change</a></td>';
    echo '<td>'.$row['phone'].'</td>';
    echo '<td>'.$row['st_address'].'</td>';
    echo '<td>'.$row['city'].'</td>';
    echo '<td>'.$row['state'].'</td>';
    echo '<td>'.$row['zip_code'].'</td>';
    echo "</tr>";
}

?>
                </table>
            <hr>
            <h3>Shop owners</h3>
                <table id = 'owner_table' align = 'center' style = 'margin: 0px auto; border-collapse:collapse; border: 1px solid #aaa' border = 1>
                    <tr>
                        <th>id</th>
                        <th>user_name</th>
                        <th>email</th>
                        <th>password</th>
                        <th>first name</th>
                        <th>last name</th>
                        <th>phone</th>
                        <th>street address</th>
                        <th>city</th>
                        <th>state</th>
                        <th>zip code</th>
                    </tr>
<?php
$sql_get_owner = 'SELECT * FROM user, shop_owner where user.id = shop_owner.id;';
$link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
$sql_result = mysqli_query($link, $sql_get_owner) or die ('Query failed! '.mysql_error());

while($row = mysqli_fetch_array($sql_result))
{
    echo "<tr>";
    echo '<td>'.$row['id'].'</td>';
    echo '<td>'.$row['user_name'].'</td>';
    echo '<td>'.$row['email'].'</td>';
    echo '<td id = "change_owner_psw_'.$row['id'].'"><a href="#!" class = "owner_change_psw">Change</a></td>';
    echo '<td>'.$row['fname'].'</td>';
    echo '<td>'.$row['lname'].'</td>';
    echo '<td>'.$row['phone'].'</td>';
    echo '<td>'.$row['st_address'].'</td>';
    echo '<td>'.$row['city'].'</td>';
    echo '<td>'.$row['state'].'</td>';
    echo '<td>'.$row['zip_code'].'</td>';
    echo "</tr>";
}

?>
                </table>
            <hr>
            <h3>Restaurants</h3>
                <table id = 'restaurant_table' align = 'center' style = 'margin: 0px auto; border-collapse:collapse; border: 1px solid #aaa' border = 1>
                    <th>id</th>
                    <th>phone</th>
                    <th>name</th>
                    <th>rating</th>
                    <th>created_time</th>
                    <th>description</th>
                    <th>category</th>
                    <th>street address</th>
                    <th>city</th>
                    <th>state</th>
                    <th>zipcode</th>
                    <th>approve</th>
<?php
$sql_get_shop = 'SELECT * FROM shop_info;';
$link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
$sql_result = mysqli_query($link, $sql_get_shop) or die ('Query failed! '.mysql_error());

while($row = mysqli_fetch_array($sql_result))
{
    echo "<tr>";
    echo '<td>'.$row['id'].'</td>';
    echo '<td>'.$row['shop_phone'].'</td>';
    echo '<td>'.$row['shop_name'].'</td>';
    echo '<td>'.$row['rating'].'</td>';
    echo '<td>'.$row['created_time'].'</td>';
    echo '<td>'.$row['description'].'</td>';
    echo '<td>'.$row['category'].'</td>';
    echo '<td>'.$row['straddr'].'</td>';
    echo '<td>'.$row['city'].'</td>';
    echo '<td>'.$row['state'].'</td>';
    echo '<td>'.$row['zipcode'].'</td>';
    if($row['approve_status'] == 'y')
    {
        echo '<td><a href="./admin_page.php?approved=y&id='.$row['id'].'">Suspend</a></td>';
    }
    else
    {
        echo '<td><a href="./admin_page.php?approved=n&id='.$row['id'].'">Approve</a></td>';
    }
    echo "</tr>";
}

?>
                </table>
        </div>
    </div>
    <script src = './admin_page.js'></script>
    
<div style = 'display: none;'>
<?php
include './admin_form_handler.php';
?>
</div>
</body>
</html>