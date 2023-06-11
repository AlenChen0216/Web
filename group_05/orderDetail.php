<?php
include_once("api.php");

$id = extractIDByAcc($_SESSION['login']);
$sql = "SELECT * FROM 訂單資訊 WHERE ID = '" . $id . "'";
if($result = mysqli_query($link,$sql)){
    $row = $result->fetch_assoc();
}
?>
<br>
<script>
    function delete_order(oid) {
        if (confirm("確定要取消訂單嗎?")) {
            $.ajax({
                url: './administrator/deletion.php',
                data: { oid: oid },
                type: 'GET',
                dataType: 'text',
                success: function (text) {
                    alert('訂單取消成功!!');
                    history.back();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('訂單刪除失敗!!');
                },
            });
        }

    }
    function direct_back() {
        history.back();
    }
</script>
<!------------------- 訂單管理-------------- -->
<div class="row shadow p-3 m-3 bg-body rounded">
    <form action="">
        <div class="row">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-0 ps-3 pt-4 pb-4 ">訂單詳細資料</h2>
                <!-- -----訂單管理----- -->
                <form action="">
                    <table class="table table-bordered table-hover ms-3">
                        <tbody>
                            <div class="tableStyle">

                                <!-- 最上面那排 -->
                                <tr>
                                    <th scope="col" class="col-lg-3">編號</th>
                                    <th scope="col" class="col-lg-3">商品</th>
                                    <th scope="col" class="col-lg-3">價格</th>
                                    <th scope="col" class="col-lg-3">數量</th>
                                </tr>
                                <!-- 訂單 -->
                                <?php show()?>
                            </div>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-lg-4">
                            <table class="table table-borderless ms-3 mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="col" class="col-lg-3">狀態:</th>
                                        <th><?php echo $row['運送狀態']?></th>
                                    </tr>
                                    <!--地址 -->
                                    <tr>
                                        <th scope="col" class="col-lg-3">地址:</th>
                                        <th><?php echo $row['地址']?></th>
                                    </tr>
                                    <!--姓名 -->
                                    <tr>
                                        <th>姓名:</th>
                                        <th><?php echo $row['姓名'] ?></th>
                                    </tr>
                                    <!-- 電話 -->
                                    <tr>
                                        <th>電話:</th>
                                        <th><?php echo $row['姓名'] ?></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- 確認按鈕 -->
                        <div class="col-lg-8 mt-4">
                            <button type="button" class="btn btn-primary ms-5 mb-3" onclick="delete_order(<?php echo trim($_GET['order_id'])?>)">取消訂單</button>
                            <button type="button" class="btn btn-primary ms-5 mb-3" onclick="direct_back()">返回購買清單</button>
                        </div>
                    </div>
                </form>

                <!-- -----商品列表----- -->
            </div>
        </div>
    </form>
</div>

<!-- ---------------------------------------------------------- -->