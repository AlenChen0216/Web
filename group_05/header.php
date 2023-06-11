<head>
  <!-- 自定義CSS -->
  <link rel="stylesheet" href="css/style.css" />
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

  <!-- 一些icon    -->
  <script src="https://kit.fontawesome.com/388c8d3892.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./css/cart.css">

  <title>彰師生鮮賣場</title>

</head>
<?php
//帳號系統，用session，以利網頁間傳遞與安全性
session_start();
include_once("api.php");
$place = array_filter(explode("/", $_SERVER['PHP_SELF']));
//若剛進入網頁，則"login"狀態為 NULL
if (!isset($_SESSION['login'])) {
  $_SESSION['login'] = NULL;
}
if (!isset($_SESSION['pass']) && ($place[2] == "administrator")) {
  header("location:../index.php?account=fail");
}
if (!isset($_SESSION['pass']) && array_filter(explode("/", $_SERVER['PHP_SELF']))[2] == "administrator.php") {
  header("location:./index.php?account=fail");
}
//與通往位置有關
function href()
{
  global $place;
  if ($_SESSION['login'] != "not" && $_SESSION['login'] != NULL) {
    if ($place[2] == "administrator") {
      echo '../information.php?dir=infor';
    } else {
      echo "./information.php?dir=infor";
    }
  } else
    echo "./log_in.php";
}
if (isset($_GET['account'])) { //顯示帳號登入、登出、下定、建立狀態
  $state = strip_tags($_GET['account']);
  if ($state == "success") {
    echo "<script> alert('帳號建立成功!!\\n\\n歡迎您的加入!!');location.replace('./index.php'); </script>";
  } else if ($state == "login") {
    echo "<script> alert('登入成功!!\\n\\n歡迎用戶「" . $_SESSION['login'] . "」!!');location.replace('./index.php'); </script>";
  } else if ($state == 'out') {
    echo "<script> alert('登出成功!!\\n\\n期待您再次登入!!');location.replace('./index.php'); </script>";
  } else if ($state == 'buy') {
    echo "<script> alert('下定成功!!\\n\\n請您耐心等候，並期待您再次下定!!');location.replace('./index.php'); </script>";
  } else if ($state == 'fail') {
    echo "<script> alert('權限不足');location.replace('./index.php'); </script>";
  }
}
if (isset($_GET['logout'])) { //登出時，清除購物車跟登入狀態
  if ($_GET['logout'] == true) {
    header("location:index.php?account=out");
    $_SESSION['login'] = NULL;
    unset($_SESSION['pass']);
    unset($_SESSION['cart']);
  }
}
?>

<body>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
  <script src="https://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/localization/messages_zh_TW.js "></script>
  <script>
    //購物車內商品刪除部分
    $(function () {
      $('.re').click(function () {
        $(this).closest("tr").remove();
        var content = $('.badge').html();
        $('.badge').html(content - 1);
      });
    });
    function remove(id) {
      $.ajax({
        url: './remove_cart.php',
        data: { id: id },
        type: 'POST',
        dataType: 'text',
        success: function (text) {
          alert('商品: ' + text + ' 取消成功!!');
          location.reload();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert('商品取消失敗!!');
        },
      });
    }
    function search() {
      $item = $("#search_item").val();
      location.replace("./item.php?cat=search&item=" + $item);
    }

  </script>

  <!-- Option 2: Separate Popper and Bootstrap JS   這個跟購物車下拉有關，不要動-->

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
  <!-- -----------------------------------------------------主程式--------------------------------------------- -->
  <!-- -------------導覽列----------------- -->
  <header class="fixed-top">
    <div class="container-fuild mb-2">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark ps-4 pe-4">
        <a class="navbar-brand" href="<?php
        if ($place[2] == "administrator") { //根據目前目錄，來變更位址。
          echo '../index.php';
        } else {
          echo './index.php';
        }
        ?>">
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
            <li class="nav-item d-flex">
              <!-- 根據登入狀況，決定此欄 通往 (登入/註冊) 或 (會員資訊)-->
              <?php if ($_SESSION['login'] == "not" || $_SESSION['login'] == NULL) {
              } else {
                $sql = "SELECT * FROM user_image WHERE ID IN(SELECT ID FROM 用戶 WHERE 帳號 = '".$_SESSION['login']."' )";
                $result = mysqli_query($link,$sql);
                $has = $result->fetch_array();
                if($has[1] == 1){
                  $image = $has[0]; 
                }else if($has[1]==0) {
                  $image = "default"; 
                }
                echo "<img src='./image/".$image.".png' class='rounded-3'style='width: 35px; height:35px' />";
              }
              ?>
              <a class="nav-link" href=<?php href() ?>> <?php if ($_SESSION['login'] == "not" || $_SESSION['login'] == NULL) {
                  echo "登入/註冊";
                } else {
                  echo " <u>" . $_SESSION['login'] . "</u>";
                }
                ?> </a>
            </li>
            <!-- "登出"的顯示/隱藏 -->
            <?php
            if ($_SESSION['login'] != NULL) {
              echo '<li class="nav-item">';
              if ($place[2] == "administrator") {
                echo '<a href="../index.php?logout=true" class="nav-link" id="admin">';
              } else {
                echo '<a href="./index.php?logout=true" class="nav-link" id="admin">';
              }
              echo '登出
                </a>
               </li>';
            }
            ?>
            <li class="nav-item">
              <!------        購物車下拉部分    ------->
              <?php
              if (!isset($_SESSION['pass']) && $_SESSION['login'] != NULL) {
                include("cart.php");
              }
              ?>
              <!--                  購物車下拉部分           -->
            </li>
          </ul>
          <div class="d-flex">
            <div class="input-group">
              <input class="form-control me-1" type="text" placeholder="輸入商品名稱" id="search_item" />
              <button class="btn btn-warning" type="button" onclick="search()">搜尋商品</button>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <br><br>