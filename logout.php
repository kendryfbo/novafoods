<?php 
	 session_start();
	 $_SESSION = array();

	 session_destroy();
	 //Redireccionar a login.php
	 header("location: index.php");
?>