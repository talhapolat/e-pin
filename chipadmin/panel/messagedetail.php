<?php  
session_start();
ob_start();
require_once("../../app/connect.php");

$messageQuery = $dbConnect->prepare("SELECT * FROM messages WHERE id = ?");
$messageQuery->execute([$_GET["message"]]);
$messageNum = $messageQuery->rowCount();
$message = $messageQuery->fetch(PDO::FETCH_ASSOC);

if ($messageNum != 1) {
  echo "HATA KODU 492649320032";
  exit();
}

?>
<!DOCTYPE html>
<html>
<head>  
  <?php include("sections/head.php") ?> 
</head>
<body>
  <div class="page">

    <!-- CONTENT -->

    <div class="page-content d-flex align-items-stretch"> 


      <div class="content-inner">

        <!-- Dashboard Counts Section-->

        <!-- Updates Section                                                -->
        <section class="updates no-padding-top">
          <div class="container-fluid">
            <div class="row">
              <!-- Recent Updates-->
              <div class="col-lg-12 p-3">
                <div class="recent-updates card p-3">

                  <div class="card-header">
                    <h3 class="h4">Mesaj Detayı</h3>
                  </div>

                  <div class="card-body ">


                    <form action="/chipadmin/panel/app/func.php" method="POST" enctype="multipart/form-data">

                      <div class="mb-3">
                        <label for="InputQty" class="form-label">Kullanıcı</label>
                        <?php  
                        $userQuery = $dbConnect->prepare("SELECT * FROM users WHERE id = ?");
                        $userQuery->execute([$message["user_id"]]);
                        $userNum = $userQuery->rowCount();
                        $user = $userQuery->fetch(PDO::FETCH_ASSOC); 
                        ?>   
                        <h6>
                          <?php if ($userNum == 1): ?>
                            <?= $user["name"] ?>
                          <?php else: ?>
                            <a>Ziyaretçi</a>
                          <?php endif ?>
                        </h6>
                      </div>



                      <div class="mb-3">
                        <label for="InputTitle" class="form-label">E-Posta</label>
                        <h6><?= $message["email"] ?></h6>
                      </div>


                      <div class="mb-3">
                        <label for="InputQty" class="form-label">Mesaj</label>
                        <h6><?= $message["message"] ?></h6>
                      </div>

                      <div class="mb-3">
                        <label for="InputPrice" class="form-label">Tarih</label>
                        <h6><?= $message["created_at"] ?></h6>
                      </div>


                    </form>



                  </div>



                </div>
              </div>


            </div>


          </div>
        </section>


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