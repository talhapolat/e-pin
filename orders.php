<?php  
session_start();
ob_start();
require_once("app/connect.php");

if (!isset($_SESSION["useremail"])) {
  header("Location: /app/func.php?logout=ok");
} else {
  $userQuery   = $dbConnect->prepare("SELECT * FROM users WHERE email = ? and statu = 1");
  $userQuery->execute([$_SESSION["useremail"]]);
  $userNum     = $userQuery->rowCount();
  $user        = $userQuery->fetch(PDO::FETCH_ASSOC);

  if ($userNum != 1) {
    header("Location: /app/func.php?logout=ok");
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<?php include("sections/head.php") ?> 

<body class="animsition">
	
  <?php include("sections/header.php") ?> 

  
  <?php include("sections/duyuru.php") ?> 

  <!-- breadcrumb -->
  <div class="container">
    <div class="bread-crumb flex-w p-r-15 p-t-30 p-lr-0-lg">
      <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
        Anasayfa
        <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
      </a>

      <span class="stext-109 cl4">
        Siparişlerim
      </span>
    </div>
  </div>


  <div class="container mt-5">	
    <div class="row">

     <div class="col-md-9 col-12 mb-5">

      <div class="p-b-10">
        <h3 class="ltext-102 cl5">
          <i class="fab fa-shopify"></i> SİPARİŞLERİM
        </h3>
      </div>


      <div class="row mt-3 mobileorders" style="overflow: auto;">


        <?php  

        $orderQuery = $dbConnect->prepare("SELECT * FROM orders WHERE user_id = ? and deleted = 0");
        $orderQuery->execute([$user["id"]]);
        $ordersNum = $orderQuery->rowCount();
        $orders = $orderQuery->fetchAll(PDO::FETCH_ASSOC);

        if ($ordersNum == 0) { ?>
          <div class="container">
            <h5>Henüz sipariş vermediniz.</h5>
          </div>
          <?php  
        } else { ?>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">NO</th>
                
                <th scope="col">Ürün Adı</th>
                <th scope="col">Tutar</th>
                <th scope="col">Durum</th>
                <th scope="col">İşlem</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              foreach ($orders as $key => $order) { ?>
                <tr>
                  <th scope="row"><a style="font-size: 13px"><?= $order["order_number"] ?></a></th>
                  <?php  
                  $categoryQuery = $dbConnect->prepare("SELECT * FROM category WHERE statu = 1 and id = ?");
                  $categoryQuery->execute([$order["category"]]);
                  $categoryNum = $categoryQuery->rowCount();
                  $category = $categoryQuery->fetch(PDO::FETCH_ASSOC);

                  $productQuery = $dbConnect->prepare("SELECT * FROM product WHERE id = ?");
                  $productQuery->execute([$order["product"]]);
                  $productNum = $productQuery->rowCount();
                  $product = $productQuery->fetch(PDO::FETCH_ASSOC);    

                  if ($productNum == 1) {
                    $product_title = $product["title"];
                  } elseif ($productNum == 0) {
                    $product_title = "Özel Paket";
                  } else {
                    $product_title = "Bulunamadı";
                  }     

                  ?>      
                  
                  <td><?= $product_title ?></td>
                  <td><?= $order["price"] ?>₺</td>
                  <td>
                    <?php  
                    switch ($order["statu"]) {
                      case 0:
                      ?>
                      <a style="color: orange; font-size: 10px">ÖDENMEDİ</a> 
                      <?php
                      break;
                      case 1:
                      ?>
                      <a style="color: blue; font-size: 10px">İŞLEMDE</a> 
                      <?php
                      break;
                      case 2:
                      ?>
                      <a style="color: red; font-size: 10px">İPTAL</a> 
                      <?php
                      break;
                      case 3:
                      ?>
                      <a style="color: green; font-size: 10px">TAMAMLANDI</a> 
                      <?php
                      break;    
                    }
                    ?>
                  </td>      
                  <td style="text-align: center"><i class="fas fa-arrow-circle-right" style="font-size: 20px;"></i></td>
                </tr> 
                <?php
              } 
              ?>

            </tbody>
          </table>
          <?php
        }

        ?>













      </div>
















      <div class="row mt-3 desktoporders" style="overflow: auto;">


      	<?php  

       $orderQuery = $dbConnect->prepare("SELECT * FROM orders WHERE user_id = ? and deleted = 0");
       $orderQuery->execute([$user["id"]]);
       $ordersNum = $orderQuery->rowCount();
       $orders = $orderQuery->fetchAll(PDO::FETCH_ASSOC);

       if ($ordersNum == 0) { ?>
        <div class="container">
          <h5>Henüz sipariş vermediniz.</h5>
        </div>
        <?php  
      } else { ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Sıra</th>
              <th scope="col">Sipariş No</th>
              <th scope="col">Kategori</th>
              <th scope="col">Ürün Adı</th>
              <th scope="col">Miktar</th>
              <th scope="col">Toplam Tutar</th>
              <!-- <th scope="col">Ödeme</th> -->
              <th scope="col">Durum</th>
              <th scope="col">Tarih</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            foreach ($orders as $key => $order) { ?>
              <tr>
                <th scope="row"><?= $key+1 ?></th>
                <th scope="row"><?= $order["order_number"] ?></th>
                <?php  
                $categoryQuery = $dbConnect->prepare("SELECT * FROM category WHERE statu = 1 and id = ?");
                $categoryQuery->execute([$order["category"]]);
                $categoryNum = $categoryQuery->rowCount();
                $category = $categoryQuery->fetch(PDO::FETCH_ASSOC);
                ?>      
                <td><?= $category["title"] ?></td>
                <?php 
                $productQuery = $dbConnect->prepare("SELECT * FROM product WHERE id = ?");
                $productQuery->execute([$order["product"]]);
                $productNum = $productQuery->rowCount();
                $product = $productQuery->fetch(PDO::FETCH_ASSOC);    

                if ($productNum == 1) {
                  $product_title = $product["title"];
                } elseif ($productNum == 0) {
                  $product_title = "Özel Paket";
                } else {
                  $product_title = "Bulunamadı";
                }  
                ?>
                <td><?= $product_title ?></td>
                <td><?= $order["qty"] ?> <?= $category["birim1"] ?></td>
                <td><?= $order["price"] ?>₺</td>
<!--                 <td><?php switch ($order["payment"]) {
                  case '0':
                  ?> <small>Havale / EFT</small> <?php
                  break;
                  case '1':  
                  ?> <small>Kredi Kartı</small> <?php
                  break;
                  case '2':  
                  ?> <small>Bakiye</small> <?php
                  break;          
                  default:
                  ?> <small>-</small> <?php
                  break;
                } ?></td> -->
                <td>
                  <?php  
                  switch ($order["statu"]) {
                    case 0:
                    ?>
                    <a style="color: orange">Ödeme Bekliyor</a> 
                    <?php
                    break;
                    case 1:
                    ?>
                    <a style="color: blue">Teslimat Bekliyor</a> 
                    <?php
                    break;
                    case 2:
                    ?>
                    <a style="color: red">İptal Edildi</a> 
                    <?php
                    break;
                    case 3:
                    ?>
                    <a style="color: green">Sipariş Tamamlandı</a> 
                    <?php
                    break;    
                  }
                  ?>
                </td>      
                <td><?= $order["created_at"] ?></td>
              </tr> 
              <?php
            } 
            ?>

          </tbody>
        </table>
        <?php
      }

      ?>



      






      


    </div>




  </div>

  <div class="col-md-3 justify-content-center desktopslider" style="background-color: ; border: 2px solid #f1f1f1;padding-top: 20px">

    <?php include("sections/widgetlogin.php") ?>

  </div>



</div>



<?php 

$orderQueryB = $dbConnect->prepare("SELECT * FROM orders_balance WHERE user_id = ? and deleted = 0");
$orderQueryB->execute([$user["id"]]);
$ordersNumB = $orderQueryB->rowCount();
$ordersB = $orderQueryB->fetchAll(PDO::FETCH_ASSOC);

?>


<?php if ($ordersNumB > 0): ?>


  <div class="row">

    <div class="col-md-9 col-12 mb-5">

      <div class="p-b-10">
        <h3 class="ltext-102 cl5">
          <i class="fas fa-plus-circle"></i> BAKİYE YÜKLEME
        </h3>
      </div>



      <div class="row mt-3 mobileorders" style="overflow: auto;">


        <?php  



        if ($ordersNumB == 0) { ?>
          <div class="container">
            <h5>Henüz sipariş vermediniz.</h5>
          </div>
          <?php  
        } else { ?>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">NO</th>
                <th scope="col">Tutar</th>
                <th scope="col">Ödeme</th>
                <th scope="col">Durum</th>
                <th scope="col">Tarih</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              foreach ($ordersB as $key => $order) { ?>
                <tr>
                  <th scope="row"><a style="font-size: 13px"><?= $order["order_number"] ?></a></th>
                  <td><?= $order["price"] ?>₺</td>
                  <td><?php switch ($order["payment"]) {
                    case '0':
                    ?> <small style="font-size: 10px">Havale</small> <?php
                    break;
                    case '1':  
                    ?> <small style="font-size: 10px">Kredi Kartı</small> <?php
                    break;
                    default:
                    ?> <small>-</small> <?php
                    break;
                  } ?></td>
                  <td>
                    <?php  
                    switch ($order["statu"]) {
                      case 0:
                      ?>
                      <a style="color: orange; font-size: 10px">Ödeme Bekliyor</a> 
                      <?php
                      break;
                      case 2:
                      ?>
                      <a style="color: red; font-size: 10px">Sipariş İptal</a> 
                      <?php
                      break;
                      case 1:
                      ?>
                      <a style="color: green; font-size: 10px">Tamamlandı</a> 
                      <?php
                      break;    
                    }
                    ?>
                  </td>
                  <td><a style="font-size: 11px"><?= $order["created_at"] ?></a></td>
                </tr> 
                <?php
              } 
              ?>

            </tbody>
          </table>
          <?php
        }

        ?>


      </div>






      <div class="row mt-3 desktoporders" style="overflow: auto;">


        <?php  



        if ($ordersNumB == 0) { ?>
          <div class="container">
            <h5>Henüz sipariş vermediniz.</h5>
          </div>
          <?php  
        } else { ?>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Sıra</th>
                <th scope="col">Sipariş No</th>
                <th scope="col">Toplam Tutar</th>
                <th scope="col">Ödeme</th>
                <th scope="col">Durum</th>
                <th scope="col">Tarih</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              foreach ($ordersB as $key => $order) { ?>
                <tr>
                  <th scope="row"><?= $key+1 ?></th>
                  <th scope="row"><?= $order["order_number"] ?></th>
                  <td><?= $order["price"] ?>₺</td>
                  <td><?php switch ($order["payment"]) {
                    case '0':
                    ?> <small>Havale / EFT</small> <?php
                    break;
                    case '1':  
                    ?> <small>Kredi Kartı</small> <?php
                    break;
                    default:
                    ?> <small>-</small> <?php
                    break;
                  } ?></td>
                  <td>
                    <?php  
                    switch ($order["statu"]) {
                      case 0:
                      ?>
                      <a style="color: orange">Ödeme Bekliyor</a> 
                      <?php
                      break;
                      case 2:
                      ?>
                      <a style="color: red">İptal Edildi</a> 
                      <?php
                      break;
                      case 1:
                      ?>
                      <a style="color: green">Tamamlandı</a> 
                      <?php
                      break;    
                    }
                    ?>
                  </td>
                  <td><?= $order["created_at"] ?></td>
                </tr> 
                <?php
              } 
              ?>

            </tbody>
          </table>
          <?php
        }

        ?>


      </div>

    </div>



  </div>


<?php endif ?>


</div>




<!-- OYUNLAR -->
<div class="sec-banner bg0 p-t-40 p-b-50">
  <div class="container">
   <div class="row">

    <div class="col-xl-9">



    </div>




    <div class="col-xl-3 ">


    </div>

    <div class="col-xl-3">

    </div>


  </div>


  
</div>
</div> 




<div class="text-center p-t-95" style="text-indent: center" >
  <img src="images/sitealt_ftr.png" class="img-fluid">
</div>


<?php include("sections/footer.php") ?>


<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
  <span class="symbol-btn-back-to-top">
   <i class="zmdi zmdi-chevron-up"></i>
 </span>
</div>


<div id="fb-root"></div>



<?php include("sections/jsasset.php") ?>


</body>
</html>

<?php
$dbConnect = null;

?>