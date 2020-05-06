$(document).ready(function(){
	$('#form_reportes').submit(listarRegistros );
	
	$('#contenedor_tabla').on("click", ".salidas", detalleSalidas);
	$('#modal_salidas .modal-body').on("click", ".id_ventas", verTicket);

	$("#descripcion_productos").autocomplete({
		serviceUrl: "../control/productos_autocomplete.php",   
		onSelect: function(eleccion){
			$("#id_productos").val(eleccion.data.id_productos);
			
		},
		autoSelectFirst	:true , 
		showNoSuggestionNotice	:true , 
		noSuggestionNotice	: "Sin Resultados"
	});
});



function listarRegistros(event){
	event.preventDefault();
	$('#contenedor_tabla').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>');
	var boton = $(this).find(':submit');
	var icono = boton.find('.fa');
	var formulario = $(this).serialize();
	$.ajax({
		url: 'tabla_movimientos.php',
		method: 'POST',
		dataType: 'HTML',
		data: formulario
		}).done(function(respuesta){
		$('#contenedor_tabla').html(respuesta);
		
		$(".sort").click(ordenar)
	});
}


function detalleSalidas(event){
	console.log("detalleSalidas()");
	
	event.preventDefault();
	
	var id_productos = $(this).data('id_productos');
	
	$.ajax({
		url: 'detalle_salidas.php',
		method: 'GET',
		data: {
			"fecha_inicio": $("#fecha_inicio").val(),
			"fecha_fin": $("#fecha_fin").val(),
			"id_productos": id_productos
		}
		}).done(function(respuesta){
		$('#modal_salidas .modal-body').html(respuesta);
		$('#modal_salidas').modal("show");
		
	});
}


function verTicket(){
	
	console.log("verTicket");
	var id_ventas = $(this).data("id_ventas");
	// var boton = $(this).prop("disabled",true);
	// var icono = boton.find(".fa");
	// icono.toggleClass("fa-eye fa-spinner fa-spin");
	
	$.ajax({
		url: "../corte/forms/modal_imprimir_venta.php",
		dataType: "HTML",
		data:{ id_ventas:id_ventas}
		}).done(function(respuesta){
		$('#ver_venta').html(respuesta);
		$('#modal_ticket').modal("show");
		
		
		
		// boton.prop("disabled",false);
		// icono.toggleClass("fa-print fa-spinner fa-spin");
		
	});
	// console.log("pago");
}

function ordenar(){
	$("#sort").val($(this).data("campo"));
	
	$('#form_reportes').submit();
	
}