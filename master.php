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