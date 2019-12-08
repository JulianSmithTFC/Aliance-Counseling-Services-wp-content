( function( $ ) {
  "use strict";



  // ------------------------------------

  // HELPER FUNCTIONS TO TEST FOR SPECIFIC DISPLAY SIZE (RESPONSIVE HELPERS)

  // ------------------------------------

  function is_display_type(display_type){
    return ( ($('.display-type').css('content') == display_type) || ($('.display-type').css('content') == '"'+display_type+'"'));
  }
  function not_display_type(display_type){
    return ( ($('.display-type').css('content') != display_type) && ($('.display-type').css('content') != '"'+display_type+'"'));
  }







  // DOCUMENT READY
  $( function() {

    if($('.peeking-form-w').length){
      
      $('.pf-trigger, .pf-close-trigger').click(function(){
        $('.peeking-form-w').toggleClass('active');
        return false;
      });
    }

    $('.os-faq-item ').on('click', function(){
      $(this).find('.os-faq-answer').slideToggle();
      return false;
    });

    // SLIDER LOGIC - START

    $('.control-slide').on('click', function(){
      var $this = $(this);
      $this.closest('.slider-controls').find('.control-slide.active').removeClass('active');
      $this.addClass('active');
      var $will_be_inactive_slide = $this.closest('.os-slider-w').find('.os-slide-w.active').removeClass('active').addClass('will-be-inactive');
      var slide_id = $this.data('slide-id');

      setTimeout(function(){
        $will_be_inactive_slide.removeClass('will-be-inactive');
        $this.closest('.os-slider-w').find('.os-slide-w[data-slide-id="' + slide_id + '"]').addClass('active');
      }, 700);

      return false;
    });

    if($('.os-slider-w').length){
      var slide_delay = parseInt($('.os-slider-w').data('autoslide'));
      if(slide_delay > 0){
        setInterval(function(){
          $('.os-slider-w .slide-navi-next, .os-slider-w .slide-navi-next-v2').click();
        }, slide_delay);
      }
    }

    $('.slide-navi-next, .slide-navi-next-v2').on('click', function(){
      var $active_slide = $('.os-slide-w.active');
      var $next_slide = $active_slide.next('.os-slide-w');
      if(!$next_slide.length){
        $next_slide = $('.os-slide-w:first');
      }
      var next_slide_id = $next_slide.data('slide-id');
      $(this).closest('.os-slider-w').find('.control-slide').removeClass('active');
      $(this).closest('.os-slider-w').find('.control-slide[data-slide-id="' + next_slide_id + '"]').addClass('active');
      $('.os-slide-w').removeClass('active');
      $next_slide.addClass('active');
      return false;
    });
    $('.slide-navi-prev, .slide-navi-prev-v2').on('click', function(){
      var $active_slide = $('.os-slide-w.active');
      var $next_slide = $active_slide.prev('.os-slide-w');
      if(!$next_slide.length){
        $next_slide = $('.os-slide-w:last');
      }
      var next_slide_id = $next_slide.data('slide-id');
      $(this).closest('.os-slider-w').find('.control-slide').removeClass('active');
      $(this).closest('.os-slider-w').find('.control-slide[data-slide-id="' + next_slide_id + '"]').addClass('active');
      $('.os-slide-w').removeClass('active');
      $next_slide.addClass('active');
      return false;
    });


    // SLIDER LOGIC - END


    var $testimonials = $(".testimonials-slider");
    if ($testimonials.length) {
      $testimonials.owlCarousel({
        items: 1,
        loop: true,
        nav: true,
        dots: false,
        navText : ['<i class="os-icon os-icon-chevron-thin-left"></i>', '<i class="os-icon os-icon-chevron-thin-right"></i>']
      });
    }


    var $recent_posts = $(".recent-posts-slider");
    if ($recent_posts.length) {
      $recent_posts.owlCarousel({
        items: 3,
        loop: true,
        nav: true,
        dots: false,
        navText : ['<i class="os-icon os-icon-chevron-thin-left"></i>', '<i class="os-icon os-icon-chevron-thin-right"></i>'],
        responsive : {
          0 : { items : 1 },
          480 : { items : 2 },
          768 : { items : 2 },
          992 : { items : 3 }
        }
      });
    }


    // index gallery navigation
    $('.gallery-image-next').on('click', function(){
      var $item_media = $(this).closest('.archive-item-media');
      var $item_thumbnail = $item_media.find('.archive-item-media-thumbnail');
      var $next_source = $item_media.find('.gallery-image-source.active').next('.gallery-image-source');
      if(!$next_source.length) $next_source = $item_media.find('.gallery-image-source').first();
      $item_media.find('.gallery-image-source').removeClass('active');
      $next_source.addClass('active');
      $item_thumbnail.css('background-image', 'url(' + $next_source.data('gallery-image-url') + ')');
    });

    $('.print-recipe-btn').on('click', function(){
      window.print();
      return false;
    });

    $('.share-recipe-btn, .trigger-share-recipe-lightbox').on('click', function(){
      if($('.full-screen-share-box').length){
        $('.full-screen-share-box').remove();
      }else{
        $('body').append('<div class="full-screen-share-box"><div class="post-share-box">' + $('.post-share-box').html() + '</div></div>');
      }
      return false;
    });

    $('body').on('click', '.full-screen-share-box .psb-close', function(){
      $('.full-screen-share-box').remove();
      return false;
    });

    $('body').on('click', '.full-screen-share-box', function(e){
      if (e.target !== this)
        return;
      $('.full-screen-share-box').remove();
      return false;
    });



    // timed scroll event
    var uniqueCntr = 0;
    $.fn.scrolled = function (waitTime, fn) {
        if (typeof waitTime === "function") {
            fn = waitTime;
            waitTime = 50;
        }
        var tag = "scrollTimer" + uniqueCntr++;
        this.scroll(function () {
            var self = $(this);
            var timer = self.data(tag);
            if (timer) {
                clearTimeout(timer);
            }
            timer = setTimeout(function () {
                self.removeData(tag);
                fn.call(self[0]);
            }, waitTime);
            self.data(tag, timer);
        });
    }

    if($('.top-menu').length && $('.fixed-header-w').length){
      $(window).scrolled(function(){
          var offset = $('.top-menu').offset();
          var trigger_point = offset.top + $('.top-menu').outerHeight();
          if($(document).scrollTop() >= trigger_point){
            $('body').addClass('fix-top-menu');
          }else{
            $('body').removeClass('fix-top-menu');
          }
      });
    }



    /// ------------------
    /// BOOKMARKS CLOSE BUTTON
    /// ------------------
    
    $('.single-recipe-bookmark-box .close-btn').on('click', function(){
      $('.single-recipe-bookmark-box .userpro-bm').slideToggle();
      return false;
    });



    $('.read-comments-link').on('click', function(){
      $('.comment-list').toggle();
      return false;
    });

    $('.search-trigger, .mobile-menu-search-toggler').on('click', function(){
      $('body').addClass('active-search-form');
      $('.main-search-form-overlay').fadeIn(300);
      $('.main-search-form .search-field').focus();
    });

    $('.main-search-form-overlay').on('click', function(){
      $('body').removeClass('active-search-form');
      $('.main-search-form-overlay').fadeOut(300);
    });



    /// ------------------
    /// mobile menu activator
    /// ------------------
    $('.mobile-menu-toggler').on('click', function(){
      $('.mobile-header-menu-w').slideToggle(400);
    });


    $(document).keyup(function(e) {
      if (e.keyCode == 27) { 
        $('body').removeClass('active-search-form');
        $('.main-search-form-overlay').fadeOut(300);
      }
    });



    // REGULAR POST GALLERY
    var $post_gallery = $(".single-post-gallery-images-i");
    if ($post_gallery.length) {
      $post_gallery.owlCarousel({
        items: 4,
        loop: false,
        nav: $post_gallery.find('.gallery-image-source').length > 4 ? true : false,
        dots: false,
        navText : ['<i class="os-icon os-icon-arrow-left"></i>', '<i class="os-icon os-icon-arrow-right"></i>']
      });
    }


    $('.single-post-gallery-images .gallery-image-source').on('click', function(){
      var image_id = $(this).data('image-id');
      $('.single-main-media-image-w.active').removeClass('active');
      $('#'+image_id).addClass('active');
      return false;
    });


    // STICKY POSTS
    var $sticky_owl = $(".sticky-posts-owl-slider");
    if ($sticky_owl.length) {
      $sticky_owl.owlCarousel({
        items: 1,
        loop: false,
        nav: true,
        dots: true,
        navText : ['<i class="os-icon os-icon-arrow-left"></i>', '<i class="os-icon os-icon-arrow-right"></i>']
      });
    }

    // Tooltip

    $('.tooltip-trigger').on({
      mouseenter: function(){
        var tooltip_header = $(this).data('tooltip-header');
        $(this).append('<div class="tooltip-box"><div class="tooltip-box-header">'+ tooltip_header +'</div></div>');
      },
      mouseleave: function(){
        $(this).find('.tooltip-box').remove();
      }
    });



    // --------------------------------------------

    // ACTIVATE TOP MENU

    // --------------------------------------------

    // MAIN TOP MENU HOVER DELAY LOGIC
    var menu_timer;
    $('.menu-activated-on-hover > ul > li.menu-item-has-children').mouseenter(function(){
      var $elem = $(this);
      clearTimeout(menu_timer);
      $elem.closest('ul').addClass('has-active').find('> li').removeClass('active');
      $elem.addClass('active');
    });
    $('.menu-activated-on-hover > ul > li.menu-item-has-children').mouseleave(function(){
      var $elem = $(this);
      menu_timer = setTimeout(function(){
        $elem.removeClass('active').closest('ul').removeClass('has-active');

      }, 200);
    });

    // SUB MENU HOVER DELAY LOGIC
    var sub_menu_timer;
    $('.menu-activated-on-hover > ul > li.menu-item-has-children > ul > li.menu-item-has-children').mouseenter(function(){
      var $elem = $(this);
      clearTimeout(sub_menu_timer);
      $elem.closest('ul').addClass('has-active').find('> li').removeClass('active');
      $elem.addClass('active');
      if($elem.length){
        var sub_menu_right_offset = $elem.offset().left + ($elem.outerWidth() * 2);
        if(sub_menu_right_offset >= $('body').width()){
          $elem.addClass('active-left');
        }
      }
    });
    $('.menu-activated-on-hover > ul > li.menu-item-has-children > ul > li.menu-item-has-children').mouseleave(function(){
      var $elem = $(this);
      sub_menu_timer = setTimeout(function(){
        $elem.removeClass('active').removeClass('active-left').closest('ul').removeClass('has-active');

      }, 200);
    });


    $('.menu-activated-on-click li.menu-item-has-children > a').on('click', function(event){
      var $elem = $(this).closest('li').find('.sub-menu');
      $elem.slideToggle(300);
      return false;
    });


    // SHARE POST LINK
    $('.post-control-share, .single-panel .psb-close').on('click', function(){
      $('.post-share-box').slideToggle(500);
      return false;
    });

    // select all text on click when trying to share a url
    $('.psb-url-input').on('click', function(){
      $(this).select();
    });


  } );


} )( jQuery );
