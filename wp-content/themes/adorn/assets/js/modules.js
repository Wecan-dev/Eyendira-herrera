(function($) {
    "use strict";

    window.edge = {};
    edge.modules = {};

    edge.scroll = 0;
    edge.window = $(window);
    edge.document = $(document);
    edge.windowWidth = $(window).width();
    edge.windowHeight = $(window).height();
    edge.body = $('body');
    edge.html = $('html, body');
    edge.htmlEl = $('html');
    edge.menuDropdownHeightSet = false;
    edge.defaultHeaderStyle = '';
    edge.minVideoWidth = 1500;
    edge.videoWidthOriginal = 1280;
    edge.videoHeightOriginal = 720;
    edge.videoRatio = 1.61;

    edge.edgeOnDocumentReady = edgeOnDocumentReady;
    edge.edgeOnWindowLoad = edgeOnWindowLoad;
    edge.edgeOnWindowResize = edgeOnWindowResize;
    edge.edgeOnWindowScroll = edgeOnWindowScroll;

    $(document).ready(edgeOnDocumentReady);
    $(window).load(edgeOnWindowLoad);
    $(window).resize(edgeOnWindowResize);
    $(window).scroll(edgeOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgeOnDocumentReady() {
        edge.scroll = $(window).scrollTop();

        //set global variable for header style which we will use in various functions
        if(edge.body.hasClass('edge-dark-header')){ edge.defaultHeaderStyle = 'edge-dark-header';}
        if(edge.body.hasClass('edge-light-header')){ edge.defaultHeaderStyle = 'edge-light-header';}
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgeOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgeOnWindowResize() {
        edge.windowWidth = $(window).width();
        edge.windowHeight = $(window).height();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgeOnWindowScroll() {
        edge.scroll = $(window).scrollTop();
    }

    //set boxed layout width variable for various calculations

    switch(true){
        case edge.body.hasClass('edge-grid-1300'):
            edge.boxedLayoutWidth = 1350;
            break;
        case edge.body.hasClass('edge-grid-1200'):
            edge.boxedLayoutWidth = 1250;
            break;
        case edge.body.hasClass('edge-grid-1000'):
            edge.boxedLayoutWidth = 1050;
            break;
        case edge.body.hasClass('edge-grid-800'):
            edge.boxedLayoutWidth = 850;
            break;
        default :
            edge.boxedLayoutWidth = 1150;
            break;
    }

})(jQuery);
(function($) {
	"use strict";

    var common = {};
    edge.modules.common = common;

    common.edgeFluidVideo = edgeFluidVideo;
    common.edgeEnableScroll = edgeEnableScroll;
    common.edgeDisableScroll = edgeDisableScroll;
    common.edgeOwlSlider = edgeOwlSlider;
    common.getLoadMoreData = getLoadMoreData;
    common.setLoadMoreAjaxData = setLoadMoreAjaxData;
    common.edgePrettyPhoto = edgePrettyPhoto;

    common.edgeOnDocumentReady = edgeOnDocumentReady;
    common.edgeOnWindowLoad = edgeOnWindowLoad;
    common.edgeOnWindowResize = edgeOnWindowResize;
    common.edgeOnWindowScroll = edgeOnWindowScroll;

    $(document).ready(edgeOnDocumentReady);
    $(window).load(edgeOnWindowLoad);
    $(window).resize(edgeOnWindowResize);
    $(window).scroll(edgeOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgeOnDocumentReady() {
	    edgeIconWithHover().init();
	    edgeIEversion();
	    edgeInitAnchor().init();
	    edgeInitBackToTop();
	    edgeBackButtonShowHide();
	    edgeInitSelfHostedVideoPlayer();
	    edgeSelfHostedVideoSize();
	    edgeFluidVideo();
	    edgeOwlSlider();
	    edgePreloadBackgrounds();
	    edgePrettyPhoto();
        edgeInitCustomMenuDropdown();
        edgeSocialShareHide();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgeOnWindowLoad() {
        edgeSmoothTransition();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgeOnWindowResize() {
        edgeSelfHostedVideoSize();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgeOnWindowScroll() {
        
    }
	
	/*
	 * IE version
	 */
	function edgeIEversion() {
		var ua = window.navigator.userAgent;
		var msie = ua.indexOf("MSIE ");
		
		if (msie > 0) {
			var version = parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));
			edge.body.addClass('edge-ms-ie'+version);
		}
		return false;
	}
	
	function edgeDisableScroll() {
		if (window.addEventListener) {
			window.addEventListener('DOMMouseScroll', edgeWheel, false);
		}
		
		window.onmousewheel = document.onmousewheel = edgeWheel;
		document.onkeydown = edgeKeydown;
	}
	
	function edgeEnableScroll() {
		if (window.removeEventListener) {
			window.removeEventListener('DOMMouseScroll', edgeWheel, false);
		}
		
		window.onmousewheel = document.onmousewheel = document.onkeydown = null;
	}
	
	function edgeWheel(e) {
		edgePreventDefaultValue(e);
	}
	
	function edgeKeydown(e) {
		var keys = [37, 38, 39, 40];
		
		for (var i = keys.length; i--;) {
			if (e.keyCode === keys[i]) {
				edgePreventDefaultValue(e);
				return;
			}
		}
	}
	
	function edgePreventDefaultValue(e) {
		e = e || window.event;
		if (e.preventDefault) {
			e.preventDefault();
		}
		e.returnValue = false;
	}
	
	/*
	 **	Anchor functionality
	 */
	var edgeInitAnchor = function() {
		/**
		 * Set active state on clicked anchor
		 * @param anchor, clicked anchor
		 */
		var setActiveState = function(anchor){
			
			$('.edge-main-menu .edge-active-item, .edge-mobile-nav .edge-active-item, .edge-fullscreen-menu .edge-active-item').removeClass('edge-active-item');
			anchor.parent().addClass('edge-active-item');
			
			$('.edge-main-menu a, .edge-mobile-nav a, .edge-fullscreen-menu a').removeClass('current');
			anchor.addClass('current');
		};
		
		/**
		 * Check anchor active state on scroll
		 */
		var checkActiveStateOnScroll = function(){
			
			$('[data-edge-anchor]').waypoint( function(direction) {
				if(direction === 'down') {
					setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("edge-anchor")+"']"));
				}
			}, { offset: '50%' });
			
			$('[data-edge-anchor]').waypoint( function(direction) {
				if(direction === 'up') {
					setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("edge-anchor")+"']"));
				}
			}, { offset: function(){
				return -($(this.element).outerHeight() - 150);
			} });
			
		};
		
		/**
		 * Check anchor active state on load
		 */
		var checkActiveStateOnLoad = function(){
			var hash = window.location.hash.split('#')[1];
			
			if(hash !== "" && $('[data-edge-anchor="'+hash+'"]').length > 0){
				anchorClickOnLoad(hash);
			}
		};
		
		/**
		 * Handle anchor on load
		 */
		var anchorClickOnLoad = function($this) {
			var scrollAmount;
			var anchor = $('a');
			var hash = $this;
			if(hash !== "" && $('[data-edge-anchor="' + hash + '"]').length > 0 ) {
				var anchoredElementOffset = $('[data-edge-anchor="' + hash + '"]').offset().top;
				scrollAmount = $('[data-edge-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset) - edgeGlobalVars.vars.edgeAddForAdminBar;
				
				setActiveState(anchor);
				
				edge.html.stop().animate({
					scrollTop: Math.round(scrollAmount)
				}, 1000, function() {
					//change hash tag in url
					if(history.pushState) { history.pushState(null, null, '#'+hash); }
				});
				return false;
			}
		};
		
		/**
		 * Calculate header height to be substract from scroll amount
		 * @param anchoredElementOffset, anchorded element offest
		 */
		var headerHeihtToSubtract = function(anchoredElementOffset){
			
			if(edge.modules.header.behaviour === 'edge-sticky-header-on-scroll-down-up') {
				edge.modules.header.isStickyVisible = (anchoredElementOffset > edge.modules.header.stickyAppearAmount);
			}
			
			if(edge.modules.header.behaviour === 'edge-sticky-header-on-scroll-up') {
				if((anchoredElementOffset > edge.scroll)){
					edge.modules.header.isStickyVisible = false;
				}
			}
			
			var headerHeight = edge.modules.header.isStickyVisible ? edgeGlobalVars.vars.edgeStickyHeaderTransparencyHeight : edgePerPageVars.vars.edgeHeaderTransparencyHeight;
			
			if(edge.windowWidth < 1025) {
				headerHeight = 0;
			}
			
			return headerHeight;
		};
		
		/**
		 * Handle anchor click
		 */
		var anchorClick = function() {
			edge.document.on("click", ".edge-main-menu a, .edge-fullscreen-menu a, .edge-btn, .edge-anchor, .edge-mobile-nav a", function() {
				var scrollAmount;
				var anchor = $(this);
				var hash = anchor.prop("hash").split('#')[1];
				
				if(hash !== "" && $('[data-edge-anchor="' + hash + '"]').length > 0 ) {
					
					var anchoredElementOffset = $('[data-edge-anchor="' + hash + '"]').offset().top;
					scrollAmount = $('[data-edge-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset) - edgeGlobalVars.vars.edgeAddForAdminBar;
					
					setActiveState(anchor);
					
					edge.html.stop().animate({
						scrollTop: Math.round(scrollAmount)
					}, 1000, function() {
						//change hash tag in url
						if(history.pushState) { history.pushState(null, null, '#'+hash); }
					});
					return false;
				}
			});
		};
		
		return {
			init: function() {
				if($('[data-edge-anchor]').length) {
					anchorClick();
					checkActiveStateOnScroll();
					$(window).load(function() { checkActiveStateOnLoad(); });
				}
			}
		};
	};
	
	function edgeInitBackToTop(){
		var backToTopButton = $('#edge-back-to-top');
		backToTopButton.on('click',function(e){
			e.preventDefault();
			edge.html.animate({scrollTop: 0}, edge.window.scrollTop()/3, 'linear');
		});
	}

    function edgeSocialShareHide() {
        var holder = $(".edge-social-sidebar-holder"),
            footer = $('.edge-page-footer');

        if(holder.length && footer.length && $(window).width() > 1025) {
            var footerTop = footer.position().top;

            $(window).resize(function(){
                footerTop = footer.position().top;
            });

            setTimeout(function() {
                footerTop = footer.position().top;
            }, 1000);

            $(window).scroll(function(){
                if (edge.scroll + edge.windowHeight - holder.height()/2 >= footerTop) {
                    holder.fadeOut(200);
                } else {
                    holder.fadeIn(200);
                }
            });
        }
    }
	
	function edgeBackButtonShowHide(){
		edge.window.scroll(function () {
			var b = $(this).scrollTop();
			var c = $(this).height();
			var d;
			if (b > 0) { d = b + c / 2; } else { d = 1; }
			if (d < 1e3) { edgeToTopButton('off'); } else { edgeToTopButton('on'); }
		});
	}
	
	function edgeToTopButton(a) {
		var b = $("#edge-back-to-top");
		b.removeClass('off on');
		if (a === 'on') { b.addClass('on'); } else { b.addClass('off'); }
	}
	
	function edgeInitSelfHostedVideoPlayer() {
		var players = $('.edge-self-hosted-video');
		
		if(players.length) {
			players.mediaelementplayer({
				audioWidth: '100%'
			});
		}
	}
	
	function edgeSelfHostedVideoSize(){
		var selfVideoHolder = $('.edge-self-hosted-video-holder .edge-video-wrap');
		
		if(selfVideoHolder.length) {
			selfVideoHolder.each(function(){
				var thisVideo = $(this),
					videoWidth = thisVideo.closest('.edge-self-hosted-video-holder').outerWidth(),
					videoHeight = videoWidth / edge.videoRatio;
				
				if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
					thisVideo.parent().width(videoWidth);
					thisVideo.parent().height(videoHeight);
				}
				
				thisVideo.width(videoWidth);
				thisVideo.height(videoHeight);
				
				thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
				thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
			});
		}
	}
	
	function edgeFluidVideo() {
        fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}

    function edgeSmoothTransition() {

        if (edge.body.hasClass('edge-smooth-page-transitions')) {

            //check for preload animation
            if (edge.body.hasClass('edge-smooth-page-transitions-preloader')) {
                var loader = $('body > .edge-smooth-transition-loader.edge-mimic-ajax');
                loader.fadeOut(500);
                $(window).on("pageshow", function (event) {
                    if (event.originalEvent.persisted) {
                        loader.fadeOut(500);
                    }
                });
            }

            //check for fade out animation
            if(edge.body.hasClass('edge-smooth-page-transitions-fadeout')) {
                $('a').on('click', function (e) {
                    var a = $(this);

                    if ((a.parents('.edge-shopping-cart-dropdown').length || a.parent('.product-remove').length) && a.hasClass('remove') || a.hasClass('edge-no-smooth-transitions')) {
                        return;
                    }

                    if (
                        e.which === 1 && // check if the left mouse button has been pressed
                        a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
                        (typeof a.data('rel') === 'undefined') && //Not pretty photo link
                        (typeof a.attr('rel') === 'undefined') && //Not VC pretty photo link
                        (typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
                        (a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) // check if it is an anchor aiming for a different page
                    ) {
                        e.preventDefault();
                        $('.edge-wrapper-inner, #multiscroll-nav').fadeOut(1000, function () {
                            window.location = a.attr('href');
                        });
                    }
                });
            }
        }
    }
	
	/*
	 *	Preload background images for elements that have 'edge-preload-background' class
	 */
	function edgePreloadBackgrounds(){
		var preloadBackHolder = $('.edge-preload-background');
		
		if(preloadBackHolder.length) {
			preloadBackHolder.each(function() {
				var preloadBackground = $(this);
				
				if(preloadBackground.css("background-image") !== "" && preloadBackground.css("background-image") != "none") {
					var bgUrl = preloadBackground.attr('style');
					
					bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
					bgUrl = bgUrl ? bgUrl[1] : "";
					
					if (bgUrl) {
						var backImg = new Image();
						backImg.src = bgUrl;
						$(backImg).load(function(){
							preloadBackground.removeClass('edge-preload-background');
						});
					}
				} else {
					$(window).load(function(){ preloadBackground.removeClass('edge-preload-background'); }); //make sure that edge-preload-background class is removed from elements with forced background none in css
				}
			});
		}
	}
	
	function edgePrettyPhoto() {
		/*jshint multistr: true */
		var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><span class="fa fa-angle-right"></span></a> \
                                            <a class="pp_previous" href="#"><span class="fa fa-angle-left"></span></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';
		
		$("a[data-rel^='prettyPhoto']").prettyPhoto({
			hook: 'data-rel',
			animation_speed: 'normal', /* fast/slow/normal */
			slideshow: false, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: true, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			horizontal_padding: 0,
			default_width: 960,
			default_height: 540,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			deeplinking: false,
			custom_markup: '',
			social_tools: false,
			markup: markupWhole
		});
	}
	
	/**
	 * Initializes load more data params
	 * @param container with defined data params
	 * return array
	 */
	function getLoadMoreData(container){
		var dataList = container.data(),
			returnValue = {};
		
		for (var property in dataList) {
			if (dataList.hasOwnProperty(property)) {
				if (typeof dataList[property] !== 'undefined' && dataList[property] !== false) {
					returnValue[property] = dataList[property];
				}
			}
		}
		
		return returnValue;
	}
	
	/**
	 * Sets load more data params for ajax function
	 * @param container with defined data params
	 * return array
	 */
	function setLoadMoreAjaxData(container, action){
		var returnValue = {
			action: action
		};
		
		for (var property in container) {
			if (container.hasOwnProperty(property)) {
				
				if (typeof container[property] !== 'undefined' && container[property] !== false) {
					returnValue[property] = container[property];
				}
			}
		}
		
		return returnValue;
	}
	
	/**
	 * Object that represents icon with hover data
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var edgeIconWithHover = function() {
		//get all icons on page
		var icons = $('.edge-icon-has-hover');
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var hoverColor = icon.data('hover-color'),
					originalColor = icon.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: icon, color: originalColor}, changeIconColor);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconHoverColor($(this));
					});
				}
			}
		};
	};

    /**
     * Init Owl Carousel
     */
    function edgeOwlSlider() {
        var sliders = $('.edge-owl-slider');

        if (sliders.length) {
            sliders.each(function(){
                var slider = $(this),
                    slideItemsNumber = slider.children().length,
                    numberOfItems = 1,
                    loop = true,
                    autoplay = true,
                    autoplayHoverPause = true,
                    sliderSpeed = 3500,
                    sliderSpeedAnimation = 600,
                    margin = 0,
                    center = false,
                    autoWidth = false,
                    animateIn = false, // keyframe css animation
                    animateOut = false, // keyframe css animation
                    navigation = true,
                    pagination = false,
                	dotsData  = false;

                if (typeof slider.data('number-of-items') !== 'undefined' && slider.data('number-of-items') !== false) {
                    numberOfItems = slider.data('number-of-items');
                }
                if (slider.data('enable-loop') === 'no') {
                    loop = false;
                }
                if (slider.data('enable-autoplay') === 'no') {
                    autoplay = false;
                }
                if (slider.data('enable-autoplay-hover-pause') === 'no') {
                    autoplayHoverPause = false;
                }
                if (typeof slider.data('slider-speed') !== 'undefined' && slider.data('slider-speed') !== false) {
                    sliderSpeed = slider.data('slider-speed');
                }
                if (typeof slider.data('slider-speed-animation') !== 'undefined' && slider.data('slider-speed-animation') !== false) {
                    sliderSpeedAnimation = slider.data('slider-speed-animation');
                }
                if (typeof slider.data('slider-margin') !== 'undefined' && slider.data('slider-margin') !== false) {
                    margin = slider.data('slider-margin');
                }
                if(slider.parent().hasClass('edge-normal-space')) {
                    margin = 30;
                } else if (slider.parent().hasClass('edge-small-space')) {
                    margin = 20;
                } else if (slider.parent().hasClass('edge-tiny-space')) {
                    margin = 10;
                }
                if (slider.data('enable-center') === 'yes') {
                    center = true;
                }
                if (slider.data('enable-auto-width') === 'yes') {
                    autoWidth = true;
                }
                if (typeof slider.data('slider-animate-in') !== 'undefined' && slider.data('slider-animate-in') !== false) {
                    animateIn = slider.data('slider-animate-in');
                }
                if (typeof slider.data('slider-animate-out') !== 'undefined' && slider.data('slider-animate-out') !== false) {
                    animateOut = slider.data('slider-animate-out');
                }
                if (slider.data('enable-navigation') === 'no') {
                    navigation = false;
                }
                if (slider.data('enable-pagination') === 'yes') {
                    pagination = true;
                }
                if (slider.data('enable-dots-data') === 'yes') {
                    dotsData = true;
                }
                if(navigation && pagination) {
                    slider.addClass('edge-slider-has-both-nav');
                }
                if (slideItemsNumber <= 1) {
                    loop       = false;
                    autoplay   = false;
                    navigation = false;
                    pagination = false;
                }

                var responsiveNumberOfItems1 = 1,
                    responsiveNumberOfItems2 = 2,
                    responsiveNumberOfItems3 = 3;

                if (numberOfItems < 3) {
                    responsiveNumberOfItems2 = numberOfItems;
                    responsiveNumberOfItems3 = numberOfItems;
                }

                slider.owlCarousel({
                    items: numberOfItems,
                    loop: loop,
                    autoplay: autoplay,
                    autoplayHoverPause: autoplayHoverPause,
                    autoplayTimeout: sliderSpeed,
                    autoplaySpeed: 650,
                    margin: margin,
                    center: center,
                    autoWidth: autoWidth,
                    animateIn : animateIn,
                    animateOut : animateOut,
                    dots: pagination,
                    nav: navigation,
                    dotsData: dotsData,
                    navText: [
                        '<span class="edge-prev-icon"><span class="edge-icon-linear-icon lnr lnr-arrow-left"></span></span>',
                        '<span class="edge-next-icon"><span class="edge-icon-linear-icon lnr lnr-arrow-right"></span></span>'
                    ],
                    responsive: {
                        0: {
                            items: responsiveNumberOfItems1,
                            slideBy: responsiveNumberOfItems1,
                            margin: 0,
                            center: false,
                            autoWidth: false,
                        },
                        680: {
                            items: responsiveNumberOfItems1,
                            slideBy: responsiveNumberOfItems1,
                        },
                        768: {
                            items: responsiveNumberOfItems2,
                            slideBy: responsiveNumberOfItems2,
                        },
                        1024: {
                            items: numberOfItems,
                            slideBy: numberOfItems,
                        }
                    },
                    onInitialize: function () {
                        slider.css('visibility', 'visible');
                    }
                });
            });
        }
    }

    function edgeInitCustomMenuDropdown() {

    	var menus = $('.edge-sidebar .widget_nav_menu .menu');


        var dropdownOpeners,
            currentMenu;


        if (menus.length) {
            menus.each(function () {

                currentMenu = $(this);

                dropdownOpeners = currentMenu.find('li.menu-item-has-children > a');

                if (dropdownOpeners.length) {
                    dropdownOpeners.each(function () {
                        var currentDropdownOpener = $(this);

                        if (currentDropdownOpener.parent().hasClass('current-menu-parent')) {
                            currentDropdownOpener.addClass('edge-custom-menu-active');
                        }

                        currentDropdownOpener.on('click', function (e) {
                            e.preventDefault();
                            var currentDropdownOpenerActive = $(this);
                            var dropdownToOpen = currentDropdownOpenerActive.parent().children('.sub-menu');

                            if (!currentDropdownOpenerActive.hasClass('edge-custom-menu-active')) {

                                if (!$(this).parent().parent().hasClass('sub-menu')) { //if first level
                                    dropdownOpeners.each(function () {

                                        $(this).removeClass('edge-custom-menu-active');
                                        $(this).parent().children('.sub-menu').slideUp();

                                    });
                                }

                                dropdownToOpen.slideDown();
                                currentDropdownOpenerActive.addClass('edge-custom-menu-active');
                            }

                            else {
                                if ($(this).parent().parent().hasClass('sub-menu')) {
                                    dropdownToOpen.slideUp();
                                    currentDropdownOpenerActive.removeClass('edge-custom-menu-active');
                                }
                            }
                        });
                    });
                }
            });
        }
    }

})(jQuery);
(function($) {
	"use strict";

    var blog = {};
    edge.modules.blog = blog;

    blog.edgeOnDocumentReady = edgeOnDocumentReady;
    blog.edgeOnWindowLoad = edgeOnWindowLoad;
    blog.edgeOnWindowResize = edgeOnWindowResize;
    blog.edgeOnWindowScroll = edgeOnWindowScroll;

    $(document).ready(edgeOnDocumentReady);
    $(window).load(edgeOnWindowLoad);
    $(window).resize(edgeOnWindowResize);
    $(window).scroll(edgeOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgeOnDocumentReady() {
        edgeInitAudioPlayer();
        edgeInitBlogMasonryGallery();
        edgeInitBlogMasonry();
        edgeInitBlogListMasonry();
	    edgeInitBlogSlider();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgeOnWindowLoad() {
	    edgeInitBlogPagination().init();
	    edgeInitBlogListShortcodePagination().init();
        edgeInitBlogMasonryGalleryAppear();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgeOnWindowResize() {
        edgeInitBlogMasonry();
	    edgeInitBlogMasonryGallery();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgeOnWindowScroll() {
	    edgeInitBlogPagination().scroll();
	    edgeInitBlogListShortcodePagination().scroll();
    }

    /**
    * Init audio player for Blog list and single pages
    */
    function edgeInitAudioPlayer() {
        var players = $('audio.edge-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }

    /**
     * Init Resize Blog Items
     */
    function edgeResizeBlogItems(size,container){

        if(container.hasClass('edge-masonry-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.edge-post-size-default'),
                largeWidthMasonryItem = container.find('.edge-post-size-large-width'),
                largeHeightMasonryItem = container.find('.edge-post-size-large-height'),
                largeWidthHeightMasonryItem = container.find('.edge-post-size-large-width-height');

			if (edge.windowWidth > 680) {
				defaultMasonryItem.css('height', size - 2 * padding);
				largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
				largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
				largeWidthMasonryItem.css('height', size - 2 * padding);
			} else {
				defaultMasonryItem.css('height', size);
				largeHeightMasonryItem.css('height', size);
				largeWidthHeightMasonryItem.css('height', size);
				largeWidthMasonryItem.css('height', Math.round(size / 2));
			}
        }
    }

    /**
    * Init Blog Masonry Layout
    */
    function edgeInitBlogMasonry() {
	    var holder = $('.edge-blog-holder.edge-blog-type-masonry');
	
	    if(holder.length){
		    holder.each(function(){
			    var thisHolder = $(this),
				    masonry = thisHolder.children('.edge-blog-holder-inner'),
                    size = thisHolder.find('.edge-blog-masonry-grid-sizer').width();
			    
                edgeResizeBlogItems(size, thisHolder);
                
			    masonry.waitForImages(function() {
				    masonry.isotope({
					    layoutMode: 'packery',
					    itemSelector: 'article',
					    percentPosition: true,
					    packery: {
						    gutter: '.edge-blog-masonry-grid-gutter',
						    columnWidth: '.edge-blog-masonry-grid-sizer'
					    }
				    });
                    masonry.css('opacity', '1');
                });
		    });
	    }
    }

    /**
     *  Init Blog Chequered
     */
    function edgeInitBlogChequered(){
        var container = $('.edge-blog-holder.edge-blog-chequered');
        var masonry = container.children('.edge-blog-holder-inner');
        var newSize;

        if(container.length) {
            newSize = masonry.find('.edge-blog-masonry-grid-sizer').outerWidth();
            masonry.children('article').css({'height': (newSize) + 'px'});
            masonry.isotope( 'layout', function(){
                masonry.css('opacity', '1');
            });
        }
    }


    /**
     *  Init Blog Masonry Gallery
     *
     *  Function that sets equal height of articles on blog masonry gallery list
     */
    function edgeInitBlogMasonryGallery() {
        var blogList = $('.edge-blog-holder.edge-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){

                var container = $(this),
                    masonry = container.children('.edge-blog-holder-inner'),
                    article = masonry.find('article'),
                    size = masonry.find('.edge-blog-masonry-grid-sizer').width() * 1.25;

                article.css({'height': (size) + 'px'});

                masonry.isotope( 'layout', function(){});
                edgeInitBlogMasonryGalleryAppear();
            });
        }
    }
	
	/**
	 *  Init Blog Slider shortcode
	 */
	function edgeInitBlogSlider() {
		var blogSlider = $('.edge-blog-slider-holder .edge-blog-slider');
		
		if(blogSlider.length) {
			blogSlider.each(function(){
				var thisSlider = $(this);
				
				thisSlider.owlCarousel({
					responsive : {
						0: {
							loop: true,
							items: 1,
							center: false,
							margin: 0,
							dots: true,
							nav: false
						},
						1025: {
							loop: true,
							items: 2,
							startPosition: 1,
							center: true,
							margin: 15,
							dots: true,
							nav: true,
							navText: [
								'<span class="edge-prev-icon"><span class="arrow arrow_left"></span></span>',
								'<span class="edge-next-icon"><span class="arrow arrow_right"></span></span>'
							]
						}
					}
				});
			});
		}
	}

    /**
     *  Animate blog masonry gallery type
     */
    function edgeInitBlogMasonryGalleryAppear() {
        var blogList = $('.edge-blog-holder.edge-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.edge-blog-pagination-holder'),
                    animateCycle = 7, // rewind delay
                    animateCycleCounter = 0;

                article.each(function(){
                    var thisArticle = $(this);
                    setTimeout(function(){
                        thisArticle.appear(function(){
                            animateCycleCounter ++;
                            if(animateCycleCounter == animateCycle) {
                                animateCycleCounter = 0;
                            }
                            setTimeout(function(){
                                thisArticle.addClass('edge-appeared');
                            },animateCycleCounter * 200);
                        },{accX: 0, accY: 0});
                    },150);
                });

                pagination.appear(function(){
                    pagination.addClass('edge-appeared');
                },{accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});

            });
        }
    }

    /**
     *  Animate blog narrow articles on appear
     */
    function edgeInitBlogNarrowAppear() {
        var blogList = $('.edge-blog-holder.edge-blog-narrow');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.edge-blog-pagination-holder');

                article.each(function(){
                    var thisArticle = $(this);
                    thisArticle.appear(function(){
                        thisArticle.addClass('edge-appeared');
                    },{accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});
                });

                pagination.appear(function(){
                    pagination.addClass('edge-appeared');
                },{accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});

            });
        }
    }

	
	/**
	 * Initializes blog pagination functions
	 */
	function edgeInitBlogPagination(){
		var holder = $('.edge-blog-holder');
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.edge-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - edgeGlobalVars.vars.edgeAddForAdminBar;
			
			if(!thisHolder.hasClass('edge-blog-pagination-infinite-scroll-started') && edge.scroll + edge.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder) {
			var thisHolderInner = thisHolder.children('.edge-blog-holder-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('edge-blog-pagination-infinite-scroll')) {
				thisHolder.addClass('edge-blog-pagination-infinite-scroll-started');
			}
			
			var loadMoreDatta = edge.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.edge-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;

			var nonceHolder = thisHolder.find('input[name*="edgtf_blog_load_more_nonce_"]');

			loadMoreDatta.blog_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
			loadMoreDatta.blog_load_more_nonce = nonceHolder.val();
			
			if(nextPage <= maxNumPages){
				loadingItem.addClass('edge-showing');
				
				var ajaxData = edge.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'adorn_edge_blog_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: EdgeAjaxUrl,
					success: function (data) {
						nextPage++;
						
						thisHolder.data('next-page', nextPage);

						var response = $.parseJSON(data),
							responseHtml =  response.html;

						thisHolder.waitForImages(function(){
							if(thisHolder.hasClass('edge-blog-type-masonry')){
								edgeInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
                                edgeResizeBlogItems(thisHolderInner.find('.edge-blog-masonry-grid-sizer').width(), thisHolder);
							} else {
								edgeInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
							}
							
							setTimeout(function() {
								edgeInitAudioPlayer();
								edge.modules.common.edgeOwlSlider();
								edge.modules.common.edgeFluidVideo();
                                edgeInitBlogNarrowAppear();
                                edgeInitBlogMasonryGalleryAppear();
                                edgeInitBlogChequered();
							}, 400);
						});
						
						if(thisHolder.hasClass('edge-blog-pagination-infinite-scroll-started')) {
							thisHolder.removeClass('edge-blog-pagination-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.edge-blog-pag-load-more').hide();
			}
		};
		
		var edgeInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edge-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 400);
		};
		
		var edgeInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edge-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('edge-blog-pagination-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('edge-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('edge-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}
	
	/**
	 * Init blog list shortcode masonry layout
	 */
	function edgeInitBlogListMasonry() {
		var holder = $('.edge-blog-list-holder.edge-bl-masonry');

		if(holder.length){
			holder.each(function(){
				var thisHolder = $(this),
					masonry = thisHolder.find('.edge-blog-list');
				
				masonry.waitForImages(function() {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.edge-bl-item',
						percentPosition: true,
						packery: {
							gutter: '.edge-bl-grid-gutter',
							columnWidth: '.edge-bl-grid-sizer'
						}
					});
					
					masonry.css('opacity', '1');
				});
			});
		}
	}
	
	/**
	 * Init blog list shortcode pagination functions
	 */
	function edgeInitBlogListShortcodePagination(){
		var holder = $('.edge-blog-list-holder');
		
		var initStandardPagination = function(thisHolder) {
			var standardLink = thisHolder.find('.edge-bl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisHolder, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.edge-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - edgeGlobalVars.vars.edgeAddForAdminBar;
			
			if(!thisHolder.hasClass('edge-bl-pag-infinite-scroll-started') && edge.scroll + edge.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder, pagedLink) {
			var thisHolderInner = thisHolder.find('.edge-blog-list'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('edge-bl-pag-standard-blog-list')) {
				thisHolder.data('next-page', pagedLink);
			}
			
			if(thisHolder.hasClass('edge-bl-pag-infinite-scroll')) {
				thisHolder.addClass('edge-bl-pag-infinite-scroll-started');
			}
			
			var loadMoreDatta = edge.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.edge-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;

			var nonceHolder = thisHolder.find('input[name*="edgtf_blog_load_more_nonce_"]');

			loadMoreDatta.blog_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
			loadMoreDatta.blog_load_more_nonce = nonceHolder.val();
			
			if(nextPage <= maxNumPages){
				if(thisHolder.hasClass('edge-bl-pag-standard-blog-list')) {
					loadingItem.addClass('edge-showing edge-standard-pag-trigger');
					thisHolder.addClass('edge-bl-pag-standard-blog-list-animate');
				} else {
					loadingItem.addClass('edge-showing');
				}
				
				var ajaxData = edge.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'adorn_edge_blog_shortcode_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: EdgeAjaxUrl,
					success: function (data) {
						if(!thisHolder.hasClass('edge-bl-pag-standard-blog-list')) {
							nextPage++;
						}
						
						thisHolder.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisHolder.hasClass('edge-bl-pag-standard-blog-list')) {
							edgeInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage);
							
							thisHolder.waitForImages(function(){
								if(thisHolder.hasClass('edge-bl-masonry')){
									edgeInitHtmlIsotopeNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
								} else {
									edgeInitHtmlGalleryNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisHolder.waitForImages(function(){
								if(thisHolder.hasClass('edge-bl-masonry')){
									edgeInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
								} else {
									edgeInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
								}
							});
						}
						
						if(thisHolder.hasClass('edge-bl-pag-infinite-scroll-started')) {
							thisHolder.removeClass('edge-bl-pag-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.edge-blog-pag-load-more').hide();
			}
		};
		
		var edgeInitStandardPaginationLinkChanges = function(thisHolder, maxNumPages, nextPage) {
			var standardPagHolder = thisHolder.find('.edge-bl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.edge-bl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.edge-bl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.edge-bl-pag-next a');
			
			standardPagNumericItem.removeClass('edge-bl-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('edge-bl-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var edgeInitHtmlIsotopeNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.html(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edge-showing edge-standard-pag-trigger');
			thisHolder.removeClass('edge-bl-pag-standard-blog-list-animate');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 400);
		};
		
		var edgeInitHtmlGalleryNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edge-showing edge-standard-pag-trigger');
			thisHolder.removeClass('edge-bl-pag-standard-blog-list-animate');
			thisHolderInner.html(responseHtml);
		};
		
		var edgeInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edge-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 400);
		};
		
		var edgeInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edge-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('edge-bl-pag-standard-blog-list')) {
							initStandardPagination(thisHolder);
						}
						
						if(thisHolder.hasClass('edge-bl-pag-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('edge-bl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('edge-bl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}

})(jQuery);
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
(function($) {
    "use strict";

    var title = {};
    edge.modules.title = title;

    title.edgeOnDocumentReady = edgeOnDocumentReady;
    title.edgeOnWindowLoad = edgeOnWindowLoad;
    title.edgeOnWindowResize = edgeOnWindowResize;
    title.edgeOnWindowScroll = edgeOnWindowScroll;

    $(document).ready(edgeOnDocumentReady);
    $(window).load(edgeOnWindowLoad);
    $(window).resize(edgeOnWindowResize);
    $(window).scroll(edgeOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgeOnDocumentReady() {
	    initTitleFullHeight();
	    edgeParallaxTitle();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgeOnWindowLoad() {
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgeOnWindowResize() {
	    initTitleFullHeight();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgeOnWindowScroll() {

    }

    /*
     **	Title image with parallax effect
     */
    function edgeParallaxTitle(){
        if($('.edge-title.edge-has-parallax-background').length > 0 && $('.touch').length === 0){

            var parallaxBackground = $('.edge-title.edge-has-parallax-background');
            var parallaxBackgroundWithZoomOut = $('.edge-title.edge-has-parallax-background.edge-zoom-out');

            var backgroundSizeWidth = parseInt(parallaxBackground.data('background-width').match(/\d+/));
            var titleHolderHeight = parallaxBackground.data('height');
            var titleRate = (titleHolderHeight / 10000) * 7;
            var titleYPos = -(edge.scroll * titleRate);

            //set position of background on doc ready
            parallaxBackground.css({'background-position': 'center '+ (titleYPos+edgeGlobalVars.vars.edgeAddForAdminBar) +'px' });
            parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-edge.scroll + 'px auto'});

            //set position of background on window scroll
            $(window).scroll(function() {
                titleYPos = -(edge.scroll * titleRate);
                parallaxBackground.css({'background-position': 'center ' + (titleYPos+edgeGlobalVars.vars.edgeAddForAdminBar) + 'px' });
                parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-edge.scroll + 'px auto'});
            });
        }
    }
	
	function initTitleFullHeight() {
		var title = $('.edge-title');
		
		if(title.length > 0 && title.hasClass('edge-title-full-height')) {
			var titleHolder = title.find('.edge-title-holder');
			var titleMargin = parseInt($('.edge-content').css('margin-top'));
			var titleHolderPadding = parseInt(titleHolder.css('padding-top'));
			if(edge.windowWidth > 1024) {
				if(titleMargin < 0) {
					title.css("height", edge.windowHeight);
					title.attr("data-height", edge.windowHeight);
					titleHolder.css("height", edge.windowHeight);
					if(titleHolderPadding > 0) {
						titleHolder.css("height", edge.windowHeight - edgeGlobalVars.vars.edgeMenuAreaHeight);
					}
				} else {
					title.css("height", edge.windowHeight - edgeGlobalVars.vars.edgeMenuAreaHeight);
					title.attr("data-height", edge.windowHeight - edgeGlobalVars.vars.edgeMenuAreaHeight);
					titleHolder.css("height", edge.windowHeight - edgeGlobalVars.vars.edgeMenuAreaHeight);
				}
			} else {
				title.css("height", edge.windowHeight - edgeGlobalVars.vars.edgeMobileHeaderHeight);
				title.attr("data-height", edge.windowHeight - edgeGlobalVars.vars.edgeMobileHeaderHeight);
				titleHolder.css("height", edge.windowHeight - edgeGlobalVars.vars.edgeMobileHeaderHeight);
			}
		}
	}

})(jQuery);

(function($) {
    'use strict';

    $(document).ready(function(){
	    edgeInitAccordions();
    });
	
	/**
	 * Init accordions shortcode
	 */
	function edgeInitAccordions(){
		var accordion = $('.edge-accordion-holder');
		
		if(accordion.length){
			accordion.each(function(){
				var thisAccordion = $(this);

				if(thisAccordion.hasClass('edge-accordion')){
					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('edge-toggle')){
					var toggleAccordion = $(this),
						toggleAccordionTitle = toggleAccordion.find('.edge-title-holder'),
						toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						
						thisTitle.on('mouseenter mouseleave', function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		edgeInitAnimationHolder();
	});
	
	/*
	 *	Init animation holder shortcode
	 */
	function edgeInitAnimationHolder(){
		
		var elements = $('.edge-grow-in, .edge-fade-in-down, .edge-element-from-fade, .edge-element-from-left, .edge-element-from-right, .edge-element-from-top, .edge-element-from-bottom, .edge-flip-in, .edge-x-rotate, .edge-z-rotate, .edge-y-translate, .edge-fade-in, .edge-fade-in-left-x-rotate'),
			animationClass,
			animationData,
			animationDelay;
		
		if(elements.length){
			elements.each(function(){
				var thisElement = $(this);
				
				thisElement.appear(function() {
					animationData = thisElement.data('animation');
					animationDelay = parseInt(thisElement.data('animation-delay'));
					
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						var newClass = animationClass+'-on';
						
						setTimeout(function(){
							thisElement.addClass(newClass);
						},animationDelay);
					}
				},{accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		edgeButton().init();
	});
	
	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var edgeButton = function() {
		//all buttons on the page
		var buttons = $('.edge-btn');
		
		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function(button) {
			if(typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function(event) {
					event.data.button.css('color', event.data.color);
				};
				
				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');
				
				button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
				button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
			}
		};
		
		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function(button) {
			if(typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function(event) {
					event.data.button.css('background-color', event.data.color);
				};
				
				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');
				
				button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
				button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
			}
		};
		
		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function(button) {
			if(typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function(event) {
					event.data.button.css('border-color', event.data.color);
				};
				
				var originalBorderColor = button.css('border-color'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');
				
				button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
				button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
			}
		};
		
		return {
			init: function() {
				if(buttons.length) {
					buttons.each(function() {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		edgeInitClientsCarousel();
	});
	
	/**
	 * Init clients carousel shortcode
	 */
	function edgeInitClientsCarousel(){
		var carouselHolder = $('.edge-clients-carousel-holder');
		
		if(carouselHolder.length){
			carouselHolder.each(function(){
				
				var thisCarouselHolder = $(this),
					thisCarousel = thisCarouselHolder.children('.edge-cc-inner'),
					numberOfItems = 4,
					autoplay = true,
					autoplayTimeout = 5000,
					loop = true,
					speed = 650;
				
				if (typeof thisCarousel.data('number-of-items') !== 'undefined' && thisCarousel.data('number-of-items') !== false) {
					numberOfItems = parseInt(thisCarousel.data('number-of-items'));
				}
				
				if (typeof thisCarousel.data('autoplay') !== 'undefined' && thisCarousel.data('autoplay') !== false) {
					autoplay = thisCarousel.data('autoplay');
				}
				
				if (typeof thisCarousel.data('autoplay-timeout') !== 'undefined' && thisCarousel.data('autoplay-timeout') !== false) {
					autoplayTimeout = thisCarousel.data('autoplay-timeout');
				}
				
				if (typeof thisCarousel.data('loop') !== 'undefined' && thisCarousel.data('loop') !== false) {
					loop = thisCarousel.data('loop');
				}
				
				if (typeof thisCarousel.data('speed') !== 'undefined' && thisCarousel.data('speed') !== false) {
					speed = thisCarousel.data('speed');
				}
				
				if(numberOfItems === 1) {
					autoplay = false;
					loop = false;
				}
				
				var responsiveNumberOfItems1 = 1,
					responsiveNumberOfItems2 = 2,
					responsiveNumberOfItems3 = 3;
				
				if (numberOfItems < 3) {
					responsiveNumberOfItems1 = numberOfItems;
					responsiveNumberOfItems2 = numberOfItems;
					responsiveNumberOfItems3 = numberOfItems;
				}
				
				thisCarousel.owlCarousel({
					items: numberOfItems,
					autoplay: autoplay,
					autoplayTimeout: autoplayTimeout,
					autoplayHoverPause:true,
					loop: loop,
					smartSpeed: speed,
					nav: false,
					dots: false,
					responsive: {
						0: {
							items: responsiveNumberOfItems1,
						},
						600: {
							items: responsiveNumberOfItems2
						},
						768: {
							items: responsiveNumberOfItems3,
						},
						1025: {
							items: numberOfItems
						}
					}
				});

				thisCarousel.css({'visibility': 'visible'});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		edgeInitCountdown();
	});
	
	/**
	 * Countdown Shortcode
	 */
	function edgeInitCountdown() {
		var countdowns = $('.edge-countdown'),
			year,
			month,
			day,
			hour,
			minute,
			timezone,
			monthLabel,
			dayLabel,
			hourLabel,
			minuteLabel,
			secondLabel;
		
		if (countdowns.length) {
			countdowns.each(function(){
				//Find countdown elements by id-s
				var countdownId = $(this).attr('id'),
					countdown = $('#'+countdownId),
					digitFontSize,
					labelFontSize;
				
				//Get data for countdown
				year = countdown.data('year');
				month = countdown.data('month');
				day = countdown.data('day');
				hour = countdown.data('hour');
				minute = countdown.data('minute');
				timezone = countdown.data('timezone');
				monthLabel = countdown.data('month-label');
				dayLabel = countdown.data('day-label');
				hourLabel = countdown.data('hour-label');
				minuteLabel = countdown.data('minute-label');
				secondLabel = countdown.data('second-label');
				digitFontSize = countdown.data('digit-size');
				labelFontSize = countdown.data('label-size');
				
				//Initialize countdown
				countdown.countdown({
					until: new Date(year, month - 1, day, hour, minute, 44),
					labels: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
					format: 'ODHMS',
					timezone: timezone,
					padZeroes: true,
					onTick: setCountdownStyle
				});
				
				function setCountdownStyle() {
					countdown.find('.countdown-amount').css({
						'font-size' : digitFontSize+'px',
						'line-height' : digitFontSize+'px'
					});
					countdown.find('.countdown-period').css({
						'font-size' : labelFontSize+'px'
					});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		edgeInitCounter();
	});
	
	/**
	 * Counter Shortcode
	 */
	function edgeInitCounter() {
		var counterHolder = $('.edge-counter-holder');
		
		if (counterHolder.length) {
			counterHolder.each(function() {
				var thisCounterHolder = $(this),
					thisCounter = thisCounterHolder.find('.edge-counter');
				
				thisCounterHolder.appear(function() {
					thisCounterHolder.css('opacity', '1');
					
					//Counter zero type
					if (thisCounter.hasClass('edge-zero-counter')) {
						var max = parseFloat(thisCounter.text());
						thisCounter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						thisCounter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}
				},{accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});
			});
		}
	}
	
})(jQuery);
/**
 * Cards Gallery shortcode
 */
(function($) {
    'use strict';

    $(window).load(function(){
        edgeCardsGallery();
    });



/**
 * Cards Gallery shortcode
 */
function edgeCardsGallery() {
    if ($('.edge-cards-gallery-holder').length) {
        $('.edge-cards-gallery-holder').each(function () {
            var gallery = $(this);
            var cards = gallery.find('.card');
            cards.each(function () {
                var card = $(this);
                card.on('click', function () {
                    if (!cards.last().is(card)) {
                        card.addClass('out animating').siblings().addClass('animating-siblings');
                        card.detach();
                        card.insertAfter(cards.last());
                        setTimeout(function () {
                            card.removeClass('out');
                        }, 200);
                        setTimeout(function () {
                            card.removeClass('animating').siblings().removeClass('animating-siblings');
                        }, 1200);
                        cards = gallery.find('.card');
                        return false;
                    }
                });
            });

            if (gallery.hasClass('edge-bundle-animation') && !edge.htmlEl.hasClass('touch')) {
                gallery.appear(function () {
                    gallery.addClass('edge-appeared');
                    gallery.find('img').one('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function () {
                        $(this).addClass('edge-animation-done');
                    });
                }, {accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});
            }
        });
    }
}

})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		edgeInitElementsHolderResponsiveStyle();
	});
	
	/*
	 **	Elements Holder responsive style
	 */
	function edgeInitElementsHolderResponsiveStyle(){
		var elementsHolder = $('.edge-elements-holder');
		
		if(elementsHolder.length){
			elementsHolder.each(function() {
				var thisElementsHolder = $(this),
					elementsHolderItem = thisElementsHolder.children('.edge-eh-item'),
					style = '',
					responsiveStyle = '';
				
				elementsHolderItem.each(function() {
					var thisItem = $(this),
						itemClass = '',
						largeLaptop = '',
						smallLaptop = '',
						ipadLandscape = '',
						ipadPortrait = '',
						mobileLandscape = '',
						mobilePortrait = '';
					
					if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
						itemClass = thisItem.data('item-class');
					}
					if (typeof thisItem.data('1280-1600') !== 'undefined' && thisItem.data('1280-1600') !== false) {
						largeLaptop = thisItem.data('1280-1600');
					}
					if (typeof thisItem.data('1024-1280') !== 'undefined' && thisItem.data('1024-1280') !== false) {
						smallLaptop = thisItem.data('1024-1280');
					}
					if (typeof thisItem.data('768-1024') !== 'undefined' && thisItem.data('768-1024') !== false) {
						ipadLandscape = thisItem.data('768-1024');
					}
					if (typeof thisItem.data('600-768') !== 'undefined' && thisItem.data('600-768') !== false) {
						ipadPortrait = thisItem.data('600-768');
					}
					if (typeof thisItem.data('480-600') !== 'undefined' && thisItem.data('480-600') !== false) {
						mobileLandscape = thisItem.data('480-600');
					}
					if (typeof thisItem.data('480') !== 'undefined' && thisItem.data('480') !== false) {
						mobilePortrait = thisItem.data('480');
					}
					
					if(largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {
						
						if(largeLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1280px) and (max-width: 1600px) {.edge-eh-item-content."+itemClass+" { padding: "+largeLaptop+" !important; } }";
						}
						if(smallLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1024px) and (max-width: 1280px) {.edge-eh-item-content."+itemClass+" { padding: "+smallLaptop+" !important; } }";
						}
						if(ipadLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 768px) and (max-width: 1024px) {.edge-eh-item-content."+itemClass+" { padding: "+ipadLandscape+" !important; } }";
						}
						if(ipadPortrait.length) {
							responsiveStyle += "@media only screen and (min-width: 600px) and (max-width: 768px) {.edge-eh-item-content."+itemClass+" { padding: "+ipadPortrait+" !important; } }";
						}
						if(mobileLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 480px) and (max-width: 600px) {.edge-eh-item-content."+itemClass+" { padding: "+mobileLandscape+" !important; } }";
						}
						if(mobilePortrait.length) {
							responsiveStyle += "@media only screen and (max-width: 480px) {.edge-eh-item-content."+itemClass+" { padding: "+mobilePortrait+" !important; } }";
						}
					}
				});
				
				if(responsiveStyle.length) {
					style = '<style type="text/css" data-type="adorn_edge_shortcodes_custom_css">'+responsiveStyle+'</style>';
				}
				
				if(style.length) {
					$('head').append(style);
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(window).load(function(){
		edgeInitFrameSlider();
	});
	
	/*
	 **	Init Frame Slider shortcode
	 */
	function edgeInitFrameSlider() {
		var sliders = $('.edge-frame-slider-holder');
		
		if (sliders.length) {
			sliders.each(function() {
				var sliderHolder = $(this),
					slider = sliderHolder.children('.edge-fs-slides');
				
				slider.owlCarousel({
					loop: true,
					nav: false,
					dots: false,
					center: true,
					responsive: {
						0: {
							items: 1,
							margin: 0,
							autoWidth: false
						},
						681: {
							items: 3,
							margin: 36,
							autoWidth: true
						},
						1441: {
							items: 5,
							margin: 36,
							autoWidth: true
						}
					}
				});
				
				slider.css({'visibility': 'visible'});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		edgeShowGoogleMap();
	});
	
	/*
	 **	Show Google Map
	 */
	function edgeShowGoogleMap(){
		var googleMap = $('.edge-google-map');
		
		if(googleMap.length){
			googleMap.each(function(){
				var element = $(this);
				
				var customMapStyle;
				if(typeof element.data('custom-map-style') !== 'undefined') {
					customMapStyle = element.data('custom-map-style');
				}
				
				var colorOverlay;
				if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
					colorOverlay = element.data('color-overlay');
				}
				
				var saturation;
				if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
					saturation = element.data('saturation');
				}
				
				var lightness;
				if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
					lightness = element.data('lightness');
				}
				
				var zoom;
				if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
					zoom = element.data('zoom');
				}
				
				var pin;
				if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
					pin = element.data('pin');
				}
				
				var mapHeight;
				if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
					mapHeight = element.data('height');
				}
				
				var uniqueId;
				if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
					uniqueId = element.data('unique-id');
				}
				
				var scrollWheel;
				if(typeof element.data('scroll-wheel') !== 'undefined') {
					scrollWheel = element.data('scroll-wheel');
				}
				var addresses;
				if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
					addresses = element.data('addresses');
				}
				
				var map = "map_"+ uniqueId;
				var geocoder = "geocoder_"+ uniqueId;
				var holderId = "edge-map-"+ uniqueId;
				
				edgeInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
			});
		}
	}
	
	/*
	 **	Init Google Map
	 */
	function edgeInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){

		if (typeof google !== 'object') {
			return;
		}

		var mapStyles = [
			{
				stylers: [
					{hue: color },
					{saturation: saturation},
					{lightness: lightness},
					{gamma: 1}
				]
			}
		];
		
		var googleMapStyleId;
		
		if(customMapStyle === 'yes'){
			googleMapStyleId = 'edge-style';
		} else {
			googleMapStyleId = google.maps.MapTypeId.ROADMAP;
		}
		
		if(wheel === 'yes'){
			wheel = true;
		} else {
			wheel = false;
		}
		
		var qoogleMapType = new google.maps.StyledMapType(mapStyles,
			{name: "Edge Google Map"});
		
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);
		
		if (!isNaN(height)){
			height = height + 'px';
		}
		
		var myOptions = {
			zoom: zoom,
			scrollwheel: wheel,
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'edge-style'],
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeId: googleMapStyleId
		};
		
		map = new google.maps.Map(document.getElementById(holderId), myOptions);
		map.mapTypes.set('edge-style', qoogleMapType);
		
		var index;
		
		for (index = 0; index < data.length; ++index) {
			edgeInitializeGoogleAddress(data[index], pin, map, geocoder);
		}
		
		var holderElement = document.getElementById(holderId);
		holderElement.style.height = height;
	}
	
	/*
	 **	Init Google Map Addresses
	 */
	function edgeInitializeGoogleAddress(data, pin, map, geocoder){
		if (data === '') {
			return;
		}
		
		var contentString = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<div id="bodyContent">'+
			'<p>'+data+'</p>'+
			'</div>'+
			'</div>';
		
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		
		geocoder.geocode( { 'address': data}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon:  pin,
					title: data.store_title
				});
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});
				
				google.maps.event.addDomListener(window, 'resize', function() {
					map.setCenter(results[0].geometry.location);
				});
			}
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		edgeIcon().init();
	});
	
	/**
	 * Object that represents icon shortcode
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var edgeIcon = function() {
		//get all icons on page
		var icons = $('.edge-icon-shortcode');
		
		/**
		 * Function that triggers icon animation and icon animation delay
		 */
		var iconAnimation = function(icon) {
			if(icon.hasClass('edge-icon-animation')) {
				icon.appear(function() {
					icon.parent('.edge-icon-animation-holder').addClass('edge-icon-animation-show');
				}, {accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});
			}
		};
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var iconElement = icon.find('.edge-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};
		
		/**
		 * Function that triggers icon holder background color hover functionality
		 */
		var iconHolderBackgroundHover = function(icon) {
			if(typeof icon.data('hover-background-color') !== 'undefined') {
				var changeIconBgColor = function(event) {
					event.data.icon.css('background-color', event.data.color);
				};
				
				var hoverBackgroundColor = icon.data('hover-background-color');
				var originalBackgroundColor = icon.css('background-color');
				
				if(hoverBackgroundColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
					icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
				}
			}
		};
		
		/**
		 * Function that initializes icon holder border hover functionality
		 */
		var iconHolderBorderHover = function(icon) {
			if(typeof icon.data('hover-border-color') !== 'undefined') {
				var changeIconBorder = function(event) {
					event.data.icon.css('border-color', event.data.color);
				};
				
				var hoverBorderColor = icon.data('hover-border-color');
				var originalBorderColor = icon.css('border-color');
				
				if(hoverBorderColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
					icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconAnimation($(this));
						iconHoverColor($(this));
						iconHolderBackgroundHover($(this));
						iconHolderBorderHover($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		edgeInitIconList().init();
	});
	
	/**
	 * Button object that initializes icon list with animation
	 * @type {Function}
	 */
	var edgeInitIconList = function() {
		var iconList = $('.edge-animate-list');
		
		/**
		 * Initializes icon list animation
		 * @param list current slider
		 */
		var iconListInit = function(list) {
			setTimeout(function(){
				list.appear(function(){
					list.addClass('edge-appeared');
				},{accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});
			},30);
		};
		
		return {
			init: function() {
				if(iconList.length) {
					iconList.each(function() {
						iconListInit($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';

    var imageGallery = {};
    edge.modules.imageGallery = imageGallery;
    imageGallery.edgeInitImageGallery = edgeInitImageGallery;

	$(document).ready(function(){
		edgeInitImageGallery();
	});
	
	/**
	 * Init image gallery shortcode
	 */
	function edgeInitImageGallery() {
		var galleries = $('.edge-image-gallery');
		
		if (galleries.length) {
			galleries.each(function () {
				var gallery = $(this).find('.edge-ig-slider'),
					numberOfItems = gallery.data('number-of-visible-items'),
					autoplay = gallery.data('autoplay'),
					animation = (gallery.data('animation') === 'slide') ? false : gallery.data('animation'),
					navigation = (gallery.data('navigation') === 'yes'),
					pagination = (gallery.data('pagination') === 'yes');
				
				//Responsive breakpoints
				var items = numberOfItems;
				
				var responsiveItems1 = 4;
				var responsiveItems2 = 3;
				var responsiveItems3 = 2;
				var responsiveItems4 = 1;
				
				if (items < 3) {
					responsiveItems1 = items;
					responsiveItems2 = items;
				}
				
				if (items < 2) {
					responsiveItems3 = items;
				}
				
				gallery.owlCarousel({
					autoplay: true,
					autoplayTimeout: autoplay * 1000,
					loop: true,
					smartSpeed: 600,
					animateIn : animation, //fade, fadeUp, backSlide, goDown
					nav: navigation,
					dots: pagination,
					navText: [
						'<span class="edge-prev-icon"><span class="edge-icon-arrow ion-ios-arrow-thin-left"></span></span>',
						'<span class="edge-next-icon"><span class="edge-icon-arrow ion-ios-arrow-thin-right"></span></span>'
					],
					responsive:{
						1201:{
							items: items
						},
						769:{
							items: responsiveItems1
						},
						601:{
							items: responsiveItems2
						},
						481:{
							items: responsiveItems3
						},
						0:{
							items: responsiveItems4
						}
					}
				});
				
				gallery.css({'visibility': 'visible'});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		edgeInitItemShowcase();
	});
	
	/**
	 * Init item showcase shortcode
	 */
	function edgeInitItemShowcase() {
		var itemShowcase = $('.edge-item-showcase-holder');
		
		if (itemShowcase.length) {
			itemShowcase.each(function(){
				var thisItemShowcase = $(this),
					leftItems = thisItemShowcase.find('.edge-is-left'),
					rightItems = thisItemShowcase.find('.edge-is-right'),
					itemImage = thisItemShowcase.find('.edge-is-image');
				
				//logic
				leftItems.wrapAll( "<div class='edge-is-item-holder edge-is-left-holder' />");
				rightItems.wrapAll( "<div class='edge-is-item-holder edge-is-right-holder' />");
				thisItemShowcase.animate({opacity:1},200);
				
				setTimeout(function(){
					thisItemShowcase.appear(function(){
						itemImage.addClass('edge-appeared');
						thisItemShowcase.on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
							function(e) {
								if(edge.windowWidth > 1200) {
									itemAppear('.edge-is-left-holder .edge-is-item');
									itemAppear('.edge-is-right-holder .edge-is-item');
								} else {
									itemAppear('.edge-is-item');
								}
							});
					},{accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});
				},100);
				
				//appear animation trigger
				function itemAppear(itemCSSClass) {
					thisItemShowcase.find(itemCSSClass).each(function(i){
						var thisListItem = $(this);
						setTimeout(function(){
							thisListItem.addClass('edge-appeared');
						}, i*150);
					});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
    'use strict';

    $(document).ready(function(){
        edgeInitMessages();
        edgeInitMessageHeight();
    });

/*
 **	Function to close message shortcode
 */
function edgeInitMessages(){
    var message = $('.edge-message');
    if(message.length){
        message.each(function(){
            var thisMessage = $(this);
            thisMessage.find('.edge-close').on('click', function(e){
                e.preventDefault();
                $(this).parent().parent().fadeOut(500);
            });
        });
    }
}

/*
 **	Init message height
 */
function edgeInitMessageHeight(){
    var message = $('.edge-message.edge-with-icon');
    if(message.length){
        message.each(function(){
            var thisMessage = $(this);
            var textHolderHeight = thisMessage.find('.edge-message-text-holder').height();
            var iconHolderHeight = thisMessage.find('.edge-message-icon-holder').height();

            if(textHolderHeight > iconHolderHeight) {
                thisMessage.find('.edge-message-icon-holder').height(textHolderHeight);
            } else {
                thisMessage.find('.edge-message-text-holder').height(iconHolderHeight);
            }
        });
    }
}

})(jQuery);
(function($) {
    'use strict';
	
    $(window).load(function() {
	    edgeInitParallax();
	    if(edge.body.hasClass('wpb-js-composer') && typeof vc_rowBehaviour === 'function') {
		    window.vc_rowBehaviour(); //call vc row behavior on load, this is for parallax on row since it is not loaded after some other shortcodes are loaded
	    }
    });
	
	/*
	 ** Init parallax shortcode
	 */
	function edgeInitParallax(){
		var parallaxHolder = $('.edge-parallax-holder');
		
		if(parallaxHolder.length){
			parallaxHolder.each(function() {
				var parallaxElement = $(this),
					speed = parallaxElement.data('parallax-speed')*0.4;
				
				parallaxElement.parallax('50%', speed);
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		edgeInitPieChart();
	});
	
	/**
	 * Init Pie Chart shortcode
	 */
	function edgeInitPieChart() {
		var pieChartHolder = $('.edge-pie-chart-holder');
		
		if (pieChartHolder.length) {
			pieChartHolder.each(function () {
				var thisPieChartHolder = $(this),
					pieChart = thisPieChartHolder.children('.edge-pc-percentage'),
					barColor = '#25abd1',
					trackColor = '#f7f7f7',
					lineWidth = 3,
					size = 176;
				
				if(typeof pieChart.data('size') !== 'undefined' && pieChart.data('size') !== '') {
					size = pieChart.data('size');
				}
				
				if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
					barColor = pieChart.data('bar-color');
				}
				
				if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
					trackColor = pieChart.data('track-color');
				}
				
				pieChart.appear(function() {
					initToCounterPieChart(pieChart);
					thisPieChartHolder.css('opacity', '1');
					
					pieChart.easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: lineWidth,
						animate: 1500,
						size: size
					});
				},{accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});
			});
		}
	}
	
	/*
	 **	Counter for pie chart number from zero to defined number
	 */
	function initToCounterPieChart(pieChart){
		var counter = pieChart.find('.edge-pc-percent'),
			max = parseFloat(counter.text());
		
		counter.countTo({
			from: 0,
			to: max,
			speed: 1500,
			refreshInterval: 50
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		edgeInitProgressBars();
	});
	
	/*
	 **	Horizontal progress bars shortcode
	 */
	function edgeInitProgressBars(){
		var progressBar = $('.edge-progress-bar');
		
		if(progressBar.length){
			progressBar.each(function() {
				var thisBar = $(this),
					thisBarContent = thisBar.find('.edge-pb-content'),
					percentage = thisBarContent.data('percentage');
				
				thisBar.appear(function() {
					edgeInitToCounterProgressBar(thisBar, percentage);
					
					thisBarContent.css('width', '0%');
					thisBarContent.animate({'width': percentage+'%'}, 2000);
				});
			});
		}
	}
	
	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function edgeInitToCounterProgressBar(progressBar, $percentage){
		var percentage = parseFloat($percentage),
			percent = progressBar.find('.edge-pb-percent');
		
		if(percent.length) {
			percent.each(function() {
				var thisPercent = $(this);
				thisPercent.css('opacity', '1');
				
				thisPercent.countTo({
					from: 0,
					to: percentage,
					speed: 2000,
					refreshInterval: 50
				});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		edgeInitSplitScrollingSection();
	});
	
	/*
	 **	Split Scrolling Section
	 */
	function edgeInitSplitScrollingSection() {}
	
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		edgeInitTabs();
	});
	
	/*
	 **	Init tabs shortcode
	 */
	function edgeInitTabs(){
		var tabs = $('.edge-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.edge-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.edge-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;
					
					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();
			});
		}
	}
	
})(jQuery);
(function($) {
'use strict';

$(window).load(function(){
    edgeInitTextMarquee();
});

/*
 ** Init Frame Slider shortcode
 */
function edgeInitTextMarquee() {

    var marqueeSections = $('.edge-text-marquee');

    if (marqueeSections.length) {
        marqueeSections.each(function(){
            var marqueeSection = $(this);

            var marqueeEffect = function () {
                edgeRequestAnimationFrame();

                var marqueeText = marqueeSection.find('.edge-text-marquee-title'),
                    originalText = marqueeText.first(),
                    auxText = marqueeText.filter('.edge-aux-text'),
                    marqueeTextWidthBasic = Math.round(originalText.width()),
                    marqueeTextWidth = Math.round(originalText.outerWidth());

                auxText.css('left', marqueeTextWidth); //set to the right of the inital marquee text element

                marqueeText.each(function(i){
                    var marqueeTextElement = $(this),
                        currentPos = 0,
                        delta = 2;

                    var edgeInfiniteScrollEffect = function() { 
                        currentPos -= delta;

                        if (Math.round(marqueeTextElement.offset().left) <= -marqueeTextWidth) {
                            marqueeTextElement.css('left', parseInt(marqueeTextWidth - 2*delta));
                            currentPos = 0;
                        }

                        marqueeTextElement.css('transform','translate3d('+currentPos+'px,0,0)');
                        requestAnimFrame(edgeInfiniteScrollEffect);

                        $(window).resize(function(){

                            currentPos = 0;
                            marqueeTextWidth = Math.round(originalText.outerWidth());
                            marqueeText.first().css('left',0);
                            auxText.css('left', marqueeTextWidth); //set to the right of the inital marquee text element
                        });
                    }; 

                    edgeInfiniteScrollEffect();
                });
            };

            //init
            marqueeSection.waitForImages({
                finished: function() {
                    marqueeEffect();
                    marqueeSection.css('visibility','visible');
                },
                waitForAll: true
            });
        });
    }

}

function edgeRequestAnimationFrame() {
    window.requestAnimFrame = (function () {
        return window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.oRequestAnimationFrame ||
            window.msRequestAnimationFrame ||
            function (/* function */ callback, /* DOMElement */ element) {
                window.setTimeout(callback, 1000 / 60);
            };
    })();
}
    
})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		edgeInitVerticalSplitSlider();
	});
	
	/*
	 **	Vertical Split Slider
	 */
	function edgeInitVerticalSplitSlider() {
		var slider = $('.edge-vertical-split-slider');
		
		if (slider.length) {
			if (edge.body.hasClass('edge-vss-initialized')) {
				edge.body.removeClass('edge-vss-initialized');
				$.fn.multiscroll.destroy();
			}
			
			slider.height(edge.windowHeight).animate({opacity: 1}, 300);
			
			var defaultHeaderStyle = '';
			if (edge.body.hasClass('edge-light-header')) {
				defaultHeaderStyle = 'light';
			} else if (edge.body.hasClass('edge-dark-header')) {
				defaultHeaderStyle = 'dark';
			}
			
			slider.multiscroll({
				scrollingSpeed: 700,
				easing: 'easeInOutQuart',
				navigation: true,
				useAnchorsOnLoad: false,
				sectionSelector: '.edge-vss-ms-section',
				leftSelector: '.edge-vss-ms-left',
				rightSelector: '.edge-vss-ms-right',
                loopTop: true,
                loopBottom: true,
				afterRender: function () {
					edgeCheckVerticalSplitSectionsForHeaderStyle($('.edge-vss-ms-left .edge-vss-ms-section:last-child').data('header-style'), defaultHeaderStyle);
					edge.body.addClass('edge-vss-initialized');
					
					var contactForm7 = $('div.wpcf7 > form');
					if (contactForm7.length) {
						_wpcf7.supportHtml5 = $.wpcf7SupportHtml5();
						contactForm7.wpcf7InitForm();
					} // this function need to be initialized after initVerticalSplitSlide
					
					//prepare html for smaller screens - start //
					var verticalSplitSliderResponsive = $('<div class="edge-vss-responsive"></div>'),
						leftSide = slider.find('.edge-vss-ms-left > div'),
						rightSide = slider.find('.edge-vss-ms-right > div');
					
					slider.after(verticalSplitSliderResponsive);
					
					for (var i = 0; i < leftSide.length; i++) {
						verticalSplitSliderResponsive.append($(leftSide[i]).clone(true));
						verticalSplitSliderResponsive.append($(rightSide[leftSide.length - 1 - i]).clone(true));
					}
					
					//prepare google maps clones
					var googleMapHolder = $('.edge-vss-responsive .edge-google-map');
					if (googleMapHolder.length) {
						googleMapHolder.each(function () {
							var map = $(this);
							map.empty();
							var num = Math.floor((Math.random() * 100000) + 1);
							map.attr('id', 'edge-map-' + num);
							map.data('unique-id', num);
						});
					}
					
					if (typeof edgeButton === "function") {
						edgeButton().init();
					}
					
					if (typeof edgeInitElementsHolderResponsiveStyle === "function") {
						edgeInitElementsHolderResponsiveStyle();
					}
					
					if (typeof edgeShowGoogleMap === "function") {
						edgeShowGoogleMap();
					}
					
					if (typeof edgeInitProgressBars === "function") {
						edgeInitProgressBars();
					}
					
					if (typeof edgeInitTestimonials === "function") {
						edgeInitTestimonials();
					}
				},
				onLeave: function (index, nextIndex, direction) {
					edgeCheckVerticalSplitSectionsForHeaderStyle($($('.edge-vss-ms-left .edge-vss-ms-section')[$(".edge-vss-ms-left .edge-vss-ms-section").length - nextIndex]).data('header-style'), defaultHeaderStyle);
				}
			});
			
			if (edge.windowWidth <= 1024) {
				$.fn.multiscroll.destroy();
			} else {
				$.fn.multiscroll.build();
			}
			
			$(window).resize(function () {
				if (edge.windowWidth <= 1024) {
					$.fn.multiscroll.destroy();
				} else {
					$.fn.multiscroll.build();
				}
			});
		}
	}
	
	/*
	 **	Check slides on load and slide change for header style changing
	 */
	function edgeCheckVerticalSplitSectionsForHeaderStyle(section_header_style, default_header_style) {
		if (section_header_style !== undefined && section_header_style !== '') {
			edge.body.removeClass('edge-light-header edge-dark-header').addClass('edge-' + section_header_style + '-header');
		} else if (default_header_style !== '') {
			edge.body.removeClass('edge-light-header edge-dark-header').addClass('edge-' + default_header_style + '-header');
		} else {
			edge.body.removeClass('edge-light-header edge-dark-header');
		}
	}
	
})(jQuery);
(function($) {
    'use strict';

    var wooCustomSc = {};
    edge.modules.wooCustomSc = wooCustomSc;

    wooCustomSc.edgeOnDocumentReady = edgeOnDocumentReady;
    wooCustomSc.edgeOnWindowLoad = edgeOnWindowLoad;
    wooCustomSc.edgeOnWindowResize = edgeOnWindowResize;
    wooCustomSc.edgeOnWindowScroll = edgeOnWindowScroll;

    $(document).ready(edgeOnDocumentReady);
    $(window).load(edgeOnWindowLoad);
    $(window).resize(edgeOnWindowResize);
    $(window).scroll(edgeOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgeOnDocumentReady() {
        edgeInitWooCustomProductList();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgeOnWindowLoad() {
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function edgeOnWindowResize() {
        edgeInitWooCustomProductList();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgeOnWindowScroll() {}

    function edgeInitWooCustomProductList(){

        var wooCustomList = $('.edge-woo-custom-items-holder');

        if(wooCustomList.length){
            wooCustomList.each(function(){
                var thisList = $(this),
                    masonry = thisList.children('.edge-woo-custom-items-inner'),
                    size = thisList.find('.edge-woo-custom-grid-sizer').width();

                edgeResizeWooCustomItems(size, thisList);

                masonry.isotope({
                    layoutMode: 'packery',
                    itemSelector: 'article',
                    percentPosition: true,
                    packery: {
                        gutter: '.edge-woo-custom-grid-gutter',
                        columnWidth: '.edge-woo-custom-grid-sizer'
                    }
                });

                masonry.css('opacity', '1');
            });
        }

    }
    
    function edgeResizeWooCustomItems(size, container) {

        var defaultMasonryItem = container.find('.edge-product-default-item'),
            largeWidthMasonryItem = container.find('.edge-product-large-width'),
            largeHeightMasonryItem = container.find('.edge-product-large-height'),
            largeWidthHeightMasonryItem = container.find('.edge-product-large-width-height');

        if (edge.windowWidth > 600) {
            defaultMasonryItem.css('height', size);
            largeHeightMasonryItem.css('height', Math.round(2 * size));
            largeWidthHeightMasonryItem.css('height', Math.round(2 * size));
            largeWidthMasonryItem.css('height', size);
        } else {
            defaultMasonryItem.css('height', size);
            largeHeightMasonryItem.css('height', size);
            largeWidthHeightMasonryItem.css('height', size);
            largeWidthMasonryItem.css('height', Math.round(size / 2));
        }
        
    }

})(jQuery);

(function($) {
    'use strict';

    $(document).ready(function(){
        setWooCategoriesHeight();
    });
    $(window).resize(function(){
        setWooCategoriesHeight();
    });

    function setWooCategoriesHeight(){

        var holder = $('.edge-floating-prod-cats-holder');

        if(holder.length){
            holder.each(function () {

                var thisHolder = $(this),
                items = thisHolder.find('.edge-floating-prod-cat');

                if(items.length){
                    var width = items.width();
                    if(typeof width !== 'undefined' && width !== '' && width !=='undefined'){
                        items.height(width);
                        items.addClass('show');
                    }
                }

            });
        }
    }

})(jQuery);
(function($) {
	'use strict';
	
	$(document).ready(function(){
		edgeParallaxPtfText();
	});
	
	/**
	 * Parallax Pft text
	 * @type {Function}
	 */

	function edgeParallaxPtfText() {
	    var parallaxLists = $('.edge-prod-cats-holder.edge-parallax-items');


	    if (parallaxLists.length && !edge.htmlEl.hasClass('touch')) {
	        parallaxLists.each(function(){

	            var parallaxList = $(this),
	                categories = parallaxList.find('.edge-prod-cat'),
	                yOffset = parallaxList.attr('data-y-axis-translation'),
	                negative = false;

	            if (yOffset < 0) {
	                negative = true;
	            }

	            categories.each(function(){
	                var category = $(this),
	                    categoryHeight = category.outerHeight(),
	                    categoryInner = category.find('.edge-prod-cat-inner'),
	                    categoryInnerHeight = categoryInner.height(),
	                    delta = yOffset;

	                if (negative) {
	                     delta = -delta;
	                }

	                var dataParallax = '{"y":'+delta+', "smoothness":20}';
	                categoryInner.attr('data-parallax', dataParallax);
	            });
	        });

	        setTimeout(function(){
	            ParallaxScroll.init(); //initialzation removed from plugin js file to have it run only on non-touch devices
	        }, 100); //wait for calcs
	    }
	}
	
})(jQuery);
(function($) {
    'use strict';

    $(document).ready(function(){
	    edgeInitMasonryGallery();
    });
	
	/**
	 * Masonry gallery, init masonry and resize pictures in grid
	 */
	function edgeInitMasonryGallery(){
		var galleryHolder = $('.edge-masonry-gallery-holder'),
			gallery = galleryHolder.children('.edge-mg-inner'),
			gallerySizer = gallery.children('.edge-mg-grid-sizer');
		
		resizeMasonryGallery(gallerySizer.outerWidth(), gallery);
		
		if(galleryHolder.length){
			galleryHolder.each(function(){
				var holder = $(this),
					holderGallery = holder.children('.edge-mg-inner');
				
				holderGallery.waitForImages(function(){
					holderGallery.animate({opacity:1});
					
					holderGallery.isotope({
						layoutMode: 'packery',
						itemSelector: '.edge-mg-item',
						percentPosition: true,
						packery: {
							gutter: '.edge-mg-grid-gutter',
							columnWidth: '.edge-mg-grid-sizer'
						}
					});
				});
			});
			
			$(window).resize(function(){
				resizeMasonryGallery(gallerySizer.outerWidth(), gallery);
				
				gallery.isotope('reloadItems');
			});
		}
	}
	
	function resizeMasonryGallery(size, holder){
		var rectangle_portrait = holder.find('.edge-mg-rectangle-portrait'),
			rectangle_landscape = holder.find('.edge-mg-rectangle-landscape'),
			square_big = holder.find('.edge-mg-square-big'),
			square_small = holder.find('.edge-mg-square-small');
		
		rectangle_portrait.css('height', 2*size);
		
		if (window.innerWidth <= 680) {
			rectangle_landscape.css('height', size/2);
		} else {
			rectangle_landscape.css('height', size);
		}
		
		square_big.css('height', 2*size);
		
		if (window.innerWidth <= 680) {
			square_big.css('height', square_big.width());
		}
		
		square_small.css('height', size);
	}

})(jQuery);
(function($) {
    'use strict';

    var portfolio = {};
    edge.modules.portfolio = portfolio;

    portfolio.edgeOnDocumentReady = edgeOnDocumentReady;
    portfolio.edgeOnWindowLoad = edgeOnWindowLoad;
    portfolio.edgeOnWindowResize = edgeOnWindowResize;
    portfolio.edgeOnWindowScroll = edgeOnWindowScroll;

    $(document).ready(edgeOnDocumentReady);
    $(window).load(edgeOnWindowLoad);
    $(window).resize(edgeOnWindowResize);
    $(window).scroll(edgeOnWindowScroll);
    
    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function edgeOnDocumentReady() {
        edgeInitPortfolioSlider();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgeOnWindowLoad() {
        edgeInitPortfolioMasonry();
        edgeInitPortfolioFilter();
        initPortfolioSingleMasonry();
        edgeInitPortfolioListAnimation();
	    edgeInitPortfolioPagination().init();
        edgePortfolioSingleFollow().init();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function edgeOnWindowResize() {
        edgeInitPortfolioMasonry();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgeOnWindowScroll() {
	    edgeInitPortfolioPagination().scroll();
    }

    /**
     * Initializes portfolio list article animation
     */
    function edgeInitPortfolioListAnimation(){
        var portList = $('.edge-portfolio-list-holder.edge-pl-has-animation');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this).children('.edge-pl-inner'),
                	articles = thisPortList.find('article'),
                    rewindCalc = 0,
                    cycle = 0,
                    delay = 250,
                    yOffset = edgeGlobalVars.vars.edgeElementAppearAmount;

                articles.each(function() {
                    var article = $(this);

                    if (article.offset().top == articles.first().offset().top) { //find the number of articles in the same row
                        rewindCalc ++;
                    }

                    article.appear(function(){
                        if (cycle == rewindCalc) {
                            cycle = 0;
                        }

                        setTimeout(function(){
    		            	showItem(article);
                        }, cycle*delay);

                        cycle++;
                    }, {accX: 0, accY: yOffset});
                });
            });

			//show item function
			var showItem = function(article) {
				article.addClass('edge-item-show');

				article.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				    article.addClass('edge-item-shown');
				});
			}
        }
    }

    /**
     * Initializes portfolio list
     */
    function edgeInitPortfolioMasonry(){
        var portList = $('.edge-portfolio-list-holder.edge-pl-masonry');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this),
                    masonry = thisPortList.children('.edge-pl-inner'),
                    size = thisPortList.find('.edge-pl-grid-sizer').width();
                
                edgeResizePortfolioItems(size, thisPortList);

                masonry.isotope({
                    layoutMode: 'packery',
                    itemSelector: 'article',
                    percentPosition: true,
                    packery: {
                        gutter: '.edge-pl-grid-gutter',
                        columnWidth: '.edge-pl-grid-sizer'
                    }
                });

                masonry.css('opacity', '1');
            });
        }
    }

    /**
     * Init Resize Blog Items
     */
    function edgeResizePortfolioItems(size,container){

        if(container.hasClass('edge-pl-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.edge-pl-masonry-default'),
                largeWidthMasonryItem = container.find('.edge-pl-masonry-large-width'),
                largeHeightMasonryItem = container.find('.edge-pl-masonry-large-height'),
                largeWidthHeightMasonryItem = container.find('.edge-pl-masonry-large-width-height');

            if (edge.windowWidth > 680) {
                defaultMasonryItem.css('height', size - 2 * padding);
                largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthMasonryItem.css('height', size - 2 * padding);
            } else {
                defaultMasonryItem.css('height', size);
                largeHeightMasonryItem.css('height', size);
                largeWidthHeightMasonryItem.css('height', size);
                largeWidthMasonryItem.css('height', Math.round(size / 2));
            }
        }
    }

    /**
     * Initializes portfolio masonry filter
     */
    function edgeInitPortfolioFilter(){
        var filterHolder = $('.edge-portfolio-list-holder .edge-pl-filter-holder');

        if(filterHolder.length){
            filterHolder.each(function(){
                var thisFilterHolder = $(this),
                    thisPortListHolder = thisFilterHolder.closest('.edge-portfolio-list-holder'),
                    thisPortListInner = thisPortListHolder.find('.edge-pl-inner'),
                    portListHasLoadMore = thisPortListHolder.hasClass('edge-pl-pag-load-more') ? true : false;

                thisFilterHolder.find('.edge-pl-filter:first').addClass('edge-pl-current');
	            
	            if(thisPortListHolder.hasClass('edge-pl-gallery')) {
		            thisPortListInner.isotope();
	            }

                thisFilterHolder.find('.edge-pl-filter').on('click', function(){
                    var thisFilter = $(this),
                        filterValue = thisFilter.attr('data-filter'),
                        filterClassName = filterValue.length ? filterValue.substring(1) : '',
                        portListHasArtciles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                    thisFilter.parent().children('.edge-pl-filter').removeClass('edge-pl-current');
                    thisFilter.addClass('edge-pl-current');

                    if(portListHasLoadMore && !portListHasArtciles) {
                        edgeInitLoadMoreItemsPortfolioFilter(thisPortListHolder, filterValue, filterClassName);
                    } else {
                        thisFilterHolder.parent().children('.edge-pl-inner').isotope({ filter: filterValue });
                    }
                });
            });
        }
    }

    /**
     * Initializes load more items if portfolio masonry filter item is empty
     */
    function edgeInitLoadMoreItemsPortfolioFilter($portfolioList, $filterValue, $filterClassName) {

        var thisPortList = $portfolioList,
            thisPortListInner = thisPortList.find('.edge-pl-inner'),
            filterValue = $filterValue,
            filterClassName = $filterClassName,
            maxNumPages = 0;

        if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
            maxNumPages = thisPortList.data('max-num-pages');
        }

        var	loadMoreDatta = edge.modules.common.getLoadMoreData(thisPortList),
            nextPage = loadMoreDatta.nextPage,
	        ajaxData = edge.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'edge_core_portfolio_ajax_load_more'),
            loadingItem = thisPortList.find('.edge-pl-loading');

        if(nextPage <= maxNumPages) {
            loadingItem.addClass('edge-showing edge-filter-trigger');
            thisPortListInner.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: EdgeAjaxUrl,
                success: function (data) {
                    nextPage++;
                    thisPortList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    thisPortList.waitForImages(function () {
                        thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        var portListHasArtciles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                        if(portListHasArtciles) {
                            setTimeout(function() {
                                edgeResizePortfolioItems(thisPortListInner.find('.edge-pl-grid-sizer').width(), thisPortList);
                                thisPortListInner.isotope('layout').isotope({filter: filterValue});
                                loadingItem.removeClass('edge-showing edge-filter-trigger');

                                setTimeout(function() {
                                    thisPortListInner.css('opacity', '1');
                                }, 150);
                            }, 400);
                        } else {
                            loadingItem.removeClass('edge-showing edge-filter-trigger');
                            edgeInitLoadMoreItemsPortfolioFilter(thisPortList, filterValue, filterClassName);
                        }
                    });
                }
            });
        }
    }
	
	/**
	 * Initializes portfolio pagination functions
	 */
	function edgeInitPortfolioPagination(){
		var portList = $('.edge-portfolio-list-holder');
		
		var initStandardPagination = function(thisPortList) {
			var standardLink = thisPortList.find('.edge-pl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisPortList, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisPortList) {
			var loadMoreButton = thisPortList.find('.edge-pl-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisPortList);
			});
		};
		
		var initInifiteScrollPagination = function(thisPortList) {
			var portListHeight = thisPortList.outerHeight(),
				portListTopOffest = thisPortList.offset().top,
				portListPosition = portListHeight + portListTopOffest - edgeGlobalVars.vars.edgeAddForAdminBar;
			
			if(!thisPortList.hasClass('edge-pl-infinite-scroll-started') && edge.scroll + edge.windowHeight > portListPosition) {
				initMainPagFunctionality(thisPortList);
			}
		};
		
		var initMainPagFunctionality = function(thisPortList, pagedLink) {
			var thisPortListInner = thisPortList.find('.edge-pl-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
				maxNumPages = thisPortList.data('max-num-pages');
			}
			
			if(thisPortList.hasClass('edge-pl-pag-standard')) {
				thisPortList.data('next-page', pagedLink);
			}
			
			if(thisPortList.hasClass('edge-pl-pag-infinite-scroll')) {
				thisPortList.addClass('edge-pl-infinite-scroll-started');
			}
			
			var loadMoreDatta = edge.modules.common.getLoadMoreData(thisPortList),
				loadingItem = thisPortList.find('.edge-pl-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages){
				if(thisPortList.hasClass('edge-pl-pag-standard')) {
					loadingItem.addClass('edge-showing edge-standard-pag-trigger');
					thisPortList.addClass('edge-pl-pag-standard-animate');
				} else {
					loadingItem.addClass('edge-showing');
				}
				
				var ajaxData = edge.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'edge_core_portfolio_ajax_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: EdgeAjaxUrl,
					success: function (data) {
						if(!thisPortList.hasClass('edge-pl-pag-standard')) {
							nextPage++;
						}
						
						thisPortList.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisPortList.hasClass('edge-pl-pag-standard')) {
							edgeInitStandardPaginationLinkChanges(thisPortList, maxNumPages, nextPage);
							
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('edge-pl-masonry')){
                                    edgeResizePortfolioItems(thisPortListInner.find('.edge-pl-grid-sizer').width(), thisPortList);
									edgeInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('edge-pl-gallery') && thisPortList.hasClass('edge-pl-has-filter')) {
									edgeInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
									edgeInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('edge-pl-masonry')){
									edgeInitAppendIsotopeNewContent(thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('edge-pl-gallery') && thisPortList.hasClass('edge-pl-has-filter')) {
									edgeInitAppendIsotopeNewContent(thisPortListInner, loadingItem, responseHtml);
								} else {
									edgeInitAppendGalleryNewContent(thisPortListInner, loadingItem, responseHtml);
								}
							});
						}
						
						if(thisPortList.hasClass('edge-pl-infinite-scroll-started')) {
							thisPortList.removeClass('edge-pl-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisPortList.find('.edge-pl-load-more-holder').hide();
			}
		};
		
		var edgeInitStandardPaginationLinkChanges = function(thisPortList, maxNumPages, nextPage) {
			var standardPagHolder = thisPortList.find('.edge-pl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.edge-pl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.edge-pl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.edge-pl-pag-next a');
			
			standardPagNumericItem.removeClass('edge-pl-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('edge-pl-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var edgeInitHtmlIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			thisPortListInner.html(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edge-showing edge-standard-pag-trigger');
			thisPortList.removeClass('edge-pl-pag-standard-animate');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				edgeInitPortfolioListAnimation();
			}, 400);
		};
		
		var edgeInitHtmlGalleryNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edge-showing edge-standard-pag-trigger');
			thisPortList.removeClass('edge-pl-pag-standard-animate');
			thisPortListInner.html(responseHtml);
			edgeInitPortfolioListAnimation();
		};
		
		var edgeInitAppendIsotopeNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edge-showing');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				edgeInitPortfolioListAnimation();
			}, 400);
		};
		
		var edgeInitAppendGalleryNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edge-showing');
			thisPortListInner.append(responseHtml);
			edgeInitPortfolioListAnimation();
		};
		
		return {
			init: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('edge-pl-pag-standard')) {
							initStandardPagination(thisPortList);
						}
						
						if(thisPortList.hasClass('edge-pl-pag-load-more')) {
							initLoadMorePagination(thisPortList);
						}
						
						if(thisPortList.hasClass('edge-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
			scroll: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('edge-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			}
		};
	}

    /**
     * Initializes portfolio slider
     */
    function edgeInitPortfolioSlider(){
        var portSlider = $('.edge-portfolio-slider-holder');
	
	    if(portSlider.length) {
		    portSlider.each(function () {
			    var thisPortSlider = $(this),
				    portHolder = thisPortSlider.children('.edge-portfolio-list-holder'),
				    portSlider = portHolder.children('.edge-pl-inner'),
				    numberOfItems = 4,
				    margin = 0,
				    marginLabel,
				    sliderSpeed = 5000,
				    loop = true,
				    padding = false,
				    navigation = true,
				    pagination = true;
			
			    if (typeof portHolder.data('number-of-columns') !== 'undefined' && portHolder.data('number-of-columns') !== false) {
				    numberOfItems = portHolder.data('number-of-columns');
			    }
			
			    if (typeof portHolder.data('space-between-items') !== 'undefined' && portHolder.data('space-between-items') !== false) {
				    marginLabel = portHolder.data('space-between-items');
				
				    if (marginLabel === 'normal') {
                        margin = 30;
                    } else if (marginLabel === 'small') {
					    margin = 20;
				    } else if (marginLabel === 'tiny') {
                        margin = 10;
                    } else {
					    margin = 0;
				    }
			    }
			
			    if (typeof portHolder.data('slider-speed') !== 'undefined' && portHolder.data('slider-speed') !== false) {
				    sliderSpeed = portHolder.data('slider-speed');
			    }
			    if (typeof portHolder.data('enable-loop') !== 'undefined' && portHolder.data('enable-loop') !== false && portHolder.data('enable-loop') === 'no') {
				    loop = false;
			    }
			    if (typeof portHolder.data('enable-padding') !== 'undefined' && portHolder.data('enable-padding') !== false && portHolder.data('enable-padding') === 'yes') {
				    padding = true;
			    }
			    if (typeof portHolder.data('enable-navigation') !== 'undefined' && portHolder.data('enable-navigation') !== false && portHolder.data('enable-navigation') === 'no') {
				    navigation = false;
			    }
			    if (typeof portHolder.data('enable-pagination') !== 'undefined' && portHolder.data('enable-pagination') !== false && portHolder.data('enable-pagination') === 'no') {
				    pagination = false;
			    }
			
			    var responsiveNumberOfItems1 = 1,
				    responsiveNumberOfItems2 = 2,
				    responsiveNumberOfItems3 = 3;
			
			    if (numberOfItems < 3) {
				    responsiveNumberOfItems1 = numberOfItems;
				    responsiveNumberOfItems2 = numberOfItems;
				    responsiveNumberOfItems3 = numberOfItems;
			    }
			
			    portSlider.owlCarousel({
				    items: numberOfItems,
				    margin: margin,
				    loop: loop,
				    autoplay: true,
				    autoplayTimeout: sliderSpeed,
				    autoplayHoverPause: true,
				    smartSpeed: 800,
				    nav: navigation,
				    navText: [
                        '<span class="edge-prev-icon"><span class="edge-icon-linear-icon lnr lnr-arrow-left"></span></span>',
                        '<span class="edge-next-icon"><span class="edge-icon-linear-icon lnr lnr-arrow-right"></span></span>'
				    ],
				    dots: pagination,
				    responsive: {
					    0: {
						    items: responsiveNumberOfItems1,
						    stagePadding: 0
					    },
					    600: {
						    items: responsiveNumberOfItems2
					    },
					    768: {
						    items: responsiveNumberOfItems3
					    },
					    1024: {
						    items: numberOfItems
					    }
				    }
			    });
			
			    thisPortSlider.css('opacity', '1');
		    });
	    }
    }

    var edgePortfolioSingleFollow = function() {

        var info = $('.edge-follow-portfolio-info .edge-portfolio-single-holder .edge-ps-info-sticky-holder');

        if (info.length) {
            var infoHolderOffset = info.offset().top,
                infoHolderHeight = info.height(),
                mediaHolder = $('.edge-ps-image-holder'),
                mediaHolderHeight = mediaHolder.height(),
                header = $('.header-appear, .edge-fixed-wrapper'),
                headerHeight = (header.length) ? header.height() : 0;
        }

        var infoHolderPosition = function() {

            if(info.length) {

                if (mediaHolderHeight > infoHolderHeight) {
                    if(edge.scroll > infoHolderOffset) {
                        var marginTop = edge.scroll + headerHeight + edgeGlobalVars.vars.edgeAddForAdminBar - infoHolderOffset;
                        // if scroll is initially positioned below mediaHolderHeight
                        if(marginTop + infoHolderHeight > mediaHolderHeight){
                            marginTop = mediaHolderHeight - infoHolderHeight;
                        }
                        info.animate({
                            marginTop: marginTop
                        });
                    }
                }
            }
        };

        var recalculateInfoHolderPosition = function() {

            if (info.length) {
                if(mediaHolderHeight > infoHolderHeight) {
                    if(edge.scroll > infoHolderOffset) {
                    	
                        if(edge.scroll + headerHeight + infoHolderHeight <  mediaHolderHeight) {
                            //Calculate header height if header appears
                            if ($('.header-appear, .edge-fixed-wrapper').length) {
                                headerHeight = $('.header-appear, .edge-fixed-wrapper').height();
                            }
                            info.stop().animate({
                                marginTop: (edge.scroll + headerHeight + edgeGlobalVars.vars.edgeAddForAdminBar - infoHolderOffset)
                            });
                            //Reset header height
                            headerHeight = 0;
                        } else{
                            info.stop().animate({
                            	marginTop: mediaHolderHeight - infoHolderHeight
                            });
                        }
                    } else {
                        info.stop().animate({
                            marginTop: 0
                        });
                    }
                }
            }
        };

        return {
            init : function() {
                infoHolderPosition();
                $(window).scroll(function(){
                    recalculateInfoHolderPosition();
                });
            }
        };
    };
	
	function initPortfolioSingleMasonry(){
		var masonryHolder = $('.edge-portfolio-single-holder .edge-ps-masonry-images'),
			masonry = masonryHolder.children();
		
		if(masonry.length){
            masonry.isotope({
                layoutMode: 'packery',
                itemSelector: '.edge-ps-image',
                percentPosition: true,
                packery: {
                    gutter: '.edge-ps-grid-gutter',
                    columnWidth: '.edge-ps-grid-sizer'
                }
            });

            masonry.css('opacity', '1');
		}
	}

})(jQuery);
(function($) {
    'use strict';

    $(document).ready(function(){
	    // edgeInitTeamSlider();
    });
	
	/**
	 * Init team slider shortcode
	 */
	function edgeInitTeamSlider() {
		var teamSliders = $('.edge-team-slider-holder');
		
		if (teamSliders.length) {
			teamSliders.each(function () {
				
				var thisTeamSlider = $(this),
					teamHolder = thisTeamSlider.children('.edge-team-list-holder'),
					teamSlider = teamHolder.children('.edge-tl-inner');
				
				var dots = (teamHolder.data('dots') == 'yes');
				
				var numberOfItems = teamHolder.data('number_of_items');
				
				var responsiveItems1 = numberOfItems;
				var responsiveItems2 = 3;
				var responsiveItems3 = 2;
				var responsiveItems4 = 1;
				
				if (numberOfItems > 4) {
					responsiveItems1 = 4;
				}
				
				if(numberOfItems < 3) {
					responsiveItems2 = numberOfItems;
				}
				
				if (numberOfItems < 2) {
					responsiveItems3 = numberOfItems;
				}
				
				if (numberOfItems === 1) {
					responsiveItems4 = numberOfItems;
				}
				
				teamSlider.owlCarousel({
					dots: dots,
					nav: false,
					items: numberOfItems,
					responsive:{
						1200:{
							items: numberOfItems
						},
						1024:{
							items: responsiveItems1
						},
						769:{
							items: responsiveItems2
						},
						601:{
							items: responsiveItems3
						},
						0:{
							items: responsiveItems4
						}
					},
					onInitialized: function() {
						teamSlider.css({'opacity': 1});
					}
				});
			});
		}
	}

})(jQuery);
(function($) {
    'use strict';

    $(document).ready(function(){
	    edgeInitTestimonials();
    });

	/**
	 * Init testimonials shortcode
	 */
	function edgeInitTestimonials(){
		var testimonialsHolder = $('.edge-testimonials-holder');

		if(testimonialsHolder.length){
			testimonialsHolder.each(function(){
				var thisTestimonials = $(this),
					testimonials = thisTestimonials.children('.edge-testimonials'),
					numberOfItems = 3,
					loop = true,
					autoplay = true,
					number = 0,
					speed = 5000,
					animationSpeed = 600,
					navArrows = true,
					navDots = true,
					margin = 26;

				if (typeof testimonials.data('number') !== 'undefined' && testimonials.data('number') !== false) {
					number = parseInt(testimonials.data('number'));
				}

				if (typeof testimonials.data('number-visible') !== 'undefined' && testimonials.data('number-visible') !== false) {
					numberOfItems = parseInt(testimonials.data('number-visible'));
				}

				if (typeof testimonials.data('speed') !== 'undefined' && testimonials.data('speed') !== false) {
					speed = testimonials.data('speed');
				}

				if (typeof testimonials.data('animation-speed') !== 'undefined' && testimonials.data('animation-speed') !== false) {
					animationSpeed = testimonials.data('animation-speed');
				}

				if (typeof testimonials.data('nav-arrows') !== 'undefined' && testimonials.data('nav-arrows') !== false && testimonials.data('nav-arrows') === 'no') {
					navArrows = false;
				}

				if (typeof testimonials.data('nav-dots') !== 'undefined' && testimonials.data('nav-dots') !== false && testimonials.data('nav-dots') === 'no') {
					navDots = false;
				}

				if(number === 1) {
					loop = false;
					autoplay = false;
					navArrows = false;
					navDots = false;
				}

                var responsiveNumberOfItems1 = 1,
                    responsiveNumberOfItems2 = 2;

                if (numberOfItems < 3) {
                    responsiveNumberOfItems1 = numberOfItems;
                    responsiveNumberOfItems2 = numberOfItems;
                }

				testimonials.owlCarousel({
					items: numberOfItems,
					loop: loop,
					autoplay: autoplay,
					autoplayTimeout: speed,
					smartSpeed: animationSpeed,
					margin: margin,
					nav: navArrows,
					dots: navDots,
                    responsive: {
						0: {
                            items: responsiveNumberOfItems1,
                            margin: 0,
                            center: false,
                            autoWidth: false
                        },
                        769: {
                            items: responsiveNumberOfItems2
                        },
                        1025: {
                            items: numberOfItems
                        }
                    },
					navText: [
						'<span class="edge-prev-icon"><span class="edge-icon-linear-icon lnr lnr-arrow-left"></span></span>',
						'<span class="edge-next-icon"><span class="edge-icon-linear-icon lnr lnr-arrow-right"></span></span>'
					]
				});
				thisTestimonials.css({'visibility': 'visible'});
			});
		}
	}

})(jQuery);
(function($) {
    'use strict';

    var woocommerce = {};
    edge.modules.woocommerce = woocommerce;

    woocommerce.edgeOnDocumentReady = edgeOnDocumentReady;
    woocommerce.edgeOnWindowLoad = edgeOnWindowLoad;
    woocommerce.edgeOnWindowResize = edgeOnWindowResize;
    woocommerce.edgeOnWindowScroll = edgeOnWindowScroll;

    $(document).ready(edgeOnDocumentReady);
    $(window).load(edgeOnWindowLoad);
    $(window).resize(edgeOnWindowResize);
    $(window).scroll(edgeOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgeOnDocumentReady() {
        edgeInitQuantityButtons();
        edgeInitSelect2();
        edgeInitSingleProductLightbox();
        edgeInitProductListFilter().init();
        edgeWishlistRefresh().init();
        edgeQuickViewGallery().init();
        edgeQuickViewSelect2();
        edgeAddingToCart();
        edgeAddingToWishlist();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgeOnWindowLoad() {
        edgeInitProductListMasonryShortcode();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgeOnWindowResize() {
        edgeInitProductListMasonryShortcode();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgeOnWindowScroll() {}
    
    /*
    ** Init quantity buttons to increase/decrease products for cart
    */
    function edgeInitQuantityButtons() {
    
        $(document).on( 'click', '.edge-quantity-minus, .edge-quantity-plus', function(e) {
            e.stopPropagation();

            var button = $(this),
                inputField = button.siblings('.edge-quantity-input'),
                step = parseFloat(inputField.attr('step')),
                max = parseFloat(inputField.attr('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('edge-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(0);
                }
            } else {
                newInputValue = inputValue + step;
                if ( max === undefined ) {
                    inputField.val(newInputValue);
                } else {
                    if ( newInputValue >= max ) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }

            inputField.trigger( 'change' );
        });
    }

    /*
    ** Init select2 script for select html dropdowns
    */
    function edgeInitSelect2() {

        if ($('.woocommerce-ordering .orderby').length) {
            $('.woocommerce-ordering .orderby').select2({
                minimumResultsForSearch: Infinity
            });
        }

        if($('#calc_shipping_country').length) {
            $('#calc_shipping_country').select2();
        }

        $(edge.body).on('updated_shipping_method',function(){
            $('#calc_shipping_country').select2();
        });

        if($('.cart-collaterals .shipping select#calc_shipping_state').length) {
            $('.cart-collaterals .shipping select#calc_shipping_state').select2();
        }

        if($('.edge-woo-single-page .variations select').length) {
            $('.edge-woo-single-page .variations select').select2();
        }
    }

    /*
     ** Init Product List Masonry Image Sizes
     */
    function edgeProductImageSizes(thisContainer) {

        var size = thisContainer.find('.edge-pl-sizer').width();

        var defaultMasonryItem = thisContainer.find('.edge-woo-image-normal-width');
        var largeWidthMasonryItem = thisContainer.find('.edge-woo-image-large-width');
        var largeHeightMasonryItem = thisContainer.find('.edge-woo-image-large-height');
        var largeWidthHeightMasonryItem = thisContainer.find('.edge-woo-image-large-width-height');

        if(thisContainer.find('.edge-landscape-size').length){
            size = size * 0.8;
        }
        defaultMasonryItem.css('height', size);

        if (edge.windowWidth > 600) {
            largeWidthHeightMasonryItem.css('height', Math.round(2 * size));
            largeHeightMasonryItem.css('height', Math.round(2 * size));
            largeWidthMasonryItem.css('height', size);
        } else {
            largeWidthHeightMasonryItem.css('height', size);
            largeHeightMasonryItem.css('height', size);
        }
    }

	/*
	 ** Init Product List Masonry Shortcode Layout
	 */
	function edgeInitProductListMasonryShortcode() {
		var container = $('.edge-pl-holder.edge-masonry-layout .edge-pl-outer');

		if(container.length) {
			container.each(function(){
				var thisContainer = $(this);

                edgeProductImageSizes(thisContainer);
				thisContainer.waitForImages(function() {
					thisContainer.isotope({
						itemSelector: '.edge-pli',
						resizable: false,
                        layoutMode: 'packery',
						masonry: {
							columnWidth: '.edge-pl-sizer',
							gutter: '.edge-pl-gutter'
						}
					});
					
					thisContainer.isotope('layout');
					
					thisContainer.css('opacity', 1);
				});
			});
		}
	}

	function edgeInitProductListFilter(){
		var productList = $('.edge-pl-holder');
		var queryParams = {};

        var initFilterClick = function(thisProductList){
            var links = thisProductList.find('.edge-pl-categories a, .edge-pl-ordering a');

            links.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                var clickedLink = $(this);
                if(!clickedLink.hasClass('active')) {
                    initMainPagFunctionality(thisProductList, clickedLink);
                }
            });
		}

		//used for replacing content after ajax call
        var edgeReplaceStandardContent = function(thisProductListInner, loader, responseHtml) {
            thisProductListInner.html(responseHtml);
            loader.fadeOut();
        };

        //used for replacing content after ajax call
        var edgeReplaceMasonryContent = function(thisProductListInner, loader, responseHtml) {
            thisProductListInner.find('.edge-pli').remove();

            thisProductListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            edgeProductImageSizes(thisProductListInner);
            setTimeout(function() {
                thisProductListInner.isotope('layout');
                loader.fadeOut();
            }, 400);
        };

        //used for storing parameters in global object
        var edgeReturnOrderingParemeters = function(queryParams, data){

            for (var key in data) {
                queryParams[key] = data[key];
            }

            //store ordering parameters
            switch(queryParams.ordering) {
                case 'menu_order':
                    queryParams.metaKey = '';
                    queryParams.order = 'asc';
                    queryParams.orderby = 'menu_order title';
                    break;
                case 'popularity':
                    queryParams.metaKey = 'total_sales';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'rating':
                    queryParams.metaKey = '_wc_average_rating';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'newness':
                    queryParams.metaKey = '';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'date';
                    break;
                case 'price':
                    queryParams.metaKey = '_price';
                    queryParams.order = 'asc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'price-desc':
                    queryParams.metaKey = '_price';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
            }

            return queryParams;
        }

		var initMainPagFunctionality = function(thisProductList, clickedLink){
            var thisProductListInner = thisProductList.find('.edge-pl-outer');

            var loadData = edge.modules.common.getLoadMoreData(thisProductList),
				loader = thisProductList.find('.edge-prl-loading');

            //store parameters in global object
            edgeReturnOrderingParemeters(queryParams, clickedLink.data());

            //set paremeters for new query passed through ajax
            loadData.category = queryParams.category !== undefined ? queryParams.category : '';
            loadData.metaKey = queryParams.metaKey !== undefined ? queryParams.metaKey : '';
            loadData.order = queryParams.order !== undefined ? queryParams.order : '';
            loadData.orderby = queryParams.orderby !== undefined ? queryParams.orderby : '';
            loadData.minPrice = queryParams.minprice !== undefined ? queryParams.minprice : '';
            loadData.maxPrice = queryParams.maxprice !== undefined ? queryParams.maxprice : '';

			var nonceHolder = thisProductList.find('input[name*="edgtf_product_load_more_nonce_"]');

			loadData.product_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
			loadData.product_load_more_nonce = nonceHolder.val();

            loader.fadeIn();

            var ajaxData = edge.modules.common.setLoadMoreAjaxData(loadData, 'adorn_edge_product_ajax_load_category');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: EdgeAjaxUrl,
                success: function (data) {
                    var response = $.parseJSON(data),
                        responseHtml =  response.html;

					thisProductList.waitForImages(function(){
                        clickedLink.parent().siblings().find('a').removeClass('active');
                        clickedLink.addClass('active');
                        if(thisProductList.hasClass('edge-masonry-layout')) {
                            edgeReplaceMasonryContent(thisProductListInner, loader, responseHtml);
                        }else{
                            edgeReplaceStandardContent(thisProductListInner, loader, responseHtml);
                        }
                        edgeAddingToCart();
                        edgeAddingToWishlist();
					});

                }
            });
        }

        var initMobileFilterClick = function(cliked, holder){
            cliked.on('click',function(){
                if(edge.windowWidth <= 768) {
                    if(!cliked.hasClass('opened')){
                        cliked.addClass('opened');
                        holder.slideDown();
                    }else{
                        cliked.removeClass('opened');
                        holder.slideUp();
                    }
                }
            });
        }
		
        return {
            init: function () {
                if (productList.length) {
                    productList.each(function () {
                        var thisProductList = $(this);
                        initFilterClick(thisProductList);

                        initMobileFilterClick(thisProductList.find('.edge-pl-ordering-outer h6'), thisProductList.find('.edge-pl-ordering'));
                        initMobileFilterClick(thisProductList.find('.edge-pl-categories-label'),thisProductList.find('.edge-pl-categories-label').next('ul'));
                    });
                }
            },

        }
	}

    function edgeWishlistRefresh() {

        var initRefreshWishlist = function(){
			var nonceHolder = $('.edge-wishlist-widget-holder').find('input[name*="edgtf_product_wishlist_nonce_"]');

			var data = {
				action: 'adorn_edge_action_product_ajax_wishlist',
				product_wishlist_id: nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length),
				product_wishlist_nonce: nonceHolder.val()
			};

            $.ajax({
                url: EdgeAjaxUrl,
                type: "POST",
				data: data,
                success:function(data) {
                    $('.edge-wishlist-widget-holder .edge-wishlist-items-number span').html(data['wishlist_count_products']);
                }
            });
        }

        return {
            init: function () {
                //trigger defined in jquery.yith-wcwl.js, after product is added to wishlist
                $('body').on('added_to_wishlist',function(){
                    initRefreshWishlist();
                });

                //after product is removed from wishlist list
                $('#yith-wcwl-form').on('click', '.product-remove a, .product-add-to-cart a', function() {
                    setTimeout(function() {
                        initRefreshWishlist();
                    }, 2000);
                });
            }

        }

    }

    function edgeQuickViewGallery() {

        var initGallery = function(){
            var sliders = $('.edge-quick-view-gallery.edge-owl-slider');

            if (sliders.length) {
                sliders.each(function(){
                    var slider = $(this);
                    slider.owlCarousel({
                        items: 1,
                        loop: true,
                        autoplay: false,
                        smartSpeed: 600,
                        margin: 0,
                        center: false,
                        autoWidth: false,
                        animateIn : false,
                        animateOut : false,
                        dots: false,
                        nav: true,
                        navText: [
                            '<span class="edge-prev-icon"><span class="edge-icon-linear-icon lnr lnr-arrow-left"></span></span>',
                            '<span class="edge-next-icon"><span class="edge-icon-linear-icon lnr lnr-arrow-right"></span></span>'
                        ],
                        onInitialize: function () {
                            slider.css('visibility', 'visible');
                        }
                    });
                });
            }
        }

        return {
            init: function () {
                //trigger defined in yith-woocommerce-quick-view\assets\js\frontend.js, after quick view is returned
                $(document).on('qv_loader_stop',function(){
                    initGallery();

                    $('.yith-wcqv-wrapper').css('top', edge.scroll+20); //positioning popup on screens smaller than ipad portrait
                });
            }
        }
    }

    function edgeQuickViewSelect2() {
        $(document).on('qv_loader_stop',function(){
            $('#yith-quick-view-modal select').select2();
        });
    }

    function edgeAddingToCart() {
        var addToCartButtons = $('.add_to_cart_button, .single_add_to_cart_button');

        if (addToCartButtons.length) {
            addToCartButtons.on('click', function(){
                $(this).text(edgeGlobalVars.vars.edgeAddingToCartLabel);
            });
        }
    }

    function edgeAddingToWishlist() {
        var wishlistButtons = $('.add_to_wishlist');

        if (wishlistButtons.length) {
            wishlistButtons.on('click', function(){
                var wishlistButton = $(this),
                    wishlistItem,
                    wishlistItemOffset,
                    heightAdj,
                    widthAdj;

                //absolute centering over added item
                if (wishlistButton.closest('.edge-pli').length) {
                    wishlistItem = wishlistButton.closest('.edge-pli');            // product list shortcode
                } else if (wishlistButton.closest('.edge-plc-item').length) {  
                    wishlistItem = wishlistButton.closest('.edge-plc-item');       // product carousel shortcode
                } else if (wishlistButton.closest('.product').length) {
                    wishlistItem = wishlistButton.closest('.product');              // WooCommerce template
                }

                wishlistItemOffset = wishlistItem.find('img').offset();
                heightAdj = wishlistItem.find('img').height()/2;
                widthAdj = wishlistItem.find('img').width()/2;

                $('#yith-wcwl-popup-message').css({
                    'top': wishlistItemOffset.top + heightAdj,
                    'left': wishlistItemOffset.left + widthAdj,
                });

                wishlistButton.addClass('edge-adding-to-wishlist');

                $(document).on('added_to_wishlist', function(){
                    wishlistButton.removeClass('edge-adding-to-wishlist');

                    setTimeout(function(){
                        var wishlistMsg = $('#yith-wcwl-popup-message');

                        wishlistMsg.stop().addClass('edge-wishlist-vanish-out');
                        wishlistMsg.one('webkitAnimationEnd oanimationend msAnimationEnd animationend' ,function(){
                            wishlistMsg.removeClass('edge-wishlist-vanish-out');
                        });
                    }, 1000);
                });
            });
        }
    }

    function edgeInitSingleProductLightbox() {
        var item = $('.edge-woo-single-page.edge-woo-single-has-pretty-photo .images .woocommerce-product-gallery__image');

        if(item.length) {
            item.children('a').attr('data-rel', 'prettyPhoto[woo_single_pretty_photo]');

            if (typeof edge.modules.common.edgePrettyPhoto === "function") {
                edge.modules.common.edgePrettyPhoto();
            }
        }
    }

})(jQuery);