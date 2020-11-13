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