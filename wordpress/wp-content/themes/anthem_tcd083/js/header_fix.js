jQuery(document).ready(function($){

  var header_message_height = 0;
  if($('#header_message').length){
    header_message_height = $('#header_message').innerHeight();
  }

  if($(window).scrollTop() > 200 + header_message_height) {
    $("body").addClass("header_fix");
  }

  $(window).scroll(function () {
    if($(this).scrollTop() > 200 + header_message_height) {
      $("body").addClass("header_fix");
    } else {
      $("body").removeClass("header_fix");
    };
  });


});