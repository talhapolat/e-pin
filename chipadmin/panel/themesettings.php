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
                      <h3 class="h4">Tema Ayarları</h3>
                    </div>

                    <div class="card-body ">
                      

  <form action="/chipadmin/panel/app/func.php" method="POST" enctype="multipart/form-data">
 
  <div class="mb-3">
    <label for="InputTitle" class="form-label">Üst Bant Başlık</label> 
    <input type="text" class="form-control" name="topbandheader" placeholder="Üst Bant Başlığı" value="<?= $theme["topbandheader"] ?>">
  </div>

  <div class="mb-3">
    <label for="InputTitle" class="form-label">Üst Bant Yazısı</label>
    <textarea class="form-control" name="topband" rows="6"><?= $theme["topband"] ?></textarea>
  </div>


  <button type="submit" class="btn btn-primary" value="<?= $theme["id"] ?>" name="updatethemesettings">Kaydet</button>
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