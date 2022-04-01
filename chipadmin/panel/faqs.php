<?php  
session_start();
ob_start();
require_once("../../app/connect.php");
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
						<h2 class="no-margin-bottom">Sıkça Sorulan Sorular</h2>
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
										<h3 class="h4">Tüm Sıkça Sorulan Sorular <a href="/chipadmin/panel/addfaq.php" class="btn btn-dark" style="float: right;">YENİ</a></h3>
									</div>

									<div class="card-body " style="overflow: auto;">


										<table id="example" class="display compact" style="width:100%">
											<thead>
												<tr>
													<th>NO</th>
													<th style="min-width: 250px;">Soru</th>
													<th>Cevap</th>
													<th style="min-width: 100px;">Tarih</th>
													<th style="min-width: 200px;">İşlemler</th>
												</tr>
											</thead>
											<tbody>

												<?php 
												$faqQuery = $dbConnect->prepare("SELECT * FROM faq ORDER BY id");
												$faqQuery->execute();
												$faqNum = $faqQuery->rowCount();
												$faqs = $faqQuery->fetchAll(PDO::FETCH_ASSOC);
												?>

												<?php foreach ($faqs as $key => $faq): ?>

													<tr>
														<td><?= $key+1 ?></td>
															<td><?= $faq["title"] ?></td>
															<td style="overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3"><?= $faq["content"] ?></td>
															<td style="min-width: 100px;"><?= $faq["created_at"] ?></td>
															<td>
																<a href="faqdetail?faqid=<?= $faq["id"] ?>" class="btn btn-info" style="color: white; text-decoration: none">DÜZENLE</a> 
																<a href="/chipadmin/panel/app/func.php?faqdelete=<?= $faq["id"] ?>" class="btn btn-danger" style="color: white; text-decoration: none"><i class="fa fa-trash"></i> SİL</a>
															</td>
														</tr>                

													<?php endforeach ?>



												</tbody>
											</table>


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