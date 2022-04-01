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
                      <h3 class="h4">Yeni Kategori Ekle</h3>
                    </div>

                    <div class="card-body ">
                      

  <form action="/chipadmin/panel/app/func.php" method="POST" enctype="multipart/form-data">
  
  <div class="mb-3">
    <label for="InputTitle" class="form-label">Başlık</label>
    <input type="text" class="form-control" id="InputTitle" name="title" required="required">
  </div>

  <div class="mb-3">
    <label for="InputTitle" class="form-label">Ürün Tipi</label>
    <input type="text" class="form-control" id="InputType" name="producttype" required="required" >
  </div>

  <div class="mb-3">
    <label for="InputTitle" class="form-label">Açıklama</label>
    <input type="text" class="form-control" id="InputDescription" name="description" required="required" >
  </div>

  <div class="mb-3">
    <label for="InputTitle" class="form-label">Birim Fiyat</label>
    <input type="number" step="any" class="form-control" id="InputPrice" name="price" required="required" >
  </div>      

  <div class="mb-3">
    <label for="InputTitle" class="form-label">Alt Birim</label>
    <input type="text" class="form-control" id="InputBirim1" name="birim1" required="required" >
  </div>

  <div class="mb-3">
    <label for="InputTitle" class="form-label">Üst Birim</label>
    <input type="text" class="form-control" id="InputBirim2" name="birim2" required="required" >
  </div>

    <div class="mb-3">
    <h5>Sipariş İçin Gerekli Bilgiler</h5>

    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="1" id="checkInName" name="checkInName">
      <label class="form-check-label" for="checkInName">
        Ad Soyad
      </label>
    </div>

    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="1" id="checkInFace" name="checkInFace">
      <label class="form-check-label" for="checkInFace">
        Facebook E-posta
      </label>
    </div>

    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="1" id="checkInFacePass" name="checkInFacePass">
      <label class="form-check-label" for="checkInFacePass">
        Facebook Şifre
      </label>
    </div>

    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="1" id="checkInPhone" name="checkInPhone">
      <label class="form-check-label" for="checkInPhone">
        Telefon Numarası
      </label>
    </div>

    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="1" id="checkInGameId" name="checkInGameId">
      <label class="form-check-label" for="checkInGameId">
        Oyun ID
      </label>
    </div>

    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="1" id="checkInZyngaVip" name="checkInZyngaVip">
      <label class="form-check-label" for="checkInZyngaVip">
        ZYNGA VIP
      </label>
    </div>
</div>

    <div class="mb-3">
        <label class="form-check-label" for="flexSwitchCheckDefault">PAKET OLUŞTURMA</label> <br>
        <input type="checkbox" data-toggle="toggle" data-onstyle="info" data-on="AKTİF" data-off="KAPALI" value="1" name="custompacket">
    </div>

  <div class="mb-3">
    <label for="fileToUpload" class="form-label">Resim</label>
    <input class="form-control" type="file" name="the_file" id="fileToUpload" required="required" >
  </div>

  <div class="mb-3">
    <label for="description2" class="form-label">Transfer Şartları</label>
    <input type="text" class="form-control" id="description2" name="description2" required="required" >
  </div>

  <div class="mb-3">
    <label for="description3" class="form-label">Ban Riski</label>
    <input type="text" class="form-control" id="description3" name="description3" required="required" >
  </div>


  <button type="submit" class="btn btn-primary" name="newcategory">Kaydet</button>
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