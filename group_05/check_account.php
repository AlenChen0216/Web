<?php
    include_once("api.php");
    $account = trim($_GET['account']);
    $email = trim($_GET['email']);
    $sql = "SELECT ID FROM 用戶 WHERE 帳號 = '".$account."' OR 信箱 = '".$email."'";
    if($result = mysqli_query($link,$sql)){
        if($row = $result->fetch_assoc()){
            echo "1";
        }else {
            echo "0";
        }
    }
    mysqli_free_result($result);
?>