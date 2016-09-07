<?php 
	require_once 'app/include/function.php';

    $href = $_POST['href'];
	$pos = $_POST['pos'];
	$count = $_POST['count'];

	$publication = getPublicationNews($href, $pos, $count);

	echo json_encode($publication);
?>