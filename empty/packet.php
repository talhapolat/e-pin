<?php  
session_start();
ob_start();
require_once("app/connect.php");

if (isset($_GET["cid"])) {
          $cat = $_GET["cid"];
          $categoryQuery = $dbConnect->prepare("SELECT * FROM category WHERE statu = 1 and custompacket = 1 and id = ?");
          $categoryQuery->execute([$cat]);
          $categoryNum = $categoryQuery->rowCount();
          $category = $categoryQuery->fetch(PDO::FETCH_ASSOC);

          if ($categoryNum != 1) {
            header("Location: /categories.php");
          }
} else {
  header("Location: /categories.php");
}

?>

<!DOCTYPE html>
<html lang="tr">

<?php include("sections/head.php") ?> 

<body class="animsition">
	
<?php include("sections/header.php") ?> 

	


	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="/" class="stext-109 cl8 hov-cl1 trans-04">
				Anasayfa
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<a href="/categories.php" class="stext-109 cl8 hov-cl1 trans-04">
				Oyunlar
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>		

			<a href="/products.php?cid=<?= $category["id"] ?>" class="stext-109 cl8 hov-cl1 trans-04">
				<?= $category["title"] ?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>				

			<span class="stext-109 cl4">
				Paket Oluştur
			</span>
		</div>
	</div>
		

	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60">
		<div class="container">
			<div class="row">

				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w" style="text-align: top!important; top: 0px">


							<?php if ($category["title"] == "Big Poker"): ?>
							<iframe width="560" height="315" src="https://www.youtube.com/embed/Na4mpv-FGYc" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>								
							<?php else: ?>
							<div class="slick3 gallery-lb">
								<div class="item-slick3" data-thumb="images/<?= $category["image"] ?>">
									<div class="wrap-pic-w pos-relative">
										<img src="images/<?= $category["image"] ?>" alt="IMG-PRODUCT">
									</div>
								</div>
							</div> 
							<?php endif ?>

						

						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<form action="app/func.php" method="POST">
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							<?= $category["title"] ?>
						</h4>

						<p class="stext-102 cl3">
							<?= $category["description"] ?>
						</p>


						<span class="mtext-106 cl2">
							  <div class="mb-3 mt-5">
    							  <label for="InputBalance" class="form-label">Tutarı siz belirleyin (₺)</label>
    							  <input onkeyup="calc(this)" onchange="calc(this)" data="<?= $category["price"] ?>" data-birim="<?= $category["birim1"] ?>" data-birim2="<?= $category["birim2"] ?>" type="number" min="0" class="form-control" id="InputBalance" name="inputBalance" placeholder="Tutar Giriniz" required="required">
  							  </div>
						</span>


						<span class="mtext-106 cl2">
							  <div class="mb-3 mt-5">
    							  <label for="showBalance" class="form-label"><?= $category["product_type"] ?> Miktarı</label>
    							  <input type="texet" class="form-control" id="showBalance" name="showBalance" placeholder="Önce Tutar Giriniz" required="required" disabled="disabled">
  							  </div>
						</span>


						
						<!--  -->
						<div class="p-t-33">
							
							<?php if ($category["in_name"] == 1) { ?>	
							<div class="flex-w flex-r-m p-b-10">
								<div class="size-203 ">
									Ad Soyad
								</div>

								<div class="size-204 ">
									<div class="rs1-select2  bg0">
										<input type="text" class="form-control" id="exampleFormControlInput1" name="in_name" placeholder="Adınızı ve soyadınızı yazınız" required="required">
									</div>
								</div>
							</div>
							<?php	
							} 
							?>		

							<?php if ($category["in_facemail"] == 1) { ?>
							<div class="flex-w flex-r-m p-b-10">
								<div class="size-203">
									Facebook
								</div>

								<div class="size-204 ">
									<div class="rs1-select2 bg0">
										<input type="email" class="form-control" id="exampleFormControlInput1" name="in_facemail" placeholder="Facebook E-posta adresinizi yazınız" required="required">
									</div>
								</div>
							</div>
							<?php	
							} 
							?>

							<?php if ($category["in_facepass"] == 1) { ?>
							<div class="flex-w flex-r-m p-b-10">
								<div class="size-203 ">
									Şifre
								</div>

								<div class="size-204">
									<div class="rs1-select2 bg0">
										<input type="text" class="form-control" id="exampleFormControlInput1" name="in_facepass" placeholder="Facebook şifrenizi yazınız" required="required">
									</div>
								</div>
							</div>
							<?php	
							} 
							?>

							<?php if ($category["in_gameid"] == 1) { ?>
							<div class="flex-w flex-r-m p-b-10">
								<div class="size-203 ">
									Oyun ID
								</div>

								<div class="size-204">
									<div class="rs1-select2 bg0">
										<input type="text" class="form-control" id="exampleFormControlInput1"  name="in_gameid" placeholder="Oyundaki ID numaranızı yazınız" required="required">
									</div>
								</div>
							</div>							
							<?php	
							} 
							?>

							<?php if ($category["in_phone"] == 1) { ?>
							<div class="flex-w flex-r-m p-b-10">
								<div class="size-203 ">
									Telefon
								</div>

								<div class="size-204">
									<div class="rs1-select2 bg0">
										<input type="text" class="form-control" id="exampleFormControlInput1" name="in_phone" placeholder="Telefon numaranızı yazınız" required="required">
									</div>
								</div>
							</div>
							<?php	
							} 
							?>

							<?php if ($category["in_zyngavip"] == 1) { ?>							
							<div class="form-group mt-4">
  							  <label for="vipSelect"> <small style="font-weight: bolder">ÖNEMLİ:</small> İlk defa chip siparişi veriyorsanız hesabınızın güvenliği için tek seferlik oyun içi vip satın almalısınız. Eğer sizin adınıza bizim satın almamızı istiyorsanız aşağıdan vip paket seçimi yapabilirsiniz.</label>
  							  <select class="form-control" id="vipSelect" name="in_vip">
  							    <option value="0">İstemiyorum (Daha önce vip satın aldım)</option>
  							    <option value="1">1.000 VIP (+25 ₺)</option>
  							    <option value="2">2.000 VIP (+50 ₺)</option>
  							    <option value="3">5.000 VIP (+110 ₺)</option>
  							    <option value="4">10.000 VIP (+230 ₺)</option>
  							  </select>
  							</div>
							<?php	
							} 
							?>

							<input type="hidden" name="category" value="<?= $category["id"] ?>">


							<div class="flex-w flex-r-m p-b-10 m-t-25">
								<div class="size-204 flex-w flex-m ">
									
									<button name="makeorderpacket" value="MakeOrderPacket" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
										SİPARİŞ OLUŞTUR
									</button>
								</div>
							</div>	
							
						</div>

						<!--  -->
						<div class="flex-w flex-m p-t-40 ">
							

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
								<i class="fa fa-facebook"></i>
							</a>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
								<i class="fa fa-twitter"></i>
							</a>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
								<i class="fa fa-instagram"></i>
							</a>
						</div>
						</form>
					</div>
				</div>



			</div>

			<div class="bor10 m-t-50 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item p-b-10">
							<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Açıklama</a>
						</li>

						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#information" role="tab">Teslimat Şartları ve Riskler</a>
						</li>

						
					</ul>

					<!-- Tab panes -->
					<div class="tab-content p-t-43">
						<!-- - -->
						<div class="tab-pane fade show active" id="description" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6">
									Ürün açıklaması. Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus et elementum sed, sodales vitae eros. Ut ex quam, porta consequat interdum in, faucibus eu velit. Quisque rhoncus ex ac libero varius molestie. Aenean tempor sit amet orci nec iaculis. Cras sit amet nulla libero. Curabitur dignissim, nunc nec laoreet consequat, purus nunc porta lacus, vel efficitur tellus augue in ipsum. Cras in arcu sed metus rutrum iaculis. Nulla non tempor erat. Duis in egestas nunc.
								</p>
							</div>
						</div>

						<!-- - -->
						<div class="tab-pane fade" id="information" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6">
									Teslimat şartları ve riskler hakkında açıklama. Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus et elementum sed, sodales vitae eros. Ut ex quam, porta consequat interdum in, faucibus eu velit. Quisque rhoncus ex ac libero varius molestie. Aenean tempor sit amet orci nec iaculis. Cras sit amet nulla libero. Curabitur dignissim, nunc nec laoreet consequat, purus nunc porta lacus, vel efficitur tellus augue in ipsum. Cras in arcu sed metus rutrum iaculis. Nulla non tempor erat. Duis in egestas nunc.
								</p>
							</div>
						</div>

						<!-- - -->


					


					</div>
				</div>
			</div>
		</div>

		<div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
			<span class="stext-107 cl6 p-lr-25">
				<?= $category["title"] ?>
			</span>

			<span class="stext-107 cl6 p-lr-25">
				
			</span>
		</div>
	</section>







	
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

<script type="text/javascript">
function calc(x) {  
  var numbers = /^[0-9]+$/;

  if (x.value.match(numbers)) {
  if (x.value == "" || x.value == 0) {
    x.value = "";
    document.getElementById("showBalance").value = "Önce Tutar Giriniz";
  } else {
    const result = (x.value)/(x.getAttribute("data"));
    if (result >= 1000) {
      result2 = result/1000;
      document.getElementById("showBalance").value = parseFloat(result2.toFixed(2)) + " " + x.getAttribute("data-birim2") + " / " + parseFloat(result2.toFixed(2))*1000000000000 + " $";
    } else {
      document.getElementById("showBalance").value = parseFloat(result.toFixed(2)) + " " + x.getAttribute("data-birim") + " / " + parseFloat(result.toFixed(2))*1000000000 + " $";
    }
    
  }
} else {
  x.value = "";
  document.getElementById("showBalance").value = "Önce Tutar Giriniz";
}
  
}
</script>


</body>
</html>