<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_idioma=$_POST["id_idioma"];
 	
	try{
			$sql1="UPDATE idiomas	 
				set 		 
				habilitado='n'
				where id_idioma=".$id_idioma;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Idioma Borrado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		