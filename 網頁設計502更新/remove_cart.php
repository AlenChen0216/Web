<?php
    session_start();
    if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];
      }
      $temp= array_filter(explode(",",$cart));
      $array_cart;
      for($i=0;$i<count($temp);$i+=2){
        $arr_cart[$temp[$i]] =  $temp[$i+1];
      }
      if(isset($_POST['id'])){
        $id = $_POST['id'];
        unset($arr_cart[$id]);
      }
      $item = array_keys($arr_cart);
      $num = array_values($arr_cart);
      $result = '';
      $length = count($arr_cart);
      for($i=0;$i<$length;$i++){
        $result =$result.$item[$i].",".$num[$i].",";
      }
      $_SESSION['cart'] = $result;
      echo $id;
?>  