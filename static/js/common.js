
$(window).scroll(function(event){
    if($(window).scrollTop() > $(window).height()){
        $(".message").addClass("on");
    }else{
        $(".message").removeClass("on");
    }
})
$(window).scroll(function () {
  if ($(this).scrollTop() > 20) {
    $(".header").stop().show().addClass("sticky");
  }
  else {
    $(".header").stop().removeClass("sticky");
  }
});

$(".user a").click(function(){
  $(".modal").addClass("show in")
})

$(".close").click(function(){
  $(".modal").removeClass("show in");
  $("main").css("z-index","0");
  $(".pup").removeClass("active");

})

$(".index-block .IOlist .col-md-12 a,.index-block .IOlist .col-md-6 a,.index-block .news .evlist .items a").click(function(){
  var num = $(".index-block .IOlist .col-md-12 a,.index-block .IOlist .col-md-6 a,.index-block .news .evlist .items a").index($(this));
  $(".index-block .IOlist .col-md-12,.index-block .IOlist .col-md-6,.index-block .news .evlist .items").eq(num).find(".pup").addClass("active");
  $("main").css("z-index","9999");
  $(".IOlist").css("z-index","99");

})



$(".pup .close,.pupback").click(function(){
  $(".pup").removeClass("active")
  $("main").css("z-index","0");
})


$(".index-block .col-md-2.left h2.mobile").click(function(){
  $(".index-block .col-md-2.left .menu-box,.index-block .col-md-2.left .imgs").slideToggle();
  $(this).toggleClass("show")
})


$(".scroll-top").on('click', function() {
    let target = $(this).attr('data-target');
    $('html, body').animate({
        scrollTop: $(target).offset().top
    }, 300);
});

$(function () {
  $('.sdlist,.index-block .article .con').find('img').each(function () {
    var e = $(this).parent().prev().text();
    $(this).attr('alt', 'articlepic'); 
    $(this).wrap('<a href="' + $(this).attr("src") + '" data-fancybox="images" title="articlepic" alt="articlepic"></a>');
    })

})


$(function(){
    $('#menu-header .menu-item-has-children').hover(function(){
      $(this).addClass('active');
      $(this).removeClass('z-index-8');
    },function(){
       $(this).removeClass('active');
      $(this).addClass('z-index-8');

    })
    $('#menu-header_cn .menu-item-has-children').hover(function(){
      $(this).removeClass('z-index-8');
      $(this).addClass('active');
    },function(){
      $(this).addClass('z-index-8');
      $(this).removeClass('active');
    })

});


var banner = new Swiper(".banner .mySwiper", {
  navigation: {
    nextEl: ".banner .swiper-button-next",
    prevEl: ".banner .swiper-button-prev",
  },
  autoplay:true,
  speed:800,
  pagination: {
    el: ".swiper-pagination",
  },

});




$(".menu-box ul .li").on('click',function () {
  var num = $(".menu-box ul .li").index($(this));

  if($(".menu-box ul .li dl").eq(num).css("display")=="none"){
      $(".menu-box ul .li").find(".fa-caret-up").hide();
      $(".menu-box ul .li").find(".fa-caret-down").show();
      $(".menu-box ul .li").eq(num).find(".fa-caret-down").toggle();
      $(".menu-box ul .li").eq(num).find(".fa-caret-up").toggle();
      $(".menu-box ul .li dl").hide();
      $(".menu-box ul .li dl").eq(num).toggle();
  }else{
      $(".menu-box ul .li").eq(num).find(".fa-caret-down").show();
      $(".menu-box ul .li").find(".fa-caret-up").hide();
      $(".menu-box ul .li dl").hide();
  }
});



$(".faq ul .li a.fs18").on('click',function () {
  var num = $(".faq ul .li a.fs18").index($(this));

  if($(".faq ul .li .con").eq(num).css("display")=="none"){
      $(".faq ul .li").find(".fa-angle-up").hide();
      $(".faq ul .li").find(".fa-angle-down").show();
      $(".faq ul .li").eq(num).find(".fa-angle-down").toggle();
      $(".faq ul .li").eq(num).find(".fa-angle-up").toggle();
      $(".faq ul .li .con").hide();
      $(".faq ul .li .con").eq(num).toggle();
  }else{
      $(".faq ul .li").eq(num).find(".fa-angle-down").show();
      $(".faq ul .li").find(".fa-angle-up").hide();
      $(".faq ul .li .con").hide();
  }
});

var productstop = new Swiper(".nximg .mySwiper", {
	spaceBetween: 10,
	slidesPerView: 6,
	freeMode: true,
	watchSlidesProgress: true,
	breakpoints: {
		360: {
			slidesPerView: 3,
		},
		320: {
			slidesPerView: 3,
		},
		375: {
			slidesPerView: 3,
		},
		414: {
			slidesPerView: 3,
		},
		767: {
			slidesPerView: 3,
		},
		768: {
			slidesPerView: 3,
		},
		1024: {
			slidesPerView: 4,
		},
		1280: {
			slidesPerView: 6,
		},
	}
});
var productsbottom = new Swiper(".ndimg .mySwiper2", {
	spaceBetween: 0,
	thumbs: {
	  swiper: productstop,
	},
	speed:1200,
  pagination: {
    el: ".swiper-pagination",
    type: "fraction",
  },
  navigation: {
    nextEl: ".nximg .swiper-button-next",
    prevEl: ".nximg .swiper-button-prev",
  }
  
	
});



var Mentorshiplist = new Swiper(".Mentorshiplist .mySwiper", {
  navigation: {
    nextEl: ".Mentorshiplist .swiper-button-next",
    prevEl: ".Mentorshiplist .swiper-button-prev",
  },
});

$(document).ready(function() {
  var $tab_li = $('.Offerings-block .col-md-8 .yuan ul li');
  $tab_li.mouseover(function() {
      $(this).addClass('active').siblings().removeClass('active');
      var index = $tab_li.index(this);
      $('.Offerings-block .content .txt').eq(index).show().siblings().hide();
      $('.Offerings-block .items .imgs').eq(index).show().siblings().hide();

  });

});

$('.index-block .Academic .tags a').click(function() {
  var target = document.getElementById(this.hash.slice(1));
  if (!target) return;
  $('html,body').animate({scrollTop: $(target).offset().top-90},100);
  var wsw = window.screen.width;
  if( wsw <=1520){
    $('html,body').animate({scrollTop: $(target).offset().top-140},100);
  }
  if( wsw <=620){
    $('html,body').animate({scrollTop: $(target).offset().top-170},100);
  }
  return false;
  
});

$(document).ready(function(){
  var $tab_litab2 = $('.index-block .Academic .tags a');
  $tab_litab2.click(function(){
    $(this).addClass('active').siblings().removeClass('active');
  });

});


certifySwiper = new Swiper('#certify .swiper-container', {
  watchSlidesProgress: true,
  slidesPerView: 'auto',
  centeredSlides: true,
  loop: true,
  loopedSlides: 5,
  autoplay: true,
  navigation: {
      nextEl: '#certify .swiper-button-next',
      prevEl: '#certify .swiper-button-prev',
  },
  pagination: {
      el: '#certify .swiper-pagination',
      clickable :true,
  },
  on: {
      progress: function(progress) {
          for (i = 0; i < this.slides.length; i++) {
              var slide = this.slides.eq(i);
              var slideProgress = this.slides[i].progress;
              modify = 1;
              if (Math.abs(slideProgress) > 1) {
                  modify = (Math.abs(slideProgress) - 1) * 0.3 + 1;
              }
              translate = slideProgress * modify * 260 + 'px';
              scale = 1 - Math.abs(slideProgress) / 5;
              zIndex = 999 - Math.abs(Math.round(10 * slideProgress));
              slide.transform('translateX(' + translate + ') scale(' + scale + ')');
              slide.css('zIndex', zIndex);
              slide.css('opacity', 1);
              if (Math.abs(slideProgress) > 3) {
                  slide.css('opacity', 0);
              }
          }
      },
      setTransition: function(transition) {
          for (var i = 0; i < this.slides.length; i++) {
              var slide = this.slides.eq(i)
              slide.transition(transition);
          }

      }
  }

})


$(document).ready(function() {
  $('.index-block .faq ul li a.fs18').click(function(e) {
    e.preventDefault(); 
    var targetPosition = $(this).offset().top;
    $('html, body').animate({
      scrollTop: targetPosition
    }, 100); 
  });
});