<?php

if(!function_exists('adorn_edge_woocommerce_quickview_link')) {
	/**
	 * Function that returns quick view link
	 */
	function adorn_edge_woocommerce_quickview_link(){
		global $product;

		print '<div class="edge-yith-wcqv-holder"><a href="#" class="yith-wcqv-button" data-product_id="'.$product->id.'"><span>'.esc_html__('QUICK VIEW', 'adorn').'</span></a></div>';

	}
	add_action('adorn_edge_woocommerce_info_below_image_hover', 'adorn_edge_woocommerce_quickview_link',1);
}

if(!function_exists('adorn_edge_woocommerce_disable_yith_pretty_photo')) {
	/**
	 * Function that disable YITH Quick View pretty photo style
	 */
	function adorn_edge_woocommerce_disable_yith_pretty_photo() {
		//is woocommerce installed?
		if(adorn_edge_is_woocommerce_installed() && adorn_edge_is_yith_wcqv_install()) {

			wp_deregister_style('woocommerce_prettyPhoto_css');
		}
	}

	add_action('wp_footer', 'adorn_edge_woocommerce_disable_yith_pretty_photo');
}

