<?php

if (!function_exists('adorn_edge_social_options_map')) {

    function adorn_edge_social_options_map() {

        adorn_edge_add_admin_page(
            array(
                'slug' => '_social_page',
                'title' => esc_html__('Social', 'adorn'),
                'icon' => 'fa fa-share-alt'
            )
        );

        /**
         * Enable Social Share
         */
        $panel_social_share = adorn_edge_add_admin_panel(array(
            'page' => '_social_page',
            'name' => 'panel_social_share',
            'title' => esc_html__('Enable Social Share', 'adorn')
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_social_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Social Share', 'adorn'),
            'description' => esc_html__('Enabling this option will allow social share on networks of your choice', 'adorn'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#edge_panel_social_networks, #edge_panel_show_social_share_on'
            ),
            'parent' => $panel_social_share
        ));

        $panel_show_social_share_on = adorn_edge_add_admin_panel(array(
            'page' => '_social_page',
            'name' => 'panel_show_social_share_on',
            'title' => esc_html__('Show Social Share On', 'adorn'),
            'hidden_property' => 'enable_social_share',
            'hidden_value' => 'no'
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_social_share_on_post',
            'default_value' => 'no',
            'label' => esc_html__('Posts', 'adorn'),
            'description' => esc_html__('Show Social Share on Blog Posts', 'adorn'),
            'parent' => $panel_show_social_share_on
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_social_share_on_page',
            'default_value' => 'no',
            'label' => esc_html__('Pages', 'adorn'),
            'description' => esc_html__('Show Social Share on Pages', 'adorn'),
            'parent' => $panel_show_social_share_on
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_social_share_on_portfolio-item',
            'default_value' => 'no',
            'label' => esc_html__('Portfolio Item', 'adorn'),
            'description' => esc_html__('Show Social Share for Portfolio Items', 'adorn'),
            'parent' => $panel_show_social_share_on
        ));

        if (adorn_edge_is_woocommerce_installed()) {
            adorn_edge_add_admin_field(array(
                'type' => 'yesno',
                'name' => 'enable_social_share_on_product',
                'default_value' => 'no',
                'label' => esc_html__('Product', 'adorn'),
                'description' => esc_html__('Show Social Share for Product Items', 'adorn'),
                'parent' => $panel_show_social_share_on
            ));
        }

        /**
         * Social Share Networks
         */
        $panel_social_networks = adorn_edge_add_admin_panel(array(
            'page' => '_social_page',
            'name' => 'panel_social_networks',
            'title' => esc_html__('Social Networks', 'adorn'),
            'hidden_property' => 'enable_social_share',
            'hidden_value' => 'no'
        ));

        /**
         * Facebook
         */
        adorn_edge_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'facebook_title',
            'title' => esc_html__('Share on Facebook', 'adorn')
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_facebook_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'adorn'),
            'description' => esc_html__('Enabling this option will allow sharing via Facebook', 'adorn'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#edge_enable_facebook_share_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_facebook_share_container = adorn_edge_add_admin_container(array(
            'name' => 'enable_facebook_share_container',
            'hidden_property' => 'enable_facebook_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'image',
            'name' => 'facebook_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'adorn'),
            'parent' => $enable_facebook_share_container
        ));

        /**
         * Twitter
         */
        adorn_edge_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'twitter_title',
            'title' => esc_html__('Share on Twitter', 'adorn')
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_twitter_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'adorn'),
            'description' => esc_html__('Enabling this option will allow sharing via Twitter', 'adorn'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#edge_enable_twitter_share_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_twitter_share_container = adorn_edge_add_admin_container(array(
            'name' => 'enable_twitter_share_container',
            'hidden_property' => 'enable_twitter_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'image',
            'name' => 'twitter_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'adorn'),
            'parent' => $enable_twitter_share_container
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'text',
            'name' => 'twitter_via',
            'default_value' => '',
            'label' => esc_html__('Via', 'adorn'),
            'parent' => $enable_twitter_share_container
        ));

        /**
         * Google Plus
         */
        adorn_edge_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'google_plus_title',
            'title' => esc_html__('Share on Google Plus', 'adorn')
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_google_plus_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'adorn'),
            'description' => esc_html__('Enabling this option will allow sharing via Google Plus', 'adorn'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#edge_enable_google_plus_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_google_plus_container = adorn_edge_add_admin_container(array(
            'name' => 'enable_google_plus_container',
            'hidden_property' => 'enable_google_plus_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'image',
            'name' => 'google_plus_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'adorn'),
            'parent' => $enable_google_plus_container
        ));

        /**
         * Linked In
         */
        adorn_edge_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'linkedin_title',
            'title' => esc_html__('Share on LinkedIn', 'adorn')
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_linkedin_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'adorn'),
            'description' => esc_html__('Enabling this option will allow sharing via LinkedIn', 'adorn'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#edge_enable_linkedin_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_linkedin_container = adorn_edge_add_admin_container(array(
            'name' => 'enable_linkedin_container',
            'hidden_property' => 'enable_linkedin_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'image',
            'name' => 'linkedin_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'adorn'),
            'parent' => $enable_linkedin_container
        ));

        /**
         * Tumblr
         */
        adorn_edge_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'tumblr_title',
            'title' => esc_html__('Share on Tumblr', 'adorn')
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_tumblr_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'adorn'),
            'description' => esc_html__('Enabling this option will allow sharing via Tumblr', 'adorn'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#edge_enable_tumblr_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_tumblr_container = adorn_edge_add_admin_container(array(
            'name' => 'enable_tumblr_container',
            'hidden_property' => 'enable_tumblr_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'image',
            'name' => 'tumblr_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'adorn'),
            'parent' => $enable_tumblr_container
        ));

        /**
         * Pinterest
         */
        adorn_edge_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'pinterest_title',
            'title' => esc_html__('Share on Pinterest', 'adorn')
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_pinterest_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'adorn'),
            'description' => esc_html__('Enabling this option will allow sharing via Pinterest', 'adorn'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#edge_enable_pinterest_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_pinterest_container = adorn_edge_add_admin_container(array(
            'name' => 'enable_pinterest_container',
            'hidden_property' => 'enable_pinterest_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'image',
            'name' => 'pinterest_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'adorn'),
            'parent' => $enable_pinterest_container
        ));

        /**
         * VK
         */
        adorn_edge_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'vk_title',
            'title' => esc_html__('Share on VK', 'adorn')
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_vk_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'adorn'),
            'description' => esc_html__('Enabling this option will allow sharing via VK', 'adorn'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#edge_enable_vk_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_vk_container = adorn_edge_add_admin_container(array(
            'name' => 'enable_vk_container',
            'hidden_property' => 'enable_vk_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'image',
            'name' => 'vk_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'adorn'),
            'parent' => $enable_vk_container
        ));

        if (defined('EDGE_TWITTER_FEED_VERSION')) {
            $twitter_panel = adorn_edge_add_admin_panel(array(
                'title' => esc_html__('Twitter', 'adorn'),
                'name' => 'panel_twitter',
                'page' => '_social_page'
            ));

            adorn_edge_add_admin_twitter_button(array(
                'name' => 'twitter_button',
                'parent' => $twitter_panel
            ));
        }

        if (defined('EDGE_INSTAGRAM_FEED_VERSION')) {
            $instagram_panel = adorn_edge_add_admin_panel(array(
                'title' => esc_html__('Instagram', 'adorn'),
                'name' => 'panel_instagram',
                'page' => '_social_page'
            ));

            adorn_edge_add_admin_instagram_button(array(
                'name' => 'instagram_button',
                'parent' => $instagram_panel
            ));
        }

        /**
         * Open Graph
         */
        $panel_open_graph = adorn_edge_add_admin_panel(array(
            'page' => '_social_page',
            'name' => 'panel_open_graph',
            'title' => esc_html__('Open Graph', 'adorn'),
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_open_graph',
            'default_value' => 'no',
            'label' => esc_html__('Enable Open Graph', 'adorn'),
            'description' => esc_html__('Enabling this option will allow usage of Open Graph protocol on your site', 'adorn'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#edge_enable_open_graph_container'
            ),
            'parent' => $panel_open_graph
        ));

        $enable_open_graph_container = adorn_edge_add_admin_container(array(
            'name' => 'enable_open_graph_container',
            'hidden_property' => 'enable_open_graph',
            'hidden_value' => 'no',
            'parent' => $panel_open_graph
        ));

        adorn_edge_add_admin_field(array(
            'type' => 'image',
            'name' => 'open_graph_image',
            'default_value' => EDGE_ASSETS_ROOT . '/img/open_graph.jpg',
            'label' => esc_html__('Default Share Image', 'adorn'),
            'parent' => $enable_open_graph_container,
            'description' => esc_html('Used when featured image is not set. Make sure that image is at least 1200 x 630 pixels, up to 8MB in size', 'adorn'),
        ));
		do_action('adorn_edge_additional_social_options');
    }

    add_action('adorn_edge_options_map', 'adorn_edge_social_options_map', 16);
}