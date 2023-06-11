<br>
<?php
    if (!isset($_GET['page'])) {
        $_GET['page'] = 1;
    }
?>
<div class="row shadow p-3 m-3 bg-body rounded">
            <form action="">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="fw-bold mb-0 ps-3 pt-4 pb-4 ">購買清單</h2>
                        <!-- -----清單表格----- -->
                        <table class="table table-bordered table-hover ms-3 text-center">
                            <tbody>
                                <div>
                                    <!-- 最上面那排 -->
                                    <tr>
                                        <th scope="col" class="col-lg-2">編號</th>
                                        <th scope="col" class="col-lg-2">客戶名</th>
                                        <th scope="col" class="col-lg-2">電話</th>
                                        <th scope="col" class="col-lg-2">地址</th>
                                        <th scope="col" class="col-lg-2">狀態</th>
                                        <th scope="col" class="col-lg-2">價格</th>
                                    </tr>
                                    <!-- 清單 -->
                                    <?php
                                        $length = 5;
                                        displayList(5,6);
                                    ?>

                                </div>
                            </tbody>
                        </table>
                        <!-- -----清單表格----- -->
                    </div>
                </div>
            </form>

        </div>
    </div>
