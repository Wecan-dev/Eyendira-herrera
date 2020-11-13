<?php

if(!function_exists('edge_membership_add_register_shortcodes')) {
    function edge_membership_add_register_shortcodes($shortcodes_class_name) {
        $shortcodes = array(
            'EdgeMembership\Shortcodes\EdgeUserRegister\EdgeUserRegister'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('edge_membership_filter_add_vc_shortcode', 'edge_membership_add_register_shortcodes');
}