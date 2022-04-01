<?php  
session_start();
ob_start();
require_once("app/connect.php");
?>

<!DOCTYPE html>
<html lang="tr">

<?php include("sections/head.php") ?> 

<body class="animsition">
	
	<?php include("sections/header.php") ?> 

	<?php include("sections/duyuru.php") ?> 


	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w  p-r-15 p-t-30 p-lr-0-lg">
			<a href="/" class="stext-109 cl8 hov-cl1 trans-04">
				Anasayfa
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Banka Bilgileri
			</span>    

		</div>
	</div>



	<div class="sec-banner bg0 p-t-40 p-b-50">
		<div class="container">
			<div class="row">

				<div class="col-xl-12">
					<?php include("sections/banks.php") ?>
				</div>

				

				<div class="col-xl-3">
					
				</div>
			</div>


			
		</div>
	</div> 



	<div class="container mobilelogin mt-4" id="mobilelogin">
		<div style="background-color: #f9f9f9; border: 2px solid #f9f9f9;padding-top: 20px" class="p-3">
			<a class="" style="float: left; font-size: 30px">Giriş Yap</a>
			<div style="text-align: right">
				<i class="fas fa-user-tie" style="font-size: 35px"></i>
				<hr>
			</div>

			

			<form class="mt-4">
				<div class="form-group">
					<label for="exampleInputEmail1" style="font-weight: bold"> <i class="fas fa-envelope"></i> Email Adresi</label>
					<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-posta adresi">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1" style="font-weight: bold"> <i class="fas fa-key"></i> Şifre</label>
					<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Şifre">
				</div>
				
				<button type="submit" class="btn btn-warning">GİRİŞ YAP</button>
				<button type="submit" class="btn btn-dark" style="color: #f9f9f9">KAYIT OL</button>
			</form>
			

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