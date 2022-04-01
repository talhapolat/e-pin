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
              <h2 class="no-margin-bottom">Ürünler</h2>
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
                      <h3 class="h4">Tüm Ürünler</h3>
                    </div>

                    <div class="card-body " style="overflow: auto;">
                      

                            <table id="example" class="display compact" style="width:100%;">
        <thead>
            <tr>
                <th>NO</th>
                <th>Ürün Adı</th>
                <th>Kategori</th>
                <th>Resim</th>
                <th>Miktar</th>
                <th>Fiyat</th>
                <th>Stok</th>
                <th>Statü</th>
                <th style="min-width: 200px;">İşlemler</th>
            </tr>
        </thead>
        <tbody>

            <?php 
                $productQuery = $dbConnect->prepare("SELECT * FROM product WHERE deleted = 0");
                $productQuery->execute();
                $productNum = $productQuery->rowCount();
                $products = $productQuery->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php foreach ($products as $key => $product): ?>

            <?php  
                $categoryQuery = $dbConnect->prepare("SELECT * FROM category WHERE id = ?");
                $categoryQuery->execute([$product["category_id"]]);
                $categoryNum = $categoryQuery->rowCount();
                $category = $categoryQuery->fetch(PDO::FETCH_ASSOC);            
            ?>    

            <tr>
                <td><?= $key+1 ?></td>
                <td><?= $product["title"] ?></td>
                <td><?= $category["title"] ?></td>
                <td><img height="40px" src="/images/<?= $product["image"] ?>"></td>
                <td><?= $product["qty"] ?> <?= $category["birim1"] ?></td>
                <td><?= $product["price"] ?>₺</td>
                <td><?= $product["stock"] ?></td>
                <td><?php if ($product["statu"] == 1): ?>
                         <a href="/chipadmin/panel/app/func.php?productstatuchange=<?= $product["id"] ?>" class="btn btn-success">AKTİF</a>
                    <?php else: ?>
                         <a href="/chipadmin/panel/app/func.php?productstatuchange=<?= $product["id"] ?>" class="btn btn-dark">PASİF</a>
                    <?php endif ?>
                    
                </td>
                <td style="min-width: 200px;"><a href="productdetail.php?pid=<?= $product["id"] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i> DÜZENLE</a> <a href="/chipadmin/panel/app/func.php?productdelete=<?= $product["id"] ?>" class="btn btn-danger"><i class="fa fa-trash"></i> SİL</a></td>
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