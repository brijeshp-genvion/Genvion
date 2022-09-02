jQuery(document).ready(function($) {

    /*------------------------------------------------
                DECLARATIONS
    ------------------------------------------------*/
    
        var loader = $('#loader');
        var loader_container = $('#preloader');
        var scroll = $(window).scrollTop();  
        var scrollup = $('.backtotop');
        var menu_toggle = $('.menu-toggle');
        var dropdown_toggle = $('.main-navigation button.dropdown-toggle');
        var nav_menu = $('.main-navigation ul.nav-menu');
    
    /*------------------------------------------------
                PRELOADER
    ------------------------------------------------*/
    
        loader_container.delay(1000).fadeOut();
        loader.delay(1000).fadeOut("slow");
    
    /*------------------------------------------------
                BACK TO TOP
    ------------------------------------------------*/
    
        $(window).scroll(function() {
            if ($(this).scrollTop() > 1) {
                scrollup.css({bottom:"25px"});
            } 
            else {
                scrollup.css({bottom:"-100px"});
            }
        });
    
        scrollup.click(function() {
            $('html, body').animate({scrollTop: '0px'}, 800);
            return false;
        });
    
    /*------------------------------------------------
                MAIN NAVIGATION
    ------------------------------------------------*/
    
        $('#top-bar').click(function(){
            $('#top-bar .wrapper').slideToggle();
            $('#top-bar').toggleClass('top-menu-active');
        });
    
        menu_toggle.click(function(){
            nav_menu.slideToggle();
            $(this).toggleClass('active');
           $('.main-navigation').toggleClass('menu-open');
           $('.menu-overlay').toggleClass('active');
        });
    
        dropdown_toggle.click(function() {
            $(this).toggleClass('active');
           $(this).parent().find('.sub-menu').first().slideToggle();
        });
    
        $('.main-navigation ul li.search-menu a').click(function(event) {
            event.preventDefault();
            $(this).toggleClass('search-active');
            $('.main-navigation #search').fadeToggle();
            $('.main-navigation .search-field').focus();
        });
    
        $(window).scroll(function() {
            if ($(this).scrollTop() > 1) {
                $('.menu-sticky #masthead').addClass('nav-shrink');
            }
            else {
                $('.menu-sticky #masthead').removeClass('nav-shrink');
            }
        });
    
        $(document).click(function (e) {
            var container = $("#masthead");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                $('#site-navigation').removeClass('menu-open');
                $('#primary-menu').slideUp();
                $('.menu-overlay').removeClass('active');
                $('.main-navigation ul li.search-menu a').removeClass('search-active');
                $('.main-navigation #search').fadeOut();
            }
        });
    
    /*------------------------------------------------
                SLICK SLIDER
    ------------------------------------------------*/
    
    $('#featured-slider').slick();
    
    
    $('#team .team-slider').slick({
            responsive: [
            {
                breakpoint: 1023,
                settings: {
                slidesToShow: 2
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1
                }
            }
            ]
        });
    
    
     $('#testimonials .slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: true,
            asNavFor: '.slider-nav'
        });
    
        $('#testimonials .slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            arrows: false,
            dots: true,
            focusOnSelect: true,
            asNavFor: '.slider-for',
            responsive: [
            {
                breakpoint: 1023,
                settings: {
                slidesToShow: 1
                }
            }
            ]
        });
    
        $('#gallery .section-content').slick({
            responsive: [
            {
                breakpoint: 1023,
                settings: {
                slidesToShow: 2
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1
                }
            }
            ]
        });
    
        $('#our-services .section-content').slick({
            responsive: [{
                breakpoint: 1024,
                    settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1
                }
            }]
        });
    
        $('#our-services .read-more').append( $('#our-services .slick-next') );
        $('#our-services .read-more').prepend( $('#our-services .slick-prev') );
    
        
    
    
    /*------------------------------------------------
                PRODUCTS FILTERING
    ------------------------------------------------*/
    
    $('ul.product-nav li a').click(function(event) {
        event.preventDefault();
    
        var tab_id = $(this).attr('data-tab');
    
        $('ul.product-nav li').removeClass('active');
        $(this).addClass('active');
    
        $('.tab-content').removeClass('active');
        $('.tab-content').hide();
    
        $("#"+tab_id).show();
    
    });

    
/*--------------------------------------------------------------
 Keyboard Navigation
----------------------------------------------------------------*/
if( $(window).width() < 1024 ) {
    $('#primary-menu').find("li").last().bind( 'keydown', function(e) {
        if( e.which === 9 ) {
            e.preventDefault();
            $('#masthead').find('.menu-toggle').focus();
        }
    });
    $('#secondary-menu').find("li").last().bind( 'keydown', function(e) {
        if( e.which === 9 ) {
            e.preventDefault();
            $('#top-navigation').find('.menu-toggle').focus();
        }
    });
    $('#primary-menu > li:last-child button:not(.active)').bind( 'keydown', function(e) {
        if( e.which === 9 ) {
            e.preventDefault();
            $('#masthead').find('.menu-toggle').focus();
        }
    });
    $('#secondary-menu > li:last-child button:not(.active)').bind( 'keydown', function(e) {
        if( e.which === 9 ) {
            e.preventDefault();
            $('#top-navigation').find('.menu-toggle').focus();
        }
    });
    $('#search').find("button").unbind('keydown');
}
else {
    $('#primary-menu').find("li").unbind('keydown');
    $('#secondary-menu').find("li").unbind('keydown');
    $('#search').find("button").bind( 'keydown', function(e) {
        var tabKey              = e.keyCode === 9;
        var shiftKey            = e.shiftKey;
        if( tabKey ) {
            e.preventDefault();
            $('#search').hide();
            $('.search-menu > a').removeClass('search-active').focus();
        }
        if( shiftKey && tabKey ) {
            e.preventDefault();
            $('#search').show();
            $('.main-navigation .search-field').focus();
            $('.search-menu > a').addClass('search-active');
        }
    });
    $('.search-menu > a').on('keydown', function (e) {
        var tabKey              = e.keyCode === 9;
        var shiftKey            = e.shiftKey;
        if( $('.search-menu > a').hasClass('search-active') ) {
            if ( shiftKey && tabKey ) {
                e.preventDefault();
                $('#search').hide();
                $('.search-menu > a').removeClass('search-active').focus();
            }
        }
    });
}
$(window).resize(function() {
    if( $(window).width() < 1024 ) {
        $('#primary-menu').find("li").last().bind( 'keydown', function(e) {
            if( e.which === 9 ) {
                e.preventDefault();
                $('#masthead').find('.menu-toggle').focus();
            }
        });
        $('#secondary-menu').find("li").last().bind( 'keydown', function(e) {
            if( e.which === 9 ) {
                e.preventDefault();
                $('#top-navigation').find('.menu-toggle').focus();
            }
        });
        $('#primary-menu > li:last-child button:not(.active)').bind( 'keydown', function(e) {
            if( e.which === 9 ) {
                e.preventDefault();
                $('#masthead').find('.menu-toggle').focus();
            }
        });
        $('#secondary-menu > li:last-child button:not(.active)').bind( 'keydown', function(e) {
            if( e.which === 9 ) {
                e.preventDefault();
                $('#top-navigation').find('.menu-toggle').focus();
            }
        });
        $('#search').find("button").unbind('keydown');
    }
    else {
        $('#primary-menu').find("li").unbind('keydown');
        $('#secondary-menu').find("li").unbind('keydown');
        $('#search').find("button").bind( 'keydown', function(e) {
            var tabKey              = e.keyCode === 9;
            var shiftKey            = e.shiftKey;
            if( tabKey ) {
                e.preventDefault();
                $('#search').hide();
                $('.search-menu > a').removeClass('search-active').focus();
            }
            if( shiftKey && tabKey ) {
                e.preventDefault();
                $('#search').show();
                $('.main-navigation .search-field').focus();
                $('.search-menu > a').addClass('search-active');
            }
        });
        $('.search-menu > a').on('keydown', function (e) {
            var tabKey              = e.keyCode === 9;
            var shiftKey            = e.shiftKey;
            if( $('.search-menu > a').hasClass('search-active') ) {
                if ( shiftKey && tabKey ) {
                    e.preventDefault();
                    $('#search').hide();
                    $('.search-menu > a').removeClass('search-active').focus();
                }
            }
        });
    }
});

menu_toggle.on('keydown', function (e) {
    var tabKey    = e.keyCode === 9;
    var shiftKey  = e.shiftKey;

    if( menu_toggle.hasClass('active') ) {
        if ( shiftKey && tabKey ) {
            e.preventDefault();
            nav_menu.slideUp();
            $('.main-navigation').removeClass('menu-open');
            $('.menu-overlay').removeClass('active');
            menu_toggle.removeClass('active');
        };
    }
});

/*------------------------------------------------
                END JQUERY
------------------------------------------------*/

});