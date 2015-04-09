<?php

session_start();
include '../../procesos/base.php';
conectarse();
$texto = $_GET['term'];
$consulta = pg_query("select * from plan_cuentas where codigo_plan like '%$texto%' and estado='Activo'");
while ($row = pg_fetch_row($consulta)) {
    $data[] = array(
        'value' => $row[1],
        'id_plan_cuentas' => $row[0],
        'descripcion' => $row[2]
    );
}

echo $data = json_encode($data);
?>
