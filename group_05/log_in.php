<!DOCTYPE html>
<html lang="en">

<head>
  <!-- 自定義CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/error.css">
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

  <!-- 帳號驗證相關script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
  <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/localization/messages_zh_TW.js "></script>

  <title>彰師生鮮賣場</title>
  <!-- 帳號驗證 -->
  
</head>
    <script>
    $(document).ready(function ($) {
      $("#login").validate({
        submitHandler: function (form) {
          alert("驗證會員身份....");
          form.submit();
        },
        rules: {
          account: {
            required: true,
            minlength: 4,
            maxlength: 10
          },
          pwd: {
            required: true,
            minlength: 6,
            maxlength: 12
          },
          email: {
            required: true,
            email: true
          },
        },
        messages: {
          account: {
            minlength: "(限4~10個字)",
            maxlength: "(限4~10個字)"
          },
          pwd: {
            minlength: "(限6~12個字)",
            maxlength: "(限6~12個字)"
          },
        }
      });
    });
  </script>
<?php
  session_start();
  include_once("api.php");
  //給訂"login" 的初始值
    if(!isset($_SESSION['login'])){
      $_SESSION['login']=NULL;
    }
    
  // 當按下"登入"鍵後，執行下列程式
    if(isset($_POST['account'])&&isset($_POST['pwd'])){
      //判定是否資料庫有輸入的 (帳/密)
       $account = strip_tags($_POST['account']);
       $pwd = strip_tags($_POST['pwd']);
       $check = false;
       $sql = "SELECT * FROM 用戶 WHERE 帳號 = "."'".$_POST['account']."'";
       echo $sql;
       if($result = mysqli_query($link,$sql)){
        while($row = $result->fetch_assoc()){
          echo " <br>HI ".$row['帳號']." ".$row['密碼']."  ".$account." ".$pwd;
          if($row['帳號']==$account && $row['密碼']==$pwd){
            
            $check = true;
            $_SESSION['login'] = $account;
            if($row['權限']=='1'){
              $_SESSION['pass'] = 'true';
            }
          }
        }
       }
        //如果沒有此（帳/密），則彈出此訊息
      if(!$check){
        echo "<script> alert('密碼或帳號錯誤，請重新輸入') </script>";
      }else {
        header("location:index.php?account=login");
      }
    }
?>
<body>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  <!-- -----------------------------------------------------主程式--------------------------------------------- -->
  <!-- -------------導覽列----------------- -->
  <header class="fixed-top">
    <div class="container-fuild mb-2">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark ps-4 pe-4">
        <a class="navbar-brand" href="index.php">
          <b>
            <h2>回首頁</h2>
          </b>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="member.php">註冊</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>
  <br><br><br>
  <!-- -----------登入--------------- -->
    <div class="modal modal-signin position-static d-block" tabindex="-1" role="dialog" id="modalSignin">
      <div class="modal-dialog " role="document">
        <div class="modal-content rounded-5 shadow">
          <div>
            <h2 class="fw-bold mb-0 text-center pt-5 pb-4">登入會員</h2>
          </div>
          <div class="modal-body p-5 pt-0  ">
            <form action="log_in.php" name="login" id="login" method="POST">
              帳號
              <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-4" id="account" placeholder="account" name="account">
              </div>
              密碼
              <div class="form-floating mb-3">
                <input type="password" class="form-control rounded-4" id="pwd" placeholder="pwd" name="pwd">
              </div>
  
              <div class="d-flex">
                <button class=" w-100 mb-4 me-4 btn btn-lg rounded-4 btn-primary" type="submit">登入</button>
                <button class=" w-100 mb-4 btn btn-lg rounded-4 btn-primary" type="reset">重填</button>
              </div>
              <div class="text-secondary text-center">
                還沒有會員帳號?
                <a href="member.php" id="decoration1" class="text-primary">註冊</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  <!-- ------------------------------------------ -->
   
  <!-- -------------網頁最下方版權聲明欄------------ -->
  <br><br><br>
  <?php include("footer.php")?>
  <!-- -------------------------------------------- -->
</body>

</html>