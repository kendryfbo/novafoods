<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_marca=$_POST["id_marca"];
 	$marca=trim($_POST["marca"]);
	$id_familia=trim($_POST["id_familia"]);
	$ila=trim($_POST["ila"]);
	try{
			$sql1="UPDATE marcas	 
				set 		 
				marca='".utf8_decode($marca)."',
				id_familia='".$id_familia."',
				ILA='".$ila."'
				where id_marca=".$id_marca;
			$resultado2=mysql_query($sql1,$conexion->link);

			echo "Marca Actualizada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}


					
?>		