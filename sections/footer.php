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
					Kategoriler
				</h4>

				<ul>
					<?php foreach ($categories as $key => $category) { ?>
						<li class="p-b-10">
							<a href="/category/<?= $category["slug"] ?>" class="stext-107 cl7 hov-cl1 trans-04">
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
					<a target="_blank" href="http://facebook.com/<?= $setting["facebook"] ?>" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
						<i class="fa fa-facebook"></i>
					</a>

					<a target="_blank" href="http://instagram.com/<?= $setting["instagram"] ?>" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
						<i class="fa fa-instagram"></i>
					</a>

					<a target="_blank" href="https://api.whatsapp.com/send?phone=90<?= $setting["phone"]?>&text=Merhaba" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
						<i class="fa fa-whatsapp"></i>
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
					<a class="m-all-1">
						<img src="images/icons/icon-pay-01.png" alt="ICON-PAY">
					</a>

					<a class="m-all-1">
						<img src="images/icons/icon-pay-02.png" alt="ICON-PAY">
					</a>

					<a class="m-all-1">
						<img src="images/icons/icon-pay-03.png" alt="ICON-PAY">
					</a>

					<a class="m-all-1">
						<img src="images/icons/icon-pay-04.png" alt="ICON-PAY">
					</a>

					<a class="m-all-1">
						<img src="images/icons/icon-pay-05.png" alt="ICON-PAY">
					</a>
				</div>

				<p class="stext-107 cl6 txt-center">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy; <script>document.write(new Date().getFullYear());</script> Tüm hakları saklıdır | <a href="https://talhapolat.com.tr" target="_blank">TP</a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

				</p>
			</div>
		</div>




	</footer>

	<!-- WhatsApp ekleme -->
	<script type="text/javascript">
		(function () {
			var options = {
            whatsapp: "905330453692", // WhatsApp numarası
            call_to_action: "Merhaba, nasıl yardımcı olabilirim?", // Görüntülenecek yazı
            position: "left", // Sağ taraf için 'right' sol taraf için 'left'
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- WhatsApp ekleme -->


<!--Start of Tawk.to Script-->
<script type="text/javascript">
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
		var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
		s1.async=true;
		s1.src='https://embed.tawk.to/5c9f5a006bba460528007228/default';
		s1.charset='UTF-8';
		s1.setAttribute('crossorigin','*');
		s0.parentNode.insertBefore(s1,s0);
	})();
</script>
<!--End of Tawk.to Script-->

<?php
$dbConnect = null;
$_SESSION["error"] = null;
?>