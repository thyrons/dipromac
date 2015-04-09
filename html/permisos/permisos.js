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

function numeros(e) { 
tecla = (document.all) ? e.keyCode : e.which;
if (tecla==8) return true;
patron = /\d/;
te = String.fromCharCode(tecla);
return patron.test(te);
}

function inicio() {
    $(window).bind('resize', function() {
        jQuery("#list").setGridWidth($('#centro').width() - 10);
    }).trigger('resize');
    jQuery("#list").jqGrid({
        url: 'xmlPermisos.php',
        datatype: 'xml',
        colNames: ['CÓDIGO', 'DESCRICIÓN'],
        colModel: [
            {name: 'id_permisos', index: 'id_permisos', editable: true, align: 'center', width: '100', search: false, frozen: true, editoptions: {readonly: 'readonly'}},
            {name: 'descripcion', index: 'descripcion', editable: true, align: 'center', width: '300', size: '10', search: true, frozen: true, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}, editoptions:{maxlength: 10, size:20,dataInit: function(elem){$(elem).bind("keypress", function(e) {return numeros(e)})}}}, 
            
        ],
        rowNum: 10,
        rowList: [10, 20, 30],
        width: null,
        height: 400,
        pager: jQuery('#pager'),
        sortname: 'id_permisos',
        shrinkToFit: false,
        sortordezr: 'asc',
        multiselect: true,
        viewrecords: true,
        subGrid : true,
	subGridRowExpanded: function(subgrid_id, row_id) {
		var subgrid_table_id, pager_id;
		subgrid_table_id = subgrid_id+"_t";
		pager_id = "p_"+subgrid_table_id;
		$("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");
		jQuery("#"+subgrid_table_id).jqGrid({
			url:"xmDetallelPermisos.php?id="+row_id,
			datatype: "xml",
			colNames: ['CÓDIGO','DESCRICIÓN'],
			colModel: [
				{name:"id_detalles_permiso",index:"id_detalles_permiso",width:100,key:true},
				{name:"descripcion",index:"descripcion",width:300},
			],
		   	rowNum:20,
		   	pager: pager_id,
		   	sortname: 'id_detalles_permiso',
                        multiselect: true,
		        sortorder: "asc",
                        viewrecords: true,
		        height: '100%',
                        subGrid : true,
                        subGridRowExpanded: function(subgrid_id2, row_id2) {
                        var subgrid_table_id2, pager_id2; 
                        subgrid_table_id2 = subgrid_id2+"_t";
		        pager_id2 = "p_"+subgrid_table_id2;
                        $("#"+subgrid_id2).html("<table id='"+subgrid_table_id2+"' class='scroll'></table><div id='"+pager_id2+"' class='scroll'></div>");
                        jQuery("#"+subgrid_table_id2).jqGrid({
                        url:"xmlDetalleAdicionales.php?id="+row_id2,
			datatype: "xml",
			colNames: ['CÓDIGO','DESCRICIÓN'],
			colModel: [
				{name:"id_detalle_adicional",index:"id_detalle_adicional",width:50,key:true},
				{name:"descripcion",index:"descripcion",width:300},
			],
		   	rowNum:20,
		   	pager: pager_id2,
		   	sortname: 'id_detalle_adicional',
                        multiselect: true,
		        sortorder: "asc",
                        viewrecords: true,
		        height: '100%' 
                          });
                          jQuery("#"+subgrid_table_id2).jqGrid('navGrid',"#"+pager_id2,{edit:false,add:false,del:false})
                        }
                    });
		jQuery("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:false,add:false,del:false})
	},
        caption: 'Lista Menu'
    }).jqGrid('navGrid', '#pager',
            {
                add: false,
                edit: false,
                del: false,
                refresh: true,
                search: false,
                view: true,
                addtext: "Nuevo",
                viewtext: "Ver",
                refreshtext: "Actualizar"
            },
         {
        closeOnEscape: true
    });

    jQuery("#m1").click( function() {
            var s;
            s = jQuery("#list").jqGrid('getGridParam','selarrrow');
            alert(s);
    });
    
    jQuery("#list").setGridWidth($('#centro').width() - 10);
}

function Defecto(e) {
    e.preventDefault();
}


