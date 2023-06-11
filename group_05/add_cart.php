<?php
session_start();
include_once('api.php');
if (isset($_SESSION['cart']) && $_SESSION['cart'] != "" ) {
    $cart = $_SESSION['cart'];
    $temp = array_filter(explode(",", $cart));
    for ($i = 0; $i < count($temp); $i += 2) {
        $arr_cart[$temp[$i]] = $temp[$i + 1];
    }
    if (isset($_POST['uid'])) {
        $uid = $_POST['uid'];
        $amount = $_POST['amount'];
        //用uid 在sql內查詢商品名稱，並加入購屋車內
        $sql = "SELECT 品名 FROM 商品 WHERE UID = '" . $uid . "'";
        if ($result = mysqli_query($link, $sql)) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['品名'];
                if (array_key_exists($id, $arr_cart)) {
                    $arr_cart[$id] += $amount;
                } else {
                    $arr_cart[$id] = $amount;
                }
            }
        }

    }

} else {
    if (isset($_POST['uid'])) {
        $uid = $_POST['uid'];
        $amount = $_POST['amount'];
        //用uid 在sql內查詢商品名稱，並加入購屋車內
        $sql = "SELECT 品名 FROM 商品 WHERE UID = '" . $uid . "'";
        if ($result = mysqli_query($link, $sql)) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['品名'];
                $arr_cart[$id] = $amount;
            }
        }
    }

}
$item = array_keys($arr_cart);
$num = array_values($arr_cart);
$result = '';
$length = count($arr_cart);
for ($i = 0; $i < $length - 1; $i++) {
    $result = $result . $item[$i] . "," . $num[$i] . ",";
}
$result = $result . $item[$length - 1] . "," . $num[$length - 1];
$_SESSION['cart'] = $result;
echo $id;
?>