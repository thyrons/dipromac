<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$data = 0;
$cont = 0;

$consulta = pg_query("select * from clientes C, directores D  where C.id_director = D.id_director and D.id_director = '$_POST[id_director]'");
while ($row = pg_fetch_row($consulta)) {
    $cont++;
}

if ($cont == 0) {
    pg_query("Update directores Set estado='Pasivo' where id_director='$_POST[id_director]'");
    $data = 0;
} else {
    $data = 1;
}

echo $data;
?>