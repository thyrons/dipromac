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

function Valida_punto() {
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

function inicio() {
    $(window).bind('resize', function() {
        jQuery("#list").setGridWidth($('#centro').width() - 10);
    }).trigger('resize');
    jQuery("#list").jqGrid({
        url: 'xmlRetencionFuente.php',
        datatype: 'xml',
        colNames: ['Cod', 'Abreviatura', 'Descripción','Valor en %','Valor Base $'],
        colModel: [
            {name: 'id_retencion_fuentes', index: 'id_retencion_fuentes', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'abreviatura', index: 'abreviatura', editable: true, align: 'center', width: '300', search: true, frozen: true, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}},
            {name: 'descripcion', index: 'descripcion', editable: true, align: 'center', width: '350', search: true, frozen: true, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}},
            {name: 'valor', index: 'valor', editable: true, align: 'center', width: '140', search: false, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}, editoptions:{maxlength: 10, size:20,dataInit: function(elem){$(elem).bind("keypress", function(e) {return Valida_punto(e)})}}}, 
            {name: 'valor_base', index: 'valor_base', editable: true, align: 'center', width: '140', search: false, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}, editoptions:{maxlength: 10, size:20,dataInit: function(elem){$(elem).bind("keypress", function(e) {return Valida_punto(e)})}}}, 
        ],
        rowNum: 10,
        rowList: [10, 20, 30],
        height: 255,
        pager: jQuery('#pager'),
        editurl: "procesoRetencionFuente.php",
        sortname: 'id_retencion_fuentes',
        shrinkToFit: false,
        sortordezr: 'asc',
        caption: 'Lista Retenciones',
        viewrecords: true
     }).jqGrid('navGrid', '#pager',
            {
                add: true,
                edit: true,
                del: false,
                refresh: true,
                search: true,
                view: true,
                addtext: "Nuevo",
                edittext: "Modificar",
                refreshtext: "Recargar",
                viewtext: "Consultar"
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

