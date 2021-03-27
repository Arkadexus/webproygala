$('nav div').click(function() {
    if($(window).width() < 768) {
        $('#menu').slideToggle();
        $('#menu ul').css('display', 'none');
    }
  });
  
  $('#menu li').click(function() {
    if($(window).width() < 768) {
        $('#menu ul').slideUp();
        $(this).find('ul').slideToggle();
    }
    
  });

  $(window).resize(function() {
  if($(window).width() > 768) {
    $('ul').removeAttr('style');
  }
});