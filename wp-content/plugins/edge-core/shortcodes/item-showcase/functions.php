<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Edge_Item_Showcase extends WPBakeryShortCodesContainer {}
}

if(!function_exists('edge_core_add_item_showcase_shortcodes')) {
	function edge_core_add_item_showcase_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'EdgeCore\CPT\Shortcodes\ItemShowcase\ItemShowcase',
			'EdgeCore\CPT\Shortcodes\ItemShowcaseItem\ItemShowcaseItem'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('edge_core_filter_add_vc_shortcode', 'edge_core_add_item_showcase_shortcodes');
}