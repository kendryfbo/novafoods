
<?php	 
        
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);
	if ($funcion==1)
	{
		$fecha1=trim($_POST["fecha1"]);
                $fecha2=trim($_POST["fecha2"]);
		try{
                    echo"<table class='tablesorter' id='tabla_4'> 
			<thead> 
                            <tr>
                                <th>
                                    Empresa
				</th>
				<th>
                                    Factura
				</th>
				<th>
                                    Fecha
				</th>
                                <th>
                                    Proforma
				</th>
				<th>
                                    Pais
				</th>
				<th>
                                    Cliente
				</th>
                                <th>
                                    Cajas
				</th>
				<th>
                                    FOB
				</th>
				<th>
                                    Freight
				</th>
                                <th>
                                    Insurance
				</th>
				<th>
                                    Total
				</th>
				<th>
                                    Revisar
				</th>
                            </tr> 
			</thead>";
                        $sql3="select
                            centro_venta.centro_venta,
                            factura_internacional.numero_factura,
                            factura_internacional.fecha_factura,
                            proforma.numero_proforma,
                            paises.pais,
                            cliente.nombre,
                            sum(detalle_proforma.Cantidad) as suma,
                            proforma.fob,
                            proforma.freight,
                            proforma.insurance,
                            proforma.total
                            from proforma
                            inner join centro_venta on centro_venta.id_centro_venta=proforma.id_centro_venta
                            inner join factura_internacional on factura_internacional.numero_proforma=proforma.numero_proforma
                            inner join cliente on cliente.id_cliente=proforma.id_cliente
                            inner join paises on paises.id_pais=cliente.pais
                            inner join detalle_proforma on detalle_proforma.numero_proforma=proforma.numero_proforma
                            where fecha_factura  >='".$fecha1."' AND fecha_factura<='".$fecha2."'
                            group by proforma.numero_proforma
                            ";//$fecha1
                        //where formulas.id_producto_padre=".$id_producto_terminado." and formulas.nivel=5";
                            $ejecuta3=mysql_query($sql3,$conexion->link);
                            $sumcan=0;
                            $sumfob=0;
                            $sumfre=0;
                            $sumins=0;
                            $sumtot=0;
                            /*
                            $sum_pre_bat=0;
                            $sumTBmezclaBAT=0;
                            $sumTBmezclaUNI=0;*/
                            mysql_query("SET NAMES 'UTF8'");
                            while ($fila3 = mysql_fetch_array($ejecuta3))
                            {
                                $fob=number_format($fila3[7], 2, '.', ',');
                                $fre=number_format($fila3[8], 2, '.', ',');
                                $ins=number_format($fila3[9], 2, '.', ',');
                                $tot=number_format($fila3[10], 2, '.', ',');
                                /*$canbat=$fila3[3]*$numbat;
                                $canbatfor=number_format($canbat, 3, '.', '');
                                $uni=number_format($fila3[5], 3, '.', '');*/
                            $fecfac= $fila3[2];
                            $fecfac = date("d-m-Y", strtotime($fecfac));
                            //date_format($fecfac, 'd/m/y');
                                echo "<tr>";
                                    echo "<td >".$fila3[0]."</td>"; 
                                    echo "<td style='text-align:right'>".utf8_decode($fila3[1])."</td>"; 
                                    echo "<td >".$fecfac."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[3]."</td>"; 
                                    echo "<td >".utf8_encode($fila3[4])."</td>"; 
                                    echo "<td >".$fila3[5]."</td>"; 
                                    $sumcan=$sumcan+$fila3[6];
                                    echo "<td style='text-align:right'>".$fila3[6]."</td>";
                                    $sumfob=$sumfob+$fila3[7];                            
                                    echo "<td style='text-align:right'>".$fob."</td>";
                                    $sumfre=$sumfre+$fila3[8];                            
                                    echo "<td style='text-align:right'>".$fre."</td>";
                                    $sumins=$sumins+$fila3[9];                            
                                    echo "<td style='text-align:right'>".$ins."</td>";
                                    $sumtot=$sumtot+$fila3[10];
                                    echo "<td style='text-align:right'>".$tot."</td>";
                                    echo "<td><a href='#' onClick='$(this).Detalle_ventas_export(".$fila3[3].");' title='Revisar Detalle' class='icon-editar info-tooltip'></a></td>";
                                    //echo "<td  width='30%' style='text-align:right'>".$canbatfor."</td>"; 
                                    //echo "<td style='text-align:right'width='37%'>".$bat."</td>";         
                                    //echo "<td style='text-align:right'></td>"; 
                                    //echo "<td style='text-align:right'>".$uni."</td>"; 
                                echo "</tr>";
                            }
                            $sumfob=number_format($sumfob, 2, '.', ',');
                            $sumfre=number_format($sumfre, 2, '.', ',');
                            $sumins=number_format($sumins, 2, '.', ',');
                            
                            echo "<tr>";
                                echo "<td style='text-align:right' colspan=6>
                                    <input type='hidden' id='tot1' value='$sumtot' />
                                    Total</td>";
                                $sumtot=number_format($sumtot, 2, '.', ',');
                                echo "<td style='text-align:right'>".$sumcan."</td>";
                                echo "<td style='text-align:right'>".$sumfob."</td>";
                                echo "<td style='text-align:right'>".$sumfre."</td>";
                                echo "<td style='text-align:right'>".$sumins."</td>";
                                echo "<td style='text-align:right'>".$sumtot."</td>";
                            echo "</tr>";
                       echo"</table>";
                   
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
        //Nacional
        if ($funcion==11)
	{
		$fecha1=trim($_POST["fecha1"]);
                $fecha2=trim($_POST["fecha2"]);
		try{
                    echo"<table class='tablesorter' id='tabla_4'> 
			<thead> 
                            <tr>
                                <th>
                                    Empresa
				</th>
				<th>
                                    Factura
				</th>
				<th>
                                    Fecha
				</th>
                                <th>
                                    N.Venta
				</th>
				<th>
                                    Cliente
				</th>
                                <th>
                                    Cajas
				</th>
				<th>
                                    SUBTOTAL
				</th>
				<th>
                                    IABA
				</th>
                                <th>
                                    IVA
				</th>
				<th>
                                    Total
				</th>
				<th>
                                    Revisar
				</th>
                            </tr> 
			</thead>";
                        /*select
                            centro_venta.centro_venta,
                            facturas.numero_factura,
                            facturas.fecha_factura,
                            nota_venta.numero_nota_venta,
                            cliente.nombre,
                            sum(detalle_nota_venta.Cantidad) as suma,
                            nota_venta.sub_total,
                            nota_venta.total_ila,
                            nota_venta.iva,
                            nota_venta.total
                            from nota_venta
                            inner join centro_venta on centro_venta.id_centro_venta=nota_venta.id_centro_venta
                            inner join facturas on facturas.numero_nota_venta=nota_venta.numero_nota_venta
                            inner join cliente on cliente.id_cliente=nota_venta.id_cliente
                            inner join detalle_nota_venta on detalle_nota_venta.crl_nota_venta=nota_venta.numero
                            where fecha_factura  >='2016-08-01' AND fecha_factura<='2016-10-26'
                            group by nota_venta.numero*/
                        $sql3="select
                            centro_venta.centro_venta,
                            facturas.numero_factura,
                            facturas.fecha_factura,
                            nota_venta.numero_nota_venta,
                            cliente.nombre,
                            sum(detalle_nota_venta.Cantidad) as suma,
                            nota_venta.sub_total,
                            nota_venta.total_ila,
                            nota_venta.iva,
                            nota_venta.total,
                            nota_venta.numero
                            from nota_venta
                            inner join centro_venta on centro_venta.id_centro_venta=nota_venta.id_centro_venta
                            inner join facturas on facturas.numero_nota_venta=nota_venta.numero_nota_venta
                            inner join cliente on cliente.id_cliente=nota_venta.id_cliente
                            inner join detalle_nota_venta on detalle_nota_venta.crl_nota_venta=nota_venta.numero
                            where fecha_factura  >='".$fecha1."' AND fecha_factura<='".$fecha2."'
                            group by nota_venta.numero";
                        /*$sql3="select
                            centro_venta.centro_venta,
                            factura_internacional.numero_factura,
                            factura_internacional.fecha_factura,
                            proforma.numero_proforma,
                            paises.pais,
                            cliente.nombre,
                            sum(detalle_proforma.Cantidad) as suma,
                            proforma.fob,
                            proforma.freight,
                            proforma.insurance,
                            proforma.total
                            from proforma
                            inner join centro_venta on centro_venta.id_centro_venta=proforma.id_centro_venta
                            inner join factura_internacional on factura_internacional.numero_proforma=proforma.numero_proforma
                            inner join cliente on cliente.id_cliente=proforma.id_cliente
                            inner join paises on paises.id_pais=cliente.pais
                            inner join detalle_proforma on detalle_proforma.numero_proforma=proforma.numero_proforma
                            where fecha_factura  >='".$fecha1."' AND fecha_factura<='".$fecha2."'
                            group by proforma.numero_proforma";*/
                        //where formulas.id_producto_padre=".$id_producto_terminado." and formulas.nivel=5";
                            $ejecuta3=mysql_query($sql3,$conexion->link);
                            $sumcan=0;
                            $sumfob=0;
                            $sumfre=0;
                            $sumins=0;
                            $sumtot=0;
                            /*
                            $sum_pre_bat=0;
                            $sumTBmezclaBAT=0;
                            $sumTBmezclaUNI=0;*/
                            mysql_query("SET NAMES 'UTF8'");
                            while ($fila3 = mysql_fetch_array($ejecuta3))
                            {
                                $sub=number_format($fila3[6], 0, '', '.');
                                $iaba=number_format($fila3[7],0, '', '.');
                                $iva=number_format($fila3[8], 0, '', '.');
                                $tot=number_format($fila3[9], 0, '', '.');
                                /*$canbat=$fila3[3]*$numbat;
                                $canbatfor=number_format($canbat, 3, '.', '');
                                $uni=number_format($fila3[5], 3, '.', '');*/
                            $fecfac= $fila3[2];
                            $fecfac = date("d-m-Y", strtotime($fecfac));
                            //date_format($fecfac, 'd/m/y');
                                echo "<tr>";
                                    echo "<td >".$fila3[0]."</td>"; 
                                    echo "<td style='text-align:right'>".utf8_decode($fila3[1])."</td>"; 
                                    echo "<td >".$fecfac."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[3]."</td>"; 
                                    echo "<td >".utf8_encode($fila3[4])."</td>"; 
                                    //echo "<td >".$fila3[5]."</td>"; 
                                    $sumcan=$sumcan+$fila3[5];
                                    echo "<td style='text-align:right'>".$fila3[5]."</td>";
                                    $sumfob=$sumfob+$fila3[6];                            
                                    echo "<td style='text-align:right'>".$sub."</td>";
                                    $sumfre=$sumfre+$fila3[7];                            
                                    echo "<td style='text-align:right'>".$iaba."</td>";
                                    $sumins=$sumins+$fila3[8];                            
                                    echo "<td style='text-align:right'>".$iva."</td>";
                                    $sumtot=$sumtot+$fila3[9];
                                    echo "<td style='text-align:right'>".$tot."</td>";
                                    echo "<td><a href='#' onClick='$(this).Detalle_ventas_nac(".$fila3[10].");' title='Revisar Detalle' class='icon-editar info-tooltip'></a></td>";
                                    //echo "<td  width='30%' style='text-align:right'>".$canbatfor."</td>"; 
                                    //echo "<td style='text-align:right'width='37%'>".$bat."</td>";         
                                    //echo "<td style='text-align:right'></td>"; 
                                    //echo "<td style='text-align:right'>".$uni."</td>"; 
                                echo "</tr>";
                            }
                            $sumfob=number_format($sumfob, 0, '', '.');
                            $sumfre=number_format($sumfre, 0, '', '.');
                            $sumins=number_format($sumins,0 , '', '.');
                            
                            echo "<tr>";
                                echo "<td style='text-align:right' colspan=5>
                                    <input type='hidden' id='tot1' value='$sumtot' />
                                    Total</td>";
                                $sumtot=number_format($sumtot, 0, ',', '.');
                                echo "<td style='text-align:right'>".$sumcan."</td>";
                                echo "<td style='text-align:right'>".$sumfob."</td>";
                                echo "<td style='text-align:right'>".$sumfre."</td>";
                                echo "<td style='text-align:right'>".$sumins."</td>";
                                echo "<td style='text-align:right'>".$sumtot."</td>";
                            echo "</tr>";
                       echo"</table>";
                   
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
        //Por Producto y Fecha
        if ($funcion==111)
	{
		$fecha1=trim($_POST["fecha1"]);
                $fecha2=trim($_POST["fecha2"]);
                $prod=trim($_POST["list_prod_term_proforma"]);
		try{
                    echo"<table class='tablesorter' id='tabla_4'> 
			<thead> 
                            <tr>
                                <th>
                                    Empresa
				</th>
				<th>
                                    Factura
				</th>
				<th>
                                    Fecha
				</th>
                                <th>
                                    N.Venta
				</th>
				<th>
                                    Cliente
				</th>
                                <th>
                                    Cajas
				</th>
				<th>
                                    SUBTOTAL
				</th>
				<th>
                                    IABA
				</th>
                                <th>
                                    IVA
				</th>
				<th>
                                    Total
				</th>
				<th>
                                    Revisar
				</th>
                            </tr> 
			</thead>";
                        
                        $sql3="select
                            centro_venta.centro_venta,
                            facturas.numero_factura,
                            facturas.fecha_factura,
                            nota_venta.numero_nota_venta,
                            cliente.nombre,
                            sum(detalle_nota_venta.Cantidad) as suma,
                            nota_venta.sub_total,
                            nota_venta.total_ila,
                            nota_venta.iva,
                            nota_venta.total,
                            nota_venta.numero
                            from nota_venta
                            inner join centro_venta on centro_venta.id_centro_venta=nota_venta.id_centro_venta
                            inner join facturas on facturas.numero_nota_venta=nota_venta.numero_nota_venta
                            inner join cliente on cliente.id_cliente=nota_venta.id_cliente
                            inner join detalle_nota_venta on detalle_nota_venta.crl_nota_venta=nota_venta.numero
                            where facturas.fecha_factura  >='".$fecha1."' AND facturas.fecha_factura<='".$fecha2."'
                            and detalle_nota_venta.id_producto='".$prod."'
                            group by nota_venta.numero";
                        /*$sql3="select
                            centro_venta.centro_venta,
                            factura_internacional.numero_factura,
                            factura_internacional.fecha_factura,
                            proforma.numero_proforma,
                            paises.pais,
                            cliente.nombre,
                            sum(detalle_proforma.Cantidad) as suma,
                            proforma.fob,
                            proforma.freight,
                            proforma.insurance,
                            proforma.total
                            from proforma
                            inner join centro_venta on centro_venta.id_centro_venta=proforma.id_centro_venta
                            inner join factura_internacional on factura_internacional.numero_proforma=proforma.numero_proforma
                            inner join cliente on cliente.id_cliente=proforma.id_cliente
                            inner join paises on paises.id_pais=cliente.pais
                            inner join detalle_proforma on detalle_proforma.numero_proforma=proforma.numero_proforma
                            where fecha_factura  >='".$fecha1."' AND fecha_factura<='".$fecha2."'
                            group by proforma.numero_proforma";*/
                        //where formulas.id_producto_padre=".$id_producto_terminado." and formulas.nivel=5";
                            $ejecuta3=mysql_query($sql3,$conexion->link);
                            $sumcan=0;
                            $sumfob=0;
                            $sumfre=0;
                            $sumins=0;
                            $sumtot=0;
                            /*
                            $sum_pre_bat=0;
                            $sumTBmezclaBAT=0;
                            $sumTBmezclaUNI=0;*/
                            mysql_query("SET NAMES 'UTF8'");
                            while ($fila3 = mysql_fetch_array($ejecuta3))
                            {
                                $sub=number_format($fila3[6], 0, '', '.');
                                $iaba=number_format($fila3[7],0, '', '.');
                                $iva=number_format($fila3[8], 0, '', '.');
                                $tot=number_format($fila3[9], 0, '', '.');
                                /*$canbat=$fila3[3]*$numbat;
                                $canbatfor=number_format($canbat, 3, '.', '');
                                $uni=number_format($fila3[5], 3, '.', '');*/
                            $fecfac= $fila3[2];
                            $fecfac = date("d-m-Y", strtotime($fecfac));
                            //date_format($fecfac, 'd/m/y');
                                echo "<tr>";
                                    echo "<td >".$fila3[0]."</td>"; 
                                    echo "<td style='text-align:right'>".utf8_decode($fila3[1])."</td>"; 
                                    echo "<td >".$fecfac."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[3]."</td>"; 
                                    echo "<td >".utf8_encode($fila3[4])."</td>"; 
                                    //echo "<td >".$fila3[5]."</td>"; 
                                    $sumcan=$sumcan+$fila3[5];
                                    echo "<td style='text-align:right'>".$fila3[5]."</td>";
                                    $sumfob=$sumfob+$fila3[6];                            
                                    echo "<td style='text-align:right'>".$sub."</td>";
                                    $sumfre=$sumfre+$fila3[7];                            
                                    echo "<td style='text-align:right'>".$iaba."</td>";
                                    $sumins=$sumins+$fila3[8];                            
                                    echo "<td style='text-align:right'>".$iva."</td>";
                                    $sumtot=$sumtot+$fila3[9];
                                    echo "<td style='text-align:right'>".$tot."</td>";
                                    echo "<td><a href='#' onClick='$(this).Detalle_ventas_nac(".$fila3[10].");' title='Revisar Detalle' class='icon-editar info-tooltip'></a></td>";
                                    //echo "<td  width='30%' style='text-align:right'>".$canbatfor."</td>"; 
                                    //echo "<td style='text-align:right'width='37%'>".$bat."</td>";         
                                    //echo "<td style='text-align:right'></td>"; 
                                    //echo "<td style='text-align:right'>".$uni."</td>"; 
                                echo "</tr>";
                            }
                            $sumfob=number_format($sumfob, 0, '', '.');
                            $sumfre=number_format($sumfre, 0, '', '.');
                            $sumins=number_format($sumins,0 , '', '.');
                            
                            echo "<tr>";
                                echo "<td style='text-align:right' colspan=5>
                                    <input type='hidden' id='tot1' value='$sumtot' />
                                    Total</td>";
                                $sumtot=number_format($sumtot, 0, ',', '.');
                                echo "<td style='text-align:right'>".$sumcan."</td>";
                                echo "<td style='text-align:right'>".$sumfob."</td>";
                                echo "<td style='text-align:right'>".$sumfre."</td>";
                                echo "<td style='text-align:right'>".$sumins."</td>";
                                echo "<td style='text-align:right'>".$sumtot."</td>";
                            echo "</tr>";
                       echo"</table>";
                   
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
        /*Por Fecha y Cliente*/
        if ($funcion==112)
	{
		$fecha1=trim($_POST["fecha1"]);
                $fecha2=trim($_POST["fecha2"]);
                $cli=trim($_POST["id_cliente"]);
		try{
                    echo"<table class='tablesorter' id='tabla_4'> 
			<thead> 
                            <tr>
                                <th>
                                    Empresa
				</th>
				<th>
                                    Factura
				</th>
				<th>
                                    Fecha
				</th>
                                <th>
                                    N.Venta
				</th>
				<th>
                                    Cliente
				</th>
                                <th>
                                    Cajas
				</th>
				<th>
                                    SUBTOTAL
				</th>
				<th>
                                    IABA
				</th>
                                <th>
                                    IVA
				</th>
				<th>
                                    Total
				</th>
				<th>
                                    Revisar
				</th>
                            </tr> 
			</thead>";
                        
                        $sql3="select
                            centro_venta.centro_venta,
                            facturas.numero_factura,
                            facturas.fecha_factura,
                            nota_venta.numero_nota_venta,
                            cliente.nombre,
                            sum(detalle_nota_venta.Cantidad) as suma,
                            nota_venta.sub_total,
                            nota_venta.total_ila,
                            nota_venta.iva,
                            nota_venta.total,
                            nota_venta.numero
                            from nota_venta
                            inner join centro_venta on centro_venta.id_centro_venta=nota_venta.id_centro_venta
                            inner join facturas on facturas.numero_nota_venta=nota_venta.numero_nota_venta
                            inner join cliente on cliente.id_cliente=nota_venta.id_cliente
                            inner join detalle_nota_venta on detalle_nota_venta.crl_nota_venta=nota_venta.numero
                            where fecha_factura  >='".$fecha1."' AND fecha_factura<='".$fecha2."'
                            and nota_venta.id_cliente='".$cli."'
                            group by nota_venta.numero";
                      
                            $ejecuta3=mysql_query($sql3,$conexion->link);
                            $sumcan=0;
                            $sumfob=0;
                            $sumfre=0;
                            $sumins=0;
                            $sumtot=0;
                            /*
                            $sum_pre_bat=0;
                            $sumTBmezclaBAT=0;
                            $sumTBmezclaUNI=0;*/
                            mysql_query("SET NAMES 'UTF8'");
                            while ($fila3 = mysql_fetch_array($ejecuta3))
                            {
                                $sub=number_format($fila3[6], 0, '', '.');
                                $iaba=number_format($fila3[7],0, '', '.');
                                $iva=number_format($fila3[8], 0, '', '.');
                                $tot=number_format($fila3[9], 0, '', '.');
                                /*$canbat=$fila3[3]*$numbat;
                                $canbatfor=number_format($canbat, 3, '.', '');
                                $uni=number_format($fila3[5], 3, '.', '');*/
                            $fecfac= $fila3[2];
                            $fecfac = date("d-m-Y", strtotime($fecfac));
                            //date_format($fecfac, 'd/m/y');
                                echo "<tr>";
                                    echo "<td >".$fila3[0]."</td>"; 
                                    echo "<td style='text-align:right'>".utf8_decode($fila3[1])."</td>"; 
                                    echo "<td >".$fecfac."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[3]."</td>"; 
                                    echo "<td >".utf8_encode($fila3[4])."</td>"; 
                                    //echo "<td >".$fila3[5]."</td>"; 
                                    $sumcan=$sumcan+$fila3[5];
                                    echo "<td style='text-align:right'>".$fila3[5]."</td>";
                                    $sumfob=$sumfob+$fila3[6];                            
                                    echo "<td style='text-align:right'>".$sub."</td>";
                                    $sumfre=$sumfre+$fila3[7];                            
                                    echo "<td style='text-align:right'>".$iaba."</td>";
                                    $sumins=$sumins+$fila3[8];                            
                                    echo "<td style='text-align:right'>".$iva."</td>";
                                    $sumtot=$sumtot+$fila3[9];
                                    echo "<td style='text-align:right'>".$tot."</td>";
                                    echo "<td><a href='#' onClick='$(this).Detalle_ventas_nac(".$fila3[10].");' title='Revisar Detalle' class='icon-editar info-tooltip'></a></td>";
                                    //echo "<td  width='30%' style='text-align:right'>".$canbatfor."</td>"; 
                                    //echo "<td style='text-align:right'width='37%'>".$bat."</td>";         
                                    //echo "<td style='text-align:right'></td>"; 
                                    //echo "<td style='text-align:right'>".$uni."</td>"; 
                                echo "</tr>";
                            }
                            $sumfob=number_format($sumfob, 0, '', '.');
                            $sumfre=number_format($sumfre, 0, '', '.');
                            $sumins=number_format($sumins,0 , '', '.');
                            
                            echo "<tr>";
                                echo "<td style='text-align:right' colspan=5>
                                    <input type='hidden' id='tot1' value='$sumtot' />
                                    Total</td>";
                                $sumtot=number_format($sumtot, 0, ',', '.');
                                echo "<td style='text-align:right'>".$sumcan."</td>";
                                echo "<td style='text-align:right'>".$sumfob."</td>";
                                echo "<td style='text-align:right'>".$sumfre."</td>";
                                echo "<td style='text-align:right'>".$sumins."</td>";
                                echo "<td style='text-align:right'>".$sumtot."</td>";
                            echo "</tr>";
                       echo"</table>";
                   
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
	if ($funcion==2)
	{
		$id_cliente_int=trim($_POST["id_cliente_int"]);
                //$fecha2=trim($_POST["fecha2"]);
		try{
                    echo"<table class='tablesorter' id='tabla_4'> 
			<thead> 
                            <tr>
                                <th>
                                    Empresa
				</th>
				<th>
                                    Factura
				</th>
				<th>
                                    Fecha
				</th>
                                <th>
                                    Proforma
				</th>
				<th>
                                    Pais
				</th>
				<th>
                                    Cliente
				</th>
                                <th>
                                    Cajas
				</th>
				<th>
                                    FOB
				</th>
				<th>
                                    Freight
				</th>
                                <th>
                                    Insurance
				</th>
				<th>
                                    Total
				</th>
				<th>
                                    Revisar
				</th>
                            </tr> 
			</thead>";
                        $sql3="select
                            centro_venta.centro_venta,
                            factura_internacional.numero_factura,
                            factura_internacional.fecha_factura,
                            proforma.numero_proforma,
                            paises.pais,
                            cliente.nombre,
                            sum(detalle_proforma.Cantidad) as suma,
                            proforma.fob,
                            proforma.freight,
                            proforma.insurance,
                            proforma.total
                            from proforma
                            inner join centro_venta on centro_venta.id_centro_venta=proforma.id_centro_venta
                            inner join factura_internacional on factura_internacional.numero_proforma=proforma.numero_proforma
                            inner join cliente on cliente.id_cliente=proforma.id_cliente
                            inner join paises on paises.id_pais=cliente.pais
                            inner join detalle_proforma on detalle_proforma.numero_proforma=proforma.numero_proforma
                            where proforma.id_cliente='".$id_cliente_int."'
                            group by proforma.numero_proforma
                            ";//$id_cliente_int
                        //where formulas.id_producto_padre=".$id_producto_terminado." and formulas.nivel=5";
                            $ejecuta3=mysql_query($sql3,$conexion->link);
                            $sumcan=0;
                            $sumfob=0;
                            $sumfre=0;
                            $sumins=0;
                            $sumtot=0;
                            /*
                            $sum_pre_bat=0;
                            $sumTBmezclaBAT=0;
                            $sumTBmezclaUNI=0;*/
                            mysql_query("SET NAMES 'UTF8'");
                            while ($fila3 = mysql_fetch_array($ejecuta3))
                            {
                                /*$canbat=$fila3[3]*$numbat;
                                $bat=number_format($fila3[3], 3, '.', '');
                                $canbatfor=number_format($canbat, 3, '.', '');
                                $uni=number_format($fila3[5], 3, '.', '');*/
                            $fecfac= $fila3[2];
                            $fecfac = date("d-m-Y", strtotime($fecfac));
                            //date_format($fecfac, 'd/m/y');
                                echo "<tr>";
                                    echo "<td >".$fila3[0]."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[1]."</td>"; 
                                    echo "<td >".$fecfac."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[3]."</td>"; 
                                    echo "<td >".utf8_encode($fila3[4])."</td>"; 
                                    echo "<td >".$fila3[5]."</td>"; 
                                    $sumcan=$sumcan+$fila3[6];
                                    echo "<td style='text-align:right'>".$fila3[6]."</td>";
                                    $sumfob=$sumfob+$fila3[7];                            
                                    echo "<td style='text-align:right'>".$fila3[7]."</td>";
                                    $sumfre=$sumfre+$fila3[8];                            
                                    echo "<td style='text-align:right'>".$fila3[8]."</td>";
                                    $sumins=$sumins+$fila3[9];                            
                                    echo "<td style='text-align:right'>".$fila3[9]."</td>";
                                    $sumtot=$sumtot+$fila3[10];
                                    echo "<td style='text-align:right'>".$fila3[10]."</td>";
                                    echo "<td><a href='#' onClick='$(this).Detalle_ventas_export(".$fila3[3].");' title='Revisar Detalle' class='icon-editar info-tooltip'></a></td>";
                                    //echo "<td  width='30%' style='text-align:right'>".$canbatfor."</td>"; 
                                    //echo "<td style='text-align:right'width='37%'>".$bat."</td>";         
                                    //echo "<td style='text-align:right'></td>"; 
                                    //echo "<td style='text-align:right'>".$uni."</td>"; 
                                echo "</tr>";
                            }
                            echo "<tr>";
                                echo "<td style='text-align:right' colspan=6>Total</td>";
                                echo "<td style='text-align:right'>".$sumcan."</td>";
                                echo "<td style='text-align:right'>".$sumfob."</td>";
                                echo "<td style='text-align:right'>".$sumfre."</td>";
                                echo "<td style='text-align:right'>".$sumins."</td>";
                                echo "<td style='text-align:right'>".$sumtot."</td>";
                            echo "</tr>";
                       echo"</table>";
                   
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
        if ($funcion==3)
	{
		$list_prod_term_proforma=trim($_POST["list_prod_term_proforma"]);
                //$fecha2=trim($_POST["fecha2"]);
		try{
                    echo"<table class='tablesorter' id='tabla_4'> 
			<thead> 
                            <tr>
                                <th>
                                    Empresa
				</th>
				<th>
                                    Factura
				</th>
				<th>
                                    Fecha
				</th>
                                <th>
                                    Proforma
				</th>
				<th>
                                    Pais
				</th>
				<th>
                                    Cliente
				</th>
                                <th>
                                    Cajas
				</th>
				<th>
                                    FOB
				</th>
				<th>
                                    Freight
				</th>
                                <th>
                                    Insurance
				</th>
				<th>
                                    Total
				</th>
				<th>
                                    Revisar
				</th>
                            </tr> 
			</thead>";
                        $sql3="select
                            centro_venta.centro_venta,
                            factura_internacional.numero_factura,
                            factura_internacional.fecha_factura,
                            proforma.numero_proforma,
                            paises.pais,
                            cliente.nombre,
                            sum(detalle_proforma.Cantidad) as suma,
                            proforma.fob,
                            proforma.freight,
                            proforma.insurance,
                            proforma.total
                            from proforma
                            inner join centro_venta on centro_venta.id_centro_venta=proforma.id_centro_venta
                            inner join factura_internacional on factura_internacional.numero_proforma=proforma.numero_proforma
                            inner join cliente on cliente.id_cliente=proforma.id_cliente
                            inner join paises on paises.id_pais=cliente.pais
                            inner join detalle_proforma on detalle_proforma.numero_proforma=proforma.numero_proforma
                            where detalle_proforma.id_producto='".$list_prod_term_proforma."'
                            group by proforma.numero_proforma
                            ";//$list_prod_term_proforma
                        //where formulas.id_producto_padre=".$id_producto_terminado." and formulas.nivel=5";
                            $ejecuta3=mysql_query($sql3,$conexion->link);
                            $sumcan=0;
                            $sumfob=0;
                            $sumfre=0;
                            $sumins=0;
                            $sumtot=0;
                            /*
                            $sum_pre_bat=0;
                            $sumTBmezclaBAT=0;
                            $sumTBmezclaUNI=0;*/
                            mysql_query("SET NAMES 'UTF8'");
                            while ($fila3 = mysql_fetch_array($ejecuta3))
                            {
                                /*$canbat=$fila3[3]*$numbat;
                                $bat=number_format($fila3[3], 3, '.', '');
                                $canbatfor=number_format($canbat, 3, '.', '');
                                $uni=number_format($fila3[5], 3, '.', '');*/
                            $fecfac= $fila3[2];
                            $fecfac = date("d-m-Y", strtotime($fecfac));
                            //date_format($fecfac, 'd/m/y');
                                echo "<tr>";
                                    echo "<td >".$fila3[0]."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[1]."</td>"; 
                                    echo "<td >".$fecfac."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[3]."</td>"; 
                                    echo "<td >".utf8_encode($fila3[4])."</td>"; 
                                    echo "<td >".$fila3[5]."</td>"; 
                                    $sumcan=$sumcan+$fila3[6];
                                    echo "<td style='text-align:right'>".$fila3[6]."</td>";
                                    $sumfob=$sumfob+$fila3[7];                            
                                    echo "<td style='text-align:right'>".$fila3[7]."</td>";
                                    $sumfre=$sumfre+$fila3[8];                            
                                    echo "<td style='text-align:right'>".$fila3[8]."</td>";
                                    $sumins=$sumins+$fila3[9];                            
                                    echo "<td style='text-align:right'>".$fila3[9]."</td>";
                                    $sumtot=$sumtot+$fila3[10];
                                    echo "<td style='text-align:right'>".$fila3[10]."</td>";
                                    echo "<td><a href='#' onClick='$(this).Detalle_ventas_export(".$fila3[3].");' title='Revisar Detalle' class='icon-editar info-tooltip'></a></td>";
                                    //echo "<td  width='30%' style='text-align:right'>".$canbatfor."</td>"; 
                                    //echo "<td style='text-align:right'width='37%'>".$bat."</td>";         
                                    //echo "<td style='text-align:right'></td>"; 
                                    //echo "<td style='text-align:right'>".$uni."</td>"; 
                                echo "</tr>";
                            }
                            echo "<tr>";
                                echo "<td style='text-align:right' colspan=6>Total</td>";
                                echo "<td style='text-align:right'>".$sumcan."</td>";
                                echo "<td style='text-align:right'>".$sumfob."</td>";
                                echo "<td style='text-align:right'>".$sumfre."</td>";
                                echo "<td style='text-align:right'>".$sumins."</td>";
                                echo "<td style='text-align:right'>".$sumtot."</td>";
                            echo "</tr>";
                       echo"</table>";
                   
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
        if ($funcion==4)
	{
		$fecha1=trim($_POST["fecha1"]);
                $fecha2=trim($_POST["fecha2"]);
                $id_cliente_int=trim($_POST["id_cliente_int"]);
		try{
                    echo"<table class='tablesorter' id='tabla_4'> 
			<thead> 
                            <tr>
                                <th>
                                    Empresa
				</th>
				<th>
                                    Factura
				</th>
				<th>
                                    Fecha
				</th>
                                <th>
                                    Proforma
				</th>
				<th>
                                    Pais
				</th>
				<th>
                                    Cliente
				</th>
                                <th>
                                    Cajas
				</th>
				<th>
                                    FOB
				</th>
				<th>
                                    Freight
				</th>
                                <th>
                                    Insurance
				</th>
				<th>
                                    Total
				</th>
				<th>
                                    Revisar
				</th>
                            </tr> 
			</thead>";
                        $sql3="select
                            centro_venta.centro_venta,
                            factura_internacional.numero_factura,
                            factura_internacional.fecha_factura,
                            proforma.numero_proforma,
                            paises.pais,
                            cliente.nombre,
                            sum(detalle_proforma.Cantidad) as suma,
                            proforma.fob,
                            proforma.freight,
                            proforma.insurance,
                            proforma.total
                            from proforma
                            inner join centro_venta on centro_venta.id_centro_venta=proforma.id_centro_venta
                            inner join factura_internacional on factura_internacional.numero_proforma=proforma.numero_proforma
                            inner join cliente on cliente.id_cliente=proforma.id_cliente
                            inner join paises on paises.id_pais=cliente.pais
                            inner join detalle_proforma on detalle_proforma.numero_proforma=proforma.numero_proforma
                            where fecha_factura  >='".$fecha1."' AND fecha_factura<='".$fecha2."' and proforma.id_cliente='".$id_cliente_int."'
                            group by proforma.numero_proforma
                            ";//$fecha1
                        //where formulas.id_producto_padre=".$id_producto_terminado." and formulas.nivel=5";
                            $ejecuta3=mysql_query($sql3,$conexion->link);
                            $sumcan=0;
                            $sumfob=0;
                            $sumfre=0;
                            $sumins=0;
                            $sumtot=0;
                            /*
                            $sum_pre_bat=0;
                            $sumTBmezclaBAT=0;
                            $sumTBmezclaUNI=0;*/
                            mysql_query("SET NAMES 'UTF8'");
                            while ($fila3 = mysql_fetch_array($ejecuta3))
                            {
                                /*$canbat=$fila3[3]*$numbat;
                                $bat=number_format($fila3[3], 3, '.', '');
                                $canbatfor=number_format($canbat, 3, '.', '');
                                $uni=number_format($fila3[5], 3, '.', '');*/
                            $fecfac= $fila3[2];
                            $fecfac = date("d-m-Y", strtotime($fecfac));
                            //date_format($fecfac, 'd/m/y');
                                echo "<tr>";
                                    echo "<td >".$fila3[0]."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[1]."</td>"; 
                                    echo "<td >".$fecfac."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[3]."</td>"; 
                                    echo "<td >".utf8_encode($fila3[4])."</td>"; 
                                    echo "<td >".$fila3[5]."</td>"; 
                                    $sumcan=$sumcan+$fila3[6];
                                    echo "<td style='text-align:right'>".$fila3[6]."</td>";
                                    $sumfob=$sumfob+$fila3[7];                            
                                    echo "<td style='text-align:right'>".$fila3[7]."</td>";
                                    $sumfre=$sumfre+$fila3[8];                            
                                    echo "<td style='text-align:right'>".$fila3[8]."</td>";
                                    $sumins=$sumins+$fila3[9];                            
                                    echo "<td style='text-align:right'>".$fila3[9]."</td>";
                                    $sumtot=$sumtot+$fila3[10];
                                    echo "<td style='text-align:right'>".$fila3[10]."</td>";
                                    echo "<td><a href='#' onClick='$(this).Detalle_ventas_export(".$fila3[3].");' title='Revisar Detalle' class='icon-editar info-tooltip'></a></td>";
                                    //echo "<td  width='30%' style='text-align:right'>".$canbatfor."</td>"; 
                                    //echo "<td style='text-align:right'width='37%'>".$bat."</td>";         
                                    //echo "<td style='text-align:right'></td>"; 
                                    //echo "<td style='text-align:right'>".$uni."</td>"; 
                                echo "</tr>";
                            }
                            echo "<tr>";
                                echo "<td style='text-align:right' colspan=6>Total</td>";
                                echo "<td style='text-align:right'>".$sumcan."</td>";
                                echo "<td style='text-align:right'>".$sumfob."</td>";
                                echo "<td style='text-align:right'>".$sumfre."</td>";
                                echo "<td style='text-align:right'>".$sumins."</td>";
                                echo "<td style='text-align:right'>".$sumtot."</td>";
                            echo "</tr>";
                       echo"</table>";
                   
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
        if ($funcion==5)
	{
		$fecha1=trim($_POST["fecha1"]);
                $fecha2=trim($_POST["fecha2"]);
                $list_prod_term_proforma=trim($_POST["list_prod_term_proforma"]);
		try{
                    echo"<table class='tablesorter' id='tabla_4'> 
			<thead> 
                            <tr>
                                <th>
                                    Empresa
				</th>
				<th>
                                    Factura
				</th>
				<th>
                                    Fecha
				</th>
                                <th>
                                    Proforma
				</th>
				<th>
                                    Pais
				</th>
				<th>
                                    Cliente
				</th>
                                <th>
                                    Cajas
				</th>
				<th>
                                    FOB
				</th>
				<th>
                                    Freight
				</th>
                                <th>
                                    Insurance
				</th>
				<th>
                                    Total
				</th>
				<th>
                                    Revisar
				</th>
                            </tr> 
			</thead>";
                        $sql3="select
                            centro_venta.centro_venta,
                            factura_internacional.numero_factura,
                            factura_internacional.fecha_factura,
                            proforma.numero_proforma,
                            paises.pais,
                            cliente.nombre,
                            sum(detalle_proforma.Cantidad) as suma,
                            proforma.fob,
                            proforma.freight,
                            proforma.insurance,
                            proforma.total
                            from proforma
                            inner join centro_venta on centro_venta.id_centro_venta=proforma.id_centro_venta
                            inner join factura_internacional on factura_internacional.numero_proforma=proforma.numero_proforma
                            inner join cliente on cliente.id_cliente=proforma.id_cliente
                            inner join paises on paises.id_pais=cliente.pais
                            inner join detalle_proforma on detalle_proforma.numero_proforma=proforma.numero_proforma
                            where fecha_factura  >='".$fecha1."' AND fecha_factura<='".$fecha2."' and detalle_proforma.id_producto='".$list_prod_term_proforma."'
                            group by proforma.numero_proforma
                            ";//$fecha1
                        //where formulas.id_producto_padre=".$id_producto_terminado." and formulas.nivel=5";
                            $ejecuta3=mysql_query($sql3,$conexion->link);
                            $sumcan=0;
                            $sumfob=0;
                            $sumfre=0;
                            $sumins=0;
                            $sumtot=0;
                            /*
                            $sum_pre_bat=0;
                            $sumTBmezclaBAT=0;
                            $sumTBmezclaUNI=0;*/
                            mysql_query("SET NAMES 'UTF8'");
                            while ($fila3 = mysql_fetch_array($ejecuta3))
                            {
                                /*$canbat=$fila3[3]*$numbat;
                                $bat=number_format($fila3[3], 3, '.', '');
                                $canbatfor=number_format($canbat, 3, '.', '');
                                $uni=number_format($fila3[5], 3, '.', '');*/
                            $fecfac= $fila3[2];
                            $fecfac = date("d-m-Y", strtotime($fecfac));
                            //date_format($fecfac, 'd/m/y');
                                echo "<tr>";
                                    echo "<td >".$fila3[0]."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[1]."</td>"; 
                                    echo "<td >".$fecfac."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[3]."</td>"; 
                                    echo "<td >".utf8_encode($fila3[4])."</td>"; 
                                    echo "<td >".$fila3[5]."</td>"; 
                                    $sumcan=$sumcan+$fila3[6];
                                    echo "<td style='text-align:right'>".$fila3[6]."</td>";
                                    $sumfob=$sumfob+$fila3[7];                            
                                    echo "<td style='text-align:right'>".$fila3[7]."</td>";
                                    $sumfre=$sumfre+$fila3[8];                            
                                    echo "<td style='text-align:right'>".$fila3[8]."</td>";
                                    $sumins=$sumins+$fila3[9];                            
                                    echo "<td style='text-align:right'>".$fila3[9]."</td>";
                                    $sumtot=$sumtot+$fila3[10];
                                    echo "<td style='text-align:right'>".$fila3[10]."</td>";
                                    echo "<td><a href='#' onClick='$(this).Detalle_ventas_export(".$fila3[3].");' title='Revisar Detalle' class='icon-editar info-tooltip'></a></td>";
                                    //echo "<td  width='30%' style='text-align:right'>".$canbatfor."</td>"; 
                                    //echo "<td style='text-align:right'width='37%'>".$bat."</td>";         
                                    //echo "<td style='text-align:right'></td>"; 
                                    //echo "<td style='text-align:right'>".$uni."</td>"; 
                                echo "</tr>";
                            }
                            echo "<tr>";
                                echo "<td style='text-align:right' colspan=6>Total</td>";
                                echo "<td style='text-align:right'>".$sumcan."</td>";
                                echo "<td style='text-align:right'>".$sumfob."</td>";
                                echo "<td style='text-align:right'>".$sumfre."</td>";
                                echo "<td style='text-align:right'>".$sumins."</td>";
                                echo "<td style='text-align:right'>".$sumtot."</td>";
                            echo "</tr>";
                       echo"</table>";
                   
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
        if ($funcion==6)
	{
		$fecha1=trim($_POST["fecha1"]);
                $fecha2=trim($_POST["fecha2"]);
                $tot1=trim($_POST["tot1"]);
		try{
                    echo"<table class='tablesorter' id='tabla_4'> 
			<thead> 
                            <tr>
                                <th>
                                    Empresa
				</th>
				<th>
                                    Factura
				</th>
				<th>
                                    Fecha
				</th>
                                <th>
                                    N. Credito
				</th>
                                <th>
                                    Observación
				</th>
				<th >
                                    Total
				</th>				
                            </tr> 
			</thead>";
                        $sql3="select
                            centro_venta.centro_venta,
                            factura_internacional.numero_factura,
                            factura_internacional.fecha_factura,
                            nota_de_credito_exportacion.numero_nota_credito,
                            nota_de_credito_exportacion.observacion_nota_credito,
                            nota_de_credito_exportacion.total                     
                            from proforma
                            inner join centro_venta on centro_venta.id_centro_venta=proforma.id_centro_venta
                            inner join factura_internacional on factura_internacional.numero_proforma=proforma.numero_proforma
                            inner join nota_de_credito_exportacion on factura_internacional.numero_factura=nota_de_credito_exportacion.numero_factura
                            inner join cliente on cliente.id_cliente=proforma.id_cliente
                            inner join paises on paises.id_pais=cliente.pais
                            inner join detalle_proforma on detalle_proforma.numero_proforma=proforma.numero_proforma
                            where fecha_factura  >='".$fecha1."' AND fecha_factura<='".$fecha2."'
                            group by proforma.numero_proforma
                            ";//$fecha1
                        //where formulas.id_producto_padre=".$id_producto_terminado." and formulas.nivel=5";
                            $ejecuta3=mysql_query($sql3,$conexion->link);
                            $sumtot=0;
                            /*
                            $sum_pre_bat=0;
                            $sumTBmezclaBAT=0;
                            $sumTBmezclaUNI=0;*/
                            mysql_query("SET NAMES 'UTF8'");
                            while ($fila3 = mysql_fetch_array($ejecuta3))
                            {
                                /*$canbat=$fila3[3]*$numbat;
                                $bat=number_format($fila3[3], 3, '.', '');
                                $canbatfor=number_format($canbat, 3, '.', '');
                                $uni=number_format($fila3[5], 3, '.', '');*/
                            $fecfac= $fila3[2];
                            $fecfac = date("d-m-Y", strtotime($fecfac));
                            //date_format($fecfac, 'd/m/y');
                                echo "<tr>";
                                    echo "<td >".$fila3[0]."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[1]."</td>"; 
                                    echo "<td >".$fecfac."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[3]."</td>"; 
                                    echo "<td>".utf8_encode($fila3[4])."</td>"; 
                                    $cre=number_format($fila3[5], 2, '.', ',');
                                    echo "<td style='text-align:right'>".$cre."</td>"; 
                                 echo "</tr>";
                                 $sumtot=$sumtot+$fila3[5];
                            }
                            echo "<tr>";
                                echo "<td style='text-align:right' colspan=5>
                                    Total</td>";
                                $sumtot=number_format($sumtot, 2, '.', ',');
                                echo "<td style='text-align:right'>".$sumtot."</td>";                                
                            echo "</tr>";
                            
                            echo "<tr>";
                                echo "<td style='text-align:right' colspan=5>
                                    <h2>Total Vendido</h2></td>";
                                $total=$tot1-$sumtot;
                                $total=number_format($total, 2, '.', ',');
                                echo "<td style='text-align:right'><h2>".$total."</h2></td>";                                
                            echo "</tr>";
                       echo"</table>";
                   
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
        if ($funcion==61)
	{
		$fecha1=trim($_POST["fecha1"]);
                $fecha2=trim($_POST["fecha2"]);
                $tot1=trim($_POST["tot1"]);
		try{
                    echo"<table class='tablesorter' id='tabla_4'> 
			<thead> 
                            <tr>
                                <th>
                                    Empresa
				</th>
				<th>
                                    Factura
				</th>
				<th>
                                    Fecha
				</th>
                                <th>
                                    N. Credito
				</th>
                                <th>
                                    Observación
				</th>
				<th >
                                    Total
				</th>
                                <th >
                                    Ver
				</th>
                            </tr> 
			</thead>";
                        $sql3="select
                            centro_venta.centro_venta,
                            facturas.numero_factura,
                            facturas.fecha_factura,
                            nota_de_credito.numero_nota_credito,
                            nota_de_credito.observacion,
                            nota_de_credito.total,
                            centro_venta.id_centro_venta
                            from nota_venta
                            inner join centro_venta on centro_venta.id_centro_venta=nota_venta.id_centro_venta
                            inner join facturas on facturas.numero_nota_venta=nota_venta.numero_nota_venta
                            inner join nota_de_credito on facturas.numero_factura=nota_de_credito.numero_factura
                            inner join cliente on cliente.id_cliente=nota_venta.id_cliente
                            inner join detalle_nota_credito on detalle_nota_credito.id_nc=nota_de_credito.id_nc
                            where fecha_factura  >='".$fecha1."' AND fecha_factura<='".$fecha2."'
                            group by nota_venta.numero_nota_venta
                            ";//$fecha1
                        //where formulas.id_producto_padre=".$id_producto_terminado." and formulas.nivel=5";
                            $ejecuta3=mysql_query($sql3,$conexion->link);
                            $sumtot=0;
                            /*
                            $sum_pre_bat=0;
                            $sumTBmezclaBAT=0;
                            $sumTBmezclaUNI=0;*/
                            mysql_query("SET NAMES 'UTF8'");
                            while ($fila3 = mysql_fetch_array($ejecuta3))
                            {
                                /*$canbat=$fila3[3]*$numbat;
                                $bat=number_format($fila3[3], 3, '.', '');
                                $canbatfor=number_format($canbat, 3, '.', '');
                                $uni=number_format($fila3[5], 3, '.', '');*/
                            $fecfac= $fila3[2];
                            $fecfac = date("d-m-Y", strtotime($fecfac));
                            //date_format($fecfac, 'd/m/y');
                                echo "<tr>";
                                    echo "<td >".$fila3[0]."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[1]."</td>"; 
                                    echo "<td >".$fecfac."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[3]."</td>"; 
                                    echo "<td>".utf8_encode($fila3[4])."</td>"; 
                                    $cre=number_format($fila3[5], 0, ',', '.');
                                    echo "<td style='text-align:right'>".$cre."</td>"; 
                                    echo "<td><a href='#' onClick='$(this).Detalle_ventas_nac_cre(".$fila3[3].",".$fila3[6].");' title='Revisar Detalle' class='icon-editar info-tooltip'></a></td>";
                                 echo "</tr>";
                                 $sumtot=$sumtot+$fila3[5];
                            }
                            echo "<tr>";
                                echo "<td style='text-align:right' colspan=5>
                                    Total</td>";
                                $sumtotcre=number_format($sumtot, 0, ',', '.');
                                echo "<td style='text-align:right'>".$sumtotcre."</td>";                                
                            echo "</tr>";
                            
                            
                            echo "<tr>";
                                echo "<td style='text-align:right' colspan=5>
                                    <h1>Total Vendido</h1></td>";
                                $total=$tot1-$sumtot;
                                $total=number_format($total, 0, ',', '.');
                                echo "<td style='text-align:right'><h1>".$total."</h1></td>";                                
                            echo "</tr>";
                       echo"</table>";
                   
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
        //con PROD
        if ($funcion==611)
	{
		$fecha1=trim($_POST["fecha1"]);
                $fecha2=trim($_POST["fecha2"]);
                $prod=trim($_POST["list_prod_term_proforma"]);
                $tot1=trim($_POST["tot1"]);
		try{
                    echo"<table class='tablesorter' id='tabla_4'> 
			<thead> 
                            <tr>
                                <th>
                                    Empresa
				</th>
				<th>
                                    Factura
				</th>
				<th>
                                    Fecha
				</th>
                                <th>
                                    N. Credito
				</th>
                                <th>
                                    Observación
				</th>
				<th >
                                    Total
				</th>				
                            </tr> 
			</thead>";
                        $sql3="select
                            centro_venta.centro_venta,
                            facturas.numero_factura,
                            facturas.fecha_factura,
                            nota_de_credito.numero_nota_credito,
                            nota_de_credito.observacion,
                            nota_de_credito.total,
                            centro_venta.id_centro_venta                     
                            from nota_venta
                            inner join centro_venta on centro_venta.id_centro_venta=nota_venta.id_centro_venta
                            inner join facturas on facturas.numero_nota_venta=nota_venta.numero_nota_venta
                            inner join nota_de_credito on facturas.numero_factura=nota_de_credito.numero_factura
                            inner join cliente on cliente.id_cliente=nota_venta.id_cliente
                            inner join detalle_nota_credito on detalle_nota_credito.id_nc=nota_de_credito.id_nc
                            where fecha_factura  >='".$fecha1."' AND fecha_factura<='".$fecha2."'
                            and id_producto='".$prod."'
                            group by nota_venta.numero_nota_venta
                            ";//$fecha1
                        //where formulas.id_producto_padre=".$id_producto_terminado." and formulas.nivel=5";
                            $ejecuta3=mysql_query($sql3,$conexion->link);
                            $sumtot=0;
                            /*
                            $sum_pre_bat=0;
                            $sumTBmezclaBAT=0;
                            $sumTBmezclaUNI=0;*/
                            mysql_query("SET NAMES 'UTF8'");
                            while ($fila3 = mysql_fetch_array($ejecuta3))
                            {
                                /*$canbat=$fila3[3]*$numbat;
                                $bat=number_format($fila3[3], 3, '.', '');
                                $canbatfor=number_format($canbat, 3, '.', '');
                                $uni=number_format($fila3[5], 3, '.', '');*/
                            $fecfac= $fila3[2];
                            $fecfac = date("d-m-Y", strtotime($fecfac));
                            //date_format($fecfac, 'd/m/y');
                                echo "<tr>";
                                    echo "<td >".$fila3[0]."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[1]."</td>"; 
                                    echo "<td >".$fecfac."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[3]."</td>"; 
                                    echo "<td>".utf8_encode($fila3[4])."</td>"; 
                                    $cre=number_format($fila3[5], 0, ',', '.');
                                    echo "<td style='text-align:right'>".$cre."</td>"; 
                                    echo "<td><a href='#' onClick='$(this).Detalle_ventas_nac_cre(".$fila3[3].",".$fila3[6].");' title='Revisar Detalle' class='icon-editar info-tooltip'></a></td>";
                                 echo "</tr>";
                                 $sumtot=$sumtot+$fila3[5];
                            }
                            echo "<tr>";
                                echo "<td style='text-align:right' colspan=5>
                                    Total</td>";
                                $sumtotcre=number_format($sumtot, 0, ',', '.');
                                echo "<td style='text-align:right'>".$sumtotcre."</td>";                                
                            echo "</tr>";
                            
                            echo "<tr>";
                                echo "<td style='text-align:right' colspan=5>
                                    <h2>Total Vendido</h2></td>";
                                $total=$tot1-$sumtot;
                                $total=number_format($total, 0, ',', '.');
                                echo "<td style='text-align:right'><h2>".$total."</h2></td>";                                
                            echo "</tr>";
                       echo"</table>";
                   
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
        /*FECHA Y CLI CRED*/
        if ($funcion==612)
	{
		$fecha1=trim($_POST["fecha1"]);
                $fecha2=trim($_POST["fecha2"]);
                $cli=trim($_POST["id_cliente"]);
                $tot1=trim($_POST["tot1"]);
		try{
                    echo"<table class='tablesorter' id='tabla_4'> 
			<thead> 
                            <tr>
                                <th>
                                    Empresa
				</th>
				<th>
                                    Factura
				</th>
				<th>
                                    Fecha
				</th>
                                <th>
                                    N. Credito
				</th>
                                <th>
                                    Observación
				</th>
				<th >
                                    Total
				</th>				
                            </tr> 
			</thead>";
                        $sql3="select
                            centro_venta.centro_venta,
                            facturas.numero_factura,
                            facturas.fecha_factura,
                            nota_de_credito.numero_nota_credito,
                            nota_de_credito.observacion,
                            nota_de_credito.total,
                            centro_venta.id_centro_venta                     
                            from nota_venta
                            inner join centro_venta on centro_venta.id_centro_venta=nota_venta.id_centro_venta
                            inner join facturas on facturas.numero_nota_venta=nota_venta.numero_nota_venta
                            inner join nota_de_credito on facturas.numero_factura=nota_de_credito.numero_factura
                            inner join cliente on cliente.id_cliente=nota_venta.id_cliente
                            inner join detalle_nota_credito on detalle_nota_credito.id_nc=nota_de_credito.id_nc
                            where fecha_factura  >='".$fecha1."' AND fecha_factura<='".$fecha2."'
                            and nota_venta.id_cliente='".$cli."'
                            group by nota_venta.numero_nota_venta
                            ";//$fecha1
                        //where formulas.id_producto_padre=".$id_producto_terminado." and formulas.nivel=5";
                            $ejecuta3=mysql_query($sql3,$conexion->link);
                            $sumtot=0;
                            /*
                            $sum_pre_bat=0;
                            $sumTBmezclaBAT=0;
                            $sumTBmezclaUNI=0;*/
                            mysql_query("SET NAMES 'UTF8'");
                            while ($fila3 = mysql_fetch_array($ejecuta3))
                            {
                                /*$canbat=$fila3[3]*$numbat;
                                $bat=number_format($fila3[3], 3, '.', '');
                                $canbatfor=number_format($canbat, 3, '.', '');
                                $uni=number_format($fila3[5], 3, '.', '');*/
                            $fecfac= $fila3[2];
                            $fecfac = date("d-m-Y", strtotime($fecfac));
                            //date_format($fecfac, 'd/m/y');
                                echo "<tr>";
                                    echo "<td >".$fila3[0]."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[1]."</td>"; 
                                    echo "<td >".$fecfac."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[3]."</td>"; 
                                    echo "<td>".utf8_encode($fila3[4])."</td>"; 
                                    $cre=number_format($fila3[5], 0, ',', '.');
                                    echo "<td style='text-align:right'>".$cre."</td>"; 
                                    echo "<td><a href='#' onClick='$(this).Detalle_ventas_nac_cre(".$fila3[3].",".$fila3[6].");' title='Revisar Detalle' class='icon-editar info-tooltip'></a></td>";
                                 echo "</tr>";
                                 $sumtot=$sumtot+$fila3[5];
                            }
                            echo "<tr>";
                                echo "<td style='text-align:right' colspan=5>
                                    Total</td>";
                                $sumtotcre=number_format($sumtot, 0, ',', '.');
                                echo "<td style='text-align:right'>".$sumtotcre."</td>";                                
                            echo "</tr>";
                            
                            echo "<tr>";
                                echo "<td style='text-align:right' colspan=5>
                                    <h2>Total Vendido</h2></td>";
                                $total=$tot1-$sumtot;
                                $total=number_format($total, 0, ',', '.');
                                echo "<td style='text-align:right'><h2>".$total."</h2></td>";                                
                            echo "</tr>";
                       echo"</table>";
                   
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
	else if ($funcion==10)
	{
		$numero=trim($_POST["numero"]);
                //$fecha1=trim($_POST["fecha1"]);
		try{
                    //echo$numero;
                    echo"<table class='tablesorter' id='tabla_4'> 
                        <thead> 
                            <tr>
                                <th >
                                    Proforma Nº $numero
				</th>
                            </tr>
                        </thead> 
			<thead> 
                            <tr>
                                <th>
                                    Codigo
				</th>
                                <th>
                                    Producto
				</th>
				<th>
                                    Cantidad
				</th>
				<th>
                                    Precio
				</th>
                                <th>
                                    Total
				</th>
                            </tr> 
			</thead>";
                        $sql4="select
                            productos.nombre_producto,
                            detalle_proforma.cantidad,
                            detalle_proforma.precio,
                            detalle_proforma.total,
                            productos.codigo_producto
                            from detalle_proforma
                            inner join productos on detalle_proforma.id_producto=productos.id_producto
                            where detalle_proforma.numero_proforma=".$numero;
                        //where formulas.id_producto_padre=".$id_producto_terminado." and formulas.nivel=5";
                            $ejecuta4=mysql_query($sql4,$conexion->link);
                            /*$sumcan=0;
                            $sumfob=0;
                            $sumfre=0;
                            $sumins=0;
                            $sumtot=0;*/
                            while ($fila4 = mysql_fetch_array($ejecuta4))
                            {
                                $prec=number_format($fila4[2], 2, '.', ',');
                                $totlin=number_format($fila4[3], 2, '.', ',');
                                echo "<tr>";
                                    echo "<td >".$fila4[4]."</td>"; 
                                    echo "<td >".  utf8_encode($fila4[0])."</td>"; 
                                    echo "<td  style='text-align:right'>".$fila4[1]."</td>"; 
                                    echo "<td  style='text-align:right'>".$prec."</td>"; 
                                    echo "<td  style='text-align:right'>".$totlin."</td>"; 
                                    /*echo "<td style='text-align:right'>".$fila3[1]."</td>"; 
                                    echo "<td >".$fecfac."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[3]."</td>"; 
                                    echo "<td >".utf8_encode($fila3[4])."</td>"; 
                                    echo "<td >".$fila3[5]."</td>"; 
                                    $sumcan=$sumcan+$fila3[6];
                                    echo "<td style='text-align:right'>".$fila3[6]."</td>";
                                    $sumfob=$sumfob+$fila3[7];                            
                                    echo "<td style='text-align:right'>".$fila3[7]."</td>";
                                    $sumfre=$sumfre+$fila3[8];                            
                                    echo "<td style='text-align:right'>".$fila3[8]."</td>";
                                    $sumins=$sumins+$fila3[9];                            
                                    echo "<td style='text-align:right'>".$fila3[9]."</td>";
                                    $sumtot=$sumtot+$fila3[10];
                                    echo "<td style='text-align:right'>".$fila3[10]."</td>";
                                    echo "<td><a href='#' onClick='$(this).Detalle_ventas_export(".$fila3[3].");' title='Revisar Detalle' class='icon-editar info-tooltip'></a></td>";
                                    //echo "<td  width='30%' style='text-align:right'>".$canbatfor."</td>"; 
                                    //echo "<td style='text-align:right'width='37%'>".$bat."</td>";         
                                    //echo "<td style='text-align:right'></td>"; 
                                    //echo "<td style='text-align:right'>".$uni."</td>"; */
                                echo "</tr>";
                            }
                            /*echo "<tr>";
                                echo "<td style='text-align:right' colspan=6>Total</td>";
                                echo "<td style='text-align:right'>".$sumcan."</td>";
                                echo "<td style='text-align:right'>".$sumfob."</td>";
                                echo "<td style='text-align:right'>".$sumfre."</td>";
                                echo "<td style='text-align:right'>".$sumins."</td>";
                                echo "<td style='text-align:right'>".$sumtot."</td>";
                            echo "</tr>";*/
                       echo"</table>";
                   
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
        else if ($funcion==100)
	{
		$numero=trim($_POST["numero"]);
                $sql5="Select numero_nota_venta from nota_venta where numero=".$numero;
                        //$sql5="Select * from facturas where numero_factura=".$factura." and numero_nota_venta=".$numero_nota_venta." and id_centro_venta=".$centro_venta;
			$resultado5=mysql_query($sql5,$conexion->link);
                        while ($fila = mysql_fetch_array($resultado5))
			{
				$nv=$fila[0];
			}
                //$fecha1=trim($_POST["fecha1"]);
		try{
                    //echo$numero;
                    echo"<table class='tablesorter' id='tabla_4'> 
                        <thead> 
                            <tr>
                                <th >
                                    Nota de Venta Nº $nv
				</th>
                            </tr>
                        </thead> 
			<thead> 
                            <tr>
                                <th>
                                    Codigo
				</th>
                                <th>
                                    Producto
				</th>
				<th>
                                    Cantidad
				</th>
				<th>
                                    Precio
				</th>
                                <th>
                                    Descuento
				</th>
                                <th>
                                    Total
				</th>
                            </tr> 
			</thead>";
                        $sql4="select
                            productos.nombre_producto,
                            detalle_nota_venta.cantidad,
                            detalle_nota_venta.precio,
                            detalle_nota_venta.total,
                            productos.codigo_producto,
                            detalle_nota_venta.descuento
                            from detalle_nota_venta
                            inner join productos on detalle_nota_venta.id_producto=productos.id_producto
                            where detalle_nota_venta.crl_nota_venta=".$numero;
                        //where formulas.id_producto_padre=".$id_producto_terminado." and formulas.nivel=5";
                            $ejecuta4=mysql_query($sql4,$conexion->link);
                            /*$sumcan=0;
                            $sumfob=0;
                            $sumfre=0;
                            $sumins=0;
                            $sumtot=0;*/
                            while ($fila4 = mysql_fetch_array($ejecuta4))
                            {
                                $prec=number_format($fila4[2], 0, '', '.');
                                $totlin=number_format($fila4[3], 0, '', '.');
                                $deslin=number_format($fila4[5], 0, '', '.');
                                echo "<tr>";
                                    echo "<td >".$fila4[4]."</td>"; 
                                    echo "<td >".  utf8_encode($fila4[0])."</td>"; 
                                    echo "<td  style='text-align:right'>".$fila4[1]."</td>"; 
                                    echo "<td  style='text-align:right'>".$prec."</td>"; 
                                    echo "<td  style='text-align:right'>".$deslin."</td>";
                                    echo "<td  style='text-align:right'>".$totlin."</td>"; 
                                    /*echo "<td style='text-align:right'>".$fila3[1]."</td>"; 
                                    echo "<td >".$fecfac."</td>"; 
                                    echo "<td style='text-align:right'>".$fila3[3]."</td>"; 
                                    echo "<td >".utf8_encode($fila3[4])."</td>"; 
                                    echo "<td >".$fila3[5]."</td>"; 
                                    $sumcan=$sumcan+$fila3[6];
                                    echo "<td style='text-align:right'>".$fila3[6]."</td>";
                                    $sumfob=$sumfob+$fila3[7];                            
                                    echo "<td style='text-align:right'>".$fila3[7]."</td>";
                                    $sumfre=$sumfre+$fila3[8];                            
                                    echo "<td style='text-align:right'>".$fila3[8]."</td>";
                                    $sumins=$sumins+$fila3[9];                            
                                    echo "<td style='text-align:right'>".$fila3[9]."</td>";
                                    $sumtot=$sumtot+$fila3[10];
                                    echo "<td style='text-align:right'>".$fila3[10]."</td>";
                                    echo "<td><a href='#' onClick='$(this).Detalle_ventas_export(".$fila3[3].");' title='Revisar Detalle' class='icon-editar info-tooltip'></a></td>";
                                    //echo "<td  width='30%' style='text-align:right'>".$canbatfor."</td>"; 
                                    //echo "<td style='text-align:right'width='37%'>".$bat."</td>";         
                                    //echo "<td style='text-align:right'></td>"; 
                                    //echo "<td style='text-align:right'>".$uni."</td>"; */
                                echo "</tr>";
                            }
                            /*echo "<tr>";
                                echo "<td style='text-align:right' colspan=6>Total</td>";
                                echo "<td style='text-align:right'>".$sumcan."</td>";
                                echo "<td style='text-align:right'>".$sumfob."</td>";
                                echo "<td style='text-align:right'>".$sumfre."</td>";
                                echo "<td style='text-align:right'>".$sumins."</td>";
                                echo "<td style='text-align:right'>".$sumtot."</td>";
                            echo "</tr>";*/
                       echo"</table>";
                   
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
        else if ($funcion==1001)
	{
		$numero=trim($_POST["numero"]);
                $cv=trim($_POST["cv"]);
                $sql5="Select id_nc from nota_de_credito where numero_nota_credito=".$numero." and id_centro_venta=".$cv;
                        //$sql5="Select * from facturas where numero_factura=".$factura." and numero_nota_venta=".$numero_nota_venta." and id_centro_venta=".$centro_venta;
			$resultado5=mysql_query($sql5,$conexion->link);
                        while ($fila = mysql_fetch_array($resultado5))
			{
				$nc=$fila[0];
			}
                //$fecha1=trim($_POST["fecha1"]);
		try{
                    //echo$numero;
                    echo"<table class='tablesorter' id='tabla_4'> 
                        <thead> 
                            <tr>
                                <th >
                                    Nota de Credito Nº $numero
				</th>
                            </tr>
                        </thead> 
			<thead> 
                            <tr>
                                <th>
                                    Codigo
				</th>
                                <th>
                                    Producto
				</th>
				<th>
                                    Cantidad
				</th>
				<th>
                                    Precio
				</th>
                                <th>
                                    Descuento
				</th>
                                <th>
                                    Total
				</th>
                            </tr> 
			</thead>";
                        $sql4="select
                            productos.nombre_producto,
                            detalle_nota_credito.cantidad,
                            detalle_nota_credito.precio,
                            detalle_nota_credito.total,
                            productos.codigo_producto,
                            detalle_nota_credito.descuento,
                            detalle_nota_credito.obs_gen
                            from detalle_nota_credito
                            inner join productos on detalle_nota_credito.id_producto=productos.id_producto
                            where detalle_nota_credito.id_nc=".$nc;
                        //where formulas.id_producto_padre=".$id_producto_terminado." and formulas.nivel=5";
                            $ejecuta4=mysql_query($sql4,$conexion->link);
                            $numero_filas = mysql_num_rows($ejecuta4);
                            if ($numero_filas==0)
                            {		 
                                    /*$salida[]=array("valor"=>0);
                                    echo json_encode($salida);
                                        $sql4="select
                                    productos.nombre_producto,
                                    detalle_nota_credito.cantidad,
                                    detalle_nota_credito.precio,
                                    detalle_nota_credito.total,
                                    productos.codigo_producto,
                                    detalle_nota_credito.descuento,
                                    detalle_nota_credito.obs_gen
                                    from detalle_nota_credito
                                    inner join productos on detalle_nota_credito.id_producto=productos.id_producto
                                    where detalle_nota_credito.id_nc=".$nc;                                     */
                                    $sql5="select
                                    cantidad,
                                    precio,
                                    total,
                                    descuento,
                                    obs_gen
                                    from detalle_nota_credito
                                    where id_nc=".$nc;
                                    $ejecuta5=mysql_query($sql5,$conexion->link);
                                    while ($fila5 = mysql_fetch_array($ejecuta5))
                                    {
                                        $prec=number_format($fila5[1], 0, '', '.');
                                        $totlin=number_format($fila5[2], 0, '', '.');
                                        $deslin=number_format($fila5[3], 0, '', '.');
                                        echo "<tr>";
                                            echo "<td >***</td>"; 
                                            echo "<td >".  utf8_encode($fila5[4])."</td>";
                                            
                                            echo "<td  style='text-align:right'>".$fila5[0]."</td>"; 
                                            echo "<td  style='text-align:right'>".$prec."</td>"; 
                                            echo "<td  style='text-align:right'>".$deslin."</td>";
                                            echo "<td  style='text-align:right'>".$totlin."</td>"; 

                                        echo "</tr>";
                                    }
                            }
                            else{
                                while ($fila4 = mysql_fetch_array($ejecuta4))
                                {
                                    $prec=number_format($fila4[2], 0, '', '.');
                                    $totlin=number_format($fila4[3], 0, '', '.');
                                    $deslin=number_format($fila4[5], 0, '', '.');
                                    echo "<tr>";
                                        echo "<td >".$fila4[4]."</td>"; 
                                        echo "<td >".  utf8_encode($fila4[0])."</td>"; 
                                        echo "<td  style='text-align:right'>".$fila4[1]."</td>"; 
                                        echo "<td  style='text-align:right'>".$prec."</td>"; 
                                        echo "<td  style='text-align:right'>".$deslin."</td>";
                                        echo "<td  style='text-align:right'>".$totlin."</td>"; 

                                    echo "</tr>";
                                }
                            }
                       echo"</table>";
                   
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
					
?>		