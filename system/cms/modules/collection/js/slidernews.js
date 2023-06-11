/*
* Jqcollection - JQuery collectionTicker
* Author: Gravagnola Saverio and Iuliano Renato
* Version: 2.0 Orizzontale e Verticale
*/

// Settings for the vertical rotation.
var collectionVisualVertical = 2; //Number of collection to be displayed
var intervalloVert = 4000; // time > 2500
var numcollectionVert;
//Enter the same value used in the file css/style.css for "jqcollectionVert"
var larghezzaDivVert ; //width div
var altezzaDivVert = 118; //height div
var margineDivVert = 0; //margin between div

// Settings for the horizontal rotation.
var collectionVisualOrizzontal = 4;   //Number of collection to be displayed
var intervalloOriz = 5000; // time > 1500
var numcollectionOrizzontal;
//Enter the same value used in the file css/style.css for "jqcollectionOriz"
var larghezzaDivOriz = 150; // width div
var altezzaDivOriz = 118; // height div
var margineDivOriz = 5; // margin between div

$(document).ready(function() {
    // Totale collection
    numcollectionVert = $("#jqcollectionVert").children().length;

    // Totale collection orizzontali
    numcollectionOrizzontal = $("#jqcollectionOriz").children().length;

    // Se si  creato il div per le collection a rotazione verticale
    if (numcollectionVert > 0) {
        jqcollectionVertical();
    }
    
    // Se si  creato il div per le collection a rotazione orizzontale
    if (numcollectionOrizzontal > 0) {
        jqcollectionOrizzontal();
    }
});

function jqcollectionVertical() {
    // Controllo di overflow
    if (collectionVisualVertical > numcollectionVert) {
        collectionVisualVertical = numcollectionVert;
    }

    // Hide delle collection superflue all'inizializzazione
    for (var i = collectionVisualVertical; i < numcollectionVert; i++) {
        $($("#jqcollectionVert").children()[i]).css("opacity", "0");
    }

    var gestInter = setInterval(jqcollectionRotateVertical, intervalloVert);

    // Gestione del mouseover-mouseout
    $("#jqcollectionVert").mouseover(function() { clearInterval(gestInter) });
    $("#jqcollectionVert").mouseout(function() { gestInter = setInterval(jqcollectionRotateVertical, intervalloVert); });
}

function jqcollectionRotateVertical() {
    // Hide della prima collection
    $($("#jqcollectionVert").children()[0]).animate({ opacity: 0 }, 1000, "linear", function() {
        // Movimento verso l'alto
        $($("#jqcollectionVert").children()[0]).animate({ marginTop: -altezzaDivVert }, 1000, "linear", function() {
            // Ripristino posizione elemento nascosto
        $($("#jqcollectionVert").children()[0]).css("margin", margineDivVert);
        // Spostamento in coda dell'elemento nascosto
        $("#jqcollectionVert").append($($("#jqcollectionVert").children()[0]));
            // Visualizzazione dell'ultima collection
        $($("#jqcollectionVert").children()[collectionVisualVertical - 1]).animate({ opacity: 1 }, 1000);
        });
    });
}

function jqcollectionOrizzontal() {
    // Controllo di overflow
    if (collectionVisualOrizzontal > numcollectionOrizzontal) {
        collectionVisualOrizzontal = numcollectionOrizzontal;
    }

    // Hide delle collection superflue all'inizializzazione
    for (var i = collectionVisualOrizzontal; i < numcollectionOrizzontal; i++) {
        $($("#jqcollectionOriz").children()[i]).css("opacity", "0");
    }

    var gestInter = setInterval(jqcollectionRotateOrizzontal, intervalloOriz);

    // Gestione del mouseover-mouseout
    $("#jqcollectionOriz").mouseover(function() { clearInterval(gestInter) });
    $("#jqcollectionOriz").mouseout(function() { gestInter = setInterval(jqcollectionRotateOrizzontal, intervalloOriz); });
}

function jqcollectionRotateOrizzontal() {    
    // Hide della prima collection
    $($("#jqcollectionOriz").children()[0]).animate({ opacity: 0 }, 1000, "linear", function() {
        // Movimento verso l'alto
        $($("#jqcollectionOriz").children()[0]).animate({ marginLeft: -larghezzaDivOriz }, 1000, "linear", function() {
            // Ripristino posizione elemento nascosto
            $($("#jqcollectionOriz").children()[0]).css("margin", margineDivOriz);
            // Spostamento in coda dell'elemento nascosto
            $("#jqcollectionOriz").append($($("#jqcollectionOriz").children()[0]));
            // Visualizzazione dell'ultima collection
            $($("#jqcollectionOriz").children()[(collectionVisualOrizzontal - 1)]).animate({ opacity: 1 }, 1000);
        });
    });
}