<?php  
session_start();
ob_start();
require_once("../../app/connect.php");

$blogQuery = $dbConnect->prepare("SELECT * FROM blogs WHERE id = ?");
$blogQuery->execute([$_GET["bid"]]);
$blogsNum = $blogQuery->rowCount();
$blog = $blogQuery->fetch(PDO::FETCH_ASSOC);
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
              <h2 class="no-margin-bottom">Haberler</h2>
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
                      <h3 class="h4">Haber Düzenle</h3>
                    </div>

                    <div class="card-body ">
                      

  <form action="/chipadmin/panel/app/func.php" method="POST" enctype="multipart/form-data">

  <div class="mb-3">
    <label for="InputTitle" class="form-label">Haber Başlığı</label>
    <input type="text" class="form-control" id="InputTitle" name="title" value="<?= $blog["title"] ?>" required="required" >
  </div>

  <div class="mb-3">
    <label for="InputText" class="form-label">Haber İçeriği</label>
    <textarea class="form-control" id="InputText" name="text" required="required" rows="6"><?= $blog["text"] ?></textarea>
  </div> 

  <div class="mb-3">
    <label for="InputTopic" class="form-label">Konu</label>
    <input type="text" class="form-control" id="InputTopic" name="topic" value="<?= $blog["topic"] ?>" required="required" >
  </div>

  <button type="submit" class="btn btn-primary" value="<?= $blog["id"] ?>" name="updateblog">Kaydet</button>
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