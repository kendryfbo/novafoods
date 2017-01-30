<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_banco=$_POST["id_banco"];
 	
	try{
			$sql1="UPDATE bancos	 
				set 		 
				habilitado='n'
				where id_banco=".$id_banco;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Banco Borrado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		