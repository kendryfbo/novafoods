<?php
	$id_cliente=$_POST["id_cliente"];
	include_once("../clases/conexion.php");
	$conexion= new conexion();  
        //echo$id_cliente;
        
            
	$sql1="select 
			suc_clientes.id_suc_cliente,
                        suc_clientes.suc_cliente,
			comuna_cl.str_descripcion,
                        provincia_cl.str_descripcion,
                        region_cl.str_descripcion
			from suc_clientes
                        inner join comuna_cl on suc_clientes.comuna=comuna_cl.id_co
                        inner join provincia_cl on suc_clientes.provincia=provincia_cl.id_pr
                        inner join region_cl on suc_clientes.region=region_cl.id_re
			where suc_clientes.cliente=".$id_cliente;
 		 	$ejecuta=mysql_query($sql1,$conexion->link);
			$número_filas = mysql_num_rows($ejecuta);
			if ($número_filas<>0)
			{
                            echo"<article class='module width_full'>            
										<div class='module_content'>";
                            echo"<table class='tablesorter' id='tabla_4'>
                            <thead> 
                                <tr>
                                                <th>
                                                    Crl
                                                </th>
                                                <th>
                                                    Sucursal
                                                </th>
                                                <th>
                                                    Comuna
                                                </th>
                                                <th>
                                                    Provincia
                                                </th>

                                                <th>
                                                    Region
                                                </th>
                                </tr> 
                        </thead> ";
                            $crl=1;
                            while ($fila = mysql_fetch_array($ejecuta))
                            {

                                echo "<tr>";
                                    echo "<td>";
                                        echo $crl;
                                    echo "</td>";
                                    echo "<td>";
                                        echo $fila[1];
                                    echo "</td>";
                                    echo "<td>";
                                        echo $fila[2];
                                    echo "</td>";
                                    echo "<td>";
                                        echo $fila[3];
                                    echo "</td>";
                                    echo "<td>";
                                        echo $fila[4];
                                    echo "</td>";
                                echo "</tr>";
                            }
                            
                            echo "</table>";
                            echo"</div>
                            </article>";
                            echo"<div class='fright'><input  onClick='$(this).crea_sucural_cliente($id_cliente);' type='submit' value='Agregar Sucursales&raquo;'/>
                            </div>";
                        }else{
                           echo"Sin Registros<br>" ;
                           /*echo"<div class='fright'>
                            <a href='crear_cliente_nacional.php'><input type='button' value='Agregar Sucursales&raquo;' /></a>
                            </div>";*/
                           echo"<div class='fright'><input  onClick='$(this).crea_sucural_cliente($id_cliente);' type='submit' value='Agregar Sucursales&raquo;'/>
                            </div>";
                            
                        }
                       
				
?>