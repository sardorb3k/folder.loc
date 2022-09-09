$(document).ready(function() {
    "use strict";
    $("#coggy").on("click", function() {
        $("#madeon-picker , #fullpage").toggleClass("switcher-opened");
    });

    $("a[data-theme]").click(function() {
        $("head link#feuille").attr("href", $(this).data("theme"));
    });

    $("#fullpage").on("click", function() {
        $("#madeon-picker , #fullpage").removeClass("switcher-opened");
    });
});