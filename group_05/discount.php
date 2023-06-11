<?php
    include("api.php");
    session_start();
    $ori = $_POST['original']; //原始金額
    $now = $_POST['price'];
    $dis = $_POST['coupon']; //折價
    $now = $now - $dis; //折後金額
    $_SESSION['coupon'] = $_POST['infor'];
    echo $now;
?>