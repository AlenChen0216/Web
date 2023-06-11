<!DOCTYPE html>
<html lang="en">

<?php include_once("../header.php");
if (isset($_GET['aid'])) {
    $aid = trim($_GET['aid']);
    $sql = "SELECT * FROM 公告 WHERE 公告id = '" . $aid . "'";
    $result = mysqli_query($link, $sql);
    $ann_content = $result->fetch_assoc();
    mysqli_free_result($result);
}
if (isset($_POST['title']) && isset($_POST['start'])) { //變更商品內容
    $aid = trim($_POST['aid']);
    $title = trim($_POST['title']);
    $start = trim($_POST['start']);
    $end = trim($_POST['end']);
    $content = trim($_POST['content']);
    updateAnn($aid, $title, $start, $end, $content);
    if (isset($_FILES['imgIn'])) { //將更改後的商品圖片，移至image裡
        if (move_uploaded_file($_FILES['imgIn']['tmp_name'], "../image/" . $aid . ".webp")) {
        }
    }
    echo "<script>location.replace('./change_Ann.php?aid= " . $aid . " ');alert('更改成功!!')</script>";
}
?>
<script>
    function direct_back() {
        location.replace('./allAnn.php?page=1');
    }
    $(document).ready(function ($) {
        $.validator.addMethod("notEqualsTo", function (value, element, arg) {
            return arg != value;
        }, "您尚未選擇!");
        $("#change_ann").validate({
            submitHandler: function (form) {
                alert("請等待公告資料更改....");
                form.submit();
            },
            rules: {
                title: {
                    required: true,
                },
                start: {
                    required: true,
                },
                end: {
                    required: true,
                },
                content: {
                    required: true,
                },
            },
            messages: {

            }
        });
    });
</script>
<br><br><br><br><br>
<link rel="stylesheet" href="../css/error.css">
<!-- --------------------------------------- -->
<br>

<div class="row shadow p-3 m-3 bg-body rounded">
    <form action="./change_Ann.php" method="POST" enctype="multipart/form-data" name="change_ann"
        id="change_ann">
        <div class="row">
            <!-- 左邊 -->
            <div class="col-lg-3">
                <h2 class="fw-bold mb-0 ps-3 pt-4 pb-4">修改商品</h2>
                <!----- 上傳圖片 ----->
                <label class="btn btn-primary ms-3 mb-2"><input id="imgIn" name="imgIn" style="display:none;"
                        type="file" accept="image/*">上傳圖片</label>
                <h6>*請上傳正方形圖片*</h6>
                <img id="img" src="../image/<?php echo $ann_content['公告id']; ?>.webp"
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
                        <!-- 標題 -->
                        <tr>
                            <th scope="col" class="col-lg-1">
                                <h5>標題</h5>
                            </th>
                            <th scope="col">
                                <div class="col-lg-6">
                                    <input type="hidden" value="<?php echo $aid ?>" id="aid" name="aid">
                                    <input class="form-control" type="text" value="<?php echo $ann_content['標題'] ?>"
                                        id="title" name="title">
                                </div>
                            </th>
                        </tr>
                        <!-- 起始日期 -->
                        <tr>
                            <th scope="col" class="col-lg-1">
                                <h5>起始日期</h5>
                            </th>
                            <th scope="col">
                                <div class="col-lg-6">
                                    <input class="form-control" type="date" value="<?php echo $ann_content['start'] ?>"
                                        id="start" name="start">
                                </div>
                            </th>
                        </tr>
                        <!-- 結束日期 -->
                        <tr>
                            <th scope="col" class="col-lg-1">
                                <h5>結束日期</h5>
                            </th>
                            <th scope="col">
                                <div class="col-lg-6">
                                    <input class="form-control" type="date" value="<?php echo $ann_content['end'] ?>"
                                        id="end" name="end">
                                </div>
                            </th>
                        </tr>
                        <!-- 內容 -->
                        <tr style="vertical-align: middle;">
                            <th scope="col" class="col-lg-1">
                                <h5>內容</h5>
                            </th>
                            <th scope="col">
                                <div class="col-lg-6">
                                    <textarea class="form-control" rows="3" cols="40" id="short_introduce"
                                        name="content"><?php echo $ann_content['內容'] ?></textarea>
                                </div>
                            </th>
                        </tr>
                    </thead>
                </table>
                <div class="ms-5">
                    <button class="btn btn-primary" onclick="direct_back()" type="button">返回公告頁面</button>
                    <button type="submit" class="btn btn-primary ms-5 mb-2">確認修改</button>
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