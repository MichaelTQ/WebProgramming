<?php
$rest_id = $_SESSION['rest_id'];
$sql_get_rest = 'select * from shop_info where id = \''.$rest_id.'\';';
$link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
$sql_result = mysqli_query($link, $sql_get_rest) or die ('Query failed! '.mysql_error());
while($row = mysqli_fetch_array($sql_result))
{
    $tmp_rest_name = $row['shop_name'];
    $tmp_rest_straddr = $row['straddr'];
    $tmp_rest_city = $row['city'];
    $tmp_rest_state = $row['state'];
    $tmp_rest_zcode = $row['zipcode'];
    $tmp_rest_tel = $row['shop_phone'];
    $tmp_rest_description = $row['description'];
    $rest_tel_display = "(".substr($tmp_rest_tel, 0, 3).") ".substr($tmp_rest_tel, 3, 3)."-".substr($tmp_rest_tel, 6);
    $rest_address_display = $tmp_rest_straddr.", ".$tmp_rest_city." ".$tmp_rest_state." ".$tmp_rest_zcode;
    
    echo '<h1>'.$tmp_rest_name.'</h1>';
    echo '<article><p class = "rest_left"><span class = "address" id = "rest_address_id">'.$rest_address_display.'</span><br>';
    echo 'Tel: <span class = "telephone">'.$rest_tel_display.'</span><br></p>';
    echo '<p class = "rest_description">'.$tmp_rest_description.'</p></article>';
}
    
mysqli_close($link);
?>