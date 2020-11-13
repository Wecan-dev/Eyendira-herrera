<?php

if (!function_exists('adorn_edge_woocommerce_products_per_page')) {
	/**
	 * Function that sets number of products per page. Default is 9
	 * @return int number of products to be shown per page
	 */
	function adorn_edge_woocommerce_products_per_page() {

		$products_per_page = 12;

		if (adorn_edge_options()->getOptionValue('edge_woo_products_per_page')) {
			$products_per_page = adorn_edge_options()->getOptionValue('edge_woo_products_per_page');
		}
		if(isset($_GET['woo-products-count']) && $_GET['woo-products-count'] === 'view-all') {
			$products_per_page = 9999;
		}

		return $products_per_page;
	}
}

if (!function_exists('adorn_edge_woocommerce_thumbnails_per_row')) {
	/**
	 * Function that sets number of thumbnails on single product page per row. Default is 4
	 * @return int number of thumbnails to be shown on single product page per row
	 */
	function adorn_edge_woocommerce_thumbnails_per_row() {

		return 4;
	}
}

if (!function_exists('adorn_edge_woocommerce_related_products_args')) {
	/**
	 * Function that sets number of displayed related products. Hooks to woocommerce_output_related_products_args filter
	 * @param $args array array of args for the query
	 * @return mixed array of changed args
	 */
	function adorn_edge_woocommerce_related_products_args($args) {
		$related = adorn_edge_options()->getOptionValue('edge_woo_product_list_columns');

		if (!empty($related)) {
			switch ($related) {
				case 'edge-woocommerce-columns-4':
					$args['posts_per_page'] = 4;
					break;
				case 'edge-woocommerce-columns-3':
					$args['posts_per_page'] = 4;
					break;
				default:
					$args['posts_per_page'] = 4;
			}
		} else {
			$args['posts_per_page'] = 4;
		}



		return $args;
	}
}

if (!function_exists('adorn_edge_woocommerce_template_loop_product_title')) {
	/**
	 * Function for overriding product title template in Product List Loop
	 */
	function adorn_edge_woocommerce_template_loop_product_title() {

		$tag = adorn_edge_options()->getOptionValue('edge_products_list_title_tag');
		if($tag === '') {
			$tag = 'h4';
		}
		the_title('<' . $tag . ' class="edge-product-list-title"><a href="'.get_the_permalink().'">', '</a></' . $tag . '>');
	}
}

if (!function_exists('adorn_edge_woocommerce_template_single_title')) {
	/**
	 * Function for overriding product title template in Single Product template
	 */
	function adorn_edge_woocommerce_template_single_title() {

		$tag = adorn_edge_options()->getOptionValue('edge_single_product_title_tag');
		if($tag === '') {
			$tag = 'h3';
		}
		the_title('<' . $tag . '  itemprop="name" class="edge-single-product-title">', '</' . $tag . '>');
	}
}

if (!function_exists('adorn_edge_woocommerce_sale_flash')) {
	/**
	 * Function for overriding Sale Flash Template
	 *
	 * @return string
	 */
	function adorn_edge_woocommerce_sale_flash() {
		global $product;

		if ($product->is_in_stock() && !$product->has_child()) { //second condition is for variable products that has variations with different prices
			return '<span class="edge-onsale">' . adorn_edge_woocommerce_sale_percentage(intval($product->get_regular_price()), intval($product->get_sale_price())) . '</span>';
		}
	}
}

if (!function_exists('adorn_edge_woocommerce_product_out_of_stock')) {
	/**
	 * Function for adding Out Of Stock Template
	 *
	 * @return string
	 */
	function adorn_edge_woocommerce_product_out_of_stock() {

		global $product;

		if (!$product->is_in_stock()) {
			print '<span class="edge-out-of-stock">' . esc_html__('Sold', 'adorn') . '</span>';
		}
	}
}

if (!function_exists('adorn_edge_woocommerce_new_product_mark')) {
	/**
	 * Function for adding New Product Template
	 *
	 * @return string
	 */
	function adorn_edge_woocommerce_new_product_mark() {
		global $product;

		if (get_post_meta($product->get_id(), 'edge_single_product_new_meta', true) === 'yes') {
			print '<span class="edge-new-product">' . esc_html__('New', 'adorn') . '</span>';
		}
	}
}

if (!function_exists('adorn_edge_woocommerce_view_all_pagination')) {
	/**
	 * Function for adding New WooCommerce Pagination Template
	 *
	 * @return string
	 */
	function adorn_edge_woocommerce_view_all_pagination() {

		global $wp_query;

		if ( $wp_query->max_num_pages <= 1 ) {
			return;
		}

		$html = '';

		if(get_option('woocommerce_shop_page_id')) {
			$html .= '<div class="edge-woo-view-all-pagination">';
			$html .= '<a href="'.get_permalink(get_option('woocommerce_shop_page_id')).'?woo-products-count=view-all">'.esc_html__('View All', 'adorn').'</a>';
			$html .= '</div>';
		}

		echo wp_kses_post( $html );
	}
}
if (!function_exists('adorn_edge_woocommerce_template_loop_add_to_cart')) {
	/**
	 * Function for adding woo button to list
	 *
	 * @return string
	 */
	function adorn_edge_woocommerce_template_loop_add_to_cart() {
		global $product;

		if (!$product->is_in_stock()) {
			$button_classes = 'ajax_add_to_cart edge-button edge-read-more-button';
		} else if ($product->get_type() === 'variable') {
			$button_classes = 'product_type_variable add_to_cart_button edge-button';
		} else if ($product->get_type() === 'external') {
			$button_classes = 'product_type_external edge-button';
		} else {
			$button_classes = 'add_to_cart_button ajax_add_to_cart edge-button';
		}

		echo '<div class="edge-pl-add-to-cart">';
		echo apply_filters( 'woocommerce_loop_add_to_cart_link',
			sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				esc_attr( $product->get_id() ),
				esc_attr( $product->get_sku() ),
				esc_attr( $button_classes ),
				esc_html( $product->add_to_cart_text() )
			),
			$product );
		echo '</div>';
	}
}

if (!function_exists('adorn_edge_woo_view_all_pagination_additional_tag_before')) {
	function adorn_edge_woo_view_all_pagination_additional_tag_before() {

		print '<div class="edge-woo-pagination-holder"><div class="edge-woo-pagination-inner">';
	}
}

if (!function_exists('adorn_edge_woo_view_all_pagination_additional_tag_after')) {
	function adorn_edge_woo_view_all_pagination_additional_tag_after() {

		print '</div></div>';
	}
}

if (!function_exists('adorn_edge_woocommerce_product_thumbnail_column_size')) {
	function adorn_edge_woocommerce_product_thumbnail_column_size() {
		
		return 4;
	}
}

if (!function_exists('adorn_edge_single_product_content_additional_tag_before')) {
	function adorn_edge_single_product_content_additional_tag_before() {

		print '<div class="edge-single-product-content">';
	}
}

if (!function_exists('adorn_edge_single_product_content_additional_tag_after')) {
	function adorn_edge_single_product_content_additional_tag_after() {

		print '</div>';
	}
}

if (!function_exists('adorn_edge_single_product_summary_additional_tag_before')) {
	function adorn_edge_single_product_summary_additional_tag_before() {

		print '<div class="edge-single-product-summary">';
	}
}

if (!function_exists('adorn_edge_single_product_summary_additional_tag_after')) {
	function adorn_edge_single_product_summary_additional_tag_after() {

		print '</div>';
	}
}

if (!function_exists('adorn_edge_pl_holder_additional_tag_before')) {
	function adorn_edge_pl_holder_additional_tag_before() {

		print '<div class="edge-pl-main-holder">';
	}
}

if (!function_exists('adorn_edge_pl_holder_additional_tag_after')) {
	function adorn_edge_pl_holder_additional_tag_after() {

		print '</div>';
	}
}

if (!function_exists('adorn_edge_pl_inner_additional_tag_before')) {
	function adorn_edge_pl_inner_additional_tag_before() {

		print '<div class="edge-pl-inner">';
	}
}

if (!function_exists('adorn_edge_pl_inner_additional_tag_after')) {
	function adorn_edge_pl_inner_additional_tag_after() {

		print '</div>';
	}
}

if (!function_exists('adorn_edge_pl_image_additional_tag_before')) {
	function adorn_edge_pl_image_additional_tag_before() {

		print '<div class="edge-pl-image">';
	}
}

if (!function_exists('adorn_edge_pl_image_additional_tag_after')) {
	function adorn_edge_pl_image_additional_tag_after() {

		print '</div>';
	}
}

if (!function_exists('adorn_edge_pl_inner_text_additional_tag_before')) {
	function adorn_edge_pl_inner_text_additional_tag_before() {

		print '<div class="edge-pl-text"><div class="edge-pl-text-outer"><div class="edge-pl-text-inner">';
	}
}

if (!function_exists('adorn_edge_pl_inner_text_additional_tag_after')) {
	function adorn_edge_pl_inner_text_additional_tag_after() {

		print '</div></div></div>';
	}
}

if (!function_exists('adorn_edge_pl_text_wrapper_additional_tag_before')) {
	function adorn_edge_pl_text_wrapper_additional_tag_before() {

		print '<div class="edge-pl-text-wrapper">';
	}
}

if (!function_exists('adorn_edge_pl_text_wrapper_additional_tag_after')) {
	function adorn_edge_pl_text_wrapper_additional_tag_after() {

		print '</div>';
	}
}

if (!function_exists('adorn_edge_pl_rating_additional_tag_before')) {
	function adorn_edge_pl_rating_additional_tag_before() {
		global $product;

		if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {

			$rating_html = wc_get_rating_html( $product->get_average_rating() );;

			if($rating_html !== '') {
				print '<div class="edge-pl-rating-holder">';
			}
		}
	}
}

if (!function_exists('adorn_edge_pl_rating_additional_tag_after')) {
	function adorn_edge_pl_rating_additional_tag_after() {
		global $product;

		if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {

			$rating_html = wc_get_rating_html( $product->get_average_rating() );;

			if($rating_html !== '') {
				print '</div>';
			}
		}
	}
}

if (!function_exists('adorn_edge_woocommerce_cart_title')) {
	function adorn_edge_woocommerce_cart_title(){
		print '<h3>'.esc_html__('Shopping Cart','adorn').'</h3>';
	}
}

if (!function_exists('adorn_edge_woocommerce_cart_back_to_home')) {
	function adorn_edge_woocommerce_cart_back_to_home(){
		print '<a class="edge-cart-go-back" itemprop="url" href="' . esc_url(home_url('/')) . '">' . esc_html__('Go Back Shopping', 'adorn') . '</a>';
	}
}

if (!function_exists('adorn_edge_woocommerce_empty_cart_text')) {
    function adorn_edge_woocommerce_empty_cart_text(){
        print '<p>'.esc_html__('Why not return to our amazing shop and start filling it with products. Just click on the button below to instantly get back to the shop page. Oh, and while you are there, check out all of our mind-blowing discounts.','adorn').'</p>';
    }
}

if (!function_exists('adorn_edge_woocommerce_div_before_account_navigation')) {
	function adorn_edge_woocommerce_div_before_account_navigation(){
		print '<div class="edge-woocommerce-account-navigation">';
	}
}

if (!function_exists('adorn_edge_woocommerce_div_after_account_navigation')) {
	function adorn_edge_woocommerce_div_after_account_navigation(){
		print '</div>';
	}
}

if (!function_exists('adorn_edge_woocommerce_account_profile_image')) {
	function adorn_edge_woocommerce_account_profile_image(){
		$current_user    = wp_get_current_user();
		$name            = $current_user->display_name;
		$current_user_id = $current_user->ID;

		$html = '';

		$profile_image = get_user_meta( $current_user_id, 'social_profile_image', true );
		if ( $profile_image == '' ) {
			$profile_image = get_avatar( $current_user_id );
		} else {
			$profile_image = '<img src="' . esc_url( $profile_image ) . '" />';
		}
		$html .= '<div class="edge-user-info">';
		$html .= adorn_edge_kses_img( $profile_image, 96 );
		$html .= '<h3>'.esc_html__('Hello', 'adorn').'</h3>';
		$html .= '<span class="edge-username">@'.esc_html( $name ).'</span>';
		$html .= '</div>';


		echo wp_kses_post( $html );
	}
}

if ( ! function_exists( 'adorn_edge_woo_single_product_image_behavior_class' ) ) {
    function adorn_edge_woo_single_product_image_behavior_class( $classes ) {
        $image_behavior = adorn_edge_get_meta_field_intersect( 'woo_set_single_images_behavior' );

        if ( ! empty( $image_behavior ) ) {
            $classes[] = 'edge-woo-single-has-' . $image_behavior;
        }

        return $classes;
    }

    add_filter( 'body_class', 'adorn_edge_woo_single_product_image_behavior_class' );
}

if (!function_exists('adorn_edge_login_form_additional_tag_before')) {
	function adorn_edge_login_form_additional_tag_before(){
		print '<div class="edge-woocommerce-account-login-form">';
	}
}

if (!function_exists('adorn_edge_login_form_additional_tag_after')) {
	function adorn_edge_login_form_additional_tag_after(){
		print '</div>';
	}
}