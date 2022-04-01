<?php  
	$categoryQuery = $dbConnect->prepare("SELECT * FROM category WHERE statu = 1 AND deleted = 0");
    $categoryQuery->execute();
    $categoryNum = $categoryQuery->rowCount();
    $categories = $categoryQuery->fetchAll(PDO::FETCH_ASSOC);


?>
	<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32" style="margin-top: 80px">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Oyunlar
					</h4>

					<ul>
						<?php foreach ($categories as $key => $category) { ?>
							<li class="p-b-10">
							   <a href="/products.php?cid=<?= $category["id"] ?>" class="stext-107 cl7 hov-cl1 trans-04">
									<?= $category["title"] ?>
							   </a>
						    </li>
						<?php	
						} ?>	
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Yardım
					</h4>
					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								SİPARİŞLER
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								İADELER
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								TESLİMAT
							</a>
						</li>

					
					</ul>

					
				</div>


								<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Bağlantılar
					</h4>
					<ul>
						<li class="p-b-10">
							<a href="https://chipkolik.com" target="_blank" class="stext-107 cl7 hov-cl1 trans-04">
								CHIPKOLİK
							</a>
						</li>
											
					
					</ul>

					
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						İLETİŞİME GEÇ
					</h4>

					<p class="stext-107 cl7 size-201">
						Asağıdaki kanallardan bizimle iletişime geçebilirsiniz
					</p>

					<div class="p-t-27">
						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-instagram"></i>
						</a>

					
					</div>
				</div>

<!-- 				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						CHIPKOLİK HABERLER
					</h4>

					<form>
						<div class="wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
							<div class="focus-input1 trans-04"></div>
						</div>

						<div class="p-t-18">
							<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Abone Ol
							</button>
						</div>
					</form>
				</div> -->
			</div>

			<div class="p-t-40">
				<div class="flex-c-m flex-w p-b-18">
					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-01.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-02.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-03.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-04.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-05.png" alt="ICON-PAY">
					</a>
				</div>

				<p class="stext-107 cl6 txt-center">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy; <script>document.write(new Date().getFullYear());</script> Tüm hakları saklıdır | <a href="https://phpci.net" target="_blank">PHPCI</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

				</p>
			</div>
		</div>




	</footer>

	<?php
$dbConnect = null;
$_SESSION["error"] = null;
?>