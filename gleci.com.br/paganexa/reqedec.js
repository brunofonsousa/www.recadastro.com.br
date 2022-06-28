/* JQUERY */
(function($) {
    // Atualiza a página para trocar o documento dentro do modal
    $('#myModal').on('hidden.bs.modal', function() {
        location.reload();
    })
})(jQuery);

/* JAVASCRIPT */

//Regula o tamanho do logo e o título 
window.onscroll = function() {
    scrollFunction()
};

function scrollFunction() {
    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
        document.getElementById("navbar").style.padding = "30px 10px";
        document.getElementById("logo").style.fontSize = "25px";
    } else {
        document.getElementById("navbar").style.padding = "80px 10px";
        document.getElementById("logo").style.fontSize = "35px";
    }
}

//Renomeia todos os id para vincular aos requerimentos
window.onload = init();

function init() {
    var bac = $('[id^=rec]').length;
    var i;
    for (i = 0; i <= bac; i++) {
        var num = i;
        var n = num.toString();
        var y = "ret" + n;
        document.getElementById("rec").id = y;
    }
}

//Relaciona o link ao requerimento dentro do modal
function showID(id) {
    var ID = document.getElementById(id).getAttribute("href");
    document.getElementById("demo").data = ID;
}