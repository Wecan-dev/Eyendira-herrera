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
