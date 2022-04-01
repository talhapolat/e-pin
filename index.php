<?php  
session_start();
ob_start();
require_once("app/connect.php");

if (isset($_GET["ref"])) {
  $refcode = $_GET["ref"];
  $_SESSION["refcode"] = $refcode;
} 

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

<?php  

$sliderQuery = $dbConnect->prepare("SELECT * FROM slider WHERE statu = 1 ORDER BY number");
$sliderQuery->execute();
$sliderNum = $sliderQuery->rowCount();
$sliders = $sliderQuery->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="mobileslider">	
  <div id="carouselMobile" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">

      <?php foreach ($sliders as $key => $slider): ?>
        <li data-target="#carouselDesktop" data-slide-to="<?= $key ?>"
          <?php if ($key == 0): ?>
            class="active"
          <?php endif ?>
          ></li>
        <?php endforeach ?>

      </ol>

      <div class="carousel-inner">

        <?php foreach ($sliders as $key => $slider): ?>

          <div class="carousel-item 
          <?php if ($key == 0): ?>
            active
          <?php endif ?>
          ">
          <?php if (isset($slider["link"])): ?>
           <a href="<?= $slider["link"] ?>">
            <img src="images/slider/<?= $slider["image"] ?>" width="100%" alt="...">
          </a>           
        <?php else: ?>
          <img src="images/slider/<?= $slider["image"] ?>" width="100%" alt="...">
        <?php endif ?>
        <div class="carousel-caption d-none d-md-block">
          <h5></h5>
          <p></p>
        </div>
      </div>      

    <?php endforeach ?>
  </div>



  <a class="carousel-control-prev" href="#carouselMobile" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Önceki</span>
  </a>
  <a class="carousel-control-next" href="#carouselMobile" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Sonraki</span>
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