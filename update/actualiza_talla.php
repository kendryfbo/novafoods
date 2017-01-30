<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_talla=$_POST["id_talla"];
 	$talla=trim($_POST["talla"]);
	
	 try{
				$sql1="UPDATE tallas	 
				set 		 
				talla='".$talla."'
				where id_talla=".$id_talla;
				$resultado2=mysql_query($sql1,$conexion->link);
				echo "Talla Actualizada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>	