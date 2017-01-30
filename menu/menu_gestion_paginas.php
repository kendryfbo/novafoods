<?php
	include_once("clases/conexion.php"); 
	if(!isset($_SESSION))
	{ 
		session_start();
	} 
	$usuario=($_SESSION['usuario']);
	$id_usuario=($_SESSION['id_Usuario']); 
	$id_tipo_usuario=($_SESSION['id_tipo_usuario']);
	$id_sector=($_SESSION['id_sector']);
 ?>	
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Nova Food</title>
	<meta charset="utf-8" />
	<link href="css/estilo3.css" rel="stylesheet" type="text/css" />
</head> 
<body>
<div class="menunav">
	<div class="name fleft"> 
		<a href="principal.php">Bienvenido <strong><?php echo $usuario; ?></strong></a>
	</div>
	<div class="colorNav fright">
		<?php if ($id_tipo_usuario==1 )
		{
		?>
		<ul>
			<li>
				<a href="#"><img src="img/icn_settings.png" width="19" height="19" />
				</a>
				 <ul>
					<li>
						<a href="listado_usuarios.php">Gestionar Paginas
						</a>
					</li>
						<?php if ($id_sector==1 )
						{
						?>
							<li>
								<a href="cambio_clave_aprobacion.php">Cambio Clave de Aprobacion	
								</a>
							</li>
						<?php
						}
						?>
					<!--<li>
						<a href="admin_usuarios_clave.php">Gestionar claves de usuario	
						</a>
					</li>-->
				 </ul>
			</li>
		<?php
		}
		?>
 				<!-- <li>
					<a href="principal_datos.php" ><img src="img/icn_person.png" width="22" height="22" />
					</a>
				</li>
				<li>
					<a href="principal_clave.php" ><img src="img/icn_gear.png" width="22" height="22" />
					</a>
				</li>-->
				<li>
					<a href="logout.php" ><img src="img/icn_logout.png" width="19" height="19" />
					</a>
				</li>
			</ul>
		</div>
	</div>
</body>
</html>