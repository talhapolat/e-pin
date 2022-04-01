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
            <h2 class="no-margin-bottom">Siparişler</h2>
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
                    <h3 class="h4">Teslimat Bekleyen Siparişler</h3>
                  </div>

                  <div class="card-body " style="overflow: scroll;">


                    <table id="example" class="display compact" style="width:100%">
                      <thead>
                        <tr>
                          <th>NO</th>
                          <th>Sipariş NO</th>
                          <th>Kullanıcı</th>
                          <th>Ödeme Yöntemi</th>
                          <th>Kategori</th>
                          <th>Ürün Adı</th>
                          <th>Miktar</th>
                          <th>Toplam</th>
                          <th style="min-width: 100px;">Tarih</th>
                          <th style="min-width: 200px;">Statü</th>
                          <th style="min-width: 200px;">İşlemler</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php 
                        $orderQuery = $dbConnect->prepare("SELECT * FROM orders WHERE statu = 1 AND deleted = 0 ORDER BY id DESC");
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

                          $categoryQuery = $dbConnect->prepare("SELECT * FROM category WHERE id = ?");
                          $categoryQuery->execute([$order["category"]]);
                          $categoryNum = $categoryQuery->rowCount();
                          $category = $categoryQuery->fetch(PDO::FETCH_ASSOC);  

                          $productQuery = $dbConnect->prepare("SELECT * FROM product WHERE id = ?");
                          $productQuery->execute([$order["product"]]);
                          $productNum = $productQuery->rowCount();
                          $product = $productQuery->fetch(PDO::FETCH_ASSOC);    

                          if ($productNum == 1) {
                            $product_title = $product["title"];
                          } else {
                            $product_title = "Özel Paket";
                          }                                          
                          ?>    

                          <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $order["order_number"] ?></td>
                            <td>
                            <?php if ($user["name"] != null) {
                                print($user["name"]);
                              } else { ?>
                                <span style="color:blue">Ziyaretçi</span>
                                <?php
                              }  
                              ?>
                            </td>
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
                            <td><?= $category["title"] ?></td>
                            <td><?= $product_title ?></td>
                            <td><?= $order["qty"] ?> <?= $category["birim1"] ?></td>
                            <td><?= $order["price"] ?>₺</td>
                            <td><?= $order["created_at"] ?></td>
                            <td>
                              <?php  
                              switch ($order["statu"]) {
                                case 0:
                                ?>
                                <!-- <a href="/chipadmin/panel/app/func.php?orderstatuchange=<?= $order["id"] ?>&statu=1" class="btn btn-secondary">Ödeme Bekliyor</a> --> 
                                <a href="#" style="color: white; text-decoration: none" class="btn btn-secondary">Ödeme Bekliyor</a>
                                <?php
                                break;
                                case 1:
                                ?>
                                <!-- <a href="/chipadmin/panel/app/func.php?orderstatuchange=<?= $order["id"] ?>&statu=3" class="btn btn-warning">Teslimat Bekliyor</a>  -->
                                <a href="#" style="color: white; text-decoration: none" class="btn btn-warning">Teslimat Bekliyor</a> 
                                <?php
                                break;
                                case 2:
                                ?>
                                <!-- <a href="/chipadmin/panel/app/func.php?orderstatuchange=<?= $order["id"] ?>&statu=0" class="btn btn-danger">Sipariş İptal</a> --> 
                                <a href="#" style="color: white; text-decoration: none" class="btn btn-danger">Sipariş İptal</a> 
                                <?php
                                break;
                                case 3:
                                ?>
                                <!-- <a href="/chipadmin/panel/app/func.php?orderstatuchange=<?= $order["id"] ?>&statu=2" class="btn btn-success">Sipariş Tamamlandı</a> --> 
                                <a href="#" style="color: white; text-decoration: none" class="btn btn-success">Sipariş Tamamlandı</a>
                                <?php
                                break;    
                              }
                              ?> 
                            </td>     
                            <td>
                              <a href="#" 
                              onclick="window.open('orderdetail.php?order=<?= $order["id"] ?>', 'newwindow', 'width=500,height=1000'); return false;" 
                              class="btn btn-info">DETAYLAR</a> 
                              <a href="/chipadmin/panel/app/func.php?orderdelete=<?= $order["id"] ?>" class="btn btn-danger"><i class="fa fa-trash"></i> SİL</a>
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