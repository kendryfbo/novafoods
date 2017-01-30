<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);	
	if ($funcion=="1")
	{
		$canal=trim($_POST["canal"]);
		$sql1="select canales from canal
				where canal='".$canal."'";
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
		//$canal=trim(utf8_decode($_POST["canal"]));
                $canal=trim($_POST["canal"]);
                $desc=trim($_POST["desc"]);
                //echo $canal;
                //echo $desc;
                mysql_query("SET NAMES 'utf8'");		
                $sql3="INSERT INTO canal (canal,Desc)
				VALUES ('$canal','$desc')";
				$resultado=mysql_query($sql3,$conexion->link);
                                echo $sql3;
				echo "Canal Ingresado";
		/*try{
				$sql3="INSERT INTO canal (canal,Desc)
				VALUES ('$canal','$desc')";
				$resultado=mysql_query($sql3,$conexion->link);
				echo "Canal Ingresado";
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}*/
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
				$sql1="UPDATE canales	 
				set 		 
				habilitado='n'
				where id_canal=".$id_condicion;
				$resultado2=mysql_query($sql1,$conexion->link);
				echo "Canal Borrado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}
	
?>