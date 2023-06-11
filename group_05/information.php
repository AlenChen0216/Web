<!DOCTYPE html>
<html lang="en">

<?php 
  include_once('header.php');
  if(!isset($_SESSION['login'])){
    header("location:index.php");
  }else if(isset($_SESSION['login'])){
    if($_SESSION['login']==NULL){
      header("location:index.php");
    }
  }
  if(isset($_GET['change'])){//顯示密碼變更、帳號變更、下訂單的情形
    $change = strip_tags($_GET['change']);
    $dir = strip_tags($_GET['dir']);
    if($change=='yes'){
      if($dir=="change_pwd"){
        echo "<script>alert('密碼更改成功!!');location.replace('./information.php?dir=change_pwd');</script>";
      }else if($dir=="infor"){
        echo "<script>alert('資料更改成功!!');location.replace('./information.php?dir=infor');</script>";
      }
    }else if($change=='no'){
      if($dir=="change_pwd"){
        echo "<script>alert('密碼更改失敗!!\\n請重新填寫');location.replace('./information.php?dir=change_pwd');</script>";
      }else if($dir=="infor"){
        echo "<script>alert('資料更改失敗!!\\n請重新填寫');location.replace('./information.php?dir=infor');</script>";
      }else if($dir=='shop'){
        echo "<script>alert('下定失敗!!\\n請重新來過');location.replace('./information.php?dir=infor');</script>";
      }
    }
  }
?>
<!-- --------------------------------------- -->
<br><br><br><br><br><br>
<!-- ---------------------------------------------------------------------- -->
<script>
  $(function(){
            $(document).ready(function(){
                $('a.nav_link').removeClass('active');
                $('a.nav_link').attr('aria-current','false');
                <?php 
                  if(isset($_GET['dir'])){
                    $dir = strip_tags($_GET['dir']);
                    echo "$('#".$dir."').addClass('active');
                          $('#".$dir."').attr('aria-current','page');";
                  }
                ?>
              })
          });
</script>
<div class="container">
  <!-- ---------------------左邊欄------------------------------------------- -->
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ps-4 pe-4">
      <b class="navbar-brand">會員中心</b>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent1">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a href="information.php?dir=infor" class="nav-link" id="infor">
              <svg class="bi me-2" width="16" height="16">
                <use xlink:href="#home"></use>
              </svg>
              會員資料
            </a>
          </li>
          <li class="nav-item">
            <a href="information.php?dir=change_pwd" class="nav-link" id="change_pwd">
              <svg class="bi me-2" width="16" height="16">
                <use xlink:href="#speedometer2"></use>
              </svg>
              修改密碼
            </a>
          </li>
          <?php
              if(!isset($_SESSION['pass'])){
                echo '<li class="nav-item">
              <a href="information.php?dir=list" class="nav-link" id="list">
                <svg class="bi me-2" width="16" height="16">
                  <use xlink:href="#table"></use>
                </svg>
                購買清單
              </a>
            </li>
            <li class="nav-item">
              <a href="information.php?dir=coupon" class="nav-link" id="coupon">
                <svg class="bi me-2" width="16" height="16">
                  <use xlink:href="#grid"></use>
                </svg>
                優惠卷
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="information.php?dir=shop" id="shop">
                  <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#table"></use>
                  </svg>
                  購物車
                </a>
            </li>';
            }
          ?>
          <?php
              if(isset($_SESSION['pass'])){
                echo '<li>
                <a href="./administrator.php" class="nav-link" id="admin">
                  <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#grid"></use>
                  </svg>
                  管理員
                </a>
               </li>';
              }
          ?>
        </ul>
      </div>
    </nav>
  </div>

  <!-- ---------------------------------------------------------------------- -->

  <!-- -------------------------右邊欄-------------------------------------- -->
  <?php //根據上側的項目，變更下側的內容
      if(isset($_GET['dir'])){ 
        $dir = strip_tags($_GET['dir']);
        if($dir=="change_pwd"){
          include("./membership_infor/change_pwd.html");
          //將上側的"目前選項"，根據按下的項目進行變動
          echo "<script>
            $(document).ready(function($){
                $('a.nav_link').removeClass('active');
                $('a.nav_link').attr('aria-current','false');
                $('#change').addClass('active');
                $('#change').attr('aria-current','page');
                $('#pwd').validate({
                  submitHandler: function (form) {
                    alert('更改中....');
                    form.submit();
                  },
                  rules: {
                    old: {
                      required: true,
                      minlength: 6,
                      maxlength: 12,
                    },
                    new: {
                      required: true,
                      minlength: 6,
                      maxlength: 12,
                    },
                    check: {
                      required: true,
                      equalTo: '#new',
                    },
                  },
                  messages: {
                    old: {
                      minlength: '(限6~12個字)',
                      maxlength: '(限6~12個字)'
                    },
                    new: {
                      minlength: '(限6~12個字)',
                      maxlength: '(限6~12個字)'
                    },
                    check: {
                      equalTo: '兩次密碼不同'
                    },
                  }
                });
              });
        </script>";
        }else if($dir=="infor"){
          include("./membership_infor/infor.php");
          echo "<script>
            $(document).ready(function($){
                $('a.nav_link').removeClass('active');
                $('a.nav_link').attr('aria-current','false');
                $('#infor').addClass('active');
                $('#infor').attr('aria-current','page');
                $('#information').validate({
                  submitHandler: function (form) {
                    alert('更改中....');
                    form.submit();
                  },
                  rules: {
                    email: {
                      required: true,
                      email: true,
                    },
                    name: {
                      required: true,
                    },
                    birthday:{
                      required: true,
                    },
                    address:{
                      required: true,
                    },
                    phoneNum:{
                      required:true,
                    },
                  },
                  messages: {
                  },
                });
            });
        </script>";
        }else if($dir=="list"){
          include("./membership_infor/list.php");
        }else if($dir == "shop"){
          include("./membership_infor/shopping_cart.php");
        }else if($dir == "coupon"){
          include("./membership_infor/coupon.php");
        }
        else {
          echo "<script> location.replace('index.php'); alert('錯誤分類！！')</script>";
        }
      }
      if(isset($_GET['order_id'])){
        $id = $_GET['order_id'];
        include_once('orderDetail.php');
      }
    ?>
  <!-- ---------------------------------------------------------------------- -->
</div>
<!-- -------------網頁最下方版權聲明欄------------ -->
<br><br><br><br><br>
<?php include_once("footer.php")?>

<!-- -------------------------------------------- -->
</body>

</html>