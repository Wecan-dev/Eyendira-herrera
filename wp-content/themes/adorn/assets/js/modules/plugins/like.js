(function($) {
    'use strict';

    var like = {};
    
    like.edgeOnDocumentReady = edgeOnDocumentReady;

    $(document).ready(edgeOnDocumentReady);
    
    /**
    *  All functions to be called on $(document).ready() should be in this function
    **/
    function edgeOnDocumentReady() {
        edgeLikes();
    }

    function edgeLikes() {

        $(document).on('click','.edge-like', function() {
            var likeLink = $(this),
                id = likeLink.attr('id'),
				postID = likeLink.data('post-id'),
                type;

            if ( likeLink.hasClass('liked') ) {
                return false;
            }

            if (typeof likeLink.data('type') !== 'undefined') {
                type = likeLink.data('type');
            }

            var dataToPass = {
                action: 'adorn_edge_like',
                likes_id: id,
                type: type,
				like_nonce: $('#edgtf_like_nonce_'+postID).val()
            };

            var like = $.post(edgeLike.ajaxurl, dataToPass, function( data ) {
                likeLink.html(data).addClass('liked').attr('title', 'You already like this!');
	
	            if(type !== 'portfolio_list') {
		            likeLink.children('span').css('opacity', 1);
	            }
            });

            return false;
        });
    }
    
})(jQuery);