<!DOCTYPE html>
<html lang="en">


<?php
  include("../header.php");
  if(!isset($_SESSION['pass'])){
    header("location:../index.php");
  }
?>

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