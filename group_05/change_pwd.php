<?php //修改密碼的程式
    session_start();
    include_once('api.php');
    if(isset($_SESSION['login'])&&isset($_POST['new'])){ //確認用戶有登入，且表單有確實填入
        $new = strip_tags($_POST['new']);
        $old = strip_tags($_POST['old']);
        $check = (change_pwd($old,$new)==1)?true:false; //確定是否更新成功
        if(!$check){//沒有的話，跳回information並提示輸入有誤。
            header("location:./information.php?dir=change_pwd&change=no");
        }else {
            header("location:./information.php?dir=change_pwd&change=yes");
        }
    }else {
        header("location:./information.php?dir=change_pwd&change=no");
    }

?>