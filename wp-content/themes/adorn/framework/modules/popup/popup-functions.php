<?php

if ( ! function_exists('adorn_edge_get_popup') ) {
    /**
     * Loads search HTML based on search type option.
     */
    function adorn_edge_get_popup() {

        if ( adorn_edge_active_widget( false, false, 'edge_popup_opener' ) ) {
            if(adorn_edge_options()->getOptionValue('enable_popup') === 'yes') {
                adorn_edge_load_popup_template();
            }
        }
    }
}

if ( ! function_exists('adorn_edge_load_popup_template') ) {
    /**
     * Loads HTML template with parameters
     */
    function adorn_edge_load_popup_template() {
        $parameters = array();
        $parameters['image'] = adorn_edge_options()->getOptionValue('popup_image');
        $parameters['title'] = adorn_edge_options()->getOptionValue('popup_title');
        $parameters['subtitle'] = adorn_edge_options()->getOptionValue('popup_subtitle');
        $parameters['desc'] = adorn_edge_options()->getOptionValue('popup_desc');
        $parameters['contact_form'] = adorn_edge_options()->getOptionValue('popup_contact_form');
        $parameters['contact_form_style'] = adorn_edge_options()->getOptionValue('popup_contact_form_style');
        adorn_edge_get_module_template_part( 'templates/popup', 'popup', '', $parameters );
    }
}