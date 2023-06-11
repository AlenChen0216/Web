<?php
    include_once("../api.php");
    $name = trim($_POST['name']);
    $addr = trim($_POST['addr']);
    $phone = trim($_POST['phone']);
    $oid  = trim($_POST['oid']);
    $state = trim($_POST['state']);
    $state_type = array(0=>"準備中","已出貨","已送達");
    //更新訂單內容
    $sql = "update 訂單資訊 set 姓名 = '".$name."' , 地址 = '".$addr."' , 電話='".$phone."' , 運送狀態 = '".$state_type[$state]."' WHERE 訂單id = '".$oid."'";
    $result = mysqli_query($link,$sql);
    echo $sql;
?>