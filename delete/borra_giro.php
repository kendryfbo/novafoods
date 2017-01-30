<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_giro=$_POST["id_giro"];
 	
	try{
			$sql1="UPDATE giros	 
				set 		 
				habilitado='n'
				where id_giro=".$id_giro;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Giro Borrado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		