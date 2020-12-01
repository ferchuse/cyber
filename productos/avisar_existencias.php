<?php 
	include("../conexi.php");
	require '../lib/phpmailer/PHPMailerAutoload.php';
	$link = Conectarse();
	
	$listaProductos = $_POST['productos'];
	$body = "
	<center><b>Los siguientes productos se encuentran debajo del minimo de existencia</b> </center>
	
	<table>
	<thead>
	<tr>
	<th>Producto</th>
	<th>Minimo</th>
	<th>Existencia Actual</th>
	</tr>
	
	</thead>
	";
	
	
	
	foreach($listaProductos as $indice => $producto){
		
		
		$buscar_productos = "SELECT
		id_productos,
		descripcion_productos,
		existencia_productos,
		min_productos
		FROM
		productos
		WHERE
		existencia_productos <= min_productos
		AND usa_inventario = 'SI'
		AND id_productos = '{$producto["id_productos"]}' 
		ORDER BY descripcion_productos
		
		";
		
		$result = mysqli_query($link, $buscar_productos);
		
		if($result){
			
			if(mysqli_num_rows($result) > 0){
				$productos_sin_stock[] = $producto;
				
			}
			// $respuesta['estatus_detalle'] = 'success';
			// $respuesta['mensaje_detalle'] = 'Ventas Detalles guardado';
			
		}
		else{
			$respuesta['estatus'] = 'error';
			$respuesta['mensaje'] = mysqli_error($link);
			$respuesta['consulta'] = $buscar_productos;
		}
		
		
	}
	
	$body= "	
	
	</table>
	<hr>
	<small><a href='www.glifo.mx'>glifo.mx</a></small>
	";
	
	
	
	$correo_clientes = isset($_GET["correo"]) ? $_GET["correo"] : "ferchuse@hotmail.com";
	// $url_xml = isset($_GET["url_xml"]) ? $_GET["url_xml"] : 'timbrados/A2000.xml';
	// $url_pdf = isset($_GET["url_pdf"]) ? $_GET["url_pdf"] : 'timbrados/A2000.pdf';
	
	
	$mail = new PHPMailer;
	$mail->CharSet = 'UTF-8';
	$mail->Encoding = 'base64';
	
	$mail->isSMTP();                                    
	$mail->Host = 'smtp.live.com';  
	$mail->SMTPAuth = true;                              
	// $mail->Username = 'facturacion@glifo.mx';                
	// $mail->Password = 'glifo951';    
	$mail->Username = 'sistemas@glifo.mx';                
	$mail->Password = 'ferchusesaifer';                            
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    
	$mail->SMTPDebug = 0;                            //Activa depuracion SMTP
	
	$mail->setFrom('sistemas@glifo.mx', 'Sistemas Glifo Media ');
	// $mail->addAddress($correo_clientes);     // Destinatario
	// $mail->addBCC("contacto@innovaasesoria.com");     // Copia Oculta
	$lista_correos = explode("," ,$correo_clientes ) ;
	$respuesta["lista_correos"] = $lista_correos;
	foreach($lista_correos as $index => $correo){
		$mail->addAddress($correo); 
	}
	
	
	$mail->addBCC("sistemas@glifo.mx"); 
	// $mail->addBCC("colegiocovarrubias@gmail.com");     //  Copia Oculta
	
	$mail->addReplyTo("sistemas@glifo.mx", "Glifo Media");      // Add attachments
	$mail->addAttachment($url_xml);        // Add attachments
	$mail->addAttachment($url_pdf);         // Add attachments
	// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML
	
	$mail->Subject = 'Cyber El Ark@ Productos bajos de existencia';
	$mail->Body    = $body; 
	
	
	$mail->AltBody = "Adjunto Factura  ";
	
	if(!$mail->send()) {
		$respuesta["estatus_correo"] = "error";
		$respuesta["mensaje_correo"] = 'No se envio el correo.'. $mail->ErrorInfo;
		
		} else {
		$respuesta["estatus_correo"] = "success";
		$respuesta["mensaje_correo"] = "Correo Enviado Correctamente";
		
	}
	
	echo json_encode($respuesta);
?>
