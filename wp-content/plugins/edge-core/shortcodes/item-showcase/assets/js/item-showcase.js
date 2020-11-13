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