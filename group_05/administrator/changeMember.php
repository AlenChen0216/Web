<!DOCTYPE html>
<html lang="en">

<?php include_once("../header.php");
if (isset($_GET['id'])) {
    $id = trim($_GET['id']);
    $sql = "SELECT 密碼,信箱 FROM 用戶 WHERE ID = '" . $id . "'";
    $result = mysqli_query($link, $sql);
    $member_content = $result->fetch_assoc();
    mysqli_free_result($result);
}
if(isset($_POST['email'])){ //變更會員內容
    $email = trim($_POST['email']);
    $id = trim($_POST['id']);
    updateMember($eamil,$id);
    echo "<script>location.replace('./changeMember.php?id=".$id."');alert('更改成功!!')</script>";
}
?>
<link rel="stylesheet" href="../css/error.css">
<script>
    function direct_back() {
        location.replace('./allMember.php?page=1');
    }
    $(document).ready(function ($) {
            $.validator.addMethod("notEqualsTo", function (value, element, arg) {
                return arg != value;
            }, "您尚未選擇!");
            $("#change_member").validate({
                submitHandler: function (form) {
                    alert("請等待會員資料更改....");
                    form.submit();
                },
                rules: {
                    email: {
                        required: true,
                        email:true
                    },
                },
                messages: {
                    
                }
            });
        });
    function check_email(){
        $id = <?php echo $id?>;
        $email = $("#email").val();
        $.ajax({
        url: './check_email.php',
        data: {id:$id,email:$email},
        type: 'GET',
        dataType: 'text',
        success:function(text){
          if(text == "1"){
            $("#submit").attr('disabled',true);
            $("#check_email").html("信箱已存在，請重填!");
          }else{
            $("#submit").attr('disabled',false);
            $("#check_email").html("");
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert('驗證失敗!!');
        },
      });
    }
</script>
<br><br><br><br><br>
<!-- --------------------------------------- -->
<br>

<div class="row shadow p-3 m-3 bg-body rounded">
    <form action="./changeMember.php" method="POST"  name="change_member" id="change_member">
        <div class="row">
            <!-- 左邊 -->
            <div class="col-lg-3">
                <h2 class="fw-bold mb-0 ps-3 pt-4 pb-4">修改用戶</h2>
            </div>
            <!-- 右邊 -->
            <div class="col-lg-9">
                <br><br><br><br>
                <table class="table table-borderless table-responsive ms-3">
                    <thead>
                        <!-- 密碼 -->
                        <tr>
                            <th scope="col" class="col-lg-1">
                                <h5>密碼</h5>
                            </th>
                            <th scope="col">
                                <div class="col-lg-6">
                                    <input type="hidden" values = "<?php echo $id ?>" id="id" name="id">
                                    <input class="form-control" type="text" value="<?php echo $member_content['密碼'] ?>" readonly>
                                </div>
                            </th>
                        </tr>
                        <!-- 信箱 -->
                        <tr>
                            <th scope="col" class="col-lg-1">
                                <h5>信箱</h5>
                            </th>
                            <th scope="col">
                                <div class="col-lg-6">
                                    <input class="form-control" type="text" value="<?php echo $member_content['信箱'] ?>" id="email" name="email" onkeyup="check_email()">
                                </div>
                            </th>
                        </tr>
                    </thead>
                </table>
                <br>
                <div>
                    <span id="check_email" style="color:red;"></span>
                </div>
                <br>
                <div class="ms-5">
                    <button class="btn btn-primary" onclick="direct_back()" type="button">返回用戶頁面</button>
                    <button type="submit" class="btn btn-primary ms-5 mb-2" id="submit">確認修改</button>
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