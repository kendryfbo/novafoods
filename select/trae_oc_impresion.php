<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);
	
	if ($funcion==1)
	{
		//$numero=trim($_POST["numero"]);
		try{
				$numero_oc=trim($_POST["numero"]);
                                /*
                                $sql3="SELECT numero FROM nota_venta where numero_nota_venta=".$numero_nota_venta." and id_centro_venta=".$centro_venta;
                                $resultado3=mysql_query($sql3,$conexion->link);
                                while ($fila3 = mysql_fetch_array($resultado3))
                                {
                                                    //$numero_crl=$fila2[0]+1;
                                                    $numero_crl=$fila3[0];

                                }*/
                                
                                $sql="select 
                                    DATE_FORMAT(orden_compra.fecha_orden_compra,'%d-%m-%Y') as fecha,
                                    DATE_FORMAT(orden_compra.fecha_despacho_oc,'%d-%m-%Y') as fecha,
                                    proveedor.rut,
                                    proveedor.nombre,
                                    proveedor.contacto1,
                                    condiciones_pago.Condicion,
                                    tipos_de_monedas.tipo_moneda,
                                    areas.area,
                                    orden_compra.subtotal,
                                    orden_compra.descuento,
                                    orden_compra.porc_desc,
                                    orden_compra.neto,
                                    orden_compra.iva,
                                    orden_compra.rte,
                                    orden_compra.total,
                                    orden_compra.estado,
                                    orden_compra.exenta,
                                    orden_compra.honorario,
                                    proveedor.fono,
                                    proveedor.direccion,
                                    proveedor.fax                                    
                                    from 
                                    orden_compra
                                    inner join proveedor on proveedor.id_proveedor=orden_compra.id_proveedor
                                    inner join condiciones_pago on condiciones_pago.id_condicion=orden_compra.cond_pago
                                    inner join tipos_de_monedas on tipos_de_monedas.id_tipo_moneda=orden_compra.id_tipo_moneda
                                    inner join areas on areas.id_area=orden_compra.id_area
                                    where orden_compra.numero_orden_compra=".$numero_oc;
                                //where nota_venta.numero_nota_venta=".$numero_nota_venta;
                                mysql_query("SET NAMES 'UTF8'");
                                $ejecuta=mysql_query($sql,$conexion->link);
                                while ($fila = mysql_fetch_array($ejecuta))
                                        {
                                                
                                                $fecha1=$fila[0];
                                                $fecha2=$fila[1];
                                                $rut=utf8_encode($fila[2]);
                                                $proveedor=utf8_encode($fila[3]);
                                                $atencion=utf8_encode($fila[4]);
                                                $cond_pago=utf8_encode($fila[5]);
                                                $moneda=utf8_encode($fila[6]);
                                                $area=utf8_encode($fila[7]);
                                                
                                                $subtotal=$fila[8];
                                                $descuento=$fila[9]; 
                                                $porc=$fila[10]; 
                                                $neto=$fila[11]; 
                                                
                                                $iva=$fila[12]; 
                                                $rte=$fila[13]; 
                                                $total=$fila[14];
                                                
                                                $est=$fila[15];
                                                $exe=$fila[16];
                                                $hon=$fila[17];
                                                
                                                $fon=$fila[18];
                                                $dir=$fila[19];
                                                $fax=$fila[20];
                                        }
                                        
                        echo"   <div class='modulo widht_modulo_full'>
                                    <div class='title'><p>Orden de Compra</p>
                                    </div>
                                    <div class='content'>  
                                        <br>         
					<div>  
                                            <div class='fright'>
                                                <a href='crear_orden_compra2.php'><input type='button' value='Volver&raquo;'/></a>
                                            </div>
					</div>
					<table class='tableform'>
                                            <tr>
                                                <td>
                                                    <b>Novafoods S.A.<br></b>
                                                    RUT : 96.873.090-8<br>
                                                    Dirección: Av. Quilin 4000, Macul<br>
                                                    Fono:(562) 2294 7252 - Fax:(562) 2294 1824<br>
                                                    e-Mail:adquisiciones@novafoods.cl<br>
                                                    SANTIAGO-CHILE
                                                </td>
                                                <td>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    Orden de Compra Nº $numero_oc<br>
                                                        <table>
                                                            <tr>
                                                                <td>$fecha1</td>
                                                            </tr>
                                                        </table>
                                                        
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>
                                                    <article class='module width_full'>            
                                                                    <div class='module_content'>
                                                                        <table class='tablesorter' id='productos'> 
                                                                            <thead> 
                                                                                <tr>
                                                                                    <td >
                                                                                        <label>Señores: </label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $proveedor    
                                                                                    </td>
                                                                                    <td>
                                                                                        <label>At:</label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $atencion 
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <label>RUT</label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $rut 
                                                                                    </td>
                                                                                    <td >
                                                                                        <label>Fono:</label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $fon
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td >
                                                                                        <label>Dirección</label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $dir
                                                                                    </td>
                                                                                    <td >
                                                                                        <label>Fax</label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $fax
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan='4'>
                                                                                        <label>Presente</label><br>
                                                                                        <label>Confirmo Orden de Compra de:</label>
                                                                                    </td>
                                                                                </tr>
                                                                                
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </article>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>
                                                    
                                                    
                                                                <article class='module width_full'>            
                                                                    <div class='module_content'>
                                                                        <table class='tablesorter' width='100%'>
                                                                            <thead> 
                                                                                <tr>
                                                                                    <th width='100'>
                                                                                        Codigo 
                                                                                    </th>
                                                                                    <th>
                                                                                        Descripción
                                                                                    </th>
                                                                                    <th style='text-align:right'>
                                                                                        Cantidad
                                                                                    </th>
                                                                                    <th style='text-align:right'>
                                                                                        Precio Unit.
                                                                                    </th>
                                                                                    <th style='text-align:right'>
                                                                                        Total
                                                                                    </th>
                                                                                 </thead> 
                                                                                </tr>";
                                                                            $sql2="select 
                                                                                detalle_oc.id_detalle,
                                                                                productos.nombre_producto,
                                                                                detalle_oc.cantidad,
                                                                                detalle_oc.total,
                                                                                detalle_oc.precio,
                                                                                productos.codigo_producto,
                                                                                detalle_oc.id_producto
                                                                                from detalle_oc
                                                                                inner join productos on productos.id_producto=detalle_oc.id_producto	
                                                                                WHERE detalle_oc.id_oc =".$numero_oc;
                                                                            //WHERE detalle_nota_venta.numero_nota_venta =".$numero_nota_venta;
                                                                            $resultado2=mysql_query($sql2,$conexion->link);
                                                                            $sumcaj=0;
                                                                            $sumpbrut=0;
                                                                            $sumpnet=0;
                                                                            $sumpvol=0;
                                                                            while ($mensaje2=mysql_fetch_array($resultado2))
                                                                            {						
                                                                                    $pre=number_format($mensaje2[4], 2, '.', ',');

                                                                                    $tot=number_format($mensaje2[3], 2, '.', ',');
                                                                                    $sumcaj=$sumcaj+$mensaje2[2];
                                                                                    //$porc=number_format($mensaje2[7], 2, '.', ',');

                                                                                    //$netlin=$mensaje2[7]*$mensaje2[3];
                                                                                    /*$sumpbrut=$sumpbrut+($mensaje2[7]*$mensaje2[3]);
                                                                                    $sumpnet=$sumpnet+($mensaje2[8]*$mensaje2[3]);
                                                                                    $sumpvol=$sumpvol+($mensaje2[9]*$mensaje2[3]);*/
                                                                                            echo	"<tr>";
                                                                                                    echo	"<td>".$mensaje2[5]."</td>";
                                                                                                    echo	"<td>".utf8_encode($mensaje2[1])."</td>";
                                                                                                    echo	"<td style='text-align:right'>".$mensaje2[2]."</td>";
                                                                                                    echo	"<td style='text-align:right'>".$pre."</td>";
                                                                                                    echo	"<td style='text-align:right'>".$tot."</td>";
                                                                                            echo "</tr>";	
                                                                            }

                                                                                    $subtotal=number_format($subtotal, 2, '.', ',');

                                                                                    $neto=number_format($neto, 2, '.', ',');
                                                                                    $iva=number_format($iva, 2, '.', ',');
                                                                                    $total=number_format($total, 2, '.', ',');
                                                                                    /*$subtotal=$fila[8];
                                                =$fila[9]; 
                                                $porc=$fila[10]; 
                                                $neto=$fila[11]; 
                                                
                                                $iva=$fila[12]; 
                                                $rte=$fila[13]; 
                                                $total=$fila[14];
                                                
                                                $est=$fila[15];
                                                $exe=$fila[16];
                                                $hon=$fila[17];*/
                                                                         echo"<tr>
                                                                                    <td COLSPAN=3>

                                                                                    </td>

                                                                                    <td>
                                                                                        SUB TOTAL<br>
                                                                                        DESCUENTO $porc%<br>
                                                                                        NETO<br>
                                                                                        IVA<br>";
                                                                                        if($hon==1){
                                                                                            echo"RTE (-)<br>";
                                                                                        }
                                                                                    echo"TOTAL<br>
                                                                                    </td>

                                                                                    <td  style='text-align:right'>
                                                                                        $subtotal<br>
                                                                                        $descuento<br>
                                                                                        $neto<br>    
                                                                                        $iva<br>";
                                                                                        if($hon==1){
                                                                                           echo $rte."<br> ";
                                                                                        }    
                                                                                   echo" $total<br>
                                                                                    </td>

                                                                              </tr>

                                                                        </table>
                                                                    </div>
                                                                </article>
                                                            
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>
                                                    <article class='module width_full'>            
                                                                    <div class='module_content'>
                                                                        <table class='tablesorter' id='productos'> 
                                                                            <thead> 
                                                                                <tr>
                                                                                    <td colspan='4'>
                                                                                        <label>FECHA REQUERIDA EN PLANTA : $fecha2</label><br>
                                                                                        <label>(En el momento del envío anexar: 1.-Copia de la Orden de Compra;2.-Certificado aprobación y Nº de Lote. :</label><br>
                                                                                        <label>La recepción es de Lu-Vi de 8:00 a 13:00 y de 14:00 a 17:00 horas)</label><br><br>
                                                                                        
                                                                                        <label>CONDICIONES DE PAGO : $cond_pago</label><br>
                                                                                        <label>Facturar a : Novafoods S.A.  RUT: 96.873.090-8, Av. Quilin 4000, Macul ,Santiago.</label>
                                                                                    </td>
                                                                                </tr>
                                                                                
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </article>
                                                </td>
                                            </tr>";
                                            if($est==1){
                                            echo"<tr>
                                                <td colspan=2 >
                                                    <article class='module width_full'>            
                                                                    <div class='module_content'>
                                                                        <table class='tablesorter' id='productos'> 
                                                                            
                                                                                <tr>
                                                                                    <td colspan='4'style='text-align:center' >
                                                                                        <img src='img/firmas/vcabrera.jpg' width='20%' height='65'></img><br>
                                                                                        _______________________________<br>
                                                                                        Firma
                                                                                    </td>
                                                                                </tr>
                                                                                
                                                                            
                                                                        </table>
                                                                    </div>
                                                                </article>
                                                </td>
                                            </tr>";    
                                            }
                                    echo"</table>
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
		try{
				$numero_oc=trim($_POST["numero"]);
                                /*
                                $sql3="SELECT numero FROM nota_venta where numero_nota_venta=".$numero_nota_venta." and id_centro_venta=".$centro_venta;
                                $resultado3=mysql_query($sql3,$conexion->link);
                                while ($fila3 = mysql_fetch_array($resultado3))
                                {
                                                    //$numero_crl=$fila2[0]+1;
                                                    $numero_crl=$fila3[0];

                                }*/
                                
                                $sql="select 
                                    DATE_FORMAT(orden_compra.fecha_orden_compra,'%d-%m-%Y') as fecha,
                                    DATE_FORMAT(orden_compra.fecha_despacho_oc,'%Y-%m-%d') as fecha,
                                    proveedor.rut,
                                    proveedor.nombre,
                                    proveedor.contacto1,
                                    condiciones_pago.Condicion,
                                    tipos_de_monedas.tipo_moneda,
                                    areas.area,
                                    orden_compra.subtotal,
                                    orden_compra.descuento,
                                    orden_compra.porc_desc,
                                    orden_compra.neto,
                                    orden_compra.iva,
                                    orden_compra.rte,
                                    orden_compra.total,
                                    orden_compra.estado,
                                    orden_compra.exenta,
                                    orden_compra.honorario,
                                    proveedor.fono,
                                    proveedor.direccion,
                                    proveedor.fax                                    
                                    from 
                                    orden_compra
                                    inner join proveedor on proveedor.id_proveedor=orden_compra.id_proveedor
                                    inner join condiciones_pago on condiciones_pago.id_condicion=orden_compra.cond_pago
                                    inner join tipos_de_monedas on tipos_de_monedas.id_tipo_moneda=orden_compra.id_tipo_moneda
                                    inner join areas on areas.id_area=orden_compra.id_area
                                    where orden_compra.numero_orden_compra=".$numero_oc;
                                //where nota_venta.numero_nota_venta=".$numero_nota_venta;
                                mysql_query("SET NAMES 'UTF8'");
                                $ejecuta=mysql_query($sql,$conexion->link);
                                while ($fila = mysql_fetch_array($ejecuta))
                                        {
                                                
                                                $fecha1=$fila[0];
                                                $fecha2=$fila[1];
                                                $rut=utf8_encode($fila[2]);
                                                $proveedor=utf8_encode($fila[3]);
                                                $atencion=utf8_encode($fila[4]);
                                                $cond_pago=utf8_encode($fila[5]);
                                                $moneda=utf8_encode($fila[6]);
                                                $area=utf8_encode($fila[7]);
                                                
                                                $subtotal=$fila[8];
                                                $descuento=$fila[9]; 
                                                $porc=$fila[10]; 
                                                $neto=$fila[11]; 
                                                
                                                $iva=$fila[12]; 
                                                $rte=$fila[13]; 
                                                $total=$fila[14];
                                                
                                                $est=$fila[15];
                                                $exe=$fila[16];
                                                $hon=$fila[17];
                                                
                                                $fon=$fila[18];
                                                $dir=$fila[19];
                                                $fax=$fila[20];
                                        }
                                        
                        echo"   <div class='modulo widht_modulo_full'>
                                    <div class='title'><p>Orden de Compra</p>
                                    </div>
                                    <div class='content'>  
                                        <br>         
					<div>  
                                            <div class='fright'>
                                                <a href='listado_oc_por_autorizar.php'><input type='button' value='Volver&raquo;'/></a>
                                            </div>
					</div>
					<table class='tableform'>
                                            <tr>
                                                <td>
                                                    <b>Novafoods S.A.<br></b>
                                                    RUT : 96.873.090-8<br>
                                                    Dirección: Av. Quilin 4000, Macul<br>
                                                    Fono:(562) 2294 7252 - Fax:(562) 2294 1824<br>
                                                    e-Mail:adquisiciones@novafoods.cl<br>
                                                    SANTIAGO-CHILE
                                                </td>
                                                <td>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    Orden de Compra Nº $numero_oc<br>
                                                        <table>
                                                            <tr>
                                                                <td>$fecha1</td>
                                                            </tr>
                                                        </table>
                                                        
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>
                                                    <article class='module width_full'>            
                                                                    <div class='module_content'>
                                                                        <table class='tablesorter' id='productos'> 
                                                                            <thead> 
                                                                                <tr>
                                                                                    <td >
                                                                                        <label>Señores: </label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $proveedor    
                                                                                    </td>
                                                                                    <td>
                                                                                        <label>At:</label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $atencion 
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <label>RUT</label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $rut 
                                                                                    </td>
                                                                                    <td >
                                                                                        <label>Fono:</label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $fon
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td >
                                                                                        <label>Dirección</label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $dir
                                                                                    </td>
                                                                                    <td >
                                                                                        <label>Fax</label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $fax
                                                                                    </td>
                                                                                </tr>
                                                                                
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </article>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>
                                                    
                                                    
                                                                <article class='module width_full'>            
                                                                    <div class='module_content'>
                                                                        <table class='tablesorter' width='100%'>
                                                                            <thead> 
                                                                                <tr>
                                                                                    <th width='100'>
                                                                                        Codigo 
                                                                                    </th>
                                                                                    <th>
                                                                                        Descripción
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
                                                                                 </thead> 
                                                                                </tr>";
                                                                            $sql2="select 
                                                                                detalle_oc.id_detalle,
                                                                                productos.nombre_producto,
                                                                                detalle_oc.cantidad,
                                                                                detalle_oc.total,
                                                                                detalle_oc.precio,
                                                                                productos.codigo_producto,
                                                                                detalle_oc.id_producto
                                                                                from detalle_oc
                                                                                inner join productos on productos.id_producto=detalle_oc.id_producto	
                                                                                WHERE detalle_oc.id_oc =".$numero_oc;
                                                                            //WHERE detalle_nota_venta.numero_nota_venta =".$numero_nota_venta;
                                                                            $resultado2=mysql_query($sql2,$conexion->link);
                                                                            $sumcaj=0;
                                                                            $sumpbrut=0;
                                                                            $sumpnet=0;
                                                                            $sumpvol=0;
                                                                            while ($mensaje2=mysql_fetch_array($resultado2))
                                                                            {						
                                                                                    $pre=number_format($mensaje2[4], 2, '.', ',');

                                                                                    $tot=number_format($mensaje2[3], 2, '.', ',');
                                                                                    $sumcaj=$sumcaj+$mensaje2[2];
                                                                                    //$porc=number_format($mensaje2[7], 2, '.', ',');

                                                                                    //$netlin=$mensaje2[7]*$mensaje2[3];
                                                                                    /*$sumpbrut=$sumpbrut+($mensaje2[7]*$mensaje2[3]);
                                                                                    $sumpnet=$sumpnet+($mensaje2[8]*$mensaje2[3]);
                                                                                    $sumpvol=$sumpvol+($mensaje2[9]*$mensaje2[3]);*/
                                                                                            echo	"<tr>";
                                                                                                    echo	"<td>".$mensaje2[5]."</td>";
                                                                                                    echo	"<td>".utf8_encode($mensaje2[1])."</td>";
                                                                                                    echo	"<td style='text-align:right'>".$mensaje2[2]."</td>";
                                                                                                    echo	"<td style='text-align:right'>".$pre."</td>";
                                                                                                    echo	"<td style='text-align:right'>".$tot."</td>";
                                                                                            echo "</tr>";	
                                                                            }

                                                                                    $subtotal=number_format($subtotal, 2, '.', ',');

                                                                                    $neto=number_format($neto, 2, '.', ',');
                                                                                    $iva=number_format($iva, 2, '.', ',');
                                                                                    $total=number_format($total, 2, '.', ',');
                                                                                    /*$subtotal=$fila[8];
                                                =$fila[9]; 
                                                $porc=$fila[10]; 
                                                $neto=$fila[11]; 
                                                
                                                $iva=$fila[12]; 
                                                $rte=$fila[13]; 
                                                $total=$fila[14];
                                                
                                                $est=$fila[15];
                                                $exe=$fila[16];
                                                $hon=$fila[17];*/
                                                                         echo"<tr>
                                                                                    <td COLSPAN=3>

                                                                                    </td>

                                                                                    <td>
                                                                                        SUB TOTAL<br>
                                                                                        DESCUENTO $porc%<br>
                                                                                        NETO<br>
                                                                                        IVA<br>";
                                                                                        if($hon==1){
                                                                                            echo"RTE (-)<br>";
                                                                                        }
                                                                                    echo"TOTAL<br>
                                                                                    </td>

                                                                                    <td  style='text-align:right'>
                                                                                        $subtotal<br>
                                                                                        $descuento<br>
                                                                                        $neto<br>    
                                                                                        $iva<br>";
                                                                                        if($hon==1){
                                                                                           echo $rte."<br> ";
                                                                                        }    
                                                                                   echo" $total<br>
                                                                                    </td>

                                                                              </tr>

                                                                        </table>
                                                                    </div>
                                                                </article>
                                                            
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>
                                                    <article class='module width_full'>            
                                                                    <div class='module_content'>
                                                                        <table class='tablesorter' id='productos'> 
                                                                            <thead> 
                                                                                <tr>
                                                                                    <td colspan=3>
                                                                                         <label>Autorizacion de Orden de Compra Nº $numero_oc </label>
                                                                                         <input type='hidden' id='oc' value='$numero_oc' />
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                         <table class='tablesorter'> 

                                                                                             <tr>
                                                                                                 <td>
                                                                                                         <input type='radio' name='desicion' id='desicion1' value='1'onClick='$(this).autoriza_OC_GTE();'> Autorizar<br>

                                                                                                 </td>
                                                                                                 <td>

                                                                                                         <input type='radio' name='desicion' id='desicion1' value='0' onClick='$(this).autoriza_OC_GTE();'> Rechazar<br>
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
                                                                          </thead> 
                                                                        </table>
                                                                      </div>
                                                   </article>
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
            /*   echo"</table>
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
                                </div>";*/
		
	}
        
        else if ($funcion==3)
	{
		try{
				$numero_crl=trim($_POST["numero"]);                                
                                
                                $sql="select 
                                                cliente.nombre,
				DATE_FORMAT(nota_venta.fecha_emision,'%Y-%m-%d') as fecha,
				centro_venta.centro_venta,
				nota_venta.orden_compra_externa,
				DATE_FORMAT(nota_venta.fecha_despacho,'%Y-%m-%d') as fecha,
				condiciones_pago.Condicion,
				cliente.rut,
				vendedores.vendedor,
				nota_venta.observacion_despacho,
				nota_venta.sub_total,
				nota_venta.iva,
				nota_venta.total,
				nota_venta.total_ila,
				nota_venta.version,
                                suc_clientes.suc_cliente,
                                cliente.id_cliente,
                                comuna_cl.str_descripcion,
                                provincia_cl.str_descripcion,
                                region_cl.str_descripcion,
                                nota_venta.numero_nota_venta
				from 
				nota_venta
				inner join cliente on cliente.id_cliente=nota_venta.id_cliente
				inner join centro_venta on centro_venta.id_centro_venta=nota_venta.id_centro_venta
				inner join vendedores on vendedores.id_vendedor=nota_venta.id_vendedor
				inner join condiciones_pago on condiciones_pago.id_condicion=nota_venta.id_condicion
                                inner join suc_clientes on suc_clientes.id_suc_cliente=nota_venta.suc_cliente
                                inner join comuna_cl on suc_clientes.comuna=comuna_cl.id_co
                                inner join provincia_cl on comuna_cl.id_pr=provincia_cl.id_pr
                                inner join region_cl on provincia_cl.id_re=region_cl.id_re
				where nota_venta.numero=".$numero_crl;
                                //where nota_venta.numero_nota_venta=".$numero_nota_venta;
                                mysql_query("SET NAMES 'UTF8'");
                                $ejecuta=mysql_query($sql,$conexion->link);
                                while ($fila = mysql_fetch_array($ejecuta))
                                        {
                                                $cliente=utf8_encode($fila[0]);
                                                $fecha1=$fila[1];
                                                $centro_venta=strtoupper($fila[2]); 
                                                $oc=$fila[3]; 
                                                $version=$fila[3]; 
                                                $fecha2=$fila[4];
                                                $forma_pago=$fila[5];
                                                $rut=$fila[6];
                                                $vende=utf8_encode($fila[7]);
                                                $observ=$fila[8]; 
                                                
                                                $subtotal=$fila[9];
                                                
                                                $iva=$fila[10]; 
                                                $total=$fila[11]; 
                                                $ila=$fila[12]; 
                                                
                                                $version=$fila[13]; 
                                                $suc_cli=$fila[14]; 
                                                $comuna=$fila[16];
                                                $ciudad=$fila[17];
                                                $rg=$fila[18];
                                                $numero_nota_venta=$fila[19];
                                        }
                                        
                        echo"   <div class='modulo widht_modulo_full'>
                                    <div class='title'><p>Autorizacion de Nota de Venta Por Finanzas</p>
                                    </div>
                                    <div class='content'>  
                                        <br>         
					<div>  
                                            <div class='fright'>
                                                <a href='listado_nota_venta_por_autorizar2.php'><input type='button' value='Volver&raquo;'/></a>
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
                                                    Nota de Venta Nº $numero_nota_venta<br>
                                                    Version Nº:$version
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>
                                                    <article class='module width_full'>            
                                                                    <div class='module_content'>
                                                                        <table class='tablesorter' id='productos'> 
                                                                            <thead> 
                                                                                <tr>
                                                                                    <td >
                                                                                        <label>Cliente</label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $cliente    
                                                                                    </td>
                                                                                    <td >
                                                                                        <label>RUT</label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $rut 
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td >
                                                                                        <label>Dirección</label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $suc_cli
                                                                                    </td>
                                                                                    <td >
                                                                                        <label>Fecha Emisión</label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $fecha1
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td >
                                                                                        <label>Comuna</label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $comuna
                                                                                    </td>
                                                                                    <td >
                                                                                        <label>Fecha Vcto</label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $fecha2
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td >
                                                                                        <label>Provincia</label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $ciudad
                                                                                    </td>
                                                                                    <td >
                                                                                        <label>Forma Pago</label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $forma_pago
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td >
                                                                                        <label>O. Compra</label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $oc
                                                                                    </td>
                                                                                    <td >
                                                                                        <label>Vendedor</label>
                                                                                    </td>
                                                                                    <td>
                                                                                       $vende
                                                                                    </td>
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </article>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>
                                                    <div class='module_content'>
                                                    <table class='tablesorter'>
                                                        
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
										%
                                                                            </th>
                                                                            <th style='text-align:right'>
										Descuento
                                                                            </th>
                                                                            <th style='text-align:right'>
                                                                                Total
                                                                            </th>
                                                                        </tr>";
                                                                    $sql2="select 
                                                                        detalle_nota_venta.id_detalle_nota_venta,
                                                                        productos.nombre_producto,
                                                                        detalle_nota_venta.cantidad,
                                                                        detalle_nota_venta.total,
                                                                        detalle_nota_venta.precio,
                                                                        productos.codigo_producto,
                                                                        detalle_nota_venta.descuento,
                                                                        detalle_nota_venta.descuento_procentaje,
                                                                        detalle_nota_venta.id_producto,
                                                                        detalle_nota_venta.crl_nota_venta
                                                                        from detalle_nota_venta
                                                                        inner join productos on productos.id_producto=detalle_nota_venta.id_producto	
                                                                        WHERE detalle_nota_venta.crl_nota_venta =".$numero_crl;
                                                                    //WHERE detalle_nota_venta.numero_nota_venta =".$numero_nota_venta;
                                                                    $resultado2=mysql_query($sql2,$conexion->link);
                                                                    $sumcaj=0;
                                                                    $sumpbrut=0;
                                                                    $sumpnet=0;
                                                                    $sumpvol=0;
                                                                    while ($mensaje2=mysql_fetch_array($resultado2))
                                                                    {						
                                                                            $pre=number_format($mensaje2[4], 0, '.', ',');
                                                                            $desc=number_format($mensaje2[6], 0, '.', ',');
                                                                            $tot=number_format($mensaje2[3], 0, '.', ',');
                                                                            $sumcaj=$sumcaj+$mensaje2[2];
                                                                            $porc=number_format($mensaje2[7], 2, '.', ',');
                                                                            
                                                                            //$netlin=$mensaje2[7]*$mensaje2[3];
                                                                            $sumpbrut=$sumpbrut+($mensaje2[7]*$mensaje2[3]);
                                                                            $sumpnet=$sumpnet+($mensaje2[8]*$mensaje2[3]);
                                                                            $sumpvol=$sumpvol+($mensaje2[9]*$mensaje2[3]);
                                                                                    echo	"<tr>";
                                                                                            echo	"<td>".$mensaje2[5]."</td>";
                                                                                            echo	"<td>".utf8_encode($mensaje2[1])."</td>";
                                                                                            echo	"<td style='text-align:right'>".$mensaje2[2]."</td>";
                                                                                            echo	"<td style='text-align:right'>".$pre."</td>";
                                                                                            echo	"<td style='text-align:right'>".$porc."</td>";
                                                                                            echo	"<td style='text-align:right'>".$desc."</td>";
                                                                                            echo	"<td style='text-align:right'>".$tot."</td>";
                                                                                    echo "</tr>";	
                                                                    }
                                                                                    
                                                                    $subtotal=number_format($subtotal, 0, '.', ',');
                                                                            $ila=number_format($ila, 0, '.', ',');
                                                                            $iva=number_format($iva, 0, '.', ',');
                                                                            $total=number_format($total, 0, '.', ',');
                                                                 echo"<tr>
                                                                            <td COLSPAN=5>
                                                                                <table>
                                                                                    <tr>
                                                                                        <td colspan=4>
                                                                                            <br>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            TOTAL CAJAS
                                                                                        </td>
                                                                                        <!--td>
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
                                                                                        </td-->
                                                                                    </tr>
                                                                                    
                                                                                    <tr>
                                                                                        <td style='text-align:right'>$sumcaj</td>
                                                                                        <!--td style='text-align:right'>$sumpbrut</td>
                                                                                        <td style='text-align:right'>$sumpnet</td>
                                                                                        <td style='text-align:right'>$sumpvol</td-->
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            
                                                                            <td>
                                                                                SUB TOTAL<br>
                                                                                ILA<br>
                                                                                IVA<br>
                                                                                TOTAL<br>
                                                                            </td>
                                                                            
                                                                            <td  style='text-align:right'>
                                                                                $subtotal<br>
                                                                                $ila<br>
                                                                                $iva<br>
                                                                                $total<br>
                                                                            </td>
                                                                            
                                                                      </tr>";
                                                                 
                                                            echo"</table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>
                                                    <article class='module width_full'>            
                                                                    <div class='module_content'>
                                                                        <table class='tablesorter' id='productos'> 
                                                                            <thead> 
                                                                                <tr>
                                                                                    <td colspan=3>
                                                                                         <label>Autorizacion de Nota de Venta Nº $numero_nota_venta   de $centro_venta </label>
                                                                                         <input type='hidden' id='nv' value='$numero_crl' />
                                                                                             <input type='hidden' id='version' value='$version' />
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                         <table class='tablesorter'> 

                                                                                             <tr>
                                                                                                 <td>
                                                                                                         <input type='radio' name='desicion' id='desicion1' value='1'onClick='$(this).autoriza_nv_gte22();'> Autorizar<br>

                                                                                                 </td>
                                                                                                 <td>

                                                                                                         <input type='radio' name='desicion' id='desicion1' value='0' onClick='$(this).autoriza_nv_gte22();'> Rechazar<br>
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
                                                                          </thead> 
                                                                        </table>
                                                                      </div>
                                                   </article>
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
            /*   echo"</table>
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
                                </div>";*/
		
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