<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Edge_Process_Holder extends WPBakeryShortCodesContainer {}
    class WPBakeryShortCode_Edge_Process_Item extends WPBakeryShortCodesContainer {}
}

if(!function_exists('edge_core_add_process_shortcodes')) {
    function edge_core_add_process_shortcodes($shortcodes_class_name) {
        $shortcodes = array(
            'EdgeCore\CPT\Shortcodes\ProcessHolder\ProcessHolder',
            'EdgeCore\CPT\Shortcodes\ProcessItem\ProcessItem'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('edge_core_filter_add_vc_shortcode', 'edge_core_add_process_shortcodes');
}