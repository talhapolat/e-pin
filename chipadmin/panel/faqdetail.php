<?php  
session_start();
ob_start();
require_once("../../app/connect.php");

$faqQuery = $dbConnect->prepare("SELECT * FROM faq WHERE id = ?");
$faqQuery->execute([$_GET["faqid"]]);
$faqNum = $faqQuery->rowCount();
$faq = $faqQuery->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>  
	<?php include("sections/head.php") ?> 
</head>
<body>
	<div class="page">

		<!-- Main Navbar-->
		<header class="header">
			<?php include("sections/header.php") ?> 
		</header>


		<!-- CONTENT -->

		<div class="page-content d-flex align-items-stretch"> 

			<!-- Side Navbar -->
			<nav class="side-navbar">
				<?php include("sections/sidebar.php") ?> 
			</nav>


			<div class="content-inner">
				<!-- Page Header-->
				<header class="page-header">
					<div class="container-fluid">
						<h2 class="no-margin-bottom">S.S.S. Bilgileri</h2>
					</div>
				</header>
				<!-- Dashboard Counts Section-->

				<!-- Updates Section                                                -->
				<section class="updates no-padding-top">
					<div class="container-fluid">
						<div class="row">
							<!-- Recent Updates-->
							<div class="col-lg-12 p-3">
								<div class="recent-updates card p-3">

									<div class="card-header">
										<h3 class="h4">S.S.S. Bilgisini Düzenle</h3>
									</div>

									<div class="card-body ">


										<form action="/chipadmin/panel/app/func.php" method="POST" enctype="multipart/form-data">

											<div class="mb-3">
												<label for="InputTitle" class="form-label">Soru Başlığı</label>
												<input type="text" class="form-control" id="InputTitle" name="title" value="<?= $faq["title"] ?>" required="required" >
											</div>

											<div class="mb-3">
												<label for="InputContent" class="form-label">Cevap</label>
												<textarea class="form-control" id="InputContent" name="content" rows="7" required="required"><?= $faq["content"] ?></textarea>
											</div> 

											<button type="submit" class="btn btn-primary" value="<?= $faq["id"] ?>" name="updatefaq">Kaydet</button>
										</form>



									</div>



								</div>
							</div>


						</div>


					</div>
				</section>







				<!-- Page Footer-->
				<footer class="main-footer">
					<?php include("sections/foot.php") ?>
				</footer>
			</div>
		</div>



		<!-- CONTENT END -->

	</div>

	<?php include("sections/footer.php") ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
</body>
</html>