<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id=$_POST["id"];
 	$batch=trim($_POST["batch"]);
	$caja=trim($_POST["caja"]);
	$unidad=trim($_POST["unidad"]);

	try{
			$sql1="UPDATE formulas	 
				set 		 
				batch='".($batch)."',
				caja='".($caja)."',
				unidad='".($unidad)."'
				where id=".$id;

			$resultado2=mysql_query($sql1,$conexion->link);
			echo $sql1;
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		