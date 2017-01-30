<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_formato=$_POST["id_formato"];
 	$formato=trim($_POST["formato"]);
	
	try{
			$sql1="UPDATE formatos	 
				set 		 
				formato='".utf8_decode($formato)."'
				where id_formato=".$id_formato;

			$resultado2=mysql_query($sql1,$conexion->link);
	
			echo "Formato Actualizado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		