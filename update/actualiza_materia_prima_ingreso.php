<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_calidad=$_POST["id_calidad"];
	 try{
				$sql1="UPDATE calidad	 
				set 		 
				imprimido='si'
				where id_bodega=".$id_calidad;
				$resultado2=mysql_query($sql1,$conexion->link);
				echo "Material Listo Para ser Ingresado en Bodega";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>