 
// Culinary
function openpop(id){
    document.getElementById(id).style.width = "100%";
}

function closepop(id){
    document.getElementById(id).style.width = "0%";
}


  function openCul() {
    document.getElementById("kuliner").style.width = "100%";

}

function closeCul() {
    document.getElementById("kuliner").style.width = "0%";
}

// ATRAKSI 
function openAtr() {
    document.getElementById("atraksi").style.width = "100%";

}

function closeAtr() {
    document.getElementById("atraksi").style.width = "0%";
}

// Seni Budaya
function openSb() {
    document.getElementById("senibudaya").style.width = "100%";

}

function closeSb() {
    document.getElementById("senibudaya").style.width = "0%";
}
// TEMPAT BELANJA
function openShop() {
    document.getElementById("shopping").style.width = "100%";

}

function closeShop() {
    document.getElementById("shopping").style.width = "0%";
}
// TAMAN KOTA
function openTmk() {
    document.getElementById("tamankota").style.width = "100%";

}

function closeTmk() {
    document.getElementById("tamankota").style.width = "0%";
}
// HIBURAN
function openEnt() {
    document.getElementById("hiburan").style.width = "100%";

}

function closeEnt() {
    document.getElementById("hiburan").style.width = "0%";
}


// kalender event
                  $(document).ready(function() {
                    $("#myCarousel2").on("slide.bs.carousel", function(e) {
                        var $e = $(e.relatedTarget);
                        var idx = $e.index();
                        var itemsPerSlide = 4;
                        var totalItems = $(".carousel-item").length;

                        if (idx >= totalItems - (itemsPerSlide - 1)) {
                        var it = itemsPerSlide - (totalItems - idx);
                        for (var i = 0; i < it; i++) {
                            // append slides to end
                            if (e.direction == "left") {
                            $(".carousel-item")
                                .eq(i)
                                .appendTo(".carousel-inner");
                            } else {
                            $(".carousel-item")
                                .eq(0)
                                .appendTo($(this).find(".carousel-inner"));
                            }
                        }
                        }
                    });
                    });