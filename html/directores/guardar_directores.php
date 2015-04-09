<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);

///////////////////contador clientes////////////////////////
$cont = 0;
$consulta = pg_query("select max(id_director) from directores");
while ($row = pg_fetch_row($consulta)) {
    $cont = $row[0];
}
$cont++;
/////////////////////////////////////////////////////////

/////////////////contador usuarios////////////////////////
$cont2 = 0;
$consulta2 = pg_query("select max(id_usuario) from usuario");
    while ($row = pg_fetch_row($consulta2)) {
        $cont2 = $row[0];
    }
    $cont2++;
/////////////////////////////////////////////////////////    

if (pg_query("insert into directores values('$cont','$_POST[ruc_ci]','" . strtoupper($_POST[nombres_cli]) . "','$_POST[direccion_cli]','$_POST[nro_telefono]','$_POST[nro_celular]','" . strtoupper($_POST[pais_cli]) . "','" . strtoupper($_POST[ciudad_cli]) . "','$_POST[email]','Activo')")) {
    
    ///////////guardar usuarios///////////
    pg_query("insert into usuario values('$cont2','$_POST[nombres_cli]','','$_POST[ruc_ci]','$_POST[nro_telefono]','$_POST[nro_celular]','Vendedor','$_POST[clave2]','$_POST[email]','$_POST[direccion_cli]','$_POST[ruc_ci]','Activo')");
    //////////
    $data = 1;
}

echo $data;
?>
