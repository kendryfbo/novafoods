<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_cargo=$_POST["id_cargo"];
 	
	try{
			$sql1="UPDATE cargos	 
				set 		 
				habilitado='n'
				where id_cargo=".$id_cargo;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Cargo Borrado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		