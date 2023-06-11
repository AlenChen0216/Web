<!DOCTYPE html>
<html lang="en">

<?php include_once("header.php");
function popular()
{
  global $link;
  $sql = "SELECT UID,品名,庫存量,售價 FROM 商品 WhERE UID LIKE '%0' ";
  if ($result = mysqli_query($link, $sql)) {
    echo '<div class="container d-flex flex-row flex-wrap">';
    while ($row = $result->fetch_assoc()) {
      echo '<div class="box p-2" id="itemhover">';
      echo '<a href="./item_infor.php?uid=' . $row['UID'] . '" id="decoration1">';
      echo '<div class="box-bg">
                  <img src="./image/' . $row['UID'] . '.webp" alt="...." />
                </div>';
      echo '<div class="box-text">
                  <h4>' . $row['品名'] . '</h4>
                  <p>NT$' . $row['售價'] . '</p>
                </div>
              </a>
            </div>';
    }
    echo '</div>';
  }
}
?>
<!-- --------------------------------------- -->
<style>
  .carousel-inner img {
    margin: auto;
  }
</style>
<!-- -------------公告----------------- -->
<div class="container-fuild mb-5">
  <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
        <?php //公告數量
          $sql = "SELECT 公告id FROM 公告";
          $result = mysqli_query($link,$sql);
          $amount = mysqli_num_rows($result);
          for($i=1;$i<=$amount;$i++){
            echo '<button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="'.$i.'" aria-label="Slide '.($i+1).'"></button>';
          }
          mysqli_free_result($result);
        ?>
    </div>
    <div class="carousel-inner  justify-content-center">
      <div class="carousel-item active" data-bs-interval="4000">
        <a href="./announcement.php"><img src="image/彰師生鮮賣場.png" class="d-block w-100" alt="..."></a>
        <!--  如果要加文字可以這樣做:
             <div class="carousel-caption d-none d-md-block">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div> 
        -->
      </div>
      <?php  //公告圖片
        $sql = "SELECT 公告id,標題 FROM 公告";
        $result = mysqlI_query($link,$sql);
        while($row = $result->fetch_assoc()){
          echo '<div class="carousel-item" data-bs-interval="4000">
          <a href="./announcement.php" class=" justify-content-center"><img src="image/'.$row['公告id'].'.webp" class="d-block w-50 "
              alt="..."></a>
        </div>';
        }
        mysqli_free_result($result);
      ?>
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

<?php popular(); ?>

<!-- --------------------------------------------------- -->
<!-- -------------網頁最下方版權聲明欄------------ -->
<?php include_once("footer.php") ?>
<!-- -------------------------------------------- -->
</body>

</html>