<!DOCTYPE html>
<html lang="en">

<?php  include_once("header.php"); 
  function find($head){
    global $link;
    if(is_numeric($head)){
      $sql = "SELECT UID,品名,庫存量,售價 FROM 商品 WhERE UID LIKE '".$head."%'";
    }else {
      $sql = "SELECT UID,品名,庫存量,售價 FROM 商品 WhERE  品名 LIKE '%".$head."%'";
    }
    
    if($result = mysqli_query($link,$sql)){
      $num = mysqli_num_rows($result);
      if($num!=0){
        echo '<div class="container d-flex flex-row flex-wrap">';
      
      while($row = $result->fetch_assoc()){
        echo '<div class="box p-2" id="itemhover">';
        echo '<a href="./item_infor.php?uid='.$row['UID'].'" id="decoration1">';
        echo '<div class="box-bg">
                <img src="./image/'.$row['UID'].'.webp" alt="...." />
              </div>';
        echo '<div class="box-text">
                <h4>'.$row['品名'].'</h4>
                <p>NT$'.$row['售價'].'</p>
              </div>
            </a>
          </div>';
      }
      echo '</div>';
      }else {
        echo "HJIHe";
      }
      
    }
  }

?>
<script>
  $(function(){
    $('a.nav_link').removeClass('active');
    $("#<?php if(isset($_GET['cat'])){$cat = strip_tags($_GET['cat']);echo $cat;}?>").addClass('active');
  })
</script>
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
            <a class="nav-link" href="item.php?cat=seafood" id="seafood">海鮮</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="item.php?cat=pork" id="pork">豬肉</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="item.php?cat=chicken" id="chicken">雞肉</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="item.php?cat=beef" id="beef">牛肉</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="item.php?cat=egg" id="egg">蛋類</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="item.php?cat=cereals" id="cereals">五穀類</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="item.php?cat=vegetable" id="vegetable">蔬菜</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="item.php?cat=fruit" id="fruit">水果</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  <!-- ------------------------商品------------------------- -->
  <?php
    if(isset($_GET['cat'])){  //(可改成ajax)
        $cat = strip_tags($_GET['cat']);
        switch($cat){
          case "seafood":
            find('1');
            break;
          case "pork":
            find('2');
            break;
          case "chicken":
            find('6');
            break;
          case "beef":
            find('8');
            break;
          case "egg":
            find('5');
            break;
          case "cereals":
            find('7');
            break;
          case "vegetable":
            find('3');
            break;
          case "fruit":
            find('4');
             break;
          case "search":
            find(trim($_GET['item']));
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