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
              <h2 class="no-margin-bottom">Kullanıcılar</h2>
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
                      <h3 class="h4">Tüm Kullanıcılar</h3>
                    </div>

                    <div class="card-body " style="overflow: auto;">
                      

                            <table id="example" class="display compact" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th style="min-width: 100px; max-width: 300px">Ad Soyad</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Bakiye</th>
                <th>Sipariş Sayısı</th>
                <th style="min-width: 100px;">Kayıt Tarihi</th>
                <th>Statü</th>
                <th style="min-width: 200px;">İşlemler</th>
            </tr>
        </thead>
        <tbody>

            <?php 
                $userQuery = $dbConnect->prepare("SELECT * FROM users WHERE deleted = 0 ORDER BY id DESC");
                $userQuery->execute();
                $userNum = $userQuery->rowCount();
                $users = $userQuery->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php foreach ($users as $key => $user): ?>

            <tr>
                <td><?= $key+1 ?></td>
                <td><?= $user["name"] ?></td>
                <td><?= $user["email"] ?></td>
                <td><?= $user["phone"] ?></td>
                <td><?= $user["balance"] ?>₺</td>
                <td>
                    <?php 
                        $orderQuery = $dbConnect->prepare("SELECT * FROM orders WHERE user_id = ?");
                        $orderQuery->execute([$user["id"]]);
                        $orderNum = $orderQuery->rowCount();
                    ?>                 
                    <?= $orderNum ?>   
                </td>
                
                <td><?= $user["created_at"] ?></td>
                <td>
                    <?php if ($user["statu"] == 1): ?>
                         <a href="/chipadmin/panel/app/func.php?userstatuchange=<?= $user["id"] ?>&statu=0" class="btn btn-success">AKTİF</a>
                    <?php else: ?>
                         <a href="/chipadmin/panel/app/func.php?userstatuchange=<?= $user["id"] ?>&statu=1" class="btn btn-dark">PASİF</a>
                    <?php endif ?>
                </td>  
                
                <td>
                  <a href="/chipadmin/panel/userdetail.php?uid=<?= $user["id"] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i> DÜZENLE</a> 
                  <a href="/chipadmin/panel/app/func.php?userdelete=<?= $user["id"] ?>" class="btn btn-danger"><i class="fa fa-trash"></i> SİL</a>
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