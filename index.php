<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 	<title>Sistema Novafoods</title> 
 	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="body">
	<div class="modulo widht_modulo">
		<div class="title"><p>Inicio de Sesion</p>
		</div>
		<div class="content">
			<form action="validar_usuario.php" method="post">
				<table class="tableform">
					<tr>	
						<td colspan="3">
							<div class="img">
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<label>Usuario</label>
						</td>
						<td colspan="2">
							<input type="text" name="usuario" placeholder="Nombre de usuario" required=""/>
						</td>
					</tr>
					<tr>
						<td>
							<label>Contrase&ntilde;a</label>
						</td>
						<td colspan="2">
							<input type="password" name="password_usuario"  placeholder="contrasena" required=""/>
						</td>
					</tr>
					<td>
					</td>
					<td >
						<input type="submit" value="Ingresar" />
					</td>
						<!--	<td>
							<a href="#" ><input name="iniciar" type="submit" type="button"  id="recup" value="Recuperar Password" /></a>
						</td>-->
					
				</table>
			</form>
		</div>
	</div>
 </div>         
</body>
</html>