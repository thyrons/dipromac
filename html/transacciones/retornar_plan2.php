<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$id = $_GET['com'];
$arr_data = array();

$consulta = pg_query("select P.id_plan_cuentas, P.codigo_plan, P.descripcion, D.tipo_referencia, D.num_referencia, D.debito, D.credito  from transacciones T, detalle_transaccion D, plan_cuentas P where T.id_transacciones = D.id_transacciones and D.id_plan_cuentas = P.id_plan_cuentas and  T.comprobante='" . $id . "'");
while ($row = pg_fetch_row($consulta)) {
    $arr_data[] = $row[0];
    $arr_data[] = $row[1];
    $arr_data[] = $row[2];
    $arr_data[] = $row[3];
    $arr_data[] = $row[4];
    $arr_data[] = $row[5];
    $arr_data[] = $row[6];
}
echo json_encode($arr_data);
?>
