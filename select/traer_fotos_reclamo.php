<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_reclamo=trim($_POST["id_reclamo"]);
	$sql="SELECT nombre_imagen,id_imagen FROM imagenes_reclamos WHERE id_reclamo=".$id_reclamo;
	$resultado=mysql_query($sql,$conexion->link);

	while ($fila = mysql_fetch_array($resultado))
	{
		echo "<tr id=".$fila[1].">
				<td>
					<img src=imagenes/".utf8_encode($fila[0])." width='300' height='300'>					 
				</td>
				<td>
					<input type='button' value='Eliminar'  onClick='$(this).eliminar_imagen_reclamo(".$fila[1].");' >
				</td>
			</tr>";	
			
	}
	 
 
?>