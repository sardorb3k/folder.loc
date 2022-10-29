/* * MOON - Absolute Coming Soon Template
 *
 * This is a premium product available exclusively at this address http://themeforest.net/user/madeon08/portfolio
 *
 * The demo files are minified/crypted for copyright reasons, you will find them, expanded, commented and coded accurately in your download pack.
 *
 * Thanks for your support!
 *
 */

$(window).load(function () {
  "use strict";
  setTimeout(function () {
    $("#loading").addClass("loaded");
  }, 1000);

  setTimeout(function () {
    $("#loading").remove();
  }, 2210);
});

function selectedfield() {
  var a = document.getElementById("reason");
  "placeholder" !== a.options[a.selectedIndex].value &&
    $("#reason").removeClass("no-selection");
}

$(".form-control").on("focusin focusout", function () {
  $(this).siblings(".icon-fields").toggleClass("active");
});

$(document).ready(function () {
  "use strict";

  $("#fullpage").fullpage({
    anchors: "123".split(""),
    navigationTooltips: "Bosh Sahifa, Biz Haqimizda, Aloqa".split(", "),
    showActiveTooltip: !1,
    menu: "#menu",
    css3: !0,
    scrollingSpeed: 800,
    responsiveWidth: 992,
  });

  $("#notifyMe").notifyMe();
});
