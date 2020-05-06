<?php
	
	include("funciones/dame_permiso.php");
	
?>

<nav class="menu navbar navbar-default ">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Cambiar Navegación</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">
				<img src="img/logo_menu.png" class="logo">
			</a>
		</div>
		
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<?php if(dame_permiso("index.php", $link) != "Sin Acceso"){	?> 
					<li class="<?php echo $menu_activo == "principal" ? "active" : ''; ?>">
						<a href="index.php">
							<i class="fas fa-dollar-sign"></i> Ventas
						</a>
					</li>					
					<?php 
					}
				?> 
				
				<?php if(dame_permiso("compras/compras_lista.php", $link) != "Sin Acceso"){	?> 
					<li class=" <?php echo $menu_activo == "compras" ? "active" : ''; ?>">
						<a href="compras/compras_lista.php">
							<i class="fas fa-shopping-cart"></i> Compras
						</a>
					</li>
					<?php 
					}
				?> 
				
				
				<li class="dropdown <?php echo $menu_activo == "reportes" ? "active" : ''; ?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fas fa-chart-bar"></i> Reportes <strong class="caret"></strong>
					</a>
					<ul class="dropdown-menu">
						<?php if(dame_permiso("reportes/index.php", $link) != "Sin Acceso"){	?>
							<li>
								<a href="reportes/index.php">Ventas Por Día</a>
							</li>
							<?php 
							}
						?> 
						<?php if(dame_permiso("reportes/egresos.php", $link) != "Sin Acceso"){	?>
							<li>
								<a href="reportes/egresos.php">Egresos</a>
							</li>
							<?php 
							}
						?> 
						<?php if(dame_permiso("inventarios/movimientos.php", $link) != "Sin Acceso"){	?>
							<li>
								<a href="inventarios/movimientos.php"> Movimientos</a>
							</li>
							<?php 
							}
						?> 
					</ul>
				</li>
				
				<li class="dropdown <?php echo $menu_activo == "productos" ? "active" : ''; ?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fas fa-list"></i> Productos <strong class="caret"></strong>
					</a>
					<ul class="dropdown-menu">
						<?php if(dame_permiso("productos/editar.php?accion=nuevo", $link) != "Sin Acceso"){	?>
							<li>
								<a href="productos/editar.php?accion=nuevo">
								<i class="fas fa-plus"></i> Nuevo</a>
							</li>
							<?php 
							}
						?> 
						<?php if(dame_permiso("productos/editar.php?accion=editar", $link) != "Sin Acceso"){	?>
							<li>
								<a href="productos/editar.php?accion=editar">
								<i class="fas fa-edit"></i> Editar</a>
							</li>
							<?php 
							}
						?> 
						<?php if(dame_permiso("productos/catalogo.php", $link) != "Sin Acceso"){	?>
							<li>
								<a href="productos/catalogo.php">
								<i class="fas fa-file-alt"></i> Catálogo</a>
							</li>
							<?php 
							}
						?> 
					</ul>
				</li>
				<li class="dropdown <?php echo $menu_activo == "catalogos" ? "active" : ''; ?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fas fa-file-alt"></i> Catálogos <strong class="caret"></strong>
					</a>
					<ul class="dropdown-menu">
						<?php if(dame_permiso("departamentos.php", $link) != "Sin Acceso"){	?>
							<li>
								<a href="departamentos.php"><i class="fas fa-file-alt"></i> Departamentos</a>
							</li>
							<?php 
							}
						?> 
						<?php
						if(dame_permiso("proveedores.php", $link) != "Sin Acceso"){	?>
							<li>
								<a href="proveedores.php"><i class="fas fa-file-alt"></i> Proveedores</a>
							</li>
							<?php 
							}
						?> 
						<?php if(dame_permiso("egresos.php", $link) != "Sin Acceso"){	?>
							<li>
								<a href="egresos.php"><i class="fas fa-file-alt"></i> Egresos</a>
							</li>
							<?php 
							}
						?> 
					</ul>
				</li>
				
				<?php if(dame_permiso("corte/resumen.php", $link) != "Sin Acceso"){	?>
					<li class="<?php echo $menu_activo == "resumen" ? "active" : ''; ?>">
						<a href="corte/resumen.php">
							<i class="fas fa-cash-register"></i> Corte de Caja
						</a>
					</li>
					<?php
					}
				?>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				
				<li class="dropdown <?php echo $menu_activo == "control" ? "active" : '';?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fas fa-cog"></i> Configuración <strong class="caret"></strong>
					</a>
					<ul class="dropdown-menu">
						
						<?php if(dame_permiso("usuarios/index.php", $link) != "Sin Acceso"){	?>
							<li>
								<a href="usuarios/index.php"><i class="fa fa-user-plus "></i> Usuarios</a>
							</li>
							<?php
							}
						?>
					</ul>
				</li>
				
				
				
				<li >
					<a href="#">
						<i class="fas fa-clock"></i> Turno <?php echo $_COOKIE["id_turnos"];?>
					</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-user"></i>
						<span id="menu_nombre_usuario">
							<?php echo isset($_COOKIE["nombre_usuarios"]) ? $_COOKIE["nombre_usuarios"] : "" ?>
						</span>
						<strong class="caret"></strong>
						<input type="hidden" id="id_usuarios" value="<?php echo isset($_COOKIE["id_usuarios"]) ? $_COOKIE["id_usuarios"] : ""; ?>">
						
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="login/logout.php"><i class="fas fa-sign-out-alt"></i> Salir</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
