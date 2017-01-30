<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$id_pedido=$_POST["id_pedido"];
 	$cantidad=trim($_POST["cantidad"]);
	$fecha=date("y-m-d H:i:s");
 	$numero_documento=trim($_POST["numero_documento"]);
	$id_tipo_documento=trim($_POST["id_tipo_documento"]);
	$numero_orden_compra=trim($_POST["numero_orden_compra"]);	
	$observacion=trim($_POST["observacion"]);	
	$cantidad_pallet=trim($_POST["cantidad_pallet"]);
	$id_posicion=trim($_POST["id_posicion"]);
try{
	
							$sql13="UPDATE veredas	 
							set 		 
							id_estado_vereda=2
							where id=".$id_posicion;
							$resultado13=mysql_query($sql13,$conexion->link);
							echo $sql13;

	}
		catch (Exception $e)
	{    
		 echo $e->getMessage();
	}


					
?>