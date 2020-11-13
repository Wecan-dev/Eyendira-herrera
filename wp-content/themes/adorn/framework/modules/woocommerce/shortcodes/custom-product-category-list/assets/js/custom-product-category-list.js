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
