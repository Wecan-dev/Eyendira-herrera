<?php
if(!function_exists('adorn_edge_design_styles')) {
    /**
     * Generates general custom styles
     */
    function adorn_edge_design_styles() {
	    $font_family = adorn_edge_options()->getOptionValue('google_fonts');
	    if (!empty($font_family) && adorn_edge_is_font_option_valid($font_family)){
		    echo adorn_edge_dynamic_css('body', array('font-family' => adorn_edge_get_font_option_val($font_family)));
		}

		$first_main_color = adorn_edge_options()->getOptionValue('first_color');
        if(!empty($first_main_color)) {
            $color_selector = array(

	            'a',
	            'a:hover',
	            'h1',
	            'h1 a:hover',
	            'h2',
	            'h2 a:hover',
	            'h3',
	            'h3 a:hover',
	            'h4',
	            'h4 a:hover',
	            'h5',
	            'h5 a:hover',
	            'h6',
	            'h6 a:hover',
	            'p a',
	            'p a:hover',
	            'h1 a',
	            'h2 a',
	            'h3 a',
	            'h4 a',
	            'h5 a',
	            'h6 a',
	            'mark',
	            '.edge-comment-holder .edge-comment-text .comment-edit-link:hover',
	            '.edge-comment-holder .edge-comment-text .comment-reply-link:hover',
	            '.edge-comment-holder .edge-comment-text .replay:hover',
	            '.edge-comment-holder .edge-comment-text #cancel-comment-reply-link',
	            '.edge-comment-holder .edge-comment-text #cancel-comment-reply-link:hover',
	            '#respond input[type=text]',
	            '#respond input[type=email]',
	            '#respond textarea',
	            '.post-password-form input[type=password]',
	            '#respond input[type=text]:focus',
	            '#respond input[type=email]:focus',
	            '#respond textarea:focus',
	            '.post-password-form input[type=password]:focus',
	            'div.edge-newsletter-form label',
	            'div.edge-newsletter-popup label',
	            '.wpcf7-form-control.wpcf7-date:focus',
	            '.wpcf7-form-control.wpcf7-number:focus',
	            '.wpcf7-form-control.wpcf7-quiz:focus',
	            '.wpcf7-form-control.wpcf7-select:focus',
	            '.wpcf7-form-control.wpcf7-text:focus',
	            '.wpcf7-form-control.wpcf7-textarea:focus',
	            '.edge-owl-slider .owl-nav .edge-next-icon',
	            '.edge-owl-slider .owl-nav .edge-prev-icon',
	            '.edge-404-page .edge-page-not-found .edge-icon-shortcode',
	            '.edge-main-menu>ul>li.edge-active-item>a',
	            '.edge-main-menu>ul>li>a:hover',
	            '.edge-main-menu>ul>li>a',
	            '.edge-drop-down .second .inner ul li a:hover',
	            '.edge-drop-down .second .inner ul li.current-menu-ancestor>a',
	            '.edge-drop-down .second .inner ul li.current-menu-item>a',
	            '.edge-vertical-menu .second .inner ul li a:hover',
	            '.edge-vertical-menu .second .inner ul li.current-menu-ancestor>a',
	            '.edge-vertical-menu .second .inner ul li.current-menu-item>a',
	            '.edge-drop-down .wide .second .inner ul li a:hover',
	            '.edge-drop-down .wide .second .inner>ul>li>a',
	            '.edge-drop-down .wide .second .inner>ul>li>a:hover',
	            '.edge-drop-down .wide .second .inner>ul>li.current-menu-ancestor>a',
	            '.edge-drop-down .wide .second .inner>ul>li.current-menu-item>a',
	            '.edge-header-vertical-closed .edge-vertical-menu ul li a.current-menu-ancestor>a',
	            '.edge-header-vertical-closed .edge-vertical-menu ul li a.current-menu-ancestor>a .edge-menu-arrow',
	            '.edge-header-vertical-closed .edge-vertical-menu ul li a.current-menu-item>a',
	            '.edge-header-vertical-closed .edge-vertical-menu ul li a.current-menu-item>a .edge-menu-arrow',
	            '.edge-header-vertical-closed .edge-vertical-menu ul li a:hover',
	            '.edge-header-vertical-closed .edge-vertical-menu ul li a:hover .edge-menu-arrow',
	            '.edge-header-vertical-closed .edge-vertical-menu ul li a',
	            '.edge-header-vertical-closed .edge-vertical-menu ul li a .edge-menu-featured-icon',
	            '.edge-header-vertical-closed .edge-vertical-menu ul li.current-menu-ancestor>a',
	            '.edge-header-vertical-closed .edge-vertical-menu ul li.current-menu-item>a',
	            '.edge-header-vertical-closed .edge-vertical-menu ul li.current_page_item>a',
	            '.edge-header-vertical-closed .edge-vertical-menu ul li.edge-active-item>a',
	            '.edge-header-vertical .edge-vertical-menu ul li a',
	            '.edge-header-vertical .edge-vertical-menu ul li a.current-menu-ancestor>a',
	            '.edge-header-vertical .edge-vertical-menu ul li a.current-menu-item>a',
	            '.edge-header-vertical .edge-vertical-menu ul li a:hover',
	            '.edge-header-vertical .edge-vertical-menu ul li a.current-menu-ancestor>a .edge-menu-arrow',
	            '.edge-header-vertical .edge-vertical-menu ul li a.current-menu-item>a .edge-menu-arrow',
	            '.edge-header-vertical .edge-vertical-menu ul li a:hover .edge-menu-arrow',
	            '.edge-header-vertical .edge-vertical-menu ul li a .edge-menu-featured-icon',
	            '.edge-header-vertical .edge-vertical-menu ul li.current-menu-ancestor>a',
	            '.edge-header-vertical .edge-vertical-menu ul li.current-menu-item>a',
	            '.edge-header-vertical .edge-vertical-menu ul li.current_page_item>a',
	            '.edge-header-vertical .edge-vertical-menu ul li.edge-active-item>a',
	            '.edge-mobile-header .edge-mobile-nav ul li.current-menu-ancestor>a',
	            '.edge-mobile-header .edge-mobile-nav ul li.current-menu-item>a',
	            '.edge-mobile-header .edge-mobile-nav li.current-menu-ancestor>.mobile_arrow',
	            '.edge-mobile-header .edge-mobile-nav li.current-menu-item .mobile_arrow',
	            '.edge-mobile-header .edge-mobile-nav ul ul li.current-menu-ancestor>a',
	            '.edge-mobile-header .edge-mobile-nav ul ul li.current-menu-item>a',
	            '.edge-page-footer .edge-light .widget div.edge-widget-title-holder .edge-widget-title',
	            '.edge-page-footer .widget ul li a:hover',
	            '.edge-page-footer .widget.widget_nav_menu ul li a:hover',
	            '.edge-page-footer .widget div.edge-widget-title-holder .edge-widget-title',
	            '.edge-title .edge-title-holder .edge-breadcrumbs a:hover',
	            '.edge-fullscreen-menu-opener.edge-fm-opened .edge-fm-lines:before',
	            'nav.edge-fullscreen-menu ul li a:hover',
	            'nav.edge-fullscreen-menu ul li ul li.current-menu-ancestor>a',
	            'nav.edge-fullscreen-menu ul li ul li.current-menu-item>a',
	            'nav.edge-fullscreen-menu>ul>li.edge-active-item>a',
	            '.edge-search-page-holder .edge-search-page-form .edge-form-holder .edge-search-submit:hover',
	            '.edge-search-page-holder article.sticky .edge-post-title-area h3 a',
	            '.edge-search-cover .edge-search-close a:hover',
	            '.edge-fullscreen-search-holder .edge-search-submit',
	            '.edge-fullscreen-search-holder .edge-search-submit:hover',
	            '.edge-fullscreen-search-holder .edge-fullscreen-search-close-container a',
	            '.edge-fullscreen-search-holder .edge-fullscreen-search-close-container a:before',
	            '.edge-fullscreen-search-opened::-webkit-input-placeholder',
	            '.edge-fullscreen-search-opened:-moz-placeholder',
	            '.edge-fullscreen-search-opened::-moz-placeholder',
	            '.edge-fullscreen-search-opened:-ms-input-placeholder',
	            '.edge-blog-holder article.sticky .edge-post-title a',
	            '.edge-blog-holder.edge-blog-masonry article .edge-post-read-more-button a i',
	            '.edge-blog-holder.edge-blog-masonry article .edge-post-read-more-button a:hover span',
	            '.edge-blog-holder.edge-blog-masonry article .edge-post-info-bottom .edge-post-info-author a:hover',
	            '.edge-blog-holder.edge-blog-masonry article .edge-post-info-bottom .edge-blog-like:hover i:first-child',
	            '.edge-blog-holder.edge-blog-masonry article .edge-post-info-bottom .edge-blog-like:hover span:first-child',
	            '.edge-blog-holder.edge-blog-masonry article .edge-post-info-bottom .edge-post-info-comments-holder:hover span:first-child',
	            '.edge-blog-holder.edge-blog-masonry article.format-link .edge-post-mark .edge-link-mark',
	            '.edge-blog-holder.edge-blog-masonry article.format-quote .edge-post-mark .edge-quote-mark',
	            '.edge-blog-holder.edge-blog-standard article .edge-post-info-bottom .edge-post-info-author a',
	            '.edge-blog-holder.edge-blog-standard article .edge-post-info-bottom .edge-post-info-author a:hover',
	            '.edge-blog-holder.edge-blog-standard article .edge-post-info-bottom .edge-blog-like:hover i:first-child',
	            '.edge-blog-holder.edge-blog-standard article .edge-post-info-bottom .edge-blog-like:hover span:first-child',
	            '.edge-blog-holder.edge-blog-standard article .edge-post-info-bottom .edge-post-info-comments-holder:hover span:first-child',
	            '.edge-blog-holder.edge-blog-standard article.format-quote .edge-post-mark .edge-quote-mark',
	            '.edge-blog-holder.edge-blog-standard article.format-quote .edge-quote-author',
	            '.edge-author-description .edge-author-description-text-holder .edge-author-name a',
	            '.edge-author-description .edge-author-description-text-holder .edge-author-name a:hover',
	            '.edge-author-description .edge-author-description-text-holder .edge-author-social-icons a:hover',
	            '.edge-blog-pagination ul li.edge-pag-number a:hover',
	            '.edge-blog-pagination ul li a.edge-pag-active',
	            '.edge-bl-standard-pagination ul li.edge-bl-pag-active a',
	            '.edge-blog-pag-loading',
	            '.edge-blog-pagination ul li.edge-pag-first a:hover',
	            '.edge-blog-pagination ul li.edge-pag-last a:hover',
	            '.edge-blog-pagination ul li.edge-pag-next a:hover',
	            '.edge-blog-pagination ul li.edge-pag-prev a:hover',
	            '.edge-blog-single-navigation a:hover .edge-blog-single-nav-label',
	            '.edge-blog-single-navigation .edge-blog-single-nav-title:hover',
	            '.edge-blog-list-holder.edge-bl-masonry .edge-post-read-more-button a i',
	            '.edge-blog-list-holder.edge-bl-masonry .edge-post-read-more-button a:hover span',
	            '.edge-blog-list-holder.edge-bl-standard .edge-bli-excerpt .edge-post-read-more-button a i',
	            '.edge-blog-slider-holder .owl-nav .owl-next:hover .edge-next-icon',
	            '.edge-blog-slider-holder .owl-nav .owl-next:hover .edge-prev-icon',
	            '.edge-blog-slider-holder .owl-nav .owl-prev:hover .edge-next-icon',
	            '.edge-blog-slider-holder .owl-nav .owl-prev:hover .edge-prev-icon',
	            '.edge-blog-slider-holder .owl-nav .edge-next-icon',
	            '.edge-blog-slider-holder .owl-nav .edge-prev-icon',
	            'letter-spaci .edge-blog-holder.edge-blog-single.edge-blog-single-standard article .edge-tags a:hover',
	            '.edge-blog-holder.edge-blog-single.edge-blog-single-standard article .edge-post-info-top>div a:hover',
	            '.edge-blog-holder.edge-blog-single.edge-blog-single-standard article .edge-post-info-bottom .edge-post-info-bottom-left>div a:hover',
	            '.edge-blog-holder.edge-blog-single.edge-blog-single-standard article.format-quote .edge-post-mark .edge-quote-mark',
	            '.edge-blog-holder.edge-blog-single.edge-blog-single-standard article.format-quote .edge-quote-author',
	            '.edge-blog-single-title-area-empty article.format-link .edge-post-mark .edge-link-mark',
	            '.edge-blog-single-title-area-empty article.format-quote .edge-post-mark .edge-quote-mark',
	            '.edge-blog-single-title-area-empty article.format-quote .edge-post-title',
	            '.edge-blog-single-title-area-info article.format-link .edge-post-mark .edge-link-mark',
	            '.edge-blog-single-title-area-info article.format-quote .edge-post-mark .edge-quote-mark',
	            '.edge-blog-single-title-area-info article.format-quote .edge-post-title',
	            'footer .widget ul li a:hover',
	            'footer .widget.widget_archive ul li a:hover',
	            'footer .widget.widget_categories ul li a:hover',
	            'footer .widget.widget_meta ul li a:hover',
	            'footer .widget.widget_nav_menu ul li a:hover',
	            'footer .widget.widget_pages ul li a:hover',
	            'footer .widget.widget_recent_entries ul li a:hover',
	            'footer .widget #wp-calendar tfoot a:hover',
	            'footer .widget.widget_search .input-holder button:hover',
	            'footer .widget.widget_tag_cloud a:hover',
	            '.edge-side-menu .widget ul li a:hover',
	            '.edge-side-menu .widget.widget_archive ul li a:hover',
	            '.edge-side-menu .widget.widget_categories ul li a:hover',
	            '.edge-side-menu .widget.widget_meta ul li a:hover',
	            '.edge-side-menu .widget.widget_nav_menu ul li a:hover',
	            '.edge-side-menu .widget.widget_pages ul li a:hover',
	            '.edge-side-menu .widget.widget_recent_entries ul li a:hover',
	            '.edge-side-menu .widget #wp-calendar tfoot a:hover',
	            '.edge-side-menu .widget.widget_search .input-holder button:hover',
	            '.edge-side-menu .widget.widget_tag_cloud a:hover',
	            'aside.edge-sidebar div.widget div.edge-widget-title-holder .edge-widget-title',
	            '.wpb_widgetised_column .widget ul li a',
	            'aside.edge-sidebar .widget ul li a',
	            '.wpb_widgetised_column .widget.widget_archive ul li a:hover',
	            '.wpb_widgetised_column .widget.widget_categories ul li a:hover',
	            '.wpb_widgetised_column .widget.widget_meta ul li a:hover',
	            '.wpb_widgetised_column .widget.widget_nav_menu ul li a:hover',
	            '.wpb_widgetised_column .widget.widget_pages ul li a:hover',
	            '.wpb_widgetised_column .widget.widget_recent_entries ul li a:hover',
	            'aside.edge-sidebar .widget.widget_archive ul li a:hover',
	            'aside.edge-sidebar .widget.widget_categories ul li a:hover',
	            'aside.edge-sidebar .widget.widget_meta ul li a:hover',
	            'aside.edge-sidebar .widget.widget_nav_menu ul li a:hover',
	            'aside.edge-sidebar .widget.widget_pages ul li a:hover',
	            'aside.edge-sidebar .widget.widget_recent_entries ul li a:hover',
	            '.wpb_widgetised_column .widget #wp-calendar tfoot a',
	            'aside.edge-sidebar .widget #wp-calendar tfoot a',
	            'aside.edge-sidebar div.widget .edge-blog-list .edge-post-title:hover a',
	            '.widget ul li a',
	            '.widget.widget_archive ul li a:hover',
	            '.widget.widget_categories ul li a:hover',
	            '.widget.widget_meta ul li a:hover',
	            '.widget.widget_nav_menu ul li a:hover',
	            '.widget.widget_pages ul li a:hover',
	            '.widget.widget_recent_entries ul li a:hover',
	            '.widget #wp-calendar tfoot a',
	            '.widget.widget_edge_twitter_widget .edge-twitter-widget.edge-twitter-slider li .edge-tweet-text a',
	            '.widget.widget_edge_twitter_widget .edge-twitter-widget.edge-twitter-slider li .edge-tweet-text a:hover',
	            '.widget.widget_edge_twitter_widget .edge-twitter-widget.edge-twitter-slider li .edge-tweet-text span',
	            '.widget.widget_edge_twitter_widget .edge-twitter-widget.edge-twitter-standard li .edge-tweet-text a',
	            '.widget.widget_edge_twitter_widget .edge-twitter-widget.edge-twitter-standard li .edge-tweet-text a:hover',
	            '.widget.widget_edge_twitter_widget .edge-twitter-widget.edge-twitter-standard li .edge-tweet-text span',
	            '.widget.widget_edge_twitter_widget .edge-twitter-widget.edge-twitter-slider li .edge-twitter-icon i',
	            '.edge-popup-holder .edge-popup-inner .edge-popup-close:hover',
	            'body .pp_pic_holder #pp_full_res .pp_inline',
	            'body .pp_pic_holder a.pp_next:hover',
	            'body .pp_pic_holder a.pp_previous:hover',
	            '.edge-main-menu .menu-item-language .submenu-languages a:hover',
	            '.edge-accordion-holder span.edge-title-holder',
	            '.edge-accordion-holder.edge-ac-boxed.edge-white-skin .edge-title-holder.ui-state-active',
	            '.edge-accordion-holder.edge-ac-boxed.edge-white-skin .edge-title-holder.ui-state-default.ui-state-hover',
	            'blockquote .edge-icon-quotations-holder',
	            'blockquote .edge-blockquote-text',
	            '.edge-btn.edge-btn-outline',
	            '.edge-countdown .countdown-row .countdown-section .countdown-amount',
	            '.edge-countdown .countdown-row .countdown-section .countdown-period',
	            '.edge-countdown.edge-dark-skin .countdown-row .countdown-section .countdown-amount',
	            '.edge-countdown.edge-dark-skin .countdown-row .countdown-section .countdown-period',
	            '.edge-icon-list-holder .edge-il-icon-holder>*',
	            '.edge-image-gallery .owl-nav .owl-next:hover .edge-next-icon',
	            '.edge-image-gallery .owl-nav .owl-next:hover .edge-prev-icon',
	            '.edge-image-gallery .owl-nav .owl-prev:hover .edge-next-icon',
	            '.edge-image-gallery .owl-nav .owl-prev:hover .edge-prev-icon',
	            '.edge-image-gallery .owl-nav .edge-next-icon',
	            '.edge-image-gallery .owl-nav .edge-prev-icon',
	            '.edge-item-showcase-holder .edge-is-icon:hover .edge-icon-element',
	            '.edge-message .edge-message-inner a.edge-close',
	            '.edge-pie-chart-holder .edge-pc-percentage .edge-pc-percent',
	            '.edge-price-item .edge-pi-inner ul li:before',
	            '.edge-price-table .edge-pt-inner ul li.edge-pt-title-holder',
	            '.edge-price-table .edge-pt-inner ul li.edge-pt-subtitle-holder',
	            '.edge-social-share-holder.edge-list li a',
	            '.edge-social-share-holder.edge-dropdown .edge-social-share-dropdown-opener .social_share',
	            '.edge-social-share-holder.edge-dropdown .edge-social-share-dropdown-opener:hover',
	            '.edge-tabs.edge-tabs-standard .edge-tabs-nav li a',
	            '.edge-tabs.edge-tabs-boxed .edge-tabs-nav li a',
	            '.edge-tabs.edge-tabs-simple .edge-tabs-nav li.ui-state-active a',
	            '.edge-tabs.edge-tabs-simple .edge-tabs-nav li.ui-state-hover a',
	            '.edge-tabs.edge-tabs-vertical .edge-tabs-nav li.ui-state-active a',
	            '.edge-tabs.edge-tabs-vertical .edge-tabs-nav li.ui-state-hover a',
	            '#multiscroll-nav ul li a.active:before',
	            '#multiscroll-nav ul li a:hover:before',
	            '.edge-video-button-holder .edge-video-button-play',
	            '.edge-pl-filter-holder ul li span',
	            '.edge-pl-standard-pagination ul li a:hover',
	            '.edge-pl-standard-pagination ul li.edge-pl-pag-active a',
	            '.edge-pl-standard-pagination ul li.edge-pl-pag-next a',
	            '.edge-pl-standard-pagination ul li.edge-pl-pag-prev a',
	            '.edge-pl-loading',
	            '.edge-portfolio-slider-holder .owl-dots .owl-dot.active:before',
	            '.edge-portfolio-slider-holder .owl-dots .owl-dot:hover:before',
	            '.edge-portfolio-list-holder.edge-pl-gallery-overlay article .edge-pli-text .edge-pli-category-holder a:hover',
	            '.edge-portfolio-single-holder.edge-ps-gallery-layout .edge-ps-social-info-holder .edge-portfolio-single-likes a span',
	            '.edge-portfolio-single-holder.edge-ps-huge-images-layout .edge-portfolio-single-likes a span',
	            '.edge-portfolio-single-holder.edge-ps-masonry-layout .edge-ps-social-info-holder .edge-portfolio-single-likes a span',
	            '.edge-portfolio-single-holder.edge-ps-slider-layout .edge-ps-social-info-holder .edge-portfolio-single-likes a span',
	            '.edge-portfolio-single-holder.edge-ps-small-gallery-layout .edge-portfolio-single-likes a span',
	            '.edge-portfolio-single-holder.edge-ps-small-images-layout .edge-portfolio-single-likes a span',
	            '.edge-portfolio-single-holder.edge-ps-small-masonry-layout .edge-portfolio-single-likes a span',
	            '.edge-portfolio-single-holder.edge-ps-small-slider-layout .edge-portfolio-single-likes a span',
	            '.edge-ps-navigation .edge-ps-next .edge-single-nav-title-holder a:hover',
	            '.edge-ps-navigation .edge-ps-prev .edge-single-nav-title-holder a:hover',
	            '.edge-ps-navigation .edge-ps-next a .edge-ps-nav-mark',
	            '.edge-ps-navigation .edge-ps-prev a .edge-ps-nav-mark',
	            '.edge-testimonials-holder .owl-nav .owl-next:hover .edge-next-icon',
	            '.edge-testimonials-holder .owl-nav .owl-next:hover .edge-prev-icon',
	            '.edge-testimonials-holder .owl-nav .owl-prev:hover .edge-next-icon',
	            '.edge-testimonials-holder .owl-nav .owl-prev:hover .edge-prev-icon',
	            '.edge-testimonials-holder .owl-nav .edge-next-icon',
	            '.edge-testimonials-holder .owl-nav .edge-prev-icon',
	            '.edge-membership-input-holder label',
	            '.edge-login-register-widget .edge-logged-in-user .edge-logged-in-user-inner>span',
	            '.edge-login-register-widget .edge-login-opener',
	            '.edge-login-register-content ul li a',
	            '.edge-membership-dashboard-nav-holder ul li a.active',
	            '.edge-membership-dashboard-nav-holder ul li a:hover',
	            '.edge-membership-dashboard-content-holder .edge-membership-dashboard-page-content p span',
	            '.edge-woocommerce-page.woocommerce-cart .woocommerce>form table.cart tr.cart_item td.product-remove a:hover',
	            '.edge-woocommerce-page.woocommerce-cart .cart-collaterals table th',
	            '.edge-woocommerce-page.woocommerce-cart .cart-collaterals tr.order-total td',
	            '.edge-woocommerce-page .cart-empty',
	            '.edge-woocommerce-page.woocommerce-order-received .woocommerce ul.order_details li strong',
	            '.edge-woocommerce-page .woocommerce-error>a:hover',
	            '.edge-woocommerce-page .woocommerce-info>a:hover',
	            '.edge-woocommerce-page .woocommerce-message>a:hover',
	            '.edge-woocommerce-page .woocommerce-info .showcoupon:hover',
	            '.woocommerce-pagination .page-numbers li a.current',
	            '.woocommerce-pagination .page-numbers li a:hover',
	            '.woocommerce-pagination .page-numbers li span.current',
	            '.woocommerce-pagination .page-numbers li span:hover',
	            '.edge-woo-view-all-pagination a:hover',
	            '.woocommerce-page .edge-content .edge-quantity-buttons .edge-quantity-minus:hover',
	            '.woocommerce-page .edge-content .edge-quantity-buttons .edge-quantity-plus:hover',
	            'div.woocommerce .edge-quantity-buttons .edge-quantity-minus:hover',
	            'div.woocommerce .edge-quantity-buttons .edge-quantity-plus:hover',
	            '.select2-container--default.select2-container--open .select2-selection--single',
	            '.select2-container--default .select2-results__option--highlighted[aria-selected]',
	            '.select2-container--default .select2-results__option[aria-selected=true]',
	            '.select2-container--default .select2-results__option[aria-disabled=true]',
	            '.edge-woocommerce-page .edge-content .variations .reset_variations',
	            '.edge-woocommerce-page .edge-content table.group_table a:hover',
	            '.edge-woocommerce-page.woocommerce-account .edge-woocommerce-account-navigation .woocommerce-MyAccount-navigation ul li.is-active a',
	            '.edge-woocommerce-page.woocommerce-account .edge-woocommerce-account-navigation .woocommerce-MyAccount-navigation ul li:hover a',
	            '.edge-woocommerce-page.woocommerce-account .woocommerce form.edit-account fieldset>legend',
	            '.edge-woocommerce-page.woocommerce-account .woocommerce table.shop_table th',
	            '.edge-woocommerce-page.woocommerce-account .vc_row .woocommerce form.login p label:not(.inline)',
	            '.edge-content .woocommerce.add_to_cart_inline del',
	            '.edge-content .woocommerce.add_to_cart_inline ins',
	            'div.woocommerce>.single-product .woocommerce-tabs table th',
	            '.edge-woo-single-page .edge-single-product-summary .product_meta>span',
	            '.edge-woo-single-page .edge-single-product-summary .product_meta>span a:hover',
	            '.edge-woo-single-page .edge-single-product-summary .edge-woo-social-share-holder>span:before',
	            '.edge-woo-single-page .edge-single-product-summary p.stock.in-stock',
	            '.edge-woo-single-page .edge-single-product-summary p.stock.out-of-stock',
	            '.edge-woo-single-page .woocommerce-tabs table th',
	            '.edge-woo-single-page .woocommerce-tabs #reviews ol.commentlist .comment-text .woocommerce-review__author',
	            '.edge-shopping-cart-holder .edge-header-cart .edge-cart-icon-text',
	            '.edge-shopping-cart-holder .edge-header-cart .edge-cart-count',
	            '.edge-shopping-cart-holder .edge-header-cart:hover',
	            '.edge-shopping-cart-dropdown .edge-item-info-holder .edge-product-title',
	            '.edge-shopping-cart-dropdown .edge-cart-bottom .edge-subtotal-holder>*',
	            '.edge-shopping-cart-dropdown .edge-cart-bottom .edge-subtotal-holder .edge-total',
	            '.edge-shopping-cart-dropdown .edge-cart-bottom .edge-subtotal-holder .edge-total-amount',
	            '.widget.woocommerce.widget_layered_nav ul li.chosen a',
	            '.widget.woocommerce.widget_price_filter .price_slider_wrapper .price_slider_amount button',
	            '.widget.woocommerce.widget_products ul li .amount',
	            '.widget.woocommerce.widget_recently_viewed_products ul li .amount',
	            '.widget.woocommerce.widget_top_rated_products ul li .amount',
	            '.widget.woocommerce.widget_product_search .woocommerce-product-search button:hover',
	            '.edge-floating-prod-cats-holder .edge-floating-prod-cat .edge-category-title',
	            '.edge-floating-prod-cats-holder .edge-floating-prod-cat .edge-floating-cat-content .edge-btn',
	            '.edge-product-info .edge-pi-add-to-cart .edge-btn.edge-btn-solid.edge-white-skin',
	            '.edge-product-info .edge-pi-add-to-cart .edge-btn.edge-btn-solid.edge-dark-skin:hover',
	            '.edge-plc-holder .edge-plc-title',
	            '.edge-plc-holder .edge-plc-item .edge-plc-image-outer .edge-plc-image .edge-plc-new-product',
	            '.edge-plc-holder .edge-plc-item .edge-plc-image-outer .edge-plc-image .edge-plc-onsale',
	            '.edge-plc-holder .edge-plc-item .edge-plc-image-outer .edge-plc-image .edge-plc-out-of-stock',
	            '.edge-plc-holder .edge-plc-item .edge-plc-excerpt',
	            '.edge-plc-holder .edge-plc-item .edge-plc-add-to-cart a',
	            '.edge-pl-holder .edge-prl-loading .edge-prl-loading-msg',
	            '.edge-pl-holder .edge-pl-categories ul li a.active',
	            '.edge-pl-holder .edge-pl-categories ul li a:hover',
	            '.edge-pl-holder .edge-pl-ordering-outer .edge-pl-ordering div h5',
	            '.edge-pl-holder .edge-pl-ordering-outer .edge-pl-ordering div ul li a.active',
	            '.edge-pl-holder .edge-pl-ordering-outer .edge-pl-ordering div ul li a:hover',
	            '.edge-pl-holder .edge-pli .edge-pli-excerpt',
	            '.edge-pl-holder .edge-pli-inner .edge-pli-image .edge-pli-new-product',
	            '.edge-pl-holder .edge-pli-inner .edge-pli-image .edge-pli-onsale',
	            '.edge-pl-holder .edge-pli-inner .edge-pli-image .edge-pli-out-of-stock',
	            '.edge-pl-holder.edge-info-on-image:not(.edge-product-info-light) .edge-pli-category',
	            '.edge-pl-holder.edge-info-on-image:not(.edge-product-info-light) .edge-pli-excerpt',
	            '.edge-pl-holder.edge-info-on-image:not(.edge-product-info-light) .edge-pli-price',
	            '.edge-pl-holder.edge-info-below-image .edge-pli .edge-pli-text-wrapper .edge-pli-add-to-cart a:hover',
	            '.edge-pl-holder.edge-product-info-dark .edge-pli-inner .edge-pli-text-inner .edge-pli-category',
	            '.edge-pl-holder.edge-product-info-dark .edge-pli-inner .edge-pli-text-inner .edge-pli-excerpt',
	            '.edge-pl-holder.edge-product-info-dark .edge-pli-inner .edge-pli-text-inner .edge-pli-price',
	            '.edge-pl-holder.edge-product-info-dark .edge-pli-inner .edge-pli-text-inner .edge-pli-rating',
	            '.edge-pl-holder.edge-product-info-dark .edge-pli-inner .edge-pli-text-inner .edge-pli-title',
	            '.edge-pls-holder .edge-pls-title',
	            '.edge-pls-holder .edge-pls-item .edge-pls-image-outer .edge-pls-image .edge-pls-new-product',
	            '.edge-pls-holder .edge-pls-item .edge-pls-image-outer .edge-pls-image .edge-pls-onsale',
	            '.edge-pls-holder .edge-pls-item .edge-pls-image-outer .edge-pls-image .edge-pls-out-of-stock',
	            '.edge-pls-holder .edge-pls-item .edge-pls-text-wrapper.edge-pls-text-left-type .edge-pls-title',
	            '.edge-pls-holder .edge-pls-item .edge-pls-text-wrapper.edge-pls-text-right-type .edge-pls-button span',
	            '.edge-pls-holder .edge-pls-item.edge-product-slider-dark-skin .edge-pls-button span',
	            '.edge-pls-holder .edge-pls-item.edge-product-slider-dark-skin .edge-pls-category',
	            '.edge-pls-holder .edge-pls-item.edge-product-slider-dark-skin .edge-pls-category a',
	            '.edge-pls-holder .edge-pls-item.edge-product-slider-dark-skin .edge-pls-text-right-type .edge-pls-button span',
	            '.edge-pls-holder.edge-pls-pag-with-numbers .owl-dots .owl-dot.active',
	            '#yith-quick-view-modal #yith-quick-view-content .summary .variations .reset_variations',
	            '.yith-quick-view.yith-modal #yith-quick-view-content .summary .variations .reset_variations',
	            '#yith-quick-view-modal #yith-quick-view-content .summary table.group_table a:hover',
	            '.yith-quick-view.yith-modal #yith-quick-view-content .summary table.group_table a:hover',
	            '#yith-quick-view-modal #yith-quick-view-content .summary div[itemprop=offers] .price',
	            '.yith-quick-view.yith-modal #yith-quick-view-content .summary div[itemprop=offers] .price',
	            '#yith-quick-view-modal #yith-quick-view-content .summary .edge-single-product-share-wish .yith-wcwl-wishlistaddedbrowse a:after',
	            '#yith-quick-view-modal #yith-quick-view-content .summary .edge-single-product-share-wish .yith-wcwl-wishlistexistsbrowse a:after',
	            '.yith-quick-view.yith-modal #yith-quick-view-content .summary .edge-single-product-share-wish .yith-wcwl-wishlistaddedbrowse a:after',
	            '.yith-quick-view.yith-modal #yith-quick-view-content .summary .edge-single-product-share-wish .yith-wcwl-wishlistexistsbrowse a:after',
	            '#yith-quick-view-modal #yith-quick-view-content .summary .edge-single-product-share-wish .yith-wcwl-wishlistaddedbrowse span',
	            '.yith-quick-view.yith-modal #yith-quick-view-content .summary .edge-single-product-share-wish .yith-wcwl-wishlistaddedbrowse span',
	            '#yith-quick-view-modal #yith-quick-view-content .summary .edge-single-product-share-wish .edge-woo-social-share-holder>span',
	            '.yith-quick-view.yith-modal #yith-quick-view-content .summary .edge-single-product-share-wish .edge-woo-social-share-holder>span',
	            '#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a',
	            '#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a',
	            '#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a',
	            '.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a',
	            '.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a',
	            '.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a',
	            '#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse span',
	            '.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse span',
	            '#yith-quick-view-modal #yith-quick-view-content .summary p.stock.in-stock',
	            '#yith-quick-view-modal #yith-quick-view-content .summary p.stock.out-of-stock',
	            '.yith-quick-view.yith-modal #yith-quick-view-content .summary p.stock.in-stock',
	            '.yith-quick-view.yith-modal #yith-quick-view-content .summary p.stock.out-of-stock',
	            '#yith-quick-view-modal #yith-quick-view-close',
	            '.yith-quick-view.yith-modal #yith-quick-view-close',
	            '.yith-wcwl-wishlistaddedbrowse span',
	            '#yith-wcwl-popup-message #yith-wcwl-message',
	            '.woocommerce-wishlist .woocommerce-error>a:hover',
	            '.woocommerce-wishlist .woocommerce-info>a:hover',
	            '.woocommerce-wishlist .woocommerce-message>a:hover',
	            '.woocommerce-wishlist table.wishlist_table tbody tr td.product-remove a:hover',
	            '.woocommerce-wishlist table.wishlist_table tbody tr td.product-add-to-cart a',
	            '.edge-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a',
	            '.edge-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a',
	            '.edge-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a',
	            '.edge-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a:hover:after',
	            '.edge-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:hover:after',
	            '.edge-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a:hover:after',
	            '.edge-wishlist-widget-holder a',

            );

	        $color_important_selector = array(
		        '.edge-fullscreen-menu-opener.edge-fm-opened',
		        '.edge-fullscreen-menu-opener:hover',
		        '.edge-btn.edge-btn-simple:not(.edge-btn-custom-hover-color):hover',
	        );

            $background_color_selector = array(
	            '.edge-st-loader .pulse',
	            '.edge-st-loader .double_pulse .double-bounce1',
	            '.edge-st-loader .double_pulse .double-bounce2',
	            '.edge-st-loader .cube',
	            '.edge-st-loader .rotating_cubes .cube1',
	            '.edge-st-loader .rotating_cubes .cube2',
	            '.edge-st-loader .stripes>div',
	            '.edge-st-loader .wave>div',
	            '.edge-st-loader .two_rotating_circles .dot1',
	            '.edge-st-loader .two_rotating_circles .dot2',
	            '.edge-st-loader .five_rotating_circles .container1>div',
	            '.edge-st-loader .five_rotating_circles .container2>div',
	            '.edge-st-loader .five_rotating_circles .container3>div',
	            '.edge-st-loader .lines .line1',
	            '.edge-st-loader .lines .line2',
	            '.edge-st-loader .lines .line3',
	            '.edge-st-loader .lines .line4',
	            '.edge-owl-slider .owl-dots .owl-dot.active span',
	            '.edge-owl-slider .owl-dots .owl-dot:hover span',
	            '.edge-header-vertical-closed .edge-vertical-menu-area .edge-vertical-area-opener .edge-vertical-area-opener-line',
	            '.edge-header-vertical-closed .edge-vertical-menu-area .edge-vertical-area-opener .edge-vertical-area-opener-line:before',
	            '.edge-header-vertical-closed .edge-vertical-menu-area .edge-vertical-area-opener .edge-vertical-area-opener-line:after',
	            '.edge-mobile-header .edge-mobile-side-area .edge-close-mobile-side-area-holder .edge-mo-line:before',
	            '.edge-mobile-header .edge-mobile-side-area .edge-close-mobile-side-area-holder .edge-mo-line:after',
	            '.edge-mobile-header .edge-mobile-menu-opener a .edge-mo-lines .edge-mo-line',
	            '.edge-mobile-header .edge-mobile-menu-opener a .edge-mo-lines .edge-mo-line:before',
	            '.edge-mobile-header .edge-mobile-menu-opener a .edge-mo-lines .edge-mo-line:after',
	            '.edge-page-footer .edge-footer-bottom-holder',
	            '.edge-side-menu-button-opener.opened .edge-side-menu-lines .edge-side-menu-line',
	            '.edge-fullscreen-menu-opener.edge-fm-opened .edge-fm-lines .edge-fm-line',
	            '.edge-blog-holder article.format-audio .edge-blog-audio-holder .mejs-container .mejs-controls>.mejs-time-rail .mejs-time-total .mejs-time-current',
	            '.edge-blog-holder article.format-audio .edge-blog-audio-holder .mejs-container .mejs-controls>a.mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
	            '.edge-blog-pag-loading>div',
	            '.edge-bl-loading>div',
	            '.edge-blog-slider-holder .owl-dots .owl-dot.active span',
	            '.edge-blog-slider-holder .owl-dots .owl-dot:hover span',
	            '.widget.edge-image-slider-widget .owl-dots .owl-dot.active span',
	            'body .pp_overlay',
	            '.edge-page-footer .widget_icl_lang_sel_widget #lang_sel ul ul',
	            '.edge-page-footer .widget_icl_lang_sel_widget #lang_sel_click ul ul',
	            '.edge-top-bar .widget_icl_lang_sel_widget #lang_sel ul ul',
	            '.edge-top-bar .widget_icl_lang_sel_widget #lang_sel_click ul ul',
	            '.edge-accordion-holder.edge-ac-boxed .edge-title-holder.ui-state-active',
	            '.edge-accordion-holder.edge-ac-boxed .edge-title-holder.ui-state-hover',
	            '.edge-dropcaps.edge-circle',
	            '.edge-dropcaps.edge-square',
	            '.edge-image-gallery .owl-dots .owl-dot span:before',
	            '.edge-image-slider-holder.edge-owl-slider .owl-dots .owl-dot span',
	            '.edge-message',
	            '.edge-mobile-slider-holder .edge-ms-inner .owl-dots .owl-dot span',
	            '.edge-progress-bar.edge-progress-bar-dark .edge-pb-content-holder .edge-pb-content',
	            '.edge-progress-bar.edge-progress-bar-default .edge-pb-content-holder .edge-pb-content',
	            '.edge-tabs.edge-tabs-standard .edge-tabs-nav li.ui-state-active a',
	            '.edge-tabs.edge-tabs-standard .edge-tabs-nav li.ui-state-hover a',
	            '.edge-tabs.edge-tabs-boxed .edge-tabs-nav li.ui-state-active a',
	            '.edge-tabs.edge-tabs-boxed .edge-tabs-nav li.ui-state-hover a',
	            '#multiscroll-nav ul li a.active',
	            '#multiscroll-nav ul li a:hover',
	            '.edge-masonry-gallery-holder .edge-mg-item.edge-mg-simple.edge-mg-skin-dark .edge-mg-item-inner',
	            '.edge-pl-loading>div',
	            '.edge-ps-navigation .edge-ps-back-btn a span .icon_grid-square',
	            '.edge-team-slider-holder .edge-tl-inner .owl-dots .owl-dot.active span',
	            '.edge-team-slider-holder .edge-tl-inner .owl-dots .owl-dot:hover span',
	            '.edge-testimonials-holder .owl-dots .owl-dot.active span',
	            '.edge-testimonials-holder .owl-dots .owl-dot:hover span',
	            '.edge-testimonials-holder.edge-testimonials-standard .owl-dots .owl-dot.active span',
	            '.edge-testimonials-holder.edge-testimonials-standard .owl-dots .owl-dot:hover span',
	            '.edge-login-register-content.edge-user-not-logged-in ul li.ui-state-active',
	            '.woocommerce-pagination .page-numbers li a:not(.next):before',
	            '.woocommerce-pagination .page-numbers li span:not(.next):before',
	            '.select2-container--default .select2-selection--multiple .select2-selection__rendered .select2-selection__choice',
	            '.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content .ui-slider-handle',
	            '.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content .ui-slider-range',
	            '.edge-product-info .edge-pi-add-to-cart .edge-btn.edge-btn-solid.edge-dark-skin',
	            '.edge-product-info .edge-pi-add-to-cart .edge-btn.edge-btn-solid.edge-white-skin:hover',
	            '.edge-pls-holder.edge-pls-pag-with-numbers .owl-dots .owl-dot:before'
            );

            $border_color_selector = array(
	            '.edge-blog-holder article.format-audio .edge-blog-audio-holder .mejs-container .mejs-controls>.mejs-time-rail .mejs-time-total .mejs-time-float .mejs-time-float-corner'
            );

            echo adorn_edge_dynamic_css($color_selector, array('color' => $first_main_color));
	        echo adorn_edge_dynamic_css($color_important_selector, array('color' => $first_main_color.'!important'));
	        echo adorn_edge_dynamic_css($background_color_selector, array('background-color' => $first_main_color));
	        echo adorn_edge_dynamic_css($border_color_selector, array('border-color' => $first_main_color));
        }

        $page_background_color = adorn_edge_options()->getOptionValue('page_background_color');
		if (!empty($page_background_color)) {
			$background_color_selector = array(
				'.edge-wrapper-inner',
				'.edge-content'
			);
			echo adorn_edge_dynamic_css($background_color_selector, array('background-color' => $page_background_color));
		}

		$selection_color = adorn_edge_options()->getOptionValue('selection_color');
		if (!empty($selection_color)) {
			echo adorn_edge_dynamic_css('::selection', array('background' => $selection_color));
			echo adorn_edge_dynamic_css('::-moz-selection', array('background' => $selection_color));
		}

		$boxed_background_style = array();
	    $boxed_page_background_color = adorn_edge_options()->getOptionValue('page_background_color_in_box');
		if (!empty($boxed_page_background_color)) {
			$boxed_background_style['background-color'] = $boxed_page_background_color;
		}
	
	    $boxed_page_background_image = adorn_edge_options()->getOptionValue('boxed_background_image');
		if (!empty($boxed_page_background_image)) {
			$boxed_background_style['background-image'] = 'url('.esc_url($boxed_page_background_image).')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat'] = 'no-repeat';
		}
	
	    $boxed_page_background_pattern_image = adorn_edge_options()->getOptionValue('boxed_pattern_background_image');
		if (!empty($boxed_page_background_pattern_image)) {
			$boxed_background_style['background-image'] = 'url('.esc_url($boxed_page_background_pattern_image).')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat'] = 'repeat';
		}
	
	    $boxed_page_background_attachment = adorn_edge_options()->getOptionValue('boxed_background_image_attachment');
		if (!empty($boxed_page_background_attachment)) {
			$boxed_background_style['background-attachment'] = $boxed_page_background_attachment;
		}

		echo adorn_edge_dynamic_css('.edge-boxed .edge-wrapper', $boxed_background_style);

        $paspartu_style = array();
	    $paspartu_color = adorn_edge_options()->getOptionValue('paspartu_color');
        if (!empty($paspartu_color)) {
            $paspartu_style['background-color'] = $paspartu_color;
        }
	
	    $paspartu_width = adorn_edge_options()->getOptionValue('paspartu_width');
        if ($paspartu_width !== '') {
            $paspartu_style['padding'] = $paspartu_width.'%';
        }

        echo adorn_edge_dynamic_css('.edge-paspartu-enabled .edge-wrapper', $paspartu_style);
    }

    add_action('adorn_edge_style_dynamic', 'adorn_edge_design_styles');
}

if(!function_exists('adorn_edge_content_styles')) {
    /**
     * Generates content custom styles
     */
    function adorn_edge_content_styles() {
        $content_style = array();
	    
	    $padding_top = adorn_edge_options()->getOptionValue('content_top_padding');
	    if ($padding_top !== '') {
            $content_style['padding-top'] = adorn_edge_filter_px($padding_top).'px';
        }

        $content_selector = array(
            '.edge-content .edge-content-inner > .edge-full-width > .edge-full-width-inner',
        );

        echo adorn_edge_dynamic_css($content_selector, $content_style);

        $content_style_in_grid = array();
	    
	    $padding_top_in_grid = adorn_edge_options()->getOptionValue('content_top_padding_in_grid');
	    if ($padding_top_in_grid !== '') {
            $content_style_in_grid['padding-top'] = adorn_edge_filter_px($padding_top_in_grid).'px';
        }

        $content_selector_in_grid = array(
            '.edge-content .edge-content-inner > .edge-container > .edge-container-inner',
        );

        echo adorn_edge_dynamic_css($content_selector_in_grid, $content_style_in_grid);
    }

    add_action('adorn_edge_style_dynamic', 'adorn_edge_content_styles');
}

if (!function_exists('adorn_edge_h1_styles')) {

    function adorn_edge_h1_styles() {
	    $margin_top = adorn_edge_options()->getOptionValue('h1_margin_top');
	    $margin_bottom = adorn_edge_options()->getOptionValue('h1_margin_bottom');
	    
	    $item_styles = adorn_edge_get_typography_styles('h1');
	    
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = adorn_edge_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = adorn_edge_filter_px($margin_bottom).'px';
	    }
	    
	    $item_selector = array(
		    'h1'
	    );
	
	    echo adorn_edge_dynamic_css($item_selector, $item_styles);
    }

    add_action('adorn_edge_style_dynamic', 'adorn_edge_h1_styles');
}

if (!function_exists('adorn_edge_h2_styles')) {

    function adorn_edge_h2_styles() {
	    $margin_top = adorn_edge_options()->getOptionValue('h2_margin_top');
	    $margin_bottom = adorn_edge_options()->getOptionValue('h2_margin_bottom');
	
	    $item_styles = adorn_edge_get_typography_styles('h2');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = adorn_edge_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = adorn_edge_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h2'
	    );
	
	    echo adorn_edge_dynamic_css($item_selector, $item_styles);
    }

    add_action('adorn_edge_style_dynamic', 'adorn_edge_h2_styles');
}

if (!function_exists('adorn_edge_h3_styles')) {

    function adorn_edge_h3_styles() {
	    $margin_top = adorn_edge_options()->getOptionValue('h3_margin_top');
	    $margin_bottom = adorn_edge_options()->getOptionValue('h3_margin_bottom');
	
	    $item_styles = adorn_edge_get_typography_styles('h3');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = adorn_edge_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = adorn_edge_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h3'
	    );
	
	    echo adorn_edge_dynamic_css($item_selector, $item_styles);
    }

    add_action('adorn_edge_style_dynamic', 'adorn_edge_h3_styles');
}

if (!function_exists('adorn_edge_h4_styles')) {

    function adorn_edge_h4_styles() {
	    $margin_top = adorn_edge_options()->getOptionValue('h4_margin_top');
	    $margin_bottom = adorn_edge_options()->getOptionValue('h4_margin_bottom');
	
	    $item_styles = adorn_edge_get_typography_styles('h4');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = adorn_edge_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = adorn_edge_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h4'
	    );
	
	    echo adorn_edge_dynamic_css($item_selector, $item_styles);
    }

    add_action('adorn_edge_style_dynamic', 'adorn_edge_h4_styles');
}

if (!function_exists('adorn_edge_h5_styles')) {

    function adorn_edge_h5_styles() {
	    $margin_top = adorn_edge_options()->getOptionValue('h5_margin_top');
	    $margin_bottom = adorn_edge_options()->getOptionValue('h5_margin_bottom');
	
	    $item_styles = adorn_edge_get_typography_styles('h5');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = adorn_edge_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = adorn_edge_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h5'
	    );
	
	    echo adorn_edge_dynamic_css($item_selector, $item_styles);
    }

    add_action('adorn_edge_style_dynamic', 'adorn_edge_h5_styles');
}

if (!function_exists('adorn_edge_h6_styles')) {

    function adorn_edge_h6_styles() {
	    $margin_top = adorn_edge_options()->getOptionValue('h6_margin_top');
	    $margin_bottom = adorn_edge_options()->getOptionValue('h6_margin_bottom');
	
	    $item_styles = adorn_edge_get_typography_styles('h6');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = adorn_edge_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = adorn_edge_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h6'
	    );
	
	    echo adorn_edge_dynamic_css($item_selector, $item_styles);
    }

    add_action('adorn_edge_style_dynamic', 'adorn_edge_h6_styles');
}

if (!function_exists('adorn_edge_text_styles')) {

    function adorn_edge_text_styles() {
	    $item_styles = adorn_edge_get_typography_styles('text');
	
	    $item_selector = array(
		    'p'
	    );
	
	    echo adorn_edge_dynamic_css($item_selector, $item_styles);
    }

    add_action('adorn_edge_style_dynamic', 'adorn_edge_text_styles');
}

if (!function_exists('adorn_edge_link_styles')) {

    function adorn_edge_link_styles() {
        $link_styles = array();

        if(adorn_edge_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = adorn_edge_options()->getOptionValue('link_color');
        }
        if(adorn_edge_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = adorn_edge_options()->getOptionValue('link_fontstyle');
        }
        if(adorn_edge_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = adorn_edge_options()->getOptionValue('link_fontweight');
        }
        if(adorn_edge_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = adorn_edge_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if (!empty($link_styles)) {
            echo adorn_edge_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('adorn_edge_style_dynamic', 'adorn_edge_link_styles');
}

if (!function_exists('adorn_edge_link_hover_styles')) {

    function adorn_edge_link_hover_styles() {
        $link_hover_styles = array();

        if(adorn_edge_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = adorn_edge_options()->getOptionValue('link_hovercolor');
        }
        if(adorn_edge_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = adorn_edge_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if (!empty($link_hover_styles)) {
            echo adorn_edge_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if(adorn_edge_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = adorn_edge_options()->getOptionValue('link_hovercolor');
        }

        $link_heading_hover_selector = array(
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover'
        );

        if (!empty($link_heading_hover_styles)) {
            echo adorn_edge_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('adorn_edge_style_dynamic', 'adorn_edge_link_hover_styles');
}

if (!function_exists('adorn_edge_smooth_page_transition_styles')) {

	function adorn_edge_smooth_page_transition_styles($style) {
		$id = adorn_edge_get_page_id();
		$loader_style = array();
		$current_style = '';
		$style = '';

		if(adorn_edge_get_meta_field_intersect('smooth_pt_bgnd_color',$id) !== '') {
			$loader_style['background-color'] = adorn_edge_get_meta_field_intersect('smooth_pt_bgnd_color',$id);
		}

		$loader_selector = array('.edge-smooth-transition-loader');

		if (!empty($loader_style)) {
			$current_style .= adorn_edge_dynamic_css($loader_selector, $loader_style);
		}

		$spinner_style = array();

		if(adorn_edge_get_meta_field_intersect('smooth_pt_spinner_color',$id) !== '') {
			$spinner_style['background-color'] = adorn_edge_get_meta_field_intersect('smooth_pt_spinner_color',$id);
		}

		$spinner_selectors = array(
			'.edge-st-loader .edge-rotate-circles > div',
			'.edge-st-loader .pulse',
			'.edge-st-loader .double_pulse .double-bounce1',
			'.edge-st-loader .double_pulse .double-bounce2',
			'.edge-st-loader .cube',
			'.edge-st-loader .rotating_cubes .cube1',
			'.edge-st-loader .rotating_cubes .cube2',
			'.edge-st-loader .stripes > div',
			'.edge-st-loader .wave > div',
			'.edge-st-loader .two_rotating_circles .dot1',
			'.edge-st-loader .two_rotating_circles .dot2',
			'.edge-st-loader .five_rotating_circles .container1 > div',
			'.edge-st-loader .five_rotating_circles .container2 > div',
			'.edge-st-loader .five_rotating_circles .container3 > div',
			'.edge-st-loader .atom .ball-1:before',
			'.edge-st-loader .atom .ball-2:before',
			'.edge-st-loader .atom .ball-3:before',
			'.edge-st-loader .atom .ball-4:before',
			'.edge-st-loader .clock .ball:before',
			'.edge-st-loader .mitosis .ball',
			'.edge-st-loader .lines .line1',
			'.edge-st-loader .lines .line2',
			'.edge-st-loader .lines .line3',
			'.edge-st-loader .lines .line4',
			'.edge-st-loader .fussion .ball',
			'.edge-st-loader .fussion .ball-1',
			'.edge-st-loader .fussion .ball-2',
			'.edge-st-loader .fussion .ball-3',
			'.edge-st-loader .fussion .ball-4',
			'.edge-st-loader .wave_circles .ball',
			'.edge-st-loader .pulse_circles .ball'
		);

		if (!empty($spinner_style)) {
			$current_style .= adorn_edge_dynamic_css($spinner_selectors, $spinner_style);
		}

		$current_style = $current_style . $style;

		return $current_style;
	}

	add_filter('adorn_edge_add_page_custom_style', 'adorn_edge_smooth_page_transition_styles');
}