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

        $classes[] = 'edge-search-slides-from-window-top';

        return $classes;

    }

    add_filter('body_class', 'adorn_edge_search_body_class');
}

if ( ! function_exists('adorn_edge_get_search') ) {
    /**
     * Loads search HTML based on search type option.
     */
    function adorn_edge_get_search() {

        add_action( 'adorn_edge_after_header_menu_area_html_open', 'adorn_edge_load_search_template');
        if ( adorn_edge_is_responsive_on() ) {
            add_action( 'adorn_edge_after_mobile_header_html_open', 'adorn_edge_load_search_template');
        }
    }

    add_action('adorn_edge_before_page_header', 'adorn_edge_get_search', 9);
}

if ( ! function_exists('adorn_edge_load_search_template') ) {
    /**
     * Loads search HTML based on search type option.
     */
    function adorn_edge_load_search_template() {

        $search_in_grid = adorn_edge_options()->getOptionValue('search_in_grid') == 'yes' ? true : false;
        $search_icon = '';
        $search_icon_close = '';
        if ( adorn_edge_options()->getOptionValue('search_icon_pack') !== '' ) {
            $search_icon = adorn_edge_icon_collections()->getSearchIcon( adorn_edge_options()->getOptionValue('search_icon_pack'), true );
            $search_icon_close = adorn_edge_icon_collections()->getSearchClose( adorn_edge_options()->getOptionValue('search_icon_pack'), true );
        }

        $parameters = array(
            'search_in_grid'		=> $search_in_grid,
            'search_icon'			=> $search_icon,
            'search_icon_close'		=> $search_icon_close
        );

        adorn_edge_get_module_template_part('templates/types/slide-from-window-top', 'search', '', $parameters);

    }
}