<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_bodega=$_POST["id_bodega"];

	try{
			$sql1="UPDATE calidad	 
				set 		 
				aceptada='si'
				where id_bodega=".$id_bodega;

			$resultado2=mysql_query($sql1,$conexion->link);
	
			echo "Productos Aceptados";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		