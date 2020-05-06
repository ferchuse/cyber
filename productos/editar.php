<?php
	include("../login/login_success.php");
	include("../conexi.php");
	include("../funciones/generar_select.php");
	$link = Conectarse();
	$menu_activo = "productos";
	

	// if($_GET["accion"] == "nuevo"){
		// $titulo = "Nuevo Producto";
		// $busqueda = "hidden";
		// $form = "";
	// }
	// else{
		// $busqueda = "";
		// $titulo = "Editar Producto";
		// $form = "hidden";
	// }

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			#respuesta_rep{
			color: red;
			}
			</style>
    <title>Productos</title>
		
		<?php include("../styles_carpetas.php");?>
		
	</head>
  <body>
		
		<?php include("../menu_carpetas.php");?>
		
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="text-center"><?php echo $titulo?></h4>
					<input type="hidden" id="accion" value="<?php echo $_GET["accion"]?>">
				</div>
			</div>
			<div class="">
			<!--
				<form id="form_agregar_producto" class="<?php echo $busqueda;?>" autocomplete="off">
					<div class="row">
						<div class="col-sm-4">
							<label for="">Código de Barras:</label>
							<div class="input-group">
								<input id="buscar_codigo"   type="text" class="form-control" placeholder="ESC" >
								
								<span class="input-group-addon"><i class="fas fa-search "></i></span>
							</div>
							
							
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Descripción:</label>
								<div class="input-group">
									<input id="buscar_producto"   type="text" class="form-control" placeholder="F10" >
									<span class="input-group-addon"><i class="fas fa-search "></i></span>
								</div>
								
							</div>
						</div>
						
					</div>
				</form>
				-->
				<hr>
			</div>
			
			<div id="form" class="<?php echo $form;?>">
				<?php include('form_productos.php'); ?>
			</div>
			
			
		</div>
		
		
		<?php  include('../scripts_carpetas.php'); ?>
		<script src="editar.js"></script>
		
	</body>
</html>