<?php
    session_start();
    include '../../menus/menu.php';
    include '../../procesos/base.php';
    conectarse();
    error_reporting(0);
    $cont1 = 0;
    $consulta = pg_query("select max(id_transacciones) from transacciones");
    while ($row = pg_fetch_row($consulta)) {
        $cont1 = $row[0];
    }
    $cont1++;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>.:TRANSACCIONES:.</title>
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
        <script type="text/javascript" src="transacciones.js"></script>
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
                                    <i class="icon-money"></i>
                                    <h3>INGRESO DE TRANSACCIONES</h3>
                                </div> <!-- /widget-header -->

                                <div class="widget-content">
                                    <div class="tabbable">
                                        <div class="widget-content">
                                            <div class="widget big-stats-container">
                                                <form id="form_transacciones" name="form_transacciones" method="post" class="form-horizontal">
                                                    <fieldset>
                                                        <section class="columna_1">
                                                            <div class="control-group">											
                                                                <label class="control-label" for="nombres_cli">Transacción No:</label>
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
                                                                    <input type="hidden" name="comprobante2" id="comprobante2" class="campo" style="width: 100px" value="<?php echo $cont1 ?>" />
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </fieldset>

                                                    <br />

                                                    <fieldset>
                                                        <div class="row">
                                                            <div class="span4">
                                                                <div class="control-group">
                                                                    <label class="control-label" for="transaccion">Tipo de Transacción: <font color="red">*</font></label>
                                                                    <div class="controls">
                                                                        <select id="transaccion" name="transaccion" class="span3">
                                                                            <option value="">........Seleccione........</option>
                                                                            <?php
                                                                            $consulta2 = pg_query("select * from tipo_transaccion ");
                                                                            while ($row = pg_fetch_row($consulta2)) {
                                                                                echo "<option id=$row[0] value=$row[1]>$row[1]</option>";
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>   
                                                            </div>



                                                            <div class="span2">
                                                                <div class="control-group">
                                                                    <label class="control-label" for="num">No:</label>
                                                                    <div class="controls">
                                                                        <div class="input-append">
                                                                            <input type="text" name="num"  id="num" required class="span1"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="span2">
                                                                <div class="control-group">
                                                                    <label class="control-label" for="abreviatura" id="abreviatura">DIA-1</label>
                                                                </div>
                                                            </div>

                                                            <div class="span6">
                                                                <div class="control-group">											
                                                                    <label class="control-label" for="cancepto">Concepto: <font color="red">*</font></label>
                                                                    <div class="controls">
                                                                        <input type="text" name="cancepto"  id="cancepto" required  class="span4" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 

                                                    </fieldset>
                                                    <br />
                                                    <fieldset>
                                                        <legend>Transacciones</legend>
                                                        <table cellpadding="2" border="0" style="margin-left: 10px">
                                                            <tr>
                                                                <td><label>Código</label></td>   
                                                                <td><label>Descripción</label></td>   
                                                                <td><label>Tipo Ref.</label></td>   
                                                                <td><label># Ref.</label></td>
                                                                <td><label>Débido</label></td>
                                                                <td><label>Crédito</label></td>
                                                            </tr>

                                                            <tr>
                                                                <td><input type="text" name="codigo" id="codigo" class="campo" style="width: 150px"  placeholder="Buscar..."/></td>
                                                                <td><input type="text" name="descripcion" id="descripcion" class="campo" style="width: 150px" /></td>
                                                                <td><input type="text" name="tipo_ref" id="tipo_ref" class="campo" style="width: 120px" maxlength="10"/></td>
                                                                <td><input type="text" name="num_ref" id="num_ref" style="width: 80px"  class="campo"/></td>
                                                                <td><input type="text" name="debito" id="debito" class="campo" style="width: 80px" value="0" /></td>
                                                                <td><input type="text" name="credito" id="credito" class="campo" style="width: 80px" value="0" /></td>
                                                                <td><input type="hidden" name="id_plan_cuentas" id="id_plan_cuentas" class="campo" style="width: 80px"/></td>
                                                            </tr>
                                                        </table>

                                                        <div style="margin-left: 10px">
                                                            <table id="list" ></table>
                                                        </div>

                                                        <div style="margin-left: 425px">
                                                            <table border="0" cellpadding="2">
                                                                <tr>
                                                                    <td><label>Total Debe:</label></td>
                                                                    <td><input type="text" name="total_debe" id="total_debe" class="campo" readonly style="width: 80px" value="0.00" /></td>
                                                                    <td><label>Total Haber:</label></td>
                                                                    <td><input type="text" name="total_haber" id="total_haber" class="campo" readonly style="width: 80px" value="0.00" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Diferencia:</label></td>
                                                                    <td><input type="text" name="direrencia" id="direrencia" class="campo" readonly style="width: 80px" value="0.00" /></td>  
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                                <div id="buscar_facturas" title="BUSCAR FACTURAS">
                                                    <fieldset>
                                                        <table id="list2"><tr><td></td></tr></table>
                                                        <div id="pager2"></div>
                                                    </fieldset>
                                                </div> 
                                                <div id="buscar_cuentas_cobrar" title="BUSCAR CUENTAS POR COBRAR">
                                                    <fieldset>
                                                        <table id="list3"><tr><td></td></tr></table>
                                                        <div id="pager3"></div>
                                                    </fieldset>
                                                </div> 

                                                <div class="form-actions">
                                                    <button class="btn btn-primary" id='btnGuardar'><i class="icon-save"></i> Guardar</button>
                                                    <button class="btn btn-primary" id='btnModificar'><i class="icon-edit"></i> Modificar</button>
                                                    <!--<button class="btn btn-primary" id='btnBuscar'><i class="icon-search"></i> Buscar</button>-->
                                                    <button class="btn btn-primary" id='btnNuevo'><i class="icon-pencil"></i> Nuevo</button>
                                                    <button class="btn btn-primary" id='btnImprimir'><i class="icon-print"></i> Imprimir</button>
                                                    <button class="btn btn-primary" id='btnAtras'><i class="icon-step-backward"></i> Atras</button>
                                                    <button class="btn btn-primary" id='btnAdelante'>Adelante <i class="icon-step-forward"></i></button>
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
                            &copy; 2015 <a href=""> <?php echo $_SESSION['empresa']; ?></a>.
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </body>
</html>