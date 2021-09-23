<?php
	include("../login/login_success.php");
	include("../conexi.php");
	include("../funciones/generar_select.php");
	$link = Conectarse();
	$menu_activo = "productos";
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
				<div class="col-md-12">
					<h4 class="text-center">Productos
						
						<button type="button" class="btn btn-success pull-right btn-sm" id="btn_alta">
							<i class="fa fa-plus"></i> Nuevo
						</button>
						<button type="submit" form="form_imprimir_codigos" class="btn btn-sm btn-info pull-right" >
							<i class="fa fa-print"></i> Imprimir Códigos  
							(<span id="cant_seleccionados">0</span>)
						</button>
						<button id="btn_exportar"  class="btn btn-secondary d-print-none  pull-right btn-sm">
							<i class="fa fa-file-excel"></i> Exportar
						</button>
					</h4>
				</div>
			</div>
			
			<hr>
			<div class="row">
				<div class="col-md-12">
					<form id="form_filtros" class="form-inline">
						<div class="form-group">
							<label for="fecha_inicio">Departamento:</label>
							<?php echo generar_select($link, "departamentos", "id_departamentos", "nombre_departamentos", true)?>
						</div>
						<div class="form-group">
							<label for="fecha_fin">Existencias:</label>
							<select  class="form-control"  name="existencia">
								<option value="">TODAS</option>
								<option value="minimo">DEBAJO DEL MINIMO</option>
							</select>
						</div>
						<div class="form-group">
							<label for="ordenar">Ordenar Por:</label>
							<select  class="form-control"  name="orden">
								<option value="codigo_productos">Codigo</option>
								<option value="existencia_productos">Existencia</option>
								<option selected value="descripcion_productos">Descripción</option>
							</select>
						</div>
						<div class="form-group">
							<label for="asc">Orden:</label>
							<select  class="form-control"  name="asc">
								<option value="ASC">Ascendente</option>
								<option value="DESC">Descendente</option>
							</select>
						</div>
						
						<button type="submit" class="btn btn-sm btn-primary" id="btn_buscar">
							<i class="fa fa-search"></i> Buscar
						</button>
					</form>
					
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-12 text-center table-responsive" id="lista_productos">
					
					<table class="table table-bordered" id="tabla_productos">
						<thead class="bg-primary">
							<tr>
								<th class="text-center">Descripción</th>
								<th class="text-center">Código</th>
								<th class="text-center">Costo de Compra</th>
								<th class="text-center">Ganancia</th>
								<th class="text-center">Precio Venta</th>
								<th class="text-center">Precio Mayoreo</th>
								<th class="text-center">Mínimo</th>
								<th class="text-center">Existencia</th>
								<th class="text-center">Acciones</th>	
							</tr>
							<tr>
								<th class="text-center">
									<input type="text" class="form-control buscar_descripcion" data-indice="0" placeholder="Buscar descripcion" name="descripcion_productos" form="form_filtros">
								</th>
								<th colspan="7">
								</th>
								<th >
									<span class="badge badge-success" id="contar_productos"></span>
								</th>
							</tr>
						</thead>
						
						<tbody id="bodyProductos">                    
							<tr>
								<th class="text-center" colspan="9">
									<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
								</th>
							</tr>                   
							
						</tbody>
						
					</table>
					
				</div>
			</div>
		</div>
		<form id="form_imprimir_precios" target="_blank" action="../impresion/imprimir_precios.php">
		</form>
		<form id="form_imprimir_codigos" target="_blank" action="../impresion/imprimir_codigos.php">
		</form>
		<?php include('form_productos.php'); ?>
		<?php include('../forms/existencias.php'); ?>
		
		<?php  include('../scripts_carpetas.php'); ?>
		<script src="catalogo.js?<?= date("d-m-Y-H-m-s")?>"></script>
		<script src="carrito.js?<?= date("d-m-Y-H-m-s")?>"></script>
		<script src="https://unpkg.com/sticky-table-headers"></script>
	</body>
</html>