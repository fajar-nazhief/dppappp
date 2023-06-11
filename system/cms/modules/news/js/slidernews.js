/*
* JqNews - JQuery NewsTicker
* Author: Gravagnola Saverio and Iuliano Renato
* Version: 2.0 Orizzontale e Verticale
*/

// Settings for the vertical rotation.
var newsVisualVertical = 2; //Number of news to be displayed
var intervalloVert = 4000; // time > 2500
var numNewsVert;
//Enter the same value used in the file css/style.css for "jqnewsVert"
var larghezzaDivVert ; //width div
var altezzaDivVert = 118; //height div
var margineDivVert = 0; //margin between div

// Settings for the horizontal rotation.
var newsVisualOrizzontal = 4;   //Number of news to be displayed
var intervalloOriz = 5000; // time > 1500
var numNewsOrizzontal;
//Enter the same value used in the file css/style.css for "jqnewsOriz"
var larghezzaDivOriz = 150; // width div
var altezzaDivOriz = 118; // height div
var margineDivOriz = 5; // margin between div

$(document).ready(function() {
    // Totale news
    numNewsVert = $("#jqnewsVert").children().length;

    // Totale news orizzontali
    numNewsOrizzontal = $("#jqnewsOriz").children().length;

    // Se si  creato il div per le news a rotazione verticale
    if (numNewsVert > 0) {
        jqnewsVertical();
    }
    
    // Se si  creato il div per le news a rotazione orizzontale
    if (numNewsOrizzontal > 0) {
        jqnewsOrizzontal();
    }
});

function jqnewsVertical() {
    // Controllo di overflow
    if (newsVisualVertical > numNewsVert) {
        newsVisualVertical = numNewsVert;
    }

    // Hide delle news superflue all'inizializzazione
    for (var i = newsVisualVertical; i < numNewsVert; i++) {
        $($("#jqnewsVert").children()[i]).css("opacity", "0");
    }

    var gestInter = setInterval(jqNewsRotateVertical, intervalloVert);

    // Gestione del mouseover-mouseout
    $("#jqnewsVert").mouseover(function() { clearInterval(gestInter) });
    $("#jqnewsVert").mouseout(function() { gestInter = setInterval(jqNewsRotateVertical, intervalloVert); });
}

function jqNewsRotateVertical() {
    // Hide della prima news
    $($("#jqnewsVert").children()[0]).animate({ opacity: 0 }, 1000, "linear", function() {
        // Movimento verso l'alto
        $($("#jqnewsVert").children()[0]).animate({ marginTop: -altezzaDivVert }, 1000, "linear", function() {
            // Ripristino posizione elemento nascosto
        $($("#jqnewsVert").children()[0]).css("margin", margineDivVert);
        // Spostamento in coda dell'elemento nascosto
        $("#jqnewsVert").append($($("#jqnewsVert").children()[0]));
            // Visualizzazione dell'ultima news
        $($("#jqnewsVert").children()[newsVisualVertical - 1]).animate({ opacity: 1 }, 1000);
        });
    });
}

function jqnewsOrizzontal() {
    // Controllo di overflow
    if (newsVisualOrizzontal > numNewsOrizzontal) {
        newsVisualOrizzontal = numNewsOrizzontal;
    }

    // Hide delle news superflue all'inizializzazione
    for (var i = newsVisualOrizzontal; i < numNewsOrizzontal; i++) {
        $($("#jqnewsOriz").children()[i]).css("opacity", "0");
    }

    var gestInter = setInterval(jqNewsRotateOrizzontal, intervalloOriz);

    // Gestione del mouseover-mouseout
    $("#jqnewsOriz").mouseover(function() { clearInterval(gestInter) });
    $("#jqnewsOriz").mouseout(function() { gestInter = setInterval(jqNewsRotateOrizzontal, intervalloOriz); });
}

function jqNewsRotateOrizzontal() {    
    // Hide della prima news
    $($("#jqnewsOriz").children()[0]).animate({ opacity: 0 }, 1000, "linear", function() {
        // Movimento verso l'alto
        $($("#jqnewsOriz").children()[0]).animate({ marginLeft: -larghezzaDivOriz }, 1000, "linear", function() {
            // Ripristino posizione elemento nascosto
            $($("#jqnewsOriz").children()[0]).css("margin", margineDivOriz);
            // Spostamento in coda dell'elemento nascosto
            $("#jqnewsOriz").append($($("#jqnewsOriz").children()[0]));
            // Visualizzazione dell'ultima news
            $($("#jqnewsOriz").children()[(newsVisualOrizzontal - 1)]).animate({ opacity: 1 }, 1000);
        });
    });
}