<?php
	include_once("clases/conexion.php");
	$conexion= new conexion();
	$usuario=$_POST["usuario"];   
	$password=$_POST["password_usuario"];
	$sql= mysql_query("SELECT * FROM usuarios WHERE usuario='$usuario' and id_estado=1");
	if($row = mysql_fetch_array($sql))
	{     
		if($row["password"] == $password)
		{
			session_start();  
			$_SESSION['usuario'] = $usuario;  
			$_SESSION['id_Usuario'] = $row["id_Usuario"];
			$_SESSION['id_tipo_usuario'] = $row["id_tipo_usuario"];
			$_SESSION['id_sector'] = $row["id_sector"];
			
			if(trim($row["clave_aprobacion_gerencia"]) == ""  && $row["id_sector"] == 1)
			{
				?>
					<script languaje="javascript">
						alert("Falta Su Clave de Aprobacion de Gerencia");
						location.href = "crear_clave_aprobacion.php";
					</script>
				<?php 
			}
			else
			{
				header("Location:principal.php");  
			}
		}
		else
		{
		?>
			<script languaje="javascript">
				alert("Contrasena Incorrecta");
				location.href = "index.php";
			</script>
		 <?php
		}
	}
	else
	{
		?>
			<script languaje="javascript">
				alert("El nombre de usuario es incorrecto");
				location.href = "index.php";
			</script>
		<?php   
	}

	mysql_free_result($resultado);
	mysql_close();
?>

