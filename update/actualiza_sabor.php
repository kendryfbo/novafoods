<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	
	$sabor_esp=$_POST["sabor_esp"];
	$sabor_ing=$_POST["sabor_ing"];
 	$id_sabor=trim($_POST["id_sabor"]);
	
	try{
			$sql1="UPDATE sabores	 
				set 		 
				sabor_espanol='".utf8_decode($sabor_esp)."',
				sabor_ingles='".utf8_decode($sabor_ing)."'
				where id_sabor=".$id_sabor;
			$resultado2=mysql_query($sql1,$conexion->link);
			
			echo "Sabor Actualizado";
	
		 
	}
		catch (Exception $e)
	{    
		echo $e->getMessage();
	}


					
?>	