<?php
    session_start();
    include '../../menus/menu.php';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>.:PROVEEDORES:.</title>
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

        <script type="text/javascript" src="../../js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.js"></script>
        <script type="text/javascript" src="../../js/jquery-loader.js"></script>
        <!--<script type="text/javascript" src="../../js/jquery-1.10.2.js"></script>-->
        <script type="text/javascript" src="../../js/jquery-ui-1.10.4.custom.min.js"></script>
        <script type="text/javascript" src="../../js/grid.locale-es.js"></script>
        <script type="text/javascript" src="../../js/jquery.jqGrid.src.js"></script>
        <script type="text/javascript" src="../../js/buttons.js" ></script>
        <script type="text/javascript" src="../../js/validCampoFranz.js" ></script>
        <script type="text/javascript" src="proveedores.js"></script>
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
                                    <h3>PROVEEDORES</h3>
                                </div> <!-- /widget-header -->

                                <div class="widget-content">
                                    <div class="tabbable">
                                    <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#formcontrols" data-toggle="tab">Generales</a>
                                            </li>
                                            <li ><a href="#jscontrols" data-toggle="tab">Adicionales</a></li>
                                        </ul>
                                        <fieldset>
                                            <form class="form-horizontal" id="proveedores_form" name="proveedores_form" method="post">
                                            <div class="tab-content">
                                              <div class="tab-pane active" id="formcontrols">
                                                <div class="span6">
                                                    <div class="control-group">
                                                        <label class="control-label" for="tipo_docu">Tipo Documento: <font color="red">*</font></label>
                                                        <div class="controls" >
                                                            <select name="tipo_docu" id="tipo_docu" required class="span4">
                                                                <!-- <option value="">......Seleccione......</option> -->
                                                                <option value="Cedula">Cedula</option>
                                                                <option value="Ruc">Ruc</option>
                                                                <option value="Pasaporte">Pasaporte</option>
                                                            </select>
                                                        </div> 
                                                    </div>  

                                                    <div class="control-group">
                                                        <label class="control-label" for="empresa_pro">Empresa: <font color="red">*</font></label>
                                                        <div class="controls">
                                                            <input type="text" name="empresa_pro"  id="empresa_pro" placeholder="Nombre de la Empresa" required class="span4"/>
                                                        </div>  
                                                    </div> 

                                                    <div class="control-group">
                                                        <label class="control-label" for="visitador">Visitador:</label>
                                                        <div class="controls">
                                                            <input type="text" name="visitador" id="visitador" placeholder="Empleado Empresa" required  class="span4"/>
                                                        </div>   
                                                    </div> 

                                                    <div class="control-group">
                                                        <label class="control-label" for="nro_telefono">Nro. Telefónico: <font color="red">*</font></label>
                                                        <div class="controls">
                                                            <input type="tel" name="nro_telefono" id="nro_telefono" placeholder="062-999-999" maxlength="10" class="span4"/>
                                                        </div>   
                                                    </div> 

                                                    <div class="control-group">
                                                        <label class="control-label" for="correo">E-mail: <font color="red">*</font></label>
                                                        <div class="controls">
                                                            <input type="text" name="correo" id="correo" placeholder="xxxx@example.com" class="span4"/>
                                                        </div>  
                                                    </div> 

                                                    <div class="control-group">
                                                        <label class="control-label" for="pais_pro">País: <font color="red">*</font></label>
                                                        <div class="controls">
                                                            <input type="text" name="pais_pro" id="pais_pro" required  class="span4"/>
                                                        </div>  
                                                    </div> 

                                                    <div class="control-group">
                                                        <label class="control-label" for="forma_pago">Formas de Pago: <font color="red">*</font></label>
                                                        <div class="controls" >
                                                            <select name="forma_pago" id="forma_pago" required class="span4">
                                                                <option value="Contado" selected>Contado</option>
                                                                <option value="Credito">Credito</option>
                                                            </select>
                                                        </div>  
                                                    </div> 
                                                    
                                                    <div class="control-group">
                                                        <label class="control-label" for="observaciones_pro">Comentario:</label>
                                                        <div class="controls" >
                                                            <textarea name="observaciones_pro" id="observaciones_pro" rows="3" class="span4"></textarea>
                                                        </div>  
                                                  </div>
                                                </div>  

                                                <div class="span6">
                                                    <div class="control-group">											
                                                        <label class="control-label" for="ruc_ci">RUC/CI: <font color="red">*</font></label>
                                                        <div class="controls">
                                                            <input type="text" name="ruc_ci"  id="ruc_ci" placeholder="10000000000" required class="span4"  />
                                                            <input type="hidden" name="id_proveedor"  id="id_proveedor" readonly class="campo" >
                                                        </div>	
                                                    </div>

                                                    <div class="control-group">											
                                                        <label class="control-label" for="representante_legal">Representante Legal: </label>
                                                        <div class="controls">
                                                            <input type="text" name="representante_legal" id="representante_legal" placeholder="Representante Legal" required class="span4"  />
                                                        </div>
                                                    </div>

                                                    <div class="control-group">											
                                                        <label class="control-label" for="direccion_pro">Dirección: <font color="red">*</font></label>
                                                        <div class="controls">
                                                            <input type="text"  name="direccion_pro" id="direccion_pro" placeholder="Dirección de la Empresa" required class="span4" />
                                                        </div>
                                                    </div>

                                                    <div class="control-group">											
                                                        <label class="control-label" for="nro_celular">Nro. de Celular:</label>
                                                        <div class="controls">
                                                            <input type="tel" name="nro_celular" id="nro_celular" maxlength="10" placeholder="09-9999-999" class="span4"/>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="fax">Fax: </label>
                                                        <div class="controls">
                                                            <input type="text" name="fax" id="fax" class="span4" />
                                                        </div>
                                                    </div>

                                                    <div class="control-group">											
                                                        <label class="control-label" for="ciudad_pro">Ciudad: <font color="red">*</font> </label>
                                                        <div class="controls">
                                                            <input type="text" name="ciudad_pro" id="ciudad_pro" required class="span4"/>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">											
                                                        <label class="control-label" for="principal_pro">Proveedor Principal: <font color="red">*</font></label>
                                                        <div class="controls">
                                                            <select name="principal_pro" id="principal_pro" required class="span4">
                                                                <option value="Si" selected>Si</option>
                                                                <option value="No">No</option>
                                                            </select>
                                                        </div>			
                                                    </div>

                                                    <div class="control-group">                                         
                                                        <label class="control-label" for="principal_pro">Tipo: <font color="red">*</font></label>
                                                        <div class="controls">
                                                            <select name="principal_pro" id="principal_pro" required class="span4">
                                                                <option value="N" selected>Persona Natural</option>
                                                                <option value="J">Persona Jurídica</option>
                                                            </select>
                                                        </div>          
                                                    </div>
                                                  </div>
                                                </div>

                                                <div class="tab-pane" id="jscontrols">
                                                <div class="span6">
                                                 <div class="control-group">                                           
                                                        <label class="control-label" for="cupo_credito">Cupo de Crédito:</label>
                                                        <div class="controls">
                                                             <input type="text" name="cupo_credito" id="cupo_credito" class="span3" value="0.00" />
                                                        </div>
                                                  </div>
                                                  <hr>

                                                 <div class="control-group">                                            
                                                    <label class="control-label">Se aplica impto a las compras.</label>
                                                    <div class="controls">
                                                    <label class="radio inline">
                                                      <input type="radio"  name="radiobtns">Si
                                                    </label>
                                                    
                                                    <label class="radio inline">
                                                      <input type="radio" name="radiobtns">No
                                                    </label>
                                                  </div>    <!-- /controls -->          
                                                </div> <!-- /control-group -->

                                                <div class="control-group">                                            
                                                    <label class="control-label">Se aplica retención en el impto.</label>
                                                    <div class="controls">
                                                    <label class="radio inline">
                                                      <input type="radio"  name="radiobtns">Si
                                                    </label>
                                                    
                                                    <label class="radio inline">
                                                      <input type="radio" name="radiobtns">No
                                                    </label>
                                                  </div>    <!-- /controls -->          
                                                </div> <!-- /control-group -->

                                                <div class="control-group">                                            
                                                    <label class="control-label">Se aplica retención en la fuente.</label>
                                                    <div class="controls">
                                                    <label class="radio inline">
                                                      <input type="radio"  name="radiobtns">Si
                                                    </label>
                                                    
                                                    <label class="radio inline">
                                                      <input type="radio" name="radiobtns">No
                                                    </label>
                                                  </div>    <!-- /controls -->          
                                                </div> <!-- /control-group -->

                                                <div class="control-group">                                            
                                                    <label class="control-label">Se aplica un segundo impto.</label>
                                                    <div class="controls">
                                                    <label class="radio inline">
                                                      <input type="radio"  name="radiobtns">Si
                                                    </label>
                                                    
                                                    <label class="radio inline">
                                                      <input type="radio" name="radiobtns">No
                                                    </label>
                                                  </div>    <!-- /controls -->          
                                                </div> <!-- /control-group -->
                                               </div>
                                                
                                                <div class="span6">
                                                  <div class="control-group">
                                                    <label class="control-label" for="cuenta_contable">Cuenta Contable:</label>
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
                                            </form>
                                        </fieldset>  

                                        <div class="form-actions">
                                            <button class="btn btn-primary" id='btnGuardar'><i class="icon-save"></i> Guardar</button>
                                            <button class="btn btn-primary" id='btnModificar'><i class="icon-edit"></i> Modificar</button>
                                            <button class="btn btn-primary" id='btnEliminar'><i class="icon-remove"></i> Eliminar</button>
                                            <button class="btn btn-primary" id='btnBuscar'><i class="icon-search"></i> Buscar</button>
                                            <button class="btn btn-primary" id='btnNuevo'><i class="icon-pencil"></i> Nuevo</button>
                                        </div>

                                        <div id="proveedores" title="Búsqueda de Proveedores" class="">
                                            <table id="list"><tr><td></td></tr></table>
                                            <div id="pager"></div>
                                        </div>

                                        <div id="cuentas" title="Búsqueda Plan de Cuentas" class="">
                                            <table id="list2"><tr><td></td></tr></table>
                                            <div id="pager2"></div>
                                        </div>

                                        <div id="clave_permiso" title="PERMISOS">
                                            <table border="0" >
                                                <tr>
                                                    <td><label>Ingese la clave de seguridad</label></td> 
                                                    <td><input type="password" name="clave" id="clave" class="campo"></td>
                                                </tr>  
                                            </table>
                                            <div class="form-actions" align="center">
                                                <button class="btn btn-primary" id='btnAcceder'><i class="icon-ok"></i> Acceder</button>
                                                <button class="btn btn-primary" id='btnCancelar'><i class="icon-remove-sign"></i> Cancelar</button>
                                            </div>
                                        </div> 

                                        <div id="seguro">
                                            <label>Esta seguro de eliminar al cliente</label>  
                                            <br />
                                            <button class="btn btn-primary" id='btnAceptar'><i class="icon-ok"></i> Aceptar</button>
                                            <button class="btn btn-primary" id='btnSalir'><i class="icon-remove-sign"></i> Cancelar</button>
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
                            &copy; 2015 <a href=""> <?php echo $_SESSION['empresa']; ?></a>.
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </body>
</html>