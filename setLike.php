<?php 
	require_once 'app/include/function.php';

	$value = $_POST['value'];
	$type = $_POST['type'];
	$id = $_POST['id'];

	setLike($value, $type, $id);
?>