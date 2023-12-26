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

  $('.search input').keyup(function (e) {
    let search_term = $('.search input').val();
    if (search_term != "") {
      $('.search input').addClass("active");
    }
    else {
      $('.search input').removeClass("active");
    }


    let xhr = new XMLHttpRequest();
    xhr.open("POST", "Assets/php/function.php?search=true.php", true);
    xhr.onload = () => {
      if (xhr.readyState == XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          $('.users-list').html(data);
        }
      }
    };
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("search_term=" + search_term);
  });
});
