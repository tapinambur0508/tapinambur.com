<?php 
	if (isset($_POST["id"]) && isset($_POST["full_content"])) {
		include_once($_SERVER['DOCUMENT_ROOT'].'/app/include/function.php'); 
		echo($tapinambur->needToUpdateArticle($_POST["id"], $_POST["full_content"]));
	}
?>