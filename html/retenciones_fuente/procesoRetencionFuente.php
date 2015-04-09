<?php
session_start();
include '../../procesos/base.php';
conectarse();
$cont = 0;
$repe = 0;

//////////////////validar repetidos//////////////////
$consulta = pg_query("select * from retencion_fuentes where descripcion = '$_POST[descripcion]' ");
while ($row = pg_fetch_row($consulta)) {
   $repe++;
}
//////////////////////////////////////////////////    

if ($_POST['oper'] == "add") {
    $consulta = pg_query("select max(id_retencion_fuentes) from retencion_fuentes");
    while ($row = pg_fetch_row($consulta)) {
        $cont = $row[0];
    }
    $cont++;

    if ($repe == 0) {
        pg_query("insert into retencion_fuentes values('$cont','" . strtoupper($_POST['abreviatura']) . "','$_POST[descripcion]','$_POST[valor]','$_POST[valor_base]','Activo')");
    }
} else {
    if ($_POST['oper'] == "edit") {
        pg_query("update retencion_fuentes set abreviatura='" . strtoupper($_POST['abreviatura']) . "', descripcion='$_POST[descripcion]', valor = '$_POST[valor]', valor_base = '$_POST[valor_base]', Estado = 'Activo' where id_retencion_fuentes='$_POST[id_retencion_fuentes]'");
        
    }
}
?>
