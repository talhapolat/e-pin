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
                      <h3 class="h4">Tüm Banka Bilgileri <a href="/chipadmin/panel/addbank.php" class="btn btn-dark" style="float: right;">YENİ</a></h3>
                    </div>

                    <div class="card-body " style="overflow: auto;">
                      

                            <table id="example" class="display compact" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Başlık</th>
                <th>Hesap Adı</th>
                <th>Şube No</th>
                <th>Hesap Numarası</th>
                <th>IBAN</th>
                <th>Ücret Bilgisi</th>
                <th>Resim</th>                
                <th>Statü</th>
                <th style="min-width: 200px;">İşlemler</th>
            </tr>
        </thead>
        <tbody>

            <?php 
                $bankQuery = $dbConnect->prepare("SELECT * FROM bank WHERE deleted = 0");
                $bankQuery->execute();
                $banjsNum = $bankQuery->rowCount();
                $banks = $bankQuery->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php foreach ($banks as $key => $bank): ?>

            <tr>
                <td><?= $key+1 ?></td>
                <td><?= $bank["title"] ?></td>
                <td><?= $bank["name"] ?></td>
                <td><?= $bank["sube"] ?></td>
                <td><?= $bank["account_number"] ?></td>
                <td><?= $bank["iban"] ?></td> 
                <td><?= $bank["price"] ?></td> 
                <td><img height="40px" src="/images/banks/<?= $bank["image"] ?>"></td>
                <td>
                    <?php if ($bank["statu"] == 1): ?>
                         <a href="/chipadmin/panel/app/func.php?bankstatuchange=<?= $bank["id"] ?>&statu=0" class="btn btn-success">AKTİF</a>
                    <?php else: ?>
                         <a href="/chipadmin/panel/app/func.php?bankstatuchange=<?= $bank["id"] ?>&statu=1" class="btn btn-dark">PASİF</a>
                    <?php endif ?>
                </td>              
                <td>
                  <a href="/chipadmin/panel/bankdetail.php?bid=<?= $bank["id"] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i> DÜZENLE</a> 
                  <a href="/chipadmin/panel/app/func.php?bankdelete=<?= $bank["id"] ?>" class="btn btn-danger"><i class="fa fa-trash"></i> SİL</a>
                </td>
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