<?php

include("conexi.php");
$link = Conectarse();

$consulta = "SELECT * FROM
(SELECT SUM(total_ventas) AS ventas_totales, SUM(efectivo_ventas) AS ventas_efectivo FROM ventas WHERE estatus_ventas='PAGADO' AND id_turnos = {$_COOKIE["turno"]} ) AS tabla_ventas,
(SELECT SUM(cantidad_ingresos) AS entradas FROM ingresos WHERE estatus_ingresos='ACTIVO') AS tabla_entradas,
(SELECT SUM(cantidad_egresos) AS salidas FROM egresos WHERE estatus_egresos='ACTIVO') AS tabla_salidas,
(SELECT SUM(efectivo_ventas) AS devoluciones_efectivo FROM ventas WHERE estatus_ventas='CANCELADO') AS tabla_devoluciones_efectivo,
(SELECT SUM(tarjeta_ventas) AS ventas_tarjeta, SUM(comision) AS comisiones FROM ventas WHERE estatus_ventas='PAGADO') AS tabla_tarjeta,
(SELECT SUM(total_ventas) AS devoluciones FROM ventas WHERE estatus_ventas='CANCELADO') AS tabla_devoluciones";

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
    <title>Corte</title>

    <!-- Bootstrap, Font Awesome & CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    <link href="css/all.min.css" rel="stylesheet">
    <link href="css/corte.css" rel="stylesheet">
</head>

<body>
	<pre>
	<?php# echo $consulta;?>
	</pre>
    <!-- "Contenedor Corte de Caja" -->
    <div class="container mt-3 mb-4">
        <!-- "Sección" -->
        <div class="seccion row">
            <div class="col text-center">Corte de Caja</div>
        </div>
        
        <!-- Primera Línea -->
        <hr class="linea-solid">

        <!-- Botones: "Corte de Cajero" & "Corte del Día" -->
        <div class="botones row no-gutters justify-content-end mt-3">
            <div class="col-3">
                <button class="btn btn-outline-success float-right">
                    <i class="fas fa-cut mr-2"></i><span>Hacer Corte de <strong>Cajero</strong></span>
                </button>
            </div>
            <div class="col-3">
                <button class="btn btn-outline-success float-right">
                    <i class="fas fa-cut mr-2"></i><span>Hacer Corte del <strong>Día</strong></span>
                </button>
            </div>
        </div>
        
        <!-- Filtros & Botón "Imprimir" -->
        <div class="filtros row mt-4">
            <div class="col-3 form-inline">
                <div class="row form-group no-gutters">
                    <label for="fecha" class="col-5 font-weight-bold">Corte De:</label>
                    <input class="col-7 form-control text-center" id="fecha" value="08/08/2019">
                </div>
            </div>
            <div class="col-3 form-inline">
                <div class="row form-group no-gutters">
                    <label for="inicio" class="col-5 font-weight-bold">Desde Las:</label>
                    <input class="col-7 form-control text-center" id="inicio" value="12:00:00">
                </div>
            </div>
            <div class="col-3 form-inline">
                <div class="row form-group no-gutters">
                    <label for="fin" class="col-5 font-weight-bold">Hasta Las:</label>
                    <input class="col-7 form-control text-center" id="fin" value="15:40:50">
                </div>
            </div>
            <div class="col-3">
                <button class="btn btn-primary float-right">
                    <i class="fas fa-print mr-2"></i><span>Imprimir</span>
                </button>
            </div>
        </div>
        
        <!-- Segunda Línea -->
        <hr class="linea-dashed" >

        <!-- "Datos" -->
        <div class="datos row">
            <div class="col-12">
                <!-- "Ventas Totales" & "Ganancia" -->
                <div class="row mt-4">
                    <div class="col-6">
                        <div class="row no-gutters">
                            <div class="encabezado col-7">
                                <i class="fas fa-dollar-sign mr-2"></i><span>Ventas Totales</span>
                            </div>
                            <div class="text-primary col-1 text-center">$</div>
                            <div class="cantidad text-primary col-4 text-left"><?php echo $fila_productos[0]["ventas_totales"] ?></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row no-gutters">
                            <div class="encabezado col-7">
                                <i class="fas fa-chart-line mr-2"></i><span>Ganancia</span>
                            </div>
                            <div class="text-primary col-1 text-center">$</div>
                            <div class="cantidad text-primary col-4 text-left">2,000,000,000.00</div>
                        </div>
                    </div>
                </div>

                <!-- "Dinero en Caja" & "Ventas" -->
                <div class="row mt-4">
                    <!-- "Dinero en Caja" -->
                    <div class="col-6">
                        <div class="row">
                            <div class="encabezado col-12">
                                <i class="fas fa-cash-register mr-2"></i><span>Dinero en Caja</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row no-gutters">
                                <div class="col-7">Fondo de Caja</div>
                                <div class="col-1 text-left"></div>
                                <div class="col-1 text-center">$</div>
                                <div class="cantidad col-3 text-left">1000</div>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-7">Ventas en Efectivo</div>
                                <div class="text-success col-1 text-center">+</div>
                                <div class="text-success col-1 text-center">$</div>
                                <div class="cantidad text-success col-3 text-left">
                                    <?php echo $fila_productos[0]["ventas_efectivo"] ?>
                                </div>
                            </div>
                            <div hidden class="row no-gutters">
                                <div class="col-7">Abonos en Efectivo</div>
                                <div class="text-success col-1 text-center">+</div>
                                <div class="text-success col-1 text-center">$</div>
                                <div class="cantidad text-success col-3 text-left">400</div>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-7">Entradas</div>
                                <div class="text-success col-1 text-center">+</div>
                                <div class="text-success col-1 text-center">$</div>
                                <div class="cantidad text-success col-3 text-left"><?php echo $fila_productos[0]["entradas"] ?></div>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-7">Salidas</div>
                                <div class="text-danger col-1 text-center">-</div>
                                <div class="text-danger col-1 text-center">$</div>
                                <div class="cantidad text-danger col-3 text-left"><?php echo $fila_productos[0]["salidas"] ?></div>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-7">Devoluciones en Efectivo</div>
                                <div class="text-danger col-1 text-center">-</div>
                                <div class="text-danger col-1 text-center">$</div>
                                <div class="cantidad text-danger col-3 text-left">
                                    <?php echo $fila_productos[0]["devoluciones_efectivo"] ?>
                                </div>
                            </div>
                            <div class="balance row no-gutters mt-1">
                                <div class="col-7"></div>
                                <div class="col-1 text-center"></div>
                                <div class="col-1 text-center border-top border-secondary">$</div>
                                <div class="cantidad col-3 text-left border-top border-secondary">
                                    <?php echo $fondo_caja + $fila_productos[0]["ventas_efectivo"] + $fila_productos[0]["entradas"] - $fila_productos[0]["salidas"] - $fila_productos[0]["devoluciones_efectivo"] ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- "Ventas" -->
                    <div class="col-6">
                        <div class="row">
                            <div class="encabezado col-12">
                                <i class="fas fa-shopping-basket mr-2"></i><span>Ventas</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row no-gutters">
                                <div class="col-7">En Efectivo</div>
                                <div class="text-success col-1 text-center">+</div>
                                <div class="text-success col-1 text-center">$</div>
                                <div class="cantidad text-success col-3 text-left">
                                    <?php echo $fila_productos[0]["ventas_efectivo"] ?>
                                </div>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-7">Con Tarjeta de Crédito</div>
                                <div class="text-success col-1 text-center">+</div>
                                <div class="text-success col-1 text-center">$</div>
                                <div class="cantidad text-success col-3 text-left">
                                    <?php echo $fila_productos[0]["ventas_tarjeta"] ?>
                                </div>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-7">Comisiones</div>
                                <div class="text-success col-1 text-center">+</div>
                                <div class="text-success col-1 text-center">$</div>
                                <div class="cantidad text-success col-3 text-left">
                                    <?php echo $fila_productos[0]["comisiones"] ?>
                                </div>
                            </div>
                            <div hidden class="row no-gutters">
                                <div class="col-7">A Crédito</div>
                                <div class="text-success col-1 text-center">+</div>
                                <div class="text-success col-1 text-center">$</div>
                                <div class="cantidad text-success col-3 text-left"></div>
                            </div>
                            <div hidden class="row no-gutters">
                                <div class="col-7">Con Vales de Despensa</div>
                                <div class="text-success col-1 text-center">+</div>
                                <div class="text-success col-1 text-center">$</div>
                                <div class="cantidad text-success col-3 text-left">2,000,000.00</div>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-7">Devoluciones de Ventas</div>
                                <div class="text-danger col-1 text-center">-</div>
                                <div class="text-danger col-1 text-center">$</div>
                                <div class="cantidad text-danger col-3 text-left">
                                    <?php echo $fila_productos[0]["devoluciones"] ?>
                                </div>
                            </div>
                            <div class="balance row no-gutters mt-1">
                                <div class="col-7"></div>
                                <div class="col-1 text-center"></div>
                                <div class="col-1 text-center border-top border-secondary">$</div>
                                <div class="cantidad col-3 text-left border-top border-secondary">
                                <?php echo $fila_productos[0]["ventas_efectivo"] + $fila_productos[0]["ventas_tarjeta"] + $fila_productos[0]["comisiones"] - $fila_productos[0]["devoluciones"] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- "Entradas de Efectivo" & "Ingresos de Contado" -->
                <div class="row mt-4">
                    <div class="col-6">
                        <div class="row">
                            <div class="encabezado col-12">
                                <i class="fas fa-arrow-down mr-2"></i><span>Entradas de Efectivo</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mensaje row">
                                <div class="col-8">No Hubo Entradas en Efectivo</div>
                                <div class="col-4 text-left"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="encabezado col-12">
                                <i class="fas fa-money-bill-wave mr-2"></i><span>Ingresos de Contado</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mensaje row">
                                <div class="col-8">No Hubo Ingresos de Contado</div>
                                <div class="col-4 text-left"></div>
                            </div>
                            <div class="total row no-gutters mt-1">
                                <div class="col-7"></div>
                                <div class="col-1 text-center"></div>
                                <div class="col-1 text-center border-top border-secondary">$</div>
                                <div class="cantidad col-3 text-left border-top border-secondary">0.00</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- "Ventas por Departamento" & "Salidas de Efectivo" -->
                <div class="row mt-4">
                    <div class="col-6">
                        <div class="row">
                            <div class="encabezado col-12">
                                <i class="fas fa-store mr-2"></i><span>Ventas por Departamento</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mensaje row">
                                <div class="col-8">No se Registró Ninguna Venta</div>
                                <div class="col-4 text-left"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="encabezado col-12">
                                <i class="fas fa-arrow-up mr-2"></i><span>Salidas de Efectivo</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mensaje row">
                                <div class="col-8">No Hubo Salidas en Efectivo</div>
                                <div class="col-4 text-left"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- "Impuestos" & "Pagos de Crédito" -->
                <div hidden class="row mt-4">
                    <div class="col-6">
                        <div class="row">
                            <div class="encabezado col-12">
                                <i class="fas fa-percent mr-2"></i><span>Impuestos</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="mensaje col-8">No Hubo Ventas</div>
                                <div class="col-4 text-left"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="encabezado col-12">
                                <i class="fas fa-credit-card mr-2"></i><span>Pagos de Crédito</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="mensaje col-8">No se Recibieron Pagos de Créditos</div>
                                <div class="col-4 text-left"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Última Línea -->
        <hr class="linea-dashed" >
    </div>
</body>

</html>