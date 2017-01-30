<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_proveedor=$_POST["id_proveedor"];
 	
	try{
			$sql1="UPDATE proveedor	 
				set 		 
				habilitado='n'
				where id_proveedor=".$id_proveedor;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Proveedor Borrado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		