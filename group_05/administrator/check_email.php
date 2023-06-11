<?php
    include_once("../api.php");
    $email = trim($_GET['email']);
    $id = trim($_GET['id']);
    $sql = "SELECT ID FROM 用戶 WHERE 信箱 = '".$email."' and NOT ID  = '".$id."'";
    if($result = mysqli_query($link,$sql)){
        if($row = $result->fetch_assoc()){
            echo "1";
        }else {
            echo "0";
        }
    }
?>