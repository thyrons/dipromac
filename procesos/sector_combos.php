<?php

session_start();
include 'base.php';
conectarse();
error_reporting(0);
$consulta = pg_query("select id_sectores,nombre_sector from sectores;");
while ($row = pg_fetch_row($consulta)) {
    if ($row['id_marca'] == $_GET['id']) {
        echo "<option selected id='$row[0]' value='$row[0]'> $row[1]</option>";
    } else {
        echo "<option id='$row[0]' value='$row[0]'> $row[1]</option>";
    }
}
?>
