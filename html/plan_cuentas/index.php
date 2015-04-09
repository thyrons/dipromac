<?php
    session_start();
    include '../../menus/menu.php';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>.:PLAN DE CUENTAS:.</title>
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

        <script type="text/javascript" src="../../js/bootstrap.js"></script>
        <script type="text/javascript" src="../../js/jquery-loader.js"></script>
        <script type="text/javascript" src="../../js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="../../js/jquery-ui-1.10.4.custom.min.js"></script>
        <script type="text/javascript" src="../../js/grid.locale-es.js"></script>
        <script type="text/javascript" src="../../js/jquery.jqGrid.src.js"></script>
        <script type="text/javascript" src="../../js/buttons.js" ></script>
        <script type="text/javascript" src="../../js/validCampoFranz.js" ></script>
        <script type="text/javascript" src="plan_cuentas.js"></script>
        <script type="text/javascript" src="../../js/datosUser.js"></script>
        <script type="text/javascript" src="../../js/ventana_reporte.js"></script>
        <script type="text/javascript" src="../../js/guidely/guidely.min.js"></script>
        <script type="text/javascript" src="../../js/alertify.min.js"></script>
        <script type="text/javascript" src="../../js/jquery.smartmenus.js"></script>
        <script type="text/javascript" src="../../js/ruc_jquery_validator.min.js"></script>
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

        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <div class="row">
                        <div class="span12">      		
                            <div class="widget ">
                                <div class="widget-header">
                                    <i class="icon-user"></i>
                                    <h3>PLAN DE CUENTAS</h3>
                                </div> <!-- /widget-header -->

                                <div class="widget-content">
                                    <div class="tabbable">
                                        <fieldset>
                                            <form class="form-horizontal" id="plan_form" name="plan_form" method="post">
                                                <div class="row">  
                                                    <div class="span5">
                                                        <table id="list"><tr><td></td></tr></table>
                                                        <div id="pager"></div>
                                                    </div>

                                                    <div class="span5">
                                                        <div class="control-group">
                                                            <label class="control-label" for="direccion_cli">Cuenta de : <font color="red">*</font></label>
                                                            <div class="controls">
                                                                <select name="cuenta" id="cuenta">
                                                                    <option value="G" selected>GRUPO</option>
                                                                    <option value="M">MOVIMIENTO</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                <!--<div class="control-group">											
                                                        <label class="control-label" for="tipo">Tipo cuenta: </label>
                                                        <div class="controls">
                                                            <select name="tipo" id="tipo">
                                                                <option value="">...Seleccione...</option>
                                                                <option value="Activo">Activo</option>
                                                                <option value="Pasivo">Pasivo</option>
                                                                <option value="Capital">Capital</option>
                                                                <option value="Ingresos">Ingresos</option>
                                                                <option value="Costos">Costos</option>
                                                                <option value="Gastos">Gastos</option>
                                                                <option value="Otros Ingresos">Otros Ingresos</option>
                                                                <option value="Otros Egresos">Otros Egresos</option>
                                                                <option value="Cta. de Orden Deudora">Cta. de Orden Deudora</option>
                                                                <option value="Cta. de Orden Acreedora">Cta. de Orden Acreedora</option>
                                                            </select>
                                                        </div>
                                                    </div>-->

                                                        <div class="control-group">											
                                                            <label class="control-label" for="tipo_docu">Código cuenta: <font color="red">*</font></label>
                                                            <div class="controls" >
                                                                <input type="text" name="codigo_cuenta"  id="codigo_cuenta" required class="campo"/>
                                                                <input type="hidden" name="id_plan_cuentas"  id="id_plan_cuentas" required class="campo"/>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">											
                                                            <label class="control-label" for=""></label>
                                                            <div class="controls">
                                                                <label class="control-label" for="formato"><font color="red">FORMATO:9.9.99.99.99.99</font></label>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">											
                                                            <label class="control-label" for="descripcion">Descripción: <font color="red">*</font></label>
                                                            <div class="controls">
                                                                <input type="text" name="descripcion"  id="descripcion" placeholder="Descripción de la cuenta" required class="campo"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </fieldset>

                                        <div class="form-actions">
                                            <button class="btn btn-primary" id='btnGuardar'><i class="icon-save"></i> Guardar</button>
                                            <button class="btn btn-primary" id='btnModificar'><i class="icon-edit"></i> Modificar</button>
                                            <button class="btn btn-primary" id='btnBuscar'><i class="icon-search"></i> Buscar</button>
                                            <button class="btn btn-primary" id='btnNuevo'><i class="icon-pencil"></i> Nuevo</button>
                                        </div>


                                        <div id="clientes" title="Búsqueda de Clientes" class="">

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