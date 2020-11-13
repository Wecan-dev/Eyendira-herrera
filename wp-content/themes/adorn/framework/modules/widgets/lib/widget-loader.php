<?php

if (!function_exists('adorn_edge_register_widgets')) {
	function adorn_edge_register_widgets() {
		$widgets = array(
			'AdornEdgeBlogListWidget',
			'AdornEdgeButtonWidget',
			'AdornEdgeImageWidget',
			'AdornEdgeImageSliderWidget',
			'AdornEdgeRawHTMLWidget',
			'AdornEdgeSearchOpener',
			'AdornEdgeSeparatorWidget',
			'AdornEdgeSideAreaOpener',
			'AdornEdgeSocialIconWidget',
			'AdornEdgePopupOpener'
		);

		if( adorn_edge_is_woocommerce_installed() && adorn_edge_is_yith_wishlist_installed() ) {
			$widgets[] = 'AdornEdgeYithWishlist';
		}

		if( adorn_edge_is_woocommerce_installed() ) {
			$widgets[] = 'AdornEdgeWoocommerceDropdownCart';
		}

		if( adorn_edge_core_plugin_installed() ) {
			foreach ($widgets as $widget) {
				adorn_edge_create_wp_widget($widget);
			}
		}
	}
	
	add_action('widgets_init', 'adorn_edge_register_widgets');
}