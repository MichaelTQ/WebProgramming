<?php

include './simple_html_dom.php';

$allowedExt = 'html';
if(isset($_FILES['menu_upload']))
{
    $tmp = explode(".", $_FILES['menu_upload']['name']);
    $extension = end($tmp);
}

if(isset($_FILES['menu_upload']))
{
    if($_FILES['menu_upload']['type'] != 'text/html' && $extension != $allowedExt)
    {
        echo "<script>$('#menu_warning').html('Only html file allowed!');</script>";
    }
    else
    {
        if($_FILES['menu_upload']['error']>0)
        {
            echo "<script>alert('upload menu error!');</script>";
        }
        else
        {
            $fname = $_FILES['menu_upload']['name'];
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
                $structure = '../restaurants/'.$_SESSION['rest_id'].'/pics';
                if (!file_exists($structure))
                {
                    mkdir($structure, 0777, true);
                }
                
                move_uploaded_file($_FILES['menu_upload']['tmp_name'], '../restaurants/'.$_SESSION['rest_id'].'/upload_menu.html');
                
                $f_uploaded = '/Library/WebServer/Documents/WebProgramming/restaurants/'.$_SESSION['rest_id'].'/upload_menu.html';
                $file_content = '';
                $file_handle = fopen($f_uploaded, 'r');
                while(!feof($file_handle))
                {
                    $line = fgets($file_handle);
                    $file_content = $file_content.$line;
                }
                
                $html = file_get_html($f_uploaded);
                $arr_all_data = array();
                foreach($html->find('div.category') as $cate)
                {
                    $arr_cate = array();
                    //echo $cate->find('h3', 0)->plaintext."<br>";
                    $cate_name = $cate->find('h3', 0)->plaintext;
                    if($cate_name == '')
                    {
                        echo "<script>$('#menu_warning').html('errors in html file');</script>";
                        die();
                    }
                    
                    array_push($arr_cate, $cate_name);
                    //echo $cate->find('p', 0)->plaintext."<br>";
                    $description = $cate->find('p', 0)->plaintext;
                    array_push($arr_cate, $description);
                    
                    $arr_dish = array();
                    $arr_price = array();
                    foreach($cate->find('li') as $name_price)
                    {
                        //echo $name_price->find('span', 0)->plaintext;
                        $dish_name = $name_price->find('span', 0)->plaintext;
                        //echo $name_price->find('span', 1)->plaintext."<br>";
                        $dish_price = $name_price->find('span', 1)->plaintext;
                        if($dish_name == '' || $dish_price == '')
                        {
                            echo "<script>$('#menu_warning').html('errors in html file');</script>";
                            die();
                        }
                        array_push($arr_dish, $dish_name);
                        array_push($arr_price, $dish_price);
                    }
                    if(count($arr_dish) != count($arr_price))
                    {
                        echo "<script>$('#menu_warning').html('errors in html file');</script>";
                        die();
                    }
                    array_push($arr_cate, $arr_dish);
                    array_push($arr_cate, $arr_price);
                    array_push($arr_all_data, $arr_cate);
                }
                
                if(count($arr_all_data) == 0)
                {
                    echo "<script>$('#menu_warning').html('errors in html file');</script>";
                    die();
                }
                //echo count($arr_all_data);
                
                //REMOVE ALL MENU DATA!!!!!
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
                
                foreach($arr_all_data as $cate)
                {
                    $cate_name = $cate[0];
                    $description = $cate[1];
                    $arr_dish = $cate[2];
                    $arr_price = $cate[3];
                    
                    $sql_insert_cate = 'insert into category(cate_name, description) values(\''.$cate_name.'\', \''.$description.'\');';
                    $sql_result = mysqli_query($link, $sql_insert_cate);
                    
                    $sql_get_cateid = 'select max(id) from category;';
                    $sql_result = mysqli_query($link, $sql_get_cateid);
                    while($row = mysqli_fetch_array($sql_result))
                    {
                        $tmp_cate_id = $row['max(id)'];
                    }
                    
                    for($i = 0; $i < count($arr_dish); $i++)
                    {
                        $dish_name = $arr_dish[$i];
                        $dish_price = $arr_price[$i];
                        $dish_price = trim($dish_price);
                        
                        if(is_numeric($dish_price)!=true)
                        {
                            echo "<script>$('#menu_warning').html('errors in html file');</script>";
                            die();
                        }
                        //insert into dish
                        $sql_insert_dish = 'insert into dish(cate_id, dish_name, dish_price) values(\''.$tmp_cate_id.'\', \''.$dish_name.'\', \''.$dish_price.'\');';
                        $sql_result = mysqli_query($link, $sql_insert_dish) or die('insert into dish failed!');
                    }
                    //insert into rest_category
                    $sql_insert_restcate = 'insert into rest_category values(\''.$rest_id.'\', \''.$tmp_cate_id.'\');';
                    $sql_result = mysqli_query($link, $sql_insert_restcate);
                }
                
                
//                $DOM = new DOMDocument;
//                $DOM->loadHTML($file_content);
//                
//                $categorys = $DOM->getElementsByTagName('h3');
//                
//                foreach($categorys as $elem)
//                {
//                    echo $elem->nodeValue."<br>";
//                    $cate_name = $elem->nodeValue;
//                    echo $elem->nextSibling->nodeValue."<br>";
//                    $cate_description = $elem->nextSibling->nodeValue;
//                    
//                    echo $elem->parentNode->parentNode->firstChild->nextSibling.getAttribute('class');
//                }
                
                //echo $file_content;
                
                fclose($file_handle);
                echo "<script>location.reload();</script>";
                echo "<script>$('#menu_warning').html('file uploaded successfully! reload to see updates.');</script>";
                
            }
            else
            {
                echo "<script>$('#menu_warning').html('edit restaurant first!');</script>";
            }
        }
    }
}

?>