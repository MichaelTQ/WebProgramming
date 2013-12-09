<?php
if(isset($_POST['old_passwd']) && isset($_POST['new_passwd']) && isset($_POST['conf_passwd']))
{
    $old_passwd = $_POST['old_passwd'];
    $new_passwd = $_POST['new_passwd'];
    $conf_passwd = $_POST['conf_passwd'];
    
    $old_passwd = SHA1($old_passwd);
    $new_passwd = SHA1($new_passwd);
    $conf_passwd = SHA1($conf_passwd);
    
    $uname = $_SESSION['uname'];
    $sql_checkpass = 'SELECT * FROM user WHERE user.user_name = \''.$uname.'\' and passwd = \''.$old_passwd.'\';';
    $link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
    $sql_result = mysqli_query($link, $sql_checkpass) or die ('Query failed!'.mysql_error());
    if(mysqli_num_rows($sql_result) >= 1)
    {
        $sql_passchange = 'UPDATE user SET passwd = \''.$new_passwd.'\' WHERE user_name = \''.$uname.'\';';
        $sql_result = mysqli_query($link, $sql_passchange) or die('Query failed'.mysql_error());
        
        echo "<script>passwsChanged();</script>";
    }
    else
    {
        echo "<script>passwdWrong();</script>";
    }
    mysqli_close($link);
}

if(isset($_POST['uname']) && isset($_POST['email']) && isset($_POST['fname'])
    && isset($_POST['lname']) && isset($_POST['tel']) && isset($_POST['straddr'])
    && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['zcode']))
{
    $uname_old = $_SESSION['uname'];
    $uname = $_POST['uname'];
    $uname = addslashes($uname);
    $uname = trim($uname);
    $email = $_POST['email'];
    $email = addslashes($email);
    $email = trim($email);
    $fname = $_POST['fname'];
    $fname = addslashes($fname);
    $fname = trim($fname);
    $lname = $_POST['lname'];
    $lname = addslashes($lname);
    $lname = trim($lname);
    $tel = $_POST['tel'];
    $tel = addslashes($tel);
    $tel = trim($tel);
    $straddr = $_POST['straddr'];
    $straddr = addslashes($straddr);
    $straddr = trim($straddr);
    $city = $_POST['city'];
    $city = addslashes($city);
    $city = trim($city);
    $state = $_POST['state'];
    $state = addslashes($state);
    $state = trim($state);
    $zcode = $_POST['zcode'];
    $zcode = addslashes($zcode);
    $zcode = trim($zcode);
    
    $id = '';
    
    $sql_get_id = 'SELECT id FROM user WHERE user_name = \''.$uname_old.'\';';
    $link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
    $sql_result = mysqli_query($link, $sql_get_id) or die ('Query failed!'.mysql_error());
    while($row = mysqli_fetch_array($sql_result))
    {
        $id = $row['id'];
    }
    
    $sql_update_user = 'update user set user_name = \''.$uname.'\', email = \''.$email.'\' where id = \''.$id.'\';';
    $sql_update_owner = 'update shop_owner set phone = \''.$tel.'\', st_address = \''.$straddr.'\', city = \''.$city.'\', state = \''.$state.'\', zip_code = \''.$zcode.'\', fname = \''.$fname.'\', lname = \''.$lname.'\' where id = \''.$id.'\';';
    
    $sql_result1 = mysqli_query($link, $sql_update_user) or die ('Query failed!'.mysql_error());
    
    $_SESSION['uname'] = $uname;
    
    $sql_result2 = mysqli_query($link, $sql_update_owner) or die('Query failed!'.mysql_error());
    
    echo "<script>my_pinfo_changed();</script>";
    echo "<script>setInterval(function(){location.reload();}, 2000)</script>";
    
    mysqli_close($link);
}
?>