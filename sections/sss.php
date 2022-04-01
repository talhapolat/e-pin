<?php  
$faqQuery = $dbConnect->prepare("SELECT * FROM faq ORDER BY id");
$faqQuery->execute();
$faqNum = $faqQuery->rowCount();
$faqs = $faqQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="p-b-10">
  <h3 class="ltext-102 cl5">
   <i class="fas fa-question-circle"></i> SORULAR
 </h3>
</div>

<ul class="list-group p-t-10">
  <?php foreach ($faqs as $key => $faq): ?>
   <li class="list-group-item ssslist"><a class="cl2 hov-cl1 trans-04" href="/faq"><?= $faq["title"] ?></a></li> 
  <?php endforeach ?>
</ul>