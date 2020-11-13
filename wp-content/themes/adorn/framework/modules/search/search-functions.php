<?php

if( !function_exists('adorn_edge_load_search') ) {
    function adorn_edge_load_search() {

        $search_type = 'fullscreen';
        $search_type = adorn_edge_options()->getOptionValue('search_type');

        if ( adorn_edge_active_widget( false, false, 'edge_search_opener' ) ) {
            include_once EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/search/types/' . $search_type . '.php';
        }
    }

    add_action('init', 'adorn_edge_load_search');
}