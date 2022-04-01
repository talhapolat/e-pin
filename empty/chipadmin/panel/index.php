<?php  
session_start();
ob_start();
require_once("../../app/connect.php");

$orderQuery = $dbConnect->prepare("SELECT * FROM orders WHERE deleted = 0 AND statu = ?");
$orderQuery->execute([0]);
$ordersNum_0 = $orderQuery->rowCount();

$orderQuery->execute([1]);
$ordersNum_1 = $orderQuery->rowCount();

$orderQuery->execute([2]);
$ordersNum_2 = $orderQuery->rowCount();

$orderQuery->execute([3]);
$ordersNum_3 = $orderQuery->rowCount();

$orderQuery2 = $dbConnect->prepare("SELECT * FROM orders WHERE deleted = 0");
$orderQuery2->execute();
$ordersNum = $orderQuery2->rowCount();

$orderQuery3 = $dbConnect->prepare("SELECT SUM(price) AS total FROM orders WHERE deleted = 0 and statu = 3");
$orderQuery3->execute();
$total = $orderQuery3->fetch(PDO::FETCH_ASSOC);

$orderBQuery = $dbConnect->prepare("SELECT SUM(price) AS totalB FROM orders_balance WHERE deleted = 0 and statu = 1");
$orderBQuery->execute();
$totalB = $orderBQuery->fetch(PDO::FETCH_ASSOC);

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
              <h2 class="no-margin-bottom">Dashboard</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="icon-user"></i></div>
                    <div class="title"><a href="orders1.php" style="color: #777"><span>Ödeme Bekleyen<br>Siparişler</span></a>
                      <div class="progress">
                        <div role="progressbar" style="width: <?= $ordersNum_0*100/$ordersNum ?>%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?= $ordersNum_0 ?></strong></div>
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-red"><i class="icon-padnote"></i></div>
                    <div class="title"><a href="orders2.php" style="color: #777"><span>Teslimat Bekleyen<br>Siparişler</span></a>
                      <div class="progress">
                        <div role="progressbar" style="width: <?= $ordersNum_1*100/$ordersNum ?>%; height: 4px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?= $ordersNum_1 ?></strong></div>
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-green"><i class="icon-bill"></i></div>
                    <div class="title"><a href="orders4.php" style="color: #777"><span>Tamamlanan<br>Siparişler</span></a>
                      <div class="progress">
                        <div role="progressbar" style="width: <?= $ordersNum_3*100/$ordersNum ?>%; height: 4px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?= $ordersNum_3 ?></strong></div>
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-orange"><i class="icon-check"></i></div>
                    <div class="title"><a href="orders3.php" style="color: #777"><span>İptal Edilen<br>Siparişler</span></a>
                      <div class="progress">
                        <div role="progressbar" style="width: <?= $ordersNum_2*100/$ordersNum ?>%; height: 4px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?= $ordersNum_2 ?></strong></div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- Dashboard Header Section    -->
          <section class="dashboard-header">
            <div class="container-fluid">
              <div class="row">
                <!-- Statistics -->
                <div class="statistics col-lg-3 col-12">
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-red"><i class="fa fa-tasks"></i></div>
                    <div class="text"><strong>234</strong><br><small>Üye Sayısı</small></div>
                  </div>
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-yellow"><i class="fa fa-calendar-o"></i></div>
                    <div class="text"><strong><?= $ordersNum ?></strong><br><small>Sipariş Sayısı</small></div>
                  </div>
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-orange"><i class="fa fa-paper-plane-o"></i></div>
                    <div class="text"><strong><?= $total["total"] ?>₺</strong><br><small>Sipariş Toplamı</small></div>
                  </div>
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-green"><i class="fa fa-money"></i></div>
                    <div class="text"><strong><?= $totalB["totalB"] ?>₺</strong><br><small>Yüklenen Bakiye Toplamı</small></div>
                  </div>                  

                </div>
               
                <div class="chart col-lg-3 col-12">
                  <!-- Bar Chart   -->
<!--                   <div class="bar-chart has-shadow bg-white">
                    <div class="title"><strong class="text-violet">95%</strong><br><small>Current Server Uptime</small></div>
                    <canvas id="barChartHome"></canvas>
                  </div> -->
                  <!-- Numbers-->
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-green"><i class="fa fa-line-chart"></i></div>
                    <div class="text"><strong><?= round($ordersNum_3*100/$ordersNum) ?>%</strong><br><small>Başarılı Sipariş Oranı</small></div>
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

  </body>
</html>