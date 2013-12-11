<?php
$id = $_SESSION['rest_id'];

$menu_dir = './'.$id.'/menu.html';
if(file_exists($menu_dir) == false)
{
    echo 'no menus now!';
}
else
{
    $file = fopen($menu_dir, 'r') or die('error reading files!');
    $str_content = '';
    while(!feof($file))
    {
        $str_content .= fgets($file);
    }
    
    echo $str_content;
    
    fclose($file);
}
?>