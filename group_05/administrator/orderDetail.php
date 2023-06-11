<?php include_once("../header.php");
if (isset($_GET['order_id'])) {
    $oid = trim($_GET['order_id']);
    $sql = "SELECT * FROM 訂單資訊 WHERE 訂單id = '" . $oid . "'";
    if ($result = mysqli_query($link, $sql)) {
        $order_infor = $result->fetch_assoc();
    }
}
?>
<script>
    function direct_back() {
        location.replace('./orderManage.php?page=1');
    }
    function change_order() { //變更訂單內容
        $name = $("#name").val();
        $addr = $("#addr").val();
        $phone = $("#phone").val();
        $oid = <?php if (isset($_GET['order_id'])) {
            echo $_GET['order_id'];
        } ?>;
        $state = $("#state option:selected").val();
        if ($name == "" || $addr == "" || $phone == "") { //若有未輸入的資料，則不能更新訂單
            alert("資料有誤!! \n請重新填寫");
            location.reload();
        } else {
            $.ajax({ //利用ajax修改訂單內容
                url: './change_order.php',
                data: { name: $name, addr: $addr, phone: $phone, oid: $oid, state: $state },
                type: 'POST',
                dataType: 'text',
                success: function (text) {
                    alert('修改成功!!');
                    location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('修改失敗!!');
                },
            })
        }

    }
</script>
<!------------------- 訂單管理-------------- -->
<br><br><br>
<div class="row shadow p-3 m-3 bg-body rounded">
    <form id="change_order">
        <div class="row">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-0 ps-3 pt-4 pb-4 ">訂單詳細資料</h2>
                <!-- -----訂單管理----- -->
                <table class="table table-bordered table-hover ms-3 text-center">
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
                            <?php show() ?>
                        </div>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-lg-4">
                        <table class="table table-borderless ms-3 mb-0">
                            <tbody>
                                <tr>
                                    <th scope="col" class="col-lg-3">狀態:</th>
                                    <th><select id="state">
                                            <?php
                                            $state_type = array(0 => "準備中", "已出貨", "已送達");
                                            for ($i = 0; $i < 3; $i++) {
                                                if ($state_type[$i] == $order_infor['運送狀態']) {
                                                    echo "<option value='" . $i . "' selected>" . $state_type[$i] . "</option>";
                                                } else {
                                                    echo "<option value='" . $i . "'>" . $state_type[$i] . "</option>";
                                                }
                                            }
                                            ?>

                                        </select></th>
                                </tr>
                                <!--地址 -->
                                <tr>
                                    <th scope="col" class="col-lg-3">地址:</th>
                                    <th><input type="text" value="<?php echo $order_infor['地址'] ?>" id="addr"
                                            name="addr"></th>
                                </tr>
                                <!--姓名 -->
                                <tr>
                                    <th>姓名:</th>
                                    <th><input type="text" value="<?php echo $order_infor['姓名'] ?>" id="name"
                                            name="name"></th>
                                </tr>
                                <!-- 電話 -->
                                <tr>
                                    <th>電話:</th>
                                    <th><input type="text" value="<?php echo $order_infor['電話'] ?>" id="phone"
                                            name="phone"></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- 確認按鈕 -->
                    <div class="col-lg-8 mt-4">
                        <button type="button" class="btn btn-primary mt-5 ms-5 mb-2" onclick="change_order()"
                            id="confirm">確認修改</button><br>
                        <button type="button" class="btn btn-primary ms-5 mb-3" onclick="direct_back()">返回訂單頁面</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- ---------------------------------------------------------- -->

<!-- -------------網頁最下方版權聲明欄------------ -->
<br><br><br>
<?php include_once("../footer.php"); ?>
<!-- -------------------------------------------- -->
</body>

</html>