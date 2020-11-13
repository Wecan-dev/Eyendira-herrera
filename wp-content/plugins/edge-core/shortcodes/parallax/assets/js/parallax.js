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