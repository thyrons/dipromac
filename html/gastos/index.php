<?php
    session_start();
    include '../../menus/menu.php';
    include '../../procesos/base.php';
    conectarse();
    error_reporting(0);
    $cont1 = 0;
    $consulta2 = pg_query("select * from gastos_internos order by id_gastos asc");
    while ($row = pg_fetch_row($consulta2)) {
        $cont1 = $row[0];
    }
    $cont1++;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>.:GASTOS:.</title>
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
        <link href="../../css/sm-core-css.css" rel="stylesheet" type="text/css" />
        <link href="../../css/sm-blue/sm-blue.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../../css/alertify.core.css" />
        <link rel="stylesheet" href="../../css/alertify.default.css" id="toggleCSS" />

        <script type="text/javascript" src="../../js/bootstrap.js"></script>
        <script type="text/javascript" src="../../js/jquery-loader.js"></script>
        <script type="text/javascript" src="../../js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="../../js/jquery-ui-1.10.4.custom.min.js"></script>
        <script type="text/javascript" src="../../js/grid.locale-es.js"></script>
        <script type="text/javascript" src="../../js/jquery.jqGrid.src.js"></script>
        <script type="text/javascript" src="../../js/buttons.js" ></script>
        <script type="text/javascript" src="../../js/validCampoFranz.js" ></script>
        <script type="text/javascript" src="gastos_internos.js"></script>
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
                                    <i class="icon-dollar"></i>
                                    <h3>GASTOS INTERNOS</h3>
                                </div> <!-- /widget-header -->

                                <div class="widget-content">
                                    <div class="tabbable">
                                        <div class="widget-content">
                                            <div class="widget big-stats-container">
                                                <form id="formularios_fac" name="formularios_fac" method="post" class="form-horizontal">

                                                    <fieldset>
                                                        <section class="columna_1">
                                                            <div class="control-group">											
                                                                <label class="control-label" for="nombres_cli">Comprobante:</label>
                                                                <div class="controls">
                                                                    <input type="text" name="comprobante" id="comprobante" readonly class="campo" value="<?php echo $cont1 ?>" style="width: 80px"/>
                                                                </div>
                                                            </div>
                                                        </section>

                                                        <section class="columna_2">
                                                            <div class="control-group">											
                                                                <label class="control-label" for="nombres_cli">Fecha Actual:</label>
                                                                <div class="controls">
                                                                    <input type="text" name="fecha_actual" id="fecha_actual" readonly value="<?php echo date("Y-m-d"); ?>" class="campo" style="width: 100px" />
                                                                </div>
                                                            </div>
                                                        </section>

                                                        <section class="columna_3">
                                                            <div class="control-group">											
                                                                <label class="control-label" for="nombres_cli">Hora Actual:</label>
                                                                <div class="controls">
                                                                    <input type="text" name="hora_actual" id="hora_actual" readonly class="campo" style="width: 100px"/>
                                                                </div>
                                                            </div>
                                                        </section>

                                                        <section class="columna_4">
                                                            <div class="control-group">											
                                                                <label class="control-label" for="nombres_cli"> Digitad@r:</label>
                                                                <div class="controls">
                                                                    <input type="text" name="digitador" id="digitador" value="<?php echo $_SESSION['nombres'] ?>" class="campo" style="width: 200px" readonly/>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </fieldset>

                                                    <fieldset>
                                                        <br />
                                                        <div class="widget widget-nopad">
                                                            <div class="widget-header"> <i class="icon-money"></i>
                                                                <h3>REGISTRO GASTOS</h3>
                                                            </div>
                                                            <!-- /widget-header -->
                                                            <div class="widget-content">
                                                                <div class="widget big-stats-container">
                                                                    <br />
                                                                    <p style="margin-left: 10px">DETALLE GASTOS</p>
                                                                    <table cellpadding="2" border="0" style="margin-left: 10px">
                                                                        <tr>
                                                                            <td><label style="width: 100%">Proveedor: <font color="red">*</font></label></td>
                                                                            <td><select name="tipo_docu" id="tipo_docu" required style="width: 170px">
                                                                                    <option value="">......Seleccione......</option>
                                                                                    <option value="Cedula">Cedula</option>
                                                                                    <option value="Ruc">Ruc</option>
                                                                                    <option value="Pasaporte">Pasaporte</option>  
                                                                                </select></td>
                                                                            <td><label style="width: 100%; margin-left: 10px">Nro de Identificación: <font color="red">*</font></label></td>
                                                                            <td><input type="text" name="ruc_ci" id="ruc_ci" class="campo" style="width: 150px; margin-left: 5px"/></td>
                                                                            <td><input type="text" name="empresa" id="empresa" class="campo" style="width: 220px" /></td>
                                                                            <td><input type="hidden" name="id_proveedor" id="id_proveedor" class="campo" style="width: 180px" /></td>
                                                                        </tr>  
                                                                    </table>
                                                                    <table cellpadding="2" border="0" style="margin-left: 10px" > 
                                                                        <tr>
                                                                            <td><label for="num_factura" style="width: 100%">Num. Factura: <font color="red">*</font></label></td>  
                                                                            <td><input type="text" name="num_factura" id="num_factura" required maxlength="10" class="campo" style="width: 200px"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><label for="descripcion" style="width: 100%">Descripción: <font color="red">*</font></label></td>  
                                                                            <td><input type="text" name="descripcion" id="descripcion" required class="campo" style="width: 300px"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><label for="total" style="width: 100%">Total: <font color="red">*</font></label></td>
                                                                            <td><input type="text" name="total" id="total" required maxlength="10" class="campo" style="width: 100px"/></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </form>

                                                <div class="form-actions">
                                                    <button class="btn btn-primary" id='btnGuardar'><i class="icon-save"></i> Guardar</button>
                                                    <button class="btn btn-primary" id='btnModificar'><i class="icon-edit"></i> Modificar</button>
                                                    <button class="btn btn-primary" id='btnBuscar'><i class="icon-search"></i> Buscar</button>
                                                    <button class="btn btn-primary" id='btnNuevo'><i class="icon-pencil"></i> Nuevo</button>
                                                    <button class="btn btn-primary" id='btnAtras'><i class="icon-step-backward"></i> Atras</button>
                                                    <button class="btn btn-primary" id='btnAdelante'>Adelante <i class="icon-step-forward"></i></button>
                                                </div>

                                                <div id="buscar_gastos_internos" title="BUSCAR GASTOS INTERNOS">
                                                    <table id="list2"><tr><td></td></tr></table>
                                                    <div id="pager2"></div>
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
        </div> 
        <script type="text/javascript" src="../../js/base.js"></script>
        <script type="text/javascript" src="../../js/jquery.ui.datepicker-es.js"></script>

        <div class="footer">
            <div class="footer-inner">
                <div class="container">
                    <div class="row">
                        <div class="span12">
                            &copy; 2014 <a href=""> <?php echo $_SESSION['empresa']; ?></a>.
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </body>
</html>
