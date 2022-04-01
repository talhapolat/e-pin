<?php  
session_start();
ob_start();
require_once("app/connect.php");

if (!isset($_SESSION["useremail"])) {
  header("Location: /app/func.php?logout=ok");
} else {
  $userQuery   = $dbConnect->prepare("SELECT * FROM users WHERE email = ? and statu = 1");
  $userQuery->execute([$_SESSION["useremail"]]);
  $userNum     = $userQuery->rowCount();
  $user        = $userQuery->fetch(PDO::FETCH_ASSOC);

  if ($userNum != 1) {
    header("Location: /app/func.php?logout=ok");
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<?php include("sections/head.php") ?> 

<body class="animsition">
	
  <?php include("sections/header.php") ?> 

  
  <?php include("sections/duyuru.php") ?> 

  <!-- breadcrumb -->
  <div class="container">
    <div class="bread-crumb flex-w p-r-15 p-t-30 p-lr-0-lg">
      <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
        Anasayfa
        <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
      </a>

      <span class="stext-109 cl4">
        Bakiye Yükle
      </span>
    </div>
  </div>


  <div class="container mt-5">	
    <div class="row">

     <div class="col-md-9 col-12 mb-5">

      <div class="p-b-10">
        <h3 class="ltext-102 cl5">
          <i class="fas fa-wallet"></i> BAKİYE YÜKLE
        </h3>
      </div>


      <div class="mt-3" style="width: 300px">

        <form action="app/func.php" method="POST" class="mb-3">
          <div class="mb-3 mt-3">
            <label for="InputBalance" class="form-label">Yüklemek İstediğiniz Miktar (₺)</label>
            <input type="number" style="font-family: Poppins-Medium" min="1" max="5000" placeholder="Tutar" class="form-control" id="InputBalance" name="inputBalance" required="required">
          </div>
          <button type="submit" class="btn btn-dark" name="addbalancecart" value="AddBalanceCart" style="font-family: Poppins-Medium"><i class="fas fa-credit-card"></i> Ödeme</button>
        </form>





        


      </div>




    </div>

    <div class="col-md-3 justify-content-center desktopslider" style="background-color: ; border: 2px solid #f1f1f1;padding-top: 20px">

      <?php include("sections/widgetlogin.php") ?>

    </div>



  </div>


</div>




<!-- OYUNLAR -->
<div class="sec-banner bg0 p-t-40 p-b-50">
  <div class="container">
   <div class="row">

    <div class="col-xl-9">



    </div>




    <div class="col-xl-3 ">


    </div>

    <div class="col-xl-3">
     
    </div>


  </div>


  
</div>
</div> 




<div class="text-center p-t-95" style="text-indent: center" >
  <img src="images/sitealt_ftr.png" class="img-fluid">
</div>


<?php include("sections/footer.php") ?>


<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
  <span class="symbol-btn-back-to-top">
   <i class="zmdi zmdi-chevron-up"></i>
 </span>
</div>


<div id="fb-root"></div>



<?php include("sections/jsasset.php") ?>


</body>
</html>

<?php
$dbConnect = null;

?>