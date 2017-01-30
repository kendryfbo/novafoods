<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
 	$funcion=trim($_POST["funcion"]);
	if ($funcion==1)
	{
		$numero_nota_venta=trim($_POST["numero_nota_venta"]);
		$sql="select sum(total) as suma
			from temporal_detalle_nota_venta
			where numero_nota_venta=".$numero_nota_venta;
				
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		if ($mensaje[0]=="")
		{
			echo "0";
		}
		else
		{
			echo  trim($mensaje[0]);
		}
	}
	else if ($funcion==2)
	{
		$numero_nota_venta=trim($_POST["numero_nota_venta"]);
		$sql="select temporal_detalle_nota_venta.id_producto
			from temporal_detalle_nota_venta
			inner join productos on productos.id_producto=temporal_detalle_nota_venta.id_producto
			inner join marcas on marcas.id_marca=productos.id_marca
			where temporal_detalle_nota_venta.numero_nota_venta='".$numero_nota_venta."' and marcas.ILA='SI' " ;
				
		$resultado=mysql_query($sql,$conexion->link);
		while ($mensaje=mysql_fetch_array($resultado))
		{		
			$sql1="select sum(total) as suma
			from temporal_detalle_nota_venta
			where id_producto=".$mensaje[0]. " and  numero_nota_venta=".$numero_nota_venta;					
			$resultado1=mysql_query($sql1,$conexion->link);
			$mensaje1=mysql_fetch_array($resultado1);
			
			$sql="select  cantidad
			from tabla_impuestos_ventas
			where tipo='ila' ";					
			$resultado=mysql_query($sql,$conexion->link);
			$mensaje=mysql_fetch_array($resultado);
			$ila=($mensaje1[0]*$mensaje[0])/100;
			echo $ila;
		}
	}
	else if ($funcion==3)
	{
		$id_usuario=trim($_POST["id_usuario"]);
                //$numero_nota_venta=trim($_POST["numero_nota_venta"]);
		$sql="select sum(total) as suma
			from temporal_det_oc
			where id_usuario=".$id_usuario;
				
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		if ($mensaje[0]=="")
		{
			echo "0";
		}
		else
		{
			echo  $mensaje[0];
                        //echo number_format($mensaje[0]);
		}
	}
        else if ($funcion==31)
	{
		$numero_oc=trim($_POST["numero_oc"]);
                //$numero_nota_venta=trim($_POST["numero_nota_venta"]);
		$sql="select sum(total) as suma
			from detalle_oc
			where id_oc=".$numero_oc;
				
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		if ($mensaje[0]=="")
		{
			echo "0";
		}
		else
		{
			echo  $mensaje[0];
                        //echo number_format($mensaje[0]);
		}
	}
	else if ($funcion==4)
	{
		$id_usuario=trim($_POST["id_usuario"]);
                //$numero_nota_venta=trim($_POST["numero_nota_venta"]);
		$sql="select sum(ila) as suma
			from temporal_detalle_nota_venta
			where id_usuario=".$id_usuario;
				
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		if ($mensaje[0]=="")
		{
			echo "0";
		}
		else
		{
			echo  $mensaje[0];
                        //echo number_format($mensaje[0]);
		}
	}
	else if ($funcion==5)
	{
		$numero_oc=trim($_POST["numero_oc"]);
                //$numero_nota_venta=trim($_POST["numero_nota_venta"]);
		$sql="select sum(total) as suma
			from detalle_oc
			where id_oc=".$numero_oc;
				
		$resultado=mysql_query($sql,$conexion->link);
		$mensaje=mysql_fetch_array($resultado);
		if ($mensaje[0]=="")
		{
			echo "0";
		}
		else
		{
			echo  $mensaje[0];
                        //echo number_format($mensaje[0]);
		}
	}
 			
?>	