<?php
    session_start();
    include '../../procesos/base.php';
    include '../../menus/menu.php';

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>.:ASIGNACION CUENTAS:.</title>
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
        <link rel="stylesheet" href="../../css/alertify.core.css" />
        <link rel="stylesheet" href="../../css/alertify.default.css" id="toggleCSS" />
        <link href="../../css/sm-core-css.css" rel="stylesheet" type="text/css" />
        <link href="../../css/sm-blue/sm-blue.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="../../js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.js"></script>
        <!--<script type="text/javascript" src="../../js/jquery-1.10.2.js"></script>-->
        <script type="text/javascript" src="../../js/jquery-ui-1.10.4.custom.min.js"></script>
        <script type="text/javascript" src="../../js/grid.locale-es.js"></script>
        <script type="text/javascript" src="../../js/jquery.jqGrid.src.js"></script>
        <script type="text/javascript" src="../../js/buttons.js" ></script>
        <script type="text/javascript" src="../../js/validCampoFranz.js" ></script>        
        <script type="text/javascript" src="../../js/datosUser.js"></script>
        <script type="text/javascript" src="../../js/ventana_reporte.js"></script>
        <script type="text/javascript" src="../../js/alertify.min.js"></script>
        <script type="text/javascript" src="../../js/guidely/guidely.min.js"></script>
        <script type="text/javascript" src="../../js/jquery.smartmenus.js"></script>
        <script type="text/javascript" src="asignacion.js"></script>
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
                                    <i class="icon-user"></i>
                                    <h3>ASIGNACIÓN CUENTAS </h3>
                                </div> <!-- /widget-header -->

                                    <div class="widget-content">
                                        <div class="tabbable">
                                           <div class="widget-content">
                                              <div class="widget big-stats-container">
                                              <form class="form-horizontal" id="clientes_form" name="clientes_form" method="post">
                                              <div class="row">
                                              <div class="span6">
                                               <div class="control-group">
                                                <label class="control-label" for="categoria">Asignar Cuenta:</label>
                                                <div class="controls">
                                                    <div class="input-append">
                                                        <select id="tabla" name="tabla" class="span4">
                                                            <option value="">........Seleccione........</option>
                                                            <!-- <option value="Clientes">CLIENTES</option>
                                                            <option value="Proveedores">Proveedores</option> -->
                                                            <?php
                                                                $consulta = pg_query("select * from bodegas ");
                                                                while ($row = pg_fetch_row($consulta)) {
                                                                    echo "<option value=$row[0]>$row[1]</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                        <!-- <input type="button" class="btn btn-primary" id='btnCategoria' value="..." title="INGRESO CATEGORIAS"/> -->
                                                    </div>
                                                </div>
                                            </div>   
                                          </div> 
                                          <div class="span6">
                                              <input type="button" class="btn btn-primary" id='btnCuenta' value="Agregar Cuenta..." title=""/>
                                          </div>
                                         </div>
                                         <br />

                                    <p style="margin-left: 10px">DETALLE CUENTAS</p>
                                     <div style="margin-left: 10px; height: 200px; border: solid 0px">
                                        <table id="tablaNuevo" style="width: 400px; margin-left: 20px"  class="table table-striped table-bordered"  >
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px"></th>
                                                    <th style="width: 200px; text-align: center">Tabla</th>
                                                    <th style="width: 200px; text-align: center">Código</th>
                                                    <th style="width: 200px; text-align: center">Cuenta Contable</th>
                                                    <th style="width: 20px; text-align: center"></th>
                                                </tr>   
                                            </thead>
                                            <tbody>
                                                <tr></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                 </form>

                                 <div class="form-actions">
                                    <button class="btn btn-primary" id='btnGuardar'><i class="icon-save"></i> Guardar</button>
                                    <button class="btn btn-primary" id='btnNuevo'><i class="icon-pencil"></i> Nuevo</button>
                                </div>

                                 <div id="cuentas" title="Búsqueda Plan de Cuentas" class="">
                                    <table id="list"><tr><td></td></tr></table>
                                   <div id="pager"></div>
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