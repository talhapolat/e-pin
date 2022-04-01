  
<?php  

$sliderQuery = $dbConnect->prepare("SELECT * FROM slider WHERE statu = 1 ORDER BY number");
$sliderQuery->execute();
$sliderNum = $sliderQuery->rowCount();
$sliders = $sliderQuery->fetchAll(PDO::FETCH_ASSOC);


?>

<div id="carouselDesktop" class="carousel slide" data-ride="carousel">


  <ol class="carousel-indicators">

    <?php foreach ($sliders as $key => $slider): ?>
      <li data-target="#carouselDesktop" data-slide-to="<?= $key ?>"
        <?php if ($key == 0): ?>
          class="active"
        <?php endif ?>
        ></li>
      <?php endforeach ?>

    </ol>


    <div class="carousel-inner">

      <?php foreach ($sliders as $key => $slider): ?>

        <div class="carousel-item 
        <?php if ($key == 0): ?>
          active
        <?php endif ?>
        ">
        <?php if (isset($slider["link"])): ?>
         <a href="<?= $slider["link"] ?>">
          <img src="images/slider/<?= $slider["image"] ?>" width="100%" alt="...">
        </a>           
        <?php else: ?>
          <img src="images/slider/<?= $slider["image"] ?>" width="100%" alt="...">
        <?php endif ?>
        <div class="carousel-caption d-none d-md-block">
          <h5></h5>
          <p></p>
        </div>
      </div>      

    <?php endforeach ?>





  </div>
  <a class="carousel-control-prev" href="#carouselDesktop" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Önceki</span>
  </a>
  <a class="carousel-control-next" href="#carouselDesktop" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Sonraki</span>
  </a>
</div>