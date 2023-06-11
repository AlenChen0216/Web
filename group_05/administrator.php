<!DOCTYPE html>
<html lang="en">

<?php include_once('header.php') ?>
<!-- --------------------------------------- -->
<br><br><br><br><br><br><br><br>
<div id="ad_content">
    <div class="modal modal-signin position-static d-block" tabindex="-1" role="dialog" id="modalSignin">
        <div class="modal-dialog " role="document">
            <div class="modal-content rounded-5 shadow">
                <div>
                    <br><br>
                    <h2 class="fw-bold mb-0 text-center justify-content-center">管理員:<?php echo $_SESSION['login']?></h2>
                    <br>
                </div>
                <div class="modal-body">
                    <div class="justify-content-center">
                        <a href="./administrator/allCommodity.php?page=1" class="btn btn-primary ms-5 mb-2">商品一覽</a>
                        <a href="./administrator/addCommodity.php" class="btn btn-primary ms-5 mb-2">新增商品</a>
                        <a href="./administrator/orderManage.php" class="btn btn-primary ms-5 mb-2">訂單一覽</a>
                        <a href="./administrator/allMember.php" class="btn btn-primary ms-5 mb-2">會員一覽</a>
                        <a href="./administrator/allAnn.php" class="btn btn-primary ms-5 mb-2">公告一覽</a>
                        <a href="./administrator/addAnn.php" class="btn btn-primary ms-5 mb-2">新增公告</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ---------------------------------------------------------- -->
<br><br><br><br><br><br><br><br><br>
<!-- -------------網頁最下方版權聲明欄------------ -->
<?php include_once('footer.php'); ?>
<!-- -------------------------------------------- -->