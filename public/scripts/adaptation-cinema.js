$(document).ready(function() {
    
    $(window).scroll( function(){
    
        //Sélectionner l'élément que vous voulez animer//
        $('.card').each( function(i){
            
            //Script permettant de detecter quand l'élément est visible dans votre fenètre//
            var bottom_of_object = $(this).offset().top + $(this).outerHeight();
            var bottom_of_window = $(window).scrollTop() + $(window).height();
            
            if( bottom_of_window > bottom_of_object ){
                
                //Faites les animations que vous voulez//
                $(this).animate({left: '60px'},3000);
                    
            }
            
        }); 
    
    });
    
});


//Script à rajouter dans la base pour que ca marche//
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>