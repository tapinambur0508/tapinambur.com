<?php 
include($_SERVER['DOCUMENT_ROOT'].'/app/include/function.php');
$tapinambur = new tapinambur();
$href = ""; 
if (isset($_GET["href"])) { 
$href = strtolower($_GET["href"]);
$heading=$tapinambur->getPublicationName($href);
if ($heading) {
$title = $heading.' | tapinambur';
$news = $tapinambur->getPublication($href, 0, 100);
$news_count = $tapinambur->getCountPublication($href);
} else {
exit(header("Location: /404"));
}
} else {
$title = 'Новини | tapinambur';
$heading = "Новини";
$news = $tapinambur->getNews(0, 100);
$news_count = $tapinambur->getCountNews();
}
$style_less = 'news-style.less';
$style_masonry = 'masonry-big.css';
include_once($_SERVER['DOCUMENT_ROOT'].'/app/header.php');
?>
<a class="fa fa-chevron-up" aria-hidden="true" id="up" title="Вгору"></a>
<div id="myContainer">
<h1><?=$heading; ?></h1>
<div class="row masonry" data-columns>
<?php foreach($news as $item): ?>
<div>
<div class="image">
<a href="/article/<?=translit($item['header']); ?>/<?=$item['id']; ?>/">
<img src="<?=$item['cover_image']; ?>" alt="<?=$item['header']; ?>">
</a>
<p class="date"><?=$item['date']; ?></p>
<p class="views"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;<?=$item['views']; ?></p>
</div>
<h2><a href="/article/<?=translit($item['header']); ?>/<?=$item['id']; ?>/"><?=$item['header']; ?></a></h2>
<p><?=$item['content']; ?></p>
</div>
<?php endforeach; ?>
</div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/app/footer.php'); ?>