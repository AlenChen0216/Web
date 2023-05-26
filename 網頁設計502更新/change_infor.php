<?php
  session_start();
  if(isset($_POST['email'])&&isset($_POST['gender'])){
    $email = strip_tags($_POST['email']);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("location:information.php?dir=infor&change=no");
    }else {
        $che = false;
        $double_che = false;
        if(isset($_SESSION['email'])){
            foreach($_SESSION['email'] as $value){
                if($email==$value){
                    header("location:information.php?dir=infor&change=no");
                    $che = true;
                    break;
                }
            }
        }
        $gender = array(1=>"m","f");
        if(!$che){
            for($i=0;$i<count($_SESSION['account']);$i++){
                if($_SESSION['account'][$i]==$_SESSION['login']){
                    $_SESSION['birthday'][$i] = $_POST['birthday'];
                    $_SESSION['sex'][$i]=$gender[$_POST['gender']];
                    $_SESSION['email'][$i]=$_POST['email'];
                }
              }
                $_SESSION['login_birthday']=$_POST['birthday'];
                $_SESSION['login_gender']=$gender[$_POST['gender']];
                $_SESSION['login_email']=$_POST['email'];
                $double_che = true;
        }
        if($double_che){
            header("location:information.php?dir=infor&change=yes");
        }
      }        
    }
?>