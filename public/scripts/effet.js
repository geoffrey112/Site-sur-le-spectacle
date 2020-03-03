$(document).ready(function() {
    
    $(window).scroll(function(){
        let scrolledFromTop = $(window).scrollTop() + $(window).height();

        $(".carte").each(function(){
          let distanceFromTop = $(this).offset().top;
          if(scrolledFromTop >= distanceFromTop+100){
            $(this).animate({right:0, opacity:1 },2000);
          }
        });

        $(".contentText").each(function(){
            let distanceFromTop = $(this).offset().top;
            if(scrolledFromTop >= distanceFromTop+100){
              $(this).animate({left:0, opacity:1 },2000);
            }
        });

        $(".contentRea").each(function(){
            let distanceFromTop = $(this).offset().top;
            if(scrolledFromTop >= distanceFromTop+100){
              $(this).animate({right:0, opacity:1 },2000);
            }
        });

        $(".contact").each(function(){
            let distanceFromTop = $(this).offset().top;
            if(scrolledFromTop >= distanceFromTop+0){
              $(this).animate({right:0, opacity:1 },2000);
            }
        });

        $(".form").each(function(){
            let distanceFromTop = $(this).offset().top;
            if(scrolledFromTop >= distanceFromTop+0){
              $(this).animate({top:0, opacity:1 },2000);
            }
        });
    });
});