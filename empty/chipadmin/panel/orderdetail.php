<?php  
session_start();
ob_start();
require_once("../../app/connect.php");

$orderQuery = $dbConnect->prepare("SELECT * FROM orders WHERE id = ?");
$orderQuery->execute([$_GET["order"]]);
$orderNum = $orderQuery->rowCount();
$order = $orderQuery->fetch(PDO::FETCH_ASSOC);

if ($orderNum != 1) {
  echo "HATA KODU 3873513520";
  exit();
}

?>
<!DOCTYPE html>
<html>
  <head>  
      <?php include("sections/head.php") ?> 
  </head>
  <body>
    <div class="page">
      
      <!-- CONTENT -->

      <div class="page-content d-flex align-items-stretch"> 


        <div class="content-inner">

          <!-- Dashboard Counts Section-->
      
          <!-- Updates Section                                                -->
          <section class="updates no-padding-top">
            <div class="container-fluid">
              <div class="row">
                <!-- Recent Updates-->
                <div class="col-lg-12 p-3">
                  <div class="recent-updates card p-3">
                    
                    <div class="card-header">
                      <h3 class="h4">Sipariş Detayı</h3>
                    </div>

                    <div class="card-body ">
                      

  <form action="/chipadmin/panel/app/func.php" method="POST" enctype="multipart/form-data">

  <div class="mb-3">
    <label for="InputTitle" class="form-label">Sipariş NO</label>
    <h6><?= $order["order_number"] ?></h6>
  </div>

  <div class="mb-3">
    <label for="InputQty" class="form-label">Kullanıcı</label>
<?php  
$userQuery = $dbConnect->prepare("SELECT * FROM users WHERE id = ?");
$userQuery->execute([$order["user_id"]]);
$userNum = $userQuery->rowCount();
$user = $userQuery->fetch(PDO::FETCH_ASSOC); 
?>   
    <h6><?= $user["name"] ?></h6>
  </div>

  <div class="mb-3">
    <label for="InputPrice" class="form-label">Ödeme Yöntemi</label> <br>
    <h6>
                    <?php  
                      switch ($order["payment"]) {
                      case 0:
                          echo "Havale/EFT";
                          break;
                      case 1:
                          echo "Kredi Kartı";
                          break;
                      case 2:
                          echo "Bakiye";
                          break;  
                      }
                    ?> 
    </h6>               
  </div>

  <div class="mb-3">
    <label for="InputStock" class="form-label">Kategori</label>
<?php  
$categoryQuery = $dbConnect->prepare("SELECT * FROM category WHERE id = ?");
$categoryQuery->execute([$order["category"]]);
$categoryNum = $categoryQuery->rowCount();
$category = $categoryQuery->fetch(PDO::FETCH_ASSOC); 
?>     
    <h6><?= $category["title"] ?></h6>
  </div>  

  <div class="mb-3">
    <label for="InputTitle" class="form-label">Miktar</label>
    <h6><?= $order["qty"] ?> <?= $category["birim1"] ?></h6>
  </div>

<?php if ($order["in_name"] != null): ?>
  <div class="mb-3">
    <label class="form-label">Ad Soyad</label>
    <h6><?= $order["in_name"] ?></h6>
  </div>
<?php endif ?>  

<?php if ($order["in_facemail"] != null): ?>
  <div class="mb-3">
    <label class="form-label">Facebook E-posta</label>
    <h6><?= $order["in_facemail"] ?></h6>
  </div>
<?php endif ?>

<?php if ($order["in_facepass"] != null): ?>
  <div class="mb-3">
    <label class="form-label">Facebook Şifre</label>
    <h6><?= $order["in_facepass"] ?></h6>
  </div>
<?php endif ?>

<?php if ($order["in_phone"] != null): ?>
  <div class="mb-3">
    <label class="form-label">Telefon</label>
    <h6><?= $order["in_phone"] ?></h6>
  </div>
<?php endif ?>

<?php if ($order["in_gameid"] != null): ?>
  <div class="mb-3">
    <label class="form-label">Oyun ID</label>
    <h6><?= $order["in_gameid"] ?></h6>
  </div>
<?php endif ?>

<?php if ($order["in_vip"] != null): ?>
  <div class="mb-3">
    <label class="form-label">Zynga VIP</label>
<?php  
$zyngaVipQuery = $dbConnect->prepare("SELECT * FROM zynga_vip WHERE id = ?");
$zyngaVipQuery->execute([$order["in_vip"]]);
$zyngaVipNum = $zyngaVipQuery->rowCount();
$zyngaVip = $zyngaVipQuery->fetch(PDO::FETCH_ASSOC); 
?>      
    <h6><?= $zyngaVip["title"] ?></h6>
  </div>
<?php endif ?>

  <div class="mb-3">
    <label for="InputQty" class="form-label">Toplam Tutar</label>
    <h6><?= $order["price"] ?> ₺</h6>
  </div>

  <div class="mb-3">
    <label for="InputPrice" class="form-label">Tarih</label>
    <h6><?= $order["created_at"] ?></h6>
  </div>

  <div class="mb-3">
    <label for="InputStock" class="form-label">Statü</label>
    <h6>
                          <?php  
                      switch ($order["statu"]) {
                      case 0:
                          ?>
                          <a href="/chipadmin/panel/app/func.php?orderstatuchange=<?= $order["id"] ?>&statu=1" class="btn btn-secondary">Ödeme Bekliyor</a> 
                          <?php
                          break;
                      case 1:
                          ?>
                          <a href="/chipadmin/panel/app/func.php?orderstatuchange=<?= $order["id"] ?>&statu=3" class="btn btn-warning">Teslimat Bekliyor</a> 
                          <?php
                          break;
                      case 2:
                          ?>
                          <a href="/chipadmin/panel/app/func.php?orderstatuchange=<?= $order["id"] ?>&statu=0" class="btn btn-danger">Sipariş İptal</a> 
                          <?php
                          break;
                      case 3:
                          ?>
                          <a href="/chipadmin/panel/app/func.php?orderstatuchange=<?= $order["id"] ?>&statu=2" class="btn btn-success">Sipariş Tamamlandı</a> 
                          <?php
                          break;    
                      }
                    ?>
    </h6>
  </div>   

</form>



                    </div>



                  </div>
                </div>
             

              </div>


            </div>
          </section>


        </div>
      </div>



      <!-- CONTENT END -->

    </div>

      <?php include("sections/footer.php") ?>
      <script type="text/javascript">
        $(document).ready(function() {
    $('#example').DataTable();
} );
      </script>
  </body>
</html>