<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$id = $_GET['com'];
$arr_data = array();

$consulta = pg_query("SELECT sum(total_venta::Float) as total from factura_venta ");
while ($row = pg_fetch_row($consulta)) {
    $arr_data[] = $row[0];
}
echo json_encode($arr_data);
?>
