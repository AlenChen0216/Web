<!DOCTYPE html>
<html lang="en">

<head>
  <!-- 自定義CSS -->
  <link rel="stylesheet" href="..css/style.css" />
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

  <!-- 一些icon    -->
  <script src="https://kit.fontawesome.com/388c8d3892.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/cart.css">

  <title>彰師生鮮賣場</title>

</head>
<?php
  session_start();
  if(!isset($_SESSION['admin'])){
    header("location:../index.php");
  }else {
    if($_SESSION['admin']!='alen'){
      header("location:../index.php");
    }else {
      header("location:./addCommodity.php");
    }
  }
?>
<body>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS   這個跟購物車下拉有關，不要動-->

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <!-- -----------------------------------------------------主程式--------------------------------------------- -->
  <!-- -------------導覽列----------------- -->
  <header class="fixed-top">
    <div class="container-fuild mb-2">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark ps-4 pe-4">
        <a class="navbar-brand" href="../index.html">
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
              <a class="nav-link" href="../change_pwd.php">
              <?php 
                  echo "<i class='fa-solid fa-user fa-lg' style='color: #dddfe3;'></i> &nbsp <u>".$_SESSION['login']."</u>";
                ?>
              </a>
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
            <span class="fs-4">管理員</span>
          </a>
        </div>

        <hr>
        <div>
          <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
              <a href="commodity.html" class="nav-link active" aria-current="page">
                <svg class="bi me-2" width="16" height="16">
                  <use xlink:href="#home"></use>
                </svg>
                新增商品
              </a>
            </li>
            <li>
              <a href="deletCommodity.html" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16">
                  <use xlink:href="#speedometer2"></use>
                </svg>
                刪除商品
              </a>
            </li>
            <li>
              <a href="memberManager.html" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16">
                  <use xlink:href="#speedometer2"></use>
                </svg>
                帳號管理
              </a>
            </li>
          </ul>
        </div>
        <hr>
      </div>
    </div>
    <!-- ---------------------------------------------------------------------- -->

    <!-- -------------------------右邊欄-------------------------------------- -->
    <div class="modal-content rounded-5 shadow">
      <div>
        <h2 class="fw-bold mb-0 ps-5 pt-4 pb-3">新增商品</h2>
      </div>
      <div class="p-5 pt-0">
        <form action="">
          <div>
            <div class="row g-3 pb-2">
              <div class="col-auto">
                <label for="name" class="col-form-label">名稱:</label>
              </div>
              <div class="col-auto">
                <input type="text" class="form-control" id="name" placeholder="">
              </div>
            </div>
          </div>
          <div>
            <div class="row g-3 pb-2">
              <div class="col-auto">
                <label for="type" class="col-form-label">分類:</label>
              </div>
              <div class="col-auto">
                <input type="text" class="form-control" id="type" placeholder="">
              </div>
            </div>
          </div>
          <div>
            <div class="row g-3 pb-2">
              <div class="col-auto">
                <label for="price" class="col-form-label">價格:</label>
              </div>
              <div class="col-auto">
                <input type="text" class="form-control" id="price" placeholder="">
              </div>
            </div>
          </div>
          <div>
            <div class="row g-3 pb-2">
              <div class="col-auto">
                <label for="amount" class="col-form-label">數量:</label>
              </div>
              <div class="col-auto">
                <input type="text" class="form-control" id="amount" placeholder="">
              </div>
            </div>
          </div>
          <div class="pt-2">
            <button type="submit" class="btn btn-primary ms-5">新增商品</button>
          </div>
        </form>

      </div>
    </div>
    <!-- ---------------------------------------------------------------------- -->
  </div>
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