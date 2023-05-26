<?php
$host = "localhost";
$dbuser ="root";
$dbpassword = "root123456";
$dbname = "user0";
$link = mysqli_connect($host,$dbuser,$dbpassword,$dbname) or die("無法開啟MySQL資料庫連結!<br>"); //連結SQL
mysqli_query($link,'SET CHARACTER SET utf8');
mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");
session_start();

function encapPara($str){
    return "'".$str."'";
}
function appendMerchandise($uid,$mcname,$inventory,$rate,$conciseDesc,$comprehensiveDesc){
    global $link;
    $sql="insert into `商品`(`UID`,`品名`,`庫存量`,`評價`,`簡短敘述`,`完整敘述`) values("+encapPara($uid).",".encapPara($mcname).",".encapPara($inventory).",".encapPara($rate).",".encapPara($conciseDesc).",".encapPara($comprehensiveDesc).")";
    $result=mysqli_query($link,$sql);
}
function takInv(){
    global $link;
    $sql="select * from `商品`";
    $result=mysqli_query($link,$sql);
    while($row = $result->fetch_assoc()){
        echo $row['UID']." ".$row['庫存量']."<br>";
    }
    
}
function takeFromInventory($uid,$number){
    global $link;
    $sql0="select `庫存量` from `商品` where `UID`=".encapPara($uid)."";
    $result0=mysqli_query($link,$sql0);
    $row0=$result0->fetch_assoc();
    $currentInv=$row0['庫存量'];
    $sql1="update `商品` set `庫存量`=".encapPara(strval(intval($currentInv)-intval($number)))." where `UID`=".encapPara($uid)."";
    $result=mysqli_query($link,$sql1);

}
//takeFromInventory("1000",7);
//takInv();
function change_pwd($old,$new){
    global $link;
    $sql = "SELECT 帳號 , 密碼 FROM 用戶 WHERE 帳號 = '".$_SESSION['login']."' AND 密碼 = '".$old."'";
    if($result = mysqli_query($link,$sql)){
        while($row = $result->fetch_assoc()){
            $sql = "UPDATE 用戶 SET 密碼 = '".$new."' WHERE 帳號 = '".$_SESSION['login']."'";
            $result = mysqli_query($link,$sql);
            return 1;
        }
    }
    return 0;
}
?>