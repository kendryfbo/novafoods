<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_cliente_int=$_POST["id_cliente_int"];
 	
	try{
			$sql1="delete from cliente where id_cliente=".$id_cliente_int;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Cliente Borrado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		