<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);

/////datos detalle factura/////
$campo1 = $_POST['campo1'];
$campo2 = $_POST['campo2'];
$campo3 = $_POST['campo3'];
$campo4 = $_POST['campo4'];
$campo5 = $_POST['campo5'];
///////////////////////////////
//
/////////////////contador factura compra///////////
$cont1 = 0;
$consulta = pg_query("select max(id_factura_compra) from factura_compra");
while ($row = pg_fetch_row($consulta)) {
    $cont1 = $row[0];
}
$cont1++;
////////////guardar factura compra////////
pg_query("insert into factura_compra values('$cont1','1','$_POST[id_proveedor]','$_SESSION[id]','$_POST[comprobante]','$_POST[fecha_actual]','$_POST[hora_actual]','$_POST[fecha_registro]'
    ,'$_POST[fecha_emision]','$_POST[fecha_caducidad]','$_POST[tipo_comprobante]','$_POST[serie]','$_POST[autorizacion]','$_POST[cancelacion]','$_POST[formas]'
    ,'$_POST[tarifa0]','$_POST[tarifa12]','$_POST[iva]','$_POST[desc]','$_POST[tot]','Activo')");

////////////////////////////////////////
//
////////////agregar detalle_factura_compra////////
$arreglo1 = explode('|', $campo1);
$arreglo2 = explode('|', $campo2);
$arreglo3 = explode('|', $campo3);
$arreglo4 = explode('|', $campo4);
$arreglo5 = explode('|', $campo5);
$nelem = count($arreglo1);
$forma = $_POST['formas'];
///////////////////////////////////////////

if ($forma === "Credito") {

    ///////contador pagos compra//////
    $cont2 = 0;
    $consulta = pg_query("select max(id_pagos_compra) from pagos_compra");
    while ($row = pg_fetch_row($consulta)) {
        $cont2 = $row[0];
    }
    $cont2++;
    ////////////////////////////////
    //variables pagos////
    $total = $_POST['tot'];
    ///////////////
    //////////////guardar pagos compra//////////
    pg_query("insert into pagos_compra values('$cont2','$_POST[id_proveedor]','$cont1','$_SESSION[id]','$_POST[fecha_actual]','0','0','$_POST[tipo_comprobante]','$total','$total','Activo')");
    ///////////////////////////////////////////
    //
    ////////////////guardar detalle compra/////
    for ($i = 0; $i <= $nelem; $i++) {

        /////////////////contador detalle factura compra/////////////
        $cont4 = 0;
        $consulta = pg_query("select max(id_detalle_compra) from detalle_factura_compra");
        while ($row = pg_fetch_row($consulta)) {
            $cont4 = $row[0];
        }
        $cont4++;
        /////////////////////////////////////////////////////////
        ///guardar detalle_factura/////
        pg_query("insert into detalle_factura_compra values('$cont4','$cont1','$arreglo1[$i]','$arreglo2[$i]','$arreglo3[$i]','$arreglo4[$i]','$arreglo5[$i]','Activo')");
        ////////////////////////////////
        //
        //////////////modificar productos///////////
        $consulta2 = pg_query("select * from productos where cod_productos = '$arreglo1[$i]'");
        while ($row = pg_fetch_row($consulta2)) {
            $stock = $row[13];
        }
        $cal = $stock + $arreglo2[$i];

        pg_query("Update productos Set precio_compra='" . $arreglo3[$i] . "', stock='" . $cal . "' where cod_productos='" . $arreglo1[$i] . "'");
        ////////////////////////////////////////////////////////
        //
        ///////////////////contador kardex/////////////
        $cont5 = 0;
        $consulta3 = pg_query("select max(id_kardex) from kardex");
        while ($row = pg_fetch_row($consulta3)) {
            $cont5 = $row[0];
        }
        $cont5++;
        /////////////////////////////////////////////////////////
        //
        ///guardar kardex/////
        pg_query("insert into kardex values('$cont5',' $_POST[fecha_actual]', '" . 'Factura Compra:' . $_POST[serie] . "' ,'$arreglo2[$i]','$arreglo3[$i]','$arreglo5[$i]','$arreglo1[$i]','Activo','1')");
        /////////////////////////////
    }
} else {
    if ($forma === "Contado") {
        for ($i = 0; $i <= $nelem; $i++) {

            /////////////////contador detalle factura compra/////////////
            $cont6 = 0;
            $consulta = pg_query("select  max(id_detalle_compra) from detalle_factura_compra");
            while ($row = pg_fetch_row($consulta)) {
                $cont6 = $row[0];
            }
            $cont6++;
            /////////////////////////////////////////////////////////////
            //////////////guardar detalle_factura////////
            pg_query("insert into detalle_factura_compra values('$cont6','$cont1','$arreglo1[$i]','$arreglo2[$i]','$arreglo3[$i]','$arreglo4[$i]','$arreglo5[$i]','Activo')");
            ////////////////////////////////////////////
            //
            //////////////modificar productos///////////
            $consulta2 = pg_query("select * from productos where cod_productos = '$arreglo1[$i]'");
            while ($row = pg_fetch_row($consulta2)) {
                $stock = $row[13];
            }
            $cal = $stock + $arreglo2[$i];

            pg_query("Update productos Set precio_compra='" . $arreglo3[$i] . "', stock='" . $cal . "' where cod_productos='" . $arreglo1[$i] . "'");
            ///////////////////////////////////////////
            //
            ///////////////////contador kardex/////////////
            $cont7 = 0;
            $consulta3 = pg_query("select max(id_kardex) from kardex");
            while ($row = pg_fetch_row($consulta3)) {
                $cont7 = $row[0];
            }
            $cont7++;
            /////////////////////////////////////////////////////////
            //
            ///guardar kardex/////
            pg_query("insert into kardex values('$cont7','$_POST[fecha_actual]','" . 'Factura Compra:' . $_POST[serie] . "','$arreglo2[$i]','$arreglo3[$i]','$arreglo5[$i]','$arreglo1[$i]','Activo','1')");
            /////////////////////////////
        }
         /////////////////contador libro diario/////////////
         //for ($i = 0; $i <= 3; $i++) {
            $cont8 = 0;
            $consulta = pg_query("select  max(id_libro_diario) from libro_diario");
            while ($row = pg_fetch_row($consulta)) {
                $cont8 = $row[0];
            }
            $cont8++;
            //////////////////////////
            //
            ///guardar libro/////
            pg_query("insert into libro_diario values('$cont8','$_POST[fecha_actual]','Inventarios','$_POST[tarifa12]','0.00','Compra Mercaderia','Activo')");
            $cont8 = 0;
            $consulta = pg_query("select  max(id_libro_diario) from libro_diario");
            while ($row = pg_fetch_row($consulta)) {
                $cont8 = $row[0];
            }
            $cont8++;
            ////////////////////////// 
            pg_query("insert into libro_diario values('$cont8','$_POST[fecha_actual]','Iva Compras','$_POST[iva]','0.00','Compra Mercaderia','Activo')");
            $cont8 = 0;
            $consulta = pg_query("select  max(id_libro_diario) from libro_diario");
            while ($row = pg_fetch_row($consulta)) {
                $cont8 = $row[0];
            }
            $cont8++;
            ////////////////////////// 
            pg_query("insert into libro_diario values('$cont8','$_POST[fecha_actual]','Caja Chica','0.00','$_POST[tot]','Compra Mercaderia','Activo')");
            /////////////////////////////     
         

    }
}

$data = 1;
echo $data;
?>
