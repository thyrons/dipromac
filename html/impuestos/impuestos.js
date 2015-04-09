$(document).on("ready", inicio);

$(function() {
    $('#main-menu').smartmenus({
        subMenusSubOffsetX: 1,
        subMenusSubOffsetY: -8
    });
});

function openPDF(){
window.open('../../ayudas/ayuda.pdf');
}

function punto() {
    var key;
    if (window.event)
    {
        key = event.keyCode;
    } else if (event.which)
{
        key = event.which;
    }

    if (key < 48 || key > 57)
    {
        if (key === 46 || key === 8)
        {
            return true;
        } else {
            return false;
        }
    }
    return true;
}

function guardar(){
if($("#abreviatura").val() == ""){
   $("#abreviatura").focus();
   alertify.error('Ingrese la Abreviatura');
}else{
  if($("#descripcion").val() == ""){
    $("#descripcion").focus();
    alertify.error('Ingrese la Descripción');
}else{
   if($("#valor").val() == ""){
    $("#valor").focus();
    alertify.error('Ingrese un Valor');
}else{
 $.ajax({
        url: 'procesoImpuestos.php',
        type: 'POST',
        data: $("#impuesto_form").serialize()+"&oper="+'add',
        success: function(data) {
        var val = data;
        if (val == 1) {
            alertify.success('Datos Agregados Correctamente');     
            setTimeout(function() {
                location.reload();
            }, 1000);
        } else {
        if (val == 3) {
            $("#descripcion").focus();
            alertify.error('El impuesto ya esta agregado');   
         }
        }
       }
      });
     } 
   }
  }
}

function modificar(){
if($("#id_impuestos").val() == ""){
   $("#id_impuestos").focus();
   alertify.error('Seleccione un impuesto');
}else{    
if($("#abreviatura").val() == ""){
   $("#abreviatura").focus();
   alertify.error('Ingrese la Abreviatura');
}else{
  if($("#descripcion").val() == ""){
    $("#descripcion").focus();
    alertify.error('Ingrese la Descripción');
}else{
   if($("#valor").val() == ""){
    $("#valor").focus();
    alertify.error('Ingrese un Valor');
}else{
 $.ajax({
        url: 'procesoImpuestos.php',
        type: 'POST',
        data: $("#impuesto_form").serialize()+"&oper="+'edit',
        success: function(data) {
        var val = data;
        if (val == 2) {
            alertify.success('Datos Modificados Correctamente');     
            setTimeout(function() {
                location.reload();
            }, 1000);
        } else {
            if (val == 3) {
                alertify.error('El impuesto ya esta agregado');   
            }
        }
       }
      });
     } 
   }
  }
}
}

function nuevo() {
    location.reload();
}

function inicio() {

    alertify.set({ delay: 1000 });   

    $("#valor").on("keypress",punto);

     $("#btnGuardar").click(function(e) {
        e.preventDefault();
    });
    $("#btnModificar").click(function(e) {
        e.preventDefault();
    });
    $("#btnBuscar").click(function(e) {
        e.preventDefault();
    });
    $("#btnEliminar").click(function(e) {
        e.preventDefault();
    });
    $("#btnNuevo").click(function(e) {
        e.preventDefault();
    });
    $("#btnCuenta").click(function(e) {
        e.preventDefault();
    });

    $("#btnGuardar").on("click", guardar);
    $("#btnModificar").on("click", modificar);
    $("#btnNuevo").on("click", nuevo);

    $(window).bind('resize', function() {
        jQuery("#list").setGridWidth($('#centro').width() - 10);
    }).trigger('resize');
    jQuery("#list").jqGrid({
        url: 'xmlImpuestos.php',
        datatype: 'xml',
        colNames: ['Cod', 'Abreviatura', 'Descripción','Valor en %'],
        colModel: [
            {name: 'id_impuestos', index: 'id_impuestos',hidden: true, editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'abreviatura', index: 'abreviatura', editable: true, align: 'center', width: '100', search: true, frozen: true, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}},
            {name: 'descripcion', index: 'descripcion', editable: true, align: 'center', width: '260', search: true, frozen: true, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}},
            {name: 'valor', index: 'valor', editable: true, align: 'center', width: '140', search: false, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}, editoptions:{maxlength: 10, size:20,dataInit: function(elem){$(elem).bind("keypress", function(e) {return Valida_punto(e)})}}}, 
        ],
        rowNum: 10,
        rowList: [10, 20, 30],
        height: 255,
        pager: jQuery('#pager'),
        // editurl: "procesoImpuestos.php",
        sortname: 'id_impuestos',
        shrinkToFit: false,
        sortordezr: 'asc',
        caption: 'Lista Impuestos',
        viewrecords: true,
        ondblClickRow: function(){
            var id = jQuery("#list").jqGrid('getGridParam', 'selrow');
            jQuery('#list').jqGrid('restoreRow', id);
            var ret = jQuery("#list").jqGrid('getRowData', id);
            $("#id_impuestos").val(ret.id_impuestos);
            $("#abreviatura").val(ret.abreviatura);
            $("#descripcion").val(ret.descripcion);
            $("#valor").val(ret.valor);
            $("#btnGuardar").attr("disabled", true);
        }
     }).jqGrid('navGrid', '#pager',
            {
                add: false,
                edit: false,
                del: false,
                refresh: true,
                search: true,
                view: true,
                addtext: "Nuevo",
                edittext: "Modificar",
                // refreshtext: "Recargar",
                // viewtext: "Consultar"
            },
    {
        recreateForm: true, closeAfterEdit: true, checkOnUpdate: true, reloadAfterSubmit: true, closeOnEscape: true
    },
    {
        reloadAfterSubmit: true, closeAfterAdd: true, checkOnUpdate: true, closeOnEscape: true,
        bottominfo: "Los campos marcados con (*) son obligatorios", width: 350, checkOnSubmit: false
    },
    {
        width: 300, closeOnEscape: true
    },
    {
        closeOnEscape: true,
        multipleSearch: false, overlay: false
    },
    {
        closeOnEscape: true,
        width: 400
    },
    {
        closeOnEscape: true
    });
    jQuery("#list").setGridWidth($('#centro').width() - 10);
}
function Defecto(e) {
    e.preventDefault();
}

