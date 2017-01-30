<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_genero=$_POST["id_genero"];
 	$genero=trim($_POST["genero"]);
	
	 try{
			$sql1="UPDATE generos	 
			set 		 
			genero='".$genero."'
			where id_genero=".$id_genero;
			$resultado2=mysql_query($sql1,$conexion->link);
			echo "Genero Actualizado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>	