const form = document.querySelector(".typing-area");

$(document).ready(function () {

  // alert('nima');

  var is_search = false;

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


    $.ajax({
      url: 'Assets/php/function.php?search=true',
      type: 'POST',
      data: { search_term: search_term },
      success: function (data) {
        $('.users-list').html(data);
      },
      beforeSend: function (xhr) {
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      }
    });
  });

  $('.chat-zone').mouseenter(function () {
    $('.chat-zone').addClass('active');
  });

  $('.chat-zone').mouseleave(function () {
    $('.chat-zone').removeClass('active');
  });

  Scroll();

  $('.typing-area').submit(function (e) {
    e.preventDefault();
  });

  $('.send-btn').click(function (e) {
    SendMsg();
  });

  setInterval(() => {
    $.ajax({
      url: 'Assets/php/function.php',
      type: 'POST',
      data: new FormData(form),
      processData: false,
      contentType: false,
      success: function (data) {
        $('.chat-zone').html(data);
        var clas = $('.chat-zone').attr('class');
        var split_class = clas.split(" ");
        if (split_class != "active") {
          Scroll();
        }
      }
    });
  }, 500);


  setInterval(() => {
    var txt_search = $('.search input').val()
    if (txt_search != '') {
      is_search = true;
    }
    else {
      is_search = false;
    }
    if (is_search == false) {
      $.ajax({
        url: 'Assets/php/user.php',
        type: 'POST',
        success: function (data) {
          $('.users-list').html(data);
        }
      });
    }
  }, 500);

});

function Scroll() {
  var scroll_height = $('.chat-zone').height();
  $('.chat-zone').scrollTop(scroll_height + 500)
}

function SendMsg() {
  $.ajax({
    url: 'Assets/php/header.php',
    type: 'POST',
    data: new FormData(form),
    processData: false,
    contentType: false,
    success: function (data) {
      $('.chat-zone').html(data);
      $('.txt-msg').val('');
      Scroll();
    }
  });
}