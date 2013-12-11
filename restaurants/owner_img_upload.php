<?php
if(isset($_FILES["owner_img"]))
{
$rest_id = $_SESSION['rest_id'];

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["owner_img"]["name"]);
$extension = strtolower(end($temp));
if ((($_FILES["owner_img"]["type"] == "image/gif")
|| ($_FILES["owner_img"]["type"] == "image/jpeg")
|| ($_FILES["owner_img"]["type"] == "image/jpg")
|| ($_FILES["owner_img"]["type"] == "image/pjpeg")
|| ($_FILES["owner_img"]["type"] == "image/x-png")
|| ($_FILES["owner_img"]["type"] == "image/png"))
&& ($_FILES["owner_img"]["size"] < 2000000)
&& in_array($extension, $allowedExts))
{
    if ($_FILES["owner_img"]["error"] > 0)
	{
		echo "Return Code: " . $_FILES["owner_img"]["error"] . "<br>";
		die("upload failed");
	}
    move_uploaded_file($_FILES["owner_img"]["tmp_name"],
      "/Library/WebServer/Documents/WebProgramming/restaurants/".$rest_id."/pics/".$_FILES["owner_img"]["name"]);
    
    //echo $_FILES["owner_img"]["tmp_name"]."<br>";
    //echo"/Library/WebServer/Documents/WebProgramming/restaurants/".$rest_id."/pics/".$_FILES["owner_img"]["name"];
    echo "<script>location.reload();</script>";
}
else
{
    echo "<script>alert('please upload an image!');</script>";
}
}
?>