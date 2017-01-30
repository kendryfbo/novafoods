<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$numero_pallet=trim($_POST["numero_pallet"]);
	$fecha_produccion=trim($_POST["fecha_produccion"]);
	$turno=trim($_POST["turno"]);
	$unidades_producidas=trim($_POST["unidades_producidas"]);
	$unidades_rechazadas=trim($_POST["unidades_rechazadas"]);
	$id_producto=trim($_POST["id_producto"]);
	$fecha_vencimiento=trim($_POST["fecha_vencimiento"]);
	$maq=trim($_POST["maq"]);
	$oper=trim($_POST["oper"]);
	$cod=trim($_POST["cod"]);
	$batch=trim($_POST["batch"]);
	$lote=trim($_POST["lote"]);
	$idUsuario=trim($_POST["idUsuario"]);
	$fecha_vencimiento_2=date("Y-m-d",strtotime($fecha_vencimiento));
	$fecha_produccion_2=date("Y-m-d",strtotime($fecha_produccion));
	
	try
	{
				$sql3="INSERT INTO produccion (numero_pallet,fecha_produccion,turno,id_producto,unidades_producidas,unidades_rechazadas,
				lote,fecha_vencimiento,maquina,operario,codigo,batch,usuario)
				VALUES ('$numero_pallet','$fecha_produccion_2','$turno','$id_producto','$unidades_producidas','$unidades_rechazadas','$lote','$fecha_vencimiento_2','$maq','$oper','$cod','$batch','$idUsuario')";
				$resultado=mysql_query($sql3,$conexion->link);
				$valor=mysql_insert_id();
				if ($valor<>"")
				{	
					echo "ok";					
				}
				else
				{
					echo "Error";	
				}
	}
		catch (Exception $e)
	{    
		echo $e->getMessage();
	}
?>