<?php
    session_start();
    include '../../menus/menu.php';
    include '../../procesos/base.php';
    conectarse();
    error_reporting(0);
    $cont1 = 0;
    $consulta = pg_query("select max(id_inventario) from inventario");
    while ($row = pg_fetch_row($consulta)) {
        $cont1 = $row[0];
    }
    $cont1++;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>.:KARDEX:.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes"> 
        <link rel="stylesheet" type="text/css" href="../../css/buttons.css"/>
        <link rel="stylesheet" type="text/css" href="../../css/jquery-ui-1.10.4.custom.css"/>    
        <link rel="stylesheet" type="text/css" href="../../css/normalize.css"/>    
        <link rel="stylesheet" type="text/css" href="../../css/ui.jqgrid.css"/> 
        <link href="../../css/bootstrap.min.css" rel="stylesheet">
        <link href="../../css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="../../css/font-awesome.css" rel="stylesheet">
        <link href="../../css/style.css" rel="stylesheet">
        <link href="../../css/link_top.css" rel="stylesheet" />
        <link rel="stylesheet" href="../../css/alertify.core.css" />
        <link rel="stylesheet" href="../../css/alertify.default.css" id="toggleCSS" />
        <link href="../../css/sm-core-css.css" rel="stylesheet" type="text/css" />
        <link href="../../css/sm-blue/sm-blue.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript"src="../../js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.js"></script>
        <!--<script type="text/javascript" src="../../js/jquery-1.10.2.js"></script>-->
        <script type="text/javascript" src="../../js/jquery-ui-1.10.4.custom.min.js"></script>
        <script type="text/javascript" src="../../js/grid.locale-es.js"></script>
        <script type="text/javascript" src="../../js/jquery.jqGrid.src.js"></script>
        <script type="text/javascript" src="../../js/buttons.js" ></script>
        <script type="text/javascript" src="../../js/validCampoFranz.js" ></script>
        <script type="text/javascript" src="kardex.js"></script>
        <script type="text/javascript" src="../../js/datosUser.js"></script>
        <script type="text/javascript" src="../../js/ventana_reporte.js"></script>
        <script type="text/javascript" src="../../js/guidely/guidely.min.js"></script>
        <script type="text/javascript" src="../../js/easing.js" ></script>
        <script type="text/javascript" src="../../js/jquery.ui.totop.js" ></script>
        <script type="text/javascript" src="../../js/jquery.smartmenus.js"></script>
        <script type="text/javascript" src="../../js/alertify.min.js"></script>
    </head>

    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="">
                        <h1><?php echo $_SESSION['empresa']; ?></h1>				
                    </a>
                </div>
            </div>
        </div> 

        <!-- /Inicio  Menu Principal -->
        <div class="subnavbar">
            <div class="subnavbar-inner">
                <?Php
                // Cabecera Menu 
                if ($_SESSION['cargo'] == '1') {
                    print menu_1();
                }
                if ($_SESSION['cargo'] == '2') {
                    print menu_2();
                }
                if ($_SESSION['cargo'] == '3') {
                    print menu_3();
                }
                ?> 
            </div> 
        </div> 
        <!-- /Fin  Menu Principal -->

        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <div class="row">
                        <div class="span12">      		
                            <div class="widget ">
                                <div class="widget-header">
                                    <i class="icon-file"></i>
                                    <h3>INVENTARIO GENERAL</h3>
                                </div> <!-- /widget-header -->

                                <div class="widget-content">
                                    <div class="tabbable">
                                        <div class="widget-content">
                                            <div class="widget big-stats-container">
                                                <form id="formularios_inv" name="formularios_inv" method="post" class="form-horizontal">
                                                    <fieldset>
                                                        <section class="columna_1">
                                                            <div class="control-group">											
                                                                <label class="control-label" for="comprobante">Comprobante:</label>
                                                                <div class="controls">
                                                                    <input type="text" name="comprobante" id="comprobante" readonly class="campo" value="<?php echo $cont1 ?>" style="width: 80px"/>
                                                                </div>
                                                            </div>
                                                        </section>

                                                        <section class="columna_2">
                                                            <div class="control-group">											
                                                                <label class="control-label" for="fecha_actual">Fecha Actual:</label>
                                                                <div class="controls">
                                                                    <input type="text" name="fecha_actual" id="fecha_actual" readonly value="" class="campo" style="width: 100px" />
                                                                </div>
                                                            </div>
                                                        </section>

                                                        <section class="columna_3">
                                                            <div class="control-group">											
                                                                <label class="control-label" for="hora_actual">Hora Actual:</label>
                                                                <div class="controls">
                                                                    <input type="text" name="hora_actual" id="hora_actual" readonly class="campo" style="width: 100px"/>
                                                                </div>
                                                            </div>
                                                        </section>

                                                        <section class="columna_4">
                                                            <div class="control-group">											
                                                                <label class="control-label" for="digitador"> Digitad@r:</label>
                                                                <div class="controls">
                                                                    <input type="text" name="digitador" id="digitador" value="<?php echo $_SESSION['nombres'] ?>" class="campo" style="width: 200px" readonly/>
                                                                    <input type="hidden" name="comprobante2" id="comprobante2" class="campo" style="width: 100px" value="<?php echo $cont1 ?>" />
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </fieldset>

                                                    <fieldset>
                                                        <legend>Productos</legend>   
                                                        <table cellpadding="2" border="0" style="margin-left: 10px">
                                                            <tr>
                                                                <td><label>Código:</label></td>   
                                                                <td><label>Producto:</label></td>  
                                                                <td><label>Fecha Inicio:</label></td>   
                                                                <td><label>Fecha Fin:</label></td>
                                                            </tr>

                                                            <tr>
                                                                <!--<td><input type="text" name="codigo_barras" id="codigo_barras" class="campo" style="width: 170px"  placeholder="Buscar..."/></td>-->
                                                                <td><input type="text" name="codigo" id="codigo" class="campo" style="width: 200px"  placeholder="Buscar..."/></td>
                                                                <td><input type="text" name="producto" id="producto" class="campo" style="width: 300px"  placeholder="Buscar..."/></td>
                                                                <td><input type="text" name="fecha_inicio" id="fecha_inicio" class="campo" readonly /></td>
                                                                <td><input type="text" name="fecha_fin" id="fecha_fin" class="campo" readonly/></td>
                                                                <td><input type="hidden" name="cantidad" id="cantidad" class="campo" style="width: 60px" maxlength="10"/></td>
                                                                <td><input type="hidden" name="precio" id="precio" style="width: 60px" readonly class="campo"/></td>
                                                                <td><input type="hidden" name="stock" id="stock" class="campo" style="width: 60px" maxlength="10" value="" readonly/></td>
                                                                <td><input type="hidden" name="p_venta" id="p_venta" class="campo" style="width: 60px" maxlength="10" value="" readonly/></td>
                                                                <td><input type="hidden" name="existencia" id="existencia" class="campo" style="width: 60px" maxlength="10" value="" readonly/></td>
                                                                <td><input type="hidden" name="diferencia" id="diferencia" class="campo" style="width: 60px" maxlength="10" value="" readonly/></td>
                                                                <td><input type="hidden" name="cod_producto" id="cod_producto" class="campo" style="width: 100px"/></td>
                                                                <td><button class="btn btn-primary" id='btnGenerar'><i class="icon-save"></i> Generar</button></td>
                                                            </tr>
                                                        </table>
                                                        <br />

                                                        <table id="td_kardex" class="table table-striped table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Producto</th>
                                                                    <th>Detalle</th>
                                                                    <th>Cant. Entrada</th>
                                                                    <th>Precio. Entrada</th>
                                                                    <th>Valor. Entrada</th>
                                                                    <th>Cant. Salida</th>
                                                                    <th>Precio. Salida</th>
                                                                    <th>Valor. Salida</th>
                                                                    <th>Transacción</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </fieldset> 
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div>
        <script type="text/javascript" src="../../js/base.js"></script>
        <script type="text/javascript" src="../../js/jquery.ui.datepicker-es.js"></script>

        <div class="footer">
            <div class="footer-inner">
                <div class="container">
                    <div class="row">
                        <div class="span12">
                            &copy; 2015 <a href=""> <?php echo $_SESSION['empresa']; ?></a>.
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </body>
</html>