<?php
if(isset($_POST['search_cont']) && $_POST['search_cont'] != "")
{
    $search_cont = $_POST['search_cont'];
    $search_cont = addslashes($search_cont);
    $search_cont = strip_tags($search_cont);
    
    $sql_search_name = 'select * from shop_info where shop_name like \'%'.$search_cont.'%\' and  approve_status = \'y\';';
    $link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
    $sql_result = mysqli_query($link, $sql_search_name);
    
    $arr_all_results = array();
    
    if(mysqli_num_rows($sql_result) >= 1)
    {
        while($row = mysqli_fetch_array($sql_result))
        {
            $arr_rest = array();
            $tmp_rest_id = $row['id'];
            $tmp_rest_name = $row['shop_name'];
            $tmp_rest_straddr = $row['straddr'];
            $tmp_rest_city = $row['city'];
            $tmp_rest_state = $row['state'];
            $tmp_rest_zcode = $row['zipcode'];
            $tmp_rest_rating = $row['rating'];
            $tmp_rest_tel = $row['shop_phone'];
            $tmp_rest_icon_url = $row['icon_url'];
            $rest_tel_display = "(".substr($tmp_rest_tel, 0, 3).") ".substr($tmp_rest_tel, 3, 3)."-".substr($tmp_rest_tel, 6);
            $rest_address_display = $tmp_rest_straddr.", ".$tmp_rest_city." ".$tmp_rest_state." ".$tmp_rest_zcode;
            array_push($arr_rest, $tmp_rest_id);
            array_push($arr_rest, $tmp_rest_name);
            array_push($arr_rest, $tmp_rest_rating);
            array_push($arr_rest, $rest_address_display);
            array_push($arr_rest, $rest_tel_display);
            array_push($arr_rest, $tmp_rest_icon_url);
            array_push($arr_all_results, $arr_rest);
        }
    }
    
    $sql_search_dish = 'select distinct shop_info.id, shop_info.shop_phone, shop_info.shop_name, ';
    $sql_search_dish .= 'shop_info.rating, shop_info.icon_url, shop_info.straddr, shop_info.city, shop_info.state, shop_info.zipcode ';
    $sql_search_dish .= 'from shop_info, rest_category, dish where ';
    $sql_search_dish .= 'shop_info.id = rest_category.rest_id and ';
    $sql_search_dish .= 'rest_category.cate_id = dish.cate_id and shop_info.approve_status = \'y\' and ';
    $sql_search_dish .= 'dish.dish_name like \'%'.$search_cont.'%\';';
    
    //echo $sql_search_dish."<hr>";
    
    $sql_result = mysqli_query($link, $sql_search_dish);
    
    if(mysqli_num_rows($sql_result) >= 1)
    {
        while($row = mysqli_fetch_array($sql_result))
        {
            $arr_rest = array();
            $tmp_rest_id = $row['id'];
            $tmp_rest_name = $row['shop_name'];
            $tmp_rest_straddr = $row['straddr'];
            $tmp_rest_city = $row['city'];
            $tmp_rest_state = $row['state'];
            $tmp_rest_zcode = $row['zipcode'];
            $tmp_rest_rating = $row['rating'];
            $tmp_rest_tel = $row['shop_phone'];
            $tmp_rest_icon_url = $row['icon_url'];
            $rest_tel_display = "(".substr($tmp_rest_tel, 0, 3).") ".substr($tmp_rest_tel, 3, 3)."-".substr($tmp_rest_tel, 6);
            $rest_address_display = $tmp_rest_straddr.", ".$tmp_rest_city." ".$tmp_rest_state." ".$tmp_rest_zcode;
            array_push($arr_rest, $tmp_rest_id);
            array_push($arr_rest, $tmp_rest_name);
            array_push($arr_rest, $tmp_rest_rating);
            array_push($arr_rest, $rest_address_display);
            array_push($arr_rest, $rest_tel_display);
            array_push($arr_rest, $tmp_rest_icon_url);
            if(in_array($arr_rest, $arr_all_results) == false)
            {
                array_push($arr_all_results, $arr_rest);
            }
        }
    }
    
    if(count($arr_all_results) != 0)
    {
        foreach($arr_all_results as $elem)
        {
            $id = $elem[0];
            $name = $elem[1];
            $rating = $elem[2];
            $address = $elem[3];
            $tel = $elem[4];
            $icon_url = $elem[5];
            echo "<li><a href='./restaurant.php?id=".$elem[0]."'>";
            //echo "<article class = \"chopped_img\">";
            $icon_dir = './'.$id.'/icon.';
            if(file_exists($icon_dir.'jpg'))
            {
                echo "<div class = 'thumb' style='background-image: url(\"".$icon_dir."jpg"."\");'></div>";
            }
            else if(file_exists($icon_dir.'png'))
            {
                echo "<div class = 'thumb' style='background-image: url(\"".$icon_dir."png"."\");'></div>";
            }
            else if(file_exists($icon_dir.'gif'))
            {
                echo "<div class = 'thumb' style='background-image: url(\"".$icon_dir."gif"."\");'></div>";
            }
            else if(file_exists($icon_dir.'jpeg'))
            {
                echo "<div class = 'thumb' style='background-image: url(\"".$icon_dir."jpeg"."\");'></div>";
            }
            else if($icon_url != '')
            {
                echo "<div class = 'thumb' style='background-image: url(\"".$icon_url."\");'></div>";
            }
            else
            {
                echo "<div class = 'thumb' style='background-image: url(\"./icons/no_photo.png\");'></div>";
            }
            //echo "</article>";
            echo '<h3 class="rest_title_list">'.$name.'</h3>';
            if($rating == '')
            {
                echo '<p class="rest_rating">rating: N/A</p>';
            }
            else
            {
                echo '<p class="rest_rating">rating: '.$rating.'</p>';
            }
            echo '<p class = "rest_address_list">'.$address.'</p>';
            echo '<p class = "rest_tel">'.$tel.'</p>';
            echo '</a></li>';
        }
    }
    else
    {
        echo "<strong>No results!</strong>";
    }
    
    
}
else
{
    echo "<strong><span style='color:red;'>Please input something to search!</span></strong>";
}
?>