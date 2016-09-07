<?php 
	require_once 'app/include/function.php';

	$login = $_POST['login'];

	$result = checkLogin($login);

	echo ($result);
?> 