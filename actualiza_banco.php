<?php
$id_banco=$_GET["id_banco"];
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
	<title>Bancos NovaFoods</title>
	<meta charset="utf-8" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<link href="css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.js"></script>
	<script src="js/funcion_listados.js" type="text/javascript"></script>
</head> 
<script>
$(document).ready(function() {
	var id_banco = "<?php echo $id_banco;?>";	 
	$.getJSON("select/trae_banco.php",{id_banco:id_banco},function(data){					
		for(i=0;i<data.length;i++)
		{
			$('#banco').val(data[i].banco);
 		}					 
	});  
});
</script>
<body>
<table class="table">
	<tr>
		<td height="100%">
			<div class="body">				 
				<div class="modulo widht_modulo_full">
					<div class="title"><p>Actualizacion de Bancos</p>
					</div>
					<div class="content">     
						<section>
							<article class="module width_full"> 
								<div>  
									<div class="fright"><a href="bancos.php" ><input type="button" value="Volver &raquo;"/></a>
									</div>
								</div>
								<table class="tableform">
									<tr>
										<td>
											<label>Banco</label>
										</td>
										<td>
											<input type="text" id='banco' placeholder="Ingrese Banco" onkeyup="javascript:this.value=this.value.toUpperCase();"/> 
											<div id="valida-banco" style="display:none" class="errores">
												Debe Ingresar el Banco
											</div> 
											<div id="valida-banco_r" style="display:none" class="errores">
												Su Banco Se Encuentra Registrado
											</div> 
											<input type="hidden" id='id_banco' value='<?php echo $id_banco ?>'/> 
										</td>
										<td colspan="2">
											<div class="fright"><input type="submit" value="Actualizar &raquo;" onClick='$(this).actualizar_banco();'/>
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
 