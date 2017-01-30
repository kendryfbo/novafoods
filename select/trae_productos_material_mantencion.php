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
				WHERE calidad.numero_orden_compra =".$numero_orden." and calidad.rechazada <> 'si' and calidad.ingresada <> 'si'";
				
		$resultado2=mysql_query($sql2,$conexion->link);
			echo	"<thead><tr>";
			echo	"<th width='100'>Producto</th>";
			echo    "<th>Recepcionado</th>";
			echo    "<th></th>";
			 echo    "<th></th>";
			echo	"</tr></thead>";
												
 		while ($mensaje2=mysql_fetch_array($resultado2))
		{	 					
				echo	"<tbody>";
				echo	"<tr id='td_cambiar_cant_2".$mensaje2[0]."'>";
				echo	"<td>".utf8_encode($mensaje2[1])."</td>";
				echo	"<td>".$mensaje2[2]."</td>";
				/*echo	"<td id='td_aceptar_producto".$mensaje2[0]."'><input type='checkbox' id='cambiar_cant".$mensaje2[0]."' onClick='$(this).aceptar_cantidad_recepcionada_materia_prima(".$mensaje2[0].");'>Aceptar</td>";
				echo	"<td id='td_cambiar_cant".$mensaje2[0]."'><input type='checkbox' id='cambiar_cant".$mensaje2[0]."' onClick='$(this).rechazar_cantidad_recepcionada_materia_prima(".$mensaje2[0].");'>Rechazar</td>";*/

				echo	"<td id='td_cambiar_cant".$mensaje2[0]."'><input type='checkbox' id='cambiar_cant".$mensaje2[0]."' onClick='$(this).cambiar_cantidad_recepcionada_material_pop(".$mensaje2[0].");'></td>";
				echo "<td id='td_input_cambiar_cant".$mensaje2[0]."' style='display:none'><input type='text' placeholder='Ingrese Nueva Cantidad'  id='input_cant_camb".$mensaje2[0]."' onChange='$(this).cantidad_recepcionada_material_pop(".$mensaje2[0].",".$mensaje2[2].");'/></td>";
				echo	"<td id='valida-cantidad_prod".$mensaje2[0]."' style='display:none' class='errores'>Debe Ingresar Numeros</td>"; 
				echo	"<td id='valida-cantidad_input".$mensaje2[0]."' style='display:none' class='errores'>Debe Ingresar Un Numero Menor al Que Ingresa</td>"; 
				echo	"</tr>";
				echo	"</tbody>";
		}
  		 
	}
	catch (Exception $e)
	{    
	 echo $e->getMessage();
	}


					
?>	