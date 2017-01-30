<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_sabor=$_POST["id_sabor"];
 	
	try{
			$sql1="UPDATE sabores	 
				set 		 
				habilitado='n'
				where id_sabor=".$id_sabor;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Sabor Borrado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		