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
	
	<div class="edge-wrapper edge-404-page">
	    <div class="edge-wrapper-inner">
		    <?php adorn_edge_get_header(); ?>
		    <?php adorn_edge_get_title(); ?>

			<div class="edge-content" <?php adorn_edge_content_elem_style_attr(); ?>>
	            <div class="edge-content-inner">
					<div class="edge-page-not-found">
						<?php
							$edge_title_image_404 = adorn_edge_options()->getOptionValue('404_page_title_image');
							$edge_title_404       = adorn_edge_options()->getOptionValue('404_title');
							$edge_subtitle_404    = adorn_edge_options()->getOptionValue('404_subtitle');
							$edge_text_404        = adorn_edge_options()->getOptionValue('404_text');
							$edge_button_label    = adorn_edge_options()->getOptionValue('404_back_to_home');
						?>

						<?php if (!empty($edge_title_image_404)) { ?>
							<div class="edge-404-title-image"><img src="<?php echo esc_url($edge_title_image_404); ?>" alt="<?php esc_attr_e('404 Title Image', 'adorn'); ?>" /></div>
						<?php } ?>

                        <span class="edge-icon-shortcode edge-normal">
                        <i class="edge-icon-linear-icon lnr lnr-cross edge-icon-element" style=""></i>
                        </span>

						<h2 class="edge-page-not-found-title">
							<?php if(!empty($edge_title_404)) {
								echo esc_html($edge_title_404);
							} else {
								esc_html_e('404 ERROR', 'adorn');
							} ?>
						</h2>

						<?php
                        if($edge_subtitle_404 !== ''){ ?>
                            <h3 class="edge-page-not-found-subtitle">
		                        <?php if(!empty($edge_subtitle_404)){
			                        echo esc_html($edge_subtitle_404);
		                        }?>
                            </h3>
                        <?php }
                        ?>

						<p class="edge-page-not-found-text">
							<?php if(!empty($edge_text_404)){
								echo esc_html($edge_text_404);
							} else {
								esc_html_e('The page requested couldn\'t be found. This could be a spelling error in the URL or a removed page.', 'adorn');
							} ?>
						</p>

						<?php
							$edge_params = array();
							$edge_params['text'] = !empty($edge_button_label) ? $edge_button_label : esc_html__('Go back to the homepage', 'adorn');
							$edge_params['link'] = esc_url(home_url('/'));
							$edge_params['target'] = '_self';
							$edge_params['size'] = 'medium';

						echo adorn_edge_execute_shortcode('edge_button',$edge_params);?>
					</div>
				</div>	
			</div>
		</div>
	</div>
    <?php get_footer(); ?>
</body>
</html>