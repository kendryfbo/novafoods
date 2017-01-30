<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_talla=$_POST["id_talla"];
 	
	try{
			$sql1="UPDATE tallas	 
				set 		 
				habilitado='n'
				where id_talla=".$id_talla;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Talla Borrada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		