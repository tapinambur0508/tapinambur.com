<?php
    $title = 'tapinambur - Home';
    require_once 'app/header.php';
    require_once 'app/include/function.php';
    echo '<link href="public/css/home-style.css" rel="stylesheet">';
?>

<a class="fa fa-chevron-up" aria-hidden="true" id="up" title="Вгору"></a>

<!-- Carousel -->
<?php 
  $news = getNews(0, 6);
?>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img class="first-slide" src="public/images/hero-01 (1).jpg" alt="First slide">
      <div class="container">
        <div class="carousel-caption">
         <p><a href="#">Another example headline</a></p>
        </div>
      </div>
    </div>
    <div class="item">
      <img class="second-slide" src="public/images/hero-01 (2).jpg" alt="Second slide">
      <div class="container">
        <div class="carousel-caption">
          <p><a href="#">Another example headline</a></p>
        </div>
      </div>
    </div>
    <div class="item">
      <img class="third-slide" src="public/images/hero-01 (3).jpg" alt="Third slide">
      <div class="container">
        <div class="carousel-caption">
          <p><a href="#">Another example headline</a></p>
        </div>
      </div>
    </div>
  </div>
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<!-- Container -->
<div id="myContainer"> 
  <div class="row">
    <div class="cols col-12">
      <h1>Останні додані новини:</h1>
    </div>
 
    <?php 
      $news = getNews(0, 6);
    ?>

    <?php foreach($news as $item): ?>
      <div class="cols col-4">
        <img src="<?=$item['image'] ?>">
        <h2><?=$item['header'] ?></h2>
        <p><?=$item['content'] ?></p>
        <a href="/article.php?id=<?=$item['id'] ?>">
          <input type="button" value="View details&nbsp;&raquo;" class="btn btn-default">
        </a>
      </div>
    <?php endforeach; ?>

    <div class="cols col-12">
      <a href="/news.php">
        <input type="button" value="Читати всі новини&nbsp;&raquo;" class="btn btn-danger btn-lg">
      </a>
    </div>
  </div>

  <div class="row">
    <div class="cols col-12">
      <h1>Рекомендовані:</h1>
    </div>

    <!-- Code -->

  </div>

  <div class="row">
    <div class="cols col-12">
      <h1>Найбільш популярні:</h1>
    </div>

    <?php 
      $news = getMostVisitNews(0, 6);
    ?>

    <?php foreach($news as $item): ?>
      <div class="cols col-4">
        <img src="<?=$item['image'] ?>">
        <h2><?=$item['header'] ?></h2>
        <p><?=$item['content'] ?></p>
        <a href="/article.php?id=<?=$item['id'] ?>">
          <input type="button" value="View details&nbsp;&raquo;" class="btn btn-default">
        </a>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="row">
    <div class="cols col-12">
      <h1>Магазин:</h1>
    </div>

   <!-- Code -->

    <div class="cols col-12">
      <a href="/store.php">
        <input type="button" value="Перейти в магазин&nbsp;&raquo;" class="btn btn-danger btn-lg">
      </a>
    </div>
  </div>
</div>

<div id="money">
  <!-- Реклама -->
</div>

<script>
  $(document).ready(function () {

    window.onscroll = function() {
      var scrolled = window.pageYOffset;
      
      if (scrolled > 600) {
        if (($(document).width() >= 300) && ($(document).width() <= 580)) {
          up.classList.add('fa-2x');
        } else if (($(document).width() >= 581) && ($(document).width() <= 799)) {
          up.classList.add('fa-3x');
        } else if (($(document).width() >= 800) && ($(document).width() <= 1400)) {
          up.classList.add('fa-4x');
        } else if (($(document).width() >= 1401) && ($(document).width() <= 2000)) {
          up.classList.add('fa-5x');
        }

        $("#up").show();
      } else {
        $("#up").hide();
      }
    }

    $("#up").bind("click", function () {
      var scroll = window.pageYOffset;

      var timerId = setInterval(function() {
        $(document).scrollTop(scroll);
        scroll -= 90; 

        if (scroll < 0) {
          clearInterval(timerId);
          window.scrollTo(0, 0);
        }
      }, 10);
    });
  });
</script>

<?php
    require_once 'app/footer.php';
?>