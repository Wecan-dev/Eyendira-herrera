<?php
if (!function_exists('adorn_edge_register_side_area_sidebar')) {
    /**
     * Register side area sidebar
     */
    function adorn_edge_register_side_area_sidebar() {

        register_sidebar(array(
            'name' => esc_html__('Side Area', 'adorn'),
            'id' => 'sidearea', //TODO Change name of sidebar
            'description' => esc_html__('Side Area', 'adorn'),
            'before_widget' => '<div id="%1$s" class="widget edge-sidearea %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="edge-widget-title-holder"><h5 class="edge-widget-title">',
            'after_title' => '</h5></div>'
        ));
    }

    add_action('widgets_init', 'adorn_edge_register_side_area_sidebar');
}

if (!function_exists('adorn_edge_register_side_area_bottom_sidebar')) {
    /**
     * Register side area sidebar
     */
    function adorn_edge_register_side_area_bottom_sidebar() {

        register_sidebar(array(
            'name' => esc_html__('Side Area Bottom', 'adorn'),
            'id' => 'sideareabottom', //TODO Change name of sidebar
            'description' => esc_html__('Side Area Bottom', 'adorn'),
            'before_widget' => '<div id="%1$s" class="widget edge-sidearea %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="edge-widget-title-holder"><h5 class="edge-widget-title">',
            'after_title' => '</h5></div>'
        ));
    }

    add_action('widgets_init', 'adorn_edge_register_side_area_bottom_sidebar');
}

if (!function_exists('adorn_edge_side_menu_body_class')) {
    /**
     * Function that adds body classes for different side menu styles
     *
     * @param $classes array original array of body classes
     *
     * @return array modified array of classes
     */
    function adorn_edge_side_menu_body_class($classes) {

        if (is_active_widget(false, false, 'edge_side_area_opener')) {

            $classes[] = 'edge-side-menu-slide-from-right';
        }

        return $classes;
    }

    add_filter('body_class', 'adorn_edge_side_menu_body_class');
}

if (!function_exists('adorn_edge_get_side_area')) {
    /**
     * Loads side area HTML
     */
    function adorn_edge_get_side_area() {

        if (is_active_widget(false, false, 'edge_side_area_opener')) {

            adorn_edge_get_module_template_part('templates/sidearea', 'sidearea');
        }
    }
	
	add_action('adorn_edge_after_body_tag', 'adorn_edge_get_side_area', 10);
}

