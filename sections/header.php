

<!-- Header -->
	<header>

		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<a href="/category/zynga">
					<div class="left-top-bar">
						Zynga Texas Holdem Poker Chip Fiyatları İndirimde!
					</div>
					</a>

					<div class="right-top-bar flex-w h-full">
						<a href="/faq" class="flex-c-m trans-04 p-lr-25">
							Yardım
						</a>

						<?php if (isset($_SESSION["useremail"])) { ?>
							<a href="/account" class="flex-c-m trans-04 p-lr-25">
								Hesabım
							</a>
						<?php	
						} ?>
						

<!-- 						<a href="#" class="flex-c-m trans-04 p-lr-25">
							EN
						</a>

						<a href="#" class="flex-c-m trans-04 p-lr-25">
							USD
						</a> -->
					</div>
				</div>
			</div>

			<div class="wrap-menu-desktop m-t-10">
				<nav class="limiter-menu-desktop container">
					
					<!-- Logo desktop -->		
					<a href="/" class="logo">
						<img src="images/icons/<?= $setting["logo"] ?>" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu" id="sitemenu">
							<li class="">
								<a href="/">Anasayfa</a>
							</li>

							<li id="menucategory">
								<a href="categories">Oyunlar</a>
							</li>

							<li >
								<a href="bank">Banka Bilgileri</a>
							</li>

							<li>
								<a href="blogs">Haberler</a>
							</li>

							<li>
								<a href="about">Hakkımızda</a>
							</li>

							<li>
								<a href="contact">İletişim</a>
							</li>
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile" style="height: 100px">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="/"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				

				<a href="/myaccount" id="mobileLoginButton" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 " data-notify="0">
					<i class="fas fa-user-tie" style="font-size: 25px;"></i>
				</a>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="topbar-mobile">
				<li>
					<a href="/products.php?cid=1">
					<div class="left-top-bar">
						Zynga Texas Holdem Poker Chip Fiyatları İndirimde!
					</div>
					</a>
				</li>

				
			</ul>

			<ul class="main-menu-m">
				<li>
					<a href="/">Anasayfa</a>
				</li>

				<li>
					<a href="categories">Oyunlar</a>
				</li>

				<li>
					<a href="bank" data-label1="hot">Banka Bilgileri</a>
				</li>

				<li>
					<a href="blogs">Haberler</a>
				</li>

				<li>
					<a href="about">Hakkımızda</a>
				</li>

				<li>
					<a href="contact">İletişim</a>
				</li>
			</ul>
		</div>

		
	</header>



