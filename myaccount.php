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

  <!-- breadcrumb -->
  <div class="container">
    <div class="bread-crumb flex-w p-r-15 p-t-30 p-lr-0-lg">
      <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
        Anasayfa
        <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
      </a>

      <span class="stext-109 cl4">
        Hesabım
      </span>
    </div>
  </div>


  <div class="container mt-4">	
    <div class="row">



     <div class="col-md-3 justify-content-center pb-3" style="background-color: ; border: 2px solid #f7f7f7;padding-top: 20px">


      <?php 



      if (isset($_SESSION["useremail"])) {  

        $userQuery   = $dbConnect->prepare("SELECT * FROM users WHERE email = ? and statu = 1");
        $userQuery->execute([$_SESSION["useremail"]]);
        $userNum   = $userQuery->rowCount();
        $user       = $userQuery->fetch(PDO::FETCH_ASSOC);

        if ($userNum > 0) { ?>
          <a style="float: left; font-size: 20px; text-transform: uppercase; font-family: Poppins-Medium"><?= $user["name"] ?></a>
          <div style="text-align: right">
            <i class="fas fa-user-tie" style="font-size: 20px"></i>
            <hr>
          </div>

          
          <!-- <div style="text-align: center; width: 90px; float: right; border-radius: 20px; color: black; padding-top: 2px; margin-bottom: 4px" class="">
            <a class="" style="font-size: 16px">Bakiye: </a>
            <a style="font-size: 16px"><?= $user["balance"] ?>₺</a>
          </div> -->

          <div class="card" style="width: auto;">
            <ul class="list-group list-group-flush" id="userpanellist">
              <li class="list-group-item block1-txt userwidget" id="list1" style="font-family: Poppins-Medium"><i class="fas fa-user m-r-2" style="font-size: 17px"> </i> Hesap Bilgilerim</li>
              <li class="list-group-item block1-txt userwidget" id="list2" style="font-family: Poppins-Medium"><i class="fab fa-shopify m-r-2" style="font-size: 17px"> </i> Siparişlerim</li>
              <li class="list-group-item block1-txt userwidget" id="list3" style="font-family: Poppins-Medium"><i class="fas fa-university m-r-2" style="font-size: 16px"> </i> Ödeme Bildirimi</li>
              <li class="list-group-item block1-txt userwidget" id="list4" style="font-family: Poppins-Medium"><i class="fas fa-plus-circle m-r-2" style="font-size: 17px"></i> Bakiye Yükle <small>(Mevcut: <?= $user["balance"] ?>₺)</small> </li>
              <li class="list-group-item block1-txt userwidget" id="list5" style="font-family: Poppins-Medium"><i class="fas fa-share-alt m-r-2" style="font-size: 17px"></i> Davet Et & Kazan</li>
              <li class="list-group-item block1-txt userwidget" id="list6" style="font-family: Poppins-Medium"><i class="fas fa-sign-out-alt m-r-2" style="font-size: 17px"></i> Çıkış</li>
            </ul>
          </div>


          <?php  
        } else {
          header("Location: /");
        }


        ?>


        <?php  
      } else { ?>

        <a class="" style="float: left; font-size: 20px; font-family: Poppins-Medium">Giriş Yap</a>
        <div style="text-align: right">
          <i class="fas fa-user-tie" style="font-size: 25px"></i>
          <hr>
        </div>

        <form class="mt-4" action="app/func.php" method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1" style="font-weight: bold"> <i class="fas fa-envelope"></i> Email Adresi</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="E-posta adresi" required="required">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1" style="font-weight: bold"> <i class="fas fa-key"></i> Şifre</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Şifre" required="required">
            <small class="js-show-modal4" style="font-family: Poppins-Medium; cursor: pointer;">Şifremi Unuttum</small>
          </div>
          
          <button type="submit" class="btn btn-warning" name="userlogin" value="Userlogin" style="font-family: Poppins-Medium">GİRİŞ YAP</button>
          <button class="btn btn-dark js-show-modal1" style="color: #f9f9f9; font-family: Poppins-Medium">KAYIT OL</button>
        </form>

        <div class="m-t-4">
          <?php if (isset($_SESSION["error"])) { ?>
            <small style="color: red"> <?php echo $_SESSION["error"] ?> </small>
          <?php } ?>
        </div>          

        <?php
      }

      ?>


      <script type="text/javascript">
        // locate your element and add the Click Event Listener
        document.getElementById("userpanellist").addEventListener("click",function(e) {
        // e.target is our targetted element.
                    // try doing console.log(e.target.nodeName), it will result LI
                    if(e.target && e.target.nodeName == "LI" && e.target.id == "list1") {
                      window.location.href = "/account";
                    } else if(e.target && e.target.nodeName == "LI" && e.target.id == "list2") {
                      window.location.href = "/orders";
                    } else if(e.target && e.target.nodeName == "LI" && e.target.id == "list3") {
                      window.location.href = "/paymentnoti";
                    } else if(e.target && e.target.nodeName == "LI" && e.target.id == "list4") {
                      window.location.href = "/addbalance";
                    } else if(e.target && e.target.nodeName == "LI" && e.target.id == "list5") {
                      window.location.href = "/invite";  
                    } else if(e.target && e.target.nodeName == "LI" && e.target.id == "list6") {
                      window.location.href = "/app/func?logout=ok";            
                    } else
                    window.location.href = "/";
                  });
                </script>






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
                              KAYIT OL
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




                <!-- Modal4 -->
<div class="wrap-modal2 js-modal4 p-t-60 p-b-20">
  <div class="overlay-modal1 js-hide-modal4"></div>

  <div class="container">
    <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
      <button class="how-pos3 hov3 trans-04 js-hide-modal4">
        <img src="images/icons/icon-close.png" alt="CLOSE">
      </button>

      <div class="row justify-content-center">
        <div class="col-md-9 col-lg-9 p-b-30">
          <div class="p-r-30 p-t-5 p-lr-0-lg">
            <h4 class="mtext-105 cl2 js-name-detail p-b-14">
              ŞİFREMİ UNUTTUM
            </h4>

            <p class="stext-102 cl3 p-t-23">
              Üyeliğinize kayıtlı e-posta adresinizi yazarak şifrenizi yenileyebilirsiniz. 
            </p>

            <!--  -->
            <div class="p-t-33">

              <form action="app/func.php" method="POST">

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

                <div class="flex-w flex-r-m p-b-10">
                  <div class="size-204 flex-w flex-m respon6-next">


                    <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04" name="repassword" value="RePassword">
                      Gönder
                    </button>
                  </div>
                </div>  

              </form>


            </div>

            <!--  -->
            <div class="flex-w flex-m p-l-100 p-t-40 respon7">

              <a target="_blank" href="https://facebook.com/<?= $setting["facebook"] ?>" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
                <i class="fa fa-facebook"></i>
              </a>

              <a target="_blank" href="https://instagram.com/<?= $setting["instagram"] ?>" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="İnstagram">
                <i class="fa fa-instagram"></i>
              </a>

              <a target="_blank" href="https://api.whatsapp.com/send?phone=90<?= $setting["phone"]?>&text=Merhaba" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Whatsapp">
                <i class="fa fa-whatsapp"></i>
              </a>
              

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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

       ?>