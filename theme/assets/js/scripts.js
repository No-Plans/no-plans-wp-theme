var wHeight =  $(window).height();
var wWidth =  $(window).width();
var throttle = function (fn, wait) {
  var time = Date.now();
  return function() {
    if ((time + wait - Date.now()) < 0) {
      fn();
      time = Date.now();
    }
  }
};

var App = {};

App.window = {
  width: wWidth,
  height: wHeight
};

App.loadRespVideo = function ($video, callback) {
  if (!$video || $video.length < 1) return false;
  if ($video.data('lazy') === 'loaded') return callback;
  winW = this.window.width;
  winH = this.window.height;
  portraitMode = winW < winH;
  var HD = portraitMode ? winW >= 768 : winW >= 812;
  // get best src
  var srcset = $video.data('lazy-srcset');
  srcset = srcset ? srcset.split(',') : [];
  var src = HD && srcset[1] ? srcset[1] : srcset[0];
  // load src
  if (!src) return console.warn('No videos in data-lazy-srcset');
  $video.attr('src', src).attr('lazy', 'loaded').removeAttr('data-lazy-srcset');
  return callback;
};

App.pauseAllVideos = function () {
  $('video').each(function() {
    var vid = $(this).get(0);
    if (!vid.paused) return vid.pause();
  });
};


// ready
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

  var afterScroll;
  var afterScrollDelay = 100;
  // var scrolled = false;
  var intro = $('.intro-container').outerHeight();
  var dHeight = $(document).height();
  var wHeightPlus = wHeight * 2;
  var lazyVids = '.home .case-study video[data-lazy-srcset]';

  // load responsive videos based on scroll position
  var loadVideosByScrollPos = function (selector, y) {
    var videos = $(selector);
    if (videos.length < 1) return;
    videos.each(function () {
      $this = $(this);
      elTop = $this.offset().top;
      if (elTop <= y + wHeightPlus) return App.loadRespVideo($this);
    });
  };

  var playVideosInView = function (vid) {
    $('.home .case-study video').each(function() {
      var vid = $(this).get(0);
      var edges = vid.getBoundingClientRect(); // distance from window top
      var inView = 0 < edges.bottom && edges.top <= wHeight;
      var isPaused = vid.paused;
      if (inView) {
        if (isPaused) return vid.play();
      } else {
        if (!isPaused) return vid.pause();
      }
    });
  }

  var toggleLogo = function (y) {
    if (y > intro) {
      $('.logo').addClass('up');
    }
    if (y < intro) {
      $('.logo').removeClass('up');
    }
  };

  var toggleThankYou = function (y) {
    if (y + wHeightPlus >= dHeight) {
      $('.thankyou').addClass('show');
    }
    if (y + wHeightPlus < dHeight) {
       $('.thankyou').removeClass('show');
    }
  }

  // scroll handler
  var onScroll = throttle(function () {
    var scrollTop = $(window).scrollTop();
    loadVideosByScrollPos(lazyVids, scrollTop);
    // scroll timeout
    clearTimeout(afterScroll);
    afterScroll = setTimeout(function () {
      toggleLogo(scrollTop);
      toggleThankYou(scrollTop);
      playVideosInView();
    }, afterScrollDelay);
  }, 100);

  // set videos on ready
  loadVideosByScrollPos(lazyVids, $(window).scrollTop());
  playVideosInView();
  // on scroll
  $(window).on('scroll', onScroll);

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

// toggle projects
$(document).on('mousedown','.project-toggle.project_closed', function (e) {

  // store this project variables
  var this_project = $(this);
  var this_project_content = $(this).next();
  // get height of the header
  var header_offset = 0; // $('.header-menu').height();
  
  // close all other projects
  $('.project-toggle').removeClass('project_open').addClass('project_closed');
  $('.project-content').slideUp('400').removeClass('open');

  // open this project
  this_project.addClass('project_open').removeClass('project_closed');
  this_project_content.slideDown('400').addClass('open');

  // add autoplay for mobile on this project
  /* delete ?
  if (wWidth <= 760) {
    $('video').prop('autoplay', true);
  }
  */

  // pause all videos
  App.pauseAllVideos();

  // play video
  var video = this_project_content.find('video');
  App.loadRespVideo(video, function () {
    video.play();
  });

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
  App.pauseAllVideos();
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

 
