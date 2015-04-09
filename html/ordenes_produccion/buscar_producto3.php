<?php

session_start();
include '../../procesos/base.php';
conectarse();
$texto2 = $_GET['term'];
$consulta = pg_query("select distinct * from productos where codigo like '%$texto2%' and estado= 'Activo'");
while ($row = pg_fetch_row($consulta)) {
    $data[] = array(
        'value' => $row[1],
        'producto' => $row[3],
        'precio_v' => $row[9],
        'stock' => $row[13],
        'cod_producto' => $row[0]
    );
}

echo $data = json_encode($data);
?>
