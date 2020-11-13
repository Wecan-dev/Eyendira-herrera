<?php

if (!function_exists('adorn_edge_register_sidebars')) {
    /**
     * Function that registers theme's sidebars
     */
    function adorn_edge_register_sidebars() {

        register_sidebar(array(
            'name' => esc_html__('Sidebar', 'adorn'),
            'id' => 'sidebar',
            'description' => esc_html__('Default Sidebar', 'adorn'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="edge-widget-title-holder"><h5 class="edge-widget-title">',
            'after_title' => '</h5></div>'
        ));
    }

    add_action('widgets_init', 'adorn_edge_register_sidebars', 1);
}

if (!function_exists('adorn_edge_add_support_custom_sidebar')) {
    /**
     * Function that adds theme support for custom sidebars. It also creates AdornEdgeSidebar object
     */
    function adorn_edge_add_support_custom_sidebar() {
        add_theme_support('AdornEdgeSidebar');
        if (get_theme_support('AdornEdgeSidebar')) new AdornEdgeSidebar();
    }

    add_action('after_setup_theme', 'adorn_edge_add_support_custom_sidebar');
}