					<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					<i class="fas fa-rss-square"></i> HABERLER
				</h3>
			</div>
					<div class="p-r-45 p-r-0-lg">

						<?php  
		  					$blogQuery = $dbConnect->prepare("SELECT * FROM blogs WHERE statu = 1 AND deleted = 0");
          					$blogQuery->execute();
          					$blogNum = $blogQuery->rowCount();
          					$blogs = $blogQuery->fetchAll(PDO::FETCH_ASSOC);
          				?>

          				<?php foreach ($blogs as $key => $blog): ?>

							<!-- item blog -->
							<div class="p-b-63">
							
							<div class="p-t-32">
								<h4 class="p-b-15">
									<a href="/blogdetail?blog=<?= $blog["id"] ?>" class="ltext-108 cl2 hov-cl1 trans-04">
										<?= $blog["title"] ?>
									</a>
								</h4>

								<p class="stext-117 cl6" style="overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3">
									<?= $blog["text"] ?>
								</p>

								<div class="flex-w flex-sb-m p-t-18">
									<span class="flex-w flex-m stext-111 cl2 p-r-30 m-tb-10">
										<span>
											<span class="cl4">By</span> Chipkolik  
											<span class="cl12 m-l-4 m-r-6">|</span>
										</span>

										<span>
											<?= $blog["topic"] ?>  
										</span>

									
									</span>

									<a href="/blogdetail?blog=<?= $blog["id"] ?>" class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
										Okumaya Devam Et

										<i class="fa fa-long-arrow-right m-l-9"></i>
									</a>
								</div>
							</div>
							</div>
          					
          				<?php endforeach ?>

					</div>