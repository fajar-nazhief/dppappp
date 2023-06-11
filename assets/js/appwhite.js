$(document).ready(function() {
        // Transition effect for navbar 
        $(window).scroll(function() {
          // checks if window is scrolled more than 500px, adds/removes solid class
          if($(this).scrollTop() > 20) { 
              $('.navbar').addClass('solid');
              $('.navbar').addClass('margin:0px;'); 
              $(".logo").attr("src","./logo.png");
          } else {
              $('.navbar').removeClass('solid');
                
              $(".logo").attr("src","./logo.png");
               
          }
        });
});

 // FULL SCREEN 
 var $item = $('.carousel-item'); 
var $wHeight = $(window).height();
$item.eq(0).addClass('active');
$item.height($wHeight); 
$item.addClass('full-screen');

$('.carousel img').each(function() {
  var $src = $(this).attr('src');
  var $color = $(this).attr('data-color');
  $(this).parent().css({
    'background-image' : 'url(' + $src + ')',
    'background-color' : $color
  });
  $(this).remove();
});

$(window).on('resize', function (){
  $wHeight = $(window).height();
  $item.height($wHeight);
});

$('.carousel').carousel({
  interval: 6000,
  pause: "false"
});

// news

  var news = (function(){
  'use strict';
  return {
    // this.js(obj)
    js: function(e){return $("[data-js="+e+"]");},
    // this.lk(obj)
    lk: function(e){return $("[data-lk="+e+"]");},
    // Ready functions
    ready_: function(){this.events();},
    //  functions
    events:function(){
      var self = this;
      var close = $('.news_item_full');
      close.append('<a href="#" data-js="cl" class="cl">X</a>');
      // Get all data js and add clickOn function
      var k = $('a[data-js]');
      k.each(function(i, v){
        i = i+1;
        self.clickOn(i);
      });
      // close on click
      self.js('cl').on("click",function(){
        self.fx_out($('.news_item_full'));
        self.fx_out($('.box'));
      });
      
      // list
      self.js('list').on("click",function(){
        $('.news_item').toggleClass('news_item_list');
        $('.news_item_preview a img').toggleClass('news_line');
      });
    },
    // Show on click
    clickOn: function(i){
      var self = this;
      this.js(i).on('click',function(){
        self.fx_in(self.lk(i)); 
        self.fx_in($('.box'));
      });
    }, 
    // out function
    fx_out: function(el){
      el.addClass('efOut')
      .delay(500)
      .fadeOut('fast')
      .removeClass('efIn');
      $('body').css({overflow:'auto'});
      return false;
    }, 
    // in function
    fx_in: function(el){
      el.removeClass('efOut')
      .show()
      .addClass('efIn');
      $('body').css({overflow:'hidden'});
      return false;
    }
  };
})();
// ready function of news
news.ready_();

// end news
// menu 3 baris
function openNav() {
    document.getElementById("mySidenav").style.width = "285px";
    // document.getElementById("gone").style.display = 'none';
    // document.getElementById("search").style.display = 'none';
    // document.getElementById("lang-menu").style.display = 'none';
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    // document.getElementById("gone").style.display = "inline-flex";
    // document.getElementById("search").style.display = "inline-block";
    // document.getElementById("lang-menu").style.display = "inline-block";
}

// seacrh
jQuery(document).ready(function($) {
  var wHeight = window.innerHeight;
  //search bar middle alignment
  $('#mk-fullscreen-searchform').css('top', wHeight / 2);
  //reform search bar
  jQuery(window).resize(function() {
    wHeight = window.innerHeight;
    $('#mk-fullscreen-searchform').css('top', wHeight / 2);
  });
  // Search
  $('#search-button').click(function() {
    console.log("Open Search, Search Centered");
    $("div.mk-fullscreen-search-overlay").addClass("mk-fullscreen-search-overlay-show");
  });
  $("a.mk-fullscreen-close").click(function() {
    console.log("Closed Search");
    $("div.mk-fullscreen-search-overlay").removeClass("mk-fullscreen-search-overlay-show");
  });
});


// language
$(document).ready(function(){
  ///hover container lang menu
  $("#lang-menu").hover(
  	function(){
      	$(this).addClass("cls-border-lang");
      	$(this).children().eq(0).addClass("cls-borderbottom-lang");
			  $("#lang-menu ul").stop().slideToggle(100);
    },
    function(){
 				$(this).removeClass("cls-border-lang");
      	$(this).children().eq(0).removeClass("cls-borderbottom-lang");
        $("#lang-menu ul").stop().slideToggle(100);  
    }
  );
  /// click languages
  $("#lang-menu ul li").on("click", function(){
    	//select lang and apply changes
    	$lang = $(this).text();
	    $("#lang-menu div").text($lang);
  });

});




// scroll smooth
// $(document).ready(function(){
// 			$fn.scrollSpeed(step, speed, easing);
// 			jQuery.scrollSpeed(200, 800);
// });

// Custom scrolling speed with jQuery
// Source: github.com/ByNathan/jQuery.scrollSpeed
// Version: 1.0.2

// (function($) {
    
//     jQuery.scrollSpeed = function(step, speed, easing) {
        
//         var $document = $(document),
//             $window = $(window),
//             $body = $('html, body'),
//             option = easing || 'default',
//             root = 0,
//             scroll = false,
//             scrollY,
//             scrollX,
//             view;
            
//         if (window.navigator.msPointerEnabled)
        
//             return false;
            
//         $window.on('mousewheel DOMMouseScroll', function(e) {
            
//             var deltaY = e.originalEvent.wheelDeltaY,
//                 detail = e.originalEvent.detail;
//                 scrollY = $document.height() > $window.height();
//                 scrollX = $document.width() > $window.width();
//                 scroll = true;
            
//             if (scrollY) {
                
//                 view = $window.height();
                    
//                 if (deltaY < 0 || detail > 0)
            
//                     root = (root + view) >= $document.height() ? root : root += step;
                
//                 if (deltaY > 0 || detail < 0)
            
//                     root = root <= 0 ? 0 : root -= step;
                
//                 $body.stop().animate({
            
//                     scrollTop: root
                
//                 }, speed, option, function() {
            
//                     scroll = false;
                
//                 });
//             }
            
//             if (scrollX) {
                
//                 view = $window.width();
                    
//                 if (deltaY < 0 || detail > 0)
            
//                     root = (root + view) >= $document.width() ? root : root += step;
                
//                 if (deltaY > 0 || detail < 0)
            
//                     root = root <= 0 ? 0 : root -= step;
                
//                 $body.stop().animate({
            
//                     scrollLeft: root
                
//                 }, speed, option, function() {
            
//                     scroll = false;
                
//                 });
//             }
            
//             return false;
            
//         }).on('scroll', function() {
            
//             if (scrollY && !scroll) root = $window.scrollTop();
//             if (scrollX && !scroll) root = $window.scrollLeft();
            
//         }).on('resize', function() {
            
//             if (scrollY && !scroll) view = $window.height();
//             if (scrollX && !scroll) view = $window.width();
            
//         });       
//     };
    
//     jQuery.easing.default = function (x,t,b,c,d) {
    
//         return -c * ((t=t/d-1)*t*t*t - 1) + b;
//     };
    
// })(jQuery);