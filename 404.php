<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/app/include/function.php');
$tapinambur = new tapinambur();
$title='404 | tapinambur'; 
$style_less='system-style.less'; 
include_once($_SERVER['DOCUMENT_ROOT'].'/app/header.php'); ?>
<div id="myContainer">
<h1><font color="#fb3f4c">404</font></h1>
<h1>Сторінка не знайдена</h1>
<p>Можливо, ця сторінка була видалена або допущена помилка в адресі</p>
<h3><a href="/">Перейти на головну сторінку</a></h3>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/app/footer.php'); ?>