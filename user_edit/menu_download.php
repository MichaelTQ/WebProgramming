<?php
$uname = $_SESSION['uname'];
$sql_check_shop = 'SELECT shop_id FROM user, own_shop where user.user_name = \''.$uname.'\' and user.id = own_shop.user_id;';
$link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
$sql_result = mysqli_query($link, $sql_check_shop);
if(mysqli_num_rows($sql_result) >= 1)
{
    while($row = mysqli_fetch_array($sql_result))
    {
        $rest_id = $row['shop_id'];
    }
    $SESSION['rest_id'] = $rest_id;
    $sql_check_category = 'select * from category, rest_category where category.id = rest_category.cate_id and rest_category.rest_id = \''.$rest_id.'\';';
    $sql_result = mysqli_query($link, $sql_check_category);
    if(mysqli_num_rows($sql_result) >= 1)
    {
        $menu_html = '<div id = "menu">';
        $cate_length = mysqli_num_rows($sql_result);
        while($row = mysqli_fetch_array($sql_result))
        {
            $tmp_cate_id = $row['cate_id'];
            $tmp_cate_name = $row['cate_name'];
            $tmp_description = $row['description'];
            
            $menu_html = $menu_html.'<div class = "category"><div class = "category_head">';
            $menu_html = $menu_html.'<h3>'.$tmp_cate_name.'</h3>';
            $menu_html = $menu_html.'<p>'.$tmp_description.'</p></div>';
            $menu_html = $menu_html.'<ul>';

            $sql_get_dish = 'select * from dish where cate_id = \''.$tmp_cate_id.'\';';
            $sql_result2 = mysqli_query($link, $sql_get_dish);
            
            $counter = 0;
            while($row2 = mysqli_fetch_array($sql_result2))
            {
                $tmp_dish_name = $row2['dish_name'];
                $tmp_dish_price = $row2['dish_price'];
                
                if($counter%2 == 0)
                {
                    //odd
                    $menu_html = $menu_html.'<li class="menu_item odd">';
                    $menu_html = $menu_html.'<span class="name">'.$tmp_dish_name.'</span>';
                    $menu_html = $menu_html.'<span class="price">'.$tmp_dish_price.'</span>';
                    $menu_html = $menu_html.'</li>';
                }
                else if($counter%2 == 1)
                {
                    //even
                    $menu_html = $menu_html.'<li class="menu_item even">';
                    $menu_html = $menu_html.'<span class="name">'.$tmp_dish_name.'</span>';
                    $menu_html = $menu_html.'<span class="price">'.$tmp_dish_price.'</span>';
                    $menu_html = $menu_html.'</li>';
                }
                $counter++;
            }
            $menu_html = $menu_html.'</ul><div style="clear: left;"></div></div>';
        }
        $menu_html = $menu_html.'</div>';
        
        //add restaurant directory
        $structure = '../restaurants/'.$rest_id.'/pics';
        if (!file_exists($structure))
        {
            mkdir($structure, 0777, true);
        }
        $file = '../restaurants/'.$rest_id.'/menu.html';
        $handle = fopen($file, 'w') or die('Cannot open file:  '.$my_file);
        fwrite($handle, $menu_html);
        
        echo "Click <a href='".$file."' target='_blank'>HERE</a> to download your menu<br>\n";
    }
}
?>