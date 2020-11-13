<?php

if( !function_exists('adorn_edge_search_body_class') ) {
    /**
     * Function that adds body classes for different search types
     *
     * @param $classes array original array of body classes
     *
     * @return array modified array of classes
     */
    function adorn_edge_search_body_class($classes) {

        $classes[] = 'edge-fullscreen-search';
        $classes[] = 'edge-search-fade';

        return $classes;

    }

    add_filter('body_class', 'adorn_edge_search_body_class');
}

if ( ! function_exists('adorn_edge_get_search') ) {
    /**
     * Loads search HTML based on search type option.
     */
    function adorn_edge_get_search() {
        adorn_edge_load_search_template();
    }

    add_action('adorn_edge_before_page_header', 'adorn_edge_get_search', 9);
}

if ( ! function_exists('adorn_edge_load_search_template') ) {
    /**
     * Loads search HTML based on search type option.
     */
    function adorn_edge_load_search_template() {
        adorn_edge_get_module_template_part('templates/types/fullscreen', 'search');
    }
}