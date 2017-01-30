<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_cliente_nac=$_POST["id_cliente_nac"];
 	
	try{
			$sql1="UPDATE cliente_nacional	 
				set 		 
				habilitado='n'
				where id_cliente=".$id_cliente_nac;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Cliente Borrado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		