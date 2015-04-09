<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);

$fecha = date("d-m-Y");

/////////////////comparar codigos/////////////////////
    $contt = 0;
    $consulta = pg_query("select * from plan_cuentas where codigo_plan='$_POST[var]'");
    while ($row = pg_fetch_row($consulta)) {
        $contt++;
    }
/////////////////////////////////////////////////////

    if ($contt == 0) {
/////////////contador productos//////////
        $cont = 0;
        $consulta = pg_query("select max(id_plan_cuentas) from plan_cuentas");
        while ($row = pg_fetch_row($consulta)) {
            $cont = $row[0];
        }
        $cont++;
////////////////////////////////////////
        pg_query("insert into plan_cuentas values('$cont','$_POST[var]','$_POST[var1]','$_POST[var2]','$_POST[var3]')");
        $data = 1;
    } else {
        $data = 2;
    }

echo $data;
?>