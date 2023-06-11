<!DOCTYPE html>
<html lang="en">

<?php include_once("../header.php");
if (isset($_POST['title']) && isset($_POST['start'])) {
    $title = trim($_POST['title']);
    $start = trim($_POST['start']);
    $end = trim($_POST['end']);
    $content = trim($_POST['content']);
    $aid = addAnn($title, $content, $start, $end);
    if (isset($_FILES['imgInp'])) { //將商品圖片根據aid改名，並移至image裡
        if (move_uploaded_file($_FILES['imgInp']['tmp_name'], "../image/" . $aid . ".webp")) {
            echo "<script>location.replace('./allAnn.php?page=1');alert('公告新增成功!!')</script>";
        }
    }
}
?>
<br><br><br><br><br><br>
<!-- --------------------------------------- -->
<script>
    function direct_back() {
        location.replace('../administrator.php');
    }
    $(document).ready(function ($) {
        $.validator.addMethod("notEqualsTo", function (value, element, arg) {
            return arg != value;
        }, "您尚未選擇!");
        $("#add_ann").validate({
            submitHandler: function (form) {
                alert("請等待商品建立....");
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
                imgInp: {
                    required: true,
                }
            },
            messages: {

            }
        });
    });
</script>
<link rel="stylesheet" href="../css/error.css">
<!-- ----------------新增公告 ------------------------>
<div class="container">
    <form action="./addAnn.php" method="POST" enctype="multipart/form-data" id="add_ann">
        <div class="row shadow p-1 m-1 bg-body rounded">
            <div class="row">
                <div class="col-lg-4">
                    <img id="img" src="../image/add_default.jpg" class="img-fluid ms-1 mt-3 mb-3" alt="..." style="height: 270px;width:380px;">
                </div>
                <div class="col-lg-8">
                    <h5>
                        <div class="fw-bolder pt-3 ">公告標題&nbsp;:&nbsp;<input type="text" id="title" name="title"></div>
                    </h5>
                    <h5>
                        <div class="fw-bolder">開始日期&nbsp;:&nbsp;<input type="date" id="start" name="start"></div>
                    </h5>
                    <h5>
                        <div class="fw-bolder">結束日期&nbsp;:&nbsp;<input type="date" id="end" name="end"></div>
                    </h5>
                    <h5>
                        <div class="fw-bolder">公告內容:</div>
                    </h5>
                    <div>
                        <textarea name="content" id="content" cols="41" rows="8"></textarea>
                    </div>
                    <div class="ms-3 mb-3">
                        <button class="btn btn-primary ms-3" type="button" onclick="direct_back()">返回管理選項</button>
                        <label class="btn btn-primary ms-3"><input id="imgInp" name="imgInp" style="display:none;" type="file"
                                accept="image/*">上傳圖片</label>
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
                        <button class="btn btn-primary ms-3" type="submit">確認新增</button>
                        <button class="btn btn-primary ms-3" type="reset">清除內容</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- ----------------新增公告 ------------------------>


<!-- -------------網頁最下方版權聲明欄------------ -->
<br><br><br>
<?php include_once("../footer.php") ?>
<!-- -------------------------------------------- -->
</body>

</html>