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
              <h2 class="no-margin-bottom">Mesajlar</h2>
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
                      <h3 class="h4">Tüm Mesajlar</h3>
                    </div>

                    <div class="card-body " style="overflow: auto;">
                      

                            <table id="example" class="display compact" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th style="min-width: 100px;">Kullanıcı</th>
                <th>E-Posta</th>
                <th>Mesaj</th>
                <th style="min-width: 100px;">Tarih</th>
                <th style="min-width: 200px;">İşlemler</th>
            </tr>
        </thead>
        <tbody>

            <?php 
                $messageQuery = $dbConnect->prepare("SELECT * FROM messages WHERE deleted = 0 ORDER BY id DESC");
                $messageQuery->execute();
                $messagesNum = $messageQuery->rowCount();
                $messages = $messageQuery->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php foreach ($messages as $key => $message): ?>

            <?php  
                $userQuery = $dbConnect->prepare("SELECT * FROM users WHERE id = ?");
                $userQuery->execute([$message["user_id"]]);
                $usersNum = $userQuery->rowCount();
                $user = $userQuery->fetch(PDO::FETCH_ASSOC);                             
            ?>    

            <tr>
                <td><?= $key+1 ?></td>
                <td style="min-width: 100px;">
                  <?php if ($usersNum == 1): ?>
                    <?php echo $user["name"] ?>
                  <?php else: ?>
                    <a>Ziyaretçi</a>
                  <?php endif ?>
                </td>
                <td><?= $message["email"] ?></td>
                <td style="overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3"><?= $message["message"] ?></td>
                <td style="min-width: 100px;"><?= $message["created_at"] ?></td>
                <td>
                  <a href="#" 
                    onclick="window.open('messagedetail.php?message=<?= $message["id"] ?>', 'newwindow', 'width=500,height=1000'); return false;" 
                    class="btn btn-info" style="color: white; text-decoration: none">DETAYLAR</a> 
                  <a href="/chipadmin/panel/app/func.php?messagedelete=<?= $message["id"] ?>" class="btn btn-danger" style="color: white; text-decoration: none"><i class="fa fa-trash"></i> SİL</a>
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