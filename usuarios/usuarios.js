$(document).ready(function(){
	
		listarRegistros();

	$('#btn_usuario').click(function(){
		$('#form_usuario')[0].reset();
		$('#modal_usuario').modal('show');
	});
	


	$('#form_usuario').submit(guardarRegistro );
});

function listarRegistros(){
		$.ajax({
			url: 'lista_usuarios.php',
			method: 'POST',
			dataType: 'HTML',
			}).done(function(resultado){
			$('#lista_usuario').html(resultado);
			
			//--------EDITAR GRUPO----------
			$('.btn_editar').click(cargarRegistro);
			
			//ELIMINAR
			$('.btn_eliminar').click(function(){
				var boton = $(this);
				var icono = boton.find('.fa');
				boton.prop('disabled',true);
				icono.toggleClass('fa-trash fa-spinner fa-spin fa-floppy-o');
				var fila = boton.closest('tr');
				var id_usuarios = boton.data('id_usuarios');
				var eliminar = function(){
					$.ajax({
						url: '../control/eliminar_normal.php',
						method: 'POST',
						dataType: 'JSON',
						data: {campo: 'id_usuarios', tabla:'usuarios', id_campo: id_usuarios}
						}).done(function(respuesta){
						
						if(respuesta.estatus == "success"){
							fila.fadeOut(1000);
							alertify.success('Se ha eliminado');
							}else{
							console.log(respuesta.error);
						}
						}).fail(function(xhr, textStatus, errorThrown ){
						
						alertify.error("Ocurrió un Error:" + errorThrown);
						}).always(function(){
						boton.prop('disabled',false);
						icono.toggleClass("fa-trash fa-spinner fa-spin fa-floppy-o");
						
					});
				};
				alertify.confirm('Confirmacion', '¿Desea eliminarlo?', eliminar , function(){
					icono.toggleClass("fa-trash fa-spinner fa-spin fa-floppy-o");
					boton.prop('disabled',false);
				});
			});	
		});
	}


function guardarRegistro(event){
	console.log("guardarRegistro")
	event.preventDefault();
	let datos = $(this).serialize();
	let boton = $(this).find(":submit");
	let icono = boton.find(".fas");
	
	boton.prop("disabled", true);
	icono.toggleClass("fa-save fa-spinner fa-spin");
	
	$.ajax({
		url: 'consultas/guardar_usuarios.php',
		dataType: 'JSON',
		method: 'POST',
		data: datos
		
	}).done(
	function(respuesta){
		
		if(respuesta.estatus == "success"){
			alertify.success('Se ha agregado correctamente');
			$('#form_usuario')[0].reset();
			$('#modal_usuario').modal("hide");
			listarRegistros();
			}else{
			console.log(respuesta.mensaje);
		}
		}).always(function(){
		
		boton.prop("disabled", false);
		icono.toggleClass("fa-save fa-spinner fa-spin");
		
		
	}); 
}


//FUNCION DE Cargar datos
function cargarRegistro() {
	console.log("cargarRegistro()");
	var $boton = $(this);
	var id_registro= $(this).data("id_registro");
	$("#form_usuario")[0].reset();
	$boton.prop("disabled", true);
	
	$.ajax({
		url: 'consultas/cargar_permisos.php',
		method: 'GET',
		data: {
			id_usuarios: id_registro
		}
		}).done(function(respuesta){
		console.log("imprime registros")
		$boton.prop("disabled", false);
		// console.table(respuesta.data.permisos);
		
		//Imprime Datos del Usuario
		$.each(respuesta.data.usuarios, function(name , value){
			$("#form_usuario").find("#"+ name).val(value);
			// console.log("name", name)
			if(name == "id_usuarios"){
				$("#edicion_id_usuarios").val(value);
			}
			
		});
		
		//Imprime permisos
		if(respuesta.data.permisos){
			$.each(respuesta.data.permisos, function(index , permiso){
				$input_paginas = $('input[value="'+permiso.id_paginas+'"].id_paginas');
				
				$input_paginas.closest("tr").find('input[value="'+permiso.permiso+'"]').prop("checked", true);
				
			});
			
		}
		
		$("#modal_usuario").modal("show");
		
	});
}