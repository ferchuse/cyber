$(".tipo_tarjeta").on("change click", calculaComision);
$("#efectivo").on("change keyup", function(){
	$("#pago").val($(this).val())
	calculaCambio();
	calculaComision();
	
});



$("#forma_pago").change(eligeFormaPago);



function calculaComision(){
	console.log("calculaComision")
	let porc_comision = $(".tipo_tarjeta:checked").val();
	
	if($("#forma_pago").val() == "mixto"){
		
		subtotal = Number($("#subtotal").val()) - Number($("#efectivo").val());
	}
	else{
		
		subtotal = Number($("#subtotal").val());
	}
	console.log("porc_comision:",porc_comision)
	console.log("subtotal:", subtotal)
	console.log("forma_pago:",$("#forma_pago").val() )
	
	let comision = subtotal * porc_comision;
	let tarjeta = subtotal + comision;
	
	$("#comision").val(Math.round(comision * 100) / 100);
	$("#tarjeta").val(Math.round(tarjeta * 100) / 100);
	// $("#comision").val(comision.toFixed(2));
	// $("#tarjeta").val(tarjeta.toFixed(2));
	// $("#tarjeta").val(tarjeta.toFixed(2));
}





function eligeFormaPago(event){
	
	// $("#forma_pago") hacer requeridos todos los input visibles y no requeridso los invisibles
	
	switch($(this).val()){
		
		case "efectivo":
		$("#div_efectivo").removeClass("hidden")
		$("#div_tarjeta").addClass("hidden")
		
		
		
		$("#efectivo").prop("readonly", true)
		$("#efectivo").val($("#subtotal").val())
		
		$("#tarjeta").val(0)
		$("#comision").val(0)
		break;
		
		case "tarjeta":
		
		$("#div_efectivo").addClass("hidden")
		$("#div_tarjeta").removeClass("hidden")
		
		$("#efectivo").val(0);
		$("#debito").click();
		
		break;
		
		case "mixto":
		$("#efectivo").prop("readonly", false)
		$("#efectivo").val($("#subtotal").val())
		$("#efectivo").focus()
		
		$("#div_efectivo").removeClass("hidden")
		$("#div_tarjeta").removeClass("hidden")
		$("#debito").click();
		// calculaComision()
		break;
		
		
		
	}
}

// $('.nav-tabs a[href=#ventana_efectivo]').on('shown.bs.tab', function(){
// console.log("pago en efectivo");
// $("#tarjeta").val(0)
// $("#comision").val(0)
// $("#forma_pago").val("efectivo")
// $("#efectivo").val($(".total:visible").val());
// $("#subtotal").val(0);

// $("#pago").val($("#efectivo").val());
// });

// $('.nav-tabs a[href=#ventana_tarjeta]').on('shown.bs.tab', function(){
// console.log("pago con tarjeta");
// $("#efectivo").val(0);
// $("#subtotal").val($(".total:visible").val());
// $("#forma_pago").val("tarjeta");
// calculaComision();
// });
// $('.nav-tabs a[href=#ventana_mixto]').on('shown.bs.tab', function(){
// console.log("pago mixto");
// $("#efectivo").val(0);
// $("#subtotal").val($(".total:visible").val());
// $("#forma_pago").val("tarjeta");
// calculaComision();
// });