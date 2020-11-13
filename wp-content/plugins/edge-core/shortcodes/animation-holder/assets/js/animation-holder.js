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