<?php 
    if (!isset($_GET['page'])) {
        $_GET['page'] = 1;
    }
?>
<br>
    <!------------------- 折價券-------------- -->
    <div class="row shadow p-3 m-3 bg-body rounded">
        <form action="">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="fw-bold mb-0 ps-3 pt-4 pb-4 ">折價券</h2>
                    <!-- -----折價券列表----- -->
                    <table class="table table-bordered table-hover ms-3 text-center">
                        <tbody>
                            <div>
                                <!-- 最上面那排 -->
                                <tr>
                                    <th scope="col" class="col-lg-3">折價券面額</th>
                                    <th scope="col" class="col-lg-3">折價券說明</th>
                                    <th scope="col" class="col-lg-2">數量</th>
                                    <th scope="col" class="col-lg-4">有效期限</th>
                                </tr>
                                <!-- 折價券 -->
                            <?php show_coupon(3,4);?>
                            </div>
                        </tbody>
                    </table>
                    <!-- -----折價券列表----- -->
                </div>
            </div>
        </form>
    </div>

    <!-- ---------------------------------------------------------- -->