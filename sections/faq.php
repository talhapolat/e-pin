<style>
	.accordion {
		
		color: #444;
		cursor: pointer;
		width: 100%;
		border: none;
		text-align: left;
		outline: none;
		font-size: 15px;
		transition: 0.4s;
	}

	.active, .accordion:active {
		 font-weight: 700;
	}

	.panel {
		display: none;
		background-color: white;
		overflow: hidden;
	}
</style>



<div class="p-b-10">
	<h3 class="ltext-102 cl5">
		<i class="fas fa-question-circle"></i> SORULAR
	</h3>
</div>

<div class="row p-t-10">

	<?php 
	$faqQuery = $dbConnect->prepare("SELECT * FROM faq ORDER BY id");
	$faqQuery->execute();
	$faqNum = $faqQuery->rowCount();
	$faqs = $faqQuery->fetchAll(PDO::FETCH_ASSOC);


	foreach ($faqs as $key => $faq) { ?>

		<div class="card mt-2" style="width: 100%">
			<div class="card-body">
				<button class="accordion"><?= $faq["title"] ?></button>
				<div class="panel">
					<p><?= $faq["content"] ?></p>
				</div>
			</div>
		</div>


		<?php	
	}
	?>


</div>


<script>
	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
		acc[i].addEventListener("click", function() {
			this.classList.toggle("active");
			var panel = this.nextElementSibling;
			if (panel.style.display === "block") {
				panel.style.display = "none";
			} else {
				panel.style.display = "block";
			}
		});
	}
</script>