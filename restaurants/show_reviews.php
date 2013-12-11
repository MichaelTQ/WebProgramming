<?php
if(isset($_SESSION['privilege']))
{
    $uname = $_SESSION['uname'];
    $rest_id = $_SESSION['rest_id'];
    if(isset($_POST['review_text']))
    {
        if($_POST['review_text'] != '')
        {
            $content = $_POST['review_text'];
            $content = addslashes($content);
            $content = trim($content);
            $content = strip_tags($content);
            if(isset($_POST['rating']))
            {
                $this_rating = $_POST['rating'];
            }
            $sql_get_cus_id = 'select id from user where user_name = \''.$uname.'\';';
            $link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
            $sql_result = mysqli_query($link, $sql_get_cus_id);
            while($row = mysqli_fetch_array($sql_result))
            {
                $cus_id = $row['id'];
            }
            
            $sql_add_review = 'insert into review(id_cust, id_rest, rating, content) values(\''.$cus_id.'\', \''.$rest_id.'\', \''.$this_rating.'\', \''.$content.'\');';
            
            $sql_result = mysqli_query($link, $sql_add_review) or die ('Query failed! '.mysql_error());
            
            $sql_get_old_review = 'select rating, rating_count from shop_info where id = \''.$rest_id.'\';';
            $sql_result = mysqli_query($link, $sql_get_old_review);
            while($row = mysqli_fetch_array($sql_result))
            {
                $old_rating = $row['rating'];
                $old_ratingcount = $row['rating_count'];
            }
            if($old_rating == '')
            {
                $sql_update_shop = 'update shop_info set rating = \''.$this_rating.'\', rating_count="1" where id = \''.$rest_id.'\';';
                mysqli_query($link, $sql_update_shop);
            }
            else
            {
                $int_old_count = intval($old_ratingcount);
                $new_rating = number_format(($old_rating*$int_old_count+$this_rating)/($int_old_count + 1), 1);
                $new_count = $int_old_count + 1;
                $new_count = $new_count;
                //echo $new_count;
                $sql_update = 'update shop_info set rating = \''.strval($new_rating).'\', rating_count = \''.$new_count.'\' where id = \''.$rest_id.'\';';
                mysqli_query($link, $sql_update);
            }
        }
        
    }
    $rest_id = $_SESSION['rest_id'];
    if($_SESSION['privilege'] == 'customer')
    {
        echo "<div id = 'review_warning'><br></div>";
        echo "<div id = 'add_review'>";
        echo "<form action = './restaurant.php?id=".$rest_id."' method='post' id='review_form'>";
        echo "<label for='rating'>rating:</label>";
        echo "<input type='radio' name = 'rating' value='1'>1 ";
        echo "<input type='radio' name = 'rating' value='2'>2 ";
        echo "<input type='radio' name = 'rating' value='3' checked>3 ";
        echo "<input type='radio' name = 'rating' value='4'>4 ";
        echo "<input type='radio' name = 'rating' value='5'>5<br>";
        echo "<textarea name = 'review_text'></textarea><br>";
        echo "<input type = 'submit' value = 'Submit' text-align = 'right'>";
        echo "</form>";
        echo "</div>";
    }
    else
    {
        echo "login as customer to write review.<hr>";
    }
}
else
{
    echo "login as customer to write review.<hr>";
}

$link = mysqli_connect('localhost', 'web_user', 'webwebweb', 'web_final_db') or die('Cannot connect to DB!');
$sql_get_reviews = 'select distinct user.user_name, review.content, review.rating from review, user where user.id = review.id_cust and id_rest = \''.$rest_id.'\';';
//echo $sql_get_reviews;
$sql_result = mysqli_query($link, $sql_get_reviews);
while($row = mysqli_fetch_array($sql_result))
{
    echo "<div class = 'every_review'>";
    echo "<p><span class = 'review_cus_name'>".$row['user_name'].":</span> ";
    echo "<span class='review_rating'>".$row['rating']."/5</span><br>";
    echo "<span class='review_content'>".$row['content']."</span>";
    echo "</div>";
}

mysqli_close($link);
?>