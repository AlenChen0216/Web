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
    function delete_Ann(aid) {
        if (confirm("確定要刪除 公告標號: " + aid + " 嗎?")) {
            $.ajax({
                url: './deletion.php',
                data: { aid: aid },
                type: 'GET',
                dataType: 'text',
                success: function (text) {
                    alert('公告編號: ' + text + ' 刪除成功!!');
                    location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('公告刪除失敗!!');
                },
            });
        }

    }
    function direct_back() {
        location.replace('../administrator.php');
    }
</script>

<!------------------- 公告一覽------------- -->
<div class="row shadow p-3 m-3 bg-body rounded">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="fw-bold mb-0 ps-3 pt-4 pb-4 ">公告一覽</h2>
            <!-- -----公告列表----- -->
            <table class="table table-bordered table-hover ms-3 text-center">
                <tbody>
                    <div>
                        <!-- 最上面那排 -->
                        <tr>
                            <th scope="col" class="col-lg-1">編號</th>
                            <th scope="col" class="col-lg-3">標題</th>
                            <th scope="col" class="col-lg-2">公告圖片</th>
                            <th scope="col" class="col-lg-2">開始日期</th>
                            <th scope="col" class="col-lg-2">結束日期</th>
                            <th scope="col" class="col-lg-1">修改</th>
                            <th scope="col" class="col-lg-1">刪除</th>
                        </tr>

                        <?php
                        $length = 5;
                        $data = show_all("公告", $length, 7,null);
                        for ($i = 0; $i < $length; $i++) {
                            if (!isset($data['data'][$i])) {
                                break;
                            }
                            echo '<tr>
                                    <td>' . $data['data'][$i][0] . '</td>
                                    <td>' . $data['data'][$i][1] . '</td>
                                    <td> <img src="../image/' . $data['data'][$i][0] . '.webp" width="200" height="150"> </td>
                                    <td>' . $data['data'][$i][3] . '</td>
                                    <td>' . $data['data'][$i][4] . '</td>
                                    <td><a class="btn btn-warning" href="./change_Ann.php?aid=' . $data['data'][$i][0] . '">修改</a></td>
                                    <td><button class="btn btn-danger" onclick="delete_Ann(' . $data['data'][$i][0] . ')">刪除</button></td>
                                </tr>';
                        }
                        echo $data['page'];
                        ?>

                    </div>
                </tbody>
            </table>
            <!-- -----公告列表----- -->
        </div>
    </div>
    <div class="text-center">
        <button class="btn btn-primary" onclick="direct_back()">返回管理選項</button>
    </div>
</div>

<!-- ---------------------------------------------------------- -->

<!-- -------------網頁最下方版權聲明欄------------ -->
<br><br><br>
<?php include_once("../footer.php") ?>
<!-- -------------------------------------------- -->
</body>

</html>