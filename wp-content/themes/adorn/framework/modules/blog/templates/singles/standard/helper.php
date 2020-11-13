<?php

if( !function_exists('adorn_edge_get_blog_holder_params') ) {
    /**
     * Function that generates params for holders on blog templates
     */
    function adorn_edge_get_blog_holder_params($params) {
        $params_list = array();

        $params_list['holder'] = 'edge-container';
        $params_list['inner'] = 'edge-container-inner clearfix';

        return $params_list;
    }

    add_filter( 'adorn_edge_blog_holder_params', 'adorn_edge_get_blog_holder_params' );
}

if( !function_exists('adorn_edge_get_blog_single_holder_classes') ) {
    /**
     * Function that generates blog holder classes for single blog page
     */
    function adorn_edge_get_blog_single_holder_classes($classes) {
        $sidebar_classes   = array();
        $sidebar_classes[] = 'edge-grid-large-gutter';
	
	    $classes = $classes . ' ' . implode(' ', $sidebar_classes);
	    
        return $classes;
    }

    add_filter( 'adorn_edge_blog_single_holder_classes', 'adorn_edge_get_blog_single_holder_classes' );
}

if( !function_exists('adorn_edge_blog_part_params') ) {
    function adorn_edge_blog_part_params($params) {

        $part_params = array();
        $part_params['title_tag'] = 'h2';
        $part_params['link_tag'] = 'h5';
        $part_params['quote_tag'] = 'h5';

        return array_merge($params, $part_params);
    }

    add_filter( 'adorn_edge_blog_part_params', 'adorn_edge_blog_part_params' );
}