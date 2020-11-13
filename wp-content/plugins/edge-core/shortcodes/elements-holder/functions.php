<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Edge_Elements_Holder extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Edge_Elements_Holder_Item extends WPBakeryShortCodesContainer {}
}

if(!function_exists('edge_core_add_elements_holder_shortcodes')) {
	function edge_core_add_elements_holder_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'EdgeCore\CPT\Shortcodes\ElementsHolder\ElementsHolder',
			'EdgeCore\CPT\Shortcodes\ElementsHolderItem\ElementsHolderItem'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('edge_core_filter_add_vc_shortcode', 'edge_core_add_elements_holder_shortcodes');
}