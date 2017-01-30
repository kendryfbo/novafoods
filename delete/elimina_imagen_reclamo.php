<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_imagen=trim($_POST["id_imagen"]);
 
	try{	
			$sql="SELECT nombre_imagen FROM imagenes_reclamos WHERE id_imagen=".$id_imagen;
			$resultado=mysql_query($sql,$conexion->link);
			if ($fila = mysql_fetch_array($resultado))
			{
			 
				unlink("../imagenes/".$fila[0]);
			}
			$sql1="DELETE FROM imagenes_reclamos	
			WHERE id_imagen=".$id_imagen;
			$resultado1=mysql_query($sql1,$conexion->link);
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}

 	
	
	 
	 
 
?>