<?php include($_SERVER['DOCUMENT_ROOT'].'/app/include/function.php'); $article=$tapinambur->getArticle($_GET["id"]);
if (!$article) {
exit(header("Location: /404"));
}
$title = $article["header"].' | tapinambur';
$style = 'article-style';
$meta = '
<meta property="og:title" content="'.$title.'" />
<meta property="og:type" content="article" />
<meta property="og:description" content="'.$article["header"].'"/>
<meta property="og:image" content="'.$article["cover_image"].'"/>
<meta property="og:url" content="'.$_SERVER["HTTP_HOST"].''.$_SERVER["REQUEST_URI"].'"/>
<meta property="og:site_name" content="tapinambur"/>
<meta name="twitter:card" content="summary"/>
<meta name="twitter:url" content="'.$_SERVER["HTTP_HOST"].''.$_SERVER["REQUEST_URI"].'"/>
<meta property="og:title" content="'.$title.'" />
<meta itemprop="image" content="'.$article["cover_image"].'"/>
<meta itemprop="name" content="tapinambur"/>
<meta itemprop="description" content="'.$article["header"].'"/>
<meta itemprop="image" content="'.$article["cover_image"].'"/>';
include_once($_SERVER['DOCUMENT_ROOT'].'/app/header.php');
$ip = $_SERVER["REMOTE_ADDR"];
$date = date("Y-m-d");
$browser = $_SERVER['HTTP_USER_AGENT'];
$article["views"] = $tapinambur->setVisits($_GET["id"], $article["views"], $ip, $date, $browser);
$news = $tapinambur->getReadMoreNews($article["id"], $article["key_word"]);
?>
<style>@media screen and (max-width:767.9px){.masonry[data-columns]::before{content:'1 .col-xs-12'}}@media screen and (min-width:768px) and (max-width:991.9px){.masonry[data-columns]::before{content:'1 .col-xs-6'}}@media screen and (min-width:992px) and (max-width:1199.9px){.masonry[data-columns]::before{content:'2 .col-xs-6'}}@media screen and (min-width:1200px){.masonry[data-columns]::before{content:'2 .col-xs-6'}}</style>
<a class="fa fa-chevron-up" aria-hidden="true" id="up" title="Вгору"></a>
<div id="myContainer">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
<div class="carousel-inner" role="listbox">
<div class="item active">
<img class="first-slide" src="<?=$article["cover_image"]; ?>" alt="<?=$article["header"]; ?>">
<div class="container-fluid">
<p class="views"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;<?=$article["views"]; ?></p>
<p class="date"><?=$article["date"]; ?></p>
<div class="carousel-caption">
<p><a><?=$article["header"]; ?></a></p>
</div>
</div>
</div>
</div>
</div>
<div class="full-content">
<?=$article["full_content"]; ?>
</div>
<p><a target="_blank" href="<?=$article['source']; ?>">Джерело</a></p>
<div class="fix-full-content">
<p>Побачили помилку? Допоможіть нам її&nbsp;<span>Виправити</span></p>
<div class="row">
<div class="col-md-6 col-xs-12">
<button class="btn btn-success btn-block" name="save" data-id="<?=$article['id']; ?>">Зберегти</button>
</div>
<div class="col-md-6 col-xs-12">
<button class="btn btn-danger btn-block" name="cancel">Скасувати</button>
</div>
</div>
</div>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" id="st_insights_js" src="http://w.sharethis.com/button/buttons.js?publisher=8c694d50-97fa-4f3d-8dab-6710d08c8e89"></script>
<script type="text/javascript">stLight.options({publisher:"8c694d50-97fa-4f3d-8dab-6710d08c8e89",doNotHash:false,doNotCopy:false,hashAddressBar:false});</script>
<span class='st_facebook_large' displayText='Facebook'></span>
<span class='st_vkontakte_large' displayText='Vkontakte'></span>
<span class='st_twitter_large' displayText='Tweet'></span>
<span class='st_googleplus_large' displayText='Google +'></span>
<span class='st_linkedin_large' displayText='LinkedIn'></span>
<span class='st_odnoklassniki_large' displayText='Odnoklassniki'></span>
<span class='st_pinterest_large' displayText='Pinterest'></span>
<span class='st_flipboard_large' displayText='Flipboard'></span>
<span class='st_email_large' displayText='Email'></span>
<div class="row">
<div class="col-md-6 col-xs-12">
<?php if ($header=$tapinambur->getPrevNews($article["publish_date_time"])): ?>
<a class="direction" href="/article/<?=translit($header[1]); ?>/<?=$header[0]; ?>">
<i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;<?=$header[1]; ?>
</a>
<?php endif; ?>
</div>
<div class="col-md-6 col-xs-12">
<?php if ($header=$tapinambur->getNextNews($article["publish_date_time"])): ?>
<a class="direction" href="/article/<?=translit($header[1]); ?>/<?=$header[0]; ?>">
<?=$header[1]; ?>&nbsp;<i class="fa fa-angle-double-right" aria-hidden="true"></i>
</a>
<?php endif; ?>
</div>
</div>
<h1>Читайте також:</h1>
<div class="row masonry" data-columns>
<?php foreach ($news as $item): ?>
<div>
<div class="image">
<a href="/article/<?=translit($item['header']); ?>/<?=$item['id']; ?>"><img src="<?=$item['cover_image']; ?>"></a>
<p class="date"><?=$item['date']; ?></p>
<p class="views"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;<?=$item['views']; ?></p>
</div>
<h2><a href="/article/<?=translit($item['header']); ?>/<?=$item['id']; ?>"><?=$item['header']; ?></a></h2>
<p><?=$item['content']; ?></p>
</div>
<?php endforeach; ?>
</div>
<div id="disqus_thread"></div>
<script>(function(){var b=document,a=b.createElement("script");a.src="//http-www-tapinambur-com.disqus.com/embed.js";a.setAttribute("data-timestamp",+new Date());(b.head||b.body).appendChild(a)})();</script>
</div>
<script id="dsq-count-scr" src="//http-www-tapinambur-com.disqus.com/count.js" async></script>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/app/footer.php'); ?>