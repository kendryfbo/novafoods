<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);
	
	if ($funcion==1)
	{
		//$numero=trim($_POST["numero"]);
		try{
				$numero_proforma=trim($_POST["numero"]);
                                $sql="select 
                                                cliente.nombre,
                                                DATE_FORMAT(proforma.fecha_proforma,'%d-%m-%Y') as fecha,
                                                centro_venta.centro_venta,
                                                proforma.version,
                                                proforma.medio_de_transporte,
                                                suc_aduanas.id_suc_aduanas,
                                                proforma.puerto_destino,
                                                proforma.forma_pago,
                                                proforma.descripcion_mercaderia,
                                                cliente.direccion,
                                                paises.pais,
                                                tipos_de_monedas.tipo_moneda,
                                                proforma.Subtotal,
                                                proforma.total,
                                                proforma.clausula_venta,
                                                proforma.descuento,
                                                proforma.insurance,
                                                proforma.freight,
                                                proforma.fob,
                                                suc_aduanas.id_aduana,
                                                proforma.status,
                                                cliente.direccion,
                                                suc_aduanas.direccion
                                                from 
                                                proforma
                                                inner join cliente on cliente.id_cliente=proforma.id_cliente
                                                inner join tipos_de_monedas on tipos_de_monedas.id_tipo_moneda=proforma.id_tipo_moneda
                                                inner join centro_venta on centro_venta.id_centro_venta=proforma.id_centro_venta
                                                inner join paises on paises.id_pais=cliente.pais
                                                inner join suc_aduanas on suc_aduanas.id_suc_aduanas=proforma.puerto_embarque
                                                where proforma.numero_proforma=".$numero_proforma;	
                                mysql_query("SET NAMES 'UTF8'");
                                $ejecuta=mysql_query($sql,$conexion->link);
                                while ($fila = mysql_fetch_array($ejecuta))
                                        {
                                                $cliente=utf8_encode($fila[0]);
                                                $fecha_proforma=$fila[1];
                                                $centro_venta=strtoupper($fila[2]); 
                                                $version=$fila[3]; 
                                                $medio_de_transporte=utf8_encode($fila[4]); 
                                                $puerto_embarque=utf8_encode($fila[5]);  
                                                $puerto_destino=utf8_encode($fila[6]); 
                                                $forma_pago=utf8_encode($fila[7]); 
                                                $descripcion_mercaderia=$fila[8]; 
                                                $direccion=$fila[9]; 
                                                $pais=$fila[10]; 
                                                $tipo_moneda=$fila[11]; 
                                                $sub_total=$fila[12]; 
                                                $total=$fila[13]; 
                                                $clausula_venta=$fila[14]; 
                                                $descuento=$fila[15]; 
                                                $insurance=$fila[16]; 
                                                $freight=$fila[17]; 
                                                $tot_fob=$fila[18]; 
                                                $aduana=$fila[19]; 
                                                $est=$fila[20]; 
                                                $dir=$fila[21]; 
                                                $puerto_embarque_NAME=$fila[22]; 
                                        }
                                        //<a href="crear_proforma.php"><input type="button" value="Nueva&raquo;"/></a>
                        echo"   <div class='modulo widht_modulo_full'>
                                    <div class='title'><p>Proforma</p>
                                    </div>
                                    <div class='content'>  
                                        <br>         
					<div>  
                                            <div class='fright'>
                                                <a href='crear_proforma.php'><input type='button' value='Volver&raquo;'/></a>
                                            </div>
					</div>
					<table class='tableform'>
                                            <tr>
                                                <td>
                                                    <b>$centro_venta<br></b>
                                                    Elaboración, Comercialización Alimentos<br>
                                                    Procesos en Polvo, Importación y Exportación<br>
                                                    Quilin 4000, Macul.
                                                    Fono:(562) 2294 7252 - Fax:(562) 2294 1824<br>
                                                    SANTIAGO-CHILE
                                                </td>
                                                <td>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    PROFORMA Nº $numero_proforma<br>
                                                    Version Nº:$version
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>
                                                    <div class='module_content'>
                                                    <table class='tablesorter'>
                                                        <tr>
                                                            <td>
                                                                <br>
                                                                CLIENTE/CUSTOMER &nbsp; &nbsp; :  &nbsp; &nbsp;  $cliente    <br>
                                                                DIRECCION/ADDRESS &nbsp; &nbsp; :   &nbsp; &nbsp; $dir    <br>
                                                                PAIS/COUNTRY &nbsp; &nbsp; :  &nbsp; &nbsp;  $pais    <br>
                                                            </td>
                                                            <td>
                                                                <TABLE>
                                                                    <tr>
                                                                        <td>
                                                                            COD.CLIENTE<br>
                                                                            CUSTOMER Nº
                                                                        </td>
                                                                        <td>
                                                                            FECHA<br>
                                                                            DATE
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            
                                                                        </td>
                                                                        <td>
                                                                            $fecha_proforma
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td COLSPAN=2>
                                                                            DESC.MERCADERIA/GOODS DESCRIPTON
                                                                        </td>
                                                                    </tr>
                                                                </TABLE>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <br>
                                                                CLAUSULA DE VENTA/INCOTERMS &nbsp; &nbsp;   : &nbsp; &nbsp;  $clausula_venta    <br>
                                                                CONDICION DE PAGO/PAYMENT TERMS  &nbsp; &nbsp;  : &nbsp; &nbsp;  $forma_pago    <br>
                                                                MONEDA DE PAGO/CURRENCY  &nbsp; &nbsp;  : &nbsp; &nbsp;  $tipo_moneda    <br><br>

                                                                MEDIO DE TRANSPORTE/TRANSPORT VIA  &nbsp; &nbsp;  : &nbsp; &nbsp;  $medio_de_transporte    <br>
                                                                PUERTO DE EMBARQUE/LOADING PORT &nbsp; &nbsp;   : &nbsp; &nbsp;  $puerto_embarque_NAME    <br>
                                                                PUERTO DE DESTINO/DISCHARGING PORT &nbsp; &nbsp;   : &nbsp; &nbsp;  $puerto_destino    <br>
                                                            </td>
                                                            <td>
                                                                $descripcion_mercaderia
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan=2>
                                                                <table class='tablesorter'>
                                                                     
									<tr>
                                                                            <th width='100'>
										Codigo 
                                                                            </th>
                                                                            <th>
                                                                                Producto
                                                                            </th>
                                                                            <th style='text-align:right'>
                                                                            	Cantidad
                                                                            </th>
                                                                            <th style='text-align:right'>
										Precio
                                                                            </th>
                                                                            <th style='text-align:right'>
                                                                                Total
                                                                            </th>
                                                                        </tr>";
                                                                    $sql2="select
                                                                    detalle_proforma.id_detalle_proforma,
                                                                    productos.nombre_producto,
                                                                    productos.codigo_producto,
                                                                    detalle_proforma.cantidad,
                                                                    detalle_proforma.precio,
                                                                    detalle_proforma.total,
                                                                    proforma.facturada,
                                                                    productos.Peso_Bruto,
                                                                    productos.peso_neto,
                                                                    productos.Volumen
                                                                    from detalle_proforma
                                                                    inner join proforma on proforma.numero_proforma=detalle_proforma.numero_proforma
                                                                    inner join productos on productos.id_producto=detalle_proforma.id_producto	
                                                                    WHERE detalle_proforma.numero_proforma=".$numero_proforma;			
                                                                    $resultado2=mysql_query($sql2,$conexion->link);
                                                                    $sumcaj=0;
                                                                    $sumpbrut=0;
                                                                    $sumpnet=0;
                                                                    $sumpvol=0;
                                                                    while ($mensaje2=mysql_fetch_array($resultado2))
                                                                    {						
                                                                            $pre=number_format($mensaje2[4], 2, '.', ',');
                                                                            $tot=number_format($mensaje2[5], 2, '.', ',');
                                                                            $sumcaj=$sumcaj+$mensaje2[3];
                                                                            
                                                                            //$netlin=$mensaje2[7]*$mensaje2[3];
                                                                            $sumpbrut=$sumpbrut+($mensaje2[7]*$mensaje2[3]);
                                                                            $sumpnet=$sumpnet+($mensaje2[8]*$mensaje2[3]);
                                                                            $sumpvol=$sumpvol+($mensaje2[9]*$mensaje2[3]);
                                                                                    echo	"<tr>";
                                                                                    echo	"<td>".$mensaje2[2]."</td>";
                                                                                    echo	"<td>".utf8_encode($mensaje2[1])."</td>";
                                                                                    echo	"<td style='text-align:right'>".$mensaje2[3]."</td>";
                                                                                    echo	"<td style='text-align:right'>".$pre."</td>";
                                                                                    echo	"<td style='text-align:right'>".$tot."</td>";
                                                                                    //echo	"<td style='text-align:right'>".$netlin."</td>";
                                                                                   // echo	"<td><a href='#' title='Borrar Informacion' onClick='$(this).elimina_prod_detalle_proforma_temporal(".$mensaje2[0].",".$id_usuario.");'class='icon-borrar info-tooltip'></a></td>";
                                                                                    //echo	"<td><a href='#' title='Editar Informacion' onClick='$(this).editar_prod_detalle_proforma(".$mensaje2[0].",".$numero_proforma.");'class='icon-editar info-tooltip'></a></td>";
                                                                                    //echo	"<input type='hidden' id='num_prof' value=".$mensaje2[6]." >" ;
                                                                                    echo "</tr>";	
                                                                    }
                                                                                    $sumcaj=number_format($sumcaj, 0, '.', ',');
                                                                                    $sumpbrut=number_format($sumpbrut, 2, '.', '');
                                                                                    $sumpnet=number_format($sumpnet, 2, '.', ',');
                                                                                    $sumpvol=number_format($sumpvol, 2, '.', ',');
                                                                                    $sub_total=number_format($sub_total, 2, '.', ',');
                                                                            $descuento=number_format($descuento, 2, '.', ',');
                                                                            $tot_fob=number_format($tot_fob, 2, '.', ',');
                                                                            $freight=number_format($freight, 2, '.', ',');
                                                                            $insurance=number_format($insurance, 2, '.', ',');
                                                                            $total=number_format($total, 2, '.', ',');
                                                                 echo"<tr>
                                                                            <td COLSPAN=3>
                                                                                <table>
                                                                                    <tr>
                                                                                        <td colspan=4>
                                                                                            <br>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            TOTAL CAJAS<br>
                                                                                            TOTAL CASES
                                                                                        </td>
                                                                                        <td>
                                                                                            TOTAL KG<br>
                                                                                            GROSS WIGHT
                                                                                        </td>
                                                                                        <td>
                                                                                            TOTAL NETO<br>
                                                                                            NET WEIGHT
                                                                                        </td>
                                                                                        <td>
                                                                                            TOTAL VOLUMEN<br>
                                                                                            VOLUME
                                                                                        </td>
                                                                                    </tr>
                                                                                    
                                                                                    <tr>
                                                                                        <td style='text-align:right'>$sumcaj</td>
                                                                                        <td style='text-align:right'>$sumpbrut</td>
                                                                                        <td style='text-align:right'>$sumpnet</td>
                                                                                        <td style='text-align:right'>$sumpvol</td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            
                                                                            <td>
                                                                                SUBTOTAL<br>
                                                                                DESCUENTO (%)<br>
                                                                                FOB<br>
                                                                                FREIGHT<br>
                                                                                INSURANCE<br>
                                                                                TOTAL<br>
                                                                            </td>
                                                                            
                                                                            <td  style='text-align:right'>
                                                                                $sub_total<br>
                                                                                $descuento<br>
                                                                                $tot_fob<br>
                                                                                $freight<br>
                                                                                $insurance<br>
                                                                                $total<br>
                                                                            </td>
                                                                            
                                                                      </tr>";
                                                                 /*
                                                                  $descuento=$fila[15]; 
                                                                  $tot_fob=$fila[18]
                                                                  */
                                                            echo"</table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                        </table>
                                    </div>
                                </div>";
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
	}
	else if ($funcion==2)
	{
		//$numero=trim($_POST["numero"]);
		try{
				$numero_proforma=trim($_POST["numero"]);
                                $sql="select 
                                                cliente.nombre,
                                                DATE_FORMAT(proforma.fecha_proforma,'%d-%m-%Y') as fecha,
                                                centro_venta.centro_venta,
                                                proforma.version,
                                                proforma.medio_de_transporte,
                                                suc_aduanas.id_suc_aduanas,
                                                proforma.puerto_destino,
                                                proforma.forma_pago,
                                                proforma.descripcion_mercaderia,
                                                cliente.direccion,
                                                paises.pais,
                                                tipos_de_monedas.tipo_moneda,
                                                proforma.Subtotal,
                                                proforma.total,
                                                proforma.clausula_venta,
                                                proforma.descuento,
                                                proforma.insurance,
                                                proforma.freight,
                                                proforma.fob,
                                                suc_aduanas.id_aduana,
                                                proforma.status,
                                                cliente.direccion,
                                                suc_aduanas.direccion
                                                from 
                                                proforma
                                                inner join cliente on cliente.id_cliente=proforma.id_cliente
                                                inner join tipos_de_monedas on tipos_de_monedas.id_tipo_moneda=proforma.id_tipo_moneda
                                                inner join centro_venta on centro_venta.id_centro_venta=proforma.id_centro_venta
                                                inner join paises on paises.id_pais=cliente.pais
                                                inner join suc_aduanas on suc_aduanas.id_suc_aduanas=proforma.puerto_embarque
                                                where proforma.numero_proforma=".$numero_proforma;	
                                $ejecuta=mysql_query($sql,$conexion->link);
                                while ($fila = mysql_fetch_array($ejecuta))
                                        {
                                                $cliente=utf8_encode($fila[0]);
                                                $fecha_proforma=$fila[1];
                                                $centro_venta=strtoupper($fila[2]); 
                                                $version=$fila[3]; 
                                                $medio_de_transporte=utf8_encode($fila[4]); 
                                                $puerto_embarque=utf8_encode($fila[5]);  
                                                $puerto_destino=utf8_encode($fila[6]); 
                                                $forma_pago=utf8_encode($fila[7]); 
                                                $descripcion_mercaderia=$fila[8]; 
                                                $direccion=$fila[9]; 
                                                $pais=$fila[10]; 
                                                $tipo_moneda=$fila[11]; 
                                                $sub_total=$fila[12]; 
                                                $total=$fila[13]; 
                                                $clausula_venta=$fila[14]; 
                                                $descuento=$fila[15]; 
                                                $insurance=$fila[16]; 
                                                $freight=$fila[17]; 
                                                $tot_fob=$fila[18]; 
                                                $aduana=$fila[19]; 
                                                $est=$fila[20]; 
                                                $dir=$fila[21]; 
                                                $puerto_embarque_NAME=$fila[22]; 
                                        }
                                        //<a href="crear_proforma.php"><input type="button" value="Nueva&raquo;"/></a>
                       
                        echo"   <div class='modulo widht_modulo_full'>
                                    <div class='title'><p>Proforma</p>
                                    </div>
                                    <div class='content'>  
                                        <br>         
					<div>  
                                            <div class='fright'>
                                                <a href='listado_proformas_por_autorizar.php'><input type='button' value='Volver&raquo;'/></a>
                                            </div>
					</div>
					<table class='tableform'>
                                            <tr>
                                                <td>
                                                    <b>$centro_venta<br></b>
                                                    Elaboración, Comercialización Alimentos<br>
                                                    Procesos en Polvo, Importación y Exportación<br>
                                                    Quilin 4000, Macul.
                                                    Fono:(562) 2294 7252 - Fax:(562) 2294 1824<br>
                                                    SANTIAGO-CHILE
                                                </td>
                                                <td>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    PROFORMA Nº $numero_proforma<br>
                                                    Version Nº:$version
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>
                                                    <div class='module_content'>
                                                    <table class='tablesorter'>
                                                        <tr>
                                                            <td>
                                                                <br>
                                                                CLIENTE/CUSTOMER &nbsp; &nbsp; :  &nbsp; &nbsp;  $cliente    <br>
                                                                DIRECCION/ADDRESS &nbsp; &nbsp; :   &nbsp; &nbsp; $dir    <br>
                                                                PAIS/COUNTRY &nbsp; &nbsp; :  &nbsp; &nbsp;  $pais    <br>
                                                            </td>
                                                            <td>
                                                                <TABLE>
                                                                    <tr>
                                                                        <td>
                                                                            COD.CLIENTE<br>
                                                                            CUSTOMER Nº
                                                                        </td>
                                                                        <td>
                                                                            FECHA<br>
                                                                            DATE
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            
                                                                        </td>
                                                                        <td>
                                                                            $fecha_proforma
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td COLSPAN=2>
                                                                            DESC.MERCADERIA/GOODS DESCRIPTON
                                                                        </td>
                                                                    </tr>
                                                                </TABLE>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <br>
                                                                CLAUSULA DE VENTA/INCOTERMS &nbsp; &nbsp;   : &nbsp; &nbsp;  $clausula_venta    <br>
                                                                CONDICION DE PAGO/PAYMENT TERMS  &nbsp; &nbsp;  : &nbsp; &nbsp;  $forma_pago    <br>
                                                                MONEDA DE PAGO/CURRENCY  &nbsp; &nbsp;  : &nbsp; &nbsp;  $tipo_moneda    <br><br>

                                                                MEDIO DE TRANSPORTE/TRANSPORT VIA  &nbsp; &nbsp;  : &nbsp; &nbsp;  $medio_de_transporte    <br>
                                                                PUERTO DE EMBARQUE/LOADING PORT &nbsp; &nbsp;   : &nbsp; &nbsp;  $puerto_embarque_NAME    <br>
                                                                PUERTO DE DESTINO/DISCHARGING PORT &nbsp; &nbsp;   : &nbsp; &nbsp;  $puerto_destino    <br>
                                                            </td>
                                                            <td>
                                                                $descripcion_mercaderia
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan=2>
                                                                <table class='tablesorter'>
                                                                     
									<tr>
                                                                            <th width='100'>
										Codigo 
                                                                            </th>
                                                                            <th>
                                                                                Producto
                                                                            </th>
                                                                            <th style='text-align:right'>
                                                                            	Cantidad
                                                                            </th>
                                                                            <th style='text-align:right'>
										Precio
                                                                            </th>
                                                                            <th style='text-align:right'>
                                                                                Total
                                                                            </th>
                                                                        </tr>";
                                                                    $sql2="select
                                                                    detalle_proforma.id_detalle_proforma,
                                                                    productos.nombre_producto,
                                                                    productos.codigo_producto,
                                                                    detalle_proforma.cantidad,
                                                                    detalle_proforma.precio,
                                                                    detalle_proforma.total,
                                                                    proforma.facturada
                                                                    from detalle_proforma
                                                                    inner join proforma on proforma.numero_proforma=detalle_proforma.numero_proforma
                                                                    inner join productos on productos.id_producto=detalle_proforma.id_producto	
                                                                    WHERE detalle_proforma.numero_proforma=".$numero_proforma;			
                                                                    $resultado2=mysql_query($sql2,$conexion->link);
                                                                    $sumcaj=0;
                                                                    while ($mensaje2=mysql_fetch_array($resultado2))
                                                                    {						
                                                                            $pre=number_format($mensaje2[4], 3, '.', '');
                                                                            $tot=number_format($mensaje2[5], 3, '.', '');
                                                                            $sumcaj=$sumcaj+$mensaje2[3];
                                                                                    echo	"<tr>";
                                                                                    echo	"<td>".$mensaje2[2]."</td>";
                                                                                    echo	"<td>".utf8_encode($mensaje2[1])."</td>";
                                                                                    echo	"<td style='text-align:right'>".$mensaje2[3]."</td>";
                                                                                    echo	"<td style='text-align:right'>".$pre."</td>";
                                                                                    echo	"<td style='text-align:right'>".$tot."</td>";
                                                                                   // echo	"<td><a href='#' title='Borrar Informacion' onClick='$(this).elimina_prod_detalle_proforma_temporal(".$mensaje2[0].",".$id_usuario.");'class='icon-borrar info-tooltip'></a></td>";
                                                                                    //echo	"<td><a href='#' title='Editar Informacion' onClick='$(this).editar_prod_detalle_proforma(".$mensaje2[0].",".$numero_proforma.");'class='icon-editar info-tooltip'></a></td>";
                                                                                    //echo	"<input type='hidden' id='num_prof' value=".$mensaje2[6]." >" ;
                                                                                    echo "</tr>";	
                                                                    }
                                                                 echo"<tr>
                                                                            <td COLSPAN=3>
                                                                                <table>
                                                                                    <tr>
                                                                                        <td colspan=4>
                                                                                            <br>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            TOTAL CAJAS<br>
                                                                                            TOTAL CASES
                                                                                        </td>
                                                                                        <td>
                                                                                            TOTAL KG<br>
                                                                                            GROSS WIGHT
                                                                                        </td>
                                                                                        <td>
                                                                                            TOTAL NETO<br>
                                                                                            NET WEIGHT
                                                                                        </td>
                                                                                        <td>
                                                                                            TOTAL VOLUMEN<br>
                                                                                            VOLUME
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>$sumcaj</td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            
                                                                            <td>
                                                                                SUBTOTAL<br>
                                                                                DESCUENTO (%)<br>
                                                                                FOB<br>
                                                                                FREIGHT<br>
                                                                                INSURANCE<br>
                                                                                TOTAL<br>
                                                                            </td>
                                                                            <td  style='text-align:right'>
                                                                                $sub_total<br>
                                                                                $descuento<br>
                                                                                $tot_fob<br>
                                                                                $freight<br>
                                                                                $insurance<br>
                                                                                $total<br>
                                                                            </td>
                                                                            
                                                                      </tr>";
                                                                 /*
                                                                  $descuento=$fila[15]; 
                                                                  $tot_fob=$fila[18]
                                                                  */
                                                            echo"</table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                           <td>
                                                                <table class='tablesorter'> 
                                                                    <tr>
                                                                        <td colspan=3>
                                                                             <label>Autorizacion de Proforma Nº$numero_proforma   </label>
                                                                             <input type='hidden' id='proforma' value='$numero_proforma' />
                                                                                 <input type='hidden' id='version' value='$version' />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                                <input type='radio' name='desicion' id='desicion1' value='1'onClick='$(this).autoriza_prof_gte1();'> Autorizar<br>

                                                                        </td>
                                                                        <td>

                                                                                <input type='radio' name='desicion' id='desicion1' value='0' onClick='$(this).autoriza_prof_gte1();'> Rechazar<br>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <table class='tablesorter'> 
                                                                    <tr>
                                                                        <div id='observa'> 
                                                                        
                                                                        </div>
                                                                    </tr>
                                                                    <tr>
                                                                        <div id='clave_autoriza'> 
                                                                        
                                                                        </div>
                                                                    </tr>                                                                    
                                                                </table>
                                                                    
                                                           </td>                                                                
                                                        </tr>
                                                    </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                        </table>
                                    </div>
                                </div>";
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
	}
	else if ($funcion==4)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql2="SELECT MAX(id_temporal_proforma) FROM temporal_proforma";						
		$ejecuta2=mysql_query($sql2,$conexion->link);			
		$fila2 = mysql_fetch_array($ejecuta2);
		$valor=$fila2[0]+1;
		if ($numero_proforma==$valor)
		{
			echo "1";
		}
		else if ($numero_proforma<$valor)
		{
			echo "3";
		}
		else if ($numero_proforma>$valor)
		{
			echo "2";
		}
	}
	else if ($funcion==5)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql="select 
				cliente.nombre,
				DATE_FORMAT(proforma.fecha_proforma,'%d-%m-%Y') as fecha,
				centro_venta.centro_venta,
				proforma.version,
				proforma.medio_de_transporte,
				suc_aduanas.id_suc_aduanas,
				proforma.puerto_destino,
				proforma.forma_pago,
				proforma.descripcion_mercaderia,
				cliente.direccion,
				paises.pais,
				tipos_de_monedas.tipo_moneda,
				proforma.Subtotal,
				proforma.total,
				proforma.clausula_venta,
				proforma.descuento,
				proforma.insurance,
				proforma.freight,
                                proforma.fob,
                                suc_aduanas.id_aduana,
                                proforma.status
				from 
				proforma
				inner join cliente on cliente.id_cliente=proforma.id_cliente
				inner join tipos_de_monedas on tipos_de_monedas.id_tipo_moneda=proforma.id_tipo_moneda
				inner join centro_venta on centro_venta.id_centro_venta=proforma.id_centro_venta
				inner join paises on paises.id_pais=cliente.pais
                                inner join suc_aduanas on suc_aduanas.id_suc_aduanas=proforma.puerto_embarque
				where proforma.numero_proforma=".$numero_proforma;	
		$ejecuta=mysql_query($sql,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas==0)
		{		 
			$salida[]=array("valor"=>1);
		 	echo json_encode($salida);
		}
		else
		{
			while ($fila = mysql_fetch_array($ejecuta))
			{
				$salida[]=array("cliente"=>utf8_encode($fila[0]),"fecha_proforma"=>$fila[1],"centro_venta"=>$fila[2]
				,"version"=>$fila[3],"medio_de_transporte"=>utf8_encode($fila[4]),"puerto_embarque"=>utf8_encode($fila[5]),
					"puerto_destino"=>utf8_encode($fila[6]),"forma_pago"=>utf8_encode($fila[7]),"descripcion_mercaderia"=>$fila[8]
					,"direccion"=>$fila[9],"pais"=>$fila[10],"tipo_moneda"=>$fila[11],"sub_total"=>$fila[12],"total"=>$fila[13],
					"clausula_venta"=>$fila[14],"descuento"=>$fila[15],"insurance"=>$fila[16],"freight"=>$fila[17],"tot_fob"=>$fila[18],
                                        "aduana"=>$fila[19],"est"=>$fila[20]); 
			}
			echo json_encode($salida);
		}
	}
	else if ($funcion==6)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql2="select
					detalle_proforma.id_detalle_proforma,
					productos.nombre_producto,
					productos.codigo_producto,
					detalle_proforma.cantidad,
					detalle_proforma.precio,
					detalle_proforma.total,
					proforma.facturada
					from detalle_proforma
					inner join proforma on proforma.numero_proforma=detalle_proforma.numero_proforma
					inner join productos on productos.id_producto=detalle_proforma.id_producto	
					WHERE detalle_proforma.numero_proforma=".$numero_proforma;			
		$resultado2=mysql_query($sql2,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado2))
		{						
			echo	"<tr id=".$mensaje2[0].">";
			echo	"<td>".$mensaje2[2]."</td>";
			echo	"<td>".utf8_encode($mensaje2[1])."</td>";
			echo	"<td>".$mensaje2[3]."</td>";
			echo	"<td>".$mensaje2[4]."</td>";
			echo	"<td>".number_format($mensaje2[5])."</td>";
			if ($mensaje2[6]<>'Si')
			{
				echo	"<td><a href='#' title='Borrar Informacion' onClick='$(this).elimina_prod_detalle_proforma(".$mensaje2[0].",".$numero_proforma.");'class='icon-borrar info-tooltip'></a></td>";
				echo	"<td><a href='#' title='Editar Informacion' onClick='$(this).editar_prod_detalle_proforma_version(".$mensaje2[0].",".$numero_proforma.");'class='icon-editar info-tooltip'></a></td>";
			}
			else
			{
				echo	"<td></td>";
			}		
			echo "</tr>";	
		}
	}
	else if ($funcion==7)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);			
		$sql="INSERT INTO proforma_historico
			SELECT * FROM proforma where numero_proforma=".$numero_proforma;
		$ejecuta=mysql_query($sql,$conexion->link);

		$sql1="SELECT version FROM proforma where numero_proforma=".$numero_proforma;
		$ejecuta1=mysql_query($sql1,$conexion->link);
		$fila1=mysql_fetch_array($ejecuta1);
		$dato=$fila1[0]+1;

		$sql2="UPDATE proforma set version=".$dato." where numero_proforma=".$numero_proforma;
		$resultado2=mysql_query($sql2,$conexion->link);

		$sql3=" SELECT Cantidad,id_producto,Precio,total FROM detalle_proforma where numero_proforma=".$numero_proforma;
		$ejecuta3=mysql_query($sql3,$conexion->link);
		while ($fila3=mysql_fetch_array($ejecuta3))
		{	
			$sql4="SELECT version FROM proforma where numero_proforma=".$numero_proforma;
			$ejecuta4=mysql_query($sql4,$conexion->link);
			$fila4=mysql_fetch_array($ejecuta4);

			$sql5="INSERT INTO detalle_proforma_historica (numero_proforma,Cantidad,id_producto,Precio,total)
			VALUES
			('$numero_proforma','$fila3[0]','$fila3[1]','$fila3[2]','$fila3[3]')";
			$resultado5=mysql_query($sql5,$conexion->link);
			$valor=mysql_insert_id();
			$dato2=($fila4[0]-(1));

			$sql6="UPDATE detalle_proforma_historica	 
				set 		 
				version=".$dato2.
				" where id_detalle_proforma=".$valor;
			$resultado6=mysql_query($sql6,$conexion->link);			
		}
		echo $dato;
	}
	else if ($funcion==8)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql2="select
					detalle_proforma.id_detalle_proforma,
					productos.nombre_producto,
					productos.codigo_producto,
					detalle_proforma.cantidad,
					detalle_proforma.total,
					detalle_proforma.precio,
					proforma.facturada
					from detalle_proforma
					inner join proforma on proforma.numero_proforma=detalle_proforma.numero_proforma
					inner join productos on productos.id_producto=detalle_proforma.id_producto	
					WHERE detalle_proforma.numero_proforma=".$numero_proforma;			
		$resultado2=mysql_query($sql2,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado2))
		{						
			echo	"<tr id=".$mensaje2[0].">";
			echo	"<td>".$mensaje2[2]."</td>";
			echo	"<td>".utf8_encode($mensaje2[1])."</td>";
			echo	"<td>".$mensaje2[3]."</td>";
		}
	}
	else if ($funcion==9)
	{
		$id_aduana=trim($_POST["id_aduana"]);
		$sql="select
					rut,
					direccion,
					ciudad,
					fono
					from aduanas
					WHERE id_aduana=".$id_aduana;			
		$ejecuta=mysql_query($sql,$conexion->link);
		while ($fila = mysql_fetch_array($ejecuta))
		{
			$salida[]=array("rut"=>$fila[0],"direccion"=>utf8_encode($fila[1]),"ciudad"=>utf8_encode($fila[2]),"fono"=>$fila[3]);
		}
		echo json_encode($salida);
	}
	else if ($funcion==10)
	{
		$nave=trim($_POST["nave"]);
		$contenedor=trim($_POST["contenedor"]);
		$movil=trim($_POST["movil"]);
		$patente=trim($_POST["patente"]);
		$id_aduana=trim($_POST["id_aduana"]);	
		$num_proforma=trim($_POST["num_proforma"]);	
		$num_guia=trim($_POST["num_guia"]);	
		$fecha=date("y-m-d H:i:s");
		$proforma=trim($_POST["proforma"]);
		

		$sql="INSERT INTO guias_despachos (numero_guia_despacho,nave,contenedor,movil,patente,numero_proforma,id_aduana,fecha)
			VALUES
			('$num_guia','$nave','$contenedor','$movil','$patente','$num_proforma','$id_aduana','$fecha')";
		$resultado=mysql_query($sql,$conexion->link);
		$guia=mysql_insert_id();
		$sql1="UPDATE proforma	 
			set 		 
			despachada='Si' where numero_proforma=".$proforma;
		$resultado1=mysql_query($sql1,$conexion->link);	

		echo "Guia de Despacho Ingresada Numero ".$num_guia;
	}
	else if ($funcion==11)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql="SELECT numero_proforma FROM guias_despachos where numero_proforma=".$numero_proforma;						
		$ejecuta=mysql_query($sql,$conexion->link);			
		$fila = mysql_fetch_array($ejecuta);
		if ($fila[0]<>"")
		{
			echo "1";
		}
		else
		{
			echo "2";
		}
	}
	else if ($funcion==12)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql="select 
				guias_despachos.numero_guia_despacho,
				guias_despachos.nave,
				guias_despachos.contenedor,
				guias_despachos.movil,
				guias_despachos.patente,
				aduanas.nombre_aduana,
				aduanas.rut,
				aduanas.direccion,
				aduanas.ciudad,
				aduanas.fono,
				cliente_internacional.nombre_cliente,
				guias_despachos.id_guia_despacho
				from 
				guias_despachos
				inner join aduanas on aduanas.id_aduana=guias_despachos.id_aduana
				inner join proforma on proforma.numero_proforma=guias_despachos.numero_proforma
				inner join cliente_internacional on cliente_internacional.id_cliente=proforma.id_cliente
				where guias_despachos.numero_proforma=".$numero_proforma;	
		$ejecuta=mysql_query($sql,$conexion->link);
		$numero_filas = mysql_num_rows($ejecuta);
		if ($numero_filas==0)
		{		 
			$salida[]=array("valor"=>1);
		 	echo json_encode($salida);
		}
		else
		{
			while ($fila = mysql_fetch_array($ejecuta))
			{
				$salida[]=array("numero_guia_despacho"=>$fila[0],"nave"=>utf8_encode($fila[1]),"contenedor"=>utf8_encode($fila[2]),
					"movil"=>utf8_encode($fila[3]),"patente"=>utf8_encode($fila[4]),"nombre_aduana"=>utf8_encode($fila[5])
					,"rut"=>$fila[6],"direccion"=>utf8_encode($fila[7]),"ciudad"=>utf8_encode($fila[8]),"fono"=>$fila[9],"cliente"=>$fila[10]
					,"id_guia_despacho"=>$fila[11]);
			}
			echo json_encode($salida);
		}
	}
	else if ($funcion==13)
	{
		$num_guia=trim($_POST["num_guia"]);
		$id_guia=trim($_POST["id_guia"]);		
		$sql="SELECT numero_guia_despacho FROM guias_despachos where numero_guia_despacho=".$num_guia." where id_guia_despacho=".$id_guia;				
		$ejecuta=mysql_query($sql,$conexion->link);			
		$fila = mysql_fetch_array($ejecuta);
		if ($fila[0]<>"")
		{
			echo "1";
		}
		else
		{
			echo "2";
		}
	}
	else if ($funcion==14)
	{
		$nave=trim($_POST["nave"]);
		$contenedor=trim($_POST["contenedor"]);
		$movil=trim($_POST["movil"]);
		$patente=trim($_POST["patente"]);
		$id_aduana=trim($_POST["id_aduana"]);	
		$num_proforma=trim($_POST["num_proforma"]);	
		$num_guia=trim($_POST["num_guia"]);	
		$id_guia=trim($_POST["id_guia"]);	
		$fecha=date("y-m-d H:i:s");
		$sql="UPDATE guias_despachos	 
					set 		 
					numero_guia_despacho='".$num_guia."',
					nave='".$nave."',
					contenedor='".$contenedor."',
					movil='".$movil."',
					patente='".utf8_decode($patente)."',
					fecha='".$fecha."',
					id_aduana='".$id_aduana."'
					where id_guia_despacho=".$id_guia;
		$resultado=mysql_query($sql,$conexion->link);
		echo "Guia de Despacho Modificada";
	}
	else if ($funcion==15)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql2="select
					detalle_proforma.id_detalle_proforma,
					productos.nombre_producto,
					productos.codigo_producto,
					detalle_proforma.cantidad,
					detalle_proforma.precio,
					detalle_proforma.total,
					proforma.facturada,
                                        proforma.status
					from detalle_proforma
					inner join proforma on proforma.numero_proforma=detalle_proforma.numero_proforma
					inner join productos on productos.id_producto=detalle_proforma.id_producto	
					WHERE detalle_proforma.numero_proforma=".$numero_proforma;			
		$resultado2=mysql_query($sql2,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado2))
		{						
			$pre=number_format($mensaje2[4], 3, '.', '');
                        $tot=number_format($mensaje2[5], 3, '.', '');
                        echo	"<tr id=".$mensaje2[0].">";
			echo	"<td>".$mensaje2[2]."</td>";
			echo	"<td>".utf8_encode($mensaje2[1])."</td>";
			echo	"<td style='text-align:right'>".$mensaje2[3]."</td>";//can
			echo	"<td style='text-align:right'>".$pre."</td>";//pre
			echo	"<td style='text-align:right'>".$tot."</td>";//tot
			if ($mensaje2[6]<>'Si')
			{
                            if($mensaje2[7]==0){
				echo	"<td><a href='#' title='Borrar Informacion' onClick='$(this).elimina_prod_detalle_proforma(".$mensaje2[0].",".$numero_proforma.");'class='icon-borrar info-tooltip'></a></td>";
				//echo	"<td><a href='#' title='Editar Informacion' onClick='$(this).cambio_proforma_version_modifca(".$mensaje2[0].",".$numero_proforma.");'class='icon-editar info-tooltip'></a></td>";
                            }
			}
			else
			{
				echo	"<td></td>";
			}		
			echo "</tr>";	
		}
	}
	else if ($funcion==16)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$id_cliente_int=trim($_POST["id_cliente_int"]);
		$fecha_proforma=trim($_POST["fecha_proforma"]);
		$id_centro_venta=trim($_POST["id_centro_venta"]);
		$medio_transporte=trim($_POST["medio_transporte"]);
		$puerto_embarque=utf8_decode(trim($_POST["puerto_embarque"]));
		$puerto_destino=utf8_decode(trim($_POST["puerto_destino"]));
		$cond_pago=trim($_POST["cond_pago"]);
		$id_tipo_moneda=utf8_decode(trim($_POST["id_tipo_moneda"]));
		$clausula_venta=trim($_POST["clausula_venta"]);
		$descripcion=utf8_decode(trim($_POST["descripcion"]));
		$subtotal=trim($_POST["subtotal"]);
		$descuento=trim($_POST["descuento"]);
		$freight=trim($_POST["freight"]);
		$insurance=trim($_POST["insurance"]);
		$total=trim($_POST["total"]);
		$fecha_proforma2=date("Y-m-d",strtotime($fecha_proforma));
		$version=trim($_POST["version"]);
		try{

			$sql1="UPDATE proforma	 
					set 		 
					id_cliente='".$id_cliente_int."',
					fecha_proforma='".$fecha_proforma2."',
					id_centro_venta='".$id_centro_venta."',
					medio_de_transporte='".$medio_transporte."',
					puerto_embarque='".utf8_decode($puerto_embarque)."',
					puerto_destino='".utf8_decode($puerto_destino)."',
					ingresada='Si',
					forma_pago='".utf8_decode($cond_pago)."',
					id_tipo_moneda='".$id_tipo_moneda."',
					clausula_venta='".$clausula_venta."',
					total='".$total."',
					descripcion_mercaderia='".utf8_decode($descripcion)."',
					subtotal='".$subtotal."',
					freight='".$freight."',
					insurance='".$insurance."',
					version='".$version."',
					descuento='".$descuento."'
					where numero_proforma=".$numero_proforma;
				$resultado2=mysql_query($sql1,$conexion->link);	 
			
				
				echo "Proforma Actualizada Numero ".$numero_proforma;
		}
			catch (Exception $e)
		{    
			echo $e->getMessage();
		}
	}
	else if ($funcion==17)
	{
		$numero_guia=trim($_POST["numero_guia"]);
		$sql="SELECT numero_guia_despacho FROM guias_despachos where numero_guia_despacho=".$numero_guia;				
		$ejecuta=mysql_query($sql,$conexion->link);			
		$fila = mysql_fetch_array($ejecuta);
		if ($fila[0]<>"")
		{
			echo "1";
		}
		else
		{
			echo "2";
		}
	}
	else if ($funcion==18)
	{
		$numero_guia=trim($_POST["numero_guia"]);
		$sql2="select
					detalle_proforma.id_detalle_proforma,
					detalle_proforma.cantidad,
					productos.nombre_producto,
					formatos.formato,
					productos.Peso_Bruto,
					productos.Volumen,
					productos.peso_neto,
					cliente_internacional.nombre_cliente,
					factura_internacional.numero_factura,
					guias_despachos.contenedor
					from detalle_proforma
					inner join proforma on proforma.numero_proforma=detalle_proforma.numero_proforma
					inner join productos on productos.id_producto=detalle_proforma.id_producto	
					inner join formatos on formatos.id_formato=productos.id_formato	
					inner join guias_despachos on guias_despachos.numero_proforma=proforma.numero_proforma
					inner join factura_internacional on factura_internacional.numero_proforma=proforma.numero_proforma
					inner join cliente_internacional on cliente_internacional.id_cliente=factura_internacional.id_cliente
					WHERE guias_despachos.numero_guia_despacho=".$numero_guia;			
		$resultado2=mysql_query($sql2,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado2))
		{		
			$peso_bruto=$mensaje2[1]*$mensaje2[4];
			$peso_neto=$mensaje2[1]*$mensaje2[6];
			$volumen=$mensaje2[1]*$mensaje2[5];
			echo	"<tr id=".$mensaje2[0].">";
			echo	"<td>".$mensaje2[1]."</td>";
			echo	"<td>".utf8_encode($mensaje2[2])."</td>";
			echo	"<td>".$mensaje2[3]."</td>";
			echo	"<td>".$peso_bruto."</td>";
			echo	"<td>".$peso_neto."</td>";
			echo	"<td>".$volumen."</td>";
			echo	"<input type='hidden' id='cliente_nom' value=".$mensaje2[7].">";
			echo	"<input type='hidden' id='factura_num' value=".$mensaje2[8].">";
			echo	"<input type='hidden' id='contenedor_num' value=".$mensaje2[9].">";
		echo "</tr>";	
		}		
	}
	else if ($funcion==19)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql="SELECT facturada FROM proforma where numero_proforma=".$numero_proforma;				
		$ejecuta=mysql_query($sql,$conexion->link);			
		$fila = mysql_fetch_array($ejecuta);
		if ($fila[0]<>"")
		{
			echo "1";
		}
		else
		{
			$numero_proforma=trim($_POST["numero_proforma"]);
			$sql2="SELECT rechazada FROM proforma where numero_proforma=".$numero_proforma;				
			$ejecuta2=mysql_query($sql2,$conexion->link);	
			$fila2 = mysql_fetch_array($ejecuta2);
			if ($fila2[0]<>"")
			{
				echo "3";
			}
			else
			{
				echo "2";
			}
		}		
	}
	else if ($funcion==20)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql="SELECT ingresada FROM proforma where numero_proforma=".$numero_proforma;				
		$ejecuta=mysql_query($sql,$conexion->link);			
		$fila = mysql_fetch_array($ejecuta);
		if ($fila[0]<>"")
		{
			echo "1";
		}
		else
		{
			echo "2";
		}		
	}
	else if ($funcion==21)
	{
		$numero_proforma=trim($_POST["numero_proforma"]);
		$sql2="select
					detalle_proforma.id_detalle_proforma,
					productos.nombre_producto,
					productos.codigo_producto,
					detalle_proforma.cantidad,
					detalle_proforma.precio,
					detalle_proforma.total,
					proforma.facturada
					from detalle_proforma
					inner join proforma on proforma.numero_proforma=detalle_proforma.numero_proforma
					inner join productos on productos.id_producto=detalle_proforma.id_producto	
					WHERE detalle_proforma.numero_proforma=".$numero_proforma;			
		$resultado2=mysql_query($sql2,$conexion->link);
		while ($mensaje2=mysql_fetch_array($resultado2))
		{						
			echo	"<tr id=".$mensaje2[0].">";
			echo	"<td>".$mensaje2[2]."</td>";
			echo	"<td>".utf8_encode($mensaje2[1])."</td>";
			echo	"<td>".$mensaje2[3]."</td>";
			echo	"<td>".$mensaje2[4]."</td>";
			echo	"<td>".number_format($mensaje2[5])."</td>";
			echo	"<td></td>";
			echo "</tr>";	
		}
	}
?>	