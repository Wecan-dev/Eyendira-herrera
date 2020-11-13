<?php
$edge_sidebar_layout  = adorn_edge_sidebar_layout();

get_header();
adorn_edge_get_title();
get_template_part('slider');
?>
<div class="edge-container edge-default-page-template">
	<?php do_action('adorn_edge_after_container_open'); ?>
	<div class="edge-container-inner clearfix">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="edge-grid-row">
				<div <?php echo adorn_edge_get_content_sidebar_class(); ?>>
					<?php
						the_content();
						do_action('adorn_edge_page_after_content');
					?>
				</div>
				<?php if($edge_sidebar_layout !== 'no-sidebar') { ?>
					<div <?php echo adorn_edge_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		<?php endwhile; endif; ?>
	</div>
	<?php do_action('adorn_edge_before_container_close'); ?>
</div>
<?php get_footer(); ?>