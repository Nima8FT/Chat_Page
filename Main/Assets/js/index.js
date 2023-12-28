const form = document.querySelector(".typing-area");

$(document).ready(function () {

  // alert('nima');

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
    xhr.open("POST", "Assets/php/function.php?search=true", true);
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
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "Assets/php/function.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          $('.chat-zone').html(data);
          var clas = $('.chat-zone').attr('class');
          var split_class = clas.split(" ");
          if (split_class != "active") {
            Scroll();
          }
        }
      }
    };
    let formData = new FormData(form);
    xhr.send(formData);
  }, 500);


  setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "Assets/php/user.php", true);
    xhr.onload = () => {
      if (xhr.readyState == XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          $('.users-list').html(data);
        }
      }
    };
    xhr.send();
  }, 500);

});

function Scroll() {
  var scroll_height = $('.chat-zone').height();
  $('.chat-zone').scrollTop(scroll_height + 500)
}

function SendMsg() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "Assets/php/header.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        $('.chat-zone').html(data);
        $('.txt-msg').val('');
        Scroll();
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
}