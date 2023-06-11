<?php
session_start();
include('api.php');
if (isset($_POST['email']) && isset($_POST['gender'])) {
    //防止xss攻擊
    $phone = strip_tags($_POST['phoneNum']);
    $home = strip_tags($_POST['address']);
    $name = strip_tags($_POST['name']);
    $email = strip_tags($_POST['email']);
    $birthday = $_POST['birthday'];
    $gender = ($_POST['gender'] == '1') ? '男' : '女';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location:information.php?dir=infor&change=no");
    } else {
        $sql = "SELECT 信箱 FROM 用戶 WHERE 信箱 = '" . $email . "'";
        if ($result = mysqli_query($link, $sql)) {
            $sql = "UPDATE 用戶 SET 生日 = '" . $birthday . "' , 電話 = '" . $phone . "' , 地址 = '" . $home . "' , 姓名 = '" . $name . "' , 信箱 = '" . $email . "' , 性別 = '" . $gender . "' WHERE 帳號 = '" . $_SESSION['login'] . "'";
            if (!($result = mysqli_query($link, $sql))) {
                echo $sql;
                header("location:information.php?dir=infor&change=no");
            } else {
                header("location:information.php?dir=infor&change=yes");
            }
        }else {
            header("location:information.php?dir=infor&change=no");
        }
        
    }
}
?>