$(document).ready(function() {
    
    $(window).scroll(function(){
        let scrolledFromTop = $(window).scrollTop() + $(window).height();

        $(".carte").each(function(){
          let distanceFromTop = $(this).offset().top;
          if(scrolledFromTop >= distanceFromTop+100){
            $(this).animate({right:0, opacity:1 },2000);
          }
        });
    });
});