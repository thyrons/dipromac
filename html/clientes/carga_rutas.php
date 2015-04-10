<?php

session_start();
include '../../procesos/base.php';
conectarse();
$consulta = pg_query("select * from rutas where id_sector='$_GET[id]'");
$response = '';
while ($row = pg_fetch_row($consulta)) {          
    $response .= '<option value="'.$row[0].'">'.$row[1].'</option>';
}
echo $response;

?>