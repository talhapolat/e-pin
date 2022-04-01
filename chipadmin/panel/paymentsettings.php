<?php  
session_start();
ob_start();
require_once("../../app/connect.php");

$settingQuery = $dbConnect->prepare("SELECT * FROM settings WHERE id = ?");
$settingQuery->execute(["1"]);
$settingNum = $settingQuery->rowCount();
$setting = $settingQuery->fetch(PDO::FETCH_ASSOC);
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
              <h2 class="no-margin-bottom">Ayarlar</h2>
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
                      <h3 class="h4">Ödeme Entegrasyon Ayarları</h3>
                    </div>

                    <div class="card-body ">
                      

  <form action="/chipadmin/panel/app/func.php" method="POST" enctype="multipart/form-data">
 
  <div class="mb-3">
    <label for="merchant_id" class="form-label">merchant_id</label>
    <input type="text" style="cursor: not-allowed" class="form-control" id="merchant_id" name="merchant_id" value="<?= $setting["merchant_id"] ?>" required="required" disabled>
  </div>

  <div class="mb-3">
    <label for="merchant_key" class="form-label">merchant_key</label>
    <input type="text" style="cursor: not-allowed" class="form-control" id="merchant_key" name="merchant_key" value="<?= $setting["merchant_key"] ?>" required="required" disabled>
  </div>

  <div class="mb-3">
    <label for="merchant_salt" class="form-label">merchant_salt</label>
    <input type="text" style="cursor: not-allowed" class="form-control" id="merchant_salt" name="pass" value="<?= $setting["merchant_salt"] ?>" required="required" disabled>
  </div>

  <div class="mb-3">
    <label for="merchant_ok_url" class="form-label">merchant_ok_url</label>
    <input type="text" style="cursor: not-allowed" class="form-control" id="merchant_ok_url" name="merchant_ok_url" value="<?= $setting["merchant_ok_url"] ?>" required="required" disabled>
  </div>

  <div class="mb-3">
    <label for="merchant_fail_url" class="form-label">merchant_fail_url</label>
    <input type="text" style="cursor: not-allowed" class="form-control" id="merchant_fail_url" name="merchant_fail_url" value="<?= $setting["merchant_fail_url"] ?>" required="required" disabled>
  </div>

  <div class="mb-3">
    <label for="commission_rate" class="form-label">Komisyon Oranı (%)</label>
    <input type="text" style="cursor: not-allowed" class="form-control" id="commission_rate" name="commission_rate" value="<?= $setting["commission_rate"] ?>" required="required" disabled>
  </div>


  <button type="submit" class="btn btn-primary" value="<?= $setting["id"] ?>" name="updatepaymentsettings">Kaydet</button>
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