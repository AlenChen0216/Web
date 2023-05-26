<!DOCTYPE html>
<html lang="en">
<!-- 目前缺一些頁面內容 e.g. 圖片....，送出後跳轉 主頁面 或 登入畫面的部份。 -->

<head>
    <!-- 自定義CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- 帳號驗證 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/localization/messages_zh_TW.js "></script>

    <title>彰師生鮮賣場</title>

    <script>
        $(document).ready(function ($) {
            $.validator.addMethod("notEqualsTo", function (value, element, arg) {
                return arg != value;
            }, "您尚未選擇!");
            $("#Member").validate({
                submitHandler: function (form) {
                    alert("請等待會員建立....");
                    form.submit();
                },
                rules: {
                    account: {
                        required: true,
                        minlength: 4,
                        maxlength: 10
                    },
                    pwd: {
                        required: true,
                        minlength: 6,
                        maxlength: 12
                    },
                    pwd2: {
                        required: true,
                        equalTo: "#pwd"
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    birthday: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    agree: {
                        required: true
                    },
                },
                messages: {
                    account: {
                        required: "必填",
                        minlength: "(限4~10個字)",
                        maxlength: "(限4~10個字)"
                    },
                    pwd: {
                        minlength: "(限6~12個字)",
                        maxlength: "(限6~12個字)"
                    },
                    pwd2: {
                        equalTo: "兩次密碼不同"
                    },
                }
            });
        });
    </script>
    <link rel="stylesheet" href="./css/error.css">
</head>

<body>
<?php
    session_start();
    $host = "localhost";
    $dbuser ="root";
    $dbpassword = "root123456";
    $dbname = "group_05";
    $link = mysqli_connect($host,$dbuser,$dbpassword,$dbname) or die("無法開啟MySQL資料庫連結!<br>"); //連結SQL
    mysqli_query($link,'SET CHARACTER SET utf8');//當在資料表儲存中文欄位值時，PHP程式在執行SQL查詢前，可設定使用中文內碼的字元集和校對
    mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");
    //驗證會員資訊是否正確，以及是否已經在資料庫內
    if(isset($_POST['account'])&&isset($_POST['pwd'])){
        //防止xss攻擊
        $account = strip_tags($_POST['account']);
        $pwd = strip_tags($_POST['pwd']);
        $email = strip_tags($_POST['email']);
        //$pwd = md5($pwd,);
        $phone = strip_tags("0909090909");
        $home = strip_tags("彰化市彰化是");
        $name = strip_tags("五條");
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "<script>alert('Email格式不對，請重新輸入')</script>";
        }else {  
            $sql = "SELECT * FROM 用戶 WHERE 帳號 = "."'".$_POST['account']."' OR 信箱 = "."'".$_POST['email']."'" ;
            $che = false;
            $gender = array(1=>"男","女");
            if($result = mysqli_query($link,$sql)){
                while($row = $result->fetch_array()){
                    $che = true;
                }
            }
            $sql = "SELECT MAX(CONVERT(ID,UNSIGNED)) FROM 用戶";
            $id;
            if($result = mysqli_query($link,$sql)){
                while($row = $result->fetch_array()){
                    $id = $row[0]+1;
                }
            }
            if(!$che){
                //新增會員資料。
                $sql = "insert into 用戶 values( '".$id."' , '".$account."' , '".$pwd."'  , '".$_POST['birthday']."' , '".$phone."' , '".$home."' , 0 , '".$name."' , '".$email."' , '".$gender[$_POST['gender']]."' )";
                $result = mysqli_query($link,$sql);
                echo "<script> location.replace('index.php?account=success');</script>";
            }else{
                echo "<script>alert('資料已存在，請重新填寫')</script>";
            }
        }
    }
    
?>
    <!-- Button trigger modal -->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <!-- -----------------------------------------------------主程式--------------------------------------------- -->
    <!-- -------------導覽列----------------- -->
    <header class="fixed-top">
        <div class="container-fuild mb-5">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark ps-4 pe-4">
                <a class="navbar-brand" href="./index.php">
                    <b>
                        <h2>回首頁</h2>
                    </b>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="./log_in.php">登入</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <br><br><br>
    <?php foreach($_SESSION['account'] as $value){ echo $value." ";}echo "<br>" ;foreach($_SESSION['pwd'] as $value){ echo $value." ";} ?>
    <!--------------------------------- 會員註冊的填寫欄 ------------------------------------>
    <div class="modal-dialog " role="document">
        <div class="modal-content rounded-5 shadow">
            <div>
                <h2 class="fw-bold mb-0 text-center pt-5 pb-3">註冊會員</h2>
            </div>
            <div class="modal-body p-5 pt-0  ">
                <form action="member.php" name="Member" id="Member" method="POST">
                    <div>
                        <!-- 帳號 -->
                        帳號(限4~10個字)
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-4" id="account" name="account"
                                placeholder="account">
                        </div>
                    </div>

                    <!-- 密碼 -->
                    <div>
                        密碼(限6~12個字)
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-4" id="pwd" name="pwd" placeholder="pwd">
                        </div>
                    </div>

                    <!-- 密碼確認 -->
                    <div>
                        密碼確認
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-4" id="pwd2" name="pwd2"
                                placeholder="pwd2">
                        </div>
                    </div>

                    <!-- 信箱 -->
                    <div>
                        E-mail
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-4" id="email" name="email"
                                placeholder="example@gmail.com">
                        </div>
                    </div>
                    <div>
                        生日
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control rounded-4" name="birthday" id="birthday">
                        </div>
                    </div>
                    <!-- 性別 -->
                    <div class="d-flex justify-content-center p-3">
                        <label class=" control-label">性別：&nbsp;&nbsp;</label>
                        <div>
                            <input type="radio" class="radio-inline" id="gender1" name="gender" value="1">男&nbsp;&nbsp;
                            <input type="radio" class="radio-inline" id="gender2" name="gender" value="2">女
                            <label for="gender" class="error"></label>
                        </div>
                    </div>
                    <!-- 條款 -->
                    <div class="form-group row justify-content-center">
                        <div class="col-auto">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="agree" name="agree"> 我同意 <button type="button"
                                        class="btn btn-md text-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        服務條款
                                    </button>
                                </label>
                                <label class="error" for="agree"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        &nbsp;
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="w-100 mb-4 me-4 btn btn-lg rounded-4 btn-primary" type="submit">註冊</button>
                        <button class="w-100 mb-4 btn btn-lg rounded-4 btn-primary" type="reset">重填</button>
                    </div>
                    <div class="row">
                        &nbsp;
                    </div>
                    <div class="text-secondary text-center">
                        已經有會員帳號?
                        <a href="log_in.php" id="decoration1" class="text-primary">登入</a>
                    </div>
                </form>
            </div>
        </div>
        <!------------------------------------ 會員註冊的填寫欄 --------------------------->
    </div>

    <!-- 服務條款的彈出畫面 -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">服務條款</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!--------- 條款內容 -------->
                <div class="modal-body">
                    abcd <br>
                    defg <br>
                    dssd <br>
                </div>
                <!---------條款內容 -------->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- 服務條款的彈出畫面 -->

    <!-- -------------網頁最下方版權聲明欄------------ -->
    <br><br><br>
    <?php include("footer.php") ?>
    <!-- -------------------------------------------- -->
</body>

</html>