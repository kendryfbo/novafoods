<?php
	session_start();
	if(!isset($_SESSION['usuario'])) 
	{
	  header('Location: index.php'); 
	  exit();
	}
	$user=($_SESSION['usuario']);
	$idUsuario=($_SESSION['id_Usuario']);  
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Formatos Novafoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
        <script src="js/funcion_combos.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
</head> 
<script>
$(document).ready(function() {
    $( "#display").change(function() {
        //alert("hola");
        if($.trim($("#display").val())==="") 
	{
            $("#display").focus ();
            $('#valida-display').fadeIn('slow'); 
            setTimeout(function(){$('#valida-display').fadeOut('slow');},1000); 
            return false;
	}
        if($.trim($("#display").val())==="0") 
	{
            $("#display").focus ();
            $('#valida-display2').fadeIn('slow'); 
            setTimeout(function(){$('#valida-display2').fadeOut('slow');},1000); 
            return false;
	}
        if($.trim($("#sobre").val())==="") 
	{
            $("#sobre").focus ();
            $('#valida-sobre').fadeIn('slow'); 
            setTimeout(function(){$('#valida-sobre').fadeOut('slow');},1000); 
            return false;
	}
        if($.trim($("#sobre").val())==="0") 
	{
            $("#sobre").focus ();
            $('#valida-sobre2').fadeIn('slow'); 
            setTimeout(function(){$('#valida-sobre2').fadeOut('slow');},1000); 
            return false;
	}
        if($.trim($("#contenido").val())==="") 
	{
            $("#contenido").focus ();
            $('#valida-contenido').fadeIn('slow'); 
            setTimeout(function(){$('#valida-contenido').fadeOut('slow');},1000); 
            return false;
	}
        if($.trim($("#contenido").val())==="0") 
	{
            $("#contenido").focus ();
            $('#valida-contenido2').fadeIn('slow'); 
            setTimeout(function(){$('#valida-contenido2').fadeOut('slow');},1000); 
            return false;
	}
        var list_umed = $('#list_umed option:selected').attr('id');
                //alert(list_umed);
        if(list_umed===undefined) 
        {
            $("#list_umed").focus ();
            $('#valida-list_umed').fadeIn('slow'); 
            setTimeout(function(){$('#valida-list_umed').fadeOut('slow');},1000); 
            return false;
        }else{
            var stream="list_umed="+list_umed;			 
                    $.ajax({
                        type: "POST",
                        url: "select/trae_pref_umed.php",
                        data:stream,
                        success: function(data){							
                            //alert (data);
                            var pref=data;
                            var dis=$("#display").val();
                            var sob=$("#sobre").val();
                            var con=$("#contenido").val();

                            if(dis==1){
                              var prefijo=sob+"x"+con+pref;
                              $("#formato").val(prefijo)  ;

                            }else{
                              var prefijo=dis+"x"+sob+"x"+con+pref;  
                              $("#formato").val(prefijo)  ;
                            }
                        }			
                    });
            
        }
        
                
        
    });
    $( "#sobre").change(function() {
        //alert("hola");
        if($.trim($("#display").val())==="") 
	{
            $("#display").focus ();
            $('#valida-display').fadeIn('slow'); 
            setTimeout(function(){$('#valida-display').fadeOut('slow');},1000); 
            return false;
	}
        if($.trim($("#display").val())==="0") 
	{
            $("#display").focus ();
            $('#valida-display2').fadeIn('slow'); 
            setTimeout(function(){$('#valida-display2').fadeOut('slow');},1000); 
            return false;
	}
        if($.trim($("#sobre").val())==="") 
	{
            $("#sobre").focus ();
            $('#valida-sobre').fadeIn('slow'); 
            setTimeout(function(){$('#valida-sobre').fadeOut('slow');},1000); 
            return false;
	}
        if($.trim($("#sobre").val())==="0") 
	{
            $("#sobre").focus ();
            $('#valida-sobre2').fadeIn('slow'); 
            setTimeout(function(){$('#valida-sobre2').fadeOut('slow');},1000); 
            return false;
	}
        if($.trim($("#contenido").val())==="") 
	{
            $("#contenido").focus ();
            $('#valida-contenido').fadeIn('slow'); 
            setTimeout(function(){$('#valida-contenido').fadeOut('slow');},1000); 
            return false;
	}
        if($.trim($("#contenido").val())==="0") 
	{
            $("#contenido").focus ();
            $('#valida-contenido2').fadeIn('slow'); 
            setTimeout(function(){$('#valida-contenido2').fadeOut('slow');},1000); 
            return false;
	}
        var list_umed = $('#list_umed option:selected').attr('id');
                //alert(list_umed);
        if(list_umed===undefined) 
        {
            $("#list_umed").focus ();
            $('#valida-list_umed').fadeIn('slow'); 
            setTimeout(function(){$('#valida-list_umed').fadeOut('slow');},1000); 
            return false;
        }else{
            var stream="list_umed="+list_umed;			 
                    $.ajax({
                        type: "POST",
                        url: "select/trae_pref_umed.php",
                        data:stream,
                        success: function(data){							
                            //alert (data);
                            var pref=data;
                            var dis=$("#display").val();
                            var sob=$("#sobre").val();
                            var con=$("#contenido").val();

                            if(dis==1){
                              var prefijo=sob+"x"+con+pref;
                              $("#formato").val(prefijo)  ;

                            }else{
                              var prefijo=dis+"x"+sob+"x"+con+pref;  
                              $("#formato").val(prefijo)  ;
                            }
                        }			
                    });
            
        }    
        
    });
    $( "#contenido").change(function() {
        //alert("hola");
        if($.trim($("#display").val())==="") 
	{
            $("#display").focus ();
            $('#valida-display').fadeIn('slow'); 
            setTimeout(function(){$('#valida-display').fadeOut('slow');},1000); 
            return false;
	}
        if($.trim($("#display").val())==="0") 
	{
            $("#display").focus ();
            $('#valida-display2').fadeIn('slow'); 
            setTimeout(function(){$('#valida-display2').fadeOut('slow');},1000); 
            return false;
	}
        if($.trim($("#sobre").val())==="") 
	{
            $("#sobre").focus ();
            $('#valida-sobre').fadeIn('slow'); 
            setTimeout(function(){$('#valida-sobre').fadeOut('slow');},1000); 
            return false;
	}
        if($.trim($("#sobre").val())==="0") 
	{
            $("#sobre").focus ();
            $('#valida-sobre2').fadeIn('slow'); 
            setTimeout(function(){$('#valida-sobre2').fadeOut('slow');},1000); 
            return false;
	}
        if($.trim($("#contenido").val())==="") 
	{
            $("#contenido").focus ();
            $('#valida-contenido').fadeIn('slow'); 
            setTimeout(function(){$('#valida-contenido').fadeOut('slow');},1000); 
            return false;
	}
        if($.trim($("#contenido").val())==="0") 
	{
            $("#contenido").focus ();
            $('#valida-contenido2').fadeIn('slow'); 
            setTimeout(function(){$('#valida-contenido2').fadeOut('slow');},1000); 
            return false;
	}
        var list_umed = $('#list_umed option:selected').attr('id');
                //alert(list_umed);
        if(list_umed===undefined) 
        {
            $("#list_umed").focus ();
            $('#valida-list_umed').fadeIn('slow'); 
            setTimeout(function(){$('#valida-list_umed').fadeOut('slow');},1000); 
            return false;
        }else{
            var stream="list_umed="+list_umed;			 
                    $.ajax({
                        type: "POST",
                        url: "select/trae_pref_umed.php",
                        data:stream,
                        success: function(data){							
                            //alert (data);
                            var pref=data;
                            var dis=$("#display").val();
                            var sob=$("#sobre").val();
                            var con=$("#contenido").val();

                            if(dis==1){
                              var prefijo=sob+"x"+con+pref;
                              $("#formato").val(prefijo)  ;

                            }else{
                              var prefijo=dis+"x"+sob+"x"+con+pref;  
                              $("#formato").val(prefijo)  ;
                            }
                        }			
                    });
            
        }      
        
    });
    $( "#list_umed").change(function() {
        if($.trim($("#display").val())==="") 
	{
            $("#display").focus ();
            $('#valida-display').fadeIn('slow'); 
            setTimeout(function(){$('#valida-display').fadeOut('slow');},1000); 
            return false;
	}
        if($.trim($("#display").val())==="0") 
	{
            $("#display").focus ();
            $('#valida-display2').fadeIn('slow'); 
            setTimeout(function(){$('#valida-display2').fadeOut('slow');},1000); 
            return false;
	}
        if($.trim($("#sobre").val())==="") 
	{
            $("#sobre").focus ();
            $('#valida-sobre').fadeIn('slow'); 
            setTimeout(function(){$('#valida-sobre').fadeOut('slow');},1000); 
            return false;
	}
        if($.trim($("#sobre").val())==="0") 
	{
            $("#sobre").focus ();
            $('#valida-sobre2').fadeIn('slow'); 
            setTimeout(function(){$('#valida-sobre2').fadeOut('slow');},1000); 
            return false;
	}
        if($.trim($("#contenido").val())==="") 
	{
            $("#contenido").focus ();
            $('#valida-contenido').fadeIn('slow'); 
            setTimeout(function(){$('#valida-contenido').fadeOut('slow');},1000); 
            return false;
	}
        if($.trim($("#contenido").val())==="0") 
	{
            $("#contenido").focus ();
            $('#valida-contenido2').fadeIn('slow'); 
            setTimeout(function(){$('#valida-contenido2').fadeOut('slow');},1000); 
            return false;
	}
		var list_umed = $('#list_umed option:selected').attr('id');
                //alert(list_umed);
                if(list_umed===undefined) 
                {
                    $("#list_umed").focus ();
                    $('#valida-list_umed').fadeIn('slow'); 
                    setTimeout(function(){$('#valida-list_umed').fadeOut('slow');},1000); 
                    return false;
                }else{
                    var stream="list_umed="+list_umed;			 
                    $.ajax({
                        type: "POST",
                        url: "select/trae_pref_umed.php",
                        data:stream,
                        success: function(data){							
                            //alert (data);
                            var pref=data;
                            var dis=$("#display").val();
                            var sob=$("#sobre").val();
                            var con=$("#contenido").val();

                            if(dis==1){
                              var prefijo=sob+"x"+con+pref;
                              $("#formato").val(prefijo)  ;

                            }else{
                              var prefijo=dis+"x"+sob+"x"+con+pref;  
                              $("#formato").val(prefijo)  ;
                            }						
                        }			
                    });
                }
    }); 
});
               
function ValidaSoloNumeros() {
 if ( event.keyCode != 46 && (event.keyCode < 48 ) || (event.keyCode > 57) ) 
  event.returnValue = false;
}
</script>
<body>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Creacion de Formatos </p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<div class="fright"><a href="listado_formatos.php" ><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Nombre</label>
										</td>
										<td>
											<input type="text" id='formato' placeholder="Ingrese Formato" readonly/>
											<div id="valida-formato" style="display:none" class="errores">
												Debe Ingresar Formato
											</div> 
											<div id="valida-formato_r" style="display:none" class="errores">
												Formato Se Encuentra Registrado
											</div> 
										</td>
									</tr>
                                                                        <tr>
										<td>
											<label>Display</label>
										</td>
										<td>
											<input type="text" id='display' placeholder="Ingrese Display"onkeypress="ValidaSoloNumeros()"/>
											<div id="valida-display" style="display:none" class="errores">
												Debe Ingresar Display
											</div> 
											<div id="valida-display2" style="display:none" class="errores">
												Display no puede ser igual a 0
											</div> 
										</td>
									</tr>
                                                                        <tr>
										<td>
											<label>Sobre</label>
										</td>
										<td>
											<input type="text" id='sobre' placeholder="Ingrese Sobre"onkeypress="ValidaSoloNumeros()"/>
											<div id="valida-sobre" style="display:none" class="errores">
												Debe Ingresar Sobre
											</div> 
											<div id="valida-sobre2" style="display:none" class="errores">
												Sobre no puede ser igual a 0
											</div> 
										</td>
									</tr>
                                                                        <tr>
										<td>
											<label>Contenido</label>
										</td>
										<td>
											<input type="text" id='contenido' placeholder="Ingrese Contenido"onkeypress="ValidaSoloNumeros()"/>
											<div id="valida-contenido" style="display:none" class="errores">
												Debe Ingresar Contenido
											</div> 
											<div id="valida-contenido2" style="display:none" class="errores">
												Contenido no puede ser igual a 0
											</div> 
										</td>
									</tr>
                                                                        <tr>
                                                                            <td>
                                                                                    <br><label>Unidad de Medida</label>
                                                                            </td>
                                                                            <td>
                                                                                    <select id="list_umed" > 
                                                                                    </select>
                                                                                    <div id="valida-list_umed" style="display:none" class="errores">
                                                                                            Debe Seleccionar Unidad de Medida
                                                                                    </div>
                                                                            </td>
                                                                            
										<td colspan="2">
											<div class="fright"><input type="submit" value="Crear Formato&raquo;" 
											onClick='$(this).ingresa_formato();'/>
											</div>
										</td>
                                                                     </tr> 
								</table>
							</article>
						</section>
					</div>
				</div>
			</div>
		</td>
	</tr>
</table>
</body>
</html>		
 
