<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
//
/////datos detalle asignacion/////
$campo1 = $_POST['campo1'];

/////////////////contador asignacion///////////
$cont1 = 0;
$consulta = pg_query("select max(id_asignacion) from asignacion");
while ($row = pg_fetch_row($consulta)) {
    $cont1 = $row[0];
}
$cont1++;
//
////////////guardar asignacion////////
pg_query("insert into asignacion values('$cont1','$_POST[tabla]'
    ,'','Activo')");
////////////////////////////////////////
//
////////////agregar detalle_proforma////////
$arreglo1 = explode(',', $campo1);
$nelem = count($arreglo1);

///////////////////////////////////////////

for ($i = 0; $i <= $nelem; $i++) {
    /////////////////contador detalle asignacion/////////////
    $cont2 = 0;
    $consulta = pg_query("select max(id_detalle_asignacion) from detalle_asignacion");
    while ($row = pg_fetch_row($consulta)) {
        $cont2 = $row[0];
    }
    $cont2++;
    //////////////////////////  
    //
    ///guardar detalle asignacion/////
    pg_query("insert into detalle_asignacion values('$cont2','$cont1','$arreglo1[$i]','Activo')");
    ////////////////////////////////
}
$data = 1;
echo $data;
?>
