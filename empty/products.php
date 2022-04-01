<?php  
session_start();
ob_start();
require_once("app/connect.php");
if (isset($_GET["cid"])) {
          $cat = $_GET["cid"];
          $categoryQuery = $dbConnect->prepare("SELECT * FROM category WHERE statu = 1 and id = ?");
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

      <a href="categories" class="stext-109 cl8 hov-cl1 trans-04">
        Oyunlar
        <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
      </a>

      <span class="stext-109 cl4">
        <?= $category["title"]; ?>
      </span>
    </div>
  </div>



<!-- <div class="mobileslider">  
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
  </div> -->

  <!-- OYUNLAR -->
  <div class="sec-banner bg0 p-t-40 p-b-50">
    <div class="container">
      <div class="row">

        <div class="col-xl-9">
<?php include("sections/products.php") ?>
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