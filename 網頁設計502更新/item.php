<!DOCTYPE html>
<html lang="en">

<?php  include_once("header.php"); ?>
  <!-- --------------------------------------- -->

  <!-- -----------商品分類--------------- -->
  <br><br><br><br><br>
  <div class="container mb-2">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ps-4 pe-4">
      <b class="navbar-brand"> |商品分類| </b>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent1">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="item.php?cat=seafood">海鮮</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="item.php?cat=pork">豬肉</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="item.php?cat=chicken">雞肉</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="item.php?cat=beef">牛肉</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="item.php?cat=egg">蛋類</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="item.php?cat=cereals">五穀類</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="item.php?cat=vegetable">蔬菜</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="item.php?cat=fruit">水果</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  <!-- ------------------------商品------------------------- -->
  <?php
    if(isset($_GET['cat'])){ 
        $cat = strip_tags($_GET['cat']);
        switch($cat){
          case "seafood":
            include("./items/seafood.html");
            break;
          case "pork":
            include("./items/pork.html");
            break;
          case "chicken":
            include("./items/chicken.html");
            break;
          case "beef":
            include("./items/beef.html");
            break;
          case "egg":
            include("./items/egg.html");
            break;
          case "cereals":
            include("./items/cereals.html");
            break;
          case "vegetable":
            include("./items/vegetable.html");
            break;
          case "fruit":
             include("./items/fruit.html");
             break;
          default :
            echo "<script> location.replace('index.php'); alert('錯誤分類！！')</script>";
            break;
        }
        echo '';
      }else if(!isset($_GET['cat'])){
        echo "<script> location.replace('index.php'); alert('錯誤分類！！')</script>";
      }
  ?>
  <!-- --------------------------------------------------- -->

   <!-- -------------網頁最下方版權聲明欄------------ -->
   <br><br><br>
   <?php include_once("footer.php")?>
   <!-- -------------------------------------------- -->
</body>

</html>