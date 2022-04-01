					

			<div class="p-b-10">
				<div class="row">
					<div class="col-md-7">
						<a class="ltext-103 cl5" style="color: black">
							<i class="fas fa-chess-queen"></i> <?= $category["title"] ?> <?= $category["product_type"] ?>
						</a>	
					</div>

					<div class="col-md-5 categorymenus" >
            <?php if ($category["description2"] != null): ?>
            <button class="btn btn-warning m-b-17 js-show-modal2">Transfer Şartları</button>            
            <?php endif ?>
            <?php if ($category["description3"] != null): ?>
            <button class="btn btn-danger m-b-17 js-show-modal3" >Ban Riski</button>        
            <?php endif ?>
					</div>
				</div>




				<p class="m-t-10"><?= $category["description"] ?></p>
			</div>

			<div class="row p-t-10">

        <?php if ($category["custompacket"] == 1): ?>
           <!-- CUSTOM PACKET -->
                    <div class="col-md-3 col-xl-3 col-6 p-b-30 ">
          <div class="block1 wrap-pic-w" style="border-bottom: 0px!important">
            <img src="images/<?= $category["image"] ?>" alt="IMG-BANNER">

            <?php if (isset($_SESSION["useremail"])) { ?>
            <a href="packet?cid=<?= $category["id"] ?>" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
            <?php
            } else { ?>
            <a style="cursor: pointer" class="js-addwish-detail block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
            <?php  
            }
            ?>

              <div class="block1-txt-child3 flex-col-l">
                <span class="block1-name ltext-102 trans-04 p-b-8" style="color: white">
                  <?= $category["title"] ?>
                </span>

                <span class="block1-info stext-102 trans-04" style="color: white">
                  <?= $category["product_type"] ?>
                </span>
              </div>

              <div class="block1-txt-child2 p-b-4 trans-05">
                <div class="block1-link stext-101 cl0 trans-09">
                   Paket Oluştur
                </div>
              </div>
            </a>
          </div>
          <div class="block1 wrap-pic-w bg-dark p-2" style="border-top: 0px; color: #f9f9f9; ">
          <a style="font-family: Poppins-Bold;">Paket Oluştur</a>
          <a style="float: right; font-family: Poppins-Bold;"> </a>
          </div>
        </div>         
        <?php endif ?>




				<?php 
		      $productQuery = $dbConnect->prepare("SELECT * FROM product WHERE statu = 1 AND category_id = ? AND deleted = 0");
          $productQuery->execute([$category["id"]]);
          $productNum = $productQuery->rowCount();
          $products = $productQuery->fetchAll(PDO::FETCH_ASSOC);



          foreach ($products as $key => $product) { ?>

          	<div class="col-md-3 col-xl-3 col-6 p-b-30 ">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w" style="border-bottom: 0px!important">
						<img src="images/<?= $product["image"] ?>" alt="IMG-BANNER">

            <?php if (isset($_SESSION["useremail"])) { ?>
            <a href="checkout?pid=<?= $product["id"] ?>" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
            <?php
            } else { ?>
            <a style="cursor: pointer" class="js-addwish-detail block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
            <?php  
            }
            ?>

							<div class="block1-txt-child3 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8" style="color: white">
									<?= $product["title"] ?>
								</span>

								<span class="block1-info stext-102 trans-04" style="color: white">
									<?= $category["product_type"] ?>
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									 Satın Al
								</div>
							</div>
						</a>
					</div>
					<div class="block1 wrap-pic-w bg-dark p-2" style="border-top: 0px; color: #f9f9f9; ">
					<a style="font-family: Poppins-Bold;"><?= $product["title"] ?></a>
					<a style="float: right; font-family: Poppins-Bold;"> <?= $product["price"] ?> ₺</a>
					</div>
				</div>


          <?php	
          }





           ?>


			</div>


  <div class="categoryex"> 
      <!-- TRANSFER ŞARTLARI -->
  <div class="wrap-modal1 js-modal2 p-t-60 p-b-20" style="width: 800px">
    <div class="overlay-modal1 js-hide-modal2"></div>

    <div class="container">
      <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
        <button class="how-pos3 hov3 trans-04 js-hide-modal2">
          <img src="images/icons/icon-close.png" alt="CLOSE">
        </button>

        <div class="row justify-content-center">
          <div class="col-md-9 col-lg-9 p-b-30">
            <div class="p-r-30 p-t-5 p-lr-0-lg">

              <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                <i class="fas fa-exclamation-circle"></i> TRANSFER ŞARTLARI
              </h4>

              <ul>
                <li>
                  <p><?= $category["description2"] ?></p>
                </li>
              </ul>


                  <div class="m-t-20">
                  <div class="size-204">
                    <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-hide-modal2" name="newuser" value="Newuser">
                      TAMAM
                    </button>
                  </div>
                </div>  


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  

      <!-- BAN RİSKİ -->
  <div class="wrap-modal1 js-modal3 p-t-60 p-b-20" style="width: 800px">
    <div class="overlay-modal1 js-hide-modal3"></div>

    <div class="container">
      <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
        <button class="how-pos3 hov3 trans-04 js-hide-modal3">
          <img src="images/icons/icon-close.png" alt="CLOSE">
        </button>

        <div class="row justify-content-center">
          <div class="col-md-9 col-lg-9 p-b-30">
            <div class="p-r-30 p-t-5 p-lr-0-lg">

              <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                <i class="fas fa-exclamation-triangle" ></i> BAN RİSKİ
              </h4>

              <ul>
                <li>
                  <p><?= $category["description3"] ?></p>
                </li>
              </ul>


                  <div class="m-t-20">
                  <div class="size-204">
                    <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-hide-modal3" name="newuser" value="Newuser">
                      TAMAM
                    </button>
                  </div>
                </div>  


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  

  </div>


    <div class="categoryexmobile">     
      <!-- TRANSFER ŞARTLARI MOBİLE -->
  <div class="wrap-modal2 js-modal2 p-t-60 p-b-20">
    <div class="overlay-modal1 js-hide-modal2"></div>

    <div class="container">
      <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
        <button class="how-pos3 hov3 trans-04 js-hide-modal2">
          <img src="images/icons/icon-close.png" alt="CLOSE">
        </button>

        <div class="row justify-content-center">
          <div class="col-md-9 col-lg-9 p-b-30">
            <div class="p-r-30 p-t-5 p-lr-0-lg">

              <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                <i class="fas fa-exclamation-circle"></i> TRANSFER ŞARTLARI
              </h4>

              <ul>
                <li>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                  cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </li>

                <li class="m-t-12">
                  <p>Satın aldığınız chip'leriniz banlanmasın diye hesapları farklı ülkelerden giriş yapıp zynganın algılayamaması için gerekli önlemleri alarak aktarımlarınızı gerçekleştiriyoruz. Ürün satın aldığınız taktirde transfer şartlarını kabul etmiş sayılırsınız.</p>
                </li>

              </ul>


                  <div class="m-t-20">
                  <div class="size-204">
                    <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-hide-modal2" name="newuser" value="Newuser">
                      TAMAM
                    </button>
                  </div>
                </div>  


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  

      <!-- BAN RİSKİ MOBİLE -->
  <div class="wrap-modal2 js-modal3 p-t-60 p-b-20">
    <div class="overlay-modal1 js-hide-modal3"></div>

    <div class="container">
      <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
        <button class="how-pos3 hov3 trans-04 js-hide-modal3">
          <img src="images/icons/icon-close.png" alt="CLOSE">
        </button>

        <div class="row justify-content-center">
          <div class="col-md-9 col-lg-9 p-b-30">
            <div class="p-r-30 p-t-5 p-lr-0-lg">

              <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                <i class="fas fa-exclamation-triangle" ></i> BAN RİSKİ
              </h4>

              <ul>
                <li>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                  cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </li>

                <li class="m-t-12">
                  <p>Banlanma durumlarında firmamız sorunlu değildir. Ürün satın aldığınız taktirde banlanma riskini kabul etmiş sayılırsınız.</p>
                </li>

              </ul>


                  <div class="m-t-20">
                  <div class="size-204">
                    <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-hide-modal3" name="newuser" value="Newuser">
                      TAMAM
                    </button>
                  </div>
                </div>  


            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
  </div>

