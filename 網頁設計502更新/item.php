<!DOCTYPE html>
<html lang="en">

  <?php include("header.php") ?>
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
        if($_GET['cat']=="seafood"){
          include("./items/seafood.html");
        }else if($_GET['cat']=="pork"){
          include("./items/pork.html");
        }else if($_GET['cat']=="chicken"){
          include("./items/chicken.html");
        }else if($_GET['cat']=="beef"){
            include("./items/beef.html");
        }else if($_GET['cat']=="egg"){
            include("./items/egg.html");
        }else if($_GET['cat']=="cereals"){
            include("./items/cereals.html");
        }else if($_GET['cat']=="vegetable"){
            include("./items/vegetable.html");
        }else if($_GET['cat']=="fruit"){
            include("./items/fruit.html");
        }
      }
  ?>
  <!-- --------------------------------------------------- -->

   <!-- -------------網頁最下方版權聲明欄------------ -->
   <br><br><br>
   <?php include("footer.php")?>
   <!-- -------------------------------------------- -->
</body>

</html>