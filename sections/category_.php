					<div class="p-b-10">
				<h3 class="ltext-102 cl5">
					<i class="fas fa-chess-queen"></i> OYUNLAR
				</h3>
			</div>

			<div class="row p-t-10">

				<?php 
		  $categoryQuery = $dbConnect->prepare("SELECT * FROM category WHERE statu = 1 AND deleted = 0 ORDER BY number");
          $categoryQuery->execute();
          $categoryNum = $categoryQuery->rowCount();
          $categories = $categoryQuery->fetchAll(PDO::FETCH_ASSOC);


          foreach ($categories as $key => $category) { ?>
          	
          	<div class="col-md-4 col-xl-4 col-6 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="images/<?= $category["image"] ?>" alt="IMG-BANNER">

						<a href="category/<?= $category["slug"] ?> " class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child3 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8" style="color: white">
									<?= $category["title"] ?>
								</span>

								<span class="block1-info stext-102 trans-04" style="color: white">
									<?= $category["product_type"] ?>
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									<?= $category["product_type"] ?> Satın Al
								</div>
							</div>
						</a>
					</div>
				</div>

          <?php	
          }
          ?>

  
			</div>
