<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$idioma=$_POST["idioma"];
 	$id_idioma=trim($_POST["id_idioma"]);
	
	try{
			$sql1="UPDATE idiomas	 
				set 		 
				idioma='".utf8_decode($idioma)."'
				where id_idioma=".$id_idioma;

			$resultado2=mysql_query($sql1,$conexion->link);
	
			echo "Idioma Actualizado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		