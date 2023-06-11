<!DOCTYPE html>
<html lang="en">

<?php include_once("../header.php");
if (isset($_GET['uid'])) {
    $uid = trim($_GET['uid']);
    $sql = "SELECT * FROM 商品 WHERE UID = '" . $uid . "'";
    $result = mysqli_query($link, $sql);
    $item_content = $result->fetch_assoc();
    mysqli_free_result($result);
}
if(isset($_POST['name'])&&isset($_POST['number'])){ //變更商品內容
    $uid = trim($_POST['uid']);
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $number = trim($_POST['number']);
    $short = trim($_POST['short_introduce']);
    $intro = trim($_POST['introduce']);
    updateMerchandiseByUID($uid,$name,$number,$price,50,$short,$intro);
    if(isset($_FILES['imgIn'])){ //將更改後的商品圖片，移至image裡
        if (move_uploaded_file($_FILES['imgIn']['tmp_name'],"../image/".$uid.".webp")){
        }
    }
    echo "<script>location.replace('./changeCommodity.php?uid=".$uid."');alert('更改成功!!')</script>";
}
?>
<script>
    function direct_back() {
        location.replace('./allCommodity.php?page=1');
    }
    $(document).ready(function ($) {
            $.validator.addMethod("notEqualsTo", function (value, element, arg) {
                return arg != value;
            }, "您尚未選擇!");
            $("#change_item").validate({
                submitHandler: function (form) {
                    alert("請等待商品資料更改....");
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
                },
                messages: {
                    
                }
            });
        });
</script>
<br><br><br><br><br>
<!-- --------------------------------------- -->
<br>

<div class="row shadow p-3 m-3 bg-body rounded">
    <form action="./changeCommodity.php" method="POST" enctype="multipart/form-data" name="change_item"id="change_item">
        <div class="row">
            <!-- 左邊 -->
            <div class="col-lg-3">
                <h2 class="fw-bold mb-0 ps-3 pt-4 pb-4">修改商品</h2>
                <!----- 上傳圖片 ----->
                <label class="btn btn-primary ms-3 mb-2"><input id="imgIn" name="imgIn" style="display:none;" type="file"
                        accept="image/*">上傳圖片</label>
                <h6>*請上傳正方形圖片*</h6>
                <img id="img" src="../image/<?php echo $item_content['UID']; ?>.webp"
                    class="img-fluid img-thumbnail ms-3 mt-3" alt="" style="height: 260px;width:260px;">
                <!-- 圖片預覽 -->
                <script>
                    imgIn.onchange = evt => {
                        const [file] = imgIn.files
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
                        <!-- 名稱 -->
                        <tr>
                            <th scope="col" class="col-lg-1">
                                <h5>名稱</h5>
                            </th>
                            <th scope="col">
                                <div class="col-lg-6">
                                    <input type="hidden" value="<?php echo $item_content['UID']; ?>" name="uid" id="uid">
                                    <input class="form-control" type="text" value="<?php echo $item_content['品名'] ?>"
                                        id="name" name="name">
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
                                    <input class="form-control" type="text" value="<?php echo $item_content['售價'] ?>"
                                        id="price" name="price">
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
                                    <input class="form-control" type="text" value="<?php echo $item_content['庫存量'] ?>"
                                        id="number" name="number">
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
                                    <textarea class="form-control" rows="3" cols="40"
                                        id="short_introduce" name="short_introduce"><?php echo $item_content['簡短敘述'] ?></textarea>
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
                                    <textarea class="form-control" rows="6" cols="40"
                                        id="introduce" name="introduce"><?php echo $item_content['完整敘述'] ?></textarea>
                                </div>
                            </th>
                        </tr>
                    </thead>
                </table>
                <div class="ms-5">
                    <button class="btn btn-primary" onclick="direct_back()" type="button">返回商品頁面</button>
                    <button type="submit" class="btn btn-primary ms-5 mb-2" onclick="change_item()">確認修改</button>
                </div>
            </div>
    </form>
</div>
                </div>
<!-- ---------------------------------------------------------- -->

<!-- -------------網頁最下方版權聲明欄---------->
<br><br><br>
<?php include_once("../footer.php"); ?>
<!-- ------------------------------------------- -->
</body>

</html>