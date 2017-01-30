<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$sabor_ing=trim($_POST["sabor_ing"]);
	$id_sabor=trim($_POST["id_sabor"]);
 
	
	if ($id_sabor<>"")
	{
		
		$sql1="select sabor_ingles from sabores
				where sabor_ingles='".utf8_decode($sabor_ing)."' and id_sabor <> ".$id_sabor;
		$resultado=mysql_query($sql1,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		
		if ($mensaje[0]<>"")
		{

			echo "Error";
			return false;

		}
		else
		{
				echo "Ok";
		}
	}
	else
	{
		$sql1="select sabor_ingles from sabores
		where sabor_ingles='".utf8_decode($sabor_ing)."'";
		$resultado=mysql_query($sql1,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);

		if ($mensaje[0]<>"")
		{

			echo "Error";
			return false;

		}
		else
		{
		
				echo "Ok";
		}
	
	}
?>