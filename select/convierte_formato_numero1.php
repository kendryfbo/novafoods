
<?php	 
        
	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);
	if ($funcion==1)
	{
		$dato=trim($_POST["dato"]);
		try{
                     $dat=number_format($dato, 0, ',', '.');
                    echo "<label>".$dat."</label>";
                   
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
	else if ($funcion==2)
	{
		try{	
                   echo "<td>
                            Observación :
                         </td>
                         <td>
                            <textarea rows='3' cols='30' id='observacion' placeholder=' Ingrese Observación'></textarea>
                            <div id='valida-observacion' style='display:none' class='errores'>
                                Debe Ingresar Observación
                            </div>
                         </td>
                         ";
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
	if ($funcion==3)
	{
		$dato=trim($_POST["dato"]);
		try{
                     $dat=number_format($dato, 2, ',', '.');
                    echo "<label>".$dat."</label>";
                   /*
                    * id_subtotal
                    * id_descuento
                    * id_neto_oc
                    * id_iva_oc
                    * id_honorario
                    * id_total
                    */
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
	if ($funcion==4)
	{
		$net=trim($_POST["net_actual"]);
                $iva=trim($_POST["iva_actual"]);
                
		try{
                     $tot=$net+$iva;
                     echo $tot;
                        //$dat=number_format($dato, 2, ',', '.');
                        //echo "<label>".$dat."</label>";
                   
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}				
?>		