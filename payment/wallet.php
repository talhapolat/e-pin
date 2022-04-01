<div class="card" style="width: 18rem;">
	<ul class="list-group list-group-flush">
		<li class="list-group-item">Mevcut Bakiye : <b><?= $user["balance"] ?>₺</b> </li>
		<li class="list-group-item">Sipariş Tutarı : <b><?= $order["price"] ?>₺</b> </li>
		<li class="list-group-item">Sipariş Kodu : <b><?= $order["order_number"] ?></b> </li>
		<li class="list-group-item"> 
			<?php if ($user["balance"] < $order["price"]): ?>
				<button class="btn btn-dark" name="paywithbalance" value="<?= $order["id"] ?>" style="cursor: not-allowed;" title="Bakiye Yetersiz" disabled >BAKİYE İLE ÖDE</button>
			<?php else: ?>
			<form action="/app/func.php" method="POST">
				<button type="submit" class="btn btn-dark" name="paywithbalance" value="<?= $order["id"] ?>">BAKİYE İLE ÖDE</button> 
			</form>
			<?php endif ?>
		</li>
	</ul>
</div>