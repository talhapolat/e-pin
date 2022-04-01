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


	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			İletişim
		</h2>
	</section>	


	<!-- Content page -->
	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<form action="mailler/mail_gonder.php" method="POST">
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							Mesaj Gönder
						</h4>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="email" name="email" placeholder="E-posta Adresiniz" required="required">
							<img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
						</div>

						<div class="bor8 m-b-30">
							<textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="msg" placeholder="Size nasıl yardımcı olabiliriz?"></textarea>
						</div>

						<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Gönder
						</button>
					</form>
				</div>

				<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Adres
							</span>

							<p class="stext-115 cl6 size-213 p-t-18">
								Mavi Plaza Kat:8 139, Büyükdere Cad, İstanbul, TR
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Whatsapp
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								+90 531 1234567
							</p>
						</div>
					</div>

					<div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Satış Desteği
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								contact@chipkolik.com
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>		
	
	<!-- Map -->
	<div class="map">
		<div class="size-303" id="google_map" data-map-x="40.691446" data-map-y="-73.886787" data-pin="images/icons/pin.png" data-scrollwhell="0" data-draggable="1" data-zoom="11"></div>
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





