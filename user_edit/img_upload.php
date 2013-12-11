<?php

if(isset($_FILES["rest_icon_file"]) && $_FILES["rest_icon_file"]['name'] != '')
{
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["rest_icon_file"]["name"]);
    $extension = end($temp);
    if ((($_FILES["rest_icon_file"]["type"] == "image/gif")
    || ($_FILES["rest_icon_file"]["type"] == "image/jpeg")
    || ($_FILES["rest_icon_file"]["type"] == "image/jpg")
    || ($_FILES["rest_icon_file"]["type"] == "image/pjpeg")
    || ($_FILES["rest_icon_file"]["type"] == "image/x-png")
    || ($_FILES["rest_icon_file"]["type"] == "image/png"))
    && ($_FILES["rest_icon_file"]["size"] < 2000000)
    && in_array(strtolower($extension), $allowedExts))
    {
        
        for($i = 0; $i != count($allowedExts); $i++)
        {
            if(file_exists('../restaurants/'.$rest_id.'/icon.'.$allowedExts[$i]))
            {
                $icon_dir = '../restaurants/'.$rest_id.'/icon.'.$allowedExts[$i];
                unlink($icon_dir);
            }
        }
        
        $uname = $_SESSION['uname'];
        $sql_check_rest_exists = 'SELECT * FROM user, own_shop where user.user_name = \''.$uname.'\' and user.id = own_shop.user_id;';
        $link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
        $sql_result = mysqli_query($link, $sql_check_rest_exists) or die ('Query failed! '.mysql_error());
        if(mysqli_num_rows($sql_result) >= 1)
        {
            while($row = mysqli_fetch_array($sql_result))
            {
                $rest_id = $row['shop_id'];
                $_SESSION['rest_id'] = $rest_id;
            }
            
            $sql_update_icon_url = 'update shop_info set icon_url= \'\' where id = \''.$rest_id.'\';';
            $sql_result = mysqli_query($link, $sql_update_icon_url);
            
            move_uploaded_file($_FILES["rest_icon_file"]["tmp_name"],
		      "../restaurants/".$rest_id."/icon.".strtolower($extension));
            
            echo "<script>location.reload();</script>";
            
        }
        else
        {
            echo "<script>$('#rest_img_warning').html('edit restaurant info first!');</script>";
        }
    }
    else
    {
        echo "<script>$('#rest_img_warning').html('invalid image!');</script>";
    }
}

else if(isset($_POST['rest_icon_url']) && $_POST['rest_icon_url']!='')
{
    $url = strval($_POST['rest_icon_url']);
    if(exists($url) != false)
    {
        $uname = $_SESSION['uname'];
        $sql_check_rest_exists = 'SELECT * FROM user, own_shop where user.user_name = \''.$uname.'\' and user.id = own_shop.user_id;';
        $link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
        $sql_result = mysqli_query($link, $sql_check_rest_exists) or die ('Query failed! '.mysql_error());
        if(mysqli_num_rows($sql_result) >= 1)
        {
            while($row = mysqli_fetch_array($sql_result))
            {
                $rest_id = $row['shop_id'];
                $_SESSION['rest_id'] = $rest_id;
            }
            
            $sql_update_icon_url = 'update shop_info set icon_url= \''.$url.'\' where id = \''.$rest_id.'\';';
            $sql_result = mysqli_query($link, $sql_update_icon_url);
            
            echo "<script>location.reload();</script>";
        }
        else
        {
            echo "<script>$('#rest_img_warning').html('edit restaurant info first!');</script>";
        }
    }
    else
    {
        echo "<script>$('#rest_img_warning').html('invalid image!');</script>";
    }
}

function exists($uri)
{
    $ch = curl_init($uri);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $code == 200;
}
?>