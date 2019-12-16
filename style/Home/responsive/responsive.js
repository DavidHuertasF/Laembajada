$( document ).ready(function() {      
    var isMobile = window.matchMedia("only screen and (max-width: 760px)");

    if (isMobile.matches) {
       $("#normal-version").remove();
    }
 });