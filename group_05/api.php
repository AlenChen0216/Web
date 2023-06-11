<?php
$host = "localhost";
$dbuser = "root";
$dbpassword = "root123456";
$dbname = "group_05";
$link = mysqli_connect($host, $dbuser, $dbpassword, $dbname) or die("無法開啟MySQL資料庫連結!<br>"); //連結SQL
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");


function encapPara($str)
{
    return "'" . $str . "'";
}
function appendMerchandise($uid, $mcname, $inventory, $price, $rate, $conciseDesc, $comprehensiveDesc)
{
    global $link;
    $sql = "insert into `商品`(`UID`,`品名`,`庫存量`,`售價`,`評價`,`簡短敘述`,`完整敘述`) values(" . encapPara($uid) . "," . encapPara($mcname) . "," . encapPara($inventory) . "," . encapPara($price) . "," . encapPara($rate) . "," . encapPara($conciseDesc) . "," . encapPara($comprehensiveDesc) . ")";
    $result = mysqli_query($link, $sql);
}
function appendUser($id, $acc, $pass, $bird, $phone, $address, $power, $name, $mail, $sex)
{
    global $link;
    $sql = "insert into `用戶`(`ID`,`帳號`,`密碼`,`生日`,`電話`,`地址`,`權限`,`姓名`,`信箱`,`性別`) values(" . encapPara($id) . "," . encapPara($acc) . "," . encapPara($pass) . "," . encapPara($bird) . "," . encapPara($phone) . "," . encapPara($address) . "," . encapPara($power) . "," . encapPara($name) . "," . encapPara($mail) . "," . encapPara($sex) . ")";
    $result = mysqli_query($link, $sql);
}
function change_pwd($old, $new)
{
    global $link;
    $sql = "SELECT 帳號 , 密碼 FROM 用戶 WHERE 帳號 = '" . $_SESSION['login'] . "' AND 密碼 = '" . $old . "'";
    if ($result = mysqli_query($link, $sql)) {
        while ($row = $result->fetch_assoc()) {
            $sql = "UPDATE 用戶 SET 密碼 = '" . $new . "' WHERE 帳號 = '" . $_SESSION['login'] . "'";
            $result = mysqli_query($link, $sql);
            return 1;
        }
    }
    return 0;
}
function addOrderToPerson($idOfOrder, $idOfPerson)
{
    global $link;
    $sql = "insert into `持有訂單`(`ID`,`訂單id`) values(" . encapPara($idOfPerson) . "," . encapPara($idOfOrder) . ")";
    $result = mysqli_query($link, $sql);
}
function createOrderContent($idOfOrder, $merchandise, $quantity)
{
    global $link;
    $sql = "insert into `訂單內容`(`訂單ID`,`UID`,`數量`) values(" . encapPara($idOfOrder) . "," . encapPara($merchandise) . "," . encapPara($quantity) . ")";
    $result = mysqli_query($link, $sql);
}
function extractClientInfo($id)
{
    global $link;
    $sql = "select * from `用戶` where ID=" . encapPara($id) . "";
    $result = mysqli_query($link, $sql);
    $row = $result->fetch_assoc();
    return $row;
}
function createOrderInfo($idOfOrder, $id, $status, $name, $phone, $address, $price)
{
    global $link;
    $sql = "insert into `訂單資訊` values(" . encapPara($idOfOrder) . "," . encapPara($name) . "," . encapPara($phone) . "," . encapPara($address) . "," . encapPara($status) . "," . encapPara($id) . "," . encapPara($price) . ")";
    $result = mysqli_query($link, $sql);

}
function extractIDByAcc($acc)
{
    global $link;
    $sql = "select `ID` from `用戶` where `帳號`=" . encapPara($acc) . "";
    $result = mysqli_query($link, $sql);
    $row = $result->fetch_assoc();
    return $row["ID"];
}
function CPRNameToUID()
{
    global $link;
    $sql = "select * from `商品`";
    $arr[] = array();
    $result = mysqli_query($link, $sql);
    while ($row = $result->fetch_assoc()) {
        $arr += array($row["品名"] => $row["UID"]);
    }
    return $arr;
}
function decreaseAmount($name, $num)
{
    global $link;
    for ($i = 0; $i < count($name); $i++) {
        $sql = "SELECT 庫存量 FROM 商品 WHERE 品名 = '" . $name[$i] . "'";
        if ($result = mysqli_query($link, $sql)) {
            $amount = $result->fetch_assoc();
            $now = $amount['庫存量'] - $num[$i];
            $sql = "UPDATE 商品 SET 庫存量 = " . $now . " WHERE 品名 = '" . $name[$i] . "'";
            if (!($result = mysqli_query($link, $sql))) {
                header("location:index.php");
            }
        } else {
            header("location:index.php");
        }
    }

}
function createCompleteOrder($idOfOrder, $Name, $Phone, $Address, $Price)
{
    if (isset($_SESSION['cart']) && $_SESSION['cart'] != '') {
        $cart = $_SESSION['cart'];
        $temp = array_filter(explode(",", $cart));
        $item = array();
        $num = array();
        for ($i = 0; $i < count($temp); $i += 2) {
            array_push($item, $temp[$i]);
            array_push($num, $temp[$i + 1]);
        }
        decreaseAmount($item, $num);
        $account = $_SESSION["login"];
        $idOfPerson = extractIDByAcc($account);
        addOrderToPerson($idOfOrder, $idOfPerson);
        createOrderInfo($idOfOrder, $idOfPerson, "準備中", $Name, $Phone, $Address, $Price);
        $cprTable = CPRNameToUID();
        for ($i = 0; $i < count($item); $i++) {
            createOrderContent($idOfOrder, $cprTable[$item[$i]], $num[$i]);
        }
        return true;
    }
    return false;
}

function displayList($rows, $columns)
{
    global $link;
    $id = extractIDByAcc($_SESSION['login']);
    $sql = "SELECT * FROM 訂單資訊 WHERE ID = '" . $id . "'";
    $result = mysqli_query($link, $sql);
    $data = show_all(" ", $rows, $columns, $result);
    for ($i = 0; $i < $rows; $i++) {
        if (!isset($data['data'][$i])) {
            break;
        }
        echo '<tr>
        <td> <a href="information.php?order_id=' . $data['data'][$i][0] . '">' . $data['data'][$i][0] . '</td>
        <td>' . $data['data'][$i][1] . '</td>
        <td>' . $data['data'][$i][2] . '</td>
        <td>' . $data['data'][$i][3] . '</td>';
        if ($data['data'][$i][4] == "已送達") {
            echo '<td> <a href="information.php?comment=' . $data['data'][$i][0] . '" title="進入留言區"> 已送達 </a> </td>';
        } else {
            echo '<td>' . $data['data'][$i][4] . '</td>';
        }
        echo '<td> NT$' . $data['data'][$i][6] . '</td>
    </tr>';
    }
    echo $data['page'];
}
function show_coupon($rows,$columns)
{
    global $link;
    $id = extractIDByAcc($_SESSION['login']);
    $sql = "SELECT * FROM 折價券 WhERE ID = '" . $id . "'";
    $result = mysqli_query($link, $sql);
    $data = show_all(" ",$rows,$columns,$result);
    for($i=0;$i<$rows;$i++) {
        if(!isset($data['data'][$i])){
            break;
        }
        echo '<tr>
        <td>' . $data['data'][$i][1] . '元</td>
        <td>' . $data['data'][$i][2] . '</td>
        <td>' . $data['data'][$i][3] . '</td>
        <td>' . $data['data'][$i][4] . '</td>
    </tr>';
    }
    echo $data['page'];
}
function append()
{
    global $array_cart;
    global $link;
    if ($array_cart != null) {
        $item = array_keys($array_cart);
        $num = array_values($array_cart);
        for ($i = 0; $i < count($array_cart); $i++) {
            $sql = "SELECT * FROM 商品 WHERE 品名 = '" . $item[$i] . "'";
            if ($result = mysqli_query($link, $sql)) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>
                <th scope="row">
                    <a id="remove" class="re" href="#" onclick="remove(' . '\'' . $item[$i] . '\'' . ')">
                    <i class="fas fa-trash-alt"></i>
                </th>';
                    echo '<td>' . $row['UID'] . '</td>'; //編號
                    echo '<td> <img class="img-fluid" src="./image/' . $row['UID'] . '.webp" alt="..."> </td>'; //照片
                    echo '<td>' . $item[$i] . '</td>'; //名稱
                    echo '<td>' . $row['售價'] . '</td>'; //價錢
                    echo '<td> <input type="number" value="' . $num[$i] . '" class="form-control rounded-4 text-center" max="' . $row['庫存量'] . '" min="1" id="amount' . $i . '" name="amount[]"> </td> </tr>'; //數量
                }
            }
        }
    }
}
function deleteAnnByAID($aid)
{
    global $link;
    $sql = "DELETE FROM 公告 WHERE 公告id = " . encapPara("$aid") . "";
    $result = mysqli_query($link, $sql);
}
function deleteMerchandiseByUID($uid)
{
    global $link;
    $sql = "delete from `商品` where `UID`=" . encapPara($uid) . "";
    $result = mysqli_query($link, $sql);
}
function updateMerchandiseByUID($uid, $name, $stock, $price, $coment, $omitDes, $wholeDes)
{
    global $link;
    $sql = "select * from `商品` where `UID`=" . encapPara($uid) . "";
    $result = mysqli_query($link, $sql);
    $row = $result->fetch_assoc();
    deleteMerchandiseByUID($uid);
    $name = $name == "" ? $row["品名"] : $name;
    $stock = $stock == "" ? $row["庫存量"] : $stock;
    $price = $price == "" ? $row["售價"] : $price;
    $coment = $coment == "" ? $row["評價"] : $coment;
    $omitDes = $omitDes == "" ? $row["簡短敘述"] : $omitDes;
    $wholeDes = $wholeDes == "" ? $row["完整敘述"] : $wholeDes;
    appendMerchandise($uid, $name, $stock, $price, $coment, $omitDes, $wholeDes);
}
function deleteUserByID($id)
{
    global $link;
    $sql = "DELETE FROM `用戶` , `訂單資訊` , `持有訂單` ,`用戶評論`,`折價券` ,`user_image` USING `用戶` 
    LEFT JOIN `訂單資訊` ON `用戶`.ID = `訂單資訊`.ID 
    LEFT JOIN `持有訂單` ON `用戶`.ID = `持有訂單`.ID 
    LEFT JOIN`用戶評論` ON `用戶`.ID = `用戶評論`.ID 
    LEFT JOIN `折價券` ON `用戶`.ID = `折價券`.ID 
    LEFT JOIN `user_image` ON `用戶`.ID = `user_image`.ID WHERE `用戶`.ID = ".encapPara($id)."";
    $result = mysqli_query($link, $sql);
}
function updateUserByID($id, $acc, $pass, $bird, $phone, $address, $power, $name, $mail, $sex)
{
    global $link;
    $sql = "select * from `用戶` where `ID`=" . encapPara($id) . "";
    $result = mysqli_query($link, $sql);
    $row = $result->fetch_assoc();
    deleteUserByID($id);
    $acc = $acc == "" ? $row["帳號"] : $acc;
    $pass = $pass == "" ? $row["密碼"] : $pass;
    $bird = $bird == "" ? $row["生日"] : $bird;
    $phone = $phone == "" ? $row["電話"] : $phone;
    $address = $address == "" ? $row["地址"] : $address;
    $power = $power == "" ? $row["權限"] : $power;
    $name = $name == "" ? $row["姓名"] : $name;
    $mail = $mail == "" ? $row["信箱"] : $mail;
    $sex = $sex == "" ? $row["性別"] : $sex;
    appendUser($id, $acc, $pass, $bird, $phone, $address, $power, $name, $mail, $sex);
}
function deleteOrderByOID($oid)
{
    global $link;
    $sql = "DELETE from 訂單資訊,訂單內容,持有訂單 USING 訂單資訊 INNER JOIN 訂單內容 ON 訂單內容.訂單id = 訂單資訊.訂單id INNER JOIN 持有訂單 ON 持有訂單.訂單id = 訂單資訊.訂單id WHERE 訂單資訊.訂單id = " . $oid . " ";
    $result = mysqli_query($link, $sql);
}
function show()
{
    global $link;
    if (isset($_GET['order_id'])) {
        $id = strip_tags($_GET['order_id']);
        $sql = "SELECT 商品.UID,商品.品名,商品.售價,訂單內容.數量 FROM 商品 JOIN 訂單內容 ON 商品.UID = 訂單內容.UID WHERE 訂單內容.訂單id = '" . $id . "'";
        if ($result = mysqli_query($link, $sql)) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr><td>' . $row['UID'] . '</td>
                <td>' . $row['品名'] . '</td>
                <td>NT$' . $row['售價'] . '</td>
                <td>' . $row['數量'] . '</td></tr>';
            }
        }
    }

}
function show_all($type, $rows, $columns, $result) //回傳要尋找的table類型，並擁有分頁
{
    global $link;
    $sql = "SELECT * FROM " . $type;
    if ($result == null) {
        $result = mysqli_query($link, $sql);
    }
    //分頁功能
    $totala_amount = mysqli_num_rows($result); //獲取table中有多少列
    $total_col = mysqli_num_fields($result);
    $total_page = ceil($totala_amount / $rows); //計算需要有多少頁
    $cur_page = trim($_GET['page']); //目前所在頁數
    mysqli_data_seek($result, ($cur_page - 1) * $rows); //跳過前面($cur_page - 1) * 6幾列資料
    for ($i = 0; $i < $rows; $i++) { //呈現訂單資料
        $row = $result->fetch_array();
        if ($row == null) {
            break;
        } else {
            for ($k = 0; $k < $total_col; $k++) {
                $temp[] = $row[$k];
            }
            $content['data'][] = $temp;
        }
        $temp = array();
    }

    mysqli_free_result($result);
    //下方的頁數部分
    $data = "";
    if (isset($_GET['dir'])) {
        $dir = trim($_GET['dir']);
        $data .= "<tr><td colspan='" . $columns . "'><ul class='pagination justify-content-center'>";
        $data .= "<li class='page-item'><a class='page-link'  href='" . $_SERVER['PHP_SELF'] . "?dir=" . $dir . "&page=" . (($cur_page - 1 == 0) ? 1 : $cur_page - 1) . "''> <i class='fa-solid fa-chevron-left' style='color: #5cc9ff;'></i> </a></li>&nbsp;&nbsp;";
        for ($j = 1; $j <= $total_page; $j++) {
            if ($j == $cur_page) {
                $data .= "<li class='page-item active'><a class='page-link' href='#'>" . $j . "</a></li>&nbsp;&nbsp;";
            } else {
                $data .= "<li class='page-item'><a class='page-link' href='" . $_SERVER['PHP_SELF'] . "?dir=" . $dir . "&page=$j''> $j </a></li>&nbsp;&nbsp;";
            }
        }
        $data .= "<li class='page-item'><a  class='page-link' href='" . $_SERVER['PHP_SELF'] . "?dir=" . $dir . "&page=" . (($cur_page + 1 > $total_page) ? $total_page : $cur_page + 1) . "' > <i class='fa-solid fa-chevron-right' style='color: #5cc9ff;'></i> </a></li>";
        $data .= "</ul></td></tr>";
    } else {
        $data .= "<tr><td colspan='" . $columns . "'><ul class='pagination justify-content-center'>";
        $data .= "<li class='page-item'><a class='page-link'  href='" . $_SERVER['PHP_SELF'] . "?page=" . (($cur_page - 1 == 0) ? 1 : $cur_page - 1) . "''> <i class='fa-solid fa-chevron-left' style='color: #5cc9ff;'></i> </a></li>&nbsp;&nbsp;";
        for ($j = 1; $j <= $total_page; $j++) {
            if ($j == $cur_page) {
                $data .= "<li class='page-item active'><a class='page-link' href='#'>" . $j . "</a></li>&nbsp;&nbsp;";
            } else {
                $data .= "<li class='page-item'><a class='page-link' href='" . $_SERVER['PHP_SELF'] . "?page=$j''> $j </a></li>&nbsp;&nbsp;";
            }
        }
        $data .= "<li class='page-item'><a  class='page-link' href='" . $_SERVER['PHP_SELF'] . "?page=" . (($cur_page + 1 > $total_page) ? $total_page : $cur_page + 1) . "' > <i class='fa-solid fa-chevron-right' style='color: #5cc9ff;'></i> </a></li>";
        $data .= "</ul></td></tr>";
    }

    $content['page'] = $data;
    return $content;
}
function updateMember($email, $id)
{
    global $link;
    $sql = "UPDATE 用戶 SET 信箱 = " . encapPara($email) . " WHERE ID = " . encapPara($id) . " ";
    $result = mysqli_query($link, $sql);
}
function updateAnn($aid, $title, $start, $end, $content)
{
    global $link;
    $sql = "UPDATE 公告 SET 標題 = " . encapPara($title) . " ,start = " . encapPara($start) . " ,end = " . encapPara($end) . " ,內容 = " . encapPara($content) . " WHERE 公告id = '" . $aid . "'";
    $result = mysqli_query($link, $sql);
}
function addAnn($title, $content, $start, $end)
{
    global $link;
    $sql = "SELECT MAX(CONVERT(公告id,UNSIGNED)) FROM 公告";
    $result = mysqli_query($link, $sql);
    if ($row = $result->fetch_array()) {
        $aid = $row[0] + 1;
    }
    $sql = "INSERT INTO 公告 VALUES( " . encapPara($aid) . " , " . encapPara($title) . " , " . encapPara($content) . " , " . encapPara($start) . " , " . encapPara($end) . " )";
    $result = mysqli_query($link, $sql);
    return $aid;
}
?>