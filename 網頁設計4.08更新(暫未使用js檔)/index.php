<!DOCTYPE html>
<html lang="en">

<head>
  <!-- 自定義CSS -->
  <link rel="stylesheet" href="css/style.css" />
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

  <!-- 一些icon    -->
  <script src="https://kit.fontawesome.com/388c8d3892.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./css/cart.css">

  <title>彰師生鮮賣場</title>

</head>
<?php
  //帳號系統，用session，以利網頁間傳遞與安全性
  session_start();
  //若剛進入網頁，則"login"狀態為 NULL
  if(!isset($_SESSION['login'])){
    $_SESSION['login'] = NULL;
  }
  //與通往位置有關
  function href(){
    if($_SESSION['login']!="not"&&$_SESSION['login']!=NULL){
      echo "./change_pwd.php";
    }else echo "./log_in.php";
  }
  if(isset($_GET['logout'])){
    if($_GET['logout']==true){
      header("location:index.php");
      $_SESSION['login'] = NULL;
    }
  }
?>

<body>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script>
    //購物車內商品刪除部分
    $(function() {
      $('.re').click(function() {
        console.log("HIFJG");
        $(this).closest("tr").remove();
        var content = $('.badge').html();
        $('.badge').html(content - 1);
      });
    });
  </script>

  <!-- Option 2: Separate Popper and Bootstrap JS   這個跟購物車下拉有關，不要動-->

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
  <!-- -----------------------------------------------------主程式--------------------------------------------- -->
  <!-- -------------導覽列----------------- -->
  <header class="fixed-top">
    <div class="container-fuild mb-2">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark ps-4 pe-4">
        <a class="navbar-brand" href="index.html">
          <b>
            <h2>彰師生鮮賣場</h2>
          </b>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <!-- 根據登入狀況，決定此欄 通往 (登入/註冊) 或 (會員資訊)-->
              <a class="nav-link" href=<?php href() ?>> <?php if($_SESSION['login']=="not"||$_SESSION['login']==NULL){
                                                                echo "登入/註冊";
                                                              }else {
                                                                echo "<i class='fa-solid fa-user fa-lg' style='color: #dddfe3;'></i> &nbsp <u>".$_SESSION['login']."</u>";
                                                              }
                                                        ?> </a>
            </li>
            <!-- "登出"的顯示/隱藏 -->
            <?php
              if($_SESSION['login']!=NULL){
                echo '<li class="nav-item">
                <a href="./index.php?logout=true" class="nav-link" id="admin">
                  登出
                </a>
               </li>';
              }
            ?>
            <li class="nav-item">
              <!------        購物車下拉部分    ------->
              <div class="dropdown">
                <div class="dropdown ml-auto">
                  <button type="button" class="btn" data-toggle="dropdown">
                    <i class="fas fa-cart-plus" style="color: white;"></i>
                    <span class="badge badge-pill badge-warning">2</span>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuReference"
                    style="min-width:400px;">
                    <div class="px-4 py-3">
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col"></th>
                            <th scope="col">商品名稱</th>
                            <th scope="col">數量</th>
                            <th scope="col">小計</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!--   車內商品   -->
                          <tr>
                            <th scope="row">
                              <a id="remove" class="re" href="#">
                                <i class="fas fa-trash-alt"></i>
                            </th>
                            <td>吳郭魚</td>
                            <td>1隻</td>
                            <td class="text-right">$65</td>
                          </tr>
                          <tr>
                            <th scope="row">
                              <a id="remove" class="re" href="#">
                                <i class="fas fa-trash-alt"></i>
                              </a>
                            </th>
                            <td>小卷</td>
                            <td>1盒</td>
                            <td class="text-right">$100</td>
                          </tr>
                        </tbody>
                      </table>
                      <a href="#" class="btn btn-primary btn-block"> 結帳去</a>
                    </div>
                  </div>
                </div>
                <!--                  購物車下拉部分           -->
            </li>
          </ul>
          <form class="d-flex">
            <div class="input-group">
              <input class="form-control me-1" type="text" placeholder="輸入商品名稱" />
              <button class="btn btn-warning" type="submit">搜尋商品</button>
            </div>
          </form>
        </div>
      </nav>
    </div>
  </header>
  <br><br>
  <!-- --------------------------------------- -->

  <!-- -------------公告----------------- -->
  <div class="container-fuild mb-5">
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="4000">
          <a href=""><img src="image/彰師生鮮賣場.png" class="d-block w-100" alt="..."></a>
          <!--  如果要加文字可以這樣做:
             <div class="carousel-caption d-none d-md-block">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div> 
        -->
        </div>
        <div class="carousel-item" data-bs-interval="4000">
          <a href=""><img src="image/彰師生鮮賣場.png" class="d-block w-100" alt="..."></a>
        </div>
        <div class="carousel-item" data-bs-interval="4000">
          <a href=""><img src="image/彰師生鮮賣場.png" class="d-block w-100" alt="..."></a>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <!-- ---------------------------------------------------------- -->

  <!-- -----------商品分類--------------- -->
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ps-4 pe-4">
      <b class="navbar-brand"> |商品分類| </b>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent1">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="seafood.html">海鮮</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pork.html">豬肉</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="chicken.html">雞肉</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="beef.html">牛肉</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="egg.html">蛋類</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cereals.html">五穀類</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vegetable.html">蔬菜</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="fruit.html">水果</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  <!-- ---------------------------------------------------------- -->

  <!-- ------------------------商品------------------------- -->
  <div class="container d-flex flex-row flex-wrap">

    <!-- 商品1 -->
    <div class="box p-2" id="itemhover">
      <a href="seafoodItem/item1.html" id="decoration1">
        <div class="box-bg">
          <img src="image/seafood/吳郭魚.jpg" alt="" />
        </div>
        <div class="box-text">
          <h4>吳郭魚</h4>
          <p>NT$65</p>
        </div>
      </a>
    </div>
    <!-- 商品2 -->
    <div class="box p-2" id="itemhover">
      <a href="seafoodItem/item2.html" id="decoration1">
        <div class="box-bg">
          <img src="image/seafood/小卷.jpg" alt="" />
        </div>
        <div class="box-text">
          <h4>小卷</h4>
          <p>NT$100</p>
        </div>
      </a>
    </div>
    <!-- 商品3 -->
    <div class="box p-2" id="itemhover">
      <a href="" id="decoration1">
        <div class="box-bg">
          <img src="image/seafood/無毒大白蝦.jpg" alt="" />
        </div>
        <div class="box-text">
          <h4>無毒大白蝦</h4>
          <p>NT$500</p>
        </div>
      </a>
    </div>
    <!-- 商品4 -->
    <div class="box p-2" id="itemhover">
      <a href="" id="decoration1">
        <div class="box-bg">
          <img src="image/seafood/厚切比目魚.jpg" alt="" />
        </div>
        <div class="box-text">
          <h4>厚切比目魚</h4>
          <p>NT$800</p>
        </div>
      </a>
    </div>

  </div>
  <!-- --------------------------------------------------- -->
  <!-- -------------網頁最下方版權聲明欄------------ -->
  <br><br><br>
  <div class="bg-dark text-secondary px-5 py-4 text-center">
    <div class="py-5">
      <h1 class=" fw-bold text-white">版權聲明</h1>
      <div class="col-lg-6 mx-auto">
        <p class="fs-5 mb-4">此網站內容僅供國立彰化師範大學課程"網際網路資料庫程式設計"期末專題使用，請勿用於商業或者其他用途</p>
      </div>
    </div>
  </div>
  <!-- -------------------------------------------- -->
</body>

</html>