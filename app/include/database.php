<?php 
	$mysqli = false;

	function connectDB () {
		global $mysqli;
		$mysqli = new mysqli('localhost', 'root', '', 'tapinambur');
		$mysqli->query("SET NAMES 'utf8'");
	}

	function closeDB () {
		global $mysqli;
		$mysqli->close();
	}
    
    // if (mysqli_connect_errno($link)) {
    //     echo 'Error in the connection to the database ('.mysqli_connect_errno().') : '.mysqli_connect_error();
    // }
?>
    
    