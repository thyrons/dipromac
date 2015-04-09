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

var dialogo_cuenta ={
    autoOpen: false,
    resizable: false,
    width: 570,
    height: 360,
    modal: true,
    position: "top",
    show: "explode",
    hide: "blind"
}

function guardar_asignacion(){
    var vect1 = new Array();
    var cont=0;
    $("#tablaNuevo tbody tr").each(function (index) {                                                                 
        $(this).children("td").each(function (index) {                               
            switch (index) {                                            
                case 0:
                    vect1[cont] = $(this).text();   
                    break; 
            }                                
        });
        cont++;  
    });

    if($("#tabla").val() == ""){
        alertify.error("Seleccione una opcion");
    }else{
      if(vect1.length == 0){
         alertify.error("Ingrese las Asignaciones");  
        }else{
              $.ajax({
                type: "POST",
                url:"guardar_asignacion.php",
                data: "tabla="+$("#tabla").val()+"&campo1="+vect1,
                success: function(data) {
                    var val = data;
                    if (val == 1) {
                        alertify.alert("Asignacion Guardada correctamente");
                        // location.reload();   
                    }
                }
            }) 
        }
    }
}

function abrirCuenta() {
    $("#cuentas").dialog("open");
}

function numeros(e) { 
tecla = (document.all) ? e.keyCode : e.which;
if (tecla==8) return true;
patron = /\d/;
te = String.fromCharCode(tecla);
return patron.test(te);
}

function inicio() {
    alertify.set({ delay: 1000 });

$("#btnCuenta").click(function(e) {
        e.preventDefault();
    });
$("#btnGuardar").click(function(e) {
        e.preventDefault();
    });

$("#btnCuenta").on("click", abrirCuenta);
$("#cuentas").dialog(dialogo_cuenta);
$("#btnGuardar").on("click", guardar_asignacion);

     jQuery("#list").jqGrid({
        url: 'datos_plan.php',
        datatype: 'xml',
        colNames: ['Id', 'Codigo', 'Descripción', 'Cuenta'],
        colModel: [
            {name: 'id_plan_cuentas', index: 'id_plan_cuentas', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'codigo_cuenta', index: 'codigo_cuenta', editable: true, align: 'left', width: '120', search: false, frozen: true, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}},
            {name: 'descripcion', index: 'descripcion', editable: true, align: 'left', width: '200', search: true, frozen: true, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}},
            {name: 'cuenta', index: 'cuenta', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
        ],
        rowNum: 10,
        width: 550,
        height: 200,
        rowList: [10, 20, 30],
        pager: jQuery('#pager'),
        sortname: 'id_plan_cuentas',
        shrinkToFit: false,
        sortorder: 'asc',
        caption: 'Lista de Clientes',        
        viewrecords: true,
        ondblClickRow: function(){
         var id = jQuery("#list").jqGrid('getGridParam', 'selrow');
         jQuery('#list').jqGrid('restoreRow', id);
         var ret = jQuery("#list").jqGrid('getRowData', id);    
        
         if($("#tabla").val()==""){
               alertify.error("Seleccione una opcion"); 
               $("#cuentas").dialog("close");
           }else{
            $("#tablaNuevo tbody").append( "<tr>" +
            "<td align=center >" + ret.id_plan_cuentas + "</td>" +    
            "<td align=center >" + $("#tabla").val()+ "</td>" +
            "<td align=center>" + ret.codigo_cuenta + "</td>" +             
            "<td align=center>" + ret.descripcion + "</td>" + 
            "<td align=center>" + " " + "</td>" +   
           "<tr>");
            $("#cuentas").dialog("close");
           }
        }
    }).jqGrid('navGrid', '#pager',
            {
                add: false,
                edit: false,
                del: false,
                refresh: true,
                search: true,
                view: true
            },
    {
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
        }
    );
    
    jQuery("#list").jqGrid('navButtonAdd', '#pager', {caption: "Añadir",
        onClickButton: function() {
            var id = jQuery("#list").jqGrid('getGridParam', 'selrow');
            jQuery('#list').jqGrid('restoreRow', id);
            var ret = jQuery("#list").jqGrid('getRowData', id);

            if (id) {
                if($("#tabla").val()==""){
                   alertify.error("Seleccione una opcion"); 
                   $("#cuentas").dialog("close");
               }else{
                $("#tablaNuevo tbody").append( "<tr>" +
                "<td align=center >" + ret.id_plan_cuentas + "</td>" +    
                "<td align=center >" + $("#tabla").val()+ "</td>" +
                "<td align=center>" + ret.codigo_cuenta + "</td>" +             
                "<td align=center>" + ret.descripcion + "</td>" + 
                "<td align=center>" + " " + "</td>" +   
               "<tr>");
                $("#cuentas").dialog("close");
               }
            } else {
                alertify.alert("Seleccione un fila");
            }
        }
    });
}

function Defecto(e) {
    e.preventDefault();
}

