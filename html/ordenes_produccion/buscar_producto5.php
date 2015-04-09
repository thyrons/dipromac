<?php

session_start();
include '../../procesos/base.php';
conectarse();
$texto2 = $_GET['term'];
$consulta = pg_query("select * from productos where codigo like '%$texto2%' and estado= 'Activo'");
while ($row = pg_fetch_row($consulta)) {
    $data[] = array(
        'value' => $row[1],
        'cod_producto2' => $row[0],
        'producto2' => $row[3],
        'precio2' => $row[6],
        'disponibles' => $row[13]
    );
}

echo $data = json_encode($data);
?>
