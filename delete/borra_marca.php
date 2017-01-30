<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_marca=$_POST["id_marca"];
 	
	try{
			$sql1="UPDATE marcas	 
				set 		 
				habilitado='n'
				where id_marca=".$id_marca;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Marca Borrada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		