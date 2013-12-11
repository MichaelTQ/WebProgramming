<?php
if (isset($_POST['login_uname_email']) == TRUE)
{
    $uname_or_email = $_POST['login_uname_email'];
    $passwd = $_POST['login_psw'];
    $uname_or_email = addslashes($uname_or_email);
    $passwd = SHA1($passwd);
    $passwd = addslashes($passwd);
    
    $uname_or_email = trim($uname_or_email);
    
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
            $_SESSION['uname'] = $tmp_username;
            
            $sql_checkprivilege = 'SELECT * FROM user, admin_user where user_name = \''.$tmp_username.'\' and user.id = admin_user.id;';
            $sql_result = mysql_query($sql_checkprivilege) or die('Query failed'.mysql_error());
            if(mysql_num_rows($sql_result) >= 1)
            {
                $_SESSION['privilege'] = 'admin';
            }
            else
            {
                $sql_checkprivilege = 'SELECT * FROM user, normal_user where user_name = \''.$tmp_username.'\' and user.id = normal_user.id;';
                $sql_result = mysql_query($sql_checkprivilege) or die('Query failed'.mysql_error());
                if(mysql_num_rows($sql_result) >= 1)
                {
                    $_SESSION['privilege'] = 'customer';
                }
                else
                {
                    $_SESSION['privilege'] = 'owner';
                }
            }
            
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
        
        $_SESSION['uname'] = $uname_or_email;
            
        $sql_checkprivilege = 'SELECT * FROM user, admin_user where user_name = \''.$uname_or_email.'\' and user.id = admin_user.id;';
        $sql_result = mysql_query($sql_checkprivilege) or die('Query failed'.mysql_error());
        if(mysql_num_rows($sql_result) >= 1)
        {
            $_SESSION['privilege'] = 'admin';
        }
        else
        {
            $sql_checkprivilege = 'SELECT * FROM user, normal_user where user_name = \''.$uname_or_email.'\' and user.id = normal_user.id;';
            $sql_result = mysql_query($sql_checkprivilege) or die('Query failed'.mysql_error());
            if(mysql_num_rows($sql_result) >= 1)
            {
                $_SESSION['privilege'] = 'customer';
            }
            else
            {
                $_SESSION['privilege'] = 'owner';
            }
        }
    }
    mysql_close();
}

if(isset($_POST['cus_signup_uname']) == TRUE)
{
    if(isset($_POST['cus_signup_email'])!= TRUE || isset($_POST['cus_signup_psw']) != TRUE
      || isset($_POST['cus_confirm_psw'])!= TRUE)
    {
        echo '<script>';
        echo 'alert(\'Form not complete!\')';
        echo '</script>';
    }
    $uname = $_POST['cus_signup_uname'];
    $email = $_POST['cus_signup_email'];
    $passwd = $_POST['cus_signup_psw'];
    
    $uname = addslashes($uname);
    $email = addslashes($email);
    $passwd = SHA1($passwd);
    $passwd = addslashes($passwd);
    
    $uname = trim($uname);
    $email = trim($email);
    
    $sqlcheck = 'SELECT * FROM USER WHERE user_name = \''.$uname.'\';';
    $link = mysql_connect('localhost', 'web_user', 'webwebweb') or die('Cannot connect to DB!');
    mysql_select_db('web_final_db') or die('Cannot select DB!');
    $sql_result = mysql_query($sqlcheck) or die('Query failed!'.mysql_error());
    if(mysql_num_rows($sql_result) < 1)
    {
        $sqlcheck = 'SELECT * FROM USER WHERE email = \''.$email.'\';';
        $sql_result2 = mysql_query($sqlcheck) or die('Query failed!'.mysql_error());
        if(mysql_num_rows($sql_result2) < 1)
        {
            $sqlinsert = 'INSERT INTO USER(user_name, email, passwd) VALUES 
                (\''.$uname.'\', \''.$email.'\', \''.$passwd.'\');';
            mysql_query($sqlinsert) or die('Query failed!'.mysql_error());
            $sql_getID = 'SELECT ID FROM USER WHERE email = \''.$email.'\';';
            $sql_results3 = mysql_query($sql_getID) or die('Query failed!'.mysql_error());
            $id = '';
            while ($row = mysql_fetch_assoc($sql_results3))
            {
                 $id = $row['ID'];
            }
            $sql_insertCus = 'INSERT INTO normal_user(id) values(\''.$id.'\')';
            mysql_query($sql_insertCus) or die('Query failed!'.mysql_error());
            
            echo '<script>';
            echo 'signup_success(\''.$uname.'\');';
            echo '</script>';
            
            $_SESSION['uname'] = $uname;
            $_SESSION['privilege'] = 'customer';
        }
        else
        {
            echo "<script>";
            echo "cus_signup_error('This email has been registered!');";
            echo "</script>";
        }
    }
    else
    {
        echo "<script>";
        echo "cus_signup_error('This username has been registered!');";
        echo "</script>";
    }

    //echo "<hr>\n".$uname."<br>\n".$email."<br>\n".$passwd."<hr>\n";
}

if(isset($_POST['owner_signup_uname']) == TRUE)
{
    $uname = $_POST['owner_signup_uname'];
    $email = $_POST['owner_signup_email'];
    $passwd = $_POST['owner_signup_psw'];
    $fname = $_POST['owner_signup_fname'];
    $lname = $_POST['owner_signup_lname'];
    $tel = $_POST['owner_signup_phone'];
    $straddr = $_POST['owner_signup_straddr'];
    $city = $_POST['owner_signup_city'];
    $zcode = $_POST['owner_signup_zcode'];
    $state = $_POST['owner_signup_state'];
    
    $uname = addslashes($uname);
    $unmae = trim($uname);
    $email = addslashes($email);
    $email = trim($email);
    $passwd = SHA1($passwd);
    $passwd = addslashes($passwd);
    $fname = addslashes($fname);
    $fname = trim($fname);
    $lname = addslashes($lname);
    $lname = trim($lname);
    $tel = addslashes($tel);
    $tel = trim($tel);
    $straddr = addslashes($straddr);
    $straddr = trim($straddr);
    $city = addslashes($city);
    $city = trim($city);
    $zcode = addslashes($zcode);
    $zcode = trim($zcode);
    $state = addslashes($state);
    $state = trim($state);
    
    
    $sqlcheck = 'SELECT * FROM USER WHERE user_name = \''.$uname.'\';';
    $link = mysql_connect('localhost', 'web_user', 'webwebweb') or die('Cannot connect to DB!');
    mysql_select_db('web_final_db') or die('Cannot select DB!');
    $sql_result = mysql_query($sqlcheck) or die('Query failed!'.mysql_error());
    if(mysql_num_rows($sql_result) < 1)
    {
        $sqlcheck = 'SELECT * FROM USER WHERE email = \''.$email.'\';';
        $sql_result2 = mysql_query($sqlcheck) or die('Query failed!'.mysql_error());
        if(mysql_num_rows($sql_result2) < 1)
        {
            $sqlinsert = 'INSERT INTO USER(user_name, email, passwd) VALUES 
                (\''.$uname.'\', \''.$email.'\', \''.$passwd.'\');';
            mysql_query($sqlinsert) or die('Query failed!'.mysql_error());
            $sql_getID = 'SELECT ID FROM USER WHERE email = \''.$email.'\';';
            $sql_results3 = mysql_query($sql_getID) or die('Query failed!'.mysql_error());
            $id = '';
            while ($row = mysql_fetch_assoc($sql_results3))
            {
                 $id = $row['ID'];
            }
            
            
            $sql_insert_owner = 'INSERT INTO shop_owner VALUES(\''.$id.'\', \''.$tel.'\', \''.$straddr.'\', \''.$city.'\', \''.$state.'\', \''.$zcode.'\', \''.$fname.'\', \''.$lname.'\');';
            mysql_query($sql_insert_owner) or die('Query failed!'.mysql_error());
            
            echo '<script>';
            echo 'signup_success(\''.$uname.'\');';
            echo '</script>';
            
            $_SESSION['uname'] = $uname;
            $_SESSION['privilege'] = 'owner';
        }
        else
        {
            echo "<script>";
            echo "owner_signup_error('This email has been registered!');";
            echo "</script>";
        }
    }
    else
    {
        echo "<script>";
        echo "owner_signup_error('This username has been registered!');";
        echo "</script>";
    }
    
    //echo '<hr>'.$uname.'<br>'.$email.'<br>'.$passwd.'<br>'.$fname.'<br>'.$lname.'<br>'.$tel.'<br>'.$straddr.'<br>'.$city.'<br>'.$zcode.'<br>'.$state.'<hr>';
}
?>