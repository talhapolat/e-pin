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
                      <h3 class="h4">Tüm Haberler <a href="/chipadmin/panel/addblog.php" class="btn btn-dark" style="float: right;">YENİ</a></h3>
                    </div>

                    <div class="card-body " style="overflow: auto;">
                      

                            <table id="example" class="display compact" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Başlık</th>
                <th>İçerik</th>
                <th>Konu</th>
                <th style="min-width: 100px;">Tarih</th>
                <th>Statu</th>
                <th style="min-width: 200px;">İşlemler</th>
            </tr>
        </thead>
        <tbody>

            <?php 
                $blogQuery = $dbConnect->prepare("SELECT * FROM blogs WHERE deleted = 0");
                $blogQuery->execute();
                $blogsNum = $blogQuery->rowCount();
                $blogs = $blogQuery->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php foreach ($blogs as $key => $blog): ?>

            <tr>
                <td><?= $key+1 ?></td>
                <td style="max-width: 400px"><?= $blog["title"] ?></td>
                <td style="max-width: 500px; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3"><?= $blog["text"] ?></td>
                <td><?= $blog["topic"] ?></td>
                <td><?= $blog["created_at"] ?></td>
                <td>
                    <?php if ($blog["statu"] == 1): ?>
                         <a href="/chipadmin/panel/app/func.php?blogstatuchange=<?= $blog["id"] ?>&statu=0" class="btn btn-success">AKTİF</a>
                    <?php else: ?>
                         <a href="/chipadmin/panel/app/func.php?blogstatuchange=<?= $blog["id"] ?>&statu=1" class="btn btn-dark">PASİF</a>
                    <?php endif ?>
                </td>           
                <td>
                  <a href="/chipadmin/panel/blogdetail.php?bid=<?= $blog["id"] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i> DÜZENLE</a> 
                  <a href="/chipadmin/panel/app/func.php?blogdelete=<?= $blog["id"] ?>" class="btn btn-danger"><i class="fa fa-trash"></i> SİL</a>
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