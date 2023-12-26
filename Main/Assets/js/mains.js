$(document).ready(function () {


  $("#eyes").click(function (e) {
    var txt_type = $("#pass").attr("type");
    if (txt_type == "password") {
      $("#pass").attr("type", "text");
      $("#eyes").addClass("active");
    } else {
      $("#pass").attr("type", "password");
      $("#eyes").removeClass("active");
    }
  });

  $(".search button").click(function (e) {
    $(".search input").toggleClass("active");
    $(".search input").focus();
    $(".search button").toggleClass("active");
    $(".search input").val("");
  });
});
