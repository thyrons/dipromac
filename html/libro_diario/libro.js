$(document).on("ready", inicio);
function evento(e) {
    e.preventDefault();
}

function openPDF(){
window.open('../../ayudas/ayuda.pdf');
}

$(function() {
    $('#main-menu').smartmenus({
        subMenusSubOffsetX: 1,
        subMenusSubOffsetY: -8
    });
});

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

function show() {
    var Digital = new Date();
    var hours = Digital.getHours();
    var minutes = Digital.getMinutes();
    var seconds = Digital.getSeconds();
    var dn = "AM";
    if (hours > 12) {
        dn = "PM";
        hours = hours - 12;
    }
    if (hours === 0)
        hours = 12;
    if (minutes <= 9)
        minutes = "0" + minutes;
    if (seconds <= 9)
        seconds = "0" + seconds;
    $("#hora_actual").val(hours + ":" + minutes + ":" + seconds + " " + dn);
    setTimeout("show()", 1000);
}

function reset () {
    $("#toggleCSS").attr("href", "../../css/alertify.default.css");
    alertify.set({
        labels : {
            ok     : "OK",
            cancel : "Cancel"
        },
        delay : 5000,
        buttonReverse : false,
        buttonFocus   : "ok"
    });
}

function inicio() {
    alertify.set({
        delay: 1000
    });
    
    $("#td_kardex tbody").empty(); 

    $.ajax({
        type: "POST",
        url: "retornar_libro.php",  
        data:{
            id:$('#cod_producto').val(),
            fecha1:$('#fecha_inicio').val(),
            fecha2:$('#fecha_fin').val()
        },
        dataType: 'json',
        success: function(response) {         
            for (var i = 0; i < response.length; i=i+5) {
                $("#td_kardex tbody").append( "<tr>" +
                    "<td align=center>" + response[i+0] + "</td>" +
                    "<td align=center>" + response[i+1] + "</td>" +	            
                    "<td align=center>" + response[i+2] + "</td>" + 
                    "<td align=center>" + response[i+3] + "</td>" +   
                    "<td align=center>" + response[i+4] + "</td>" +
                    "<tr>"); 
            }
        }                    
    }); 


//////////////////////////////////////
}


