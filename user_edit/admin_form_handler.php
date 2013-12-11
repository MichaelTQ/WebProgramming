<?php
if(isset($_GET['approved']))
{
    $id = $_GET['id'];
    if($_GET['approved'] == 'n')
    {
        //to approve a restaurant.
        $sql_approve = 'update shop_info set approve_status = "y" where id = \''.$id.'\';';
        $link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
        $sql_result = mysqli_query($link, $sql_approve) or die ('Query failed! '.mysql_error());

    }
    else if($_GET['approved'] == 'y')
    {
        //to suspend a restaurant.
        $sql_suspend = 'update shop_info set approve_status = "n" where id = \''.$id.'\';';
        $link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
        $sql_result = mysqli_query($link, $sql_suspend) or die ('Query failed! '.mysql_error());
    }
    echo "<script>location.replace('./admin_page.php');</script>";
    mysqli_close($link);
}

if(isset($_POST['change_psw_cus']))
{
    $id = $_POST['id'];
    $passwd = $_POST['change_psw_cus'];
    $passwd = SHA1($passwd);
    
    $sql_change_cus_psw = 'update user set passwd = \''.$passwd.'\' where id = \''.$id.'\';';
    $link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
    $sql_result = mysqli_query($link, $sql_change_cus_psw);
    
    echo "<script>$('#admin_warning').html('Password of id: ".$id." is successfully changed!');</script>";
    mysqli_close($link);
}

if(isset($_POST['change_psw_owner']))
{
    $id = $_POST['id'];
    $passwd = $_POST['change_psw_owner'];
    $passwd = SHA1($passwd);
    
    $sql_change_owner_psw = 'update user set passwd = \''.$passwd.'\' where id = \''.$id.'\';';
    
    $link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
    $sql_result = mysqli_query($link, $sql_change_owner_psw);
    
    echo "<script>$('#admin_warning').html('Password of id: ".$id." is successfully changed!');</script>";
    mysqli_close($link);
}
?>