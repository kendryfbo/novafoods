<?php
	$id_producto_terminado=$_POST["id_producto_terminado"];
	$nivel=$_POST["nivel"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
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
 				
				echo "<thead>"; 
				echo "<tr><th>Codigo</th>";
				echo "<th>Descripcion</th>";
				echo "<th style='text-align:right'>Batch</th>";
				echo "<th style='text-align:right'>Caja</th>";
				echo "<th style='text-align:right'>Env.Uni</th>";
				//echo  "<th>Editar Datos</th>";
				echo  "<th>Borrar</th>";
				echo "</tr>";
				echo "</thead>";
				echo "<tbody>";										 
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
					echo "</tbody>";
                                        echo "<tr>";
                                            echo "<td  colspan=6>
                                                <input  type='hidden'  id='vs' value='$version' />
                                                <input  type='hidden'  id='estado' value='$status' />
                                                    
                                            </td>"; 
                                        echo "</tr>";
                                        if($status==0){
                                            echo "<tr>";
                                                echo "<td  colspan=6 >
                                                    <h1 style='color:red;'>Falta Autorizar por Desarrollo!</h1>
                                                    <input onClick='$(this).actualiza_formula_por_desarrollo();' type='button' value='Autoriza Desarrollo&raquo;'/>
                                                </td>"; 
                                            echo "</tr>";
                                            
                                        }
                                        if($status==1){
                                            echo "<tr>";
                                                echo "<td  colspan=6 >
                                                    <h1 style='color:red;'>Pendiente de Autorizar por Gerencia!</h1>
                                                </td>"; 
                                            echo "</tr>";
                                            
                                        }
                                        
			}	
			else
			{	
 				echo "<td>No Registra Materia Prima/ Insumos</td>"; 			
			}		
?>