<?php
if(isset($_SESSION['privilege']) && $_SESSION['privilege'] == 'owner')
{
    $uname = $_SESSION['uname'];
    $sql_getinfo = 'SELECT * FROM user, shop_owner where user.user_name = \''.$uname.'\' and user.id = shop_owner.id;';
    $link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
    $sql_result = mysqli_query($link, $sql_getinfo) or die('Query failed!'.mysql_error());
    
    $uname = '';
    $email = '';
    $tel = '';
    $straddr = '';
    $city = '';
    $state = '';
    $zcode = '';
    $fname = '';
    $lname = '';
    
    $count = 0;
    while($row = mysqli_fetch_array($sql_result))
    {
        if ($count == 0)
        {
            $uname = $row['user_name'];
            echo "<div id = 'uname'>".$uname."</div>";
            $email = $row['email'];
            echo "<div id = 'email'>".$email."</div>";
            $tel = $row['phone'];
            echo "<div id = 'tel'>".$tel."</div>";
            $straddr = $row['st_address'];
            echo "<div id ='straddr'>".$straddr."</div>";
            $city = $row['city'];
            echo "<div id = 'city'>".$city."</div>";
            $state = $row['state'];
            echo "<div id = 'state'>".$state."</div>";
            $zcode = $row['zip_code'];
            echo "<div id = 'zcode'>".$zcode."</div>";
            $fname = $row['fname'];
            echo "<div id = 'fname'>".$fname."</div>";
            $lname = $row['lname'];
            echo "<div id = 'lname'>".$lname."</div>";
            $count++;
        }
        else
        {
            break;
        }
    }
    
    mysqli_close($link);
}
else if(isset($_SESSION['privilege']) && $_SESSION['privilege'] == 'customer')
{
    $uname = $_SESSION['uname'];
    $sql_getinfo = 'SELECT * FROM user, normal_user where user.user_name = \''.$uname.'\' and user.id = normal_user.id;';
    $link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
    $sql_result = mysqli_query($link, $sql_getinfo) or die('Query failed!'.mysql_error());
    
    $uname = '';
    $email = '';
    $tel = '';
    $straddr = '';
    $city = '';
    $state = '';
    $zcode = '';
    
    $count = 0;
    while($row = mysqli_fetch_array($sql_result))
    {
        if ($count == 0)
        {
            $uname = $row['user_name'];
            echo "<div id = 'uname'>".$uname."</div>";
            $email = $row['email'];
            echo "<div id = 'email'>".$email."</div>";
            $tel = $row['phone'];
            echo "<div id = 'tel'>".$tel."</div>";
            $straddr = $row['st_address'];
            echo "<div id ='straddr'>".$straddr."</div>";
            $city = $row['city'];
            echo "<div id = 'city'>".$city."</div>";
            $state = $row['state'];
            echo "<div id = 'state'>".$state."</div>";
            $zcode = $row['zip_code'];
            echo "<div id = 'zcode'>".$zcode."</div>";
            $count++;
        }
        else
        {
            break;
        }
    }
    
    mysqli_close($link);
}
?>