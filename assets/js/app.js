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
              if($('.logoputih').val()=='1'){
                
              $(".logo").attr("src","./logo.png");
              }else{
                
              $(".logo").attr("src","./logoputih.png");
              }
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



function charts(a,b,c,d) {
    
    
  Highcharts.chart(a, {
    chart: {
        type: 'bar' 
    },
    title: {
        text: c
    },
    legend: {
        enabled: false
    },
    subtitle: {
        text: d
    },
    data: {
        csvURL: b,
        enablePolling: false 
    },
    plotOptions: {
        bar: {
            colorByPoint: true
        },
        series: {
          zones: [{
            color: '#4CAF50',
            value: 0
        }, {
            color: '#8BC34A',
            value: 100000
        }, {
            color: '#CDDC39',
            value: 200000
        }, {
            color: '#CDDC39',
            value: 300000
        }, {
            color: '#FFEB3B',
            value: 400000
        }, {
            color: '#FFEB3B',
            value: 500000
        }, {
            color: '#FFC107',
            value: 600000
        }, {
            color: '#FF9800',
            value: 700000
        }, {
            color: '#FF5722',
            value: 800000
        }, {
            color: '#F44336',
            value: 9000000
        }, {
            color: '#F44336',
            value: Number.MAX_VALUE
        }],
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            }
        }
    },
    tooltip: {
        valueDecimals: 0,
        valueSuffix: ' Orang'
    },
    xAxis: {
        type: 'category',
        labels: {
            style: {
                fontSize: '10px'
            }
        }
    },
    yAxis: { 
        title: false,
        plotBands: [{
            from: 0,
            to: 30,
            color: '#E8F5E9'
        }, {
            from: 30,
            to: 70,
            color: '#FFFDE7'
        }, {
            from: 70,
            to: 100,
            color: "#FFEBEE"
        }]
    }
});
}


function chartcolumn(a,b,c,d){
  Highcharts.chart(a, {
      chart: {
          type: 'column'
      },
      data: {
          // enablePolling: true,
          csvURL: b
      },
      plotOptions: {
          bar: {
              colorByPoint: true
          },
          series: {
            zones: [{
              color: '#4CAF50',
              value: 0
          }, {
              color: '#8BC34A',
              value: 10
          }, {
              color: '#CDDC39',
              value: 20
          }, {
              color: '#CDDC39',
              value: 30
          }, {
              color: '#FFEB3B',
              value: 40
          }, {
              color: '#FFEB3B',
              value: 50
          }, {
              color: '#FFC107',
              value: 60
          }, {
              color: '#FF9800',
              value: 70
          }, {
              color: '#FF5722',
              value: 80
          }, {
              color: '#F44336',
              value: 90
          }, {
              color: '#F44336',
              value: Number.MAX_VALUE
          }],
              dataLabels: {
                  enabled: true,
                  format: '{point.y:.0f}'
              }
          }
      },
      title: {
          text: c
      },
      yAxis: {
          title: {
              text: d
          }
      }
  });
}

function getFormData(data) {
  var unindexed_array = data;
  var indexed_array = {};

  $.map(unindexed_array, function(n, i) {
   indexed_array[n['name']] = n['value'];
  });

  return indexed_array;
}

function frm2json(namaform){
 var data =  myApp.formToJSON($('#'+namaform));
 // var data = $("#"+namaform).serializeArray();
  return (JSON.stringify((data)));
}

function tgls(a){
  var dateAr = a.split('-');
  //alert(JSON.stringify(dateAr))
return  dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0];
}




function api(url,method,form, callback){ 
  var dataarr='';
  if(method==='post'){
      var frmdata = frm2json(form);
  }
   
  
  $.ajax({
      url: url,
      dataType: 'json',
      type: method,
      contentType: 'application/json',
      data: frmdata,
      processData: false,
      success: function( data, textStatus, jQxhr ){
          //alert(data.status);
           
               

              callback(data);
              
              //localStorage.setItem("Token", data.token); 
              //mainView.router.loadPage('about.html');
         
           
      },
      error: function( jqXhr, textStatus, errorThrown ){
          alert('error');
          
      }
  });
             


  } 

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