<?php


require ($_SERVER['DOCUMENT_ROOT'].'/clases/class.phpmailer.php');

class EnviaMail extends PHPMailer {

	var $Host     = "smtp.bsp.cl";
	var $Mailer   = "smtp";                         
	var $WordWrap = 75;
	public $mensaje;

	public function parametrosMail ($de,$nombre_de,$para,$cc ,$cco ,$asunto,$cuerpo,$adjunto)
	{

		try
		{	
			//desde
			$this->From = $de;
		    $this->FromName = $nombre_de;
			
			//destinatarios
			foreach($para as $destinatario=>$valores)
			{
				$this->AddAddress($valores["cuenta"],$valores["nombre"]);

			}
			//con copia
			foreach($cc as $concopia=>$valores)
			{
				$this->AddCC($valores["cuenta"],$valores["nombre"]);
			}
			//con copia oculta
			foreach($cco as $concopiaoculta=>$valores)
			{
				$this->AddBCC($valores["cuenta"],$valores["nombre"]);
			}
			//asunto
			$this->Subject = $asunto;
			//cuerpo
			$this->Body    = $cuerpo;
			//adjuntar archivos
			foreach($adjunto as $atachar=>$valores)
			{
				$this->AddAttachment($valores["ruta"],$valores["archivo"]);
			}

			if(!$this->Send())
			{
				$mensaje="Error no se pudo mandar el Mail!!!";
				
				
			}
			else
			{
				$mensaje= "Correo Enviado!!!";
			}
		}
		catch(Exception $e)
		{
			$mensaje= "Error al mandar el mensaje : ".$e->getMessage();
		}
		return $mensaje;
		
	}



}
?>