<?php

session_start();
include '../../procesos/base.php';
conectarse();

$consulta = pg_query("select P.articulo, K.detalle, K.cantidad, K.valor_unitario, K.total, K.transaccion, K.estado from productos P, kardex K where P.cod_productos = K.cod_productos and K.cod_productos='$_POST[id]' and K.fecha_kardex BETWEEN '$_POST[fecha1]' and '$_POST[fecha2]'");
while ($row = pg_fetch_row($consulta)) {
    $lista[] = $row[0];
    $lista[] = $row[1];
    $lista[] = $row[2];
    $lista[] = $row[3];
    $lista[] = $row[4];
    $lista[] = $row[5];
    $lista[] = $row[6];
}
echo $lista = json_encode($lista);
?>
