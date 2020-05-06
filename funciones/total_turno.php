<?php

include("../login/login_success.php");
include("../conexi.php");
$link = Conectarse();

$consulta_efectivo = "SELECT COALESCE(efectivo_inicial,0) + COALESCE(total_efectivo,0) + COALESCE(total_ingresos,0) - COALESCE(total_egresos,0) AS total_turno FROM
(SELECT efectivo_inicial FROM turnos WHERE id_turnos = '{$_COOKIE["id_turnos"]}') AS efectivo_inicial,
(SELECT SUM(efectivo) AS total_efectivo FROM ventas WHERE estatus_ventas='PAGADO' AND id_turnos = '{$_COOKIE["id_turnos"]}') AS tabla_ventas,
(SELECT SUM(cantidad_ingresos) AS total_ingresos FROM ingresos WHERE estatus_ingresos='ACTIVO' AND id_turnos = '{$_COOKIE["id_turnos"]}') AS tabla_entradas,
(SELECT SUM(cantidad_egresos) AS total_egresos FROM egresos WHERE estatus_egresos='ACTIVO' AND id_turnos = '{$_COOKIE["id_turnos"]}') AS tabla_salidas
";

$result = mysqli_query($link, $consulta_efectivo);

while ($fila = mysqli_fetch_assoc($result)) {
	$fila_venta = $fila;
}

echo json_encode($fila_venta);

?>