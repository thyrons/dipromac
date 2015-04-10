$(document).on("ready", inicio);
$(function() {
    $('#main-menu').smartmenus({
        subMenusSubOffsetX: 1,
        subMenusSubOffsetY: -8
    });
});

function inicio() {
    $(window).bind('resize', function() {
        jQuery("#list").setGridWidth($('#centro').width() - 10);
    }).trigger('resize');
    jQuery("#list").jqGrid({
        url: 'xmlSectores.php',
        datatype: 'xml',
        colNames: ['Id', 'Nombre Sector', 'Dirección Sector'],
        colModel: [
            {name: 'id_sectores', index: 'id_sectores', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'nombre_sector', index: 'nombre_sector', editable: true, align: 'left', width: '500', search: true, frozen: true, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}},
            {name: 'direccion_sector', index: 'direccion_sector', editable: true, align: 'left', width: '490', search: true, frozen: true, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}},
        ],
        rowNum: 10,
        rowList: [10, 20, 30],
        height: 255,
        pager: jQuery('#pager'),
        editurl: "sectores.php",
        sortname: 'id_sectores',
        shrinkToFit: false,
        sortordezr: 'asc',
        caption: 'Lista Sectores',
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

