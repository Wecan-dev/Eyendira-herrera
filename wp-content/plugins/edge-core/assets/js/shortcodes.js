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