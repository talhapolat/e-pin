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
              <h2 class="no-margin-bottom">Kategoriler</h2>
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
                      <h3 class="h4">Tüm Kategoriler</h3>
                    </div>

                    <div class="card-body " style="overflow: auto;">
                      

                            <table id="example" class="display compact" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Kategori Adı</th>
                <th>Ürün Tipi</th>
                <th>Birim Fiyat</th>
                <th>Alt Birim Simge</th>
                <th>Üst Birim Simge</th>
                <th>Resim</th>
                <th>Statü</th>
                <th style="min-width: 300px;">İşlemler</th>
            </tr>
        </thead>
        <tbody>

            <?php  
                $categoryQuery = $dbConnect->prepare("SELECT * FROM category WHERE deleted = 0 ORDER BY number");
                $categoryQuery->execute();
                $categoryNum = $categoryQuery->rowCount();
                $categories = $categoryQuery->fetchAll(PDO::FETCH_ASSOC);            
            ?>    

            <?php foreach ($categories as $key => $category): ?>

            <tr>
                <td><?= $category["number"] ?></td>
                <td><?= $category["title"] ?></td>
                <td><?= $category["product_type"] ?></td>
                <td><?= $category["price"] ?>₺</td>
                <td><?= $category["birim1"] ?></td>
                <td><?= $category["birim2"] ?></td>
                <td><img height="40px" src="/images/<?= $category["image"] ?>"></td>
                <td><?php if ($category["statu"] == 1): ?>
                         <a href="/chipadmin/panel/app/func.php?categorystatuchange=<?= $category["id"] ?>" class="btn btn-success">AKTİF</a>
                    <?php else: ?>
                         <a href="/chipadmin/panel/app/func.php?categorystatuchange=<?= $category["id"] ?>" class="btn btn-dark">PASİF</a>
                    <?php endif ?>
                    
                </td>
                <td>

                  <?php if ($key == 0): ?>
                  <a type="button" href="/chipadmin/panel/app/func.php?categoryorderchange=<?= $category["id"] ?>&order=1" class="btn btn-dark" style="transform: rotate(90deg); margin-left: 2px">></a>
                  <a type="button" class="btn btn-dark" style="transform: rotate(90deg);"><</a>  
                  
                  <?php elseif ($key == $categoryNum-1): ?>
                  <a class="btn btn-dark" style="transform: rotate(90deg); margin-left: 2px">></a>
                  <a href="/chipadmin/panel/app/func.php?categoryorderchange=<?= $category["id"] ?>&order=-1" class="btn btn-dark" style="transform: rotate(90deg);"><</a>  

                  <?php else : ?>
                  <a href="/chipadmin/panel/app/func.php?categoryorderchange=<?= $category["id"] ?>&order=1" class="btn btn-dark" style="transform: rotate(90deg); margin-left: 2px">></a>  
                  <a href="/chipadmin/panel/app/func.php?categoryorderchange=<?= $category["id"] ?>&order=-1" class="btn btn-dark" style="transform: rotate(90deg);"><</a>
                  <?php endif ?>

                  <a href="categorydetail.php?cid=<?= $category["id"] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i> DÜZENLE</a> <a href="/chipadmin/panel/app/func.php?categorydelete=<?= $category["id"] ?>" class="btn btn-danger"><i class="fa fa-trash"></i> SİL</a>
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