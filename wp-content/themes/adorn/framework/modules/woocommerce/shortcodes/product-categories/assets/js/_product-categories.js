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