<?php
$uname = $_SESSION['uname'];
$sql_check_rest_exists = 'SELECT * FROM user, own_shop where user.user_name = \''.$uname.'\' and user.id = own_shop.user_id;';
$link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
$sql_result = mysqli_query($link, $sql_check_rest_exists) or die ('Query failed! '.mysql_error());
if(mysqli_num_rows($sql_result) >= 1)
{
    $id = '';
    $sql_get_user_id = 'select id from user where user_name = \''.$uname.'\';';
    $sql_result = mysqli_query($link, $sql_get_user_id) or die('Query failed! ==> '.mysql_error());
    while($row = mysqli_fetch_array($sql_result))
    {
        $id = $row['id'];
        $_SESSION['user_id'] = $id;
    }
    $sql_get_restid = 'select shop_info.id from shop_info where icon_dir = \'./restaurants/rest_pics/'.$id.'/\';';
    $rest_id = '';
    $sql_result = mysqli_query($link, $sql_get_restid) or die('Query failed! ==> '.mysql_error());
    while($row = mysqli_fetch_array($sql_result))
    {
        $rest_id = $row['id'];
    }
    
    if(isset($_POST['rest_name']) && isset($_POST['rest_straddr'])
       && isset($_POST['rest_city']) && isset($_POST['rest_state'])
      && isset($_POST['rest_tel']))
    {
        //update restaurant
        $rest_name = $_POST['rest_name'];
        $rest_name = addslashes($rest_name);
        $rest_name = trim($rest_name);
        $rest_straddr = $_POST['rest_straddr'];
        $rest_straddr = addslashes($rest_straddr);
        $rest_straddr = trim($rest_straddr);
        $rest_city = $_POST['rest_city'];
        $rest_city = addslashes($rest_city);
        $rest_city = trim($rest_city);
        $rest_state = $_POST['rest_state'];
        $rest_state = addslashes($rest_state);
        $rest_state = trim($rest_state);
        $rest_tel = $_POST['rest_tel'];
        $rest_tel = addslashes($rest_tel);
        $rest_tel = trim($rest_tel);
        $rest_description = $_POST['rest_description'];
        $rest_description = addslashes($rest_description);
        $rest_description = trim($rest_description);
        $rest_zcode = $_POST['rest_zcode'];
        $rest_zcode = addslashes($rest_zcode);
        $rest_zcode = trim($rest_zcode);
        
        $sql_update_rest = 'update shop_info set shop_name = \''.$rest_name.'\', shop_phone = \''.$rest_tel.'\', description = \''.$rest_description.'\', city = \''.$rest_city.'\', state = \''.$rest_state.'\', zipcode = \''.$rest_zcode.'\', straddr = \''.$rest_straddr.'\' where id = \''.$rest_id.'\';';
        $sql_result = mysqli_query($link, $sql_update_rest) or die('Query failed!');
        
        echo "<script>location.reload();</script>";
    }
    
    if(isset($_POST['cate_name']))
    {
        $arr_cate_name = $_POST['cate_name'];
        $arr_cate_description = $_POST['cate_description'];
        $counter = 0;
        
        $sql_get_cate_id = 'select cate_id from rest_category where rest_id = \''.$rest_id.'\';';
        $sql_result = mysqli_query($link, $sql_get_cate_id) or die('Query failed');
        $arr_cate_id = array();
        while($row = mysqli_fetch_array($sql_result))
        {
            array_push($arr_cate_id, $row['cate_id']);
        }
        
        if(count($arr_cate_id) != 0)
        {
            foreach($arr_cate_id as $cate_id)
            {
            //it has records, remove them first.
            $sql_delete_records1 = 'delete from rest_category where rest_id = \''.$rest_id.'\';';
            $sql_delete_records2 = 'delete from dish where cate_id = \''.$cate_id.'\';';
            $sql_delete_records3 = 'delete from category where id = \''.$cate_id.'\'';
            mysqli_query($link, $sql_delete_records1) or die("sql_delete_records1 failed!");
            mysqli_query($link, $sql_delete_records2) or die("sql_delete_records2 failed!");
            mysqli_query($link, $sql_delete_records3) or die("sql_delete_records3 failed!");
            }
        }
        
        for ($j = 0; $j < count($arr_cate_name); $j++)
        {
            $arr_dish_name = $_POST['cate'.strval($counter).'_dish_name'];
            $arr_dish_price = $_POST['cate'.strval($counter).'_dish_price'];
            $arr_length = count($arr_dish_name);
            
            //insert into category
            
            //first get cate_id
            $sql_insert_cate = 'insert into category(cate_name, description) values(\''.$arr_cate_name[$j].'\', \''.$arr_cate_description[$j].'\');';
            $sql_result = mysqli_query($link, $sql_insert_cate);
            
            $sql_get_cateid = 'select max(id) from category;';
            $sql_result = mysqli_query($link, $sql_get_cateid);
            while($row = mysqli_fetch_array($sql_result))
            {
                $tmp_cate_id = $row['max(id)'];
            }
            
            for($i = 0; $i < $arr_length; $i++)
            {
                //insert into category
                $sql_insert_dish = 'insert into dish(cate_id, dish_name, dish_price) values(\''.$tmp_cate_id.'\', \''.$arr_dish_name[$i].'\', \''.$arr_dish_price[$i].'\');';
                $sql_result = mysqli_query($link, $sql_insert_dish) or die('insert into dish failed!');
            }
            
            //insert into rest_category
            $sql_insert_restcate = 'insert into rest_category values(\''.$rest_id.'\', \''.$tmp_cate_id.'\');';
            $sql_result = mysqli_query($link, $sql_insert_restcate);
            $counter++;
        }
        echo "<script>location.reload();</script>";
        
    }
    
    $sql_check_catedish = 'select cate_id, cate_name, description from rest_category, category where category.id = rest_category.cate_id and rest_category.rest_id = \''.$rest_id.'\';';
    $sql_result = mysqli_query($link, $sql_check_catedish);
    if(mysqli_num_rows($sql_result) >= 1)
    {
        $cate_counter = 0;
        $cate_num = mysqli_num_rows($sql_result);
        echo '<div id = "old_cate_num">'.strval($cate_num).'</div>';
        //There are categories and dishes!
        while($row = mysqli_fetch_array($sql_result))
        {
            $tmp_cateid = $row['cate_id'];
            $tmp_cate_name = $row['cate_name'];
            $tmp_description = $row['description'];
            echo '<div id = "old_cate_name_id'.strval($cate_counter).'">'.$tmp_cate_name.'</div>';
            echo '<div id = "old_description_id'.strval($cate_counter).'">'.$tmp_description.'</div>';
            $sql_get_dishes = 'select dish_name, dish_price from dish where cate_id = \''.$tmp_cateid.'\';';
            $sql_result2 = mysqli_query($link, $sql_get_dishes);
            $dish_length = mysqli_num_rows($sql_result2);
            echo '<div id = "dish_length_id'.strval($cate_counter).'">'.strval($dish_length).'</div>';
            $dish_counter = 0;
            while($row2 = mysqli_fetch_array($sql_result2))
            {
                $tmp_dish_name = $row2['dish_name'];
                $tmp_dish_price = $row2['dish_price'];
                echo '<div id = "old_dish_name_id_'.strval($cate_counter).'_'.strval($dish_counter).'">'.$tmp_dish_name.'</div>';
                echo '<div id = "old_dish_price_id_'.strval($cate_counter).'_'.strval($dish_counter).'">'.$tmp_dish_price.'</div>';
                
                $dish_counter++;
            }
            $cate_counter++;
        }
        echo "<script>my_update_allmenus();</script>";
    }
    
    //has restaurant!
    echo "<script>open_restaurant();</script>";
    
    $sql_get_rest_info = 'select shop_info.shop_phone, shop_info.shop_name, shop_info.description, shop_info.city, shop_info.state, shop_info.zipcode, shop_info.straddr, shop_info.icon_url from shop_info, own_shop where own_shop.shop_id = shop_info.id and own_shop.user_id = \''.$id.'\';';
    $sql_result = mysqli_query($link, $sql_get_rest_info) or die('Query failed! ==> '.mysql_error());
    while($row = mysqli_fetch_array($sql_result))
    {
        $rest_name = $row['shop_name'];
        $rest_tel = $row['shop_phone'];
        $rest_description = $row['description'];
        $rest_city = $row['city'];
        $rest_state = $row['state'];
        $rest_zcode = $row['zipcode'];
        $rest_straddr = $row['straddr'];
        $rest_icon_url = $row['icon_url'];
    }
    echo "<div id = 'rest_info_name'>".$rest_name."</div><br>";
    echo "<div id = 'rest_info_tel'>".$rest_tel."</div><br>";
    echo "<div id = 'rest_info_description'>".$rest_description."</div><br>";
    echo "<div id = 'rest_info_city'>".$rest_city."</div><br>";
    echo "<div id = 'rest_info_state'>".$rest_state."</div><br>";
    echo "<div id = 'rest_info_zcode'>".$rest_zcode."</div><br>";
    echo "<div id = 'rest_info_straddr'>".$rest_straddr."</div><br>";
    echo "<div id = 'rest_info_icon_url'>".$rest_icon_url."</div><br>";
    echo "<script>update_rest_info();</script>";
}
else
{
    //don't have restaurant!
    if(isset($_POST['rest_name']) && isset($_POST['rest_straddr'])
       && isset($_POST['rest_city']) && isset($_POST['rest_state'])
      && isset($_POST['rest_tel']))
    {
        $rest_name = $_POST['rest_name'];
        $rest_name = addslashes($rest_name);
        $rest_name = trim($rest_name);
        $rest_straddr = $_POST['rest_straddr'];
        $rest_straddr = addslashes($rest_straddr);
        $rest_straddr = trim($rest_straddr);
        $rest_city = $_POST['rest_city'];
        $rest_city = addslashes($rest_city);
        $rest_city = trim($rest_city);
        $rest_state = $_POST['rest_state'];
        $rest_state = addslashes($rest_state);
        $rest_state = trim($rest_state);
        $rest_tel = $_POST['rest_tel'];
        $rest_tel = addslashes($rest_tel);
        $rest_tel = trim($rest_tel);
        $rest_description = $_POST['rest_description'];
        $rest_description = addslashes($rest_description);
        $rest_description = trim($rest_description);
        $rest_zcode = $_POST['rest_zcode'];
        $rest_zcode = addslashes($rest_zcode);
        $rest_zcode = trim($rest_zcode);
        
        $id = '';
        
        $sql_get_user_id = 'select id from user where user.user_name = \''.$uname.'\';';
        $sql_result = mysqli_query($link, $sql_get_user_id) or die('Query failed! ==> '.mysql_error());
        while($row = mysqli_fetch_array($sql_result))
        {
            $id = $row['id'];
            $_SESSION['user_id'] = $id;
        }
        
        $sql_insert_rest = 'insert into shop_info(shop_phone, shop_name, approve_status, icon_dir, description, city, state, zipcode, straddr) values(\''.$rest_tel.'\', \''.$rest_name.'\', \'n\', \'./restaurants/rest_pics/'.$id.'/\', \''.$rest_description.'\', \''.$rest_city.'\', \''.$rest_state.'\', \''.$rest_zcode.'\', \''.$rest_straddr.'\');';
        $sql_result = mysqli_query($link, $sql_insert_rest) or die('Query failed! ==> '.mysql_error());
        
        $sql_get_restid = 'select shop_info.id from shop_info where icon_dir = \'./restaurants/rest_pics/'.$id.'/\';';
        $rest_id = '';
        $sql_result = mysqli_query($link, $sql_get_restid) or die('Query failed! ==> '.mysql_error());
        while($row = mysqli_fetch_array($sql_result))
        {
            $rest_id = $row['id'];
        }
        
        $sql_insert_ownshop = 'insert into own_shop values(\''.$id.'\', \''.$rest_id.'\');';
        $sql_result = mysqli_query($link, $sql_insert_ownshop) or die('Query failed! ==>'.mysqli_error($link));
        
        echo "<script>location.reload();</script>";
        
        //add restaurant directory
        $structure = '../restaurants/'.$rest_id.'/pics';
        if (!mkdir($structure, 0700, true)) {
            die('Failed to create folders...');
        }
    }
    
//    if(isset($_POST['cate_name']))
//    {
//        $arr_cate_name = $_POST['cate_name'];
//        $arr_cate_description = $_POST['cate_description'];
//        $counter = 0;
//        
//        $sql_get_cate_id = 'select cate_id from rest_category where rest_id = \''.$rest_id.'\';';
//        $sql_result = mysqli_query($link, $sql_get_cate_id) or die('Query failed');
//        $arr_cate_id = array();
//        while($row = mysqli_fetch_array($sql_result))
//        {
//            array_push($arr_cate_id, $row['cate_id']);
//        }
//        
//        if(count($arr_cate_id) != 0)
//        {
//            foreach($arr_cate_id as $cate_id)
//            {
//            //it has records, remove them first.
//            $sql_delete_records1 = 'delete from rest_category where rest_id = \''.$rest_id.'\';';
//            $sql_delete_records2 = 'delete from dish where cate_id = \''.$cate_id.'\';';
//            $sql_delete_records3 = 'delete from category where id = \''.$cate_id.'\'';
//            mysqli_query($link, $sql_delete_records1) or die("sql_delete_records1 failed!");
//            mysqli_query($link, $sql_delete_records2) or die("sql_delete_records2 failed!");
//            mysqli_query($link, $sql_delete_records3) or die("sql_delete_records3 failed!");
//            }
//        }
//        
//        for ($j = 0; $j < count($arr_cate_name); $j++)
//        {
//            $arr_dish_name = $_POST['cate'.strval($counter).'_dish_name'];
//            $arr_dish_price = $_POST['cate'.strval($counter).'_dish_price'];
//            $arr_length = count($arr_dish_name);
//            
//            //insert into category
//            
//            //first get cate_id
//            $sql_insert_cate = 'insert into category(cate_name, description) values(\''.$arr_cate_name[$j].'\', \''.$arr_cate_description[$j].'\');';
//            $sql_result = mysqli_query($link, $sql_insert_cate);
//            
//            $sql_get_cateid = 'select max(id) from category;';
//            $sql_result = mysqli_query($link, $sql_get_cateid);
//            while($row = mysqli_fetch_array($sql_result))
//            {
//                $tmp_cate_id = $row['max(id)'];
//            }
//            
//            for($i = 0; $i < $arr_length; $i++)
//            {
//                //insert into category
//                $sql_insert_dish = 'insert into dish(cate_id, dish_name, dish_price) values(\''.$tmp_cate_id.'\', \''.$arr_dish_name[$i].'\', \''.$arr_dish_price[$i].'\');';
//                $sql_result = mysqli_query($link, $sql_insert_dish) or die('insert into dish failed!');
//            }
//            
//            //insert into rest_category
//            $sql_insert_restcate = 'insert into rest_category values(\''.$rest_id.'\', \''.$tmp_cate_id.'\');';
//            $sql_result = mysqli_query($link, $sql_insert_restcate);
//            $counter++;
//        }
//        
//        echo "<script>location.reload();</script>";
//    }
}

mysqli_close($link);
?>