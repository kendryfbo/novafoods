<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_genero=$_POST["id_genero"];
 	
	try{
			$sql1="UPDATE generos	 
				set 		 
				habilitado='n'
				where id_genero=".$id_genero;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Genero Borrado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		