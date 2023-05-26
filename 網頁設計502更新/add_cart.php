<?php
    session_start();
    if(isset($_SESSION['cart'])&&$_SESSION['cart']!=""){
        $cart = $_SESSION['cart'];
        $temp= array_filter(explode(",",$cart));
        for($i=0;$i<count($temp);$i+=2){
            $arr_cart[$temp[$i]] =  $temp[$i+1];
        }
        if(isset($_POST['uid'])){
        $uid = $_POST['uid'];
        $amount = $_POST['amount'];
        //用uid 在sql內查詢商品名稱
        if($uid=='1001'){
            if(array_key_exists('吳郭魚',$arr_cart)){
               $arr_cart['吳郭魚'] += $amount;
            }else {
                $arr_cart['吳郭魚'] = $amount;
            }
            $id = '吳郭魚';
        }else if($uid=='1002'){
            if(array_key_exists('小卷',$arr_cart)){
                $arr_cart['小卷'] += $amount;
            }else {
                $arr_cart['小卷'] = $amount;
            }
            $id = '小卷';
        }
        
        }
        
    }else{
        $cart="";
        //$_SESSION['cart'] = '吳郭魚,1,小卷,2,松阪豬,3,澳洲牛,1';
        if(isset($_POST['uid'])){
            $uid = $_POST['uid'];
            $amount = $_POST['amount'];
            if($uid=='1001'){
                $arr_cart['吳郭魚'] = $amount;
                $id = '吳郭魚';
            }else if($uid=='1002'){
                $arr_cart['小卷'] = $amount;
                $id = '小卷';
            }
        }

    }
    $item = array_keys($arr_cart);
    $num = array_values($arr_cart);
    $result = '';
    $length = count($arr_cart);
    for($i=0;$i<$length-1;$i++){
        $result =$result.$item[$i].",".$num[$i].",";
    }
    $result = $result.$item[$length-1].",".$num[$length-1];
    $_SESSION['cart'] = $result;
    echo $id;
?>  