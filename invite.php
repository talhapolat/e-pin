<?php  
session_start();
ob_start();
require_once("app/connect.php");

if (!isset($_SESSION["useremail"])) {
	header("Location: /app/func.php?logout=ok");
} else {
	$userQuery   = $dbConnect->prepare("SELECT * FROM users WHERE email = ? and statu = 1");
	$userQuery->execute([$_SESSION["useremail"]]);
	$userNum     = $userQuery->rowCount();
	$user        = $userQuery->fetch(PDO::FETCH_ASSOC);

	if ($userNum != 1) {
		header("Location: /app/func.php?logout=ok");
	}
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

			<span class="stext-109 cl4">
				Davet Et
			</span>
		</div>
	</div>


	<div class="container mt-5">	
		<div class="row">

			<div class="col-md-9 col-12 mb-5">

				<div class="p-b-20">
					<h3 class="ltext-102 cl5">
						<i class="fas fa-share-alt"></i> ARKADAŞINI DAVET ET
					</h3>
				</div>

				<div class="mt-4">
					<p>Davet ettiğiniz arkadaşlarınızın yaptığı ödemelerden ömür boyu bonus kazanırsınız.</p>
					<p>Herhangi bir sınır yoktur. <b>Ne kadar çok davet, o kadar çok bonus.</b> </p>
				</div>

				<div style="margin-top: 30px">

					<div class ="card" style="width: 13rem;">
						<ul class ="list-group list-group-flush">
							<li class ="list-group-item">BONUS ORANI: <b>%5</b> </li>
						</ul>
					</div>


					<div class ="card mt-5" style="width: auto">
						<ul class ="list-group list-group-flush">
							<li class ="list-group-item">DAVET LİNKİ <br>
								<a target="_blank" href="https://<?= $_SERVER['SERVER_NAME'] ?>?ref=<?= $user["refcode"] ?>"> https://<?= $_SERVER['SERVER_NAME'] ?>?ref=<?= $user["refcode"] ?></a> 
							</li>
						</ul>
					</div>

				</div>




			</div>

			<div class="col-md-3 justify-content-center desktopslider" style="background-color: ; border: 2px solid #f1f1f1;padding-top: 20px">

				<?php include("sections/widgetlogin.php") ?>

			</div>



		</div>


		<div class="row">
			
			<div class="col-md-12 col-12 mb-5">

				<div class="p-b-10">
					<h3 class="ltext-101 cl5">
						DAVET ETTİKLERİN
					</h3>
				</div>

				<div class="mt-3" style="overflow: auto;">
					<?php  
					$inviteQuery = $dbConnect->prepare("SELECT * FROM users WHERE invited_user = ?");
					$inviteQuery->execute([$user["id"]]);
					$invitesNum = $inviteQuery->rowCount();
					$invites = $inviteQuery->fetchAll(PDO::FETCH_ASSOC);
					?>
					<?php if ($invitesNum == 0): ?>
						<p>Henüz kimseyi davet etmediniz.</p>
						<?php else: ?>	
							<table class="table">
								<thead>
									<tr>
										<th scope="col">NO</th>
										<th scope="col">İSİM</th>
										<th scope="col">TARİH</th>
										<th scope="col">BONUS</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($invites as $key => $invite): ?>
										<tr>
											<th scope="row"><?= $key+1 ?></th>
											<td><?= $invite["name"] ?></td>
											<td><?= $invite["created_at"] ?></td>
											<?php  
											$rewardQuery = $dbConnect->prepare("SELECT SUM(balance) AS total FROM reference_rewards WHERE sender_id = ? and invited_id = ?");
											$rewardQuery->execute([$user["id"], $invite["id"]]);
											$total = $rewardQuery->fetch(PDO::FETCH_ASSOC);
											?>
											<td><?= number_format($total["total"], 2) ?> ₺</td>
										</tr>			
									<?php endforeach ?>
								</tbody>
							</table>					
						<?php endif ?>
					</div>

				</div>

			</div>

		</div>




		<!-- OYUNLAR -->
		<div class="sec-banner bg0 p-t-40 p-b-50">
			<div class="container">
				<div class="row">

					<div class="col-xl-9">



					</div>




					<div class="col-xl-3 ">


					</div>

					<div class="col-xl-3">

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