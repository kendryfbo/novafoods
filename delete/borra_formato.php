<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_formato=$_POST["id_formato"];
 	
	try{
			$sql1="UPDATE formatos	 
				set 		 
				habilitado='n'
				where id_formato=".$id_formato;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Formato Borrado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		