<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_umed=$_POST["id_umed"];
 	
	try{
			$sql1="UPDATE umed	 
				set 		 
				habilitado='n'
				where id_umed=".$id_umed;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Unidad Borrada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		