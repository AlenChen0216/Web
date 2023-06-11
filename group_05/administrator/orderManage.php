<!DOCTYPE html>
<html lang="en">

<?php include_once("../header.php");
if (!isset($_GET['page'])) {
    $_GET['page'] = 1;
}
?>
<br><br><br><br><br>
<!-- --------------------------------------- -->
<script>
    function delete_order(oid) {
        if (confirm("確定要刪除 訂單標號: " + oid + " 嗎?")) {
            $.ajax({
                url: './deletion.php',
                data: { oid: oid },
                type: 'GET',
                dataType: 'text',
                success: function (text) {
                    alert('訂單編號: ' + text + ' 刪除成功!!');
                    location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('訂單刪除失敗!!');
                },
            });
        }

    }
    function direct_back() {
        location.replace('../administrator.php');
    }
</script>

<!------------------- 訂單管理-------------- -->
<div class="row shadow p-3 m-3 bg-body rounded">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="fw-bold mb-0 ps-3 pt-4 pb-4 ">訂單管理</h2>
            <!-- -----訂單管理----- -->
            <table class="table table-bordered table-hover ms-3 text-center">
                <tbody>
                    <div class="tableStyle">
                        <!-- 最上面那排 -->
                        <tr>
                            <th scope="col" class="col-lg-1">編號</th>
                            <th scope="col" class="col-lg-1">客戶</th>
                            <th scope="col" class="col-lg-3">電話</th>
                            <th scope="col" class="col-lg-3">地址</th>
                            <th scope="col" class="col-lg-2">狀態</th>
                            <th scope="col" class="col-lg-1">修改</th>
                            <th scope="col" class="col-lg-1">刪除</th>
                        </tr>
                        <!-- 訂單 -->
                        <?php
                        $length = 8;
                        $data = show_all("訂單資訊",$length,7,null);
                        for ($i = 0; $i < $length; $i++) { //呈現訂單資料
                            if (!isset($data['data'][$i])) {
                                break;
                            }
                            echo '<tr>
                                             <td>' . $data['data'][$i][0] . '</td>
                                             <td>' . $data['data'][$i][1] . '</td>
                                             <td>' . $data['data'][$i][2] . '</td>
                                             <td>' . $data['data'][$i][3] . '</td>
                                             <td>' . $data['data'][$i][4] . '</td>
                                             <td><a class="btn btn-warning" href="./orderDetail.php?order_id=' . $data['data'][$i][0]. '">修改</td>
                                             <td><button class="btn btn-danger" onclick="delete_order(' . $data['data'][$i][0] . ')">刪除</button></td>
                                             </tr>';
                        }
                        //下方的頁數部分
                         echo $data['page'];
                        ?>
                    </div>
                </tbody>
            </table>

        </div>
        <div class="text-center">
            <button class="btn btn-primary" onclick="direct_back()">返回管理選項</button>
        </div>
    </div>

</div>

<!-- ---------------------------------------------------------- -->

<!-- -------------網頁最下方版權聲明欄------------ -->
<br><br><br><br><br><br>
<?php include_once("../footer.php") ?>
<!-- -------------------------------------------- -->
</body>

</html>