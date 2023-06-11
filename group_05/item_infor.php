<!DOCTYPE html>
<html lang="en">
<?php include_once('header.php');
    if(isset($_GET['uid'])){
       $uid= strip_tags($_GET['uid']);
       $sql = "SELECT * FROM 商品 WHERE UID = '".$uid."'";
       if($result = mysqli_query($link,$sql)){
        while($row = $result->fetch_assoc()){
            $name = $row['品名'];
            $img = "./image/".$uid.".webp";
            $price = $row['售價'];
            $coupon = "滿600折60";
            $review = $row['評價'];
            $total_amount = $row['庫存量'];
            $short_des = array_filter(explode(",",$row['簡短敘述']));
            $description = $row['完整敘述'];
        }
       }
       $sql = "SELECT * FROM 用戶評論 WHERE UID = '".$uid."'";
       if($result = mysqli_query($link,$sql)){
        while($row = $result->fetch_assoc()){
            $critic[] = array($row['ID'],$row['評價'],$row['評論']);
        }
       }
    }
?>
<script>
    //將商品加入購物車中
    
    function add(uid){
      $amount = $('#amount option:selected').text();
      $.ajax({
        url: './add_cart.php',
        data: {uid:uid ,amount:$amount},
        type: 'POST',
        dataType: 'text',
        success:function(text){
          alert('商品: '+text+' 加入成功!!');
          location.reload();
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert('商品加入失敗!!');
          location.replace('./item_infor.php?uid='+uid);
        },
      });
    }
</script>
  <!-- --------------------------------------- -->
  <!-- -----------商品分類--------------- -->
  <link rel="stylesheet" href="./css/star.css">
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
    <hr>
  </div>
  <!-- ----------------------------------------------- -->
  <!-- ---------------商品介紹----------------- -->
  <div class="container ">
    <div class="row p-5 pt-2">
      <div class="col-md-auto">
        <img src= <?php echo $img ?> class="img-thumbnail" alt="" width="300px" height="200px" />
      </div>
      <div class="col-md-auto">
        <form action="">
          <div class="d-flex ">
            <!-- 根據先前按下的商品名 -->
            <h2 class="fw-bold ps-5 pt-2 pb-3">商品名稱:</h2>
            <h2 class="fw-bold ps-2 pt-2 pb-3"><?php echo $name ?></h2>
          </div>

          <div class="d-flex">
            <!-- 根據sql內的商品價格 -->
            <h5 class="ps-5 pt-2">網路價:</h5>
            <h5 class="ps-2 pt-2 text-danger">NT$<?php echo $price ?></h5>
          </div>
          <div class="d-flex">
            <h5 class="ps-5 pt-2">付款方式:</h5>
            <h5 class="ps-2 pt-2 text-warning">貨到付款</h5>
          </div>
          <div class="d-flex">
            <h5 class="ps-5 pt-2">運&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;費:</h5>
            <h5 class="ps-2 pt-2 text-primary">宅配NT$100</h5>
          </div>
          <div class="d-flex">
            <!-- 跟據sql的整體優惠 -->
            <h5 class="ps-5 pt-2">優惠活動:</h5>
            <h5 class="ps-2 pt-2 text-success"><?php echo $coupon ?></h5>
          </div>
          <div class="d-flex">
            <h5 class="ps-5 pt-2">商品評價:</h5>

            <!-- -----星星評分  根據sql內的等級 ------>
            <div class="star_style">
              <style>
                #star_width {
                  /*調整寬度可變更星等*/
                  width: <?php echo $review."%" ?>;
                }
              </style>
              <div class="empty_star ps-2 pt-1">★★★★★</div>
              <div class="full_star ps-2 pt-1" id="star_width">★★★★★</div>
            </div>
            <!-- ------------- ------>

          </div>
          <div class="d-flex">
            <!-- 根據sql內的數量 -->
            <h5 class="ps-5 pt-2">購買數量:</h5>
            <div class="p-2">
              <select name="amount" id="amount" size="1">
                <?php 
                    echo '<option value=1 selected >1</option>';
                    for($i=2;$i<=$total_amount;$i++){
                        echo '<option value='.$i.'>'.$i.'</option>';
                    }
                ?>
              </select>
            </div>
          </div>
          <div class="ps-5 pt-2">
            
            <?php
                //若為訪客，則跳到登入頁面；若為使用者，則將可商品加進購物車內
                if($_SESSION['login']==NULL){
                    echo ' <a href="./log_in.php" class="w-100 btn btn-lg rounded-4 btn-primary">加入購物車</a>';
                }else if(!isset($_SESSION['pass'])){
                    if(isset($_GET['uid'])){
                        echo '<button class=" w-100 btn btn-lg rounded-4 btn-primary" type="submit" onclick="add('.$_GET['uid'].')">加入購物車</button>';
                    }
                }else {
                    echo ' <a href="./information.php?dir=infor" class="w-100 btn btn-lg rounded-4 btn-primary">加入購物車</a>';
                }
            ?>
          </div>
        </form>
      </div>
      <div class="col-md-auto pt-5">
        <div class="ps-5 pt-5">
            <?php 
                for($i=0;$i<count($short_des);$i++){
                    echo "<h5>
                    <li>".$short_des[$i]."</li>
                  </h5>";
                }
            ?>
        </div>
      </div>

    </div>
    <hr>
  </div>
  <div class="container">
    <div class="shadow-sm rounded ">
      <div class="py-5">
        <h1 class=" fw-bold text-center mb-2">商品介紹</h1>
        <div class="col-lg-6 mx-5">
            <?php
                echo nl2br($description);
            ?>
        </div>
        <h1 class=" fw-bold text-center mb-2">評價與留言</h1>
        <div class="table-responsive mx-2">
          <table class="table align-middle">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">評價</th>
                <th scope="col">留言</th>
              </tr>
            </thead>
            <tbody>
                <?php
                  if(isset($critic)){
                    for($i=0;$i<count($critic);$i++){
                        echo '<tr>
                        <th scope="row">'.$critic[$i][0].'</th>
                        <td>
                         <!-- -----星星評分 ------>
                        <div class="star_style">
                        <div class="empty_star">★★★★★</div>
                        <!-- 百分之幾就是幾顆星 -->
                        <div class="full_star" style="width: '.$critic[$i][1].'%;">★★★★★</div>
                        </div>
                        <!-- ------------- ------>
                        </td>
                        <td> '.$critic[$i][2].'</td>
                        </tr>';
                    }
                  }
                    
                    
                ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  </div>
  <!-- ---------------------------------------------------- -->

  <!-- -------------網頁最下方版權聲明欄------------ -->
    <?php include_once('footer.php') ?>
  <!-- -------------------------------------------- -->
</body>

</html>