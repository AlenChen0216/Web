<?php
//上傳用戶的照片
include_once("api.php");
session_start();
$id = extractIDByAcc($_SESSION['login']);
if(isset($_POST["image"]))
{
	$data = $_POST["image"];

	$image_array_1 = explode(";", $data);

	$image_array_2 = explode(",", $image_array_1[1]);

	$data = base64_decode($image_array_2[1]);

	$imageName = 'image/' . $id . '.png';

	file_put_contents($imageName, $data);

	$sql = "UPDATE user_image SET hasPic = 1 WHERE ID = '".$id."'";
	$result = mysqli_query($link,$sql);

	echo $imageName;

}

?>