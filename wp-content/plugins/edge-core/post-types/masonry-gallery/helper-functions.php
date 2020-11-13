<?php

if(!function_exists('edge_core_masonry_gallery_meta_box_functions')) {
	function edge_core_masonry_gallery_meta_box_functions($post_types) {
		$post_types[] = 'masonry-gallery';
		
		return $post_types;
	}
	
	add_filter('adorn_edge_meta_box_post_types_save', 'edge_core_masonry_gallery_meta_box_functions');
	add_filter('adorn_edge_meta_box_post_types_remove', 'edge_core_masonry_gallery_meta_box_functions');
}

if(!function_exists('edge_core_register_masonry_gallery_cpt')) {
	function edge_core_register_masonry_gallery_cpt($cpt_class_name) {
		$cpt_class = array(
			'EdgeCore\CPT\MasonryGallery\MasonryGalleryRegister'
		);
		
		$cpt_class_name = array_merge($cpt_class_name, $cpt_class);
		
		return $cpt_class_name;
	}
	
	add_filter('edge_core_filter_register_custom_post_types', 'edge_core_register_masonry_gallery_cpt');
}