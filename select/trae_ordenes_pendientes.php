<?php	 
	include_once("../clases/conexion.php");
	$conexion=new conexion();
	$id_proveedor=$_POST["id_proveedor"];


		$sql="select 
		DATE_FORMAT(fecha_orden_compra, '%d/%m/%y') as fecha,
		numero_orden_compra
		from orden_compra 
		where id_proveedor=".$id_proveedor. " and id_estado_orden_compra=5  and id_area<>2";
		$ejecuta=mysql_query($sql,$conexion->link);
		$número_filas = mysql_num_rows($ejecuta);
	if ($número_filas<>0)
	{  
		echo "<select id='ordenes_compra'>";
		echo "<option value='' selected>Seleccione Orden de Compra</option>";
		while ($fila = mysql_fetch_array($ejecuta))
		{	
			echo "<option id=".$fila[1]." value=".$fila[1].">".$fila[1]."</option>";
		}
			echo "</select>";
		echo  "<div id='valida-orden_compra' style='display:none' class='errores'>Debe Ingresar Orden de Compra</div>"; 
	}
	else
	{
		echo "Error";		
	}

?>