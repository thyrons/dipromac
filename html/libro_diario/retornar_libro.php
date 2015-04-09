<?php

session_start();
include '../../procesos/base.php';
conectarse();

$consulta = pg_query("select * from libro_diario ");
while ($row = pg_fetch_row($consulta)) {
    $lista[] = $row[1];
    $lista[] = $row[2];
    $lista[] = $row[3];
    $lista[] = $row[4];
    $lista[] = $row[5];
}
echo $lista = json_encode($lista);
?>
