<!DOCTYPE html>
<html lang="en">

  <?php include_once("header.php") ?>
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
  <br>
  <!-- ---------------------------------------------------------- -->
  <div class="container">
    <h3><b>&nbsp;&nbsp;精選商品</b></h3>
  </div>
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
  <?php include_once("footer.php")?>
  <!-- -------------------------------------------- -->
</body>

</html>