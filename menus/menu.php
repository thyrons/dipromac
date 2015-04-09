<?php

if (empty($_SESSION['id'])) {
    header('Location: ../index.php');
}

function menu_1() {
    print(' <ul id="main-menu" class="sm sm-blue">
            <li><a href="../html/principal.php" target="_parent" class="inicio"><i class="icon-home"></i> Inicio</a></li>
            <li><a href="" target="_parent"> <i class="icon-th-large"></i> Ingresos</a>
                <ul>
                  <li><a href="" target="_parent">Parámetros</a>
                      <ul>
                          <li><a href="" target="_parent">Facturación</a>
                            <ul>
                              <li><a href="../impuestos" target="_blank">Impuestos Ventas/Compras</a>
                              <li><a href="../retenciones" target="_blank">Retención en Impuesto</a>
                              <li><a href="../retenciones_fuente" target="_blank">Retención en Fuente</a>
                              <li><a href="../segundo_impuesto" target="_blank">Segundo Impuesto Ventas/Compras</a>
                            </ul>
                          </li>

                          <li><a href="" target="_parent">Inventario</a>
                            <ul>
                              <li><a href="../bodegas" target="_blank">Bodegas</a>
                              <li><a href="../categorias" target="_blank">Categorias</a>
                              <li><a href="../marcas" target="_blank">Marcas</a>
                              <li><a href="../medida" target="_blank">Unidades Productos</a>
                            </ul>
                          </li>
                          
                          <li><a href="" target="_parent">Importar</a>
                            <ul>
                              <li><a href="../cargarProductos" target="_blank">Cargar Productos</a></li>
                              <li><a href="../planCuentas" target="_blank">Cargar Plan Cuentas</a></li>
                            </ul>
                          </li>
                      </ul>
                    </li>
                    <li><a href="../asignacion_cuentas" target="_blank">Asignación Cuentas</a></li>
                    <li><a href="../usuarios" target="_blank">Usuarios</a></li>
                    <li><a href="../proveedores"target="_blank">Proveedores</a></li>
                    <li><a href="../clientes" target="_blank">Clientes</a></li>
                    
                    <li><a href="../productos" target="_blank">Productos</a></li>
                    
                </ul>
            </li>
            
            <li><a href="" target="_parent"><i class="icon-book"></i> Procesos</a>
                <ul>
                    <li><a href="../inventario" target="_blank">Inventario</a></li>
                    <li><a href="../proformas" target="_blank">Proformas</a></li>
                    <li><a href="" target="_parent">Compras</a>
                        <ul>
                            <li><a href="../factura_compra" target="_blank">Productos Bodega</a></li>
                            <li><a href="../devolucion_compra" target="_blank">Devolución Compra</a></li>
                        </ul>
                    </li>
                    <li><a href="" target="_parent">Ventas</a>
                        <ul>
                            <li><a href="../factura_venta" target="_blank">Ventas facturación</a></li>
                            <li><a href="../notas_credito" target="_blank">Notas de crédito</a></li>
                        </ul>
                    </li>

                    <li><a href="" target="_parent">Cartera</a>
                        <ul>
                            <li><a href="../cuentas_cobrar" target="_blank">Cuentas por cobrar</a></li>
                            <li><a href="../cuentas_pagar" target="_blank">Cuentas por pagar</a></li>
                            <li><a href="" target="_blank">Externas</a>
                            <ul>
                            <li><a href="../cxc_externa" target="_blank">Cuentas por cobrar</a></li>
                            <li><a href="../cxp_externa" target="_blank">Cuentas por pagar</a></li>
                            </ul>
                           </li>
                        </ul>
                    </li>
                    <li><a href="" target="_parent">Transferencias</a>
                        <ul>
                            <li><a href="../ingresos" target="_blank">Ingresos</a></li>
                            <li><a href="../egresos.php" target="_blank">Egresos</a></li>
                        </ul>
                    </li>
                    <li><a href="../registro_gastos.php" target="_blank">Registro Gastos</a></li>
                    <li><a href="../gastos" target="_blank">Gastos Internos</a></li>
                </ul>
            </li>

            <li><a href="" target="_parent"><i class="icon-book"></i> Contabilidad</a>
                <ul>
                    <li><a href="../plan_cuentas" target="_blank">Plan de Cuentas</a></li>
                    <li><a href="../transacciones" target="_blank">Transacciones</a></li>
                    <li><a href="../kardex" target="_blank">Kardex</a></li>
                    <li><a href="../libro_diario" target="_blank">Libro Diario</a></li>
                    <li><a href="" target="_parent">Bancos</a>
                        <ul>
                            <li><a href="../bancos" target="_blank">Catalogo Bancos</a></li>
                            <li><a href="../conciliacion" target="_blank">Conciliación</a></li>
                        </ul>
                    </li>
                    <li><a href="" target="_parent">Cierre de Caja</a>
                        <ul>
                            <li><a href="../cierre_caja" target="_blank">Contado</a></li>
                            
                        </ul>
                    </li>
                </ul>
            </li>

            <!--<li><a href="" target="_parent"><i class="icon-book"></i> Mantenimiento</a>
                <ul>
                    <li><a href="../registro_equipo" target="_blank">Registro Equipos</a></li>
                    <li><a href="../reparacion_equipo" target="_blank">Reparación Equipos</a></li>
                    <li><a href="../entrega_equipo" target="_blank">Entrega Equipos</a></li>
                    <li><a href="../reestablecer" target="_blank">Reestablecer</a></li>
                </ul>
            </li>-->

            
            <li><a href="" target="_parent"><i class="icon-print"></i> Reportes</a>
                <ul>
                    <li><a href="" target="_parent">Productos</a>
                        <ul>
                            <li><a href="" id="producto_general">Lista precios en general</a></li>
                            <li><a href="" id="producto_marca_categoria">Lista precios por Categorias y Marcas</a></li>
                            <li><a href="" id="producto_existencia_minima">Productos existencia mínima</a></li>
                        </ul>
                   </li>
                   <li><a href="" target="_parent">Compras</a>
                        <ul>
                            <li><a href="">Resumen de compras locales</a>
                               <ul>
                                  <li><a href="" id="agrupados_proveedor">Agrupados por proveedor</a></li>
                                  <li><a href="" id="reporte_factura_compra">Facturas</a></li>
                                  <li><a href="" id="reporte_dev_compras">Devoluciones en compras</a></li>
                                  <li><a href="" id="resumenFacturas">Facturas por proveedor</a></li>
                                  <li><a href="" id="resumenFacturasCompras">Facturas Agrupadas</a></li>
                                  
                               </ul>
                            </li>
                        </ul>
                   </li>
                   <li><a href="" target="_parent">Ventas</a>
                        <ul>
                            <li><a href="" target="_parent">Flujo de caja</a>
                               <ul>
                                  <li><a href="" id="ventaGeneralClientes">Resumen de venta general por clientes</a></li>
                                  <li><a href="" id="ventaGeneral">Resumen de venta general</a></li>
                                  <li><a href="" id="diario_caja">Diario de caja</a></li>
                               </ul>
                            </li>
                            <li><a href="" target="_parent">Resumen de:</a>
                               <ul>
                                  <li><a href="" id="reporte_factura_venta">Facturas y notas de ventas</a></li>
                                  <li><a href="" id="reporte_facturas_notas_anuladas">Facturas y notas de venta anuladas</a></li>
                                  <li><a href="" id="reporte_nota_credito">Notas de crédito (NC)</a></li>
                                  <!--<li><a href="">Facturas y notas de venta por producto</a></li>-->
                                  <li><a href="" id="reporte_general">General de facturas y notas de venta</a></li>
                               </ul>
                            </li>
                            <li><a href="" id="reporte_utilidad_producto">Utilidad por producto</a></li>
                            <li><a href="" id="reporte_utilidad_factura">Utilidad por factura</a></li>
                            <li><a href="" id="reporte_utilidad_factura_general">Utilidad General de facturas</a></li>
                            <li><a href="" id="buscar_serie">Buscar por nro de serie</a></li>
                        </ul>
                   </li>
                   <li><a href="" target="_parent">Cartera</a>
                        <ul>
                            <!--<li><a href="">Estados de cuentas proveedores locales</a></li>
                            <li><a href="">Estados de cuentas de clientes</a></li>-->
                            <li><a href="">Cuentas por cobrar</a>
                               <ul>
                                  <li><a href="" id="facturas_canceladas">Listado de facturas canceladas</a></li>
                                  <li><a href="" id="facturas_cobrar_clientes" >Listado de facturas por cobrar</a></li>
                                  <li><a href="" id="cobros_realizados">Cobros realizados</a></li>
                               </ul>
                            </li>
                            
                           <li><a href="" target="_parent">Cuentas por pagar</a>
                               <ul>
                                  <li><a href="" id="facturas_canceladas_proveedor">Listado de facturas canceladas</a></li>
                                  <li><a href="" id="facturas_pagar_proveedor" >Listado de facturas por pagar</a></li>
                                  <li><a href="" id="pagos_realizados">Pagos realizados</a></li>
                               </ul>
                            </li>
                        </ul>
                   </li>
                   <!--<li><a href="" target="_parent">Proformas</a>
                        <ul>
                            <li><a href="" target="_parent" id="proformas">Proformas</a></li>
                            <li><a href="" id="lista_proformas">Lista de Proformas</a></li>
                        </ul>
                  </li> --> 
                  <li><a href="" target="_parent">Gastos</a>
                      <ul>
                        <li><a href="" id="gastos">Gastos por factura</a></li> 
                        <li><a href="" id="gastos_general">Gastos general</a></li>         
                        <li><a href="" id="gastos_internos">Gastos Internos Fechas</a></li>         
                      </ul>
                  </li> 
                </ul>
            </li>
           
            <li><a href="" target="_parent"><i class="icon-bookmark"></i> Bienvenido</a>
                <ul>
                    <li><a href="" class="disabled">' . $_SESSION['nombres'] . '</a></li>
                    <li><a href="../configuracion" target="_blank">Modificar</a></li>
                    <li><a href="../index.php">Salir</a></li>
                </ul>
            </li>

            <li><a href="" target="_parent">Ayuda</a>
              <ul>
                <li><a href="" onClick="openPDF()" >Generar</a></li>      
              </ul>
          </li> 

        </ul>');
}

function menu_2() {
           print(' <ul id="main-menu" class="sm sm-blue">
            <li><a href="../html/principal.php" target="_parent" class="inicio"><i class="icon-home"></i> Inicio</a></li>
            <li><a href="" target="_parent"> <i class="icon-th-large"></i> Ingresos</a>
                <ul>
                    <li><a href="../html/clientes.php" target="_blank">Clientes</a></li>
                    <li><a href="../html/proveedores.php"target="_blank">Proveedores</a></li>
                    <li><a href="../html/productos.php" target="_blank">Productos</a></li>
                    <li><a href="" target="_parent">Clasificacion</a>
                    <ul>
                          <li><a href="../html/categorias.php" target="_blank">Categorias</a></li>
                          <li><a href="../html/marcas.php" target="_blank">Marcas</a></li>
                    </ul>
                    </li>
                </ul>
            </li>
            
            <li><a href="" target="_parent"><i class="icon-book"></i> Procesos</a>
                <ul>
                    <li><a href="../html/inventario.php" target="_blank">Inventario</a></li>
                    <!--<li><a href="../html/proformas.php" target="_blank">Proformas</a></li>-->
                    <li><a href="" target="_parent">Compras</a>
                        <ul>
                            <li><a href="../html/factura_compra.php" target="_blank">Productos Bodega</a></li>
                            <li><a href="../html/devolucionCompra.php" target="_blank">Devolución Compra</a></li>
                        </ul>
                    </li>
                    <li><a href="" target="_parent">Ventas</a>
                        <ul>
                            <li><a href="../html/factura_venta.php" target="_blank">Ventas facturación</a></li>
                            <!--<li><a href="../html/notasCredito.php" target="_blank">Notas de crédito</a></li>-->
                        </ul>
                    </li>
                     <li><a href="" target="_parent">Cartera</a>
                        <ul>
                            <li><a href="../html/cuentasCobrar.php" target="_blank">Cuentas por cobrar</a></li>
                            <li><a href="../html/cuentasPagar.php" target="_blank">Cuentas por pagar</a></li>
                            <li><a href="" target="_blank">Externas</a>
                            <ul>
                            <li><a href="../html/CxCexternas.php" target="_blank">Cuentas por cobrar</a></li>
                            <li><a href="../html/CxPexternas.php" target="_blank">Cuentas por pagar</a></li>
                            </ul>
                           </li>
                        </ul>
                    </li>
                    <li><a href="../html/registroGastos.php" target="_blank">Registro Gastos</a></li>
                    <li><a href="../html/gastos.php" target="_blank">Gastos Internos</a></li>
                </ul>
            </li>

            <li><a href="" target="_parent"><i class="icon-book"></i> Contabilidad</a>
                <ul>
                    <li><a href="../html/plan_cuentas.php" target="_blank">Plan de Cuentas</a></li>
                    <li><a href="../html/transacciones.php" target="_blank">Transacciones</a></li>
                    <li><a href="../html/kardex.php" target="_blank">Kardex</a></li>
                    <li><a href="../html/libro_diario.php" target="_blank">Libro Diario</a></li>
                    <li><a href="" target="_parent">Bancos</a>
                        <ul>
                            <li><a href="../html/bancos.php" target="_blank">Catalogo Bancos</a></li>
                            <li><a href="../html/cuentasPagar.php" target="_blank">Conciliación</a></li>
                        </ul>
                    </li>
                    <li><a href="" target="_parent">Cierre de Caja</a>
                        <ul>
                            <li><a href="../html/bancos.php" target="_blank">Contado</a></li>
                            <li><a href="../html/cuentasPagar.php" target="_blank">Crédito</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            
            <li><a href="" target="_parent"><i class="icon-print"></i> Reportes</a>
                <ul>
                    <li><a href="" target="_parent">Productos</a>
                        <ul>
                            <li><a href="" id="producto_general">Lista precios en general</a></li>
                            <li><a href="" id="producto_marca_categoria">Lista precios por Categorias y Marcas</a></li>
                            <li><a href="" id="producto_existencia_minima">Productos existencia mínima</a></li>
                        </ul>
                   </li>
                   
                   <li><a href="" target="_parent">Compras</a>
                        <ul>
                            <li><a href="">Resumen de compras locales</a>
                               <ul>
                                  <li><a href="" id="agrupados_proveedor">Agrupados por proveedor</a></li>
                                  <li><a href="" id="reporte_factura_compra">Facturas</a></li>
                                  <li><a href="" id="reporte_dev_compras">Devoluciones en compras</a></li>
                                  <li><a href="" id="resumenFacturas">Facturas por proveedor</a></li>
                                  <li><a href="" id="resumenFacturasCompras">Facturas Agrupadas</a></li>
                                  
                               </ul>
                            </li>
                        </ul>
                   </li>
                   
                   <li><a href="" target="_parent">Ventas</a>
                        <ul>
                            <li><a href="" target="_parent">Flujo de caja</a>
                               <ul>
                                  <li><a href="" id="ventaGeneralClientes">Resumen de venta general por clientes</a></li>
                                  <li><a href="" id="ventaGeneral">Resumen de venta general</a></li>
                                  <li><a href="" id="diario_caja">Diario de caja</a></li>
                               </ul>
                            </li>
                            <li><a href="" target="_parent">Resumen de:</a>
                               <ul>
                                  <li><a href="" id="reporte_factura_venta">Facturas y notas de ventas</a></li>
                                  <li><a href="" id="reporte_facturas_notas_anuladas">Facturas y notas de venta anuladas</a></li>
                                  <li><a href="" id="reporte_nota_credito">Notas de crédito (NC)</a></li>
                                  <!--<li><a href="">Facturas y notas de venta por producto</a></li>-->
                                  <li><a href="" id="reporte_general">General de facturas y notas de venta</a></li>
                               </ul>
                            </li>
                            <li><a href="" id="reporte_utilidad_producto">Utilidad por producto</a></li>
                            <li><a href="" id="reporte_utilidad_factura">Utilidad por factura</a></li>
                            <li><a href="" id="reporte_utilidad_factura_general">Utilidad General de facturas</a></li>
                            <li><a href="" id="buscar_serie">Buscar por nro de serie</a></li>
                        </ul>
                   </li>
                   
                   <li><a href="" target="_parent">Cartera</a>
                        <ul>
                            <!--<li><a href="">Estados de cuentas proveedores locales</a></li>
                            <li><a href="">Estados de cuentas de clientes</a></li>-->
                            <li><a href="">Cuentas por cobrar</a>
                               <ul>
                                  <li><a href="" id="facturas_canceladas">Listado de facturas canceladas</a></li>
                                  <li><a href="" id="facturas_cobrar_clientes" >Listado de facturas por cobrar</a></li>
                                  <li><a href="" id="cobros_realizados">Cobros realizados</a></li>
                               </ul>
                            </li>
                            
                           <li><a href="" target="_parent">Cuentas por pagar</a>
                               <ul>
                                  <li><a href="" id="facturas_canceladas_proveedor">Listado de facturas canceladas</a></li>
                                  <li><a href="" id="facturas_pagar_proveedor" >Listado de facturas por pagar</a></li>
                                  <li><a href="" id="pagos_realizados">Pagos realizados</a></li>
                               </ul>
                            </li>
                        </ul>
                   </li>
                  <!--<li><a href="" target="_parent">Proformas</a>
                        <ul>
                            <li><a href="" target="_parent" id="proformas">Proformas</a></li>
                            <li><a href="" id="lista_proformas">Lista de Proformas</a></li>
                        </ul>
                   </li>--> 
                  <li><a href="" target="_parent">Gastos</a>
                      <ul>
                        <li><a href="" id="gastos">Gastos por factura</a></li> 
                        <li><a href="" id="gastos_general">Gastos general</a></li>         
                        <li><a href="" id="gastos_internos">Gastos Internos Fechas</a></li>         
                      </ul>
                  </li> 
                </ul>
            </li>
           
            <li><a href="" target="_parent"><i class="icon-bookmark"></i> Bienvenido</a>
                <ul>
                    <li><a href="" class="disabled">' . $_SESSION['nombres'] . '</a></li>
                    <li><a href="../html/index.php">Salir</a></li>
                </ul>
            </li>
            
            <li><a href="" target="_parent"><i class="icon-warning-sign"></i> Ayuda</a>
                <ul class="mega-menu">
                    <li>
                        <!-- The mega drop down contents -->
                        <div style="width:400px;max-width:100%;">
                            <div style="padding:1px 10px;">
                              <li><a href="../procesos/backup.php" id="">Respaldo de la base de datos</a></li>     
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>');
}
?>


