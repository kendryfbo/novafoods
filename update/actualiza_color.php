<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_color=$_POST["id_color"];
 	$color=trim($_POST["color"]);
	
	 try{
				$sql1="UPDATE colores	 
				set 		 
				color='".$color."'
				where id_color=".$id_color;
				$resultado2=mysql_query($sql1,$conexion->link);
				echo "Color Actualizado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>	