<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_familia=$_POST["id_familia"];
 	
	try{
			$sql1="UPDATE familias	 
				set 		 
				habilitado='n'
				where id_familia=".$id_familia;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Familia Borrada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		