<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);	
	if ($funcion=="1")
	{
		$Vendedor=trim($_POST["Vendedor"]);
		$sql1="select vendedor from vendedores
				where vendedor='".$Vendedor."'";
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
		$iniciales=trim($_POST["iniciales"]);
		$sql1="select iniciales from vendedores
				where iniciales='".$iniciales."'";
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
	else if ($funcion=="3")
	{	
		$Vendedor=trim($_POST["Vendedor"]);
		$iniciales=trim($_POST["iniciales"]);
		try{
				$sql3="INSERT INTO vendedores (vendedor,iniciales)
				VALUES ('$Vendedor','$iniciales')";
				$resultado=mysql_query($sql3,$conexion->link);
				echo "Vendedor Ingresado";
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
	}
	else if ($funcion=="4")
	{
		$Vendedor=trim($_POST["Vendedor"]);
		$id_vendedor=trim($_POST["id_vendedor"]);
		$sql1="select vendedor from vendedores
				where vendedor='".$Vendedor."' and id_vendedor <> ".$id_vendedor;
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
		$iniciales=trim($_POST["iniciales"]);
		$id_vendedor=trim($_POST["id_vendedor"]);
		$sql1="select vendedor from vendedores
				where iniciales='".$iniciales."' and id_vendedor <> ".$id_vendedor;
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
	else if ($funcion=="6")
	{
		$iniciales=trim($_POST["iniciales"]);
		$id_vendedor=trim($_POST["id_vendedor"]);
		$Vendedor=trim($_POST["Vendedor"]);
		try
		{
				$sql1="UPDATE vendedores	 
				set 		 
				Vendedor='".$Vendedor."',
				iniciales='".$iniciales."'
				where id_vendedor=".$id_vendedor;
				$resultado2=mysql_query($sql1,$conexion->link);
				echo "Vendedor Actualizado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}
	else if ($funcion=="7")
	{
		$id_vendedor=trim($_POST["id_vendedor"]);
 		try
		{
				$sql1="UPDATE vendedores	 
				set 		 
				habilitado='n'
				where id_vendedor=".$id_vendedor;
				$resultado2=mysql_query($sql1,$conexion->link);
				echo "Vendedor Borrado";
		}
			catch (Exception $e)
		{    
			 echo $e->getMessage();
		}
	}	
?>