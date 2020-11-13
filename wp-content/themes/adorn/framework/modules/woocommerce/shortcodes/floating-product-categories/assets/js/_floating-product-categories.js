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