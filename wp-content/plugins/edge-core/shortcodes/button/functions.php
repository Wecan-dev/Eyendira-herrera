<?php

if(!function_exists('adorn_edge_get_button_html')) {
    /**
     * Calls button shortcode with given parameters and returns it's output
     * @param $params
     *
     * @return mixed|string
     */
    function adorn_edge_get_button_html($params) {
        $button_html = adorn_edge_execute_shortcode('edge_button', $params);
        $button_html = str_replace("\n", '', $button_html);
        return $button_html;
    }
}

if(!function_exists('edge_core_add_button_shortcodes')) {
	function edge_core_add_button_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'EdgeCore\CPT\Shortcodes\Button\Button'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('edge_core_filter_add_vc_shortcode', 'edge_core_add_button_shortcodes');
}