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

  
});
