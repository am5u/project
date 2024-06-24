<?php 
	echo '<script>alert("وداعــــــــــــاً")</script>';
	session_start();
	$_SESSION["id"] = "";
	session_destroy();
	header('location:../view/home.php');
?>