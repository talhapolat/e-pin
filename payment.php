<?php  
session_start();
ob_start();
require_once("app/connect.php");

if (!isset($_SESSION["useremail"])) {
	// header("Location: /app/func.php?logout=ok");
} else {
	$userQuery   = $dbConnect->prepare("SELECT * FROM users WHERE email = ? and statu = 1");
	$userQuery->execute([$_SESSION["useremail"]]);
	$userNum     = $userQuery->rowCount();
	$user        = $userQuery->fetch(PDO::FETCH_ASSOC);

	if ($userNum != 1) {
		header("Location: /app/func.php?logout=ok");
	}
}


if (!isset($_GET["oidnmbr"])) {
	header("Location: /app/func.php?logout=ok");
} else {
	$orderQuery   = $dbConnect->prepare("SELECT * FROM orders WHERE order_number = ? and statu = 0 and deleted = 0");
	$orderQuery->execute([$_GET["oidnmbr"]]);
	$orderNum     = $orderQuery->rowCount();
	$order        = $orderQuery->fetch(PDO::FETCH_ASSOC);

	if ($orderNum == 0) {

		$orderBQuery   = $dbConnect->prepare("SELECT * FROM orders_balance WHERE order_number = ? and statu = 0 and deleted = 0");
		$orderBQuery->execute([$_GET["oidnmbr"]]);
		$orderBNum     = $orderBQuery->rowCount();
		$order        = $orderBQuery->fetch(PDO::FETCH_ASSOC);

		if ($orderBNum == 0) {
			header("Location: /app/func.php?logout=ok");
		} else {
			$ordernumb = $_GET["oidnmbr"];
		}

	} else {
		$ordernumb = $order["order_number"];
	}

	$totalprice = $order["price"];


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
				Ödeme Bilgileri
			</span>
		</div>
	</div>


	<div class="container mt-5">	
		<div class="row">

			<div class="col-md-9 col-12">

				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Kredi Kartı</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Havale / EFT</a>
					</li>

					<?php if ($orderBNum == 0 && isset($_SESSION["useremail"])): ?>
						<li class="nav-item">
							<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Bakiye Kullan</a>
						</li>						
					<?php endif ?>

				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<br>
						<?php include 'payment/paytr/payment1.php'; ?>

						

					</div>
					<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

						<br>
						<?php include 'payment/paytr/payment2.php'; ?>

					</div>
					<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
						<div class="mt-4">
							<?php include 'payment/wallet.php'; ?>
						</div>
					</div>
				</div>








			</div>
			<?php if (isset($_SESSION['useremail'])): ?>
				<div class="col-md-3 justify-content-center desktopslider" style="background-color: ; border: 2px solid #f1f1f1;padding-top: 20px">

					<?php include("sections/widgetlogin.php") ?>

				</div>
			<?php endif ?>
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