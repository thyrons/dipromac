<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
//
/////datos detalle factura/////
$campo1 = $_POST['campo1'];
$campo2 = $_POST['campo2'];
$campo3 = $_POST['campo3'];
$campo4 = $_POST['campo4'];
$campo5 = $_POST['campo5'];

/////////////////contador transacciones///////////
$cont1 = 0;
$consulta = pg_query("select max(id_transacciones) from transacciones");
while ($row = pg_fetch_row($consulta)) {
    $cont1 = $row[0];
}
$cont1++;
//
////////////guardar proforma////////
pg_query("insert into transacciones values('$cont1','$_SESSION[id]','$_POST[comprobante]','$_POST[fecha_actual]','$_POST[hora_actual]','$_POST[transaccion]'
    ,'$_POST[num]','$_POST[abreviatura]','$_POST[cancepto]','$_POST[total_debe]','$_POST[total_haber]','$_POST[direrencia]','Activo')");
////////////////////////////////////////
//
////////////agregar detalle_proforma////////
$arreglo1 = explode('|', $campo1);
$arreglo2 = explode('|', $campo2);
$arreglo3 = explode('|', $campo3);
$arreglo4 = explode('|', $campo4);
$arreglo5 = explode('|', $campo5);
$nelem = count($arreglo1);

///////////////////////////////////////////

for ($i = 1; $i < $nelem; $i++) {
    /////////////////contador detalle factura compra/////////////
    $cont2 = 0;
    $consulta = pg_query("select max(id_detalle_transaccion) from detalle_transaccion");
    while ($row = pg_fetch_row($consulta)) {
        $cont2 = $row[0];
    }
    $cont2++;
    //////////////////////////  
    //
    ///guardar detalle_factura/////
    pg_query("insert into detalle_transaccion values('$cont2','$cont1','$arreglo1[$i]','$arreglo2[$i]','$arreglo3[$i]','$arreglo4[$i]','$arreglo5[$i]','Activo')");
    ////////////////////////////////
}
$data = 1;
echo $data;
?>
