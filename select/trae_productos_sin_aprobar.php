<?php	 
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$fecha=date("y-m-d H:i:s");  
	$numero_orden=trim($_POST["numero_orden"]);

 
   try{	
		
		$sql2="select
				calidad.id_bodega,
				productos.nombre_producto,
				calidad.cantidad
				from calidad
				inner join productos on productos.id_producto=calidad.id_producto	
				WHERE calidad.numero_orden_compra =".$numero_orden. " and calidad.aceptada <> 'si'";
				
		$resultado2=mysql_query($sql2,$conexion->link);
			echo	"<thead><tr>";
			echo	"<th width='100'>Producto</th>";
			echo    "<th>Recepcionado</th>";
			echo	"</tr></thead>";
												
 		while ($mensaje2=mysql_fetch_array($resultado2))
		{	 					
				echo	"<tbody>";
				echo	"<tr id=".$mensaje2[0].">";
				echo	"<td>".utf8_encode($mensaje2[1])."</td>";
				echo	"<td>".$mensaje2[2]."</td>";
				 
				echo	"</tr>";
				echo	"</tbody>";
		}
  		 
	}
	catch (Exception $e)
	{    
	 echo $e->getMessage();
	}


					
?>	