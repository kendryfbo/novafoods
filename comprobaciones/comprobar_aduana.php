<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);	
	if ($funcion=="1")
	{
		$Aduana=trim(utf8_decode($_POST["Aduana"]));
		$sql1="select nombre_aduana from aduanas
				where nombre_aduana='".$Aduana."'";
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
	else if ($funcion=="2")
	{	
		$Fono=trim($_POST["Fono"]);
		$Ciudad=trim(utf8_decode($_POST["Ciudad"]));
		$direccion=trim(utf8_decode($_POST["direccion"]));
		$rut_aduana=trim($_POST["rut_aduana"]);
		$Aduana=trim(utf8_decode($_POST["Aduana"]));
		try{
		
			$sql3="INSERT INTO aduanas (nombre_aduana,rut)
					VALUES ('$Aduana','$rut_aduana')";
			$resultado=mysql_query($sql3,$conexion->link);
			echo "Aduana Ingresada";
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
 		
	}
	else if ($funcion=="3")
	{	
		$id_aduana=trim(utf8_decode($_POST["id_aduana"]));
		$Aduana=trim(utf8_decode($_POST["Aduana"]));
		$sql1="select nombre_aduana from aduanas
				where nombre_aduana='".$Aduana."' and id_aduana <> ".$id_aduana;
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
	else if ($funcion=="4")
	{
		$Fono=trim($_POST["Fono"]);
		$Ciudad=trim(utf8_decode($_POST["Ciudad"]));
		$direccion=trim(utf8_decode($_POST["direccion"]));
		$rut_aduana=trim($_POST["rut_aduana"]);
		$Aduana=trim(utf8_decode($_POST["Aduana"]));
		$id_aduana=trim(utf8_decode($_POST["id_aduana"]));
		try
		{
				$sql1="UPDATE aduanas	 
				set 		 
				nombre_aduana='".$Aduana."',
				rut='".$rut_aduana."',
				direccion='".$direccion."',
				fono='".$Fono."',
				ciudad='".$Ciudad."'
				where id_aduana=".$id_aduana;
				$resultado2=mysql_query($sql1,$conexion->link);
				echo "Aduana Actualizada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}
	else if ($funcion=="5")
	{
		$id_aduana=trim(utf8_decode($_POST["id_aduana"]));
		try
		{
				$sql1="UPDATE aduanas	 
				set 			 
				habilitado='n'
				where id_aduana=".$id_aduana;
				$resultado2=mysql_query($sql1,$conexion->link);
				echo "Aduana Eliminada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}
        else if ($funcion=="6")
	{
		$id_suc_aduana=trim(utf8_decode($_POST["id_suc_aduana"]));
		try
		{
				$sql1="delete from suc_aduanas where id_suc_aduanas=".$id_suc_aduana;
				$resultado2=mysql_query($sql1,$conexion->link);
				echo "Sucursal de Aduana Eliminada ";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}
?>