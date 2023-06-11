<?php //下定後的程序
    session_start();
    include('api.php');
    $id = extractIDByAcc($_SESSION['login']);
    if(isset($_SESSION['coupon'])){//扣除使用過得折價卷
        $sql = "SELECT 數量 FROM 折價券 WHERE 說明 = '".$_SESSION['coupon']."' AND ID = '".$id."'";
        $num = 0;
        if($result = mysqli_query($link,$sql)){
            $row = $result->fetch_array();
            $num = $row[0] -1;
        }
        if($num>0){
            $sql = "UPDATE 折價券 SET 數量 = ".$num." WHERE 說明 = '".$_SESSION['coupon']."' AND ID = '".$id."'";
            if(!($result = mysqli_query($link,$sql))){
                header("location:./information.php?dir=shop&change=no");
            }
        }else if($num==0) {//若扣除後，數量<0，則直接刪除此優惠卷
            $sql = "DELETE FROM 折價券 WHERE 說明 = '".$_SESSION['coupon']."' AND ID = '".$id."'";
            if(!($result = mysqli_query($link,$sql))){
                header("location:./information.php?dir=shop&change=no");
            }
        }
    }
    
    if(isset($_POST['name'])&&isset($_POST['phone'])){ //建立訂單
        $name = strip_tags($_POST['name']);
        $phone = strip_tags($_POST['phone']);
        $address = strip_tags($_POST['address']);
        $price = strip_tags($_POST['price']);
        $sql = "SELECT MAX(CONVERT(訂單id,UNSIGNED)) FROM 訂單資訊";
        $id;
        if($result = mysqli_query($link,$sql)){
            while($row = $result->fetch_array()){
                $id = $row[0]+1;
            }
        }
        if(createCompleteOrder($id,$name,$phone,$address,$price)){
            unset($_SESSION['cart']);
            unset($_SESSION['coupon']);
            header("location:./index.php?account=buy");
        }else {
            header("location:./information.php?dir=shop&change=no");
        }
    }
?>