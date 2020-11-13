(function($) {
	"use strict";

    var blog = {};
    edge.modules.blog = blog;

    blog.edgeOnDocumentReady = edgeOnDocumentReady;
    blog.edgeOnWindowLoad = edgeOnWindowLoad;
    blog.edgeOnWindowResize = edgeOnWindowResize;
    blog.edgeOnWindowScroll = edgeOnWindowScroll;

    $(document).ready(edgeOnDocumentReady);
    $(window).load(edgeOnWindowLoad);
    $(window).resize(edgeOnWindowResize);
    $(window).scroll(edgeOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgeOnDocumentReady() {
        edgeInitAudioPlayer();
        edgeInitBlogMasonryGallery();
        edgeInitBlogMasonry();
        edgeInitBlogListMasonry();
	    edgeInitBlogSlider();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgeOnWindowLoad() {
	    edgeInitBlogPagination().init();
	    edgeInitBlogListShortcodePagination().init();
        edgeInitBlogMasonryGalleryAppear();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgeOnWindowResize() {
        edgeInitBlogMasonry();
	    edgeInitBlogMasonryGallery();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgeOnWindowScroll() {
	    edgeInitBlogPagination().scroll();
	    edgeInitBlogListShortcodePagination().scroll();
    }

    /**
    * Init audio player for Blog list and single pages
    */
    function edgeInitAudioPlayer() {
        var players = $('audio.edge-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }

    /**
     * Init Resize Blog Items
     */
    function edgeResizeBlogItems(size,container){

        if(container.hasClass('edge-masonry-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.edge-post-size-default'),
                largeWidthMasonryItem = container.find('.edge-post-size-large-width'),
                largeHeightMasonryItem = container.find('.edge-post-size-large-height'),
                largeWidthHeightMasonryItem = container.find('.edge-post-size-large-width-height');

			if (edge.windowWidth > 680) {
				defaultMasonryItem.css('height', size - 2 * padding);
				largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
				largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
				largeWidthMasonryItem.css('height', size - 2 * padding);
			} else {
				defaultMasonryItem.css('height', size);
				largeHeightMasonryItem.css('height', size);
				largeWidthHeightMasonryItem.css('height', size);
				largeWidthMasonryItem.css('height', Math.round(size / 2));
			}
        }
    }

    /**
    * Init Blog Masonry Layout
    */
    function edgeInitBlogMasonry() {
	    var holder = $('.edge-blog-holder.edge-blog-type-masonry');
	
	    if(holder.length){
		    holder.each(function(){
			    var thisHolder = $(this),
				    masonry = thisHolder.children('.edge-blog-holder-inner'),
                    size = thisHolder.find('.edge-blog-masonry-grid-sizer').width();
			    
                edgeResizeBlogItems(size, thisHolder);
                
			    masonry.waitForImages(function() {
				    masonry.isotope({
					    layoutMode: 'packery',
					    itemSelector: 'article',
					    percentPosition: true,
					    packery: {
						    gutter: '.edge-blog-masonry-grid-gutter',
						    columnWidth: '.edge-blog-masonry-grid-sizer'
					    }
				    });
                    masonry.css('opacity', '1');
                });
		    });
	    }
    }

    /**
     *  Init Blog Chequered
     */
    function edgeInitBlogChequered(){
        var container = $('.edge-blog-holder.edge-blog-chequered');
        var masonry = container.children('.edge-blog-holder-inner');
        var newSize;

        if(container.length) {
            newSize = masonry.find('.edge-blog-masonry-grid-sizer').outerWidth();
            masonry.children('article').css({'height': (newSize) + 'px'});
            masonry.isotope( 'layout', function(){
                masonry.css('opacity', '1');
            });
        }
    }


    /**
     *  Init Blog Masonry Gallery
     *
     *  Function that sets equal height of articles on blog masonry gallery list
     */
    function edgeInitBlogMasonryGallery() {
        var blogList = $('.edge-blog-holder.edge-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){

                var container = $(this),
                    masonry = container.children('.edge-blog-holder-inner'),
                    article = masonry.find('article'),
                    size = masonry.find('.edge-blog-masonry-grid-sizer').width() * 1.25;

                article.css({'height': (size) + 'px'});

                masonry.isotope( 'layout', function(){});
                edgeInitBlogMasonryGalleryAppear();
            });
        }
    }
	
	/**
	 *  Init Blog Slider shortcode
	 */
	function edgeInitBlogSlider() {
		var blogSlider = $('.edge-blog-slider-holder .edge-blog-slider');
		
		if(blogSlider.length) {
			blogSlider.each(function(){
				var thisSlider = $(this);
				
				thisSlider.owlCarousel({
					responsive : {
						0: {
							loop: true,
							items: 1,
							center: false,
							margin: 0,
							dots: true,
							nav: false
						},
						1025: {
							loop: true,
							items: 2,
							startPosition: 1,
							center: true,
							margin: 15,
							dots: true,
							nav: true,
							navText: [
								'<span class="edge-prev-icon"><span class="arrow arrow_left"></span></span>',
								'<span class="edge-next-icon"><span class="arrow arrow_right"></span></span>'
							]
						}
					}
				});
			});
		}
	}

    /**
     *  Animate blog masonry gallery type
     */
    function edgeInitBlogMasonryGalleryAppear() {
        var blogList = $('.edge-blog-holder.edge-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.edge-blog-pagination-holder'),
                    animateCycle = 7, // rewind delay
                    animateCycleCounter = 0;

                article.each(function(){
                    var thisArticle = $(this);
                    setTimeout(function(){
                        thisArticle.appear(function(){
                            animateCycleCounter ++;
                            if(animateCycleCounter == animateCycle) {
                                animateCycleCounter = 0;
                            }
                            setTimeout(function(){
                                thisArticle.addClass('edge-appeared');
                            },animateCycleCounter * 200);
                        },{accX: 0, accY: 0});
                    },150);
                });

                pagination.appear(function(){
                    pagination.addClass('edge-appeared');
                },{accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});

            });
        }
    }

    /**
     *  Animate blog narrow articles on appear
     */
    function edgeInitBlogNarrowAppear() {
        var blogList = $('.edge-blog-holder.edge-blog-narrow');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.edge-blog-pagination-holder');

                article.each(function(){
                    var thisArticle = $(this);
                    thisArticle.appear(function(){
                        thisArticle.addClass('edge-appeared');
                    },{accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});
                });

                pagination.appear(function(){
                    pagination.addClass('edge-appeared');
                },{accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});

            });
        }
    }

	
	/**
	 * Initializes blog pagination functions
	 */
	function edgeInitBlogPagination(){
		var holder = $('.edge-blog-holder');
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.edge-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - edgeGlobalVars.vars.edgeAddForAdminBar;
			
			if(!thisHolder.hasClass('edge-blog-pagination-infinite-scroll-started') && edge.scroll + edge.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder) {
			var thisHolderInner = thisHolder.children('.edge-blog-holder-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('edge-blog-pagination-infinite-scroll')) {
				thisHolder.addClass('edge-blog-pagination-infinite-scroll-started');
			}
			
			var loadMoreDatta = edge.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.edge-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;

			var nonceHolder = thisHolder.find('input[name*="edgtf_blog_load_more_nonce_"]');

			loadMoreDatta.blog_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
			loadMoreDatta.blog_load_more_nonce = nonceHolder.val();
			
			if(nextPage <= maxNumPages){
				loadingItem.addClass('edge-showing');
				
				var ajaxData = edge.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'adorn_edge_blog_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: EdgeAjaxUrl,
					success: function (data) {
						nextPage++;
						
						thisHolder.data('next-page', nextPage);

						var response = $.parseJSON(data),
							responseHtml =  response.html;

						thisHolder.waitForImages(function(){
							if(thisHolder.hasClass('edge-blog-type-masonry')){
								edgeInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
                                edgeResizeBlogItems(thisHolderInner.find('.edge-blog-masonry-grid-sizer').width(), thisHolder);
							} else {
								edgeInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
							}
							
							setTimeout(function() {
								edgeInitAudioPlayer();
								edge.modules.common.edgeOwlSlider();
								edge.modules.common.edgeFluidVideo();
                                edgeInitBlogNarrowAppear();
                                edgeInitBlogMasonryGalleryAppear();
                                edgeInitBlogChequered();
							}, 400);
						});
						
						if(thisHolder.hasClass('edge-blog-pagination-infinite-scroll-started')) {
							thisHolder.removeClass('edge-blog-pagination-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.edge-blog-pag-load-more').hide();
			}
		};
		
		var edgeInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edge-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 400);
		};
		
		var edgeInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edge-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('edge-blog-pagination-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('edge-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('edge-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}
	
	/**
	 * Init blog list shortcode masonry layout
	 */
	function edgeInitBlogListMasonry() {
		var holder = $('.edge-blog-list-holder.edge-bl-masonry');

		if(holder.length){
			holder.each(function(){
				var thisHolder = $(this),
					masonry = thisHolder.find('.edge-blog-list');
				
				masonry.waitForImages(function() {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.edge-bl-item',
						percentPosition: true,
						packery: {
							gutter: '.edge-bl-grid-gutter',
							columnWidth: '.edge-bl-grid-sizer'
						}
					});
					
					masonry.css('opacity', '1');
				});
			});
		}
	}
	
	/**
	 * Init blog list shortcode pagination functions
	 */
	function edgeInitBlogListShortcodePagination(){
		var holder = $('.edge-blog-list-holder');
		
		var initStandardPagination = function(thisHolder) {
			var standardLink = thisHolder.find('.edge-bl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisHolder, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.edge-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - edgeGlobalVars.vars.edgeAddForAdminBar;
			
			if(!thisHolder.hasClass('edge-bl-pag-infinite-scroll-started') && edge.scroll + edge.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder, pagedLink) {
			var thisHolderInner = thisHolder.find('.edge-blog-list'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('edge-bl-pag-standard-blog-list')) {
				thisHolder.data('next-page', pagedLink);
			}
			
			if(thisHolder.hasClass('edge-bl-pag-infinite-scroll')) {
				thisHolder.addClass('edge-bl-pag-infinite-scroll-started');
			}
			
			var loadMoreDatta = edge.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.edge-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;

			var nonceHolder = thisHolder.find('input[name*="edgtf_blog_load_more_nonce_"]');

			loadMoreDatta.blog_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
			loadMoreDatta.blog_load_more_nonce = nonceHolder.val();
			
			if(nextPage <= maxNumPages){
				if(thisHolder.hasClass('edge-bl-pag-standard-blog-list')) {
					loadingItem.addClass('edge-showing edge-standard-pag-trigger');
					thisHolder.addClass('edge-bl-pag-standard-blog-list-animate');
				} else {
					loadingItem.addClass('edge-showing');
				}
				
				var ajaxData = edge.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'adorn_edge_blog_shortcode_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: EdgeAjaxUrl,
					success: function (data) {
						if(!thisHolder.hasClass('edge-bl-pag-standard-blog-list')) {
							nextPage++;
						}
						
						thisHolder.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisHolder.hasClass('edge-bl-pag-standard-blog-list')) {
							edgeInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage);
							
							thisHolder.waitForImages(function(){
								if(thisHolder.hasClass('edge-bl-masonry')){
									edgeInitHtmlIsotopeNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
								} else {
									edgeInitHtmlGalleryNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisHolder.waitForImages(function(){
								if(thisHolder.hasClass('edge-bl-masonry')){
									edgeInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
								} else {
									edgeInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
								}
							});
						}
						
						if(thisHolder.hasClass('edge-bl-pag-infinite-scroll-started')) {
							thisHolder.removeClass('edge-bl-pag-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.edge-blog-pag-load-more').hide();
			}
		};
		
		var edgeInitStandardPaginationLinkChanges = function(thisHolder, maxNumPages, nextPage) {
			var standardPagHolder = thisHolder.find('.edge-bl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.edge-bl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.edge-bl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.edge-bl-pag-next a');
			
			standardPagNumericItem.removeClass('edge-bl-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('edge-bl-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var edgeInitHtmlIsotopeNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.html(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edge-showing edge-standard-pag-trigger');
			thisHolder.removeClass('edge-bl-pag-standard-blog-list-animate');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 400);
		};
		
		var edgeInitHtmlGalleryNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edge-showing edge-standard-pag-trigger');
			thisHolder.removeClass('edge-bl-pag-standard-blog-list-animate');
			thisHolderInner.html(responseHtml);
		};
		
		var edgeInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edge-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 400);
		};
		
		var edgeInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edge-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('edge-bl-pag-standard-blog-list')) {
							initStandardPagination(thisHolder);
						}
						
						if(thisHolder.hasClass('edge-bl-pag-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('edge-bl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('edge-bl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}

})(jQuery);