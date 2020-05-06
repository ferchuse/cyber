<?php
	
	include('../conexi.php');
	include('../funciones/numero_a_letras.php');
	$nombre_empresa = "MINISUPER 3G";
	
	$link = Conectarse();
	$consulta = "SELECT * FROM ventas
	LEFT JOIN ventas_detalle USING (id_ventas)
	LEFT JOIN usuarios USING (id_usuarios)
	WHERE id_ventas={$_GET["id_ventas"]}";
	
	$result = mysqli_query($link, $consulta);
	
	while ($fila = mysqli_fetch_assoc($result)) {
		$fila_venta[] = $fila;
	}
	
?>

<!-- "Ticket" -->
<section class="ticket container">
	<!-- "Encabezado" Ticket -->
	<section class="encabezado">
		<!-- "Empresa" -->
		<div class="empresa row">
			<!-- "Nombre" -->
			<p class="nombre col-xs-12"><?php echo $nombre_empresa; ?></p>
		</div>
		
		<!-- "Venta" -->
		<div class="venta row">
			<!-- "Datos" -->
			<div class="datos col-xs-12">
				<!-- "Folio" -->
				<div class="folio row margin-none">
					<span class="etiquetas col-xs-4">Folio:</span>
					<div class="valores col-xs-8">
						<?php echo $fila_venta[0]["id_ventas"]; ?>
					</div>
				</div>
				<!-- "Fecha" -->
				<div class="fecha row margin-none">
					<span class="etiquetas col-xs-4">Fecha:</span>
					<div class="valores col-xs-8" id="fecha" name="fecha">
						<?php echo date("d/m/Y", strtotime($fila_venta[0]["fecha_ventas"])); ?>
					</div>
				</div>
				<!-- "Hora" -->
				<div class="hora row margin-none">
					<span class="etiquetas col-xs-4">Hora:</span>
					<div class="valores col-xs-8" id="hora" name="hora">
						<?php echo date("h:i A", strtotime($fila_venta[0]["hora_ventas"])); ?>
					</div>
				</div>
				<!-- "Turno" -->
				<div class="hora row margin-none">
					<span class="etiquetas col-xs-4">Turno:</span>
					<div class="valores col-xs-8" >
						<?php echo ($fila_venta[0]["id_turnos"]); ?>
					</div>
				</div>
				<!-- "Usuario" -->
				<div class="usuario row margin-none">
					<span class="etiquetas col-xs-4">Usuario:</span>
					<div class="valores col-xs-8" id="usuario" name="usuario">
						<?php echo $fila_venta[0]["nombre_usuarios"]; ?>
					</div>
				</div>
				<!-- "Cliente" -->
				<div hidden class="cliente row margin-none">
					<span class="etiquetas col-xs-4">Cliente:</span>
					<div class="valores col-xs-8" id="cliente" name="cliente">
						<?php echo $fila_venta[0]["nombre_cliente"]; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<!-- "Cuerpo" Ticket -->
	<section class="cuerpo">
		<!-- "Lista" -->
		<table class="lista table">
			<!-- "Encabezados" -->
			<thead class="encabezados">
				<tr class="etiquetas uno">
					<td class="empty"></td>
					<td class="descripcion text-left" colspan="3">DESCRIPCIÓN DEL PRODUCTO</td>
				</tr>
				<tr class="etiquetas dos">
					<td class="cantidad text-left">Cant.</td>
					<td class="unitario text-left" colspan="2">Precio Unitario</td>
					<td class="importe text-right">Importe</td>
				</tr>
			</thead>
			
			<!-- Productos -->
			<tbody class="productos">
				<?php foreach ($fila_venta as $i => $producto) { ?>
					
					<tr class="valores uno">
						<td class="cantidad text-left"><?php echo $producto["cantidad"]; ?></td>
						<td class="descripcion" colspan="3"><?php echo $producto["descripcion"]; ?></td>
					</tr>
					<tr class="valores dos">
						<td class="empty"></td>
						<td class="precio" colspan="2"><?php echo "$" . $producto["precio"]; ?></td>
						<td class="importe text-right"><?php echo "$" . $producto["importe"]; ?></td>
					</tr>
					
				<?php } ?>
			</tbody>
			<tfoot class="">
				
				<?php
					if($fila_venta[0]["forma_pago"] == "efectivo"){
					?>
					<tr>
						<td class="etiqueta text-right" colspan="3"><strong>Total:</strong></td>
						<td class="valor text-right"><?php echo "$" . $producto["total_ventas"] ?></td>
					</tr>
					<tr>
						<td class="etiqueta text-right" colspan="3"><strong>Pago Con :</strong></td>
						<td class="valor text-right"><?php echo "$" . $producto["pagocon_ventas"] ?></td>
					</tr>
					<tr>
						<td class="etiqueta text-right" colspan="3"><strong>Cambio :</strong></td>
						<td class="valor text-right"><?php echo "$" . $producto["cambio_ventas"] ?></td>
					</tr>
					
					
					<?php
					}
					elseif($fila_venta[0]["forma_pago"] == "tarjeta"){
					?>
					
					<tr>
						<td class="etiqueta text-right" colspan="3"><strong>Subtotal:</strong></td>
						<td class="valor text-right"><?php echo "$" . $fila_venta[0]["subtotal_ventas"] ?></td>
					</tr>
					<tr>
						<td class="etiqueta text-right" colspan="3"><strong>Comision:</strong></td>
						<td class="valor text-right"><?php echo "$" . $fila_venta[0]["comision"] ?></td>
					</tr>
					<tr>
						<td class="etiqueta text-right" colspan="3"><strong>Total:</strong></td>
						<td class="valor text-right"><?php echo "$" . $fila_venta[0]["tarjeta"] ?></td>
					</tr>
					
					<?php
					}
					else{ ?>
					
					
					<tr>
						<td class="etiqueta text-right" colspan="3"><strong>Efectivo :</strong></td>
						<td class="valor text-right"><?php echo "$" . $producto["efectivo"] ?></td>
					</tr>
					<tr>
						<td class="etiqueta text-right" colspan="3"><strong>Pago Con :</strong></td>
						<td class="valor text-right"><?php echo "$" . $producto["pagocon_ventas"] ?></td>
					</tr>
					<tr>
						<td class=" text-right" colspan="3"><strong>Cambio :</strong></td>
						<td class=" text-right"><?php echo "$" . $producto["cambio_ventas"] ?></td>
					</tr>
					
					
					<tr>
						<td class=" text-right" colspan="3"><strong>Tarjeta:</strong></td>
						<td class=" text-right"><?php echo "$" . $fila_venta[0]["tarjeta"] ?></td>
					</tr>
					
					<hr>
					<tr>
						<td class=" text-right" colspan="3"><strong>Total:</strong></td>
						<td class=" text-right"><?php echo "$" . $fila_venta[0]["total_ventas"] ?></td>
					</tr>
					
					
					<?php
					}
				?>
			</tfoot>
			
		</table>
	</section>
	
	<!-- "Pie" Ticket -->
	<section class="pie">
		<!-- Total En "Letras" -->
		<div class="letras text-center">
			<?php echo NumeroALetras::convertir($producto["total_ventas"], "pesos", "centavos") ?>
		</div>
		
		<!-- "Mensaje" -->
		<div class="mensaje text-center">
			GRACIAS POR SU COMPRA
		</div>
	</section>
</section>