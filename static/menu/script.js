(function($) {

    "use strict";












    //Submenu Dropdown Toggle
    if ($('.main-header li.menu-item-has-children ul').length) {
        $('.main-header li.menu-item-has-children').append('<div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>');

        //Dropdown Button
        $('.main-header li.menu-item-has-children .dropdown-btn').on('click', function() {
            $(this).prev('ul').slideToggle(500);
        });



    }






    //Mobile Nav Hide Show
    if ($('.mobile-menu').length) {

        $('.mobile-menu .menu-box').mCustomScrollbar();

        var mobileMenuContent = $('.main-header .nav-outer .main-menu').html();
        $('.mobile-menu .menu-box .menu-outer').append(mobileMenuContent);


        //Hide / Show Submenu
        $('.mobile-menu .navigation > li.menu-item-has-children > .dropdown-btn').on('click', function(e) {
            e.preventDefault();
            var target = $(this).parent('li').children('ul');

            if ($(target).is(':visible')) {

                $(this).parent('li').removeClass('open');
                $(target).slideUp(500);
                //$(this).parents('.navigation').children('li.dropdown').removeClass('open');
                $(this).parents('.navigation').children('li.menu-item-has-children > ul').slideUp(500);
                return false;
            } else {

                //$(this).parents('.navigation').children('li.dropdown').removeClass('open');
                $(this).parents('.navigation').children('li.menu-item-has-children').children('ul').slideUp(500);
                $(this).parent('li').toggleClass('open');
                $(this).parent('li').children('ul').slideToggle(500);
            }
        });

        $('.mobile-menu .navigation .sc-dropdown .dropdown-btn').on('click', function(e) {
            //e.preventDefault();
            var target = $(this).parent('li').children('ul');

            if ($(target).is(':visible')) {
               
                $(this).parent('li').removeClass('open');
                $(target).slideUp(500);
               //$(this).parents('.navigation').children('.sc-dropdown').removeClass('open');
                $(this).parents('.navigation').children('.sc-dropdown > ul').slideUp(500);
                return false;
            } else {
                
                //$(this).parents('.navigation').children('.sc-dropdown').removeClass('open');
                $(this).parents('.navigation').children('.sc-dropdown').children('ul').slideUp(500);
                $(this).parent('li').toggleClass('open');
                $(this).parent('li').children('ul').slideToggle(500);
            }
        });


        //Menu Toggle Btn
        $('.mobile-nav-toggler').on('click', function() {
            $('body').toggleClass('mobile-menu-visible');
            $('.mobile-menu .navigation > li').toggleClass('open');
            $('.mobile-menu .navigation li ul').slideUp(0);

        });

        //Menu Toggle Btn
        $('.mobile-menu .menu-backdrop').on('click', function() {
            $('body').removeClass('mobile-menu-visible');
            $('.mobile-menu .navigation > li').removeClass('open');
            $('.mobile-menu .navigation li ul').slideUp(0);
        });

        $(document).keydown(function(e) {
            if (e.keyCode == 27) {
                $('body').removeClass('mobile-menu-visible');
                $('.mobile-menu .navigation > li').removeClass('open');
                $('.mobile-menu .navigation li ul').slideUp(0);
            }
        });

    }










})(window.jQuery);