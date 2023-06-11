<!DOCTYPE html>
<html lang="en">

<?php include_once("header.php");
if (!isset($_GET['page'])) {
  $_GET['page'] = 1;
}
?>
<br><br><br><br><br><br>
<!-- --------------------------------------- -->
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


<!-- ----------------公告 ------------------------>
<div class="container">
  <?php
  $length = 4;
  $data = show_all("公告", $length, 1,null);
  for ($i = 0; $i < $length; $i++) {
    if (!isset($data['data'][$i])) {
      break;
    }
    echo '<div class="row shadow p-1 m-1 bg-body rounded">
      <div class="row">
        <div class="col-lg-4">
          <img src="./image/'.$data['data'][$i][0].'.webp" class="img-fluid ms-1 mt-3 mb-3" alt="..." style="height: 270px;width:380px;">
        </div>
        <div class="col-lg-8">
          <h1>
            <div class="fw-bolder pt-2 text-info fst-italic">'.$data['data'][$i][1].'</div>
          </h1>
          <div class="fst-italic"><u>'.$data['data'][$i][3].'</u></div>
          <h5>
            <div class="text-break fw-bolder lh-base">'.nl2br($data['data'][$i][2]).'</div>
          </h5>
        </div>
      </div>
    </div>';
  }
  ?>

  <?php echo "<br>".$data['page'];?>
<!-- ----------------公告 ------------------------>
</div>

<!-- -------------網頁最下方版權聲明欄------------ -->
<br><br><br>
<?php include_once("footer.php") ?>
<!-- -------------------------------------------- -->
</body>

</html>