<?php 
	require_once 'app/include/function.php';

	$pos = $_POST['pos'];
	$count = $_POST['count'];

	$news = getNews($pos, $count);

	echo json_encode($news);
?>