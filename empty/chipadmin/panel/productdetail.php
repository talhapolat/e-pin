<?php  
session_start();
ob_start();
require_once("../../app/connect.php");

$product_id = $_GET["pid"];

                $productQuery = $dbConnect->prepare("SELECT * FROM product WHERE id = ?");
                $productQuery->execute([$product_id]);
                $productNum = $productQuery->rowCount();
                $product = $productQuery->fetch(PDO::FETCH_ASSOC);

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
                      <h3 class="h4">Ürün Düzenle</h3>
                    </div>

                    <div class="card-body ">
                      

  <form action="/chipadmin/panel/app/func.php" method="POST" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="InputCategory" class="form-label">Kategori</label> <br>
    <select class="form-select" aria-label="Default select example" name="category">
            <?php  
                $categoryQuery = $dbConnect->prepare("SELECT * FROM category");
                $categoryQuery->execute();
                $categoryNum = $categoryQuery->rowCount();
                $categories = $categoryQuery->fetchAll(PDO::FETCH_ASSOC);            
            ?>     	

            <?php foreach ($categories as $key => $category): ?>
            	<option value="<?= $category["id"] ?>" 
                <?php if ($product["category_id"] == $category["id"]): ?>
                  selected
                <?php endif ?>
                ><?= $category["title"] ?></option>
            <?php endforeach ?>
	</select>
  </div>

  <div class="mb-3">
    <label for="InputTitle" class="form-label">Başlık</label>
    <input type="text" class="form-control" id="InputTitle" value="<?= $product["title"] ?>" name="title" required="required" >
  </div>

  <div class="mb-3">
    <label for="fileToUpload" class="form-label">Resim</label> <br>
    <img src="/images/<?= $product["image"] ?>" class="mb-2">
    <input class="form-control" type="file" name="the_file" id="fileToUpload" >
  </div>

  <div class="mb-3">
    <label for="InputQty" class="form-label">Miktar</label>
    <input type="number" step="any" class="form-control" id="InputQty" value="<?= $product["qty"] ?>" name="qty" required="required" >
  </div>

  <div class="mb-3">
    <label for="InputPrice" class="form-label">Fiyat (₺)</label>
    <input type="number" step="any" class="form-control" id="InputPrice" value="<?= $product["price"] ?>" name="price" required="required" >
  </div>

  <div class="mb-3">
    <label for="InputStock" class="form-label">Stok</label>
    <input type="number" step="any" class="form-control" id="InputStock" value="<?= $product["stock"] ?>" name="stock" required="required" >
  </div>  

  <div class="mb-3">
    <label for="smalldesc" class="form-label">Kısa Açıklama</label>
    <textarea class="form-control" id="smalldesc" rows="3" name="smalldesc"><?= $product["smalldesc"] ?></textarea>
  </div>

  <div class="mb-3">
    <label for="description" class="form-label">Uzun Açıklama</label>
    <textarea class="form-control" id="smalldesc" rows="6" name="description"><?= $product["description"] ?></textarea>
  </div>

  <div class="mb-3">
    <label for="description2" class="form-label">Teslimat Şartları ve Riskler</label>
    <textarea class="form-control" id="smalldesc" rows="8" name="description2"><?= $product["description2"] ?></textarea>
  </div>

      
  <input type="hidden" name="pid" value="<?= $product["id"] ?>">

  <button type="submit" class="btn btn-primary" name="updateproduct" value="UpdateProduct">Kaydet</button>
</form>



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