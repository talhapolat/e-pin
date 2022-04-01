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
                      <h3 class="h4">Yeni Ürün Ekle</h3>
                    </div>

                    <div class="card-body ">
                      

  <form action="/chipadmin/panel/app/func.php" method="POST" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="InputCategory" class="form-label">Kategori</label> <br>
    <select class="form-select" aria-label="Default select example" name="category">
            <?php  
                $categoryQuery = $dbConnect->prepare("SELECT * FROM category WHERE deleted = 0 AND statu = 1");
                $categoryQuery->execute();
                $categoryNum = $categoryQuery->rowCount();
                $categories = $categoryQuery->fetchAll(PDO::FETCH_ASSOC);            
            ?>     	

            <?php foreach ($categories as $key => $category): ?>
            	<option value="<?= $category["id"] ?>"><?= $category["title"] ?></option>
            <?php endforeach ?>
	</select>
  </div>

  <div class="mb-3">
    <label for="InputTitle" class="form-label">Başlık</label>
    <input type="text" class="form-control" id="InputTitle" name="title" required="required" >
  </div>

  <div class="mb-3">
    <label for="fileToUpload" class="form-label">Resim</label>
    <input class="form-control" type="file" name="the_file" id="fileToUpload" required="required" >
  </div>

  <div class="mb-3">
    <label for="InputQty" class="form-label">Miktar</label>
    <input type="number" step="any" class="form-control" id="InputQty" name="qty" required="required" >
  </div>

  <div class="mb-3">
    <label for="InputPrice" class="form-label">Fiyat (₺)</label>
    <input type="number" step="any" class="form-control" id="InputPrice" name="price" required="required" >
  </div>

  <div class="mb-3">
    <label for="InputStock" class="form-label">Stok</label>
    <input type="number" step="any" class="form-control" id="InputStock" name="stock" required="required" >
  </div>  

  <div class="mb-3">
    <label for="smalldesc" class="form-label">Kısa Açıklama</label>
    <input type="text" class="form-control" id="smalldesc" name="smalldesc" required="required" >
  </div>

  <div class="mb-3">
    <label for="description" class="form-label">Uzun Açıklama</label>
    <input type="text" class="form-control" id="description" name="description" required="required" >
  </div>  

  <div class="mb-3">
    <label for="description2" class="form-label">Teslimat Şartları ve Riskler</label>
    <input type="text" class="form-control" id="description2" name="description2" required="required" >
  </div>

  <button type="submit" class="btn btn-primary" name="newproduct">Kaydet</button>
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