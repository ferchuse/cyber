<?php 
	include('../conexi.php');
	$link = Conectarse();
?>
<table  class="table table-hover">
	<thead>
		<tr>
			<th class="text-center">Nombre Completo</th>
			<th class="text-center">Usuario</th>
			<th class="text-center">Acciones</th>
		</tr> 
	</thead>
	<tbody>
		<?php 
			$consulta = "SELECT * FROM  usuarios";
			$resultado = mysqli_query($link,$consulta);
			while($row = mysqli_fetch_assoc($resultado)){
				extract($row);
		?>
			<tr>
				<td class="text-center"><?php echo $nombre_completo_usuarios;?></td>
				<td class="text-center"><?php echo $nombre_usuarios;?></td>
				<td class="text-center">
					<button class="btn btn-warning btn_editar" type="button" title="Editar" data-id_registro="<?php echo $id_usuarios;?>"><i class="fa fa-edit"></i></button>
					<button class="btn btn-danger btn_eliminar" type="button" title="Eliminar" data-id_registro="<?php echo $id_usuarios;?>"><i class="fa fa-trash"></i>
					</button>
				</td>
			</tr>
		<?php	
			}
		?>
	</tbody>
	
</table>