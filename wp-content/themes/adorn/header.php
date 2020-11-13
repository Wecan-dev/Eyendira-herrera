<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php
    /**
     * adorn_edge_header_meta hook
     *
     * @see adorn_edge_header_meta() - hooked with 10
     * @see adorn_edge_user_scalable_meta - hooked with 10
     */
    do_action('adorn_edge_header_meta');

    wp_head(); ?>
</head>
<body <?php body_class();?> itemscope itemtype="http://schema.org/WebPage">
    <?php
    /**
     * adorn_edge_after_body_tag hook
     *
     * @see adorn_edge_get_side_area() - hooked with 10
     * @see adorn_edge_smooth_page_transitions() - hooked with 10
     */
    do_action('adorn_edge_after_body_tag'); ?>

    <div class="edge-wrapper">
        <div class="edge-wrapper-inner">
            <?php adorn_edge_get_header(); ?>
	
	        <?php
	        /**
	         * adorn_edge_after_header_area hook
	         *
	         * @see adorn_edge_back_to_top_button() - hooked with 10
	         * @see adorn_edge_get_full_screen_menu() - hooked with 10
	         * @see adorn_edge_get_social_sidebar() - hooked with 10
	         */
	        do_action('adorn_edge_after_header_area'); ?>
	        
            <div class="edge-content" <?php adorn_edge_content_elem_style_attr(); ?>>
                <div class="edge-content-inner">