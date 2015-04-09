<?php

session_start();
include '../../procesos/base.php';
conectarse();
$texto2 = $_GET['term'];

$consulta = pg_query("select * from productos where codigo like '%$texto2%' and estado= 'Activo'");
while ($row = pg_fetch_row($consulta)) {
    $data[] = array(
        'value' => $row[1],
        'producto' => $row[3],
        'precio' => $row[6],
        'p_venta' => $row[9],
        'iva_producto' => $row[4],
        'cod_producto' => $row[0]
    );
}

//$consulta2 = pg_query("select * from productos where cod_barras like '%$texto2%' and estado= 'Activo'");
//while ($row = pg_fetch_row($consulta2)) {
//    $data[] = array(
//        'value' => $row[2],
//        'producto' => $row[3],
//        'precio' => $row[6],
//        'p_venta' => $row[9],
//        'iva_producto' => $row[4],
//        'cod_producto' => $row[0]
//    );
//}

echo $data = json_encode($data);
?>
