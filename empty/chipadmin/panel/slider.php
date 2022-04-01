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
              <h2 class="no-margin-bottom">Slider</h2>
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
                      <h3 class="h4">Slider Görselleri <a href="/chipadmin/panel/addslider.php" class="btn btn-dark" style="float: right;">YENİ</a></h3>
                    </div>

                    <div class="card-body " style="overflow: auto;">
                      

                            <table id="example" class="display compact" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th style="min-width: 300px">Resim</th> 
                <th style="min-width: 100px">Başlık</th>              
                <th style="text-align: right;">Statü</th>
                <th style="text-align: right; min-width: 250px">İşlemler</th>
            </tr>
        </thead>
        <tbody>

            <?php 
                $sliderQuery = $dbConnect->prepare("SELECT * FROM slider ORDER BY number");
                $sliderQuery->execute();
                $sliderNum = $sliderQuery->rowCount();
                $sliders = $sliderQuery->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php foreach ($sliders as $key => $slider): ?>

            <tr>
                <td><?= $slider["number"] ?></td>
                <td><img height="140px" src="/images/slider/<?= $slider["image"] ?>"></td>
                <td ><?= $slider["title"] ?></td>                
                <td style="text-align: right;">
                    <?php if ($slider["statu"] == 1): ?>
                         <a href="/chipadmin/panel/app/func.php?sliderstatuchange=<?= $slider["id"] ?>&statu=0" class="btn btn-success">AKTİF</a>
                    <?php else: ?>
                         <a href="/chipadmin/panel/app/func.php?sliderstatuchange=<?= $slider["id"] ?>&statu=1" class="btn btn-dark">PASİF</a>
                    <?php endif ?>
                </td>              
                <td style="text-align: right;">
                  <?php if ($key == 0): ?>
                  <a type="button" href="/chipadmin/panel/app/func.php?sliderorderchange=<?= $slider["id"] ?>&order=1" class="btn btn-dark" style="transform: rotate(90deg); margin-left: 2px">></a>
                  <a type="button" class="btn btn-dark" style="transform: rotate(90deg);"><</a>  
                  
                  <?php elseif ($key == $sliderNum-1): ?>
                  <a class="btn btn-dark" style="transform: rotate(90deg); margin-left: 2px">></a>
                  <a href="/chipadmin/panel/app/func.php?sliderorderchange=<?= $slider["id"] ?>&order=-1" class="btn btn-dark" style="transform: rotate(90deg);"><</a>  

                  <?php else : ?>
                  <a href="/chipadmin/panel/app/func.php?sliderorderchange=<?= $slider["id"] ?>&order=1" class="btn btn-dark" style="transform: rotate(90deg); margin-left: 2px">></a>  
                  <a href="/chipadmin/panel/app/func.php?sliderorderchange=<?= $slider["id"] ?>&order=-1" class="btn btn-dark" style="transform: rotate(90deg);"><</a>
                  <?php endif ?>
                  
                  <a href="/chipadmin/panel/sliderdetail.php?sid=<?= $slider["id"] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i> DÜZENLE</a> 
                  <a href="/chipadmin/panel/app/func.php?sliderdelete=<?= $slider["id"] ?>" class="btn btn-danger"><i class="fa fa-trash"></i> SİL</a>
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