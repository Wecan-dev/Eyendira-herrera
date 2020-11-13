<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Edge_Split_Scrolling_Section extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Edge_Split_Scrolling_Section_Left_Panel extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Edge_Split_Scrolling_Section_Right_Panel extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Edge_Split_Scrolling_Section_Content_Item extends WPBakeryShortCodesContainer {}
}

if(!function_exists('edge_core_add_vertical_split_screen_slider_shortcodes')) {
	function edge_core_add_vertical_split_screen_slider_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'EdgeCore\CPT\Shortcodes\SplitScrollingSection\SplitScrollingSection',
			'EdgeCore\CPT\Shortcodes\SplitScrollingSectionContentItem\SplitScrollingSectionContentItem',
			'EdgeCore\CPT\Shortcodes\SplitScrollingSectionLeftPanel\SplitScrollingSectionLeftPanel',
			'EdgeCore\CPT\Shortcodes\SplitScrollingSectionRightPanel\SplitScrollingSectionRightPanel'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('edge_core_filter_add_vc_shortcode', 'edge_core_add_vertical_split_screen_slider_shortcodes');
}