<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);	
	if ($funcion=="1")
	{
		$dire=trim(utf8_decode($_POST["dire"]));
		$id_adu=trim(utf8_decode($_POST["id_adu"]));
		$sql1="select direccion from suc_aduanas

				where direccion='".$dire."' and 	id_aduana='".$id_adu."'";
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
		/*
		id_adu="+id_adu
						+"&"+"dire="+dire
						+"&"+"id_reg="+id_reg
						+"&"+"id_reg="+id_reg
						+"&"+"id_prov="+id_prov
						+"&"+"id_com="+id_com
						+"&"+"Fono="+Fono*/
		$id_adu=trim($_POST["id_adu"]);
		$dire=trim(utf8_decode($_POST["dire"]));
		$id_reg=trim($_POST["id_reg"]);
		$id_prov=trim($_POST["id_prov"]);
		$id_com=trim($_POST["id_com"]);
		$Fono=trim($_POST["Fono"]);
		try{
		
			$sql3="INSERT INTO suc_aduanas (direccion,region,provincia,comuna,fono,id_aduana)
					VALUES ('$dire','$id_reg','$id_prov','$id_com','$Fono','$id_adu')";
			$resultado=mysql_query($sql3,$conexion->link);
			echo "Sucursal de Aduana Ingresada Correctamente!";
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
?>