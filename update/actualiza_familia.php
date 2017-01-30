<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	
	$familia=$_POST["familia"];
	$cod_familia=$_POST["cod_familia"];
 	$id_familia=trim($_POST["id_familia"]);
	
	try{
			$sql1="UPDATE familias	 
				set 		 
				codigo_familia='".utf8_decode($cod_familia)."',
				familia='".utf8_decode($familia)."'
				where id_familia=".$id_familia;
			$resultado2=mysql_query($sql1,$conexion->link);
			echo "Familia Actualizada";
	
		 
	}
		catch (Exception $e)
	{    
		echo $e->getMessage();
	}


					
?>	