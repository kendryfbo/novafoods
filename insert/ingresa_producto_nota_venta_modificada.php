<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$precio=trim($_POST["precio"]);
	$cajas=trim($_POST["cajas"]);
	$id_producto=trim($_POST["id_producto"]);
	$numero_nota_venta=trim($_POST["numero_nota_venta"]);
	$stock_producto=trim($_POST["stock_producto"]);	
	$descuento=trim($_POST["descuento"]);
	$id_Usuario=trim($_POST["id_Usuario"]);		
	if ($cajas>$stock_producto)
	{
		echo "1";
	}
	else if ($cajas=='0')
	{
		echo "2";
	}
	else
	{
		try{	
				if ($descuento===0)
				{
					$total=($precio*$cajas);		
					$total_descuento=0;	
					$descuento=0;	
				}
				else
				{
					$total=($precio*$cajas);		
					$total_descuento=($total*$descuento)/100;
					$total_2=($total-$total_descuento);		
				}
				mysql_query("SET NAMES 'utf8'");

				$sql3="INSERT INTO detalle_nota_venta (Cantidad,id_producto,Precio,numero_nota_venta,total,descuento_procentaje,descuento)
					VALUES ('$cajas','$id_producto','$precio','$numero_nota_venta','$total_2','$descuento','$total_descuento')";
				$resultado=mysql_query($sql3,$conexion->link);
				$id_detalle_nota_venta=mysql_insert_id();
				$cantidad=$cajas*-1;

			$sql2="select
					detalle_nota_venta.id_detalle_nota_venta,
					productos.nombre_producto,
					detalle_nota_venta.cantidad,
					detalle_nota_venta.total,
					detalle_nota_venta.precio,
					productos.codigo_producto,
					detalle_nota_venta.descuento,
					detalle_nota_venta.descuento_procentaje,
					ingresado_factura
					from detalle_nota_venta
					inner join productos on productos.id_producto=detalle_nota_venta.id_producto	
					WHERE detalle_nota_venta.id_detalle_nota_venta =".$id_detalle_nota_venta;
					
			$resultado2=mysql_query($sql2,$conexion->link);
			$mensaje2=mysql_fetch_array($resultado2);
										
					echo	"<tr id=".$mensaje2[0].">";
					echo	"<td>".$mensaje2[5]."</td>";
					echo	"<td>".$mensaje2[1]."</td>";
					echo	"<td>".$mensaje2[2]."</td>";
					echo	"<td>".$mensaje2[4]."</td>";
					echo	"<td>".number_format($mensaje2[3])."</td>";
					echo	"<td>".$mensaje2[7]." %</td>";
					echo	"<td>".$mensaje2[6]." </td>";
					echo	"<input type='hidden' id='valor_id_nota' value=".$numero_nota_venta." >" ;

					if ($mensaje2[8]<>'Si')
					{
						echo	"<td><a href='#' title='Borrar Informacion' onClick='$(this).elimina_prod_detalle_nota_venta_modificar(".$mensaje2[0].",".$numero_nota_venta.");'class='icon-borrar info-tooltip'></a></td>";						
						echo	"<td><a href='#' title='Editar Informacion' onClick='$(this).editar_prod_detalle_nota_venta_modificar(".$mensaje2[0].",".$numero_nota_venta.");' class='icon-editar info-tooltip'></a></td>";
					}
					else
					{
						echo	"<td></td>";
					}
					echo "</tr>";	

			}
				catch (Exception $e)
			{    
				 echo $e->getMessage();
			}
	}			
?>		