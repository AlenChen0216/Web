<?php
include_once('api.php');
$ID = extractIDByAcc($_SESSION['login']);
$infor = extractClientInfo($ID);
$sql = "SELECT * FROM 折價券 WhERE ID = '" . $ID . "'";
if(!($result = mysqli_query($link,$sql))){
    
}
if (isset($_SESSION['cart']) && $_SESSION['cart'] != '') {
    $cart = $_SESSION['cart'];
    $temp = array_filter(explode(",", $cart));
    $array_cart;
    for ($i = 0; $i < count($temp); $i += 2) {
        $array_cart[$temp[$i]] = $temp[$i + 1];
    }
} else {
    $array_cart = null;
    $cart = "";
}

?>
<script> //根據折價卷更新的部份
    $(function () {
        $ori = <?php echo $total?>; //紀錄原始價格
        $now = $ori; //折價後價格
        $("#cou").on('change', function () {
            total = <?php echo $total?>; //紀錄原始價格
            coupon = $("#cou option:selected").val(); //紀錄折價量
            infor = $("#cou option:selected").text(); //紀錄折價卷名稱
            $.ajax({
                url: './discount.php',
                data: { price: total, original: total,coupon:coupon,infor:infor },
                type: 'POST',
                dataType: 'text',
                success: function (price) {
                    $now = price; //price為折價後價格
                    $("#price").val(price);
                    $("#money").val(0);
                    $("#display").val("NT$"+$ori);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('商品折價失敗!!');
                },
            });
        })
        $("#money").on('change',function(){ //根據選擇的項目，來變更顯示金額。
            val = $("#money option:selected").val();
            if(val==0){
                $("#display").val("NT$"+$ori);
            }else if(val==1){
                $("#display").val("NT$"+$now);
            }
        })
    })
    $(document).ready(function ($) {
            $.validator.addMethod("notEqualsTo", function (value, element, arg) {
                return arg != value;
            }, "您尚未選擇!");
            $("#buy").validate({
                submitHandler: function (form) {
                    alert("請等待商品資料更改....");
                    form.submit();
                },
                rules: {
                    name: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                    "amount[]":{
                        required: true,
                        min : 1,
                    }
                },
                messages: {
                    "amount[]":{
                        max : "數量超過庫存量，請重新輸入!!",
                        min : "購買數量不能小於1,請重新輸入!!",
                    }
                }
            });
        });
</script>
<link rel="stylesheet" href="css/error.css">
<br>
<!------------------- 購物車-------------- -->
<div class="row shadow p-3 m-3 bg-body rounded">
    <form action="buy.php" name="buy" id="buy" method="POST">
        <div class="row">
            <div class="col-lg-10">
                <h2 class="fw-bold mb-0 ps-3 pt-4 pb-4 ">購物車</h2>
                <!-- -----購物車表格----- -->
                <table class="table table-bordered table-hover ms-3 text-center">
                    <div>
                        <!-- 最上面那排 -->
                        <tr>
                            <th scope="col" class="col-lg-1"></th>
                            <th scope="col" class="col-lg-1">編號</th>
                            <th scope="col" class="col-lg-1">商品圖片</th>
                            <th scope="col" class="col-lg-3">名稱</th>
                            <th scope="col" class="col-lg-3">價錢</th>
                            <th scope="col" class="col-lg-3">數量</th>
                        </tr>
                        <!-- 商品 -->
                        <?php append(); ?>
                    </div>
                    </tbody>
                </table>
                <!-- -----購物車表格----- -->

                <!-- -----地址 姓名 確認----- -->
                <div class="row">
                    <div class="col-lg-4">
                        <table class="table table-borderless ms-3 mb-0">
                            <tbody>
                                <!-- 輸入姓名 -->
                                <tr>
                                    <th>姓名:</th>
                                    <th><input type="text" value=<?php echo $infor['姓名'] ?> name="name" id="name"
                                            ></th>
                                </tr>
                                <!-- 輸入地址 -->
                                <tr>
                                    <th scope="col" class="col-lg-3">地址:</th>
                                    <th><input type="text" value=<?php echo $infor['地址'] ?> name="address" id="address"
                                            ></th>
                                </tr>
                                <!-- 輸入電話 -->
                                <tr>
                                    <th scope="col" class="col-lg-3">電話:</th>
                                    <th><input type="text" value=<?php echo $infor['電話'] ?> name="phone" id="phone"
                                            ></th>
                                </tr>
                                <!-- 優惠券 -->
                                <tr>
                                    <th scope="col" class="col-lg-3">折價券:</th>
                                    <th>
                                        <select id="cou">
                                            <option value="0">不使用</option>
                                            <?php
                                                while($row = $result->fetch_assoc()){
                                                    echo '<option value="'.$row['折價'].'">'.$row['說明'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- 確認按鈕 -->
                    <div class="col-lg-8">
                        <!-- 金額 -->
                        <div class="mt-5 ms-3 mb-4">
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;運費： NT$100</p>
                            <select class="ms-3" id="money">
                                <option value="0" id="default">原金額:</option>
                                <option value="1">打折後金額:</option>
                            </select>
                            <input type="text" value="NT$<?php echo (($total == null) ? 0 : $total) ?>" id="display"
                                disabled>
                            <input type="hidden" value=<?php echo $total ?> name="price" id="price">
                        </div>
                        <div class="ms-5">
                            <button type="submit" class="btn btn-primary ms-5 mb-3">確認購買</button>
                        </div>
                    </div>
                </div>
                <!-- -----地址 姓名 確認----- -->
            </div>
        </div>
    </form>

</div>
</div>

<!-- ---------------------------------------------------------- -->