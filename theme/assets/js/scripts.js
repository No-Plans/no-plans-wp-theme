var wHeight =  $(window).height();
var wWidth =  $(window).width();
var throttle = 50;


$(document).ready(function(){
  if (wWidth > 760) {
    $('.home video').prop('autoplay', false);
  }

  setTimeout(function(){
    $('.loader').fadeOut(400);
  }, 2000);

  // CLOCK
  function calcTime(city, offset) {
    // create Date object for current location
    var d = new Date();
    // convert to msec
    // add local time zone offset
    // get UTC time in msec
    var utc = d.getTime() + (d.getTimezoneOffset() * 60000);
    var nd_hours = d.getUTCHours();
    // create new Date object for different city
    // using supplied offset
    var nd = new Date(utc + (3600000*offset));

    // return "The local time in " + city + " is " + nd.toLocaleString();
    return nd;
}

    var ldn = calcTime('LDN', '+0').getHours();
    var nyc = calcTime('NYC', '-5').getHours();
    var nyc_full = calcTime('NYC', '-5');

    $('.sunmoon').removeClass('now');

    if (ldn <= 6 || ldn > 19 ) {
      $('.ldn img.moon-up').addClass('now');
    }
    if (ldn > 6 && ldn <= 8 || ldn > 16 && ldn <= 19 ) {
      $('.ldn img.sun-down').addClass('now');
    }
    if (ldn > 8 && ldn <= 16) {
      $('.ldn img.sun-up').addClass('now');
    }
    
    if (nyc <= 6 || nyc > 19 ) {
      $('.nyc img.moon-up').addClass('now');
    }
    if (nyc > 6 && nyc <= 8 || nyc > 16 && nyc <= 19 ) {
      $('.nyc img.sun-down').addClass('now');
    }
    if (nyc > 8 && nyc <= 16) {
      $('.nyc img.sun-up').addClass('now');
    }

  var scrollTimeout;
  var scrolled = false;
  var intro = $('.intro-container').outerHeight();
  var dHeight = $(document).height();
  var wHeightPlus = wHeight * 2;

  $(window).on('scroll', function () {
 
    if (!scrollTimeout) {
      scrollTimeout = setTimeout(function () {

          if ($(window).scrollTop() > intro) {
            $('.logo').addClass('up');
          }
          if ($(window).scrollTop() < intro) {
            $('.logo').removeClass('up');
          }

          if( $(window).scrollTop() + wHeightPlus >= dHeight ) {
              $('.thankyou').addClass('show');
          }
          if($(window).scrollTop() + wHeightPlus < dHeight ) {
              $('.thankyou').removeClass('show');
          }

          $('.home .case-study').each(function() {
            var elementOffset = $(this).position().top;
            var distance = (elementOffset - $(window).scrollTop());

            if (distance < 300) {
            	// pauses all case studies videos
    				$('.case-study').find('video').each(function() {
    				  $(this).get(0).pause();
    				});
				    // play this video
              $(this).find('video')[0].play();
            }
          }); 
      //  }
      scrollTimeout = null;
      }, throttle);
    }
  });

  /* SHOWS ONLY CATEGORY ON CLICK, AND SHOWS EVERYTHING WHEN RE-CLICKED */
    $('.filters button').click(function(){
      // alert('ho');
      if (!$(this).hasClass('active')) {
        var filter_id = $(this).attr('id');
        $('.filters button').removeClass('active');
        $(this).toggleClass('active');
        $('.archive .project').fadeOut('400');
        setTimeout (function(){
          $('.projects').find('.' + filter_id).fadeIn('400');
        }, 400);
        $('html, body').animate({scrollTop:$('#archive').position().top + 0}, 400);
      }
      else {
        $('.filters button').removeClass('active');
        $('.projects .project').fadeIn('400');
        $('html, body').animate({scrollTop:$('#archive').position().top + 0}, 400);
      }
    });

});  



// next prev keyboard
$(document).keydown(function(e) {
  switch(e.which) {
    case 40: // down
      $('html, body').animate({ scrollTop:$('.section.current').next('.section').offset().top}, 'slow');
    break;
    case 38: // up
      $('html, body').animate({ scrollTop:$('.section.current').prev('.section').offset().top}, 'slow');
    break;
     default: return; 
  }
  e.preventDefault();
});



function showImages(e){
  var images = $('.internet');
//  var randomNum = Math.floor((Math.random()*1)+1);
//  $('#internet').attr('src', 'assets/content/fashion/fashion' + randomNum + '.jpg');
  
  images.show();
  // images.addClass('show');
};

function hideImages(e){
  var images = $('.internet');
  images.hide();
  // images.removeClass('show');
};


$(document).ready(function(){
  var trigger = $('.header-menu');
  
  trigger.mouseenter(showImages);
  trigger.mouseleave(hideImages);
  trigger.click(hideImages);
 
});



//  background 
$(document).ready(function(){

  $('.information a, .information button').mouseenter(function(){
    $('.bg').addClass('blur');
  });
  $('.information a, .information button').mouseleave(function(){
    $('.bg').removeClass('blur');
  });

});


$(document).on('mousedown','.project-toggle.project_closed',function(e){

  // store this project variables
  var this_project = $(this);
  var this_project_content = $(this).next();
  // get height of the header
  var header_offset = 0; // $('.header-menu').height();
  
  // close all other projects
  $('.project-toggle').removeClass('project_open').addClass('project_closed');
  $('.project-content').slideUp('400').removeClass('open');
  
  // pauses all videos
  $('video').each(function() {
    $(this).get(0).pause();
  });
  
  // open this project
  this_project.addClass('project_open').removeClass('project_closed');
  this_project_content.slideDown('400').addClass('open');

  // add autoplay for mobile on this project
  if (wWidth <= 760) {
    $('video').prop('autoplay', true);
  }

  setTimeout(function(){
    // retrieve the stored variable but with current position
    var top = this_project.offset().top;
    var scroll_to = top - header_offset; 
    // scroll to the position minus the header
    $('html,body').animate({
            scrollTop: scroll_to
          }, 400);
    this_project_content.find('video')[0].play();
  }, 405);
});

// if project already opened just close it
$(document).on('mousedown','.project-toggle.project_open',function(e){
  $('.project-toggle').removeClass('project_open').addClass('project_closed');
  $('.project-content').slideUp('400').removeClass('open');
});


/* OLD BROKEN SCRIPT YOU CAN DELETE
function showVideo(e){
      var offset = $('.header-menu').height();
      var top = $(this).position().top;
      var scroll = top - offset;
      console.log(offset);


      $('.project-content.open').slideUp('400').removeClass('open');
      $(this).next().slideDown('400').addClass('open');

      setTimeout(function(){ 
        $('html,body').animate({
                scrollTop: scroll
              }, 400);
      }, 400);
}; */

 
