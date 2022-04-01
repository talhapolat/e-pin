<?php  
session_start();
ob_start();
require_once("../../app/connect.php");

$userQuery = $dbConnect->prepare("SELECT * FROM users WHERE id = ?");
$userQuery->execute([$_GET["uid"]]);
$userNum = $userQuery->rowCount();
$user = $userQuery->fetch(PDO::FETCH_ASSOC);
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
              <h2 class="no-margin-bottom">Kullanıcı Bilgileri</h2>
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
                      <h3 class="h4">Kullanıcı Düzenle</h3>
                    </div>

                    <div class="card-body ">
                      

  <form action="/chipadmin/panel/app/func.php" method="POST" enctype="multipart/form-data">

  <div class="mb-3">
    <label for="InputTitle" class="form-label">E-posta Adresi</label>
    <input type="text" class="form-control" id="InputEmail" name="email" value="<?= $user["email"] ?>" readonly >
  </div>

  <div class="mb-3">
    <label for="InputName" class="form-label">Ad Soyad</label>
    <input type="text" class="form-control" id="InputName" name="name" value="<?= $user["name"] ?>" required="required" >
  </div> 

  <div class="mb-3">
    <label for="InputSube" class="form-label">Telefon</label>
    <input type="text" class="form-control" id="InputPhone" name="phone" value="<?= $user["phone"] ?>" required="required" >
  </div>

  <div class="mb-3">
    <label for="InputSube" class="form-label">Şifreyi Değiştir</label>
    <input type="password" class="form-control" id="InputPass" name="password" >
  </div>  


  <button type="submit" class="btn btn-primary" value="<?= $user["id"] ?>" name="updateUser">Kaydet</button>
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