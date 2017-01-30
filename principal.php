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
<?php require_once 'menu/menu_gestion_paginas.php'; ?>   
<div id="container">
</div>
<table class="table">
	<tr>
		<td colspan="2" height="39px;">
			<div class="menunav">
				<td height="100%">
    				<div class="body">   
						<div class="modulo widht_modulo_mid">
							<div class="title"><p>Accesos Directos</p>
                                                        </div>
							<div class="content">
                                                            <br>
								<div class="access">
									  <a href="principal_desarrollo.php"><img src="img/iconos/desarrollo3.jpg"/>
									  </a>
									  <p>Desarrollo</p>
								</div>
                                                                <!--div class="access">
									  <a href="principal_gerencia.php"><img src="img/iconos/keynote_on.png"/>
									  </a>
									  <p>Gerencia</p>
								</div-->
								<div class="access">
									  <a href="principal_comercializacion.php"><img src="img/iconos/gold_bullion.png"/>
									  </a>
									  <p>Comercializacion</p>
								</div> 
								<div class="access">
									  <a href="principal_finanzas.php"><img src="img/iconos/line_chart.png"/>
									  </a>
									  <p>Finanzas</p>
								</div>  
								<div class="access">
									  <a href="principal_operaciones.php" ><img src="img/iconos/packing256.png" />
									  </a>
									  <p>Operaciones</p>
								</div>  
								<div class="access">
									  <a href="principal_calidad.php" ><img src="img/iconos/unit-completed256.png" />
									  </a>
									  <p>Calidad</p>
								</div>  
								<div class="access">
									  <a href="#" ><img src="img/iconos/table_colums.png" />
									  </a>
									  <p>Informes</p>
								</div>  
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