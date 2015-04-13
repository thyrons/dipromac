<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
$data = 0;
///////////////////contador clientes////////////////////////
$cont = 0;
$cont1 = 0;
$consulta = pg_query("select max(id_cliente) from clientes");
while ($row = pg_fetch_row($consulta)) {
    $cont = $row[0];
}
$cont++;
////////////////////////contador cliente sector////////////////////////////
$consulta1 = pg_query("select max(id_cli_sector) from cliente_sector");
while ($row1 = pg_fetch_row($consulta1)) {
    $cont1 = $row1[0];    
}
$cont1++;
if (pg_query("insert into clientes values('$cont','$_POST[tipo_docu]','$_POST[ruc_ci]','".strtoupper($_POST['nombres_cli'])."','$_POST[tipo_cli]','$_POST[direccion_cli]','$_POST[nro_telefono]','$_POST[nro_celular]','".strtoupper($_POST['pais_cli'])."','".strtoupper($_POST['ciudad_cli'])."','$_POST[email]','$_POST[cupo_credito]','$_POST[notas_cli]','Activo','1')")) {    
    $data = 1;
    pg_query("insert into cliente_sector values ('".$cont1."','".$cont."','".$_POST['id_sector']."')");

}

echo $data;
?>
