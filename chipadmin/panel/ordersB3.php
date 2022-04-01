<?php  
session_start();
ob_start();
require_once("../../app/connect.php");
?>
<!DOCTYPE html>
<html>
  <head>  
      <?php include("sections/head.php") ?> 
  </head>
  <body>
    <div class="page">
    	
      <!-- Main Navbar-->
      <header class="header">
        <?php include("sections/header.php") ?> 
      </header>


      <!-- CONTENT -->

      <div class="page-content d-flex align-items-stretch"> 

        <!-- Side Navbar -->
        <nav class="side-navbar">
          <?php include("sections/sidebar.php") ?> 
        </nav>


        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Bakiye Yükleme</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
      
          <!-- Updates Section                                                -->
          <section class="updates no-padding-top">
            <div class="container-fluid">
              <div class="row">
                <!-- Recent Updates-->
                <div class="col-lg-12 p-3">
                  <div class="recent-updates card p-3">
                    
                    <div class="card-header">
                      <h3 class="h4">Tüm Bakiye Yüklemeleri</h3>
                    </div>

                    <div class="card-body " style="overflow: scroll;">
                      

                            <table id="example" class="display compact" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Sipariş NO</th>
                <th>Kullanıcı</th>
                <th>Ödeme Yöntemi</th>
                <th>Toplam</th>
                <th style="min-width: 100px;">Tarih</th>
                <th style="min-width: 200px;">Statü</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>

            <?php 
                $orderQuery = $dbConnect->prepare("SELECT * FROM orders_balance WHERE deleted = 0 ORDER BY id DESC");
                $orderQuery->execute();
                $ordersNum = $orderQuery->rowCount();
                $orders = $orderQuery->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php foreach ($orders as $key => $order): ?>

            <?php  
                $userQuery = $dbConnect->prepare("SELECT * FROM users WHERE id = ?");
                $userQuery->execute([$order["user_id"]]);
                $usersNum = $userQuery->rowCount();
                $user = $userQuery->fetch(PDO::FETCH_ASSOC);                           
            ?>    

            <tr>
                <td><?= $key ?></td>
                <td><?= $order["order_number"] ?></td>
                <td><?= $user["name"] ?></td>
                <td>
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
                </td>
                <td><?= $order["price"] ?>₺</td>
                <td><?= $order["created_at"] ?></td>
                <td> 
                    <?php  
                      switch ($order["statu"]) {
                      case 0:
                          ?>
                          <a href="/chipadmin/panel/app/func.php?orderBstatuchange=<?= $order["id"] ?>&statu=1" class="btn btn-secondary">Ödeme Bekliyor</a> 
                          <?php
                          break;
                      case 1:
                          ?>
                          <a href="/chipadmin/panel/app/func.php?orderBstatuchange=<?= $order["id"] ?>&statu=2" class="btn btn-success">Sipariş Tamamlandı</a> 
                          <?php
                          break;
                      case 2:
                          ?>
                          <a href="/chipadmin/panel/app/func.php?orderBstatuchange=<?= $order["id"] ?>&statu=0" class="btn btn-danger">Sipariş İptal</a> 
                          <?php
                          break;    
                      }
                    ?>
                </td>
                <td> 
                  <a href="/chipadmin/panel/app/func.php?orderBdelete=<?= $order["id"] ?>" class="btn btn-danger"><i class="fa fa-trash"></i> SİL</a>
                </td>
            </tr>                
                
            <?php endforeach ?>
            

           
        </tbody>
    </table>


                    </div>



                  </div>
                </div>
             

              </div>



            </div>
          </section>







          <!-- Page Footer-->
          <footer class="main-footer">
<?php include("sections/foot.php") ?>
          </footer>
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