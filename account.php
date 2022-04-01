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
        Hesap Bilgileri
      </span>
    </div>
  </div>


  <div class="container mt-5">	
    <div class="row">

     <div class="col-md-9 col-12">

      <div class="p-b-10">
        <h3 class="ltext-102 cl5">
          <i class="fas fa-id-card"></i> ÜYELİK BİLGİLERİ
        </h3>
      </div>


      <div class="row mt-3">
       

        <div class="col-md-6 mb-5">
          <h5 style="font-weight: bold; color: black">Güvenlik</h5>
          <hr>

          <form action="app/func.php" method="POST" class="mb-3">
            <div class="mb-3">
              <label for="InputEmail" class="form-label">E-posta Adresi</label>
              <input type="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" value="<?= $user["email"] ?>" disabled="disabled">
            </div>
            <div class="mb-3">
              <label for="InputPassword" class="form-label">Mevcut Şifre</label>
              <input type="password" class="form-control" id="InputPassword" name="password" required="required">
            </div>
            <div class="mb-3">
              <label for="InputNewPassword" class="form-label">Yeni Şifre</label>
              <input type="password" class="form-control" id="InputNewPassword" name="newpassword" required="required" >
            </div>  
            <div class="mb-3">
              <label for="InputRePassword" class="form-label">Yeni Şifre (Tekrar)</label>
              <input type="password" class="form-control" id="InputRePassword" name="repassword" required="required" >
            </div>   

            <button type="submit" class="btn btn-dark" name="updatepassword" value="UpdatePassword" style="font-family: Poppins-Medium">Şifre Değiştir</button>
          </form>

          <?php if (isset($_SESSION["updatepassok"])): ?>
            <h6 style="color: green"><?= $_SESSION["updatepassok"] ?></h6>
          <?php endif ?>

          <?php if (isset($_SESSION["updatepasserror"])): ?>
            <h6 style="color: red"><?= $_SESSION["updatepasserror"] ?></h6>
          <?php endif ?>


        </div>


        <div class="col-md-6 mb-5">
          <h5 style="font-weight: bold; color: black">Kişisel Bilgiler</h5>
          <hr>
          <form action="app/func.php" method="POST" class="mb-3">
            <div class="mb-3 mt-3">
              <label for="InputNameSurname" class="form-label">Adınız Soyadınız</label>
              <input type="text" class="form-control" id="InputNameSurname" name="nameSurname"  value="<?= $user["name"] ?>" required="required">
            </div>

            <div class="mb-3">
              <label for="InputPhone" class="form-label">Telefon Numaranız</label>
              <input type="text" class="form-control" id="InputPhone" name="phone" value="<?= $user["phone"] ?>" required="required">
            </div>

            <button type="submit" class="btn btn-dark" name="updateaccountinfo" value="UpdateAccountInfo" style="font-family: Poppins-Medium">Güncelle</button>
          </form>

          <?php if (isset($_SESSION["updateinfook"])): ?>
            <h6 style="color: green"><?= $_SESSION["updateinfook"] ?></h6>
          <?php endif ?>



        </div>


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
$_SESSION["updatepassok"] = null;
$_SESSION["updatepasserror"] = null;
$_SESSION["updateinfook"] = null;
?>