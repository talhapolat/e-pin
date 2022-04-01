<?php  
session_start();
ob_start();
require_once("app/connect.php");

	 $blogQuery = $dbConnect->prepare("SELECT * FROM blogs WHERE statu = 1 and id = ?");
     $blogQuery->execute([$_GET["blog"]]);
     $blogNum = $blogQuery->rowCount();
     $blog = $blogQuery->fetch(PDO::FETCH_ASSOC);

     if ($blogNum != 1) {
     	header("Location: /blogs.php");
     }

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

      <a href="/blogs" class="stext-109 cl8 hov-cl1 trans-04">
        Haberler
        <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
      </a>      

      <span class="stext-109 cl4">
        <?= $blog["title"]; ?>
      </span>    

    </div>
  </div>


	<!-- Content page -->
	<section class="bg0 p-t-15 p-b-20">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-lg-9 p-b-80">
					<div class="p-r-45 p-r-0-lg">
						

						<div class="p-t-32">
							
							<h4 class="ltext-109 cl2 p-b-28">
								<?= $blog["title"]; ?>
							</h4>

							<p class="stext-117 cl6 p-b-26">
								<?= $blog["text"]; ?>
							</p>

						</div>

						<div class="flex-w flex-t p-t-16">
							<span class="size-216 stext-116 cl8 p-t-4">
								Tags
							</span>

							<div class="flex-w size-217">
								<a class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
									<?= $blog["topic"]; ?>
								</a>

						
							</div>
						</div>

						<!--  -->
						<!-- <div class="p-t-40">
							<h5 class="mtext-113 cl2 p-b-12">
								Leave a Comment
							</h5>

							<p class="stext-107 cl6 p-b-40">
								Your email address will not be published. Required fields are marked *
							</p>

							<form>
								<div class="bor19 m-b-20">
									<textarea class="stext-111 cl2 plh3 size-124 p-lr-18 p-tb-15" name="cmt" placeholder="Comment..."></textarea>
								</div>

								<div class="bor19 size-218 m-b-20">
									<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="name" placeholder="Name *">
								</div>

								<div class="bor19 size-218 m-b-20">
									<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="email" placeholder="Email *">
								</div>

								<div class="bor19 size-218 m-b-30">
									<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="web" placeholder="Website">
								</div>

								<button class="flex-c-m stext-101 cl0 size-125 bg3 bor2 hov-btn3 p-lr-15 trans-04">
									Post Comment
								</button>
							</form>
						</div> -->
					</div>
				</div>

				<div class="col-md-4 col-lg-3 p-b-80">
					<div class="side-menu">
					

					</div>
				</div>
			</div>
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