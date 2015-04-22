<?php

session_start();
include '../../procesos/base.php';
conectarse();
error_reporting(0);
////
/////datos detalle factura/////
$campo1 = $_POST['campo1'];
$campo2 = $_POST['campo2'];
$campo3 = $_POST['campo3'];
$campo4 = $_POST['campo4'];
$campo5 = $_POST['campo5'];
$campo6 = $_POST['campo6'];
/////////////////////////////
//
/////////////////contador factura venta///////////
$cont1 = 0;
$consulta = pg_query("select max(id_factura_venta) from factura_venta");
while ($row = pg_fetch_row($consulta)) {
    $cont1 = $row[0];
}
$cont1++;
//////////////////////////////////////////////////
//
//////////////contador clientes///////////////////
$contt = 0;
$consulta_cli = pg_query("select max(id_cliente) from clientes");
while ($row = pg_fetch_row($consulta_cli)) {
    $contt = $row[0];
}
$contt++;
//////////////////////////////////////////////////
//
/////////////////////contador cliente sector//////
$contsec = 0;
$consulta_sec = pg_query("select max(id_cli_sector) from cliente_sector");
while ($row1 = pg_fetch_row($consulta_sec)) {
    $contsec = $row1[0];    
}
$contsec++;
//////////////////////////////////////////////////

if ($_POST['id_cliente'] === "") {

    $tipo = $_POST['ruc_ci'];
    if (strlen($tipo) == 10) {
        //////////////////guardar clientes/////////////    
        pg_query("insert into clientes values('$contt','Cedula','$_POST[ruc_ci]','" . strtoupper($_POST['nombre_cliente']) . "','N','$_POST[direccion_cliente]','$_POST[telefono_cliente]','','','','$_POST[correo]','','','Activo','1')");
        pg_query("insert into cliente_sector values ('".$contsec."','".$contt."','1')");
        ////////////////////////////////////////////
        //
        ////////////guardar factura venta////////
        pg_query("insert into factura_venta values('$cont1','1','$contt','$_SESSION[id]','$_POST[comprobante]','$_POST[num_factura]','$_POST[fecha_actual]','$_POST[hora_actual]','$_POST[cancelacion]','$_POST[tipo_precio]','$_POST[formas]','$_POST[autorizacion]','$_POST[fecha_auto]','$_POST[fecha_caducidad]','$_POST[tarifa0]','$_POST[tarifa12]','$_POST[iva]','$_POST[desc]','$_POST[tot]','Activo','')");
        pg_query("insert into cliente_sector values ('".$contsec."','".$contt."','1')");
        ////////////////////////////////////////
    } else {
        if (strlen($tipo) == 13) {
            //////////////////guardar clientes/////////////    
            pg_query("insert into clientes values('$contt','Ruc','$_POST[ruc_ci]','" . strtoupper($_POST['nombre_cliente']) . "','N','$_POST[direccion_cliente]','$_POST[telefono_cliente]','','','','$_POST[correo]','','','Activo','1')");
            ////////////////////////////////////////////
            //
            ////////////guardar factura venta////////
            pg_query("insert into factura_venta values('$cont1','1','$contt','$_SESSION[id]','$_POST[comprobante]','$_POST[num_factura]','$_POST[fecha_actual]','$_POST[hora_actual]','$_POST[cancelacion]','$_POST[tipo_precio]','$_POST[formas]','$_POST[autorizacion]','$_POST[fecha_auto]','$_POST[fecha_caducidad]','$_POST[tarifa0]','$_POST[tarifa12]','$_POST[iva]','$_POST[desc]','$_POST[tot]','Activo','')");
            ////////////////////////////////////////    
        }
    }
} else {
    ////////////guardar factura compra////////
    pg_query("insert into factura_venta values('$cont1','1','$_POST[id_cliente]','$_SESSION[id]','$_POST[comprobante]','$_POST[num_factura]','$_POST[fecha_actual]','$_POST[hora_actual]','$_POST[cancelacion]','$_POST[tipo_precio]','$_POST[formas]','$_POST[autorizacion]','$_POST[fecha_auto]','$_POST[fecha_caducidad]','$_POST[tarifa0]','$_POST[tarifa12]','$_POST[iva]','$_POST[desc]','$_POST[tot]','Activo','')");
    ////////////////////////////////////////
}

/////////////////modificar proformas///////////
if ($_POST['proforma'] != "") {
    pg_query("Update proforma Set estado='Pasivo' where id_proforma='" . $_POST['proforma'] . "'");
}
///////////////////////////////////////////////
//    
////////////agregar detalle_factura_venta////////
$arreglo1 = explode('|', $campo1);
$arreglo2 = explode('|', $campo2);
$arreglo3 = explode('|', $campo3);
$arreglo4 = explode('|', $campo4);
$arreglo5 = explode('|', $campo5);
$arreglo6 = explode('|', $campo6);
$nelem = count($arreglo1);
$forma = $_POST['formas'];
///////////////////////////////////////////

if ($forma === "Credito") {
    //variables pagos////
    $adelanto = $_POST['adelanto'];
    $meses = $_POST['meses'];
    $total = $_POST['tot'];
    ///////////////
    //
    ///////contador pagos venta//////
    $cont2 = 0;
    $consulta = pg_query("select max(id_pagos_venta) from pagos_venta");
    while ($row = pg_fetch_row($consulta)) {
        $cont2 = $row[0];
    }
    $cont2++;
    /////////////////////////////////
    //
    //////////////guardar pagos venta//////////
    if ($adelanto === "") {
        $monto = $total;
        $format = number_format($monto, 2, '.', '');
        $adelanto = 0.00;
    } else {
        $monto = $total - $adelanto;
        $format = number_format($monto, 2, '.', '');
    }
    ////////////////////////////////////////////////////

    pg_query("insert into pagos_venta values('$cont2','$_POST[id_cliente]','$cont1','$_SESSION[id]','$_POST[fecha_actual]','$adelanto','$meses','Factura','$format','$format','Activo')");
    /////////////////////////////////////////////////////////
    //
    ////////////////Guardar meses///////////////////////////
    if ($meses > 1) {
        for ($i = 1; $i <= $meses - 1; $i++) {
            /////////////contador detalle pagos compra/////
            $cont3 = 0;
            $consulta8 = pg_query("select max(id_detalle_pagos_venta) from detalle_pagos_venta");
            while ($row = pg_fetch_row($consulta8)) {
                $cont3 = $row[0];
            }
            $cont3++;
            //////////////////////////////

            $calcu = $monto / ($meses);
            $nuevaFecha = date('Y-m-d', strtotime(" + $i month"));
            $format_numero = number_format(floor($calcu), 2, '.', '');
            pg_query("insert into detalle_pagos_venta values('$cont3','$cont2','$nuevaFecha','$format_numero','$format_numero','Activo')");
        }
        $cont3++;
        $calcu1 = floor($calcu) * ($meses - 1);
        $ultimaFecha = date('Y-m-d', strtotime(" + $i month"));
        $sal = $monto - $calcu1;
        $format_numero2 = number_format($sal, 2, '.', '');
        pg_query("insert into detalle_pagos_venta values('$cont3','$cont2','$ultimaFecha','$format_numero2','$format_numero2','Activo')");
    } else {
        $cont3 = 0;
        $consulta8 = pg_query("select max(id_detalle_pagos_venta) from detalle_pagos_venta");
        while ($row = pg_fetch_row($consulta8)) {
            $cont3 = $row[0];
        }
        $cont3++;
        ////////////////////////////

        $k = 1;
        $format2 = number_format($monto, 2, '.', '');
        $Fecha = date('Y-m-d', strtotime(" + $k month"));
        pg_query("insert into detalle_pagos_venta values('$cont3','$cont2','$Fecha','$format2','$format2','Activo')");
    }
    //////////////////////////////////////////////////////  
    //
    ////////////////guardar detalle compra/////
    for ($i = 0; $i <= $nelem; $i++) {
        /////////////////contador detalle factura venta/////////////
        $cont4 = 0;
        $consulta = pg_query("select max(id_detalle_venta) from detalle_factura_venta");
        while ($row = pg_fetch_row($consulta)) {
            $cont4 = $row[0];
        }
        $cont4++;
        //////////////////////////  
        //
        ///guardar detalle_factura/////
        pg_query("insert into detalle_factura_venta values('$cont4','$cont1','$arreglo1[$i]','$arreglo2[$i]','$arreglo3[$i]','$arreglo4[$i]','$arreglo5[$i]','Activo','$arreglo6[$i]')");
        ////////////////////////////////
        //
        //////////////modificar productos///////////
        $consulta2 = pg_query("select * from productos where cod_productos = '$arreglo1[$i]'");
        while ($row = pg_fetch_row($consulta2)) {
            $stock = $row[13];
        }
        $cal = $stock - $arreglo2[$i];

        pg_query("Update productos Set stock='" . $cal . "' where cod_productos='" . $arreglo1[$i] . "'");
        ///////////////////////////////////////////
        //
        ///////////////////contador dkardex/////////////
        $cont5 = 0;
        $consulta3 = pg_query("select max(id_kardex) from kardex");
        while ($row = pg_fetch_row($consulta3)) {
            $cont5 = $row[0];
        }
        $cont5++;
        /////////////////////////////////////////////////////////
        //
        ///guardar kardex/////
        pg_query("insert into kardex values('$cont5',' $_POST[fecha_actual]', '" . 'Factura Venta:' . $_POST[num_factura] . "' ,'$arreglo2[$i]','$arreglo3[$i]','$arreglo5[$i]','$arreglo1[$i]','Activo','2')");
        /////////////////////////////
    }
} else {
    if ($forma === "Contado") {
        for ($i = 0; $i <= $nelem; $i++) {

            /////////////////contador detalle factura venta/////////////
            $cont6 = 0;
            $consulta = pg_query("select  max(id_detalle_venta) from detalle_factura_venta");
            while ($row = pg_fetch_row($consulta)) {
                $cont6 = $row[0];
            }
            $cont6++;
            //////////////////////////  
            //
            //////////////guardar detalle_venta////////
            pg_query("insert into detalle_factura_venta values('$cont6','$cont1','$arreglo1[$i]','$arreglo2[$i]','$arreglo3[$i]','$arreglo4[$i]','$arreglo5[$i]','Activo','$arreglo6[$i]')");
            ////////////////////////////////////////////
            //
            //////////////modificar productos///////////
            $consulta2 = pg_query("select * from productos where cod_productos = '$arreglo1[$i]'");
            while ($row = pg_fetch_row($consulta2)) {
                $stock = $row[13];
            }
            $cal = $stock - $arreglo2[$i];

            pg_query("Update productos Set stock='" . $cal . "' where cod_productos='" . $arreglo1[$i] . "'");
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
            pg_query("insert into kardex values('$cont7','$_POST[fecha_actual]','" . 'Factura Venta:' . $_POST[num_factura] . "','$arreglo2[$i]','$arreglo3[$i]','$arreglo5[$i]','$arreglo1[$i]','Activo','2')");
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
            ///guardar libro/////
            pg_query("insert into libro_diario values('$cont8','$_POST[fecha_actual]','Inventarios','0.00','$_POST[tarifa12]','Salida Mercaderia','Activo')");
            $cont8 = 0;
            $consulta = pg_query("select  max(id_libro_diario) from libro_diario");
            while ($row = pg_fetch_row($consulta)) {
                $cont8 = $row[0];
            }
            $cont8++;
            ////////////////////////// 
            pg_query("insert into libro_diario values('$cont8','$_POST[fecha_actual]','Iva Ventas','0.00','$_POST[iva]','Salida Mercaderia','Activo')");
            $cont8 = 0;
            $consulta = pg_query("select  max(id_libro_diario) from libro_diario");
            while ($row = pg_fetch_row($consulta)) {
                $cont8 = $row[0];
            }
            $cont8++;
            ////////////////////////// 
            pg_query("insert into libro_diario values('$cont8','$_POST[fecha_actual]','Caja Chica','0.00','$_POST[tot]','Salida Mercaderia','Activo')");
            /////////////////////////////
            
            
            
      //}
    }
}

$data = 1;
echo $data;
?>
