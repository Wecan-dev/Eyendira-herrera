<?php

if(!function_exists('adorn_edge_include_blog_shortcodes')) {
	function adorn_edge_include_blog_shortcodes() {
		include_once EDGE_FRAMEWORK_MODULES_ROOT_DIR.'/blog/shortcodes/blog-list/blog-list.php';
		include_once EDGE_FRAMEWORK_MODULES_ROOT_DIR.'/blog/shortcodes/blog-slider/blog-slider.php';
	}
	
	if(adorn_edge_core_plugin_installed()) {
		add_action('edge_core_action_include_shortcodes_file', 'adorn_edge_include_blog_shortcodes');
	}
}

if(!function_exists('adorn_edge_add_blog_shortcodes')) {
	function adorn_edge_add_blog_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'EdgeCore\CPT\Shortcodes\BlogList\BlogList',
			'EdgeCore\CPT\Shortcodes\BlogSlider\BlogSlider'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	if(adorn_edge_core_plugin_installed()) {
		add_filter('edge_core_filter_add_vc_shortcode', 'adorn_edge_add_blog_shortcodes');
	}
}