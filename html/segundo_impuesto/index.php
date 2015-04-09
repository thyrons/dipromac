    <?php
    session_start();
    include '../../menus/menu.php';
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>.:INGRESO IMPUESTOS:.</title>
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
        <script type="text/javascript" src="../../js/jquery-loader.js"></script>
        <script type="text/javascript" src="../../js/jquery-ui-1.10.4.custom.min.js"></script>
        <script type="text/javascript" src="../../js/grid.locale-es.js"></script>
        <script type="text/javascript" src="../../js/jquery.jqGrid.src.js"></script>
        <script type="text/javascript" src="../../js/buttons.js" ></script>
        <script type="text/javascript" src="../../js/validCampoFranz.js" ></script>
        <script type="text/javascript" src="segundo_impuesto.js"></script>
        <script type="text/javascript" src="../../js/datosUser.js"></script>
        <script type="text/javascript" src="../../js/ventana_reporte.js"></script>
        <script type="text/javascript" src="../../js/guidely/guidely.min.js"></script>
        <script type="text/javascript" src="../../js/alertify.min.js"></script>
        <script type="text/javascript" src="../../js/jquery.smartmenus.js"></script>
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
                                    <i class="icon-list-alt"></i>
                                    <h3>TABLA SEGUNDO IMPUESTO</h3>
                                </div> <!-- /widget-header -->

                                <div class="widget-content">
                                  <form class="form-horizontal" id="impuesto_form" name="impuesto_form" method="post">
                                    <div class="row">
                                      <div class="span6">
                                      <hr />
                                            <div class="tabbable" id="centro">
                                            <fieldset>
                                                <table id="list"></table>
                                                <div id="pager"></div>   
                                            </fieldset>   
                                            </div> 
                                         </div>

                                         <div class="span6">
                                         <hr />
                                           <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#formcontrols" data-toggle="tab">Generales</a>
                                                </li>
                                                <li ><a href="#jscontrols" data-toggle="tab">Contable</a></li>
                                          </ul>
                                          <div class="tab-content">
                                             <div class="tab-pane active" id="formcontrols">
                                                <div class="control-group">                                           
                                                    <label class="control-label" for="descripcion">Abreviatura:</label>
                                                    <div class="controls">
                                                         <input type="text" name="abreviatura" id="abreviatura" class="span2" value="" />
                                                         <input type="hidden" name="id_segundo_impuesto" id="id_segundo_impuesto" class="span2" value="" />
                                                    </div>
                                                </div>

                                                <div class="control-group">                                           
                                                    <label class="control-label" for="descripcion">Descripción:</label>
                                                    <div class="controls">
                                                         <input type="text" name="descripcion" id="descripcion" class="span3" value="" />
                                                    </div>
                                                </div>

                                                <div class="control-group">                                           
                                                    <label class="control-label" for="valor">Valor en %:</label>
                                                    <div class="controls">
                                                         <input type="text" name="valor" id="valor" class="span2" value="" />
                                                    </div>
                                                </div> 
                                             </div> 
                                             
                                             <div class="tab-pane" id="jscontrols">
                                             <p>Cuenta Contable</p>
                                                <div class="control-group">
                                                    <label class="control-label" for="cuenta_contable">Ventas:</label>
                                                    <div class="controls">
                                                        <div class="input-append">
                                                            <input type="text" name="cuenta_contable" readonly id="cuenta_contable" class="span3"/>
                                                            <input type="hidden" name="nombre_cuenta" readonly id="nombre_cuenta" class="span3"/>                                                            
                                                            <input type="button" class="btn btn-primary" id='btnCategoria' value="Cargar" title="Plan Cuentas"/>
                                                        </div>
                                                    </div>
                                                  </div>

                                                  <div class="control-group">
                                                    <label class="control-label" for="cuenta_contable">Compras:</label>
                                                    <div class="controls">
                                                        <div class="input-append">
                                                            <input type="text" name="cuenta_contable" readonly id="cuenta_contable" class="span3"/>
                                                            <input type="hidden" name="nombre_cuenta" readonly id="nombre_cuenta" class="span3"/>                                                            
                                                            <input type="button" class="btn btn-primary" id='btnCategoria' value="Cargar" title="Plan Cuentas"/>
                                                        </div>
                                                    </div>
                                                  </div>
                                             </div>
                                          </div>
                                         </div> 
                                    </div>  
                                  </form>

                                  <div class="form-actions">
                                    <button class="btn btn-primary" id='btnGuardar'><i class="icon-save"></i> Guardar</button>
                                    <button class="btn btn-primary" id='btnModificar'><i class="icon-edit"></i> Modificar</button>
                                    <button class="btn btn-primary" id='btnEliminar'><i class="icon-remove"></i> Eliminar</button>
                                    <button class="btn btn-primary" id='btnNuevo'><i class="icon-pencil"></i> Nuevo</button>
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
                            &copy; 2015 <a href=""> <?php echo $_SESSION['empresa']; ?></a>.
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </body>
</html>