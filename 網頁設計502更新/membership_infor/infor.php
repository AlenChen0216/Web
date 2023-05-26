<?php 
  if(!isset($_SESSION['login'])){
    header("location:index.php");
  }else if(isset($_SESSION['login'])){
    if($_SESSION['login']==NULL){
      header("location:index.php");
    }
  }
  $sql = "SELECT * FROM 用戶 WHERE 帳號 = '".$_SESSION['login']."'";
  if($result = mysqli_query($link,$sql)){
    $row = $result->fetch_assoc();
  }
?>

<link rel="stylesheet" href="./css/error.css">
<br>
<div class="row shadow p-3 m-3 bg-body rounded">
  <form action="change_infor.php" name="information" id="information" method="POST">
    <div class="row">
      <!-- 左邊 -->
      <div class="col-lg-3">
        <h2 class="fw-bold mb-0 ps-3 pt-4 pb-4">會員資料</h2>
        <img src="image/素材1.jpg" class="img-fluid img-thumbnail ms-3 mt-3" alt="..." style="height: 260px;width:260px;">
      </div>
      <!-- 右邊 -->
      <div class="col-lg-9">
        <br><br><br><br>
        <table class="table table-borderless table-responsive ms-3">
          <thead>
            <!-- 帳號 -->
            <tr>
              <th scope="col" class="col-lg-1">
                <h5>帳號:</h5>
              </th>
              <th scope="col">
                <div class="col-lg-6">
                  <input class="form-control" type="text" value=<?php echo $row['帳號'] ?> id="account" disabled readonly>
                </div>
              </th>
            </tr>
            <!-- 姓名 -->
            <tr>
              <th scope="col" class="col-lg-1">
                <h5>姓名:</h5>
              </th>
              <th scope="col">
                <div class="col-lg-6">
                  <input class="form-control" type="text" value=<?php echo $row['姓名'] ?> id="account">
                </div>
              </th>
            </tr>
            <!-- 信箱 -->
            <tr>
              <th scope="col" class="col-lg-1">
                <h5>信箱:</h5>
              </th>
              <th scope="col">
                <div class="col-lg-6">
                  <input type="text" class="form-control" id="email" name="email" placeholder=""
                    value=<?php echo $row['信箱'] ?>>
                </div>
              </th>
            </tr>
            <!-- 生日 -->
            <tr>
              <th scope="col" class="col-lg-1">
                <h5>生日:</h5>
              </th>
              <th scope="col">
                <div class="col-lg-6">
                  <input class="form-control" type="date" name="birthday" id="birthday" value=<?php echo $row['生日'] ?>>
                </div>
              </th>
            </tr>
            <!-- 地址 -->
            <tr>
              <th scope="col" class="col-lg-1">
                <h5>地址:</h5>
              </th>
              <th scope="col">
                <div class="col-lg-6">
                  <input class="form-control" type="text" value=<?php echo $row['地址'] ?> id="address">
                </div>
              </th>
            </tr>
            <!-- 電話 -->
            <tr>
              <th scope="col" class="col-lg-1">
                <h5>電話:</h5>
              </th>
              <th scope="col">
                <div class="col-lg-6">
                  <input class="form-control" type="text" value=<?php echo $row['電話'] ?> id="phoneNum" >
                </div>
              </th>
            </tr>
          </thead>
          <tbody>
            <!-- 性別 -->
            <tr>
              <th scope="col" class="col-lg-1">
                <h5>性別:</h5>
              </th>
              <th scope="col">
                <div class="col-lg-6">
                  <input type="radio" class="radio-inline" id="gender" name="gender" <?php 
                          if($row['性別']=="男"){
                          echo 'checked';
                        }
                  ?> value='1'>
                  <label class="form-check-label" for="gender1">
                    男
                  </label>
                  <input type="radio" class="radio-inline" id="gender" name="gender" <?php 
                          if($row['性別']=="女"){
                          echo 'checked';
                        }
                  ?> value='2'>
                  <label class="form-check-label" for="gender1">
                    女
                  </label>
                </div>
              </th>
            </tr>
          </tbody>
        </table>
        <div class="ms-5">
          <label class="btn btn-primary ms-5 mb-2"><input id="upload_img" style="display:none;" type="file"
              accept="image/*">上傳圖片</label>
          <button type="submit" class="btn btn-primary ms-5 mb-2">確認修改</button>
          <button type="submit" class="btn btn-primary ms-5 mb-2">登出會員</button>
          <h6 class="ms-2"> &nbsp;*圖片請上傳正方形圖片*</h6>
        </div>
      </div>
    </div>
  </form>
</div>