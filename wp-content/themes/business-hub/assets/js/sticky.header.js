jQuery(document).ready(function ($) {
    //Sticky header 
    jQuery(window).scroll(function($) {            

    var header_ht = jQuery( '.full-nav-menu' ).height();

    if (jQuery(this).scrollTop() > header_ht){          

        jQuery('.full-nav-menu').addClass("sticky-header");             

    }else{          

        jQuery('.full-nav-menu').removeClass("sticky-header");  
        
    }   
    
});     
});
