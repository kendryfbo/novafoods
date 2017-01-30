<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
 	$precio=trim($_POST["precio"]);
	$cajas=trim($_POST["cajas"]);
	$id_producto=trim($_POST["id_producto"]);
	//$numero_nota_venta=trim($_POST["numero_nota_venta"]);
	//$stock_producto=trim($_POST["stock_producto"]);	
	$descuento=trim($_POST["descuento"]);
	$id_Usuario=trim($_POST["id_Usuario"]);	
        $ila_nota_venta=trim($_POST["ila_nota_venta"]);
	/*if ($cajas>$stock_producto)
	{
		echo "1";
	}
	else if ($cajas=='0')
	{
		echo "2";
	}
	else
	{*/
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
				/*mysql_query("SET NAMES 'utf8'");
				$sql="select					
					temporal_nota_venta.id_temporal_nota_venta
					from temporal_nota_venta
					WHERE temporal_nota_venta.id_temporal_nota_venta =".$numero_nota_venta;					
				$resultado=mysql_query($sql,$conexion->link);
				$mensaje=mysql_fetch_array($resultado);
				if ($mensaje[0]=="")
				{
					$sql6="INSERT INTO temporal_nota_venta (id_usuario)
					VALUES ('$id_Usuario')";
					$resultado6=mysql_query($sql6,$conexion->link);
					$numero_nota_venta=mysql_insert_id();
				}
				else
				{
					$valor=$numero_nota_venta;
				}	*/
                                $ila=0;
                                if($ila_nota_venta==="SI"){
                                    $ila=$total_2*10/100;
                                }else{
                                    $ila=0;
                                }

				$sql3="INSERT INTO temporal_detalle_nota_venta (Cantidad,id_producto,Precio,total,descuento_procentaje,descuento,id_usuario,ila)
					VALUES ('$cajas','$id_producto','$precio','$total_2','$descuento','$total_descuento','$id_Usuario','$ila')";
                                /*$sql3="INSERT INTO temporal_detalle_nota_venta (Cantidad,id_producto,Precio,numero_nota_venta,total,descuento_procentaje,descuento)
					VALUES ('$cajas','$id_producto','$precio','$numero_nota_venta','$total_2','$descuento','$total_descuento')";*/
				$resultado=mysql_query($sql3,$conexion->link);
				$id_detalle_nota_venta=mysql_insert_id();
				$cantidad=$cajas*-1;

			$sql2="select
					temporal_detalle_nota_venta.id_detalle_nota_venta,
					productos.nombre_producto,
					temporal_detalle_nota_venta.cantidad,
					temporal_detalle_nota_venta.total,
					temporal_detalle_nota_venta.precio,
					productos.codigo_producto,
					temporal_detalle_nota_venta.descuento,
					temporal_detalle_nota_venta.descuento_procentaje,
					ingresado_factura
					from temporal_detalle_nota_venta
					inner join productos on productos.id_producto=temporal_detalle_nota_venta.id_producto	
					WHERE temporal_detalle_nota_venta.id_usuario =".$id_Usuario;
			mysql_query("SET NAMES 'UTF8'");		
			$resultado2=mysql_query($sql2,$conexion->link);
                        
                        while ($mensaje2 = mysql_fetch_array($resultado2))
			{
			//$mensaje2=mysql_fetch_array($resultado2);
										
					echo	"<tr id=".$mensaje2[0].">";
					echo	"<td>".utf8_encode($mensaje2[5])."</td>";
					echo	"<td style='text-align:right'>".$mensaje2[1]."</td>";
					echo	"<td style='text-align:right'>".$mensaje2[2]."</td>";
					echo	"<td style='text-align:right'>".$mensaje2[4]."</td>";
					
					echo	"<td style='text-align:right'>".$mensaje2[7]." %</td>";
					echo	"<td style='text-align:right'>".$mensaje2[6]." </td>";
                                        echo	"<td style='text-align:right'>".number_format($mensaje2[3])."</td>";
					//echo	"<input type='hidden' id='valor_id_nota' value=".$numero_nota_venta." >" ;

					if ($mensaje2[8]<>'Si')
					{
						echo	"<td  style='text-align:center'><a href='#' title='Borrar Informacion' onClick='$(this).elimina_prod_detalle_nota_venta(".$mensaje2[0].",".$numero_nota_venta.");'class='icon-borrar info-tooltip'></a></td>";						
						//echo	"<td><a href='#' title='Editar Informacion' onClick='$(this).editar_prod_detalle_nota_venta(".$mensaje2[0].",".$numero_nota_venta.");' class='icon-editar info-tooltip'></a></td>";
					}
					else
					{
						echo	"<td></td>";
					}
					echo "</tr>";	
                            }
			}
				catch (Exception $e)
			{    
				 echo $e->getMessage();
			}
	//}			
?>		