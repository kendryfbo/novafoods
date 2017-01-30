<?php
	$id_producto_terminado=$_POST["id_producto"];
	//$nivel=$_POST["nivel"];
        echo"<link href='css/estilo2.css' rel='stylesheet' type='text/css' />";
	include_once("../clases/conexion.php");
	$conexion= new conexion(); 
            $sql2="select formulas.version,productos.nombre_producto from productos 
                   inner join formulas on productos.id_producto=formulas.id_producto_padre
                   where productos.id_producto=".$id_producto_terminado;                    
            $ejecuta2=mysql_query($sql2,$conexion->link);
            while ($fila2 = mysql_fetch_array($ejecuta2))
            {
		$vers=$fila2[0];
                $prod=$fila2[1];
            }
            
            echo"<tr>
		<td height='100%'>
			<div class='body'>
				<div class='modulo widht_modulo_full'>
					
                                        <div class='title'><p>Producto : $prod</p>
					</div>
                                        <div class='title'><p>Version: $vers</p>
					</div>
					<div class='content'>     
						<section>
							<article class='module width_full'> 
								
								<div class='module_content'>
									<table class='tablesorter' >";
                                                                        $sql1="select
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
                                                                            where formulas.id_producto_padre=".$id_producto_terminado;
                                                                            //where formulas.id_producto_padre=".$id_producto_terminado." and formulas.nivel=".$nivel;
                                                                            $ejecuta=mysql_query($sql1,$conexion->link);
                                                                            $número_filas1 = mysql_num_rows($ejecuta);
                                                                            if ($número_filas1<>0)
                                                                            {

                                                                                    //echo "<thead>"; 
                                                                                    echo "<tr><th>Codigo</th>";
                                                                                    echo "<th>Descripcion</th>";
                                                                                    echo "<th style='text-align:right'>Batch</th>";
                                                                                    echo "<th style='text-align:right'>Caja</th>";
                                                                                    echo "<th style='text-align:right'>Env.Uni</th>";
                                                                                    //echo  "<th>Editar Datos</th>";
                                                                                    //echo  "<th>Borrar</th>";
                                                                                    echo "</tr>";
                                                                                    //echo "</thead>";
                                                                                    //echo "<tbody>";										 
                                                                                    while ($fila = mysql_fetch_array($ejecuta))
                                                                                    {			 
                                                                                            $env=number_format($fila[5], 3, '.', '');
                                                                                            $caj=number_format($fila[4], 3, '.', '');
                                                                                            $bat=number_format($fila[3], 3, '.', '');
                                                                                            $version=$fila[6];
                                                                                            $status=$fila[7];
                                                                                            echo "<tr id=".$fila[0].">";
                                                                                                echo "<td  width='10%'>".$fila[1]."</td>"; 
                                                                                                echo "<td width='30%'>".$fila[2]."</td>"; 
                                                                                                echo "<td style='text-align:right'>".$bat."</td>"; 
                                                                                                echo "<td style='text-align:right'>".$caj."</td>"; 
                                                                                                echo "<td style='text-align:right'>".$env."</td>"; 
                                                                                                //echo "<td><a href='#' onClick='$(this).actualiza_valores_formulas(".$fila[0].");' title='Editar Informacion' class='icon-editar info-tooltip'></a></td>";
                                                                                                if($status==0){
                                                                                                echo "<td><a href='#' onClick='$(this).eliminar_valores_formulas(".$fila[0].");' title='Borrar Informacion' class='icon-borrar info-tooltip'></a></td>";
                                                                                                }
                                                                                            echo "</tr>";
                                                                                    }
                                                                                            //echo "</tbody>";
                                                                                            echo "<tr>";
                                                                                                echo "<td  colspan=6>
                                                                                                    <input  type='hidden'  id='vs' value='$version' />
                                                                                                    <input  type='hidden'  id='estado' value='$status' />

                                                                                                </td>"; 
                                                                                            echo "</tr>";
                                                                                            
                                                                                            echo"<tr>
                                                                                                    <td colspan=6>
                                                                                                         <table class='tablesorter'> 
                                                                                                             <tr>
                                                                                                                 <td colspan=3>
                                                                                                                    <h2 style='color:blue;'>Autorizacion de Producto $prod   </h2>
                                                                                                                      
                                                                                                                      <input type='hidden'  id='proforma' value='$id_producto_terminado' />
                                                                                                                          <input type='hidden'  id='version' value='$vers' />
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
                                                                                                 </tr>";
                  

                                                                            }	
                                                                            else
                                                                            {	
                                                                                    echo "<td>No Registra Materia Prima/ Insumos</td>"; 			
                                                                            }
                                                                        echo"</table>
                                                                </div>
                                                         </article>
                                                </section>
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