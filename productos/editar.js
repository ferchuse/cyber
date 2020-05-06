
var producto_elegido ;

$(document).ready( function onLoad(){
	
	$("input").focus( function selecciona_input(){
		$(this).select();
	});
	
	$('#form_agregar_producto').submit(function(event){
		event.preventDefault();
	});
	
	$(document).on('keydown', disableFunctionKeys);
	
	alertify.set('notifier','position', 'top-right');
	
	$('#buscar_codigo').keypress( buscarCodigo);
	$('#codigo_productos').keypress( buscarCodigo);
	
	
	//Autocomplete Productos https://github.com/devbridge/jQuery-Autocomplete
	$("#buscar_producto").autocomplete({
		serviceUrl: "productos_autocomplete.php",   
		onSelect: function(eleccion){
			console.log("Elegiste: ",eleccion);
			cargarProducto(eleccion.data);
			$("#form_agregar_producto")[0].reset();
		},
		autoSelectFirst	:false , 
		showNoSuggestionNotice	:true , 
		noSuggestionNotice	: "Sin Resultados"
	});
	
	$("#descripcion_productos").autocomplete({
		serviceUrl: "productos_autocomplete.php",   
		onSelect: function(eleccion){
			console.log("Elegiste: ",eleccion);
			cargarProducto(eleccion.data);
		},
		autoSelectFirst	:false , 
		showNoSuggestionNotice	:true , 
		noSuggestionNotice	: "Sin Resultados"
	});
	
	$("#descripcion_productos").autocomplete({
		serviceUrl: "productos_autocomplete.php",   
		onSelect: function(eleccion){
			console.log("Elegiste: ",eleccion);
			cargarProducto(eleccion.data);
		},
		autoSelectFirst	:true , 
		showNoSuggestionNotice	:true , 
		noSuggestionNotice	: "Sin Resultados"
	});
	
	
	$('#costo_proveedor').keyup(modificarPrecio );
	$('#ganancia_menudeo_porc').keyup(calculaPrecioVenta );
	$('#precio_menudeo').keyup(calculaGanancia );
	
	$('#form_productos').submit( guardarProducto);
	
}); 

function calculaPrecioVenta() {
	console.log("calculaPrecioVenta");
	
	var ganancia_menudeo_porc = Number($(this).val());
	// var costo_unitario = Number($('#costo_unitario').val());
	var costo_unitario = Number($('#costo_proveedor').val());
	
	if (costo_unitario != '') {
		var ganancia_menudeo_pesos = (ganancia_menudeo_porc * costo_unitario) / 100;
		$('#ganancia_menudeo_pesos').val(ganancia_menudeo_pesos.toFixed(2));
		var precio_menudeo = costo_unitario + ganancia_menudeo_pesos;
		$('#precio_menudeo').val(precio_menudeo.toFixed(2));
	}
	
}

function buscarCodigo(event){
	if(event.which == 13){
		console.log("buscarCodigo()");
		var input = $(this);
		var codigoProducto = $(this).val();
		
		input.prop('disabled',true);
		// input.toggleClass('ui-autocomplete-loading');
		$.ajax({
			url: "../control/buscar_normal.php",
			dataType: "JSON",
			method: 'POST',
			data: {tabla:'productos', campo:'codigo_productos', id_campo: codigoProducto}
			}).done(function (respuesta){
			
			if(respuesta.numero_filas >= 1){
				console.log("Producto Encontrado");
				cargarProducto(respuesta.fila);
				
				// $('#form_agregar_producto')[0].reset();		
			}
			else{
				alertify.error('Código no Encontrado');
			}
			
			
			}).always(function(){
			
			// input.toggleClass('ui-autocomplete-loading');
			input.prop('disabled',false);
			input.focus();
		});
		
	}
}

function cargarProducto(producto) {
	
	$.each(producto, function(name, value){
		$("#" + name).val(value);
	});
	$("#form").removeClass("hidden");
}

function modificarPrecio() {
	console.log("modificarPrecio");
	var costo_proveedor = Number($(this).val());
	var cantidad_contenedora = Number($('#cantidad_contenedora').val());
	var ganancia_mayoreo_porc = Number($('#ganancia_mayoreo_porc').val());
	
	if (ganancia_mayoreo_porc != '') {
		
		//ganancia mayoreo
		var ganancia_mayoreo_pesos = (ganancia_mayoreo_porc * costo_proveedor) / 100;
		$('#ganancia_mayoreo_pesos').val(ganancia_mayoreo_pesos.toFixed(2));
		// $('#precio_mayoreo').val((costo_proveedor+ganancia_mayoreo_pesos).toFixed(2));
	}
	
	if (cantidad_contenedora != '') {
		var costo_pz = costo_proveedor / cantidad_contenedora;
		$('#costo_unitario').val(costo_pz.toFixed(2));
		
		if (costo_pz != '') {
			
			//ganancia menudeo
			var ganancia_menudeo_porc = Number($('#ganancia_menudeo_porc').val());
			var ganancia_menudeo_pesos = (ganancia_menudeo_porc * costo_pz) / 100;
			$('#ganancia_menudeo_pesos').val(ganancia_menudeo_pesos.toFixed(2));
			
			//precio mayoreo
			var precio_menudeo = costo_pz + ganancia_menudeo_pesos;
			$('#precio_menudeo').val(precio_menudeo.toFixed(2));
			
		}
	}
}
function calculaGanancia() {
	console.log("calculaGanancia()")
	var precio_menudeo = Number($(this).val());
	var costo_unitario = Number($('#costo_proveedor').val());
	
	if (costo_unitario != '') {
		var ganancia_menudeo_porc = ((precio_menudeo * 100) / costo_unitario) - 100;
		$('#ganancia_menudeo_porc').val(ganancia_menudeo_porc.toFixed(2));
		var ganancia_menudeo_pesos = precio_menudeo - costo_unitario;
		$('#ganancia_menudeo_pesos').val(ganancia_menudeo_pesos.toFixed(2));
		
	}
}

function guardarProducto(event) {
	event.preventDefault();
	var boton = $(this).find(':submit');
	var icono = boton.find('.fa');
	boton.prop('disabled', true);
	icono.toggleClass('fa-save fa-spinner fa-spin');
	
	var formulario = $(this).serializeArray();
	console.log("formulario: ", formulario)
	$.ajax({
		url: 'guardar.php',
		dataType: 'JSON',
		method: 'POST',
		data: formulario
		}).done(function (respuesta) {
		console.log(respuesta);
		if (respuesta.estatus == "success") {
			alertify.success('Se ha guardado correctamente');
			$('#form_productos')[0].reset();
			if($("#accion").val() == "editar"){
				$("#form").addClass("hidden");
				$("#buscar_producto").focus();
			}
			else{
				$("#codigo_productos").focus();
			}
			$('#form_productos')[0].reset();
			
		} 
		else {
			alertify.error('Error al guardar');
			
		}
		}).always(function () {
		boton.prop('disabled', false);
		icono.toggleClass('fa-save fa-spinner fa-spin');
	});
	
}




function disableFunctionKeys(e) {
	var functionKeys = new Array(112, 113, 114, 115, 117, 118, 119, 120, 121, 122);
	if (functionKeys.indexOf(e.keyCode) > -1 || functionKeys.indexOf(e.which) > -1) {
		e.preventDefault();
		
		console.log("key", e.which)
		
	}
	
	// if(e.key == 'F12'){
	
	// console.log("F12");
	
	// $("#cerrar_venta").click()
	// }
	
	if(e.key == 'F10'){
		console.log("F10");
		$("#buscar_producto").focus()
	}
	
	if(e.key == 'F11'){
		console.log("F11");
		aplicarMayoreo();
	}
	
	if(e.key == 'Escape'){
		
		console.log("ESC");
		
		$("#buscar_codigo").focus()
	}
	
};

function buscarRepetido() {
	$codigo = $("#codigo_productos").val();
	
	$.ajax({
		url:"..buscar_normal.php",
		data:"..buscar_normal.php",
		
		
	}).done();
}



