<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_subfamilia=$_POST["id_subfamilia"];
 	
	try{
			$sql1="UPDATE sub_familias	 
				set 		 
				habilitado='n'
				where id_subfamilia=".$id_subfamilia;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Subfamilia Borrada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		