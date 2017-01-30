<?php	 

	include_once("../clases/conexion.php");
	$conexion= new conexion();
	$funcion=trim($_POST["funcion"]);
	if ($funcion==1)
	{
		//$numero_proforma=trim($_POST["numero_proforma"]);
		try{	
                   echo "<td>
                            Password :
                         </td>
                         <td>
                            <input type='password' id='clave' placeholder='Ingrese Password' size='20' maxlength='20'/>
                            <div id='valida-clave' style='display:none' class='errores'>
                                Debe Ingresar Password
                            </div>
                            <div id='valida-clave_incorrecta' style='display:none' class='errores'>
                                Password Incorrecto
                            </div>
                         </td>
                         <td>
                            <input type='submit' onClick='$(this).autoriza_prof_gte2();' value='Actualizar&raquo;'/> 
                         </td>
                         ";
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
	else if ($funcion==3)
	{
		//$numero_proforma=trim($_POST["numero_proforma"]);
		try{	
                   echo "<td>
                            Password :
                         </td>
                         <td>
                            <input type='password' id='clave' placeholder='Ingrese Password' size='20' maxlength='20'/>
                            <div id='valida-clave' style='display:none' class='errores'>
                                Debe Ingresar Password
                            </div>
                            <div id='valida-clave_incorrecta' style='display:none' class='errores'>
                                Password Incorrecto
                            </div>
                         </td>
                         <td>
                            <input type='submit' onClick='$(this).autoriza_nv_gte2();' value='Actualizar&raquo;'/> 
                         </td>
                         ";
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
	else if ($funcion==4)
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
        //aqui
        else if ($funcion==5)
	{
		//$numero_proforma=trim($_POST["numero_proforma"]);
		try{	
                   echo "<td>
                            Password :
                         </td>
                         <td>
                            <input type='password' id='clave' placeholder='Ingrese Password' size='20' maxlength='20'/>
                            <div id='valida-clave' style='display:none' class='errores'>
                                Debe Ingresar Password
                            </div>
                            <div id='valida-clave_incorrecta' style='display:none' class='errores'>
                                Password Incorrecto
                            </div>
                         </td>
                         <td>
                            <input type='submit' onClick='$(this).autoriza_nv_gte23();' value='Actualizar&raquo;'/> 
                         </td>
                         ";
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
        else if ($funcion==51)
	{
		//$numero_proforma=trim($_POST["numero_proforma"]);
		try{	
                   echo "<td>
                            Password :
                         </td>
                         <td>
                            <input type='password' id='clave' placeholder='Ingrese Password' size='20' maxlength='20'/>
                            <div id='valida-clave' style='display:none' class='errores'>
                                Debe Ingresar Password
                            </div>
                            <div id='valida-clave_incorrecta' style='display:none' class='errores'>
                                Password Incorrecto
                            </div>
                         </td>
                         <td>
                            <input type='submit' onClick='$(this).autoriza_OC_gte23();' value='Actualizar&raquo;'/> 
                         </td>
                         ";
                }catch (Exception $e)
		{    
				 echo $e->getMessage();
		}
	}
	else if ($funcion==6)
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
        else if ($funcion==61)
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
					
?>		