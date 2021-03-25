$("header").css("position", "fixed");

$(window).scroll(function(){
      var scroll = $(window).scrollTop();
      if (scroll > 50){
        $("header").addClass('scrolleado');
      }else{
        $("header").removeClass('scrolleado');
      }
    })
    