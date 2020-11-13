(function($) {
    'use strict';

    var woocommerce = {};
    edge.modules.woocommerce = woocommerce;

    woocommerce.edgeOnDocumentReady = edgeOnDocumentReady;
    woocommerce.edgeOnWindowLoad = edgeOnWindowLoad;
    woocommerce.edgeOnWindowResize = edgeOnWindowResize;
    woocommerce.edgeOnWindowScroll = edgeOnWindowScroll;

    $(document).ready(edgeOnDocumentReady);
    $(window).load(edgeOnWindowLoad);
    $(window).resize(edgeOnWindowResize);
    $(window).scroll(edgeOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgeOnDocumentReady() {
        edgeInitQuantityButtons();
        edgeInitSelect2();
        edgeInitSingleProductLightbox();
        edgeInitProductListFilter().init();
        edgeWishlistRefresh().init();
        edgeQuickViewGallery().init();
        edgeQuickViewSelect2();
        edgeAddingToCart();
        edgeAddingToWishlist();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgeOnWindowLoad() {
        edgeInitProductListMasonryShortcode();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgeOnWindowResize() {
        edgeInitProductListMasonryShortcode();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgeOnWindowScroll() {}
    
    /*
    ** Init quantity buttons to increase/decrease products for cart
    */
    function edgeInitQuantityButtons() {
    
        $(document).on( 'click', '.edge-quantity-minus, .edge-quantity-plus', function(e) {
            e.stopPropagation();

            var button = $(this),
                inputField = button.siblings('.edge-quantity-input'),
                step = parseFloat(inputField.attr('step')),
                max = parseFloat(inputField.attr('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('edge-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(0);
                }
            } else {
                newInputValue = inputValue + step;
                if ( max === undefined ) {
                    inputField.val(newInputValue);
                } else {
                    if ( newInputValue >= max ) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }

            inputField.trigger( 'change' );
        });
    }

    /*
    ** Init select2 script for select html dropdowns
    */
    function edgeInitSelect2() {

        if ($('.woocommerce-ordering .orderby').length) {
            $('.woocommerce-ordering .orderby').select2({
                minimumResultsForSearch: Infinity
            });
        }

        if($('#calc_shipping_country').length) {
            $('#calc_shipping_country').select2();
        }

        $(edge.body).on('updated_shipping_method',function(){
            $('#calc_shipping_country').select2();
        });

        if($('.cart-collaterals .shipping select#calc_shipping_state').length) {
            $('.cart-collaterals .shipping select#calc_shipping_state').select2();
        }

        if($('.edge-woo-single-page .variations select').length) {
            $('.edge-woo-single-page .variations select').select2();
        }
    }

    /*
     ** Init Product List Masonry Image Sizes
     */
    function edgeProductImageSizes(thisContainer) {

        var size = thisContainer.find('.edge-pl-sizer').width();

        var defaultMasonryItem = thisContainer.find('.edge-woo-image-normal-width');
        var largeWidthMasonryItem = thisContainer.find('.edge-woo-image-large-width');
        var largeHeightMasonryItem = thisContainer.find('.edge-woo-image-large-height');
        var largeWidthHeightMasonryItem = thisContainer.find('.edge-woo-image-large-width-height');

        if(thisContainer.find('.edge-landscape-size').length){
            size = size * 0.8;
        }
        defaultMasonryItem.css('height', size);

        if (edge.windowWidth > 600) {
            largeWidthHeightMasonryItem.css('height', Math.round(2 * size));
            largeHeightMasonryItem.css('height', Math.round(2 * size));
            largeWidthMasonryItem.css('height', size);
        } else {
            largeWidthHeightMasonryItem.css('height', size);
            largeHeightMasonryItem.css('height', size);
        }
    }

	/*
	 ** Init Product List Masonry Shortcode Layout
	 */
	function edgeInitProductListMasonryShortcode() {
		var container = $('.edge-pl-holder.edge-masonry-layout .edge-pl-outer');

		if(container.length) {
			container.each(function(){
				var thisContainer = $(this);

                edgeProductImageSizes(thisContainer);
				thisContainer.waitForImages(function() {
					thisContainer.isotope({
						itemSelector: '.edge-pli',
						resizable: false,
                        layoutMode: 'packery',
						masonry: {
							columnWidth: '.edge-pl-sizer',
							gutter: '.edge-pl-gutter'
						}
					});
					
					thisContainer.isotope('layout');
					
					thisContainer.css('opacity', 1);
				});
			});
		}
	}

	function edgeInitProductListFilter(){
		var productList = $('.edge-pl-holder');
		var queryParams = {};

        var initFilterClick = function(thisProductList){
            var links = thisProductList.find('.edge-pl-categories a, .edge-pl-ordering a');

            links.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                var clickedLink = $(this);
                if(!clickedLink.hasClass('active')) {
                    initMainPagFunctionality(thisProductList, clickedLink);
                }
            });
		}

		//used for replacing content after ajax call
        var edgeReplaceStandardContent = function(thisProductListInner, loader, responseHtml) {
            thisProductListInner.html(responseHtml);
            loader.fadeOut();
        };

        //used for replacing content after ajax call
        var edgeReplaceMasonryContent = function(thisProductListInner, loader, responseHtml) {
            thisProductListInner.find('.edge-pli').remove();

            thisProductListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            edgeProductImageSizes(thisProductListInner);
            setTimeout(function() {
                thisProductListInner.isotope('layout');
                loader.fadeOut();
            }, 400);
        };

        //used for storing parameters in global object
        var edgeReturnOrderingParemeters = function(queryParams, data){

            for (var key in data) {
                queryParams[key] = data[key];
            }

            //store ordering parameters
            switch(queryParams.ordering) {
                case 'menu_order':
                    queryParams.metaKey = '';
                    queryParams.order = 'asc';
                    queryParams.orderby = 'menu_order title';
                    break;
                case 'popularity':
                    queryParams.metaKey = 'total_sales';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'rating':
                    queryParams.metaKey = '_wc_average_rating';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'newness':
                    queryParams.metaKey = '';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'date';
                    break;
                case 'price':
                    queryParams.metaKey = '_price';
                    queryParams.order = 'asc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'price-desc':
                    queryParams.metaKey = '_price';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
            }

            return queryParams;
        }

		var initMainPagFunctionality = function(thisProductList, clickedLink){
            var thisProductListInner = thisProductList.find('.edge-pl-outer');

            var loadData = edge.modules.common.getLoadMoreData(thisProductList),
				loader = thisProductList.find('.edge-prl-loading');

            //store parameters in global object
            edgeReturnOrderingParemeters(queryParams, clickedLink.data());

            //set paremeters for new query passed through ajax
            loadData.category = queryParams.category !== undefined ? queryParams.category : '';
            loadData.metaKey = queryParams.metaKey !== undefined ? queryParams.metaKey : '';
            loadData.order = queryParams.order !== undefined ? queryParams.order : '';
            loadData.orderby = queryParams.orderby !== undefined ? queryParams.orderby : '';
            loadData.minPrice = queryParams.minprice !== undefined ? queryParams.minprice : '';
            loadData.maxPrice = queryParams.maxprice !== undefined ? queryParams.maxprice : '';

			var nonceHolder = thisProductList.find('input[name*="edgtf_product_load_more_nonce_"]');

			loadData.product_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
			loadData.product_load_more_nonce = nonceHolder.val();

            loader.fadeIn();

            var ajaxData = edge.modules.common.setLoadMoreAjaxData(loadData, 'adorn_edge_product_ajax_load_category');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: EdgeAjaxUrl,
                success: function (data) {
                    var response = $.parseJSON(data),
                        responseHtml =  response.html;

					thisProductList.waitForImages(function(){
                        clickedLink.parent().siblings().find('a').removeClass('active');
                        clickedLink.addClass('active');
                        if(thisProductList.hasClass('edge-masonry-layout')) {
                            edgeReplaceMasonryContent(thisProductListInner, loader, responseHtml);
                        }else{
                            edgeReplaceStandardContent(thisProductListInner, loader, responseHtml);
                        }
                        edgeAddingToCart();
                        edgeAddingToWishlist();
					});

                }
            });
        }

        var initMobileFilterClick = function(cliked, holder){
            cliked.on('click',function(){
                if(edge.windowWidth <= 768) {
                    if(!cliked.hasClass('opened')){
                        cliked.addClass('opened');
                        holder.slideDown();
                    }else{
                        cliked.removeClass('opened');
                        holder.slideUp();
                    }
                }
            });
        }
		
        return {
            init: function () {
                if (productList.length) {
                    productList.each(function () {
                        var thisProductList = $(this);
                        initFilterClick(thisProductList);

                        initMobileFilterClick(thisProductList.find('.edge-pl-ordering-outer h6'), thisProductList.find('.edge-pl-ordering'));
                        initMobileFilterClick(thisProductList.find('.edge-pl-categories-label'),thisProductList.find('.edge-pl-categories-label').next('ul'));
                    });
                }
            },

        }
	}

    function edgeWishlistRefresh() {

        var initRefreshWishlist = function(){
			var nonceHolder = $('.edge-wishlist-widget-holder').find('input[name*="edgtf_product_wishlist_nonce_"]');

			var data = {
				action: 'adorn_edge_action_product_ajax_wishlist',
				product_wishlist_id: nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length),
				product_wishlist_nonce: nonceHolder.val()
			};

            $.ajax({
                url: EdgeAjaxUrl,
                type: "POST",
				data: data,
                success:function(data) {
                    $('.edge-wishlist-widget-holder .edge-wishlist-items-number span').html(data['wishlist_count_products']);
                }
            });
        }

        return {
            init: function () {
                //trigger defined in jquery.yith-wcwl.js, after product is added to wishlist
                $('body').on('added_to_wishlist',function(){
                    initRefreshWishlist();
                });

                //after product is removed from wishlist list
                $('#yith-wcwl-form').on('click', '.product-remove a, .product-add-to-cart a', function() {
                    setTimeout(function() {
                        initRefreshWishlist();
                    }, 2000);
                });
            }

        }

    }

    function edgeQuickViewGallery() {

        var initGallery = function(){
            var sliders = $('.edge-quick-view-gallery.edge-owl-slider');

            if (sliders.length) {
                sliders.each(function(){
                    var slider = $(this);
                    slider.owlCarousel({
                        items: 1,
                        loop: true,
                        autoplay: false,
                        smartSpeed: 600,
                        margin: 0,
                        center: false,
                        autoWidth: false,
                        animateIn : false,
                        animateOut : false,
                        dots: false,
                        nav: true,
                        navText: [
                            '<span class="edge-prev-icon"><span class="edge-icon-linear-icon lnr lnr-arrow-left"></span></span>',
                            '<span class="edge-next-icon"><span class="edge-icon-linear-icon lnr lnr-arrow-right"></span></span>'
                        ],
                        onInitialize: function () {
                            slider.css('visibility', 'visible');
                        }
                    });
                });
            }
        }

        return {
            init: function () {
                //trigger defined in yith-woocommerce-quick-view\assets\js\frontend.js, after quick view is returned
                $(document).on('qv_loader_stop',function(){
                    initGallery();

                    $('.yith-wcqv-wrapper').css('top', edge.scroll+20); //positioning popup on screens smaller than ipad portrait
                });
            }
        }
    }

    function edgeQuickViewSelect2() {
        $(document).on('qv_loader_stop',function(){
            $('#yith-quick-view-modal select').select2();
        });
    }

    function edgeAddingToCart() {
        var addToCartButtons = $('.add_to_cart_button, .single_add_to_cart_button');

        if (addToCartButtons.length) {
            addToCartButtons.on('click', function(){
                $(this).text(edgeGlobalVars.vars.edgeAddingToCartLabel);
            });
        }
    }

    function edgeAddingToWishlist() {
        var wishlistButtons = $('.add_to_wishlist');

        if (wishlistButtons.length) {
            wishlistButtons.on('click', function(){
                var wishlistButton = $(this),
                    wishlistItem,
                    wishlistItemOffset,
                    heightAdj,
                    widthAdj;

                //absolute centering over added item
                if (wishlistButton.closest('.edge-pli').length) {
                    wishlistItem = wishlistButton.closest('.edge-pli');            // product list shortcode
                } else if (wishlistButton.closest('.edge-plc-item').length) {  
                    wishlistItem = wishlistButton.closest('.edge-plc-item');       // product carousel shortcode
                } else if (wishlistButton.closest('.product').length) {
                    wishlistItem = wishlistButton.closest('.product');              // WooCommerce template
                }

                wishlistItemOffset = wishlistItem.find('img').offset();
                heightAdj = wishlistItem.find('img').height()/2;
                widthAdj = wishlistItem.find('img').width()/2;

                $('#yith-wcwl-popup-message').css({
                    'top': wishlistItemOffset.top + heightAdj,
                    'left': wishlistItemOffset.left + widthAdj,
                });

                wishlistButton.addClass('edge-adding-to-wishlist');

                $(document).on('added_to_wishlist', function(){
                    wishlistButton.removeClass('edge-adding-to-wishlist');

                    setTimeout(function(){
                        var wishlistMsg = $('#yith-wcwl-popup-message');

                        wishlistMsg.stop().addClass('edge-wishlist-vanish-out');
                        wishlistMsg.one('webkitAnimationEnd oanimationend msAnimationEnd animationend' ,function(){
                            wishlistMsg.removeClass('edge-wishlist-vanish-out');
                        });
                    }, 1000);
                });
            });
        }
    }

    function edgeInitSingleProductLightbox() {
        var item = $('.edge-woo-single-page.edge-woo-single-has-pretty-photo .images .woocommerce-product-gallery__image');

        if(item.length) {
            item.children('a').attr('data-rel', 'prettyPhoto[woo_single_pretty_photo]');

            if (typeof edge.modules.common.edgePrettyPhoto === "function") {
                edge.modules.common.edgePrettyPhoto();
            }
        }
    }

})(jQuery);