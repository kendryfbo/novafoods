<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_color=$_POST["id_color"];
 	
	try{
			$sql1="UPDATE colores	 
				set 		 
				habilitado='n'
				where id_color=".$id_color;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Color Borrado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		