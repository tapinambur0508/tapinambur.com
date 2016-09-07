<?php 
	require_once 'app/include/function.php';

	$email = $_POST['email'];

	$result = checkEmail($email);

	echo ($result);
?> 