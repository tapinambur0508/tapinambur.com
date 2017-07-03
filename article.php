<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/app/include/function.php');
$tapinambur=new tapinambur();
$article=$tapinambur->getArticle($_GET["id"]);
if ($article) {
$title = $article["header"].' | tapinambur';
$style_less = 'article-style.less';
$style_masonry = 'masonry-small.css';
$meta = '
<meta property="og:url" content="'.$_SERVER["HTTP_HOST"].''.$_SERVER["REQUEST_URI"].'"/>
<meta property="og:title" content="'.$title.'" />
<meta property="og:description" content="'.$article["header"].'"/>
<meta property="og:image" content="'.$article["cover_image"].'"/>
<meta property="og:site_name" content="tapinambur"/>
<meta property="fb:app_id" content="1276593922383445"/>
<meta property="fb:admins" content="100002982444589"/>
<meta name="twitter:card" content="summary"/>
<meta name="twitter:url" content="'.$_SERVER["HTTP_HOST"].''.$_SERVER["REQUEST_URI"].'"/>
<meta property="og:title" content="'.$title.'" />
<meta itemprop="image" content="'.$article["cover_image"].'"/>
<meta itemprop="name" content="tapinambur"/>
<meta itemprop="description" content="'.$article["header"].'"/>
<meta itemprop="image" content="'.$article["cover_image"].'"/>';
include_once($_SERVER['DOCUMENT_ROOT'].'/app/header.php');
$ip = $_SERVER["REMOTE_ADDR"];
$browser = $_SERVER['HTTP_USER_AGENT'];
$article["views"] = $tapinambur->setVisits($_GET["id"], $article["views"], $ip, $browser);
$news = $tapinambur->getRandNews($article["id"], 6);
} else { exit(header("Location: /404")); }
?>
<div id="myContainer">
<div class="img-wrapper">
<img src="<?=$article["cover_image"]; ?>" alt="<?=$article["header"]; ?>" style="width: 100%">
<p class="header"><?=$article["header"]; ?></p>
<p class="views"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;<?=$article["views"]; ?></p>
<p class="date"><?=date("d.m.Y", strtotime($article["date_time"])); ?></p>
</div>
<?=$article["full_content"]; ?>
<?php if (isset($article['source'])): ?>
<p><a target="_blank" href="<?=$article['source']; ?>">Джерело</a></p>
<?php endif; ?>
<!-- AddToAny BEGIN -->
<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
<a class="a2a_button_facebook"></a>
<a class="a2a_button_twitter"></a>
<a class="a2a_button_google_plus"></a>
<a class="a2a_button_linkedin"></a>
<a class="a2a_button_email"></a>
</div>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->
<div class="row">
<div class="col-md-6 col-xs-12">
<?php if ($header=$tapinambur->getPrevNews($article["date_time"])): ?>
<a class="direction" href="/article/<?=translit($header[1]); ?>/<?=$header[0]; ?>/">
<i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;<?=$header[1]; ?>
</a>
<?php endif; ?>
</div>
<div class="col-md-6 col-xs-12">
<?php if ($header=$tapinambur->getNextNews($article["date_time"])): ?>
<a class="direction" href="/article/<?=translit($header[1]); ?>/<?=$header[0]; ?>/">
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
<a href="/article/<?=translit($item['header']); ?>/<?=$item['id']; ?>/"><img src="<?=$item['cover_image']; ?>"></a>
<p class="date"><?=$item['date']; ?></p>
<p class="views"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;<?=$item['views']; ?></p>
</div>
<h2><a href="/article/<?=translit($item['header']); ?>/<?=$item['id']; ?>/"><?=$item['header']; ?></a></h2>
<p><?=$item['content']; ?></p>
</div>
<?php endforeach; ?>
</div>
<div id="disqus_thread"></div>
<script>(function(){var b=document,a=b.createElement("script");a.src="//http-www-tapinambur-com.disqus.com/embed.js";a.setAttribute("data-timestamp",+new Date());(b.head||b.body).appendChild(a)})();</script>
</div>
<script id="dsq-count-scr" src="//http-www-tapinambur-com.disqus.com/count.js" async></script>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/app/footer.php'); ?>
