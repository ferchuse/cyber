<?php
	require_once(__DIR__ . '/vendor/autoload.php');
	require_once(__DIR__ . '/../conexi.php');
	
	$link = Conectarse();
	
	$consulta = "SELECT * FROM productos WHERE existencia_productos < min_productos AND usa_inventario = 'SI'
	
	ORDER BY descripcion_productos
	";
	
	$result = mysqli_query($link, $consulta);
	
	while($fila = mysqli_fetch_assoc($result)){
		
		$productos[] = [
		"NOMBRE" => $fila["descripcion_productos"], 
		"CANTIDAD" => $fila["existencia_productos"]
		];
	}
	
	
	
	
	
	// Configure API key authorization: api-key
	$config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
	
	// Uncomment below line to configure authorization using: partner-key
	// $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('partner-key', 'YOUR_API_KEY');
	
	$apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
	);
	$sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail(); // \SendinBlue\Client\Model\SendSmtpEmail | Values to send a transactional email
	$sendSmtpEmail['to'] = array(
	array('email'=>'ferchuse@hotmail.com', 'name'=>'Fernando Guzman'),
	array('email'=>'dosarka7@gmail.com', 'name'=>'Cyber El Ark@')
	
	);
	
	$sendSmtpEmail['templateId'] = 2;
	$sendSmtpEmail['params'] = array(
	
	'productos'=> $productos
	
	
	);
	
	$sendSmtpEmail['headers'] = array('X-Mailin-custom'=>'custom_header_1:custom_value_1|custom_header_2:custom_value_2');
	
	try {
		$result = $apiInstance->sendTransacEmail($sendSmtpEmail);
		print_r($result);
		} catch (Exception $e) {
		echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
	}
	
	exit();
	/*
		
		// PHP SDK: https://github.com/sendinblue/APIv3-php-library
		require_once(__DIR__ . '/vendor/autoload.php');
		
		// Configure API key authorization: api-key
		$config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', 'YOUR_API_KEY');
		
		$apiInstance = new SendinBlue\Client\Api\ContactsApi(
		// If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
		// This is optional, `GuzzleHttp\Client` will be used as default.
		new GuzzleHttp\Client(),
		$config
		);
		$createContact = new \SendinBlue\Client\Model\CreateContact(); // \SendinBlue\Client\Model\CreateContact | Values to create a contact
		$createContact['email'] = 'john@doe.com';
		
		try {
		$result = $apiInstance->createContact($createContact);
		print_r($result);
		} catch (Exception $e) {
		echo 'Exception when calling ContactsApi->createContact: ', $e->getMessage(), PHP_EOL;
		}
		
	*/
?>