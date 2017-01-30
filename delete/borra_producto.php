<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_producto=$_POST["id_producto"];
 	
	try{
			$sql1="UPDATE productos	 
				set 		 
				habilitado='n'
				where id_producto=".$id_producto;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Producto Borrado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		