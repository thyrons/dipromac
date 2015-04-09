<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);

/////////////////modificar clientes////////////////////
pg_query("Update plan_cuentas Set codigo_plan='$_POST[codigo_cuenta]', descripcion='$_POST[descripcion]', tipo_cuenta='$_POST[tipo]', cuenta='$_POST[cuenta]' where id_plan_cuentas='$_POST[id_plan_cuentas]'");
//////////////////////////////////////////////////////

$data = 1;
echo $data;
?>
