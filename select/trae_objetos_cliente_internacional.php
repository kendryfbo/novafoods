
<?php	 
        
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);
	if ($funcion==1)
	{
		$id_cliente_int=trim($_POST["id_cliente_int"]);
                
		try{
                    $sql3="select
                            cliente.nombre,
                            cliente.tipo_empresa,
                            paises.pais,
                            cliente.direccion,
                            cliente.telefono,
                            cliente.fax,
                            cliente.pagina_web,
                            categoria.categoria,
                            condiciones_pago.Condicion,
                            cliente.credito,
                            cliente.moneda,
                            idiomas.idioma,
                            cliente.c1,
                            cliente.m1,
                            cliente.fo1,
                            cliente.fe1,
                            cliente.c2,
                            cliente.m2,
                            cliente.fo2,
                            cliente.fe2,
                            cliente.c3,
                            cliente.m3,
                            cliente.fo3,
                            cliente.fe3,
                            cliente.c4,
                            cliente.m4,
                            cliente.fo4,
                            cliente.fe4,
                            cliente.c5,
                            cliente.m5,
                            cliente.fo5,
                            cliente.fe5,
                            cliente.c6,
                            cliente.m6,
                            cliente.fo6,
                            cliente.fe6
                            from cliente
                            inner join categoria on categoria.id_categoria=cliente.categoria
                            inner join condiciones_pago on condiciones_pago.id_condicion=cliente.cond_pago
                            inner join paises on paises.id_pais=cliente.pais
                            inner join idiomas on idiomas.id_idioma=cliente.idioma
                            where cliente.id_cliente=".$id_cliente_int;
                            $ejecuta3=mysql_query($sql3,$conexion->link);
                            //mysql_query("SET NAMES 'UTF8'");
                            while ($fila3 = mysql_fetch_array($ejecuta3))
                            {
                                /*$canbat=$fila3[3]*$numbat;
                                $bat=number_format($fila3[3], 3, '.', '');
                                $canbatfor=number_format($canbat, 3, '.', '');
                                $uni=number_format($fila3[5], 3, '.', '');*/
                            
                                $nombre= $fila3[0];
                                $tipo_empresa= $fila3[1];
                                $pais= $fila3[2];
                                $direccion= $fila3[3];
                                $telefono= $fila3[4];
                                $fax= $fila3[5];
                                $pagina_web= $fila3[6];
                                $categoria= $fila3[7];
                                $Condicion= $fila3[8];
                                $credito= $fila3[9];
                                $moneda= $fila3[10];
                                $idioma= $fila3[11];
                                $c1= $fila3[12];
                                $m1= $fila3[13];
                                $fo1= $fila3[14];
                                $fe1= $fila3[15];
                                $c2= $fila3[16];
                                $m2= $fila3[17];
                                $fo2= $fila3[18];
                                $fe2= $fila3[19];
                                $c3= $fila3[20];
                                $m3= $fila3[21];
                                $fo3= $fila3[22];
                                $fe3= $fila3[23];
                                $c4= $fila3[24];
                                $m4= $fila3[25];
                                $fo4= $fila3[26];
                                $fe4= $fila3[27];
                                $c5= $fila3[28];
                                $m5= $fila3[29];
                                $fo5= $fila3[30];
                                $fe5= $fila3[31];
                                $c6= $fila3[32];
                                $m6= $fila3[33];
                                $fo6= $fila3[34];
                                $fe6= $fila3[35];
                                
                                $fecfac= $fila3[2];
                            $fecfac = date("d-m-Y", strtotime($fecfac));
                            //date_format($fecfac, 'd/m/y');
                                
                            }
                    echo"<td height='100%'>
                                <div class='body'>		 
                                        <div class='modulo widht_modulo_full'>
                                                <div class='title'><p>Cliente InterNacional</p>
                                                </div>
                                                <div class='module_content'>          
                                                        <div>  
                                                                <div class='fright'><a href='listado_clientes.php'><input type='button' value='Volver &raquo;'/></a>
                                                                        </div>
                                                                </div>
                                                                <table class='tablesorter'> 

                                                                        <tr>
                                                                                <td>
                                                                                        <label>Nombre / Razón Social</label>
                                                                                </td>
                                                                                <td>
                                                                                        $nombre	
                                                                                </td>
                                                                                <td>
                                                                                        <label>Tipo Empresa</label>
                                                                                </td>
                                                                                <td>
                                                                                        $tipo_empresa
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                        <td>
                                                                                        <label>Pais</label>
                                                                                </td>
                                                                                <td>
                                                                                        $pais
                                                                                </td>
                                                                                <td>
                                                                                        <label>Direccion</label>
                                                                                </td>
                                                                                <td>
                                                                                        $direccion
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                        <td>
                                                                                        <label>Teléfono</label>
                                                                                </td>
                                                                                <td>
                                                                                        $telefono
                                                                                </td>
                                                                                <td>
                                                                                        <label>Fax</label>
                                                                                </td>
                                                                                <td>
                                                                                        $fax
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                        <td>
                                                                                        <label>Página Web</label>
                                                                                </td>
                                                                                <td>
                                                                                        $pagina_web
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                        <td>
                                                                                        <label>Categoria</label>
                                                                                </td>
                                                                                <td>
                                                                                        $categoria

                                                                                </td>
                                                                                <td>
                                                                                        <label>Condición de Pago </label>
                                                                                </td>
                                                                                <td>
                                                                                        $Condicion

                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                        <td>
                                                                                        <label>Credito Maximo</label>
                                                                                </td>
                                                                                <td>
                                                                                        $credito
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                        <td>
                                                                                        <label>Moneda Local</label>
                                                                                </td>
                                                                                <td>
                                                                                        $moneda
                                                                                </td>
                                                                                <td>
                                                                                        <label>Idioma</label>
                                                                                </td>
                                                                                <td>
                                                                                        $idioma									
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                        <td colspan=6>
                                                                                        <table>
                                                                                                <tr>
                                                                                                        <td colspan=8>
                                                                                                                <hr>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <label>Gerente General</label>
                                                                                                        </td>
                                                                                                        <td colspan=7>
                                                                                                                $c1
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan=2>

                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <label>e-Mail</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                $m1
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <label>Teléfono</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                $fo1
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <label>Fecha Nacimiento</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                $fe1
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan=8>
                                                                                                                <hr>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <label>Gerente Finanzas</label>
                                                                                                        </td>
                                                                                                        <td colspan=7>
                                                                                                                $c2
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan=2>

                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <label>e-Mail</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                $m2
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <label>Teléfono</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                $fo2
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <label>Fecha Nacimiento</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                $fe2
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan=8>
                                                                                                                <hr>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <label>Gerente Comercial</label>
                                                                                                        </td>
                                                                                                        <td colspan=7>
                                                                                                                $c3

                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan=2>

                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <label>e-Mail</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                $m3
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <label>Teléfono</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                $fo3
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <label>Fecha Nacimiento</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                $fe3
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan=8>
                                                                                                                <hr>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <label>Jefe Producto</label>
                                                                                                        </td>
                                                                                                        <td colspan=7>
                                                                                                            $c4                                                   </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan=2>

                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <label>e-Mail</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                $m4
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <label>Teléfono</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                $fo4
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <label>Fecha Nacimiento</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                $fe4
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan=8>
                                                                                                                <hr>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <label>Comercio Exterior</label>
                                                                                                        </td>
                                                                                                        <td colspan=7>
                                                                                                                $c5                                
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan=2>

                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <label>e-Mail</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                $m5
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <label>Teléfono</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                $fo5
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <label>Fecha Nacimiento</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                $fe5
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan=8>
                                                                                                                <hr>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <label>Contabilidad</label>
                                                                                                        </td>
                                                                                                        <td colspan=7>
                                                                                                                $c6
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan=2>

                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <label>e-Mail</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                $m6
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <label>Teléfono</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                $fo6
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <label>Fecha Nacimiento</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                $fe6
                                                                                                        </td>
                                                                                                </tr>
                                                                                        </table>
                                                                                </td>

                                                                        </tr>




                                                                        <tr>
                                                                                <td colspan='4'>
                                                                                        
                                                                                </td>
                                                                        </tr>
                                                                </table>
                                                        </div>
                                                </div>		
                                        </div>
                                 </div>
                         </td>";
                    //<div class='fright'><input onClick='$(this).crear_cliente_int();' type='submit' value='Crear&raquo;'/>
                                                                                        //</div>
                   
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
                            //mysql_query("SET NAMES 'UTF8'");
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
                            //mysql_query("SET NAMES 'UTF8'");
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
                            //mysql_query("SET NAMES 'UTF8'");
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
                            //mysql_query("SET NAMES 'UTF8'");
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
                                    echo "<td >".$fila3[5]."</td>"; 
                                 echo "</tr>";
                                 $sumtot=$sumtot+$fila3[5];
                            }
                            echo "<tr>";
                                echo "<td style='text-align:right' colspan=5>
                                    Total</td>";
                                echo "<td style='text-align:right'>".$sumtot."</td>";                                
                            echo "</tr>";
                            
                            echo "<tr>";
                                echo "<td style='text-align:right' colspan=5>
                                    <h2>Total Vendido</h2></td>";
                                $total=$tot1-$sumtot;
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
                                
                                echo "<tr>";
                                    echo "<td >".$fila4[4]."</td>"; 
                                    echo "<td >".$fila4[0]."</td>"; 
                                    echo "<td >".$fila4[1]."</td>"; 
                                    echo "<td >".$fila4[2]."</td>"; 
                                    echo "<td >".$fila4[3]."</td>"; 
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
					
?>		