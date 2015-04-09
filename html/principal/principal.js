$(document).on("ready", inicio);

function Defecto(e) {
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

function inicio (){
    
}	


