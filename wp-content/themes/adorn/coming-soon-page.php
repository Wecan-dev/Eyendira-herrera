<?php
/*
Template Name: Coming Soon Page
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
	    <?php
	    /**
	     * adorn_edge_header_meta hook
	     *
	     * @see adorn_edge_header_meta() - hooked with 10
	     * @see adorn_edge_user_scalable_meta() - hooked with 10
	     */
	    do_action('adorn_edge_header_meta');

	    wp_head(); ?>
    </head>
	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
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
				<div class="edge-content">
		            <div class="edge-content-inner">
						<div class="edge-full-width">
							<div class="edge-full-width-inner">
								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
									<?php the_content(); ?>
								<?php endwhile; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>