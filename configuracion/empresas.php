<?php
	include("../login/login_success.php");
	include("../conexi.php");
	$link = Conectarse();
	$menu_activo = "configuracion";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Configuración de la Empresa</title>
		
		<?php include("../styles_carpetas.php");?>
		
	</head>
  <body>
		
		<?php include("../menu_carpetas.php");?>
		
		
		<div class="container">
			<h3 >Datos de la Empresa</h3>
			<hr>
			<?php include("form_empresas.php");?>
		</div>
		<?php  include('../scripts_carpetas.php'); ?>
	</body>
</html>