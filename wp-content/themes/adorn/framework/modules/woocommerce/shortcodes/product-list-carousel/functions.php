<?php
if(!function_exists('adorn_edge_add_product_list_carousel_shortcode')) {
	function adorn_edge_add_product_list_carousel_shortcode($shortcodes_class_name) {
		$shortcodes = array(
			'EdgeCore\CPT\Shortcodes\ProductListCarousel\ProductListCarousel',
		);

		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

		return $shortcodes_class_name;
	}

	if(adorn_edge_core_plugin_installed()) {
		add_filter('edge_core_filter_add_vc_shortcode', 'adorn_edge_add_product_list_carousel_shortcode');
	}
}