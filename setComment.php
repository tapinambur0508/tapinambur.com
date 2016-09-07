<?php 
	require_once 'app/include/function.php';

	$article_id = $_POST['article_id'];
	$user_id = $_POST['user_id'];
	$message = $_POST['message'];

	setComment($article_id, $user_id, $message);

	echo (date('d-m-Y H:i:s a'));
?> 