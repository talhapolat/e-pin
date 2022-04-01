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
                      <h3 class="h4">Genel Ayarlar</h3>
                    </div>

                    <div class="card-body ">
                      

  <form action="/chipadmin/panel/app/func.php" method="POST" enctype="multipart/form-data">
 
  <div class="mb-3">
    <label for="InputTitle" class="form-label">Başlık</label>
    <input type="text" class="form-control" id="InputTitle" name="title" value="<?= $setting["title"] ?>" required="required" >
  </div>

  <div class="mb-3">
    <label for="InputDesc" class="form-label">META Description</label>
    <input type="text" class="form-control" id="InputDesc" name="description" value="<?= $setting["description"] ?>" required="required" >
  </div>

  <div class="mb-3">
    <label for="InputKeywords" class="form-label">META Keywords</label>
    <input type="text" class="form-control" id="InputKeywords" name="keywords" value="<?= $setting["keywords"] ?>" required="required" >
  </div>

  <div class="mb-3">
    <label for="InputAddres" class="form-label">Adres</label>
    <input type="text" class="form-control" id="InputAddres" name="address" value="<?= $setting["address"] ?>" required="required" >
  </div>

  <div class="mb-3">
    <label for="InputPhone" class="form-label">Telefon</label>
    <input type="text" class="form-control" id="InputPhone" name="phone" value="<?= $setting["phone"] ?>" required="required" >
  </div>

  <div class="mb-3">
    <label for="InputMail" class="form-label">E-posta</label>
    <input type="text" class="form-control" id="InputMail" name="email" value="<?= $setting["email"] ?>" required="required" >
  </div>

  <div class="mb-3">
    <label for="fileToUploadLogo" class="form-label">Logo</label> <br>
    <img src="/images/icons/<?= $setting["logo"] ?>" class="mb-2">
    <input class="form-control" type="file" name="the_file_logo" id="fileToUploadLogo" >
  </div>

  <div class="mb-3">
    <label for="fileToUploadAlt" class="form-label">Foot Resim</label> <br>
    <img src="/images/<?= $setting["footimage"] ?>" class="mb-2">
    <input class="form-control" type="file" name="the_file_alt" id="fileToUploadAlt" >
  </div>




  <button type="submit" class="btn btn-primary" value="<?= $setting["id"] ?>" name="updatemainsettings">Kaydet</button>
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