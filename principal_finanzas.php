<?php
	session_start();
	if(!isset($_SESSION['usuario'])) 
	{
	  header('Location: index.php'); 
	  exit();
	}
	$user=($_SESSION['usuario']);
	$idUsuario=($_SESSION['id_Usuario']); 
	$id_tipo_usuario=($_SESSION['id_tipo_usuario']);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Principal</title>
		<link href="css/reset.css" rel="stylesheet" type="text/css" />
		<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
		<link href="css/est.css" rel="stylesheet" type="text/css" />
		<script src="js/jquery.js"></script>
	</head>
<body>
 <?php
	include_once("menu/menu_finanzas.php");
?> 
<div id="container">
</div>
<table class="table">
	<tr>
		<td colspan="2" height="39px;">
			<div class="menunav">
				<td height="100%">
    				<div class="body">   
						<div class="modulo widht_modulo_mid">
													
							</div>	
				    	</div>
					</div>
				</td>
			</div>
		</td>
	</tr>
</table>
</body>
</html>