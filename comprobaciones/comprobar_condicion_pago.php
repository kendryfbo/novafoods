<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);	
	if ($funcion=="1")
	{
		$Condicion=trim($_POST["Condicion"]);
		$sql1="select Condicion from condiciones_pago
				where Condicion='".$Condicion."'";
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
		$Condicion=trim(utf8_decode($_POST["Condicion"]));
		try{
				$sql3="INSERT INTO condiciones_pago (Condicion)
				VALUES ('$Condicion')";
				$resultado=mysql_query($sql3,$conexion->link);
				echo "Condicion de Pago Ingresada";
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
	}
	else if ($funcion=="3")
	{
		$id_condicion=trim($_POST["id_condicion"]);
 
		$sql1="select Condicion from condiciones_pago
				where id_condicion=".$id_condicion;
		$resultado=mysql_query($sql1,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);		
		echo utf8_encode($mensaje[0]);		
	}
	else if ($funcion=="4")
	{
		$Condicion=trim($_POST["Condicion"]);
		$id_condicion=trim($_POST["id_condicion"]);
		$sql1="select Condicion from condiciones_pago
				where Condicion='".utf8_encode($Condicion)."' and id_condicion <> ".$id_condicion;
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
	else if ($funcion=="5")
	{
		$Condicion=trim($_POST["Condicion"]);
		$id_condicion=trim($_POST["id_condicion"]);
		
		try
		{
			$sql1="UPDATE condiciones_pago	 
			set 		 
			Condicion='".utf8_decode($Condicion)."'			
			where id_condicion=".$id_condicion;
			$resultado2=mysql_query($sql1,$conexion->link);
			echo "Condicion de Pago Actualizada";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}
	else if ($funcion=="6")
	{
		$id_condicion=trim($_POST["id_condicion"]);
 		try
		{
				$sql1="UPDATE condiciones_pago	 
				set 		 
				habilitado='n'
				where id_condicion=".$id_condicion;
				$resultado2=mysql_query($sql1,$conexion->link);
				echo "Condicion de Pago Borrado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}
	
?>