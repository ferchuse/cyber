<?php
	include("../conexi.php");
	$link = Conectarse();
	
	$str_productos = implode(",", $_GET['id_productos']);
	$consulta = "SELECT * FROM productos WHERE id_productos IN ({$str_productos})";
	// echo $consulta;
	$result = mysqli_query($link, $consulta);
	while ($fila = mysqli_fetch_assoc($result)) {
		$fila_productos[] = $fila;
	}
	
?>

<!DOCTYPE html>
<html lang="es">
	
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Codigos de Barras</title>
		<link rel="stylesheet" href="../css/bootstrap4.min.css"> 
		<!-- Bootstrap & CSS -->
		
		<!--
			<link rel="stylesheet" href="../css/imprimir_precios.css">
		-->
		
	</head>
	
	<body>
		<div class="container">
			<div class="row">
				<?php foreach ($fila_productos as $index => $producto) { ?>
					
					<div class="col-2 border producto text-center ">
						
						<div class="barcode"></div>
						<div class="text-bold codigo"><?php echo $producto["codigo_productos"]; ?></div>
						
						<?php echo $producto["descripcion_productos"]; ?>
						
						
						
					</div>
					
					
					<?php 
					if(count($fila_productos) > 60 && (count($fila_productos) % ($index + 1 )) == 0) {
						// echo "page break ";
						
						}
					} 
				?>
			</div>
		</div>
		
		<script type="text/javascript" src="../lib/jquery.min.js"></script>
		<script type="text/javascript" src="../lib/jquery-barcode.min.js"></script>
		<script>
			
			
			$(".codigo").each(function(index, item){
				
				
				let codigo = $(this).text();
				
				var btype = "code128";
				
				var settings = {
					output: "bmp",
					bgColor: "#FFFFFF",
					color: "#000000",
					barWidth: "2",
					barHeight: "50"
					
				};
				
				$(this).closest(".producto").find(".barcode").barcode(codigo, btype, settings);
				
				// $("#div_codigos").append("<div class='grid'><DIV class='barras'></div><div class='codigo_texto'>MCR - "+codigo+"</div><button type='button' class='btn btn-danger no_imprimir btn_delete'><i class='fa fa-times'></i></button></div>");
				// $(".grid").last().find(".barras").barcode(codigo, btype, settings);
			});
		</script>
		
		
	</body>
	
</html>