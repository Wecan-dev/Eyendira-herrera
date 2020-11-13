(function($) {
    "use strict";

    var header = {};
    edge.modules.header = header;

    header.isStickyVisible = false;
    header.stickyAppearAmount = 0;
    header.behaviour = '';

    header.edgeOnDocumentReady = edgeOnDocumentReady;
    header.edgeOnWindowLoad = edgeOnWindowLoad;
    header.edgeOnWindowResize = edgeOnWindowResize;
    header.edgeOnWindowScroll = edgeOnWindowScroll;

    $(document).ready(edgeOnDocumentReady);
    $(window).load(edgeOnWindowLoad);
    $(window).resize(edgeOnWindowResize);
    $(window).scroll(edgeOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgeOnDocumentReady() {
        edgeHeaderBehaviour();
        edgeSideArea();
        edgeSideAreaScroll();
        edgeFullscreenMenu();
        edgeInitMobileNavigation();
        edgeMobileHeaderBehavior();
        edgeSetDropDownMenuPosition();
        edgeDropDownMenu();
        edgeSearch();
        edgePopup();
        edgeVerticalMenu().init();

    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgeOnWindowLoad() {
        edgeSetDropDownMenuPosition();
        edgeInitDividedHeaderMenu();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgeOnWindowResize() {
        edgeInitDividedHeaderMenu();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgeOnWindowScroll() {
        
    }


    /**
     * Init Popup functionality
     */
    function edgePopup() {

        var popupOpener = $('a.edge-popup-opener'),
            popupClose = $( '.edge-popup-close' );

        popupOpener.on('click', function(e) {
            e.preventDefault();

            if ( edge.body.hasClass( 'edge-popup-opened' ) ) {
                edge.body.removeClass('edge-popup-opened');
                if(!edge.body.hasClass('page-template-full_screen-php')){
                    edge.modules.common.edgeEnableScroll();
                }
            } else {
                edge.body.addClass('edge-popup-opened');
                if(!edge.body.hasClass('page-template-full_screen-php')){
                    edge.modules.common.edgeDisableScroll();
                }
            }

            popupClose.on('click', function(e) {
                e.preventDefault();
                edge.body.removeClass('edge-popup-opened');
                if(!edge.body.hasClass('page-template-full_screen-php')){
                    edge.modules.common.edgeEnableScroll();
                }
            });

            //Close on escape
            $(document).keyup(function(e){
                if (e.keyCode === 27 ) { //KeyCode for ESC button is 27
                    edge.body.removeClass('edge-popup-opened');
                    if(!edge.body.hasClass('page-template-full_screen-php')){
                        edge.modules.common.edgeEnableScroll();
                    }
                }
            });
        });
    }

    /*
     **	Show/Hide sticky header on window scroll
     */
    function edgeHeaderBehaviour() {

        var header = $('.edge-page-header'),
	        stickyHeader = $('.edge-sticky-header'),
            fixedHeaderWrapper = $('.edge-fixed-wrapper');
        
        var revSliderHeight =  0;
        if ($('.edge-slider').length) {
            revSliderHeight = $('.edge-slider').outerHeight();
        }

        var headerMenuAreaOffset = $('.edge-page-header').find('.edge-fixed-wrapper').length ? $('.edge-page-header').find('.edge-fixed-wrapper').offset().top - edgeGlobalVars.vars.edgeAddForAdminBar : 0;
		
        var stickyAppearAmount;
        var headerAppear;

        switch(true) {
            // sticky header that will be shown when user scrolls up
            case edge.body.hasClass('edge-sticky-header-on-scroll-up'):
                edge.modules.header.behaviour = 'edge-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = edgeGlobalVars.vars.edgeTopBarHeight + edgeGlobalVars.vars.edgeLogoAreaHeight + edgeGlobalVars.vars.edgeMenuAreaHeight + edgeGlobalVars.vars.edgeStickyHeaderHeight;

                headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();

                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        edge.modules.header.isStickyVisible= false;
                        stickyHeader.removeClass('header-appear').find('.edge-main-menu .second').removeClass('edge-drop-down-start');
                    }else {
                        edge.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case edge.body.hasClass('edge-sticky-header-on-scroll-down-up'):
                edge.modules.header.behaviour = 'edge-sticky-header-on-scroll-down-up';

                if(edgePerPageVars.vars.edgeStickyScrollAmount !== 0){
                    edge.modules.header.stickyAppearAmount = edgePerPageVars.vars.edgeStickyScrollAmount;
                } else {
                    edge.modules.header.stickyAppearAmount = edgeGlobalVars.vars.edgeTopBarHeight + edgeGlobalVars.vars.edgeLogoAreaHeight + edgeGlobalVars.vars.edgeMenuAreaHeight + revSliderHeight;
                }

                headerAppear = function(){
                    if(edge.scroll < edge.modules.header.stickyAppearAmount) {
                        edge.modules.header.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.edge-main-menu .second').removeClass('edge-drop-down-start');
                    }else{
                        edge.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case edge.body.hasClass('edge-fixed-on-scroll'):
                edge.modules.header.behaviour = 'edge-fixed-on-scroll';
                var headerFixed = function(){

                    if(edge.scroll <= headerMenuAreaOffset) {
                        fixedHeaderWrapper.removeClass('fixed');
                        header.css('margin-bottom', '0');
                    } else {
                        fixedHeaderWrapper.addClass('fixed');
                        header.css('margin-bottom', fixedHeaderWrapper.outerHeight());
                    }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }

    /**
     * Show/hide side area
     */
    function edgeSideArea() {

        var wrapper = $('.edge-wrapper'),
            sideMenuButtonOpen = $('a.edge-side-menu-button-opener'),
            cssClass = 'edge-right-side-menu-opened';

        wrapper.prepend('<div class="edge-cover"/>');

        var sideAreaClose = function() {
            edge.body.removeClass(cssClass);
            sideMenuButtonOpen.removeClass('opened');
        }

        var sideAreaOpen = function() {
            sideMenuButtonOpen.addClass('opened');
            edge.body.addClass(cssClass);

            $('.edge-wrapper .edge-cover').on('click', function() {
                edge.body.removeClass('edge-right-side-menu-opened');
                sideMenuButtonOpen.removeClass('opened');
            });

            var currentScroll = $(window).scrollTop();
            $(window).scroll(function() {
                if(Math.abs(edge.scroll - currentScroll) > 400){
                    sideAreaClose();
                }
            });
        }

        $('a.edge-side-menu-button-opener').on('click', function(e) {
            e.preventDefault();

            if(!sideMenuButtonOpen.hasClass('opened')) {
                sideAreaOpen();
            }
        });

        $('a.edge-close-side-menu').on('click', function(e) {
            e.preventDefault();

            if(sideMenuButtonOpen.hasClass('opened')) {
                sideAreaClose();
            }
        });
    }

    /*
    **  Smooth scroll functionality for Side Area
    */
    function edgeSideAreaScroll(){

        var sideMenu = $('.edge-side-area-inner');

        if(sideMenu.length){    
            sideMenu.niceScroll({ 
                scrollspeed: 60,
                mousescrollstep: 40,
                cursorwidth: 0, 
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false, 
                horizrailenabled: false 
            });
        }
    }

    /**
     * Init Divided Header Menu
     */
    function edgeInitDividedHeaderMenu(){
        if(edge.body.hasClass('edge-header-divided')){
            //get left side menu width
            var menuArea = $('.edge-menu-area'),
                menuAreaWidth = menuArea.width(),
                menuAreaItem = $('.edge-main-menu > ul > li > a'),
                menuItemPadding = 0,
                logoArea = menuArea.find('.edge-logo-wrapper .edge-normal-logo'),
                logoAreaWidth = 0;

            if(menuArea.children('.edge-grid').length) {
                menuAreaWidth = menuArea.children('.edge-grid').outerWidth();
            }

            if(menuAreaItem.length) {
                menuItemPadding = parseInt(menuAreaItem.css('padding-left'));
            }

            if(logoArea.length) {
                logoAreaWidth = logoArea.width() / 2;
            }

            var menuAreaLeftRightSideWidth = Math.round(menuAreaWidth/2 - menuItemPadding - logoAreaWidth);

            $('.edge-menu-area .edge-position-left').width(menuAreaLeftRightSideWidth);
            $('.edge-menu-area .edge-position-right').width(menuAreaLeftRightSideWidth);

            menuArea.css('opacity',1);

            if (typeof edge.modules.header.edgeDropDownMenu === "function") {
                edge.modules.header.edgeDropDownMenu();
            }
            if (typeof edge.modules.header.edgeSetDropDownMenuPosition === "function") {
                edge.modules.header.edgeSetDropDownMenuPosition();
            }
        }
    }

    /**
     * Init Fullscreen Menu
     */
    function edgeFullscreenMenu() {

        if ($('a.edge-fullscreen-menu-opener').length) {

            var popupMenuOpener = $( 'a.edge-fullscreen-menu-opener'),
                popupMenuHolderOuter = $(".edge-fullscreen-menu-holder-outer"),
                cssClass,
            //Flags for type of animation
                fadeRight = false,
                fadeTop = false,
            //Widgets
                widgetAboveNav = $('.edge-fullscreen-above-menu-widget-holder'),
                widgetBelowNav = $('.edge-fullscreen-below-menu-widget-holder'),
            //Menu
                menuItems = $('.edge-fullscreen-menu-holder-outer nav > ul > li > a'),
                menuItemWithChild =  $('.edge-fullscreen-menu > ul li.has_sub > a'),
                menuItemWithoutChild = $('.edge-fullscreen-menu ul li:not(.has_sub) a');


            //set height of popup holder and initialize nicescroll
            popupMenuHolderOuter.height(edge.windowHeight).niceScroll({
                scrollspeed: 30,
                mousescrollstep: 20,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            }); //200 is top and bottom padding of holder

            //set height of popup holder on resize
            $(window).resize(function() {
                popupMenuHolderOuter.height(edge.windowHeight);
            });

            if (edge.body.hasClass('edge-fade-push-text-right')) {
                cssClass = 'edge-push-nav-right';
                fadeRight = true;
            } else if (edge.body.hasClass('edge-fade-push-text-top')) {
                cssClass = 'edge-push-text-top';
                fadeTop = true;
            }

            //Appearing animation
            if (fadeRight || fadeTop) {
                if (widgetAboveNav.length) {
                    widgetAboveNav.children().css({
                        '-webkit-animation-delay' : 0 + 'ms',
                        '-moz-animation-delay' : 0 + 'ms',
                        'animation-delay' : 0 + 'ms'
                    });
                }
                menuItems.each(function(i) {
                    $(this).css({
                        '-webkit-animation-delay': (i+1) * 70 + 'ms',
                        '-moz-animation-delay': (i+1) * 70 + 'ms',
                        'animation-delay': (i+1) * 70 + 'ms'
                    });
                });
                if (widgetBelowNav.length) {
                    widgetBelowNav.children().css({
                        '-webkit-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        '-moz-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        'animation-delay' : (menuItems.length + 1)*70 + 'ms'
                    });
                }
            }

            // Open popup menu
            popupMenuOpener.on('click',function(e){
                e.preventDefault();

                if (!popupMenuOpener.hasClass('edge-fm-opened')) {
                    popupMenuOpener.addClass('edge-fm-opened');
                    edge.body.addClass('edge-fullscreen-menu-opened');
                    edge.body.removeClass('edge-fullscreen-fade-out').addClass('edge-fullscreen-fade-in');
                    edge.body.removeClass(cssClass);
                    if(!edge.body.hasClass('page-template-full_screen-php')){
                        edge.modules.common.edgeDisableScroll();
                    }
                    $(document).keyup(function(e){
                        if (e.keyCode === 27 ) {
                            popupMenuOpener.removeClass('edge-fm-opened');
                            edge.body.removeClass('edge-fullscreen-menu-opened');
                            edge.body.removeClass('edge-fullscreen-fade-in').addClass('edge-fullscreen-fade-out');
                            edge.body.addClass(cssClass);
                            if(!edge.body.hasClass('page-template-full_screen-php')){
                                edge.modules.common.edgeEnableScroll();
                            }
                            $("nav.edge-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                                $('nav.popup_menu').getNiceScroll().resize();
                            });
                        }
                    });
                } else {
                    popupMenuOpener.removeClass('edge-fm-opened');
                    edge.body.removeClass('edge-fullscreen-menu-opened');
                    edge.body.removeClass('edge-fullscreen-fade-in').addClass('edge-fullscreen-fade-out');
                    edge.body.addClass(cssClass);
                    if(!edge.body.hasClass('page-template-full_screen-php')){
                        edge.modules.common.edgeEnableScroll();
                    }
                    $("nav.edge-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                        $('nav.popup_menu').getNiceScroll().resize();
                    });
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function(e) {
                e.preventDefault();

                var thisItem = $(this),
	                thisItemParent = thisItem.parent();

                if (thisItemParent.hasClass('has_sub')) {
                    var submenu = thisItemParent.find('> ul.sub_menu');

                    if (submenu.is(':visible')) {
                        submenu.slideUp(200, function() {
                            popupMenuHolderOuter.getNiceScroll().resize();
                        });
	                    thisItemParent.removeClass('open_sub');
                    } else {
                        thisItemParent.siblings().removeClass('open_sub');
                        $('.sub_menu').slideUp(400, 'easeInOutQuint', function() {
                            popupMenuHolderOuter.getNiceScroll().resize();
                        });
                        setTimeout(function () {
                            thisItemParent.addClass('open_sub');
                            submenu.slideDown(200, function() {
                                popupMenuHolderOuter.getNiceScroll().resize();
                            });
                        }, 100);

                    }
                }
                return false;
            });

            //if link has no submenu and if it's not dead, than open that link
            menuItemWithoutChild.on('click', function (e) {

                if(($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")){

                    if (e.which === 1) {
                        popupMenuOpener.removeClass('edge-fm-opened');
                        edge.body.removeClass('edge-fullscreen-menu-opened');
                        edge.body.removeClass('edge-fullscreen-fade-in').addClass('edge-fullscreen-fade-out');
                        edge.body.addClass(cssClass);
                        $("nav.edge-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                            $('nav.popup_menu').getNiceScroll().resize();
                        });
                        edge.modules.common.edgeEnableScroll();
                    }
                }else{
                    return false;
                }
            });
        }
    }

    function edgeInitMobileNavigation() {
        var navigationOpener = $('.edge-mobile-header .edge-mobile-menu-opener, .edge-close-mobile-side-area-holder');
        var navigationHolder = $('.edge-mobile-header .edge-mobile-side-area');
        var dropdownOpener = $('.edge-mobile-nav .mobile_arrow, .edge-mobile-nav h6, .edge-mobile-nav a.edge-mobile-no-link');
        var animationSpeed = 200;

        //whole mobile menu opening / closing
        if(navigationOpener.length && navigationHolder.length) {
            navigationOpener.on('tap click', function(e) {
                e.stopPropagation();
                e.preventDefault();

                if (navigationHolder.hasClass('opened')) {
                    navigationHolder.removeClass('opened');
                } else {
                    navigationHolder.addClass('opened');
                }
            });

            navigationHolder.find('.edge-mobile-side-area-inner').niceScroll({
                scrollspeed: 60,
                mousescrollstep: 40,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            });
        }

        //dropdown opening / closing
        if(dropdownOpener.length) {
            dropdownOpener.each(function() {
                $(this).on('tap click', function(e) {
                    var dropdownToOpen = $(this).nextAll('ul').first();

                    if(dropdownToOpen.length) {
                        e.preventDefault();
                        e.stopPropagation();

                        var openerParent = $(this).parent('li');
                        if(dropdownToOpen.is(':visible')) {
                            dropdownToOpen.slideUp(animationSpeed);
                            openerParent.removeClass('edge-opened');
                        } else {
                            dropdownToOpen.slideDown(animationSpeed);
                            openerParent.addClass('edge-opened');
                            openerParent.siblings().removeClass('edge-opened');
                            openerParent.siblings().children('ul').slideUp(animationSpeed);
                        }
                    }

                });
            });
        }

        $('.edge-mobile-nav a, .edge-mobile-logo-wrapper a').on('click tap', function(e) {
            if($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(animationSpeed);
            }
        });
    }

    function edgeMobileHeaderBehavior() {
        if(edge.body.hasClass('edge-sticky-up-mobile-header')) {
            var stickyAppearAmount,
                mobileHeader = $('.edge-mobile-header'),
                mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0,
                adminBar     = $('#wpadminbar');

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = mobileHeaderHeight + edgeGlobalVars.vars.edgeAddForAdminBar;

            $(window).scroll(function() {
                var docYScroll2 = $(document).scrollTop();

                if(docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('edge-animate-mobile-header');
                } else {
                    mobileHeader.removeClass('edge-animate-mobile-header');
                }

                if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', 0);

                    if(adminBar.length) {
                        mobileHeader.find('.edge-mobile-header-inner').css('top', 0);
                    }
                } else {
                    mobileHeader.addClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', stickyAppearAmount);
                }

                docYScroll1 = $(document).scrollTop();
            });
        }
    }

    /**
     * Set dropdown position
     */
    function edgeSetDropDownMenuPosition(){

        var menuItems = $(".edge-drop-down > ul > li.narrow");
        menuItems.each( function(i) {

            var browserWidth = edge.windowWidth-16; // 16 is width of scroll bar
            var menuItemPosition = $(this).offset().left;
            var dropdownMenuWidth = $(this).find('.second .inner ul').width();

            var menuItemFromLeft = 0;
            if(edge.body.hasClass('edge-boxed')){
                menuItemFromLeft = edge.boxedLayoutWidth  - (menuItemPosition - (browserWidth - edge.boxedLayoutWidth )/2);
            } else {
                menuItemFromLeft = browserWidth - menuItemPosition;
            }

            var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true

            if($(this).find('li.sub').length > 0){
                dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
            }

            if(menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth){
                $(this).find('.second').addClass('right');
                $(this).find('.second .inner ul').addClass('right');
            }
        });
    }

    function edgeDropDownMenu() {

        var menu_items = $('.edge-drop-down > ul > li');

        menu_items.each(function(i) {
            if($(menu_items[i]).find('.second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.second');

                if($(menu_items[i]).hasClass('wide')) {

                    var dropdown = $(this).find('.inner > ul');
                    var dropdownPadding = parseInt(dropdown.css('padding-left').slice(0, -2)) + parseInt(dropdown.css('padding-right').slice(0, -2));
                    var dropdownWidth = dropdown.outerWidth();
                    
                    if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                        dropDownSecondDiv.css('left', 0);
                    }

                    //set columns to be same height - start
                    var tallest = 0;
                    $(this).find('.second > .inner > ul > li').each(function() {
                        var thisHeight = $(this).height();
                        if(thisHeight > tallest) {
                            tallest = thisHeight;
                        }
                    });

                    $(this).find('.second > .inner > ul > li').css("height", ""); // delete old inline css - via resize
                    $(this).find('.second > .inner > ul > li').height(tallest);
                    //set columns to be same height - end

                    if(!edge.body.hasClass('edge-full-width-wide-menu')) {
                        if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                            var left_position = (edge.windowWidth - 2 * (edge.windowWidth - dropdown.offset().left)) / 2 + (dropdownWidth + dropdownPadding) / 2;
                            dropDownSecondDiv.css('left', -left_position);
                        }
                    }else{
                        if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                            var left_position = dropdown.offset().left;

                            dropDownSecondDiv.css('left', -left_position);
                            dropDownSecondDiv.css('width', edge.windowWidth);

                        }
                    }
                }

                if(!edge.menuDropdownHeightSet) {
                    $(menu_items[i]).data('original_height', dropDownSecondDiv.height() + 'px');
                    dropDownSecondDiv.height(0);
                }

                if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                    $(menu_items[i]).on("touchstart mouseenter", function() {
                        dropDownSecondDiv.css({
                            'height': $(menu_items[i]).data('original_height'),
                            'overflow': 'visible',
                            'visibility': 'visible',
                            'opacity': '1'
                        });
                    }).on("mouseleave", function() {
                        dropDownSecondDiv.css({
                            'height': '0px',
                            'overflow': 'hidden',
                            'visibility': 'hidden',
                            'opacity': '0'
                        });
                    });

                } else {
                    if(edge.body.hasClass('edge-dropdown-animate-height')) {
                        $(menu_items[i]).mouseenter(function() {
                            dropDownSecondDiv.css({
                                'visibility': 'visible',
                                'height': '0px',
                                'opacity': '0'
                            });
                            dropDownSecondDiv.stop().animate({
                                'height': $(menu_items[i]).data('original_height'),
                                opacity: 1
                            }, 300, function() {
                                dropDownSecondDiv.css('overflow', 'visible');
                            });
                        }).mouseleave(function() {
                            dropDownSecondDiv.stop().animate({
                                'height': '0px'
                            }, 150, function() {
                                dropDownSecondDiv.css({
                                    'overflow': 'hidden',
                                    'visibility': 'hidden'
                                });
                            });
                        });
                    } else {
                        var config = {
                            interval: 0,
                            over: function() {
                                setTimeout(function() {
                                    dropDownSecondDiv.addClass('edge-drop-down-start');
                                    dropDownSecondDiv.stop().css({'height': $(menu_items[i]).data('original_height')});
                                }, 150);
                            },
                            timeout: 150,
                            out: function() {
                                dropDownSecondDiv.stop().css({'height': '0px'});
                                dropDownSecondDiv.removeClass('edge-drop-down-start');
                            }
                        };
                        $(menu_items[i]).hoverIntent(config);
                    }
                }
            }
        });
         $('.edge-drop-down ul li.wide ul li a').on('click', function(e) {
            if (e.which === 1){
                var $this = $(this);
                setTimeout(function() {
                    $this.mouseleave();
                }, 500);
            }
        });

        edge.menuDropdownHeightSet = true;
    }

    /**
     * Init Search Types
     */
    function edgeSearch() {

        var searchOpener = $('a.edge-search-opener'),
            searchForm,
            searchClose,
            touch = false;

        if ( $('html').hasClass( 'touch' ) ) {
            touch = true;
        }

        if ( searchOpener.length > 0 ) {
            //Check for type of search
            if ( edge.body.hasClass( 'edge-fullscreen-search' ) ) {

                var fullscreenSearchFade;

                searchClose = $( '.edge-fullscreen-search-close' );
                fullscreenSearchFade = true;
                edgeFullscreenSearch( fullscreenSearchFade);

            } else if ( edge.body.hasClass( 'edge-slide-from-header-bottom' ) ) {

                edgeSearchSlideFromHeaderBottom();

            } else if ( edge.body.hasClass( 'edge-search-covers-header' ) ) {

                edgeSearchCoversHeader();

            } else if ( edge.body.hasClass( 'edge-search-slides-from-window-top' ) ) {

                searchForm = $('.edge-search-slide-window-top');
                searchClose = $('.edge-search-close');
                edgeSearchWindowTop();
            }
        }

        /**
         * Search slides from window top type of search
         */
        function edgeSearchWindowTop() {

            searchOpener.on('click', function(e) {
                e.preventDefault();

                var yPos = 0;
                if($('.title').hasClass('has_parallax_background')){
                    yPos = parseInt($('.title.has_parallax_background').css('backgroundPosition').split(" ")[1]);
                }

                if ( searchForm.height() === 0) {
                    $('.edge-search-slide-window-top input[type="text"]').focus();
                    //Push header bottom
                    edge.body.addClass('edge-search-open');
                    $('.title.has_parallax_background').animate({
                        'background-position-y': (yPos + 50)+'px'
                    }, 150);
                } else {
                    edge.body.removeClass('edge-search-open');
                    $('.title.has_parallax_background').animate({
                        'background-position-y': (yPos - 50)+'px'
                    }, 150);
                }

                $(window).scroll(function() {
                    if ( searchForm.height() !== 0 && edge.scroll > 50 ) {
                        edge.body.removeClass('edge-search-open');
                        $('.title.has_parallax_background').css('backgroundPosition', 'center '+(yPos)+'px');
                    }
                });

                searchClose.on('click', function(e){
                    e.preventDefault();
                    edge.body.removeClass('edge-search-open');
                    $('.title.has_parallax_background').animate({
                        'background-position-y': (yPos)+'px'
                    }, 150);
                });

            });
        }

        /**
         * Search covers header type of search
         */
        function edgeSearchCoversHeader() {

            searchOpener.on('click', function (e) {
                e.preventDefault();
                var searchFormHeight,
                    searchFormHolder = $('.edge-search-cover .edge-form-holder-outer'),
                    searchForm,
                    searchFormLandmark; // there is one more div element if header is in grid

                if ($(this).closest('.edge-grid').length) {
                    searchForm = $(this).closest('.edge-grid').children().first();
                    searchFormLandmark = searchForm.parent();
                }
                else {
                    searchForm = $(this).closest('.edge-menu-area').children().first();
                    searchFormLandmark = searchForm;
                }

                if ($(this).closest('.edge-sticky-header').length > 0) {
                    searchForm = $(this).closest('.edge-sticky-header').children().first();
                    searchFormLandmark = searchForm;
                }
                if ($(this).closest('.edge-mobile-header').length > 0) {
                    searchForm = $(this).closest('.edge-mobile-header').children().children().first();
                    searchFormLandmark = searchForm.parent();
                }

                //Find search form position in header and height
                if (searchFormLandmark.parent().hasClass('edge-logo-area')) {
                    searchFormHeight = edgeGlobalVars.vars.edgeLogoAreaHeight;
                } else if (searchFormLandmark.parent().hasClass('edge-top-bar')) {
                    searchFormHeight = edgeGlobalVars.vars.edgeTopBarHeight;
                } else if (searchFormLandmark.parent().hasClass('edge-menu-area')) {
                    searchFormHeight = edgeGlobalVars.vars.edgeMenuAreaHeight;
                } else if (searchFormLandmark.parent().hasClass('edge-sticky-header')) {
                    searchFormHeight = edgeGlobalVars.vars.edgeStickyHeaderTransparencyHeight;
                } else if (searchFormLandmark.parent().hasClass('edge-mobile-header')) {
                    searchFormHeight = $('.edge-mobile-header-inner').height();
                }

                searchFormHolder.height(searchFormHeight);
                searchForm.stop(true).fadeIn(600);
                $('.edge-search-cover input[type="text"]').focus();
                $('.edge-search-close, .content, footer').on('click', function (e) {
                    e.preventDefault();
                    searchForm.stop(true).fadeOut(450);
                });
                searchForm.blur(function () {
                    searchForm.stop(true).fadeOut(450);
                });
            });

        }

        /**
         * Search slide from header bottom type of search
         */
        function edgeSearchSlideFromHeaderBottom() {
	
	        searchOpener.on('click', function() {
		        var thisItem = $(this);

                var boxed = 0;
                if(edge.body.hasClass('edge-boxed') && edge.windowWidth > 1024){
                    boxed = $('.edge-wrapper-inner').offset().left;
                }

                var searchIconPosition = parseInt(edge.windowWidth - thisItem.offset().left - thisItem.outerWidth() - boxed);

		        if(!edge.body.hasClass('edge-search-opened')){
			        edge.body.addClass('edge-search-opened');
			        if(thisItem.parents('.edge-fixed-wrapper').length) {
				        thisItem.parents('.edge-fixed-wrapper').find('.edge-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeIn(400, 'easeOutSine');
			        } else if (thisItem.parents('.edge-sticky-header.header-appear').length) {
				        thisItem.parents('.edge-sticky-header.header-appear').find('.edge-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeIn(400, 'easeOutSine');
			        } else if(thisItem.parents('.edge-logo-area').length) {
				        thisItem.parents('.edge-page-header').find('.edge-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeIn(400, 'easeOutSine');
			        } else if(thisItem.parents('.edge-menu-area').children('.edge-slide-from-header-bottom-holder').length) {
                        thisItem.parents('.edge-menu-area').children('.edge-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeIn(400, 'easeOutSine');
                    } else if (thisItem.parents('.edge-page-header').children('.edge-slide-from-header-bottom-holder').length) {
				        thisItem.parents('.edge-page-header').children('.edge-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeIn(400, 'easeOutSine');
			        } else if (thisItem.parents('.edge-mobile-header').length) {
				        thisItem.parents('.edge-mobile-header').find('.edge-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeIn(400, 'easeOutSine');
			        }
			        setTimeout(function(){
				        $('.edge-slide-from-header-bottom-holder input').focus();
			        },400);
		        } else {
                    edge.body.removeClass('edge-search-opened');
                    $('.edge-slide-from-header-bottom-holder').fadeOut(0);
                }
	        });

            $(document).mouseup(function (e) {
                var container = $(".edge-search-opener, .edge-slide-from-header-bottom-holder");
                if (!container.is(e.target) && container.has(e.target).length === 0)  {
                    if(edge.body.hasClass('edge-search-opened')){
                        edge.body.removeClass('edge-search-opened');
                        $('.edge-slide-from-header-bottom-holder').fadeOut(0);
                    }
                }
            });

	        //Close on escape
	        $(document).keyup(function(e){
		        if (e.keyCode === 27 ) { //KeyCode for ESC button is 27
                    if(edge.body.hasClass('edge-search-opened')){
                        edge.body.removeClass('edge-search-opened');
                        $('.edge-slide-from-header-bottom-holder').fadeOut(0);
                    }
		        }
	        });
        }

        /**
         * Fullscreen search fade
         */
        function edgeFullscreenSearch( fade) {

            var searchHolder = $( '.edge-fullscreen-search-holder');

            searchOpener.on('click', function(e) {
                e.preventDefault();
                var samePosition = false,
                    closeTop = 0,
                    closeLeft = 0;
                if ( $(this).data('icon-close-same-position') === 'yes' ) {
                    closeTop = $(this).find('.edge-search-opener-wrapper').offset().top;
                    closeLeft = $(this).offset().left;
                    samePosition = true;
                }
                //Fullscreen search fade
                if ( fade ) {
                    if ( searchHolder.hasClass( 'edge-animate' ) ) {
                        edge.body.removeClass('edge-fullscreen-search-opened');
                        edge.body.addClass( 'edge-search-fade-out' );
                        edge.body.removeClass( 'edge-search-fade-in' );
                        searchHolder.removeClass( 'edge-animate' );
                        setTimeout(function(){
                            searchHolder.find('.edge-search-field').val('');
                            searchHolder.find('.edge-search-field').blur();
                        },300);
                        if(!edge.body.hasClass('page-template-full_screen-php')){
                            edge.modules.common.edgeEnableScroll();
                        }
                    } else {
                        edge.body.addClass('edge-fullscreen-search-opened');
                        setTimeout(function(){
                            searchHolder.find('.edge-search-field').focus();
                        },900);
                        edge.body.removeClass('edge-search-fade-out');
                        edge.body.addClass('edge-search-fade-in');
                        searchHolder.addClass('edge-animate');
                        if (samePosition) {
                            searchClose.css({
                                'top' : closeTop - edge.scroll,
                                'left' : closeLeft
                            });
                        }
                        if(!edge.body.hasClass('page-template-full_screen-php')){
                            edge.modules.common.edgeDisableScroll();
                        }
                    }
                    searchClose.on('click', function(e) {
                        e.preventDefault();
                        edge.body.removeClass('edge-fullscreen-search-opened');
                        searchHolder.removeClass('edge-animate');
                        setTimeout(function(){
                            searchHolder.find('.edge-search-field').val('');
                            searchHolder.find('.edge-search-field').blur();
                        },300);
                        edge.body.removeClass('edge-search-fade-in');
                        edge.body.addClass('edge-search-fade-out');
                        if(!edge.body.hasClass('page-template-full_screen-php')){
                            edge.modules.common.edgeEnableScroll();
                        }
                    });

                    //Close on click away
                    $(document).mouseup(function (e) {
                        var container = $(".edge-form-holder-inner");
                        if (!container.is(e.target) && container.has(e.target).length === 0)  {
                            e.preventDefault();
                            edge.body.removeClass('edge-fullscreen-search-opened');
                            searchHolder.removeClass('edge-animate');
                            setTimeout(function(){
                                searchHolder.find('.edge-search-field').val('');
                                searchHolder.find('.edge-search-field').blur();
                            },300);
                            edge.body.removeClass('edge-search-fade-in');
                            edge.body.addClass('edge-search-fade-out');
                            if(!edge.body.hasClass('page-template-full_screen-php')){
                                edge.modules.common.edgeEnableScroll();
                            }
                        }
                    });

                    //Close on escape
                    $(document).keyup(function(e){
                        if (e.keyCode === 27 ) { //KeyCode for ESC button is 27
                            edge.body.removeClass('edge-fullscreen-search-opened');
                            searchHolder.removeClass('edge-animate');
                            setTimeout(function(){
                                searchHolder.find('.edge-search-field').val('');
                                searchHolder.find('.edge-search-field').blur();
                            },300);
                            edge.body.removeClass('edge-search-fade-in');
                            edge.body.addClass('edge-search-fade-out');
                            if(!edge.body.hasClass('page-template-full_screen-php')){
                                edge.modules.common.edgeEnableScroll();
                            }
                        }
                    });
                }
            });

            //Text input focus change
            $('.edge-fullscreen-search-holder .edge-search-field').focus(function(){
                $('.edge-fullscreen-search-holder .edge-field-holder .edge-line').css("width","100%");
            });

            $('.edge-fullscreen-search-holder .edge-search-field').blur(function(){
                $('.edge-fullscreen-search-holder .edge-field-holder .edge-line').css("width","0");
            });
        }
    }

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var edgeVerticalMenu = function() {
        /**
         * Main vertical area object that used through out function
         * @type {jQuery object}
         */
        var verticalMenuObject = $('.edge-vertical-menu-area');

        /**
         * Resizes vertical area. Called whenever height of navigation area changes
         * It first check if vertical area is scrollable, and if it is resizes scrollable area
         */
        var resizeVerticalArea = function() {
            if(verticalAreaScrollable()) {
                verticalMenuObject.getNiceScroll().resize();
            }
        };

        /**
         * Checks if vertical area is scrollable (if it has edge-with-scroll class)
         *
         * @returns {bool}
         */
        var verticalAreaScrollable = function() {
            return verticalMenuObject.hasClass('.edge-with-scroll');
        };

        /**
         * Initialzes navigation functionality. It checks navigation type data attribute and calls proper functions
         */
        var initNavigation = function() {
            var verticalNavObject = verticalMenuObject.find('.edge-vertical-menu');

            dropdownFloat();

            /**
             * Initializes click toggle navigation type. Works the same for touch and no-touch devices
             */
            /**
             * Initializes floating navigation type (it comes from the side as a dropdown)
             */
            function dropdownFloat() {
                var menuItems = verticalNavObject.find('ul li.menu-item-has-children');
                var allDropdowns = menuItems.find(' > .second, > ul');

                menuItems.each(function () {
                    var elementToExpand = $(this).find(' > .second, > ul');
                    var menuItem = this;

                    if (Modernizr.touch) {
                        var dropdownOpener = $(this).find('> a');

                        dropdownOpener.on('click tap', function (e) {
                            e.preventDefault();
                            e.stopPropagation();

                            if (elementToExpand.hasClass('edge-float-open')) {
                                elementToExpand.removeClass('edge-float-open');
                                $(menuItem).removeClass('open');
                            } else {
                                if (!$(this).parents('li').hasClass('open')) {
                                    menuItems.removeClass('open');
                                    allDropdowns.removeClass('edge-float-open');
                                }

                                elementToExpand.addClass('edge-float-open');
                                $(menuItem).addClass('open');
                            }
                        });
                    } else {
                        //must use hoverIntent because basic hover effect doesn't catch dropdown
                        //it doesn't start from menu item's edge
                        $(this).hoverIntent({
                            over: function () {
                                elementToExpand.addClass('edge-float-open');
                                $(menuItem).addClass('open');
                            },
                            out: function () {
                                elementToExpand.removeClass('edge-float-open');
                                $(menuItem).removeClass('open');
                            },
                            timeout: 100
                        });
                    }
                });
            }
        };

        /**
         * Initializes scrolling in vertical area. It checks if vertical area is scrollable before doing so
         */
        var initVerticalAreaScroll = function() {
            if(verticalAreaScrollable()) {
                verticalMenuObject.niceScroll({
                    scrollspeed: 60,
                    mousescrollstep: 40,
                    cursorwidth: 0,
                    cursorborder: 0,
                    cursorborderradius: 0,
                    cursorcolor: "transparent",
                    autohidemode: false,
                    horizrailenabled: false
                });
            }
        };

        var initHiddenVerticalArea = function() {
            var verticalLogo = $('.edge-vertical-area-bottom-logo');
            var verticalMenuOpener = verticalMenuObject.find('.edge-vertical-area-opener');
            var scrollPosition = 0;

            verticalMenuOpener.on('click tap', function() {
                if(isVerticalAreaOpen()) {
                    closeVerticalArea();
                } else {
                    openVerticalArea();
                }
            });

            $(window).scroll(function() {
                if(Math.abs($(window).scrollTop() - scrollPosition) > 400){
                    closeVerticalArea();
                }
            });

            /**
             * Closes vertical menu area by removing 'active' class on that element
             */
            function closeVerticalArea() {
                verticalMenuObject.removeClass('active');

                if(verticalLogo.length) {
                    verticalLogo.removeClass('active');
                }
            }

            /**
             * Opens vertical menu area by adding 'active' class on that element
             */
            function openVerticalArea() {
                verticalMenuObject.addClass('active');

                if(verticalLogo.length) {
                    verticalLogo.addClass('active');
                }
                scrollPosition = $(window).scrollTop();
            }

            function isVerticalAreaOpen() {
                return verticalMenuObject.hasClass('active');
            }
        };

        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function() {
                if(verticalMenuObject.length) {
                    initNavigation();
                    initVerticalAreaScroll();

                    if(edge.body.hasClass('edge-header-vertical-closed')) {
                        initHiddenVerticalArea();
                    }

                }
            }
        };
    };

})(jQuery);