<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
 	$funcion=trim($_GET["funcion"]);
	require_once("../fpdf/fpdf.php");

	if ($funcion==1)
	{ 
		$numero=trim($_GET["numero"]);
		$sql="select numero_factura
		from facturas
		where numero_factura=".$numero;
		$resultado=mysql_query($sql,$conexion->link);
		$numero_filas = mysql_num_rows($resultado);
		if ($numero_filas==0)
		{
			echo "1";	
		}
		else
		{
			echo "2";
		}	 
	}
	else if ($funcion==2)
	{ 
		$numero=trim($_GET["numero"]);
		$sql="select Numero_nota_venta
		from nota_venta
		where Numero_nota_venta=".$numero." and ingresada='Si' and aceptada='Si' and rechazada='' ";
		$resultado=mysql_query($sql,$conexion->link);
		$numero_filas = mysql_num_rows($resultado);
		if ($numero_filas==0)
		{
			echo "1";	
		}
		else
		{
			echo "2";
		}
	}
	else if ($funcion==3)
	{ 
		$numero=trim($_GET["numero"]);
		$sql="select numero_factura
		from factura_internacional
		where numero_factura=".$numero;
		$resultado=mysql_query($sql,$conexion->link);
		$numero_filas = mysql_num_rows($resultado);
		if ($numero_filas==0)
		{
			echo "1";	
		}
		else
		{
			echo "2";
		}
	}
	else if ($funcion==4)
	{ 
		$numero=trim($_GET["numero"]);
		$sql="select numero_proforma
		from proforma
		where numero_proforma=".$numero." and ingresada='Si' and aceptada='Si' and rechazada='' " ;
		$resultado=mysql_query($sql,$conexion->link);
		$numero_filas = mysql_num_rows($resultado);
		if ($numero_filas==0)
		{
			echo "1";	
		}
		else
		{
			echo "2";
		}
	 }
?>
