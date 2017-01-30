<?php
	$id_producto_terminado=$_POST["id_producto"];
	//$nivel=$_POST["nivel"];
        echo"<link href='css/estilo2.css' rel='stylesheet' type='text/css' />";
	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
            $sql2="select formulas.version,productos.nombre_producto,productos.unixcarga from productos 
                   inner join formulas on productos.id_producto=formulas.id_producto_padre
                   where productos.id_producto=".$id_producto_terminado;                    
            $ejecuta2=mysql_query($sql2,$conexion->link);
            while ($fila2 = mysql_fetch_array($ejecuta2))
            {
		$vers=$fila2[0];
                $prod=$fila2[1];
                $numbat=$fila2[2];
            }
            
            echo"<tr>
		<td height='100%'>
			<div class='body'>
				<div class='modulo widht_modulo_full'>
					<div class='title'><p>Formula Industrial</p>
					</div>
                                        <div class='title'><p>Producto : $prod</p>
					</div>
                                        <div class='title'><p>Version: $vers</p>
					</div>
					<div class='content'>     
						<section>
							<article class='module width_full'> 
								
								<div class='module_content'>
                                                                        <table class='tablesorter' >
                                                                            <tr>
                                                                                <th>Componentes Premix</th>
                                                                                <th style='text-align:right'>kg. X $numbat Batch</th>
                                                                                <th style='text-align:right'>Kg. x 1 Batch</th>
                                                                            </tr>";
                                                                            $sql3="select
                                                                            formulas.id,
                                                                            productos.codigo_producto,
                                                                            productos.nombre_producto,
                                                                            formulas.batch,
                                                                            formulas.caja,
                                                                            formulas.unidad,
                                                                            formulas.version,
                                                                            formulas.status
                                                                            from formulas
                                                                            inner join productos on productos.id_producto=formulas.id_producto_hijo
                                                                            inner join umed on umed.id_umed=productos.id_umed
                                                                            where formulas.id_producto_padre=".$id_producto_terminado." and formulas.nivel=3";
                                                                            $ejecuta3=mysql_query($sql3,$conexion->link);
                                                                            $sum_pre_canbat=0;
                                                                            $sum_pre_bat=0;
                                                                            $sumunipre=0;
                                                                            while ($fila3 = mysql_fetch_array($ejecuta3))
                                                                            {
                                                                                $canbat=$fila3[3]*$numbat;
                                                                                $bat=number_format($fila3[3], 3, '.', '');
                                                                                $canbatfor=number_format($canbat, 3, '.', '');
                                                                                echo "<tr>";
                                                                                     echo "<td  width='30%'>".$fila3[2]."</td>"; 
                                                                                     echo "<td style='text-align:right'>".$canbatfor."</td>"; 
                                                                                     echo "<td style='text-align:right'>".$bat."</td>";                                                                                      
                                                                                echo "</tr>";
                                                                                $sum_pre_canbat=$sum_pre_canbat+$canbat;
                                                                                $sum_pre_bat=$sum_pre_bat+$fila3[3];
                                                                                $sumunipre=$sumunipre+$fila3[5];
                                                                            }
                                                                            
                                                                            $sql4="select
                                                                            formulas.id,
                                                                            productos.codigo_producto,
                                                                            productos.nombre_producto,
                                                                            formulas.batch,
                                                                            formulas.caja,
                                                                            formulas.unidad,
                                                                            formulas.version,
                                                                            formulas.status
                                                                            from formulas
                                                                            inner join productos on productos.id_producto=formulas.id_producto_hijo
                                                                            inner join umed on umed.id_umed=productos.id_umed
                                                                            where formulas.id_producto_padre=".$id_producto_terminado." and formulas.nivel=5";
                                                                            $ejecuta4=mysql_query($sql4,$conexion->link);
                                                                            $sumbat=0;
                                                                            $sumcanbat=0;
                                                                            $sumbaseesp=0;
                                                                            while ($fila4 = mysql_fetch_array($ejecuta4))
                                                                            {
                                                                                $canbat=$fila4[3]*$numbat;
                                                                                
                                                                                $sumcanbat=$sumcanbat+$canbat;
                                                                                $sumbat=$sumbat+$fila4[3];
                                                                                $sumbaseesp=$sumbaseesp+$fila4[5];
                                                                            }
                                                                            $sumbatfor=number_format($sumbat, 3, '.', '');
                                                                            $sumcanbatfor=number_format($sumcanbat, 3, '.', '');
                                                                            echo "<tr>";
                                                                                     echo "<td  width='30%'>BASE ESPESANTE</td>"; 
                                                                                     echo "<td style='text-align:right'>".$sumcanbatfor."</td>"; 
                                                                                     echo "<td style='text-align:right'>".$sumbatfor."</td>";                                                                                      
                                                                            echo "</tr>";
                                                                            $sumtabla1uni=$sumunipre+$sumbaseesp;
                                                                            
                                                                            //Suma de Primera tabla
                                                                            $sum_tb1_canbat=$sumcanbat+$sum_pre_canbat;
                                                                            $sum_tb1_bat=$sumbat+$sum_pre_bat;
                                                                            //formato
                                                                            $sum_tb1_batfor=number_format($sum_tb1_bat, 3, '.', '');
                                                                            $sum_tb1_canbatfor=number_format($sum_tb1_canbat, 3, '.', '');
                                                                            echo "<tr>";
                                                                                     echo "<td  width='30%'>TOTAL</td>"; 
                                                                                     echo "<td style='text-align:right'>".$sum_tb1_canbatfor."</td>"; 
                                                                                     echo "<td style='text-align:right'>".$sum_tb1_batfor."</td>";                                                                                      
                                                                            echo "</tr>";
                                                                            $totprem=$sum_tb1_batfor;
                                                                  echo"</table><br>";
                                                                  
                                                                  echo"<table class='tablesorter' >
                                                                            <tr>
                                                                                <th>Componentes Colorantes</th>
                                                                                <th style='text-align:right'>kg. X $numbat Batch</th>
                                                                                <th style='text-align:right'>Kg. x 1 Batch</th>
                                                                            </tr>";
                                                                            $sql3="select
                                                                            formulas.id,
                                                                            productos.codigo_producto,
                                                                            productos.nombre_producto,
                                                                            formulas.batch,
                                                                            formulas.caja,
                                                                            formulas.unidad,
                                                                            formulas.version,
                                                                            formulas.status
                                                                            from formulas
                                                                            inner join productos on productos.id_producto=formulas.id_producto_hijo
                                                                            inner join umed on umed.id_umed=productos.id_umed
                                                                            where formulas.id_producto_padre=".$id_producto_terminado." and formulas.nivel=4";
                                                                            $ejecuta3=mysql_query($sql3,$conexion->link);
                                                                            $sum_pre_canbat=0;
                                                                            $sum_pre_bat=0;
                                                                            $sumuni=0;
                                                                            while ($fila3 = mysql_fetch_array($ejecuta3))
                                                                            {
                                                                                $canbat=$fila3[3]*$numbat;
                                                                                $bat=number_format($fila3[3], 3, '.', '');
                                                                                $canbatfor=number_format($canbat, 3, '.', '');
                                                                                $sumuni=$sumuni+$fila3[5];
                                                                                echo "<tr>";
                                                                                     echo "<td  width='30%'>".$fila3[2]."</td>"; 
                                                                                     echo "<td style='text-align:right'>".$canbatfor."</td>"; 
                                                                                     echo "<td style='text-align:right'>".$bat."</td>";                                                                                      
                                                                                echo "</tr>";
                                                                                $sum_pre_canbat=$sum_pre_canbat+$canbat;
                                                                                $sum_pre_bat=$sum_pre_bat+$fila3[3];
                                                                            }
                                                                            
                                                                            
                                                                            //Suma de Primera tabla
                                                                            $sum_tb1_canbat=$sumcanbat+$sum_pre_canbat;
                                                                            $sum_tb1_bat=$sumbat+$sum_pre_bat;
                                                                            //formato
                                                                            $sum_tb1_batfor=number_format($sum_pre_bat, 3, '.', '');
                                                                            $sum_tb1_canbatfor=number_format($sum_pre_canbat, 3, '.', '');
                                                                            echo "<tr>";
                                                                                     echo "<td  width='30%'>TOTAL</td>"; 
                                                                                     echo "<td style='text-align:right'>".$sum_tb1_canbatfor."</td>"; 
                                                                                     echo "<td style='text-align:right'>".$sum_tb1_batfor."</td>";                                                                                      
                                                                            echo "</tr>";
                                                                            
                                                                  echo"</table><br>";
                                                                 
                                                                  //Componentes de Mezclado
                                                                  echo"<table class='tablesorter' >
                                                                            <tr>
                                                                                <th>Componentes Mezclado</th>
                                                                                <th style='text-align:right'>Kg. x 1 Batch</th>
                                                                                <th style='text-align:right'>Premix</th>
                                                                            </tr>";
                                                                            $sql3="select
                                                                            formulas.id,
                                                                            productos.codigo_producto,
                                                                            productos.nombre_producto,
                                                                            formulas.batch,
                                                                            formulas.caja,
                                                                            formulas.unidad,
                                                                            formulas.version,
                                                                            formulas.status
                                                                            from formulas
                                                                            inner join productos on productos.id_producto=formulas.id_producto_hijo
                                                                            inner join umed on umed.id_umed=productos.id_umed
                                                                            where formulas.id_producto_padre=".$id_producto_terminado." and formulas.nivel=1";
                                                                            $ejecuta3=mysql_query($sql3,$conexion->link);
                                                                            $sum_pre_canbat=0;
                                                                            $sum_pre_bat=0;
                                                                            $sumTBmezclaBAT=0;
                                                                            $sumTBmezclaUNI=0;
                                                                            while ($fila3 = mysql_fetch_array($ejecuta3))
                                                                            {
                                                                                $canbat=$fila3[3]*$numbat;
                                                                                $bat=number_format($fila3[3], 3, '.', '');
                                                                                $canbatfor=number_format($canbat, 3, '.', '');
                                                                                $uni=number_format($fila3[5], 3, '.', '');
                                                                                echo "<tr>";
                                                                                     echo "<td  width='30%'>".$fila3[2]."</td>"; 
                                                                                     //echo "<td style='text-align:right'>".$canbatfor."</td>"; 
                                                                                     echo "<td style='text-align:right'width='37%'>".$bat."</td>";         
                                                                                     echo "<td style='text-align:right'>".$uni."</td>"; 
                                                                                echo "</tr>";
                                                                                $sum_pre_canbat=$sum_pre_canbat+$canbat;
                                                                                $sum_pre_bat=$sum_pre_bat+$fila3[3];
                                                                                $sumTBmezclaBAT=$sumTBmezclaBAT+$fila3[3];
                                                                                $sumTBmezclaUNI=$sumTBmezclaUNI+$fila3[5];
                                                                            }
                                                                            
                                                                            //Prmeix
                                                                            echo "<tr>";
                                                                                     echo "<td  width='30%'>PRMEIX</td>"; 
                                                                                     //echo "<td style='text-align:right'>".[5]."</td>"; 
                                                                                     echo "<td style='text-align:right'>".$totprem."</td>";  
                                                                                     $sumtabla1uni=number_format($sumtabla1uni, 3, '.', '');
                                                                                     echo "<td style='text-align:right'>".$sumtabla1uni."</td>";  
                                                                            echo "</tr>";
                                                                            //COLORANTES
                                                                            echo "<tr>";
                                                                                     echo "<td  width='30%'>COLORANTES</td>"; 
                                                                                     //echo "<td style='text-align:right'>".$sum_tb1_canbatfor."</td>"; 
                                                                                     echo "<td style='text-align:right'>".$sum_tb1_batfor."</td>"; 
                                                                                     $sumuni=number_format($sumuni, 3, '.', '');
                                                                                     echo "<td style='text-align:right'>".$sumuni."</td>"; 
                                                                            echo "</tr>";
                                                                            
                                                                            //Suma de Primera tabla
                                                                            $sumGENBAT=$sumTBmezclaBAT+$totprem+$sum_tb1_batfor;
                                                                            $sumGENUNI=$sumTBmezclaUNI+$sumtabla1uni+$sumuni;
                                                                            
                                                                            $sum_tb1_canbat=$sumcanbat+$sum_pre_canbat;
                                                                            $sum_tb1_bat=$sumbat+$sum_pre_bat;
                                                                            //formato
                                                                            $sumGENUNI=number_format($sumGENUNI, 3, '.', '');
                                                                            $sumGENBAT=number_format($sumGENBAT, 3, '.', '');
                                                                            echo "<tr>";
                                                                                     echo "<td  width='30%'>TOTAL</td>"; 
                                                                                     echo "<td style='text-align:right'>".$sumGENBAT."</td>"; 
                                                                                     echo "<td style='text-align:right'>".$sumGENUNI."</td>";                                                                                      
                                                                            echo "</tr>";
                                                                            
                                                                  echo"</table><br>";
                                                                //BAse Espesante
                                                                  echo"<table class='tablesorter' >
                                                                            <tr>
                                                                                <th>BASE ESPESANTE</th>
                                                                                <th style='text-align:right'></th>
                                                                                <th style='text-align:right'></th>
                                                                            </tr>";
                                                                            $sql3="select
                                                                            formulas.id,
                                                                            productos.codigo_producto,
                                                                            productos.nombre_producto,
                                                                            formulas.batch,
                                                                            formulas.caja,
                                                                            formulas.unidad,
                                                                            formulas.version,
                                                                            formulas.status
                                                                            from formulas
                                                                            inner join productos on productos.id_producto=formulas.id_producto_hijo
                                                                            inner join umed on umed.id_umed=productos.id_umed
                                                                            where formulas.id_producto_padre=".$id_producto_terminado." and formulas.nivel=5";
                                                                            $ejecuta3=mysql_query($sql3,$conexion->link);
                                                                            $sum_pre_canbat=0;
                                                                            $sum_pre_bat=0;
                                                                            $sumTBmezclaBAT=0;
                                                                            $sumTBmezclaUNI=0;
                                                                            while ($fila3 = mysql_fetch_array($ejecuta3))
                                                                            {
                                                                                $canbat=$fila3[3]*$numbat;
                                                                                $bat=number_format($fila3[3], 3, '.', '');
                                                                                $canbatfor=number_format($canbat, 3, '.', '');
                                                                                $uni=number_format($fila3[5], 3, '.', '');
                                                                                echo "<tr>";
                                                                                     echo "<td  width='30%'>".$fila3[2]."</td>"; 
                                                                                     //echo "<td style='text-align:right'>".$canbatfor."</td>"; 
                                                                                     echo "<td style='text-align:right'width='37%'>".$bat."</td>";         
                                                                                     echo "<td style='text-align:right'></td>"; 
                                                                                     //echo "<td style='text-align:right'>".$uni."</td>"; 
                                                                                echo "</tr>";
                                                                            }
                                                                            
                                                                            
                                                                  echo"</table><br>";
                                                               echo"</div>
                                                         </article>
                                                </section>
                                        </div>
                                        <div class='title'><p>
                                            <img src='img/firma_benjamin.png' width='25%' height='25%'>
                                            <hr>
                                        </p>
					</div>
                                        <div class='title'><p>Firma Gerente General</p>
					</div>
                                 </div>
                          </div>
                  </td>
                  </tr>
                  ";
            /*
            echo "<tr>";
                echo "<td colspan=6>
                    <b><h3 style='color:black;'>Producto : $prod</h3></b>
                    
                    </td>";
            echo "</tr>";                                            
            echo "<tr>";
                echo "<td  colspan=6>
                    <input  type='hidden'  />
                    <input  type='hidden'  />
                </td>"; 
            echo "</tr>";                             
        */
			
?>