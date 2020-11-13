<?php

if (!function_exists('edge_core_map_portfolio_meta')) {
    function edge_core_map_portfolio_meta() {
        global $adorn_Framework;

        $edge_pages = array();
        $pages = get_pages();
        foreach ($pages as $page) {
            $edge_pages[$page->ID] = $page->post_title;
        }

        //Portfolio Images

        $edgePortfolioImages = new AdornEdgeMetaBox('portfolio-item', esc_html__('Portfolio Images (multiple upload)', 'edge-core'), '', '', 'portfolio_images');
        $adorn_Framework->edgeMetaBoxes->addMetaBox('portfolio_images', $edgePortfolioImages);

        $edge_portfolio_image_gallery = new AdornEdgeMultipleImages('edge-portfolio-image-gallery', esc_html__('Portfolio Images', 'edge-core'), esc_html__('Choose your portfolio images', 'edge-core'));
        $edgePortfolioImages->addChild('edge-portfolio-image-gallery', $edge_portfolio_image_gallery);

        //Portfolio Images/Videos 2

        $edgePortfolioImagesVideos2 = new AdornEdgeMetaBox('portfolio-item', esc_html__('Portfolio Images/Videos (single upload)', 'edge-core'));
        $adorn_Framework->edgeMetaBoxes->addMetaBox('portfolio_images_videos2', $edgePortfolioImagesVideos2);

        $edge_portfolio_images_videos2 = new AdornEdgeImagesVideosFramework('', '');
        $edgePortfolioImagesVideos2->addChild('edge_portfolio_images_videos2', $edge_portfolio_images_videos2);

        //Portfolio Additional Sidebar Items

        $edgeAdditionalSidebarItems = adorn_edge_create_meta_box(
            array(
                'scope' => array('portfolio-item'),
                'title' => esc_html__('Additional Portfolio Sidebar Items', 'edge-core'),
                'name' => 'portfolio_properties'
            )
        );

        $edge_portfolio_properties = adorn_edge_add_options_framework(
            array(
                'label' => esc_html__('Portfolio Properties', 'edge-core'),
                'name' => 'edge_portfolio_properties',
                'parent' => $edgeAdditionalSidebarItems
            )
        );
    }

    add_action('adorn_edge_meta_boxes_map', 'edge_core_map_portfolio_meta', 40);
}