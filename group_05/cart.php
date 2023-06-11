<?php
if (isset($_SESSION['cart']) && $_SESSION['cart'] != '') {
  $total = 100;
  $cart = $_SESSION['cart'];
  $temp = array_filter(explode(",", $cart));
  $array_cart = array();
  for ($i = 0; $i < count($temp); $i += 2) {
    $array_cart[$temp[$i]] = $temp[$i + 1];
  }
} else {
  $array_cart = null;
  $cart = "";
}
function display() //顯示購物車的內容悟(可改成ajax)
{
  global $array_cart;
  global $total;
  global $link;
  if ($array_cart != null) {
    $item = array_keys($array_cart);
    $num = array_values($array_cart);
    for ($i = 0; $i < count($array_cart); $i++) {
      $sql = "SELECT * FROM 商品 WHERE 品名 = '" . $item[$i] . "'";
      if ($result = mysqli_query($link, $sql)) {
        while ($row = $result->fetch_assoc()) {
          $temp = $num[$i] * $row['售價'];
          $total += $temp;
          echo '<tr>
        <th scope="row">
          <a id="remove" class="re" href="#" onclick="remove(' . '\'' . $item[$i] . '\'' . ')">
            <i class="fas fa-trash-alt"></i>
        </th>';
          echo '<td>' . $item[$i] . '</td>';
          echo '<td>' . $num[$i] . '</td>';
          echo '<td class="text-right"> $' . $temp . '</td></tr>';
        }
      }
      mysqli_free_result($result);
    }
  }
  if($total>=600){
    $total -= 60;
  }
}
?>


<div class="dropdown">
  <div class="dropdown ml-auto">
    <button type="button" class="btn" data-toggle="dropdown">
      <i class="fas fa-cart-plus" style="color: white;"></i>
      <span class="badge badge-pill badge-warning">
        <?php if ($array_cart == null) {
          echo 0;
        } else {
          echo (count($array_cart));
        } ?>
      </span>
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuReference" style="min-width:400px;">
      <div class="px-4 py-3">
        <table class="table">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">商品名稱</th>
              <th scope="col">數量</th>
              <th scope="col">小計</th>
            </tr>
          </thead>
          <tbody>
            <!--   車內商品   -->
            <?php display(); ?>
          </tbody>
        </table>
        <table class="table">
          <tbody>
            <tr>
              <td class = "align-middle">
                <a href="./information.php?dir=shop" class="btn btn-primary btn-block"> 結帳去</a>
              </td>
              <td class = "align-bottom">
                總金額： <?php echo "NT$".(($total==null)?0:$total) ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>