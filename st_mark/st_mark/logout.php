<?php 
	echo '<script>alert("LOGOUT")</script>';
	session_start();
	$_SESSION["id"] = "";
	session_destroy();
	header('location: index.php');
?>