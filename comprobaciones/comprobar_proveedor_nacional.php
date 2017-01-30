<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$rut=trim($_POST["rut"]);
 	$id_proveedor=trim($_POST["id_proveedor"]);
	$rut = str_replace(".", "", $rut);
        /*/echo$rut;
        $sql1="select rut from proveedor
		where rut='".$rut."'";
		$resultado=mysql_query($sql1,$conexion->link);
 		$mensaje=mysql_fetch_array($resultado);
		if ($mensaje[0]<>"")
		{

			echo "Error";
			return false;
                       //echo "0";

		}
		else
		{		
			echo $mensaje[0];
                        // echo "1";
		}/*
        */
	if ($id_proveedor<>"")
	{
		$sql1="select rut from proveedor
				where rut='".$rut."' and id_proveedor <> ".$id_proveedor;                
		$resultado=mysql_query($sql1,$conexion->link);
                echo $sql1;
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
		$sql1="select rut from proveedor
		where rut='".$rut."'";
                
		$resultado=mysql_query($sql1,$conexion->link);
 		$mensaje=mysql_fetch_array($resultado);
		if ($mensaje[0]<>"")
		{

			echo "Error";
			return false;

		}
		else
		{		
			echo $mensaje[0];
		}
	
	}	
?>	