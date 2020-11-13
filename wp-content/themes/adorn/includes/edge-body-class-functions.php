<?php

if(!function_exists('adorn_edge_theme_version_class')) {
    /**
     * Function that adds classes on body for version of theme
     */
    function adorn_edge_theme_version_class($classes) {
        $current_theme = wp_get_theme();

        //is child theme activated?
        if($current_theme->parent()) {
            //add child theme version
            $classes[] = strtolower($current_theme->get('Name')).'-child-ver-'.$current_theme->get('Version');

            //get parent theme
            $current_theme = $current_theme->parent();
        }

        if($current_theme->exists() && $current_theme->get('Version') != '') {
            $classes[] = strtolower($current_theme->get('Name')).'-ver-'.$current_theme->get('Version');
        }

        return $classes;
    }

    add_filter('body_class', 'adorn_edge_theme_version_class');
}

if(!function_exists('adorn_edge_boxed_class')) {
    /**
     * Function that adds classes on body for boxed layout
     */
    function adorn_edge_boxed_class($classes) {

        //is boxed layout turned on?
        if(adorn_edge_get_meta_field_intersect('boxed') == 'yes' && adorn_edge_get_meta_field_intersect('header_type') !== 'header-vertical') {
            $classes[] = 'edge-boxed';
        }

        return $classes;
    }

    add_filter('body_class', 'adorn_edge_boxed_class');
}

if(!function_exists('adorn_edge_paspartu_class')) {
    /**
     * Function that adds classes on body for paspartu layout
     */
    function adorn_edge_paspartu_class($classes) {

        //is paspartu layout turned on?
        if(adorn_edge_get_meta_field_intersect('paspartu') === 'yes') {
            $classes[] = 'edge-paspartu-enabled';

            if(adorn_edge_get_meta_field_intersect('disable_top_paspartu') === 'yes') {
                $classes[] = 'edge-top-paspartu-disabled';
            }
        }

        return $classes;
    }

    add_filter('body_class', 'adorn_edge_paspartu_class');
}

if(!function_exists('adorn_edge_smooth_page_transitions_class')) {
    /**
     * Function that adds classes on body for smooth page transitions
     */
    function adorn_edge_smooth_page_transitions_class($classes) {

		$id = adorn_edge_get_page_id();

		if(adorn_edge_get_meta_field_intersect('smooth_page_transitions',$id) == 'yes') {
			$classes[] = 'edge-smooth-page-transitions';

			if(adorn_edge_get_meta_field_intersect('page_transition_preloader',$id) == 'yes') {
				$classes[] = 'edge-smooth-page-transitions-preloader';
			}

			if(adorn_edge_get_meta_field_intersect('page_transition_fadeout',$id) == 'yes') {
				$classes[] = 'edge-smooth-page-transitions-fadeout';
			}

		}
        return $classes;
    }

    add_filter('body_class', 'adorn_edge_smooth_page_transitions_class');
}

if(!function_exists('adorn_edge_content_initial_width_body_class')) {
    /**
     * Function that adds transparent content class to body.
     *
     * @param $classes array of body classes
     *
     * @return array with transparent content body class added
     */
    function adorn_edge_content_initial_width_body_class($classes) {

        if(adorn_edge_options()->getOptionValue('initial_content_width')) {
            $classes[] = adorn_edge_options()->getOptionValue('initial_content_width');
        }

        return $classes;
    }

    add_filter('body_class', 'adorn_edge_content_initial_width_body_class');
}