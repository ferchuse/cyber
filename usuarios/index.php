<?php 
	include('../login/login_success.php');
	include('../conexi.php');
	$link = Conectarse();
	$menu_activo = "usuarios";
?>
<!DOCTYPE html>
<html lang="es">
	
	<head>
		
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		
		
    <title>Usuarios</title>
		<?php include('../styles_carpetas.php'); ?>
	</head>
	
	<body>
		
    <div id="wrapper">
			<div class="container-fluid">
				<?php include('../menu_carpetas.php'); ?>    
			</div>
			<div id="page-wrapper">
				
				<div class="container-fluid">
					
					<div class="row">
						<div class="col-md-12">
							<h3 class="text-center">Usuarios</h3>
							<button class="btn btn-success pull-right" type="button" id="btn_usuario">
								<i class="fa fa-plus"></i> Nuevo
							</button>
							<hr>
						</div>
					</div>
					<br>
				</div>
				<div class="table-responsive" id="lista_usuario">
					<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>
				</div>
				<div class="container">
					<?php include("form_usuarios.php");?>
				</div>
				<!-- /#page-wrapper --> 
			</div>
			<!-- /#wrapper -->
		</div>
		<?php include('../scripts_carpetas.php');?>
    <script src="usuarios.js?v=<?= date("d-m-Y-h-i-s")?>"></script>
	</body>
</html>