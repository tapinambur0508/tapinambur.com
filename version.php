<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/app/include/function.php');
$tapinambur=new tapinambur();
$title='Історія версій | tapinambur'; 
$style_less='system-style.less'; 
include_once($_SERVER['DOCUMENT_ROOT'].'/app/header.php'); 
?>
<div id="myContainer">
<h1>Історія версій</h1>
<h2>Версія 1.2 від 19 березня 2017</h2>
<p>Дякуємо, що читаєте наш сайт. Для кращого перегляду контенту ми виправили деякі помилки в роботі сайту та трохи змінили його дизайн</p>
<h2>Версія 1.1 від 14 січня 2017</h2>
<p>Дякуємо, що читаєте наш сайт. Для кращого перегляду контенту ми виправили деякі помилки в роботі сайту</p>
<h2>Версія 1.0.2 від 6 січня 2017</h2>
<p>Виправлена помилка з нерівномірною висотою колонок. Також виправлені дрібні проблеми. Предрелізна версія</p>
<h2>Версія 1.0.1 від 4 січня 2017</h2>
<p>Виправлені помилки</p>
<h2>Версія 1.0 від 3 грудня 2016</h2>
<p>Початкова версія сайту</p>
<hr noshade size="2">
<h3>Якщо маєте якісь побажання щодо проекту, поділіться ними у коментарях</h3>
<div id="disqus_thread"></div>
<script>(function(){var b=document,a=b.createElement("script");a.src="//http-www-tapinambur-com.disqus.com/embed.js";a.setAttribute("data-timestamp",+new Date());(b.head||b.body).appendChild(a)})();</script>
</div>
<script id="dsq-count-scr" src="//http-www-tapinambur-com.disqus.com/count.js" async></script>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/app/footer.php'); ?>