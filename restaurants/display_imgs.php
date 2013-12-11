<?php
$id = $_SESSION['rest_id'];
$pic_dir = './'.$id.'/pics';

if($handle = opendir($pic_dir))
{
    $arr_imgs = array();
    while (false !== ($entry = readdir($handle)))
    {
        if($entry == '.' or $entry == '..')
        {
            continue;
        }
        else 
        {
            $arr_tmp = explode('.', $entry);
            $arr_exts = array('png', 'jpeg', 'gif', 'jpg');
            if(in_array(strtolower(end($arr_tmp)), $arr_exts))
            {
                $full_dir = $pic_dir.'/'.$entry;
                array_push($arr_imgs, $full_dir);
            }
        }
    }
    if(count($arr_imgs)>0)
    {
        foreach($arr_imgs as $elem)
        {
            echo '<img class="thumbnail" src="'.$elem.'" height="140">';
        }
    }
    else
    {
        echo "<strong>no images</strong>";
    }

}
else
{
    echo "<strong>no images</strong>";
}

if(isset($_SESSION['privilege']))
{
    if($_SESSION['privilege'] == 'owner')
    {
        $uname = $_SESSION['uname'];
        $rest_id = $_SESSION['rest_id'];
        
        $sql_check_owner = 'select * from user, own_shop, shop_owner where user.id = shop_owner.id and own_shop.user_id = user.id and own_shop.shop_id = \''.$rest_id.'\' and user.user_name = \''.$uname.'\';';
        $link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
        $sql_result = mysqli_query($link, $sql_check_owner) or die ('Query failed! '.mysql_error());
        if(mysqli_num_rows($sql_result) >= 1)
        {
            echo "<hr>";
            echo '<form action="./restaurant.php?id='.$rest_id.'" method="post"
enctype="multipart/form-data">';
            echo '<label for="owner_img">upload img:</label>';
            echo '<input type="file" name="owner_img" id="file">';
            echo '<input type="submit" name="submit" value="Submit">';
            echo '</form>';
        }

    }
}
?>
