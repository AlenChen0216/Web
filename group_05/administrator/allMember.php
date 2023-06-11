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
    function delete_member(id) {
        if (confirm("確定要刪除 會員標號: " + id + " 嗎?")) {
            $.ajax({
                url: './deletion.php',
                data: { id: id },
                type: 'GET',
                dataType: 'text',
                success: function (text) {
                    alert('會員編號: ' + text + ' 刪除成功!!');
                    location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('會員刪除失敗!!');
                },
            });
        }

    }
    function direct_back() {
        location.replace('../administrator.php');
    }
</script>
<!------------------- 會員一覽------------- -->
<div class="row shadow p-3 m-3 bg-body rounded">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="fw-bold mb-0 ps-3 pt-4 pb-4 ">會員一覽</h2>
            <!-- -----會員列表----- -->
            <table class="table table-bordered table-hover ms-3 text-center">
                <tbody>
                   
                        <!-- 最上面那排 -->
                        <tr>
                            <th scope="col" class="col-lg-1">編號</th>
                            <th scope="col" class="col-lg-1">帳號</th>
                            <th scope="col" class="col-lg-1">權限</th>
                            <th scope="col" class="col-lg-2">姓名</th>
                            <th scope="col" class="col-lg-1">修改</th>
                            <th scope="col" class="col-lg-1">刪除</th>
                        </tr>
                        <?php
                        $length = 8;
                        $data = show_all("用戶",$length,8,null);
                        for ($i = 0; $i < $length; $i++) { //呈現會員資料
                            if (!isset($data['data'][$i])) {
                                break;
                            } else {
                                echo '<tr><td>' . $data['data'][$i][0] . '</td>
                                                <td>' . $data['data'][$i][1] . '</td>
                                                <td>' . (($data['data'][$i][6] == 1) ? "管理者" : "一般會員") . '</td>
                                                <td>' . $data['data'][$i][7] . '</td>
                                                <td><a class="btn btn-warning" href="./changeMember.php?id=' . $data['data'][$i][0] . '">修改</a></td>
                                                <td><button class="btn btn-danger" onclick="delete_member(' . $data['data'][$i][0] . ')">刪除</button></td></tr>';
                            }
                        }
                        //下方的頁數部分
                        echo $data['page'];
                        ?>
                   
                </tbody>
            </table>
            <!-- -----會員列表----- -->
        </div>
    </div>
    <div class="text-center">
        <button class="btn btn-primary" onclick="direct_back()">返回管理選項</button>
    </div>
</div>

<!-- ---------------------------------------------------------- -->

<!-- -------------網頁最下方版權聲明欄------------ -->
<br><br><br><br><br><br>
<<?php include_once("../footer.php"); ?>
    <!-- -------------------------------------------- -->
    </body>

</html>