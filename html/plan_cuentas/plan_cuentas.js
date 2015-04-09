$(document).on("ready", inicio);
function evento(e) {
    e.preventDefault();
}

function scrollToBottom() {
    $('html, body').animate({
        scrollTop: $(document).height()
    }, 'slow');
}

function openPDF(){
window.open('../../ayudas/ayuda.pdf');
}

function scrollToTop() {
    $('html, body').animate({
        scrollTop: 0
    }, 'slow');
}

$(function() {
    $('#main-menu').smartmenus({
        subMenusSubOffsetX: 1,
        subMenusSubOffsetY: -8
    });
});

var dialogo =
{
    autoOpen: false,
    resizable: false,
    width: 700,
    height: 350,
    modal: true
};

var dialogo3 =
{
    autoOpen: false,
    resizable: false,
    width: 400,
    height: 210,
    modal: true,
    position: "top",
    show: "explode",
    hide: "blind"    
}

var dialogo4 ={
    autoOpen: false,
    resizable: false,
    width: 240,
    height: 150,
    modal: true,
    position: "top",
    show: "explode",
    hide: "blind"
}

function abrirDialogo() {
    $("#clientes").dialog("open");
}

function guardar_plan() {
    if ($("#codigo_cuenta").val() === "") {
        $("#codigo_cuenta").focus();
        alertify.error("Ingrese un Código ");
    } else {
        if ($("#descripcion").val() === "") {
            $("#descripcion").focus();
            alertify.error("Ingrese una Descripción");
        } else { 
            $.ajax({
                type: "POST",
                url: "guardar_plan.php",
                data: "codigo_cuenta=" +  $("#codigo_cuenta").val()+ "&descripcion=" + $("#descripcion").val() + "&cuenta=" + $("#cuenta").val(),
                success: function(data) {
                    var val = data;
                    if (val == 1) {
                        alertify.success('Datos Agregados Correctamente');
                        $("#codigo_cuenta").val("");
                        $("#descripcion").val("");
                        $("#list").trigger("reloadGrid");
                    }
                }
            });
       
        } 
    }  
}

function este(){
window.open('../../fpdf/ayuda_general.pdf');
}

function modificar_plan() {
    if ($("#id_plan_cuentas").val() === "" ) {
        alertify.error("Seleccione un Plan de Cuenta");
    } else {
        if ($("#tipo").val() === "" ) {
            $("#tipo").focus();
            alertify.error("Seleccione un tipo de Cuenta");
        } else {
            if ($("#codigo").val() === "") {
                $("#codigo").focus();
                alertify.error("Ingrese un Código ");
            } else {
                if ($("#descripcion").val() === "") {
                    $("#descripcion").focus();
                    alertify.error("Ingrese una Descripción");
                } else {               
                    $.ajax({
                        type: "POST",
                        url: "modificar_plan.php",
                        data: "codigo_cuenta=" + + $("#codigo").val()+ "&descripcion=" + $("#descripcion").val() +
                        "&tipo=" + $("#tipo").val() + "&cuenta=" + $("#cuenta").val() + "&id_plan_cuentas=" + $("#id_plan_cuentas").val(),
                        success: function(data) {
                            var val = data;
                            if (val == 1) {
                                alertify.success('Datos Agregados Correctamente');						    		
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            }
                        }
                    });
                }
            }
        }
    } 
}

function eliminar_cliente() {
    if ($("#id_cliente").val() === "") {
        alertify.error("Seleccione un cliente");
    } else {
        $("#clave_permiso").dialog("open");     
    }
}

function validar_acceso(){
    if($("#clave").val() == "") {
        $("#clave").focus();
        alertify.error("Ingrese la clave");
    }else{
        $.ajax({
            url: '../../procesos/validar_acceso.php',
            type: 'POST',
            data: "clave=" + $("#clave").val(),
            success: function(data) {
                var val = data;
                if (val == 0) {
                    $("#clave").val("");
                    $("#clave").focus();
                    alertify.error("Error... La clave es incorrecta ingrese nuevamente");
                } else {
                    if (val == 1) {
                        $("#seguro").dialog("open");   
                    }
                }
            }
        });
    }   
}



function ValidNum() {
    if (event.keyCode < 48 || event.keyCode > 57) {
        event.returnValue = false;
    }
    return true;
}

function Num_Let() {
    if ((event.keyCode !== 32) && (event.keyCode < 65) || (event.keyCode > 90) && (event.keyCode < 97) || (event.keyCode > 122)) {
        event.returnValue = false;
    }
    return true;
}


$(function() {
    guidely.init({
        startTrigger: false
    });
});

function punto(e){
    var key;
    if (window.event) {
        key = e.keyCode;
    }
    else if (e.which) {
        key = e.which;
    }

    if (key < 48 || key > 57) {
        if (key === 46 || key === 8)     {
            return true;
        } else {
            return false;
        }
    }
    return true;   
}

function inicio() {
    alertify.set({
        delay: 1000
    });
    
    $("#codigo_cuenta").on("keypress",punto);

    //////////////////////
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

    $("#btnGuardar").on("click", guardar_plan);
    $("#btnModificar").on("click", modificar_plan);
    $("#btnBuscar").on("click", abrirDialogo);
    $("#btnEliminar").on("click", eliminar_cliente);
    
    
    $("#btnAcceder").on("click", validar_acceso);        

    $("#clientes").dialog(dialogo);
    $("#clave_permiso").dialog(dialogo3);
    $("#seguro").dialog(dialogo4);

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
        width: 500,
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
         jQuery("#list").jqGrid('GridToForm', id, "#clientes_form");
         $("#btnGuardar").attr("disabled", true);
         $("#clientes").dialog("close");    
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
            if (id) {
                jQuery("#list").jqGrid('GridToForm', id, "#clientes_form");
                $("#btnGuardar").attr("disabled", true);
                $("#clientes").dialog("close");
            } else {
                alertify.alert("Seleccione un fila");
            }
        }
    });
}

