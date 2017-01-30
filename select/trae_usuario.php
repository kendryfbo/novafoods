<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	
	$id_usuario_modificar=$_GET["id_usuario_modificar"];
 	
 	$sql1="select
			usuarios.rut,
			usuarios.usuario,
			usuarios.nombre,
			usuarios.apellido,
			usuarios.Email,
			usuarios.password,
			tipo_usuarios.tipo_usuario,
			sector.sector
			from usuarios
			inner join tipo_usuarios on tipo_usuarios.id_tipo_usuario=usuarios.id_tipo_usuario
			inner join sector on sector.id_sector=usuarios.id_sector
			where usuarios.id_Usuario='".$id_usuario_modificar."'";

	$ejecuta=mysql_query($sql1,$conexion->link);

	while ($fila = mysql_fetch_array($ejecuta))
	{
				
		$salida[]=array("rut"=>$fila[0],"usuario"=>$fila[1],"nombre"=>$fila[2],"clave"=>$fila[5],"apellido"=>$fila[3],"email"=>$fila[4]
			,"tipo_usuario"=>$fila[6],"sector"=>$fila[7]);
	}
		echo json_encode($salida);
	 
	
 
							
 

					
?>	
  
					 
						