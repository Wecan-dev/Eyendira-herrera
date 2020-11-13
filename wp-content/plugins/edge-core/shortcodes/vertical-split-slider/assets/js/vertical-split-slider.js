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