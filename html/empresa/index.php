<?php
    session_start();
    include '../../menus/menu.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>.:INGRESO EMPRESA:.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes"> 
        <link rel="stylesheet" type="text/css" href="../../css/buttons.css"/>
        <link rel="stylesheet" type="text/css" href="../../css/jquery-ui-1.10.4.custom.css"/>    
        <link rel="stylesheet" type="text/css" href="../../css/normalize.css"/>    
        <link rel="stylesheet" type="text/css" href="../../css/ui.jqgrid.css"/> 
        <link href="../../css/bootstrap.min.css" rel="stylesheet">
        <link href="../../css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="../../css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="../../css/alertify.core.css" />
        <link rel="stylesheet" href="../../css/alertify.default.css" id="toggleCSS" />
        <link href="../../css/sm-core-css.css" rel="stylesheet" type="text/css" />
        <link href="../../css/sm-blue/sm-blue.css" rel="stylesheet" type="text/css" />
        <link href="../../css/style.css" rel="stylesheet">

        <script type="text/javascript"src="../../js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.js"></script>
        <script type="text/javascript" src="../../js/jquery-loader.js"></script>
        <!--<script type="text/javascript" src="../../js/jquery-1.10.2.js"></script>-->
        <script type="text/javascript" src="../../js/jquery-ui-1.10.4.custom.min.js"></script>
        <script type="text/javascript" src="../../js/grid.locale-es.js"></script>
        <script type="text/javascript" src="../../js/jquery.jqGrid.src.js"></script>
        <script type="text/javascript" src="../../js/buttons.js" ></script>
        <script type="text/javascript" src="../../js/validCampoFranz.js" ></script>
        <script type="text/javascript" src="empresa.js"></script>
        <script type="text/javascript" src="../../js/datosUser.js"></script>
        <script type="text/javascript" src="../../js/ventana_reporte.js"></script>
        <script type="text/javascript" src="../../js/guidely/guidely.min.js"></script>
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
                                    <i class="icon-cog"></i>
                                    <h3>EMPRESA</h3>
                                </div> <!-- /widget-header -->

                                <div class="widget-content">
                                    <div class="tabbable">
                                        <fieldset>
                                            <form class="form-horizontal" id="empresa_form" name="empresa_form" method="post"  enctype="multipart/form-data">
                                                <section class="columna1_empresa">
                                                    <div class="control-group">
                                                        <label class="control-label" for="nombre_empresa">Nombre empresa: <font color="red">*</font></label>
                                                        <div class="controls">
                                                            <input type="text" name="nombre_empresa"  id="nombre_empresa" placeholder="Empresa" required class="campo">
                                                        </div>  
                                                    </div> 

                                                    <div class="control-group">
                                                        <label class="control-label" for="descripcion_empresa">Descripción: <font color="red">*</font></label>
                                                        <div class="controls">
                                                            <input type="text" name="descripcion_empresa"  id="descripcion_empresa" placeholder="Descripción empresa" required class="campo">
                                                        </div>
                                                    </div> 

                                                    <div class="control-group">
                                                        <label class="control-label" for="direccion_empresa">Dirección: <font color="red">*</font></label>
                                                        <div class="controls">
                                                            <input type="text" name="direccion_empresa"  id="direccion_empresa" placeholder="Dirección empresa" required class="campo">
                                                        </div>	
                                                    </div> 

                                                    <div class="control-group">
                                                        <label class="control-label" for="celular_empresa">Celular: </label>
                                                        <div class="controls">
                                                            <input type="text" name="celular_empresa"  id="celular_empresa" placeholder="Telefóno empresa" maxlength="10" required class="campo">
                                                        </div>	
                                                    </div> 

                                                    <div class="control-group">
                                                        <label class="control-label" for="ciudad_empresa">Ciudad: <font color="red">*</font></label>
                                                        <div class="controls">
                                                            <input type="text" name="ciudad_empresa"  id="ciudad_empresa" placeholder="Ciudad empresa" required class="campo">
                                                        </div>	
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="correo_empresa">E-mail: </label>
                                                        <div class="controls">
                                                            <input type="text" name="correo_empresa"  id="correo_empresa" placeholder="Correo empresa" required class="campo">
                                                        </div>
                                                    </div> 

                                                    <div class="control-group">
                                                        <label class="control-label" for="correo_empresa">Imagen: </label>
                                                        <div class="controls">
                                                            <input type="file" name="archivo" id="archivo" onchange='Test.UpdatePreview(this)' accept="image/*" />
                                                        </div>	
                                                    </div> 
                                                </section>

                                                <section class="columna1_empresa">
                                                    <div class="control-group">
                                                        <label class="control-label" for="ruc_empresa">Ruc empresa: <font color="red">*</font></label>
                                                        <div class="controls">
                                                            <input type="text" name="ruc_empresa"  id="ruc_empresa" placeholder=" Ruc empresa" required class="campo">
                                                            <input type="hidden" name="id_empresa"  id="id_empresa" readonly class="campo">
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="propietario_empresa">Propietario: <font color="red">*</font></label>
                                                        <div class="controls">
                                                            <input type="text" name="propietario_empresa"  id="propietario_empresa" placeholder="Propietario empresa" required class="campo">
                                                        </div>	
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="telefono_empresa">Telefóno: <font color="red">*</font></label>
                                                        <div class="controls">
                                                            <input type="text" name="telefono_empresa"  id="telefono_empresa" placeholder="Telefóno empresa" maxlength="10" required class="campo">
                                                        </div>	
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="pais_empresa">País: <font color="red">*</font></label>
                                                        <div class="controls">
                                                            <input type="text" name="pais_empresa"  id="pais_empresa" placeholder="País empresa" required class="campo">
                                                        </div>	
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="fax_empresa">Fax: </label>
                                                        <div class="controls">
                                                            <input type="text" name="fax_empresa"  id="fax_empresa" placeholder="Fax empresa" required class="campo">
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="pagina_empresa">Página Web: </label>
                                                        <div class="controls">
                                                            <input type="text" name="pagina_empresa"  id="pagina_empresa" placeholder="Página web empresa" required class="campo">
                                                        </div>
                                                    </div>
                                                </section>

                                                <section class="columna3_empresa">
                                                    <div class="control-group" >
                                                        <div id="logo" class="logo_empresa" title="LOGO">
                                                            <img id="foto" name="foto" style="width: 100%; height: 100%"  />
                                                        </div> 
                                                    </div>
                                                </section>
                                            </form>
                                        </fieldset>

                                        <div class="form-actions">
                                            <!--<button class="btn btn-primary" id="btnGuardar"><i class="icon-save"></i> Guardar</button>-->
                                            <button class="btn btn-primary" id='btnModificar'><i class="icon-edit"></i> Modificar</button>
                                            <button class="btn btn-primary" id='btnBuscar'><i class="icon-search"></i> Buscar</button>
                                            <button class="btn btn-primary" id='btnNuevo'><i class="icon-pencil"></i> Nuevo</button>
                                        </div>

                                        <div id="empresas" title="Búsqueda de Empresas" class="">
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
