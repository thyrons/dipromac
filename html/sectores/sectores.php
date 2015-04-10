<?php

session_start();
include '../../procesos/base.php';
conectarse();
$cont = 0;
$repe = 0;

    //////////////////validar repetidos//////////////////
    $consulta = pg_query("select * from sectores where nombre_sector='" . strtoupper($_POST['nombre_sector']) . "'");
    while ($row = pg_fetch_row($consulta)) {
        $repe++;        
    }
    ///////////////////////////////////////////////////    

if ($_POST['oper'] == "add") {
    $consulta = pg_query("select max(id_sectores) from sectores");
    while ($row = pg_fetch_row($consulta)) {
        $cont = $row[0];
    }
    $cont++;

    if ($repe == 0) {
        pg_query("insert into sectores values('$cont','" . strtoupper($_POST['nombre_sector']) . "','".strtoupper($_POST['direccion_sector'])."')");
    }
} else {
    if ($_POST['oper'] == "edit") {
        if ($repe >= 0) {            
            pg_query("update sectores set id_sectores='$_POST[id_sectores]', nombre_sector='" . strtoupper($_POST['nombre_sector']) . "',direccion_sector= '".strtoupper($_POST['direccion_sector'])."' where id_sectores='$_POST[id_sectores]'");
        }
    }
}
?>
