<?php

if(!function_exists('adorn_edge_title_classes')) {
    /**
     * Function that adds classes to title div.
     * All other functions are tied to it with add_filter function
     * @param array $classes array of classes
     * @param string $module name of module calling title
     */
    function adorn_edge_title_classes($classes = array()) {
        $classes = array();
        $classes = apply_filters('adorn_edge_title_classes', $classes);

        if(is_array($classes) && count($classes)) {
            echo implode(' ', $classes);
        }
    }
}

if(!function_exists('adorn_edge_title_type_class')) {
    /**
     * Function that adds class on title based on title type option
     * @param $classes original array of classes
     * @return array changed array of classes
     */
    function adorn_edge_title_type_class($classes) {
		$id = adorn_edge_get_page_id();

		if((adorn_edge_is_product_category() || adorn_edge_is_product_tag()) && adorn_edge_get_woo_shop_page_id()) {
			$id = adorn_edge_get_woo_shop_page_id();
		}

        $title_type = adorn_edge_get_meta_field_intersect('title_area_type', $id);

	    if(!empty($title_type)) {
		    $classes[] = 'edge-'.$title_type.'-type';
	    }

        return $classes;
    }

    add_filter('adorn_edge_title_classes', 'adorn_edge_title_type_class');
}

if(!function_exists('adorn_edge_title_content_alignment_class')) {
	/**
	 * Function that adds class on title based on title content alignmnt option
	 * Could be left, centered or right
	 * @param $classes original array of classes
	 * @return array changed array of classes
	 */
	function adorn_edge_title_content_alignment_class($classes) {
		$id = adorn_edge_get_page_id();

		if((adorn_edge_is_product_category() || adorn_edge_is_product_tag()) && adorn_edge_get_woo_shop_page_id()) {
			$id = adorn_edge_get_woo_shop_page_id();
		}

		$title_content_alignment = adorn_edge_get_meta_field_intersect('title_area_content_alignment', $id);
		
		if(!empty($title_content_alignment)) {
			$classes[] = 'edge-content-'.$title_content_alignment.'-alignment';
		}
		
		return $classes;
	}
	
	add_filter('adorn_edge_title_classes', 'adorn_edge_title_content_alignment_class');
}

if(!function_exists('adorn_edge_title_background_image_classes')) {
    function adorn_edge_title_background_image_classes($classes) {
        //init variables
        $id                      = adorn_edge_get_page_id();
		if((adorn_edge_is_product_category() || adorn_edge_is_product_tag()) && adorn_edge_get_woo_shop_page_id()) {
			$id = adorn_edge_get_woo_shop_page_id();
		}
		$title_img				 = apply_filters('adorn_edge_title_image_exists', adorn_edge_get_meta_field_intersect('title_area_background_image', $id));
	    $is_img_responsive 		 = adorn_edge_get_meta_field_intersect('title_area_background_image_responsive', $id);
	    $is_image_parallax		 = adorn_edge_get_meta_field_intersect('title_area_background_image_parallax', $id);
	    $is_image_parallax_array = array('yes', 'yes_zoom');
		$hide_title_img			 = get_post_meta($id, "edge_hide_background_image_meta", true) == 'yes' ? true : false;

        //is title image set and visible?
		// Removed check for is title image set because of blog single module title (featured image used as title image). Added css for container auto heihgt.
		if($title_img != '' && !$hide_title_img) {
            //is image not responsive and parallax title is set?
            $classes[] = 'edge-preload-background';
            $classes[] = 'edge-has-background';

            if($is_img_responsive == 'no' && in_array($is_image_parallax, $is_image_parallax_array)) {
                $classes[] = 'edge-has-parallax-background';

                if($is_image_parallax == 'yes_zoom') {
                    $classes[] = 'edge-zoom-out';
                }
            }

            //is image not responsive
            elseif($is_img_responsive == 'yes'){
                $classes[] = 'edge-has-responsive-background';
            }
        }

        return $classes;
    }

    add_filter('adorn_edge_title_classes', 'adorn_edge_title_background_image_classes');
}

if(!function_exists('adorn_edge_title_background_image_div_classes')) {
	function adorn_edge_title_background_image_div_classes($classes) {
		//init variables
		$id                 = adorn_edge_get_page_id();
		if((adorn_edge_is_product_category() || adorn_edge_is_product_tag()) && adorn_edge_get_woo_shop_page_id()) {
			$id = adorn_edge_get_woo_shop_page_id();
		}
		$title_img			= apply_filters('adorn_edge_title_image_exists', adorn_edge_get_meta_field_intersect('title_area_background_image', $id));
		$is_img_responsive 	= adorn_edge_get_meta_field_intersect('title_area_background_image_responsive', $id);
		$hide_title_img			 = get_post_meta($id, "edge_hide_background_image_meta", true) == 'yes' ? true : false;
		
		//is title image set, visible and responsive?
		// Removed check for is title image set because of blog single module title (featured image used as title image). Added css for container auto heihgt.
		if($title_img != '' && !$hide_title_img) {
			
			//is image responsive?
			if($is_img_responsive == 'yes') {
				$classes[] = 'edge-title-image-responsive';
			}
			//is image not responsive?
			elseif($is_img_responsive == 'no') {
				$classes[] = 'edge-title-image-not-responsive';
			}
		}
		
		return $classes;
	}
	
	add_filter('adorn_edge_title_classes', 'adorn_edge_title_background_image_div_classes');
}