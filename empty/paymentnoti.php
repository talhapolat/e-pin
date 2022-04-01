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


  $bankQuery = $dbConnect->prepare("SELECT * FROM bank WHERE statu = 1 and deleted = 0");
  $bankQuery->execute();
  $bankNum = $bankQuery->rowCount();
  $banks = $bankQuery->fetchAll(PDO::FETCH_ASSOC);


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

      <a href="/orders.php" class="stext-109 cl8 hov-cl1 trans-04">
        Siparişler
        <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
      </a>      

      <span class="stext-109 cl4">
        Ödeme Bildirimi
      </span>
    </div>
  </div>


<div class="container mt-5">	
<div class="row">

	<div class="col-md-5 col-12 col-xs-12 mb-5">

              <div class="p-b-10">
        <h3 class="ltext-103 cl5">
          <i class="fas fa-wallet"></i> ÖDEME BİLDİRİMİ
        </h3>
      </div>


      <div class="mt-3" style="">

        <a href="/bank" target="_blank" style="color: green">Banka bilgilerimize ulaşmak için tıklayınız.</a>


<form action="app/func.php" method="POST" class="mb-3">

<div class="mb-3 mt-3">
								<div class="">
									    <label for="InputNameSurname" class="form-label">Ödeme Yapılan Banka</label>

									<div class="rs1-select2 bor8 bg0">
										<select class="js-select2" name="time">

                      <?php foreach ($banks as $key => $bank): ?>
                        <option><?= $bank["title"] ?></option>
                      <?php endforeach ?>
                      
										</select>
										<div class="dropDownSelect2"></div>
									</div>
								</div>
							 </div>

  <div class="mb-3 mt-3">
    <label for="InputDate" class="form-label">Ödeme Tarihi</label>
    <input type="date" placeholder="gg/aa/yyyy" class="form-control" id="InputDate" name="inputDate" required="required" placeholder="Tarih Seçiniz" >
  </div>

  <div class="mb-3 mt-3">
    <label for="InputBalance" class="form-label">Ödeme Tutarı (₺)</label>
    <input type="number" class="form-control" id="InputBalance" name="inputBalance" value="<?php if(isset($_GET["balance"])){ echo $_GET["balance"]; } ?>" placeholder="Tutar" required="required">
  </div>

    <div class="mb-3 mt-3">
    <label for="InputNameSurname" class="form-label">İsim Soyisim</label>
    <input type="text" class="form-control" id="InputNameSurname" name="nameSurname"  value="<?= $user["name"] ?>" required="required">
  </div>

  <div class="mb-3">
    <label for="InputPhone" class="form-label">Telefon Numarası (GSM)</label>
    <input type="text" class="form-control" id="InputPhone" name="phone" value="<?= $user["phone"] ?>" required="required">
  </div>

  <div class="mb-3">
    <label for="InputTC" class="form-label">TC Kimlik Numarası Son 5 Hane</label>
    <input type="text" class="form-control" id="InputTC" name="InputTC" placeholder="TC kimlik son 5 hanesini giriniz" required="required">
  </div>  

  <div class="mb-3">
    <label for="InputExp" class="form-label">Açıklama</label>
    <input type="text" class="form-control" id="InputExp" name="inputExp" required="required">
  </div>   

  <button type="submit" class="btn btn-dark" name="updateaccountinfo" value="UpdateAccountInfo" >Gönder</button>
</form>


 


      </div>




	</div>

	<div class="col-md-4"></div>

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