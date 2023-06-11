<!DOCTYPE html>
<html lang="en">

<style>
    .tableStyle {
        vertical-align: middle;
        text-align: center;
    }
</style>
<?php include_once("../header.php");
if (!isset($_GET['page'])) {
    $_GET['page'] = 1;
}
?>
<script>
    function delete_item(uid) {
        if (confirm("確定要刪除 商品標號: " + uid + " 嗎?")) {
            $.ajax({
                url: './deletion.php',
                data: { uid: uid },
                type: 'GET',
                dataType: 'text',
                success: function (text) {
                    alert('商品編號: ' + text + ' 刪除成功!!');
                    location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('商品刪除失敗!!');
                },
            });
        }

    }
    function direct_back() {
        location.replace('../administrator.php');
    }
</script>
<!------------------- 商品一覽-------------- -->
<br><br><br>
<div class="row shadow p-3 m-3 bg-body rounded">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="fw-bold mb-0 ps-3 pt-4 pb-4 ">商品一覽</h2>
            <!-- -----商品列表----- -->
            <table class="table table-bordered table-hover ms-3 text-center">
                <tbody>
                    <!-- 最上面那排 -->
                    <tr>
                        <th scope="col" class="col-lg-1">編號</th>
                        <th scope="col" class="col-lg-1">商品圖片</th>
                        <th scope="col" class="col-lg-3">名稱</th>
                        <th scope="col" class="col-lg-3">價錢</th>
                        <th scope="col" class="col-lg-2">數量</th>
                        <th scope="col" class="col-lg-1">修改</th>
                        <th scope="col" class="col-lg-1">刪除</th>
                    </tr>
                    <!-- 商品 -->
                    <?php
                    $length = 8;
                    $data = show_all("商品",$length,7,null);
                    for ($i = 0; $i < $length; $i++) { //呈現商品資料
                        if (!isset($data['data'][$i])) {
                            break;
                        }else {
                            echo '<tr>
                                <td>' . $data['data'][$i][0] . '</td>
                                <td>
                                    <img class="img-fluid" src="../image/' . $data['data'][$i][0] . '.webp" alt="..." width="150" height="150">
                                </td>
                                <td>' . $data['data'][$i][1] . '</td>
                                <td>NT$' .$data['data'][$i][3] . '</td>
                                <td>' . $data['data'][$i][2] . '</td>
                                <td><a class="btn btn-warning" href="./changeCommodity.php?uid=' . $data['data'][$i][0] . '">修改</a></td>
                                <td><button class="btn btn-danger" onclick="delete_item(' . $data['data'][$i][0] . ')">刪除</button></td>
                                </tr>';
                        }
                        
                    }
                    //下方的頁數部分
                    echo $data['page'];
                    ?>
                </tbody>
            </table>
            <!-- -----商品列表----- -->
        </div>
    </div>
    <div class="text-center">
        <button class="btn btn-primary" onclick="direct_back()">返回管理選項</button>
    </div>
</div>

<!-- ---------------------------------------------------------- -->
<br><br><br>
<!-- -------------網頁最下方版權聲明欄------------ -->
<?php include_once("../footer.php") ?>
<!-- -------------------------------------------- -->
</body>

</html>