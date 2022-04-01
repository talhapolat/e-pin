<div class="p-b-10">
  <h3 class="ltext-102 cl5">
   <i class="fas fa-university"></i> BANKA HESAP BİLGİLERİMİZ
 </h3>
</div>

<div class="row p-t-10">

  <?php 
  $bankQuery = $dbConnect->prepare("SELECT * FROM bank WHERE statu = 1 AND deleted = 0");
  $bankQuery->execute();
  $bankNum = $bankQuery->rowCount();
  $banks = $bankQuery->fetchAll(PDO::FETCH_ASSOC);


  foreach ($banks as $key => $bank) { ?>
   
   <div class="col-md-6 col-xl-4 col-12 p-b-30 m-lr-auto">
     <!-- Block1 -->
     <div class="card" style="">
      <img src="images/banks/<?= $bank["image"] ?>" class="card-img-top" alt="...">
<!--   <div class="card-body">
    <h5 class="card-title">ZİRAAT BANKASI</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div> -->
  <ul class="list-group list-group-flush">
    <li class="list-group-item"> <span style="font-weight: bold">İSİM:</span> <?= $bank["name"] ?> <i class="far fa-copy" style="float: right; cursor: pointer;"></i> </li>
    <li class="list-group-item"> <span style="font-weight: bold">ŞUBE NO:</span> <?= $bank["sube"] ?> <i class="far fa-copy" style="float: right; cursor: pointer;"></i></li>
    <li class="list-group-item"> <span style="font-weight: bold">HESAP NO:</span> <?= $bank["account_number"] ?> <i class="far fa-copy" style="float: right; cursor: pointer;"></i></li>
    <li class="list-group-item"> <span style="font-weight: bold">IBAN:</span> <?= $bank["iban"] ?> <i class="far fa-copy" style="float: right; cursor: pointer;"></i></li>
    <li class="list-group-item"> <span style="font-weight: bold">ÜCRETLER:</span> <?= $bank["price"] ?> <i class="far fa-copy" style="float: right; cursor: pointer;"></i></li>
  </ul>
 <!--  <div class="card-body">
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div> -->
</div>
</div>


<?php	
}





?>


</div>
