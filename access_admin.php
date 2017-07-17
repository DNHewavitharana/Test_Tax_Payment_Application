<?php
	session_start();
	if (empty($_SESSION['user_id']) || $_SESSION['access_level']!='Admin'){
		$_SESSION['error'] = 'Please login first';
		header("Location: Login.php");
	}else {
		$first_name = $_SESSION['first_name'];
		$last_name = $_SESSION['last_name'];
	}	
?>