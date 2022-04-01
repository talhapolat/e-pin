<?php  
session_start();
ob_start();
require_once("app/connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<?php include("sections/head.php") ?> 

<body class="animsition">
	
<?php include("sections/header.php") ?> 

	
<?php include("sections/duyuru.php") ?> 


<div class="container desktopslider mt-5">	
<div class="row">

	<div class="col-md-9 col-12">

<?php include("sections/slider.php") ?> 

	</div>

	<div class="col-md-3 justify-content-center" style="background-color: ; border: 2px solid #f1f1f1;padding-top: 20px">

<?php include("sections/widgetlogin.php") ?>

	</div>



</div>


</div>


<div class="mobileslider">	
		<div id="carouselMobile" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselMobile" data-slide-to="0" class="active"></li>
    <li data-target="#carouselMobile" data-slide-to="1"></li>
    <li data-target="#carouselMobile" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
  <img src="images/back3.png" width="100%" alt="...">
  <div class="carousel-caption d-none d-md-block">
    <h5>ZYNGA POKER</h5>
    <p>Chip Satışları İndirimde!</p>
  </div>
</div>
    <div class="carousel-item">
  <img src="images/back3.png" width="100%" alt="...">
  <div class="carousel-caption d-none d-md-block">
    <h5>...</h5>
    <p>...</p>
  </div>
</div>
<div class="carousel-item">
  <img src="images/back3.png" width="100%" alt="...">
  <div class="carousel-caption d-none d-md-block">
    <h5>...</h5>
    <p>...</p>
  </div>
</div>
    
  </div>
  <a class="carousel-control-prev" href="#carouselMobile" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselMobile" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
	</div>


<!-- OYUNLAR -->
	<div class="sec-banner bg0 p-t-40 p-b-50">
		<div class="container">
			<div class="row">

				<div class="col-xl-9">
<?php include("sections/category.php") ?>
				</div>

				<div class="col-xl-3 ">

<?php include("sections/widgetfacebook.php") ?>

				</div>

				<div class="col-xl-3">
					
				</div>
			</div>


			
		</div>
	</div> 

    <div class="container">
      <div class="row">

        <div class="col-xl-9">
<?php include("sections/blogs.php") ?>
        </div>

        <div class="col-xl-3 ">

<?php include("sections/sss.php") ?>

        </div>

        <div class="col-xl-3">
          
        </div>
      </div>


      
    </div>


<?php if (!isset($_SESSION["useremail"])) { ?>    

<div class="container mobilelogin mt-4" id="mobilelogin">
	<div style="background-color: #f9f9f9; border: 2px solid #f9f9f9;padding-top: 20px" class="p-3">
		<a class="" style="float: left; font-size: 30px">Giriş Yap</a>
		<div style="text-align: right">
		<i class="fas fa-user-tie" style="font-size: 35px"></i>
		<hr>
		</div>

    <form action="app/func.php" method="POST" class="mt-4">
  <div class="form-group">
    <label for="exampleInputEmail1" style="font-weight: bold"> <i class="fas fa-envelope"></i> Email Adresi</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="E-posta adresi">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1" style="font-weight: bold"> <i class="fas fa-key"></i> Şifre</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Şifre">
  </div>
  
  <button type="submit" class="btn btn-warning" name="userlogin" value="Userlogin">GİRİŞ YAP</button>
  <button type="submit" class="btn btn-dark js-show-modal1" style="color: #f9f9f9">KAYIT OL</button>
</form>
	</div>

     <!-- Modal1 -->
  <div class="wrap-modal2 js-modal1 p-t-60 p-b-20">
    <div class="overlay-modal1 js-hide-modal1"></div>

    <div class="container">
      <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
        <button class="how-pos3 hov3 trans-04 js-hide-modal1">
          <img src="images/icons/icon-close.png" alt="CLOSE">
        </button>

        <div class="row justify-content-center">
          <div class="col-md-9 col-lg-9 p-b-30">
            <div class="p-r-30 p-t-5 p-lr-0-lg">
              <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                KAYIT OLu
              </h4>

              <p class="stext-102 cl3 p-t-23">
                Üyelik oluşturarak hızlı bir şekilde sipariş verebilir, sipariş takibini yapabilirsiniz. 
              </p>
              
              <!--  -->
              <div class="p-t-33">

                <form action="" method="POST">

                <div class="flex-w flex-r-m ">
                  <div class="size-203 flex-c-m respon6">
                    E-Posta
                  </div>

                  <div class="size-204 respon6-next m-t-15">
                    <div class="bor8 m-b-20 how-pos4-parent">
                      <input class="stext-111 cl2 plh3 size-116 p-l-55 p-r-30" type="email" name="email" placeholder="E-posta Adresinizi yazınız" required="required">
                      <img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
                    </div>
                  </div>
                </div>      

                <div class="flex-w flex-r-m ">
                  <div class="size-203 flex-c-m respon6">
                    Şifre
                  </div>

                  <div class="size-204 respon6-next m-t-15">
                    <div class="bor8 m-b-20 how-pos4-parent">
                      <input class="stext-111 cl2 plh3 size-116 p-l-55 p-r-30" type="password" name="password" placeholder="Şifrenizi yazınız" required="required">
                      <img class="how-pos4 pointer-none" src="images/icons/padlock.png" alt="ICON">
                    </div>
                  </div>
                </div>   


                <div class="flex-w flex-r-m ">
                  <div class="size-203 flex-c-m respon6">
                    Telefon
                  </div>

                  <div class="size-204 respon6-next m-t-15">
                    <div class="bor8 m-b-20 how-pos4-parent">
                      <input class="stext-111 cl2 plh3 size-116 p-l-55 p-r-30" type="text" name="phone" placeholder="Telefon numaranızı yazınız">
                      <img class="how-pos4 pointer-none" src="images/icons/phone.png" alt="ICON">
                    </div>
                  </div>
                </div>


               

                <div class="flex-w flex-r-m p-b-10">
                  <div class="size-204 flex-w flex-m respon6-next">
                    

                    <button type="input" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 ">
                      Kayıt Ol
                    </button>
                  </div>
                </div>  

                </form>


              </div>

              <!--  -->
              <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                
                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
                  <i class="fa fa-facebook"></i>
                </a>

                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
                  <i class="fa fa-twitter"></i>
                </a>

                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="İnstagram">
                  <i class="fa fa-instagram"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<?php  
} ?>


	
<div class="text-center p-t-95" style="text-indent: center" >
<img src="images/<?= $setting["footimage"] ?>" class="img-fluid">
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