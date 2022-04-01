<?php  
session_start();
ob_start();
require_once("app/connect.php");
?>

<!DOCTYPE html>
<html lang="tr">

<?php include("sections/head.php") ?> 

<body class="animsition">
	
<?php include("sections/header.php") ?> 

	
<?php include("sections/duyuru.php") ?> 

  <!-- breadcrumb -->
  <div class="container">
    <div class="bread-crumb flex-w  p-r-15 p-t-30 p-lr-0-lg">
      <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
        Anasayfa
        <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
      </a>

      <span class="stext-109 cl4">
        Haberler
      </span>    

    </div>
  </div>


<div class="container mt-5">
<?php include("sections/blogs.php") ?>
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