<!DOCTYPE html>
<html lang="en">

<?php include_once("../header.php");
if(isset($_POST['name'])&&isset($_POST['price'])){//新增商品
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $number = trim($_POST['number']);
    $short = trim($_POST['short']);
    $intro = trim($_POST['introduce']);
    $type = trim($_POST['type']);
    $uid = "0";
    $sql = "SELECT MAX(CONVERT(UID,UNSIGNED)) FROM 商品 WHERE UID LIKE '".$type."%'";
    $result = mysqli_query($link,$sql);
    if($row = $result->fetch_array()){
        $uid = $row[0]+1;
    } 
    appendMerchandise($uid,$name,$number,$price,0,$short,$intro);
    if(isset($_FILES['imgInp'])){ //將商品圖片根據uid改名，並移至image裡
        if (move_uploaded_file($_FILES['imgInp']['tmp_name'],"../image/".$uid.".webp")){
            echo "<script>location.replace('./allCommodity.php?page=1');alert('商品新增成功!!')</script>";
        }
    }
}
?>
<script>
    function direct_back() {
        location.replace('../administrator.php');
    }
    $(document).ready(function ($) {
            $.validator.addMethod("notEqualsTo", function (value, element, arg) {
                return arg != value;
            }, "您尚未選擇!");
            $("#add_item").validate({
                submitHandler: function (form) {
                    alert("請等待商品建立....");
                    form.submit();
                },
                rules: {
                    name: {
                        required: true,
                    },
                    price: {
                        required: true,
                    },
                    number: {
                        required: true,
                    },
                    short: {
                        required: true,
                    },
                    introduce: {
                        required: true
                    },
                    type: {
                        required: true
                    },
                    imgInp: {
                        required: true
                    },
                },
                messages: {
                    
                }
            });
        });
</script>
<link rel="stylesheet" href="./css/error.css">
    <br><br><br><br><br>
    <!-- --------------------------------------- -->
    <br>

    <div class="row shadow p-3 m-3 bg-body rounded">
        <form action="./addCommodity.php" method="POST" enctype="multipart/form-data" name="add_item"id="add_item">
            <div class="row">
                <!-- 左邊 -->
                <div class="col-lg-3">
                    <h2 class="fw-bold mb-0 ps-3 pt-4 pb-4">新增商品</h2>
                    <!----- 上傳圖片 ----->
                    <label class="btn btn-primary ms-3 mb-2"><input id="imgInp" name="imgInp" style="display:none;"
                            type="file" accept="image/*">上傳圖片</label>
                    <h6>*請上傳正方形圖片*</h6>
                    <img id="img"  src="../image/add_default.jpg" class="img-fluid img-thumbnail ms-3 mt-3" alt="商品照片"
                        style="height: 260px;width:260px;">
                    <!-- 圖片預覽 -->
                    <script>
                        imgInp.onchange = evt => {
                            const [file] = imgInp.files
                            if (file) {
                                img.src = URL.createObjectURL(file)
                            }
                        }
                    </script>
                    <!-- 圖片預覽 -->
                    <!----- 上傳圖片 ----->
                </div>
                <!-- 右邊 -->
                <div class="col-lg-9">
                    <br><br><br><br>
                    <table class="table table-borderless table-responsive ms-3">
                        <thead>
                            <!--類型 -->
                            <tr style="vertical-align: middle;">
                                <th scope="col" class="col-lg-1">
                                    <h5>類型</h5>
                                </th>
                                <th scope="col">
                                    <div class="col-lg-6">
                                        <select name="type" id="type">
                                            <option value="1">海鮮</option>
                                            <option value="2">豬肉</option>
                                            <option value="3">蔬菜</option>
                                            <option value="4">水果</option>
                                            <option value="5">雞蛋</option>
                                            <option value="6">雞肉</option>
                                            <option value="7">五穀雜糧</option>
                                            <option value="8">牛肉</option>
                                        </select>
                                    </div>
                                </th>
                            </tr>
                            <!-- 名稱 -->
                            <tr>
                                <th scope="col" class="col-lg-1">
                                    <h5>名稱</h5>
                                </th>
                                <th scope="col">
                                    <div class="col-lg-6">
                                        <input class="form-control" type="text" placeholder="名稱" id="name" name="name">
                                    </div>
                                </th>
                            </tr>
                            <!-- 價格 -->
                            <tr>
                                <th scope="col" class="col-lg-1">
                                    <h5>價格</h5>
                                </th>
                                <th scope="col">
                                    <div class="col-lg-6">
                                        <input class="form-control" type="text" placeholder="價格" id="price" name="price">
                                    </div>
                                </th>
                            </tr>
                            <!-- 數量 -->
                            <tr>
                                <th scope="col" class="col-lg-1">
                                    <h5>數量</h5>
                                </th>
                                <th scope="col">
                                    <div class="col-lg-6">
                                        <input class="form-control" type="text" placeholder="數量" id="number" name="number">
                                    </div>
                                </th>
                            </tr>
                            <!-- 簡介 -->
                            <tr style="vertical-align: middle;">
                                <th scope="col" class="col-lg-1">
                                    <h5>簡介</h5>
                                </th>
                                <th scope="col">
                                    <div class="col-lg-6">
                                        <textarea class="form-control" rows="3" cols="40" id="short" name="short" placeholder="簡介"></textarea>
                                    </div>
                                </th>
                            </tr>
                            <!-- 詳細介紹 -->
                            <tr style="vertical-align: middle;">
                                <th scope="col" class="col-lg-1">
                                    <h5>詳細 <br> 介紹</h5>
                                </th>
                                <th scope="col">
                                    <div class="col-lg-6">
                                        <textarea class="form-control" rows="6" cols="40" id="introduce" name="introduce" placeholder="詳細介紹"></textarea>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <div class="ms-5">
                        <button type="button" class="btn btn-primary  ms-5 mb-2" onclick="direct_back()">返回管理選項</button>
                        <button type="submit" class="btn btn-primary ms-5 mb-2" >確認新增</button>
                        <button type="reset" class="btn btn-primary ms-5 mb-2">清除表單</button>

                    </div>
                </div>
        </form>

    </div>
    </div>

    <!-- ---------------------------------------------------------- -->

    <!-- -------------網頁最下方版權聲明欄---------->
    <br><br><br>
    <?php include_once("../footer.php")?>
    <!-- ------------------------------------------- -->
</body>

</html>