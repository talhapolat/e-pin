<?php  
session_start();
ob_start();
require_once("app/connect.php");

if (!isset($_SESSION["useremail"])) {
	header("Location:/");
}

$pid = $_GET["pid"];

    $productQuery = $dbConnect->prepare("SELECT * FROM product WHERE statu = 1 and deleted = 0 and id = ?");
    $productQuery->execute([$pid]);
    $productNum = $productQuery->rowCount();
    $product = $productQuery->fetch(PDO::FETCH_ASSOC);

    if ($productNum == 1) {
        $categoryQuery = $dbConnect->prepare("SELECT * FROM category WHERE statu = 1 and id = ?");
        $categoryQuery->execute([$product["category_id"]]);
        $categoryNum = $categoryQuery->rowCount();
        $category = $categoryQuery->fetch(PDO::FETCH_ASSOC);
    } else {
    	header("Location:/");
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

			<a href="/products" class="stext-109 cl8 hov-cl1 trans-04">
				Oyunlar
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>			

			<a href="products?cid=<?= $category["id"]; ?>" class="stext-109 cl8 hov-cl1 trans-04">
				<?= $category["title"]; ?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				<?= $product["title"]; ?>
			</span>
		</div>
	</div>
		

	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60">
		<div class="container">
			<div class="row">



				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">

							<div class="slick3 gallery-lb">
								<div class="item-slick3" data-thumb="images/<?= $category["image"] ?>">
									<div class="wrap-pic-w pos-relative">
										<img src="images/<?= $product["image"] ?>" alt="IMG-PRODUCT">
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>



					
				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							<?= $product["title"]; ?>
						</h4>

						<span class="mtext-106 cl2">
							<?= $product["price"]; ?>₺
						</span>

						<p class="stext-102 cl3 p-t-23">
							<?= nl2br($product["smalldesc"]) ?>
						</p>
						
						
						

						<div class="p-t-33">
							<form action="app/func.php" method="POST">
							<?php if ($category["in_name"] == 1) { ?>	
							<div class="flex-w flex-r-m p-b-10">
								<div class="size-203 ">
									Ad Soyad
								</div>

								<div class="size-204 ">
									<div class="rs1-select2  bg0">
										<input type="text" class="form-control" name="in_name" id="exampleFormControlInput1" placeholder="Adınızı ve soyadınızı yazınız" required="required">
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
										<input type="email" class="form-control" name="in_facemail" id="exampleFormControlInput1" placeholder="Facebook E-posta adresinizi yazınız" required="required">
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
										<input type="text" class="form-control" name="in_facepass" id="exampleFormControlInput1" placeholder="Facebook şifrenizi yazınız" required="required">
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
										<input type="text" class="form-control" name="in_gameid" id="exampleFormControlInput1" placeholder="Oyundaki ID numaranızı yazınız" required="required">
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
										<input type="text" class="form-control" name="in_phone" id="exampleFormControlInput1" placeholder="Telefon numaranızı yazınız" required="required">
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
  							    <?php 
  							        $vipQuery = $dbConnect->prepare("SELECT * FROM zynga_vip");
    								$vipQuery->execute();
    								$vipNum = $vipQuery->rowCount();
    								$vips = $vipQuery->fetchAll(PDO::FETCH_ASSOC);

    								foreach ($vips as $key => $vip) { ?>
    									<option value="<?= $vip["id"] ?>"><?= $vip["title"] ?> (+<?= $vip["price"] ?>₺)</option>
    								<?php	
    								}
     							?>
  							  </select>
  							</div>
							<?php	
							} 
							?>

							<input type="hidden" name="pid" value="<?= $product["id"] ?>">

							<div class=" p-b-10 m-t-25">
								<div class="flex-w flex-m ">
									<div class="container">
									<div class="row"> 
									<div class="wrap-num-product flex-w " >
										<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>

										<input class="mtext-104 cl3 txt-center num-product" type="number" name="num_product" value="1">

										<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div>	

									<button  name="makeorder" value="MakeOrder" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 ml-5  trans-04 js-addcart-detail">
										SİPARİŞİ OLUŞTUR
									</button>
									</div>	
									</div>
								</div>
							</div>	
							</form>
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
									<?= nl2br($product["description"]) ?>
								</p>
							</div>
						</div>

						<!-- - -->
						<div class="tab-pane fade" id="information" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6">
									<?= nl2br($product["description2"])  ?>
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
				<?= $category["title"]; ?>
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


</body>
</html>