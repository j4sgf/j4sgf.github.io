jQuery(document).ready(function($) {
  //For RTL
  var RTL = false;
  if( $('html').attr('dir') == 'rtl' ) {
  RTL = true;
  }
  //Slider
  jQuery('.banner-list').slick({
    autoplay: true,
    infinite: true,
    speed: 1000,
    cssEase: 'linear',
    fade: true,
    adaptiveHeight: true,
    rtl: RTL,
    rows: 0,
    dots: true,
    slidesToShow: 1,
    slidesToScroll: 1
  });

    jQuery(".main-content-area .testimonial-slide, .advertise-area .testimonial-slide").slick({
   
    autoplay: true,
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    speed: 2000,
    autoplaySpeed: 1000,
    rtl: RTL,
    rows: 1,
    nextArrow: '<i class="testimonial-slide-nav cs-prev fas fa-angle-right"></i>',
    prevArrow: '<i class="testimonial-slide-nav cs-next fas fa-angle-left"></i>',
    responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },

                    {
                        breakpoint: 960,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
  });

    jQuery("#secondary .testimonial-slide, #colophon .testimonial-slide").slick({
    autoplay: true,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    speed: 1000,
    rtl: RTL,
    rows: 0,
    nextArrow: '<i class="testimonial-slide-nav cs-prev fas fa-angle-right"></i>',
    prevArrow: '<i class="testimonial-slide-nav cs-next fas fa-angle-left"></i>',
  });
  
});