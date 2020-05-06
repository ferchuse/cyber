<?php 
	include('../conexi.php');
	$link = Conectarse();
	
	
	
	$salidas = [];
	
	
	
	
	$consulta_salidas = "
	
	SELECT
	*
	FROM
	ventas
	LEFT JOIN ventas_detalle USING (id_ventas)
	WHERE
	fecha_ventas BETWEEN '{$_GET['fecha_inicio']}'
	AND '{$_GET['fecha_fin']}'
	AND id_productos = '{$_GET['id_productos']}'
	AND estatus_ventas = 'PAGADO'
	";
	
	
	$result_salidas = mysqli_query($link,$consulta_salidas) or die ("<pre>Error en $consulta_salidas". mysqli_error($link). "</pre>");
	
	while($fila = mysqli_fetch_assoc($result_salidas)){
		
		$salidas[] = $fila;
		
	}
?>

<pre class="hidden">
	<?php echo $consulta_salidas;?>
</pre>

<?php 
	if(mysqli_num_rows($result_salidas) < 1){
	?>
	<br>
	
	<div class="alert alert-warning text-center">
	  <strong>No hay registros</strong> 
	</div>
	<?php		
	}
	else{
	?>
	
	
	<h4 class="text-center">
	<?php echo $salidas[0]["descripcion"];?></td>
</h4>

<div class="table-responsive">
	<table class="table table-hover">
		<tr>
			<th class="text-center">#</th>
			<th class="text-center">Folio</th>
			<th class="text-center">Fecha</th>
			<th class="text-center">Cantidad</th>                                                         
		</tr>
		<?php 
			$total = 0;
			foreach($salidas AS $i => $fila_salidas){
				$total+=$fila_salidas["cantidad"];
			?>
			<tr class="text-center">
				<td><?= ($i + 1);?></td>
				<td>
					<a href="#" class="id_ventas" data-id_ventas="<?php echo $fila_salidas["id_ventas"];?>" title="Ver Detalle de Venta">
						<?php echo $fila_salidas["id_ventas"] ;?>
					</a>
				</td>
				<td><?= date("d/m/Y", strtotime($fila_salidas["fecha_ventas"]))." " .$fila_salidas["hora_ventas"] ?></td>
				<td><?php echo $fila_salidas["cantidad"];?></td>
			</tr>
			<?php
				
			}
			
		?>
		<tfoot> 
			<tr class="text-center h3">
				<td ><b>TOTAL</b></td>
				<td ></td>
				<td ></td>
				<td><b><?php echo $total;?></b></td>
			</tr>
		</tfoot>
	</table>
</div>

<?php 
}
?>


