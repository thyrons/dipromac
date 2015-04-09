$(document).on("ready", inicio);
function evento(e) {
    e.preventDefault();
}

function openPDF(){
window.open('../../ayudas/ayuda.pdf');
}

function scrollToBottom() {
    $('html, body').animate({
        scrollTop: $(document).height()
    }, 'slow');
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
    width: 860,
    height: 350,
    modal: true
};

function abrirDialogo(e)
{
    $("#empresas").dialog("open");
}

function nueva_empresa(e) {
    location.reload();
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


$(function(){
    Test = {
        UpdatePreview: function(obj){
            if(!window.FileReader){
            } else {
                var reader = new FileReader();
                var target = null;
             
                reader.onload = function(e) {
                    target =  e.target || e.srcElement;
                    $("#foto").prop("src", target.result);
                };
                reader.readAsDataURL(obj.files[0]);
            }
        }
    };
});

function guardar_empresa() {
    var iden = $("#ruc_empresa").val();
   
    if ($("#nombre_empresa").val() === "") {
        $("#nombre_empresa").focus();
        alertify.alert("Ingrese nombre de la empresa");
    } else {
        if ($("#ruc_empresa").val() === "") {
            $("#ruc_empresa").focus();
            alertify.alert("Ingrese ruc de la empresa");
        }else{
            if ( iden.length < 13) {
                $("#ruc_ci").focus();
                alertify.alert("Error.. Minimo 13 digitos ");
            } else {
                if ($("#descripcion_empresa").val() === "") {
                    $("#descripcion_empresa").focus();
                    alertify.alert("Ingrese una descripción");
                }else{
                    if ($("#propietario_empresa").val() === "") {
                        $("#propietario_empresa").focus();
                        alertify.alert("Ingrese el propietario");
                    }else{
                        if ($("#direccion_empresa").val() === "") {
                            $("#direccion_empresa").focus();
                            alertify.alert("Ingrese dirección de la empresa");
                        }else{
                            if ($("#telefono_empresa").val() === "") {
                                $("#telefono_empresa").focus();
                                alertify.alert("Ingrese telefóno de la empresa");
                            }else{ 
                                if ($("#pais_empresa").val() === "") {
                                    $("#pais_empresa").focus();
                                    alertify.alert("Ingrese el país");
                                }else{
                                    if ($("#ciudad_empresa").val() === "") {
                                        $("#ciudad_empresa").focus();
                                        alertify.alert("Ingrese la ciudad");
                                    }else{
                                        $("#empresa_form").submit(function(e) {
                                            var formObj = $(this);
                                            var formURL = formObj.attr("action");
                                            if(window.FormData !== undefined) {	
                                                var formData = new FormData(this);   
                                                formURL=formURL; 
                                            
                                                $.ajax({
                                                    url: "guardar_empresa2.php",
                                                    type: "POST",
                                                    data:  formData,
                                                    mimeType:"multipart/form-data",
                                                    contentType: false,
                                                    cache: false,
                                                    processData:false,
                                                    success: function(data, textStatus, jqXHR) {
                                                        var res=data;
                                                        if(res == 1){
                                                            alertify.alert("Datos Agredados Correctamente",function(){
                                                                location.reload();
                                                            });
                                                        } else{
                                                            alertify.alert("Error..... Datos no Agregados");
                                                        }
                                                    },
                                                    error: function(jqXHR, textStatus, errorThrown) 
                                                    {
                                                    } 	        
                                                });
                                                e.preventDefault();
                                            } else {
                                                var  iframeId = "unique" + (new Date().getTime());
                                                var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');
                                                iframe.hide();
                                                formObj.attr("target",iframeId);
                                                iframe.appendTo("body");
                                                iframe.load(function(e)
                                                {
                                                    var doc = getDoc(iframe[0]);
                                                    var docRoot = doc.body ? doc.body : doc.documentElement;
                                                    var data = docRoot.innerHTML;
                                                });
                                            }
                                        });
                                        $("#empresa_form").submit();
                                    }
                                }
                            }
                        }
                    }
                }
            } 
        }
    }   
}

function modificar_empresa(){
    
    var iden = $("#ruc_empresa").val();
 
    if ($("#id_empresa").val() === "") {
        alertify.alert("Indique la empresa");
    }else{
        if ($("#nombre_empresa").val() === "") {
            $("#nombre_empresa").focus();
            alertify.alert("Ingrese nombre de la empresa");
        } else {
            if ($("#ruc_empresa").val() === "") {
                $("#ruc_empresa").focus();
                alertify.alert("Ingrese ruc de la empresa");
            }else{
                if ( iden.length < 13) {
                    $("#ruc_ci").focus();
                    alertify.alert("Error.. Minimo 13 digitos ");
                } else {
                    if ($("#descripcion_empresa").val() === "") {
                        $("#descripcion_empresa").focus();
                        alertify.alert("Ingrese una descripción");
                    }else{
                        if ($("#propietario_empresa").val() === "") {
                            $("#propietario_empresa").focus();
                            alertify.alert("Ingrese el propietario");
                        }else{
                            if ($("#direccion_empresa").val() === "") {
                                $("#direccion_empresa").focus();
                                alertify.alert("Ingrese dirección de la empresa");
                            }else{
                                if ($("#telefono_empresa").val() === "") {
                                    $("#telefono_empresa").focus();
                                    alertify.alert("Ingrese telefóno de la empresa");
                                }else{ 
                                    if ($("#pais_empresa").val() === "") {
                                        $("#pais_empresa").focus();
                                        alertify.alert("Ingrese el país");
                                    }else{
                                        if ($("#telefono_empresa").val() === "") {
                                            $("#telefono_empresa").focus();
                                            alertify.alert("Ingrese la ciudad");
                                        }else{
                                            $("#empresa_form").submit(function(e) {
                                            var formObj = $(this);
                                            var formURL = formObj.attr("action");
                                            if(window.FormData !== undefined) {	
                                                var formData = new FormData(this);   
                                                formURL=formURL; 
                                            
                                                $.ajax({
                                                    url: "modificar_empresa.php",
                                                    type: "POST",
                                                    data:  formData,
                                                    mimeType:"multipart/form-data",
                                                    contentType: false,
                                                    cache: false,
                                                    processData:false,
                                                    success: function(data, textStatus, jqXHR) {
                                                        var res=data;
                                                        if(res == 1){
                                                            alertify.alert("Datos Modificados Correctamente",function(){
                                                                location.reload();
                                                            });
                                                        } else{
                                                            alertify.alert("Error..... Datos no Modificados");
                                                        }
                                                    },
                                                    error: function(jqXHR, textStatus, errorThrown) 
                                                    {
                                                    } 	        
                                                });
                                                e.preventDefault();
                                            } else {
                                                var  iframeId = "unique" + (new Date().getTime());
                                                var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');
                                                iframe.hide();
                                                formObj.attr("target",iframeId);
                                                iframe.appendTo("body");
                                                iframe.load(function(e)
                                                {
                                                    var doc = getDoc(iframe[0]);
                                                    var docRoot = doc.body ? doc.body : doc.documentElement;
                                                    var data = docRoot.innerHTML;
                                                });
                                            }
                                        });
                                            $("#empresa_form").submit();
                                        }
                                    } 
                                }
                            }
                        }
                    }
                } 
            }
        }
    }   
} 

function inicio() {
    
    //////////////////para cargar mpresa/////////////
    function getDoc(frame) {
        var doc = null;     
     	
        try {
            if (frame.contentWindow) {
                doc = frame.contentWindow.document;
            }
        } catch(err) {
        }
        if (doc) { 
            return doc;
        }
        try { 
            doc = frame.contentDocument ? frame.contentDocument : frame.document;
        } catch(err) {
       
            doc = frame.document;
        }
        return doc;
    }      

    $("#ruc_empresa").validCampoFranz("0123456789");
    $("#telefono_empresa").validCampoFranz("0123456789");
    $("#celular_empresa").validCampoFranz("0123456789");
    $("#ruc_empresa").attr("maxlength", "13");
    
    
    $("#ruc_empresa").keyup(function() {
        var ci = $("#ruc_empresa").val();
        var pares = 0;
        var impares = 0;
        var cont = 0;
        var total = 0;
        var residuo = 0;
       
        var ruc = ci.substr(10,13);
                
        if(ruc == "001" ){
            var ce = ci.substr(0,10);
            for (var i = 0; i < 9; i++) {
                if (i % 2 === 0) {
                    if (parseInt(ce.charAt(i)) * 2 > 9) {
                        cont = (parseInt(ce.charAt(i)) * 2) - 9;
                    }
                    else {
                        cont = (parseInt(ce.charAt(i)) * 2);
                    }
                    impares = impares + cont;
                }
                else {
                    pares = pares + parseInt(ce.charAt(i));
                }
            }
            total = pares + impares;
            if (total % 10 === 0) {
            }
            else {
                residuo = total % 10;
                residuo = 10 - residuo;
                if (parseInt(ce.charAt(9)) === residuo) {
                }
                else {
                    alert("Error.... Ruc Incorrecto");
                    $("#ruc_empresa").val("");
                }
            }
        }else{
            if($("#ruc_empresa").val().length === 13){
                alert("Error.... Ruc Incorrecto");   
                $("#ruc_empresa").val("");
            }
        }
    });

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
    $("#btnNuevo").click(function(e) {
        e.preventDefault();
    });
    //////////////////////////
    
    $("#btnGuardar").on("click", guardar_empresa);
    $("#btnModificar").on("click", modificar_empresa);

    ///////////////////////////
    $("#btnBuscar").on("click", abrirDialogo);
    $("#btnNuevo").on("click", nueva_empresa);
    //////////////////////////

    /////////////////////////// 
    $("#empresas").dialog(dialogo);
/////////////////////////// 

/////////////tabla clientes/////////
 jQuery("#list").jqGrid({
        url: 'datos_empresa.php',
        datatype: 'xml',
        colNames: ['Codigo', 'Empresa', 'RUC', 'Descripción', 'Propietario', 'Dirección', 'Telefóno', 'Celular', 'País', 'Empresa', 'Fax', 'Correo', 'Página Web', 'Imagen'],
        colModel: [
            {name: 'id_empresa', index: 'id_empresa', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'nombre_empresa', index: 'nombre_empresa', editable: true, align: 'center', width: '120', search: false, frozen: true, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}},
            {name: 'ruc_empresa', index: 'ruc_empresa', editable: true, align: 'center', width: '120', search: true, frozen: true, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}},
            {name: 'descripcion_empresa', index: 'descripcion_empresa', editable: true, align: 'center', width: '120', search: true, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'propietario_empresa', index: 'propietario_empresa', editable: true, align: 'center', width: '120', search: true, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'direccion_empresa', index: 'direccion_empresa', editable: true, align: 'center', width: '120', search: true, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'telefono_empresa', index: 'telefono_empresa', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'celular_empresa', index: 'celular_empresa', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'pais_empresa', index: 'pais_empresa', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'ciudad_empresa', index: 'ciudad_empresa', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'fax_empresa', index: 'fax_empresa', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'correo_empresa', index: 'correo_empresa', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'pagina_empresa', index: 'pagina_empresa', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'imagen', index: 'imagen', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}}
        ],
        rowNum: 10,
        width: 830,
        rowList: [10, 20, 30],
        pager: jQuery('#pager'),
        sortname: 'id_empresa',
        shrinkToFit: false,
        sortorder: 'asc',
        caption: 'Lista de Empresa',        
        viewrecords: true,
        ondblClickRow: function(){
         var id = jQuery("#list").jqGrid('getGridParam', 'selrow');
         jQuery('#list').jqGrid('restoreRow', id);   
         var ret = jQuery("#list").jqGrid('getRowData', id);
         $("#foto").attr("src", "../../logos_empresa/"+ ret.imagen);
         jQuery("#list").jqGrid('GridToForm', id, "#empresa_form");
         $("#btnGuardar").attr("disabled", true);
         $("#empresas").dialog("close");    
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
    /////////////////		
    jQuery("#list").jqGrid('navButtonAdd', '#pager', {caption: "Añadir",
        onClickButton: function() {
            var id = jQuery("#list").jqGrid('getGridParam', 'selrow');
            jQuery('#list').jqGrid('restoreRow', id);
            var ret = jQuery("#list").jqGrid('getRowData', id);
            if (id) {
                jQuery("#list").jqGrid('GridToForm', id, "#empresa_form");
                $("#foto").attr("src", "../logos_empresa/"+ ret.imagen);
                $("#btnGuardar").attr("disabled", true);
                $("#empresas").dialog("close");
            } else {
                alert("Seleccione un fila");
            }
        }
    });   
}

