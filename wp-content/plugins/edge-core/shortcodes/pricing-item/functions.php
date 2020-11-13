<?php

if(!function_exists('edge_core_add_pricing_item_shortcodes')) {
    function edge_core_add_pricing_item_shortcodes($shortcodes_class_name) {
        $shortcodes = array(
            'EdgeCore\CPT\Shortcodes\PricingItem\PricingItem'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('edge_core_filter_add_vc_shortcode', 'edge_core_add_pricing_item_shortcodes');
}