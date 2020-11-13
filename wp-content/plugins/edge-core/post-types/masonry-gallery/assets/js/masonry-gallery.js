(function($) {
    'use strict';

    $(document).ready(function(){
	    edgeInitMasonryGallery();
    });
	
	/**
	 * Masonry gallery, init masonry and resize pictures in grid
	 */
	function edgeInitMasonryGallery(){
		var galleryHolder = $('.edge-masonry-gallery-holder'),
			gallery = galleryHolder.children('.edge-mg-inner'),
			gallerySizer = gallery.children('.edge-mg-grid-sizer');
		
		resizeMasonryGallery(gallerySizer.outerWidth(), gallery);
		
		if(galleryHolder.length){
			galleryHolder.each(function(){
				var holder = $(this),
					holderGallery = holder.children('.edge-mg-inner');
				
				holderGallery.waitForImages(function(){
					holderGallery.animate({opacity:1});
					
					holderGallery.isotope({
						layoutMode: 'packery',
						itemSelector: '.edge-mg-item',
						percentPosition: true,
						packery: {
							gutter: '.edge-mg-grid-gutter',
							columnWidth: '.edge-mg-grid-sizer'
						}
					});
				});
			});
			
			$(window).resize(function(){
				resizeMasonryGallery(gallerySizer.outerWidth(), gallery);
				
				gallery.isotope('reloadItems');
			});
		}
	}
	
	function resizeMasonryGallery(size, holder){
		var rectangle_portrait = holder.find('.edge-mg-rectangle-portrait'),
			rectangle_landscape = holder.find('.edge-mg-rectangle-landscape'),
			square_big = holder.find('.edge-mg-square-big'),
			square_small = holder.find('.edge-mg-square-small');
		
		rectangle_portrait.css('height', 2*size);
		
		if (window.innerWidth <= 680) {
			rectangle_landscape.css('height', size/2);
		} else {
			rectangle_landscape.css('height', size);
		}
		
		square_big.css('height', 2*size);
		
		if (window.innerWidth <= 680) {
			square_big.css('height', square_big.width());
		}
		
		square_small.css('height', size);
	}

})(jQuery);