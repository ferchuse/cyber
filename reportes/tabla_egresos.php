<?php 
	include('../conexi.php');
	$link = Conectarse();
	
	$fecha_inicial = $_GET['fecha_inicial'];
	$fecha_final = $_GET['fecha_final'];
	
	
	// Consulta Egresos
	$consulta = "SELECT 
	*,
	SUM(cantidad_egresos)  AS suma_egresos
	FROM egresos 
	LEFT JOIN catalogo_egresos
	USING(id_catalogo_egresos)
	
	WHERE fecha_egresos BETWEEN '$fecha_inicial' AND '$fecha_final' ";
	
	if($_GET["id_catalogo_egresos"] != ''){
		
		$consulta .= " AND id_catalogo_egresos = '{$_GET["id_catalogo_egresos"]}'";
	}
	
	$consulta .= " GROUP BY descripcion_egresos
	
	ORDER BY
	{$_GET["sort"]} {$_GET["order"]}"
	
	;
	$resultado = mysqli_query($link, $consulta);
	
	if(!$resultado){
		
		echo mysqli_error($link);
	}
	
	$total = 0;
	
?>
<pre hidden>
	<?php echo $consulta?>
</pre>

<?php 
	if(mysqli_num_rows($resultado) < 1){
	?>
	<br>
	<br>
	<div class="alert alert-warning text-center">
	  <strong>No hay egresos en estas fechas</strong> 
	</div>
	<?php		
	}
	else{
	?>
	
	<!-- "Egresos" -->
	
	<table class="table table-hover" id="egresos">
		<thead>
			<tr>		
				<th class="text-center"><a class="sort" href="#!" data-columna="tipo_egreso">Categoría</a> </th>
				<th class="text-center"><a class="sort" href="#!" data-columna="descripcion_egresos">Descripción</a> </th>
				<th class="text-center"><a class="sort" href="#!" data-columna="suma_egresos">Cantidad</a> </th>
			</tr>
		</thead>
		<tbody>
			<?php 
				while($fila = mysqli_fetch_assoc($resultado)){
					
					$total+= $fila["suma_egresos"];
				?>
				<tr class="">
					
					<td class=""><?php echo $fila["tipo_egreso"];?></td>
					<td class=""><?php echo $fila["descripcion_egresos"];?></td>
					<td class=""><?php echo number_format($fila["suma_egresos"], 2);?></td>
					
				</tr>
				
				<?php
					
				}
			?>
		</tbody>
		<tfoot>
			<tr class="<?php echo $color;?>">
				<td colspan="2" class="text-right text-danger">
					<big><b>TOTAL:</b></big>
				</td>
				<td class=""><?php echo "$". number_format($total,2);?></td>
			</tr>
			
			<?php 
			}
		?>
	</tfoot>
</table>
