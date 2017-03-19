<?php include($_SERVER['DOCUMENT_ROOT'].'/app/include/function.php'); $href=''; if (isset($_GET["href"])) { $href=$_GET["href"]; $heading=$tapinambur->getPublicationName(strtolower($href));
if (!$heading) {
exit(header("Location: /404"));
}
$title = $heading.' | tapinambur';
$news = $tapinambur->getPublication($_GET['href'], 0, 100);
$news_count = $tapinambur->getCountPublication(strtolower($href));
} else {
$title = 'Новини | tapinambur';
$heading = "Новини";
$news = $tapinambur->getNews(0, 100);
$news_count = $tapinambur->getCountNews();
}
$style = 'news-style';
include_once($_SERVER['DOCUMENT_ROOT'].'/app/header.php');
?>
<style>@media screen and (max-width:767.9px){.masonry[data-columns]::before{content:'1 .col-xs-12'}}@media screen and (min-width:768px) and (max-width:991.9px){.masonry[data-columns]::before{content:'2 .col-xs-6'}}@media screen and (min-width:992px) and (max-width:1199.9px){.masonry[data-columns]::before{content:'2 .col-xs-6'}}@media screen and (min-width:1200px){.masonry[data-columns]::before{content:'3 .col-xs-4'}}</style>
<a class="fa fa-chevron-up" aria-hidden="true" id="up" title="Вгору"></a>
<div id="myContainer">
<h1><?=$heading; ?></h1>
<div class="row masonry" data-columns>
<?php foreach($news as $item): ?>
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