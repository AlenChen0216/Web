<!DOCTYPE html>
<html lang="en">

<?php 
  include('header.php');
  if(!isset($_SESSION['login'])){
    header("location:index.php");
  }
?>
  <!-- --------------------------------------- -->
  <br><br><br><br><br><br>
  <!-- ---------------------------------------------------------------------- -->


  <div class="container d-flex">
    <!-- ---------------------左邊欄------------------------------------------- -->
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
      <div class="dropdown">
        <div>
          <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
              <use xlink:href="#bootstrap"></use>
            </svg>
            <span class="fs-4">會員中心</span>
          </a>
        </div>

        <hr>
        <div>
          <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
              <a href="information.php?dir=infor" class="nav-link text-white" id="infor">
                <svg class="bi me-2" width="16" height="16">
                  <use xlink:href="#home"></use>
                </svg>
                會員資料
              </a>
            </li>
            <li>
              <a href="information.php?dir=change_pwd" class="nav-link text-white" id="change">
                <svg class="bi me-2" width="16" height="16">
                  <use xlink:href="#speedometer2"></use>
                </svg>
                修改密碼
              </a>
            </li>
            <li>
              <a href="information.php?dir=list" class="nav-link text-white" id="list">
                <svg class="bi me-2" width="16" height="16">
                  <use xlink:href="#table"></use>
                </svg>
                購買清單
              </a>
            </li>
            <li>
              <a href="#" class="nav-link text-white" id="cupon">
                <svg class="bi me-2" width="16" height="16">
                  <use xlink:href="#grid"></use>
                </svg>
                優惠卷
              </a>
            </li>
            <?php
              if($_SESSION['login']=="alen"){
                echo '<li>
                <a href="./administrator/addCommodity.php" class="nav-link text-white" id="admin">
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
        <hr>
      </div>
    </div>
    <!-- ---------------------------------------------------------------------- -->

    <!-- -------------------------右邊欄-------------------------------------- -->
    <?php //根據左側的項目，變更右側的內容
      if(isset($_GET['dir'])){ 
        if($_GET['dir']=="change_pwd"){
          include("./membership_infor/change_pwd.html");
          //將左側的"目前選項(藍框)"，根據按下的項目進行變動
          echo "<script>
          $(function(){
            $(document).ready(function(){
                $('a.nav_link').removeClass('active');
                $('a.nav_link').addClass('text-white');
                $('a.nav_link').attr('aria-current','false');
                $('#change').addClass('active');
                $('#change').attr('aria-current','page');
              })
          });
        </script>";
        }else if($_GET['dir']=="infor"){
          include("./membership_infor/infor.html");
          echo "<script>
          $(function(){
            $(document).ready(function(){
                $('a.nav_link').removeClass('active');
                $('a.nav_link').addClass('text-white');
                $('a.nav_link').attr('aria-current','false');
                $('#infor').addClass('active');
                $('#infor').attr('aria-current','page');
              })
          });
        </script>";
        }else if($_GET['dir']=="list"){
          include("./membership_infor/list.html");
          echo "<script>
          $(function(){
            $(document).ready(function(){
                $('a.nav_link').removeClass('active');
                $('a.nav_link').addClass('text-white');
                $('a.nav_link').attr('aria-current','false');
                $('#list').addClass('active');
                $('#list').attr('aria-current','page');
              })
          });
        </script>";
        }
      }
    ?>
    <!-- ---------------------------------------------------------------------- -->
  </div>
   <!-- -------------網頁最下方版權聲明欄------------ -->
   <br><br><br><br><br>
   <?php include("footer.php")?>
   
   <!-- -------------------------------------------- -->
</body>

</html>