jQuery(document).ready(function ($) {

    $('.main-navigation').meanmenu();
  
    $('.scroll-down').click(function (event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $('#scroll').offset().top
        }, 1000);
    });

    // @uses business_hub_load_owl_scripts()
    var owl = $('#main-slider .owl-carousel');
        owl.owlCarousel({
        nav: owl.children().length > 1,
        autoplay: true,
        slideSpeed: business_hub_script_vars.slideSpeed,
        autoplayTimeout: business_hub_script_vars.autoplayTimeout,
        navText: ['', ''],
        items: 1,
        loop: owl.children().length > 1
    });

    //Click event to scroll to top
    $('.go-to-top-link').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });	
});
