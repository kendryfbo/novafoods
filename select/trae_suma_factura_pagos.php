<?php
	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
	$funcion=$_POST["funcion"];
	
	if ($funcion==1)
	{
		$id_cliente=$_POST["id_cliente"];
		$sql1="SELECT IFNULL((SELECT SUM(total) FROM facturas WHERE id_cliente ='".$id_cliente."'),0) AS suma_bod";
		$ejecuta=mysql_query($sql1,$conexion->link);
		while ($fila = mysql_fetch_array($ejecuta))
		{
			echo $fila[0];
		}		
	}
	else if ($funcion==2)
	{
		$id_cliente=$_POST["id_cliente"];
		$sql2="SELECT credito_maximo  FROM cliente_internacional WHERE id_cliente =".$id_cliente;
		$ejecuta2=mysql_query($sql2,$conexion->link);
		while ($fila2 = mysql_fetch_array($ejecuta2))
		{
			$sql="SELECT IFNULL((SELECT SUM(total) FROM factura_internacional WHERE id_cliente ='".$id_cliente."'),0) AS suma_bod";
			$ejecuta=mysql_query($sql,$conexion->link);
			while ($fila = mysql_fetch_array($ejecuta))
			{
				$sql1="SELECT IFNULL((SELECT SUM(monto_deposito)FROM pagos_internacionales WHERE id_cliente ='".$id_cliente."'),0) AS suma_bod";
				$ejecuta1=mysql_query($sql1,$conexion->link);
				while ($fila1 = mysql_fetch_array($ejecuta1))
				{
					$credito=$fila2[0];
					$facturas=$fila[0]*-1;
					$pagos=$fila1[0];
					$credito=$pagos+$credito;
					$total=$credito+$facturas;
					echo $total;
				}
			}
		}
	}
?>