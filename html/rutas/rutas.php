<?php

session_start();
include '../../procesos/base.php';
conectarse();
$cont = 0;
$repe = 0;

    //////////////////validar repetidos//////////////////
    $consulta = pg_query("select * from rutas where nombre_ruta='" . strtoupper($_POST['nombre_ruta']) . "'");
    while ($row = pg_fetch_row($consulta)) {
        $repe++;        
    }
    ///////////////////////////////////////////////////    

if ($_POST['oper'] == "add") {
    $consulta = pg_query("select max(id_ruta) from rutas");
    while ($row = pg_fetch_row($consulta)) {
        $cont = $row[0];
    }
    $cont++;

    if ($repe == 0) {
        pg_query("insert into rutas values('$cont','" . strtoupper($_POST['nombre_ruta']) . "','".$_POST['nombre_sector']."')");
    }
} else {
    if ($_POST['oper'] == "edit") {
        if ($repe >=0) {            
            pg_query("update rutas set id_ruta='$_POST[id_ruta]', nombre_ruta='" . strtoupper($_POST['nombre_ruta']) . "',id_sector= '".$_POST['nombre_sector']."' where id_ruta='$_POST[id_ruta]'");
        }
    }
}
?>
