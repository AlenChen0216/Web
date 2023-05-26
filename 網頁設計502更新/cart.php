<?php 
  if(isset($_SESSION['cart'])&&$_SESSION['cart']!=''){
    //$_SESSION['cart'] = '吳郭魚,1,小卷,2,松阪豬,3,澳洲牛,1,國產雞,4';
    $cart = $_SESSION['cart'];
    $temp= array_filter(explode(",",$cart));
    $array_cart;
    for($i=0;$i<count($temp);$i+=2){
      $array_cart[$temp[$i]] =  $temp[$i+1];
    }
  }else{
    $array_cart = null;
    $cart="";
  }
  function display(){
    global $array_cart;
    if($array_cart!=null){
      $item = array_keys($array_cart);
      $num = array_values($array_cart);
      for($i=0;$i<count($array_cart);$i++){
        echo '<tr>
        <th scope="row">
          <a id="remove" class="re" href="#" onclick="remove('.'\''.$item[$i].'\''.')">
            <i class="fas fa-trash-alt"></i>
        </th>';
        echo '<td>'.$item[$i].'</td>';
        echo '<td>'.$num[$i].'</td>';
        //65元的部分，請改成用sql，透過商品名，來找對應的售價。
        echo '<td class="text-right"> $'.(65*$num[$i]).'</td></tr>';
      }
    }
  }
?>


<div class="dropdown">
    <div class="dropdown ml-auto">
      <button type="button" class="btn" data-toggle="dropdown">
        <i class="fas fa-cart-plus" style="color: white;"></i>
        <span class="badge badge-pill badge-warning"><?php  if($array_cart==null){echo 0;}else{echo (count($array_cart));}  ?></span>
      </button>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuReference"
        style="min-width:400px;">
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
          <a href="./information.php?dir=shop" class="btn btn-primary btn-block"> 結帳去</a>
        </div>
      </div>
    </div>