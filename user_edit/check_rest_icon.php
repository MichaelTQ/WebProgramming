<?php
$allowedExts = array("gif", "jpeg", "jpg", "png");

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
    $flag = false;
    $icon_dir = '';
    for($i = 0; $i != count($allowedExts); $i++)
    {
        if(file_exists('../restaurants/'.$rest_id.'/icon.'.$allowedExts[$i]))
        {
            $icon_dir = '../restaurants/'.$rest_id.'/icon.'.$allowedExts[$i];
            $flag = true;
        }
    }
    if($flag == true)
    {
        echo '<div class="thumb" style="background-image: url(\''.$icon_dir.'\');"></div>';
    }
    else
    {
        $sql_get_icon_url = 'select icon_url from shop_info where id = \''.$rest_id.'\';';
        $sql_result = mysqli_query($link, $sql_get_icon_url);

        while($row = mysqli_fetch_array($sql_result))
        {
            $icon_url = $row['icon_url'];
        }
        if($icon_url != '')
        {
            echo '<div class="thumb" style="background-image: url(\''.$icon_url.'\');"></div>';
        }
        else
        {
            echo "<img src = '../restaurants/icons/no_photo.PNG' alt = 'restaurant image' width=\"150px\">";
        }
    }
}
else
{
    echo "<img src = '../restaurants/icons/no_photo.PNG' alt = 'restaurant image' width=\"150px\">";
}

?>