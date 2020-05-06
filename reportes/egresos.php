<?php
	include("../login/login_success.php");
	include("../funciones/generar_select.php");
	include("../conexi.php");
	
	$link = Conectarse();
	
	$menu_activo = "reportes";
	
	$dt_fecha_inicial = new DateTime("first day of this month");
	$dt_fecha_final = new DateTime("last day of this month");
	
	$fecha_inicial = $dt_fecha_inicial->format("Y-m-d");
	$fecha_final = $dt_fecha_final->format("Y-m-d");
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		
    <title>Reportes</title>
		
		<?php include("../styles_carpetas.php");?>
		
	</head>
  <body>
		
		<?php include("../menu_carpetas.php");?>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h3 class="text-center">Reporte de Egresos</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<form id="form_filtros" class="form-inline">
						
						<input type="hidden" id="sort" name="sort" value="tipo_egreso">
						<input type="hidden" id="order" name="order" value="ASC">
						
						<input class="buscar  form-control float-left" type="search" placeholder="Buscar">
					
						<div class="form-group">
							<label for="fecha_inicial">Desde:</label>
							<input type="date" name="fecha_inicial" id="fecha_inicial" class="form-control" value="<?php echo $fecha_inicial;?>">
						</div>
						<div class="form-group">
							<label for="fecha_final">Hasta:</label>
							<input type="date" name="fecha_final" id="fecha_final" class="form-control" value="<?php echo $fecha_final;?>">
						</div>
						
						<div class="form-group hidden">
							<label for="id_proveedores">Proveedor:</label>
							<?php echo generar_select($link, "proveedores", "id_proveedores" , "nombre_proveedores", true, false, false)?>
						</div>
						
						<div class="form-group">
							<label for="id_catalogo_egresos">Categoria:</label>
							<?php echo generar_select($link, "catalogo_egresos", "id_catalogo_egresos" , "tipo_egreso", true, false, false)?>
						</div>
						
						<button type="submit" class="btn btn-primary" id="btn_buscar">
							<i class="fa fa-search"></i> Buscar
						</button>
					</form>
				</div>
			</div>
			<hr> 
			<div class="row">
				<div class="col-sm-12 text-center table-responsive" id="tabla_reporte">
					
				</div>
			</div>
		</div >
		
		
		<?php  include('../scripts_carpetas.php'); ?>
		<script >
			$(document).ready(onLoad);
			
			
			function onLoad(){
				$('#form_filtros').submit(filtrar);
				
				$(".buscar").keyup(buscarFila);
				$(".buscar").change(buscarFila);
				
				
			}
			
			function filtrar(event){
				event.preventDefault();
				$('#contenedor_tabla').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>');
				var boton = $(this).find(':submit');
				var icono = boton.find('.fa');
				var formulario = $(this).serialize();
				$.ajax({
					url: "tabla_egresos.php",
					dataType: 'HTML',
					data: formulario
					}).done(function(respuesta){
					$('#tabla_reporte').html(respuesta);
					
					$('.sort').click(ordenarTabla);
				});
			}
			
			
			function buscarFila(event) {
				var value = $(this).val().toLowerCase();
				console.log("buscando", value);
				$("#tabla_reporte tbody tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			}	
			
			function ordenarTabla() {
				$(this).toggleClass("asc desc");
				console.log("ordenarTabla");
				
				if(	$("#order").val() ==  "ASC"){
					$("#order").val("DESC");
				}
				else{
					$("#order").val("ASC");
				}
				
				$("#sort").val($(this).data("columna"));
				$('#form_filtros').submit();
			}
			
			
		</script>
		
		
	</body>
</html>