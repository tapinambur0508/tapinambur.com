<?php 
	if (isset($_POST["pos"]) && isset($_POST["count"])) {
		include_once($_SERVER['DOCUMENT_ROOT'].'/app/include/function.php');

		if ($_POST["href"]) {
			echo(json_encode($tapinambur->getPublication($_POST['href'], $_POST["pos"], $_POST["count"])));
		} else {
			echo(json_encode($tapinambur->getNews($_POST["pos"], $_POST["count"])));	
		}	
	}
?>