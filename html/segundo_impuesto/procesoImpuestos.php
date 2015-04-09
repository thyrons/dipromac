<?php
session_start();
include '../../procesos/base.php';
conectarse();
$cont = 0;
$repe = 0;

//////////////////validar repetidos//////////////////
$consulta = pg_query("select * from segundo_impuesto where descripcion = '$_POST[descripcion]' ");
while ($row = pg_fetch_row($consulta)) {
   $repe++;
}
//////////////////////////////////////////////////    

if ($_POST['oper'] == "add") {
    $consulta = pg_query("select max(id_segundo_impuesto) from segundo_impuesto");
    while ($row = pg_fetch_row($consulta)) {
        $cont = $row[0];
    }
    $cont++;

    if ($repe == 0) {
        pg_query("insert into segundo_impuesto values('$cont','" . strtoupper($_POST['abreviatura']) . "','$_POST[descripcion]','$_POST[valor]','Activo')");
        $data = 1;
    }else{
        $data = 3;
    }
} else {
    if ($_POST['oper'] == "edit") {
        pg_query("update segundo_impuesto set abreviatura='" . strtoupper($_POST['abreviatura']) . "', descripcion='$_POST[descripcion]', valor = '$_POST[valor]', Estado = 'Activo' where id_segundo_impuesto='$_POST[id_segundo_impuesto]'");
        $data = 2;
    }
}
echo $data;
?>
