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