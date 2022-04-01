<?php  
session_start();
ob_start();
require_once("../../app/connect.php");

$bankQuery = $dbConnect->prepare("SELECT * FROM bank WHERE deleted = 0 AND id = ?");
$bankQuery->execute([$_GET["bid"]]);
$banjsNum = $bankQuery->rowCount();
$bank = $bankQuery->fetch(PDO::FETCH_ASSOC);
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
              <h2 class="no-margin-bottom">Banka Bilgileri</h2>
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
                      <h3 class="h4">Banka Bilgisini Düzenle</h3>
                    </div>

                    <div class="card-body ">
                      

  <form action="/chipadmin/panel/app/func.php" method="POST" enctype="multipart/form-data">

  <div class="mb-3">
    <label for="InputTitle" class="form-label">Banka Adı</label>
    <input type="text" class="form-control" id="InputTitle" name="title" value="<?= $bank["title"] ?>" required="required" >
  </div>

  <div class="mb-3">
    <label for="InputName" class="form-label">Hesap Adı</label>
    <input type="text" class="form-control" id="InputName" name="name" value="<?= $bank["name"] ?>" required="required" >
  </div> 

  <div class="mb-3">
    <label for="InputSube" class="form-label">Şube NO</label>
    <input type="text" class="form-control" id="InputSube" name="sube" value="<?= $bank["sube"] ?>" required="required" >
  </div>

  <div class="mb-3">
    <label for="InputAccountNumber" class="form-label">Hesap Numarası</label>
    <input type="text" class="form-control" id="InputAccountNumber" name="account_number" value="<?= $bank["account_number"] ?>" required="required" >
  </div> 

  <div class="mb-3">
    <label for="InputIban" class="form-label">IBAN</label>
    <input type="text" class="form-control" id="InputIban" name="iban" value="<?= $bank["iban"] ?>" required="required" >
  </div>

  <div class="mb-3">
    <label for="InputPrice" class="form-label">Ücret Bilgisi</label>
    <input type="text" class="form-control" id="InputPrice" name="price" value="<?= $bank["price"] ?>" required="required" >
  </div> 

  <div class="mb-3">
    <label for="fileToUpload" class="form-label">Resim</label> <br>
    <img src="/images/banks/<?= $bank["image"] ?>" class="mb-2">
    <input class="form-control" type="file" name="the_file" id="fileToUpload" >
  </div>  

  <button type="submit" class="btn btn-primary" value="<?= $bank["id"] ?>" name="updatebank">Kaydet</button>
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