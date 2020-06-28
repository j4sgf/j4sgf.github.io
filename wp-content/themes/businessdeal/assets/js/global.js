jQuery(document).ready(function($) {

  jQuery('.main-navigation .menu-toggle').click(function() {
    jQuery('.main-navigation ul.nav-menu, .main-navigation .menu > ul').slideToggle();
  });

  //responsive sub menu toggle

  jQuery('.menu-item-has-children > a, .page_item_has_children > a').after('<button class="dropdown-toggle" aria-expanded="false"> <i class="fas fa-chevron-down"></i> </button>');

  jQuery('.main-navigation button.dropdown-toggle').click(function() {
    jQuery(this).toggleClass('active');
    jQuery(this).parent().find('.sub-menu').first().slideToggle();
  });

  //mobile sub menu
  jQuery('.dropdown-toggle').on("click", function(e) {
    e.preventDefault();
    jQuery(this).attr('aria-expanded', function(index, attr) {
      return attr == 'true' ? 'false' : 'true';
    });
  });

  //Touch on focus
  jQuery("body").click(function(){
    jQuery("#primary-menu li").removeClass("focus");
  });

  /* Secondary Menu on Mobile */
  jQuery('.secondary-navigation .secondary-menu-toggle').click(function() {
    jQuery('.secondary-navigation ul.secondary-menu').slideToggle();
  });

  jQuery(document).ready(function($){ $('.secondary-navigation .menu-item-has-children').hover(
        function(){$(this).addClass("dropdown-children");},
        function(){$(this).removeClass("dropdown-children");}
      );

    $('.secondary-navigation .menu-item-has-children a').on('focus blur',
      function(){$(this).parents().toggleClass("dropdown-children");}
    );
  });
  

  //Toggle header search
  $(document).ready(function () {
      $(document).click(function () {
          $('.search-container').slideUp();
          $('.search-toggle').removeClass('open');
      });
      $('.search-toggle').click(function (e) {
          e.stopPropagation();
          $('.search-container').slideToggle();
          $('.search-toggle').toggleClass('open');
      });
      $('.search-container, .search-toggle').click(function (e) {
          e.stopPropagation();
      });
  });

  /*Scroll to Top*/
  jQuery(document).ready(function() {
    // Start Scroll To Top
    var btn = jQuery('.back-to-top');
    jQuery(window).scroll(function() {
      if ($(this).scrollTop() >= 300) {
        btn.show();
        btn.addClass('active');
      } else {
        btn.hide();
        btn.removeClass('active');
      }
    });

    btn.click(function() {
      jQuery('html, body').animate({
        scrollTop: 0
      }, 600);
      return false;
    });
    // End Scroll To Top
  });

  /* Toggle */
  var smallScreen = window.matchMedia("(max-width: 768px)");
    if (smallScreen.matches){
      var toggleBtn1 = jQuery('.menu-toggle');
      var startEnd1 = jQuery('.main-navigation #primary-menu > li:last-child');
      toggleBtn1.on('click', function() {
        $(this).toggleClass('toggle-on');
        $('.main-navigation').toggleClass('active');
      });

      function focusTrap(e, dir, $dest) {
        // dir = back tab or forward tab direction
        // $dest = where focus should go from here
        var isTab = (e.key === 'Tab' || e.keyCode === 9);

        if (!isTab) {
          return;
        }

        if ((dir === 'prev' && e.shiftKey /* shift + tab */) || (dir === 'next' && !e.shiftKey)) {
          $dest.focus();
          e.preventDefault();
        } else {
          return;
        }
      }
        // set focus trap when menu is open
        toggleBtn1.on('keydown', function (e) {
          if ($('.main-navigation.active').length) {
            focusTrap(e, 'prev', startEnd1);
          }
        });
        startEnd1.on('keydown', function (e) {
          focusTrap(e, 'next', toggleBtn1);
        })

        var toggleBtn2 = jQuery('.secondary-menu-toggle');
        var startEnd2 = jQuery('.secondary-navigation .secondary-menu > li:last-child');

         toggleBtn2.on('click', function() {
          $(this).toggleClass('toggle-on');
          $('.secondary-navigation').toggleClass('active');
        });

        function focusTrap(e, dir, $dest) {
          // dir = back tab or forward tab direction
          // $dest = where focus should go from here
          var isTab = (e.key === 'Tab' || e.keyCode === 9);

          if (!isTab) {
            return;
          }

          if ((dir === 'prev' && e.shiftKey /* shift + tab */) || (dir === 'next' && !e.shiftKey)) {
            $dest.focus();
            e.preventDefault();
          } else {
            return;
          }
        }
          // set focus trap when menu is open
          toggleBtn2.on('keydown', function (e) {
            if ($('.secondary-navigation.active').length) {
              focusTrap(e, 'prev', startEnd2);
            }
          });
          startEnd2.on('keydown', function (e) {
            focusTrap(e, 'next', toggleBtn2);
          })
    }

  /*Counter*/
  function counter(){   
    $('.counter').each(function(){
        if ($(this).hasClass('active')){
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();
            if(elementBottom > viewportTop && elementTop < viewportBottom){                               
                if(($(this).text()) % 1 === 0){
                    var decimalpoint = 0;
                }else{
                    var decimalpoint = ($(this).text()).toString().split(".")[1].length;
                }
                $(this).removeClass('active');
                $(this).animate({
                    Counter: $(this).text()
                },{
                    duration: 2000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(now.toFixed(decimalpoint).toLocaleString('en'));
                    }
                });
            }
        }
    });
  }
  $(document).on('ready', counter);
  $(window).on('scroll', counter);

});