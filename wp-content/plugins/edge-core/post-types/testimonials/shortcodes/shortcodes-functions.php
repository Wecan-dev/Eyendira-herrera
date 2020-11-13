<?php

if(!function_exists('edge_core_include_testimonials_shortcodes')) {
	function edge_core_include_testimonials_shortcodes() {
		include_once EDGE_CORE_CPT_PATH.'/testimonials/shortcodes/testimonials.php';
	}
	
	add_action('edge_core_action_include_shortcodes_file', 'edge_core_include_testimonials_shortcodes');
}

if(!function_exists('edge_core_add_testimonials_shortcodes')) {
	function edge_core_add_testimonials_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'EdgeCore\CPT\Shortcodes\Testimonials\Testimonials'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('edge_core_filter_add_vc_shortcode', 'edge_core_add_testimonials_shortcodes');
}