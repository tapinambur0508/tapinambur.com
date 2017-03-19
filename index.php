<?php $title='tapinambur | Новини зі світу технологій, автомобілів, спорту та багато іншого'; $style='home-style'; include_once($_SERVER['DOCUMENT_ROOT'].'/app/header.php'); $first_article=$tapinambur->getArticle(314);
$second_article = $tapinambur->getArticle(194);
$third_article = $tapinambur->getArticle(295);
?>
<style>@media screen and (max-width:767.9px){.masonry[data-columns]::before{content:'1 .col-xs-12'}}@media screen and (min-width:768px) and (max-width:991.9px){.masonry[data-columns]::before{content:'2 .col-xs-6'}}@media screen and (min-width:992px) and (max-width:1199.9px){.masonry[data-columns]::before{content:'2 .col-xs-6'}}@media screen and (min-width:1200px){.masonry[data-columns]::before{content:'3 .col-xs-4'}}</style>
<a class="fa fa-chevron-up" aria-hidden="true" id="up" title="Вгору"></a>
<div id="myContainer">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
<div class="carousel-inner" role="listbox">
<div class="item active">
<a href="/article/<?=translit($first_article['header']); ?>/<?=$first_article['id']; ?>"><img class="second-slide" src="<?=$first_article["cover_image"]; ?>" alt="<?=$first_article["header"]; ?>"></a>
<div class="container-fluid">
<p class="views"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;<?=$first_article["views"]; ?></p>
<p class="date"><?=$first_article["date"]; ?></p>
<div class="carousel-caption">
<p>
<a href="/article/<?=translit($first_article['header']); ?>/<?=$first_article['id']; ?>"><?=$first_article["header"]; ?></a>
</p>
</div>
</div>
</div>
<div class="item">
<a href="/article/<?=translit($second_article['header']); ?>/<?=$second_article['id']; ?>"><img class="second-slide" src="<?=$second_article["cover_image"]; ?>" alt="<?=$second_article["header"]; ?>"></a>
<div class="container-fluid">
<p class="views"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;<?=$second_article["views"]; ?></p>
<p class="date"><?=$first_article["date"]; ?></p>
<div class="carousel-caption">
<p>
<a href="/article/<?=translit($second_article['header']); ?>/<?=$second_article['id']; ?>"><?=$second_article["header"]; ?></a>
</p>
</div>
</div>
</div>
<div class="item">
<a href="/article/<?=translit($third_article['header']); ?>/<?=$third_article['id']; ?>"><img class="second-slide" src="<?=$third_article["cover_image"]; ?>" alt="<?=$third_article["header"]; ?>"></a>
<div class="container-fluid">
<p class="views"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;<?=$third_article["views"]; ?></p>
<p class="date"><?=$third_article["date"]; ?></p>
<div class="carousel-caption">
<p>
<a href="/article/<?=translit($third_article['header']); ?>/<?=$third_article['id']; ?>"><?=$third_article["header"]; ?></a>
</p>
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
<h1>Останні додані новини:</h1>
<div class="row masonry" data-columns>
<?php $news=$tapinambur->getNews(0, 9); foreach($news as $item): ?>
<div>
<div class="image">
<a href="/article/<?=translit($item['header']); ?>/<?=$item['id']; ?>">
<img src="<?=$item['cover_image']; ?>" alt="<?=$item['header']; ?>">
</a>
<p class="date"><?=$item['date']; ?></p>
<p class="views"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;<?=$item['views']; ?></p>
</div>
<h2><a href="/article/<?=translit($item['header']); ?>/<?=$item['id']; ?>"><?=$item['header']; ?></a></h2>
<p><?=$item['content']; ?></p>
</div>
<?php endforeach; ?>
</div>
<a href="/news" class="btn btn-info btn-block">Читати усі новини&nbsp;<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
<h1>Найбільш популярні:</h1>
<div class="row masonry" data-columns>
<?php $news=$tapinambur->getMostVisitNews(0, 9); foreach($news as $item): ?>
<div>
<div class="image">
<a href="/article/<?=translit($item['header']); ?>/<?=$item['id']; ?>">
<img src="<?=$item['cover_image']; ?>" alt="<?=$item['header']; ?>">
</a>
<p class="date"><?=$item['date']; ?></p>
<p class="views"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;<?=$item['views']; ?></p>
</div>
<h2><a href="/article/<?=translit($item['header']); ?>/<?=$item['id']; ?>"><?=$item['header']; ?></a></h2>
<p><?=$item['content']; ?></p>
</div>
<?php endforeach; ?>
</div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/app/footer.php'); ?>