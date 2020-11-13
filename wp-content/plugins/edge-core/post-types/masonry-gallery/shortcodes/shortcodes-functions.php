<?php

if(!function_exists('edge_core_include_masonry_gallery_shortcodes')) {
	function edge_core_include_masonry_gallery_shortcodes() {
		include_once EDGE_CORE_CPT_PATH.'/masonry-gallery/shortcodes/masonry-gallery.php';
	}
	
	add_action('edge_core_action_include_shortcodes_file', 'edge_core_include_masonry_gallery_shortcodes');
}

if(!function_exists('edge_core_add_masonry_gallery_shortcodes')) {
	function edge_core_add_masonry_gallery_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'EdgeCore\CPT\Shortcodes\MasonryGallery\MasonryGallery'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('edge_core_filter_add_vc_shortcode', 'edge_core_add_masonry_gallery_shortcodes');
}