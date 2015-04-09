$(document).on("ready", inicio);

function openPDF(){
window.open('../../ayudas/ayuda.pdf');
}

$(function() {
    $('#main-menu').smartmenus({
        subMenusSubOffsetX: 1,
        subMenusSubOffsetY: -8
    });
});

function numeros(e) { 
tecla = (document.all) ? e.keyCode : e.which;
if (tecla==8) return true;
patron = /\d/;
te = String.fromCharCode(tecla);
return patron.test(te);
}

function recargar(){
    if($("#total_caja").val() == ""){
        alert("Ingrese Monto en Caja");
    }else{
alert("Cierre de Caja Guardado correctamente");
location.reload();
}
}

function inicio() {
     ///////////////////llamar egresos primera parte/////
    $.getJSON('retornar_total.php', function(data) {
        var tama = data.length;
        if (tama !== 0) {
            for (var i = 0; i < tama; i = i + 1) {
                $("#total").val(data[i]);
            }
        }
    });
    /////////////////////////////////////////////////// 

     $("#btnCierre").click(function(e) {
        e.preventDefault();
    });
     
     $("#btnCierre").on("click", recargar);


    $(window).bind('resize', function() {
        jQuery("#list").setGridWidth($('#centro').width() - 10);
    }).trigger('resize');
   ////////////////////buscador facturas ventas/////////////////////////
        jQuery("#list").jqGrid({
        url: 'xmlBuscarFacturaVenta2.php',
        datatype: 'xml',
        colNames: ['ID','IDENTIFICACIÓN','CLIENTE', 'FACTURA NRO.','FECHA','MONTO TOTAL','SALDO RESTANTE'],
        colModel: [
            {name: 'id_factura_venta', index: 'id_factura_venta', editable: false, search: false, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 50},
            {name: 'identificacion', index: 'identificacion', editable: false, search: true, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 150},
            {name: 'nombres_cli', index: 'nombres_cli', editable: true, search: true, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 200},
            {name: 'num_factura', index: 'num_factura', editable: true, search: true, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 200},
            {name: 'fecha_actual', index: 'fecha_actual', editable: true, search: false, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 100},
            {name: 'total_venta', index: 'total_venta', editable: true, search: false, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 120},
            {name: 'total_gasto', index: 'total_gasto', editable: true, search: false, hidden: true, editrules: {edithidden: false}, align: 'center',frozen: true, width: 140}
        ],
        rowNum: 30,
        width: 800,
        height:220,
        sortable: true,
        rowList: [10, 20, 30],
        pager: jQuery('#pager'),
        sortname: 'id_factura_venta',
        sortorder: 'asc',
        viewrecords: true,              
        ondblClickRow: function(){
        // var id = jQuery("#list").jqGrid('getGridParam', 'selrow');
        // jQuery('#list2').jqGrid('restoreRow', id);
        // var ret = jQuery("#list").jqGrid('getRowData', id); 
        
        // if(parseFloat(ret.total_gasto) <= parseFloat(0.00)){
        //    alertify.alert("Factura al limite");   
        // }else{
        //     $("#ingreso_gastos").dialog("open"); 
        // }
    }
        }).jqGrid('navGrid', '#pager',
        {
            add: false,
            edit: false,
            del: false,
            refresh: true,
            search: true,
            view: true
        },{
            recreateForm: true, closeAfterEdit: true, checkOnUpdate: true, reloadAfterSubmit: true, closeOnEscape: true
        },
        {
            reloadAfterSubmit: true, closeAfterAdd: true, checkOnUpdate: true, closeOnEscape: true,
            bottominfo: "Todos los campos son obligatorios son obligatorios"
        },
        {
            width: 300, closeOnEscape: true
        },
        {
            closeOnEscape: true,        
            multipleSearch: false, overlay: false
        },
        {
        },
        {
            closeOnEscape: true
        });
        
       jQuery("#list2").jqGrid('navButtonAdd', '#pager', {caption: "Añadir",
       
});
jQuery("#list").setGridWidth($('#centro').width() - 10);
}

function Defecto(e) {
    e.preventDefault();
}

